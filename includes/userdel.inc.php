<?php
$id = $_GET['id'];
if (isset($_GET['id'])) {
    include 'dbh.inc.php';
    $q_delete = "DELETE FROM users WHERE user_id=$id";
    $query = mysqli_query($conn, $q_delete);
    if ($query) {
        header("Location: ../signup.php?c=1&id=$id&error=user was deleted successfully");
        exit();
    }else {
        header("Location: ../signup.php?c=1&id=$id&error=something went wrong we could not delete the record");
        exit();
    }
}
?>