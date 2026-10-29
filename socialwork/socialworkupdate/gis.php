<?php
include('../../php/class.user.php');
$user = new User();
    

if (isset($_GET['id'])) {
    $id = $user->getClient_id($_GET['id']); //id sa client
    $client = $user->clientData($_GET['id']); //kuha sa mga data sa bene/client data
    $name = $client["lastname"] .", ". $client["firstname"] . " " . (!empty($client["middlename"])? $client["middlename"] . " ":"").(!empty($client['extraname'])?$client['extraname'] . ".":"");
    $bname = "";
    if(!empty($client["b_lname"])){
        $bname = $client["b_lname"] . ", ". $client["b_fname"] . " " . (!empty($client["b_mname"])? $client["b_mname"] . " ":"").(!empty($client['b_exname'])?$client['b_exname'] . ".":"");
    }
    $timeentry = $user->theTime($client['date_entered']);//kwaun ang time
    $client_assistance = $user->getGISAssistance($_GET['id']);
    $familyData = $user->getclientFam($_GET['id']);
    if ($familyData === "") {
        // If no data found, return an empty response
        $familyDataJson = ""; // Set the family data to an empty string
    } else {
        // If data is found, process it as needed
        $familyDataJson = json_encode($familyData); // Convert the family data to JSON format
    }
    
    $gis = $user->getGISData($_GET['id']); //kwaun ang mga data if ever naa na xay inputed data sa assessment/service only
    // Assistance Received from DSWD (records table, one row per assistance)
    $assistance_record = $user->getRecords($_GET['id']);
    $assistanceList = array_map(function($__r){ return strtolower($__r['received'] ?? ''); }, $assistance_record ?? array());
    $assistanceOther = '';
    foreach(($assistance_record ?? array()) as $__r){ if(strtolower($__r['received'] ?? '')==='other'){ $assistanceOther = $__r['other_specify']; } }
    $genders = $user->getGenderIdentities(); // Gender Identity options for the Client/Beneficiary sections
    $subCategories = $user->getSubCategories(); // full Sub-category list for the dropdowns
    $subcatTextToCode = [
        'Solo Parent' => 1, 'Indigenous People' => 2, 'Recovering Person who used drugs' => 3,
        '4Ps Beneficiaries' => 4, 'Street Dwellers' => 5, 'Others Specify' => 8,
        'Killed in Action (KIA)' => 9, 'Wounded in Action (WIA)' => 9, 'Minimum Wage Earners' => 10,
        'Below Minimum Wage Earners' => 11, 'No Regular Income' => 12,
        'Person of Concerns - Stateless Persons' => 13, 'Person of Concerns - Asylum Seeker' => 14,
        'Person of Concerns – Refugees' => 15,
    ];
    $isSelf = strtolower($client['relation'] ?? '') === 'self'; // client is their own beneficiary -> show only the Beneficiary section
    $otherinfo = $user->getOtherInformations($_GET['id']);
    $otherclientinfo = $otherinfo['otherClientInformation'] ?? null;
    $crisisSeverityQ = $otherinfo['crisisSeverityQuestion3'] ?? null;
    $supportSystemAv = $otherinfo['supportSystemAvailability'] ?? null;
    $externalRes = $otherinfo['externalResources'] ?? null;
    $selfH = $otherinfo['selfHelp'] ?? null;
    $vulnerability_risk = $otherinfo['vulnerability_riskFactor'] ?? null;
    $otherClientInformation = $user->ParseInputs($otherclientinfo);
    $crisisSeverityQuestion3 = $user->ParseInputs($crisisSeverityQ);
    $supportSystemAvailability = $user->ParseInputs($supportSystemAv);
    $externalResources = $user->ParseInputs($externalRes);
    $selfHelp = $user->ParseInputs($selfH);
    $vulnerability_riskFactor = $user->ParseInputs($vulnerability_risk);

    $fundsourcedata = $user->getfundsourcedata($_GET['id']);
    $soc_worker = $user->getuserInfo($_SESSION['userId']);
    //fullname of social worker
    $soc_workFullname = $soc_worker['empfname'] .' '.(!empty($soc_worker['empmname'][0])?$soc_worker['empmname'][0] . '. ':''). $soc_worker['emplname'] . (!empty($soc_worker['empext'])? ' ' . $soc_worker['empext'] . '.' : '');
    $signatory = $user->show_signatory_data($client['signatory_id']);
    
    //Address
    $city = explode("/", $client['client_municipality']);
    $brgy = explode("/", $client['client_barangay']);
    $province = explode("/", $client['client_province']);
    $address['client'] = '';
    if (!empty($client['client_street'])) {
        $address['client'] .= $client['client_street'] . ", ";
    }
    $address['client'] .= $brgy[0] . ", " . $city[0] . ", " . $province[0];
    $city = explode("/", (!empty($client['b_municipality'])??""));
    $brgy = explode("/", (!empty($client['b_barangay'])??""));
    $province = explode("/", (!empty($client['b_province'])??""));
    $address['beneficiary'] = '';
    if (!empty($client['b_street'])) {
        $address['beneficiary'] .= $client['b_street'] . ", ";
    }
    $address['beneficiary'] = $brgy[0] . ", " . $city[0] . ", " . $province[0];
        
}
if(isset($_GET['option'])){
    if($_GET['option'] == 2){
        if(!empty($gis)){
            echo "<script>window.location='coe.php?id=".$_GET['id']."&option=2'</script>";
        }else{
            echo "<script>window.location='gis.php?id=".$_GET['id']."'</script>";
        }
    }
}

if (!$_SESSION['login']) {
    header('Location:../index.php');
}
?>
<html>
    <head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link rel="icon" type="image/png" href="../../images/icons/ciu.ico"/>
		<link rel="stylesheet" type="text/css" href="../../css/gis.css">
        <link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css"> 
        <!-- <link rel="stylesheet" type="text/css" href="../../css/font-awesome.min.css"> -->
        
        <script defer src="../../js/solid.js"></script>
        <script defer src="../../js/fontawesome.js"></script>
        <script src="../../js/jquery.slim.min.js"></script>
        <script src="../../js/popper.min.js"></script>
        <script src="../../js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../../js/jquery-3.2.1.slim.min.js"></script>
        
        <script type="text/javascript" src="../../js/main.js"></script>
        <script type="text/javascript" src="../../js/jquery.min.js"></script>
        <script type="text/javascript" src="../../js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../../js/jquery.mask.min.js"></script>
        <script type="text/javascript" src="../../js/PSGC.js"></script>
        <script type="text/javascript" src="../../js/jquery.inputmask.min.js"></script>
        <title>GIS</title>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark" style="position: fixed; width: 100%; z-index:100; background: #6d7fcc;">
            <a href="../reissue.php"><img src="../../images/dswd-logo_final.png" class="img-responsive" alt="unkown" width="200" height="55"></a>
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
            </div>
        </nav>
        <!--Input Form-->
        <br><br><br><br>
        <div class="container" style="position: static">
            <br>
            <div>
                <h2 class="text-center"><span><b>GIS INPUT FORM</b></span></h2>
                <div class="row">
                    <div class="col-8"><h3><small>Client Name:</small> <?php echo $name ?></h3></div>    
                    <div class="col-2">
                        <button type='submit' class='btn btn-danger deep-sky' data-toggle='modal' data-target='#clientdata' data-id='<?php echo $_GET['id'] ?>' style='margin-right: 10px;'>
                            <span class="fa fa-edit"></span> 
                            Edit Client
                        </button>
                    </div>
                    <?php if(strtolower($client['relation']) != 'self'){ ?>
                        <div class="col-2">
                            <button type='submit' class='btn btn-warning deep-sky' data-toggle='modal' data-target='#benedata' data-id='<?php echo $_GET['id'] ?>' style='margin-right: 10px;'>
                                <span class="fa fa-edit"></span> 
                                Edit Beneficiary
                            </button>
                        </div>  
                    <?php }else{ ?>
                        <div class="col-2">
                            <button type='submit' class='btn btn-warning deep-sky' data-toggle='modal' data-target='#add_benedata' data-id='<?php echo $_GET['id'] ?>' style='margin-right: 10px;'>
                                <span class="fa fa-edit"></span> 
                                Add Beneficiary
                            </button>
                        </div>

                    <?php } ?>
                </div>
                <div class="row">
                <div class="col">
                <button class="btn btn-success btn-block" onclick="back()">
                    <span class='fa fa-arrow-left'></span> Cancel
                </button>
                </div>
                <div class="col" ></div>
                <div class="col" ></div>
                <div class="col" ></div>
                <div class="col" ></div>
                </div>
            </div><br>
            <!--Fucking inputs-->
            <form id="up" action="gis.php?id=<?php echo $_GET['id'] ?>" method="post" >
            
                <!-- Beneficiary Additional Information -->
                <small>(Please Save/Update before printing)</small>
<?php
                // ---- GIS Client / Beneficiary section option data ----
                $gisCats = ["Children in Need of Special Protection","Persons Living with HIV/AIDS","Youth","Men/Women in Specially Difficult Circumstances","Persons with Disabilities","Senior Citizens","Family Heads and Other Needy Adult","None of the Above"];
                $gisDis  = ["SPEECH IMPAIRMENT","LEARNING DISABILITY","PSYCHOSOCIAL DISABILITY","DEAF/HARD-OF-HEARING","CANCER","MENTAL DISABILITY","VISUAL DISABILITY","INTELLECTUAL DISABILITY","PHYSICAL DISABILITY","RARE DISEASE"];
                $gisSectors = [1=>"FAMILY HEADS, AND OTHER NEEDY ADULTS (FHONA)",2=>"WOMEN IN ESPECIALLY DIFFICULT CIRCUMSTANCES (WEDC)",3=>"PERSON WITH DISABILITIES (PWD)",4=>"YOUTH IN NEED OF SPECIAL PROTECTION (YNSP)",5=>"SENIOR CITIZEN (SC)",6=>"PERSON LIVING WITH HIV (PLHIV)",7=>"CHILDREN IN NEED OF SPECIAL PROTECTION (CNSP)"];
                $gisSubcats = [1=>"SOLO PARENT",2=>"INDIGENOUS PEOPLE",3=>"RECOVERING PERSON WHO USED DRUGS",4=>"4PS DSWD BENEFICIARY",5=>"STREET DWELLERS",9=>"KIA/WIA",10=>"MINIMUM WAGE EARNER",11=>"BELOW MINIMUM WAGE EARNER",12=>"NO REGULAR INCOME",13=>"STATELESS PERSONS",14=>"ASYLUM SEEKERS",15=>"REFUGEES",8=>"OTHERS"];
                $gisSubcatMap = [
                    "Family Heads and Other Needy Adult" => ["Victims of Disaster","Internally Displaced Family","Solo Parent","Victims of Illegal Recruitment","Surrendered drug users","Repatriated OFW","Killed in Action (KIA)","Wounded in Action (WIA)","Indigenous People","Individuals with Cancer","Person of Concerns - Asylum Seeker","Former Rebels","Dialysis Patients","Tuberculosis Patients","Person of Concerns - Refugees","Person of Concerns - Stateless Persons"],
                    "Men/Women in Specially Difficult Circumstances" => ["Sexually-abused","Physically-abused/maltreated/battered","Victims of Illegal Recruitment","Victims of involuntary prostitution","Victims of armed conflict","Victims of trafficking","Surrendered drug users","Repatriated OFW","Killed in Action (KIA)","Wounded in Action (WIA)","Indigenous People","Individuals with Cancer","Person of Concerns - Asylum Seeker","Former Rebels","Dialysis Patients","Tuberculosis Patients","Person of Concerns - Refugees","Person of Concerns - Stateless Persons"],
                    "Children in Need of Special Protection" => ["Abandoned","Neglected","Voluntary Committed/Surrendered","Sexually-Abused","Sexually-Exploited","Physically-abused/maltreated/battered","Children in Situations of Armed Conflict","Victims of Child Labor","Victims of Child Trafficking","Street Children","Victims of Illegal Recruitment","Children with HIV/AIDS","Children with Disabilities","Children in Conflict with the Law (CICL)","Surrendered drug users","Repatriated OFW","Killed in Action (KIA)","Wounded in Action (WIA)","Indigenous People","Individuals with Cancer","Person of Concerns - Asylum Seeker","Former Rebels","Dialysis Patients","Tuberculosis Patients","Person of Concerns - Refugees","Person of Concerns - Stateless Persons"],
                    "Youth" => ["Children in Conflict with the Law (9 to < 18 yrs. old)","Out of School Youth","Pre-delinquent Youth","Victims of Illegal Recruitment","Surrendered drug users","Repatriated OFW","Killed in Action (KIA)","Wounded in Action (WIA)","Student","Indigenous People","Individuals with Cancer","Person of Concerns - Asylum Seeker","Former Rebels","Dialysis Patients","Tuberculosis Patients","Person of Concerns - Refugees","Person of Concerns - Stateless Persons"],
                    "Senior Citizens" => ["Indigenous People","Individuals with Cancer","Person of Concerns - Asylum Seeker","Former Rebels","Dialysis Patients","Tuberculosis Patients","Person of Concerns - Refugees","Person of Concerns - Stateless Persons"],
                    "Persons with Disabilities" => ["Orthopedically handicapped","Hearing/Speech impaired","Visually impaired","Mentally challenged","Victims of Illegal Recruitment","Surrendered drug users","Repatriated OFW","Killed in Action (KIA)","Wounded in Action (WIA)","Mental Disabilities","Indigenous People","Individuals with Cancer","Person of Concerns - Asylum Seeker","Former Rebels","Dialysis Patients","Tuberculosis Patients","Person of Concerns - Refugees","Person of Concerns - Stateless Persons"],
                    "Persons Living with HIV/AIDS" => ["Individuals with Cancer","Indigenous People","Tuberculosis Patients","Person of Concerns - Asylum Seeker","Former Rebels","Dialysis Patients","Person of Concerns - Refugees","Person of Concerns - Stateless Persons"],
                ];
                ?>
                <div class="row" id="gisClientSection" <?php echo $isSelf ? 'style="display:none;"' : '' ?>>
                    <div class="col-12">
                        <div class="card">
                            <div class="card border-info mb3" style="width:100%;">
                                <h5 class="card-header text-success">CLIENT</h5>
                                <div class="card-body">
                                    <div class="container" style="font-size: 15px;">
                                        <div class="form-group row">
                                            <label class="col-sm-3 label" style="font-size:18px">Category:</label>
                                            <div class="col">
                                                <select id="client_category" name="client_category" class="form-control" <?php echo $isSelf ? '' : 'required' ?>>
                                                    <option value="">Select Category</option>
                                                    <?php $ccat = $client['category'] ?? ''; foreach($gisCats as $gc){ echo "<option value=\"".htmlspecialchars($gc)."\" ".($ccat==$gc?"selected":"").">".htmlspecialchars($gc)."</option>"; } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 label" style="font-size:18px">Sub-category:</label>
                                            <div class="col">
                                                <select id="c_subcat" name="c_subcat" class="form-control" <?php echo $isSelf ? '' : 'required' ?> onchange="gisToggleClientExtra()">
                                                    <option value="">Select Sub-category</option>
                                                    <?php $csub = $client['subCategory'] ?? ''; foreach($subCategories as $sc){ echo "<option value=\"".htmlspecialchars($sc)."\" ".($csub==$sc?"selected":"").">".htmlspecialchars($sc)."</option>"; } ?>
                                                </select>
                                                <div id="clientBelowWrap" style="display:none; margin-top:7px;">Approx. Monthly Income: <input type="text" class="currencyMaskedInput" style="width:40%;" name="belowMonthly" id="belowMonthly" value="<?php echo htmlspecialchars($gis['below_monthly_income'] ?? '') ?>"></div>
                                                <div id="clientOscWrap" style="display:none; margin-top:7px;">Others: <input type="text" style="width:60%;" name="osc_val" id="osc_val" value="<?php echo htmlspecialchars($gis['others_subcat'] ?? '') ?>"></div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 label" style="font-size:18px">Type of Disability:</label>
                                            <div class="col">
                                                <select id="client_disability" name="client_disability" class="form-control">
                                                    <option value="">Not applicable</option>
                                                    <?php $cdis = $client['type_of_disability'] ?? ''; foreach($gisDis as $gd){ echo "<option value=\"".htmlspecialchars($gd)."\" ".($cdis==$gd?"selected":"").">".htmlspecialchars($gd)."</option>"; } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 label" style="font-size:18px">Gender Identity:</label>
                                            <div class="col">
                                                <select id="client_gender" name="client_gender" class="form-control" <?php echo $isSelf ? '' : 'required' ?>>
                                                    <option value="">Select Gender Identity</option>
                                                    <?php $cgen = $client['gender_identity'] ?? ''; foreach($genders as $g){ echo "<option value=\"".htmlspecialchars($g)."\" ".($cgen==$g?"selected":"").">".htmlspecialchars($g)."</option>"; } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card border-info mb3" style="width:100%;">
                                <h5 class="card-header text-success">BENEFICIARY</h5>
                                <div class="card-body">
                                    <div class="container" style="font-size: 15px;">
                                        <div class="form-group row">
                                            <label class="col-sm-3 label" style="font-size:18px">Category <small>(Target Sector)</small>:</label>
                                            <div class="col">
                                                <select id="bene_sector" name="bene_sector" class="form-control" required>
                                                    <option value="">Select Category</option>
                                                    <?php $bsec = $gis['target_sector'] ?? ''; foreach($gisSectors as $sv=>$sl){ echo "<option value=\"".$sv."\" ".($bsec==$sv?"selected":"").">".$sl."</option>"; } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 label" style="font-size:18px">Sub-category:</label>
                                            <div class="col">
                                                <select id="bene_subcat" name="bene_subcat" class="form-control" required onchange="gisToggleBeneExtra()">
                                                    <option value="">Select Sub-category</option>
                                                    <?php $bsub = $isSelf ? ($client['subCategory'] ?? '') : ($client['b_subCategory'] ?? ''); foreach($subCategories as $sc){ echo "<option value=\"".htmlspecialchars($sc)."\" ".($bsub==$sc?"selected":"").">".htmlspecialchars($sc)."</option>"; } ?>
                                                </select>
                                                <div id="beneBelowWrap" style="display:none; margin-top:7px;">Approx. Monthly Income: <input type="text" class="currencyMaskedInput" style="width:40%;" name="b_belowMonthly" id="b_belowMonthly" value="<?php echo htmlspecialchars($isSelf ? ($gis['below_monthly_income'] ?? '') : ($gis['b_below_monthly_income'] ?? '')) ?>"></div>
                                                <div id="beneOscWrap" style="display:none; margin-top:7px;">Others: <input type="text" style="width:60%;" name="b_osc_val" id="b_osc_val" value="<?php echo htmlspecialchars($isSelf ? ($gis['others_subcat'] ?? '') : ($gis['b_others_subcat'] ?? '')) ?>"></div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 label" style="font-size:18px">Type of Disability:</label>
                                            <div class="col">
                                                <select id="bene_disability" name="bene_disability" class="form-control">
                                                    <option value="">Not applicable</option>
                                                    <?php $bdis = $gis['type_of_disability'] ?? ''; foreach($gisDis as $i=>$gd){ $dv=$i+1; echo "<option value=\"".$dv."\" ".($bdis==$dv?"selected":"").">".$gd."</option>"; } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 label" style="font-size:18px">Gender Identity:</label>
                                            <div class="col">
                                                <select id="bene_gender" name="bene_gender" class="form-control" required>
                                                    <option value="">Select Gender Identity</option>
                                                    <?php $bgen = $isSelf ? ($client['gender_identity'] ?? '') : ($client['b_gender_identity'] ?? ''); foreach($genders as $g){ echo "<option value=\"".htmlspecialchars($g)."\" ".($bgen==$g?"selected":"").">".htmlspecialchars($g)."</option>"; } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><br>
                <script>
                    // The Sub-category dropdown now lists the full sub_categories table
                    // (server-rendered), so no category-dependent repopulation is needed.
                    function gisToggleClientExtra(){
                        var v = document.getElementById('c_subcat').value;
                        document.getElementById('clientBelowWrap').style.display = (v === 'Below Minimum Wage Earners') ? 'block' : 'none';
                        document.getElementById('clientOscWrap').style.display = (v === 'Others Specify') ? 'block' : 'none';
                    }
                    function gisToggleBeneExtra(){
                        var v = document.getElementById('bene_subcat').value;
                        document.getElementById('beneBelowWrap').style.display = (v === 'Below Minimum Wage Earners') ? 'block' : 'none';
                        document.getElementById('beneOscWrap').style.display = (v === 'Others Specify') ? 'block' : 'none';
                    }
                    document.addEventListener('DOMContentLoaded', function(){ gisToggleClientExtra(); gisToggleBeneExtra(); });
                </script>
                <div class="row">
                    <div class=col-12>
                        <div class="card">
                            <div class="card border-info mb3" style="width:100%;">
                                <h5 class="card-header text-success">Source of Income</h5>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6 container" style="font-size: 15px;">
                                            <div class="row" style="margin-bottom:7px;">
                                                <div class="col-1" style="margin-top:3px;"><input type="checkbox" class="lg" id="wage_check" value="1" <?php echo !empty($otherinfo['wage'])? "checked": ""; ?>></div>
                                                <div class="col-11"> SALARIES/WAGES FROM EMPLOYMENT <br><input type="text" class="lg currencyMaskedInput" style="border-radius: 3px 3px 3px 3px; width: 60%; height: 23px;" name="SOI_wage" id="SOI_wage" value="<?php echo !empty($otherinfo['wage'])? $otherinfo['wage']: ""; ?>"></div>
                                            </div>
                                            <div class="row" style="margin-bottom:7px;">
                                                <div class="col-1" style="margin-top:3px;"><input type="checkbox" class="lg" id="profit_check" value="1" <?php echo !empty($otherinfo['profit'])? "checked": ""; ?>></div>
                                                <div class="col-11"> INTREPRENEURIAL INCOME/PROFIT <br><input type="text" class="lg currencyMaskedInput" style="border-radius: 3px 3px 3px 3px; width: 60%; height: 23px;" name="SOI_profit" id="SOI_profit" value="<?php echo !empty($otherinfo['profit'])? $otherinfo['profit']: ""; ?>"></div>
                                            </div>
                                            <div class="row" style="margin-bottom:7px;">
                                                <div class="col-1" style="margin-top:3px;"><input type="checkbox" class="lg" id="domestic_check" value="1" <?php echo !empty($otherinfo['domestic_source'])? "checked": ""; ?>></div>
                                                <div class="col-11"> CASH ASSISTANCE FROM DOMESTIC SOURCES <br><input type="text" class="lg currencyMaskedInput" style="border-radius: 3px 3px 3px 3px; width: 60%; height: 23px;" name="SOI_domesticsource" id="SOI_domesticsource" value="<?php echo !empty($otherinfo['domestic_source'])? $otherinfo['domestic_source']: ""; ?>"></div>
                                            </div>
                                            <div class="row" style="margin-bottom:7px;">
                                                <div class="col-1" style="margin-top:3px;"><input type="checkbox" class="lg" id="abroad_check" value="1" <?php echo !empty($otherinfo['abroad'])? "checked": ""; ?>></div>
                                                <div class="col-11"> CASH ASSISTANCE FROM ABROAD <br><input type="text" class="lg currencyMaskedInput" style="border-radius: 3px 3px 3px 3px; width: 60%; height: 23px;" name="SOI_abroad" id="SOI_abroad" value="<?php echo !empty($otherinfo['abroad'])? $otherinfo['abroad']: ""; ?>"></div>
                                            </div>
                                        </div>
                                        <div class="col-6 container" style="font-size: 15px;">
                                            <div class="row" style="margin-bottom:7px;">
                                                <div class="col-1" style="margin-top:3px;"><input type="checkbox" class="lg" id="transfer_check" value="1" <?php echo !empty($otherinfo['government_transfer'])? "checked": ""; ?>></div>
                                                <div class="col-11"> TRANSFER FROM THE GOVERNMENT (E.G. 4PS) <br><input type="text" class="lg currencyMaskedInput" style="border-radius: 3px 3px 3px 3px; width: 60%; height: 23px;" name="SOI_governmenttransfer" id="SOI_governmenttransfer" value="<?php echo !empty($otherinfo['government_transfer'])? $otherinfo['government_transfer']: ""; ?>"></div>
                                                <div class="col-11">  </div>
                                            </div>
                                            <div class="row" style="margin-bottom:7px;">
                                                <div class="col-1" style="margin-top:3px;"><input type="checkbox" class="lg" id="pension_check" value="1" <?php echo !empty($otherinfo['pension'])? "checked": ""; ?>></div>
                                                <div class="col-11"> PENSION <br><input type="text" class="lg currencyMaskedInput" style="border-radius: 3px 3px 3px 3px; width: 60%; height: 23px;" name="SOI_pension" id="SOI_pension" value="<?php echo !empty($otherinfo['pension'])? $otherinfo['pension']: ""; ?>"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-1" style="margin-top:3px;"><input type="checkbox" class="lg" id="otherincome_check" value="1" <?php echo !empty($otherinfo['other_income'])? "checked": ""; ?>></div>
                                                <div class="col-11"> OTHER INCOME <br><input type="text" class="lg currencyMaskedInput" style="border-radius: 3px 3px 3px 3px; width: 60%; height: 23px;" name="SOI_otherincome" id="SOI_otherincome" value="<?php echo !empty($otherinfo['other_income'])? $otherinfo['other_income']: ""; ?>"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div><br>
                
                <!-- Family Composition -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card border-info mb3" style="width:100%;">
                                <h5 class="card-header text-success">FAMILY COMPOSITION</h5>
                                <div class="card-body">
                                    <!-- Family Composition Form (Single Row Input) -->
                                    <div class="row text-center mb-2">
                                        <div class="col-3">
                                            <input class="form-control" id="inputName" type="text" placeholder="Pangalan" oninput="this.value = this.value.replace(/[^A-Za-zÑñÉéÈèÊêËë\-. ]/g, '').toUpperCase()">
                                        </div>
                                        <div class="col-2">
                                            <input class="form-control" id="inputRelation" type="text" placeholder="Relasyon" oninput="this.value = this.value.replace(/[^A-Za-zÑñÉéÈèÊêËë\-. ]/g, '').toUpperCase()">
                                        </div>
                                        <div class="col-1">
                                            <input class="form-control" id="inputAge" type="number" max="99" placeholder="Edad">
                                        </div>
                                        <div class="col-3">
                                            <input class="form-control" id="inputOccupation" type="text" placeholder="Trabaho" oninput="this.value = this.value.replace(/[^A-Za-zÑñÉéÈèÊêËë\-. ]/g, '').toUpperCase()">
                                        </div>
                                        <div class="col-2">
                                            <input class="form-control currencyMaskedInput" id="inputSalary" type="text" placeholder="Buwanang Sahod">
                                        </div>
                                        <div class="col-1">
                                            <button type="button" class="btn btn-outline-primary" onclick="addFamilyRow()">+</button>
                                        </div>
                                    </div>

                                    <!-- Table to Display All Added Family Members -->
                                    <div class="table-responsive mt-3">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th style="width: 20px; border: 1px solid black;">NO.</th>
                                                    <th style="width: 240px; border: 1px solid black;">Pangalan</th>
                                                    <th style="width: 240px; border: 1px solid black;">Relasyon</th>
                                                    <th style="width: 30px; border: 1px solid black;">Edad</th>
                                                    <th style="width: 240px; border: 1px solid black;">Trabaho</th>
                                                    <th style="border: 1px solid black;">Buwanang Sahod</th>
                                                    <th style="border: 1px solid black;">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody id="familyTable">
                                                <?php if ($familyData !== ""): ?>
                                                    <?php foreach ($familyData as $index => $member): ?>
                                                        <tr>
                                                            <td style="border: 1px solid black;"><?= $index + 1 ?></td>
                                                            <td style="border: 1px solid black;"><?= htmlspecialchars($member['name']) ?></td>
                                                            <td style="border: 1px solid black;"><?= htmlspecialchars($member['relation_bene']) ?></td>
                                                            <td style="border: 1px solid black;"><?= htmlspecialchars($member['age']) ?></td>
                                                            <td style="border: 1px solid black;"><?= htmlspecialchars($member['occupation']) ?></td>
                                                            <td style="border: 1px solid black;"><?= htmlspecialchars($member['salary']) ?></td>
                                                            <td style="border: 1px solid black;">
                                                                <button class="btn btn-danger" onclick="removeFamilyRow(this)">X</button>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div> 
                </div><br>
                <input type="hidden" name="family_data" id="familyDataInput" value='<?= $familyDataJson ?>' />

                <!-- Type Assistance -->
                <div class="row">
                    <div class="col-12" >
                        <div class="card">
                            <div class="card border-info mb3" style="width:100%;">
                                <h5 class="card-header text-success">TYPE OF ASSISTANCE</h5>
                                <div class="card-body">
                                    <div class="container" style="font-size: 15px;">
                                        <div class="row">
                                            <label class="col-sm-3 label" style="font-size: 18px">TYPE OF ASSISTANCE:</label>
                                            <div class="col">
                                                <select type="text" id="type1" class="form-control" name="type1" <?php echo empty($client_assistance[1]) ? "" : "onkeyup='verifyfirst()'" ?> required>
                                                    <option value="" <?php echo (empty($client_assistance[1])) ? "selected" : "" ?>>Select Type of Assistance </option>
                                                    <option value="Food Subsidy Assistance" <?php echo (!empty($client_assistance[1]['type']) && (strtolower($client_assistance[1]['type'])) == "food subsidy assistance") ? "selected" : "" ?>>Food Subsidy Assistance</option>
                                                    <option value="Medical Assistance" <?php echo (!empty($client_assistance[1]['type']) && (strtolower($client_assistance[1]['type'])) == "medical assistance") ? "selected" : "" ?>>Medical Assistance</option>
                                                    <option value="Funeral Assistance" <?php echo (!empty($client_assistance[1]['type']) && (strtolower($client_assistance[1]['type'])) == "funeral assistance") ? "selected" : "" ?>>Funeral Assistance</option>
                                                    <option value="Transportation Assistance" <?php echo (!empty($client_assistance[1]['type']) && (strtolower($client_assistance[1]['type'])) == "transportation assistance") ? "selected" : "" ?>>Transportation Assistance</option>
                                                    <option value="Educational Assistance" <?php echo (!empty($client_assistance[1]['type']) && (strtolower($client_assistance[1]['type'])) == "educational assistance") ? "selected" : "" ?>>Educational Assistance</option>
                                                    <option value="Other Cash Assistance" <?php echo (!empty($client_assistance[1]['type']) && (strtolower($client_assistance[1]['type'])) == "other cash assistance") ? "selected" : "" ?>>Other Cash Assistance</option>
                                                    <option value="Material Assistance" <?php echo (!empty($client_assistance[1]['type']) && (strtolower($client_assistance[1]['type'])) == "material assistance") ? "selected" : "" ?>>Material Assistance</option>
                                                    <option value="Cash Relief Assistance" <?php echo (!empty($client_assistance[1]['type']) && (strtolower($client_assistance[1]['type'])) == "cash relief assistance") ? "selected" : "" ?>>Cash Relief Assistance</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>

                <!-- Assistance If Burial or Medical --> <!-- for Improvements need Calibration -->
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-6" id="medical_show"><br>
                        <div class="card">
                            <div class="card border-info mb3" style="width:100%;">
                                <h5 class="card-header text-success">IF MEDICAL</h5>
                                <div class="card-body">
                                    <div class="container" style="font-size: 15px;">
                                        <div class="row" style="margin-bottom:7px;">
                                            <div class="col-1" style="margin-top:3px;"><input type="checkbox" class="lg" name="hb" id="hb" value="1" <?php echo (!empty($client_assistance[1]['type']) && strtolower($client_assistance[1]['type'])=="medical assistance"?($client_assistance[1]['if_medical']==1 ? "checked": ""):"") ?>></div>
                                            <div class="col-11"> Hospital Bill</div>
                                        </div>
                                        <div class="row" style="margin-bottom:7px;">
                                            <div class="col-1" style="margin-top:3px;"><input type="checkbox" class="lg" name="medicine" id="medicine" value="2" <?php echo (!empty($client_assistance[1]['type']) && strtolower($client_assistance[1]['type'])=="medical assistance"?($client_assistance[1]['if_medical']==2 ? "checked": ""):"") ?>></div>
                                            <div class="col-11"> Medicines</div>
                                        </div>
                                        <div class="row" style="margin-bottom:7px;">
                                            <div class="col-1" style="margin-top:3px;"><input type="checkbox" class="lg" name="chemo" id="chemo" value="3" <?php echo (!empty($client_assistance[1]['type']) && strtolower($client_assistance[1]['type'])=="medical assistance"?($client_assistance[1]['if_medical']==3 ? "checked": ""):"") ?>></div>
                                            <div class="col-11"> Chemotheraphy</div>
                                        </div>
                                        <div class="row" style="margin-bottom:7px;">
                                            <div class="col-1" style="margin-top:3px;"><input type="checkbox" class="lg" name="dia" id="dia" value="4" <?php echo (!empty($client_assistance[1]['type']) && strtolower($client_assistance[1]['type'])=="medical assistance"?($client_assistance[1]['if_medical']==4 ? "checked": ""):"") ?>></div>
                                            <div class="col-11"> Dialysis</div>
                                        </div>
                                        <div class="row" style="margin-bottom:7px;">
                                            <div class="col-1" style="margin-top:3px;"><input type="checkbox" class="lg"  name="procedure" id="procedure" value="5" <?php echo (!empty($client_assistance[1]['type']) && strtolower($client_assistance[1]['type'])=="medical assistance"?($client_assistance[1]['if_medical']==5 ? "checked": ""):"") ?>></div>
                                            <div class="col-11"> Procedures</div>
                                        </div>
                                        <div class="row" style="margin-bottom:7px;">
                                            <div class="col-1" style="margin-top:3px;"><input type="checkbox" class="lg"  name="laboratory" id="laboratory" value="6" <?php echo (!empty($client_assistance[1]['type']) && strtolower($client_assistance[1]['type'])=="medical assistance"?($client_assistance[1]['if_medical']==6 ? "checked": ""):"") ?>></div>
                                            <div class="col-11"> Laboratory</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-1" style="margin-top:3px;"><input type="checkbox" class="lg"  name="implant" id="implant" value="7" <?php echo (!empty($client_assistance[1]['type']) && strtolower($client_assistance[1]['type'])=="medical assistance"?($client_assistance[1]['if_medical']==7 ? "checked": ""):"") ?>></div>
                                            <div class="col-11"> Implant</div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                    <div class="col-6" id="burial_show"><br>
                        <div class="card">
                            <div class="card border-info mb3" style="width:100%;">
                                <h5 class="card-header text-success">IF FUNERAL</h5>
                                <div class="card-body">
                                    <div class="container" style="font-size: 15px;">
                                        <div class="row" style="margin-bottom:17px;">
                                            <div class="col-12">Diagnosis/Cause of Death</div>
                                            <div class="col-12" style="margin-top:3px;"><input type="text" class="form-control lg" name="diagnosis_cod" id="diagnosis_cod" value="<?php echo empty($client_assistance[1]['cause_of_death']) ? "" : $client_assistance[1]['cause_of_death'] ?>"/></div>
                                        </div>
                                        <div class="row" style="margin-bottom:7px;">
                                            <div class="col-1" style="margin-top:3px;"><input type="checkbox" class="lg" name="fb" id="fb" value="1" <?php echo (!empty($client_assistance[1]['type']) && strtolower($client_assistance[1]['type']) =="funeral assistance"?($client_assistance[1]['if_burial']==1 ? "checked": ""):"") ?>></div>
                                            <div class="col-11"> Funeral Bill</div>
                                        </div>
                                        <div class="row" style="margin-bottom:7px;">
                                            <div class="col-1" style="margin-top:3px;"><input type="checkbox" class="lg" name="toc" id="toc" value="2" <?php echo (!empty($client_assistance[1]['type']) && strtolower($client_assistance[1]['type']) =="funeral assistance"?($client_assistance[1]['if_burial']==2 ? "checked": ""):"") ?>></div>
                                            <div class="col-11"> Transfer of Cadever</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-1" style="margin-top:3px;"><input type="checkbox" class="lg" name="interment" id="interment" value="3" <?php echo (!empty($client_assistance[1]['type']) && strtolower($client_assistance[1]['type']) =="funeral assistance"?($client_assistance[1]['if_burial']==3 ? "checked": ""):"") ?>></div>
                                            <div class="col-11"> Interment</div>
                                        </div>
                                    </div>
                                </div>
                                <h5 class="card-header text-success">FREE FUNERAL SERVICE</h5>
                                <div class="card-body">
                                    <div class="container" style="font-size: 15px;">
                                        <div class="row" style="margin-bottom:7px;">
                                            <div class="col-1" style="margin-top:3px;">
                                                <input type="checkbox" class="lg" name="free_funeral_service_burial" id="free_funeral_service_burial" value="burial" <?php echo (!empty($client_assistance[1]['type']) && strtolower($client_assistance[1]['type']) =="funeral assistance"?((($client_assistance[1]['free_funeral_service']=='burial-') || ($client_assistance[1]['free_funeral_service']=='burial-cremation-')) ? "checked": ""):"") ?>></div>
                                            <div class="col-11"> Burial</div>
                                        </div>
                                        <div class="row" style="margin-bottom:7px;">
                                            <div class="col-1" style="margin-top:3px;">
                                                <input type="checkbox" class="lg" name="free_funeral_service_cremation" id="free_funeral_service_cremation" value="cremation" <?php echo (!empty($client_assistance[1]['type']) && strtolower($client_assistance[1]['type']) =="funeral assistance"?((($client_assistance[1]['free_funeral_service']=='cremation-') || ($client_assistance[1]['free_funeral_service']=='burial-cremation-')) ? "checked": ""):"") ?>></div>
                                            <div class="col-11"> Cremation</div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                    <div class="col-3"></div>
                </div><br>

                <!-- Assistance Financial and Material -->
                <div class="row">
                    <div class=col-6>
                        <div class="card">
                            <div class="card border-info mb3" style="width:100%;">
                                <h5 class="card-header text-success">FINANCIAL ASSISTANCE</h5>
                                <div class="card-body">
                                    <div class="container" style="font-size: 15px;">
                                        <div class="row" style="margin-bottom:7px;">
                                            <div class="col-1" style="margin-top:3px;"><input type="checkbox" class="lg" name="medical" id="medical" value="1" <?php echo (!empty($client_assistance[1]['financial']) && $client_assistance[1]['financial']==1 ? "checked": "") ?>></div>
                                            <div class="col-11"> Medical Assistance</div>
                                        </div>
                                        <div class="row" style="margin-bottom:7px;">
                                            <div class="col-1" style="margin-top:3px;"><input type="checkbox" class="lg" name="transportation" id="transportation" value="2" <?php echo (!empty($client_assistance[1]['financial']) && $client_assistance[1]['financial']==2 ? "checked": "") ?>></div>
                                            <div class="col-11"> Transportation Assistance</div>
                                        </div>
                                        <div class="row" style="margin-bottom:7px;">
                                            <div class="col-1" style="margin-top:3px;"><input type="checkbox" class="lg" name="food" id="food" value="3" <?php echo (!empty($client_assistance[1]['financial']) && $client_assistance[1]['financial']==3 ? "checked": "") ?>></div>
                                            <div class="col-11"> Food Assistance</div>
                                        </div>
                                        <div class="row" style="margin-bottom:7px;">
                                            <div class="col-1" style="margin-top:3px;"><input type="checkbox" class="lg" name="fassist" id="fassist" value="4" <?php echo (!empty($client_assistance[1]['financial']) && $client_assistance[1]['financial']==4 ? "checked": "") ?>></div>
                                            <div class="col-11"> Funeral Assistance</div>
                                        </div>
                                        <div class="row" style="margin-bottom:7px;">
                                            <div class="col-1" style="margin-top:3px;"><input type="checkbox" class="lg"  name="educational" id="educational" value="5" <?php echo (!empty($client_assistance[1]['financial']) && $client_assistance[1]['financial']==5 ? "checked": "") ?>></div>
                                            <div class="col-11"> Educational Assistance</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-1" style="margin-top:3px;"><input type="checkbox" class="lg"  name="casha" id="casha" value="6" <?php echo (!empty($client_assistance[1]['financial']) && $client_assistance[1]['financial']==6 ? "checked": "") ?>></div>
                                            <div class="col-11"> Cash Relief Assistance</div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                    <div class=col-6>
                        <div class="card">
                            <div class="card border-info mb3" style="width:100%;">
                                <h5 class="card-header text-success">MATERIAL ASSISTANCE</h5>
                                <div class="card-body">
                                    <div class="container" style="font-size: 15px;">
                                        <div class="row" style="margin-bottom:7px;">
                                            <div class="col-1" style="margin-top:3px;"><input type="checkbox" class="lg" name="packs" id="packs" value="1" <?php echo (!empty($client_assistance[1]['material']) && $client_assistance[1]['material']==1 ? "checked": "") ?>></div>
                                            <div class="col-11"> Family Food Packs</div>
                                        </div>
                                        <div class="row" style="margin-bottom:7px;">
                                            <div class="col-1" style="margin-top:3px;"><input type="checkbox" class="lg" name="items" id="items" value="2" <?php echo (!empty($client_assistance[1]['material']) && $client_assistance[1]['material']==2 ? "checked": "") ?>></div>
                                            <div class="col-11"> Other Food Items</div>
                                        </div>
                                        <div class="row" style="margin-bottom:7px;">
                                            <div class="col-1" style="margin-top:3px;"><input type="checkbox" class="lg" name="kits" id="kits" value="3" <?php echo (!empty($client_assistance[1]['material']) && $client_assistance[1]['material']==3 ? "checked": "") ?>></div>
                                            <div class="col-11"> Hygiene or Sleeping Kits</div>
                                        </div>
                                        <div class="row" style="margin-bottom:7px;">
                                            <div class="col-1" style="margin-top:3px;"><input type="checkbox" class="lg" name="devices" id="devices" value="4" <?php echo (!empty($client_assistance[1]['material']) && $client_assistance[1]['material']==4 ? "checked": "") ?>></div>
                                            <div class="col-11"> Assistive Devices and Technologies</div>
                                        </div>
                                        <div class="row" style="margin-bottom:7px;">
                                            <div class="col-1" style="margin-top:3px;"><input type="checkbox" class="lg" name="rice" id="rice" value="5" <?php echo (!empty($client_assistance[1]['material']) && $client_assistance[1]['material']==5 ? "checked": "") ?>></div>
                                            <div class="col-11"> Rice</div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div><br>

                <!-- Assistance Received from DSWD -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card border-info mb3" style="width:100%;">
                                <h5 class="card-header text-success" style="background:#f0edff">ASSISTANCE RECEIVED FROM DSWD</h5>
                                <div class="card-body text-dark">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="row">
                                                <div class="col-1">
                                                    <input type="checkbox" class="lg" name="assistance_aics" id="assistance_aics" value="aics" <?php echo (in_array('aics',$assistanceList) ? "checked": "") ?>>
                                                </div>
                                                <div class="col-11" style="margin-bottom: 12px; font-size: 15px;">
                                                    Assistance to Individual in Crisis Situations (AICS)
                                                </div>
                                                <div class="col-1">
                                                    <input type="checkbox" class="lg" name="assistance_wgp" id="assistance_wgp" value="wgp" <?php echo (in_array('wgp',$assistanceList) ? "checked": "") ?>>
                                                </div>
                                                <div class="col-11" style="margin-bottom: 12px; font-size: 15px;">
                                                    Walang Gutom Program (WGP)
                                                </div>
                                                <div class="col-1">
                                                    <input type="checkbox" class="lg" name="assistance_4ps" id="assistance_4ps" value="4ps" <?php echo (in_array('4ps',$assistanceList) ? "checked": "") ?>>
                                                </div>
                                                <div class="col-11" style="font-size: 15px;">
                                                    Pantawid Pamilyang Pilipino Program (4Ps)
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="row">
                                                <div class="col-1">
                                                    <input type="checkbox" class="lg" name="assistance_slp" id="assistance_slp" value="slp" <?php echo (in_array('slp',$assistanceList) ? "checked": "") ?>>
                                                </div>
                                                <div class="col-11" style="margin-bottom: 12px; font-size: 15px;">
                                                    Sustainable Livelihood Program (SLP)
                                                </div>
                                                <div class="col-1">
                                                    <input type="checkbox" class="lg" name="assistance_kalahicidss" id="assistance_kalahicidss" value="kalahicidss" <?php echo (in_array('kalahi',$assistanceList) ? "checked": "") ?>>
                                                </div>
                                                <div class="col-11" style="margin-bottom: 12px; font-size: 15px;">
                                                    Kapit Bisig Laban Sa Kahirapan-Comprehensive and Integrated Delivery of Social Services (KALAHI-CIDSS)
                                                </div>
                                                <div class="col-1">
                                                    <input type="checkbox" class="lg" name="assistance_others" id="assistance_others" value="other" <?php echo (in_array('other',$assistanceList) ? "checked": "") ?>>
                                                </div>
                                                <div class="col-11" style="font-size: 15px;">
                                                    Others: <input type="text" class="lg" style="border-radius: 3px 3px 3px 3px; width: 80%; height: 23px;" name="assistance_other_specify" id="assistance_other_specify" value="<?php echo htmlspecialchars($assistanceOther, ENT_QUOTES); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><br>

                <!-- ASSESSMENT OF SOCIAL WORKER -->
                <div class="card">
                    <div class="card border-info mb3" style="width:100%;">
                        <h5 class="card-header text-success" style="background:#f0edff">ASSESSMENT INFORMATION</h5>
                        <div class="card-body text-dark">
                            <div class="row">
                                <label class="col-sm-3 label" style="font-size: 18px">Client Number</label>
                                <div class="col-sm-2">
                                    <input type="number" class="form-control mr-sm-2" id="client_num" name="num" value="<?php echo empty($gis['client_num']) ? "" : $gis['client_num'] ?>" required>  
                                </div>&nbsp;
                                <label class="col-sm-3 label text-right" style="font-size: 20px">Mode of Admission</label>
                                <div class="col-sm-2">
									<select type="text" class="form-control mr-sm-2" id="mode_ad" name="mode_ad" required>
                                        <option selected="selected"><?php echo empty($gis['mode_admission']) ? "" : $gis['mode_admission'] ?></option>
                                        <option>Walk-In</option>
                                        <option>Referral</option>
                                    </select>
                                </div>
                            </div><br>
                            <div class="row">
								<label class="col-sm-3 label text-left" style="font-size: 15px">PROGRAM INTERVENTION :</label>
                                <div class="col-2">
									<input type="checkbox" class="col-lg-1" id="aics" name="aics" value="0" <?php echo (($client['program_type']==0)||((empty($client['program_type']))&&(isset($gis['amount'])))? "checked": ""); ?> required> &nbsp; AICS
								</div>
                                <div class="col-2">
									<input type="checkbox" class="col-lg-1" id="ffs" name="ffs" value="ffs" <?php echo (($client['program_type']=="ffs")? "checked": ""); ?> required> &nbsp; FFS
								</div>
                                <div class="col-2">
									<input type="checkbox" class="col-lg-1" id="wisupport" name="wisupport" value="wisupport" <?php echo (($client['program_type']=="wisupport")? "checked": ""); ?> required> &nbsp; Wi-Support
								</div>
                                <div class="col-3">
									<input type="checkbox" class="col-lg-1" id="otherProgram" name="otherProgram" value="other" <?php echo (($client['program_type']=="other" || $client['program_type']==1)? "checked": ""); ?> required> &nbsp; Other Program
                                    <input type="text" class="form-control" style="margin-top:12px;" id="otherProgramItem" name="otherProgramItem" value="<?php echo ($client['program_type']=="other" ? $client['other_program'] : ($client['program_type']==1 ? "AKAP" : "")); ?>" hidden required/>
								</div>
                            </div><br>
							<div class="row">
								<label class="col-sm-3 label text-left" style="font-size: 15px">PSYCHOSOCIAL SUPPORT:</label>
                                <div class="col-3">
									<input type="checkbox" id="pfa" class="col-lg-1" name="pfa" value="pfa" <?php echo ((!empty($gis['service5']) && $gis['service5']==0)? "": "checked"); ?> required> &nbsp; Psychological First Aid (PFA)
								</div>&nbsp;
                                <div class="col-1"></div>
                                <div class="col-3">
									<input type="checkbox" id="counseling" class="col-lg-1" name="counseling" value="Counseling" <?php echo ((!empty($gis['service6']) && $gis['service6']==0)? "": "checked"); ?> required> &nbsp; Social Work Counseling
								</div>
                            </div><br>
							<div class="row">
								<label class="col-sm-2 label text-left" style="font-size: 17px">REFERRAL:</label>
                                <div class="col-3">
									<input type="text" id="refer1" class="col-lg-12 form-control" style="width: 100%;" name="rl1" placeholder="Refer Office" value="<?php echo empty($gis['refer1']) ? "" : $gis['refer1'] ?>">
								</div>
                                <div class="col-3">
									<input type="text" id="refer2" class="col-lg-12 form-control" style="width: 100%;" name="rl2" placeholder="Refer Office" value="<?php echo empty($gis['refer2']) ? "" : $gis['refer2'] ?>">
								</div>
                                <div class="col-3">
									<input type="text" id="refer3" class="col-lg-12 form-control" style="width: 100%;" name="rl3" placeholder="Refer Office" value="<?php echo empty($gis['refer3']) ? "" : $gis['refer3'] ?>">
								</div>
                                
                            </div><br>
                            <div class="row">
								<label class="col-sm-12 label text-left" style="font-size: 17px; font-weight: bold;">INCOME AND FINANCIAL RESOURCES</label>
                            </div>
                            <div class="row">
								<label class="col-sm-12 label text-left" style="font-size: 17px">Occupations of Family Member</label>
                                <div class="col-6">
									<input type="number" id="number_of_employed" class="col-lg-12 form-control" style="width: 100%;" name="number_of_employed" placeholder="Number of Employed" value="<?php echo (isset($otherClientInformation['employed']) ? $otherClientInformation['employed'] : '') ?>">
								</div>
                                <div class="col-6">
									<input type="number" id="number_of_seasonal" class="col-lg-12 form-control" style="width: 100%;" name="number_of_seasonal" placeholder="Number of Seasonal Employee" value="<?php echo (isset($otherClientInformation['seasonal']) ? $otherClientInformation['seasonal'] : '') ?>">
								</div>
								<label class="col-sm-6 label text-left" style="font-size: 17px">Number of Fixed income</label>
                                <label class="col-sm-6 label text-left" style="font-size: 17px">Number of Non-fixed income</label>
                                
                                <div class="col-6">
									<input type="text" id="familyIncome" class="col-lg-12 form-control currencyMaskedInput" style="width: 100%;" name="familyIncome" placeholder="Family Income" value="<?php echo (isset($otherClientInformation['familyincome']) ? $otherClientInformation['familyincome'] : '') ?>">
								</div>
                                <label class="col-sm-12 label text-left" style="font-size: 17px">Combined Family Income</label>
                                <div class="col-6">
                                    <div class="row" style="margin-bottom: 8px;">
                                        <div class="col-12">
                                            <input type="checkbox" class="col-lg-1" id="insurance" name="insurance" value="1" <?php echo (isset($otherClientInformation['insurance'])?'checked':'') ?>> Insurance Coverage
                                        </div>
                                    </div>
                                    <div class="row" style="margin-bottom: 8px;">
                                        <div class="col-12">
                                            <input type="checkbox" class="col-lg-1" id="savings" name="savings" value="2" <?php echo (isset($otherClientInformation['savings'])?'checked':'') ?>> Savings
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <input type="checkbox" class="col-lg-1" id="pension" name="pension" value="3" <?php echo (isset($otherClientInformation['pension'])?'checked':'') ?>> Pension
                                        </div>
                                    </div>
								</div>
                                
                            </div><br>
                            <div class="row">
								<label class="col-sm-12 label text-left" style="font-size: 17px; font-weight: bold;">BUDGET AND EXPENSES</label>
                            </div>
                            <div class="row">
                                <div class="col-6">
									<input type="text" id="monthlyexpense" class="col-lg-12 form-control currencyMaskedInput" style="width: 100%;" name="monthlyexpense" placeholder="Monthly Expense" value="<?php echo (isset($otherClientInformation['monthlyexpense']) ? $otherClientInformation['monthlyexpense'] : '') ?>">
								</div>
                                <label class="col-sm-12 label text-left" style="font-size: 17px">Monthly Expenses of the Family</label>
                                <div class="col-12">
                                </div> 
                                <div class="col-12" style="margin-top: 20px;">
                                    <input type="checkbox" class="col-lg-1" id="emergencyfund" name="emergencyfund" value="1" <?php echo (isset($otherClientInformation['emergencyfund'])?'checked':'') ?>> &nbsp; Availability of Emergency Fund 
								</div> 
                            </div><br>
                            <div class="row">
								<label class="col-sm-12 label text-left" style="font-size: 17px; font-weight: bold;">SEVERITY OF THE CRISIS</label>
                            </div>
                            <div class="row">
                                <label class="col-sm-12 label text-left" style="font-size: 17px">In the past three (3) months, did the family experience at least one crisis?</label>
                                <div class="col-1"></div>
                                <div class="col-2" style="margin-bottom: 8px;">
                                    <input type="checkbox" class="col-lg-2" id="crisis1" name="crisis1" value="1" <?php echo ((!empty($otherinfo['crisisSeverityQuestion2']) && $otherinfo['crisisSeverityQuestion2']==1)?'checked':'') ?>> &nbsp; YES
								</div>
                                <div class="col-2" style="margin-bottom: 8px;">
                                    <input type="checkbox" class="col-lg-2" id="crisis2" name="crisis2" value="0" <?php echo ((!empty($otherinfo['crisisSeverityQuestion2']) && $otherinfo['crisisSeverityQuestion2']==0)?'checked':'') ?>> &nbsp; NO
								</div>
                                <div class="col-7"></div>
                                <label class="col-sm-12 label text-left" style="font-size: 17px">If yes, which among the following crises did the family experience in the past three (3) months (check all that apply):</label>
                                
                                <div class="col-12" style="margin-bottom: 8px;">
                                    <input type="checkbox" class="col-lg-1" id="crisis1_1" name="crisis1_1" value="1" <?php echo (isset($crisisSeverityQuestion3[1])?'checked':'') ?>> &nbsp; Hospitalization
								</div> 
                                <div class="col-12" style="margin-bottom: 8px;">
                                    <input type="checkbox" class="col-lg-1" id="crisis1_2" name="crisis1_2" value="2" <?php echo (isset($crisisSeverityQuestion3[2])?'checked':'') ?>> &nbsp; Death of a family member
								</div> 
                                <div class="col-12" style="margin-bottom: 8px;">
                                    <input type="checkbox" class="col-lg-1" id="crisis1_3" name="crisis1_3" value="3" <?php echo (isset($crisisSeverityQuestion3[3])?'checked':'') ?>> &nbsp; Catastrophic Event (fire, earthquake, flooding, etc.)
								</div> 
                                <div class="col-12" style="margin-bottom: 8px;">
                                    <input type="checkbox" class="col-lg-1" id="crisis1_4" name="crisis1_4" value="4" <?php echo (isset($crisisSeverityQuestion3[4])?'checked':'') ?>> &nbsp; Disablement
								</div> 
                                <div class="col-12" style="margin-bottom: 8px;">
                                    <input type="checkbox" class="col-lg-1" id="crisis1_5" name="crisis1_5" value="5" <?php echo (isset($crisisSeverityQuestion3[5])?'checked':'') ?>> &nbsp; Loss of Livelihood
								</div> 
                                <div class="col-12">
                                    <input type="checkbox" class="col-lg-1" id="crisis1_6" name="crisis1_6" value="6" <?php echo (isset($crisisSeverityQuestion3[6])?'checked':'') ?>> &nbsp; Others, specify
                                    <input type="text" class="col-lg-5" style="border-radius: 4px; width: 100%;" id="crisis1_6others" name="crisis1_6others" value="<?php echo (isset($crisisSeverityQuestion3[6])?$crisisSeverityQuestion3[6]:'') ?>">
                                </div>
                                <div class="col-12" style="margin-top: 10px;">
                                </div>
                                 <label class="col-sm-12 label text-left" style="font-size: 17px">How long does the patient suffer from the disease?</label>
                                <div class="col-12" style="margin-bottom: 8px;">
                                    <input type="checkbox" class="col-lg-1" id="severity1" name="severity1" value="1" <?php echo ((!empty($otherinfo['crisisSeverityQuestion1']) && $otherinfo['crisisSeverityQuestion1']==1)?'checked':'') ?>> &nbsp; Recently Diagnosed (3 months & below) 
								</div> 
                                <div class="col-12" style="margin-bottom: 8px;">
                                    <input type="checkbox" class="col-lg-1" id="severity2" name="severity2" value="2" <?php echo ((!empty($otherinfo['crisisSeverityQuestion1']) && $otherinfo['crisisSeverityQuestion1']==2)?'checked':'') ?>> &nbsp; 3 Months to a Year 
								</div> 
                                <div class="col-12" style="margin-bottom: 8px;">
                                    <input type="checkbox" class="col-lg-1" id="severity3" name="severity3" value="3" <?php echo ((!empty($otherinfo['crisisSeverityQuestion1']) && $otherinfo['crisisSeverityQuestion1']==3)?'checked':'') ?>> &nbsp; Chronic or Lifelong 
								</div> 
                            </div><br>
                            <div class="row">
								<label class="col-sm-12 label text-left" style="font-size: 17px; font-weight: bold;">AVAILABILITY OF SUPPORT SYSTEMS</label>
                                <div class="col-12" style="margin-bottom: 8px;">
                                    <input type="checkbox" class="col-lg-1" id="support2" name="support2" value="2" <?php echo (isset($supportSystemAvailability[2])?'checked':'') ?>> &nbsp; Relatives
								</div> 
                                <div class="col-12" style="margin-bottom: 8px;">
                                    <input type="checkbox" class="col-lg-1" id="support3" name="support3" value="3" <?php echo (isset($supportSystemAvailability[3])?'checked':'') ?>> &nbsp; Friend/s
								</div> 
                                <div class="col-12" style="margin-bottom: 8px;">
                                    <input type="checkbox" class="col-lg-1" id="support4" name="support4" value="4" <?php echo (isset($supportSystemAvailability[4])?'checked':'') ?>> &nbsp; Employer
								</div> 
                                <div class="col-12" style="margin-bottom: 8px;">
                                    <input type="checkbox" class="col-lg-1" id="support5" name="support5" value="5" <?php echo (isset($supportSystemAvailability[5])?'checked':'') ?>> &nbsp; Church/Community Organization
								</div> 
                            </div><br>
                            <div class="row">
								<label class="col-sm-12 label text-left" style="font-size: 17px; font-weight: bold;">EXTERNAL RESOURCES TAPPED BY THE FAMILY</label>
                                <div class="col-12" style="margin-bottom: 8px;">
                                    <input type="checkbox" class="col-lg-1" id="external1" name="external1" value="1" <?php echo (isset($externalResources[1])?'checked':'') ?>> &nbsp; Philhealth
								</div> 
                                <div class="col-12" style="margin-bottom: 8px;">
                                    <input type="checkbox" class="col-lg-1" id="external2" name="external2" value="2" <?php echo (isset($externalResources[2])?'checked':'') ?>> &nbsp; Health Card
								</div> 
                                <div class="col-12" style="margin-bottom: 8px;">
                                    <input type="checkbox" class="col-lg-1" id="external3" name="external3" value="3" <?php echo (isset($externalResources[3])?'checked':'') ?>> &nbsp; Guarantee Letter from other agencies
								</div> 
                                <div class="col-12" style="margin-bottom: 8px;">
                                    <input type="checkbox" class="col-lg-1" id="external4" name="external4" value="4" <?php echo (isset($externalResources[4])?'checked':'') ?>> &nbsp; MSS Discount
								</div> 
                                <div class="col-12" style="margin-bottom: 8px;">
                                    <input type="checkbox" class="col-lg-1" id="external5" name="external5" value="5" <?php echo (isset($externalResources[5])?'checked':'') ?>> &nbsp; Senior Citizen Discount
								</div> 
                                <div class="col-12" style="margin-bottom: 8px;">
                                    <input type="checkbox" class="col-lg-1" id="external6" name="external6" value="6" <?php echo (isset($externalResources[6])?'checked':'') ?>> &nbsp; PWD Discount
                                </div> 
                                <div class="col-12" style="margin-bottom: 8px;">
                                    <input type="checkbox" class="col-lg-1" id="external7" name="external7" value="7" <?php echo (isset($externalResources[7])?'checked':'') ?>> &nbsp; Others, specify
                                    <input type="text" class="col-lg-5" style="border-radius: 4px; width: 100%;" id="external7_discount" name="external7_discount" value="<?php echo (isset($externalResources[7])?$externalResources[7]:'') ?>">
                                </div>
                                <div class="col-12" style="margin-bottom: 8px;">
                                    <input type="checkbox" class="col-lg-1" id="external8" name="external8" value="0" <?php echo (isset($externalResources[0])?'checked':'') ?>> &nbsp; Not Applicable
								</div> 
                            </div><br>
                            <div class="row">
                                <label class="col-12 text-left" style="font-size: 17px; font-weight: bold;">SELF HELP AND CLIENT EFFORTS</label>

                                <!-- First Item -->
                                <div class="col-12 col-md-1 d-flex justify-content-center align-items-start mb-2 mb-md-0"></div>
                                <div class="col-12 col-md-1 d-flex justify-content-center align-items-start mb-2 mb-md-0">
                                    <input type="checkbox" class="form-check-input mt-1" id="selfhelp1" name="selfhelp1" value="1" <?php echo (isset($selfHelp[1]) ? 'checked' : '') ?>>
                                </div>
                                <div class="col-12 col-md-4 mb-3">
                                    <label for="selfhelp1" class="form-check-label" style="font-size: 16px;">
                                        Successfully sought employment opportunities or explored additional income sources
                                    </label>
                                </div>

                                <!-- Second Item -->
                                <div class="col-12 col-md-1 d-flex justify-content-center align-items-start mb-2 mb-md-0"></div>
                                <div class="col-12 col-md-1 d-flex justify-content-center align-items-start mb-2 mb-md-0">
                                    <input type="checkbox" class="form-check-input mt-1" id="selfhelp2" name="selfhelp2" value="2" <?php echo (isset($selfHelp[2]) ? 'checked' : '') ?>>
                                </div>
                                <div class="col-12 col-md-4 mb-3">
                                    <label for="selfhelp2" class="form-check-label" style="font-size: 16px;">
                                        Successfully reached out to relevant organizations or agencies for financial assistance or support
                                    </label>
                                </div>
                            </div>

                            <div class="row">
								<label class="col-sm-12 label text-left" style="font-size: 17px; font-weight: bold;">VULNERABILITY AND RISK FACTORS</label>
                                <div class="col-12" style="margin-bottom: 8px;">
                                    <input type="checkbox" class="col-lg-1" id="vulnerability1" name="vulnerability1" value="1" <?php echo (isset($vulnerability_riskFactor[1])?'checked':'') ?>> &nbsp; There are elderly/ Child in need/ PWD/ Pregnant in the household
								</div> 
                                <div class="col-12" style="margin-bottom: 8px;">
                                    <input type="checkbox" class="col-lg-1" id="vulnerability2" name="vulnerability2" value="2" <?php echo (isset($vulnerability_riskFactor[2])?'checked':'') ?>> &nbsp; A member is physically or mentally incapacitated to work
								</div> 
                                <div class="col-12" style="margin-bottom: 8px;">
                                    <input type="checkbox" class="col-lg-1" id="vulnerability3" name="vulnerability3" value="3" <?php echo (isset($vulnerability_riskFactor[3])?'checked':'') ?>> &nbsp; Inability to secure stable employment
								</div> 
                            </div><br>
                            <h5 class="text-dark" style="font-weight: bold;">Assistance: </h5>
                            <div class="row"> 
                                <div class="col text-center">PURPOSE</div>
                                <div class="col-2 text-center">AMOUNT</div>
                                <div class="col-2 text-center">MODE ASSISTANCE</div>
                                <div class="col-2 text-center">FUND SOURCE</div> 
                                <div class="col-1 text-center"> </div> 
                            </div>
                            <div class="row"> 
                                <div class="col"><input class="form-control" id="pur1" name="pur1" type="text" <?php echo empty($client_assistance[1])? "" : "onkeyup='verifyfirst()'" ?> required value="<?php echo empty($client_assistance[1])? "" : $client_assistance[1]['purpose']; ?>" oninput="this.value = this.value.replace(/[^A-Za-z0-9ÑñÉéÈèÊêËë\-. ]/g, '')"></div>
                                <div class="col-2"><input class="form-control currencyMaskedInput" id="a1" name="a1" <?php echo empty($client_assistance[1])? "" : "onkeyup='verifyfirst()'" ?> required value="<?php echo empty($client_assistance[1])? "" : $client_assistance[1]['amount']; ?>"></div>
                                <div class="col-2">
                                    <select class="form-control" id="m1" name="m1" type="text" <?php echo empty($client_assistance[1])? "" : "onkeyup='verifyfirst()'" ?> required>
                                        <option selected="selected"><?php echo empty($client_assistance[1])? "" : $client_assistance[1]['mode']; ?></option>
                                        <option>GL</option>
                                        <option>CAV</option>
                                        <option>DS</option>
                                    </select>
                                </div>
                                <div class="col-2"> <!--Source of Fund-->
                                    <input type="text" id="f1" value="CURRENT FUND" hidden>
                                    <select class="form-control" id="fundf1" name="f1" <?php echo empty($client_assistance[1]) ? "" : "onchange='verifyfirst()'" ?> required><?php echo $user->fundSourceOptions(empty($fundsourcedata[1]['fundsource']) ? '' : $fundsourcedata[1]['fundsource']); ?></select>
                                    <input list="chargings" class="form-control fs1" value="<?php echo (!empty($fundsourcedata[1]['fundsource'])?$fundsourcedata[1]['fundsource']:'') ?>" id="fsof1" name="fsof1" type="text" hidden />
                                    <input list="chargings" class="form-control fs2" value="<?php echo (!empty($fundsourcedata[2]['fundsource'])?$fundsourcedata[2]['fundsource']:'') ?>" id="fsof2" name="fsof2" type="text" hidden />
                                    <input list="chargings" class="form-control fs3" value="<?php echo (!empty($fundsourcedata[3]['fundsource'])?$fundsourcedata[3]['fundsource']:'') ?>" id="fsof3" name="fsof3" type="text" hidden />
                                    <input list="chargings" class="form-control fs4" value="<?php echo (!empty($fundsourcedata[4]['fundsource'])?$fundsourcedata[4]['fundsource']:'') ?>" id="fsof4" name="fsof4" type="text" hidden />
                                    <input list="chargings" class="form-control fs5" value="<?php echo (!empty($fundsourcedata[5]['fundsource'])?$fundsourcedata[5]['fundsource']:'') ?>" id="fsof5" name="fsof5" type="text" hidden />
                                    <input list="chargings" class="form-control fs6" value="<?php echo (!empty($fundsourcedata[6]['fundsource'])?$fundsourcedata[6]['fundsource']:'') ?>" id="fsof6" name="fsof6" type="text" hidden />
                                    <input list="chargings" class="form-control fs7" value="<?php echo (!empty($fundsourcedata[7]['fundsource'])?$fundsourcedata[7]['fundsource']:'') ?>" id="fsof7" name="fsof7" type="text" hidden />
                                    <input list="chargings" class="form-control fs8" value="<?php echo (!empty($fundsourcedata[8]['fundsource'])?$fundsourcedata[8]['fundsource']:'') ?>" id="fsof8" name="fsof8" type="text" hidden />
                                    <input list="chargings" class="form-control fs9" value="<?php echo (!empty($fundsourcedata[9]['fundsource'])?$fundsourcedata[9]['fundsource']:'') ?>" id="fsof9" name="fsof9" type="text" hidden />
                                    <input list="chargings" class="form-control fs10" value="<?php echo (!empty($fundsourcedata[10]['fundsource'])?$fundsourcedata[10]['fundsource']:'') ?>" id="fsof10" name="fsof10" type="text" hidden />
                                    <input list="chargings" class="form-control fs11" value="<?php echo (!empty($fundsourcedata[11]['fundsource'])?$fundsourcedata[11]['fundsource']:'') ?>" id="fsof11" name="fsof11" type="text" hidden />
                                    <input list="chargings" class="form-control fs12" value="<?php echo (!empty($fundsourcedata[12]['fundsource'])?$fundsourcedata[12]['fundsource']:'') ?>" id="fsof12" name="fsof12" type="text" hidden />
                                    
                                </div> 
                                <div class="col-1"> <!--Source of Fund-->
                                    <input class="form-group btn btn-outline-primary" type="button" value="+" id="addfundsource" name="fsadditional" data-target="#additionalFundSource" data-toggle="modal" >
                                </div>
                            </div>
                            <div class="row"> 
                                <div class="col-lg-12">
                                    <br>
                                    <input type="hidden" name="selection" id="selection" />
                                    <select id="assess" name="swatype" class="form-control col-sm-4"  onchange="getSelectedValue();">
                                            <?php
                                                echo "<option value='' selected>" . "Assessment Option" . "</option>";
                                            $data = $user->assessment_by_socialwork();
                                            foreach ($data as $index => $value) {
                                                $swa_label = $value['ass_opt'];
                                                echo "<option value='" . $swa_label . "'>" . $swa_label . "</option>";
                                            }
                                            ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row"> 
                                <div class="col-lg-12"><br>
                                    <label>Problem Presented</label>
                                    <textarea class="form-control"  style="height:120px;font-size:12px;margin-top:-8px" type="text" id="prob" name="prob" id="type" required oninput="this.value = this.value.replace(/[^A-Za-z0-9ÑñÉéÈèÊêËë\-. ]/g, '')"><?php echo empty($gis['problem'])? "" : $gis['problem']; ?></textarea>
                                </div>
                            </div>
                            <div class="row"> 
                                <div class="col-lg-12"><br>
                                    <label>Social Work Assessment</label>
                                    <textarea class="form-control"  style="height:120px;font-size:12px;margin-top:-8px" type="text" id="ass" name="ass" id="type" required oninput="this.value = this.value.replace(/[^a-zA-Z0-9Ññ~`\s!@$%^()_\-={}:|<>?\[\],.\/]/g, '')"><?php echo empty($gis['soc_ass'])? "" : $gis['soc_ass']; ?></textarea>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 15px">
                                <label class="col-sm-2 label" style="font-size: 20px">Approved by:</label>
                                <div class="col-sm-4">
                                    <input list="signatory" type="text" class="form-control mr-sm-2" id="approved1" name="approved1" required value="<?php echo (empty($gis['signatory_id']) ? '' : $user->getSignatoryFullname($gis['signatory_id'])); ?>" required autocomplete="off">
                                    <datalist id="signatory">
                                        <?php
                                            $data = $user->signatoryGIS();
                                            foreach ($data as $index => $value) {
                                                $signatoryname = (!empty($value['name_title'])?$value['name_title'] . " ":""). $value['first_name'] . " " . $value['middle_I'] . ". " . $value['last_name'];
                                                echo "<option data-value='". $value['signatory_id'] ."'>" . strtoupper($signatoryname) . "-" . $value['position'] ."</option>";
                                            }
                                        ?>
                                    </datalist>
                                    <input type="hidden" class="form-control mr-sm-2" id="approved" name="approved" required value="<?php echo (empty($gis['signatory_id']) ? '' : $gis['signatory_id']); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div><br>
                <!--Mga buttons-->
                <div class="form-group row" >
                    <div class="col"></div>
                    <!-- <div class="col" ><input type="button" class="btn btn-<?php echo (empty($gis) ? "secondary" : "primary") ?> btn-block"  value="Print" name="print" id="printgis" onclick="printGIS()" <?php echo (empty($gis) ? "disabled" : "") ?> ></div> -->
                    <div class="col" >
                        <?php if (empty($gis)) { ?>
                        <input type="submit" class="btn btn-primary btn-block"  value="Save" id="save" name="save" <?php echo empty($gis['signature']) ? "" : "disabled"; ?>>
                        <?php } else { ?>
                                <input type="submit" class="btn btn-primary btn-block"  value="update" id="update" name="update">
                        <?php } ?>               
                    </div>
                    <div class="col" ><button type="button" class="btn btn-success btn-block text-white" id="toCOE" onclick="toCoe('<?php echo $_GET['id']; ?>')">Next <i class='fa fa-share'></i></button></div>
                </div>
            </form>
        </div>
        <div hidden>
            <?php include("gis_sheet.php"); ?>
        </div>
        <!--File na e print--> 
        
        <?php 
            if (!empty($gis)) {
                echo "<script>document.getElementById('toCOE').style.visibility='visible';</script>";
            } else {
                echo "<script>document.getElementById('toCOE').style.visibility='hidden';</script>";
            }
        ?>
            <div class="modal hide fade" id="clientdata" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Client's Information</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="showClientData"> <!--ClientData-->
                            </div>
                            </div>   
                    </div>	
                </div>
            </div>

            <?php if(strtolower($client['relation']) != 'self'){ ?>
                <div class="modal hide fade" id="benedata" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Beneficiary's Information</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="showBene"> <!--Bene Data-->
                                </div>
                            </div>   
                        </div>	
                    </div>
                </div>
            <?php } else { ?>
                <div class="modal hide fade" id="add_benedata" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Beneficiary's Information</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="showBene"> <!--Bene Data-->
                                </div>
                            </div>   
                        </div>	
                    </div>
                </div>
            <?php } ?>
        </div>
        <!--SCRIPT HERE-->
        <script type="text/javascript" src="../js/gis.js"></script>
        <script type="text/javascript">

             document.getElementById("approved1").addEventListener('input', function(e) {
                var input = e.target,
                    list = input.getAttribute('list'),
                    options = document.querySelectorAll('#' + list + ' option'),
                    hiddenInput = document.getElementById('approved'),
                    inputValue = input.value;
                hiddenInput.value = inputValue;

                for(var i = 0; i < options.length; i++) {
                    var option = options[i];

                    if(option.innerText === inputValue) {
                        hiddenInput.value = option.getAttribute('data-value');
                        break;
                    }
                }
            });

            function getSelectedValue() {  
                var assessmentoption = document.getElementById('assess').value;
                document.getElementById('selection').value = assessmentoption;
                $.ajax({
                    type: "post", //method to use
                    url: "fetch.php", //ginapasa  sa diri nga file and data
                    data: {assessmentoption : assessmentoption}, //mao ni nga data
                    success: function(html){  //If result found, this funtion will be call
                        var json = JSON.parse(html);
                        $('#ass').val(json["sw_assessment"]);
                        $('#prob').val( json["problem_presented"]);

                    }
                });
            }
            
            function back(){
                var clientid = "<?php echo $_GET['id'] ?>";
                var dataString = 'backid=' + clientid;
                $.ajax({
                    type:'POST',
                    url:'fetch.php',// put your real file name 
                    data: dataString,
                    cache: false,
                    success:function(data){
                        window.location='../reissue.php';
                    }
                });
            }

            //When ma click and edit client kani ang mo run
            $('#clientdata').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var userid = button.data('id') // Extract info from data-* attributes
                var modal = $(this);
                var dataString = 'id=' + userid;
                $.ajax({
                    type: "GET",
                    url: "showClientData.php",
                    data: dataString,
                    cache: false,
                    success: function (data) {
                        modal.find('.showClientData').html(data);
                    },
                    error: function(err) {
                    }
                });  
            });

            //When ma click and edit beneficiary na button kani ang mo run
            $('#benedata').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var userid = button.data('id') // Extract info from data-* attributes
                var modal = $(this);
                var dataString = 'id=' + userid;
                $.ajax({
                    type: "GET",
                    url: "showBene.php",
                    data: dataString,
                    cache: false,
                    success: function (data) {
                        modal.find('.showBene').html(data);
                    },
                    error: function(err) {
                    }
                });  
            });

            //pag e click ang add bene kung wa syay bene
            $('#add_benedata').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var userid = button.data('id') // Extract info from data-* attributes
                var modal = $(this);
                var dataString = 'id=' + userid;
                $.ajax({
                    type: "GET",
                    url: "addBene.php",
                    data: dataString,
                    cache: false,
                    success: function (data) {
                        modal.find('.showBene').html(data);
                    },
                    error: function(err) {
                    }
                });  
            });  
                
            //e format niya ang input sa mga kwarta
            $('.money').mask("#,000,000.00", {reverse: true});
            $(document).on('change', 'input', function() {
                if($('#client_num').val() != "" ) { 
                    document.getElementById('theNum').value = $('#client_num').val();
                }
                if($('#approved').val() != "" ) { 
                    document.getElementById('signature').value = $('#approved').val();
                }
            });    
            
            function rangeKey(evt){
                var charCode = (evt.which) ? evt.which : event.keyCode;
                    if (charCode != 46 && charCode != 45 && charCode > 31
                    && (charCode < 48 || charCode > 57))
                    return false;

                return true;
            }

            /*************** CHECK BOX REQUIRED ATLEAST 1 *****************/
            $(document).ready(function(){
                $("#counseling").prop('required');
                $("#pfa").prop('required');
                if($("#counseling").prop("checked") || $("#pfa").prop("checked") ){
                    $("#counseling").removeAttr('required');
                    $("#pfa").removeAttr('required');
                }
                $("#counseling").click(function () {
                    if ($(this).prop("checked")) {
                        $("#pfa").removeAttr('required');
                        $("#counseling").removeAttr('required');
                    }else if(!$(this).prop("checked") && !$("#pfa").prop("checked")){
                        $("#pfa").prop('required', true);
                        $("#counseling").prop('required', true);
                    }
                });
                $("#pfa").click(function () {
                    if ($(this).prop("checked")) {
                        $("#pfa").removeAttr('required');
                        $("#counseling").removeAttr('required');
                    }else if(!$(this).prop("checked") && !$("#counseling").prop("checked")){
                        $("#counseling").prop('required', true);
                        $("#pfa").prop('required', true);
                    }
                });
            });

            function typerequire() {
                    type2 = $('#type2').val();
                    if(type2 != ""){
                        $("#a2").attr('required', '');
                        $("#pur2").attr('required', '');
                        $("#m2").attr('required', '');
                        $("#fundf2").attr('required', '');
                    } else {
                        $("#a2").removeAttr('required');
                        $("#pur2").removeAttr('required');
                        $("#m2").removeAttr('required');
                        $("#fundf2").removeAttr('required');
                    }
            }
            
        </script>


        <?php
        if (isset($_POST['update'])) {
            $empid = $_SESSION['userId']; // id sa social worker
            $trans_id = $_GET['id'];
            $csubcat = $isSelf ? ($_POST['bene_subcat'] ?? '') : ($_POST['c_subcat'] ?? '');
            // Initialize ALL optional variables
            $docu_otherinfo = "";
            $material = "";
            $belowMonthly = "";
            $severity = "";
            $crisis = "";
            $crisis1 = "";
            $support = "";
            $external = "";
            $selfhelp = "";
            $vulnerability = "";

            $SOI_wage = "";
            $SOI_profit = "";
            $SOI_domesticsource = "";
            $SOI_abroad = "";
            $SOI_governmenttransfer = "";
            $SOI_pension = "";
            $SOI_otherincome = "";

            $targets = "";
            $subcat = "";
            $if_medical = "";
            $if_burial = "";
            $financial = "";
            $diagnosis_cause_of_death = "";
            $free_funeral_service = "";

            //FAMILY DATA's
            $familyData = json_decode($_POST['family_data'], true);
            //SERVICE TABLE DATA's
            $ref_name = "";
            $s1 = (isset($_POST['psy'])? 1: 0 );
            $s2 = (isset($_POST['leg'])? 1: 0 );
            if (isset($_POST["ref"])) {
                $s3 = 1;
                $ref_name = mysqli_real_escape_string($user->db, strtoupper($_POST['ref_name']));
            }else{
                $s3 = 0;
            }
            $s4 = (isset($_POST['fin'])? 1: 0 );
            $s5 = (isset($_POST['pfa'])? 1: 0 );
            $s6 = (isset($_POST["counseling"])? 1: 0 );
            $rl1 = "";
            $rl2 = "";
            $rl3 = "";
			if(strtolower($_POST['mode_ad']) != "walk-in") {
				$rl1 = mysqli_real_escape_string($user->db, $_POST['rl1']);
				$rl2 = mysqli_real_escape_string($user->db, $_POST['rl2']);
				$rl3 = mysqli_real_escape_string($user->db, $_POST['rl3']);
			}
			
            //Assisstance TAble Data's
            $num = $_POST['num']; //client number sa GIS lng
            $mode_ad = $_POST['mode_ad'];    
            $type1 = $_POST["type1"];
            $pur1 = mysqli_real_escape_string($user->db, strtoupper($_POST["pur1"]));
            $a1 = mysqli_real_escape_string($user->db, $_POST['a1']);
            $m1 = $_POST["m1"];
            $f1 = "";
            if (empty($_POST['fsof1'])) {
                $f1 = mysqli_real_escape_string($user->db, strtoupper($_POST["f1"]));
            }

            if (isset($_POST['aics'])) {
                $program = 0;
                $otherProgram = "";
            } elseif (isset($_POST['wisupport'])) {
                $program = 'wisupport';
                $otherProgram = "";
            } elseif (isset($_POST['ffs'])){
                $program = 'ffs';
                $otherProgram = "";
            } elseif (isset($_POST['otherProgram'])) {
                $program = ($otherProgram === "AKAP") ? 1 : "other";
                $otherProgram = strtoupper($_POST['otherProgramItem']);
            }

            $type2 = $_POST['type2'] ?? "";

            if ($type2 == "") {
                $type2 = "";
                $pur2 = "";
                $a2 = "";
                $m2 = "";
                $f2 = "";
            } else {
                $type2 = $_POST["type2"];
                $pur2 = mysqli_real_escape_string($user->db, strtoupper($_POST["pur2"]));
                $a2 = mysqli_real_escape_string($user->db, $_POST['a2']);
                $m2 = $_POST["m2"];
                $f2 = mysqli_real_escape_string($user->db, strtoupper($_POST["f2"]));
            }
            
            //Assessments table data's
            $gis_opt = "";
            if(!empty($_POST['swatype'])){
                $gis_opt = mysqli_real_escape_string($user->db, $_POST["swatype"]);
            }
            $prob = mysqli_real_escape_string($user->db, mb_strtoupper($_POST["prob"], "UTF-8"));
            $ass = mysqli_real_escape_string($user->db, mb_strtoupper($_POST["ass"], "UTF-8"));
            
            $signatoryGIS = $_POST["approved"]; //signatory approved
            $fund1 = "";
            $fund2 = "";
            $fund3 = "";
            $fund4 = "";
            $fund5 = "";
            $fund6 = "";
            $fund7 = "";
            $fund8 = "";
            $fund9 = "";
            $fund10 = "";
            $fund11 = "";
            $fund12 = "";
            if(!empty($_POST['fsof1'])){
                $fund1 = strtoupper($_POST['fsof1']);
            }
            if(!empty($_POST['fsof2'])) {
                $fund2 = strtoupper($_POST['fsof2']);
            }
            if(!empty($_POST['fsof3'])) {
                $fund3 = strtoupper($_POST['fsof3']);
            }
            if(!empty($_POST['fsof4'])) {
                $fund4 = strtoupper($_POST['fsof4']);
            }
            if(!empty($_POST['fsof5'])) {
                $fund5 = strtoupper($_POST['fsof5']);
            }
            if(!empty($_POST['fsof6'])) {
                $fund6 = strtoupper($_POST['fsof6']);
            }
            if(!empty($_POST['fsof7'])) {
                $fund7 = strtoupper($_POST['fsof7']);
            }
            if(!empty($_POST['fsof8'])) {
                $fund8 = strtoupper($_POST['fsof8']);
            }
            if(!empty($_POST['fsof9'])) {
                $fund9 = strtoupper($_POST['fsof9']);
            }
            if(!empty($_POST['fsof10'])) {
                $fund10 = strtoupper($_POST['fsof10']);
            }
            if(!empty($_POST['fsof11'])) {
                $fund11 = strtoupper($_POST['fsof11']);
            }
            if(!empty($_POST['fsof12'])) {
                $fund12 = strtoupper($_POST['fsof12']);
            }
            
            // new data
            // Beneficiary Category / Sub-category / Type of Disability come from the
            // single-select dropdowns; values map to the numeric target_sector / subcat_ass /
            // type_of_disability codes the official GIS print decodes.
            $targets = $_POST['bene_sector'] ?? "";

            $beneSubcatText = $_POST['bene_subcat'] ?? "";
            $subcat = $subcatTextToCode[$beneSubcatText] ?? "";
            // CLIENT below-income / others -> below_monthly_income / others_subcat
            $belowMonthly = (($_POST['c_subcat'] ?? '') === 'Below Minimum Wage Earners') ? ($_POST["belowMonthly"] ?? "") : "";
            $others_subcat = (($_POST['c_subcat'] ?? '') === 'Others Specify' && !empty($_POST['osc_val'])) ? trim($_POST['osc_val']) : "";
            // BENEFICIARY below-income / others -> b_below_monthly_income / b_others_subcat
            $b_belowMonthly = ($beneSubcatText === 'Below Minimum Wage Earners') ? ($_POST["b_belowMonthly"] ?? "") : "";
            $b_others_subcat = ($beneSubcatText === 'Others Specify' && !empty($_POST['b_osc_val'])) ? trim($_POST['b_osc_val']) : "";

            $c_disability = $_POST['bene_disability'] ?? "";

			if(strtolower($type1) == "medical assistance"){
				if(isset($_POST['hb'])){$if_medical = 1;}
				if(isset($_POST['medicine'])){$if_medical = 2;}
				if(isset($_POST['chemo'])){$if_medical = 3;}
				if(isset($_POST['dia'])){$if_medical = 4;}
				if(isset($_POST['procedure'])){$if_medical = 5;}
				if(isset($_POST['laboratory'])){$if_medical = 6;}
				if(isset($_POST['implant'])){$if_medical = 7;}
			} else {
				$if_medical = "";
			}
			
            if(strtolower($type1) == "funeral assistance"){
				$diagnosis_cause_of_death = strtoupper($_POST["diagnosis_cod"]);
				if(isset($_POST['fb'])){$if_burial = 1;}
				if(isset($_POST['toc'])){$if_burial = 2;}
				if(isset($_POST['interment'])){$if_burial = 3;}
				if(isset($_POST['free_funeral_service_burial'])){$free_funeral_service .= "burial-";}
				if(isset($_POST['free_funeral_service_cremation'])){$free_funeral_service .= "cremation-";}
			} else {
				$if_burial = "";
			}
			
            if(isset($_POST['medical'])){$financial = 1;}
            if(isset($_POST['transportation'])){$financial = 2;}
            if(isset($_POST['food'])){$financial = 3;}
            if(isset($_POST['fassist'])){$financial = 4;}
            if(isset($_POST['educational'])){$financial = 5;}
            if(isset($_POST['casha'])){$financial = 6;}
            
            if(isset($_POST['packs'])){$material = 1;}
            if(isset($_POST['items'])){$material = 2;}
            if(isset($_POST['kits'])){$material = 3;}
            if(isset($_POST['devices'])){$material = 4;}
            if(isset($_POST['rice'])){$material = 5;}

            if(isset($_POST["number_of_employed"])){$docu_otherinfo.="employed=".$_POST["number_of_employed"]."-";}
            if(isset($_POST["number_of_seasonal"])){$docu_otherinfo.="seasonal=".$_POST["number_of_seasonal"]."-";}
            if(isset($_POST["familyIncome"])){$docu_otherinfo.="familyincome=".$_POST["familyIncome"]."-";}
            if(isset($_POST["insurance"])){$docu_otherinfo.="insurance-";}
            if(isset($_POST["savings"])){$docu_otherinfo.="savings-";}
            if(isset($_POST["pension"])){$docu_otherinfo.="pension-";}
            if(isset($_POST["monthlyexpense"])){$docu_otherinfo.="monthlyexpense=".$_POST["monthlyexpense"]."-";}
            if(isset($_POST["emergencyfund"])){$docu_otherinfo.="emergencyfund=".$_POST["emergencyfund"];}
            // Assistance Received from DSWD (checkboxes -> records table)
            $received = array();
            if(isset($_POST['assistance_aics'])){ $received[] = 'aics'; }
            if(isset($_POST['assistance_wgp'])){ $received[] = 'wgp'; }
            if(isset($_POST['assistance_4ps'])){ $received[] = '4ps'; }
            if(isset($_POST['assistance_slp'])){ $received[] = 'slp'; }
            if(isset($_POST['assistance_kalahicidss'])){ $received[] = 'kalahi'; }
            if(isset($_POST['assistance_others'])){ $received[] = 'other'; }
            $user->saveRecords($trans_id, $received, $_POST['assistance_other_specify'] ?? "");

            if(isset($_POST["severity1"])){$severity=$_POST["severity1"];}
            elseif(isset($_POST["severity2"])){$severity=$_POST["severity2"];}
            elseif(isset($_POST["severity3"])){$severity=$_POST["severity3"];}
            elseif(isset($_POST["severity4"])){$severity=$_POST["severity4"];}
            
            if(isset($_POST["crisis1"])){$crisis=$_POST["crisis1"];}
            elseif(isset($_POST["crisis2"])){$crisis=$_POST["crisis2"];}

            if(isset($_POST["crisis1_1"])){$crisis1.=$_POST["crisis1_1"]."-";}
            if(isset($_POST["crisis1_2"])){$crisis1.=$_POST["crisis1_2"]."-";}
            if(isset($_POST["crisis1_3"])){$crisis1.=$_POST["crisis1_3"]."-";}
            if(isset($_POST["crisis1_4"])){$crisis1.=$_POST["crisis1_4"]."-";}
            if(isset($_POST["crisis1_5"])){$crisis1.=$_POST["crisis1_5"]."-";}
            if(isset($_POST["crisis1_6"])){$crisis1.=$_POST["crisis1_6"]."=".$_POST["crisis1_6others"];}
            
            if(isset($_POST["support1"])){$support.=$_POST["support1"]."-";}
            if(isset($_POST["support2"])){$support.=$_POST["support2"]."-";}
            if(isset($_POST["support3"])){$support.=$_POST["support3"]."-";}
            if(isset($_POST["support4"])){$support.=$_POST["support4"]."-";}
            if(isset($_POST["support5"])){$support.=$_POST["support5"];}

            if(isset($_POST["external1"])){$external.=$_POST["external1"]."-";}
            if(isset($_POST["external2"])){$external.=$_POST["external2"]."-";}
            if(isset($_POST["external3"])){$external.=$_POST["external3"]."-";}
            if(isset($_POST["external4"])){$external.=$_POST["external4"]."-";}
            if(isset($_POST["external5"])){$external.=$_POST["external5"]."-";}
            if(isset($_POST["external6"])){$external.=$_POST["external6"]."-";}
            if(isset($_POST["external7"])){$external.=$_POST["external7"]."=".$_POST["external7_discount"]."-";}
            if(isset($_POST["external8"])){$external.=$_POST["external8"];}

            if(isset($_POST["selfhelp1"])){$selfhelp.=$_POST["selfhelp1"]."-";}
            if(isset($_POST["selfhelp2"])){$selfhelp.=$_POST["selfhelp2"];}

            if(isset($_POST["vulnerability1"])){$vulnerability.=$_POST["vulnerability1"]."-";}
            if(isset($_POST["vulnerability2"])){$vulnerability.=$_POST["vulnerability2"]."-";}
            if(isset($_POST["vulnerability3"])){$vulnerability.=$_POST["vulnerability3"];}

            if(isset($_POST["SOI_wage"])){$SOI_wage=$_POST["SOI_wage"];}
            if(isset($_POST["SOI_profit"])){$SOI_profit=$_POST["SOI_profit"];}
            if(isset($_POST["SOI_domesticsource"])){$SOI_domesticsource=$_POST["SOI_domesticsource"];}
            if(isset($_POST["SOI_abroad"])){$SOI_abroad=$_POST["SOI_abroad"];}
            if(isset($_POST["SOI_governmenttransfer"])){$SOI_governmenttransfer=$_POST["SOI_governmenttransfer"];}
            if(isset($_POST["SOI_pension"])){$SOI_pension=$_POST["SOI_pension"];}
            if(isset($_POST["SOI_otherincome"])){$SOI_otherincome=$_POST["SOI_otherincome"];}
            //once save the data of new -> client
            $user->updateGIS($empid, $trans_id, $csubcat, $id, $familyData, $s1, $s2, $s3, $s4, $s5, $s6, $program, $rl1, $rl2, $rl3, $ref_name,
            $type1, $pur1, $a1, $m1, $f1,$type2, $pur2, $a2, $m2, $f2, $mode_ad, $num, $gis_opt, $prob, $ass, $signatoryGIS, 
            $fund1, $fund2, $fund3, $fund4, $fund5, $fund6, $fund7, $fund8, $fund9, $fund10, $fund11, $fund12, $targets, $subcat, $c_disability, $others_subcat, $if_medical, $if_burial, $financial, $material,
            $docu_otherinfo, $otherProgram, $belowMonthly, $diagnosis_cause_of_death, $free_funeral_service, $severity, $crisis, $crisis1, $support, $external, $selfhelp, $vulnerability,
            $SOI_wage, $SOI_profit, $SOI_domesticsource, $SOI_abroad, $SOI_governmenttransfer, $SOI_pension, $SOI_otherincome);
            // Persist the Client/Beneficiary section selections (category, disability, gender).
            // When relation is Self the client IS the beneficiary, so the Beneficiary section
            // drives the client's own category/disability/gender.
            $beneDisabilityText = (($c_disability !== '' && isset($gisDis[$c_disability-1])) ? $gisDis[$c_disability-1] : '');
            $sectorToCategory = [1=>"Family Heads and Other Needy Adult",2=>"Men/Women in Specially Difficult Circumstances",3=>"Persons with Disabilities",4=>"Youth",5=>"Senior Citizens",6=>"Persons Living with HIV/AIDS",7=>"Children in Need of Special Protection"];
            if($isSelf){
                $gisClientCategory   = $sectorToCategory[$targets] ?? '';
                $gisClientDisability = $beneDisabilityText;
                $gisClientGender     = $_POST['bene_gender'] ?? '';
                $gisClientBelow      = $b_belowMonthly;
                $gisClientOthers     = $b_others_subcat;
            } else {
                $gisClientCategory   = $_POST['client_category'] ?? '';
                $gisClientDisability = $_POST['client_disability'] ?? '';
                $gisClientGender     = $_POST['client_gender'] ?? '';
                $gisClientBelow      = $belowMonthly;
                $gisClientOthers     = $others_subcat;
            }
            $user->saveGISClientBene($trans_id, $gisClientCategory, $gisClientDisability, $gisClientGender,
                ($gisSectors[$targets] ?? ''), $beneSubcatText, $beneDisabilityText, $_POST['bene_gender'] ?? '', $b_belowMonthly, $b_others_subcat, $gisClientBelow, $gisClientOthers);
        }

            //UPDATE CLIENT
        if (isset($_POST['c_update'])) {
                //Client name
            $lname = mysqli_real_escape_string($user->db, trim(strtoupper($_POST['lname'])));
            $mname = mysqli_real_escape_string($user->db, trim(strtoupper($_POST['mname'])));
            $fname = mysqli_real_escape_string($user->db, trim(strtoupper($_POST['fname'])));
            $exname = mysqli_real_escape_string($user->db, trim(strtoupper($_POST['exname'])));
            $bday = $_POST['bday'];
            
            $region = mysqli_real_escape_string($user->db, ($_POST['region']));
            $province = mysqli_real_escape_string($user->db, ($_POST['province']));
            $municipality = mysqli_real_escape_string($user->db, ($_POST['municipality']));
            $barangay = mysqli_real_escape_string($user->db, ($_POST['barangay']));
            $street = mysqli_real_escape_string($user->db, ($_POST['street']));
            $district = mysqli_real_escape_string($user->db, ($_POST['district']));
            $sex = mysqli_real_escape_string($user->db, ($_POST['sex']));
            

            // â”€â”€ Adult age validation: client must be 18 or above â”€â”€
            $clientBirthDate = new DateTime($bday);
            $clientToday     = new DateTime();
            $clientAge       = (int)$clientToday->diff($clientBirthDate)->y;
            if ($clientAge < 18) {
                echo "<script>alert('Update failed. The client must be 18 years old or above. Please correct the birth date.');</script>";
                echo "<meta http-equiv='refresh' content='0'>";
            } else {
                $user->updateClient($id, $lname, $mname, $fname, $exname, $bday, $sex, 
                                $region, $province, $municipality, $barangay, $street, $district);
            }
        }

            //BENEFICIARY CLIENT
        if (isset($_POST['b_update'])) {

            $trans_id = $_GET['id'];
            $b_id = $user->getBene_id($trans_id);
            $relation = mysqli_real_escape_string($user->db, trim(ucwords($_POST['relation'])));
            $lname = mysqli_real_escape_string($user->db, trim(strtoupper($_POST['lname'])));
            $mname = mysqli_real_escape_string($user->db, trim(strtoupper($_POST['mname'])));
            $fname = mysqli_real_escape_string($user->db, trim(strtoupper($_POST['fname'])));
            $exname = mysqli_real_escape_string($user->db, trim(strtoupper($_POST['exname'])));
            $bday = $_POST['bday'];
            $category = mysqli_real_escape_string($user->db, ($_POST['category']));
            $sex = mysqli_real_escape_string($user->db, ($_POST['sex']));
            $status = mysqli_real_escape_string($user->db, ($_POST['status']));
            $contact = mysqli_real_escape_string($user->db, ($_POST['contact']));
            
            $region = mysqli_real_escape_string($user->db, ($_POST['region']));
            $province = mysqli_real_escape_string($user->db, ($_POST['province']));
            $municipality = mysqli_real_escape_string($user->db, ($_POST['municipality']));
            $barangay = mysqli_real_escape_string($user->db, ($_POST['barangay']));
            $district = mysqli_real_escape_string($user->db, ($_POST['district']));
            $street = mysqli_real_escape_string($user->db, ($_POST['street']));
            
            $user->updateBene($trans_id, $b_id, $relation, $lname, $mname, $fname, $exname, 
                            $bday, $category, $sex, $status, $contact,
                            $region, $province, $municipality, $barangay, $district, $street);
        }

        if(isset($_POST['add_bene'])){
            $trans_id = $_GET['id'];
            $relation = mysqli_real_escape_string($user->db, trim(ucwords($_POST['relation'])));
            $lname = mysqli_real_escape_string($user->db, trim(strtoupper($_POST['lname'])));
            $mname = mysqli_real_escape_string($user->db, trim(strtoupper($_POST['mname'])));
            $fname = mysqli_real_escape_string($user->db, trim(strtoupper($_POST['fname'])));
            $exname = mysqli_real_escape_string($user->db, trim(strtoupper($_POST['exname'])));
            $bday = $_POST['bday'];
            $category = mysqli_real_escape_string($user->db, ($_POST['category']));
            $sex = mysqli_real_escape_string($user->db, ($_POST['sex']));
            $status = mysqli_real_escape_string($user->db, ($_POST['status']));
            $contact = mysqli_real_escape_string($user->db, ($_POST['contact']));
            
            $region = mysqli_real_escape_string($user->db, ($_POST['region']));
            $province = mysqli_real_escape_string($user->db, ($_POST['province']));
            $municipality = mysqli_real_escape_string($user->db, ($_POST['municipality']));
            $barangay = mysqli_real_escape_string($user->db, ($_POST['barangay']));
            $district = mysqli_real_escape_string($user->db, ($_POST['district']));
            $street = mysqli_real_escape_string($user->db, ($_POST['street']));
            $user->addBene($trans_id, $relation, $lname, $mname, $fname, $exname,
                            $bday, $category, $sex, $status, $contact,
                            $region, $province, $municipality, $barangay, $district, $street);

        }

        ?>
    </body>

    <div class="modal hide fade" id="additionalFundSource" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Fund Source</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
				<div class="fundsourcebody">
				    <div class="modal-body">
                        <div class="row form-group" style="margin-top: 2%; height:10%;">
                            <div class="form-group col-lg-6">
                                <select id="fs1" name="fs1" class="form-control"><?php echo $user->fundSourceOptions(empty($fundsourcedata[1]['fundsource']) ? '' : $fundsourcedata[1]['fundsource']); ?></select>
                                <label class="active" for="fs1">Fund Source</label>
                            </div>
                            <div class="form-group col-lg-6">
                                <select id="fs2" name="fs2" class="form-control" disabled><?php echo $user->fundSourceOptions(empty($fundsourcedata[2]['fundsource']) ? '' : $fundsourcedata[2]['fundsource']); ?></select>
                                <label class="active" for="fs2">Fund Source</label>
                            </div>
                            <div class="form-group col-lg-6">
                                <select id="fs3" name="fs3" class="form-control" disabled><?php echo $user->fundSourceOptions(empty($fundsourcedata[3]['fundsource']) ? '' : $fundsourcedata[3]['fundsource']); ?></select>
                                <label class="active" for="fs3">Fund Source</label>
                            </div>
                            <div class="form-group col-lg-6">
                                <select id="fs4" name="fs4" class="form-control" disabled><?php echo $user->fundSourceOptions(empty($fundsourcedata[4]['fundsource']) ? '' : $fundsourcedata[4]['fundsource']); ?></select>
                                <label class="active" for="fs4">Fund Source</label>
                            </div>
                            <div class="form-group col-lg-6">
                                <select id="fs5" name="fs5" class="form-control" disabled><?php echo $user->fundSourceOptions(empty($fundsourcedata[5]['fundsource']) ? '' : $fundsourcedata[5]['fundsource']); ?></select>
                                <label class="active" for="fs5">Fund Source</label>
                            </div>
                            <div class="form-group col-lg-6">
                                <select id="fs6" name="fs6" class="form-control" disabled><?php echo $user->fundSourceOptions(empty($fundsourcedata[6]['fundsource']) ? '' : $fundsourcedata[6]['fundsource']); ?></select>
                                <label class="active" for="fs6">Fund Source</label>
                            </div>
                            <div class="form-group col-lg-6">
                                <select id="fs7" name="fs7" class="form-control" disabled><?php echo $user->fundSourceOptions(empty($fundsourcedata[7]['fundsource']) ? '' : $fundsourcedata[7]['fundsource']); ?></select>
                                <label class="active" for="fs7">Fund Source</label>
                            </div>
                            <div class="form-group col-lg-6">
                                <select id="fs8" name="fs8" class="form-control" disabled><?php echo $user->fundSourceOptions(empty($fundsourcedata[8]['fundsource']) ? '' : $fundsourcedata[8]['fundsource']); ?></select>
                                <label class="active" for="fs8">Fund Source</label>
                            </div>
                            <div class="form-group col-lg-6">
                                <select id="fs9" name="fs9" class="form-control" disabled><?php echo $user->fundSourceOptions(empty($fundsourcedata[9]['fundsource']) ? '' : $fundsourcedata[9]['fundsource']); ?></select>
                                <label class="active" for="fs9">Fund Source</label>
                            </div>
                            <div class="form-group col-lg-6">
                                <select id="fs10" name="fs10" class="form-control" disabled><?php echo $user->fundSourceOptions(empty($fundsourcedata[10]['fundsource']) ? '' : $fundsourcedata[10]['fundsource']); ?></select>
                                <label class="active" for="fs10">Fund Source</label>
                            </div>
                            <div class="form-group col-lg-6">
                                <select id="fs11" name="fs11" class="form-control" disabled><?php echo $user->fundSourceOptions(empty($fundsourcedata[11]['fundsource']) ? '' : $fundsourcedata[11]['fundsource']); ?></select>
                                <label class="active" for="fs11">Fund Source</label>
                            </div>
                            <div class="form-group col-lg-6">
                                <select id="fs12" name="fs12" class="form-control" disabled><?php echo $user->fundSourceOptions(empty($fundsourcedata[12]['fundsource']) ? '' : $fundsourcedata[12]['fundsource']); ?></select>
                                <label class="active" for="fs12">Fund Source</label>
                            </div>
                        </div>
                                
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Save</button>    
                    </div>
                </div>
			</div>	
		</div>
	</div>

    <script type="text/javascript">
        function verifyfirst(){
            t1 = '<?php echo (isset($client_assistance[1]['type']) ?? null); ?>';
            p1 = '<?php echo (isset($client_assistance[1]['purpose']) ?? null); ?>';
            a1 = '<?php echo (isset($client_assistance[1]['amount']) ?? null); ?>';
            m1 = '<?php echo (isset($client_assistance[1]['mode']) ?? null); ?>';
            f1 = '<?php echo (isset($client_assistance[1]['fund']) ?? null); ?>';
            t2 = $('#type1').val();
            p2 = $('#pur1').val();
            a2 = $('#a1').val();
            m2 = $('#m1').val();
            f2 = $('#fundf1').val();
            
            if(t1 != t2){
                $('#toCOE').attr('disabled','disabled');
                $('#print').attr('disabled','disabled');
                $('#print').removeClass('btn-primary').addClass('btn-dark ');
                $(this).addClass('btn-success').removeClass('btn-primary ');
                $('#toCOE').removeClass('btn-success').addClass('btn-dark ');
                $(this).addClass('btn-success').removeClass('btn-success ');
            }
            if(p1 != p2){
                $('#toCOE').attr('disabled','disabled');
                $('#print').attr('disabled','disabled');
                $('#print').removeClass('btn-primary').addClass('btn-dark ');
                $(this).addClass('btn-success').removeClass('btn-primary ');
                $('#toCOE').removeClass('btn-success').addClass('btn-dark ');
                $(this).addClass('btn-success').removeClass('btn-success ');
            }
            if(a1 != a2){
                $('#toCOE').attr('disabled','disabled');
                $('#print').attr('disabled','disabled');
                $('#print').removeClass('btn-primary').addClass('btn-dark ');
                $(this).addClass('btn-success').removeClass('btn-primary ');
                $('#toCOE').removeClass('btn-success').addClass('btn-dark ');
                $(this).addClass('btn-success').removeClass('btn-success ');
            }
            if(m1 != m2){
                $('#toCOE').attr('disabled','disabled');
                $('#print').attr('disabled','disabled');
                $('#print').removeClass('btn-primary').addClass('btn-dark ');
                $(this).addClass('btn-success').removeClass('btn-primary ');
                $('#toCOE').removeClass('btn-success').addClass('btn-dark ');
                $(this).addClass('btn-success').removeClass('btn-success ');
            }
            if(f1 != f2){
                $('#toCOE').attr('disabled','disabled');
                $('#print').attr('disabled','disabled');
                $('#print').removeClass('btn-primary').addClass('btn-dark ');
                $(this).addClass('btn-success').removeClass('btn-primary ');
                $('#toCOE').removeClass('btn-success').addClass('btn-dark ');
                $(this).addClass('btn-success').removeClass('btn-success ');
            }
        }
        function verifysecond(){
            t1 = '<?php echo (isset($client_assistance[2]['type']) ?? null); ?>';
            p1 = '<?php echo (isset($client_assistance[2]['purpose']) ?? null); ?>';
            a1 = '<?php echo (isset($client_assistance[2]['amount']) ?? null); ?>';
            m1 = '<?php echo (isset($client_assistance[2]['mode']) ?? null); ?>';
            f1 = '<?php echo (isset($client_assistance[2]['fund']) ?? null); ?>';
            t2 = $('#type2').val();
            p2 = $('#pur2').val();
            a2 = $('#a2').val();
            m2 = $('#m2').val();
            f2 = $('#fundf2').val();
            
            if(t1 != t2){
                $('#toCOE').attr('disabled','disabled');
                $('#print').attr('disabled','disabled');
                $('#print').removeClass('btn-primary').addClass('btn-dark ');
                $(this).addClass('btn-success').removeClass('btn-primary ');
                $('#toCOE').removeClass('btn-success').addClass('btn-dark ');
                $(this).addClass('btn-success').removeClass('btn-success ');
            }
            if(p1 != p2){
                $('#toCOE').attr('disabled','disabled');
                $('#print').attr('disabled','disabled');
                $('#print').removeClass('btn-primary').addClass('btn-dark ');
                $(this).addClass('btn-success').removeClass('btn-primary ');
                $('#toCOE').removeClass('btn-success').addClass('btn-dark ');
                $(this).addClass('btn-success').removeClass('btn-success ');
            }
            if(a1 != a2){
                $('#toCOE').attr('disabled','disabled');
                $('#print').attr('disabled','disabled');
                $('#print').removeClass('btn-primary').addClass('btn-dark ');
                $(this).addClass('btn-success').removeClass('btn-primary ');
                $('#toCOE').removeClass('btn-success').addClass('btn-dark ');
                $(this).addClass('btn-success').removeClass('btn-success ');
            }
            if(m1 != m2){
                $('#toCOE').attr('disabled','disabled');
                $('#print').attr('disabled','disabled');
                $('#print').removeClass('btn-primary').addClass('btn-dark ');
                $(this).addClass('btn-success').removeClass('btn-primary ');
                $('#toCOE').removeClass('btn-success').addClass('btn-dark ');
                $(this).addClass('btn-success').removeClass('btn-success ');
            }
            if(f1 != f2){
                $('#toCOE').attr('disabled','disabled');
                $('#print').attr('disabled','disabled');
                $('#print').removeClass('btn-primary').addClass('btn-dark ');
                $(this).addClass('btn-success').removeClass('btn-primary ');
                $('#toCOE').removeClass('btn-success').addClass('btn-dark ');
                $(this).addClass('btn-success').removeClass('btn-success ');
            }
        }

        
    	$(document).ready(function(){
			$('#printgis').on('click', function() {
				window.location='gis.php?id="'+$_GET["id"]+'"'; 
			}); 
		});
		$(document).ready(function(){
            if(document.getElementById("fundf1").value == ''){
                $('#toCOE').attr('disabled','disabled');
                $('#print').attr('disabled','disabled');
                $('#print').removeClass('btn-primary').addClass('btn-dark ');
                $(this).addClass('btn-success').removeClass('btn-primary ');
                $('#toCOE').removeClass('btn-success').addClass('btn-dark ');
                $(this).addClass('btn-success').removeClass('btn-success ');
            }
            $("#fundf1").change(function(){
                if(document.getElementById("fundf1").value == ''){
                $('#toCOE').attr('disabled','disabled');
                $('#print').attr('disabled','disabled');
                $('#print').removeClass('btn-primary').addClass('btn-dark ');
                $(this).addClass('btn-success').removeClass('btn-primary ');
                $('#toCOE').removeClass('btn-success').addClass('btn-dark ');
                $(this).addClass('btn-success').removeClass('btn-success ');
            }
            });
        });
        $(document).ready(function(){
            if(document.getElementById("fs1").value != ''){
                if(document.getElementById("fs2").value == ''){
                    $("#fundf1").attr('disabled', false);
                }else{
                    $("#fundf1").attr('disabled', true);
                }
                f1 = document.getElementById("fs1").value;
                document.getElementById('fsof1').value = f1;
                $("#fs2").attr('disabled', false);
            }
            $("#fs1").change(function(){
                f1 = document.getElementById("fs1").value;
			    document.getElementById('fsof1').value = f1;
                $("#fs2").attr('disabled', false);
                $("#fundf1").attr('disabled', true);
            });
        });
        $(document).ready(function(){
            if(document.getElementById("fs2").value != ''){
                f2 = document.getElementById("fs2").value;
                document.getElementById('fsof2').value = f2;
                $("#fs3").attr('disabled', false);
            }
            $("#fs2").change(function(){
                f2 = document.getElementById("fs2").value;
			    document.getElementById('fsof2').value = f2;
                $("#fs3").attr('disabled', false);
            });
        });
        $(document).ready(function(){
            if(document.getElementById("fs3").value != ''){
                f3 = document.getElementById("fs3").value;
                document.getElementById('fsof3').value = f3;
                $("#fs4").attr('disabled', false);
            }
            $("#fs3").change(function(){
                f3 = document.getElementById("fs3").value;
			    document.getElementById('fsof3').value = f3;
                $("#fs4").attr('disabled', false);
            });
        });
        $(document).ready(function(){
            if(document.getElementById("fs4").value != ''){
                f4 = document.getElementById("fs4").value;
                document.getElementById('fsof4').value = f4;
                $("#fs5").attr('disabled', false);
            }
            $("#fs4").change(function(){
                f4 = document.getElementById("fs4").value;
			    document.getElementById('fsof4').value = f4;
                $("#fs5").attr('disabled', false);
            });
        });
        
        $(document).ready(function(){
            if(document.getElementById("fs5").value != ''){
                f5 = document.getElementById("fs5").value;
                document.getElementById('fsof5').value = f5;
                $("#fs6").attr('disabled', false);
            }
            $("#fs5").change(function(){
                f5 = document.getElementById("fs5").value;
			    document.getElementById('fsof5').value = f5;
                $("#fs6").attr('disabled', false);
            });
        });
        $(document).ready(function(){
            if(document.getElementById("fs6").value != ''){
                f6 = document.getElementById("fs6").value;
                document.getElementById('fsof6').value = f6;
                $("#fs7").attr('disabled', false);
            }
            $("#fs6").change(function(){
                f6 = document.getElementById("fs6").value;
			    document.getElementById('fsof6').value = f6;
                $("#fs7").attr('disabled', false);
            });
        });
        $(document).ready(function(){
            if(document.getElementById("fs7").value != ''){
                f7 = document.getElementById("fs7").value;
                document.getElementById('fsof7').value = f7;
                $("#fs8").attr('disabled', false);
            }
            $("#fs7").change(function(){
                f7 = document.getElementById("fs7").value;
			    document.getElementById('fsof7').value = f7;
                $("#fs8").attr('disabled', false);
            });
        });
        $(document).ready(function(){
            if(document.getElementById("fs8").value != ''){
                f8 = document.getElementById("fs8").value;
                document.getElementById('fsof8').value = f8;
                $("#fs9").attr('disabled', false);
            }
            $("#fs8").change(function(){
                f8 = document.getElementById("fs8").value;
			    document.getElementById('fsof8').value = f8;
                $("#fs9").attr('disabled', false);
            });
        });
        $(document).ready(function(){
            if(document.getElementById("fs9").value != ''){
                f9 = document.getElementById("fs9").value;
                document.getElementById('fsof9').value = f9;
                $("#fs10").attr('disabled', false);
            }
            $("#fs9").change(function(){
                f9 = document.getElementById("fs9").value;
			    document.getElementById('fsof9').value = f9;
                $("#fs10").attr('disabled', false);
            });
        });
        $(document).ready(function(){
            if(document.getElementById("fs10").value != ''){
                f10 = document.getElementById("fs10").value;
                document.getElementById('fsof10').value = f10;
                $("#fs11").attr('disabled', false);
            }
            $("#fs10").change(function(){
                f10 = document.getElementById("fs10").value;
			    document.getElementById('fsof10').value = f10;
                $("#fs11").attr('disabled', false);
            });
        });
        $(document).ready(function(){
            if(document.getElementById("fs11").value != ''){
                f11 = document.getElementById("fs11").value;
                document.getElementById('fsof11').value = f11;
                $("#fs12").attr('disabled', false);
            }
            $("#fs11").change(function(){
                f11 = document.getElementById("fs11").value;
			    document.getElementById('fsof11').value = f11;
                $("#fs12").attr('disabled', false);
            });
        });
        $(document).ready(function(){
            if(document.getElementById("fs12").value != ''){
                f12 = document.getElementById("fs12").value;
                document.getElementById('fsof12').value = f12;
            }
            $("#fs12").change(function(){
                f12 = document.getElementById("fs12").value;
			    document.getElementById('fsof12').value = f12;
            });
        });


        $(document).ready(function () {
            var afterPrint = function () {
                window.location='gis.php?id=<?php echo $_GET['id'] ?>';
            };
            window.onafterprint = afterPrint;
        });

	    $(function () {
            var type = $("#type1").val();
            if(type.toLowerCase()=="medical assistance") {
                $("#medical_show").show();
                $("#burial_show").hide();
            } else if (type.toLowerCase()=="funeral assistance") {
                $("#medical_show").hide();
                $("#burial_show").show();
            } else {
                $("#medical_show").hide();
                $("#burial_show").hide();
            }
				
			if(type.toLowerCase()=="medical assistance") {
				$('#medical').prop('checked', true);
				$("#transportation").prop('checked', false);
				$("#food").prop('checked', false);
				$("#fassist").prop('checked', false);
				$("#educational").prop('checked', false);
				$("#casha").prop('checked', false);
			} else if (type.toLowerCase()=="funeral assistance") {
				$('#medical').prop('checked', false);
				$("#transportation").prop('checked', false);
				$("#food").prop('checked', false);
				$("#fassist").prop('checked', true);
				$("#educational").prop('checked', false);
				$("#casha").prop('checked', false);
			} else if (type.toLowerCase()=="food subsidy assistance") {
				$('#medical').prop('checked', false);
				$("#transportation").prop('checked', false);
				$("#food").prop('checked', true);
				$("#fassist").prop('checked', false);
				$("#educational").prop('checked', false);
				$("#casha").prop('checked', false);
			} else if (type.toLowerCase()=="transportation assistance") {
				$('#medical').prop('checked', false);
				$("#transportation").prop('checked', true);
				$("#food").prop('checked', false);
				$("#fassist").prop('checked', false);
				$("#educational").prop('checked', false);
				$("#casha").prop('checked', false);
			} else if (type.toLowerCase()=="educational assistance") {
				$('#medical').prop('checked', false);
				$("#transportation").prop('checked', false);
				$("#food").prop('checked', false);
				$("#fassist").prop('checked', false);
				$("#educational").prop('checked', true);
				$("#casha").prop('checked', false);
			} else if (type.toLowerCase()=="other cash assistance") {
				$('#medical').prop('checked', false);
				$("#transportation").prop('checked', false);
				$("#food").prop('checked', false);
				$("#fassist").prop('checked', false);
				$("#educational").prop('checked', false);
				$("#casha").prop('checked', true);
			} else if (type.toLowerCase()=="material assistance") {
					$('#medical').prop('checked', false);
					$("#transportation").prop('checked', false);
					$("#food").prop('checked', false);
					$("#fassist").prop('checked', false);
					$("#educational").prop('checked', false);
					$("#casha").prop('checked', false);
				}
			
            $("#type1").on("change", function () {
                var type = $("#type1").val();
                if(type.toLowerCase()=="medical assistance") {
                    $("#medical_show").show();
                    $("#burial_show").hide();
                } else if (type.toLowerCase()=="funeral assistance") {
                    $("#medical_show").hide();
                    $("#burial_show").show();
                } else {
                    $("#medical_show").hide();
                    $("#burial_show").hide();
                }
				
				if(type.toLowerCase()=="medical assistance") {
					$('#medical').prop('checked', true);
					$("#transportation").prop('checked', false);
					$("#food").prop('checked', false);
					$("#fassist").prop('checked', false);
					$("#educational").prop('checked', false);
					$("#casha").prop('checked', false);
				} else if (type.toLowerCase()=="funeral assistance") {
					$('#medical').prop('checked', false);
					$("#transportation").prop('checked', false);
					$("#food").prop('checked', false);
					$("#fassist").prop('checked', true);
					$("#educational").prop('checked', false);
					$("#casha").prop('checked', false);
				} else if (type.toLowerCase()=="food subsidy assistance") {
					$('#medical').prop('checked', false);
					$("#transportation").prop('checked', false);
					$("#food").prop('checked', true);
					$("#fassist").prop('checked', false);
					$("#educational").prop('checked', false);
					$("#casha").prop('checked', false);
				} else if (type.toLowerCase()=="transportation assistance") {
					$('#medical').prop('checked', false);
					$("#transportation").prop('checked', true);
					$("#food").prop('checked', false);
					$("#fassist").prop('checked', false);
					$("#educational").prop('checked', false);
					$("#casha").prop('checked', false);
				} else if (type.toLowerCase()=="educational assistance") {
					$('#medical').prop('checked', false);
					$("#transportation").prop('checked', false);
					$("#food").prop('checked', false);
					$("#fassist").prop('checked', false);
					$("#educational").prop('checked', true);
					$("#casha").prop('checked', false);
				} else if (type.toLowerCase()=="other cash assistance") {
					$('#medical').prop('checked', false);
					$("#transportation").prop('checked', false);
					$("#food").prop('checked', false);
					$("#fassist").prop('checked', false);
					$("#educational").prop('checked', false);
					$("#casha").prop('checked', true);
				} else if (type.toLowerCase()=="material assistance") {
					$('#medical').prop('checked', false);
					$("#transportation").prop('checked', false);
					$("#food").prop('checked', false);
					$("#fassist").prop('checked', false);
					$("#educational").prop('checked', false);
					$("#casha").prop('checked', false);
				}
            }); 
        });
		
		//referral JS
		
		$(document).ready(function(){
			var mode = $("#mode_ad").val();
			$("#refer1").keyup(function(){
                if(document.getElementById("refer1").value != ''){
					$("#refer2").attr('disabled', false);
					$("#refer3").attr('disabled', true);
				} else if(document.getElementById("refer2").value != '') {
					$("#refer2").attr('disabled', false);
					$("#refer3").attr('disabled', false);
				}
            });
			
            if(mode.toLowerCase()=="walk-in") {
				$("#refer1").prop('disabled', true);
				$("#refer2").prop('disabled', true);
				$("#refer3").prop('disabled', true);
			} else if (mode.toLowerCase()=="referral") {
				$("#refer1").prop('disabled', false);
				$("#refer2").prop('disabled', true);
				$("#refer3").prop('disabled', true);
			}
			$("#mode_ad").on("change", function () {
                var mode = $("#mode_ad").val();
                
				if(mode.toLowerCase()=="walk-in") {
					$("#refer1").prop('disabled', true);
					$("#refer2").prop('disabled', true);
					$("#refer3").prop('disabled', true);
				} else if (mode.toLowerCase()=="referral") {
					$("#refer1").prop('disabled', false);
					$("#refer2").prop('disabled', true);
					$("#refer3").prop('disabled', true);
				}
            }); 
			
            if(document.getElementById("refer1").value != ''){
				$("#refer2").attr('disabled', false);
			}else{
				$("#refer2").attr('disabled', true);
            }
            $("#refer1").keyup(function(){
                if(document.getElementById("refer1").value != ''){
					$("#refer2").attr('disabled', false);
					$("#refer3").attr('disabled', true);
				} else {
					$("#refer2").attr('disabled', true);
					$("#refer3").attr('disabled', true);
				}
            });
        });
		
        $(document).ready(function(){
            if(document.getElementById("refer2").value != ''){
                $("#refer3").attr('disabled', false);
            }else{
				$("#refer3").attr('disabled', true);
            }
            $("#refer2").keyup(function(){
				if(document.getElementById("refer2").value != ''){
					$("#refer3").attr('disabled', false);
				} else {
					$("#refer3").attr('disabled', true);
				}
            });
        });
		
		// ----------

        $(function () {
            $("#fhona").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#wedc, #pwd, #youth, #sc, #plhiv, #cnsp").prop("checked", false);
        		}
		    });
        	$("#wedc").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#fhona, #pwd, #youth, #sc, #plhiv, #cnsp").prop("checked", false);
        		}
		    });
        	$("#pwd").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#wedc, #fhona, #youth, #sc, #plhiv, #cnsp").prop("checked", false);
        		}
		    });
        	$("#youth").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#wedc, #pwd, #fhona, #sc, #plhiv, #cnsp").prop("checked", false);
        		}
		    });
        	$("#sc").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#wedc, #pwd, #youth, #fhona, #plhiv, #cnsp").prop("checked", false);
        		}
		    });
        	$("#plhiv").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#wedc, #pwd, #youth, #sc, #fhona, #cnsp").prop("checked", false);
        		}
		    });
        	$("#cnsp").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#wedc, #pwd, #youth, #sc, #plhiv, #fhona").prop("checked", false);
        		}
		    });
        });
        
        $(function () {
            if ($("#below_min_wage").prop("checked")) {
                $("#belowMonthly").prop("disabled", false);
            }
            if ($("#osc").prop("checked")) {
                $("#osc_val").prop("disabled", false);
            }
        	$("#solo").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#ip, #drug, #4ps, #dwell, #stateless, #asylum, #refugees, #osc, #kia_wia, #min_wage, #below_min_wage, #no_regular_income").prop("checked", false);
    	     		$("#belowMonthly").prop("disabled", true);
                    $("#osc_val").prop("disabled", true);
        		}
		    });
        	$("#ip").click(function () {
	        	if ($(this).prop("checked")) {
                    $("#solo, #drug, #4ps, #dwell, #stateless, #asylum, #refugees, #osc, #kia_wia, #min_wage, #below_min_wage, #no_regular_income").prop("checked", false);
                    $("#belowMonthly").prop("disabled", true);
                    $("#osc_val").prop("disabled", true);
        		}
		    });
        	$("#drug").click(function () {
	        	if ($(this).prop("checked")) {
                    $("#solo, #ip, #4ps, #dwell, #stateless, #asylum, #refugees, #osc, #kia_wia, #min_wage, #below_min_wage, #no_regular_income").prop("checked", false);
        		    $("#belowMonthly").prop("disabled", true);
                    $("#osc_val").prop("disabled", true);
        		}
		    });
        	$("#4ps").click(function () {
	        	if ($(this).prop("checked")) {
                    $("#solo, #ip, #drug, #dwell, #stateless, #asylum, #refugees, #osc, #kia_wia, #min_wage, #below_min_wage, #no_regular_income").prop("checked", false);
        		    $("#belowMonthly").prop("disabled", true);
                    $("#osc_val").prop("disabled", true);
        		}
		    });
        	$("#dwell").click(function () {
	        	if ($(this).prop("checked")) {
                    $("#solo, #ip, #drug, #4ps, #stateless, #asylum, #refugees, #osc, #kia_wia, #min_wage, #below_min_wage, #no_regular_income").prop("checked", false);
        		    $("#belowMonthly").prop("disabled", true);
                    $("#osc_val").prop("disabled", true);
        		}
		    });
        	$("#stateless").click(function () {
	        	if ($(this).prop("checked")) {
                    $("#solo, #ip, #drug, #4ps, #dwell, #asylum, #refugees, #osc, #kia_wia, #min_wage, #below_min_wage, #no_regular_income").prop("checked", false);
        		    $("#belowMonthly").prop("disabled", true);
                    $("#osc_val").prop("disabled", true);
        		}
		    });
        	$("#asylum").click(function () {
	        	if ($(this).prop("checked")) {
                    $("#solo, #ip, #drug, #4ps, #dwell, #stateless, #refugees, #osc, #kia_wia, #min_wage, #below_min_wage, #no_regular_income").prop("checked", false);
        		    $("#belowMonthly").prop("disabled", true);
                    $("#osc_val").prop("disabled", true);
        		}
		    });
        	$("#refugees").click(function () {
	        	if ($(this).prop("checked")) {
    	     	    $("#solo, #ip, #drug, #4ps, #dwell, #stateless, #asylum, #osc, #kia_wia, #min_wage, #below_min_wage, #no_regular_income").prop("checked", false);
                     $("#belowMonthly").prop("disabled", true);
                    $("#osc_val").prop("disabled", true);
        		}
		    });	
        	$("#osc").click(function () {
                let isChecked = $(this).prop("checked");
                
                $("#solo, #ip, #drug, #4ps, #dwell, #stateless, #asylum, #refugees, #kia_wia, #min_wage, #below_min_wage, #no_regular_income").prop("checked", false);
                $("#belowMonthly").prop("disabled", true);
                $("#osc_val").prop("disabled", !isChecked);
                $("#osc_val").prop("required", isChecked);
		    });
        	$("#kia_wia").click(function () {
	        	if ($(this).prop("checked")) {
                    $("#solo, #ip, #drug, #4ps, #dwell, #stateless, #asylum, #refugees, #osc, #min_wage, #below_min_wage, #no_regular_income").prop("checked", false);
                    $("#belowMonthly").prop("disabled", true);
                    $("#osc_val").prop("disabled", true);
        		}
		    });
        	$("#min_wage").click(function () {
	        	if ($(this).prop("checked")) {
                    $("#solo, #ip, #drug, #4ps, #dwell, #stateless, #asylum, #refugees, #osc, #kia_wia, #below_min_wage, #no_regular_income").prop("checked", false);
                    $("#belowMonthly").prop("disabled", true);
                    $("#osc_val").prop("disabled", true);
        		}
		    });
            $("#below_min_wage").click(function () {
                
                let isChecked = $(this).prop("checked");

                $("#solo, #ip, #drug, #4ps, #dwell, #stateless, #asylum, #refugees, #osc, #kia_wia, #min_wage, #no_regular_income").prop("checked", false);
                $("#belowMonthly").prop("disabled", !isChecked);
                $("#belowMonthly").prop("required", isChecked);
                $("#osc_val").prop("disabled", true);
		    });
            $("#no_regular_income").click(function () {
	        	if ($(this).prop("checked")) {
                    $("#solo, #ip, #drug, #4ps, #dwell, #stateless, #asylum, #refugees, #osc, #kia_wia, #min_wage, #below_min_wage").prop("checked", false);
                    $("#belowMonthly").prop("disabled", true);
                    $("#osc_val").prop("disabled", true);
        		}
		    });
        });

        $(function () {
            if ($("#wage_check").prop("checked")) {
                $("#SOI_wage").prop("disabled", false);
            }else{
                $("#SOI_wage").prop("disabled", true);
            }
            if ($("#profit_check").prop("checked")) {
                $("#SOI_profit").prop("disabled", false);
            }else{
                $("#SOI_profit").prop("disabled", true);
            }
            if ($("#domestic_check").prop("checked")) {
                $("#SOI_domesticsource").prop("disabled", false);
            }else{
                $("#SOI_domesticsource").prop("disabled", true);
            }
            if ($("#abroad_check").prop("checked")) {
                $("#SOI_abroad").prop("disabled", false);
            }else{
                $("#SOI_abroad").prop("disabled", true);
            }
            if ($("#transfer_check").prop("checked")) {
                $("#SOI_governmenttransfer").prop("disabled", false);
            }else{
                $("#SOI_governmenttransfer").prop("disabled", true);
            }
            if ($("#pension_check").prop("checked")) {
                $("#SOI_pension").prop("disabled", false);
            }else{
                $("#SOI_pension").prop("disabled", true);
            }
            if ($("#otherincome_check").prop("checked")) {
                $("#SOI_otherincome").prop("disabled", false);
            }else{
                $("#SOI_otherincome").prop("disabled", true);
            }
        	$("#wage_check").click(function () {
                $("#SOI_wage").prop("disabled", !$(this).prop("checked")).prop("required", $(this).prop("checked")).val($(this).prop("checked") ? $("#SOI_wage").val() : "");
		    });
            $("#profit_check").click(function () {
                $("#SOI_profit").prop("disabled", !$(this).prop("checked")).prop("required", $(this).prop("checked")).val($(this).prop("checked") ? $("#SOI_profit").val() : "");
		    });
            $("#domestic_check").click(function () {
                $("#SOI_domesticsource").prop("disabled", !$(this).prop("checked")).prop("required", $(this).prop("checked")).val($(this).prop("checked") ? $("#SOI_domesticsource").val() : "");
		    });
            $("#abroad_check").click(function () {
                $("#SOI_abroad").prop("disabled", !$(this).prop("checked")).prop("required", $(this).prop("checked")).val($(this).prop("checked") ? $("#SOI_abroad").val() : "");
		    });
            $("#transfer_check").click(function () {
                $("#SOI_governmenttransfer").prop("disabled", !$(this).prop("checked")).prop("required", $(this).prop("checked")).val($(this).prop("checked") ? $("#SOI_governmenttransfer").val() : "");
		    });
            $("#pension_check").click(function () {
                $("#SOI_pension").prop("disabled", !$(this).prop("checked")).prop("required", $(this).prop("checked")).val($(this).prop("checked") ? $("#SOI_pension").val() : "");
		    });
            $("#otherincome_check").click(function () {
                $("#SOI_otherincome").prop("disabled", !$(this).prop("checked")).prop("required", $(this).prop("checked")).val($(this).prop("checked") ? $("#SOI_otherincome").val() : "");
		    });
        });

        $(function () {
        	$("#severity1").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#severity2, #severity3, #severity4").prop("checked", false);
        		}
		    });
            $("#severity2").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#severity1, #severity3, #severity4").prop("checked", false);
        		}
		    });
            $("#severity3").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#severity2, #severity1, #severity4").prop("checked", false);
        		}
		    });
            $("#severity4").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#severity2, #severity3, #severity1").prop("checked", false);
        		}
		    });
        });

        $(function () {
            if ($("#crisis1_6").prop("checked")) {
                $("#crisis1_6others").prop("disabled", false);
            }else{
                $("#crisis1_6others").prop("disabled", true);
            }
            if($("#crisis2").prop("checked")) {
                $("#crisis1_1, #crisis1_2, #crisis1_3, #crisis1_4, #crisis1_5, #crisis1_6").prop("disabled", true);
                $("#crisis1_6others").prop("disabled", true);
            }else{
                $("#crisis1_1, #crisis1_2, #crisis1_3, #crisis1_4, #crisis1_5, #crisis1_6").prop("disabled", false);
            }
        	$("#crisis1").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#crisis2").prop("checked", false);
                    $("#crisis1_1, #crisis1_2, #crisis1_3, #crisis1_4, #crisis1_5, #crisis1_6").prop("disabled", false);
                    $("#crisis1_6others").prop("disabled", true);
                    $("#crisis1_6others").val("");
                    $("#crisis1_6").prop("checked", false);
        		}
		    });
            $("#crisis2").click(function () {
	        	if ($(this).prop("checked")) {
                        $("#crisis1_1, #crisis1_2, #crisis1_3, #crisis1_4, #crisis1_5, #crisis1_6, #crisis1_6others").prop("disabled", true);
        	     		$("#crisis1, #crisis1_1, #crisis1_2, #crisis1_3, #crisis1_4, #crisis1_5, #crisis1_6").prop("checked", false);
                        $("#crisis1_6others").prop("disabled", true);
                        $("#crisis1_6others").val("");
                        $("#crisis1_6").prop("checked", false);
                    }
		    });
            
            $("#crisis1_6").click(function () {
	        	let isChecked = $(this).prop("checked");
                $("#crisis1_6others").prop("disabled", !isChecked);
                $("#crisis1_6others").prop("required", isChecked);
                $("#crisis1_6others").val(isChecked ? $("#crisis1_6others").val() : "");
		    });
        });

        $(function () {
            if ($("#external7").prop("checked")) {
                $("#external7_discount").prop("disabled", false);
                $("#external7_discount").prop("required", true);
            }else{
                $("#external7_discount").prop("disabled", true);
                $("#external7_discount").prop("required", false);
            }
            $("#external7").click(function () {
                $("#external7_discount").prop("disabled", !$(this).prop("checked")).prop("required", $(this).prop("checked")).val($(this).prop("checked") ? $("#external7_discount").val() : "");
		    });
        });
        
        $(function () {
        	$("#hb").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#medicine, #chemo, #dia, #procedure, #laboratory, #implant").prop("checked", false);
        		}
		    });
        	$("#medicine").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#hb, #chemo, #dia, #procedure, #laboratory, #implant").prop("checked", false);
        		}
		    });
        	$("#chemo").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#medicine, #hb, #dia, #procedure, #laboratory, #implant").prop("checked", false);
        		}
		    });
        	$("#dia").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#medicine, #chemo, #hb, #procedure, #laboratory, #implant").prop("checked", false);
        		}
		    });
        	$("#procedure").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#medicine, #chemo, #dia, #hb, #laboratory, #implant").prop("checked", false);
        		}
		    });
        	$("#laboratory").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#medicine, #chemo, #dia, #procedure, #hb, #implant").prop("checked", false);
        		}
		    });
        	$("#implant").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#medicine, #chemo, #dia, #procedure, #laboratory, #hb").prop("checked", false);
        		}
		    });
        });

        $(function () {
        	$("#fb").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#toc, #interment").prop("checked", false);
        		}
		    });
        	$("#toc").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#fb, #interment").prop("checked", false);
        		}
		    });
        	$("#interment").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#toc, #fb").prop("checked", false);
        		}
		    });
        });

        $(function () {
            aics = $('#aics').val();
            akap = $('#akap').val();
            otherProgram = $('#otherProgram').val();

            if ($("#otherProgram").prop("checked")) {
                $("#otherProgramItem").removeAttr('hidden');
            }

            if(aics != "" || akap != "" || otherProgram != ""){
                $("#aics").removeAttr('required');
                $("#akap").removeAttr('required');
                $("#otherProgram").removeAttr('required');
                $("#otherProgramItem").removeAttr('required');
            }
            $("#aics").click(function () {
                if ($(this).prop("checked")) {
                    $("#akap").prop("checked", false);
                    $("#akap").removeAttr('required');
                    $("#otherProgram").prop("checked", false);
    	     		$("#otherProgramItem").prop("hidden", true);
                     $("#otherProgramItem").prop('required', false);
        		}
            });
            $("#akap").click(function () {
                if ($(this).prop("checked")) {
                    $("#aics").prop("checked", false);
                    $("#aics").removeAttr('required');
                    $("#otherProgram").prop("checked", false);
                    $("#otherProgram").removeAttr('required');
                    $("#otherProgramItem").prop("hidden", true);
                    $("#otherProgramItem").prop('required', false);
        		}
		    });
            $("#otherProgram").click(function () {
                let isChecked = $(this).prop("checked");
                $("#aics").prop("checked", false);
                    $("#aics").removeAttr('required');
                $("#akap").prop("checked", false);
                $("#akap").removeAttr('required');
                $("#otherProgramItem").prop('hidden', !isChecked);
                $("#otherProgramItem").prop('required', isChecked);
		    });
        });

        $(function () {
        	$("#medical").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#transportation, #food, #fassist, #educational, #casha").prop("checked", false);
        		}
		    });
        	$("#transportation").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#medical, #food, #fassist, #educational, #casha").prop("checked", false);
        		}
		    });
        	$("#food").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#transportation, #medical, #fassist, #educational, #casha").prop("checked", false);
        		}
		    });
        	$("#fassist").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#transportation, #food, #medical, #educational, #casha").prop("checked", false);
        		}
		    });
        	$("#educational").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#transportation, #food, #fassist, #medical, #casha").prop("checked", false);
        		}
		    });
        	$("#casha").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#transportation, #food, #fassist, #educational, #medical").prop("checked", false);
        		}
		    });
        });
		
        $(function () {
        	$("#packs").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#items, #kits, #devices, #rice").prop("checked", false);
        		}
		    });
        	$("#items").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#packs, #kits, #devices, #rice").prop("checked", false);
        		}
		    });
        	$("#kits").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#items, #packs, #devices, #rice").prop("checked", false);
        		}
		    });
        	$("#devices").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#items, #kits, #packs, #rice").prop("checked", false);
        		}
		    });
        	$("#rice").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#items, #kits, #devices, #packs").prop("checked", false);
        		}
		    });
        });

        $(function () {
        	$("#d_speech").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#d_learning, #d_psychosocial, #d_deaf, #d_cancer, #d_mental, #d_visual, #d_intellectual, #d_physical, #d_rare").prop("checked", false);
        		}
		    });
        	$("#d_learning").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#d_speech, #d_psychosocial, #d_deaf, #d_cancer, #d_mental, #d_visual, #d_intellectual, #d_physical, #d_rare").prop("checked", false);
        		}
		    });
        	$("#d_psychosocial").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#d_learning, #d_speech, #d_deaf, #d_cancer, #d_mental, #d_visual, #d_intellectual, #d_physical, #d_rare").prop("checked", false);
        		}
		    });
        	$("#d_deaf").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#d_learning, #d_psychosocial, #d_speech, #d_cancer, #d_mental, #d_visual, #d_intellectual, #d_physical, #d_rare").prop("checked", false);
        		}
		    });
        	$("#d_cancer").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#d_learning, #d_psychosocial, #d_deaf, #d_speech, #d_mental, #d_visual, #d_intellectual, #d_physical, #d_rare").prop("checked", false);
        		}
		    });
        	$("#d_mental").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#d_learning, #d_psychosocial, #d_deaf, #d_cancer, #d_speech, #d_visual, #d_intellectual, #d_physical, #d_rare").prop("checked", false);
        		}
		    });
        	$("#d_visual").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#d_learning, #d_psychosocial, #d_deaf, #d_cancer, #d_mental, #d_speech, #d_intellectual, #d_physical, #d_rare").prop("checked", false);
        		}
		    });
        	$("#d_intellectual").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#d_learning, #d_psychosocial, #d_deaf, #d_cancer, #d_mental, #d_visual, #d_speech, #d_physical, #d_rare").prop("checked", false);
        		}
		    });
        	$("#d_physical").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#d_learning, #d_psychosocial, #d_deaf, #d_cancer, #d_mental, #d_visual, #d_intellectual, #d_speech, #d_rare").prop("checked", false);
        		}
		    });
        	$("#d_rare").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#d_learning, #d_psychosocial, #d_deaf, #d_cancer, #d_mental, #d_visual, #d_intellectual, #d_physical, #d_speech").prop("checked", false);
        		}
		    });
        });

        $(document).ready(function () {
            $(".currencyMaskedInput").inputmask({
                alias: "currency",
                prefix: "",
                rightAlign: false,
                groupSeparator: ",",
                autoGroup: true,
                digits: 2,
                allowMinus: false
            });
        });
    
        let familyData = [];

        window.onload = function() {
            // Get the family data from the hidden input field
            const familyDataJson = document.getElementById('familyDataInput').value;
            if (familyDataJson) {
                familyData = JSON.parse(familyDataJson); // Parse the JSON data into the array
                renderFamilyTable();  // Render the table with the fetched data
            }
        };
        function renderFamilyTable() {
            const table = document.getElementById('familyTable');
            table.innerHTML = ''; // Clear the table before rendering new rows

            familyData.forEach((member, index) => {
                const row = table.insertRow();

                row.innerHTML = `
                    <td style="border: 1px solid black;">${index + 1}</td>
                    <td style="border: 1px solid black;">${member.name}</td>
                    <td style="border: 1px solid black;">${member.relation_bene}</td>
                    <td style="border: 1px solid black;">${member.age}</td>
                    <td style="border: 1px solid black;">${member.occupation}</td>
                    <td style="border: 1px solid black;">${member.salary}</td>
                    <td style="border: 1px solid black;">
                        <button class="btn btn-danger" onclick="removeFamilyRow(this)">X</button>
                    </td>
                `;
            });
        }

        function addFamilyRow() {
            const name = document.getElementById('inputName').value;
            const relation_bene = document.getElementById('inputRelation').value;
            const age = document.getElementById('inputAge').value;
            const occupation = document.getElementById('inputOccupation').value;
            const salary = document.getElementById('inputSalary').value;

            if (!name || !relation_bene || !age || !occupation || !salary) {
                alert('Please fill in all the fields!');
                return;
            }

            // Create a family member object
            const familyMember = {
                name,
                relation_bene,
                age,
                occupation,
                salary
            };

            // Push the new family member to the familyData array
            familyData.push(familyMember);

            // Create a new row in the table
            const table = document.getElementById('familyTable');
            const row = table.insertRow();

            row.innerHTML = `
                <td style="border: 1px solid black; text-transform: uppercase;">${table.rows.length}</td>
                <td style="border: 1px solid black; text-transform: uppercase;">${name}</td>
                <td style="border: 1px solid black; text-transform: uppercase;">${relation_bene}</td>
                <td style="border: 1px solid black; text-transform: uppercase;">${age}</td>
                <td style="border: 1px solid black; text-transform: uppercase;">${occupation}</td>
                <td style="border: 1px solid black;" text-transform: uppercase;>${salary}</td>
                <td style="border: 1px solid black;"><button class="btn btn-danger" onclick="removeFamilyRow(this)">X</button></td>
            `;

            // Clear input fields
            clearInputs();

            // Reapply currency mask for the new added row's salary field
            applyCurrencyMask();
            sendFamilyDataToPHP();
        }

        // For removing a family member row
        function removeFamilyRow(button) {
            const row = button.closest('tr');
            if (row) row.remove();

            reSyncFamilyData();
            reindexRows();
            sendFamilyDataToPHP(); // <<< Add this!
        }

        // Apply currency mask to the salary field
        function applyCurrencyMask() {
            $(".currencyMaskedInput").inputmask({
                alias: "currency",
                prefix: "",
                rightAlign: false,
                groupSeparator: ",",
                autoGroup: true,
                digits: 2,
                allowMinus: false
            });
        }

        // Send family data to PHP for saving to a PHP array
        function sendFamilyDataToPHP() {
            const familyDataJSON = JSON.stringify(familyData);
            
            // Assign the JSON data to the hidden input
            document.getElementById('familyDataInput').value = familyDataJSON;

            // Submit the form
            document.getElementById('familyForm').submit();
        }

        // Clear all input fields after adding a new row
        function clearInputs() {
            document.getElementById('inputName').value = '';
            document.getElementById('inputRelation').value = '';
            document.getElementById('inputAge').value = '';
            document.getElementById('inputOccupation').value = '';
            document.getElementById('inputSalary').value = '';
        }

        function reindexRows() {
            const table = document.getElementById('familyTable');
            const rows = table.querySelectorAll('tr');
            rows.forEach((row, index) => {
                row.cells[0].textContent = index + 1; // Update the first cell with the correct index
            });
        }

        // Sync the familyData array with the table if a row is removed
        function reSyncFamilyData() {
            const rows = document.querySelectorAll('#familyTable tr');
            familyData = [];

            rows.forEach((row) => {
                const cells = row.cells;
                familyData.push({
                    name: cells[1].innerText,
                    relation_bene: cells[2].innerText,
                    age: cells[3].innerText,
                    occupation: cells[4].innerText,
                    salary: cells[5].innerText
                });
            });

            // After resync, send updated data again
            sendFamilyDataToPHP();
        }
    </script>
</html>