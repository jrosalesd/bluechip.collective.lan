<?php
session_start();
$message = "";
if (isset($_GET['login'])) {
   $message = $_GET['login'];
}else {
    $message = "Your Session has been logged off.";
}
$userid = $_SESSION['uid'];
$SysName = $_SESSION['SysName'];
$email = $_SESSION['email'];
$role = $_SESSION['role'];
$username = $_SESSION['username'];
$userstatus = $_SESSION['status'];
session_unset();
session_destroy();
header("Location: ../login.php?login=$message");
exit();
?>