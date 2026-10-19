<?php
	include('../php/class.user.php');
    $user = new User();

    $office_id = $_GET['id'];
	$_SESSION['officeid'] = $office_id;
	
	$getinfo = $user->show_Office_data($office_id);

    $getregions = $user->getregion($office_id);
    $getprovince = $user->getprovince($office_id);
    $getmunicipal = $user->getmunicipality($office_id);

    if(isset($_POST['Update'])) {
        $id = $_GET['id'];
        $officename = $_POST['updateofficename'];
        $descrip = $_POST['description'];
        $m = $_POST['Ccity'];
        $officeacronym = $_POST['updateofficeacronym'];
        
        //no changes were made
        if($officename == $getinfo['office_name'] && $descrip == $getinfo['description'] && $m == ($getmunicipal['m_name']." /". $getmunicipal['psgc_code']) && $officeacronym == $getinfo['office_accronym']){
            echo "<script>alert('No Changes Made!');</script>";
            echo "<script>window.location='OfficePage.php';</script>";
            echo "<meta http-equiv='refresh' content='0'>";
        }

        $result = $user->updateOffice($officename, $officeacronym, $descrip, $m, $id);
        
        if($result=="success"){
            echo "<script>alert('Successfully Updating Office!');</script>";
            echo "<script>window.location='OfficePage.php';</script>";
            echo "<meta http-equiv='refresh' content='0'>";
        }elseif($result=="exists"){
            echo "<script>alert('Office Already Exist!');</script>";
            echo "<script>window.location='OfficePage.php';</script>";
            echo "<meta http-equiv='refresh' content='0'>";
        }else{
            echo "<script>alert('Error Updating Office!');</script>";
            echo "<script>window.location='OfficePage.php';</script>";
            echo "<meta http-equiv='refresh' content='0'>";
        }
    }

?>
<!DOCTYPE html>
<html>
	<body>
	<div class="body">
        <form class="form-group" action="UpdateOffice.php?id=<?php echo $office_id?>" method="POST">
            <div class="modal-body">
                <div class="row form-group" style="margin-top: 2%; height:10%;">
                    <div class="form-group col-lg-12">
                        <input list="regionClist" id="creg" name="Cregion" class="form-control mr-sm-2 b" placeholder="Region" onChange="get_c_Region(this)" value="<?php echo (!empty($getregions)?$getregions['r_name']." /". $getregions['psgc_code']:"")?>" required autocomplete="off">
                        <datalist id="regionClist">
                        <?php
                            $getregions = $user->optionregion();
                                //Loop through results
                            foreach($getregions as $index => $value){
                                //Display info
                                echo '<option value="'. $value['r_name'] .' /'. $value['psgc_code'] .'"> ';
                                echo '</option>';
                            }
                        ?>
                        </datalist>
                        <label class="active" for="creg">Region</label>
                    </div>
                    <div class="form-group col-lg-12">
                        <input list="provinceClist" id="cprov" type="text" class="form-control mr-sm-2 b" name="Cprovince" placeholder="Province" onChange="get_c_Province(this)" value="<?php echo (!empty($getprovince)?$getprovince['p_name']." /". $getprovince['psgc_code']:"")?>"  required autocomplete="off">
                        <datalist id="provinceClist">
                        </datalist>
                        <label class="active" for="cprov">Province</label>
                    </div>
                    <div class="form-group col-lg-12">
                        <input list="municipalityClist" type="text" class="form-control mr-sm-2 b" id="client_city" name="Ccity" placeholder="City or Municipality" value="<?php echo (!empty($getmunicipal)?$getmunicipal['m_name']." /". $getmunicipal['psgc_code']:"")?>" required autocomplete="off">
                        <datalist id="municipalityClist">
                        </datalist>
                        <label class="active" for="client_city">Municipality</label>
                    </div>

                    <div class="form-group col-lg-12">
                        <div class="row">
                            <div class="form-group col-lg-9">
                                <input placeholder="Office Name" id="officename" value="<?php echo (!empty($getinfo)?$getinfo['office_name']:"")?>"  name="updateofficename" type="text" class="form-control" required oninput="this.value = this.value.replace(/[^a-zA-Z0-9Ññ~`\s!@$%^()_\-={}:|<>?\[\],.\/]/g, '')">
                                <label class="active" for="officename">Office Name</label>
                            </div>
                            <div class="form-group col-lg-3">
                                <input placeholder="Office Acronym" id="officeacronym" value="<?php echo (!empty($getinfo)?$getinfo['office_accronym']:"")?>" name="updateofficeacronym" type="text" class="form-control" required oninput="this.value = this.value.replace(/[^a-zA-Z0-9Ññ~`\s!@$%^()_\-={}:|<>?\[\],.\/]/g, '').toUpperCase()">
                                <label class="active" for="officename">Office Acronym</label>
                            </div>
                        <div>
                    </div>
                    <div class="form-group col-lg-12">
                        <textarea placeholder="Description" id="description" name="description" class="form-control " required maxlength="100" oninput="this.value = this.value.replace(/[^a-zA-Z0-9Ññ~`\s!@$%^()_\-={}:|<>?\[\],.\/]/g, '')"><?php echo (!empty($getinfo)?$getinfo['description']:"")?></textarea>
                        <label class="active" for="description">Description</label>
                    </div>
                </div>
                        
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="Update">Save</button>
            </div>
        </form>
	</div>

</body>
<script>
    $(function () {
		reg = document.getElementById('creg').value;
		prov = document.getElementById('cprov').value;
		muni = document.getElementById('client_city').value;

		get_c_Region(document.getElementById('creg'));
		get_c_Province(document.getElementById('cprov'));
		get_c_Municipality(document.getElementById('client_city'));

		document.getElementById('creg').value = reg;
		document.getElementById('cprov').value = prov;
		document.getElementById('client_city').value = muni;
	});
</script>
</html>