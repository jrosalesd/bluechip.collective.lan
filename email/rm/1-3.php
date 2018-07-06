<div class="row">
    <div class="col-md-3">
        <h2>
			Payment Arrangement Email<small> (Check, Money Order)</small>
		</h2>
		<font color="red">
			<h5>
				<b>Generate: </b>When a customer contacts an agent to change an existing payment. Check and money order  are lumped together because we need to let the customer know the mailing address and that we need extra time to process. 
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
			$nextpmtdate = date_create($_GET['nextpmtdate']);
			$nextpmtamt = $_GET['nextpmtamt'];
			$pmtmethod = $_GET['pmtmethod'];
			$loanid = $_GET['loanid'];
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
				<strong>Subject:</strong> Snail mail alert! How to send your new payment of $<?php echo number_format($nextpmtamt,2,".",",");?> due on <?php echo date_format($nextpmtdate,"l, F jS");?>
			</p>
			<br>
			
		<p>
		    	Hi <?php echo ucfirst($brwName);?>,
		    </p>
		    <br>
		    
		    
			
			<p>
				Now that your new payment is set up, the hard part’s behind you. Just send your <?php echo $pmtmethod;?> of $<?php echo number_format($nextpmtamt,2,".",",");?> to:
			</p>
			<?php
            if($dbrow > 0)
            {
                while ($dbrow=mysqli_fetch_array($dbinit)) 
                {
                   ?>
                   <div style="margin-left: 25px;">
                   		<p>
                   			Spotloan
                            <br><?php echo $dbrow['address1'];
                            if(!empty($dbrow['address2']))
                            {
                                 ?><br><?php echo $dbrow['address2'];
                            }
                            ?>
                            <br><?php echo $dbrow['city'].", ".$dbrow['state']." ".$dbrow['zipcode'];?>
                       		<br>Attention to: <?php echo $loanid;?>
                   		</p>
                   </div>
                   <br />
                   <?php
                }
            }
            ?>
			<p>
				As we discussed, this payment is due on <?php echo date_format($nextpmtdate,"l, F jS");?>, so please allow enough time for your payment to be received and then give us 5 days to process it.
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
			<p>
				Let me know right away if anything changes so we can keep you on track.
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
							<label for="nextpmtdate">
								Next Payment Date:
							</label>
							<input class="form-control" type="date" name="nextpmtdate" required/>
						</div>
						<div class="form-group">
							<label for="nextpmtamt">
								Next Payment Amount
							</label>
							<input class="form-control" type="number" step="0.01" name="nextpmtamt" required/>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="$pmtmethod">
								Payment Method
							</label>
							<select class="form-control" name="pmtmethod" required>
								<option value=""></option>
								<option value="Money Order">Money Order</option>
								<option value="Check">Check</option>
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