<div class="row">
	<div class="col-md-3">
		<h2>
			<?php echo $emname;?>
		</h2>
		<font color="red">
			<h5>
				<b>Template Usage: </b>Use this template when a borrower requests to defer a payment, but it’s within the two business day window.
				<br>
			</h5>
		</font>
	</div>
	<div class="col-md-9" style="border-left: solid;">
		<?php
		if($_GET['set'] == "on"){
			//variables to complete template
			//$status = false;
			$pmtAmt = $_GET['pmtAmt'];
			$pmtdate = date_create($_GET['pmtdate']);
			//next payment
			$pmtnote = htmlspecialchars($_GET['pmtnote']);
			$nextpmtdate = date_create(htmlspecialchars($_GET['pmtdate']));
			$nextpmtamt = htmlspecialchars($_GET['pmtAmt'])
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
		    
		    <p>As a reminder, we require a two business day notice to make changes to your payment due dates. This means that I will not be able to adjust your payment of $<?php echo number_format($pmtAmt,2,".",","); ?> that is due <?php echo date_format($nextpmtdate,"l, F jS");?>. Please call us if we can assist with any other options going forward.</p>
			
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
                        <label for="pmtdate">
                            Payment Date:
                        </label>
                        <input class="form-control" type="date" name="pmtdate" required/>
	                    </div>
	                    <div class="form-group">
	                        <label for="pmtAmt">
	                            Payment Amount:
	                        </label>
	                        <input class="form-control" type="number" step="0.01" name="pmtAmt" required/>
	                    </div>
					</div>
				</div>
				<?php supCorr();?>
				<button type="submit" name="set" class="btn btn-success" value="on" colspan="2">
					Generate Email
				</button>
			</form>
			<?php
		}
		?>
	</div>
</div>