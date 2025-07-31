<?php
include('../php/class.user.php');
$user = new User();
	$bene = $user->getBeneData($_GET['id']);
	
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
                        <!-- <input  name="relation" type="text" class="form-control" style="border: 1px solid #b1acac; text-transform: none;" value="<?php //echo $bene['relation']?>" required> -->
						<select name="relation" class="form-control" style="border: 1px solid #b1acac; text-transform: none;" required>
							<option value="" <?php echo (empty($bene['relation'])?'selected':'') ?>>Relation With Beneficiary</option>
                            <?php
                                $getrelation = $user->getrelationshiplist();
                                //Loop through results
                                foreach($getrelation as $index => $value){
                                    //Display info
                                    echo '<option value="'. $value['relation'] .'" '. (($bene['relation'] == $value['relation'])?'selected':'') .' > ';
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
                        <input  name="lname" type="text" class="form-control" style="border: 1px solid #b1acac;" value="<?php echo $bene['b_lname']?>" required oninput="this.value = this.value.replace(/[^A-Za-zÑñÉéÈèÊêËë\-. ]/g, '').toUpperCase()">
                        <label>Lastname</label>
                    </div>
                    <div class="form-group col-lg-6">
                        <input name="fname" type="text" class="form-control" style="border: 1px solid #b1acac;" value="<?php echo $bene['b_fname']?>" required oninput="this.value = this.value.replace(/[^A-Za-zÑñÉéÈèÊêËë\-. ]/g, '').toUpperCase()">
                        <label>Firstname</label>
                    </div>
				</div>
				<div class="row" style="margin-top: 2%; height:10%;">
						<div class="form-group col-lg-6">
							<input  name="mname" type="text" class="form-control" style="border: 1px solid #b1acac;" value="<?php echo $bene['b_mname']?>" oninput="this.value = this.value.replace(/[^A-Za-zÑñÉéÈèÊêËë\-. ]/g, '').toUpperCase()">
							<label>Middlename</label>
						</div>
						<div class="form-group col-lg-6">
							<!-- <input name="exname" type="text" class="form-control" style="border: 1px solid #b1acac;" value="<?php //echo $bene['b_exname']?>"> -->
							<select name="exname" class="form-control" style="border: 1px solid #b1acac;">
								<option value="" <?php echo (($bene['b_exname'])?'selected':'') ?>> Extension Name</option>
								<option value="JR" <?php echo (($bene['b_exname']=='JR')?'selected':'') ?>>JR</option>
								<option value="SR" <?php echo (($bene['b_exname']=='SR')?'selected':'') ?>>SR</option>
								<option value="I" <?php echo (($bene['b_exname']=='I')?'selected':'') ?>>I</option>
								<option value="II" <?php echo (($bene['b_exname']=='II')?'selected':'') ?>>II</option>
								<option value="III" <?php echo (($bene['b_exname']=='III')?'selected':'') ?>>III</option>
								<option value="IV" <?php echo (($bene['b_exname']=='IV')?'selected':'') ?>>IV</option>
								<option value="V" <?php echo ($bene['b_exname']=="V")?"selected":"" ?>>V</option>
								<option value="VI" <?php echo ($bene['b_exname']=="VI")?"selected":"" ?>>VI</option>
								<option value="VII" <?php echo ($bene['b_exname']=="VII")?"selected":"" ?>>VII</option>
								<option value="VIII" <?php echo ($bene['b_exname']=="VIII")?"selected":"" ?>>VIII</option>
								<option value="IX" <?php echo ($bene['b_exname']=="IX")?"selected":"" ?>>IX</option>
								<option value="X" <?php echo ($bene['b_exname']=="X")?"selected":"" ?>>X</option>
							</select>
							<label>Extension Name</label>
						</div>
				</div>
				<div class="row" style="margin-top: 2%; height:10%;">
						<div class="form-group col-lg-6">
							<input  name="bday" type="date"  class="form-control" style="border: 1px solid #b1acac;" max= "<?php echo date('Y-m-d'); ?>" value="<?php echo $bene['b_bday']?>" required>
							<label>Birth Date</label>
						</div>
						<div class="form-group col-lg-6">
							<select name="sex" type="text"  class="form-control" style="border: 1px solid #b1acac;" required>
								<option value="" disabled <?php echo ($bene['b_sex']==""?"selected":"")?>>Sex</option>
								<option value="Male" <?php echo ($bene['b_sex']=="Male"?"selected":"")?>>Male</option>
								<option value="Female" <?php echo ($bene['b_sex']=="Female"?"selected":"")?>>Female</option>
							</select>
							<label>Sex</label>
						</div>
				</div>
                <div class="row" style="margin-top: 2%; height:10%;">
						<div class="form-group col-lg-6">
							<input list="categories" name="category" type="text"  class="form-control" style="border: 1px solid #b1acac; text-transform: none;" value="<?php echo $bene['b_category']?>" required>
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
								<option value="" disabled <?php echo ($bene['b_civilStatus']==""?"selected":"")?>>Civil Status</option>
								<option value="Single" <?php echo ($bene['b_civilStatus']=="Single"?"selected":"")?>>Single</option>
								<option value="Married" <?php echo ($bene['b_civilStatus']=="Married"?"selected":"")?>>Married</option>
								<option value="Separated" <?php echo ($bene['b_civilStatus']=="Separated"?"selected":"")?>>Separated</option>
								<option value="Widow/Widowed" <?php echo ($bene['b_civilStatus']=="Widow/Widowed"?"selected":"")?>>Widow/Widowed</option>
								<option value="Common-Law" <?php echo ($bene['b_civilStatus']=="Common-Law"?"selected":"")?>>Common-law</option>
							</select>
							<label>Civil Status</label>
						</div>
				</div>
                <div class="row" style="margin-top: 2%; height:10%;">
                    <div class="form-group col-lg-6">
						<input name="contact" type="text"  class="form-control" style="border: 1px solid #b1acac;" value="<?php echo $bene['b_contact']?>" onKeyPress="if(this.value.length==11) return false;" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,11);">
						<label>Contact</label>
                    </div>
                    <div class="form-group col-lg-6">
                        
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
                        <input  list="regionBlist" name="region" id="breg" type="text" class="form-control" style="border: 1px solid #b1acac; text-transform: none;" onChange="get_b_Region(this)" required>
                        <label>Region</label>
                        <datalist id="regionBlist">
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
                        <input list="provinceBlist" name="province" id="bprov" type="text" class="form-control" onChange="get_b_Province(this)" style="border: 1px solid #b1acac; text-transform: none;" required/>
                        <label>Province</label>
                        <datalist id="provinceBlist">
				        </datalist>
				    </div>
				</div>

				<div class="row" style="margin-top: 2%; height:10%;">
					<div class="form-group col-lg-6">
                        <input type="text"  class="form-control" id="oldmuni" style="border: 1px solid #b1acac;" value="<?php echo $bene['b_municipality']?>" readonly>
                        <label>Existing Municipality</label>
                    </div>
					<div class="form-group col-lg-6">
						<input list="municipalityBlist" name="municipality" id="beneficiary_city" type="text" onChange="get_b_Municipality(this)" class="form-control" style="border: 1px solid #b1acac; text-transform: none;" required>
						<label>Municipality</label>
						<datalist id="municipalityBlist">
						</datalist>
					</div>
				
				</div>
				<div class="row" style="margin-top: 2%; height:10%;">
					<div class="form-group col-lg-6">
                        <input type="text"  class="form-control" id="oldbrgy" style="border: 1px solid #b1acac;" value="<?php echo $bene['b_barangay']?>" readonly>
                        <label>Existing Barangay</label>
                    </div>
					<div class="form-group col-lg-6">
						<input list="barangayBlist" name="barangay" id="bbrgy" type="text" class="form-control" onChange="get_b_Barangay(this)" style="border: 1px solid #b1acac; text-transform: none;" required>
						<label>Barangay</label>
						<datalist id="barangayBlist">
						</datalist>
					</div>
				</div>
				
				<div class="row" style="margin-top: 2%; height:10%;">
					<div class="form-group col-lg-6">
                        <input type="text"  class="form-control" id="oldstr" style="border: 1px solid #b1acac;" value="<?php echo $bene['b_street']?>" readonly>
                        <label>Existing Street/Purok</label>
                    </div>
					<div class="form-group col-lg-6">
							<input name="street" type="text" id="bstr" class="form-control" style="border: 1px solid #b1acac; text-transform: none;">
							<label>Street/Purok</label>
						</div>
				</div>


				<div class="row" style="margin-top: 2%; height:10%;">
					<div class="form-group col-lg-6">
                        <input type="text"  class="form-control" id="olddist" style="border: 1px solid #b1acac;"  value="<?php echo $bene['b_district']?>" readonly>
                        <label>Existing District</label>
                    </div>
						<div class="form-group col-lg-6">
							<select name="district" type="text" id="beneficiary_district" class="form-control" style="border: 1px solid #b1acac; text-transform: none;">
								<option value="" selected>Select District</option>
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
		dist = document.getElementById('olddist').value.trim();


		get_b_Region(document.getElementById('oldreg'));
		get_b_Province(document.getElementById('oldprov'));
		get_b_Municipality(document.getElementById('oldmuni'));
		get_b_Barangay(document.getElementById('oldbrgy'));
		
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

</script>