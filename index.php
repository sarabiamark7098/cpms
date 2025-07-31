<?php
	require('php/class.user.php');
	
	$user = new User();

	if (isset($_GET['confirm_id'])) {
		
		$emp_id = $_GET['emp_id'];
		$confirm_id = $_GET['confirm_id'];
		$requestposition = $_POST['designation'];
		$requestoffice = $_POST['office'];
		
		$user_info = $user->check_user($emp_id);
		$office_id = $user_info['office_id'];
		$position = $user_info['position'];
		if($office_id == $requestoffice && $position == $requestposition){
			echo "<script type='text/javascript'>alert('No Changes Detected!');</script>";
		} else {
			$validation = $user->validateid($confirm_id);
			if($validation < 1){

				$result = $user->insert_request($confirm_id, $requestposition, $requestoffice);
				
				if($result){
					echo "<script type='text/javascript'>alert('Request Submitted! Wait for Admin Confirmation.');</script>";		
				}else{
					echo "<script type='text/javascript'>alert('Error!! Try Again');</script>";		
				}
			}else{
				echo "<script type='text/javascript'>alert('Wait For Confirmation!');</script>";		
			}

		}
		
		echo "<script>window.location='index.php';</script>";	
	}

	if(isset($_POST['close'])){
		echo "<script>window.location='index.php';</script>";
		session_destroy();
	}elseif(isset($_POST['request_confirmation_cancel'])){
		echo "<script>window.location='index.php';</script>";
		session_destroy();
	}

	if(isset($_POST['proceedDesignation'])){
		switch ($_SESSION['position']){
			case 'Encoder': 
					$user->login_log();
					echo "<script>window.location='encoder/home.php'</script>";
					break;
			case 'Social Worker': 
					$user->login_log();
					echo "<script>window.location='socialwork/home.php'</script>";
					break;
			case 'Admin': 
					$user->login_log();
					echo "<script>window.location='admin/home.php'</script>";
					break;
			default:
				 echo "<script>window.location='index.php';</script>";
		}
	}
	
	if (isset($_REQUEST['login'])) {
		extract($_REQUEST);
		
		$username = $_POST['username'];
		$password = $_POST['password'];
		
	    $login = $user->check_login($username, $password);
	  
		if ($login) {
			$user_id = $user->getUserId($username, $password);
			$user_info = $user->check_user($user_id);
			$useroffice = $user->show_office_data($user_info['office_id']);
			// echo "<script>confirm('". $user_info['fullname'] ." you are currently Assigned to: ". $useroffice['office_name'] ."')</script>";
			switch ($user_info['position']){
				case 'Encoder': echo '<script>var x = true;
					window.location="index.php?optionenc="+x</script>';
					// echo "<script>window.location='encoder/home.php'</script>";
					$_SESSION['login'] = $login;
					$_SESSION['userAccountusername'] = $username;
					$_SESSION['userAccountpassword'] = $password;
					$_SESSION['userId'] = $user_id;
					$_SESSION['position'] = $user_info['position'];
					$_SESSION['userfullname'] = $user_info['fullname'];
					$_SESSION['f_office']=$user_info['office_id'];
					break;
				case 'Social Worker': echo '<script>var x = true;
					window.location="index.php?optionsw="+x</script>';
					// echo "<script>window.location='socialwork/home.php'</script>";
					$_SESSION['login'] = $login;
					$_SESSION['userAccountusername'] = $username;
					$_SESSION['userAccountpassword'] = $password;
					$_SESSION['userId'] = $user_id;
					$_SESSION['position'] = $user_info['position'];
					$_SESSION['userfullname'] = $user_info['fullname'];
					$_SESSION['f_office']=$user_info['office_id'];
					break;
				case 'Admin': echo '<script>var x = true;
					window.location="index.php?optionadmin="+x</script>';
					// echo "<script>window.location='admin/home.php'</script>";
					$_SESSION['login'] = $login;
					$_SESSION['userAccountusername'] = $username;
					$_SESSION['userAccountpassword'] = $password;
					$_SESSION['userId'] = $user_id;
					$_SESSION['position'] = $user_info['position'];
					$_SESSION['userfullname'] = $user_info['fullname'];
					$_SESSION['f_office']=$user_info['office_id'];
					break;
				default:
					// echo "<script>window.location='index.php';</script>";
			}
		}
		echo '<center>
		<div id="user-alert" class="alert-Danger" style="padding: 15px;">
			<strong>User not Found!</strong>
		</div>
		</center>
		<script>
		setTimeout(function() {
			var alertBox = document.getElementById("user-alert");
			if (alertBox) {
			alertBox.style.display = "none";
			}
		}, 3000); // 10 seconds = 10000 milliseconds
		</script>';
	}
	
	if(isset($_REQUEST['save'])){
		extract($_REQUEST);
			$password_partial = $_POST['password_partial'];
			$password_final = $_POST['password_final'];

			if($password_partial === $password_final){
			$emp_id = $_POST['emp_id'];
			$fullname = $_POST['fullname'];
			$position = $_POST['position'];
			$initials = $_POST['initials'];
			$username = $_POST['username'];
			$password = $_POST['password_partial'];
			
			$insert = $user->get_users_data($emp_id, $fullname, $position, $username, $password, $initials);
			if($insert){
				echo "<script>alert('User Successfully Added!');</script>";
				echo "<script>window.location='index.php';</script>";
				echo "<meta http-equiv='refresh' content='0'>";
			}
			else{
				echo "<script>alert('Sorry Error Occurred While Adding!');</script>";
				echo "<script>window.location='index.php';</script>";
				echo "<meta http-equiv='refresh' content='0'>";
			}
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>DSWD Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-b-160 p-t-50">
					<form class="login100-form validate-form" method="POST" action="index.php">
						<span class="login100-form-title" style="margin-bottom:10%;">
						<img class="responsive-img" src="images/dswd-logo_final.png" height=110 width=370 >
						<div class="section"></div>
						</span>
							
						<span class="login100-form-title p-b-43">
							<b>CIU Processing and Monitoring System</b>
						</span>
						
						<div class="wrap-input100 rs1 validate-input" data-validate = "Username is required">
							<input class="input100" type="text" name="username">
							<span class="label-input100">Username</span>
						</div>
						
						
						<div class="wrap-input100 rs2 validate-input" data-validate="Password is required">
							<input class="input100" type="password" name="password">
							<span class="label-input100">Password</span>
						</div>

						<div class="container-login100-form-btn">
							<button class="login100-form-btn" type="submit" data-toggle="modal" name="login">
								Sign in
							</button>
							<button class="login1000-form-btn" type="button" data-toggle="modal" data-target="#ModalRegister" name="register">
								Request
							</button>
						</div>

						<div class="text-center w-full p-t-23">
							<a href="cpms_verification" class="txt1">
								Go to Offline Verification
							</a>
						</div>
					</form>
			</div>
		</div>
	</div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

	<div class="modal hide fade" id="ModalRegister" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
            	<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Enter Your Information</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form class="form-group" action="index.php" id="submitted" method="POST">
					<div class="modal-body">
						<label>Search Name</label>
						<!-- <form action="index.php" method="post"> -->
							<input class="form-control border border-black" type="text" name="search_emp" id="search_emp" placeholder="Search"></input>
							<!-- <button type="submit" name="request_add_emp">Search</button>
						</form> -->
						<div>
							<table id="admintable" class="table table-fixed table-striped table-hover highlight responsive-table" style="width: 100%; margin: 2% 0% 0% 0%;">
								<thead>
									<tr>
									<!-- <th scope="col" style='width: 15%'>Employee ID</th> -->
									<th scope="col" style='width: 20%'>Last Name</th>
									<th scope="col" style='width: 20%'>First Name</th>
									<th scope="col" style='width: 20%'>Middle Name</th>
									<th scope="col" style='width: 5%'>Ext.</th>
									<th scope="col" style="width: 15%">Action</th>
									</tr>
								</thead>
								<tbody id="search_emp_result">
									
								</tbody>
							</table>
						</div>
					</div>
					<div class="modal-footer">
					</div>
				</form>
			</div>
        </div>
    </div>

	<script>
		$(document).ready(function(){
			$('#search_emp').keyup(function(){  //On pressing a key on "Search box". This function will be called
				var txt = $('#search_emp').val(); //Assigning search box value to javascript variable.
				// console.log(txt);
				if(txt != ''){ //Validating, if "name" is empty.
					$.ajax({
						type: "post", //method to use
						url: "fetchdata.php", //ginapasa  sa diri nga file and data
						data: {search:txt}, //mao ni nga data
						success: function(html){  //If result found, this funtion will be called.
							$('#search_emp_result').html(html).show();  //Assigning result to "#result" div.
						}
					});
				}else{
				$('#search_emp_result').html(""); //Assigning no result to "result" div.
				}
			});
		});
	</script>

	<div class="modal hide fade" id="Requesting_userAccess" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
            	<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Confirm Employee Request Data</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form class="form-group" action="index.php" method="POST">
					<div class="modal-body2">`
						
					</div>
				</form>
			</div>
        </div>
    </div>

	<?php 
		if(isset($_GET['optionenc'])||isset($_GET['optionsw'])||isset($_GET['optionadmin'])){
			echo '<script>  var x=  1 </script>';
		}else{

			echo '<script>  var x=  0 </script>';
		}
		
		if(isset($_POST['Request_change'])){
			echo '<script>  var y=  1;</script>';
		}else{
			$_SESSION['Request_change'] = "";
			echo '<script>  var y=  0; </script>';
		}	 	
	?>
	<div class="container">
  <!-- Trigger the modal with a button -->
  
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <!-- Modal content-->
		<div class="modal-content">
			<form class="form-group" action="index.php" method="POST">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">User Access</h5>
					<button type="button" name="close" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?php $officedata = $user->show_office_data($_SESSION['f_office']);?>
				<div class="modal-body3">
					<div class="container" style="padding:50px 70px">
						<center><h3><?php echo "<b>". $_SESSION['userfullname'] ."</b> <br>you are currently assigned in <br><b style='color:red'>". $officedata['office_name'] ." </b><br> as <b style='color:red'>".$_SESSION['position'] ."</b>.<br><br>Do you want to <b>Proceed</b> or <br><b>Request</b> to change Office/User Type?" ?></h3></center>
					</div>
				</div>
				<div class="modal-footer">
					<button type='submit' name='proceedDesignation' class='btn btn-<?php echo (empty($_SESSION['f_office']) || empty($_SESSION['position']))?'dark':'success' ?>' style="font-size:20px" <?php echo empty($_SESSION['f_office'])?'disabled':'' ?>> Proceed </button>
					<button type='submit' name='Request_change' class='btn btn-primary deep-sky' style="font-size:20px"> Request </button>
					<button type="submit" name="close" class='btn btn-secondary' style="font-size:20px">Close</button>
				</div>
				</div>
			</form>
		</div>
    </div>
  </div>
  
</div>
<script>
	if(x == 1){
		$('#myModal').modal('show');
		// console.log(x);
	}
</script>
	<div class="modal fade" id="request_modal" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
            	<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Employee Request</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body4">
					<?php $empdata = $user->getEmpData($_SESSION['userId']);?>
					<form action='index.php?confirm_id=<?php echo $empdata["empnum"]; ?>&emp_id=<?php echo $empdata["empid"]; ?>' method='POST'>
						<div class="modal-body">
							<div class="container" style="padding:20px 40px">
								<h5 style='text-align:center'><b>Employee Number:&nbsp <?php echo $empdata['empnum'] ?></b></h5><br>
								<h5 style='text-align:center'><b>Name:&nbsp <?php echo $_SESSION['userfullname'] ?></b></h5><br>
								<div class="row">
									<div class="form-group col-lg-6">
										<select id="designation" name="designation" type="text" class="form-control" required>
											<option value="" <?php echo ($empdata['position'] == ''?"selected":"") ?>>Select Designation</option>
											<?php if ($empdata['position'] == 'Admin'){ ?><option value=<?php echo ($empdata['position'] == 'Admin'?"Admin":"") ?> selected> <?php echo ($empdata['position'] == 'Admin'?"Admin":"") ?> </option><?php } ?>
											<option value="Encoder" <?php echo ($empdata['position'] == 'Encoder'?"selected":"") ?>>Encoder</option>
											<option value="Social Worker" <?php echo ($empdata['position'] == 'Social Worker'?"selected":"") ?>>Social Worker</option>
										</select>
										<label class="active" for="designation">Designate Position</label>
									</div>
									<div class="form-group col-lg-6">
										<select id="office" name="office" type="text" class="form-control" required>
										<option value="" selected></option>
											<?php
											$getoffice = $user->optionoffice();
												//Loop through results
											foreach($getoffice as $index => $value){
												//Display info
												echo '<option value="'. $value['office_id'] .'" '. (($empdata['office_id']==$value['office_id'])?"selected":"") .'> ';
												echo $value['office_name'];
												echo '</option>';
											}
										?>
										</select>
										<label class="active" for="office">Designate Office</label>
									</div>
								</div>
							</div>
						</div>
						<div class='modal-footer'>
							<button type='submit' id="r_confirmation" name='request_confirmation' class='btn btn-primary deep-sky'> Confirm </button>		
						</div>	
					</form>
				</div>
			</div>
        </div>
    </div>
<script>
	if(y == 1){
		$('#request_modal').modal('show');
		
	}
</script>
</body>
</html>