<div class="row">
	<div class="col-md-3">
		<h2>
			<?php echo $emname;?>
		</h2>
		<font color="red">
			<h5>
				<b>Template Usage: </b> Use this template when a customer revokes ACH in any format 
				<br>
			</h5>
		</font>
	</div>
	<div class="col-md-9" style="border-left: solid;">
		<?php
		if($_GET['set'] == "on"){
			//variables to complete template
			$loanid = htmlspecialchars($_GET['loanid']);
			//next payment
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
				<strong>
					Subject:
				</strong>
				Here goes the subject for this email
			</p>
	
			<?php echo brwname($_GET['brwName']);?>
		    
		    <p>
		    	Thank you for contacting Spotloan. We understand that you have revoked your consent to automatic debit withdrawals. We have noted your revocation and we will not attempt to automatically debit your account again.
		    </p>
		    <?php echo pendingpayment(1, $_GET['pendingclick'], $_GET['pennextpmtamt'], $_GET['datepending'])?>
		    <p>Since you have opted to no longer permit automatic debit withdrawals, you may mail a check or money order to:</p>
		    <div class="text-center">
		    	<?php echo address();?>
		    </div>
		    <p>It is important to mail in your payments early to allow adequate time for processing. Please be sure to include your Spotloan ID <?php echo $loanid;?>.</p>
		    <?php NxtPmt($nextpmtdate, $nextpmtamt, "on");?>
			<p></p>
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
							<label for="loanid">
							Loan ID:
							</label>
							<input type="text" class="form-control" name="loanid" required>
						</div>
					</div>
					<div class="col-md-4">
						<div class='form-group' id='pmtnote'>
							<label for='nextpmtdate'>
								Next Payment Date
							</label>
							<input class='form-control' type='date' id='nextpmtdate' name='nextpmtdate' required/>
						</div>
						<div class='form-group'>
							<label for='nextpmtamt'>
								Next Payment Amount
							</label>
							<input class='form-control' type='number' step='0.01' id='nextpmtamt' name='nextpmtamt' required/>
						</div>"
					</div>
				</div>
				<?php
	            pendingpayment(0);
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