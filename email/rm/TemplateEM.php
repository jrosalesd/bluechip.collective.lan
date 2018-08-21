<div class="row">
	<div class="col-md-3">
		<h2>
			<?php echo $emname;?>
		</h2>
		<font color="red">
			<h5>
				<b>Generate: </b> use when The borrower requests to revoke ACH but there is a pending payment that cannot be stopped due to the TWO BUSINESS DAY NOTICE rule. 
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
			$nxtpmtdate = date_create($_GET['nxtpmtdate']);
			$nxtpmtamt = htmlspecialchars($_GET['nxtpmtamt']);
			$loanid=
			
			//next payment
			$pmtnote = htmlspecialchars($_GET['pmtnote']);
			$nextpmtdate = date_create(htmlspecialchars($_GET['nextpmtdate']));
			$nextpmtamt = htmlspecialchars($_GET['nextpmtamt']);
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
		    
		    <p>We understand that you have revoked your consent to ACH withdrawals. Spotloan requires a minimum of two business days’ notice to stop your automatic debits. Therefore, we were unable to stop the payment scheduled for <?php echo date_format($pmtdate,"l, F jS, Y");?>. We sincerely apologize for any inconvenience this may cause. We have noted the revocation of consent in your file and we will not automatically debit your account again.</p>
		    <p>Interest will continue to accrue on your account as is the normal practice. Your next payment of $<?php echo number_format($nxtpmtamt,2,".",","); ?> is due on <?php echo date_format($nxtpmtdate,"l, F jS, Y");?>.</p>
		   	<p>Since you have opted to no longer permit ACH withdrawals, you send us a money order payment, please mail it to our mail processor at:</p>
		    <div class="text-center">
		    	<?php
		    	echo address();
		    	?>
		    </div>
		    <p>It is important to mail in your payments early to allow time for processing. Be sure to also include your Spotloan ID (Number). </p>
		    
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
								Missed Payment Date:
							</label>
							<input type="date" class="form-control" name="misspmtdate" required>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<div class="checkbox">
							<label for="pmtnote">
							    <input type="checkbox"  id="pmtnote" name="pmtnote" onclick="nextpmt()"/><b>Next Payment Notice</b>
							</label>
						</div>
						<div class="checkbox">
							<label for="additional">
								<input type="checkbox"  id="additional" name="additional" onclick="addnote()"/><b>Other Notes</b>
							</label>
						</div>
					</div>
					<div class="col-md-9">
						<div class="row">
							<div class="col-md-6">
								<g id="pmtnotebody"></g>
							</div>
							<div class="col-md-6">
								<g id="notefield"></g>
							</div>
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