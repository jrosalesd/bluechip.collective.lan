<div class="row">
	<div class="col-md-3">
		<h2>
			Broken Settlement Agreement Email
		</h2>
		<font color="red">
			<h5>
				<b>Generate: </b>Use this template when the borrower has missed too many payments from its settlement arrangement. 
				<br>
				<b>Action: </b>Manual - git remote set-url originFR to edit and send
			</h5>
		</font>
	</div>
	<div class="col-md-9" style="border-left: solid;">
		<?php
		if($_GET['set'] == "on"){
			//variables to complete template
			$brwName = trim($_GET['brwName']);
			$outBal =  htmlspecialchars($_GET['outbal']);
			$nextpmtdate = date_create(htmlspecialchars($_GET['nextpmtdate']));
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
			<div id="email-body">
                <!-- Email Temaplate -->
                <div class="row">
                    <div class="col-lg-4"><button id="copy-init" class="btn btn-primary" onclick="copyFollowUp('email-body',this.value)" value="email">Copy Email</button></div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4"></div>
                </div>
            <hr>
			<p>
				<strong>
					Subject:
				</strong> 
				Voided Settlement
			</p>
			
			<?php echo brwname($_GET['brwName'],$_GET['sup-correction']);?>
			
			<p>
				This is a notification that the settlement you agreed to is now null and void because you failed to make the payments as discussed. You currently owe $<?php echo number_format($outBal,2,".",",");?>. Please keep in mind that your balance changes daily to reflect the interest accrued.
			</p>
			<p>
				As a friendly reminder, your next payment is due on <?php echo date_format($nextpmtdate,"l, F jS");?>.
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
							<label for="outbal">
								Outstanding Balance:
							</label>
							<input type="number" class="form-control" name="outbal" step="0.01" required>
						</div>
						<div class="form-group">
							<label for="nextpmtdate">
								Next Payment Date:
							</label>
							<input type="date" class="form-control" name="nextpmtdate" required>
						</div>
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