<?php
    include('webcamClass.php');
    $webcam = new Webcam();
    $id ="";
    $do = "";
    if(isset($_GET['id'])){
        echo $id = $_GET['id'];
    }
    if(isset($_GET['do'])){
        echo $do = $_GET['do'];
    }
    echo $webcam->showImage($id, $do); // mao ning mo show sa na save na database
?>