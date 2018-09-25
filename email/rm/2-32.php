<div class="row">
	<div class="col-md-3">
		<h2>
			<?php echo $emname;?>
		</h2>
		<font color="red">
			<h5>
				<b>Template Usage: </b>Use this template when a borrower wants to cancel their loan.
				<br>
			</h5>
		</font>
	</div>
	<div class="col-md-9" style="border-left: solid;">
		<?php
		if($_GET['set'] == "on"){
			//variables to complete template
			//$status = false;
			$loanamt = htmlspecialchars($_GET['loanamt']);
			//next payment
			$pmtnote = htmlspecialchars($_GET['pmtnote']);
			$nextpmtdate = date_create(htmlspecialchars($_GET['nextpmtdate']));
			$nextpmtamt = htmlspecialchars($_GET['nextpmtamt'])
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

			<?php echo brwname($_GET['brwName'],$_GET['sup-correction']);?>
		    
		    <p>We have attempted to stop your loan deposit. Unfortunately, we were not able to. Spotloan allows three business days to pay back a loan interest-free.</p>
		    <p>Please let us know if you would like to return the <?php echo $loanamt;?> deposit. We can make arrangements to have the deposit deducted from your bank account within two business days. If the funds are not returned in this timeframe, you will be responsible for the loan and interest paybacks.</p>
		    <p>We look forward to hearing from you as soon as you can.</p>
			
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
							<label for="loanamt">
								Original Loan Amount:
							</label>
							<select class='form-control' id="loanloanamtlife" name="loanamt" required>
								<option value="">Select One</option>
								<?php
								for ($i = 300 ; $i <= 800; $i+=100) {
									 ?>
									 <option value="$<?php echo number_format($i,2,".",",");?>">
									 	$<?php echo number_format($i,2,".",",");?>
									 </option>
									 <?php
								}
								?>
							</select>
						</div>
					</div>
				</div>
				<button type="submit" name="set" class="btn btn-success" value="on" colspan="2">
					Generate Email
				</button>
			</form>
			<?php
		}
		?>
	</div>
</div>