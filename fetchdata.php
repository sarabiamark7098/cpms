<?php
	include('php/class.user.php');
	$user = new User();

    $newdate = date("Y-m-d H:i:s");
    $now = explode("-",$newdate);

    if(isset($_POST['search'])){
        $var = $_POST['search'];
        // echo "<script> console.log('".$var."') </script>";
        $output = '';
        $result = $user->searchEmployeeforRequest($var);
		if($result){
            $output .= '';
            while($row = mysqli_fetch_array($result)){        
                $output = "<tr>
                            <td scope='row' style='width: 15%'>" . $row["emplname"] ." </td>
                            <td scope='row' style='width: 15%'>" . $row["empfname"] ." </td>
                            <td scope='row' style='width: 15%'>" . (!empty($row['empmname'])?$row["empmname"]:"") ." </td>
                            <td scope='row' style='width: 5%'>" . (!empty($row["empext"])?$row["empext"]:"") ." </td>
                            <td scope='row' style='width: 20%'>
                            <button type='button' name='r_userAccess' id='r_request' class='btn btn-primary deep-sky' data-toggle='modal' data-id='" . $row["empnum"] . "' data-target='#Requesting_userAccess'> Request </button>
                            </td>
                            </tr>
                        ";		
                }
        }else{
            echo '';
        }
        echo $output;
    }

    echo "<script>
        $('#r_request').click(function (event) {
            var empid = $(this).attr('data-id');
            // console.log(empid);
            $.ajax({
                type: 'post',
                url:'fetchdata.php',
                data: {emp_id:empid},
                success:function(result){
                $('.modal-body2').html(result);
            }});
        });
    </script>";

    if(isset($_POST['emp_id'])){
        $row = $user->get_employee_data($_POST['emp_id']);
        $output = "";
        $output = "<form action='index.php?confirm_id={$row["empnum"]}&emp_id={$row["empid"]}' method='POST'>
                        <div class='container' style='padding:20px 40px'>
                            <h5 style='text-align:center'><b>Employee Number:&nbsp ".$_POST['emp_id']."</b></h5><br>
                            <h5 style='text-align:center'><b>Name:&nbsp ". $row['emplname'] .", ". $row['empfname'] ." ". (!empty($row['empmname'])?$row['empmname'][0].'.':'') ." ". (!empty($row['empext'])?$row['empext']:'') ."</b></h5><br>
                            <div class='row'>
                                <div class='form-group col-lg-6'>
                                    <select id='designation' name='designation' type='text' class='form-control' required>option
                                        <option value=". ($row['position'] == 'Admin'?'Admin':'') ." selected>". ($row['position'] == 'Admin'?'Admin':'') ."</>
                                        <option value='Encoder' ". (!empty($row['position'] == 'Encoder')?'selected':'') .">Encoder</option>
                                        <option value='Social Worker' ". ($row['position'] == 'Social Worker'?'selected':'') .">Social Worker</option>
                                    </select>
                                    <label class='active' for='designation'>Designate Position</label>
                                </div>
                                <div class='form-group col-lg-6'>
                                    <select id='office' name='office' type='tex' class='form-control' required>
                                    <option value='' selected></option>";
                                        $getoffice = $user->optionoffice();
                                            //Loop through results
                                        foreach($getoffice as $index => $value){
                                            //Display info
                                            $output .= '<option value="'. $value['office_id'] .'" '. (($row['office_id']==$value['office_id'])?"selected":"") .'> ';
                                            $output .= $value['office_name'];
                                            $output .= '</option>';
                                        }
                                    
                                    $output .= "</select>
                                    <label class='active' for='office'>Designate Office</label>
                                </div>
                            </div>
                        </div>
                        <div class='modal-footer'>
                            <button type='submit' name='r_confirmation' class='btn btn-primary deep-sky'> Confirm </button>
                                    
                        </div>
                    </form>
                    ";


        echo $output;
    }
?>