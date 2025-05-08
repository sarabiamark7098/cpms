<?php
include('../php/class.user.php');
$user = new User();

	$clientid = $user->getClientId($_GET['id']);
	$_SESSION['myid'] = $clientid;

	$img = $user->getClientImage($_GET['id']);

	$client= $user->clientData($_GET['id']);
	if(!$_SESSION['login']){
		header('Location:../index.php');
		}
?>
	<script type="text/javascript" src="../js/PSGC.js"></script>
	<div class="body">
	  <form class="form-group" action="gis.php?id=<?php echo $_GET['id']?>" method="POST">
			<div class="modal-body">
				<div class="row form-group" >
					<div class="col text-center">
						<img class="responsive-img" src="<?php echo $img?>" style="width: 40%; border-radius: 50%;margin:auto">
						<p>Client Picture</p>
					</div>
						<div class="form-group col align-self-end">
							<input value="<?php echo $clientid;?>" name="client_id" class="form-control" readonly style="border: 1px solid #b1acac;">
							<label for="client_id">Client ID</label>
						</div>
					</div>
				<div>
				<div class="row" style="margin-top: 2%; height:10%;">
						<div class="form-group col-lg-6">
							<input  name="lname" type="text" class="form-control" style="border: 1px solid #b1acac;" value="<?php echo $client['lastname']?>" required oninput="this.value = this.value.replace(/[^A-Za-zÑñÉéÈèÊêËë\-.]/g, '').toUpperCase()">
							<label>Lastname</label>
						</div>
						<div class="form-group col-lg-6">
							<input name="fname" type="text" class="form-control" style="border: 1px solid #b1acac;" value="<?php echo $client['firstname']?>" required oninput="this.value = this.value.replace(/[^A-Za-zÑñÉéÈèÊêËë\-.]/g, '').toUpperCase()">
							<label>Firstname</label>
						</div>
				</div>
				<div class="row" style="margin-top: 2%; height:10%;">
						<div class="form-group col-lg-6">
							<input  name="mname" type="text" class="form-control" style="border: 1px solid #b1acac;" value="<?php echo $client['middlename']?>" oninput="this.value = this.value.replace(/[^A-Za-zÑñÉéÈèÊêËë\-.]/g, '').toUpperCase()">
							<label>Middlename</label>
						</div>
						<div class="form-group col-lg-6">
							<!-- <input name="exname" type="text" class="form-control" style="border: 1px solid #b1acac;" value="<?php //echo $client['extraname']?>"> -->
							<select name="exname" class="form-control" style="border: 1px solid #b1acac;">
								<option value=""  <?php echo (empty($client['extraname'])?'selected':'') ?>> Extension Name</option>
								<option value="JR" <?php echo (($client['extraname'] == 'JR')?'selected':'') ?>>JR</option>
								<option value="SR" <?php echo (($client['extraname'] == 'SR')?'selected':'') ?>>SR</option>
								<option value="I" <?php echo (($client['extraname'] == 'I')?'selected':'') ?>>I</option>
								<option value="II" <?php echo (($client['extraname'] == 'II')?'selected':'') ?>>II</option>
								<option value="III" <?php echo (($client['extraname'] == 'III')?'selected':'') ?>>III</option>
								<option value="IV" <?php echo (($client['extraname'] == 'IV')?'selected':'') ?>>IV</option>
								<option value="V" <?php echo ($client['extraname']=="V")?"selected":"" ?>>V</option>
								<option value="VI" <?php echo ($client['extraname']=="VI")?"selected":"" ?>>VI</option>
								<option value="VII" <?php echo ($client['extraname']=="VII")?"selected":"" ?>>VII</option>
								<option value="VIII" <?php echo ($client['extraname']=="VIII")?"selected":"" ?>>VIII</option>
								<option value="IX" <?php echo ($client['extraname']=="IX")?"selected":"" ?>>IX</option>
								<option value="X" <?php echo ($client['extraname']=="X")?"selected":"" ?>>X</option>
							</select>
							<label>Extension Name</label>
						</div>
				</div>
				<div class="row" style="margin-top: 2%; height:10%;">
						<div class="form-group col-lg-6">
							<input  name="bday" type="date" class="form-control" style="border: 1px solid #b1acac;" max= "<?php echo date('Y-m-d'); ?>" value="<?php echo $client['date_birth']?>" required>
							<label>Birth Date</label>
						</div>
						<div class="form-group col-lg-6">
							<select name="sex" type="text"  class="form-control" style="border: 1px solid #b1acac;" required>
								<option value="" disabled>Sex</option>
								<option value="Male" <?php echo (($client['sex'] == 'Male')?'selected':'') ?>>Male</option>
								<option value="Female" <?php echo (($client['sex'] == 'Female')?'selected':'') ?>>Female</option>
							</select>
							<label>Sex</label>
						</div>
				</div>
				<h5><small><b>Address</b></small></h5>
				<div class="row" style="margin-top: 2%; height:10%;">
						<div class="form-group col-lg-6">
							<input list="regionClist" name="region" type="text" id="creg" class="form-control" style="border: 1px solid #b1acac; text-transform:none;" value="<?php echo $client['client_region']?>"  onChange="get_c_Region(this)" required>
							<label>Region</label>
							<datalist id="regionClist">
								<?php
									$getregions = $user->optionregion();
										//Loop through results
									foreach($getregions as $index => $value){
									//Display info
										unset($_SESSION['regionname']);
										echo '<option value="'. $value['r_name'] .' /'. $value['psgc_code'] .'"> ';
										echo $value['psgc_code'];
										echo '</option>';
									}
								?>
							</datalist>
						</div>
						<div class="form-group col-lg-6">
							<input list="provinceClist" name="province" type="text" id="cprov" class="form-control" style="border: 1px solid #b1acac; text-transform:none;" value="<?php echo $client['client_province']?>" onChange="get_c_Province(this)" required>
							<label>Province</label>
							<datalist id="provinceClist">
				        	</datalist>
						</div>
				</div>
				<div class="row" style="margin-top: 2%; height:10%;">
						<div class="form-group col-lg-6">
							<input list="municipalityClist" name="municipality" type="text" id="cmuni" class="form-control" style="border: 1px solid #b1acac; text-transform:none;" value="<?php echo $client['client_municipality']?>" onChange="get_c_Municipality(this)" required>
							<label>Municipality</label>
							<datalist id="municipalityClist">
							</datalist>
						</div>
						<div class="form-group col-lg-6">
							<input list="barangayClist" name="barangay" type="text" id="cbrgy" class="form-control" style="border: 1px solid #b1acac; text-transform:none;" value="<?php echo $client['client_barangay']?>" onChange="get_c_Barangay(this)" required>
							<label>Barangay</label>
							<datalist id="barangayClist">
							</datalist>
						</div>
				</div>
				<div class="row" style="margin-top: 2%; height:10%;">
						<div class="form-group col-lg-6">
							<input  name="street" type="text" class="form-control" style="border: 1px solid #b1acac; text-transform:none;" value="<?php echo $client['client_street']?>">
							<label>Street/Purok</label>
						</div>
						<div class="form-group col-lg-6">
							<!-- <input name="district" type="text" class="form-control" style="border: 1px solid #b1acac; text-transform:none;" value="<?php //echo $client['client_district']?>"> -->
							<select name="district" id="client_district" type="text" class="form-control" style="border: 1px solid #b1acac; text-transform: none;">
								<option value=""  <?php (($client['client_district']=="")?"selected":"") ?>>Select District</option>
								<?php
									$getdistrict = $user->getdistrictlist();
									//Loop through results
									foreach($getdistrict as $index => $value){
										//Display info
										echo '<option value="'. $value['district_name'] .'" '. (($client['client_district']==$value['district_name'])?"selected":"") .'> ';
										echo $value['district_name'];
										echo '</option>';
									}
								?>
							</select>
							<label>District</label>
						</div>
				</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type='submit' class='btn btn-primary' name='c_update'>Update</button>
			</div>
    </form> 		
	
<script type="text/javascript">
	$(function () {
		reg = document.getElementById('creg').value;
		prov = document.getElementById('cprov').value;
		muni = document.getElementById('cmuni').value;
		brgy = document.getElementById('cbrgy').value;

		get_c_Region_sw(reg);
		get_c_Province_sw(prov);
		get_c_Municipality_sw(muni);
		get_c_Barangay_sw(brgy);
	});
</script>