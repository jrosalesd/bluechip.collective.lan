<div class="row">
	<div class="col-md-3">
		<h2>
			<?php echo $emname;?>
		</h2>
		<font color="red">
			<h5>
				<b>Template Usage: </b>When a customer request ACH to be turned on.
				<br>
			</h5>
		</font>
	</div>
	<div class="col-md-9" style="border-left: solid;">
		<?php
		if($_GET['set'] == "on"){
			//variables to complete template
			$lastfour = htmlspecialchars($_GET['lastfour']);
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
		    
		    <p>Thank you for contacting Spotloan. Per your request, the automatic debit option for your upcoming payments has been activated using your bank account that is now on file, ending in <?php echo $lastfour;?>.</p>
		    
		    <p>If you have any additional questions or concerns, please don’t hesitate to contact us. </p>
		    
		    <?php NxtPmt($nextpmtdate, $nextpmtamt, $pmtnote);?>
		    
			<?php
            echo pendingpmt($pmtdate, $pmtAmt, $s, 0, 0);
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
						<div class="form-group">
                            <label for="lastfour">
                                Last 4 Bank Account:
                            </label>
                            <input class="form-control" type="text" maxlength="4"  name="lastfour" required/>
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