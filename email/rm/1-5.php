<div class="row">
    <div class="col-md-3">
        <h2>
			Pay-Off Request - No Date <small> (Customer Inquiry)</small>
		</h2>
		<font color="red">
			<h5>
				<b>Generate: </b>When Borrower contacts  RM requesting Payoff amount, but does not specify the date.
				<br>
				<b>Template: </b>Manual - Agent to edit and send
			</h5>
		</font>
    </div>
    <div class="col-md-9" id="embody" style="border-left: solid;">
        <?php
		if($_GET['set'] == "on"){
			//variables to complete template
			$brwName = htmlspecialchars(trim($_GET['brwName']));
			$currbal = $_GET['currbal'];
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
					<strong>Subject:</strong> This would be your payoff as of <?php echo date_format($payoffdate,"l, F jS"); ?>
				</p>
				<br>
				
				<p>
					Hi <?php echo ucfirst($brwName);?>,
				</p>
				<br>
				
				<p>
					Thanks for contacting me. I hope you are well.
				</p>      
				
				<p>As of today, your current balance is of $<?php echo number_format($currbal,2,".",","); ?>. Remember that we need a two business day notice in order to make any changes to the payment schedule. So the next available date to schedule a payoff is for <?php echo date_format($payoffdate,"l, F jS"); ?> in the amount of $<?php echo number_format($payoffamt,2,".",","); ?>. If you wish for it to be on any other date keep in mind the amount would change because of the interest that accrues daily.</p>
				
				<p>Let me know what you decide so I can set it up in the system.</p>
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
						<?php
                        statedrop();
                        ?>
						<div class="form-group">
							<label for="currbal">
								Current Balance:
							</label>
							<input class="form-control" type="number" step="0.01" name="currbal" id="currbal" required/>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="payoffdate">
								Potential Payoff Date:
							</label>
							<input class="form-control" type="date" name="payoffdate" required/>
						</div>
						<div class="form-group">
							<label for="payoffam">
								Potential Payoff Amount:
							</label>
							<input class="form-control" type="number" step="0.01" name="payoffam" required/>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="nextpmtdate">
								Next Payment Date
							</label>
							<input class="form-control" type="date" name="nextpmtdate" required/>
						</div>
						<div class="form-group">
							<label for="nextpmtamt">
								Next  payment Amount:
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

