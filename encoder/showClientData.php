<?php
include('../php/class.user.php');
	$user = new User();

	$transid = $_GET['id'];
	$_SESSION['myid'] = $transid;
	
	$getClient = $user->show_client_data($transid);
	$getencoder = $user->getencoder($getClient['encoded_encoder']);
	$img = $user->getClientImage($transid);
	$fundsourcedata = $user->getfundsourcedata($transid);
	$sw_id = $getClient['encoded_socialWork'];
	// $_SESSION['enc'] = $getClient['enc_soc'];
	$age = $user->getAge($getClient['date_birth']);
	if($age == 0){
		$age=1;
	}
	if(!empty($getClient['b_bday'])){
		$bage = $user->getAge($getClient['b_bday']);
		if($bage == 0){
			$bage=1;
		}
	}
	if(!empty($sw_id)){
		$getSocialwork = $user->getsocialWork($sw_id);
	}
	
	$reissue = $user->getReissueData($transid);
?>
<?php
	if(!$_SESSION['login']){
		header('Location:../index.php');
		}

?>
<!DOCTYPE html>
<html>
	<head>
	</head>
	<body>
	<div class="body">
	  <form class="form-group" action="showClientData.php" method="POST">
		<div class="modal-body">
			 <div class="row col-centered text-center">
				<div class="col">
					<img class="responsive-img shadow-sm p-3" src="<?php echo $img?>" style="margin:auto;width: 30%; border-radius: 50%;height:200px">
					<p><u>Client Picture</u></p>
				</div>
			</div>
			
			<?php if(!empty($reissue)){ ?>
				<label data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
					<h5><small>&emsp;Reissue Information&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</small></h5>
				</label>
					<div class="row form-group" style="margin-top: 2%; height:10%;">
						<div class="form-group col-lg-3">
						</div>
						<div class="form-group col-lg-6">
							<input value="Reissued" id="rstatus" name="rstatus" type="text" class="form-control text-center" readonly>
							<label class="active text_center" for="rstatus">Status</label>
						</div>
						<div class="form-group col-lg-3">
						</div>
				</div>
			<?php } ?>
				<label data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
					<h5><small>&emsp;Client Details&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</small></h5>
				</label>
				<div class="row form-group" style="margin-top: 2%; height:10%;">
					<div class="form-group col-lg-6">
					  <input value="<?php echo $getClient['lastname']; ?>" id="lastname" name="lastname" type="text" class="form-control" readonly>
					  <label class="active" for="lastname">Lastname</label>
					</div>
					<div class="form-group col-lg-6">
					  <input value="<?php echo $getClient['firstname']; ?>" id="firstname" name="firstname" type="text" class="form-control" readonly>
					  <label class="active" for="firstname">Firstname</label>
					</div>
					<div class="form-group col-lg-6">
					  <input value="<?php echo $getClient['middlename']; ?>" id="middlename" name="middlename" type="text" class="form-control" readonly>
					  <label class="active" for="middlename">Middlename</label>
					</div>
					<div class="form-group col-lg-6">
					  <input value="<?php echo $getClient['extraname']; ?>" id="extraname" name="extraname" type="text" class="form-control" readonly>
					  <label class="active" for="extraname">Extraname</label>
					</div>
					
					<label class="col-lg-12" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
					<h5><small>&emsp;More Details&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</small></h5>
					</label>
					
					<div class="form-group col-lg-6">
					  <input value="<?php echo $getClient['civil_status']; ?>" id="civil" name="civil" type="text" class="form-control" readonly>
					  <label class="active" for="civilStatus">Civil Status</label>
					</div>
					<div class="form-group col-lg-6">
					  <input value="<?php echo $getClient['date_birth']; ?>" id="dob" name="dob" type="text" class="form-control" readonly>
					  <label class="active" for="dateBirth">Date Birth</label>
					</div>
					<div class="form-group col-lg-6">
					  <input value="<?php echo $age; ?>" id="age" name="age" type="text" class="form-control" readonly>
					  <label class="active" for="age">Age</label>
					</div>
					<div class="form-group col-lg-6">
					  <input value="<?php echo $getClient['occupation']; ?>" id="occupation" name="occupation" type="text" class="form-control" readonly>
					  <label class="active" for="sourceoffund">Occupation</label>
					</div>
					<div class="form-group col-lg-6">
					  <input value="<?php echo $getClient['salary']; ?>" id="salary" name="salary" type="text" class="form-control" readonly>
					  <label class="active" for="sourceoffund">Salary</label>
					</div>
					<div class="form-group col-lg-6">
					  <input value="<?php echo $getClient['contact'];?>" id="contact" name="contact" type="text" class="form-control" readonly>
					  <label class="active" for="sourceoffund">Contact</label>
					</div>
					<div class="form-group col-lg-6">
					  <input value="<?php echo $getClient['category']; ?>" id="category" name="category" type="text" class="form-control" readonly>
					  <label class="active" for="sourceoffund">Category</label>
					</div>
					<div class="form-group col-lg-6">
					  <input value="<?php echo $getClient['subCategory']; ?>" id="subcategory" name="subcategory" type="text" class="form-control" readonly>
					  <label class="active" for="sourceoffund">Subcategory</label>
					</div>
				
					<label class="col-lg-12" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
					<h5><small>&emsp;Other Details&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</small></h5>
					</label>
				
					<div class="form-group col-lg-6">
					  <input value="<?php echo $getClient['date_entered'];?>" id="dateEn" name="dateEn" type="datetime" class="form-control" readonly>
					  <label class="active" for="name">Date of filing started</label>
					</div>
					<div class="form-group col-lg-6">
					  <input value="<?php echo $getClient['date_accomplished']; ?>" id="dateaccomplished" name="dateaccomplished" type="datetime" class="form-control" readonly>
					  <label class="active" for="dateAccomplished">Date of Filing Finished</label>
					</div>
					<div class="form-group col-lg-6">
					  <input value="<?php echo $getencoder;?>" id="enteredby" name="eneteredby" type="text" class="form-control " readonly>
					  <label class="active" for="enteredby">Encoded by</label>
					</div>
					<div class="form-group col-lg-6">
					  <input value="<?php echo (empty($getSocialwork))?"":$getSocialwork ?>" id="assessby" name="assessby" type="text" class="form-control " readonly>
					  <label class="active" for="enteredby">Assessed by</label>
					</div>
					<div class="form-group col-lg-6">
					  <input value="<?php echo $getClient['control_no']; ?>" id="clientNo" name="clientNo" type="text" class="form-control mr-sm-2" readonly>
					  <label class="active" for="clientnum">Client Control Number</label>
					</div>
					<label class="col-lg-12" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
					<h5><small>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</small></h5>
					</label>
					<div class="form-group col-lg-6">
					  <input value="<?php echo $getClient['mode_admission']; ?>" id="moa" name="moa" type="text" class="form-control" readonly>
					  <label class="active" for="modeofadmission">Mode of Admission</label>
					</div>
					<div class="form-group col-lg-6">
					  <input value="<?php echo $getClient['type']; ?>" id="toa" name="toa" type="text" class="form-control" readonly>
					  <label class="active" for="typeofassistance">Type of Assistance </label>
					</div>
					<div class="form-group col-lg-6">
					  <input value="<?php echo $getClient['amount']; ?>" id="amount1" name="amount1" type="text" class="form-control" readonly>
					  <label class="active" for="amount1">Amount </label>
					</div>
					<!-- <div class="form-group col-lg-6" hidden>
					  <input value="<?php // echo empty($fundsourcedata[1]['fundsource'])? "" : (empty($fundsourcedata[2]['fundsource'])?$fundsourcedata[1]['fundsource'].'-'.$fundsourcedata[1]['fs_amount']:$fundsourcedata[1]['fundsource'].'-'.$fundsourcedata[1]['fs_amount'].'/'.$fundsourcedata[2]['fundsource'].'-'.$fundsourcedata[2]['fs_amount'].''.(!empty($fundsourcedata[3]['fundsource'])?'/'.$fundsourcedata[3]['fundsource']:"").'-'.$fundsourcedata[3]['fs_amount'].''.(!empty($fundsourcedata[4]['fundsource'])?'/'.$fundsourcedata[4]['fundsource'].'-'.$fundsourcedata[4]['fs_amount']:"").''.(!empty($fundsourcedata[5]['fundsource'])?'/'.$fundsourcedata[5]['fundsource'].'-'.$fundsourcedata[5]['fs_amount']:"")) ?>" id="sourceoffund" name="sourceoffund" type="text" class="form-control" readonly>
					  <label class="active" for="sourceoffund">Source of Fund </label>
					</div> -->
					<br><br>
					<div class="form-group col-lg-12">
					  <label class="active" for="sourceoffund">Referral Division</label>
					</div>
					<div class="form-group col-lg-6" <?php echo empty($fundsourcedata[1]['fundsource'])?"hidden":"" ?> >
						<input value="<?php echo empty($fundsourcedata[1]['fundsource'])? "" : $fundsourcedata[1]['fundsource'].'-'.$fundsourcedata[1]['fs_amount']?>" id="sourceoffund" name="sourceoffund" type="text" class="form-control" readonly>
					  <label class="active" for="sourceoffund">Source of Fund 1 </label>
					</div>
					<div class="form-group col-lg-6" <?php echo empty($fundsourcedata[2]['fundsource'])?"hidden":"" ?> >
						<input value="<?php echo empty($fundsourcedata[2]['fundsource'])? "" : $fundsourcedata[2]['fundsource'].'-'.$fundsourcedata[2]['fs_amount']?>" id="sourceoffund" name="sourceoffund" type="text" class="form-control" readonly>
					  <label class="active" for="sourceoffund">Source of Fund 2 </label>
					</div>
					<div class="form-group col-lg-6" <?php echo empty($fundsourcedata[3]['fundsource'])?"hidden":"" ?> >
						<input value="<?php echo empty($fundsourcedata[3]['fundsource'])? "" : $fundsourcedata[3]['fundsource'].'-'.$fundsourcedata[3]['fs_amount']?>" id="sourceoffund" name="sourceoffund" type="text" class="form-control" readonly>
					  <label class="active" for="sourceoffund">Source of Fund 3 </label>
					</div>
					<div class="form-group col-lg-6" <?php echo empty($fundsourcedata[4]['fundsource'])?"hidden":"" ?> >
						<input value="<?php echo empty($fundsourcedata[4]['fundsource'])? "" : $fundsourcedata[4]['fundsource'].'-'.$fundsourcedata[4]['fs_amount']?>" id="sourceoffund" name="sourceoffund" type="text" class="form-control" readonly>
					  <label class="active" for="sourceoffund">Source of Fund 4 </label>
					</div>
					<div class="form-group col-lg-6" <?php echo empty($fundsourcedata[5]['fundsource'])?"hidden":"" ?> >
					  <input value="<?php echo empty($fundsourcedata[5]['fundsource'])? "" : $fundsourcedata[5]['fundsource'].'-'.$fundsourcedata[5]['fs_amount']?>" id="sourceoffund" name="sourceoffund" type="text" class="form-control" readonly>
					  <label class="active" for="sourceoffund">Source of Fund 5 </label>
					</div>
					<div class="form-group col-lg-6" <?php echo empty($fundsourcedata[6]['fundsource'])?"hidden":"" ?> >
					  <input value="<?php echo empty($fundsourcedata[6]['fundsource'])? "" : $fundsourcedata[6]['fundsource'].'-'.$fundsourcedata[6]['fs_amount']?>" id="sourceoffund" name="sourceoffund" type="text" class="form-control" readonly>
					  <label class="active" for="sourceoffund">Source of Fund 6 </label>
					</div>
					<div class="form-group col-lg-6" <?php echo empty($fundsourcedata[7]['fundsource'])?"hidden":"" ?> >
					  <input value="<?php echo empty($fundsourcedata[7]['fundsource'])? "" : $fundsourcedata[7]['fundsource'].'-'.$fundsourcedata[7]['fs_amount']?>" id="sourceoffund" name="sourceoffund" type="text" class="form-control" readonly>
					  <label class="active" for="sourceoffund">Source of Fund 7 </label>
					</div>
					<div class="form-group col-lg-6" <?php echo empty($fundsourcedata[8]['fundsource'])?"hidden":"" ?> >
					  <input value="<?php echo empty($fundsourcedata[8]['fundsource'])? "" : $fundsourcedata[8]['fundsource'].'-'.$fundsourcedata[8]['fs_amount']?>" id="sourceoffund" name="sourceoffund" type="text" class="form-control" readonly>
					  <label class="active" for="sourceoffund">Source of Fund 8 </label>
					</div>
					<div class="form-group col-lg-6" <?php echo empty($fundsourcedata[9]['fundsource'])?"hidden":"" ?> >
					  <input value="<?php echo empty($fundsourcedata[9]['fundsource'])? "" : $fundsourcedata[9]['fundsource'].'-'.$fundsourcedata[9]['fs_amount']?>" id="sourceoffund" name="sourceoffund" type="text" class="form-control" readonly>
					  <label class="active" for="sourceoffund">Source of Fund 9 </label>
					</div>
					<div class="form-group col-lg-6" <?php echo empty($fundsourcedata[10]['fundsource'])?"hidden":"" ?> >
					  <input value="<?php echo empty($fundsourcedata[10]['fundsource'])? "" : $fundsourcedata[10]['fundsource'].'-'.$fundsourcedata[10]['fs_amount']?>" id="sourceoffund" name="sourceoffund" type="text" class="form-control" readonly>
					  <label class="active" for="sourceoffund">Source of Fund 10 </label>
					</div>
					<div class="form-group col-lg-6" <?php echo empty($fundsourcedata[11]['fundsource'])?"hidden":"" ?> >
					  <input value="<?php echo empty($fundsourcedata[11]['fundsource'])? "" : $fundsourcedata[11]['fundsource'].'-'.$fundsourcedata[11]['fs_amount']?>" id="sourceoffund" name="sourceoffund" type="text" class="form-control" readonly>
					  <label class="active" for="sourceoffund">Source of Fund 11 </label>
					</div>
					<div class="form-group col-lg-6" <?php echo empty($fundsourcedata[12]['fundsource'])?"hidden":"" ?> >
					  <input value="<?php echo empty($fundsourcedata[12]['fundsource'])? "" : $fundsourcedata[12]['fundsource'].'-'.$fundsourcedata[12]['fs_amount']?>" id="sourceoffund" name="sourceoffund" type="text" class="form-control" readonly>
					  <label class="active" for="sourceoffund">Source of Fund 12 </label>
					</div><br><br>
				
					<label class="col-lg-12" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
					<h5><small>&emsp;Client Address&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</small></h5>
					</label>
				
					<div class="form-group col-lg-6">
					  <input value="<?php echo $getClient['client_region']; ?>" id="region" name="region" type="text" class="form-control" readonly>
					  <label class="active" for="region">Region</label>
					</div>
					<div class="form-group col-lg-6">
					  <input value="<?php echo $getClient['client_province']; ?>" id="province" name="province" type="text" class="form-control" readonly>
					  <label class="active" for="province">Province</label>
					</div>
					<div class="form-group col-lg-6">
					  <input value="<?php echo $getClient['client_municipality']; ?>" id="cityMun" name="cityMun" type="text" class="form-control" readonly>
					  <label class="active" for="city/municipality">City/Municipality</label>
					</div>
					<div class="form-group col-lg-6">
					  <input value="<?php echo $getClient['client_barangay']; ?>" id="barangay" name="barangay" type="text" class="form-control" readonly>
					  <label class="active" for="barangay">Barangay</label>
					</div>
					<div class="form-group col-lg-6">
					  <input value="<?php echo $getClient['client_district'];?>" id="district" name="district" type="text" class="form-control" readonly>
					  <label class="active" for="district">District</label>
					</div>
					<div class="form-group col-lg-6">
					  <input value="<?php echo $getClient['client_street']; ?>" id="street" name="street" type="text" class="form-control" readonly>
					  <label class="active" for="street">Street/Purok</label>
					</div>
				
					<label class="col-lg-12" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
						<h5><small>&emsp;Beneficiary's Information&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</small></h5>
					</label>
			
					<div class="form-group col-lg-6">
					  <input value="<?php echo $getClient['relation'];?>" id="relation" name="relation" type="text" class="form-control" readonly>
					  <label class="active" for="sourceoffund">Relationship to Client</label>
					</div>
					<div class="form-group col-lg-6 beneshowdata">
					  <input value="<?php echo $getClient["b_fname"]." ". (!empty($getClient["b_mname"][0])?($getClient["b_mname"][0] != " "?strtoupper($getClient["b_mname"][0]) .". ":""):""). $getClient["b_lname"]."". strtoupper($getClient['b_exname'] != ""? " ".$getClient['b_exname'].".": "")?>" id="fullname" name="fullname" type="text" class="form-control" readonly>
					  <label class="active" for="fullname">Fullname</label>
					</div>
					<div class="form-group col-lg-6 beneshowdata">
					  <input value="<?php echo $getClient['b_civilStatus']; ?>" id="cs" name="cs" type="text" class="form-control" readonly>
					  <label class="active" for="civilstatus">Civil Status</label>
					</div>
					<div class="form-group col-lg-6 beneshowdata">
					  <input value="<?php echo $getClient['b_contact']; ?>" id="con" name="con" type="text" class="form-control" readonly>
					  <label class="active" for="contact">Contact</label>
					</div>
					<div class="form-group col-lg-6 beneshowdata">
					  <input value="<?php echo $getClient['b_bday']; ?>" id="dob" name="dob" type="text" class="form-control" readonly>
					  <label class="active" for="dateofbirth">Date Birth</label>
					</div>
					<div class="form-group col-lg-6 beneshowdata">
					  <input value="<?php echo $bage; ?>" id="age" name="age" type="text" class="form-control" readonly>
					  <label class="active" for="age">Age</label>
					</div>
					<div class="form-group col-lg-6 beneshowdata">
					  <input value="<?php echo $getClient['b_sex']; ?>" id="sex" name="sex" type="text" class="form-control" readonly>
					  <label class="active" for="sex">Sex</label>
					</div>
					<div class="form-group col-lg-6 beneshowdata">
					  <input value="<?php echo $getClient['b_category']; ?>" id="cat" name="cat" type="text" class="form-control" readonly>
					  <label class="active" for="category">Category</label>
					</div>
				</div>
			</div>
				
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
        </form> 		
		
	</div>

</body>
<script type="text/javascript">
        
	$(function () {
			if (document.getElementById('relation').value != 'Self') {
					$(".beneshowdata").show();
			}else{
					$(".beneshowdata").hide();
			}
	})
</script>
</html>