<?php
$servername = "127.0.0.1";
$username = "bcfdev";
$password = "DhzEkDESpVkK4Q6R";
$database = "bcfdev";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
exit();
}
//*echo "Connected successfully (".$conn->host_info.")";
