<?php
include 'dbh.inc.php';

if (isset($_POST['import'])) {
    if ($_FILES['file']['name']){
        // check if file is CSV
        $filename = explode(".", $_FILES['file']['name']);
        if ($filename[1] == 'csv') {
            // get data from file
            $handle = fopen($_FILES['file']['tmp_name'], "r");
            while($data = fgetcsv($handle)){
                $user_first	= mysqli_real_escape_string($conn, $data[0]);
                $user_last = mysqli_real_escape_string($conn, $data[1]);
                $user_shortname	= mysqli_real_escape_string($conn, $data[2]);
                $user_email	= mysqli_real_escape_string($conn, $data[3]);
                $user_role	= mysqli_real_escape_string($conn, $data[4]);
                $user_uid	= mysqli_real_escape_string($conn, $data[5]);
                $user_password	= password_hash(mysqli_real_escape_string($conn, $data[6]),PASSWORD_DEFAULT);
                $user_status = mysqli_real_escape_string($conn, $data[7]);
                $user_sec_profile = mysqli_real_escape_string($conn, $data[8]);
                $sql = "INSERT INTO `users`(user_first, user_last, user_shortname, user_email, user_role, user_uid, user_password, user_status, user_sec_profile) VALUES ('$user_first', '$user_last', '$user_shortname', '$user_email', '$user_role', '$user_uid', '$user_password', '$user_status', '$user_sec_profile')";
                mysqli_query($conn, $sql);
            }
            
            fclose($handle);
            if(is_uploaded_file($_FILES['file']['tmp_name'])){
                header("Location: ../signup.php?msg=Upload successful");
                exit();
            }else {
                header("Location: ../signup.php?msg=Something went wrong, Unable to upload your file ");
                exit();
            }
            
        }else {
            header("Location: ../signup.php?msg=only csv files are allowed");
            exit();
        }
    }else{
        header("Location: ../signup.php?msg=No file selected");
        exit();
    }
}else{
    header("Location: ../signup.php");
}
