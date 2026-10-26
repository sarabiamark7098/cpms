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
        if(strlen($var) >= 5){
            $result = $user->searchServed($var);
            if ($result) {
                if(mysqli_num_rows($result) > 0){
                    $output .= '';
                    while ($row = mysqli_fetch_array($result)) {
                        $client_assistance = $user->getGISAssistance($row['trans_id']); //kuha sa data sa assistance table

                        $output .= "<tr class='danger' style='font-size: 15px;'>
                                    <td>". $row['lastname'] .", ". $row['firstname'] ." ". $row['middlename'] ." ". $row['extraname'] ."</td>
                                    <td>";
                        if ($row['relation']!='Self') {
                            $output .= $row['b_lname'].", ".$row['b_fname']." ".$row['b_mname']." ".(!empty($row['b_exname'])?$row['b_exname']:"");
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
                        $output .= "</td>
                                    <td>".(!empty($client_assistance[1]['type'])?$client_assistance[1]['type']:"")."<br>".(!empty($client_assistance[2]['type'])?$client_assistance[2]['type']:"")."</td>
                                    <td>
                                    <button type='submit' class='btn btn-outline-primary deep-sky' data-toggle='modal' data-target='#clientdata' data-id='". $row["trans_id"] ."' style='margin-bottom:5px; font-size: 13px; width: 120px'> View </button>";
                        if ($row['status_client'] == 'Done') {
                            $output .= "<button type='button' class='btn btn-outline-warning deep-sky' onclick=\"window.location.href='financeupdate/edit_amount.php?id=". $row["trans_id"] ."'\" style='margin-bottom:5px; font-size: 13px; width: 120px'><i class='fa fa-edit'></i> Update </button>";
                        }
                        if ($row['status_client'] != 'Decline') {
                            $output .= "<button type='submit' class='btn btn-outline-danger deep-sky' data-toggle='modal' data-target='#cancelGL' data-id='". $row["trans_id"] ."' style='margin-right: 5px; font-size: 13px; width: 120px'><i class='fa fa-eraser'></i> Cancel GL </button>";
                        }
                        $output .= "</td><td>";

                        if ($row['status_client']=='Done') {
                            $output .= "<h4><small class='text'>Served</small></h4>";
                        } elseif ($row['status_client']=='Decline') {
                            $output .= "<h4><small class='text-danger'>Declined</small></h4>";
                        }
                        $output .= "</td>
                                    </tr>";
                    }
                }else{
                    echo '<b class="text-danger">No Data</b>';
                }
            }else{
                echo '<b class="text-danger">No Data</b>';
            }
        echo $output;
        }
    }
?>
