<?php
include('../php/class.user.php');
$user = new User();

if(isset($_POST["import"])){

        $allowed =  array('csv');
        $filename_temp = $_FILES["file"]["name"];
        $ext = pathinfo($filename_temp, PATHINFO_EXTENSION);
        if(in_array($ext,$allowed)){
            $filename=$_FILES["file"]["tmp_name"];

            if($_FILES["file"]["size"] > 0)
            {
    
                 $file = fopen($filename, "r");
                
                fgets($file);
                while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)  
                {   
                        $office = $_POST["office"];
                        $imported_by = $_SESSION['userfullname'];
                        $lastname = $emapData[9];
                        $client_numTemp = $emapData[2];
                        $mode_adm = $emapData[17];

                        $client_num = mysqli_real_escape_string($user->db3,$client_numTemp);
                        $mode_admission = mysqli_real_escape_string($user->db3,$mode_adm);
                        
                        $date_enteredTemp = date_create($emapData[0]);
                        $date_entered = date_format($date_enteredTemp, "Y-m-d H:i:s");

                        $date_accom = date_create($emapData[3]);
                        $date_accomplished = date_format($date_accom,  "Y-m-d H:i:s");
                        

                        $ordate = $emapData[15];
                        $birthdate = date("Y-m-d", strtotime($ordate));
                        
                      
                        if(!empty($lastname)){

                            $query = "INSERT INTO client_info(office, imported_by, date_imported, date_entered, encoded_by,
                            client_num, date_accomplished, region, province, mun_city, barangay, district, lastname, firstname,
                            middlename, extraname, sex, civil_status, date_birth, age, mode_admission, type_assistance,amount1,
                            source_of_fund1, type_assistance2, amount2, source_fund2, category, charging, mode, b_lname, b_fname, 
                            b_mname, b_exname)
                            VALUES('$office', '$imported_by', NOW(), '$date_entered', '$emapData[1]', '$client_num',
                            '$date_accomplished', '$emapData[4]', '$emapData[5]', '$emapData[6]', '$emapData[7]', 
                            '$emapData[8]', '$emapData[9]', '$emapData[10]', '$emapData[11]', '$emapData[12]', 
                            '$emapData[13]', '$emapData[14]', '$birthdate', '$emapData[16]', '$mode_admission', '$emapData[18]', 
                            '$emapData[19]', '$emapData[20]', '$emapData[21]', '$emapData[22]', '$emapData[23]', '$emapData[24]', 
                            '$emapData[25]', '$emapData[26]', '$emapData[28]', '$emapData[29]', '$emapData[30]', '$emapData[31]');";

                            $result = mysqli_query($user->db3, $query);
                            echo "<br>";
                            echo "<br>";
                        }
                        else{
                            echo "<script type=\"text/javascript\">
                            alert(\"Error Upload!,Missing data of some fields!.\");
                            window.location = \"import_page.php\"
                        </script>";
                        }
                    
                    if(!$result){
                        echo "<script type=\"text/javascript\">
                            alert(\"Error Upload!.\");
                            window.location = \"import_page.php\"
                        </script>";
                    }
                    else{
                        echo "<script type=\"text/javascript\">
                        alert(\"Success File Upload.\");
                        window.location = \"import_page.php\"
                    </script>";
                    }
    
                }
               // fclose($file);
               
	        
            }
         }
         else{
             echo "<script type=\"text/javascript\">
                alert(\"Invalid file format:Please Upload CSV File.\");
                window.location = \"import_page.php\"
                </script>";
         }

}	
mysqli_close($user->db);  
?>