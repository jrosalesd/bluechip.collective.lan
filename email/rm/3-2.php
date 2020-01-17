    <div class="row">
        <div class="col-md-3">
            <h2>
				Deposit Information Email 2 
				<br>
				<small>(Funds sent to bank - still having issues/probably wrong account)</small>
			</h2>
			<font color="red">
				<h5>
					<b>Generate: </b>When a customer emails or calls the RM and says the funds have been deposited into the wrong account OR that they want to change the bank account where the funds were deposited.
					<br>
					<b>Action: </b>Manual - Agent to edit and send
				</h5>
			</font>
        </div>
        <div class="col-md-9" id="embody" style="border-left: solid;">
            <?php
			if($_GET['set'] == "on"){
				//variables to complete template
				$brwName = htmlspecialchars(trim($_GET['brwName']));
				
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
				<p><strong>Subject:</strong> Your Spotloan deposit</p>
				<br>
			<p>
			    	Hi <?php echo ucfirst($brwName);?>,
			    </p>
			    <br>
			    
			    <p>Thanks for contacting me about your Spotloan deposit. Our deposits almost always go through. When they don’t, it usually means the banking information is wrong.</p>

			    <p>Here’s what we need to do to get this deposit to you as quickly as possible:</p>
			    
			    <div style="margin-left: 40px;">     
			      <p>1) Wait – It takes 5-7 business days to confirm the money has been returned to Spotloan.</p>
			      <p>2)Touch Base – I’ll follow up with you as soon as we receive it.</p>
			      <p>3) Re-apply – You’ll need to apply with your new account information. Keep in mind this doesn’t mean you’ll be automatically approved for another loan.</p>
			      <p>4) Money! – If approved, the funds can be in your account within the next business day.</p>    
			    </div>
			    <p>You can speed up this process by contacting your bank and asking them to return the funds.</p>
				
			    
				<?php
				include('includes/signature.inc.php');
				?>
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
						<div class="col-md-4"></div>
						<div class="col-md-4"></div>
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
</div>