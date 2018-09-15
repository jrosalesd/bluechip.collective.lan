<div class="row">
    <div class="col-md-3">
        <h2>
			Restructure Loan Notification Email  
			<small>(RM should probably call on this one)</small>
		</h2>
		<font color="red">
			<h5>
				<b>Generate: </b>when you restructure account and need to notify customer before account restructure is updated.
				
			</h5>
		</font>
    </div>
    <div class="col-md-9" id="embody" style="border-left: solid;">
        <?php
		if($_GET['set'] == "on"){
			//variables to complete template
			$brwName = htmlspecialchars(trim($_GET['brwName']));
			
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
			<div>
			<!-- Email Temaplate -->
			<p>
				<strong>
					Subject:
				</strong> 
				Your Spotloan Change in progress.
			</p>
			<br>
		<p>
		    	Hi <?php echo ucfirst($brwName);?>,
		    </p>
		    <br>
		    
		    
			<p>I’m glad we could make adjustments so that you can stay on track with paying off your loan.</p>

		    <p>I did restructure your payment schedule as follows:</p>
		    <p>Your new schedule is now <?php echo $pmt_number_new." ".$pmt_freq_new;?> payments of $<?php echo number_format($pmt_new,2,".",","); ?>.
		    <br> Your first payment is on <?php echo date_format($pmt_start_date,"F jS, Y"); ?>, and your last payment will be on <?php echo date_format($pmt_end_date,"F jS, Y"); ?>.</p>
		    <?php
		    echo pendingpmt($pmtdate, $pmtAmt,$_GET['pendingclick'], 0, 1);
		    ?>
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
						<p>Restructure Details</p>
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
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="pmt_number_new">
								Number Of Payments:
							</label>
							<input class="form-control" type="text" name="pmt_number_new" required/>
						</div>
						<div class="form-group">
							<label for="pmt_new">
								New Payment Amount:
							</label>
							<input class="form-control" type="number" step="0.01" name="pmt_new" required/>
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
					</div>
				</div>
				<?php pendingpmt(0,0,0, 1, 1);?>
				<button type="submit" name="set" class="btn btn-success" value="on" colspan="3">
					Generate Email
				</button>
			</form>
			<?php
		}
		?>
    </div>
</div>