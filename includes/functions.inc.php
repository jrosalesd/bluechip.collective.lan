<?php
function intWeeks($s, $e){
	$days = $e - $s;
	$weeknum = round($days/7);
	if ($days <= 15) {
		$weeks = "Keep in mind this would add an additional $weeknum weeks of interest at the end of your loan. However, This is still a much cheaper option than skipping your payment altogether.";
	} else if ($days > 15) {
		$weeks = "If you decide to defer this payment, keep in mind it could potentially add several extra payments to the life of your loan until made in full.";
	}
	return $weeks;
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