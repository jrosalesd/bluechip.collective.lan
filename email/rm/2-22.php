<div class="row">
	<div class="col-md-3">
		<h2>
			<?php echo $emname;?>
		</h2>
		<font color="red">
			<h5>
				<b>Template Usage: </b>Use this template when a borrower wants to update their banking information via email.  
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
		    
		    <p>For security reasons, we are unable to update your banking information via email. Please call us at your earliest convenience and we would be happy to assist you. Your payment of <?php echo nextpayment(2,$_GET['nextpmtamt']);?>, due on <?php echo nextpayment(1,$_GET['nextpmtdate']);; ?>, can then be drawn from the updated bank account on file. Please have the following information available at the time of your call: </p>
		    <div class="offset50px">
		    	<ul class="p_list_disc">
		    		<li>Routing Number</li>
		    		<li>Account Number</li>
		    		<li>Type of Account (Checking or Savings)</li>
		    	</ul>
		    </div>
		    <p>Please keep in mind, we require a two-business day notice in order to make any changes on your Spotloan account.</p>
		    
			<?php NxtPmt($nextpmtdate, $nextpmtamt, $pmtnote);?>
			
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
							<h3>Next Payment</h3>
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