<?php
include('../php/class.user.php');
$user = new User();

	$userid = $_GET['id'];
 
	$getuser = $user->show_user_data($userid);
	$fullname = strtoupper($getuser['empfname'] ." ". $getuser['empmname'][0] ." ". $getuser['emplname']);
	$initials = "";
	if(!empty($getuser['empfname'])){
		$firstname = explode(" ",$getuser['empfname']);
		if(!empty($firstname[2])){
			$initials = strtoupper($firstname[0][0]."".$firstname[1][0]."".$firstname[2][0]);
		}elseif(!empty($firstname[1])){
			$initials = strtoupper($firstname[0][0]."".$firstname[1][0]);
		}else{
			$initials = strtoupper($firstname[0][0]);
		}
	}
	
	if(!empty($getuser['empmname'])){
		$middlename = explode(" ",$getuser['empmname']);
		if(!empty($middlename[0])){
			$initials .= strtoupper($middlename[0][0]);
		}
	}


	if(!empty($getuser['emplname'])){
		$lastname = explode(" ",$getuser['emplname']);
		if(!empty($lastname[2])){
			$initials .= strtoupper($lastname[0][0]."".$lastname[1][0]."".$lastname[2][0]);
		}elseif(!empty($lastname[1])){
			$initials .= strtoupper($lastname[0][0]."".$lastname[1][0]);
		}else{
			$initials .= strtoupper($lastname[0][0]);
		}
	}

?>
<?php
	if(!$_SESSION['login']){
		header('Location:../index.php');
		}

?>
<!DOCTYPE html>
<html>
	<body>
		<form class="form-group" action="userAccount.php" method="POST">
		<div class="modal-body">
			<div class="row form-group" >
				<div style="float: right;">
				<img class="responsive-img" src="../images/no_avatar.gif" style="width: 40%; border-radius: 50%; margin-left: 20%;">
				</div>
				
				<div class="form-group col align-self-end">
					<input value="<?php echo $getuser['empid'];?>" id="user_id" name="user_id" type="text" class="form-control" readonly>
					<label class="active" for="user_id">User ID</label>
				</div>
			</div>
			<div class="row" style="margin-top: 2%; height:10%;">
				<div class="form-group col-lg-6">
					<input value="<?php echo $fullname?>" id="name" name="name" type="text" class="form-control" readonly>
					<label class="active" for="name">Fullname</label>
				</div>
				<div class="form-group col-lg-6">
					<input value="<?php echo $initials?>" id="initial" name="initial" type="text" class="form-control " readonly>
					<label class="active" for="initial">Name initial</label>
				</div>
			</div>
			<div class="row" style="margin-top: 2%; height:10%";>
				<div class="form-group col-lg-2">
				</div>
				<div class="form-group col-lg-8">
					<input value="<?php echo $getuser['position'];?>" id="position" name="position" type="text" class="form-control mr-sm-2" readonly>
					<label class="active" for="position">Position</label>
				</div>
				<div class="form-group col-lg-2">
				</div>
			</div>
			<div class="row" style="margin-top: 2%; height:10%";>
				<div class="form-group col-lg-2">
				</div>
				<div class="form-group col-lg-8">
					<input value="<?php echo $user->get_office_name($getuser['office_id']) ?>" id="office" name="office" type="text" class="form-control mr-sm-2" readonly>
					<label class="active" for="office">Office Designated</label>
				</div>
				<div class="form-group col-lg-2">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
			
</form> 	
</body>
</html>