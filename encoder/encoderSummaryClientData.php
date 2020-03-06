<?php
include('../php/class.user.php');
$user = new User();

	$clientid = $_GET['id'];
	$_SESSION['myid'] = $clientid;

	
	$getClient = $user->show_client_data($clientid);
	
	$getEncoderName = $user->getEncoder($getClient['encoded_encoder']);
	$sw_id = $getClient['encoded_socialWork'];
	
	$getSocialworkName = $user->getsocialWork($sw_id);
	
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
	</head>
	<body>
	<div class="body">
	  <form class="form-group" action="encoderSummaryClientData.php" method="POST">
		<div class="modal-body">
			 <div class="row form-group" >
				<div style="float: right;">
				 <img class="responsive-img" src="../images/no_avatar.gif" style="width: 40%; border-radius: 50%; margin-left: 20%;">
				</div>
				
				<div class="form-group col align-self-end">
				  <input value="<?php echo $getClient['client_id'];?>" id="client_id" name="client_id" type="text" class="form-control" readonly>
				  <label class="active" for="client_id">Client ID</label>
				</div>
			</div>
			<div class="row form-group" style="margin-top: 2%; height:10%;">
				<div class="form-group col-lg-6">
				  <input value="<?php echo $getClient['date_entered'];?>" id="dateEn" name="dateEn" type="datetime" class="form-control" readonly>
				  <label class="active" for="name">Date of filing started</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $getClient['date_accomplished'];?>" id="dateaccomplished" name="dateaccomplished" type="datetime" class="form-control" readonly>
				  <label class="active" for="dateAccomplished">Date of Filing Finished</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $getEncoderName;?>" id="enteredby" name="eneteredby" type="text" class="form-control " readonly>
				  <label class="active" for="enteredby">Encoded by</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo empty($getSocialworkName)?"":$getSocialworkName ?>" id="assessby" name="assessby" type="text" class="form-control " readonly>
				  <label class="active" for="enteredby">Assessed by</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $getClient['client_no'];?>" id="clientNo" name="clientNo" type="text" class="form-control mr-sm-2" readonly>
				  <label class="active" for="clientnum">Client Service Code</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $getClient['client_region'];?>" id="region" name="region" type="text" class="form-control" readonly>
				  <label class="active" for="region">Region</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $getClient['client_province'];?>" id="province" name="province" type="text" class="form-control" readonly>
				  <label class="active" for="province">Province</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $getClient['client_municipality'];?>" id="cityMun" name="cityMun" type="text" class="form-control" readonly>
				  <label class="active" for="city/municipality">City/Municipality</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $getClient['client_barangay'];?>" id="barangay" name="barangay" type="text" class="form-control" readonly>
				  <label class="active" for="barangay">Barangay</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $getClient['client_district'];?>" id="district" name="district" type="text" class="form-control" readonly>
				  <label class="active" for="district">District</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $getClient['client_street'];?>" id="street" name="street" type="text" class="form-control" readonly>
				  <label class="active" for="street">Street/Purok</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $getClient['lastname'];?>" id="lastname" name="lastname" type="text" class="form-control" readonly>
				  <label class="active" for="lastname">Lastname</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $getClient['firstname'];?>" id="firstname" name="firstname" type="text" class="form-control" readonly>
				  <label class="active" for="firstname">Firstname</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $getClient['middlename'];?>" id="middlename" name="middlename" type="text" class="form-control" readonly>
				  <label class="active" for="middlename">Middlename</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $getClient['extraname'];?>" id="extraname" name="extraname" type="text" class="form-control" readonly>
				  <label class="active" for="extraname">Extraname</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $getClient['civil_status'];?>" id="civil" name="civil" type="text" class="form-control" readonly>
				  <label class="active" for="civilStatus">Civil Status</label>
				</div>
				
				<div class="form-group col-lg-6">
				  <input value="<?php echo $getClient['date_birth'];?>" id="dob" name="dob" type="text" class="form-control" readonly>
				  <label class="active" for="dateBirth">Date Birth</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $getClient['age'];?>" id="age" name="age" type="text" class="form-control" readonly>
				  <label class="active" for="age">Age</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $getClient['mode1'];?>" id="moa" name="moa" type="text" class="form-control" readonly>
				  <label class="active" for="modeofadmission">Mode of Admission</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $getClient['type1'];?>" id="toa" name="toa" type="text" class="form-control" readonly>
				  <label class="active" for="typeofassistance">Type of Assistance 1</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $getClient['amount'];?>" id="amount" name="amount" type="text" class="form-control" readonly>
				  <label class="active" for="amount">Amount 1</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $getClient['fund1'];?>" id="sourceoffund" name="sourceoffund" type="text" class="form-control" readonly>
				  <label class="active" for="sourceoffund">Source of Fund 1</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $getClient['occupation'];?>" id="occupation" name="occupation" type="text" class="form-control" readonly>
				  <label class="active" for="sourceoffund">Occupation</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $getClient['salary'];?>" id="salary" name="salary" type="text" class="form-control" readonly>
				  <label class="active" for="sourceoffund">Salary</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $getClient['contact'];?>" id="contact" name="contact" type="text" class="form-control" readonly>
				  <label class="active" for="sourceoffund">Contact</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $getClient['category'];?>" id="category" name="category" type="text" class="form-control" readonly>
				  <label class="active" for="sourceoffund">Category</label>
				</div>
				
				<div class="form-group col-lg-6">
				  <input value="<?php echo $getClient['subCategory'];?>" id="subcategory" name="subcategory" type="text" class="form-control" readonly>
				  <label class="active" for="sourceoffund">Subcategory</label>
				</div>
				
				
				<label data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
					<h5>&emsp;Beneficiary's Information&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</h5>
				</label>
			
				
				<div class="form-group col-lg-6">
				  <input value="<?php echo $getClient['relation_client']?>" id="subcategory" name="subcategory" type="text" class="form-control" readonly>
				  <label class="active" for="sourceoffund">Relationship to Client</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $getClient['b_lname'].", ".$getClient['b_fname'].", ".$getClient['b_mname']." ". $getClient['b_exname'];?>" id="fullname" name="fullname" type="text" class="form-control" readonly>
				  <label class="active" for="fullname">Fullname</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $getClient['b_civilStatus']?>" id="cs" name="cs" type="text" class="form-control" readonly>
				  <label class="active" for="civilstatus">Civil Status</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $getClient['b_contact']?>" id="con" name="con" type="text" class="form-control" readonly>
				  <label class="active" for="contact">Contact</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $getClient['b_bday']?>" id="dob" name="dob" type="text" class="form-control" readonly>
				  <label class="active" for="dateofbirth">Date Birth</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $getClient['b_age']?>" id="age" name="age" type="text" class="form-control" readonly>
				  <label class="active" for="age">Age</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $getClient['b_sex']?>" id="sex" name="sex" type="text" class="form-control" readonly>
				  <label class="active" for="sex">Sex</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $getClient['b_region']?>" id="region" name="region" type="text" class="form-control" readonly>
				  <label class="active" for="region">region</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $getClient['b_province']?>" id="pro" name="pro" type="text" class="form-control" readonly>
				  <label class="active" for="province">Province</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $getClient['b_citymun']?>" id="subcategory" name="subcategory" type="text" class="form-control" readonly>
				  <label class="active" for="city">Municipality/City</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $getClient['b_barangay']?>" id="brgy" name="brgy" type="text" class="form-control" readonly>
				  <label class="active" for="barangay">Barangay</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $getClient['b_street']?>" id="st" name="st" type="text" class="form-control" readonly>
				  <label class="active" for="street">Street/Purok</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $getClient['b_category']?>" id="cat" name="cat" type="text" class="form-control" readonly>
				  <label class="active" for="category">Category</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $getClient['b_subCategory']?>" id="subcat" name="subcat" type="text" class="form-control" readonly>
				  <label class="active" for="subcategory">Subcategory</label>
				</div>
				
				
				</div>
			
			</div>
				  
		</div>
			<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<?php
					if($getClient['enc_soc'] === 'pass'){
							echo "<button type='submit' class='btn btn-primary' name='pass'>Pass</button>";
						}else{
							echo "<button type='submit' class='btn btn-primary' name='pass' disabled> Passed</button>";
						}
					?>
				</div>
        </form> 		
		
	</div>
</body>
</html>