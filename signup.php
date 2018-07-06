<?php
$page_name = "Users";
include 'header.php';

//if ($seclevel>2) {
//    header("Location: home.php");
//}
$msg = $_GET['msg'];

?>
<?php
if (isset($_GET['c'])) {
    if($_GET['c']==1){
        include 'profile.signup.php';
    }else{
        if ($_GET['c']==2) {
            include 'edit.signup.php';
        }else{
            
        }
    }
}else {
    include 'main.signup.php';
}
?>
<?php
include 'footer.php';
?>
