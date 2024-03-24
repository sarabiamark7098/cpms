<?php
    include('../php/class.user.php');
	$user = new User();

	$empid = $_POST['empid'];
	
	if(!$_SESSION['login']){
		header('Location:../index.php');
    }

    if(isset($_POST['Update'])){
        $emp_id = $_GET['id'];
        $id = $_POST['empid'];
        $position = "";
        $status = "";
        if(!empty($_POST['designation'])){
            $position = $_POST['designation'];
        }
        if(!empty($_POST['user_status'])){
            $status = $_POST['user_status'];
        }
        $office = $_POST['office'];
        $result = $user->UpdateEmployee($emp_id, $id, $position, $status, $office);

        if($result){
            echo "<script>alert('Updated Succesfully')</script>";
            echo "<script>window.location='Employee.php';</script>";
            echo "<meta http-equiv='refresh' content='0'>";
        }else{
            echo "<script>alert('Error! Please Try Again')</script>";
            echo "<script>window.location='Employee.php';</script>";
            echo "<meta http-equiv='refresh' content='0'>";
        }


    }

    $getemp = $user->getEmpData($empid);
    
?>
<!DOCTYPE html>
<html>
	<head>
	</head>
	<body>
	<div class="body">
	    <form class="form-group" action="UpdateEmployee.php?id=<?php echo $getemp['empid']; ?>" method="POST">
		    <div class="modal-body">
                <label data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    <h5><small>&emsp;Update Employee&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</small></h5>
                </label>
                <div class="row form-group" style="margin-top: 2%; height:10%;">
                    
					<div class="form-group col-lg-3">
                    </div>
                    <div class="form-group col-lg-6">
                        <input value="<?php echo $getemp['empid']; ?>" id="empid" name="empid" type="text" class="form-control" readonly>
                        <label class="active" for="empid">Employee ID</label>
                    </div>
					<div class="form-group col-lg-3">
                    </div>
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
                    <h5><small>&emsp;CPMS User Access &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</small></h5>
                    </label>
                    <div class="form-group col-lg-6">
                        <select id="designation" name="designation" type="text" class="form-control" required>
                            <option value="" selected></option>
                            <option value="Encoder" <?php echo ($getemp['position'] == 'Encoder'?"selected":"") ?>>Encoder</option>
                            <option value="Social Worker" <?php echo ($getemp['position'] == 'Social Worker'?"selected":"") ?>>Social Worker</option>
                            <option value="Admin" <?php echo ($getemp['position'] == 'Admin'?"selected":"") ?>>Admin</option>
                        </select>
                        <label class="active" for="designation">Designate Position</label>
                    </div>
                    <div class="form-group col-lg-6">
                        <select id="user_status" name="user_status" type="text" class="form-control" required>
                            <option value="" selected></option>
                            <option value="Activated" <?php echo ($getemp['status'] == 'Activated'?"selected":"") ?>>Activate</option>
                            <option value="Deactivated" <?php echo ($getemp['status'] == 'Deactivated'?"selected":"") ?>>Deactivate</option>
                        </select>
                        <label class="active" for="user_status">User Status</label>
                    </div>
                    
                    <div class="form-group col-lg-6">
                        <select id="office" name="office" type="text" class="form-control" required>
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
                </div>
			</div>	
			<div class="modal-footer">
                <button type="submit" class="btn btn-primary" name="Update">Update</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
        </form> 		
	</div>

</body>
</html>