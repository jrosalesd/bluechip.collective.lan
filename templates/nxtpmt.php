
//next payment
			$pmtnote = htmlspecialchars($_GET['pmtnote']);
			$nextpmtdate = date_create(htmlspecialchars($_GET['nextpmtdate']));
			$nextpmtamt = htmlspecialchars($_GET['nextpmtamt']);


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
-----------------------------------
//number format//

<?php echo number_format($pmtAmt,2,".",","); ?>
<?php echo date_format($pmtdate,"l, F jS"); ?>

<p>
Hi <?php echo $brwName;?>,
</p>
<br>

-------------------------


<?php echo $bankname;?>
<?php echo $lastfour;?>
bank information


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="bankname">
                                                Bank Name:
                                            </label>
                                            <input class="form-control" type="text" name="bankname" required/>
                                        </div>
                                        <div class="form-group">
                                            <label for="lastfour">
                                                Last 4 Bank Account:
                                            </label>
                                            <input class="form-control" type="text" maxlength="4"  name="lastfour" required/>
                                        </div>
                                    </div>


**********************

$pmtAmt = htmlspecialchars($_GET['pmtAmt']);
						$pmtdate = date_create($_GET['pmtdate']);
                        $bankname = nl2br(htmlspecialchars($_GET['bankname']));
                        $lastfour = htmlspecialchars($_GET['lastfour']);

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
//====================================================

//pending pmt var
						$pmtAmt = htmlspecialchars($_GET['pennextpmtamt']);
						$pmtdate = date_create($_GET['datepending']);
						
						<?php
						if(isset($_GET['pendingclick'])){
							?>
							<p>
								Keep in mind, this payoff is valid as long as your pending payment from <?php echo date_format($pmtdate,"l, F jS");?>, in the amount of $<?php echo number_format($pmtAmt,2,".",",");?> clears your bank account successfully.
							</p>
							<?php
						}
						?>
<div>
                        <div>
                            <div class="checkbox">
                                <label for="pendingclick">
                                    <input type="checkbox"  id="pendingclick" name="pendingclick" onclick="pendingpmt()"/><b>Is there any PENDING PAYMENTS?</b>
                                </label>
                            </div>
                        </div>
                        <div>
                            <div class="col-md-6">
                                <g id="pendingForm"></g>
                            </div>
                        </div>
                    </div>
//===========================================================
<!-- DB HANDLER STAQTEMENT -->
<?php
//Open DB connection
include 'includes/dbh.inc.php';

//Close Db Connection
$conn->close();
?>
//===========================================================
//===========================================================
 <?php
                if ($state_status == "No"){
                    ?>
                    <p>
                    <?php echo $state_note;?>
                    </p>
                    <?php
                }
                ?>