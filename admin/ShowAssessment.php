<?php
include('../php/class.user.php');
$user = new User();

	$cid = $_GET['id'];
	$_SESSION['cid'] = $cid;
	
	$getgis = $user->show_ass_data($cid);
	
?>
<!DOCTYPE html>
<html>
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