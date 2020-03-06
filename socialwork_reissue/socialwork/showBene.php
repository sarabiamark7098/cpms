<?php
include('../../php/class.user.php');
$user = new User();

	$bene = $user->getBeneData($_GET['id']);
	if(!$_SESSION['login']){
		header('Location:../../index.php');
		}

?>
	<script type="text/javascript" src="../../js/PSGC.js"></script>
	<div class="body">
	  <form class="form-group" action="gis.php?id=<?php echo $_GET['id']?>" method="POST">
			<div class="modal-body">
            <h1 class="text-center">Beneficiary Information</h1> <br>
                <div class="row" style="margin-top: 2%; height:10%;">
                    <div class="form-group col-lg-6">
                        <input  name="relation" type="text" class="form-control" style="border: 1px solid #b1acac; text-transform: none;" value="<?php echo $bene['relation']?>">
                        <label>Relationship with the client</label>
                    </div>
                </div>
                <!---->
				<div class="row" style="margin-top: 2%; height:10%;">
                    <div class="form-group col-lg-6">
                        <input  name="lname" type="text" class="form-control" style="border: 1px solid #b1acac;" value="<?php echo $bene['b_lname']?>">
                        <label>Lastname</label>
                    </div>
                    <div class="form-group col-lg-6">
                        <input name="fname" type="text" class="form-control" style="border: 1px solid #b1acac;" value="<?php echo $bene['b_fname']?>">
                        <label>Firstname</label>
                    </div>
				</div>
				<div class="row" style="margin-top: 2%; height:10%;">
						<div class="form-group col-lg-6">
							<input  name="mname" type="text" class="form-control" style="border: 1px solid #b1acac;" value="<?php echo $bene['b_mname']?>">
							<label>Middlename</label>
						</div>
						<div class="form-group col-lg-6">
							<input name="exname" type="text" class="form-control" style="border: 1px solid #b1acac;" value="<?php echo $bene['b_exname']?>">
							<label>Extension Name</label>
						</div>
				</div>
				<div class="row" style="margin-top: 2%; height:10%;">
						<div class="form-group col-lg-6">
							<input  name="bday" type="date"  class="form-control" style="border: 1px solid #b1acac;" max= "<?php echo date('Y-m-d'); ?>" value="<?php echo $bene['b_bday']?>">
							<label>Birth Date</label>
						</div>
						<div class="form-group col-lg-6">
							<select name="sex" type="text"  class="form-control" style="border: 1px solid #b1acac;">
								<option value="" disabled <?php echo ($bene['b_sex']==""?"selected":"")?>>Sex</option>
								<option value="Male" <?php echo ($bene['b_sex']=="Male"?"selected":"")?>>Male</option>
								<option value="Female" <?php echo ($bene['b_sex']=="Female"?"selected":"")?>>Female</option>
							</select>
							<label>Sex</label>
						</div>
				</div>
                <div class="row" style="margin-top: 2%; height:10%;">
						<div class="form-group col-lg-6">
							<input list="categories" name="category" type="text"  class="form-control" style="border: 1px solid #b1acac; text-transform: none;" value="<?php echo $bene['b_category']?>">
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
							<input name="s_category" type="text"  class="form-control" style="border: 1px solid #b1acac; text-transform: none;" value="<?php echo $bene['b_subCategory']?>">
							<label>Sub-Category</label>
						</div>
				</div>
                <div class="row" style="margin-top: 2%; height:10%;">
                    <div class="form-group col-lg-6">
                        <select name="status" type="text" class="form-control" style="border: 1px solid #b1acac;">
							<option value="" disabled <?php echo ($bene['b_civilStatus']==""?"selected":"")?>>Civil Status</option>
							<option value="Single" <?php echo ($bene['b_civilStatus']=="Single"?"selected":"")?>>Single</option>
							<option value="Married" <?php echo ($bene['b_civilStatus']=="Married"?"selected":"")?>>Married</option>
							<option value="Separated" <?php echo ($bene['b_civilStatus']=="Separated"?"selected":"")?>>Separated</option>
							<option value="Widow/Widower" <?php echo ($bene['b_civilStatus']=="Widow/Widower"?"selected":"")?>>Widow/Widower</option>
							<option value="Common-Law" <?php echo ($bene['b_civilStatus']=="Common-Law"?"selected":"")?>>Common-law</option>
						</select>
						<label>Civil Status</label>
                    </div>
                    <div class="form-group col-lg-6">
                        <input name="contact" type="text"  class="form-control" style="border: 1px solid #b1acac;" value="<?php echo $bene['b_contact']?>" onKeyPress="if(this.value.length==11) return false;">
                        <label>Contact</label>
                    </div>
				</div><br>
				<h4><b>Address</b></h4>
				<div class="row">
				<div class="col-9"></div><div class="col-3"><input class="btn btn-primary" style="border:none;" type="button" value="Copy Address" onclick="copyaddress()"></input></div>
				</div>
				<div class="row">
					<div class="form-group col-lg-6">
						<h5 class="text-center"><b>Existing Data</b></h5>
					</div>
					<div class="form-group col-lg-6">
						<h5 class="text-center"><b>New Data </b></h5>
					</div>
				</div>

				<div class="row" style="margin-top: 2%; height:10%;">
				 	<div class="form-group col-lg-6">
                        <input type="text"  class="form-control" id="oldreg" style="border: 1px solid #b1acac;" value="<?php echo $bene['b_region']?>" readonly>
                        <label>Existing Region</label>
                    </div>
                    <div class="form-group col-lg-6">
                        <input  list="regionClist" name="region" id="newreg" type="text" class="form-control" style="border: 1px solid #b1acac; text-transform: none;" onChange="get_c_Region(this)" required>
                        <label>New Region</label>
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
                </div>
				<div class="row" style="margin-top: 2%; height:10%;">
					<div class="form-group col-lg-6">
                        <input type="text"  class="form-control" id="oldprov" style="border: 1px solid #b1acac;" value="<?php echo $bene['b_province']?>" readonly>
                        <label>Existing Province</label>
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
                        <input type="text"  class="form-control" id="oldmuni" style="border: 1px solid #b1acac;" value="<?php echo $bene['b_municipality']?>" readonly>
                        <label>Existing Municipality</label>
                    </div>
					<div class="form-group col-lg-6">
						<input list="municipalityClist" name="municipality" id="newmuni" type="text" onChange="get_c_Municipality(this)" class="form-control" style="border: 1px solid #b1acac; text-transform: none;" required>
						<label>Municipality</label>
						<datalist id="municipalityClist">
						</datalist>
					</div>
				
				</div>
				<div class="row" style="margin-top: 2%; height:10%;">
					<div class="form-group col-lg-6">
                        <input type="text"  class="form-control" id="oldbrgy" style="border: 1px solid #b1acac;" value="<?php echo $bene['b_barangay']?>" readonly>
                        <label>Existing Barangay</label>
                    </div>
					<div class="form-group col-lg-6">
						<input list="barangayClist" name="barangay" id="newbrgy" type="text" class="form-control" onChange="get_c_Barangay(this)" style="border: 1px solid #b1acac; text-transform: none;" required>
						<label>New Barangay</label>
						<datalist id="barangayClist">
						</datalist>
					</div>
				</div>
				
				<div class="row" style="margin-top: 2%; height:10%;">
					<div class="form-group col-lg-6">
                        <input type="text"  class="form-control" id="oldstr" style="border: 1px solid #b1acac;" value="<?php echo $bene['b_street']?>" readonly>
                        <label>Existing Street/Purok</label>
                    </div>
					<div class="form-group col-lg-6">
							<input name="street" type="text" id="newstr" class="form-control" style="border: 1px solid #b1acac; text-transform: none;">
							<label>New Street/Purok</label>
						</div>
				</div>


				<div class="row" style="margin-top: 2%; height:10%;">
					<div class="form-group col-lg-6">
                        <input type="text"  class="form-control" id="olddist" style="border: 1px solid #b1acac;"  value="<?php echo $bene['b_district']?>" readonly>
                        <label>Existing District</label>
                    </div>
						<div class="form-group col-lg-6">
							<select name="district" type="text" id="newdist" class="form-control" style="border: 1px solid #b1acac; text-transform: none;">
								<option value="" disabled <?php echo ($bene['b_district']==""?"selected":"")?>>Select District</option>
								<option value="District 1" <?php echo ($bene['b_district']=="District 1"?"selected":"")?>>District 1</option>
								<option value="District 2" <?php echo ($bene['b_district']=="District 2"?"selected":"")?>>District 2</option>
								<option value="District 3" <?php echo ($bene['b_district']=="District 3"?"selected":"")?>>District 3</option>
								<option value="District 4" <?php echo ($bene['b_district']=="District 4"?"selected":"")?>>District 4</option>
								<option value="District 5" <?php echo ($bene['b_district']=="District 5"?"selected":"")?>>District 5</option>
								<option value="District 6" <?php echo ($bene['b_district']=="District 6"?"selected":"")?>>District 6</option>
								<option value="District 7" <?php echo ($bene['b_district']=="District 7"?"selected":"")?>>District 7</option>
								<option value="District 8" <?php echo ($bene['b_district']=="District 8"?"selected":"")?>>District 8</option>
								<option value="District 9" <?php echo ($bene['b_district']=="District 9"?"selected":"")?>>District 9</option>
								<option value="District 10" <?php echo ($bene['b_district']=="District 10"?"selected":"")?>>District 10</option>
							</select>
							<label>New District</label>
						</div>
				</div>
			<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type='submit' class='btn btn-primary' name='b_update'>UPDATE</button>
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