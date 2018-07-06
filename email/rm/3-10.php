<div class="row">
    <div class="col-md-3">
        <h2>
			Voided Check Process Emails
		</h2>
		<font color="red">
			<h5>
				<b>Generate: </b>Send email when borrower claims that he has not recieved Voide check email
				<br>
			</h5>
		</font>
    </div>
    <div class="col-md-9" id="embody" style="border-left: solid;">
        <?php
		if($_GET['set'] == "on"){
			//variables to complete template
			$brwName = htmlspecialchars(trim($_GET['brwName']));
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
				<strong>Subject:</strong> Your Spotloan: Additional Action Required
			</p>
		<p>
		    	Hi <?php echo ucfirst($brwName);?>,
		    </p>
		    <br>
		    
		    
			<p>
				A final review by our credit service team shows that additional documentation is needed to complete your application. Please send a voided check (colored picture) from the banking account you listed in your application and a form of photo identification (driver’s license preferred, also colored picture) to:
			</p>
			<p>
				verification@spotloan.com
			</p>
			<p>
				All pictures must be high quality and taken on a flat surface. Please make sure that the text is crisp and clear. Take a picture of front and back of check and ID.
			</p>
			<p>
				We need to receive your voided check and photo identification within 5 business days from today. It will take our credit service team 3-7 days to review your documentation and make a final decision. We will not be sharing any information from the application. If we don't receive the required documentation, we will consider your application to be denied. You can re-apply in 45 days to try to obtain a Spotloan.
			</p>
			<p>
				Thanks again for choosing Spotloan!
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
						<div class="form-group">
							<label for="brwName">
								Borrower´s First Name:
							</label>
							<input class="form-control" type="text" placeholder="i. e. David" name="brwName" required/>
						</div>
					</div>
					<div class="col-md-4"></div>
					<div class="col-md-4"></div>
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