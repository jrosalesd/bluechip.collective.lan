<div class="row">
	<div class="col-md-3">
		<h2>
			<?php echo $emname;?>
		</h2>
		<font color="red">
			<h5>
				<b>Template Usage: </b> A customer is emailing wondering why their first payment was missed.
				<br>
			</h5>
		</font>
	</div>
	<div class="col-md-9" style="border-left: solid;">
		<?php
		if($_GET['set'] == "on"){
			//variables to complete template
			$brwName = trim($_GET['brwName']);
			$nextpmtdate = date_create(htmlspecialchars($_GET['nxtpmt']));
			
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
			<div id="copy_notify"></div>
			<div class="row">
	                <div class="col-lg-4">
	                	<button id="copy-init" class="btn btn-primary" onclick="copyFollowUp('email-body',this.value)" value="email">Copy Email</button>
	                </div>
	                <div class="col-lg-4"></div>
	                <div class="col-lg-4"></div>
                </div>
            <hr>
            <div id="email-body">
                <!-- Email Temaplate -->
	
			<?php echo brwname($_GET['brwName'],$_GET['sup-correction']);?>
		    
		    <p>
				According to our records, you did not sign up for Spotloan’s AutoPay. Did you know that customers who take advantage of AutoPay are more likely to pay off their loan and be eligible for auto-approval and lower interest rates on future loans?
			</p>
			
			<p>
				The transition is seamless! If you’d like us to set up AutoPay on your account, simply respond to this email with “Set up autopay,” and a Spotloan member will set up this feature for you and help you get back on track so that the next time your payment is due, it will be a hassle-free experience!
			</p>
			<p>
				Your next payment is due <?php echo date_format($nextpmtdate,"l, F jS");?>.
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
					<div class="col-md-4">
						<div class="form-group">
							<label for="nxtpmt">
								Next Payment Date:
							</label>
							<input type="date" class="form-control" name="nxtpmt" required>
						</div>
					</div>
				</div>
				<?php
	            supCorr();
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