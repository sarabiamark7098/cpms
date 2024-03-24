<?php
include('../php/class.user.php');
$user = new User();

	$clientid = $_GET['id'];
	$_SESSION['myid'] = $clientid;
	
	if(isset($_POST['update'])){
		$cid = $_POST['client_id'];
		$fname = $_POST['firstname'];
		$lname = $_POST['lastname'];
		$mname = $_POST['middlename'];
		$exname = $_POST['extraname'];
		$civilstatus = $_POST['civil'];
		$bday = $_POST['dob'];
		$occupation = $_POST['occupation'];
		$salary = $_POST['salary'];
		$contact = $_POST['contact'];
		$categ = $_POST['category'];
		$subcateg = $_POST['subcategory'];
		$user->update_client_data($cid,$fname,$lname,$mname,$exname,$civilstatus,$bday,$occupation,$salary,$contact,$categ,$subcateg);
		header("Location:home.php");
	}
	
	$getClient = $user->show_client_data($clientid);
	$_SESSION['clientid'] = $getClient['client_id'];
	$_SESSION['dateEntered'] = $getClient['date_entered'];
	$_SESSION['enteredBy'] = $getClient['fullname'];
	$_SESSION['clientNo'] = $getClient['client_no'];
	$_SESSION['dateAccomplished'] = $getClient['date_accomplished'];
	$_SESSION['region'] = $getClient['region'];
	$_SESSION['province'] = $getClient['province'];
	$_SESSION['cityMun'] = $getClient['municipality'];
	$_SESSION['barangay'] = $getClient['barangay'];
	$_SESSION['district'] = $getClient['district'];
	$_SESSION['lastname'] = $getClient['lastname'];
	$_SESSION['firstname'] = $getClient['firstname'];
	$_SESSION['middlename'] = $getClient['middlename'];
	$_SESSION['extraname'] = $getClient['extraname'];
	$_SESSION['civilStatus'] = $getClient['civil_status'];
	$_SESSION['dateBirth'] = $getClient['date_birth'];
	$_SESSION['age'] = $getClient['age'];
	$_SESSION['modeOfAdmission'] = $getClient['modeOfAdmission'];
	$_SESSION['typeOfAssistance1'] = $getClient['typeOfAssistance1'];
	$_SESSION['amount1'] = $getClient['amount1'];
	$_SESSION['sourceOfFund1'] = $getClient['sourceOfFund1'];
	$_SESSION['occupation'] = $getClient['occupation'];
	$_SESSION['salary'] = $getClient['salary'];
	$_SESSION['contact'] = $getClient['contact'];
	$_SESSION['category'] = $getClient['category'];
	$_SESSION['subcategory'] = $getClient['subCategory'];
	$_SESSION['enc'] = $getClient['enc_soc'];
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
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link rel="icon" type="image/png" href="../images/icons/ciu.ico"/>
		<link rel="stylesheet" type="text/css" href="../css/main.css">
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">	
		<link rel="stylesheet" type="text/css" href="../css/table.responsive.css">
		<link rel="stylesheet" type="text/css" href="../css/coe.css">
		<link rel="stylesheet" type="text/css" href="../css/gis.css">
        <link rel="stylesheet" type="text/css" href="../style5.css">
        
		<script defer src="../js/solid.js"></script>
		<script defer src="../js/fontawesome.js"></script>
		<script src="../js/jquery.slim.min.js"></script>
		<script src="../js/popper.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../js/jquery-3.2.1.slim.min.js"></script>
		<script type="text/javascript" src="../js/main.js"></script>
		<script type="text/javascript" src="../js/PSGC.js"></script>
		<script type="text/javascript" src="../js/jquery.min.js"></script>
		
		<!-- added -->
		
		<link rel="stylesheet" type="text/css" href="../datatables/datatables.css">
		<script type="text/javascript" charset="utf8" src="../datatables/datatables.js"></script>
		<script type="text/javascript" src="../js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../js/bootstrap-3.3.7.min.js"></script>
		<script type="text/javascript" src="../js/jquery.mask.min.js"></script>
	</head>
	<body>
	<div class="body">
	  <form class="form-group" action="updateClientData.php" method="POST">
		<div class="modal-body">
			 <div class="row form-group" >
				<div style="float: right;">
				 <img class="responsive-img" src="../images/no_avatar.gif" style="width: 40%; border-radius: 50%; margin-left: 20%;">
				</div>
				
				<div class="form-group col align-self-end">
				  <input value="<?php echo $_SESSION['clientid'];?>" id="client_id" name="client_id" type="text" class="form-control" readonly>
				  <label class="active" for="client_id">Client ID</label>
				</div>
			</div>
			<div class="row form-group" style="margin-top: 2%; height:10%;">
				<div class="form-group col-lg-6">
				  <input value="<?php echo $_SESSION['dateEntered'];?>" id="dateEn" name="dateEn" type="datetime" class="form-control" readonly>
				  <label class="active" for="name">Date of filing started</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $_SESSION['enteredBy'];?>" id="enteredby" name="eneteredby" type="text" class="form-control " readonly>
				  <label class="active" for="enteredby">Encoded by</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $_SESSION['clientNo'];?>" id="clientNo" name="clientNo" type="text" class="form-control mr-sm-2" readonly>
				  <label class="active" for="clientnum">Client Service Code</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $_SESSION['dateAccomplished'];?>" id="dateaccomplished" name="dateaccomplished" type="datetime" class="form-control" readonly>
				  <label class="active" for="dateAccomplished">Date of Filing Finished</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $_SESSION['region'];?>" id="region" name="region" type="text" class="form-control" readonly>
				  <label class="active" for="region">Region</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $_SESSION['province'];?>" id="province" name="province" type="text" class="form-control" readonly>
				  <label class="active" for="province">Province</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $_SESSION['cityMun'];?>" id="cityMun" name="cityMun" type="text" class="form-control" readonly>
				  <label class="active" for="city/municipality">City/Municipality</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $_SESSION['barangay'];?>" id="barangay" name="barangay" type="text" class="form-control" readonly>
				  <label class="active" for="barangay">Barangay</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $_SESSION['district'];?>" id="district" name="district" type="text" class="form-control" readonly>
				  <label class="active" for="district">District</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $_SESSION['lastname'];?>" id="lastname" name="lastname" type="text" class="form-control" required>
				  <label class="active" for="lastname">Lastname</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $_SESSION['firstname'];?>" id="firstname" name="firstname" type="text" class="form-control" required>
				  <label class="active" for="firstname">Firstname</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $_SESSION['middlename'];?>" id="middlename" name="middlename" type="text" class="form-control" required>
				  <label class="active" for="middlename">Middlename</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $_SESSION['extraname'];?>" id="extraname" name="extraname" type="text" class="form-control">
				  <label class="active" for="extraname">Extraname</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $_SESSION['civilStatus'];?>" id="civil" name="civil" type="text" class="form-control" required>
				  <label class="active" for="civilStatus">Civil Status</label>
				</div>
				
				<div class="form-group col-lg-6">
				  <input value="<?php echo $_SESSION['dateBirth'];?>" id="dob" name="dob" type="text" class="form-control" required>
				  <label class="active" for="dateBirth">Date Birth</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $_SESSION['age'];?>" id="age" name="age" type="text" class="form-control" readonly>
				  <label class="active" for="age">Age</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $_SESSION['modeOfAdmission'];?>" id="moa" name="moa" type="text" class="form-control" readonly>
				  <label class="active" for="modeofadmission">Mode of Admission</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $_SESSION['typeOfAssistance1'];?>" id="toa" name="toa" type="text" class="form-control" readonly>
				  <label class="active" for="typeofassistance">Type of Assistance 1</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $_SESSION['amount1'];?>" id="amount" name="amount" type="text" class="form-control" readonly>
				  <label class="active" for="amount">Amount 1</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $_SESSION['sourceOfFund1'];?>" id="sourceoffund" name="sourceoffund" type="text" class="form-control" readonly>
				  <label class="active" for="sourceoffund">Source of Fund 1</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $_SESSION['occupation'];?>" id="occupation" name="occupation" type="text" class="form-control">
				  <label class="active" for="sourceoffund">Occupation</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $_SESSION['salary'];?>" id="salary" name="salary" type="text" class="form-control">
				  <label class="active" for="sourceoffund">Salary</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $_SESSION['contact'];?>" id="contact" name="contact" type="text" class="form-control">
				  <label class="active" for="sourceoffund">Contact</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $_SESSION['category'];?>" id="category" name="category" type="text" class="form-control">
				  <label class="active" for="sourceoffund">Category</label>
				</div>
				
				<div class="form-group col-lg-6">
				  <input value="<?php echo $_SESSION['subcategory'];?>" id="subcategory" name="subcategory" type="text" class="form-control">
				  <label class="active" for="sourceoffund">Sub Category</label>
				</div>
			</div>
		</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type='submit' class='btn btn-primary' name='update'>Update</button>
			</div>
        </form> 		
		
	</div>
</body>
</html>