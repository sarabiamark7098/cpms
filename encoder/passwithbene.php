<?php
include('../php/class.user.php');
$user = new User();

	$clientid = $_GET['id'];
		
	if(isset($_POST['pass'])){
		$transid = $_GET['id'];
		//client the one that process the transaction
		$fname = mysqli_real_escape_string($user->db,strtoupper($_POST['firstname']));
		$mname = mysqli_real_escape_string($user->db,strtoupper($_POST['middlename']));
		$lname = mysqli_real_escape_string($user->db,strtoupper($_POST['lastname']));
		$exname = mysqli_real_escape_string($user->db,strtoupper($_POST['extraname']));
		$sex = mysqli_real_escape_string($user->db,$_POST['sex']);
		$bday = $_POST['birthday'];
		//$age = $user->getAge($bday);
		$occupation = mysqli_real_escape_string($user->db,$_POST['occupation']);
		if($_POST['salary'] != ''){
			$salary= $_POST['salary'];
		}else{
			$salary = '0';
		}
		if($_POST['pantawid_y']){
			$pantawid = "Yes";
		}elseif($_POST['pantawid_n']){
			$pantawid = "No";
		}
		$category = mysqli_real_escape_string($user->db,$_POST['category']);
		$civilStatus = mysqli_real_escape_string($user->db,$_POST['civilstatus']);
		$contact = $_POST['contact'];
		$region = mysqli_real_escape_string($user->db,$_POST['Cregion']);
		$province = mysqli_real_escape_string($user->db,$_POST['Cprovince']);
		$city_mun = mysqli_real_escape_string($user->db,$_POST['Ccity']);
		$barangay = mysqli_real_escape_string($user->db,$_POST['Cbarangay']);
		$district = mysqli_real_escape_string($user->db,$_POST['Cdistrict']);
		$street= mysqli_real_escape_string($user->db,$_POST['Cstreet']);
		$note = mysqli_real_escape_string($user->db,$_POST['note']);

		// beneficiary
		$relationship = mysqli_real_escape_string($user->db,$_POST['relation']);
		$b_fname = mysqli_real_escape_string($user->db,strtoupper($_POST['b_fname']));
		$b_mname = mysqli_real_escape_string($user->db,strtoupper($_POST['b_mname']));
		$b_lname = mysqli_real_escape_string($user->db,strtoupper($_POST['b_lname']));
		$b_exname = mysqli_real_escape_string($user->db, strtoupper($_POST['b_exname']));
		$b_bday = $_POST['b_bday'];
		//$b_age = $user->getAge($b_bday);
		$b_sex = mysqli_real_escape_string($user->db,$_POST['b_sex']);
		$b_civilStatus = mysqli_real_escape_string($user->db,$_POST['b_cstatus']);
		$b_contact = $_POST['b_contact'];
		$b_category = mysqli_real_escape_string($user->db,$_POST['b_category']);
		$b_region = mysqli_real_escape_string($user->db,$_POST['b_region']);
		$b_province = mysqli_real_escape_string($user->db,$_POST['b_province']);
		$b_city_mun = mysqli_real_escape_string($user->db,$_POST['b_city']);
		$b_district = mysqli_real_escape_string($user->db,$_POST['b_district']);
		$b_barangay = mysqli_real_escape_string($user->db,$_POST['b_barangay']);
		$b_street = mysqli_real_escape_string($user->db,$_POST['b_street']);
		
		

		$execute = $user->insertClientWBPassed($transid, $fname, $mname, $lname, $exname, $sex, $bday, $occupation, $salary, $pantawid, 
		$category, $civilStatus, $contact, $region, $province, $city_mun, $barangay, $district, $street, $relationship, 
		$b_fname, $b_mname, $b_lname, $b_exname, $b_bday, $b_sex, $b_civilStatus, $b_contact, $b_category, $b_region, 
		$b_province, $b_city_mun, $b_district, $b_barangay, $b_street, $note, 0, 1, 0);
	
		if($execute){
			echo "<script>alert('Client Successfully Passed!');</script>";
			echo "<script>window.location='picture.php?id=".$execute."';</script>";
			echo "<meta http-equiv='refresh' content='0'>";
		}
		else{
			echo "<script>alert('Sorry Error Passing Client!');</script>";
			echo "<script>window.location='home.php';</script>";
			echo "<meta http-equiv='refresh' content='0'>";
		}
	}
	$getClient = $user->clientData($clientid);
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
        
		<script src="../js/jquery.slim.min.js"></script>
		<script src="../js/popper.min.js"></script>
		<script src="../js/jquery.slim.min.js"></script>
		<script type="text/javascript" src="../js/jquery-3.2.1.slim.min.js"></script>
		<script type="text/javascript" src="../js/main.js"></script>
		<script type="text/javascript" src="../js/PSGC.js"></script>
		<script type="text/javascript" src="../js/jquery.min.js"></script>
        <script type="text/javascript" src="../js/jquery.inputmask.min.js"></script>
		<script type="text/javascript">
		$(document).ready(function(){
             $('#client_city').keyup(function(){  //On pressing a key on "Search box". This function will be called
                var txt = $('#client_city').val(); //Assigning search box value to javascript variable.
				if(txt != ''){ //Validating, if "name" is empty.
                    $.ajax({
                        type: "post", //method to use
                        url: "district.php", //ginapasa  sa diri nga file and data
                        data: {search:txt}, //mao ni nga data
                        success: function(html){  //If result found, this funtion will be call
							var json = JSON.parse(html);
                            $('#client_district').val( json["Client_district"]);
                        }
                    });
                }else{
                $('#search_result').html(""); 
                }
            });
        });
		$(document).ready(function(){
             $('#beneficiary_city').keyup(function(){  //On pressing a key on "Search box". This function will be called
                var txt = $('#beneficiary_city').val(); //Assigning search box value to javascript variable.
				if(txt != ''){ //Validating, if "name" is empty.
                    $.ajax({
                        type: "post", //method to use
                        url: "district.php", //ginapasa  sa diri nga file and data
                        data: {search:txt}, //mao ni nga data
                        success: function(html){  //If result found, this funtion will be call
							var json = JSON.parse(html);
                            $('#beneficiary_district').val( json["Client_district"]);
                        }
                    });
                }else{
                $('#search_result').html(""); 
                }
            });
        });
		</script>
	</head>
	<body>
	<div class="body">
	  <form class="form-group" action="passwithbene.php?id=<?php echo $clientid?>" method="POST">
	 	<div class="modal-body">
			<h4 class="text-center">Client Info</h4>
			<div class="form-group row">
				<div class="col-sm-12">
				<label>Note</label>
				<textarea type="text" class="form-control mr-sm-2 b" name="note" placeholder="Write Note for socialwork Referrence if needed"></textarea>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-12">
					<input id="foo" value="<?php echo $getClient['firstname'] ?>" type="text" name="firstname" class="form-control mr-sm-2 b" style="text-transform:uppercase" placeholder="First Name" required oninput="this.value = this.value.replace(/[^A-Za-zÑñÉéÈèÊêËë\-. ]/g, '').toUpperCase()">
					<label>First Name</label>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-12">
					<input type="text" value="<?php echo $getClient['middlename'] ?>" class="form-control mr-sm-2 b" name="middlename" style="text-transform:uppercase" placeholder="Middle Name"  oninput="this.value = this.value.replace(/[^A-Za-zÑñÉéÈèÊêËë\-. ]/g, '').toUpperCase()">    
					<label>Middle Name</label>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-12">
				<input type="text" value="<?php echo $getClient['lastname'] ?>" class="form-control mr-sm-2 b" name="lastname" style="text-transform:uppercase" placeholder="Last Name" required oninput="this.value = this.value.replace(/[^A-Za-zÑñÉéÈèÊêËë\-. ]/g, '').toUpperCase()">
					<label>Last Name</label>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-12">
					<!-- <input type="text" value="<?php //echo $getClient['extraname'] ?>" class="form-control mr-sm-2 b" name="extraname" style="text-transform:uppercase" placeholder="Extension Name"> -->
					<select name="extraname" class="form-control mr-sm-2 b">
						<option value=""  <?php echo empty($getClient['extraname'])?"selected":"" ?>> Extension Name</option>
						<option value="JR" <?php echo ($getClient['extraname']=="JR")?"selected":"" ?>>JR</option>
						<option value="SR" <?php echo ($getClient['extraname']=="SR")?"selected":"" ?>>SR</option>
						<option value="I" <?php echo ($getClient['extraname']=="I")?"selected":"" ?>>I</option>
						<option value="II" <?php echo ($getClient['extraname']=="II")?"selected":"" ?>>II</option>
						<option value="III" <?php echo ($getClient['extraname']=="III")?"selected":"" ?>>III</option>
						<option value="IV" <?php echo ($getClient['extraname']=="IV")?"selected":"" ?>>IV</option>
						<option value="V" <?php echo ($getClient['extraname']=="V")?"selected":"" ?>>V</option>
						<option value="VI" <?php echo ($getClient['extraname']=="VI")?"selected":"" ?>>VI</option>
						<option value="VII" <?php echo ($getClient['extraname']=="VII")?"selected":"" ?>>VII</option>
						<option value="VIII" <?php echo ($getClient['extraname']=="VIII")?"selected":"" ?>>VIII</option>
						<option value="IX" <?php echo ($getClient['extraname']=="IX")?"selected":"" ?>>IX</option>
						<option value="X" <?php echo ($getClient['extraname']=="X")?"selected":"" ?>>X</option>
					</select>
					<label>Extra Name</label>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 label" style="font-size: 20px">Birth Date: </label>
				<div class="col-sm-10">
					<input type="date" value="<?php echo $getClient['date_birth'] ?>" class="form-control mr-sm-2" name="birthday" placeholder="Birth Date" required>  
					<label>Birthday</label>
				</div>
			</div>
			
			<div class="form-group row">
			<div class="col-sm-6">
					<input list="sexs" name="sex" value="<?php echo $getClient['sex'] ?>" class="form-control mr-sm-2 b" placeholder="Sex" required>
						<datalist id="sexs">
							<option value="Male">
							<option value="Female">
							
						</datalist> 
						<label>Sex</label> 
					</div> 
				
				<div class="col-sm-6">
				<select name="civilstatus" class="form-control mr-sm-2 b" required >
					<?php
					if($getClient['civil_status'] == ''){
						echo '<option value="" disabled selected>Civil Status</option>';
						echo '<option value="Single">Single</option>';
						echo '<option value="Married">Married</option>';
						echo '<option value="Separated">Separated</option>';
						echo '<option value="Widow/Widowed">Widow/Widowed</option>';
						echo '<option value="Common-Law">Common-Law</option>';
					}elseif($getClient['civil_status'] == 'Single'){
						echo '<option value="" disabled>Civil Status</option>';
						echo '<option value="Single" selected>Single</option>';
						echo '<option value="Married">Married</option>';
						echo '<option value="Separated">Separated</option>';
						echo '<option value="Widow/Widowed">Widow/Widowed</option>';
						echo '<option value="Common-Law">Common-Law</option>';
					}elseif($getClient['civil_status'] == 'Married'){
						echo '<option value="" disabled>Civil Status</option>';
						echo '<option value="Single">Single</option>';
						echo '<option value="Married" selected>Married</option>';
						echo '<option value="Separated">Separated</option>';
						echo '<option value="Widow/Widowed">Widow/Widowed</option>';
						echo '<option value="Common-Law">Common-Law</option>';
					}elseif($getClient['civil_status'] == 'Separated'){
						echo '<option value="" disabled>Civil Status</option>';
						echo '<option value="Single">Single</option>';
						echo '<option value="Married">Married</option>';
						echo '<option value="Separated" selected>Separated</option>';
						echo '<option value="Widow/Widowed">Widow/Widowed</option>';
						echo '<option value="Common-Law">Common-Law</option>';
					}elseif($getClient['civil_status'] == 'Widow/Widowed'){
						echo '<option value="" disabled>Civil Status</option>';
						echo '<option value="Single">Single</option>';
						echo '<option value="Married">Married</option>';
						echo '<option value="Separated">Separated</option>';
						echo '<option value="Widow/Widowed" selected>Widow/Widowed</option>';
						echo '<option value="Common-Law">Common-Law</option>';
					}elseif($getClient['civil_status'] == 'Common-Law'){
						echo '<option value="" disabled>Civil Status</option>';
						echo '<option value="Single">Single</option>';
						echo '<option value="Married">Married</option>';
						echo '<option value="Separated">Separated</option>';
						echo '<option value="Widow/Widowed">Widow/Widowed</option>';
						echo '<option value="Common-Law" selected>Common-Law</option>';
					}
					?>
				</select>
				<label>Civil Status</label>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-12">
				<input type="text" value="<?php echo $getClient['occupation'] ?>" class="form-control mr-sm-2 b" name="occupation" placeholder="Occupation" required>
				<label>Occupation</label>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-12">
				<input type="number" value="<?php echo $getClient['salary'] ?>" class="form-control mr-sm-2 b currencyMaskedInput" name="salary" placeholder="Salary">
				<label>Salary</label>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-12">
				<input type="number" value="<?php echo $getClient['contact'] ?>" class="form-control mr-sm-2 b" name="contact" placeholder="Contact Number" onKeyPress="if(this.value.length==11) return false;" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,11);">
				<label>Contact</label>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-12">
					<input list="categories" type="text" value="<?php echo $getClient['category'] ?>" class="form-control mr-sm-2 b" name="category" placeholder="Category" required>
					<datalist id="categories">
						<option>Children in Need of Special Protection</option>
						<option>Persons Living with HIV/AIDS</option>
						<option>Youth</option>
						<option>Men/Women in Specially Difficult Circumstances</option>
						<option>Persons with Disabilities</option>
						<option>Senior Citizens (no subcategories)</option>
						<option>Family Heads and Other Needy Adult</option>
						<option>None of the Above</option>
					</datalist>
					<label>Category</label>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-3 label" style="font-size: 20px">4Ps Beneficiary: </label>
				<div class="checkbox col-1">
					<label for='radiobutton-y'>
						<input type="checkbox" id="radiobutton-y" class="checkbutton" name="pantawid_y" style="height:25px;width:25px;margin: 0px" required>
					</label>
				</div>
				<div class="checkbox col-3" style="margin-top: 3px">
					<label for='radiobutton-y'>
						<label for="yes"> <b>Yes</b></label>
					</label>
				</div>
				<div class="checkbox col-1">
					<label for='radiobutton-n'>
						<input type="checkbox" id="radiobutton-n" class="checkbutton" name="pantawid_n" style="height:25px;width:25px;margin: 0px" required>
					</label>
				</div>
				<div class="checkbox col-3" style="margin-top: 3px">
					<label for='radiobutton-n'>
						<label for="no"> <b>No</b></label>
					</label>
				</div>
			</div><br>	

				<!--Address-->
			<h4 class="text-center">Address</h4>
			<div class="form-group row">
				<div class="col-sm-12">
				<input list="regionClist" id="creg" value="<?php echo $getClient['client_region'] ?>" name="Cregion" class="form-control mr-sm-2 b" placeholder="Region" onChange="get_c_Region(this)" required>
					<datalist id="regionClist">
					<?php
						$getregions = $user->optionregion();
							//Loop through results
						foreach($getregions as $index => $value){
						  //Display info
							echo '<option value="'. $value['r_name'] .' /'. $value['psgc_code'] .'"> ';
							echo $value['psgc_code'];
							echo '</option>';
						}
					?>
					</datalist>
					<label>Region</label>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-12">
				<input list="provinceClist" id="cprov" value="<?php echo $getClient['client_province'] ?>" type="text" class="form-control mr-sm-2 b" name="Cprovince" placeholder="Province" onChange="get_c_Province(this)" required>
				<datalist id="provinceClist">
				</datalist>
				<label>Province</label>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-12">
				<input list="municipalityClist" value="<?php echo $getClient['client_municipality'] ?>" type="text" id="client_city" class="form-control mr-sm-2 b" name="Ccity" placeholder="City or Municipality" onChange="get_c_Municipality(this)" required>
				<datalist id="municipalityClist">
				</datalist>
				<label>Municipality</label>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-12">
				<input list="barangayClist" id="cbrgy" value="<?php echo $getClient['client_barangay'] ?>" type="text" class="form-control mr-sm-2 b" name="Cbarangay" placeholder="Barangay" onChange="get_c_Barangay(this)" required>
				<datalist id="barangayClist">
				</datalist>
				<label>Barangay</label>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-12">
					<select id="client_district" class="form-control mr-sm-2 b" name="Cdistrict" placeholder="District">
						<option value="" <?php echo ($getClient['client_district']==''?'selected':'')?>>Select District</option>
						<?php
							$getdistrict = $user->getdistrictlist();
							//Loop through results
							foreach($getdistrict as $index => $value){
								//Display info
								echo '<option value="'. $value['district_name'] .'" '. ($getClient['client_district']==$value['district_name']?'selected':'') .'> ';
								echo $value['district_name'];
								echo '</option>';
							}
						?>
					</select>
					<label>District</label>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-12">
				<input type="text" id="cstr" value="<?php echo $getClient['client_street'] ?>" class="form-control mr-sm-2 b" name="Cstreet" placeholder="No./Street/Purok">
				<label>Street</label>
				</div>
			</div>
			

			<!--Check Box, Beneficiary info sheet-->
			<div class="checkbox">
				<label data-target="#collapseCheck" aria-expanded="false" aria-controls="collapseCheck">
					<input type="checkbox" name="beneficiary" id="withbene" style="height:20px;width:20px;margin: 10px" checked disabled> With BENEFICIARY
				</label>
			</div>
			<div id="collapseCheck" aria-expanded="false">
				<h4 class="text-center">Beneficiary Info</h4>
				<div class="form-group row">
					<div class="col-sm-12">
					<select name="relation" class="form-control mr-sm-2 b benerequire">
							<option value="" disabled <?php echo ($getClient['relation']==""?"selected":"") ?>>Relation With Beneficiary</option>
							<?php
								$getrelation = $user->getrelationshiplist();
								//Loop through results
								foreach($getrelation as $index => $value){
									//Display info
									echo '<option value="'. $value['relation'] .'" '.  ($getClient['relation']==$value['relation']?"selected":"") .'> ';
									echo $value['relation'];
									echo '</option>';
								}
							?>  
						</select>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-12">
						<input id="foo" type="text" value="<?php echo $getClient['b_fname']; ?>" name="b_fname" class="form-control mr-sm-2 b benerequire" style="text-transform:uppercase" placeholder="Beneficiary First Name" oninput="this.value = this.value.replace(/[^A-Za-zÑñÉéÈèÊêËë\-. ]/g, '').toUpperCase()">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-12">
						<input type="text" value="<?php echo $getClient['b_mname']; ?>" class="form-control mr-sm-2 b benerequire" name="b_mname" style="text-transform:uppercase" placeholder="Beneficiary Middle Name" oninput="this.value = this.value.replace(/[^A-Za-zÑñÉéÈèÊêËë\-. ]/g, '').toUpperCase()">    
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-12">
					<input type="text" value="<?php echo $getClient['b_lname']; ?>" class="form-control mr-sm-2 b benerequire" name="b_lname" style="text-transform:uppercase" placeholder="Beneficiary Last Name" oninput="this.value = this.value.replace(/[^A-Za-zÑñÉéÈèÊêËë\-. ]/g, '').toUpperCase()">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-12">
						<!-- <input type="text" value="<?php //echo $getClient['b_exname']; ?>" class="form-control mr-sm-2 b" name="b_exname" style="text-transform:uppercase" placeholder="Beneficiary Extension Name"> -->
						<select name="b_exname" class="form-control mr-sm-2 b">
							<option value=""  <?php echo empty($getClient['b_exname'])?"selected":"" ?>> Extension Name</option>
							<option value="JR" <?php echo ($getClient['b_exname']=="JR")?"selected":"" ?>>JR</option>
							<option value="SR" <?php echo ($getClient['b_exname']=="SR")?"selected":"" ?>>SR</option>
							<option value="I" <?php echo ($getClient['b_exname']=="I")?"selected":"" ?>>I</option>
							<option value="II" <?php echo ($getClient['b_exname']=="II")?"selected":"" ?>>II</option>
							<option value="III" <?php echo ($getClient['b_exname']=="III")?"selected":"" ?>>III</option>
							<option value="IV" <?php echo ($getClient['b_exname']=="IV")?"selected":"" ?>>IV</option>
							<option value="V" <?php echo ($getClient['b_exname']=="V")?"selected":"" ?>>V</option>
							<option value="VI" <?php echo ($getClient['b_exname']=="VI")?"selected":"" ?>>VI</option>
							<option value="VII" <?php echo ($getClient['b_exname']=="VII")?"selected":"" ?>>VII</option>
							<option value="VIII" <?php echo ($getClient['b_exname']=="VIII")?"selected":"" ?>>VIII</option>
							<option value="IX" <?php echo ($getClient['b_exname']=="IX")?"selected":"" ?>>IX</option>
							<option value="X" <?php echo ($getClient['b_exname']=="X")?"selected":"" ?>>X</option>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 label" style="font-size: 20px">Birth Date: </label>
					<div class="col-sm-10">
						<input type="date" value="<?php echo $getClient['b_bday']; ?>" class="form-control mr-sm-2 benerequire" name="b_bday" placeholder="Beneficiary Birth Date">  
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-6">
					<input list="sexs" name="b_sex" value="<?php echo $getClient['b_sex'] ?>" class="form-control mr-sm-2 b benerequire" placeholder="Beneficiary Sex">
						<datalist id="sexs">
							<option value="Male">
							<option value="Female">
							
						</datalist>  
					</div>
					<div class="col-sm-6">
					<select name="b_cstatus" class="form-control mr-sm-2 b benerequire" >
					<?php
					if($getClient['b_civilStatus'] == ''){
						echo '<option value="" disabled selected>Civil Status</option>';
						echo '<option value="Single">Single</option>';
						echo '<option value="Married">Married</option>';
						echo '<option value="Separated">Separated</option>';
						echo '<option value="Widow/Widowed">Widow/Widowed</option>';
						echo '<option value="Common-Law">Common-Law</option>';
					}elseif($getClient['b_civilStatus'] == 'Single'){
						echo '<option value="" disabled>Civil Status</option>';
						echo '<option value="Single" selected>Single</option>';
						echo '<option value="Married">Married</option>';
						echo '<option value="Separated">Separated</option>';
						echo '<option value="Widow/Widowed">Widow/Widowed</option>';
						echo '<option value="Common-Law">Common-Law</option>';
					}elseif($getClient['b_civilStatus'] == 'Married'){
						echo '<option value="" disabled>Civil Status</option>';
						echo '<option value="Single">Single</option>';
						echo '<option value="Married" selected>Married</option>';
						echo '<option value="Separated">Separated</option>';
						echo '<option value="Widow/Widowed">Widow/Widowed</option>';
						echo '<option value="Common-Law">Common-Law</option>';
					}elseif($getClient['b_civilStatus'] == 'Separated'){
						echo '<option value="" disabled>Civil Status</option>';
						echo '<option value="Single">Single</option>';
						echo '<option value="Married">Married</option>';
						echo '<option value="Separated" selected>Separated</option>';
						echo '<option value="Widow/Widowed">Widow/Widowed</option>';
						echo '<option value="Common-Law">Common-Law</option>';
					}elseif($getClient['b_civilStatus'] == 'Widow/Widowed'){
						echo '<option value="" disabled>Civil Status</option>';
						echo '<option value="Single">Single</option>';
						echo '<option value="Married">Married</option>';
						echo '<option value="Separated">Separated</option>';
						echo '<option value="Widow/Widowed" selected>Widow/Widowed</option>';
						echo '<option value="Common-Law">Common-Law</option>';
					}elseif($getClient['b_civilStatus'] == 'Common-Law'){
						echo '<option value="" disabled>Civil Status</option>';
						echo '<option value="Single">Single</option>';
						echo '<option value="Married">Married</option>';
						echo '<option value="Separated">Separated</option>';
						echo '<option value="Widow/Widowed">Widow/Widowed</option>';
						echo '<option value="Common-Law" selected>Common-Law</option>';
					}
					?>
				</select>
					</div>
				</div>
					<div class="form-group row">
					<div class="col-sm-12">
					<input type="text" value="<?php echo $getClient['b_contact'] ?>" class="form-control mr-sm-2 b" name="b_contact" placeholder="Beneficiary Contact Number" onKeyPress="if(this.value.length==11) return false;"  oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,11);">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-12">
						<input list="b_categories" type="text" value="<?php echo $getClient['b_category'] ?>" class="form-control mr-sm-2 b benerequire" name="b_category" placeholder="Beneficiary Category" >
						<datalist id="b_categories">
							<option>Children in Need of Special Protection</option>
							<option>Persons Living with HIV/AIDS</option>
							<option>Youth</option>
							<option>Men/Women in Specially Difficult Circumstances</option>
							<option>Persons with Disabilities</option>
							<option>Senior Citizens (no subcategories)</option>
							<option>Family Heads and Other Needy Adult</option>
							<option>None of the Above</option>
						</datalist>
					</div>
				</div>
				


				<!--Address-->
				<h4 class="text-center">Beneficiary Address</h4>
				<div class="row" style="margin-bottom: 2%;">
					<div class="col-8">
					</div>  
					<div class="col-4">
						<input class="btn btn-primary" style="border:none;" type="button" value="Copy Client Address" onclick="copyaddressclient()"></input>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-12">
					<input list="regionBlist" id="breg" value="<?php echo $getClient['b_region'] ?>" type="text" class="form-control mr-sm-2 b benerequire" name="b_region" placeholder="Beneficiary Region" onChange="get_b_Region(this)">
					<datalist id="regionBlist">
					<?php
						$getregions = $user->optionregion();
							//Loop through results
						foreach($getregions as $index => $value){
						  //Display info
							echo '<option value="'. $value['r_name'] .' /'. $value['psgc_code'] .'"> ';
							echo $value['psgc_code'];
							echo '</option>';
						}
					?>
					</datalist>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-12">
					<input list="provinceBlist" id="bprov" value="<?php echo $getClient['b_province'] ?>" type="text" class="form-control mr-sm-2 b benerequire" name="b_province" placeholder="Beneficiary Province" onChange="get_b_Province(this)" >
					<datalist id="provinceBlist">
					</datalist>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-12">
					<input list="municipalityBlist" value="<?php echo $getClient['b_municipality'] ?>" type="text" id="beneficiary_city" class="form-control mr-sm-2 b benerequire" name="b_city" placeholder="Beneficiary City or Municipality" onChange="get_b_Municipality(this)">
					<datalist id="municipalityBlist">
					</datalist>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-12">
					<input list="barangayBlist" id="bbrgy" value="<?php echo $getClient['b_barangay'] ?>" type="text" class="form-control mr-sm-2 b benerequire" name="b_barangay" placeholder="Beneficiary Barangay"onChange="get_b_Barangay(this)">
					<datalist id="barangayBlist">
					</datalist>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-12">
						<select id="beneficiary_district" class="form-control mr-sm-2 b" name="b_district" placeholder="District">
							<option value="" <?php echo ($getClient['b_district']==''?'selected':'')?>>Select District</option>
							<?php
								$getdistrict = $user->getdistrictlist();
								//Loop through results
								foreach($getdistrict as $index => $value){
									//Display info
									echo '<option value="'. $value['district_name'] .'" '. ($getClient['b_district']==$value['district_name']?'selected':'') .'> ';
									echo $value['district_name'];
									echo '</option>';
								}
							?>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-12">
					<input type="text" id="bstr" value="<?php echo $getClient['b_street'] ?>" class="form-control mr-sm-2 b" name="b_street" placeholder="Beneficiary No./Street/Purok">
					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
			<button type="submit" class="btn btn-primary" name="pass" onclick="msg()">Next Step</button>
		</div>
		<script>
			function msg(){
				alert("Adding Client!");
			}
		</script>
        </form> 	
</body>
<script type="text/javascript">

	$(function () {
		$(".benerequire").attr('required', '');
	});
		
	$(function () {
		reg = document.getElementById('creg').value;
		prov = document.getElementById('cprov').value;
		muni = document.getElementById('client_city').value;
		brgy = document.getElementById('cbrgy').value;
		dist = document.getElementById('client_district').value.trim();
		str = document.getElementById('cstr').value;
	
		get_c_Region(document.getElementById('creg'));
		get_c_Province(document.getElementById('cprov'));
		get_c_Municipality(document.getElementById('client_city'));
		get_c_Barangay(document.getElementById('cbrgy'));

		document.getElementById('creg').value = reg;
		document.getElementById('cprov').value = prov;
		document.getElementById('client_city').value = muni;
		document.getElementById('cbrgy').value = brgy;
		document.getElementById('cstr').value = str;

		setTimeout(() => {
			const bDist = document.getElementById('client_district');
			for (let i = 0; i < bDist.options.length; i++) {
				if (bDist.options[i].value.trim() === dist) {
					bDist.selectedIndex = i;
					break;
				}
			}
		}, 500);

		breg = document.getElementById('breg').value;
		bprov = document.getElementById('bprov').value;
		bmuni = document.getElementById('beneficiary_city').value;
		bbrgy = document.getElementById('bbrgy').value;
		bdist = document.getElementById('beneficiary_district').value.trim();
		bstr = document.getElementById('bstr').value;
	

		document.getElementById('creg').value = breg;
		document.getElementById('cprov').value = bprov;
		document.getElementById('client_city').value = bmuni;
		document.getElementById('cbrgy').value = bbrgy;
		document.getElementById('cstr').value = bstr;

		benedist = document.getElementById('beneficiary_district').value.trim();

		get_b_Region(document.getElementById('breg'))
		get_b_Province(document.getElementById('bprov'))
		get_b_Municipality(document.getElementById('beneficiary_city'))
		get_b_Barangay(document.getElementById('bbrgy'))
		
		
		document.getElementById('breg').value = breg;
		document.getElementById('bprov').value = bprov;
		document.getElementById('beneficiary_city').value = bmuni;
		document.getElementById('bbrgy').value = bbrgy;
		document.getElementById('bstr').value = bstr;

		setTimeout(() => {
			const beDist = document.getElementById('beneficiary_district');
			for (let i = 0; i < beDist.options.length; i++) {
				if (beDist.options[i].value.trim() === benedist) {
					beDist.selectedIndex = i;
					break;
				}
			}
		}, 500);
	});

	function copyaddressclient() {
		reg = document.getElementById('creg').value;
		prov = document.getElementById('cprov').value;
		muni = document.getElementById('client_city').value;
		brgy = document.getElementById('cbrgy').value;
		dist = document.getElementById('client_district').value.trim();
		str = document.getElementById('cstr').value;
		// console.log(reg);console.log(prov);console.log(muni);console.log(brgy);console.log(dist);console.log(str);

		get_b_Region(document.getElementById('creg'));
		get_b_Province(document.getElementById('cprov'));
		get_b_Municipality(document.getElementById('client_city'));
		get_b_Barangay(document.getElementById('cbrgy'));
		
		document.getElementById('breg').value = reg;
		document.getElementById('bprov').value = prov;
		document.getElementById('beneficiary_city').value = muni;
		document.getElementById('bbrgy').value = brgy;
		document.getElementById('bstr').value = str;
		
		setTimeout(() => {
			const bDist = document.getElementById('beneficiary_district');
			for (let i = 0; i < bDist.options.length; i++) {
				if (bDist.options[i].value.trim() === dist) {
					bDist.selectedIndex = i;
					break;
				}
			}
		}, 500);
	}

	$(function () {
		$("#radiobutton-y").click(function () {
			if ($(this).prop("checked")) {
				$("#radiobutton-n").prop("checked", false);
			}
		});
		$("#radiobutton-n").click(function () {
			if ($(this).prop("checked")) {
				$("#radiobutton-y").prop("checked", false);
			}
		});
	});

	$(function () {
		$("#radiobutton-y").change(function () {
			if ($(this).is(":checked")) {
				$("#radiobutton-n").not($(this)).each(function () {
					$(this).removeAttr("required");
				});
			}
		});
		$("#radiobutton-n").change(function () {
			if ($(this).is(":checked")) {
				$("#radiobutton-y").not($(this)).each(function () {
					$(this).removeAttr("required");
				});
			}
		});
	});
</script>
</html>