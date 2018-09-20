<div class="row">
    <div class="col-md-3">
        <h2>
			First Request for Deferral Email
		</h2>
		<font color="red">
			<h5>
				<b>Template Usage: </b>Use this template when a borrower requests to defer their payment.
				<br>
			</h5>
		</font>
    </div>
    <div class="col-md-9" id="embody" style="border-left: solid;">
        <?php
		if($_GET['set'] == "on"){
			//variables to complete template
			$pmtAmt = $_GET['pmtAmt'];
			$pmtdate = date_create($_GET['pmtdate']);
			$nextpmtdate = date_create($_GET['nextpmtdate']);
			$pmtnum = $_GET['pmtnum'];
			$pmtfreq = $_GET['pmtfreq'];
			$resamt = $_GET['resamt'];
			$ressdate = date_create($_GET['ressdate']);
			$ressdateEnd = date_create($_GET['ressdateEnd']);
			$start = strtotime($_GET['pmtdate'])/$one_day_sec;
			$end = strtotime($_GET['nextpmtdate'])/$one_day_sec;
			
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
			
			<?php echo brwname($_GET['brwName'],2);?>
		    
		    
			
			<p>Thanks for contacting me. I’m always happy to help with payment changes.</p>

		    <p>I have the below options for you to decide which will work best for your situation. <b>I will wait to make changes until I hear back from you.</b></p>
		
		    <p>If you absolutely need to change your payment plan, please select from the following options:<p>
		
		    <div style="margin-left: 75px;">
		    	<p>1. Pay a smaller amount on <?php echo date_format($pmtdate,"l, F jS"); ?>, when your payment is due. This is your best option. </p>
		    	<p>2. Make up your payment at a later time. However, this will still cause your loan to accrue interest every day until the payment is made. The longer you wait, the more expensive this option becomes.</p>
		      	<p>
		      		3. Adjust  your payment size. If you want to miss this next payment, but don’t want your interest to get away from you, we can increase your payment amount to keep you on track.
		      		<br />This is how your adjustment payment schedule will look:
		      		<br /><?php echo restructureOffer($pmtdate, $pmtnum, $pmtfreq, $resamt, $ressdate, $ressdateEnd);?>
		      	</p>
		      		
		    </div>
		
		    <p>Please let me know right away which option above works best for you. I need at least two business days before your payment is due to make these changes. <b>I will not make any changes to your account until you confirm what you would like me to do.</b></p>
		    		    
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
							<label for="pmtdate">
							Next Payment Date:
							</label>
							<input class="form-control" type="date" name="pmtdate" required/>
						</div>
					</div>
					<div class="col-md-4">
						<h4 class="text-center">Restructure Option</h4>
						<div class="form-group">
							<label for="pmtnum">Number Of Payments</label>
							<input class="form-control" type="number" name="pmtnum" required/>
						</div>
						<div class="form-group">
							<label for="pmtfreq">
								Payment Frequency:
							</label>
							<select class="form-control" name="pmtfreq" required>
								<option value="Bi-Weekly">Bi-Weekly</option>
								<option value="Semi-Montly">Semi-Montly</option>
								<option value="Monthly">Monthly</option>
							</select>
						</div>
						<div class="form-group">
						    <label for="resamt">
						        Restructure Payment Amount:
						    </label>
						    <input class="form-control" type="number" step="0.01" name="resamt" required/>
						</div>
						<div class="form-group">
							<label for="ressdate">
							Restructure Start Date:
							</label>
							<input class="form-control" type="date" name="ressdate" required/>
						</div>
						<div class="form-group">
							<label for="ressdate">
							Restructure End Date:
							</label>
							<input class="form-control" type="date" name="ressdateEnd" required/>
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
