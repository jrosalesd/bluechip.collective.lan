<?php
function intWeeks($s, $e){
	$days = $e - $s;
	$weeknum = round($days/7);
	if ($days <= 15) {
		$weeks = "Keep in mind this would add an additional $weeknum weeks of interest at the end of your loan. However, This is still a much cheaper option than skipping your payment altogether.";
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

function NxtPmt($nextpmtdate, $nextpmtamt, $pmtnote){
    if ($pmtnote = "on") {
        ?>
        <p>
            As a friendly reminder, your next schedule payment of $<?php echo number_format($nextpmtamt,2,".",",");?> will be due on <?php echo date_format($nextpmtdate,"l, F jS");?>.
        </p>
        <?php
    }
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
    }
}

function pendingpmt($pmtdate, $pmtAmt,$s){
    $pmtdate =  date_format($pmtdate,"l, F jS");
    $pmtAmt = number_format($pmtAmt,2,".",",");
    if($s){
        $pending = "<p>Keep in mind, this payoff is valid as long as your pending payment from $pmtdate, in the amount of $$pmtAmt clears your bank account successfully.</p>";
    }
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
function nextBD($start) {
    $start=strtotime($start);
    $year = date('Y', $start);
    $tempDate = date('m/d/Y', $start);
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
    $i = 1;
    $nextBusinessDay = date('m/d/Y', strtotime($tmpDate . ' +' . $i . ' Weekday'));
    while (in_array($nextBusinessDay, $holidays)) {
        $i++;
        $nextBusinessDay = date('m/d/Y', strtotime($tmpDate . ' +' . $i . ' Weekday'));
    }
    
    return $nextBusinessDay;
}