<?php
$page_name = "Website Edition Tools";
include 'header.php';
if ($seclevel>2) {
    header("Location: home.php");
}
else{
    header("Location: editor.php");
}
include 'footer.php';
