<!DOCTYPE html>
<html lang="en">
<head>

</head>
<body>

	<form action="maoni.php" method="post">
        Amount:<input name="amount" type="text"> <br><br>
        ID: <input name="id" type="number"><br>
        <button type="submit" name="save">GO !!!</button>
    </form>
	
</html>

<?php
    if(isset($_POST['save'])){
        $con = mysqli_connect("172.26.126.103:3361", "root", "root", "cpms");
        $amount = mysqli_real_escape_string($con,$_POST['amount']); 
        $id = $_POST['id'];

        echo $id;

        //echo $amount ."<br>". $id;
        //potang_ina($amount, $id);
    }


    function potang_ina($amount, $id){
        $con = mysqli_connect("172.26.126.103:3361", "root", "root", "cpms");
        $sqlquery="UPDATE assistance SET amount1='{$amount}' WHERE client_id={$id}";
        //checking if the username is available in the table
        $result = mysqli_query($con,$sqlquery);
        
        if($result){
            echo "<script>alert('POTANG INA!')</script>";
        }else{
            echo "<script>alert('WA mn pod!')</script>";
        }

    }

?>