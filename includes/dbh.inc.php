<?php
$servername = "127.0.0.1";
$username = "juliorosales";
$password = "Honduras2017";
$database = "members";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
exit();
}
//*echo "Connected successfully (".$conn->host_info.")";
