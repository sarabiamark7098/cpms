<?php
	include('../php/class.user.php');
	$user = new User();
    if (isset($_POST['search_client'])) {
        $var = $_POST['search_client'];
        $output = '';
        if (strlen($var) >= 5) {
            $result = $user->searchServedforReissue($var);
            if ($result) {
                if (mysqli_num_rows($result) > 0){
                    $output .= '';
                    while ($row = mysqli_fetch_array($result)) {
                        $client_assistance = $user->getGISAssistance($row['trans_id']); //kuha sa data sa assistance table
                        
                        $output .= "<tr class='danger' style='font-size: 15px;'>
                                    <td>". $row['lastname'] .", ". $row['firstname'] ." ". $row['middlename'] ." ". (!empty($row['extraname'])?$row['extraname']:"") ."</td>
                                    <td>";
                        if ($row['relation']!='Self') {
                            $output .= $row['b_lname'].", ".$row['b_fname']." ".$row['b_mname'] ." ". (!empty($row['b_exname'])?$row['b_exname']:"");
                        } else {
                            $output .= $row['lastname'].", ".$row['firstname']." ".$row['middlename']." ".(!empty($row['extraname'])?$row['extraname']:"");
                        }
                                        
                        $output .= "</td><td>";
                        if ($row['date_accomplished'] != "") {
                            $output .= $user->dateformat($row['date_accomplished']);
                            $dateaccomplished = date($row['date_accomplished']);
                            $dateaccomplished2 = strtotime($row['date_accomplished']);
                            $accomplisheddate = explode("-", $dateaccomplished);
                            $next_due_date = date('Y-m-d H:i:s', strtotime('+ 30 days', $dateaccomplished2));
                        }
                        $output .= "</td>
                                    <td class='text-success'>";
                        if ($row['date_accomplished'] != "") {
                            $output .= $user->threemonth($row['date_accomplished']);
                            $output .= "<p class='text-danger'>Remaining ".$user->datediffFromToEnd($row['date_accomplished']) ."<p>";
                        }
                                    

                        //Action
                        $output .= "</td><td>".
                                        $client_assistance[1]['type']."<br>".(!empty($client_assistance[2]['type'])?$client_assistance[2]['type']:"")."</td>
                                        <td>";

                        // //Mode
                        $output .= $client_assistance[1]['mode'] ."<br>". (!empty($client_assistance[2]['type'])?$client_assistance[2]['mode']:"")."</td>";


                        $output .= "<td>";


                        if ($row['status_client'] != 'Decline') {
                            if (!empty($client_assistance[1]['type']) &&  $client_assistance[1]['mode']== 'GL') {
                                $output .= "<button type='submit' class='btn btn-outline-success deep-sky' onclick='re_issue(`{$row['trans_id']}`)' style='margin-bottom: 5px; font-size: 13px; width: 120px'><i class='fa fa-print'></i> Re-Issue </button><br>";
                                $output .= "<button type='submit' class='btn btn-outline-success deep-sky' onclick='re_issue_for_the(`{$row['trans_id']}`)' style='margin-bottom: 5px; font-size: 13px; width: 120px'><i class='fa fa-print'></i> GL W/ For The </button><br>";
                            }
                                $output .= "<button type='submit' class='btn btn-outline-success deep-sky' onclick='update_document(`{$row['trans_id']}`)' style='margin-bottom: 5px; font-size: 13px; width: 120px'><i class='fa fa-print'></i>Update</button>";
                        }
                                

                        $output .= "</td>
                                    <td>";
                                    
                        if ($row['status_client']=='Done') {
                            $output .= "<h4><small class='text'>Served</small></h4>";
                        } elseif ($row['status_client']=='Decline') {
                            $output .= "<h4><small class='text-danger'>Declined</small></h4>";
                        }
            
                                    
                        $output .= "</td>
                                    </tr>";
                    }
                } else {
                    echo '<b class="text-danger">No Data</b>';
                } 
            } else {
                echo '<b class="text-danger">No Data</b>';
            } 
        }
        echo $output;
    }

    if(isset($_POST["search"])){
        $search = trim($_POST["search"]);
        $search = mysqli_real_escape_string($user->db, $search); 

        $sql= "SELECT * FROM provider WHERE company_name like '%".$search."%' LIMIT 1;";
        $result = mysqli_query($user->db, $sql);

        if($result && mysqli_num_rows($result) > 0){
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


    if(isset($_POST['num'])){
        $trans_id = $_POST['id'];
        $id = $_POST['num'];
        $sql="SELECT trans_id FROM gl WHERE client_no='{$id}'";
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

    if(isset($_POST['backid'])){
        
        $id = $_POST['backid'];

        $query = "UPDATE tbl_transaction SET status_client = 'Pending', encoded_socialWork = '' WHERE trans_id = '{$id}';";
        $result = mysqli_query($user->db,$query);
        if($result){
            return true;
        }else{
            return false;  
        }
    }

    if(isset($_POST['soc_work'])){
        $output = '';
        
        $sql= "SELECT a.trans_id, a.note, a.encoded_encoder, a.relation, a.date_entered, b.lastname, b.firstname, b.middlename, b.extraname, c.b_fname, c.b_mname, c.b_lname, c.b_exname  FROM client_data as b
        LEFT JOIN tbl_transaction as a USING (client_id)
        LEFT JOIN beneficiary_data as c USING (bene_id)
        WHERE status_client = 'Pending' order by date_entered asc;";
        $result2 = mysqli_query($user->db, $sql);
        
        if(mysqli_num_rows($result2) > 0){
            $output = "";
            while($row = mysqli_fetch_array($result2)){
                
                $query = "SELECT LEFT('{$row['trans_id']}', 9) as foid";
                $result3 = mysqli_query($user->db,$query);
                $row1 = mysqli_fetch_assoc($result3);
                // echo "<script> console.log('{$row1['foid']}') </script>";
        
                if($_SESSION['f_office'] == $row1['foid']){
        
                    $getEncoder = $user->getEncoder($row['encoded_encoder']);
                    $output .= "<tr>
                                    <td>{$row['lastname']}, {$row['firstname']} {$row['middlename']} {$row['extraname']} </td>
                                    <td>";
                                    if($row['relation']!='Self'){
                                        $output .= $row['b_lname'].", ".$row['b_fname']." ".$row['b_mname']." ".(!empty($row['b_exname'])?$row['b_exname']:"");
                                    }else{
                                        $output .= $row['lastname'].", ".$row['firstname']." ".$row['middlename']." ".(!empty($row['extraname'])?$row['extraname']:"");
                                    }
                                    
                        $output .= "</td>
                                    <td>{$row['date_entered']}</td>
                                    <td>{$getEncoder}</td>
                                    <td>";
                                    
                                    if($row['note'] == 'yes'){
                                        $output.= "<a type='button' class=' btn btn-primary deep-sky text-white' href='gis.php?&id={$row['trans_id']}' style='margin-right: 10px; width: 80px;'> Serve</a>
                                        <button class='btn btn-danger deep-sky text-white' data-id='{$row['trans_id']}' data-target='#declineclient' data-toggle='modal' style='margin-right: 10px; width: 80px';> X </button>";
                                    } else {
                                        $output.= "<a type='button' class=' btn btn-primary deep-sky text-white' href='gis.php?&id={$row['trans_id']}' style='margin-right: 10px; width: 80px;'> Serve</a>
                                        <button class='btn btn-danger deep-sky text-white' data-id='{$row['trans_id']}' data-target='#declineclient' data-toggle='modal' style='margin-right: 10px; width: 80px';> X <span class='badge badge-success'>1</span></button>";
                                    }
                    $output.=       "</td>
                            </tr>";
                }
            }
            echo $output;
        }else{
        echo '';
        }
        
    }
    
    if(isset($_POST['assessmentoption'])){
        $assessment = $_POST['assessmentoption'];
        $query = "SELECT * FROM gisassessment WHERE ass_opt = '".$assessment."';";
        // echo "<script>console.log(".$query.")</script>";
        $result = mysqli_query($user->db,$query);
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
            $sw_problem_presented = $row["prob_pres"];
            $sw_assessment = $row["ass_socwork"];

            $json = array('problem_presented' => $sw_problem_presented, 'sw_assessment' => $sw_assessment);
            print_r(json_encode($json));
            
        }
    }

    if(isset($_POST['soc_work_serving'])){
        $output = '';
        
        $sql= "SELECT * FROM client_data 
        LEFT JOIN tbl_transaction using (client_id)
        LEFT JOIN beneficiary_data using (bene_id)
        WHERE status_client = 'Serving' AND encoded_socialWork = '{$_SESSION['userId']}' order by date_entered asc;";
		
		$result = mysqli_query($user->db, $sql);
        if(!empty($result) && mysqli_num_rows($result) > 0){
            $output = "";
            while($row = mysqli_fetch_array($result)){
                $query = "SELECT LEFT('{$row['trans_id']}', 9) as foid";
                $result2 = mysqli_query($user->db,$query);
                $row2 = mysqli_fetch_assoc($result2);
                // echo "<script> console.log('{$row1['o_id']}') </script>";
        
                if($_SESSION['f_office'] == $row2['foid']){
        
				/*if(!empty($row['encoded_socialWork'])){ */
					/*if($row['encoded_socialWork'] == $_SESSION['userId']){ */
					$getEncoder = $user->getEncoder($row['encoded_encoder']);
					$output .= "<tr>
									<td>{$row['lastname']}, {$row['firstname']} {$row['middlename']} {$row['extraname']}</td>
                                    <td>";
                                    if($row['relation']!='Self'){
                                        $output .= $row['b_lname'].", ".$row['b_fname']." ".$row['b_mname']." ".(!empty($row['b_exname'])?$row['b_exname']:"");
                                    }else{
                                        $output .= $row['lastname'].", ".$row['firstname']." ".$row['middlename']." ".(!empty($row['extraname'])?$row['extraname']:"");
                                    }
                    $output .= "</td>
									<td>{$row['date_entered']}</td>
									<td>{$getEncoder}</td>
									<td>";
									if($row['note'] == 'yes'){
										$output.= "<a type='button' class=' btn btn-primary deep-sky text-white' href='gis.php?id={$row['trans_id']}&option=2' style='margin-right: 10px;'>Continue</a>
										<button class='btn btn-danger deep-sky text-white' data-id='{$row['trans_id']}' data-target='#declineclient' data-toggle='modal' style='margin-right: 10px; margin-top: 5px; width: 80px;'> X </button>";
									} else {
										$output.= "<a type='button' class=' btn btn-primary deep-sky text-white' href='gis.php?id={$row['trans_id']}&option=2' style='margin-right: 10px;'>Continue</a>
										<button class='btn btn-danger deep-sky text-white' data-id='{$row['trans_id']}' data-target='#declineclient' data-toggle='modal' style='margin-right: 10px; margin-top: 5px; width: 80px;'> X <span class='badge badge-success'>1</span></button>";
									}
					$output.=       "</td>
							</tr>";
                        // }
                    // }
                }
            }
			while($row = mysqli_fetch_array($result)){
			   $getEncoder = $user->getEncoder($row['encoded_encoder']);
                $output .= "<tr>
                                <td>{$row['lastname']}, {$row['firstname']} {$row['middlename']}</td>
                                <td>{$row['b_lname']}, {$row['b_fname']} {$row['b_mname']}</td>
                                <td>{$row['date_entered']}</td>
                                <td>{$getEncoder}</td>
                                <td>";
                                if($row['note'] == 'no'){
                                    $output.= "<a type='button' class=' btn btn-primary deep-sky text-white' href='gis.php?id={$row['trans_id']}&option=2' style='margin-right: 10px;'>Continue</a>
                                    <button class='btn btn-danger deep-sky text-white' data-id='{$row['trans_id']}' data-target='#declineclient' data-toggle='modal' style='margin-right: 10px; margin-top: 5px; width: 80px;'> X</button>";
                                } else {
                                    $output.= "<a type='button' class=' btn btn-primary deep-sky text-white' href='gis.php?id={$row['trans_id']}&option=2' style='margin-right: 10px;'>Continue</a>
                                    <button class='btn btn-danger deep-sky text-white' data-id='{$row['trans_id']}' data-target='#declineclient' data-toggle='modal' style='margin-right: 10px; margin-top: 5px; width: 80px;'> X <span class='badge badge-success'>1</span></button>";
                                }
                $output.=       "</td>
                        </tr>";
            }
            echo $output;
        }else{
        echo '';
        }
    }

    if(isset($_POST['page'])){
        $output = "";
        $page = $_POST['page'];
        $datas = ($_POST['page'] - 1 )  * 8; //asa magsugod ang id n e show
        // echo $page;
        $datenow = date("Y-m-d");
		// $datenow2 = date("Y-m-d");
		$datenow = strtotime($datenow);
		$datenow2 = date('Y-m-d', strtotime('+ 1 days', $datenow));
        $datenow = date("Y-m-d");
        // echo $_POST['d_1'];
        // echo $_POST['d_2'];
        $output = '
            <form class="form-group" action="summary_social.php" method="POST">
                <div class="row" style="padding-bottom: 50px;">
                    <div class="col-lg-5"></div>
                    <div class="col-lg-1" style="padding-top: 10px;"><p style="font-size: 14px;">Total Client:<p></div>
                    <div class="col-lg-1"><input id="counttotalclient" class="form-control border border-dark text-center" style="width:120%;margin-left:-30px;" disabled placeholder="0"></div>
                    <div class="col-lg-5"></div>
                </div>
                <div class="row" style="padding-bottom: 30px;">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-3"><input id="d_1" name="d_1" class="form-control border border-primary" type="date" required></div>
                    <div class="col-lg-2"></div>
                    <div class="col-lg-3"><input id="d_2" name="d_2" class="form-control border border-primary" type="date" required></div>
                    <div class="col-lg-1"><button class="btn btn-outline-primary text-center" type="submit">Submit<button></div>
                    <div class="col-lg-1"></div>
                </div>
            </form>
            
            <table class="table">
                    <thead>
                        <tr>
                            <th>Client Name</th>
                            <th>Beneficiary Name</th>
                            <th>Transaction Date</th>
                            <th>Encoder</th>
                            <th>Mode of Assistance</th>
                        </tr>
                    </thead>
                    <tbody id="page_data">';
        if (!empty($_POST['date1']) && !empty($_POST['date2'])) {
			$query = "SELECT client_id, trans_id, lastname, firstname, middlename, extraname, date_accomplished, encoded_encoder, b_fname, b_mname, b_lname, b_exname 
            FROM `client_data` 
            LEFT JOIN tbl_transaction using (client_id) 
            LEFT JOIN beneficiary_data using(bene_id)
            where (status_client = 'Done' AND encoded_socialWork = '{$_SESSION['userId']}' AND (date_accomplished BETWEEN '{$_POST['date1']}' AND '{$_POST['date2']}'))";
			$result = mysqli_query($user->db, $query);
			$rownum = mysqli_num_rows($result);
            $query = "SELECT client_id, trans_id, lastname, firstname, middlename, extraname, date_accomplished, encoded_encoder, b_fname, b_mname, b_lname, b_exname 
            FROM `client_data` 
            LEFT JOIN tbl_transaction using (client_id) 
            LEFT JOIN beneficiary_data using(bene_id)
            where (status_client = 'Done' AND encoded_socialWork = '{$_SESSION['userId']}' AND (date_accomplished BETWEEN '{$_POST['date1']}' AND '{$_POST['date2']}')) ORDER BY `tbl_transaction`.`date_accomplished` DESC limit {$datas}, 8";
        }else{
			$query = "SELECT client_id, trans_id, lastname, firstname, middlename, extraname, date_accomplished, encoded_encoder, b_fname, b_mname, b_lname, b_exname 
            FROM `client_data` 
            LEFT JOIN tbl_transaction using (client_id) 
            LEFT JOIN beneficiary_data using(bene_id)
            where (status_client = 'Done' AND encoded_socialWork = '{$_SESSION['userId']}' AND (date_accomplished BETWEEN '{$datenow}' AND '{$datenow2}'));";
			$result = mysqli_query($user->db, $query);
			$rownum = mysqli_num_rows($result);
            $query = "SELECT client_id, trans_id, lastname, firstname, middlename, extraname, date_accomplished, encoded_encoder, b_fname, b_mname, b_lname, b_exname 
            FROM `client_data` 
            LEFT JOIN tbl_transaction using (client_id) 
            LEFT JOIN beneficiary_data using(bene_id)
            where status_client = 'Done' AND encoded_socialWork = '{$_SESSION['userId']}' AND (date_accomplished BETWEEN '{$datenow}' AND '{$datenow2}') ORDER BY `tbl_transaction`.`date_accomplished` DESC limit {$datas}, 8";
        }
        $result = mysqli_query($user->db, $query);
        echo '<script>
                console.log("'.$rownum.'");
                document.getElementById("counttotalclient").value = "'.$rownum.'";
            </script>';
        if($result){
            while($row = mysqli_fetch_assoc($result)){
                $cname = $row['lastname'] .", ". $row['firstname'] ." ". $row['middlename'][0] ." ". (!empty($row['extraname'])?$row['extraname']:""); 
                if(!empty($row['b_lname'])){
                    $bname = $row['b_lname'] .", ". $row['b_fname'] ." ". $row['b_mname'][0] ." ". (!empty($row['b_exname'])?$row['b_exname']:"");
                }
                $output .= '
                <tr>
                    <td>'. $cname .'</td>';
                    if(empty($row['b_lname'])){
                        $output .= '<td>'. $cname .'</td>';
                    }else{
                        $output .= '<td>'. $bname .'</td>';
                    }
            $output .= '   
                    <td>'. $row['date_accomplished'] .'</td>
                    <td>'. $user->getEncoder($row['encoded_encoder']) .'</td>
                    <td>'. $user->get_assistance_mode($row['trans_id']).'</td>
    
               </tr>';
            }
        }else{
            $output .= '
                    <tr>
                        <td>1</td>
                        <td>2</td>
                        <td>3</td>
                        <td>4</td>
                        <td>5</td>
                    </tr>';
        }

        $output .= '
                    </tbody>
                </table>
                <div class="form-group">
                    <div class="row d-flex justify-content-between">
                        <div class="col-5"></div>';
                if($page-1){
                    $output .= '<button id="prev" onclick="prev('. ($page - 1) .');"><i style="float: right;font-size:25px" class="fa fa-angle-double-left"></i></button>';
                }
                        
        
        
        $output .= '   <span class="pagination_link" id="1"><u>'. $page .'</u></span>
                        <button id="next" onclick="next('. ($page + 1) .');"><span><i style="float: right;font-size:25px" class="fa fa-angle-double-right"></i></span></button>
                        <div class="col-5"></div>
                    </div>
                </div>';

        echo $output;
                
    }

?>