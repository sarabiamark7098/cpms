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

	if (isset($_REQUEST['login'])) {
		extract($_REQUEST);
		
		$username = $_POST['username'];
		$password = $_POST['password'];
		
	    $login = $user->check_login($username, $password);
	  
	$login_blocked = false;

		if ($login) {
			$user_id = $user->getUserId($username, $password);

			if ($user->isAccountAlreadyLoggedIn($user_id)) {
				$login_blocked = true;
				echo '<center>
			<div id="blocked-alert" style="background:#fff3cd;border:1px solid #ffc107;color:#856404;padding:15px;border-radius:4px;">
				<strong><i class="fa fa-lock"></i> Warning: Your account is already logged in on another device. Please log out from that device to proceed.</strong>
			</div>
			</center>
			<script>
			setTimeout(function() {
				var el = document.getElementById("blocked-alert");
				if(el) el.style.display = "none";
			}, 6000);
			</script>';
			} else {
			$user_info = $user->check_user($user_id);
			$useroffice = $user->show_office_data($user_info['office_id']);
			switch ($user_info['position']){
				case 'Encoder':
					$_SESSION['login'] = $login;
					$_SESSION['userAccountusername'] = $username;
					$_SESSION['userAccountpassword'] = $password;
					$_SESSION['userId'] = $user_id;
					$_SESSION['position'] = $user_info['position'];
					$_SESSION['userfullname'] = $user_info['fullname'];
					$_SESSION['f_office'] = $user_info['office_id'];
					$session_token = bin2hex(random_bytes(32));
					$user->setSessionToken($user_id, $session_token);
					$_SESSION['session_token'] = $session_token;
					$user->login_log();
					echo '<script>window.location="encoder/home.php"</script>';
					break;
				case 'Social Worker':
					$_SESSION['login'] = $login;
					$_SESSION['userAccountusername'] = $username;
					$_SESSION['userAccountpassword'] = $password;
					$_SESSION['userId'] = $user_id;
					$_SESSION['position'] = $user_info['position'];
					$_SESSION['userfullname'] = $user_info['fullname'];
					$_SESSION['f_office'] = $user_info['office_id'];
					$session_token = bin2hex(random_bytes(32));
					$user->setSessionToken($user_id, $session_token);
					$_SESSION['session_token'] = $session_token;
					$user->login_log();
					echo '<script>window.location="socialwork/home.php"</script>';
					break;
				case 'Admin':
					$_SESSION['login'] = $login;
					$_SESSION['userAccountusername'] = $username;
					$_SESSION['userAccountpassword'] = $password;
					$_SESSION['userId'] = $user_id;
					$_SESSION['position'] = $user_info['position'];
					$_SESSION['userfullname'] = $user_info['fullname'];
					$_SESSION['f_office'] = $user_info['office_id'];
					$session_token = bin2hex(random_bytes(32));
					$user->setSessionToken($user_id, $session_token);
					$_SESSION['session_token'] = $session_token;
					$user->login_log();
					echo '<script>window.location="admin/home.php"</script>';
					break;
				default:
					break;
			}
		}
		}
		if(!$login_blocked){
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
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
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
						<?php if (isset($_GET['reason'])): ?>
							<?php if ($_GET['reason'] === 'revoked'): ?>
							<div style="background:#d4edda;border:1px solid #c3e6cb;color:#155724;padding:12px 16px;border-radius:4px;margin-top:10px;font-size:14px;">
								<i class="fa fa-check-circle"></i> Your designation has been updated by the administrator. Please sign in again to continue.
							</div>
							<?php elseif ($_GET['reason'] === 'timeout'): ?>
							<div style="background:#fff3cd;border:1px solid #ffc107;color:#856404;padding:12px 16px;border-radius:4px;margin-top:10px;font-size:14px;">
								<i class="fa fa-clock-o"></i> Your session has expired due to inactivity. Please sign in again.
							</div>
							<?php endif; ?>
						<?php endif; ?>
						</div>
					</form>
			</div>
		</div>
	</div>
	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/animsition/js/animsition.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/select2/select2.min.js"></script>
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
	<script src="vendor/countdowntime/countdowntime.js"></script>
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
							<input class="form-control border border-black" type="text" name="search_emp" id="search_emp" placeholder="Search"></input>
						<div>
							<table id="admintable" class="table table-fixed table-striped table-hover highlight responsive-table" style="width: 100%; margin: 2% 0% 0% 0%;">
								<thead>
									<tr>
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
			$('#search_emp').keyup(function(){
				var txt = $('#search_emp').val();
				if(txt != ''){
					$.ajax({
						type: "post",
						url: "fetchdata.php",
						data: {search:txt},
						success: function(html){
							$('#search_emp_result').html(html).show();
						}
					});
				}else{
				$('#search_emp_result').html("");
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

</body>
</html>