<?php

$servername = "172.31.176.103:3361";
$username = "root";
$password = "p1p0-DSWD123";
$database ="cpmsdatabase2020";
// Create connection
$conn = mysqli_connect($servername, $username, $password,$database);


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

?>