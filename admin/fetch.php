<?php
include('../php/class.user.php');
	$user = new User();

    if (isset($_POST['search_client'])) {
        $output = '';
        $var = $_POST['search_client'];
        // if (($scount = strlen($_POST['search_client']) > 5)) {

            if ($var=='') {
                $result = $user->searchReissue_log_noData($var);
                if ($result) {
                    $output .= '';
                    while ($row = mysqli_fetch_assoc($result)) {
                        $client_assistance = $user->getGISAssistance($row['trans_id']); //kuha sa data sa assistance table
                        $output .= "<tr class='danger' style='font-size: 15px;'>
                                <td>". $row['lastname'] .", ". $row['firstname'] ." ". $row['middlename'] ." ". $row['extraname'] ."</td>
                                <td>";
                        if ($row['relation']!='Self') {
                            $output .= $row['b_lname'].", ".$row['b_fname']." ".$row['b_mname'];
                        } else {
                            $output .= $row['lastname'].", ".$row['firstname']." ".$row['middlename'];
                        }
                                    
                        $output .= "</td><td>";
                        $output .= date('F d, Y', strtotime($row['date_reissued']));
                        $output .= "</td>";
                            
                        $output .= "<td>";
                        $output .= $user->getuserFullname($row['empid']);
                        $output .= "</td>
                                </tr>";
                    }
                } else {
                    echo '';
                }
            } else {
                $result = $user->searchReissue_log($var);
                if ($result) {
                    $output .= '';
                    // $row = mysqli_fetch_assoc($result);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $client_assistance = $user->getGISAssistance($row['trans_id']); //kuha sa data sa assistance table
                    
                        $output .= "<tr class='danger' style='font-size: 15px;'>
                                <td>". $row['lastname'] .", ". $row['firstname'] ." ". $row['middlename'] ." ". $row['extraname'] ."</td>
                                <td>";
                        if ($row['relation']!='Self') {
                            $output .= $row['b_lname'].", ".$row['b_fname']." ".$row['b_mname'];
                        } else {
                            $output .= $row['lastname'].", ".$row['firstname']." ".$row['middlename'];
                        }
                                    
                        $output .= "</td><td>";
                        $output .= date('F d, Y', strtotime($row['date_reissued']));
                        $output .= "</td>";
                            
                        $output .= "<td>";
                        $output .= $user->getuserFullname($row['empid']);
                        $output .= "</td>
                                </tr>";
                    }
                } else {
                    echo '';
                }
            // }
            }
        echo $output;
    }else{
        echo '';
    }

?>