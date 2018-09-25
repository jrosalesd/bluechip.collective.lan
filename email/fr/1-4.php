<div class="row">
	<div class="col-md-3">
		<h2>
			Broken Agreement Email
		</h2>
		<font color="red">
			<h5>
				<b>Generate: </b>When a customer misses a payment arrangement and the agent wants to follow up. 
				<br>
				<b>Template: </b>Spotloan email with logo
				<br>
				<b>Action: </b>Manual - RM/FR to edit and send
			</h5>
		</font>
	</div>
	<div class="col-md-9" style="border-left: solid;">
		<?php
		if($_GET['set'] == "on"){
			//variables to complete template
			$brwName = trim($_GET['brwName']);
			$arrangementDate = date_format(date_create($_GET['misspmtdate']),"F jS, Y");
			
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
			<p>
				<strong>
					Subject:
				</strong> 
				A quick follow up
			</p>
			
			<?php echo brwname($_GET['brwName'],$_GET['sup-correction']);?>
		    
			
			<p>
				When we last connected, you promised me that you would make a payment on <?php echo $arrangementDate;?>. I see that this payment wasn’t made. I’m willing to work with you, but I need your cooperation.
			</p>
			<p>
				Please give me a call at 1(888) 681-6811  or reply to this email as soon as possible.
			</p>
			<?php
            if ($pmtnote == 'on') {
                ?>
                <p>
                    As a friendly reminder, your next schedule payment of $<?php echo number_format($nextpmtamt,2,".",",");?> will be due on <?php echo date_format($nextpmtdate,"l, F jS");?>.
                </p>
                <?php
            }
            ?>
            <?php
            if ($_GET['additional'] == 'on') {
                ?>
                <p>
                    <?php echo nl2br(htmlspecialchars($_GET['additionalnote']))?>
                </p>
                <?php
            }
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
							<label for="misspmtdate">
								Missed Payment Date:
							</label>
							<input type="date" class="form-control" name="misspmtdate" required>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<div class="checkbox">
							<label for="pmtnote">
							    <input type="checkbox"  id="pmtnote" name="pmtnote" onclick="nextpmt()"/><b>Next Payment Notice</b>
							</label>
						</div>
						<div class="checkbox">
							<label for="additional">
								<input type="checkbox"  id="additional" name="additional" onclick="addnote()"/><b>Other Notes</b>
							</label>
						</div>
					</div>
					<div class="col-md-9">
						<div class="row">
							<div class="col-md-6">
								<g id="pmtnotebody"></g>
							</div>
							<div class="col-md-6">
								<g id="notefield"></g>
							</div>
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