<?php
	include('../php/class.user.php');
	$user = new User();
?>
<?php
	if(!$_SESSION['login']){
		header('Location:../index.php');
        }
        
    $newdate = date("Y-m-d H:i:s");
    $now = explode("-",$newdate);

?>

<?php
    if(isset($_POST['search'])){
        $var = $_POST['search'];
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
                            $output .= "</td>
                            <td>".$client_assistance[1]['type']."<br>".(!empty($client_assistance[2]['type'])?$client_assistance[2]['type']:"")."</td>
                            <td>
                            <button type='submit' class='btn btn-outline-primary deep-sky' data-toggle='modal' data-target='#clientdata' data-id='". $row["trans_id"] ."' style='margin-bottom:5px; font-size: 13px; width: 120px'> View </button>";
                            if($row['status_client'] != 'Decline'){
                                $output .= "<button type='submit' class='btn btn-outline-success deep-sky' data-toggle='modal' data-target='#reissue' data-id='". $row["trans_id"] ."' style='margin-bottom: 5px; font-size: 13px; width: 120px'><i class='fa fa-print'></i>Update</button>";
                                $output .= "<button type='submit' class='btn btn-outline-success deep-sky' onclick='re_print(`{$row['trans_id']}`)' style='margin-bottom: 5px; font-size: 13px; width: 120px'><i class='fa fa-print'></i> Re-print </button>";
                            }
                            
                            $output .= "</td><td>";
                            
                            
                            $output .= "<button type='submit' class='btn btn-outline-dark deep-sky' data-toggle='modal' data-target='#passclient' data-id='". $row["trans_id"] ."' style='margin-right: 5px; font-size: 13px; width: 120px'";
                            if($row['clientonly'] == 0){
                                $output .= "hidden";
                            }
                            $output .= "> Client Only </button>";
                            if(strtolower($row['relation']) != 'self'){
                                $output .= "<button type='submit' class='btn btn-outline-dark deep-sky' data-toggle='modal' data-target='#passwithbene' data-id='". $row["trans_id"] ."' style='margin-right: 5px; margin-top: 5px; font-size: 13px; width: 120px'";
                                if($row['clientsamebene'] == 0){
                                    $output .= "hidden";
                                }
                                $output .= "> Same Bene </button>";
                                $output .= "<button type='submit' class='btn btn-outline-dark deep-sky' data-toggle='modal' data-target='#passbenetoclient' data-id='". $row["trans_id"] ."' style='margin-right: 5px; margin-top: 5px; font-size: 13px; width: 120px'";
                                if($row['benetoclient'] == 0){
                                    $output .= "hidden";
                                }
                                $output .= "> Bene as Client </button>";
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

    if(isset($_POST['page'])){
        $output = "";
        $page = $_POST['page'];
        $datas = ($_POST['page'] - 1 )  * 10; //asa magsugod ang id n e show
        //echo $page;
        $query = "SELECT client_id, trans_id, lastname, firstname, middlename, extraname, date_accomplished, encoded_socialWork, b_fname, b_mname, b_lname, b_exname 
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
                            <th>Social Worker</th>
                            <th>Mode of Assisstance</th>
                        </tr>
                    </thead>
                    <tbody id="page_data">';
        $result = mysqli_query($user->db, $query);
        if($result){
            while($row = mysqli_fetch_assoc($result)){
                $cname = $row['lastname'] .", ". $row['firstname'] ." ". $row['middlename'][0] .". ". $row['extraname']; 
                $bname = $row['b_lname'] .", ". $row['b_fname'] ." ". $row['b_mname'][0] .". ". $row['b_exname'];
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
                    <td>'. $user->getsocialWork($row['encoded_socialWork']) .'</td>
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