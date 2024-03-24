<?php
include('../php/class.user.php');
$user = new User();

	$clientid = $_GET['id'];
	
	if(isset($_POST['confirmedcancellation'])){
		$result = $user->cancelGLofClient($_GET['trans_id']);

		if($result){
			echo "<script>alert('GL Successfully Cancelled!');</script>";
			echo "<script>window.location='home.php';</script>";
			echo "<meta http-equiv='refresh' content='0'>";
		}
		else{
			echo "<script>alert('Sorry Error Occurred in the Cancellation Process!');</script>";
			echo "<script>window.location='home.php';</script>";
			echo "<meta http-equiv='refresh' content='0'>";
		}
	}

	$getClient = $user->show_client_data_for_cancellation_of_gl($clientid);
?>
<?php
	if(!$_SESSION['login']){
		header('Location:../index.php');
		}

?>
<!DOCTYPE html>
<html>
	<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
	<div class="body">
	  <form class="form-group" action="cancelclientGL.php?trans_id=<?php echo $getClient['trans_id'] ?>" method="POST">
	 	<div class="modal-body">
			<h4 class="text-center">Are you sure to cancel <?php echo '"'. $getClient['firstname'] ." ". (!empty($getClient['middlename'])?$getClient['middlename'][0].'.':'')  ." ". $getClient['lastname'] ." ". (!empty($getClient['extraname'])?$getClient['extraname']:'') .'" '; ?> Guarantee Letter?</h4>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
			<button type="submit" class="btn btn-primary" name="confirmedcancellation">Yes</button>
		</div>
	</form> 	
</body>

</html>