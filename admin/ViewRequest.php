<?php
    include('../php/class.user.php');
	$user = new User();

	$empid = $_POST['empid'];
	
	if(!$_SESSION['login']){
		header('Location:../index.php');
    }

    if(isset($_POST['cancelRequest'])){
        // echo $id = $_GET['cancelempid'];
        $id = $_POST['empnum'];
        $result = $user->cancelRequest($id);

        if($result){
            echo "<script>alert('Request have been cancelled')</script>";
            echo "<script>window.location='Employee.php';</script>";
            echo "<meta http-equiv='refresh' content='0'>";
        }else{
            echo "<script>alert('Error! Please Try Again')</script>";
            echo "<script>window.location='Employee.php';</script>";
            echo "<meta http-equiv='refresh' content='0'>";
        }


    }elseif(isset($_POST['confirmRequest'])){
        $position = $_POST['designation'];
        $num = $_POST['empnum'];
        $id = $_POST['empid'];
        $office = $_POST['office'];
        
        $user->grantRequest($position, $id, $num, $office);
    }

    $getemp = $user->getEmpData($empid);
    $getrequest = $user->RequestData($getemp['empnum']);
?>
<!DOCTYPE html>
<html>
	<head>
	</head>
	<body>
	<div class="body">
	    <form class="form-group" action="ViewRequest.php" method="POST">
		    <div class="modal-body">
                <label data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    <h5><small>&emsp;Employee Request&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</small></h5>
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
                    <h5><small>&emsp;Employee Details&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</small></h5>
                    </label>
                    
                    
                    
                    <label class="col-lg-12" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    <h5><small>&emsp;CPMS Field&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</small></h5>
                    </label>
                    <div class="form-group col-lg-6">
                        <select id="designation" name="designation" type="text" class="form-control" required readonly disabled>
                            <option value="" <?php echo ($getrequest['request_position'] == ''?"selected":"") ?>>Select Designation</option>
                            <option value="Admin" <?php echo ($getrequest['request_position'] == 'Admin'?"selected":"") ?>>Admin</option>
                            <option value="Encoder" <?php echo ($getrequest['request_position'] == 'Encoder'?"selected":"") ?>>Encoder</option>
                            <option value="Social Worker" <?php echo ($getrequest['request_position'] == 'Social Worker'?"selected":"") ?>>Social Worker</option>
										
                        </select>
                        <label class="active" for="designation">Designate Position</label>
                    </div>
                    <div class="form-group col-lg-6">
                        <select id="office" name="office" type="text" class="form-control" required readonly disabled>
                            <option value="" selected></option>
                            <?php
                            $getoffice = $user->optionoffice();
                                //Loop through results
                            foreach($getoffice as $index => $value){
                                //Display info
                                echo '<option value="'. $value['office_id'] .'" '. ($getrequest['request_office'] == $value['office_id']?'selected':'') .'> ';
                                echo $value['office_name'];
                                echo '</option>';
                            }
                        ?>
                        </select>
                        <label class="active" for="office">Designate Office</label>
                    </div>
                    <div class="form-group col-lg-6" hidden>
                        <input value="<?php echo $getemp['empnum']; ?>" id="empnum" name="empnum" type="text" class="form-control" readonly>
                        <label class="active" for="empnum">Employee Number</label>
                    </div>
                </div>
			</div>	
			<div class="modal-footer">
                <button type="submit" class="btn btn-danger" name="cancelRequest" id="cancelRequest">Cancel Request</button>
                <button type="submit" class="btn btn-primary" name="confirmRequest">Confirm Request</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
        </form> 		
	</div>

    <script>
        $(function () {
            $("#cancelRequest").click(function () {
                // console.log("wla na require");
                $("#designation").removeAttr('required');
               
            });
        });
    </script>
</body>
</html>