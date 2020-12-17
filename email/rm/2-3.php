<div class="row">
	<div class="col-md-3">
		<h2>
			<?php echo $emname;?>
		</h2>
		<font color="red">
			<h5>
				<b>Template Usage: </b>Use this template when a customer requests their balance.
				<br>
			</h5>
		</font>
	</div>
	<div class="col-md-9" style="border-left: solid;">
		<?php
		if($_GET['set'] == "on"){
			//variables to complete template
			//$status = false;
			$balance = htmlspecialchars($_GET['bal']);
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
			<div id="copy_notify"></div>
			<div id="email-body">
                <!-- Email Temaplate -->
                <div class="row">
                    <div class="col-lg-4"><button id="copy-init" class="btn btn-primary" onclick="copyFollowUp('email-body',this.value)" value="email">Copy Email</button></div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4"></div>
                </div>
            <hr>
				
			<?php echo brwname($_GET['brwName'],$_GET['sup-correction'],1);?>
		    
		    <p>Thank you for contacting Spotloan. Your account balance is $<?php echo number_format($balance,2,".",",");?> and your next payment of $<?php echo number_format($nextpmtamt,2,".",",");?> is due on <?php echo date_format($nextpmtdate,"l, F jS"); ?>.</p>
			
			<?php echo pendingpayment(5, $_GET['pendingclick'], $_GET['pennextpmtamt'], $_GET['datepending']);?>	
				
		    <p>As a friendly reminder, interest accrues on a daily basis.</p>
			
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
							<label for="bal">Account's Outstanding Balance:</label>
							<input class="form-control" type="number" step="0.01" name="bal" required/>
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
						</div>
					</div>
				</div>
				<?php pendingpayment(0);?>
				<button type="submit" name="set" class="btn btn-success" value="on" colspan="2">
					Generate Email
				</button>
			</form>
			<?php
		}
		?>
	</div>
</div>