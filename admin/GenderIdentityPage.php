<?php
	include("../php/class.user.php");
	require_once("../php/session_timeout.php");
	$user = new User();

	if(!$_SESSION['login']){
		header('location:../index.php');
	}
	if($_SESSION['position'] != 'Admin'){
		switch ($_SESSION['position']){
			case 'Encoder': header("Location: ../encoder/home.php"); break;
			case 'Social Worker': header("Location: ../socialwork/home.php"); break;
			case 'Finance': header("Location: ../finance/Dashboard.php"); break;
			case 'Program Head': header("Location: ../programhead/home.php"); break;
			case 'Viewer': header("Location: ../viewer/Dashboard.php"); break;
			default: echo "<script>window.location='../index.php';</script>";
		}
	}

	if(isset($_POST['Add'])){
		$result = $user->addGenderIdentity($_POST['gender_identity']);
		$msg = $result == "success" ? "Gender Identity Added!" : ($result == "exists" ? "Gender Identity Already Exists!" : "Error Adding Gender Identity!");
		echo "<script>alert('".$msg."');window.location='GenderIdentityPage.php';</script>";
	}
	if(isset($_POST['update'])){
		$result = $user->updateGenderIdentity($_POST['id'], $_POST['gender_identity']);
		$msg = $result == "success" ? "Gender Identity Updated!" : ($result == "exists" ? "Gender Identity Already Exists!" : ($result == "nochange" ? "No Changes Made!" : "Error Updating Gender Identity!"));
		echo "<script>alert('".$msg."');window.location='GenderIdentityPage.php';</script>";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Gender Identities</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="../images/icons/ciu.ico"/>
	<link rel="stylesheet" type="text/css" href="../css/main.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../css/table.responsive.css">
	<link rel="stylesheet" type="text/css" href="../style5.css">
	<script src="../js/jquery.min.js"></script>
	<script src="../js/popper.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script defer src="../js/solid.js"></script>
	<script defer src="../js/fontawesome.js"></script>
	<link rel="stylesheet" type="text/css" href="../datatables/datatables.css">
	<script type="text/javascript" charset="utf8" src="../datatables/datatables.js"></script>
	<script>
		$(function(){ $("#tablegender").dataTable(); });
	</script>
</head>
<body>
	<div class="wrapper">
		<nav id="sidebar">
			<div class="sidebar-header">
				<img src="../images/logo.png" alt="dswd logo" width="100px" height="100px">
			</div>
			<ul class="list-unstyled components">
				<li><a href="home.php">Providers<i style="float: right;font-size:25px" class="fa fa-handshake"></i></a></li>
				<li><a href="OfficePage.php">Offices<i style="float: right;font-size:25px" class="fa fa-building"></i></a></li>
				<li><a href="Employee.php">Employees <i style="float: right;font-size:25px" class="fa fa-users"></i></a></li>
				<li><a href="SignatoryPage.php">Signatory List <i style="float: right;font-size:25px" class="fa fa-list"></i></a></li>
				<li><a href="GISassessment.php">GIS Assessment <i style="float: right;font-size:25px" class="fa fa-list"></i></a></li>
				<li><a href="fundsource.php">Fund Source <i style="float: right;font-size:25px" class="fa fa-list"></i></a></li>
				<li><a href="SubCategoryPage.php">Sub-Categories <i style="float: right;font-size:25px" class="fa fa-tags"></i></a></li>
				<li><a href="GenderIdentityPage.php">Gender Identities <i style="float: right;font-size:25px" class="fa fa-venus-mars"></i></a></li>
				<li><a href="summarylist.php">Summary List <i style="float: right;font-size:25px" class="fa fa-list"></i></a></li>
				<li><a href="reissue_log.php">Re-issue Logs <i style="float: right;font-size:25px" class="fa fa-list"></i></a></li>
				<li><a href="cancelledGL_logs.php">Cancelled GL Logs <i style="float: right;font-size:25px" class="fa fa-list"></i></a></li>
				<li><a href="AccountsManagement.php">Accounts Management <i style="float: right;font-size:25px" class="fa fa-user-cog"></i></a></li>
				<li><a href="apiSend.php">API Send <i style="float: right;font-size:25px" class="fa fa-paper-plane"></i></a></li>
				<li><a href="Records.php">Records <i style="float: right;font-size:25px" class="fa fa-database"></i></a></li>
			</ul>
		</nav>
		<div id="content">
			<nav class="navbar navbar-expand-lg navbar-light bg-blue">
				<div class="container-fluid">
					<button type="button" id="sidebarCollapse" class="navbar-btn"><span></span><span></span><span></span></button>
					<a class="nav-link toggle tohover" data-id="<?php echo $_SESSION['userId'];?>" data-target="#userAccount" style="margin-left: 10px;" data-toggle="modal"><?php $name = explode(' ',$_SESSION['userfullname']); echo strtoupper($name[0]);?></a>
					<a class="nav-link toggle tohover" data-target="#AddModal" data-toggle="modal" style="border-left: solid 4px gray">Add Gender Identity</a>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="nav navbar-nav ml-auto">
							<li class="nav-item active"><a class="nav-link tohover" data-toggle="modal" data-target="#logoutmodal">Logout</a></li>
						</ul>
					</div>
				</div>
			</nav>
			<div class="container-fluid" style="padding-left: 5%">
				<div class="table-responsive-lg">
					<h5>List of Gender Identities</h5>
					<table id="tablegender" class="table table-fixed table-striped table-hover highlight display responsive nowrap" style="width: 100%; margin: 2% 0% 0% 0%;">
						<thead>
							<tr>
								<th scope="col">Gender Identity</th>
								<th scope="col" style="width: 25%">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$rows = $user->getGenderIdentitiesAdmin();
								if($rows && mysqli_num_rows($rows) > 0){
									while($v = mysqli_fetch_assoc($rows)){
										$id = (int)$v['gender_id'];
										$name = htmlspecialchars($v['gender_identity'], ENT_QUOTES);
										echo "<tr>
											<td>".htmlspecialchars($v['gender_identity'])."</td>
											<td style='width: 25%'>
												<button type='button' class='btn btn-primary deep-sky editBtn' data-id='".$id."' data-name=\"".$name."\" data-toggle='modal' data-target='#EditModal'>Update</button>
											</td>
										</tr>";
									}
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<!-- Add modal -->
	<div class="modal hide fade" id="AddModal" role="dialog" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog modal-lg" role="document"><div class="modal-content">
			<div class="modal-header"><h5 class="modal-title">Add Gender Identity</h5><button type="button" class="close" data-dismiss="modal">&times;</button></div>
			<form action="GenderIdentityPage.php" method="POST">
				<div class="modal-body"><div class="form-group">
					<label>Gender Identity</label>
					<input placeholder="Gender Identity" name="gender_identity" type="text" class="form-control" required maxlength="100" oninput="this.value = this.value.replace(/[^A-Za-z0-9ÑñÉéÈèÊêËë\-.,()/ ]/g, '')">
				</div></div>
				<div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button><button type="submit" class="btn btn-primary" name="Add">Save</button></div>
			</form>
		</div></div>
	</div>

	<!-- Edit modal -->
	<div class="modal hide fade" id="EditModal" role="dialog" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog modal-lg" role="document"><div class="modal-content">
			<div class="modal-header"><h5 class="modal-title">Update Gender Identity</h5><button type="button" class="close" data-dismiss="modal">&times;</button></div>
			<form action="GenderIdentityPage.php" method="POST">
				<input type="hidden" name="id" id="edit-id">
				<div class="modal-body"><div class="form-group">
					<label>Gender Identity</label>
					<input name="gender_identity" id="edit-name" type="text" class="form-control" required maxlength="100" oninput="this.value = this.value.replace(/[^A-Za-z0-9ÑñÉéÈèÊêËë\-.,()/ ]/g, '')">
				</div></div>
				<div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button><button type="submit" class="btn btn-primary" name="update">Update</button></div>
			</form>
		</div></div>
	</div>

	<!-- User account modal -->
	<div class="modal fade in" id="userAccount" role="dialog" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog" role="document"><div class="modal-content">
			<div class="modal-header"><h5 class="modal-title">User Account</h5><button type="button" class="close" data-dismiss="modal">&times;</button></div>
			<div class="useraccount"></div>
		</div></div>
	</div>

	<!-- Logout modal -->
	<div class="modal hide fade" id="logoutmodal" role="dialog" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog modal-md modal-dialog-centered"><div class="modal-content">
			<div class="modal-header"><h4>Logout <i class="fa fa-lock"></i></h4><button type="button" class="close" data-dismiss="modal">&times;</button></div>
			<div class="modal-body"><i class="fa fa-question-circle"></i> Are you sure you want to log-out?</div>
			<div class="modal-footer"><a href="../php/logout.php" class="btn btn-primary btn-block">Logout</a></div>
		</div></div>
	</div>

	<script>
		$(document).ready(function () {
			$('#sidebar').toggleClass('active');
			$('#sidebarCollapse').toggleClass('active');
			$('#sidebarCollapse').on('click', function () { $('#sidebar').toggleClass('active'); $(this).toggleClass('active'); });
		});
		$('#EditModal').on('show.bs.modal', function (event) {
			var b = $(event.relatedTarget);
			$('#edit-id').val(b.data('id'));
			$('#edit-name').val(b.data('name'));
		});
		$('#userAccount').appendTo("body").on('show.bs.modal', function (event) {
			var userid = $(event.relatedTarget).data('id'); var modal = $(this);
			$.ajax({ type: "GET", url: "adminuserAccount.php", data: 'id=' + userid, cache: false,
				success: function (data) { modal.find('.useraccount').html(data); } });
		});
	</script>
</body>
</html>
