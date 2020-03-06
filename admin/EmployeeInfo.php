<?php
    include('../php/class.user.php');
	$user = new User();

	$empid = $_POST['empid'];
	
	if(!$_SESSION['login']){
		header('Location:../index.php');
    }

    $getemp = $user->getEmpData($empid);
    
?>
<!DOCTYPE html>
<html>
	<head>
	</head>
	<body>
	<div class="body">
	    <form class="form-group" action="EmployeeInfo.php" method="POST">
		    <div class="modal-body">
                <label data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    <h5><small>&emsp;Employee Request&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</small></h5>
                </label>
                <div class="row form-group" style="margin-top: 2%; height:10%;">
                    <div class="form-group col-lg-6">
                        <input value="<?php echo $getemp['emplname']; ?>" id="lastname" name="lastname" type="text" class="form-control" readonly>
                        <label class="active" for="lastname">Lastname</label>
                    </div>
                    <div class="form-group col-lg-6">
                        <input value="<?php echo $getemp['empfname']; ?>" id="firstname" name="firstname" type="text" class="form-control" readonly>
                        <label class="active" for="firstname">Firstname</label>
                    </div>
                    <div class="form-group col-lg-6">
                        <input value="<?php echo $getemp['empmname']; ?>" id="middlename" name="middlename" type="text" class="form-control" readonly>
                        <label class="active" for="middlename">Middlename</label>
                    </div>
                    <div class="form-group col-lg-6">
                        <input value="<?php echo $getemp['empext']; ?>" id="extraname" name="extraname" type="text" class="form-control" readonly>
                        <label class="active" for="extraname">Extraname</label>
                    </div>
                    
                    <label class="col-lg-12" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    <h5><small>&emsp;Employee Details&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</small></h5>
                    </label>
                    
                    <div class="form-group col-lg-6">
                        <input value="<?php echo $getemp['empid']; ?>" id="empid" name="empid" type="text" class="form-control" readonly>
                        <label class="active" for="empid">Employee ID</label>
                    </div>
                    <div class="form-group col-lg-6">
                        <input value="<?php echo $getemp['empuser']; ?>" id="username" name="username" type="text" class="form-control" readonly>
                        <label class="active" for="username">Employee Username</label>
                    </div>
                    <div class="form-group col-lg-6">
                        <input value="<?php echo $getemp['emppass']; ?>" id="password" name="password" type="text" class="form-control" readonly>
                        <label class="active" for="password">Employee Password</label>
                    </div>
                    
                    <?php if(!empty($getemp['position'])){ ?>
                    <label class="col-lg-12" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    <h5><small>&emsp;CPMS User Access &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</small></h5>
                    </label>
                    <div class="form-group col-lg-6">
                        <select id="designation" name="designation" type="text" class="form-control" readonly>
                            <option value="" selected></option>
                            <option value="Encoder" <?php echo ($getemp['position'] == 'Encoder'?"selected":"") ?>>Encoder</option>
                            <option value="Social Worker" <?php echo ($getemp['position'] == 'Social Worker'?"selected":"") ?>>Social Worker</option>
                            <option value="Admin" <?php echo ($getemp['position'] == 'Admin'?"selected":"") ?>>Admin</option>
                        </select>
                        <label class="active" for="designation">System Designation</label>
                    </div>
                    <div class="form-group col-lg-6">
                        <select id="user_status" name="user_status" type="text" class="form-control" readonly>
                            <option value="" selected></option>
                            <option value="Activated" <?php echo ($getemp['status'] == 'Activated'?"selected":"") ?>>Activated</option>
                            <option value="Deactivated" <?php echo ($getemp['status'] == 'Deactivated'?"selected":"") ?>>Deactivated</option>
                        </select>
                        <label class="active" for="user_status">System Designation</label>
                    </div>
                    <div class="form-group col-lg-6">
                        <select id="office" name="office" type="text" class="form-control" readonly>
                        <option value="" selected></option>
                            <?php
                            $getoffice = $user->optionoffice();
                                //Loop through results
                            foreach($getoffice as $index => $value){
                                //Display info
                                echo '<option value="'. $value['office_id'] .'" '. (($getemp['office_id']==$value['office_id'])?"selected":"") .'> ';
                                echo $value['office_name'];
                                echo '</option>';
                            }
                        ?>
                        </select>
                        <label class="active" for="office">Designate Office</label>
                    </div>
                    <?php } ?>
                    <div class="form-group col-lg-6" hidden>
                        <input value="<?php echo $getemp['empnum']; ?>" id="empnum" name="empnum" type="text" class="form-control" readonly>
                        <label class="active" for="empnum">Employee Number</label>
                    </div>
                </div>
			</div>	
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
        </form> 		
	</div>
</body>
</html>