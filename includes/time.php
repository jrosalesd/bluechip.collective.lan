<?php
$current = date("Y");
/*if ($_GET['id']==1) {
    //Alaska Time
    if (strtotime("now") < strtotime("first Sunday of November $current") && strtotime("now")>strtotime("second Sunday of March $current")) {
	    $setDst = 'America/Anchorage';
    }else{
    	$setDst = 'Etc/GMT+9';
    }
    date_default_timezone_set($setDst);
   // echo date(' M jS, Y | h:i A ');
}elseif ($_GET['id']==2) {
    // hawaii time
    date_default_timezone_set('Pacific/Honolulu');
    echo date(' M jS, Y | h:i A');
}elseif ($_GET['id']==3) {
    //Pacific Time
    if (strtotime("now") < strtotime("first Sunday of November $current") && strtotime("now")>strtotime("second Sunday of March $current")) {
	    $setDst = 'PST8PDT';
    }else{
    	$setDst = 'America/Dawson_Creek';
    }
    date_default_timezone_set($setDst);
    //echo date(' M jS, Y | h:i A ');
}elseif ($_GET['id']==4) {
    //Mountain
    if (strtotime("now") < strtotime("first Sunday of November $current") && strtotime("now")>strtotime("second Sunday of March $current")) {
	    $setDst = 'America/Denver';
    }else{
    	$setDst = 'America/Phoenix';
    }
    date_default_timezone_set($setDst);
    echo date(' M jS, Y | h:i A ');
}elseif ($_GET['id']==5) {
    //central time
    if (strtotime("now") < strtotime("first Sunday of November $current") && strtotime("now")>strtotime("second Sunday of March $current")) {
	    $setDst = 'CST6CDT';
    }else{
    	$setDst = 'Canada/Saskatchewan';
    }
    date_default_timezone_set($setDst);
   // echo date(' M jS, Y | h:i A ');
}elseif ($_GET['id']==6) {
    //eastern time
    if (strtotime("now") < strtotime("first Sunday of November $current") && strtotime("now")>strtotime("second Sunday of March $current")) {
	    $setDst = 'EST5EDT';
    }else{
    	$setDst = 'EST';
    }
    date_default_timezone_set($setDst);
   // echo date(' M jS, Y | h:i A ');
}else{*/
session_start();
$userid = $_SESSION['uid'];

include "dbh.inc.php";
$q = "SELECT * FROM users WHERE user_id='$userid'";
$query = mysqli_query($conn, $q);
if (mysqli_num_rows($query)>0) {
    $row=mysqli_fetch_array($query);
    $timezone = trim($row['user_timezone']);
}else{
    $timezone = 5;
}

$q2 = "SELECT * FROM time_zones WHERE id='$timezone'";
    $query2 = mysqli_query($conn, $q2);
    if (mysqli_num_rows($query)>0) {
        $row2=mysqli_fetch_array($query2);
        $usertimezone = trim($row2['timezone']);
    }
date_default_timezone_set($usertimezone);

$conn->close();

echo date('M jS, Y | h:i A');
