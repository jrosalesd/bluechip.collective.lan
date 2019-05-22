<div class="row">
    <div class="col-md-3">
        <h2>
            <?php echo $emname;?>
        </h2>
        <font color="red">
            <h5>
				<b>Template Usage: </b>Use this template when a customer requests a paid-off email.
				<br>
			</h5>
        </font>
    </div>
    <div class="col-md-9" id="embody" style="border-left: solid;">
        <?php
        if($_GET['set'] == "on"){
            //variables to complete template
            
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
            <div id="copy_notify"></div>
            <div class="well well-lg">
                <div class="well well-sm">
                    <?php
                    $online = htmlspecialchars($_GET['online']);
                    $onlineDueDate = strtotime(htmlspecialchars($_GET['onlineDate']));
                    if($online > 0){
                        $date = strtotime("Today");
                        $date = nextBD(date("m/d/y",$date),1,1);
                    }if ($online == 0) {
                        $date = strtotime($_GET['payoffDate']);
                        $date += $one_day_sec*7;
                    }
                    $date2 = strtotime($_GET['payoffDate']);
                    $date2 += $one_day_sec*7;
                    
                    echo "<b>FOLLOW UP <br> Please set the follow up for ".date('m/d/Y',$date)."</b>";
                    ?>
                </div>
                <?php
                if ($online == 1) {
                    if (isset($_GET['pendingclick']) && $_GET['pendingclick'] == "on") {
                        $follow_up = "Please delete the online payoff set for ".date('m/d/Y',$onlineDueDate)." by the borrower. Once completed, reset the follow-up on ".date('m/d/Y',$date2)."  to send a ticket to servicing to waive the remaining balance if the payments on ".date_format(date_create($_GET['datepending']),"m/d")." and ".date_format($payoffDate,"m/d")." clear successfully.";
                    }else {
                        $follow_up = "Please delete the online payoff set for ".date('m/d/Y',$onlineDueDate)." by the borrower. Once completed, reset the follow-up on ".date('m/d/Y',$date2)."  to send a ticket to servicing to waive the remaining balance if the payment on ".date_format($payoffDate,"m/d")." clears successfully.";
                    }
                }elseif ($online == 2) {
                    if (isset($_GET['pendingclick']) && $_GET['pendingclick'] == "on") {
                        $follow_up = "Please delete the Special Payment set for ".date('m/d/Y',$onlineDueDate).". Once completed, reset the follow-up on ".date('m/d/Y',$date2)."  to send a ticket to servicing to waive the remaining balance if the payments on ".date_format(date_create($_GET['datepending']),"m/d")." and ".date_format($payoffDate,"m/d")." clear successfully.";
                    }else {
                        $follow_up = "Please delete the Special Payment set for ".date('m/d/Y',$onlineDueDate).". Once completed, reset the follow-up on ".date('m/d/Y',$date2)."  to send a ticket to servicing to waive the remaining balance if the payment on ".date_format($payoffDate,"m/d")." clears successfully.";
                    }
                }elseif ($online == 0) {
                     if (isset($_GET['pendingclick']) && $_GET['pendingclick'] == "on") {
                        $follow_up = "Please waive the remaining balance if the payments on ".date_format(date_create($_GET['datepending']),"m/d")." and ".date_format($payoffDate,"m/d")." clear successfully.";
                    }else {
                        $follow_up = "Please waive the remaining balance if the payment on ".date_format($payoffDate,"m/d")." clears successfully.";
                    }
                }
                ?>
                <div class="followup">
                    <div id="follow-up">
                          <i>
                        <?php echo $follow_up;?>
                        </i>
                    </div>
                    <div class="float-right">
                        <div class="row">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-4"></div>
                            <div class="col-lg-4"><button id="copy-init" class="btn btn-success" onclick="copyFollowUp('follow-up',this.value)" value="FollowUp">Copy Follow-Up</button></div>
                        </div>
                        
                    </div>
                </div>
                
                    
            </div>
            <div class="row">
                    <div class="col-lg-4"><button id="copy-init" class="btn btn-primary" onclick="copyFollowUp('email-body',this.value)" value="email">Copy Email</button></div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4"></div>
                </div>
            <hr>
            <div id="email-body">
                <!-- Email Temaplate -->
                
                
                <?php echo brwname($_GET['brwName'],$_GET['sup-correction'],1);?>
                
                <p>
                    You’re all set to pay off your loan in the amount of $<?php echo number_format($payoffAmt,2,".",",");?> on <?php echo date_format($payoffDate,"l, F jS");?>. This will be debited from your bank account on file.
                </p>
                <!--
                <p>
                    You’re all set to pay off your loan on <?php echo date_format($payoffDate,"l, F jS");?>, in the amount of $<?php echo number_format($payoffAmt,2,".",",");?> from your <?php echo $bankname;?> account ending in <?php echo $lastfour;?>.
                </p>
                -->
                <p>
                    Please let me know if you need to make any changes.
                </p>
            
            <?php
            echo pendingpayment(3, $_GET['pendingclick'], $_GET['pennextpmtamt'], $_GET['datepending']);
			echo checkState($_GET['state']);
            ?>
            
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
                        <?php
                        statedrop(true);
                        ?>
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
                            <label for="online">
                           Are there any payment that needs to be deleted?
                            </label>
                            <select class="form-control" name="online" id="online" onchange="load()" required>
                                <option value="">Select</option>
                                <option value="0">No</option>
                                <option value="1">Yes - Online</option>
                                <option value="2">Yes - SP</option>
                            </select>
                        </div>
                        <script>
                        {
                            function load(){
                                let value, element, fallback, landing;
                                value = document.getElementById('online').value;
                                landing = document.getElementById('ofall');
                                element = '<div class="form-group">';
                                    element += '<label for="onlineDate">';
                                        element += 'Due date for the payment that needs to be deleted:';
                                    element += '</label>';
                                    element += '<input class="form-control" type="date" name="onlineDate" required/>';
                                element += "</div>";
                                fallback = '<div id="ofall"></div>';
                                if(value > 0){
                                    landing.innerHTML = element;
                                }else{
                                    landing.innerHTML = fallback;
                                }
                            };
                        }
                        </script>
                        <div id="ofall"></div>
                    </div>
                </div>
                <div>
                <?php 
                pendingpayment(0);
                ?>
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
