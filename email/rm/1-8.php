<div class="row">
    <div class="col-md-3">
        <h2>
			Second & Subsequent Request for Deferral Email
		</h2>
		<font color="red">
			<h5>
				<b>Generate: </b>When a customer emails their RM or help@ asking for a second & subsequent payment deferral, an agent can generate this response email.
				<br>
				<b>Template: </b>
				<br>
				<b>Action: </b>
			</h5>
		</font>
    </div>
    <div class="col-md-9" id="embody" style="border-left: solid;">
        <?php
		if($_GET['set'] == "on"){
			//variables to complete template
			$brwName = htmlspecialchars(trim($_GET['brwName']));
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
			<p>
				<strong>Subject:</strong> Spot your savings! Your payment options
			</p>
			<br>
		<p>
		    	Hi <?php echo ucfirst($brwName);?>,
		    </p>
		    <br>
		    
		    
			<p>
				Thanks for working with me. As you know, making changes to your Spotloan gets expensive fast – it can extend the life of your loan and add more interest. My goal is to help you save money. Check out your options and let me know what you want to do. I’ll wait to make changes until I hear back from you
			</p>
			<p>Options:<p>
		    <div style="margin-left: 75px;">
		    	<p>
					<b>1) Pay a smaller amount</b> on <?php echo date_format($pmtdate,"l, F jS"); ?>, when your payment is due. Most customers try to make half the payment amount, That would be $<?php echo number_format(($pmtAmt/2),2,".",","); ?>.
				</p>
				
				<p>
		    		<b>2) Double up on your next payment:</b> If you are not able to make a partial payment, a double payment of $<?php echo number_format(($pmtAmt*2),2,".",","); ?> on <?php echo date_format($nextpmtdate,"l, F jS");?> would also be an option. <?php echo intWeeks($start, $end);?>
		    	</p>
				
				<p>
					<b>3) Make up your payment at a later time.</b> . Every day you accrue interest. The longer you wait the more expensive this option becomes. I’m here to work with you. Call me at 1(888) 681-6811 to set this up.
				</p>
				
				<p>
		      		<b>4) Change your payment size.</b> <?php echo restructureOffer($pmtdate, $pmtnum, $pmtfreq, $resamt, $ressdate, $ressdateEnd);?>
		      	<p>
		    </div>
		
		    <p>Please get back to me right away. I need at least <b><u>2 business days</u></b> before your payment is due to make these changes.</p>
		    
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
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="pmtdate">
							Next Payment Date:
							</label>
							<input class="form-control" type="date" name="pmtdate" required/>
						</div>
						<div class="form-group">
							<label for="nextpmtdate">
							Following Payment Date:
							</label>
							<input class="form-control" type="date" name="nextpmtdate" required/>
						</div>
						<div class="form-group">
							<label for="pmtAmt">
							Regular Payment Amount:
							</label>
							<input class="form-control" type="number" step="0.01" name="pmtAmt" required/>
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
								<option value="Semi-Monthly">Semi-Monthly</option>
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