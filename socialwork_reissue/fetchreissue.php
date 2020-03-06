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
                                $output .= "<button type='submit' class='btn btn-outline-success deep-sky' data-toggle='modal' data-target='#reissueexpired' data-id='". $row["client_id"] ."' style='margin-bottom: 5px; font-size: 13px; width: 120px'><i class='fa fa-print'></i>Reissue</button>";
                            }
                            
                            $output .= "</td><td>";
                            
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
?>