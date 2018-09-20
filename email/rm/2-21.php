<div class="row">
	<div class="col-md-3">
		<h2>
			<?php echo $emname;?>
		</h2>
		<font color="red">
			<h5>
				<b>Template Usage: </b>Use this template when you have changed a customer’s bank account information upon their request.
				<br>
			</h5>
		</font>
	</div>
	<div class="col-md-9" style="border-left: solid;">
		<?php
		if($_GET['set'] == "on"){
			//variables to complete template
			//$status = false;
			//next payment
			$pmtnote = htmlspecialchars($_GET['pmtnote']);
			$nextpmtdate = date_create(htmlspecialchars($_GET['nextpmtdate']));
			$nextpmtamt = htmlspecialchars($_GET['nextpmtamt']);
			//Banking information
			$bankname = htmlspecialchars($_GET['bankname']);
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

			<?php echo brwname($_GET['brwName']);?>
		    
		    <p>We have updated our records to reflect your current bank account information.</p>
		    
		    <p>As a friendly reminder, your next payment of <?php echo nextpayment(2,$_GET['nextpmtamt']);?> is due on <?php echo nextpayment(1,$_GET['nextpmtdate']);?>, and will be debited from your new <?php echo $bankname;?> account ending in <?php echo $lastfour;?>.</p>
			
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
						<div>
							<h3>Banking information</h3>
							<small>New Banking information submitted for the borrower's account</small>
						</div>
                        <div class="form-group">
                            <label for="bankname">
                                Bank Name:
                            </label>
                            <input class="form-control" type="text" name="bankname" required/>
                        </div>
                        <div class="form-group">
                            <label for="lastfour">
                                Last 4 Bank Account:
                            </label>
                            <input class="form-control" type="text" maxlength="4"  name="lastfour" required/>
                        </div>
                    </div>
                    <div class="col-md-4">
                    	<div>
							<h3>Next Payment</h3>
							<small>The next payment that will come out from new bank account.</small>
						</div>
                    	<?php echo nextpayment();?>
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