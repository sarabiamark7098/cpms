	
<?php
	require("class.user.php");
	
	$user = new User;

	$result = $user->user_logout();
	if($result){
		$user->user_logout();
		header('Location: ../index.php');
	}else{
		echo "<script>alert('Error 404')</script>";
	}
?> 	 	