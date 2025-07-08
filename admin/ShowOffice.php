<?php
	include('../php/class.user.php');
    $user = new User();

    $office_id = $_GET['id'];
	$_SESSION['officeid'] = $office_id;
	
	$getinfo = $user->show_Office_data($office_id);

    $getregions = $user->getregion($office_id);
    $getprovince = $user->getprovince($office_id);
    $getmunicipal = $user->getmunicipality($office_id);

?>
<!DOCTYPE html>
<html>
	<body>
	<div class="body">
        <form class="form-group" action="OfficePage.php" method="POST">
            <div class="modal-body">
                <div class="row form-group" style="margin-top: 2%; height:10%;">
                <div class="form-group col-lg-12">
                        <input value="<?php echo (!empty($getregions)?$getregions['r_name']." / ". $getregions['psgc_code']:"")?>" class="form-control mr-sm-2 b" placeholder="Region" readonly>
                        
                    </div>
                    <div class="form-group col-lg-12">
                        <input value="<?php echo (!empty($getprovince)?$getprovince['p_name']." / ". $getprovince['psgc_code']:"")?>" type="text" class="form-control mr-sm-2 b" placeholder="Province" readonly>
                        
                    </div>
                    <div class="form-group col-lg-12">
                        <input type="text" value="<?php echo (!empty($getmunicipal)?$getmunicipal['m_name']." / ". $getmunicipal['psgc_code']:"")?>" class="form-control mr-sm-2 b"  placeholder="City or Municipality" readonly>
                        
                    </div>
                    <div class="form-group col-lg-12">
                        <input placeholder="Office Name" id="officename" value="<?php echo (!empty($getinfo)?$getinfo['office_name']:"")?>"  name="officename" type="text" class="form-control" readonly>
                        <label class="active" for="officename">Office Name</label>
                    </div>
                    <div class="form-group col-lg-12">
                        <input placeholder="Office Name" id="officeacronym" value="<?php echo (!empty($getinfo)?$getinfo['office_accronym']:"")?>"  name="officeacronym" type="text" class="form-control" readonly>
                        <label class="active" for="officeacronym">Office Name</label>
                    </div>
                    <div class="form-group col-lg-12">
                        <textarea placeholder="Description" id="description" name="description" class="form-control " readonly><?php echo (!empty($getinfo)?$getinfo['description']:"")?></textarea>
                        <label class="active" for="description">Description</label>
                    </div>
                </div>
                        
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="Add">Save</button>
            </div>
        </form>
	</div>

</body>
</html>