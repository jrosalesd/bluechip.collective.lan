<div class="row">
	<div class="col-md-3">
		<h2>
			<?php echo $emname;?>
		</h2>
		<font color="red">
			<h5>
				<b>Template Usage: </b> Borrower asking why balance is increasing (no missed payments).
				<br>
			</h5>
		</font>
	</div>
	<div class="col-md-9" style="border-left: solid;">
		<?php
		if($_GET['set'] == "on"){
			//variables to complete template
			$brwName = trim($_GET['brwName']);
			$balance = htmlspecialchars($_GET['balance']);
			$loanamt = htmlspecialchars($_GET['loanamt']);			
			$loanduration = htmlspecialchars($_GET['loanduration']);			
			$pmtfreq = htmlspecialchars($_GET['pmtfreq']);
			
			//next payment
			$pmtnote = htmlspecialchars($_GET['pmtnote']);
			$nextpmtdate = date_create(htmlspecialchars($_GET['nextpmtdate']));
			$nextpmtamt = htmlspecialchars($_GET['nextpmtamt'])
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
	                <div class="col-lg-4">
	                	<button id="copy-init" class="btn btn-primary" onclick="copyFollowUp('email-body',this.value)" value="email">Copy Email</button>
	                </div>
	                <div class="col-lg-4"></div>
	                <div class="col-lg-4"></div>
                </div>
            <hr>
            <div id="email-body">
                <!-- Email Temaplate -->
	
			<?php echo brwname($_GET['brwName'],$_GET['sup-correction']);?>
		    
		    <p>
				Thank you for contacting Spotloan. We have received <?php echo $_GET['cortype'];?> from you and would be happy to explain.
				
				</p>
				<p>

				Upon review of your account, our records show that you agreed to a $<?php echo number_format($loanamt,2,".",",");?> loan over a <?php echo $loanduration;?> month duration. Your payments are scheduled on a <?php echo $pmtfreq;?> payment basis. 
				</p>
				
				<p>

				Your current balance is $<?php echo number_format($balance,2,".",",");?>. <?php NxtPmt($nextpmtdate, $nextpmtamt, $pmtnote,1);?> 
				</p>
				<p>
				Interest begins to accrue the day the funds are received and ends the day the loan is paid off. Keep in mind, your first few payments are the most crucial. You can save on interest by choosing to pay your loan off early (there are no prepayment penalties) or by making larger payments. 
				</p>
				<p>
					Please let us know if there is anything else that we can assist you with.
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
							<label for="cortype">
								Missed Payment Date:
							</label>
							<select class="form-control" name="cortype" required>
								<option value=''>Choose One</option>
								<option value='a fax'>Fax</option>
								<option value='a letter'>Letter</option>
								<option value='an email'>Fax</option>
							</select>
						</div>
						<div class="form-group">
							<label for="loanamt">
								Loan Amount:
							</label>
							<select class="form-control" name="loanamt" required>
								<option value=''>Original Loan Amount:</option>
								<?php
									for($x=300; $x<=1500;$x+=100){
										echo "<option value='$x'>$$x.00</option>";
									}
								?>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="loanduration">
								Loan Duration:
							</label>
							<select class="form-control" name="loanduration" required>
								<option value=''>Choose Duration</option>
								<?php
									for($x=3; $x<=10;$x++){
										echo "<option value='$x'>$$x Month(s)</option>";
									}
								?>
							</select>
						</div>
						<div class="form-group">
							<label for="pmtfreq">
								Payment Frequency:
							</label>
							<select class="form-control" name="pmtfreq" required>
								<option value=''>Choose Frequency</option>
								<option value='bi-weekly'>Bi-Weekly</option>
								<option value='semi-monthly'>Semi-Monthly</option>
								<option value='monthly'>Monthly</option>
							</select>
						</div>
                        <div class="form-group">
                            <label for="balance">
                                Current Balance:
                            </label>
                            <input class="form-control" type="number" step="0.01" name="balance" required/>
                        </div>
					</div>
				</div>
				<?php
			nxtpmtcheck();
	            ?>
				<button type="submit" name="set" class="btn btn-success" value="on" colspan="2">
					Generate Email
				</button>
			</form>
			<?php
		}
		?>
	</div>
</div>