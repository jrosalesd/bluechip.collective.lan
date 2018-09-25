<div class="row">
	<div class="col-md-3">
		<h2>
			<?php echo $emname;?>
		</h2>
		<font color="red">
			<h5>
				<b>Template Usage: </b>Use this template when a borrower inquiring about interest accrual
				<br>
			</h5>
		</font>
	</div>
	<div class="col-md-9" style="border-left: solid;">
		<?php
		if($_GET['set'] == "on"){
			//variables to complete template
			$status = false;
			$communication = htmlspecialchars($_GET['communication']);
			$missedpmt = htmlspecialchars($_GET['missedpmt']);
			$loanlife = htmlspecialchars($_GET['loanlife']);
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
		    
		    <p>We have received <?php echo $communication;?> from you and would be happy to explain.</p>
		    <p>You missed <?php echo $missedpmt;?> payments. Interest on your loan is added daily based on the outstanding principal balance; for every day that you carry a principal balance on your loan, you are charged interest. So when you miss a payment, you end up paying more in interest charges.</p>
		    <p>This happens because you missed the opportunity to pay down a portion of your principal balance and you have to make up the payment later on. This extends your payment schedule over a longer period of time (allowing interest to accrue over a longer period of time). So even though you chose to repay your loan over <?php echo $loanlife;?> months, you end up taking longer to repay when you miss payments, which costs you more in interest.</p>
		    <p>I hope this information helps. Please let me know if you have any additional questions or concerns. </p>
			
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
							<label for="communication">
								Type of Document Recieved:
							</label>
							<select class='form-control' id="communication" name="communication" required>
								<option value="">Select One</option>
								<option value="a fax">Fax</option>
								<option value="a letter">Letter</option>
								<option value="an email">Email</option>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="missedpmt">
								Number of Missed Payments:
							</label>
							<input type="text" class='form-control' id="missedpmt" name="missedpmt" required/>
						</div>
						<div class="form-group">
							<label for="loanlife">
								Original Loan Length:
							</label>
							<select class='form-control' id="loanlife" name="loanlife" required>
								<option value="">Select One</option>
								<?php
								for ($i = 3 ; $i <= 10; $i++) {
									 ?>
									 <option value="<?php echo $i;?>"><?php echo $i;?> Months</option>
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