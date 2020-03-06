<?php
	include('../php/class.user.php');
	$user = new User();
?>
<?php
	if(!$_SESSION['login']){
		header('Location:../index.php');
		}
?>
<?php 
    
    if(isset($_GET['id'])){
        if($user->pass($_GET['id'])){
            echo "<script>alert('Client Successfully Passed!');window.location='home.php?p=e'</script>";
        }
        
    }
?>