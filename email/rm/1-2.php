<div class="row">
    <div class="col-md-3">
        <h2>
			Payment Arrangement Email <small>(Bank)</small>
		</h2>
		<font color="red">
			<h5>
				<b>Generate: </b>When a customer contacts an agent to change an existing payment and the RM sets up a Special Payment.
			</h5>
		</font>
    </div>
    <div class="col-md-9" id="embody" style="border-left: solid;">
        <?php
		if($_GET['set'] == "on"){
			//variables to complete template
			$brwName = htmlspecialchars(trim($_GET['brwName']));
			$pmtAmt = $_GET['pmtAmt'];
			$pmtdate = date_create($_GET['pmtdate']);
			$bankname = $_GET['bankname'];
			$lastfour = $_GET['lastfour'];
			//next payment
			$pmtnote = $_GET['pmtnote'];
			$nextpmtdate = date_create($_GET['nextpmtdate']);
			$nextpmtamt = $_GET['nextpmtamt'];
			
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
<div class="row">
                    <div class="col-lg-4"><button id="copy-init" class="btn btn-primary" onclick="copyFollowUp('email-body',this.value)" value="email">Copy Email</button></div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4"></div>
                </div>
            <hr>
            <div id="email-body">
                <!-- Email Temaplate -->
			<p>
				<strong>Subject:</strong> Your new payment – $<?php echo number_format($pmtAmt,2,".",",");?> due on <?php echo date_format($pmtdate,"l, F jS");?>
			</p>
			<br>
			
	
			<?php echo brwname($_GET['brwName'],$_GET['sup-correction']);?>
		    
			<p>
				You’re all set to make a payment of $<?php echo number_format($pmtAmt,2,".",",");?> from your bank account on file. This payment will be debited on <?php echo date_format($pmtdate,"l, F jS");?>. 
			</p>
			<?php NxtPmt($nextpmtdate, $nextpmtamt, $pmtnote);?>
			<p>
				Please note that additional interest will accrue and extend to the life of the loan when making partial payments, missing any payments, or by moving them to a later date. 
			</p>
			<?php
			echo comment($_GET['additionalnote'], $_GET['additional']);
			echo checkState($_GET['state']);
			?>
			<p>
				Let me know if anything changes so we can keep you on track.
			</p>
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
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="pmtAmt">
								Payment Amount:
							</label>
							<input class="form-control" type="number" step="0.01" name="pmtAmt" required/>
						</div>
						<div class="form-group">
							<label for="pmtdate">
								Payment Date:
							</label>
							<input class="form-control" type="date" name="pmtdate" required/>
						</div>
					</div>
				</div>
				<div>
					<?php 
					nxtpmtcheck();
					?>
				</div>
				<button type="submit" name="set" class="btn btn-success" value="on" colspan="3">
					Generate Email
				</button>
			</form>
			<?php
		}
		?>
    </div>
</div>