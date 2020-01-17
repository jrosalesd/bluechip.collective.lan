<div class="row">
    <div class="col-md-3">
        <h2>
			<?php echo $emname;?>
		</h2>
		<font color="red">
			<h5>
				<b>Template Usage: </b>Use this template when a borrower requests to pay off their loan.
				<br>
			</h5>
		</font>
    </div>
    <div class="col-md-9" id="embody" style="border-left: solid;">
        <?php
		if($_GET['set'] == "on"){
			//variables to complete template
			$brwName = htmlspecialchars(trim($_GET['brwName']));
			$payoffdate = date_create($_GET['payoffdate']);
			$payoffamt = $_GET['payoffam'];
			$nextpmtdate = date_create($_GET['nextpmtdate']);
			$nextpmtamt = $_GET['nextpmtamt'];
			//pending pmt var
			$pmtAmt = htmlspecialchars($_GET['pennextpmtamt']);
			$pmtdate = date_create($_GET['datepending']);
			
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
                    <div class="col-lg-4"><button id="copy-init" class="btn btn-primary" onclick="copyFollowUp('email-body',this.value)" value="email">Copy Email</button></div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4"></div>
                </div>
            <hr>
            <div id="email-body">
                <!-- Email Temaplate -->
			
			

			<?php echo brwname($_GET['brwName'],$_GET['sup-correction']);?>
		    
			<p>
				To pay off your loan, you will need to contact us two business days in advance.
			</p>
			<p>
				Your account balance for <?php echo date_format($payoffdate,"l, F jS"); ?> is $<?php echo number_format($payoffamt,2,".",","); ?> and your next payment of $<?php echo number_format($nextpmtamt,2,".",","); ?> is due on <?php echo date_format($nextpmtdate,"l, F jS"); ?>.
			</p>
			<?php echo pendingpayment(3, $_GET['pendingclick'], $_GET['pennextpmtamt'], $_GET['datepending']);?>
			
			<?php echo checkState($_GET['state']);?>
		    
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
						<?php
                        statedrop();
                        ?>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="payoffdate">
								Potencial Payoff Date:	
							</label>
							<input class="form-control" type="date" name="payoffdate" required/>
						</div>
						<div class="form-group">
							<label for="payoffam">
								Potencial Payoff Amount:
							</label>
							<input class="form-control" type="number" step="0.01" name="payoffam" required/>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="nextpmtdate">
								Next Payment Date:
							</label>
							<input class="form-control" type="date" name="nextpmtdate" required/>
						</div>
						<div class="form-group">
							<label for="nextpmtamt">
								Next Payment Amount:
							</label>
							<input class="form-control" type="number" step="0.01" name="nextpmtamt" required/>
						</div>
					</div>
				</div>
				<div>
                    <?php pendingpayment(0);?>
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