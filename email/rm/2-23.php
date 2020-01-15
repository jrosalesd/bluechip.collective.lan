<div class="row">
	<div class="col-md-3">
		<h2>
			<?php echo $emname;?>
		</h2>
		<font color="red">
			<h5>
				<b>Template Usage: </b>Use this template when a borrower tells us they are filing for bankruptcy. 
				<br>
			</h5>
		</font>
	</div>
	<div class="col-md-9" style="border-left: solid;">
		<?php
		if($_GET['set'] == "on"){
			//variables to complete template
			//$status = false;
			//next payment
			$pmtnote = htmlspecialchars($_GET['pmtnote']);
			$nextpmtdate = date_create(htmlspecialchars($_GET['nextpmtdate']));
			$nextpmtamt = htmlspecialchars($_GET['nextpmtamt']);
			$balance = htmlspecialchars($_GET['Balance']);
			$notification = htmlspecialchars($_GET['notification_type']);
			$loanid	= htmlspecialchars($_GET['loanid'])

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

			<p>Thank you for contacting Spotloan.</p>
		    
		    <p>We have received notification that you have recently <?php echo $notification;?>. Because we’ve received this notification, Spotloan has turned off your
automatic debit to ensure no future payments will be drafted from your account.</p>
		    <p>As of today, you have a current balance of $<?php echo number_format($balance,2,".",","); ?> and your Spotloan loan ID is <?php echo $loanid;?>.
Please provide this information to the company you are working with for reference as needed.</p>

		    
			<?php NxtPmt($nextpmtdate, $nextpmtamt, $pmtnote);?>
			
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
						<div class="form-group">
                            <label for="Balance">
                                Payoff Balance:
                            </label>
                            <input class="form-control" type="number" step="0.01" name="Balance" required/>
                        </div>						
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="notification_type">Type of Notification</label>
							<select name="notification_type" id="notification_type" class="form-control">
								<option value="">Select One</option>
								<option value="filed for bankruptcy">Bankruptcy</option>
								<option value="opted to work with a Debt
Consolidation Company">DebtConsolidation</option>
							</select>
						</div>
						<div class="form-group">
							<label for="loanid">
								Loan ID:
							</label>
							<input class="form-control" type="text" name="loanid" id="loanid" required/>
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