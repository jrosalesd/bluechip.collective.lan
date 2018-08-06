<?php
$id = $_GET['id'];
$pass_status = 0;

function RandomString(15) {
    $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_-&%)(+=$#@!!#$%&'()*+,-./:;<=>?@[\]^_`{|}~";
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

if (isset($_GET['id'])) {
    include 'dbh.inc.php';
    $password= RandomString();
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