	
<?php
	require("class.user.php");
	
	$user = new User;

	$result = $user->cleardup();
	if($result){
		$user->cleardup();
		header('Location: ../admin/home.php');
	}else{
		echo "<script>alert('Error 404')</script>";
	}
?> 	 	