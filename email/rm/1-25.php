<div class="row">
    <div class="col-md-3">
        <h2>
			<?php echo $emname;?>
		</h2>
		<font color="red">
			<h5>
				<b>Template Usage: </b>Use this template when a borrower says their current payment schedule doesn’t work for them. 
			</h5>
		</font>
    </div>
    <div class="col-md-9" id="embody" style="border-left: solid;">
        <?php
		if($_GET['set'] == "on"){
			//variables to complete template
			$brwName = htmlspecialchars(trim($_GET['brwName']));
			
			$pmt_new = htmlspecialchars($_GET['pmt_new']);
			$pmt_number_new = htmlspecialchars($_GET['pmt_number_new']);
			$pmt_freq_new = htmlspecialchars($_GET['pmt_freq_new']);
			$pmt_start_date = date_create($_GET['pmt_start_date']);
			$pmt_end_date = date_create($_GET['pmt_end_date']);
			
			
			?>
			<div>
				<a class="btn btn-danger col-md-3" href="emails.php?cs&id=<?php echo $_GET['id'];?>">
						Reset
					<span class="glyphicon glyphicon-refresh"></span>
				</a>
			</div>
			<br>
			<br>
			<hr>
			<div id="copy_notify"></div>
			<div id="email-body">
                <!-- Email Temaplate -->
                <div class="row">
                    <div class="col-lg-4"><button id="copy-init" class="btn btn-primary" onclick="copyFollowUp('email-body',this.value)" value="email">Copy Email</button></div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4"></div>
                </div>
            <hr>
			
			<?php echo brwname($_GET['brwName'],$_GET['sup-correction']);?>
			<p>We want to ensure that your payments are taken according to the days you get paid.</p>
			<p>Here is what we can offer you:</p>
			<div class="offset25px">
				<p>
					<b>NEW SCHEDULE:</b>
					<br>Payment Frequency: <?php echo $pmt_number_new." ".$pmt_freq_new." ";if($pmt_number_new == 1){echo "payment";}else{echo "payments";}?>
					<br>First Payment Date: <?php echo date_format($pmt_start_date,"F jS, Y");?>
					<br>Last Payment Date: <?php echo date_format($pmt_end_date,"F jS, Y");?>
					<br>Payment Amount: $<?php echo number_format($pmt_new,2,".",",");?>
				</p>
			</div>
			
			<p>Any time your payments fall on weekends or holidays, they will be taken the next business day. <b>I will not make any changes to your payment schedule until you confirm.</b></p>
			
			<?php echo pendingpayment(2, $_GET['pendingclick'], $_GET['pennextpmtamt'], $_GET['datepending']);?>
			
			<p>As a friendly reminder, your next payment is due on <?php echo nextpayment(1,$_GET['nextpmtdate']);?>, for the regular amount of <?php echo nextpayment(2,$_GET['nextpmtamt']);?>.</p>
			
			<?php
			include('includes/signature.inc.php');
			?>	
			</div>
			<?php
		}else{
			?>
			<h2 class="text-center">
				Fill Out All Fields
			</h2>
			<br>
			<br>
			<form class="fom form-vertical" method="get">
				<input type="hidden" name="cs"/>
				<input type="hidden" name="id" value="<?php echo $_GET['id'];?>"/>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label for="brwName">
								Borrower´s First Name:
							</label>
							<input class="form-control" type="text" placeholder="i. e. David" name="brwName" required/>
						</div>
						<?php echo nextpayment();?>
					</div>
					<div class="col-md-4">
						<p>Restructure Offer Details</p>
						<div class="form-group">
							<label for="pmt_start_date">
								First Payment Date:
							</label>
							<input class="form-control" type="date" name="pmt_start_date" required/>
						</div>
						<div class="form-group">
							<label for="pmt_end_date">
								Last Payment Date:
							</label>
							<input class="form-control" type="date" name="pmt_end_date" required/>
						</div>
						<div class="form-group">
							<label for="pmt_number_new">
								Number Of Payments:
							</label>
							<input class="form-control" type="text" name="pmt_number_new" required/>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="pmt_new">
								New Payment Amount:
							</label>
							<input class="form-control" type="number" step="0.01" name="pmt_new" required/>
						</div>
						<div class="form-group">
							<label for="pmt_freq_new">
								Payment Frequency:
							</label>
							<select class="form-control" name="pmt_freq_new" required>
								<option value="">Choose One</option>
								<option value="Semi-Monthly">Semi-Monthly</option>
								<option value="Monthly">Monthly</option>
								<option value="Bi-Weekly">Bi-Weekly</option>
							</select>
						</div>
					</div>
				</div>
				<?php pendingpayment(0)?>
				<button type="submit" name="set" class="btn btn-success" value="on" colspan="3">
					Generate Email
				</button>
			</form>
			<?php
		}
		?>
    </div>
</div>