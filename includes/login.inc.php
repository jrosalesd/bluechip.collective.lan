<?php
    error_reporting (E_ALL ^ E_NOTICE);
	session_start();
    $userid = $_SESSION['uid'];
    $SysName = $_SESSION['SysName'];
    $email = $_SESSION['email'];
    $role = $_SESSION['role'];
    $username = $_SESSION['username'];
    $userstatus = $_SESSION['status'];
    $seclevel = $_SESSION['usersec'];
    $usertimezone =  $_SESSION['timezone'];
    $pass_status = $_SESSION['pass_status'];
    if(isset($_POST['log_in'])){
           include 'dbh.inc.php';
        $user_name = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        if (empty($user_name) || empty($password)) {
           header("Location: ../login.php?login=required: Please enter your Username/Password.");
           exit();
        }else {
           $sql = "SELECT * FROM users WHERE user_uid = '$user_name' OR user_email = '$user_name'";
           $result = mysqli_query($conn, $sql);
           $resultCheck = mysqli_num_rows($result);
           if ($resultCheck < 1) {
                header("Location: ../login.php?login= Username or email not found.");
                exit();
           } else {
               if ($row = mysqli_fetch_array($result)) {
                   // Check if usename is active
                   $user_status = $row['user_status'];
                   $passreset = $row['user_pass_status'];
                   if ($user_status == 0) {
                       header("Location: ../login.php?login=This username is inactive, Contact your Administrator.");
                       exit();
                    }elseif($passreset == 0){
                        $_SESSION['uid'] = $row['user_id'];
                        $_SESSION['SysName'] = $row['user_shortname'];
                        header("Location: ../passreset.php");
                        exit();
                    }else {
                       //Dehash Password
                       $hashedPwdCheck = password_verify($password, $row['user_password']);
                       if($hashedPwdCheck == false){
                            header("Location: ../login.php?login=The password does not match.");
                            exit(); 
                       }elseif ($hashedPwdCheck == true) {
                           //set Session variables
                            $_SESSION['uid'] = $row['user_id'];
                            $_SESSION['SysName'] = $row['user_shortname'];
                            $_SESSION['email'] = $row['user_email'];
                            $_SESSION['role'] = $row['user_role'];
                            $_SESSION['username'] = $row['user_uid'];
                            $_SESSION['status'] = $row['user_status'];
                            $_SESSION['usersec'] = $row['user_sec_profile'];
                            $_SESSION['pass_status'] = $row["user_pass_status"];
                            header("Location: ../home.php");
                            exit();
                       }
                   }
               }
           }
           
        }
    }else{
        header("Location: ../index.php");
        exit();
    }