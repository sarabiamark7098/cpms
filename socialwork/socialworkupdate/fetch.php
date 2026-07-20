<?php
	include('../../php/class.user.php');
	$user = new User();
?>
<?php
    if(isset($_POST["search"])){
        $output = '';
        $sql= "SELECT * FROM provider WHERE company_name like '%".$_POST["search"]."%'";
        $result = mysqli_query($user->db, $sql);
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
            $address = $row["company_address"];
            $pos = $row["addressee_position"]; 
            $to_mention = $row["to_mention"]; 
            $aname = $row["addressee_name"];
            
            $json = array('address' => $address, 'position' => $pos, 'to_mention' => $to_mention, 'aname' => $aname);
            echo json_encode($json);
                            
        }else{
            echo 'Data not Found';
        }
    }

    if(isset($_POST['backid'])){
        
        $id = $_POST['backid'];

        $query = "UPDATE tbl_transaction SET status_client = 'Done' WHERE trans_id = '{$id}';";
        $result = mysqli_query($user->db,$query);
        if($result){
            return true;
        }else{
            return false;  
        }
    }

    if(isset($_POST['num'])){
        $trans_id = $_POST['id'];
        $id = $_POST['num'];
        $sql="SELECT trans_id, control_no FROM gl WHERE control_no='{$id}'";
        $result = mysqli_query($user->db, $sql);
        $row = mysqli_fetch_assoc($result);
        if(mysqli_num_rows($result) > 0){
            if($trans_id == $row['trans_id']){
                
                echo 2; 
            }else{
                echo 1;
            }
        } else {
            echo 2;   
        }
    }

    if(isset($_POST['putangina'])){
        $gago = $_POST['putangina'];
        $query = "SELECT * FROM gisassessment WHERE ass_opt = '".$gago."';";
        $result = mysqli_query($user->db,$query);
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
            $sw_problem_presented = $row["prob_pres"];
            $sw_assessment = $row["ass_socwork"];

            $json = array('problem_presented' => $sw_problem_presented, 'sw_assessment' => $sw_assessment);
            print_r (json_encode($json));
            
        }
    }
    
    if(isset($_POST['assessmentoption'])){
        $assessment = $_POST['assessmentoption'];
        $query = "SELECT * FROM gisassessment WHERE ass_opt = '".$assessment."';";
        $result = mysqli_query($user->db,$query);
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
            $sw_problem_presented = $row["prob_pres"];
            $sw_assessment = $row["ass_socwork"];

            $json = array('problem_presented' => $sw_problem_presented, 'sw_assessment' => $sw_assessment);
            print_r(json_encode($json));
            
        }
    }
?>