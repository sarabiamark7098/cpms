<?php
		require('php/class.user.php');
		$user = new User();


		//echo $user->try();

	if (isset($_REQUEST['login'])) {
		extract($_REQUEST);
		
		$username = $_POST['username'];
		$password = $_POST['password'];
		
	    $login = $user->check_login($username, $password);
	  
	  if ($login) {
			
			$user_id = $user->getUserId($username, $password);
		
			$user_info = $user->check_user($user_id);

			switch ($user_info['position']){
					case 'Encoder': header("Location: encoder/home.php");
									$_SESSION['login'] = $login;
									$_SESSION['userAccountusername'] = $username;
									$_SESSION['userAccountpassword'] = $password;
									$_SESSION['userId'] = $user_id; 
									$_SESSION['position'] = $user_info['position'];
									$_SESSION['userfullname'] = $user_info['fullname'];
									break;
					case 'Social Worker': header("Location: socialwork/home.php");
									$_SESSION['login'] = $login;
									$_SESSION['userAccountusername'] = $username;
									$_SESSION['userAccountpassword'] = $password;
									$_SESSION['userId'] = $user_id; 
									$_SESSION['position'] = $user_info['position'];
									$_SESSION['userfullname'] = $user_info['fullname'];
									break;
					case 'Admin': header("Location: admin/home.php");
									$_SESSION['login'] = $login;
									$_SESSION['userAccountusername'] = $username;
									$_SESSION['userAccountpassword'] = $password;
									$_SESSION['userId'] = $user_id; 
									$_SESSION['position'] = $user_info['position'];
									$_SESSION['userfullname'] = $user_info['fullname'];
									break;
					default:
						//echo "<script>window.location='index.php';</script>";
			}
		}
		else{
			echo '<center><div class="alert alert-Danger">
			  <strong>User not Found!</strong>
			</div></center>';
		}
	}
	/*if(isset($_REQUEST['save'])){
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
	}*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>DSWD LOGIN</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<script type="text/javascript" src="../js/bootstrap-3.3.7.min.js"></script>

</head>
<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="images/img-01.png" style="width: 120%; margin-top: 20%;" alt="IMG">
				</div>

				<form class="login100-form validate-form" method="POST" action="index.php">
					
					<span class="login100-form-title">
					<img class="responsive-img" src="images/dswd-logo_final.png" height=90 width=270 >
		  			<div class="section"></div>
					</span>

					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="username" placeholder="Username" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Password" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit" name="login">Login</button>
					</div>

					<div class="text-center p-t-80">
						<p>&copy Copyright</p>
						<p>System made by USEP</p>
					</div>
				</form>
			</div>
		</div>
	</div>




	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/select2/select2.min.js"></script>
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="js/js.js"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>

<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>

	<!-- Modal4-->
	<div class="modal fade" id="error" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">ERROR!!</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="" class="form-group" action="index.php" method="POST">
					<div class="modal-body">
						<p>Error Login! Please type your credentials correctly.</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
					</div>
				</form> 
			</div>
		</div>
		</div>





 
	<!-- Modal3-->
		<div class="modal fade" id="Modal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Enter Your Information</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form class="form-group" action="index.php" method="POST">
					<div class="modal-body">
						<label>Employee ID</label>
						<input type="text" class="form-control mr-sm-2" name="emp_id" placeholder="2015-0132" required></input>
						<label>Fullname(Lastname, Firstname Middlename)</label> 	
						<input type="text" class="form-control mr-sm-2" name="fullname" placeholder="Enter Fullname(Lastname,  Firstname  Middlename)" required>
						<label>Position</label>
						<select name="position" class="form-control mr-sm-2" required>
							<option value="Encoder">Encoder</option>
							<option value="Social Worker">Social Worker</option>
							<option value="Admin">Admin</option>
						</select>	
						<label>Initials</label>
						<input type="text" class="form-control mr-sm-2" name="initials" placeholder="initials (JDC for Juan Dela Cruz)" required>
						<label>Username</label>
						<input type="text" class="form-control mr-sm-2" name="username" placeholder="Your username" required>
						<label>Password</label>
						<input type="password" name="password_partial" id="create_pass" class="form-control mr-sm-2" placeholder="Enter Password" onkeyup='check();' required>
						<label>Confirm Password</label>
						<input type="password" name="password_final" id="confirm_create_pass" class="form-control mr-sm-2" placeholder="Confirm your Password" onkeyup='check();' required>
						<span id='message'></span>
						
						<script type="text/javascript">
						$('#create_pass, #confirm_create_pass').on('keyup', function () {
						  if ($('#create_pass').val() == $('#confirm_create_pass').val()) {
							$('#message').html('Matched').css('color', 'green');
						  } else 
							$('#message').html('Not Matched').css('color', 'red');
						});
						</script>
						
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-outline-danger waves-effect waves-light btn" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-outline-success waves-effect waves-light btn" name="save">Save User</button>
					</div>
				</form> 
			</div>
		</div>
		</div>

	
	
</html>