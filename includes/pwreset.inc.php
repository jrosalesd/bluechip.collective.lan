<?php
//Files to include
include "functions.inc.php"; 

$id = $_GET['id'];
$pass_status = 0;


if (isset($_GET['id'])) {
    include 'dbh.inc.php';
    $password= ResetPass(15);
    $pwhashed = password_hash($password,PASSWORD_DEFAULT);
    $q = "UPDATE users SET user_password='$pwhashed', user_pass_status='$pass_status' WHERE user_id='$id'";
    $reset = mysqli_query($conn, $q);
    if ($reset) {
        header("Location: ../signup.php?c=1&id=$id&error= The new temporary password is: $password");
        exit();
    }else{
        header("Location: ../signup.php?c=1&id=$id&error= Please try again unable to reset Password");
        exit();
    }
    $conn->close();
}else {
    header("Location: ../signup.php");
    exit();
}