<?php
include('../php/class.user.php');
$user = new User();

	if(!$_SESSION['login']){
		header('Location:../index.php');
		}

?>
	<script type="text/javascript" src="../js/PSGC.js"></script>
	<div class="body">
	  <form class="form-group" action="gis.php?id=<?php echo $_GET['id']?>" method="POST">
			<div class="modal-body">
            <h1 class="text-center">Beneficiary Information</h1> <br>
                <div class="row" style="margin-top: 2%; height:10%;">
                    <div class="form-group col-lg-6">
                        <!-- <input  name="relation" type="text" class="form-control" style="border: 1px solid #b1acac; text-transform: none;" placeholder="Relation to Client" required> -->
						<select name="relation" class="form-control" style="border: 1px solid #b1acac; text-transform: none;" required>
							<option value="" disabled selected>Relation With Beneficiary</option>
                            <?php
                                $getrelation = $user->getrelationshiplist();
                                //Loop through results
                                foreach($getrelation as $index => $value){
                                    //Display info
                                    echo '<option value="'. $value['relation'] .'"> ';
                                    echo $value['relation'];
                                    echo '</option>';
                                }
                            ?>
                        </select>
                        <label>Relationship with the client</label>
                    </div>
                </div>
                <!---->
				<div class="row" style="margin-top: 2%; height:10%;">
                    <div class="form-group col-lg-6">
                        <input  name="lname" type="text" class="form-control" style="border: 1px solid #b1acac;" placeholder="Last Name" required oninput="this.value = this.value.replace(/[^A-Za-zÑñÉéÈèÊêËë\-. ]/g, '').toUpperCase()">
                        <label>Lastname</label>
                    </div>
                    <div class="form-group col-lg-6">
                        <input name="fname" type="text" class="form-control" style="border: 1px solid #b1acac;" placeholder="First Name" required oninput="this.value = this.value.replace(/[^A-Za-zÑñÉéÈèÊêËë\-. ]/g, '').toUpperCase()">
                        <label>Firstname</label>
                    </div>
				</div>
				<div class="row" style="margin-top: 2%; height:10%;">
						<div class="form-group col-lg-6">
							<input  name="mname" type="text" class="form-control" style="border: 1px solid #b1acac;" placeholder="Middle Name" oninput="this.value = this.value.replace(/[^A-Za-zÑñÉéÈèÊêËë\-. ]/g, '').toUpperCase()">
							<label>Middlename</label>
						</div>
						<div class="form-group col-lg-6">
							<!-- <input name="exname" type="text" class="form-control" style="border: 1px solid #b1acac;" placeholder="Extra Name"> -->
							<select name="exname" class="form-control" style="border: 1px solid #b1acac;">
								<option value="" selected> Extension Name</option>
								<option value="JR">JR</option>
								<option value="SR">SR</option>
								<option value="I">I</option>
								<option value="II">II</option>
								<option value="III">III</option>
								<option value="IV">IV</option>
								<option value="V">V</option>
								<option value="VI">VI</option>
								<option value="VII">VII</option>
								<option value="VIII">VIII</option>
								<option value="IX">IX</option>
								<option value="X">X</option>
							</select>
							<label>Extension Name</label>
						</div>
				</div>
				<div class="row" style="margin-top: 2%; height:10%;">
						<div class="form-group col-lg-6">
							<input  name="bday" type="date"  class="form-control" style="border: 1px solid #b1acac;" max= "<?php echo date('Y-m-d'); ?>" required>
							<label>Birth Date</label>
						</div>
						<div class="form-group col-lg-6">
							<select name="sex" type="text"  class="form-control" style="border: 1px solid #b1acac;" required>
								<option value="" disabled selected>Sex</option>
								<option value="Male">Male</option>
								<option value="Female">Female</option>
							</select>
							<label>Sex</label>
						</div>
				</div>
                <div class="row" style="margin-top: 2%; height:10%;">
						<div class="form-group col-lg-6">
							<input list="categories" name="category" type="text"  class="form-control" style="border: 1px solid #b1acac; text-transform: none;" placeholder="Category" required>
							<label>Category</label>
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
						</div>
						<div class="form-group col-lg-6">
							<select name="status" type="text" class="form-control" style="border: 1px solid #b1acac;" required>
								<option value="" disabled selected>Civil Status</option>
								<option value="Single">Single</option>
								<option value="Married">Married</option>
								<option value="Separated">Separated</option>
								<option value="Widow/Widowed">Widow/Widowed</option>
								<option value="Common-Law">Common-law</option>
							</select>
							<label>Civil Status</label>
						</div>
				</div>
                <div class="row" style="margin-top: 2%; height:10%;">
					<div class="form-group col-lg-6">
                        <input name="contact" type="text"  class="form-control" style="border: 1px solid #b1acac;" placeholder="Contact Number" onKeyPress="if(this.value.length==11) return false;" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,11);">
                        <label>Contact</label>
                    </div>
                    <div class="form-group col-lg-6">
                    </div>
				</div><br>
				<h4><b>Address</b></h4>

				<div class="row" style="margin-top: 2%; height:10%;">
                    <div class="form-group col-lg-6">
                        <input  list="regionClist" name="region" id="newreg" type="text" class="form-control" style="border: 1px solid #b1acac; text-transform: none;" onChange="get_c_Region(this)" required>
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
                        <input list="provinceClist" name="province" id="newprov" type="text" class="form-control" onChange="get_c_Province(this)" style="border: 1px solid #b1acac; text-transform: none;" required/>
                        <label>Province</label>
                        <datalist id="provinceClist">
				        </datalist>
				    </div>
                </div>

				<div class="row" style="margin-top: 2%; height:10%;">
					<div class="form-group col-lg-6">
						<input list="municipalityClist" name="municipality" id="newmuni" type="text" onChange="get_c_Municipality(this)" class="form-control" style="border: 1px solid #b1acac; text-transform: none;" required>
						<label>Municipality</label>
						<datalist id="municipalityClist">
						</datalist>
					</div>
					<div class="form-group col-lg-6">
						<input list="barangayClist" name="barangay" id="newbrgy" type="text" class="form-control" onChange="get_c_Barangay(this)" style="border: 1px solid #b1acac; text-transform: none;" required>
						<label>Barangay</label>
						<datalist id="barangayClist">
						</datalist>
					</div>
				
				</div>			
				<div class="row" style="margin-top: 2%; height:10%;">
					<div class="form-group col-lg-6">
						<input  name="street" type="text" id="newstr" class="form-control" style="border: 1px solid #b1acac; text-transform: none;">
						<label>Street/Purok</label>
					</div>
					<div class="form-group col-lg-6">
						<select id="newdist" class="form-control mr-sm-2 b" name="district" placeholder="Beneficiary District" style="border: 1px solid #b1acac; text-transform: none;">
							<option value="">Select Beneficiary District</option>
							<?php
								$getdistrict = $user->getdistrictlist();
								//Loop through results
								foreach($getdistrict as $index => $value){
									//Display info
									echo '<option value="'. $value['district_name'] .'"> ';
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
					<button type='submit' class='btn btn-primary' name='add_bene'>Add</button>
			</div>
    </form> 		

<script type="text/javascript">

	function copyaddress(){
		reg = document.getElementById('oldreg').value;
		prov = document.getElementById('oldprov').value;
		muni = document.getElementById('oldmuni').value;
		brgy = document.getElementById('oldbrgy').value;
		str = document.getElementById('oldstr').value;
		dist = document.getElementById('olddist').value;

		document.getElementById('newreg').value = reg;
		document.getElementById('newprov').value = prov;
		document.getElementById('newmuni').value = muni;
		document.getElementById('newbrgy').value = brgy
		document.getElementById('newstr').value = str;
		document.getElementById('newdist').value = dist;
		
		get_c_Region_sw(reg);
		get_c_Province_sw(prov);
		get_c_Municipality_sw(muni);
		get_c_Barangay_sw(brgy);
	}

</script>