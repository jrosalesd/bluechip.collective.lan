<?php
ob_start();
error_reporting (E_ALL ^ E_NOTICE);
session_start();
$userid = $_SESSION['uid'];
$SysName = $_SESSION['SysName'];
$email = $_SESSION['email'];
$role = $_SESSION['role'];
$username = $_SESSION['username'];
$userstatus = $_SESSION['status'];
$seclevel = $_SESSION['usersec'];
$pass_status = $_SESSION['pass_status'];

//Files to include
include "includes/functions.inc.php"; 
include 'includes/class.inc.php';


if(!isset($userid) && !isset($username)){
   header("Location: login.php?login=Session Timeout, Please Log in!");
}

include "includes/dbh.inc.php"; 
$statuscheck = "SELECT * FROM `users` WHERE user_id=$userid";
$check=mysqli_query($conn, $statuscheck);
$numrows = mysqli_num_rows($check);
if ($numrows > 0) {
    $row = mysqli_fetch_array($check);
    if ($row['user_status'] == 0) {
        header("Location: includes/logout.inc.php?login=Your session has been terminated because your user has been has been disabled");
    }
}
        
$conn->close();

if ($pass_status==0) {
    header("Location: passreset.php");
exit();
}
//set user timezone
include "includes/dbh.inc.php";
$q = "SELECT * FROM users WHERE user_id='$userid'";
$query = mysqli_query($conn, $q);
if (mysqli_num_rows($query)>0) {
    $row=mysqli_fetch_array($query);
    $timezone = $row['user_timezone'];
    $q2 = "SELECT * FROM time_zones WHERE id='$timezone'";
    $query2 = mysqli_query($conn, $q2);
    if (mysqli_num_rows($query)>0) {
        $row2=mysqli_fetch_array($query2);
        $usertimezone = $row2['timezone'];
        date_default_timezone_set($usertimezone);
    }
}

$conn->close();

?>

<html>
    <head>
        <meta charset ="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!--font Awesome-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!--Google Icon-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

        <link rel="stylesheet" type="text/css" href="format/css/style.css"/>
        <link rel="stylesheet" type="text/css" href="format/css/modal.css"/>
        <script src="format/js/script.js" type="text/javascript"></script>
        <script src="format/js/script.dynamic.js" type="text/javascript"></script>
        <script src="format/js/forms.js" type="text/javascript"></script>
        
        <link rel="shortcut icon" href="format/img/icon.png" type="image/png">
        
    </head>
    <style type="text/css">
	    .modal-backdrop {
            /* bug fix - no overlay */    
            display: none;    
        }
        .modal-ku {
          width: 110%;
          margin: auto;
        }
	</style>
        <!- This is the navigation bar. ->
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span> 
                    </button>
                    <a class="navbar-brand" href="home.php">SL Community</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a class="active dropdown-toggle" data-toggle="dropdown" href="#">Email Template
                                <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <?php
                                ?>
                                <li><a href="emails.php?rm">Customer Service</a></li>
                                <li><a href="emails.php?fr">Collection Manager</a></li>
                                <?php
                                if ($seclevel < 2) {
                                    ?>
                                    <li><a href="emails.php"><span class="glyphicon glyphicon-edit"></span> Edit Emails</a></li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </li>
                        <li><a href="tz.php">Time Zone Map</a></li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Call Handling
                                <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="escalate.php">Escalations</a></li>
                                <li><a href="creditcheck.php">Credit Check</a></li>
                                <li><a href="abr.php">Approved Note abbreviation</a></li>
                                <li class="divider"></li>
                                <li class="dropdown-header">Scripts</li>
                                <li><a href="script.php">App Scripts</a></li>
                                <li><a href="vcp.php">VCP Scripts</a></li>
                                <li><a href="deferals.php">Deferrals and Restructures</a></li>
                                <li><a href="vmspill.php">VM Spills</a></li>
                                <li><a href="scrpt.add.php">Additional Scripts</a></li>
                            </ul>
                        </li>
                        <li><a href="spinfo.php">Things To know!</a></li>
                        <li><a href="faq.php">FAQ</a></li>
                        <li><a href="soldlist.php">Sold List</a></li>
                        <li><a data-toggle="modal" data-target="#call" href="#"> Caller Time</a></li>
                        
                        <?php
                        /*if($role == "Collection Manager" || $role == "Manager/Supervisor") 
                        {
                            if ($rowrun['id'] < 3) {
                                ?>
                                <li>
                                    <a href="">Collection Tracker</a>
                                </li>
                                <?php
                            }
                        }*/
                        ?>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="navbar-text" id="today" onload="localtime()"></li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <span class="fa fa-user-circle md-48"></span>
                                <?php echo ucwords($SysName).".";?>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="userprofile.php"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
                                <?php 
                                if($_SESSION['usersec']<3){
                                    ?>
                                    <li><a href="signup.php?statuscheck=active"><span class="fa fa-users"></span> Users</a></li>
                                    <?php
                                }
                                if($_SESSION['usersec']<2){
                                    ?>
                                    <li><a href="editor.php"><span class="glyphicon glyphicon-edit"></span>Site Editor</a></li>
                                    <?php
                                }
                                ?>
                                <li><a href="includes/logout.inc.php"><span class="glyphicon glyphicon-log-out"> Logoff</span></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <br>
        <br>
        <br>
        <br>
        <body class="container" onload="localtime()">