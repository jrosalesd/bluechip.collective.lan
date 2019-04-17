<div class="row">
	<div class="col-md-3">
		<h2>
			<?php echo $emname;?>
		</h2>
		<font color="red">
			<h5>
				<b>Generate: </b> Use this template when the borrower sent an email but it has not been handled due to the high volume on HelpDesk.
				<br>
				<b>Action: </b>Manual - RM/FR to edit and send
			</h5>
		</font>
	</div>
	<div class="col-md-9" style="border-left: solid;">
		<?php
		if($_GET['set'] == "on"){
			//variables to complete template
			$brwName = trim($_GET['brwName']);
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
                <div class="row">
                    <div class="col-lg-4"><button id="copy-init" class="btn btn-primary" onclick="copyFollowUp('email-body',this.value)" value="email">Copy Email</button></div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4"></div>
                </div>
            <hr>
			<p>
		    	Dear <?php echo ucfirst($brwName);?>,
		    </p>
		    <br>
		    
		    <p>
		    	Thank you for the email regarding your Spotloan.
		    </p>
		    <p>
		    	We have looked into your account and it does show that you emailed in enough time to stop your payment. Due to our help desk being so backed up with emails at this time the email was overlooked and we were unable to process your request.
		    </p>
		    <p>
		    	Please send us a bank statement if the payment cleared and we will get started on getting you a refund. If the payment did not clear we can refund any overdraft fees.
		    </p>
		    
			<?php
			NxtPmt($nextpmtdate, $nextpmtamt, $pmtnote);
			echo checkState($_GET['state']);
			?>
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
				</div>
				<button type="submit" name="set" class="btn btn-success" value="on" colspan="2">
					Generate Email
				</button>
			</form>
			<?php
		}
		?>
	</div>
</div>