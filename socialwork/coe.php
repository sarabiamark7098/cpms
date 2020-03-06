<?php 
    include('../php/class.user.php');
	$user = new User();

    if(isset($_GET['id'])){
        $id = $user->getClientId($_GET['id']); //id sa client
        $client = $user->clientData($_GET['id']); //kuha sa mga data sa bene/client data
        $client_assistance = $user->getGISAssistance($_GET['id']); //kuha sa data sa assistance table

        $gis = $user->getGISData($client['trans_id']);
        $GISsignatory=$user->getsignatory($gis['signatory_id']); //get data sa GIS na signatory
        $GISsignatoryName = strtoupper($GISsignatory['first_name'] ." ". $GISsignatory['middle_I'] .". ". $GISsignatory['last_name']);
        
        $name =  $client["firstname"]." ". (!empty($client["middlename"][0])?strtoupper($client["middlename"][0]) .". ":""). $client["lastname"]." ". (!empty($client['extraname'])?$client['extraname']:"");
        $bname =  $client["b_fname"]." ". (!empty($client["b_mname"][0])?strtoupper($client["b_mname"][0]) .". ":""). $client["b_lname"]." ". (!empty($client['b_exname'])?$client['b_exname']:""); 
        
        
        $clientbarangay = explode(" /", $client["client_barangay"]);
		$clientmunicipality = explode(" /", $client["client_municipality"]);
		$clientprovince = explode(" /", $client["client_province"]);
        
        $address = '';
		if(!empty($client["client_street"])){
			$address .= $client["client_street"].", ";
		}
        $address .= $clientbarangay[0].", ". $clientmunicipality[0] .", ". $clientprovince[0];
        
        $amountToWord = $user->toWord($client_assistance[1]['amount']);
  
        $record = $user->getCOEData($_GET['id']); //kwaun ang data sa coe table
  
        if($record){
            $COEsignatory= $user->getsignatory($record['sign_Id']); //kwaun ang data sa signatory using sign_id 
            $COEsignatoryName = strtoupper($COEsignatory['first_name'] ." ". $COEsignatory['middle_I'] .". ". $COEsignatory['last_name']);
        }

        $soc_worker = $user->getuserInfo($_SESSION['userId']); //get soc-worker data from database
    
        $toif = explode(".",$client_assistance[1]['amount']);
        $am = (str_replace(",","",$toif[0]));
        $am2 = "";
        $am3 = (str_replace(",","",$client_assistance[1]['amount']));
        
        if(!empty($client_assistance[2]['amount'])){
			$toif2 = explode(".", $client_assistance[2]['amount']);
			$am2 = (str_replace(",","",$toif2[0]));
        }
        //print_r($record);
		$fund1 = "";
        $fund2 = "";

        $fund1 = explode("/",$client_assistance[1]['fund']);
        
        if(!empty($client_assistance[2]['fund'])){
            $fund2 = explode("/",$client_assistance[2]['fund']);
        }
        
    }

    if(isset($_GET['option'])){
        if($_GET['option'] = 2){
            if(!empty($record)){
                echo "<script>window.location='last.php?id=".$_GET['id']."'</script>";
            }else{
                echo "<script>window.location='coe.php?id=".$_GET['id']."'</script>";
            }
        }
    }

?>
<?php
	if(!$_SESSION['login']){
		header('Location:../index.php');
		}
?> 

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"> 
        <script type="text/javascript" src="../js/main.js"></script>
        <link rel="icon" type="image/png" href="../images/icons/ciu.ico"/>
        <script type="text/javascript" src="../js/jquery.min.js"></script>
        <script type="text/javascript" src="../js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../js/jquery.mask.min.js"></script>
        <title>COE</title>
        <style>
            input[type=checkbox]
            {
                /* Double-sized Checkboxes */
                -ms-transform: scale(2); /* IE */
                -moz-transform: scale(2); /* FF */
                -webkit-transform: scale(2); /* Safari and Chrome */
                -o-transform: scale(2); /* Opera */
                padding: 10px;
                margin: 10px;
                font-size: 20px;
            }
            input{
                background: transparent;
                border: none;
                border-bottom: 1px solid #000000;
                -webkit-box-shadow: none;
                box-shadow: none;
                border-radius: 0;
            }
            #center-input{
                padding-left:10px;
                width:45px;
                text-align:center;
            }
            .row{
                font-size: 20px;
                font-family: Geneva, Verdana, sans-serif Arial, sans-serif;
            }
        </style>  
    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-dark" style="position: fixed; width: 100%; z-index:100; background: #6d7fcc;">
        <a href="home.php"><img src="../images/dswd-logo_final.png" class="img-responsive" alt="unkown" width="200" height="55"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
			</ul>
			<div class="my-2 my-lg-0"> 
             <div class="input-group input-group-lg">
                 <h4>
                    <div class="input-group-prepend text-white">
                    <span id="date_time"></span>
                        <script type="text/javascript">window.onload = date_time('date_time');</script>
                    </div>  
                </h4>
			 </div>
			</div>
    </nav>
        <br><br><br><br>
        <div>
            <h2 class="text-center"><b><u>Certificate of Eligibility</u></b></h2><br>
        </div>
        <br> 
        <form action="coe.php?id=<?php echo $_GET['id']?>" method="post">
            <div class="container">
                <?php if($am > 5000 || $am2 > 5000){ ?>
                    <div class="row">
                        <div class="container">
                        <div class="card">
                            <div class="card-header bg-success border-success text-white">
                                <b>Signatory</b>
                            </div>
                            <div class="card-body">
                                Amount is more than Five Thousand (5000).
                                <div>
                                <label> Approved By : </label>&nbsp&nbsp&nbsp
                                    <input style="text-transform: uppercase; width:50%" list="coesign" name="coesignName" value="<?php echo empty($record['sign_Id'])?"":$user->getSignatoryFullname($record['sign_Id']) ?>" required>
                                    <datalist id="coesign">
                                        <?php 
                                            $data = $user->signatoryGIS();
                                            foreach($data as $index => $value){
                                                $signatoryname = $value['first_name'] ." ". $value['middle_I'] .". ". $value['last_name'];
                                                echo "<option value='".strtoupper($signatoryname)."-".$value['position']."'>". $signatoryname ."</option>";
                                            } 
                                        ?>
                                    </datalist>
                                </div>
                            </div>
                        </div> 
                        <br> 
                        </div>
                    </div>
                <?php }?>
                <div class="row">
                    <div class="col-6"> 
                        <div class="card border-secondary">
                            <div class="card-header  border-secondary bg-secondary text-white">
                                Records
                            </div>
                            <div class="card-body">
                                <div class="container">
                                    <div class="row">
                                        <div><input type="checkbox" class="lg" name="ref" value="Referral Letter" <?php echo $user->checkCheck($record['document'], "", "Referral") ?>> Referral</div>
                                    </div>
                                    <div class="row">
                                        <div><input type="checkbox" class="lg" name="soc" value="Social Case Study" <?php echo $user->checkCheck($record['document'], "", "Social") ?>> Social Case Study</div>
                                    </div>
                                    <div class="row">
                                        <div><input type="checkbox" class="lg" name="just" value="Justification" <?php echo $user->checkCheck($record['document'], "", "Justification") ?>> Justification</div>
                                    </div>
                                    <div class="row">
                                        <div>
                                            <input type="checkbox" class="lg" name="val_id" value="Valid ID:" <?php echo $user->checkCheck($record['document'], "", "Valid ID") ?>> Valid ID Presented: 
                                            <input list="valid" type="text" id="pres_id" class="text-left center-input" name="pres_id" value=" <?php echo $record['id_presented'] ?>">
                                            <datalist id="valid">
                                                <option>School-ID</option>
                                                <option>Voter's ID</option>
                                                <option>PhilHealth ID</option>
                                                <option>Postal ID</option>
                                                <option>Driver's License</option>
                                                <option>Senior Citizen ID</option>
                                                <option>OFW ID</option>
                                                <option>Philippine Passport</option>
                                                <option>SSS UMID Card</option>
                                                <option>TIN Card</option>
                                                <option>PRC ID</option>
                                            </datalist>
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <div><input type="checkbox" class="lg" name="brgy" value="Barangay"  <?php echo $user->checkCheck($record['document'], "", "Barangay") ?>> BRGY Certificate/Indigency</div>
                                    </div>
                                    <div class="row">
                                        <div><input type="checkbox" class="lg" name="others" value="Others"  <?php echo $user->checkCheck($record['document'], "", "Others") ?>> Others: 
                                            <input type="text" class="text-left center-input" name="others_input" value=" <?php echo $record['others_input'] ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $type = strval($client_assistance[1]['type']);?>
                    <div class="col-6">
                        <div class="card border-secondary">
                            <div class="card-header border-secondary bg-secondary text-white">
                                <?php echo $client_assistance[1]['type'] ?> Records
                            </div>
                            <div class="card-body">
                                <div class="container">
                                <?php
                                    if(substr_count(strval($type), "Medic") > 0){
                                        echo '
                                        <div class="row">
                                            <div><input type="checkbox" class="lg" name="med_cer" id="med_cer" value="MEDICAL CERTIFICATE" '.$user->checkCheck($record['document'], "", "MEDICAL").'> Medical Certificate</div>
                                        </div>
                                        <div class="row">
                                            <div><input type="checkbox" class="lg" name="dt_sum" id="dt_sum" value="DEATH SUMMARY" '.$user->checkCheck($record['document'], "", "DEATH").'> Death Summary</div>
                                        </div>
                                        <div class="row">
                                            <div><input type="checkbox" class="lg" name="dis_sum" id="dis_sum" value="DISCHARGE SUMMARY" '.$user->checkCheck($record['document'], "", "DISCHARGE").'> Discharge Summary</div>
                                        </div>
                                        <div class="row">
                                            <div><input type="checkbox" class="lg" name="tr_pro" id="tr_pro" value="TREATMENT PROTOCOL" '.$user->checkCheck($record['document'], "", "TREATMENT").'> Treatment Protocol</div>
                                        </div>
                                        <div class="row">
                                            <div><input type="checkbox" class="lg"  name="vacc" id="vacc" value="VACCINATION" '.$user->checkCheck($record['document'], "", "VACCINATION").'> Vaccination</div>
                                        </div>
                                        <div class="row">
                                            <div><input type="checkbox" class="lg" name="lab_req" id="lab_req" value="LAB REQUEST" '.$user->checkCheck($record['document'], "", "LAB REQUEST").'> Lab Request</div>
                                        </div>
                                        <div class="row">
                                            <div><input type="checkbox" class="lg" name="charge" id="charge" value="CHARGE SLIP" '.$user->checkCheck($record['document'], "", "CHARGE SLIP").'> Charge Slip</div>
                                        </div>
                                        <div class="row">
                                            <div><input type="checkbox" class="lg" name="qout" id="qout" value="QUOTATION" '.$user->checkCheck($record['document'], "", "QUOTATION").'> Quotation</div>
                                        </div>  
                                        <div class="row">
                                            <div><input type="checkbox" class="lg" name="pres" id="pres" value="PRESCRIPTIONS" '.$user->checkCheck($record['document'], "", "PRESCRIPTION").'> Prescription</div>
                                        </div>
                                        <div class="row">
                                            <div><input type="checkbox" class="lg" name="stat_acc" id="stat_acc" value="STATEMENT OF ACCOUNT" '.$user->checkCheck($record['document'], "", "STATEMENT OF ACCOUNT").'> Statement of Account</div>
                                        </div>
                                        ';
                                    }elseif(substr_count(strval($type), "Trans") > 0){
                                        echo 'None';    
                                    }elseif(substr_count(strval($type), "Educ") > 0){
                                        echo '
                                        <div class="row">
                                            <div><input type="checkbox" class="lg" name="regForm" id="regForm" value="Registration Form" '. $user->checkCheck($record['document'], "", "registration form") .'> Registration Form</div>
                                        </div>
                                        <div class="row">
                                            <div><input type="checkbox" class="lg" name="assForm" id="assForm" value="Assessment Form" '. $user->checkCheck($record['document'], "", "assessment form") .'> Assessment Form</div>
                                        </div>
                                        <div class="row">
                                            <div><input type="checkbox" class="lg" name="enrolForm" id="enrolForm" value="Certificate of Enrollment Form" '. $user->checkCheck($record['document'], "", "enrollment form") .'> Certificate of Enrollment Form</div>
                                        </div>  
                                        <div class="row">
                                            <div><input type="checkbox" class="lg" name="stAcc" id="stAcc" value="Statement of Account" '. $user->checkCheck($record['document'], "", "statement of account") .'> Statement of Account</div>
                                        </div>
                                        <div class="row">
                                            <div><input type="checkbox" class="lg" name="sID" id="sID" value="School ID" '. $user->checkCheck($record['document'], "", "school id") .'> School ID</div>
                                        </div>
                                        ';
                                    }elseif(substr_count(strval($type), "Burial") > 0){
                                        echo '
                                        <div class="row">
                                            <div><input type="checkbox" class="lg" name="regD" id="regD" value="REGISTERED DEATH CERTIFICATE" '.$user->checkCheck($record['document'], "", "DEATH").'> Registered Death Certificate</div>
                                        </div>
                                        <div class="row">
                                            <div><input type="checkbox" class="lg" name="funC" id="funC" value="FUNERAL CONTRACT" '.$user->checkCheck($record['document'], "", "FUNERAL").'> Funeral Contact</div>
                                        </div>
                                        <div class="row">
                                            <div><input type="checkbox" class="lg" name="perT" id="perT" value="PERMIT TO TRANSFER" '.$user->checkCheck($record['document'], "", "TRANSFER").'> Permit to Transfer</div>
                                        </div>  
                                        <div class="row">
                                            <div><input type="checkbox" class="lg" name="quaP" id="quaP" value="QUARANTINE PERMIT" '.$user->checkCheck($record['document'], "", "QUARANTINE").'> Quarantine Permit</div>
                                        </div>
                                        <div class="row">
                                            <div><input type="checkbox" class="lg" name="prom" id="proN" value="PROMISSORY NOTE" '.$user->checkCheck($record['document'], "", "PROMISSORY").'> Promissory Note</div>
                                        </div>
                                        ';
                                    }elseif(substr_count(strval($type), "Food") > 0){
                                        echo 'None';
                                    }elseif(substr_count(strval(strtolower($type)), "non-food") > 0) {
                                        echo 'None';
                                    }
                                ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><br>

                <?php   
                    if(!empty($fund1[1]) || !empty($fund2[1])){ ?>
                    <div class=row>
                        <div class="col-2"></div>
                        <div class="col-8">
                            <div class="card border-secondary">
                                <div class="card-header border-secondary bg-secondary text-white">
                                    Fund Source Distribution
                                </div>
                                <div class="card-body">
                                    <div class="container">
                                        <div class="row">
                                            <?php if(!empty($fund1[1]) && !empty($fund1[0])){ ?>
                                            <div class="col-12" >
                                            <h5 style="text-indent: 100px"></h5>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <h6 class="text-center">Amount to Be Distributed: </h6>
                                                        <h6 class="text-center">Php 
                                                        <input type="text" class="money" id="totalamount" readonly /></h6>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="input-group input-group-md">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm"><i><?php echo $fund1[0]." = " ?></i></span>
                                                        </div>
                                                        <input type="text" class="form-control mr-sm-2 b money" id="amountf1" name="amountf1" value="<?php echo !empty($record['fund1_amount'])?$record['fund1_amount']:''?>" placeholder="Amount" required>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="input-group input-group-md">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm"><i><?php echo $fund1[1]." = " ?></i></span>
                                                        </div>
                                                        <input type="text" class="form-control mr-sm-2 b money" id="amountf11" name="amountf11" value="<?php echo !empty($record['fund2_amount'])?$record['fund2_amount']:''?>" placeholder="Amount" required>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <h6 class="text-center">Amount Distributed: </h6>
                                                        <h6 class="text-center">Php 
                                                        <input type="text" class="text-center money" id="dtotalamount" readonly /></h6></h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php }  ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-2"></div>
                    </div>
                    <br>
                    <br>
                <?php } ?>
                

                <div class="container">
                    <div class="form-group row" >
                        <div class="col"><a href="gis.php?id=<?php echo $_GET['id']?>" class="btn btn-success btn-block"><span class="fa fa-reply"></span> GIS</a></div>
                        <div class="col"><input type="button" class="btn btn-<?php echo (empty($record))?"secondary":"primary" ?> btn-block" value="Print" name="print" onclick="printCOE()"<?php echo (empty($record))?"disabled":"" ?> ></div>
                        <?php 
                            if($record){
                        ?>
                            <div class="col"><input type="submit" class="btn btn-primary btn-block"  value="Update" id="update" name="update"></div>
                        <?php }else{ 
                        ?>
                            <div class="col"><input type="submit" class="btn btn-primary btn-block"  value="Save" id="save" name="save"></div>
                        <?php }
                        ?>
                        <div class="col" style="margin-right:3px"><a href="last.php?id=<?php echo $_GET['id']?>" type="button" class="btn btn-success btn-block text-white" id="Final">Next<span class='fa fa-share'></span></a></div>
                    </div>
                </div>
            </div>
        </form>
        <div id="coe" class="printable" hidden>
        <?php 
			if(substr_count(strval($type), "Medic") > 0){
                include("coe_med.php"); 
            }elseif(substr_count(strval($type), "Trans") > 0){
                include("coe_trans.php");
            }elseif(substr_count(strval($type), "Food Sub") > 0){
                include("coe_food.php");
            }elseif(substr_count(strval($type), "Burial") > 0){
                include("coe_burial.php");
            }elseif(substr_count(strval($type), "Educ") > 0){
                include("coe_educ.php");
            }elseif(substr_count(strval($type), "Cash") > 0){
				include("coe_cash.php");
			}elseif(substr_count(strval($type), "Non") > 0){
				include("coe_non_food.php");
			}

            if(!empty($client_assistance[2]['type'])){
                include("coe_food2.php");
            }   

            ?>
        </div>
    </body>
    <?php 
    if(isset($_POST["save"])){
		$docu = "";
        $id_pres = "";
        $others_input = "";
        $signName = "";
        $amount1 = "";
        $amount2 = "";
        if(isset($_POST['coesignName'])){
            $signName = mysqli_real_escape_string($user->db, $_POST['coesignName']);
        }
        foreach($_POST as $key => $value) {
                $docu .=   $value . '-';
        }
   
        if(isset($_POST['val_id'])){
            $id_pres = mysqli_real_escape_string($user->db, strtoupper($_POST['pres_id']));
        }

        if(isset($_POST['others'])){ //if na check si other
            $others_input = mysqli_real_escape_string($user->db, strtoupper($_POST['others_input']));
        }

        if(isset($_POST['amountf1'])){
            $amount1 = $_POST['amountf1'];
        }

        if(isset($_POST['amountf11'])){
            $amount2 = $_POST['amountf11'];
        }
        $docu=mysqli_real_escape_string($user->db,$docu);
        //echo $docu ."-". $id_pres ."-". $others_input ."-". $signName;
        $user->insertCOE($_GET['id'], $docu, $id_pres, $signName, $others_input, $amount1, $amount2);
    }


    if(isset($_POST['update'])){
        $docu = "";
        $id_pres = "";
        $others_input = "";
        if(!empty($_POST['coesignName'])){
            $signName = mysqli_real_escape_string($user->db, $_POST['coesignName']);
        }else{
            $signName = "";
        }
		$amount1 = "";
        $amount2 = "";
        foreach($_POST as $key => $value) {
                $docu .=   $value . '-';
        }

       
        if(isset($_POST['val_id'])){
            $id_pres = mysqli_real_escape_string($user->db, strtoupper($_POST['pres_id']));
        }
        
        if(isset($_POST['others'])){ //if na check si other
            $others_input = mysqli_real_escape_string($user->db, strtoupper($_POST['others_input']));
        }
		if(isset($_POST['amountf1'])){
            $amount1 = $_POST['amountf1'];
        }

        if(isset($_POST['amountf11'])){
            $amount2 = $_POST['amountf11'];
        }
        $docu=mysqli_real_escape_string($user->db,$docu);
        // echo $signName;
        $user->updateCOE($_GET['id'], $docu, $id_pres, $signName, $others_input, $amount1, $amount2);
    }
?>
    <script>
        $(document).ready(function() {
            var totaldist = parseFloat("<?php echo $am3?>");
            var amount1 = parseFloat(0.00);
            var amount2 = parseFloat(0.00);
            if(document.getElementById("amountf1").value.length > 0){
                amount1 = document.getElementById("amountf1").value;
                amount1 = parseFloat(amount1.replace(",",""));
            }
            if(document.getElementById("amountf11").value.length > 0){
                amount2 = document.getElementById("amountf11").value;
                amount2 = parseFloat(amount2.replace(",",""));
            }
            var total = Number(0.00);
            var total2 = Number(0.00);
            $("#totalamount").val(CurrencyFormat(totaldist));
            $("#dtotalamount").val(0.00);
            if(document.getElementById("amountf1").value.length > 0){
                total = parseFloat(amount1 + amount2);
                total = parseFloat(totaldist - total);
                // total = parseFloat(Number(total).toFixed(2))
                $("#totalamount").val(CurrencyFormat(total));
                total2 = parseFloat(amount1 + amount2);
                // total2 = parseFloat(Number(total2).toFixed(2));
                $("#dtotalamount").val(CurrencyFormat(total2));
            }

            $("#amountf1, #amountf11").keyup(function() {
                amount1 = parseFloat(0);
                amount2 = parseFloat(0);
                if(document.getElementById("amountf1").value.length > 0){
                    amount1 = document.getElementById("amountf1").value;
                    amount1 = parseFloat(amount1.replace(",",""));
                }
                if(document.getElementById("amountf11").value.length > 0){
                    amount2 = document.getElementById("amountf11").value;
                    amount2 = parseFloat(amount2.replace(",",""));
                }
                total = parseFloat(amount1 + amount2);
                total = parseFloat(totaldist - total);
                // total = parseFloat(Number(total).toFixed(2))
                // console.log(amount1);console.log(amount2);
                $("#totalamount").val(CurrencyFormat(total));
            });

            $("#amountf1, #amountf11").keyup(function() {
                total2 = parseFloat(amount1 + amount2);
                // total2 = parseFloat(Number(total2).toFixed(2));
                $("#dtotalamount").val(CurrencyFormat(total2));
            });
            
        });
        
        $('.money').mask("#,000,000.00", {reverse: true});
        
        function CurrencyFormat(number)
        {
        var decimalplaces = 2;
        var decimalcharacter = ".";
        var thousandseparater = ",";
        number = parseFloat(number);
        var sign = number < 0 ? "-" : "";
        var formatted = new String(number.toFixed(decimalplaces));
        if( decimalcharacter.length && decimalcharacter != "." ) { formatted = formatted.replace(/\./,decimalcharacter); }
        var integer = "";
        var fraction = "";
        var strnumber = new String(formatted);
        var dotpos = decimalcharacter.length ? strnumber.indexOf(decimalcharacter) : -1;
        if( dotpos > -1 )
        {
            if( dotpos ) { integer = strnumber.substr(0,dotpos); }
            fraction = strnumber.substr(dotpos+1);
        }
        else { integer = strnumber; }
        if( integer ) { integer = String(Math.abs(integer)); }
        while( fraction.length < decimalplaces ) { fraction += "0"; }
        temparray = new Array();
        while( integer.length > 3 )
        {
            temparray.unshift(integer.substr(-3));
            integer = integer.substr(0,integer.length-3);
        }
        temparray.unshift(integer);
        integer = temparray.join(thousandseparater);
        return sign + integer + decimalcharacter + fraction;
        }
        $(document).ready(function() {
            if(document.getElementById("totalamount").value != 0.00){
                console.log("dri ra");
                $('#update').attr('disabled','disabled');
                $('#save').attr('disabled','disabled');
                $('#save').removeClass('btn-primary').addClass('btn-dark ');
                $(this).addClass('btn-default').removeClass('btn-primary ');
                $('#update').removeClass('btn-primary').addClass('btn-dark ');
                $(this).addClass('btn-default').removeClass('btn-primary ');
            } else {
                console.log("dd2 ra");
                $('#update').removeAttr('disabled');
                $('#save').removeAttr('disabled');
                $('#save').removeClass('btn-dark').addClass('btn-primary ');
                $(this).addClass('btn-default').removeClass('btn-dark ');
                $('#update').removeClass('btn-dark').addClass('btn-primary ');
                $(this).addClass('btn-default').removeClass('btn-dark ');
            }
            $("#amountf1, #amountf11").keyup(function() {
                if(document.getElementById("totalamount").value != 0.00){
                    console.log("dri");
                    $('#update').attr('disabled','disabled');
                    $('#save').attr('disabled','disabled');
                    $('#save').removeClass('btn-primary').addClass('btn-dark ');
                    $(this).addClass('btn-default').removeClass('btn-primary ');
                    $('#update').removeClass('btn-primary').addClass('btn-dark ');
                    $(this).addClass('btn-default').removeClass('btn-primary ');
                } else {
                    console.log("dd2");
                    $('#update').removeAttr('disabled');
                    $('#save').removeAttr('disabled');
                    $('#save').removeClass('btn-dark').addClass('btn-primary ');
                    $(this).addClass('btn-default').removeClass('btn-dark ');
                    $('#update').removeClass('btn-dark').addClass('btn-primary ');
                    $(this).addClass('btn-default').removeClass('btn-dark ');
                }
            });
        });
        
    </script>

</html>