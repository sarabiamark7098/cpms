<?php
include('../php/class.user.php');
$user = new User();

    $empid = $_GET['id'];
	
	if(isset($_POST['update'])) {
		$setnewid = $_POST['empid'];
		$setfirstname = $_POST['fname'];
		$setlastname = $_POST['lname'];
		$setmiddleI = $_POST['mi'];
		$setinitials = $_POST['initials'];
		$setposition = $_POST['position'];
		$setoptions = $_POST['option'];
		$setid = $_GET['id'];
		$setrange_start = $_POST['rangestart'];
		$setrange_end = $_POST['rangeend'];
		$result = $user->updatesignatory($setnewid, $setfirstname, $setlastname, $setmiddleI, $setinitials, $setposition, $setoptions, $setid, $setrange_start, $setrange_end);
	
		if($result){
			echo "<script>alert('Successfully Adding Signatory!');</script>";
			echo "<script>window.location='SignatoryPage.php';</script>";
			echo "<meta http-equiv='refresh' content='0'>";
		}
		else{
			echo "<script>alert('Error Adding Signatory!');</script>";
			echo "<script>window.location='SignatoryPage.php';</script>";
			echo "<meta http-equiv='refresh' content='0'>";
		}
  }
	
	$getsignatory = $user->show_signatory_data($empid);
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
	  <form class="form-group" action="UpdateSignatory.php?id=<?php echo $getsignatory['signatory_id'] ?>" method="POST">
		<div class="modal-body">
			<div class="row form-group" style="margin-top: 2%; height:10%;">
				<div class="form-group col-lg-3">
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $getsignatory['signatory_id']; ?>" placeholder="Signatory ID" id="empid" name="empid" type="text" class="form-control text-center">
				  <label class="active" for="empid">Employee ID(Signatory)</label>
				</div>
				<div class="form-group col-lg-3">
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $getsignatory['first_name']; ?>" placeholder="First Name" id="fname" name="fname" type="text" class="form-control" required>
				  <label class="active" for="fname">First Name</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $getsignatory['last_name']; ?>" placeholder="Last Name" id="lname" name="lname" type="text" class="form-control " required>
				  <label class="active" for="lname">Last Name</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $getsignatory['middle_I']; ?>" placeholder="Middle Initial" id="mi" name="mi" type="text" class="form-control" required>
				  <label class="active" for="mi">Middle Initial</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $getsignatory['initials']; ?>" placeholder="Initials" id="initials" name="initials" type="text" class="form-control " required>
				  <label class="active" for="initials">Initials(e.g. NTS)</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $getsignatory['position']; ?>" placeholder="Position" id="position" name="position" type="text" class="form-control" required>
				  <label class="active" for="position">Position</label>
				</div>
				<div class="form-group col-lg-6">
					<select placeholder="Options" id="option" name="option" type="text" class="form-control " required>
						<?php if($getsignatory['options'] == 'GL'){
								echo '<option value="GL" selected>Guarantee Letter</option>';
								echo '<option value="GIS / CE">GIS / CE</option>';
							}else if($getsignatory['options'] == 'GIS / CE'){
								echo '<option value="GL" selected>Guarantee Letter</option>';
								echo '<option value="GIS / CE" selected>GIS / CE</option>';
							}
						?>
					</select>
					 <label class="active" for="position">Options</label>
				</div>
				
				<div class="form-group col-lg-6" <?php echo ($getsignatory['options'] == 'GL')?"":"hidden" ?> >
				  <input value="<?php echo $getsignatory['range_start']; ?>" placeholder="&#8369; Range Start" id="rangestart" name="rangestart" type="number" class="form-control">
				  <label class="active" for="rangestart">Range Start</label>
				</div>
				<div class="form-group col-lg-6" <?php echo ($getsignatory['options'] == 'GL')?"":"hidden" ?>>
				  <input value="<?php echo $getsignatory['range_end']; ?>" placeholder="&#8369; Range End" id="rangeend" name="rangeend" type="number" class="form-control">
				  <label class="active" for="rangeend">Range End</label>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-primary" name="update">Update</button>
		</div>
      </form>
</body>
</html>