<div class="row">
    <div class="col-md-3">
        <h2>
			Deferral Confirmation Email
		</h2>
		<font color="red">
			<h5>
				<b>Generate: </b>When an agent makes a deferral and selects to send this confirmation email. 
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
			$approxint = $_GET['approxint'];
			$pmtAmt = htmlspecialchars($_GET['pmtAmt']);
			$pmtdate = date_create($_GET['pmtdate']);
			//next payment
			$pmtnote = $_GET['pmtnote'];
			$nextpmtdate = date_create($_GET['nextpmtdate']);
			$nextpmtamt = $_GET['nextpmtamt'];
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
				<strong>Subject:</strong> <?php echo ucfirst($brwName);?>, your Spotloan is updated
			</p>
			<br>
			
			<p>
				Hi <?php echo ucfirst($brwName);?>,
			</p>
			
		    <p>
		    	Per your request to defer, Spotloan will not be taking out your next scheduled payment of $<?php echo number_format($pmtAmt,2,".",","); ?> on <?php echo date_format($pmtdate,"l, F jS"); ?>. Please remember that deferring your payment increases your total amount due; <?php if($approxint>700){echo "and a really high amount of additional interest may be added to your loan";}else{echo "it could add up to $".number_format($approxint,2,".",",")." in extra interest";}?>. You can make up this payment at any time if you want to save some money.
		    </p>
		    
			<?php
			if ($pmtnote == 'on') {
				?>
				<p>
					As a friendly reminder, your next scheduled payment of $<?php echo number_format($nextpmtamt,2,".",",");?> will be due on <?php echo date_format($nextpmtdate,"l, F jS");?>.
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
							<label for="approxint">
								Approximate Interest for Defering:
							</label>
							<input class="form-control" type="number" step="0.01" name="approxint"/>
						</div>
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
					<div class="col-md-4"></div>
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
							<input type="checkbox"  id="additional" name="additional" onclick="addnote();"/><b>Other Notes</b>
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
				<button type="submit" name="set" class="btn btn-success" value="on" colspan="3">
					Generate Email
				</button>
			</form>
			<?php
		}
		?>
    </div>
</div>