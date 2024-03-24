<?php
    include('../php/class.user.php');
    $user = new User();
    
    $year   = intval(Date("Y"));
    $year1  = intval(date("Y", strtotime("+1 days")));
    
    $day    = intval(Date("d"));
    if(strlen($day)==1){
        $day = '0'.$day;
    }else{
        $day = $day;
    }
    $month  = intval(date('m'));
    if(strlen($month)==1){
        $monthnum = '0'.$month;
    }else{
        $monthnum = $month;
    }
    $month1  = intval(date('m', strtotime('+1 days')));
    if(strlen($month1)==1){
        $monthnum1 = '0'.$month1;
    }else{
        $monthnum1 = $month1;
    }
    $day1 = intval(date('d', strtotime('+1 days')));
    if(strlen($day1)==1){
        $day1 = '0'.$day1;
    }else{
        $day1 = $day1;
    }
    $date1 = $year.'-'.$monthnum.'-'.$day.' 00:00:00';
    $date2 = $year1.'-'.$monthnum1.'-'.$day1.' 00:00:00';;
     
    $office_loc = $_SESSION['f_office'];
?>

<?php
    $count = 0;

    $query= "SELECT DISTINCT
            client_id, trans_id, date_entered, encoded_encoder, control_no, date_accomplished, mode, bene_id,
            client_region, client_province, client_municipality, client_barangay, client_district,
            lastname, firstname, middlename, extraname, sex, civil_status, date_birth, mode_admission, category, 
            b_lname, b_fname, b_mname, b_exname, cname, subCategory
            from client_data
            left join tbl_transaction USING (client_id)
            left outer join beneficiary_data USING (bene_id)
            left join assessment USING (trans_id)
            left join assistance USING (trans_id)
            left join gl USING (trans_id)
            WHERE date_accomplished BETWEEN '{$date1}' and '{$date2}'
            ORDER BY tbl_transaction.date_entered ASC";
    
    $result = mysqli_query($user->db,$query);
   

    $columnHeader = "Date Entered"."\t"."Entered By"."\t"."Client No"."\t"."Date Accomplished"."\t"."Region"."\t"."Province"."\t".
                    "City/Municipality"."\t"."Barangay"."\t"."District"."\t"."LastName"."\t"."FirstName"."\t"."MiddleName"."\t".
                    "ExtraName"."\t"."Sex"."\t"."CivilStatus"."\t"."DOB"."\t"."Age"."\t"."ModeOfAdmission"."\t"."Type of Assistance1"."\t".
                    "Amount1"."\t"."Source of Fund1"."\t"."Type of Assistance2"."\t"."Amount2"."\t". "Source of Fund2"."\t"."ClientCategory".
                    "\t"."CHARGING1"."\t"."CHARGING2"."\t"."CHARGING3"."\t"."CHARGING4"."\t"."CHARGING5"."\t"."MODE"."\t"."SERVICE PROVIDERS"."\t"."B. LAST NAME"."\t"."B. FIRST NAME"."\t"."B. MIDDLE NAME"."\t"
                    ."B. EXT."."\t"."Sub Category";
    $setData='';
    
    while($row = mysqli_fetch_assoc($result))
    {
        $mode = "";
        $fullname = $user->getuserFullname($row['encoded_encoder']);
        $assistance = $user->getAssistanceData($row['trans_id']);
        $fund = $user->getfundsourcedata($row['trans_id']);
        $rowData = '';
		$lname2 = $row['b_lname'];
        $fname2 = $row['b_fname'];
		$mname2 = $row['b_mname'];
		$ename2 = $row['b_exname'];
		if($row['bene_id']<>''){
		$lname = $lname2;					
		$fname = $fname2;					
		$mname = $mname2;					
		$ename = $ename2;					
		}else{
		$lname = "";					
		$fname = "";					
		$mname = "";					
		$ename = "";						
		}
        $rowData =  $row['date_entered']         ."\t".
                    $fullname                    ."\t".
                    $row['control_no']            ."\t".
                    $row['date_accomplished']    ."\t".
                    $row['client_region']        ."\t".
                    $row['client_province']      ."\t".
                    $row['client_municipality']  ."\t".
                    $row['client_barangay']      ."\t".
                    $row['client_district']      ."\t".
                    $row['lastname']             ."\t".
                    $row['firstname']            ."\t".
                    $row['middlename']           ."\t".
                    $row['extraname']            ."\t".
                    $row['sex']                  ."\t".
                    $row['civil_status']         ."\t".
                    $row['date_birth']           ."\t".
                    $user->getAge($row['date_birth'])                 ."\t".
                    $row['mode_admission']                            ."\t".
                    $user->translateAss($assistance[1]['type'])      ."\t".
                    $assistance[1]['amount']                         ."\t\t";

            if(isset($assistance[2])){
                $mode = $assistance[2]['mode']; //mode sa 2nd assistance
                $rowData .= 
                        $user->translateAss($assistance[2]['type']) ."\t".
                        $assistance[2]['amount']                    ."\t\t";
            }else{
                $rowData .= "\t\t\t";
            }
                $rowData .=
                    $row['category']                        ."\t";
				if(!empty($fund[1]['fundsource'])){
				$rowData .= 
					$fund[1]['fundsource']." - ".$fund[1]['fs_amount']					."\t";
				} else {
				$rowData .= 
					$assistance[1]['fund']					."\t";
				}   
                if(!empty($fund[2]['fundsource'])){               	
				$rowData .= 
					$fund[2]['fundsource']." - ".$fund[2]['fs_amount']                  	."\t";
                }else{
                $rowData .= 
					"\t";
                }
                   
                if(!empty($fund[3]['fundsource'])){               	
				$rowData .= 
					$fund[3]['fundsource']." - ".$fund[3]['fs_amount']                  	."\t";
                }else{
                $rowData .= 
					"\t";
                }
                if(!empty($fund[4]['fundsource'])){               	
				$rowData .= 
					$fund[4]['fundsource']." - ".$fund[4]['fs_amount']                  	."\t";
                }else{
                $rowData .= 
					"\t";
                }
                if(!empty($fund[5]['fundsource'])){               	
				$rowData .= 
					$fund[5]['fundsource']." - ".$fund[5]['fs_amount']                  	."\t";
                }else{
                $rowData .= 
					"\t";
                }
                $rowData .=  $row['mode']         ."\t".
                    $row['cname']                    		."\t".
					$lname			                        ."\t".
                    $fname			                        ."\t".
                    $mname          			            ."\t".
                    $ename                     		    ."\t".	
                    $row['subCategory'];
        $setData .= trim(strtoupper($rowData))."\n"; //for another line of data
        // print_r($rowData);
        $count++;
    }
    if($count > 0){
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=".$user->getMonthWord($month)."-".strval($year).".xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        echo ucwords($columnHeader)."\n".$setData."\n";
    }
    else{
        echo "<script>alert('NO TRANSACTION MADE ON THIS DATE!');
		window.location.href='export.php';</script>";
    }
    
   
?>