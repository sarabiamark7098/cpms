<?php
include('../php/class.user.php');
$user = new User();

	$cid = $_GET['id'];
	$_SESSION['cid'] = $cid;
	
	$getgis = $user->show_ass_data($cid);
	
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
	  <form class="form-group" action="ShowProvider.php" method="POST">
			<div class="modal-body">
				<div class="row form-group" style="margin-top: 2%; height:10%;">
					<div class="form-group col-lg-12 align-self-end">
						<input value="<?php echo $getgis['ass_opt'] ?>" id="assopt" name="assopt" type="text" class="form-control" readonly>
						<label class="active" for="assopt">Assessment Option</label>
					</div>
					<div class="form-group col-lg-12">
						<textarea id="prob" name="prob" type="text" class="form-control" readonly><?php echo $getgis['prob_pres'] ?></textarea>
						<label class="active" for="prob">Problem Presented</label>
					</div>
					<div class="form-group col-lg-12">
						<textarea id="ass" name="ass" type="text" class="form-control" readonly><?php echo $getgis['ass_socwork']?></textarea>
						<label class="active" for="ass">Social Work Assessment</label>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</form>
</body>
</html>