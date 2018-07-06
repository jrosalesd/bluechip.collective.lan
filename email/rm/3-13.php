<div class="row">
    <div class="col-md-3">
        <h2>
			Sold Account inquiry
		</h2>
		<font color="red">
			<h5>
				<b>Generate: </b>When customer request information about an account that has already been sold to a thind party Collection Agency.
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
			$LAPro =htmlspecialchars(trim($_GET['LAPro']));
			$Lid =  htmlspecialchars(trim($_GET['Lid']));
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
			<p><strong>Subject:</strong>Your Spotloan Status</p><br>
		<p>
		    	Hi <?php echo ucfirst($brwName);?>,
		    </p>
		    <br>
		    
		    
			<p>
				Thank you for your recent email regarding your loan status.
			</p>
			<?php
			
			$slq = "SELECT soldlist.Loan_ID, soldlist.Buyer, debtsalebuyers.Name, debtsalebuyers.PhoneNumber, soldlist.Sold_Date FROM soldlist, debtsalebuyers WHERE soldlist.Buyer = debtsalebuyers.Code AND soldlist.Loan_ID='$LAPro'";
			$slq_result = mysqli_query($conn, $slq);
			
			if(mysqli_num_rows($slq_result) != 0){
				$row = mysqli_fetch_array($slq_result);
				$AgencyAbr =$row[1];
				$Agency = $row[2]; 
				$phone = $row[3];
				$soldDate = date_create("$row[4]");
			}
			
			?>
			
			<p>
				In accordance with our customary practices, Spotloan sold your loan on <?php echo date_format($soldDate,"F jS, Y"); ?> to an independent third party unaffiliated with Spotloan (debt buyer) after not receiving a payment from you in over 90 days.
					<?php
					if (empty($pmtAmt)) {
						echo "We did not Received any payments on your loan";
					}else {
						echo "The last payment that we received from you was on ".date_format($pmtdate,"l, F jS")." for $".number_format($pmtAmt,2,".",",");
					}
					?>
					. Spotloan sold and transferred to the debt buyer all of our rights, title, and interest in this loan and Spotloan has not attempted to collect on this debt since the date of the sale.
			</p>
			<p>
				Below is the contact information for the debt buyer should you wish to contact them about your Spotloan.
			</p>
			
			<p>
				Please contact <b><?php echo $Agency." (".$AgencyAbr.")";?></b> at <b>1-<?php echo $phone;?></b> to further assist you. your can referance your account through the Loan ID, yours is <b><?php echo $Lid;?>.</b>
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
							<label for="Lid">
								Loan ID:
							</label>
							<input class="form-control" type="text" placeholder="425365" name="Lid"  id="Lid" required/>
						</div>
						<?php
						if (!isset($_GET['LAPro'])) {
						    ?>
						    <div class="form-group">
    							<label for="LAPro">
    								Account Number (LAPro):
    							</label>
    							<input class="form-control" type="text" placeholder="15D95F1JA0-06" name="LAPro"  id="LAPro" value="<?php echo $_GET['LAPro'];?>" required/>
    						</div>
						    <?php
						}
						?>
					</div>
					<div class="col-md-4">
                        <div class="form-group">
                            <label for="pmtdate">
                                Last Successful Payment Date:
                            </label>
                            <input class="form-control" type="date" name="pmtdate"/>
                        </div>
                        <div class="form-group">
                            <label for="pmtAmt">
                                Last Successful Payment Amount:
                            </label>
                            <input class="form-control" type="number" step="0.01" name="pmtAmt"/>
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