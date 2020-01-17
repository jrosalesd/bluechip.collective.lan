<?php
    $id = $_GET['id'];
if( isset($_POST['btnupdate']) ){
    include 'dbh.inc.php';
    $user_first = trim(mysqli_real_escape_string($conn, $_POST['user_first']));
    $user_last = trim(mysqli_real_escape_string($conn, $_POST['user_last']));
    $user_shortname = trim(mysqli_real_escape_string($conn, $_POST['user_shortname']));
    $user_email = trim(mysqli_real_escape_string($conn, $_POST['user_email']));
    $user_role = trim(mysqli_real_escape_string($conn, $_POST['user_role']));
    $user_sec_profile = trim(mysqli_real_escape_string($conn, $_POST['user_sec_profile']));
    $user_timezone = trim(mysqli_real_escape_string($conn, $_POST['user_timezone']));
    
    $q_update ="UPDATE users SET user_first='$user_first', user_last='$user_last', user_shortname='$user_shortname', user_email='$user_email', user_role='$user_role', user_sec_profile='$user_sec_profile', user_timezone='$user_timezone' WHERE user_id='$id'";
    $action=mysqli_query($conn, $q_update);
    if($action){
        header("Location: ../signup.php?c=1&id=$id&error=Congrats! ".ucwords($user_shortname).". was updated Successfuly");
        exit();
    }else{
        header("Location: ../signup.php?c=2&id=$id&error=An error has occured we were unable to update $user_shortname");
        exit();
    }
    $conn->close();
}else{
    if (isset($_POST['statuschange'])) {
        include 'dbh.inc.php';
        $current_state = mysqli_real_escape_string($conn, $_POST['user_status']);
        if ($current_state == 1) {
            $q="UPDATE users SET user_status='0' WHERE user_id='$id'";
            $update = mysqli_query($conn, $q);
            if ($update) {
                header("Location: ../signup.php?c=1&id=$id&error=This user has been deacivated!");
            }else{
                header("Location: ../signup.php?c=2&id=$id&error=Something went Wrong, please try again!");
            }
        }elseif ($current_state == 0) {
            $q="UPDATE users SET user_status='1' WHERE user_id='$id'";
            $update = mysqli_query($conn, $q);
            if ($update) {
                header("Location: ../signup.php?c=1&id=$id&error=User has been successfully Activated!");
            }else{
                header("Location: ../signup.php?c=2&id=$id&error=Something went Wrong, please try again!");
            }
        }
        $conn-close();
        
    }
    else{
    header("Location: ../signup.php");
    exit();
    }
}


