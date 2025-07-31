<?php
include('../php/class.user.php');
$user = new User();

    $ass_opt = $_GET['id'];

	$_SESSION['assopt'] = $ass_opt;
	
	if(isset($_POST['update'])) {
		$opt = $_GET['id'];
		$ass_opt = mysqli_real_escape_string($user->db,($_POST['assopt']));
		$prob_pre = mysqli_real_escape_string($user->db,($_POST['prob']));
		$swass = mysqli_real_escape_string($user->db,($_POST['ass']));
        
        $result = $user->updateAssessment($ass_opt, $prob_pre, $swass, $opt);
		if($result){
			echo "<script>alert('Successfully Updating GIS ASSESSMENT!');</script>";
			echo "<meta http-equiv='refresh' content='0'>";
			echo "<script>window.location='GISassessment.php';</script>";
		}
		else{
			echo "<script>alert('Error Updating GIS ASSESSMENT!');</script>";
			echo "<meta http-equiv='refresh' content='0'>";
			echo "<script>window.location='GISassessment.php';</script>";
		}
  }
	$getgis = $user->show_ass_data($ass_opt);
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
	  <form class="form-group" action="UpdateAssessment.php?id=<?php echo $ass_opt ?>" method="POST">
		<div class="modal-body">
			<div class="row form-group" style="margin-top: 2%; height:10%;">
				<div class="form-group col-lg-12 align-self-end">
				  <input value="<?php echo $getgis['ass_opt'] ?>" id="assopt" name="assopt" type="text" class="form-control" oninput="this.value = this.value.replace(/[^A-Za-z0-9ÑñÉéÈèÊêËë\-., ]/g, '')">
				  <label class="active" for="assopt">Assessment Option</label>
				</div>
				<div class="form-group col-lg-12">
				  <textarea id="prob" name="prob" type="text" class="form-control" oninput="this.value = this.value.replace(/[^A-Za-z0-9ÑñÉéÈèÊêËë\-., ]/g, '')"><?php echo $getgis['prob_pres'] ?></textarea>
				  <label class="active" for="prob">Problem Presented</label>
				</div>
				<div class="form-group col-lg-12">
				  <textarea placeholder="No Value" id="ass" name="ass" type="text" class="form-control " required oninput="this.value = this.value.replace(/[^A-Za-z0-9ÑñÉéÈèÊêËë\-., ]/g, '')"><?php echo $getgis['ass_socwork'] ?></textarea>
				  <label class="active" for="ass">Social Work Assessment</label>
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