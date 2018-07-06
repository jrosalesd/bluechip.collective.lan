<?php 

error_reporting (E_ALL ^ E_NOTICE);
session_start();

if(isset($userid) && isset($username)){
    header("Location: ../home.php");
}else{
    header('Location:../login.php');
}
