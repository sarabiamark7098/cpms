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
	<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link rel="icon" type="image/png" href="../images/icons/ciu.ico"/>
		<link rel="stylesheet" type="text/css" href="../css/main.css">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">	
		<link rel="stylesheet" type="text/css" href="../css/table.responsive.css">
        <link rel="stylesheet" type="text/css" href="../style5.css">
        
        <script defer src="../js/solid.js"></script>
        <script defer src="../js/fontawesome.js"></script>
        <script src="../js/jquery.slim.min.js"></script>
        <script src="../js/popper.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../js/jquery-3.2.1.slim.min.js"></script>
        <script type="text/javascript" src="../js/main.js"></script>
        <script type="text/javascript" src="../js/PSGC.js"></script>
        <script type="text/javascript" src="../js/jquery.min.js"></script>
        
        <!-- added -->
        
        <link rel="stylesheet" type="text/css" href="../datatables/datatables.css">
		<script type="text/javascript" charset="utf8" src="../datatables/datatables.js"></script>
		<script type="text/javascript" src="../js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../js/bootstrap-3.3.7.min.js"></script>
		
	</head>
	<body>
	<div class="body">
        <form class="form-group" action="OfficePage.php" method="POST">
            <div class="modal-body">
                <div class="row form-group" style="margin-top: 2%; height:10%;">
                <div class="form-group col-lg-12">
                        <input list="regionClist" id="creg" value="<?php echo (!empty($getregions)?$getregions['r_name']." / ". $getregions['psgc_code']:"")?>" name="regionname" class="form-control mr-sm-2 b" placeholder="Region" onChange="get_admin_Region(this)" readonly>
                        <datalist id="regionClist">
                            
                        </datalist>
                    </div>
                    <div class="form-group col-lg-12">
                        <input list="provinceClist" id="provincename" value="<?php echo (!empty($getprovince)?$getprovince['p_name']." / ". $getprovince['psgc_code']:"")?>" type="text" class="form-control mr-sm-2 b" name="province" placeholder="Province" onChange="get_admin_Province(this)" readonly>
                        <datalist id="provinceClist">
                        </datalist>
                    </div>
                    <div class="form-group col-lg-12">
                        <input list="municipalityClist" type="text" value="<?php echo (!empty($getmunicipal)?$getmunicipal['m_name']." / ". $getmunicipal['psgc_code']:"")?>" class="form-control mr-sm-2 b" id="client_city" name="city" placeholder="City or Municipality" readonly>
                        <datalist id="municipalityClist">
                        </datalist>
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