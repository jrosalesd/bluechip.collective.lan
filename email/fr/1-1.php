<div class="row">
<div class="col-md-3">
	<h2>
		Settlement Offer Email
	</h2>
	<font color="red">
		<h5>
			<b>Generate: </b>(For when we can’t call someone, but we can send them an email) 
			<br>
			<b>Template: </b> Spotloan email with logo
			<br>
			<b>Action: </b>Manual - RM/FR to edit and send
			<br>
			<br>
			<b>Description: </b>Use this template to provide settlement options to borrowers.
		</h5>
	</font>
</div>
<div class="col-md-9" style="border-left: solid;">
	<?php
	if($_GET['set'] == "on"){
		//variables to complete template
		$brwName = trim($_GET['brwName']);
		$balance = $_GET['balance'];
		$optOne = $_GET['optOne'];
		$optOneDeadLine = date_format(date_create($_GET['optOneDeadLine']),"F jS, Y");
		$optOneSave= $balance - $optOne;
		$optTwo = $_GET['optTwo'];
		$optTwocount = $_GET['optTwocount'];
		$optTwoFreq = $_GET['optTwoFreq'];
		$optTwoAmt = $optTwo/$optTwocount;
		$optTwoSave= $balance - $optTwo;
		$dueDate = date_format(date_create($_GET['dueDate']),"F jS, Y");
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
			Special Spotloan offer for you
		</p>
		<br>
		
	<p>
	    	Hi <?php echo ucfirst($brwName);?>,
	    </p>
	    <br>
	    
		
		<p>
			Great news – You’re eligible for a settlement with Spotloan! I’ve taken a look at your account and right now you have an outstanding balance of $<?php echo number_format($balance,2,".",",");?> However, we are willing to settle your account in full if you pay a portion of the remaining balance.
		</p>
		<p>Here are two options:</p>
		<div style="margin-left: 25px;">
			<p>
				1) Pay $<?php echo number_format($optOne,2,".",",");?> all at once as a lump sum payment. This saves you $<?php echo number_format($optOneSave,2,".",",");?> and is your best option. If you want to do this, make sure that we receive the funds no later than <?php echo $optOneDeadLine;?>.
			</p>
			<p>
				2) Pay $<?php echo number_format($optTwo,2,".",",");?> as <?php echo $optTwocount." ".$optTwoFreq;?> payments of $<?php echo number_format($optTwoAmt,2,".",",");?>. This still saves you money – $<?php echo number_format($optTwoSave,2,".",",");?> – but not as much as Option 1.
			</p>
		</div>
		<p>
			Either way, I need to know if you would like to accept this offer by <?php echo $dueDate;?>. Please call me at 1(888) 681-6811. I’m here to help so let’s work together to settle this debt.
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
					<h3>General</h3>
					<div class="form-group">
						<label for="brwName">a
							Borrower´s First Name:
						</label>
						<input class="form-control" type="text" placeholder="i. e. David" name="brwName" required/>
					</div>
					
					<div class="form-group">
						<label for="balance">
							Current Balance:
						</label>
						<input class="form-control" type="number" step="0.01" name="balance" id="balance" onchange="optionOne(); offer()"  required/>
					</div>
					<div class="form-group">
					<label for="dueDate" title="Last Date for Borrower to take this option">
						Response Due Date:
					</label>
					<input span="3" class="form-control" type="date"  name="dueDate" required/>
				</div>
				</div>
				<div class="col-md-4">
					<h3>Option One</h3>
					<div class="form-group">
						<label for="percent">
							Discount%:
						</label>
						<input class="form-control" type="number" step="1" name="percent" id="percent" value="20" onchange="optionOne()" required/>
					</div>
					<div class="form-group">
						<label for="optOne">
							Lump Sum Amount:
						</label>
						<input class="form-control" type="number" step="0.01" name="optOne" id="optOne" required/>
					</div>
					<div class="form-group">
						<label for="optOneDeadLine" title="Date payment should be received by Spotloan">
							Option 1 Payment due Date:
						</label>
						<input class="form-control" type="date"  name="optOneDeadLine" required/>
					</div>
				</div>
				<div class="col-md-4">
					<h3>Option Two</h3>
					<div class="form-group">
						<label for="percent">
							Discount %:
						</label>
						<input class="form-control" type="number" step="1" name="percent2" id="percent2" value="10" onchange="offer()"required/>
					</div>
					<div class="form-group">
						<label for="optTwo">
							Settlement Offer Amount:
						</label>
						<input class="form-control" type="number" step="0.01" name="optTwo" id="optTwo" required/>
					</div>
					<div class="form-group">
						<label for="optTwocount">
							Number Of payments:
						</label>
						<input class="form-control" type="number"  name="optTwocount" required/>
					</div>
					<div class="form-group">
						<label for="optTwoFreq">
							Payment Frequency:
						</label>
						<select class="form-control"  name="optTwoFreq" required>
							<option value=""></option>
							<option value="bi-weekly">Bi-Weekly</option>
							<option value="semi-monthly">Semi-Monthly</option>
							<option value="monthly">Monthly</option>
						</select>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<button type="submit" name="set" class="btn btn-success" value="on">
					Generate Email
					</button>
				</div>
				<div class="col-md-6">
					<button type="reset" class="btn btn-warning">
					<span class="glyphicon glyphicon-refresh"></span>
					Reset
					</button>
				</div>
			</div>
		</form>
		<?php
	}
	?>
</div>
</div>