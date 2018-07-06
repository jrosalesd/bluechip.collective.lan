<div class="row">
    <div class="col-md-3">
        <h2>
            Payment Arrangement Email <small>(Bank/Payoff)</small>
        </h2>
        <font color="red">
            <h5>
                <b>Generate: </b>Copy and Paste 
                <br>
                <b>Template: </b>When a customer contacts an agent to pay off her loan and it is set up.
                <br>
                <b>Action: </b>Manual - Agent to update and send accordingly.
            </h5>
        </font>
    </div>
    <div class="col-md-9" id="embody" style="border-left: solid;">
        <?php
        if($_GET['set'] == "on"){
            //variables to complete template
            $brwName = htmlspecialchars(trim($_GET['brwName']));	
            $payoffDate = date_create($_GET['payoffDate']);
            $payoffAmt = $_GET['payoffAmt'];
            $bankname = $_GET['bankname'];
            $lastfour = $_GET['lastfour'];
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
            <div>
                <!-- Email Temaplate -->
                <p>
                    <strong>Subject:</strong>
                    Your payoff – $<?php echo number_format($payoffAmt,2,".",",");?> due on <?php echo date_format($payoffDate,"l, F jS");?>
                </p>
                <br>
                <p>
                    Hi <?php echo ucfirst($brwName);?>,
                </p>
                <br>
                <p>
                    You’re all set to pay off your loan on <?php echo date_format($payoffDate,"l, F jS");?>, in the amount of $<?php echo number_format($payoffAmt,2,".",",");?> from your <?php echo $bankname;?> account ending in <?php echo $lastfour;?>.
                </p>
                
                <p>
                    Let me know if anything changes so we can keep you on track.
                </p>
            
            <?php
            if(isset($_GET['pendingclick'])){
            ?>
            <p>
            Keep in mind, this payoff is valid as long as your pending payment from <?php echo date_format($pmtdate,"l, F jS");?>, in the amount of $<?php echo number_format($pmtAmt,2,".",",");?> clears your bank account successfully.
            </p>
            <?php
            }
            if ($state_status == "No"){
            ?>
            <p>
            <?php echo $state_note;?>
            </p>
            <?php
            }
            ?>
            <br>
            
            <?php
            include('includes/signature.inc.php');
            ?>
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
                        <div class="form-group">
                            <label for="state">
                            Borrower's State:
                            </label>
                            <select class="form-control"  name="state" required>
                                <option value="">Select</option>
                                <?php
                                if($rows > 0){
                                while($row = mysqli_fetch_array($state_q)){
                                	?>
                                	<option value="<?php echo $row['id']?>" <?php if($_GET['state'] == $row['id']){echo "selected";}?>><?php echo $row['state_name']?></option>
                                	<?php
                                }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="payoffAmt">
                                Payoff Amount:
                            </label>
                            <input class="form-control" type="number" step="0.01" name="payoffAmt" required/>
                        </div>
                        <div class="form-group">
                            <label for="payoffDate">
                            Payoff Date:
                            </label>
                            <input class="form-control" type="date" name="payoffDate" required/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="$bankname">
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
                </div>
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
                <button type="submit" name="set" class="btn btn-success" value="on" colspan="3">
                Generate Email
                </button>
            </form>
            <?php
            }
            ?>
        </div>
    </div>
</div>
