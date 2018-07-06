<?php
function RandomString($length = 15) {
    $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_-&%)(+=$#@!!#$%&'()*+,-./:;<=>?@[\]^_`{|}~";
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
$pass_preset = RandomString();

if (isset($_POST['usercreate'])) {
    include 'dbh.inc.php';
    $user_first = mysqli_real_escape_string($conn, $_POST['user_first']);
    $user_last = mysqli_real_escape_string($conn, $_POST['user_last']);
    $user_shortname = mysqli_real_escape_string($conn, $_POST['user_shortname']);
    $user_uid = mysqli_real_escape_string($conn, $_POST['user_uid']);
    $user_email = mysqli_real_escape_string($conn, $_POST['user_email']);
    $user_role = mysqli_real_escape_string($conn, $_POST['user_role']);
    $user_sec_profile = mysqli_real_escape_string($conn, $_POST['user_sec_profile']);
    $user_pass = $pass_preset;
    $user_pass_repeat = $user_pass;
    $user_status = mysqli_real_escape_string($conn, $_POST['user_status']);
    $user_timezone = mysqli_real_escape_string($conn, $_POST['user_timezone']);
    $pass_status = mysqli_real_escape_string($conn, $_POST['pass_status']);
    $loc="user_first=".$user_first."&user_last=".$user_last."&user_shortname=".$user_shortname."&user_uid=".$user_uid."&user_email=".$user_email."&user_role=".$user_role."&user_sec_profile=".$user_sec_profile."&user_timezone=".$user_timezone;
    
    $q = "SELECT * FROM users";
    $db_q = mysqli_query($conn, $q);
    $q_numrows = mysqli_num_rows($db_q);
    if ($q_numrows > 0) {
        $row = mysqli_fetch_array($db_q);
        if ($user_uid === $row['user_uid']) {
           header("Location: ../signup.php?message=$user_uid is alredy in use.&$loc");
           exit();
        }elseif ($user_email === $row['user_email']) {
            header("Location: ../signup.php?message=$user_email is alredy in use.&$loc");
            exit();
        }elseif ($user_pass === $user_pass_repeat) {
             $hashedpass = password_hash($user_pass, PASSWORD_DEFAULT);
            $q_create = "INSERT INTO users(user_first, user_last, user_shortname, user_email, user_role, user_uid, user_password, user_status, user_sec_profile, user_timezone, user_pass_status) VALUES ('$user_first', '$user_last', '$user_shortname', '$user_email', '$user_role', '$user_uid', '$hashedpass', '$user_status', '$user_sec_profile','$user_timezone','$pass_status')";
                    $db_q_create = mysqli_query($conn, $q_create);
                if ($db_q_create) {
                    $q_created = "SELECT * FROM users WHERE  user_id=(SELECT MAX(user_id) FROM users)";
                    $q_result = mysqli_query($conn, $q_created);
                    $q_create_numrows = mysqli_num_rows($q_result);
                    if ($q_create_numrows > 0) {
                        $row=mysqli_fetch_array($q_result);
                        $user_new = $row['user_id'];
                        header("Location: ../signup.php?c=1&id=$user_new&error=user successfully created, Temporary password: $user_pass");
                        exit();
                    }
                }else {
                    header("Location: ../signup.php?message=This user may already be on file, please check&$loc");
                    exit();
                }
        }else {
            header("Location: ../signup.php?message=Passwords don't match&$loc");
            exit();
        }
    }
    
    $conn->close();
}else {
    header("Location: ../signup.php?statuscheck=active");
    exit();
}