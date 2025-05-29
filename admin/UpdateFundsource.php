<?php
include('../php/class.user.php');
$user = new User();

    $fsid = $_GET['id'];
	
	if(isset($_POST['update'])) {
		$setid = $_GET['id'];
		$fundsource = $_POST['fundsource'];
		$description = $_POST['fsdescription'];
		$result = $user->UpdateFundsource($setid, $fundsource, $description);
		if($result){
			echo "<script>alert('Successfully Updating Fund Source!');</script>";
			echo "<meta http-equiv='refresh' content='0'>";
			echo "<script>window.location='fundsource.php';</script>";
		}
		else{
			echo "<script>alert('Error Updating Fund Source!');</script>";
			echo "<meta http-equiv='refresh' content='0'>";
			echo "<script>window.location='fundsource.php';</script>";
		}
  }
	$getfundsource = $user->show_fundsource_data($fsid);
	
?>
<!DOCTYPE html>
<html>
	<head>
		<style>
			.dropdown .dropdown-menu .dropdown-item:active, .dropdown 
			.dropdown-menu .dropdown-item:hover{background-color: skyblue  !important;}
		
		</style>
	</head>
	<body>
	  <form class="form-group" action="UpdateFundsource.php?id=<?php echo $fsid ?>" method="POST">
		<div class="modal-body">
			<div class="row form-group" style="margin-top: 2%; height:10%;">
				<div class="form-group col-lg-12">
					<input value="<?php echo $getfundsource['fundsource']?>" placeholder="Fund Source" id="fundsource" name="fundsource" type="text" class="form-control " required oninput="this.value = this.value.replace(/[^A-Za-z0-9ÑñÉéÈèÊêËë\-., ]/g, '').toUpperCase()">
					<label class="active" for="fundsource">Fund Source</label>
				</div>
				<div class="form-group col-lg-12">
				  <input value="<?php echo $getfundsource['fs_description']?>" id="fsdescription" name="fsdescription" type="text" class="form-control" required oninput="this.value = this.value.replace(/[^A-Za-z0-9ÑñÉéÈèÊêËë\-., ]/g, '').toUpperCase()">
				  <label class="active" for="fsdescription">Description</label>
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