<div class="row">
    <div class="col-md-3">
        <h2>
			Payment Options Email
		</h2>
		<font color="red">
			<h5>
				<b>Generate: </b>When a customer declines to make ACH payments after thinking about it and wants to pay another way.
				<br>
				<b>Usage: </b>RM/FR should use this email when the borrower calls in to revoke autorization of automatic withdrawals.
			</h5>
		</font>
    </div>
    <div class="col-md-9" id="embody" style="border-left: solid;">
        <?php
		if($_GET['set'] == "on"){
			//variables to complete template
			$brwName = htmlspecialchars(trim($_GET['brwName']));
			$loanid	= htmlspecialchars($_GET['loanid']);
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
			<p><strong>Subject:</strong> Your payments, your way</p>
			<br>
			
		<p>
		    	Hi <?php echo ucfirst($brwName);?>,
		    </p>
		    <br>
			
			<p>I’ve updated your account records to show that you have declined automatic payments from your bank account.</p>
			<p>You can also mail Checks or Money Order to:</p>
			<?php
            if($dbrow > 0)
            {
                while ($dbrow=mysqli_fetch_array($dbinit)) 
                {
                   ?>
                   <div style="margin-left: 25px;">
                   		<p>
                   			Spotloan
                            <br><?php echo $dbrow['address1'];
                            if(!empty($dbrow['address2']))
                            {
                                 ?><br><?php echo $dbrow['address2'];
                            }
                            ?>
                            <br><?php echo $dbrow['city'].", ".$dbrow['state']." ".$dbrow['zipcode'];?>
                       		<br>Attention to: <?php echo $loanid;?>
                   		</p>
                   </div>
                   <br />
                   <?php
                }
            }
            ?>
			<p>
				Please make sure to include your Loan ID in the memo section your Check or Money Order. Your Loan ID is <?php echo "<b>".$loanid."</b>"?>
			</p>
			<?php
                NxtPmt($nextpmtdate, $nextpmtamt, $pmtnote);
			?>
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
						<div class="form-group">
							<label for="loanid">
								Borrower´s Loan ID:
							</label>
							<input class="form-control" type="text" placeholder="Enter Loan ID" name="loanid" required/>
						</div>
					</div>
					<div class="col-md-4"></div>
					<div class="col-md-4"></div>
				</div>
				<?php
				nxtpendingcheck();
				?>
				<button type="submit" name="set" class="btn btn-success" value="on" colspan="3">
					Generate Email
				</button>
			</form>
			<?php
		}
		?>
    </div>
</div>