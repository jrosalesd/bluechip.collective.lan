<div class="row">
    <div class="col-md-3">
        <h2>
			<?php echo $emname;?>
		</h2>
		<font color="red">
			<h5>
				<b>Template Usage: </b>Use this template when you are providing a discounted plan for no more than 90 days.
			</h5>
		</font>
    </div>
    <div class="col-md-9" id="embody" style="border-left: solid;">
        <?php
		if($_GET['set'] == "on"){
			//variables to complete template
			
			$pmtamt = number_format($_GET['pmtamt'],2,".",",");
			$pmtdate = date_create($_GET['pmtdate']);
			$discount = $_GET['discount'];
			
			//RESTRUCTURE RELATED VARIABLES
			$bal_with_discount = htmlspecialchars($_GET['bal_with_discount']);
			$pmt_new = htmlspecialchars($_GET['pmt_new']);
			$pmt_number_new = htmlspecialchars($_GET['pmt_number_new']);
			$pmt_freq_new = htmlspecialchars($_GET['pmt_freq_new']);
			$pmt_start_date = date_create($_GET['pmt_start_date']);
			$pmt_end_date = date_create($_GET['pmt_end_date']);
			//pending pmt var
            $pmtAmt = htmlspecialchars($_GET['pennextpmtamt']);
            $pmtdate = date_create($_GET['datepending'])
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
			<p>
				<b>Subject: </b> Your Updated Spotloan Agreement
			</p>	
			
			<?php echo brwname($_GET['brwName'],$_GET['sup-correction'],1);?>
		    
		    
			<p>Thank you for contacting Spotloan</p>
			
			<p>
				As discussed, we’ve given you a <?php echo $discount;?>% discount on your Spotloan balance and placed your account on an interest freeze.  You’re all set to make your first payment of $<?php echo $pmtamt;?> from your bank account on file. This payment will be debited on <?php echo date_format($pmtdate,"l, F jS");?>.
			</p>
				
			<p>
				Your new payment schedule is below. <b>This payment schedule supersedes and replaces any earlier payment schedule(s) provided for your loan.</b>
			</p>
				
			<div class="offset25px">
				<p>
					<b>NEW SCHEDULE:</b>
					<br>Updated Balance with discount: $<?php echo number_format($bal_with_discount,2,".",",");?>
					<br> Number of Payments: <?php echo $pmt_number_new." ";if($pmt_number_new == 1){echo "payment";}else{echo "payments";}?>
					<br>Payment Frequency: <?php echo $pmt_freq_new?>
					<br>First Payment Date: <?php echo date_format($pmt_start_date,"F jS, Y");?>
					<br>Last Payment Date: <?php echo date_format($pmt_end_date,"F jS, Y");?>
					<br>Payment Amount: $<?php echo number_format($pmt_new,2,".",",");?>
				</p>
			</div>
			<p>This is a one-time offer and in order for your account to be considered “settled in full,” the payments must process successfully.</p>
			<p>
				Please note that if any payments return for any reason, you will no longer be qualified for this discount and your loan will return to its original state. This means that this discount offered to you will be void and collection efforts will remain on your account toward your full balance with interest.
				</p>
			<p>
				Our Help Desk hours of operation are Monday - Friday from 7:00am CT - 4:30pm CT
				</p>
			<p>
				For immediate service, please feel free to call us at 1-888-681-6811, Monday - Friday 7:00am - 8:00pm CT or Saturdays 9:00am - 6:00pm CT.
				</p>
			<p>
				Sincerely,
				
				<br>
				<br>Spotloan Help Team
				<br>#SLHT
				<br>help@spotloan.com
				<br>1-888-681-6811
				<br>www.spotloan.com
			</p>
			
		    <?php //echo pendingpayment(2, $_GET['pendingclick'], $_GET['pennextpmtamt'], $_GET['datepending']);?>
		    
		    <?php
			//include('includes/signature.inc.php');
			?>	
			</div>
			<?php
		}else{
			//FORM FIELDS TO BUILD UP THE EMAIL.
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
						<p>First Payment Date/Amount</p>
						
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
	                        <input class="form-control" type="number" step="0.01" name="pmtamt" required/>
	                    </div>	
						
						<p>Discount Information</p>
						<div class="form-group">
							<label for="discount">
								Discount %
							</label>							
							<select class="form-control" name="discount" required>
								<option value="">Choose Discount</option>
								<?php
								
								for ( $x=0;$x<95; $x+=5 ){
									?>
									<option value='<?php echo $x;?>'><?php echo $x;?>% discount</option>
									<?php
								}
								?>
							</select>
						</div>
						<div class="form-group">
							<label for="bal_with_discount">
								Balance with Discount:
							</label>
							<input class="form-control" type="number" step="0.01" name="bal_with_discount" required/>
						</div>
					</div>
					
					<!--SECOND lIST OF EVENS. -->
					<div class="col-md-4">
						<p>0% Restructure Details</p>
						<div class="form-group">
							<label for="pmt_number_new">
								Number Of Payments:
							</label>
							<input class="form-control" type="text" name="pmt_number_new" required/>
						</div>
						<div class="form-group">
							<label for="pmt_freq_new">
								Payment Frequency:
							</label>
							<select class="form-control" name="pmt_freq_new" required>
								<option value="">Choose One</option>
								<option value="Semi-Monthly">Semi-Monthly</option>
								<option value="Monthly">Monthly</option>
								<option value="Bi-Weekly">Bi-Weekly</option>
							</select>
						</div>
						<div class="form-group">
							<label for="pmt_start_date">
								First Payment Date:
							</label>
							<input class="form-control" type="date" name="pmt_start_date" required/>
						</div>
						<div class="form-group">
							<label for="pmt_end_date">
								Last Payment Date:
							</label>
							<input class="form-control" type="date" name="pmt_end_date" required/>
						</div>
						<div class="form-group">
							<label for="pmt_new">
								New Payment Amount:
							</label>
							<input class="form-control" type="number" step="0.01" name="pmt_new" required/>
						</div>
					</div>
				</div>
				<?php //pendingpayment(0)?>
				<button type="submit" name="set" class="btn btn-success" value="on" colspan="3">
					Generate Email
				</button>
			</form>
			<?php
		}
		?>
    </div>
</div>