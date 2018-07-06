<div class="row">
    <div class="col-md-3">
        <h2>
			Banking Information Update Request Email 
			<br>
			<small>(New account)</small>
		</h2>
		<font color="red">
			<h5>
				<b>Generate: </b>When someone contacts their RM asking if they can update their banking information.
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
			$pmtAmt = htmlspecialchars($_GET['pmtAmt']);
			$pmtdate = date_create($_GET['pmtdate']);
			
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
			<p><strong>Subject:</strong> Your payment, your way</p>
			<br>
		<p>
		    	Hi <?php echo ucfirst($brwName);?>,
		    </p>
		    <br>
		    
			
			<p>In order to update the banking information so that the payment of $<?php echo number_format($pmtAmt,2,".",","); ?> due on <?php echo date_format($pmtdate,"l, F jS"); ?>, comes from a different account. you will need to call us at 888-681-6811 and provide the following information:
			</p>
			<ol>
			    <li><p>Routing Number</li>
			    <li><p>Bank Name</li>
			    <li><p>Account Number</li>
			    <li><p>Type of account (Checking or Savings)</li>
			    </p>
		    </ol>
		    <p>Please keep in mind that we do require at least 2 business days before your payment is due in order to make any changes.</p>
		    
		    <p>Let me know as soon as possible please.</p>
			
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
                            <label for="pmtdate">
                                First Payment Date:
                            </label>
                            <input class="form-control" type="date" name="pmtdate" required/>
                        </div>
                        <div class="form-group">
                            <label for="pmtAmt">
                                First Payment Amount:
                            </label>
                            <input class="form-control" type="number" step="0.01" name="pmtAmt" required/>
                        </div>
                    </div>
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