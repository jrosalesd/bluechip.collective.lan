<?php

error_reporting (E_ALL ^ E_NOTICE);
	session_start();
    $userid = $_SESSION['uid'];
    $SysName = $_SESSION['SysName'];
    if (isset($_POST['pass_change'])) {
        if (!isset($userid)) {
            header("Location: ../index.php");
        }
        include "dbh.inc.php";
        $pass = mysqli_real_escape_string($conn, $_POST['user_pass']);
        $pass_retype = mysqli_real_escape_string($conn, $_POST['user_pass_repeat']);
        $pass_status = 1;
        
        if ($pass===$pass_retype) {
            $pwhashed = password_hash($pass,PASSWORD_DEFAULT);
            $q="UPDATE users SET user_password='$pwhashed', user_pass_status='$pass_status' WHERE user_id='$userid'";
            $reset = mysqli_query($conn, $q);
            if ($reset) {
                session_unset();
                session_destroy();
                header("Location: ../login.php?login=Please Log In");
                exit();
            }
        } else {
            header("Location: ../passreset.php?msg=Your Password does not Match");
            exit();
        }
    }
        
    
    
    