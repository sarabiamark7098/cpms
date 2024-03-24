<?php
$servername = "172.31.176.27:3306";
$username = "onse";
$password = "t,fL^C:P2mgNK}e7~!j{GA";
$database ="onse_cpms";


// Create connection
$conn = mysqli_connect($servername, $username, $password,$database);


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

?>