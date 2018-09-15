<div class="row">
	<div class="col-md-3">
		<h2>
			<?php echo $emname;?>
		</h2>
		<font color="red">
			<h5>
				<b>Generate: </b> Use when customer request to have a payment stopped via email but we are not able to take the action in time. 
				<br>
				<b>Action: </b>Manual - RM/FR to edit and send
			</h5>
		</font>
	</div>
	<div class="col-md-9" style="border-left: solid;">
		<?php
		if($_GET['set'] == "on"){
			//variables to complete template
			$brwName = trim($_GET['brwName']);
			$pmtdate = date_create($_GET['pmtdate']);
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
			<p>
		    	Dear <?php echo ucfirst($brwName);?>,
		    </p>
		    <br>
		    
		    <p>Thank you for contacting Spotloan. </p>
		    <p>We attempted to stop your payment on <?php echo date_format($pmtdate,"l, F jS"); ?>. However, due to an overwhelming amount of emails, we were unable to honor your request in a timely manner. We apologize for any inconvenience this may cause.</p>
		    <p>Once you confirm that the payment was successful or if any fees were incurred, please provide a bank statement at your earliest convenience to resolve this matter.</p>
		    <p>Thank you in advance for your time.</p>
		    
			<?php
			NxtPmt($nextpmtdate, $nextpmtamt, $pmtnote);
			echo comment($_GET['additionalnote'], $_GET['additional']);
			echo checkState($_GET['state']);
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
						<div class="form-group">
							<label for="misspmtdate">
								Payment Date:
								<br><small>Place the date of the payment that we will not be able to stop.</small>
							</label>
							<input type="date" class="form-control" name="misspmtdate" required>
						</div>
					</div>
				</div>
				<?php
				 nxtpendingcheck();
				 ?>
				<button type="submit" name="set" class="btn btn-success" value="on" colspan="2">
					Generate Email
				</button>
			</form>
			<?php
		}
		?>
	</div>
</div>