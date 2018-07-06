<div class="row">
    <div class="col-md-3">
        <h2>
			Date of Next Payment Email
		</h2>
		<font color="red">
			<h5>
				<b>Generate: </b>When a customer contacts an agent to ask when the next payment is. “By clicking here” is a tokenized account information.
				<br>
				<b>Template: </b>
				<br>
				<b>Action: </b>Manual - Agent to edit and send
			</h5>
		</font>
    </div>
    <div class="col-md-9" id="embody" style="border-left: solid;">
        <?php
		if($_GET['set'] == "on"){
			//variables to complete template
			$brwName = htmlspecialchars(trim($_GET['brwName']));
			$pmtAmt = $_GET['pmtAmt'];
			$pmtdate = date_create($_GET['pmtdate']);
			$bankname = $_GET['bankname'];
			$lastfour = $_GET['lastfour'];
			
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
				<strong>Subject:</strong> Your next Spotloan payment
			</p>
			<br>
			
		<p>
		    	Hi <?php echo ucfirst($brwName);?>,
		    </p>
		    <br>
		    
		    
			<p>
				Thanks for contacting me. 
				<br>Your next payment of $<?php echo number_format($pmtAmt,2,".",","); ?> is due on <?php echo date_format($pmtdate,"l, F jS"); ?> and will be pulled from your <?php echo $bankname;?> account ending on <?php echo $lastfour;?>. Please call or email me at least 2 business days before your next payment is due if you need to make any changes.
			</p>
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
						
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="pmtdate">
								Payment Date:
							</label>
							<input class="form-control" type="date" name="pmtdate" required/>
						</div>
						<div class="form-group">
							<label for="pmtAmt">
								Payment Amount:
							</label>
							<input class="form-control" type="number" step="0.01" name="pmtAmt" required/>
						</div>
					</div>
					<div class="col-md-4">
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
				</div>
				<button type="submit" name="set" class="btn btn-success" value="on" colspan="3">
					Generate Email
				</button>
			</form>
			<?php
		}
		?>
    </div>
</div>
