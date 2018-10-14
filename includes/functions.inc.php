<?php
function ResetPass($length=15) {
    $characters = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ`~!@#$%^&*()-_=+|/:;><";
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function intWeeks($s, $e){
	$days = $e - $s;
	$weeknum = round($days/7);
	if ($days <= 15) {
		$weeks = "Keep in mind this would add an additional $weeknum weeks of interest at the end of your loan. However, this is still a much cheaper option than skipping your payment altogether.";
	} else if ($days > 15) {
		$weeks = "If you decide to defer this payment, keep in mind that it could potentially add several extra payments and extend the life of your loa until made in full.";
	}
	return $weeks;
}

function nextBD($start,$count = 1,$method = 0){ 
    $start = htmlspecialchars($start);
    $tmpDate = $start;
    $start = strtotime($start);
    $currentYear = date('Y',$start);
    $holidays = [ 
        date("m/d/Y",mktime(0, 0, 0, 1, 1,$currentYear)), 
        date("m/d/Y",strtotime("3 Mondays", mktime(0, 0, 0, 1, 1, $currentYear))), 
        date("m/d/Y",strtotime("3 Mondays", mktime(0, 0, 0, 2, 1, $currentYear))), 
        date("m/d/Y",strtotime("last Monday of May $currentYear")), 
        date("m/d/Y",mktime(0, 0, 0, 7, 4, $currentYear)), 
        date("m/d/Y",strtotime("first Monday of September $currentYear")), 
        date("m/d/Y",strtotime("2 Mondays", mktime(0, 0, 0, 10, 1, $currentYear))), 
        date("m/d/Y",mktime(0, 0, 0, 11, 11, $currentYear)), 
        date("m/d/Y",strtotime("4 Thursdays", mktime(0, 0, 0, 11, 1, $currentYear))), 
        date("m/d/Y",mktime(0, 0, 0, 12, 25, $currentYear))
    ];
    
    $i = $count;
    $nextBusinessDay = date('m/d/Y', strtotime($tmpDate . ' +' . $i . ' Weekday'));
    
    while (in_array($nextBusinessDay, $holidays)) {
        $i++;
        $nextBusinessDay = date('m/d/Y', strtotime($tmpDate . ' +' . $i . ' Weekday'));
    }
    if ($method == 0) {
    return $nextBusinessDay;
    }if ($method == 1) {
        $nextBusinessDay = strtotime($nextBusinessDay);
        return $nextBusinessDay;
    }if ($method == 3) {
        // formated dddd, mmmm dd
        $nextBusinessDay = date_create($nextBusinessDay);
        $nextBusinessDay = date_format($nextBusinessDay,"l, F jS");
        return $nextBusinessDay;
    }
}

function restructureOffer($pmtdate, $pmtnum, $pmtfreq, $resamt, $ressdate, $ressdateEnd){
    $pmtdate = date_format($pmtdate,"l, F jS");
    $resamt = "$".number_format($resamt,2,".",",");
    $ressdate = date_format($ressdate,"l, F jS");
    $ressdateEnd = date_format($ressdateEnd,"l, F jS, Y");
    
    $offer = "$pmtnum $pmtfreq payments of $resamt starting $ressdate and ending on $ressdateEnd.";
    
    return $offer;
}

function comment($comment, $s){
    if ($s == "on") {
       ?>
        <p>
            <?php echo nl2br(htmlspecialchars($comment))?>
        </p>
        <?php
    }
}

function statedrop($req = false, $status = false){
    include 'dbh.inc.php';
    if ($status == true) {
        $st = "SELECT * FROM servicing_states WHERE state_status='No' ORDER BY state_name ASC";
    }else {
        $st = "SELECT * FROM servicing_states ORDER BY state_name ASC";
    }
    
    $state_q = mysqli_query($conn, $st);
    $rows = mysqli_num_rows($state_q);
    ?>
    <div class="form-group">
        <label for="state">
            Borrower's State:
        </label>
        <select class="form-control"  name="state" <?php if($req == true){echo "required";}?> >
            <option value="">Select State</option>
            <?php
            if($rows > 0){
            while($row = mysqli_fetch_array($state_q)){
            	?>
            	<option value="<?php echo $row['id']?>" <?php if($_GET['state'] == $row['id']){echo "selected";}?>>
            	    <?php echo $row['state_abr']." - ".$row['state_name']?>
            	    </option>
            	<?php
            }
            }
            ?>
        </select>
    </div>
    <?php
    $conn->close();
}

function checkState($id){
    if (!empty($id)) {
        include 'dbh.inc.php';
        $st_check = "SELECT * FROM servicing_states WHERE id='$id'";
        $state_check = mysqli_query($conn, $st_check);
        $rows_check = mysqli_num_rows($state_check);
        if ($rows_check>0) {
        	$row_check = mysqli_fetch_array($state_check);
        	$state_status = $row_check['state_status'];
        	$state_name = $row_check['state_name'];
        	if ($state_status == "No") {
        		$state_note = "<p>Unfortunately, we are no longer offering loans in the state of $state_name. This means that we will not be able to approve a new loan for you at this time.</p>";
        	}
        }
        
        return $state_note;
        $conn->close();
    }
}

function finalpmtstate($id, $pmtdate){
    $pmtdate = date_format($pmtdate,"l, F jS");
    if (!empty($id)) {
        include 'dbh.inc.php';
        $st_check = "SELECT * FROM servicing_states WHERE id='$id'";
        $state_check = mysqli_query($conn, $st_check);
        $rows_check = mysqli_num_rows($state_check);
        if ($rows_check>0) {
        	$row_check = mysqli_fetch_array($state_check);
        	$state_status = $row_check['state_status'];
        	if ($state_status == "No") {
        		$email = 
        		"
        		<p>
        		    Your final payment is still being processed by our system, and should clear on $pmtdate.
        		</p>
        		<p>
        		    As a friendly reminder; unfortunately, we no longer lend in your state.
        		</p>
        		"
        		;
        	}else{
        	    $email= 
        	    "		    
		        <p>Your final payment is still being processed by our system, and should clear on $pmtdate. If you wish to re-apply you may do so, all you need to do is go to our website and submit a new application, just like the first time.</p>

		        <p>Keep in mind that if your final payment is returned and you are approved for a new loan, you will be responsible for both balances.</p>
		
		        <p>If you have any questions or concerns, don't hesitate to give us a call or send us an email and any one of our Relationship Managers will be more than pleased to assist you.</p>
	            "
        	    ;
        	}
        }
        
        return $email;
        $conn->close();
    }
}

function pendingpmt($pmtdate, $pmtAmt, $s, $frm=false, $res = false){
    if ($frm == false) {
        if($s){
            $pmtdate =  date_format($pmtdate,"l, F jS");
            $pmtAmt = number_format($pmtAmt,2,".",",");
            if ($res == true) {
                $pending = "<p>Keep in mind, this restructure is valid as long as your pending payment from $pmtdate, in the amount of $$pmtAmt clears your bank account successfully.</p>";
            }else{
                $pending = "<p>Keep in mind, this payoff is valid as long as your pending payment from $pmtdate, in the amount of $$pmtAmt clears your bank account successfully.</p>";
            }
        }
        return $pending;
    }elseif ($frm == true) {
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
                <div class="col-md-4">
                    <g id="pendingForm"></g>
                </div>
            </div>
        </div>
       <?php
    }

}

function address($l = false, $loanid = false){
    $address = "";
    include 'dbh.inc.php';
    $dbquery = "SELECT * FROM sp_contact where status=1 and address_type='Mailing Address'";
    $dbinit = mysqli_query($conn, $dbquery);
    $dbrow = mysqli_num_rows($dbinit);
    if($dbrow > 0) {
        $dbrow = mysqli_fetch_array($dbinit);
        $ad = $dbrow['address1'];
        $ad2 = $dbrow['address2'];
        $city = $dbrow['city'];
        $state = $dbrow['state'];
        $zip = $dbrow['zipcode'];
        if ($l == false) {
            if ($loanid == false) {
                $address = "
                    <div >
                        <p>
                            Spotloan
                            <br>$ad
                            <br>$city, $state $zip
                        </p>
                    </div>
                ";
            }else {
                $address = "
                    <div>
                        <p>
                            Spotloan
                            <br>$ad
                            <br>$city, $state $zip
                            <br>Attention to: $loanid
                        </p>
                    </div>
                ";
            }
                
        }else if ($l == true) {
            $address = "<b>Spotloan, $ad, $city, $state $zip</b>";
        }
    }else {
        $error = $conn->error();
        $address = "something went wrong Address cannot be fetched. Error:$error";
    }
        
    $conn->close();
    echo $address;
}

function addressupdate($type=0, $street="", $city="", $state="",$zip=""){
    if ($type == 0) {
        ?>
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label for="street">Street Address:</label>
                    <input class="form-control" type="text" name="street" id="street"/>
                </div>
                        
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="city">City:</label>
                            <input class="form-control" type="text" name="city" id="city"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <?php statedrop(1);?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="zip">Zipcode:</label>
                        <input class="form-control" type="text" name="zip" id="zip"/>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }if ($type == 1) {
        include 'dbh.inc.php';
        $street = ucwords(mysqli_real_escape_string($conn,$street));
        $city = ucwords(mysqli_real_escape_string($conn,$city));
        $state = mysqli_real_escape_string($conn,$state);
        $zip =mysqli_real_escape_string($conn,$zip);
        //Get state
        $state_query="SELECT * FROM servicing_states where id=$state";
        $dataPull = mysqli_query($conn, $state_query);
        $numrows = mysqli_num_rows($dataPull);
        if ($numrows > 0) {
            $row = mysqli_fetch_array($dataPull);
            $abbr = $row['state_abr'];
            $service = $row['state_status'];
            $state_name = $row['state_name'];
        }
        $addessupdate = "<p>Per your request, Spotloan has updated your address to the following: $street, $city, $abbr $zip.</p>";
        if ($service == No) {
            $addessupdate .= "<p>Please keep in mind, we no longer offer loans in $state_name. We apologize for any inconvenience.</p>";
        }
        
        $conn->close();
        
        echo $addessupdate;
    }
    
}

function pmtcancelation($code, $date = "", $amt = "", $nxtpmt = "off"){
    
    
    $script = "This email is to confirm that your loan ";
    
    if ($code == 1) {
      //payoff
      $script .= "payoff has been cancelled.";
    }
    if ($code == 2) {
        //Extra Payment
        $script .= "extra payment has been cancelled.";
    }
    if ($code == 3) {
        //double payment
        $script .= "double payment has been cancelled.";
    }
    if ($code == 4) {
        $date = date_create($date);
        $date = date_format($date,"l, F jS");
        $amt = "$".number_format($amt,2,".",",");
        $script = "This email is to confirm that your loan ";
        //Settlement
        if ($nxtpmt == "on") {
            
           $script .= "settlement payment in the amount of $amt that was scheduled for $date. Keep in mind that missing this payment could void your settlement. Please contact me as soon as possible to work out your settlement.";
        }else{
            $script .= "settlement payment in the amount of $amt that was scheduled for $date. Keep in mind that missing this payment will void your settlement. Please contact me as soon as possible to work out your settlement.";
        }
    }
    
    return $script;
    
    //Settlement
}

function pmtcncldrop(){
    ?>
    <div class="form-group">
        <label for="pmtType">
            Payment Type:
        </label>
        <select class="form-control" name="pmtType" id="pmtType" required>
        	<option value="">Select</option>
        	<option value="1">Payoff</option>
        	<option value="2">Extra Payment</option>
        	<option value="3">Double Payment</option>
        	<option value="4">Settlement</option>
        </select>
    </div>
    <?php
}

function stlbroken($s){
    if (!empty($s)) {
       $stl = "Please contact me in order to reschedule this payment and keep your settlement active";
       return $stl;
    }
}

function nxtpmtcheck(){
    
    ?>
    <div class="row">
		<div class="col-md-4">
            <?php supCorr();?>
		</div>
		<div class="col-md-3">
			<div class="checkbox">
				<label for="pmtnote">
				    <input type="checkbox"  id="pmtnote" name="pmtnote" onclick="nextpmt()"/><b>Next Payment Notice</b>
				</label>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<g id="pmtnotebody"></g>
		</div>
	</div>
    <?php
}

function NxtPmt($nextpmtdate, $nextpmtamt, $pmtnote){
    if ($pmtnote == "on") {
        ?>
        <p>
            As a friendly reminder, your next scheduled payment is due on <?php echo date_format($nextpmtdate,"l, F jS");?>, in the regular amount of $<?php echo number_format($nextpmtamt,2,".",",");?>.
        </p>
        <?php
    }
}

function brokenstl($t=true){
    if ($t == true) {
        $stl = "Please contact me as soon as possible to work out your settlement.";
    }
    if ($t == false) {
        $stl = 
            '
            <div class="row">
                <div class="col-md-3">
                    <div class="checkbox">
        				<label for="stlnote">
        				    <input type="checkbox"  id="stlnote" name="stlnote" /><b>Is this a Settlement?</b>
        				</label>
        			</div>
                </div>
            </div>
			'
			;
    }
    return $stl;
}

function restructure($start, $pmtnum, $frequecy){
    $freqref  = array('Semi-Monthly' =>15,'Monthly' =>30,'Bi-Weekly' =>14 );
    $frequecy = $freqref["$frequecy"];
    $start = date_create($start);
    
    return date_format($start,"S Y");
}

function soldacct($frm=false, $check="off", $pmtdate = "today", $pmtAmt = "0"){
    
    if($frm == false){
        if($check == "on"){
            $pmtAmt =  "$".number_format($pmtAmt,2,".",",");
            $pmtdate = date_format($pmtdate,"F jS, Y");
            $script = "The last payment that we received from you was on $pmtdate, for $pmtAmt";
        }else{
            $script ="We did not receive any payments on your loan";
        }
        return $script;
    }if ($frm == true) {
        $form = 
        '
        <div>
			<div class="checkbox">
				<label for="sldcheck">
				    <input type="checkbox"  id="sldcheck" name="sldcheck" onclick="soldpmt()"/><b>Check if there were any payments</b>
				</label>
			</div>
        </div>
        <div id="sldland" name="sldland"></div>
        '
        ;
        return $form;
    }
}

function soldfind($LAPro, $mode = 0){
    $LAPro = htmlspecialchars($LAPro);
    //Pull data from DB
    include 'dbh.inc.php';
    $slq = "SELECT soldlist.Loan_ID, soldlist.Buyer, debtsalebuyers.Name, debtsalebuyers.PhoneNumber, soldlist.Sold_Date FROM soldlist, debtsalebuyers WHERE soldlist.Buyer = debtsalebuyers.Code AND soldlist.Loan_ID='$LAPro'";
    $slq_result = mysqli_query($conn, $slq);
    if (mysqli_num_rows($slq_result) != 0) {
        $row = mysqli_fetch_array($slq_result);
        //assign variables
        $AgencyAbr =$row[1];
		$Agency = $row[2]; 
		$phone = $row[3];
		$soldDate = date_create("$row[4]");
		$reporting = "off";
    }else {
        //DB error
        $output = "</p><div class='alert alert-warning offset25px'><b>Check LA Pro Account number. Something went wrong.</b></div><p>";
        $reporting = "on";
    }
    $conn->close();
    
    if ($reporting = "off") {
        if($mode == 0) {
            $output = date_format($soldDate,"F jS, Y");
        }else if ($mode == 1) {
           $output = 
           "
           <div class='offset25px'>
               <p>
                   <b>Debt Buyer:</b> $Agency
                   <br><b>Phone Number:</b> $phone
               </p>
           </div>
           ";
        }
    }    
    return $output;
}

function brwname($name, $corr="off", $mode = 0){
    $name = htmlspecialchars(trim($name));
    $name = ucfirst($name);
        
    if ($corr == "on") {
        $script =
            "
            <p>Hi $name,</p>
            ";
        $script .= "<p>My name is ".$_SESSION['SysName'].", Manager here at Spotloan. Please disregard the previously sent email, as it was the incorrect one. Please see below the correct email confirmation for the actions taken today on your loan.</p>";
    }else {
       if ($mode == 0) {
           $script = 
            "
            <p>Hi $name,</p>
            <p>Thank you for contacting Spotloan.</p>
            "
            ;
        }elseif ($mode == 1) {
            $script =
            "
            <p>Hi $name,</p>
            ";
        }elseif ($mode == 2) {
           $script = 
            "
            <p>Hi $name,</p>
            <p>Thank you for contacting Spotloan. My name is ".$_SESSION['SysName'].". and I will be assisting with your account today.</p>
            "
            ;
        }
    }
    
    return $script;
}

function emails($type){
    
    include 'dbh.inc.php';
    if($type == 1){
        ?>
        <form method="POST">
            <div class="row">
                 <div class="col-sm-4">
                     <div class="form-group">
                        <label for="tempname">Template Name</label>
                        <input class="form-control" type="text" name="tempname" id="tempname"/>
                    </div>
                 </div>
                 <div class="col-sm-4">
                     <div class="form-group">
                        <label for="catid">Email Group</label>
                        <select  class="form-control" name="catid" id="catid">
                            <option value="">Select One</option>
                            <?php
                            $em_cat = "Select * FROM em_cat";
                            $dbquery_cat = mysqli_query($conn, $em_cat);
                            $numrows_cat = mysqli_num_rows($dbquery_cat);
                             if ($numrows_cat > 0) {
                                while($em_row_cat = mysqli_fetch_array($dbquery_cat)){
                                    ?>
                                    <option value="<?php echo $em_row_cat['cat_id'];?>"><?php echo $em_row_cat['cat_name'];?></option>
                                    <?php
                                }
                            }else {
                                echo "Check Code";
                            }
                            ?>
                        </select>
                     </div>
                 </div>
                 <div class="col-sm-4">
                    <div class="form-group">
                        <label for="emtype">Email Type</label>
                        <select class="form-control" name="emtype" id="emtype">
                            <option value ="">Select One</option>
                            <?php
                            $em_type = "SELECT * FROM emtype";
                            $dbquery = mysqli_query($conn, $em_type);
                            $numrows = mysqli_num_rows($dbquery);
                             if ($numrows > 0) {
                                
                                while($em_row = mysqli_fetch_array($dbquery)){
                                    ?>
                                    <option value="<?php echo $em_row['code'];?>"><?php echo $em_row['name'];?></option>
                                    <?php
                                }
                            }else {
                                echo "Check Code";
                            }
                            ?>
                        </select>
                    </div>
                 </div>
            </div>
            <button type="submit"  class="btn btn-primary col-md-2" name="addem">Add</button>
        </form>
        <?php
    }
    $conn->close();
}

function pendingpayment($type, $status = "off", $pmtAmt = "", $pmtdate =""){
    $status = htmlspecialchars($status);
    if ($status == "on") {
        $pmtdate = htmlspecialchars($pmtdate);
        $pmtAmtsafe = htmlspecialchars($pmtAmt);
        $pmtdate = date_create($pmtdate);
        $pmtdate =  date_format($pmtdate,"l, F jS");
        $pmtAmt = "$".number_format($pmtAmtsafe,2,".",",");
        if ($type == 1) {
        //ACH Revokation
        $pendingNote = "<p>Unfortunately, we were unable to stop your pending payment of $pmtAmt on $pmtdate. As a reminder, we need a two business day notice for payment modifications. This payment will be the last one attempted from your account.</p>";
        }elseif ($type == 2) {
            //restructure
            $pendingNote = "<p>Keep in mind, this restructure is valid as long as your pending payment from $pmtdate, in the amount of $pmtAmt clears your bank account successfully.</p>";
        }elseif ($type == 3) {
            //payoff
            $pendingNote = "<p>Keep in mind, this payoff is valid as long as your pending payment from $pmtdate, in the amount of $pmtAmt clears your bank account successfully.</p>";
        }elseif ($type == 4) {
            // Schedule
            $pendingNote = "<p>Keep in mind, the schedule on this email is valid as long as your pending payment from $pmtdate, in the amount of $pmtAmt clears your bank account successfully.</p>";
        }
    }if ($status == "off") {
        if($type == 0){
            ?>
            <div>
                <?php supCorr();?>
                <div>
                    <div class="checkbox">
                        <label for="pendingclick">
                            <input type="checkbox"  id="pendingclick" name="pendingclick" onclick="pendingpmt()"/><b>Is there any PENDING PAYMENTS?</b>
                        </label>
                    </div>
                </div>
                <div>
                    <div class="col-md-4">
                        <g id="pendingForm"></g>
                    </div>
                </div>
            </div>
           <?php
        }
    }
    
    return $pendingNote;
}

function hoursOfOperation($status = true){
    if ($status == true) {
        $operations = 
        "<p>Our Help Desk hours of operation are Monday - Friday from 7:00am CST - 4:30pm CST. 
        <br>For immediate service, please feel free to contact us at 1-888-681-6811, Monday - Friday 7:00am - 8:00pm CST or Saturdays 9:00am - 6:00pm CST.</p>
        ";
    }
    
    echo $operations;
}

function nextpayment($type = 0, $entry = ""){
    if ($type == 0) {
        $outcome = 
        "
        <div>
        <h3>
        Next Payment Reminder
        </h3>
        </div>
        <div class='form-group' id='pmtnote'>
				<label for='nextpmtdate'>
					Next Payment Date
				</label>
				<input class='form-control' type='date' id='nextpmtdate' name='nextpmtdate' required/>
			</div>
			<div class='form-group'>
				<label for='nextpmtamt'>
					Next Payment Amount
				</label>
				<input class='form-control' type='number' step='0.01' id='nextpmtamt' name='nextpmtamt' required/>
			</div>
        "
        ;
    }if ($type == 1) {
        // Date
        $entry =  htmlspecialchars($entry);
        $date= date_create($entry);
        $outcome = date_format($date,"l, F jS");
    }if ($type == 2) {
        // Outcome = amount.
        $entry =  htmlspecialchars($entry);
        $outcome = "$".number_format($entry,2,".",",");
    }
    
    return $outcome;
}

function phonenumber($phone){
    $phone = htmlspecialchars($phone);
    //leave only digits
    $phone = preg_replace("/[^\d]/","",$phone);
    //check lenght
    $length = strlen($phone);
    
    //format Phone Number
    if($length == 10){
        $phone = preg_replace("/^1?(\d{3})(\d{3})(\d{4})$/", "$1-$2-$3", $phone);
        $phone = "<p>I just tried to call you at $phone and was unable to reach you. Please contact us at your earliest convenience so we can connect with you regarding your Spotloan account.</p>";
        return $phone;
    }else {
        $phone = "<p><b>[ERROR] - Your did not enter a valid Phone number</b>";
        return $phone;
    }
    
    
}

function definterest($mode=0,$pmtdate="", $pmtamt="", $defamt=""){
    if ($mode==0) {
        // Required form
        ?>
        <div>
            <div class="form-group">
                <label for="pmtdate">Missed Payment Date:</label>
                <input class='form-control' type='date' id='pmtdate' name='pmtdate' required/>
            </div>
            <div class="form-group">
                <label for="pmtamt">Missed Payment Amount:</label>
                <input class='form-control' type='number' step='0.01' id='pmtamt' name='pmtamt' required/>
            </div>
            <div class="form-group">
                <label for="defamt">Interest Amount for Deferral</label>
                <input class='form-control' type='number' step='0.01' id='defamt' name='defamt' required/>
            </div>
        </div>
        <?php
        
    }else{
        // Make variables safe
        $pmtdate = htmlspecialchars($pmtdate);
        $pmtamt = htmlspecialchars($pmtamt);
        $defamt = htmlspecialchars($defamt);
        //check amount of def amount
        if($defamt > 700){
            $exception = "and a really high amount of additional interest may be added to your loan";
        }else{
            $exception = false;
        }
        //format Variables
        $pmtamt  ="$".number_format($pmtamt,2,".",",");
        $defamt  ="$".number_format($defamt,2,".",",");
        $pmtdate = date_create($pmtdate);
        $pmtdate = date_format($pmtdate,"l, F jS");
        
        //check amount of def amount
        if($exception == false){
            $exception = "and it could add up to $defamt in extra interest";
        }
        
        if ($mode == 1) {
            
            $outcome = "<p>Per your request to defer, Spotloan will not be deducting your next scheduled payment of $pmtamt on $pmtdate. Please remember that deferring your payment increases your total amount due $exception. You can make up this payment at any time if you want to save money.</p>";
            
        }if ($mode==2) {
            $outcome = "<p>Per your request to defer, Spotloan will not be deducting your next scheduled payment of $pmtamt on $pmtdate. Please remember that deferring your payment increases your total amount due and it could add up to $defamt in extra interest. You can make up this payment at any time if you want to save money.</p>";
        }
        return $outcome;
    }
    
    
}

function checkday($date){
    //secure entry
    $one_day_sec = 86400;
    $date = htmlspecialchars($date);
    $date = strtotime($date)/$one_day_sec;
    $today = date("Y-m-d");
    $today = strtotime($today)/$one_day_sec;
    $difference = $date-$today;
    switch($difference){
        case -1:
            return "yesterday";
            break;
        case 0:
            return "today";
            break;
    }
}

function sp($mode=0,$date="", $amtinit="", $newamt=""){
    if ($mode == 0) {
       ?>
        <div class='form-group'>
			<label for='pmt_date'>
				New Payment Date:
			</label>
			<input class='form-control' type='date' id='pmt_date' name='pmt_date' required/>
		</div>
		<div class='form-group'>
			<label for='old_pmt'>
				Original Payment Amount:
			</label>
			<input class='form-control' type='number' step='0.01' id='old_pmt' name='old_pmt' required/>
		</div>
		<div class='form-group'>
			<label for='new_pmt'>
				New Payment Amount:
			</label>
			<input class='form-control' type='number' step='0.01' id='new_pmt' name='new_pmt' required/>
		</div>
       <?php
    }else if($mode == 1){
        //make variables safe.
        $date = htmlspecialchars($date);
        $amtinit = htmlspecialchars($amtinit);
        $newamt = htmlspecialchars($newamt);
        //formating
        $date = date_create($date);
        $date = date_format($date,"l, F jS");
        $amtinit = "$".number_format($amtinit,2,".",",");
        $newamt = "$".number_format($newamt,2,".",",");
        //Outcome
        $product = "Per your request, we have adjusted your payment for $date from $amtinit to $newamt. Please remember that interest will accrue for the remaining amount of the payment.";
        return $product;
    }
}

function paidoffloan(){
}

function supCorr(){
    if ($_SESSION['usersec'] < 3) {
        $corr = '<div class="checkbox"><label for="sup-correction"><input type="checkbox"  id="sup-correction" name="sup-correction"/><b>Is this a Correction email?</b></label></div>';
    }
        echo $corr;
}   

/*
function Restructure($resStart, $payments, $amount, $frequecy){
    $resStart = strtotime($resStart);
    $interval = array("Bi-Weekly"=>"14", "Semi-Monthly"=>"15","Monthly"=>"30");
    $holidays = [ 
        date("m/d/Y",mktime(0, 0, 0, 1, 1,$currentYear)), 
        date("m/d/Y",strtotime("3 Mondays", mktime(0, 0, 0, 1, 1, $currentYear))), 
        date("m/d/Y",strtotime("3 Mondays", mktime(0, 0, 0, 2, 1, $currentYear))), 
        date("m/d/Y",strtotime("last Monday of May $currentYear")), 
        date("m/d/Y",mktime(0, 0, 0, 7, 4, $currentYear)), 
        date("m/d/Y",strtotime("first Monday of September $currentYear")), 
        date("m/d/Y",strtotime("2 Mondays", mktime(0, 0, 0, 10, 1, $currentYear))), 
        date("m/d/Y",mktime(0, 0, 0, 11, 11, $currentYear)), 
        date("m/d/Y",strtotime("4 Thursdays", mktime(0, 0, 0, 11, 1, $currentYear))), 
        date("m/d/Y",mktime(0, 0, 0, 12, 25, $currentYear))
    ];
    
    $cycle = $interval["$frequecy"] * $one_day_sec;
    $enddate= $resStart + ($payments * $cycle);
    $i = 1;
    while (in_array($enddate, $holidays)) {
        $i++;
        $enddate = date('m/d/Y', strtotime($enddate . ' +' . $i . ' Weekday'));
    }
    
    
}
*/
