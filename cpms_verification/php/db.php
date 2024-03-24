<?php
    $conn = mysqli_connect("localhost", "root", "", "37fms");
    //Check connection
    if(mysqli_connect_errno()){
        echo "Failed to connect:".mysqli_connect_errno();
    }
?>