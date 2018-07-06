<div class="row">
    <div class="col-md-3">
        <h2>
			Pay-Off Request<small> (Customer Inquiry)</small>
		</h2>
		<font color="red">
			<h5>
				<b>Generate: </b>Copy and Paste 
				<br>
				<b>Template: </b>When someone contacts  RM requesting Payoff amount.
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
			$payoffdate = date_create($_GET['payoffdate']);
			$payoffamt = $_GET['payoffam'];
			$nextpmtdate = date_create($_GET['nextpmtdate']);
			$nextpmtamt = $_GET['nextpmtamt'];
			//pending pmt var
			$pmtAmt = htmlspecialchars($_GET['pennextpmtamt']);
			$pmtdate = date_create($_GET['datepending']);
			
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
			<div>
			<!-- Email Temaplate -->
			<p>
				<strong>Subject:</strong> This Would be your payoff as of <?php echo date_format($payoffdate,"l, F jS"); ?>
			</p>
			<br>
			
		<p>
		    	Hi <?php echo ucfirst($brwName);?>,
		    </p>
		    <br>
		    
			<p>
				To pay off your account you will need to call us two business days in advance to set up the payoff. When you pay off your account through ACH, you will need to wait 5-7 business days from the day the payment is processed to reapply.
			</p>
			<p>
				Your account payoff balance for <?php echo date_format($payoffdate,"l, F jS"); ?> is $<?php echo number_format($payoffamt,2,".",","); ?> and your next payment of $<?php echo number_format($nextpmtamt,2,".",","); ?> is due on <?php echo date_format($nextpmtdate,"l, F jS"); ?>. Remember, your account balance changes daily to reflect interest.
			</p>
			<?php
			if(isset($_GET['pendingclick'])){
				?>
				<p>
					Keep in mind, this payoff is valid as long as your pending payment from <?php echo date_format($pmtdate,"l, F jS");?>, in the amount of $<?php echo number_format($pmtAmt,2,".",",");?> clears your bank account successfully.
				</p>
				<?php
			}
			if ($state_status == "No"){
				?>
				<p>
					<?php echo $state_note;?>
				</p>
				<?php
			}
			?>
		    <br>
		    
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
							<label for="state">
								Borrower's State:
							</label>
							<select class="form-control"  name="state" required>
								<option value="">Select</option>
								<?php
								if($rows > 0){
									while($row = mysqli_fetch_array($state_q)){
										?>
										<option value="<?php echo $row['id']?>" <?php if($_GET['state'] == $row['id']){echo "selected";}?>><?php echo $row['state_name']?></option>
										<?php
									}
								}
								?>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="payoffdate">
								Potencial Payoff Date:	
							</label>
							<input class="form-control" type="date" name="payoffdate" required/>
						</div>
						<div class="form-group">
							<label for="payoffam">
								Potencial Payoff Amount:
							</label>
							<input class="form-control" type="number" step="0.01" name="payoffam" required/>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="nextpmtdate">
								Next Payment Date:
							</label>
							<input class="form-control" type="date" name="nextpmtdate" required/>
						</div>
						<div class="form-group">
							<label for="nextpmtamt">
								Next Payment Amount:
							</label>
							<input class="form-control" type="number" step="0.01" name="nextpmtamt" required/>
						</div>
					</div>
				</div>
				<div>
                    <div>
                        <div class="checkbox">
                            <label for="pendingclick">
                                <input type="checkbox"  id="pendingclick" name="pendingclick" onclick="pendingpmt()"/><b>Is there any PENDING PAYMENTS?</b>
                            </label>
                        </div>
                    </div>
                    <div>
                        <div class="col-md-6">
                            <g id="pendingForm"></g>
                        </div>
                    </div>
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