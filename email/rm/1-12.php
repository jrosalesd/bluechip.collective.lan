<div class="row">
    <div class="col-md-3">
        <h2>
			<?php echo $emname;?>
		</h2>
		<font color="red">
			<h5>
				<b>Template Usage: </b>Use this template when a borrower makes a one-time payment with a debit card.
				<br>
			</h5>
		</font>
    </div>
    <div class="col-md-9" id="embody" style="border-left: solid;">
        <?php
		if($_GET['set'] == "on"){
			//variables to complete template
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
		    
		    
			<p><b>Payment Receipt</b></p>
			<?php
			if($_GET['ach'] == "on"){
				?>
				<p>This email is a receipt of your one-time payment in the amount of $<?php echo number_format($pmtAmt,2,".",","); ?> paid on <?php echo date_format($pmtdate,"l, F jS"); ?>, from your <?php echo $bankname;?> account ending in <?php echo $lastfour;?>.</p>
				<?php
			}elseif ($_GET['dc'] == "on") {
				?>
				<p>This email is a receipt of your one-time payment in the amount of $<?php echo number_format($pmtAmt,2,".",","); ?> paid on <?php echo date_format($pmtdate,"l, F jS"); ?>.</p>
				
				<p>
					Your confirmation ID is: <?php echo $pmtconf;?>
				</p>
				<?php
			}elseif ($_GET['mail'] == "on") {
				?>
				<p>
					This email is a receipt of your one-time <?php echo $mailpmttype;?> payment in the amount of $<?php echo number_format($pmtAmt,2,".",",");?> received on <?php echo date_format($pmtdate,"F jS, Y");?>.
				</p>
				<?php
			}
			?>
			
			<?php
			echo checkState($_GET['state']);
			?>
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
				<!--
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
				-->
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
						<input type="hidden" value="on" name="dc">
						<div class="form-group">
							<label for="pmtconf">
								DC Payment Confirmation ID:
							</label>
							<input class="form-control" type="text" name="pmtconf" required/>
						</div>
					</div>
					<!--<div id="landform"></div>-->
				</div>
				<?php supCorr();?>
				<button type="submit" name="set" class="btn btn-success" value="on" colspan="3">
					Generate Email
				</button>
			</form>
			
			<?php
		}
		?>
    </div>
</div>