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

function restructureOffer($pmtdate, $pmtnum, $pmtfreq, $resamt, $ressdate, $ressdateEnd){
    $pmtdate = date_format($pmtdate,"l, F jS");
    $resamt = number_format($resamt,2,".",",");
    $ressdate = date_format($ressdate,"l, F jS");
    $ressdateEnd = date_format($ressdateEnd,"l, F jS, Y");
    
    $offer = "Another option we have is what is called a restructure. This allows you to miss your next payment on $pmtdate but increases your payment amount. Meaning that you would have $pmtnum $pmtfreq payments of  $$resamt starting on $ressdate, and ending on  $ressdateEnd.";
    
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

function checkState($id){
    if (!empty($id)) {
        include 'dbh.inc.php';
        $st_check = "SELECT * FROM servicing_states WHERE id='$id'";
        $state_check = mysqli_query($conn, $st_check);
        $rows_check = mysqli_num_rows($state_check);
        if ($rows_check>0) {
        	$row_check = mysqli_fetch_array($state_check);
        	$state_status = $row_check['state_status'];
        	if ($state_status == "No") {
        		$state_note = "<p>As a friendly reminder; unfortunately, we no longer lend in your state.</p>";
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

function statedrop($req = false){
    include 'dbh.inc.php';
    $st = "SELECT * FROM servicing_states ORDER BY state_name ASC";
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
                    <div style='margin-left: 25px;'>
                        <p>
                            Spotloan
                            <br>$ad
                            <br>$city, $state $zip
                        </p>
                    </div>
                ";
            }else {
                $address = "
                    <div style='margin-left: 25px;'>
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

function pmtcancelation($code, $date, $amt, $nxtpmt){
    $date = date_create($date);
    $date = date_format($date,"l, F jS");
    $amt = "$".number_format($amt,2,".",",");
    $script = "I have cancelled your ";
    
    if ($code == 1) {
      //payoff
      $script .= "payoff in the amount of $amt that was scheduled for $date.";
    }
    if ($code == 2) {
        //Extra Payment
        $script .= "extra payment in the amount of $amt that was scheduled for $date.";
    }
    if ($code == 3) {
        //double payment
        $script .= "double payment in the amount of $amt that was scheduled for $date.";
    }
    if ($code == 4) {
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

function nxtpendingcheck(){
    ?>
    <div class="row">
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
            As a friendly reminder, your next scheduled payment of $<?php echo number_format($nextpmtamt,2,".",",");?> will be due on <?php echo date_format($nextpmtdate,"l, F jS");?>.
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
            $pmtdate = date_format($pmtdate,"l, F jS");
            $script = "The last payment that we received from you was on $pmtdate for $pmtAmt";
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

function soldfind($LAPro){
    if (!empty($LAPro)) {
       include 'dbh.inc.php';
       $slq = "SELECT soldlist.Loan_ID, soldlist.Buyer, debtsalebuyers.Name, debtsalebuyers.PhoneNumber, soldlist.Sold_Date FROM soldlist, debtsalebuyers WHERE soldlist.Buyer = debtsalebuyers.Code AND soldlist.Loan_ID='$LAPro'";
		$slq_result = mysqli_query($conn, $slq);
		
		if(mysqli_num_rows($slq_result) != 0){
			$row = mysqli_fetch_array($slq_result);
			$AgencyAbr =$row[1];
			$Agency = $row[2]; 
			$phone = $row[3];
			$soldDate = date_create("$row[4]");
			$output = date_format($soldDate,"F jS, Y");
		}else{
		    $output = '</p><div class="alert alert-warning offset25px"><b>Check LA Pro Account number, This loan was not found on the Database.</b></div><p>';
		}
        $conn->close();
    }else{
        $output = '</p><div class="alert alert-warning offset25px"><b>Check LA Pro Account number, This loan was not found on the Database.</b></div><p>';
    }
    return $output;
}

function brwname($name){
    $name = htmlspecialchars(trim($name));
    $name = ucfirst($name);
    $script = 
    "
    <p>Hi $name,</p>
    <br />
    <p>Thank you for contacting Spotloan.</p>
    "
    ;
    return $script;
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