<?php
     include('../php/class.user.php');
     $user = new User();
     if(isset($_GET['m'])){
        $month  = intval($_GET['m']);
     }
     if(isset($_GET['y'])){
        $year=  intval($_GET['y']);
     }
     $office_loc = $_SESSION['f_office'];
?>

<?php
    $count = 0;
    $query= "SELECT
            client_id, trans_id, date_entered, encoded_encoder, control_no , date_accomplished, 
            client_region, client_province, client_municipality, client_barangay, client_district,
            lastname, firstname, middlename, extraname, sex, civil_status, date_birth, mode_admission, category, 
            b_lname, b_fname, b_mname, b_exname, cname, subCategory
            from client_data
            LEFT JOIN tbl_transaction USING (client_id)
            LEFT JOIN beneficiary_data USING (bene_id)
            LEFT JOIN assessment USING (trans_id)
            LEFT JOIN gl USING (trans_id)
            WHERE Left(trans_id, 9) = '{$office_loc}' AND YEAR(date_accomplished) = {$year} AND MONTH(date_accomplished) = {$month} AND tbl_transaction.status_client='Done' 
            ORDER BY tbl_transaction.date_entered ASC";
    
    $result = mysqli_query($user->db,$query);
   

    $columnHeader = "Date Entered"."\t"."Entered By"."\t"."Client No"."\t"."Date Accomplished"."\t"."Region"."\t"."Province"."\t".
                    "City/Municipality"."\t"."Barangay"."\t"."District"."\t"."LastName"."\t"."FirstName"."\t"."MiddleName"."\t".
                    "ExtraName"."\t"."Sex"."\t"."CivilStatus"."\t"."DOB"."\t"."Age"."\t"."ModeOfAdmission"."\t"."Type of Assistance1"."\t".
                    "Amount1"."\t"."Source of Fund1"."\t"."Type of Assistance2"."\t"."Amount2"."\t". "Source of Fund2"."\t"."ClientCategory".
                    "\t"."CHARGING"."\t"."MODE"."\t"."SERVICE PROVIDERS"."\t"."B. LAST NAME"."\t"."B. FIRST NAME"."\t"."B. MIDDLE NAME"."\t"
                    ."B. EXT."."\t"."Sub Category";
    $setData='';
    
    while($row = mysqli_fetch_assoc($result))
    {
        $mode = "";
        $fullname = $user->getuserFullname($row['encoded_encoder']);
        $assistance = $user-> getAssistanceData($row['trans_id']);
        $rowData = '';
        $rowData =  $row['date_entered']         ."\t".
                    $fullname                    ."\t'".
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
                    $row['category']                        ."\t".
                    $assistance[1]['fund']                  ."\t".
                    $assistance[1]['mode'] .''. $mode       ."\t".
                    $row['cname']                    ."\t".
                    $row['b_lname']                         ."\t".
                    $row['b_fname']                         ."\t".
                    $row['b_mname']                         ."\t".
                    $row['b_exname']                        ."\t".
                    $row['subCategory'];
        $setData .= trim(strtoupper($rowData))."\n"; //for another line of data
        //print_r($rowData);
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