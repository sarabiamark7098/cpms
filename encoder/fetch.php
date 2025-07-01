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
                                    <td>".$client_assistance[1]['type']."<br>".(!empty($client_assistance[2]['type'])?$client_assistance[2]['type']:"")."</td>
                                    <td>
                                    <button type='submit' class='btn btn-outline-primary deep-sky' data-toggle='modal' data-target='#clientdata' data-id='". $row["trans_id"] ."' style='margin-bottom:5px; font-size: 13px; width: 120px'> View </button>";
                        if ($row['status_client'] != 'Decline') {
                            $output .= "<button type='submit' class='btn btn-outline-success deep-sky' data-toggle='modal' data-target='#reissue' data-id='". $row["trans_id"] ."' style='margin-bottom: 5px; font-size: 13px; width: 120px' hidden><i class='fa fa-print'></i>Update</button>";
                            $output .= "<button type='submit' class='btn btn-outline-success deep-sky' onclick='re_print(`{$row['trans_id']}`)' style='margin-bottom: 5px; font-size: 13px; width: 120px'><i class='fa fa-print'></i> Re-print </button>";
                            // $output .= "<button type='submit' class='btn btn-ouline-success deep-sky' onclick='create_osap(`{$row['trans_id']}`)' style='margin-bottom: 5px; font-size: 13px; width: 120px'><i class='fa fa-print'></i> Print OSAP </button>";
                            $output .= "<button type='submit' class='btn btn-outline-danger deep-sky' data-toggle='modal' data-target='#cancelGL' data-id='". $row["trans_id"] ."' style='margin-right: 5px; font-size: 13px; width: 120px'><i class='fa fa-eraser'></i> Cancel GL </button>";
                        }
                        $output .= "</td><td>";
                        $output .= "<button type='submit' class='btn btn-outline-dark deep-sky' data-toggle='modal' data-target='#passclient' data-id='". $row["trans_id"] ."' style='margin-right: 5px; font-size: 13px; width: 120px'";
                        if ($row['clientonly'] == 0) {
                            $output .= "hidden";
                        }
                        $output .= "> Client Only </button>";
                        if (strtolower($row['relation']) != 'self') {
                            $output .= "<button type='submit' class='btn btn-outline-dark deep-sky' data-toggle='modal' data-target='#passwithbene' data-id='". $row["trans_id"] ."' style='margin-right: 5px; margin-top: 5px; font-size: 13px; width: 120px'";
                            if ($row['clientsamebene'] == 0) {
                                $output .= "hidden";
                            }
                            $output .= "> Same Bene </button>";
                            $output .= "<button type='submit' class='btn btn-outline-dark deep-sky' data-toggle='modal' data-target='#passbenetoclient' data-id='". $row["trans_id"] ."' style='margin-right: 5px; margin-top: 5px; font-size: 13px; width: 120px'";
                            if ($row['benetoclient'] == 0) {
                                $output .= "hidden";
                            }
                            $output .= "> Bene as Client </button>";
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
                }else{
                    echo '<b class="text-danger">No Data</b>';
                }
            }else{
                echo '<b class="text-danger">No Data</b>';
            }
        echo $output;
        }
    }

    if(isset($_POST['page'])){
        $output = "";
        $page = $_POST['page'];
        $datas = ($_POST['page'] - 1 )  * 8; //asa magsugod ang id n e show
        //echo $page;
		$datenow = date("Y-m-d");
		// $datenow2 = date("Y-m-d");
		$datenow = strtotime($datenow);
		$datenow2 = date('Y-m-d', strtotime('+ 1 days', $datenow));
        $datenow = date("Y-m-d");
		
		$output = '
            <form class="form-group" action="summary.php" method="POST">
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
                            <th>Social Worker</th>
                            <th>Mode of Assistance</th>
                        </tr>
                    </thead>
                    <tbody id="page_data">';
        
        echo '<script>
            console.log("'.$rownum.'");
            document.getElementById("counttotalclient").value = "'.$rownum.'";
        </script>';
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