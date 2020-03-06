<?php
	include('../php/class.user.php');
	$user = new User();

    if(isset($_POST['search_client'])){
        $var = $_POST['search_client'];
        $output = '';
        $result = $user->searchServed($var);
		if($result){
            $output .= '';
            while($row = mysqli_fetch_array($result)){        
                    $client_assistance = $user->getGISAssistance($row['trans_id']); //kuha sa data sa assistance table
                
                    $output .= "<tr class='danger' style='font-size: 15px;'>
                            <td>". $row['lastname'] .", ". $row['firstname'] ." ". $row['middlename'] ." ". $row['extraname'] ."</td>
                            <td>";
                                if($row['relation']!='Self'){
                                    $output .= $row['b_lname'].", ".$row['b_fname']." ".$row['b_mname'];
                                }else{
                                    $output .= $row['lastname'].", ".$row['firstname']." ".$row['middlename'];
                                }
                                
                    $output .= "</td><td>"; 
                            if($row['date_accomplished'] != ""){
                                $output .= $user->dateformat($row['date_accomplished']);
                                $dateaccomplished = date($row['date_accomplished']);
                                $dateaccomplished2 = strtotime($row['date_accomplished']);
                                $accomplisheddate = explode("-",$dateaccomplished);
                                $next_due_date = date('Y-m-d H:i:s', strtotime('+ 30 days', $dateaccomplished2));
                            }
                            $output .= "</td>
                            <td class='text-success'>";
                            if($row['date_accomplished'] != ""){
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


                            if($row['status_client'] != 'Decline'){
                                if(!empty($client_assistance[1]['type']) &&  $client_assistance[1]['mode']== 'GL'){
                                    $output .= "<button type='submit' class='btn btn-outline-success deep-sky' onclick='re_issue(`{$row['trans_id']}`)' style='margin-bottom: 5px; font-size: 13px; width: 120px'><i class='fa fa-print'></i> Re-Issue </button>";
                                }
                                
                            }
                        

                            $output .= "</td>
                            <td>";
                            
                            if($row['status_client']=='Done') {
                                $output .= "<h4><small class='text'>Served</small></h4>";
                            } elseif($row['status_client']=='Decline') {
                                $output .= "<h4><small class='text-danger'>Declined</small></h4>";
                                
                            }
    
                            
                            $output .= "</td>
                            </tr>"; 
				}
			}else{
				echo '';
			}
            echo $output;
    }

    if(isset($_POST["search"])){
        $output = '';
        $sql= "SELECT * FROM provider WHERE company_name like '%".$_POST["search"]."%'";
        $result = mysqli_query($user->db, $sql);
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
            $address = $row["company_address"];
            $pos = $row["addressee_position"]; 
            $aname = $row["addressee_name"];
            
            $json = array('address' => $address, 'position' => $pos, 'aname' => $aname);
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
        
        $sql= "SELECT * FROM client_data 
        LEFT JOIN tbl_transaction USING (client_id)
        LEFT JOIN beneficiary_data USING (bene_id)
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
                                    <td>{$row['lastname']}, {$row['firstname']} {$row['middlename']}</td>
                                    <td>";
                                    if($row['relation']!='Self'){
                                        $output .= $row['b_lname'].", ".$row['b_fname']." ".$row['b_mname'];
                                    }else{
                                        $output .= $row['lastname'].", ".$row['firstname']." ".$row['middlename'];
                                    }
                                    
                        $output .= "</td>
                                    <td>{$row['date_entered']}</td>
                                    <td>{$getEncoder}</td>
                                    <td>";
                                    if($row['note'] == 'yes'){
                                        $output.= "<a type='button' class=' btn btn-primary deep-sky text-white' href='gis.php?&id={$row['trans_id']}' style='margin-right: 10px;'> Serve</a>
                                        <button class='btn btn-primary deep-sky text-white' data-id='{$row['trans_id']}' data-target='#declineclient' data-toggle='modal' style='margin-right: 10px;'> Decline</button>";
                                    } else {
                                        $output.= "<a type='button' class=' btn btn-primary deep-sky text-white' href='gis.php?&id={$row['trans_id']}' style='margin-right: 10px;'> Serve</a>
                                        <button class='btn btn-primary deep-sky text-white' data-id='{$row['trans_id']}' data-target='#declineclient' data-toggle='modal' style='margin-right: 10px;'>Decline<span class='badge badge-danger'>1</span></button>";
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
									<td>{$row['lastname']}, {$row['firstname']} {$row['middlename']}</td>
                                    <td>";
                                    if($row['relation']!='Self'){
                                        $output .= $row['b_lname'].", ".$row['b_fname']." ".$row['b_mname'];
                                    }else{
                                        $output .= $row['lastname'].", ".$row['firstname']." ".$row['middlename'];
                                    }
                    $output .= "</td>
									<td>{$row['date_entered']}</td>
									<td>{$getEncoder}</td>
									<td>";
									if($row['note'] == 'yes'){
										$output.= "<a type='button' class=' btn btn-primary deep-sky text-white' href='gis.php?id={$row['trans_id']}&option=2' style='margin-right: 10px;'>Continue Serving</a>
										<button class='btn btn-danger deep-sky text-white' data-id='{$row['trans_id']}' data-target='#declineclient' data-toggle='modal' style='margin-right: 10px; margin-top: 5px;'>X</button>";
									} else {
										$output.= "<a type='button' class=' btn btn-primary deep-sky text-white' href='gis.php?id={$row['trans_id']}&option=2' style='margin-right: 10px;'>Continue Serving</a>
										<button class='btn btn-danger deep-sky text-white' data-id='{$row['trans_id']}' data-target='#declineclient' data-toggle='modal' style='margin-right: 10px; margin-top: 5px;'>X <span class='badge badge-success'>1</span></button>";
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
                                if($row['note'] == 'yes'){
                                    $output.= "<a type='button' class=' btn btn-primary deep-sky text-white' href='gis.php?id={$row['trans_id']}&option=2' style='margin-right: 10px;'>Continue Serving</a>
                                    <button class='btn btn-danger deep-sky text-white' data-id='{$row['trans_id']}' data-target='#declineclient' data-toggle='modal' style='margin-right: 10px; margin-top: 5px;'>X</button>";
                                } else {
                                    $output.= "<a type='button' class=' btn btn-primary deep-sky text-white' href='gis.php?id={$row['trans_id']}&option=2' style='margin-right: 10px;'>Continue Serving</a>
                                    <button class='btn btn-danger deep-sky text-white' data-id='{$row['trans_id']}' data-target='#declineclient' data-toggle='modal' style='margin-right: 10px; margin-top: 5px;'>X <span class='badge badge-success'>1</span></button>";
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
        $datas = ($_POST['page'] - 1 )  * 10; //asa magsugod ang id n e show
        //echo $page;
        $query = "SELECT client_id, trans_id, lastname, firstname, middlename, extraname, date_accomplished, encoded_encoder, b_fname, b_mname, b_lname, b_exname 
                FROM `client_data` 
                LEFT JOIN tbl_transaction using (client_id) 
                LEFT JOIN beneficiary_data using(bene_id)
                where status_client = 'Done' ORDER BY `tbl_transaction`.`date_accomplished` DESC limit {$datas}, 10";
    
        $output = '
            <table class="table">
                    <thead>
                        <tr>
                            <th>Client Name</th>
                            <th>Beneficiary Name</th>
                            <th>Transaction Date</th>
                            <th>Encoder</th>
                            <th>Mode of Assisstance</th>
                        </tr>
                    </thead>
                    <tbody id="page_data">';
        $result = mysqli_query($user->db, $query);
        if($result){
            while($row = mysqli_fetch_assoc($result)){
                $cname = $row['lastname'] .", ". $row['firstname'] ." ". $row['middlename'][0] ." ". $row['extraname']; 
                $bname = $row['b_lname'] .", ". $row['b_fname'] ." ". $row['b_mname'][0] ." ". $row['b_exname'];
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