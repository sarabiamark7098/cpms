<?php
include('../php/class.user.php');
$user = new User();

	$userid = $_GET['id'];
 
	$getuser = $user->show_user_data($userid);
    $soc_worker = $user->getuserInfo($userid);
	$fullname = strtoupper($getuser['empfname'] ." ". $getuser['empmname'][0] .". ". $getuser['emplname']);
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

    if(isset($_POST['Add'])){
        $id = $userid;
        $swposition = $_POST['swposition'];
        $license = $_POST['license_no'];
        $expiry = $_POST['expiry_license'];

        $result = $user->updatesw($id, $swposition, $license, $expiry);

        if($result){
            echo "<script>alert('The data has been Updated!');</script>";
			echo "<meta http-equiv='refresh' content='0'>";
            echo "<script>window.location='../socialwork/home.php';</script>";
        }else{
            echo "<script>alert('Something Went Wrong!');</script>";
			echo "<meta http-equiv='refresh' content='0'>";
            echo "<script>window.location='../socialwork/home.php';</script>";
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
		<form class="form-group" action="socialwork_license.php?id=<?php echo $userid ?>" method="POST" autocomplete="off">
		<div class="modal-body">
			<div class="row" style="margin-top: 2%; height:10%;">
				<div class="form-group col-lg-8">
					<input value="<?php echo $fullname?>" id="name" name="name" type="text" class="form-control" readonly>
					<label class="active" for="name">Fullname</label>
				</div>
				<div class="form-group col-lg-4">
					<input value="<?php echo $getuser['empid'];?>" id="user_id" name="user_id" type="text" class="form-control" readonly>
					<label class="active" for="user_id">User ID</label>
				</div>
			</div>
			<div class="row" style="margin-top: 1%;";>
				<div class="form-group col-lg-12">
					<input value="<?php echo $soc_worker['emp_position'];?>" id="swposition" name="swposition" type="text" class="form-control mr-sm-2">
					<label class="active" for="swposition">Position</label>
				</div>
				<div class="form-group col-lg-12">
					<input value="<?php echo $getuser['sw_license_no'];?>" id="license_no" name="license_no" type="text" class="form-control mr-sm-2" pattern="^[0-9\-]+$">
					<label class="active" for="license_no">License Number</label>
				</div>
				<div class="form-group col-lg-12">
					<input value="<?php echo $getuser['sw_license_expiry'];?>" id="expiry_license" name="expiry_license" type="date" class="form-control mr-sm-2">
					<label class="active" for="expiry_license">Expiry of License</label>
				</div>
			</div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-primary btn-md submitload" name="Add" value="Submit" onclick="return checkExpiryDate()">      
            	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
			
</form> 	
</body>
<script>
	document.getElementById('license_no').addEventListener('input', function (e) {
		this.value = this.value.replace(/[^0-9\-]/g, '');
	});
	function checkExpiryDate() {
    const expiryInput = document.getElementById('expiry_license');
    const expiryDate = new Date(expiryInput.value);
    const today = new Date();
	console.log(today);
    // Set to start of today to ignore time
    today.setHours(0, 0, 0, 0);

    if (!expiryInput.value) {
        alert("Please select a license expiry date.");
        return false;
    }

    if (expiryDate <= today) {
        alert("The license expiry date is in the past. Please choose a valid future date.");
        return false;
    }

    return true; // allow form submission
}
</script>
</html>