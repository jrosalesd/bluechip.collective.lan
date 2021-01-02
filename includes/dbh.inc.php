<?php
$servername = "b19dx79besr4dzgofo82-mysql.services.clever-cloud.com";
$username = "uu9f220rkktl0rpm";
$password = "uu9f220rkktl0rpm";
$database = "b19dx79besr4dzgofo82";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
exit();
}
//*echo "Connected successfully (".$conn->host_info.")";
