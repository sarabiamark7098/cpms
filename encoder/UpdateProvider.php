<?php
include('../php/class.user.php');
$user = new User();

    $cid = $_GET['id'];

	$_SESSION['myid'] = $cid;
	
	if(isset($_POST['update'])) {
		$setname = $_POST['addresseename'];
		$setposition = $_POST['addresseeposition'];
		$settomention = $_POST['addresseetomention'];
		$setid = $_POST['companyid'];
		$setcname = $_POST['companyname'];
		$setcaddress = $_POST['companyaddress'];
		$result = $user->updateProvider($setname, $setposition, $setid, $settomention, $setcname, $setcaddress);
		if($result){
			echo "<script>alert('Successfully Updating Company!');</script>";
			echo "<meta http-equiv='refresh' content='0'>";
			echo "<script>window.location='ProviderPage.php';</script>";
		}
		else{
			echo "<script>alert('Error Updating Company!');</script>";
			echo "<meta http-equiv='refresh' content='0'>";
			echo "<script>window.location='ProviderPage.php';</script>";
		}
  }
	$getprovider = $user->show_provider_data($cid);
	
?>
<!DOCTYPE html>
<html>
	<body>
	  <form class="form-group" action="UpdateProvider.php?id=<?php echo $cid ?>" method="POST">
		<div class="modal-body">
			<div class="row form-group" style="margin-top: 2%; height:10%;">
				<div class="form-group col-lg-12 align-self-end">
				  <input value="<?php echo $getprovider['company_id']?>" id="companyid" name="companyid" type="text" class="form-control" readonly>
				  <label class="active" for="companyid">Company ID</label>
				</div>
				<div class="form-group col-lg-7">
				  <input value="<?php echo $getprovider['addressee_name']?>" id="addresseename" name="addresseename" type="text" class="form-control" oninput="this.value = this.value.replace(/[^A-Za-zÑñÉéÈèÊêËë\-., ]/g, '')">
				  <label class="active" for="addresseename">Addressee</label>
				</div>
				<div class="form-group col-lg-5">
				  <input value="<?php echo $getprovider['addressee_position']?>" placeholder="No Value" id="addresseeposition" name="addresseeposition" type="text" class="form-control " required oninput="this.value = this.value.replace(/[^A-Za-zÑñÉéÈèÊêËë\-., ]/g, '')">
				  <label class="active" for="addresseeposition">Addressee Position</label>
				</div>
				<div class="form-group col-lg-12">
					<input  value="<?php echo $getprovider['to_mention']?>" id="addresseetomention" name="addresseetomention" type="text" class="form-control" oninput="this.value = this.value.replace(/[^A-Za-zÑñÉéÈèÊêËë\-., ]/g, '')">
					<label class="active" for="addresseetomention">Addressee To Mention(e.g. Mr. Dela Cruz OR Leave Empty if None)</label>
				</div>
				<div class="form-group col-lg-12">
				  <input value="<?php echo $getprovider['company_name']?>" id="companyname" name="companyname" type="text" class="form-control" required oninput="this.value = this.value.replace(/[^A-Za-z0-9ÑñÉéÈèÊêËë\-., ]/g, '')">
				  <label class="active" for="companyname">Company Name</label>
				</div>
				<div class="form-group col-lg-12">
				  <input value="<?php echo $getprovider['company_address']?>" id="companyaddress" name="companyaddress" type="text" class="form-control " required oninput="this.value = this.value.replace(/[^A-Za-z0-9ÑñÉéÈèÊêËë\-., ]/g, '')">
				  <label class="active" for="companyaddress">Company Address</label>
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