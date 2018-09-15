<div class="row">
    <div class="col-md-3">
        <h2>
			Payment Confirmation Email
		</h2>
		<font color="red">
			<h5>
				<b>Generate: </b>If requested by borrower.
				<br>
				<b>Action: </b> Manual - Agent to edit and send
			</h5>
		</font>
    </div>
    <div class="col-md-9" id="embody" style="border-left: solid;">
        <?php
		if($_GET['set'] == "on"){
			//variables to complete template
			$brwName = htmlspecialchars(trim($_GET['brwName']));
			$pmtAmt = htmlspecialchars($_GET['pmtAmt']);
			$pmtdate = date_create($_GET['pmtdate']);
            $bankname = nl2br(htmlspecialchars($_GET['bankname']));
            $lastfour = htmlspecialchars($_GET['lastfour']);
            $pmtconf = htmlspecialchars($_GET['pmtconf']);
            $mailpmttype = htmlspecialchars($_GET['mailtype']);
			
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
				<strong>Subject:</strong> $<?php echo number_format($pmtAmt,2,".",","); ?> Spotloan payment confirmation
			</p>
			<br>

			<?php echo brwname($_GET['brwName']);?>
		    
		    
			<p><b>Payment Receipt</b></p>
			<?php
			if($_GET['ach'] == "on"){
				?>
				<p>This is an email confirmation that you made a payment of $<?php echo number_format($pmtAmt,2,".",","); ?> on <?php echo date_format($pmtdate,"l, F jS"); ?>, from your <?php echo $bankname;?> account ending in <?php echo $lastfour;?>. Thanks!</p>
				<?php
			}elseif ($_GET['dc'] == "on") {
				?>
				<p>This is an email confirmation that you made a one time payment in the amount of $<?php echo number_format($pmtAmt,2,".",","); ?> today, <?php echo date_format($pmtdate,"F jS, Y"); ?>, with your debit card. Thanks!</p>
				
				<p>
					Your confirmation ID is: <?php echo $pmtconf;?>
				</p>
				<?php
			}elseif ($_GET['mail'] == "on") {
				?>
				<p>
					This email is to confirm that we have received your <?php echo $mailpmttype;?> in the amount of $<?php echo number_format($pmtAmt,2,".",","); ?> on <?php echo date_format($pmtdate,"F jS, Y");?>. Thanks!
				</p>
				<?php
			}
			?>
			<p>I really appreciate having you as a customer!</p>
			
			<?php
			echo checkState($_GET['state']);
			?>
			<br />
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
				<div>
					<div>
						<div class="checkbox">
							<label for="dc">
								<input type="checkbox"  id="dc" name="dc" onclick="dcpmt()"/><b>Check if payment was via Debit Card</b>
							</label>
						</div>
						<div class="checkbox">
							<label for="ach">
								<input type="checkbox"  id="ach" name="ach" onclick="achpmt()"/><b>Check if payment is via ACH</b>
							</label>
						</div>
						<div class="checkbox">
							<label for="mail">
								<input type="checkbox"  id="mail" name="mail" onclick="mailed();"/><b>Check if payment is via Postal Mail</b>
							</label>
						</div>
					</div>
				</div>
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
					<div id="landform"></div>
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