<?php
include('../php/class.user.php');
$user = new User();

if(isset($_POST["import"])){

        $allowed =  array('csv');
        $filename_temp = $_FILES["file"]["name"];
        $ext = pathinfo($filename_temp, PATHINFO_EXTENSION);
        if(in_array($ext,$allowed)){
            $filename=$_FILES["file"]["tmp_name"];

                $file = fopen($filename, "r");
                
                fgets($file);
                while (($emapData = fgetcsv($file, 100000, ",")) !== FALSE)  
                {   
                        $office = $_POST["office"];
                        $imported_by = $_SESSION['userId'];
                        $lastname = $emapData[7];
                        $mode_adm = $emapData[15];

                        $mode_admission = mysqli_real_escape_string($user->db,$mode_adm);
                        
                        $date_accom = date_create($emapData[1]);
                        $date_accomplished = date_format($date_accom,  "Y-m-d H:i:s");
                        
                        $ordate = $emapData[13];
                        $birthdate = date("Y-m-d", strtotime($ordate));
                        
                        if(!empty($lastname)){
                            $query = "INSERT INTO client_info(office, imported_by, date_imported, encoded_by,
                            date_accomplished, region, province, mun_city, barangay, district, lastname, firstname,
                            middlename, extraname, sex, civil_status, date_birth, age, mode_admission, type_assistance,amount,
                            source_of_fund, category, charging, pantawid_bene)
                            VALUES('$office', '$imported_by', NOW(), '$emapData[0]', '$date_accomplished', '$emapData[2]', '$emapData[3]', 
                            '$emapData[4]', '$emapData[5]', '$emapData[6]', '$emapData[7]', '$emapData[8]', '$emapData[9]', '$emapData[10]', 
                            '$emapData[11]', '$emapData[12]', '$birthdate', '$emapData[14]', '$mode_admission', '$emapData[16]', 
                            '$emapData[17]', '$emapData[18]', '$emapData[19]', '$emapData[20]', '$emapData[21]');";

                            $result = mysqli_query($user->db, $query);
                            echo "<br>";
                            echo "<br>";
                        }
                        else{
                            echo "<script type=\"text/javascript\">
                                alert(\"Error Upload!,Missing data of some fields!.\");
                                window.location = \"import_page.php\"
                            </script>";
                        }
                    
                    
    
                }
            //    fclose($file);
               
	        
         }
         else{
             echo "<script type=\"text/javascript\">
                alert(\"Invalid file format:Please Upload CSV File.\");
                window.location = \"import_page.php\"
                </script>";
         }
        
}	
if(!$result){
    echo "<script type=\"text/javascript\">
            alert('Error Upload!.');
            window.location = 'import_page.php';
        </script>";
}
else{
    echo "<script type=\"text/javascript\">
        alert('Success File Upload.');
        window.location = 'import_page.php'
    </script>";
}
mysqli_close($user->db);  
?>