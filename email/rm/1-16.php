<div class="row">
    <div class="col-md-3">
        <h2>
			Cancelled Payment Email
		</h2>
		<font color="red">
			<h5>
				<b>Generate: </b>When a customer sets up a payment through their online account or when they call to make special arrangements with their agent -- and then decide they can’t/don’t want to go through with it. 
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
			
			//next payment
			$pmtnote = htmlspecialchars($_GET['pmtnote']);
			$nextpmtdate = date_create(htmlspecialchars($_GET['nextpmtdate']));
			$nextpmtamt = htmlspecialchars($_GET['nextpmtamt']);
			
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
				<strong>Subject:</strong> Cancelled Payment Confirmations
			</p>
			<br />
			
			<p>
				Hi <?php echo ucfirst($brwName);?>,
			</p>
			<br />
			
			<p>
				Thanks for contacting me.
			</p>
			<p>
				<?php echo pmtcancelation(htmlspecialchars(trim($_GET['pmtType'])), $_GET['pmtdate'], htmlspecialchars($_GET['pmtAmt']),$pmtnote); ?>
			</p>
			<?php
			echo checkState($id);
            NxtPmt($nextpmtdate, $nextpmtamt, $pmtnote);
            comment($comment, $s);
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
						<?php
                        statedrop();
                        ?>
					</div>
					<div class="col-md-4">
						<div class="form-group">
                            <label for="pmtAmt">
                                Cancelled Payment Amount:
                            </label>
                            <input class="form-control" type="number" step="0.01" name="pmtAmt" required/>
                        </div>
                        <div class="form-group">
                            <label for="pmtdate">
                                Cancelled Payment Date:
                            </label>
                            <input class="form-control" type="date" name="pmtdate" required/>
                        </div>
					</div>
					<div class="col-md-4">
						<?php
						pmtcncldrop();
						?>
					</div>
				</div>
				<?php
				nxtpendingcheck();
				?>
				<button type="submit" name="set" class="btn btn-success" value="on" colspan="3">
					Generate Email
				</button>
			</form>
			<?php
		}
		?>
    </div>
</div>