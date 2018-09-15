<div class="row">
    <div class="col-md-3">
        <h2>
			Account Balance Email
		</h2>
		<font color="red">
			<h5>
				<b>Generate: </b>When a customer asks an agent what their account balance is.
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
			$pmtAmt = htmlspecialchars($_GET['pmtAmt']);
			
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
		    	Hi <?php echo ucfirst($brwName);?>,
		    </p>
		    <br>
		    
		    
			<p>
				You’ve just made my “Favorite Customer of the Day” list! Thanks for checking in on your loan. Your account balance is $<?php echo number_format($pmtAmt,2,".",","); ?>.
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
            <p>
				Remember, your account balance changes daily to reflect interest.
            </p>
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
                            <label for="pmtAmt">
                                Account Balance:
                            </label>
                            <input class="form-control" type="number" step="0.01" name="pmtAmt" required/>
                        </div>
					</div>
					<div class="col-md-4"></div>
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