<div class="row">
    <div class="col-md-3">
        <h2>
			Banking Information Change Email
			<br>
			<small>(New account)</small>
		</h2>
		<font color="red">
			<h5>
				<b>Generate: </b>When someone contacts their RM with new bank account information, and this change has been made in our system. This can happen at any point after a customer has received their loan disbursement, but not before.
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
			$pmtdate = date_create($_GET['pmtdate']);
            $bankname = nl2br(htmlspecialchars($_GET['bankname']));
            $lastfour = htmlspecialchars($_GET['lastfour']);
			
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
				<strong>Subject:</strong> We’ve updated your info!
			</p>
			<br>

			<?php echo brwname($_GET['brwName']);?>		    
			
			<p>
				Thanks for letting me know about the changes to your bank account. I really appreciate it! Everything has been updated in our system.
			</p>
			<p>
				As a friendly reminder, your next payment of $<?php echo number_format($pmtAmt,2,".",","); ?> is due on <?php echo date_format($pmtdate,"l, F jS"); ?>, and will be pulled from your new <?php echo $bankname;?> account ending in <?php echo $lastfour;?>.
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
                            <label for="pmtdate">
                                Next Payment Date:
                            </label>
                            <input class="form-control" type="date" name="pmtdate" required/>
                        </div>
                        <div class="form-group">
                            <label for="pmtAmt">
                                Next Payment Amount:
                            </label>
                            <input class="form-control" type="number" step="0.01" name="pmtAmt" required/>
                        </div>
                    </div>
					<div class="col-md-4">
                            <div class="form-group">
                                <label for="bankname">
                                    New Bank Name:
                                </label>
                                <input class="form-control" type="text" name="bankname" required/>
                            </div>
                            <div class="form-group">
                                <label for="lastfour">
                                    Last 4 of New Bank Account:
                                </label>
                                <input class="form-control" type="text" maxlength="4"  name="lastfour" required/>
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