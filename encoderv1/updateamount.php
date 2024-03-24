<?php
include('../php/class.user.php');
$user = new User();

    $id = $_GET['id'];

	$_SESSION['myid'] = $id;
	
	if(isset($_POST['update'])) {
        $id = $_GET['id'];
		$setamount1 = $_POST['amount1'];
		$setamount2 = $_POST['amount2'];
		$result = $user->updateAmount($id, $setamount1, $setamount2);
		if($result){
			echo "<script>alert('Successfully Updating Company!');</script>";
			echo "<meta http-equiv='refresh' content='0'>";
			echo "<script>window.location='ProviderView.php';</script>";
		}
		else{
			echo "<script>alert('Error Updating Company!');</script>";
			echo "<meta http-equiv='refresh' content='0'>";
			echo "<script>window.location='ProviderView.php';</script>";
		}
  }
	$getdata = $user->show_assistance($id);
	
?>
<!DOCTYPE html>
<html>
	<head>
		 <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" type="text/css" href="../css/main.css">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"> 
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
        <script type="text/javascript" src="../js/jquery-3.2.1.slim.min.js"></script>
        <script type="text/javascript" src="../js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../js/main.js"></script>
        <script type="text/javascript" src="../js/jquery.min.js"></script>
		<!-- added -->
		<script type="text/javascript" src="../js/bootstrap-3.3.7.min.js"></script>
		<style>
			.dropdown .dropdown-menu .dropdown-item:active, .dropdown 
			.dropdown-menu .dropdown-item:hover{background-color: skyblue  !important;}
		</style>
	</head>
	<body>
	  <form class="form-group" action="updateamount.php?id=<?php echo $id ?>" method="POST">
		<div class="modal-body">
			<div class="row form-group" style="margin-top: 2%; height:10%;">
				<div class="form-group col-lg-12 align-self-end">
				  <input value="<?php echo $getdata['lastname'] .', '. $getdata['firstname'] .' '. $getdata['middlename'] .' '. $getdata['exname']?>" id="name" name="name" type="text" class="form-control" readonly>
				  <label class="active" for="name">Client Name</label>
				</div>
				<div class="form-group col-lg-12">
				  <input value="<?php echo $getdata['amount1'] ?>" id="companyname" name="companyname" type="text" class="form-control" required>
				  <label class="active" for="companyname">Type 1 Amount</label>
				</div>
                <?php if(!empty($getdata['amount2'])){ ?>
				<div class="form-group col-lg-12">
				  <input value="<?php echo $getdata['amount2'] ?>" id="type2" name="type2" type="text" class="form-control">
				  <label class="active" for="type2">Type 2 Amount</label>
				</div>
                <?php } ?>
			</div>
				  
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-primary" name="update">Update</button>
		</div>
      </form>
</body>
</html>