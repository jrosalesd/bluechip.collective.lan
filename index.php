<?php 

error_reporting (E_ALL ^ E_NOTICE);
session_start();

if(isset($userid) && isset($username)){
    if(isset($_SERVER['HTTP_REFERER'])) {
        header('Location: '.$_SERVER['HTTP_REFERER']);  
    } else {  
        header("Location: home.php"); 
    }
    exit;
}else{
    header('Location:login.php');
}
