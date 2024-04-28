<?php
include('../php/class.user.php');
$user = new User();
    

if (isset($_GET['id'])) {
	$user->setsw($_SESSION['userId'], $_GET['id']);
	
    $id = $user->getClient_id($_GET['id']); //id sa client
    $user->servingstatus($_GET['id']); //update data as serving
    $client = $user->clientData($_GET['id']); //kuha sa mga data sa bene/client data
    $name = $client["lastname"] .", ". $client["firstname"] . " " . (!empty($client["middlename"])? $client["middlename"] . " ":"").(!empty($client['extraname'])?$client['extraname'] . ".":"");
    $bname = $client["b_lname"] . ", ". $client["b_fname"] . " " . (!empty($client["b_mname"])? $client["b_mname"] . " ":"").(!empty($client['b_exname'])?$client['b_exname'] . ".":"");
       
    $timeentry = $user->theTime($client['date_entered']);//kwaun ang time
    $client_assistance = $user->getGISAssistance($_GET['id']);
    $client_fam = $user->getclientFam($_GET['id']);
    $gis = $user->getGISData($_GET['id']); //kwaun ang mga data if ever naa na xay inputed data sa assessment/service only
    $fundsourcedata = $user->getfundsourcedata($_GET['id']);
    $soc_worker = $user->getuserInfo($_SESSION['userId']);
    //fullname of social worker
    $soc_workFullname = $soc_worker['empfname'] .' '.(!empty($soc_worker['empmname'][0])?$soc_worker['empmname'][0] . '. ':''). $soc_worker['emplname'] . (!empty($soc_worker['empext'])? ' ' . $soc_worker['empext'] . '.' : '');
    
    //Address
    $city = explode("/", $client['client_municipality']);
    $brgy = explode("/", $client['client_barangay']);
    $province = explode("/", $client['client_province']);
    $address['client'] = '';
    if (!empty($client['client_street'])) {
        $address['client'] .= $client['client_street'] . ", ";
    }
    $address['client'] .= $brgy[0] . ", " . $city[0] . ", " . $province[0];
    $city = explode("/", $client['b_municipality']);
    $brgy = explode("/", $client['b_barangay']);
    $province = explode("/", $client['b_province']);
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
		<link rel="icon" type="image/png" href="../images/icons/ciu.ico"/>
		<link rel="stylesheet" type="text/css" href="../css/gis.css">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"> 
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
        
        <script defer src="../js/solid.js"></script>
        <script defer src="../js/fontawesome.js"></script>
        <script src="../js/jquery.slim.min.js"></script>
        <script src="../js/popper.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../js/jquery-3.2.1.slim.min.js"></script>
        
        <script type="text/javascript" src="../js/main.js"></script>
        <script type="text/javascript" src="../js/jquery.min.js"></script>
        <script type="text/javascript" src="../js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../js/jquery.mask.min.js"></script>
        <script type="text/javascript" src="../js/PSGC.js"></script>
        <title>GIS</title>
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
                <div class="row">
                    <div class="col-12" >
                        <div class="card">
                            <div class="card border-info mb3" style="width:100%;">
                                <h5 class="card-header text-success">CLIENT SUB-CATEGORY</h5>
                                <div class="card-body">
                                    <div class="container" style="font-size: 15px;">
                                        <div class="row">
                                            <label class="col-sm-3 label" style="font-size: 18px">Sub-category:</label>
                                            <div class="col">
                                                <select type="text" id="c_subcat" class="form-control" name="c_subcat" required>
                                                    <option value="" <?php echo (empty($client['subCategory'])) ? "selected" : "" ?>>Select Client Subcategory </option>
                                                    <?php if($client["category"] == "Family Heads and Other Needy Adult"){ ?>
                                                    <option value="Victims of Disaster" <?php echo (($client['subCategory']) == "Victims of Disaster") ? "selected" : "" ?>>Victims of Disaster</option>
                                                    <option value="Internally Displaced Family" <?php echo (($client['subCategory']) == "Internally Displaced Family") ? "selected" : "" ?>>Internally Displaced Family</option>
                                                    <option value="Solo Parent" <?php echo (($client['subCategory']) == "Solo Parent") ? "selected" : "Solo Parent" ?>></option>
                                                    <option value="Victims of Illegal Recruitment" <?php echo (($client['subCategory']) == "Victims of Illegal Recruitment") ? "selected" : "" ?>>Victims of Illegal Recruitment</option>
                                                    <option value="Surrendered drug users" <?php echo (($client['subCategory']) == "Surrendered drug users") ? "selected" : "" ?>>Surrendered drug users</option>
                                                    <option value="Repatriated OFW" <?php echo (($client['subCategory']) == "Repatriated OFW") ? "selected" : "" ?>>Repatriated OFW</option>
                                                    <option value="Killed in Action (KIA)" <?php echo (($client["subCategory"]) == "Killed in Action (KIA)") ? "selected" : "" ?>>Killed in Action (KIA)</option>
                                                    <option value="Wounded in Action (WIA)" <?php echo (($client["subCategory"]) == "Wounded in Action (WIA)") ? "selected" : "" ?>>Wounded in Action (WIA)</option>
                                                    <option value="Indigenous People" <?php echo (($client["subCategory"]) == "Indigenous People") ? "selected" : "" ?>>Indigenous People</option>
                                                    <option value="Individuals with Cancer" <?php echo (($client["subCategory"]) == "Individuals with Cancer") ? "selected" : "" ?>>Individuals with Cancer</option>
                                                    <option value="Person of Concerns - Asylum Seeker" <?php echo (($client["subCategory"]) == "Person of Concerns - Asylum Seeker") ? "selected" : "" ?>>Person of Concerns - Asylum Seeker</option>
                                                    <option value="Former Rebels" <?php echo (($client["subCategory"]) == "Former Rebels") ? "selected" : "" ?>>Former Rebels</option>
                                                    <option value="Dialysis Patients" <?php echo (($client["subCategory"]) == "Dialysis Patients") ? "selected" : "" ?>>Dialysis Patients</option>
                                                    <option value="Tuberculosis Patients" <?php echo (($client["subCategory"]) == "Tuberculosis Patients") ? "selected" : "" ?>>Tuberculosis Patients</option>
                                                    <option value="Person of Concerns - Refugees" <?php echo (($client["subCategory"]) == "Person of Concerns - Refugees") ? "selected" : "" ?>>Person of Concerns - Refugees</option>
                                                    <option value="Person of Concerns - Stateless Persons" <?php echo (($client["subCategory"]) == "Person of Concerns - Stateless Persons") ? "selected" : "" ?>>Person of Concerns - Stateless Persons</option>
                                                    <?php } elseif ($client["category"] == "Men/Women in Specially Difficult Circumstances"){?>
                                                    <option value="Sexually-abused" <?php echo (($client["subCategory"]) == "Sexually-abused") ? "selected" : "" ?>>Sexually-abused</option>
                                                    <option value="Physically-abused/maltreated/battered" <?php echo (($client["subCategory"]) == "Physically-abused/maltreated/battered") ? "selected" : "" ?>>Physically-abused/maltreated/battered</option>
                                                    <option value="Victims of Illegal Recruitment" <?php echo (($client["subCategory"]) == "Victims of Illegal Recruitment") ? "selected" : "" ?>>Victims of Illegal Recruitment</option>
                                                    <option value="Victims of involuntary prostitution" <?php echo (($client["subCategory"]) == "Victims of involuntary prostitution") ? "selected" : "" ?>>Victims of involuntary prostitution</option>
                                                    <option value="Victims of armed conflict" <?php echo (($client["subCategory"]) == "Victims of armed conflict") ? "selected" : "" ?>>Victims of armed conflict</option>
                                                    <option value="Victims of trafficking" <?php echo (($client["subCategory"]) == "Victims of trafficking") ? "selected" : "" ?>>Victims of trafficking</option>
                                                    <option value="Others specify" <?php echo (($client["subCategory"]) == "Others specify") ? "selected" : "" ?>>Others specify</option>
                                                    <option value="Surrendered drug users" <?php echo (($client["subCategory"]) == "Surrendered drug users") ? "selected" : "" ?>>Surrendered drug users</option>
                                                    <option value="Repatriated OFW" <?php echo (($client["subCategory"]) == "Repatriated OFW") ? "selected" : "" ?>>Repatriated OFW</option>
                                                    <option value="Killed in Action (KIA)" <?php echo (($client["subCategory"]) == "Killed in Action (KIA)") ? "selected" : "" ?>>Killed in Action (KIA)</option>
                                                    <option value="Wounded in Action (WIA)" <?php echo (($client["subCategory"]) == "Wounded in Action (WIA)") ? "selected" : "" ?>>Wounded in Action (WIA)</option>
                                                    <option value="Indigenous People" <?php echo (($client["subCategory"]) == "Indigenous People") ? "selected" : "" ?>>Indigenous People</option>
                                                    <option value="Individuals with Cancer" <?php echo (($client["subCategory"]) == "Individuals with Cancer") ? "selected" : "" ?>>Individuals with Cancer</option>
                                                    <option value="Person of Concerns - Asylum Seeker" <?php echo (($client["subCategory"]) == "Person of Concerns - Asylum Seeker") ? "selected" : "" ?>>Person of Concerns - Asylum Seeker</option>
                                                    <option value="Former Rebels" <?php echo (($client["subCategory"]) == "Former Rebels") ? "selected" : "" ?>>Former Rebels</option>
                                                    <option value="Dialysis Patients" <?php echo (($client["subCategory"]) == "Dialysis Patients") ? "selected" : "" ?>>Dialysis Patients</option>
                                                    <option value="Tuberculosis Patients" <?php echo (($client["subCategory"]) == "Tuberculosis Patients") ? "selected" : "" ?>>Tuberculosis Patients</option>
                                                    <option value="Person of Concerns - Refugees" <?php echo (($client["subCategory"]) == "Person of Concerns - Refugees") ? "selected" : "" ?>>Person of Concerns - Refugees</option>
                                                    <option value="Person of Concerns - Stateless Persons" <?php echo (($client["subCategory"]) == "Person of Concerns - Stateless Persons") ? "selected" : "" ?>>Person of Concerns - Stateless Persons</option>
                                                    <?php } elseif ($client["category"] == "Children in Need of Special Protection"){?>
                                                    <option value="Abandoned" <?php echo (($client["subCategory"]) == "Abandoned") ? "selected" : "" ?>>Abandoned</option>
                                                    <option value="Neglected" <?php echo (($client["subCategory"]) == "Neglected") ? "selected" : "" ?>>Neglected</option>
                                                    <option value="Voluntary Committed/Surrendered" <?php echo (($client["subCategory"]) == "Voluntary Committed/Surrendered") ? "selected" : "" ?>>Voluntary Committed/Surrendered</option>
                                                    <option value="Sexually-Abused" <?php echo (($client["subCategory"]) == "Sexually-Abused") ? "selected" : "" ?>>Sexually-Abused</option>
                                                    <option value="Sexually-Exploited" <?php echo (($client["subCategory"]) == "Sexually-Exploited") ? "selected" : "" ?>>Sexually-Exploited</option>
                                                    <option value="Physically-abused/maltreated/battered" <?php echo (($client["subCategory"]) == "Physically-abused/maltreated/battered") ? "selected" : "" ?>>Physically-abused/maltreated/battered</option>
                                                    <option value="Children in Situations of Armed Conflict" <?php echo (($client["subCategory"]) == "Children in Situations of Armed Conflict") ? "selected" : "" ?>>Children in Situations of Armed Conflict</option>
                                                    <option value="Victims of Child Labor" <?php echo (($client["subCategory"]) == "Victims of Child Labor") ? "selected" : "" ?>>Victims of Child Labor</option>
                                                    <option value="Victims of Child Trafficking" <?php echo (($client["subCategory"]) == "Victims of Child Trafficking") ? "selected" : "" ?>>Victims of Child Trafficking</option>
                                                    <option value="Street Children" <?php echo (($client["subCategory"]) == "Street Children") ? "selected" : "" ?>>Street Children</option>
                                                    <option value="Victims of Illegal Recruitment" <?php echo (($client["subCategory"]) == "Victims of Illegal Recruitment") ? "selected" : "" ?>>Victims of Illegal Recruitment</option>
                                                    <option value="Children with HIV/AIDS" <?php echo (($client["subCategory"]) == "Children with HIV/AIDS") ? "selected" : "" ?>>Children with HIV/AIDS</option>
                                                    <option value="Children with Disabilities" <?php echo (($client["subCategory"]) == "Children with Disabilities") ? "selected" : "" ?>>Children with Disabilities</option>
                                                    <option value="Children in Conflict with the Law (CICL)" <?php echo (($client["subCategory"]) == "Children in Conflict with the Law (CICL)") ? "selected" : "" ?>>Children in Conflict with the Law (CICL)</option>
                                                    <option value="Surrendered drug users" <?php echo (($client["subCategory"]) == "Surrendered drug users") ? "selected" : "" ?>>Surrendered drug users</option>
                                                    <option value="Repatriated OFW" <?php echo (($client["subCategory"]) == "Repatriated OFW") ? "selected" : "" ?>>Repatriated OFW</option>
                                                    <option value="Killed in Action (KIA)" <?php echo (($client["subCategory"]) == "Killed in Action (KIA)") ? "selected" : "" ?>>Killed in Action (KIA)</option>
                                                    <option value="Wounded in Action (WIA)" <?php echo (($client["subCategory"]) == "Wounded in Action (WIA)") ? "selected" : "" ?>>Wounded in Action (WIA)</option>
                                                    <option value="Indigenous People" <?php echo (($client["subCategory"]) == "Indigenous People") ? "selected" : "" ?>>Indigenous People</option>
                                                    <option value="Individuals with Cancer" <?php echo (($client["subCategory"]) == "Individuals with Cancer") ? "selected" : "" ?>>Individuals with Cancer</option>
                                                    <option value="Person of Concerns - Asylum Seeker" <?php echo (($client["subCategory"]) == "Person of Concerns - Asylum Seeker") ? "selected" : "" ?>>Person of Concerns - Asylum Seeker</option>
                                                    <option value="Former Rebels" <?php echo (($client["subCategory"]) == "Former Rebels") ? "selected" : "" ?>>Former Rebels</option>
                                                    <option value="Dialysis Patients" <?php echo (($client["subCategory"]) == "Dialysis Patients") ? "selected" : "" ?>>Dialysis Patients</option>
                                                    <option value="Tuberculosis Patients" <?php echo (($client["subCategory"]) == "Tuberculosis Patients") ? "selected" : "" ?>>Tuberculosis Patients</option>
                                                    <option value="Person of Concerns - Refugees" <?php echo (($client["subCategory"]) == "Person of Concerns - Refugees") ? "selected" : "" ?>>Person of Concerns - Refugees</option>
                                                    <option value="Person of Concerns - Stateless Persons" <?php echo (($client["subCategory"]) == "Person of Concerns - Stateless Persons") ? "selected" : "" ?>>Person of Concerns - Stateless Persons</option>
                                                    <?php } elseif ($client["category"] == "Youth"){?>
                                                    <option value="Children in Conflict with the Law (9 to < 18 yrs. old)" <?php echo (($client["subCategory"]) == "Children in Conflict with the Law (9 to < 18 yrs. old)") ? "selected" : "" ?>>Children in Conflict with the Law (9 to < 18 yrs. old)</option>
                                                    <option value="Out of School Youth" <?php echo (($client["subCategory"]) == "Out of School Youth") ? "selected" : "" ?>>Out of School Youth</option>
                                                    <option value="Pre-delinquent Youth" <?php echo (($client["subCategory"]) == "Pre-delinquent Youth") ? "selected" : "" ?>>Pre-delinquent Youth</option>
                                                    <option value="Victims of Illegal Recruitment" <?php echo (($client["subCategory"]) == "Victims of Illegal Recruitment") ? "selected" : "" ?>>Victims of Illegal Recruitment</option>
                                                    <option value="Surrendered drug users" <?php echo (($client["subCategory"]) == "Surrendered drug users") ? "selected" : "" ?>>Surrendered drug users</option>
                                                    <option value="Repatriated OFW" <?php echo (($client["subCategory"]) == "Repatriated OFW") ? "selected" : "" ?>>Repatriated OFW</option>
                                                    <option value="Killed in Action (KIA)" <?php echo (($client["subCategory"]) == "Killed in Action (KIA)") ? "selected" : "" ?>>Killed in Action (KIA)</option>
                                                    <option value="Wounded in Action (WIA)" <?php echo (($client["subCategory"]) == "Wounded in Action (WIA)") ? "selected" : "" ?>>Wounded in Action (WIA)</option>
                                                    <option value="Student" <?php echo (($client["subCategory"]) == "Student") ? "selected" : "" ?>>Student</option>
                                                    <option value="Indigenous People" <?php echo (($client["subCategory"]) == "Indigenous People") ? "selected" : "" ?>>Indigenous People</option>
                                                    <option value="Individuals with Cancer" <?php echo (($client["subCategory"]) == "Individuals with Cancer") ? "selected" : "" ?>>Individuals with Cancer</option>
                                                    <option value="Person of Concerns - Asylum Seeker" <?php echo (($client["subCategory"]) == "Person of Concerns - Asylum Seeker") ? "selected" : "" ?>>Person of Concerns - Asylum Seeker</option>
                                                    <option value="Former Rebels" <?php echo (($client["subCategory"]) == "Former Rebels") ? "selected" : "" ?>>Former Rebels</option>
                                                    <option value="Dialysis Patients" <?php echo (($client["subCategory"]) == "Dialysis Patients") ? "selected" : "" ?>>Dialysis Patients</option>
                                                    <option value="Tuberculosis Patients" <?php echo (($client["subCategory"]) == "Tuberculosis Patients") ? "selected" : "" ?>>Tuberculosis Patients</option>
                                                    <option value="Person of Concerns - Refugees" <?php echo (($client["subCategory"]) == "Person of Concerns - Refugees") ? "selected" : "" ?>>Person of Concerns - Refugees</option>
                                                    <option value="Person of Concerns - Stateless Persons" <?php echo (($client["subCategory"]) == "Person of Concerns - Stateless Persons") ? "selected" : "" ?>>Person of Concerns - Stateless Persons</option>
                                                    <?php } elseif ($client["category"] == "Senior Citizens" || ($client["category"] == "Senior Citizens (no subcategories)")){?>
                                                    <option value="Indigenous People" <?php echo (($client["subCategory"]) == "Indigenous People") ? "selected" : "" ?>>Indigenous People</option>
                                                    <option value="Individuals with Cancer" <?php echo (($client["subCategory"]) == "Individuals with Cancer") ? "selected" : "" ?>>Individuals with Cancer</option>
                                                    <option value="Person of Concerns - Asylum Seeker" <?php echo (($client["subCategory"]) == "Person of Concerns - Asylum Seeker") ? "selected" : "" ?>>Person of Concerns - Asylum Seeker</option>
                                                    <option value="Former Rebels" <?php echo (($client["subCategory"]) == "Former Rebels") ? "selected" : "" ?>>Former Rebels</option>
                                                    <option value="Dialysis Patients" <?php echo (($client["subCategory"]) == "Dialysis Patients") ? "selected" : "" ?>>Dialysis Patients</option>
                                                    <option value="Tuberculosis Patients" <?php echo (($client["subCategory"]) == "Tuberculosis Patients") ? "selected" : "" ?>>Tuberculosis Patients</option>
                                                    <option value="Person of Concerns - Refugees" <?php echo (($client["subCategory"]) == "Person of Concerns - Refugees") ? "selected" : "" ?>>Person of Concerns - Refugees</option>
                                                    <option value="Person of Concerns - Stateless Persons" <?php echo (($client["subCategory"]) == "Person of Concerns - Stateless Persons") ? "selected" : "" ?>>Person of Concerns - Stateless Persons</option>
                                                    <?php } elseif ($client["category"] == "Persons with Disabilities"){?>
                                                    <option value="Orthopedically handicapped" <?php echo (($client["subCategory"]) == "Orthopedically handicapped") ? "selected" : "" ?>>Orthopedically handicapped</option>
                                                    <option value="Hearing/Speech impaired" <?php echo (($client["subCategory"]) == "Hearing/Speech impaired") ? "selected" : "" ?>>Hearing/Speech impaired</option>
                                                    <option value="Visually impaired" <?php echo (($client["subCategory"]) == "Visually impaired") ? "selected" : "" ?>>Visually impaired</option>
                                                    <option value="Mentally challenged" <?php echo (($client["subCategory"]) == "Mentally challenged") ? "selected" : "" ?>>Mentally challenged</option>
                                                    <option value="Others specify" <?php echo (($client["subCategory"]) == "Others specify") ? "selected" : "" ?>>Others specify</option>
                                                    <option value="Victims of Illegal Recruitment" <?php echo (($client["subCategory"]) == "Victims of Illegal Recruitment") ? "selected" : "" ?>>Victims of Illegal Recruitment</option>
                                                    <option value="Surrendered drug users" <?php echo (($client["subCategory"]) == "Surrendered drug users") ? "selected" : "" ?>>Surrendered drug users</option>
                                                    <option value="Repatriated OFW" <?php echo (($client["subCategory"]) == "Repatriated OFW") ? "selected" : "" ?>>Repatriated OFW</option>
                                                    <option value="Killed in Action (KIA)" <?php echo (($client["subCategory"]) == "Killed in Action (KIA)") ? "selected" : "" ?>>Killed in Action (KIA)</option>
                                                    <option value="Wounded in Action (WIA)" <?php echo (($client["subCategory"]) == "Wounded in Action (WIA)") ? "selected" : "" ?>>Wounded in Action (WIA)</option>
                                                    <option value="Mental Disabilities" <?php echo (($client["subCategory"]) == "Mental Disabilities") ? "selected" : "" ?>>Mental Disabilities</option>
                                                    <option value="Indigenous People" <?php echo (($client["subCategory"]) == "Indigenous People") ? "selected" : "" ?>>Indigenous People</option>
                                                    <option value="Individuals with Cancer" <?php echo (($client["subCategory"]) == "Individuals with Cancer") ? "selected" : "" ?>>Individuals with Cancer</option>
                                                    <option value="Person of Concerns - Asylum Seeker" <?php echo (($client["subCategory"]) == "Person of Concerns - Asylum Seeker") ? "selected" : "" ?>>Person of Concerns - Asylum Seeker</option>
                                                    <option value="Former Rebels" <?php echo (($client["subCategory"]) == "Former Rebels") ? "selected" : "" ?>>Former Rebels</option>
                                                    <option value="Dialysis Patients" <?php echo (($client["subCategory"]) == "Dialysis Patients") ? "selected" : "" ?>>Dialysis Patients</option>
                                                    <option value="Tuberculosis Patients" <?php echo (($client["subCategory"]) == "Tuberculosis Patients") ? "selected" : "" ?>>Tuberculosis Patients</option>
                                                    <option value="Person of Concerns - Refugees" <?php echo (($client["subCategory"]) == "Person of Concerns - Refugees") ? "selected" : "" ?>>Person of Concerns - Refugees</option>
                                                    <option value="Person of Concerns - Stateless Persons" <?php echo (($client["subCategory"]) == "Person of Concerns - Stateless Persons") ? "selected" : "" ?>>Person of Concerns - Stateless Persons</option>
                                                    <?php } elseif ($client["category"] == "Persons Living with HIV/AIDS"){?>
                                                    <option value="Individuals with Cancer" <?php echo (($client["subCategory"]) == "Individuals with Cancer") ? "selected" : "" ?>>Individuals with Cancer</option>
                                                    <option value="Indigenous People" <?php echo (($client["subCategory"]) == "Indigenous People") ? "selected" : "" ?>>Indigenous People</option>
                                                    <option value="Tuberculosis Patients" <?php echo (($client["subCategory"]) == "Tuberculosis Patients") ? "selected" : "" ?>>Tuberculosis Patients</option>
                                                    <option value="Person of Concerns - Asylum Seeker" <?php echo (($client["subCategory"]) == "Person of Concerns - Asylum Seeker") ? "selected" : "" ?>>Person of Concerns - Asylum Seeker</option>
                                                    <option value="Former Rebels" <?php echo (($client["subCategory"]) == "Former Rebels") ? "selected" : "" ?>>Former Rebels</option>
                                                    <option value="Dialysis Patients" <?php echo (($client["subCategory"]) == "Dialysis Patients") ? "selected" : "" ?>>Dialysis Patients</option>
                                                    <option value="Person of Concerns - Refugees" <?php echo (($client["subCategory"]) == "Person of Concerns - Refugees") ? "selected" : "" ?>>Person of Concerns - Refugees</option>
                                                    <option value="Person of Concerns - Stateless Persons" <?php echo (($client["subCategory"]) == "Person of Concerns - Stateless Persons") ? "selected" : "" ?>>Person of Concerns - Stateless Persons</option>
                                                    <?php }?>
                                                    <option value="NONE OF THE ABOVE" <?php echo (($client["subCategory"]) == "NONE OF THE ABOVE") ? "selected" : "" ?>>NONE OF THE ABOVE</option>
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
                    <div class=col-6>
                        <div class="card">
                            <div class="card border-info mb3" style="width:100%;">
                                <h5 class="card-header text-success">TARGET SECTOR</h5>
                                <div class="card-body">
                                    <div class="container" style="font-size: 15px;">
                                        <div class="row" style="margin-bottom:7px;">
                                            <div class="col-1" style="margin-top:3px;"><input type="checkbox" class="lg" name="fhona" id="fhona" value="1" <?php echo $gis['target_sector']==1? "checked": ""; ?>></div>
                                            <div class="col-11"> FAMILY HEADS, AND OTHER NEEDY ADULTS (FHONA)</div>
                                        </div>
                                        <div class="row" style="margin-bottom:7px;">
                                            <div class="col-1" style="margin-top:3px;"><input type="checkbox" class="lg" name="wedc" id="wedc" value="2" <?php echo $gis['target_sector']==2? "checked": ""; ?>></div>
                                            <div class="col-11"> WOMEN IN ESPECIALLY DIFFICULT CIRCUMSTRANCES (WEDC)</div>
                                        </div>
                                        <div class="row" style="margin-bottom:7px;">
                                            <div class="col-1" style="margin-top:3px;"><input type="checkbox" class="lg" name="pwd" id="pwd" value="3" <?php echo $gis['target_sector']==3? "checked": ""; ?>></div>
                                            <div class="col-11"> PERSON WITH DISABILITIES (PWD)</div>
                                        </div>
                                        <div class="row" style="margin-bottom:7px;">
                                            <div class="col-1" style="margin-top:3px;"><input type="checkbox" class="lg" name="youth" id="youth" value="4" <?php echo $gis['target_sector']==4? "checked": ""; ?>></div>
                                            <div class="col-11"> YOUTH IN NEED OF SPECIAL PROTECTION (YNSP)</div>
                                        </div>
                                        <div class="row" style="margin-bottom:7px;">
                                            <div class="col-1" style="margin-top:3px;"><input type="checkbox" class="lg"  name="sc" id="sc" value="5" <?php echo $gis['target_sector']==5? "checked": ""; ?>></div>
                                            <div class="col-11"> SENIOR CITIZEN (SC)</div>
                                        </div>
                                        <div class="row" style="margin-bottom:7px;">
                                            <div class="col-1" style="margin-top:3px;"><input type="checkbox" class="lg"  name="plwhiv" id="plwhiv" value="6" <?php echo $gis['target_sector']==6? "checked": ""; ?>></div>
                                            <div class="col-11"> PERSON LIVING WITH HIV(PLWHIV)</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-1" style="margin-top:3px;"><input type="checkbox" class="lg"  name="cnsp" id="cnsp" value="7" <?php echo $gis['target_sector']==7? "checked": ""; ?>></div>
                                            <div class="col-11"> CHILDREN IN NEED OF SPECIAL PROTECTION (CNSP)</div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                    <div class=col-6>
                        <div class="card">
                            <div class="card border-info mb3" style="width:100%;">
                                <h5 class="card-header text-success">SPECIFY SUB-CATEGORY</h5>
                                <div class="card-body">
                                    <div class="container">
                                        <div class="row" style="margin-bottom:7px;">
                                            <div class="col-1" style="margin-top:5px;"><input type="checkbox" class="lg" name="solo" id="solo" value="1" <?php echo $gis['subcat_ass']==1? "checked": ""; ?>></div>
                                            <div class="col-11"> SOLO PARENTS</div>
                                        </div>
                                        <div class="row" style="margin-bottom:7px;">
                                            <div class="col-1" style="margin-top:5px;"><input type="checkbox" class="lg" name="ip" id="ip" value="2" <?php echo $gis['subcat_ass']==2? "checked": ""; ?>></div>
                                            <div class="col-11"> INDIGENOUS PEOPLE</div>
                                        </div>
                                        <div class="row" style="margin-bottom:7px;">
                                            <div class="col-1" style="margin-top:5px;"><input type="checkbox" class="lg" name="drug" id="drug" value="3" <?php echo $gis['subcat_ass']==3? "checked": ""; ?>></div>
                                            <div class="col-11"> RECOVERING PERSON WHO USED DRUGS</div>
                                        </div>
                                        <div class="row" style="margin-bottom:7px;">
                                            <div class="col-1" style="margin-top:5px;"><input type="checkbox" class="lg" name="4ps" id="4ps" value="4" <?php echo $gis['subcat_ass']==4? "checked": ""; ?>></div>
                                            <div class="col-11"> 4PS DSWD BENEFICIARY</div>
                                        </div>
                                        <div class="row" style="margin-bottom:7px;">
                                            <div class="col-1" style="margin-top:5px;"><input type="checkbox" class="lg"  name="dwell" id="dwell" value="5" <?php echo $gis['subcat_ass']==5? "checked": ""; ?>></div>
                                            <div class="col-11"> STREET DWELLERS</div>
                                        </div>
                                        <div class="row" style="margin-bottom:7px;">
                                            <div class="col-1" style="margin-top:5px;"><input type="checkbox" class="lg" name="mental" id="mental" value="6" <?php echo $gis['subcat_ass']==6? "checked": ""; ?>></div>
                                            <div class="col-11"> PSYCHOSOCIAL/MENTAL/LEARNING DISABILITY</div>
                                        </div>
                                        <div class="row" style="margin-bottom:7px;">
                                            <div class="col-1" style="margin-top:5px;"><input type="checkbox" class="lg" name="asylum" id="asylum" value="7" <?php echo $gis['subcat_ass']==7? "checked": ""; ?>></div>
                                            <div class="col-11"> STATELESS PERSONS/ASYLUM SEEKERS/REFUGEES</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-1" style="margin-top:5px;"><input type="checkbox" style="padding" class="lg" name="osc" id="osc" value="8" <?php echo $gis['subcat_ass']==8? "checked": ""; ?>></div>
                                            <div class="col-11"> OTHERS: <input type="text" class="lg" style="border-radius: 3px 3px 3px 3px; width: 60%; height: 23px;" name="osc_val" id="osc_val" value=" <?php echo !empty($gis['others_subcat'])? $gis['others_subcat']: ""; ?>"></div>
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
                                    <div class="row text-center" style="margin-bottom: 5px;">
                                        <div class="col-1"></div>
                                        <div class="col-3">Pangalan</div>
                                        <div class="col-2">Relasyon</div>
                                        <div class="col-1">Edad</div>
                                        <div class="col-3">Trabaho</div>
                                        <div class="col-2">Buwanang Sahod</div> 
                                    </div>
                                    <div class="row">
                                        <div class="col-1 text-center">1:</div>
                                        <div class="col-3"><input class="form-control" id="p1" name="p1" type="text"    value="<?php echo empty($client_fam[1]) ? "" : $client_fam[1]['name'] ?>"></div>
                                        <div class="col-2"><input class="form-control" id="rb1" name="rb1" type="text"    value="<?php echo empty($client_fam[1]) ? "" : $client_fam[1]['relation_bene'] ?>"></div>
                                        <div class="col-1"><input type= "number" class="form-control" id="e1" name="e1" max="99" onKeyPress="if(this.value.length==3) return false;" value="<?php echo empty($client_fam[1])||$client_fam[1]['age']==0? "" : $client_fam[1]['age'] ?>"></div>
                                        <div class="col-3"><input class="form-control" id="t1" name="t1" type="text"    value="<?php echo empty($client_fam[1]) ? "" : $client_fam[1]['occupation'] ?>"></div>
                                        <div class="col-2"><input class="form-control" onkeypress="return rangeKey(event)" id="b1" name="b1" value="<?php echo empty($client_fam[1]) ? "" : $client_fam[1]['salary'] ?>"></div>  
                                    </div><br>
                                    <div class="row">
                                        <div class="col-1 text-center">2:</div>
                                        <div class="col-3"><input class="form-control" id="p2" name="p2" type="text"    value="<?php echo empty($client_fam[2]) ? "" : $client_fam[2]['name'] ?>"></div>
                                        <div class="col-2"><input class="form-control" id="rb2" name="rb2" type="text"    value="<?php echo empty($client_fam[2]) ? "" : $client_fam[2]['relation_bene'] ?>"></div>
                                        <div class="col-1"><input type= "number" class="form-control" id="e2" name="e2" max="99" onKeyPress="if(this.value.length==3) return false;" value="<?php echo empty($client_fam[2])||$client_fam[2]['age']==0? "" : $client_fam[2]['age'] ?>"></div>
                                        <div class="col-3"><input class="form-control" id="t2" name="t2" type="text"    value="<?php echo empty($client_fam[2]) ? "" : $client_fam[2]['occupation'] ?>"></div>
                                        <div class="col-2"><input class="form-control" onkeypress="return rangeKey(event)" id="b2" name="b2" value="<?php echo empty($client_fam[2]) ? "" : $client_fam[2]['salary'] ?>"></div>  
                                    </div><br>
                                    <div class="row">
                                        <div class="col-1 text-center">3:</div>
                                        <div class="col-3"><input class="form-control" id="p3" name="p3" type="text"    value="<?php echo empty($client_fam[3]) ? "" : $client_fam[3]['name'] ?>"></div>
                                        <div class="col-2"><input class="form-control" id="rb3" name="rb3" type="text"    value="<?php echo empty($client_fam[3]) ? "" : $client_fam[3]['relation_bene'] ?>"></div>
                                        <div class="col-1"><input type= "number" class="form-control" id="e3" name="e3" max="99" onKeyPress="if(this.value.length==3) return false;" value="<?php echo empty($client_fam[3])||$client_fam[3]['age']==0? "" : $client_fam[3]['age'] ?>"></div>
                                        <div class="col-3"><input class="form-control" id="t3" name="t3" type="text"    value="<?php echo empty($client_fam[3]) ? "" : $client_fam[3]['occupation'] ?>"></div>
                                        <div class="col-2"><input class="form-control" onkeypress="return rangeKey(event)" id="b3" name="b3" value="<?php echo empty($client_fam[3]) ? "" : $client_fam[3]['salary'] ?>"></div>  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div><br>

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
                                                    <option value="Food Subsidy Assistance" <?php echo (strtolower($client_assistance[1]['type']) == "food subsidy assistance") ? "selected" : "" ?>>Food Subsidy Assistance</option>
                                                    <option value="Medical Assistance" <?php echo (strtolower($client_assistance[1]['type']) == "medical assistance") ? "selected" : "" ?>>Medical Assistance</option>
                                                    <option value="Funeral Assistance" <?php echo (strtolower($client_assistance[1]['type']) == "funeral assistance") ? "selected" : "" ?>>Funeral Assistance</option>
                                                    <option value="Transportation Assistance" <?php echo (strtolower($client_assistance[1]['type']) == "transportation assistance") ? "selected" : "" ?>>Transportation Assistance</option>
                                                    <option value="Educational Assistance" <?php echo (strtolower($client_assistance[1]['type']) == "educational assistance") ? "selected" : "" ?>>Educational Assistance</option>
                                                    <option value="Other Cash Assistance" <?php echo (strtolower($client_assistance[1]['type']) == "other cash assistance") ? "selected" : "" ?>>Other Cash Assistance</option>
                                                    <option value="Material Assistance" <?php echo (strtolower($client_assistance[1]['type']) == "material assistance") ? "selected" : "" ?>>Material Assistance</option>
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
                                            <div class="col-1" style="margin-top:3px;"><input type="checkbox" class="lg" name="hb" id="hb" value="1" <?php echo (strtolower($client_assistance[1]['type'])=="medical assistance"?($client_assistance[1]['if_medical']==1 ? "checked": ""):"") ?>></div>
                                            <div class="col-11"> Hospital Bill</div>
                                        </div>
                                        <div class="row" style="margin-bottom:7px;">
                                            <div class="col-1" style="margin-top:3px;"><input type="checkbox" class="lg" name="medicine" id="medicine" value="2" <?php echo (strtolower($client_assistance[1]['type'])=="medical assistance"?($client_assistance[1]['if_medical']==2 ? "checked": ""):"") ?>></div>
                                            <div class="col-11"> Medicines</div>
                                        </div>
                                        <div class="row" style="margin-bottom:7px;">
                                            <div class="col-1" style="margin-top:3px;"><input type="checkbox" class="lg" name="chemo" id="chemo" value="3" <?php echo (strtolower($client_assistance[1]['type'])=="medical assistance"?($client_assistance[1]['if_medical']==3 ? "checked": ""):"") ?>></div>
                                            <div class="col-11"> Chemotheraphy</div>
                                        </div>
                                        <div class="row" style="margin-bottom:7px;">
                                            <div class="col-1" style="margin-top:3px;"><input type="checkbox" class="lg" name="dia" id="dia" value="4" <?php echo (strtolower($client_assistance[1]['type'])=="medical assistance"?($client_assistance[1]['if_medical']==4 ? "checked": ""):"") ?>></div>
                                            <div class="col-11"> Dialysis</div>
                                        </div>
                                        <div class="row" style="margin-bottom:7px;">
                                            <div class="col-1" style="margin-top:3px;"><input type="checkbox" class="lg"  name="procedure" id="procedure" value="5" <?php echo (strtolower($client_assistance[1]['type'])=="medical assistance"?($client_assistance[1]['if_medical']==5 ? "checked": ""):"") ?>></div>
                                            <div class="col-11"> Procedures</div>
                                        </div>
                                        <div class="row" style="margin-bottom:7px;">
                                            <div class="col-1" style="margin-top:3px;"><input type="checkbox" class="lg"  name="laboratory" id="laboratory" value="6" <?php echo (strtolower($client_assistance[1]['type'])=="medical assistance"?($client_assistance[1]['if_medical']==6 ? "checked": ""):"") ?>></div>
                                            <div class="col-11"> Laboratory</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-1" style="margin-top:3px;"><input type="checkbox" class="lg"  name="implant" id="implant" value="7" <?php echo (strtolower($client_assistance[1]['type'])=="medical assistance"?($client_assistance[1]['if_medical']==7 ? "checked": ""):"") ?>></div>
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
                                        <div class="row" style="margin-bottom:7px;">
                                            <div class="col-1" style="margin-top:3px;"><input type="checkbox" class="lg" name="fb" id="fb" value="1" <?php echo (strtolower($client_assistance[1]['type'])=="funeral assistance"?($client_assistance[1]['if_burial']==1 ? "checked": ""):"") ?>></div>
                                            <div class="col-11"> Funeral Bill</div>
                                        </div>
                                        <div class="row" style="margin-bottom:7px;">
                                            <div class="col-1" style="margin-top:3px;"><input type="checkbox" class="lg" name="toc" id="toc" value="2" <?php echo (strtolower($client_assistance[1]['type'])=="funeral assistance"?($client_assistance[1]['if_burial']==2 ? "checked": ""):"") ?>></div>
                                            <div class="col-11"> Transfer of Cadever</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-1" style="margin-top:3px;"><input type="checkbox" class="lg" name="interment" id="interment" value="3" <?php echo (strtolower($client_assistance[1]['type'])=="funeral assistance"?($client_assistance[1]['if_burial']==3 ? "checked": ""):"") ?>></div>
                                            <div class="col-11"> Interment</div>
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
                                            <div class="col-1" style="margin-top:3px;"><input type="checkbox" class="lg" name="medical" id="medical" value="1" <?php echo ($client_assistance[1]['financial']==1 ? "checked": "") ?>></div>
                                            <div class="col-11"> Medical Assistance</div>
                                        </div>
                                        <div class="row" style="margin-bottom:7px;">
                                            <div class="col-1" style="margin-top:3px;"><input type="checkbox" class="lg" name="transportation" id="transportation" value="2" <?php echo ($client_assistance[1]['financial']==2 ? "checked": "") ?>></div>
                                            <div class="col-11"> Transportation Assistance</div>
                                        </div>
                                        <div class="row" style="margin-bottom:7px;">
                                            <div class="col-1" style="margin-top:3px;"><input type="checkbox" class="lg" name="food" id="food" value="3" <?php echo ($client_assistance[1]['financial']==3 ? "checked": "") ?>></div>
                                            <div class="col-11"> Food Assistance</div>
                                        </div>
                                        <div class="row" style="margin-bottom:7px;">
                                            <div class="col-1" style="margin-top:3px;"><input type="checkbox" class="lg" name="fassist" id="fassist" value="4" <?php echo ($client_assistance[1]['financial']==4 ? "checked": "") ?>></div>
                                            <div class="col-11"> Funeral Assistance</div>
                                        </div>
                                        <div class="row" style="margin-bottom:7px;">
                                            <div class="col-1" style="margin-top:3px;"><input type="checkbox" class="lg"  name="educational" id="educational" value="5" <?php echo ($client_assistance[1]['financial']==5 ? "checked": "") ?>></div>
                                            <div class="col-11"> Educational Assistance</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-1" style="margin-top:3px;"><input type="checkbox" class="lg"  name="casha" id="casha" value="6" <?php echo ($client_assistance[1]['financial']==6 ? "checked": "") ?>></div>
                                            <div class="col-11"> Cash Assistance or Other Support Technologies</div>
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
                                            <div class="col-1" style="margin-top:3px;"><input type="checkbox" class="lg" name="packs" id="packs" value="1" <?php echo ($client_assistance[1]['material']==1 ? "checked": "") ?>></div>
                                            <div class="col-11"> Family Food Packs</div>
                                        </div>
                                        <div class="row" style="margin-bottom:7px;">
                                            <div class="col-1" style="margin-top:3px;"><input type="checkbox" class="lg" name="items" id="items" value="2" <?php echo ($client_assistance[1]['material']==2 ? "checked": "") ?>></div>
                                            <div class="col-11"> Other Food Items</div>
                                        </div>
                                        <div class="row" style="margin-bottom:7px;">
                                            <div class="col-1" style="margin-top:3px;"><input type="checkbox" class="lg" name="kits" id="kits" value="3" <?php echo ($client_assistance[1]['material']==3 ? "checked": "") ?>></div>
                                            <div class="col-11"> Hygiene or Sleeping Kits</div>
                                        </div>
                                        <div class="row" style="margin-bottom:7px;">
                                            <div class="col-1" style="margin-top:3px;"><input type="checkbox" class="lg" name="devices" id="devices" value="4" <?php echo ($client_assistance[1]['material']==4 ? "checked": "") ?>></div>
                                            <div class="col-11"> Assistive Devices and Technologies</div>
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
								<label class="col-sm-3 label text-left" style="font-size: 17px">PSYCHOSOCIAL SUPPORT:</label>
                                <div class="col-3">
									<input type="checkbox" id="group" class="col-lg-1" name="pfa" value="pfa" <?php echo $gis['service5']==0? "": "checked"; ?> required> &nbsp; Psychological First Aid (PFA)
								</div>&nbsp;
                                <div class="col-1"></div>
                                <div class="col-3">
									<input type="checkbox" id="group" class="col-lg-1" name="counseling" value="Counseling" <?php echo $gis['service6']==0? "": "checked";; ?> required> &nbsp; Social Work Counseling
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
                            <h5 class="text-dark">Assistance: </h5>
                            <div class="row"> 
                                <div class="col text-center">PURPOSE</div>
                                <div class="col-2 text-center">AMOUNT</div>
                                <div class="col-2 text-center">MODE ASSISTANCE</div>
                                <div class="col-2 text-center">FUND SOURCE</div> 
                                <div class="col-1 text-center"> </div> 
                            </div>
                            <div class="row"> 
                                <div class="col"><input class="form-control" id="pur1" name="pur1" type="text" <?php echo empty($client_assistance[1])? "" : "onkeyup='verifyfirst()'" ?> required value="<?php echo empty($client_assistance[1])? "" : $client_assistance[1]['purpose']; ?>"></div>
                                <div class="col-2"><input class="form-control money" id="a1" name="a1" <?php echo empty($client_assistance[1])? "" : "onkeyup='verifyfirst()'" ?> required value="<?php echo empty($client_assistance[1])? "" : $client_assistance[1]['amount']; ?>"></div>
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
                                    <input list="chargings" class="form-control" id = "fundf1" name="f1" type="text" <?php echo empty($client_assistance[1]) ? "" : "onkeyup='verifyfirst()'" ?> value="<?php echo empty($client_assistance[1])? "" : (empty($fundsourcedata[2]['fundsource'])?$fundsourcedata[1]['fundsource']:$fundsourcedata[1]['fundsource'].'/'.$fundsourcedata[2]['fundsource'].''.(!empty($fundsourcedata[3]['fundsource'])?'/'.$fundsourcedata[3]['fundsource']:"").''.(!empty($fundsourcedata[4]['fundsource'])?'/'.$fundsourcedata[4]['fundsource']:"").''.(!empty($fundsourcedata[5]['fundsource'])?'/'.$fundsourcedata[5]['fundsource']:"")) ?>" required/>
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
                                    <?php echo $user->chargings(); ?>
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
                                        <!-- <option value="<?php //echo empty($gis['gis_option'])?'':$gis['gis_option'] ?>" <?php //echo empty($gis['gis_option'])?'disabled':'' ?> selected><?php //echo empty($gis['gis_option'])?'Select your option':$gis['gis_option'] ?></option>; -->
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
                                    <label>Social Work Assessment</label>
                                    <textarea class="form-control"  style="height:120px;font-size:12px;margin-top:-8px" type="text" id="ass" name="ass" id="type" required><?php echo empty($gis['soc_ass'])? "" : $gis['soc_ass']; ?></textarea>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 15px">
                                <label class="col-sm-2 label" style="font-size: 20px">Approved by:</label>
                                <div class="col-sm-4">
                                    <input list="signatory" type="text" class="form-control mr-sm-2" id="approved1" name="approved1" required value="<?php echo (empty($gis['signatory_id']) ? '' : $user->getSignatoryFullname($gis['signatory_id'])); ?>" required>
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
        
        <!--Mga Potang inang script-->
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
                var maoni= document.getElementById('assess').value;
                document.getElementById('selection').value = maoni;  
                //console.log(maoni);
                $.ajax({
                    type: "post", //method to use
                    url: "fetch.php", //ginapasa  sa diri nga file and data
                    data: {putangina : maoni}, //mao ni nga data
                    success: function(html){  //If result found, this funtion will be call
                        //console.log(html);   
                
                        var json = JSON.parse(html);
                        $('#ass').val(json["sw_assessment"]);
                        $('#prob').val( json["problem_presented"]);
                        //console.log(json);
                                                                    
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
                        window.location='home.php';
                    }
                });
            }

            //When ma click and edit client kani ang mo run
            $('#clientdata').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var userid = button.data('id') // Extract info from data-* attributes
                var modal = $(this);
                var dataString = 'id=' + userid;
                //console.log(dataString);
                $.ajax({
                    type: "GET",
                    url: "showClientData.php",
                    data: dataString,
                    cache: false,
                    success: function (data) {
                        //console.log(data);
                        modal.find('.showClientData').html(data);
                    },
                    error: function(err) {
                        //console.log(err);
                    }
                });  
            });

            //When ma click and edit beneficiary na button kani ang mo run
            $('#benedata').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var userid = button.data('id') // Extract info from data-* attributes
                var modal = $(this);
                var dataString = 'id=' + userid;
                //console.log(dataString);
                $.ajax({
                    type: "GET",
                    url: "showBene.php",
                    data: dataString,
                    cache: false,
                    success: function (data) {
                        //console.log(data);
                        modal.find('.showBene').html(data);
                    },
                    error: function(err) {
                        //console.log(err);
                    }
                });  
            });

            //pag e click ang add bene kung wa syay bene
            $('#add_benedata').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var userid = button.data('id') // Extract info from data-* attributes
                var modal = $(this);
                var dataString = 'id=' + userid;
                //console.log(dataString);
                $.ajax({
                    type: "GET",
                    url: "addBene.php",
                    data: dataString,
                    cache: false,
                    success: function (data) {
                        //console.log(data);
                        modal.find('.showBene').html(data);
                    },
                    error: function(err) {
                        //console.log(err);
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
                //console.log(charCode);
                    if (charCode != 46 && charCode != 45 && charCode > 31
                    && (charCode < 48 || charCode > 57))
                    return false;

                return true;
            }

            /*************** CHECK BOX REQUIRED ATLEAST 1 *****************/
            if(document.getElementById('update')){
                var checkboxes = $('input[type="checkbox"][id="group"]');
                checkboxes.removeAttr('required');
                if(!checkboxes.is(':checked')) {
                    checkboxes.attr('required', 'required'); //once naay ma checkan tangalun ang required attr.
                }
                
            }
            $('input[type="checkbox"][id="group"]').on('click', function(e) {
                var n = $( "input:checked" ).length;
                var checkboxes = $('input[type="checkbox"][id="group"]');
                if((checkboxes.is(':checked') && n >= 1)) {
                    checkboxes.removeAttr('required'); //once naay ma checkan tangalun ang required attr.
                } else {
                    checkboxes.attr('required', 'required'); //pag way na check. syempre required
                }
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
        if (isset($_POST['save'])) {
            $empid = $_SESSION['userId']; // id sa social worker
            $trans_id = $_GET['id'];
            $csubcat = $_POST['c_subcat'];

            //FAMILY DATA
            $p1="";$p2="";$p3="";$e1="";$e2="";$e3="";$t1="";$t2="";$t3="";$b1="";$b2="";$b3=""; //blank sa una 

            if(isset($_POST['p1'])){
                $p1 = mysqli_real_escape_string($user->db, strtoupper($_POST['p1']));
                $rb1 = mysqli_real_escape_string($user->db, strtoupper($_POST['rb1']));
                $e1 = $_POST['e1'];
                $t1 = mysqli_real_escape_string($user->db, strtoupper($_POST['t1']));
                $b1 = mysqli_real_escape_string($user->db, $_POST['b1']);
            }

            if(isset($_POST['p2'])){
                $p2 = mysqli_real_escape_string($user->db, strtoupper($_POST['p2']));
                $rb2 = mysqli_real_escape_string($user->db, strtoupper($_POST['rb2']));
                $e2 = $_POST['e2'];
                $t2 = mysqli_real_escape_string($user->db, strtoupper($_POST['t2']));
                $b2 = mysqli_real_escape_string($user->db, $_POST['b2']);
            }

            if(isset($_POST['p3'])){
                $p3 = mysqli_real_escape_string($user->db, strtoupper($_POST['p3']));
                $rb3 = mysqli_real_escape_string($user->db, strtoupper($_POST['rb3']));
                $e3 = $_POST['e3'];
                $t3 = mysqli_real_escape_string($user->db, strtoupper($_POST['t3']));
                $b3 = mysqli_real_escape_string($user->db, $_POST['b3']);
            }
            
            //SERVICE TABLE DATA's
            $ref_name = "";
            $s1 = 0;
            $s2 = 0;
            $s3 = 0;
            $s4 = 0;
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
			
            //Assistance TAble Data's
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
            if ($_POST['type2'] == "") {
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
            $prob = mysqli_real_escape_string($user->db, strtoupper($_POST["prob"]));
            $ass = mysqli_real_escape_string($user->db, strtoupper($_POST["ass"]));
            
            $signatoryGIS = $_POST["approved"]; //signatory approved
            $fund1 = "";
            $fund2 = "";
            $fund3 = "";
            $fund4 = "";
            $fund5 = "";
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
            if(isset($_POST['fhona'])){$targets = 1;}
            if(isset($_POST['wedc'])){$targets = 2;}
            if(isset($_POST['pwd'])){$targets = 3;}
            if(isset($_POST['youth'])){$targets = 4;}
            if(isset($_POST['sc'])){$targets = 5;}
            if(isset($_POST['plwhiv'])){$targets = 6;}
            if(isset($_POST['cnsp'])){$targets = 7;}
            
            if(isset($_POST['solo'])){$subcat = 1;}
            if(isset($_POST['ip'])){$subcat = 2;}
            if(isset($_POST['drug'])){$subcat = 3;}
            if(isset($_POST['4ps'])){$subcat = 4;}
            if(isset($_POST['dwell'])){$subcat = 5;}
            if(isset($_POST['mental'])){$subcat = 6;}
            if(isset($_POST['asylum'])){$subcat = 7;}
            if(isset($_POST['osc'])){$subcat = 8;}
            
            $others_subcat = "";
            if (!empty($_POST['osc_val'])){$others_subcat = trim($_POST['osc_val']);}

            
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
				if(isset($_POST['fb'])){$if_burial = 1;}
				if(isset($_POST['toc'])){$if_burial = 2;}
				if(isset($_POST['interment'])){$if_burial = 3;}
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

            // print_r($_POST);
            // once save the data of new -> client
            $user->insertGIS($empid, $trans_id, $csubcat, $id, $p1, $p2, $p3, $rb1, $rb2, $rb3, $e1, $e2, $e3, $t1, $t2, $t3, $b1, $b2, $b3, $s1, $s2, $s3, $s4, $s5, $s6, $rl1, $rl2, $rl3, $ref_name,
                                $type1, $pur1, $a1, $m1, $f1,$type2, $pur2, $a2, $m2, $f2, $mode_ad, $num, $gis_opt, $prob, $ass, $signatoryGIS,
                                $fund1, $fund2, $fund3, $fund4, $fund5, $fund6, $fund7, $fund8, $fund9, $fund10, $fund11, $fund12, $targets, $subcat, $others_subcat, $if_medical, $if_burial, $financial, $material);
        }

        if (isset($_POST['update'])) {
            $empid = $_SESSION['userId']; // id sa social worker
            $trans_id = $_GET['id'];
            $csubcat = $_POST['c_subcat'];
            
            //FAMILY DATA's
            $p1="";$p2="";$p3="";$e1="";$e2="";$e3="";$t1="";$t2="";$t3="";$b1="";$b2="";$b3=""; //blank sa una 

            if(isset($_POST['p1'])){
                $p1 = mysqli_real_escape_string($user->db, trim(strtoupper($_POST['p1'])));
                $rb1 = mysqli_real_escape_string($user->db, trim(strtoupper($_POST['rb1'])));
                $e1 = $_POST['e1'];
                $t1 = mysqli_real_escape_string($user->db, trim(strtoupper($_POST['t1'])));
                $b1 = mysqli_real_escape_string($user->db, $_POST['b1']);
            }

            if(isset($_POST['p2'])){
                $p2 = mysqli_real_escape_string($user->db, trim(strtoupper($_POST['p2'])));
                $rb2 = mysqli_real_escape_string($user->db, trim(strtoupper($_POST['rb2'])));
                $e2 = $_POST['e2'];
                $t2 = mysqli_real_escape_string($user->db, trim(strtoupper($_POST['t2'])));
                $b2 = mysqli_real_escape_string($user->db, $_POST['b2']);
            }

            if(isset($_POST['p3'])){
                $p3 = mysqli_real_escape_string($user->db, trim(strtoupper($_POST['p3'])));
                $rb3 = mysqli_real_escape_string($user->db, trim(strtoupper($_POST['rb3'])));
                $e3 = $_POST['e3'];
                $t3 = mysqli_real_escape_string($user->db, trim(strtoupper($_POST['t3'])));
                $b3 = mysqli_real_escape_string($user->db, $_POST['b3']);
            }
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
                echo $f1 = mysqli_real_escape_string($user->db, strtoupper($_POST["f1"]));
            }
            if ($_POST['type2'] == "") {
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
            $prob = mysqli_real_escape_string($user->db, strtoupper($_POST["prob"]));
            $ass = mysqli_real_escape_string($user->db, strtoupper($_POST["ass"]));
            
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
            if(isset($_POST['fhona'])){$targets = 1;}
            if(isset($_POST['wedc'])){$targets = 2;}
            if(isset($_POST['pwd'])){$targets = 3;}
            if(isset($_POST['youth'])){$targets = 4;}
            if(isset($_POST['sc'])){$targets = 5;}
            if(isset($_POST['plwhiv'])){$targets = 6;}
            if(isset($_POST['cnsp'])){$targets = 7;}
            
            if(isset($_POST['solo'])){$subcat = 1;}
            if(isset($_POST['ip'])){$subcat = 2;}
            if(isset($_POST['drug'])){$subcat = 3;}
            if(isset($_POST['4ps'])){$subcat = 4;}
            if(isset($_POST['dwell'])){$subcat = 5;}
            if(isset($_POST['mental'])){$subcat = 6;}
            if(isset($_POST['asylum'])){$subcat = 7;}
            if(isset($_POST['osc'])){$subcat = 8;}
            
            $others_subcat = "";
            if (!empty($_POST['osc_val'])){$others_subcat = trim($_POST['osc_val']);}

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
				if(isset($_POST['fb'])){$if_burial = 1;}
				if(isset($_POST['toc'])){$if_burial = 2;}
				if(isset($_POST['interment'])){$if_burial = 3;}
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

            //once save the data of new -> client
            $user->updateGIS($empid, $trans_id, $csubcat, $id, $p1, $p2, $p3, $rb1, $rb2, $rb3, $e1, $e2, $e3, $t1, $t2, $t3, $b1, $b2, $b3, $s1, $s2, $s3, $s4, $s5, $s6, $rl1, $rl2, $rl3, $ref_name,
            $type1, $pur1, $a1, $m1, $f1,$type2, $pur2, $a2, $m2, $f2, $mode_ad, $num, $gis_opt, $prob, $ass, $signatoryGIS, 
            $fund1, $fund2, $fund3, $fund4, $fund5, $fund6, $fund7, $fund8, $fund9, $fund10, $fund11, $fund12, $targets, $subcat, $others_subcat, $if_medical, $if_burial, $financial, $material);
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
            

            $user->updateClient($id, $lname, $mname, $fname, $exname, $bday, $sex, 
                            $region, $province, $municipality, $barangay, $street, $district);
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
            $s_category = mysqli_real_escape_string($user->db, ($_POST['s_category']));
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
                            $bday, $category, $s_category, $sex, $status, $contact,
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
            $s_category = mysqli_real_escape_string($user->db, ($_POST['s_category']));
            $sex = mysqli_real_escape_string($user->db, ($_POST['sex']));
            $status = mysqli_real_escape_string($user->db, ($_POST['status']));
            $contact = mysqli_real_escape_string($user->db, ($_POST['contact']));
            
            $region = mysqli_real_escape_string($user->db, ($_POST['region']));
            $province = mysqli_real_escape_string($user->db, ($_POST['province']));
            $municipality = mysqli_real_escape_string($user->db, ($_POST['municipality']));
            $barangay = mysqli_real_escape_string($user->db, ($_POST['barangay']));
            $district = mysqli_real_escape_string($user->db, ($_POST['district']));
            $street = mysqli_real_escape_string($user->db, ($_POST['street']));
            //print_r($_POST);
            $user->addBene($trans_id, $relation, $lname, $mname, $fname, $exname, 
                            $bday, $category, $s_category, $sex, $status, $contact,
                            $region, $province, $municipality, $barangay, $district, $street);

        }

        ?>
    </body>
    <script type="text/javascript">
        function verifyfirst(){
            t1 = '<?php echo $client_assistance[1]['type'] ?>';
            p1 = '<?php echo $client_assistance[1]['purpose'] ?>';
            a1 = '<?php echo $client_assistance[1]['amount'] ?>';
            m1 = '<?php echo $client_assistance[1]['mode'] ?>';
            f1 = '<?php echo $client_assistance[1]['fund'] ?>';
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
            t1 = '<?php echo $client_assistance[2]['type'] ?>';
            p1 = '<?php echo $client_assistance[2]['purpose'] ?>';
            a1 = '<?php echo $client_assistance[2]['amount'] ?>';
            m1 = '<?php echo $client_assistance[2]['mode'] ?>';
            f1 = '<?php echo $client_assistance[2]['fund'] ?>';
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

    </script>

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
                                <input list="chargings" placeholder="Fund Source 1" value="<?php echo (!empty($fundsourcedata[1]['fundsource'])?$fundsourcedata[1]['fundsource']:'') ?>" id="fs1" name="fs1" type="text" class="form-control" required>
                                <label class="active" for="fs1">Fund Source</label>
                            </div>
                            <div class="form-group col-lg-6">
                                <input list="chargings" placeholder="Fund Source 2" value="<?php echo (!empty($fundsourcedata[2]['fundsource'])?$fundsourcedata[2]['fundsource']:'') ?>" id="fs2" name="fs2" type="text" class="form-control" required disabled>
                                <label class="active" for="fs2">Fund Source</label>
                            </div>
                            <div class="form-group col-lg-6">
                                <input list="chargings" placeholder="Fund Source 3" value="<?php echo (!empty($fundsourcedata[3]['fundsource'])?$fundsourcedata[3]['fundsource']:'') ?>" id="fs3" name="fs3" type="text" class="form-control" required disabled>
                                <label class="active" for="fs3">Fund Source</label>
                            </div>
                            <div class="form-group col-lg-6">
                                <input list="chargings" placeholder="Fund Source 4" value="<?php echo (!empty($fundsourcedata[4]['fundsource'])?$fundsourcedata[4]['fundsource']:'') ?>" id="fs4" name="fs4" type="text" class="form-control" required disabled>
                                <label class="active" for="fs4">Fund Source</label>
                            </div>
                            <div class="form-group col-lg-6">
                                <input list="chargings" placeholder="Fund Source 5" value="<?php echo (!empty($fundsourcedata[5]['fundsource'])?$fundsourcedata[5]['fundsource']:'') ?>" id="fs5" name="fs5" type text class="form-control " required disabled>
                                <label class="active" for="fs5">Fund Source</label>
                            </div>
                            <div class="form-group col-lg-6">
                                <input list="chargings" placeholder="Fund Source 6" value="<?php echo (!empty($fundsourcedata[6]['fundsource'])?$fundsourcedata[6]['fundsource']:'') ?>" id="fs6" name="fs6" type text class="form-control " required disabled>
                                <label class="active" for="fs6">Fund Source</label>
                            </div>
                            <div class="form-group col-lg-6">
                                <input list="chargings" placeholder="Fund Source 7" value="<?php echo (!empty($fundsourcedata[7]['fundsource'])?$fundsourcedata[7]['fundsource']:'') ?>" id="fs7" name="fs7" type text class="form-control " required disabled>
                                <label class="active" for="fs7">Fund Source</label>
                            </div>
                            <div class="form-group col-lg-6">
                                <input list="chargings" placeholder="Fund Source 8" value="<?php echo (!empty($fundsourcedata[8]['fundsource'])?$fundsourcedata[8]['fundsource']:'') ?>" id="fs8" name="fs8" type text class="form-control " required disabled>
                                <label class="active" for="fs8">Fund Source</label>
                            </div>
                            <div class="form-group col-lg-6">
                                <input list="chargings" placeholder="Fund Source 9" value="<?php echo (!empty($fundsourcedata[9]['fundsource'])?$fundsourcedata[9]['fundsource']:'') ?>" id="fs9" name="fs9" type text class="form-control " required disabled>
                                <label class="active" for="fs9">Fund Source</label>
                            </div>
                            <div class="form-group col-lg-6">
                                <input list="chargings" placeholder="Fund Source 10" value="<?php echo (!empty($fundsourcedata[10]['fundsource'])?$fundsourcedata[10]['fundsource']:'') ?>" id="fs10" name="fs10" type text class="form-control " required disabled>
                                <label class="active" for="fs10">Fund Source</label>
                            </div>
                            <div class="form-group col-lg-6">
                                <input list="chargings" placeholder="Fund Source 11" value="<?php echo (!empty($fundsourcedata[11]['fundsource'])?$fundsourcedata[11]['fundsource']:'') ?>" id="fs11" name="fs11" type text class="form-control " required disabled>
                                <label class="active" for="fs11">Fund Source</label>
                            </div>
                            <div class="form-group col-lg-6">
                                <input list="chargings" placeholder="Fund Source 12" value="<?php echo (!empty($fundsourcedata[12]['fundsource'])?$fundsourcedata[12]['fundsource']:'') ?>" id="fs12" name="fs12" type text class="form-control " required disabled>
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
            $("#fundf1").keyup(function(){
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
            $("#fs1").keyup(function(){
                f1 = document.getElementById("fs1").value;
                // console.log(f1);
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
            $("#fs2").keyup(function(){
                f2 = document.getElementById("fs2").value;
                // console.log(f2);
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
            $("#fs3").keyup(function(){
                f3 = document.getElementById("fs3").value;
                // console.log(f3);
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
            $("#fs4").keyup(function(){
                f4 = document.getElementById("fs4").value;
                // console.log(f4);
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
            $("#fs5").keyup(function(){
                f5 = document.getElementById("fs5").value;
                // console.log(f5);
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
            $("#fs6").keyup(function(){
                f6 = document.getElementById("fs6").value;
                // console.log(f6);
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
            $("#fs7").keyup(function(){
                f7 = document.getElementById("fs7").value;
                // console.log(f7);
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
            $("#fs8").keyup(function(){
                f8 = document.getElementById("fs8").value;
                // console.log(f8);
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
            $("#fs9").keyup(function(){
                f9 = document.getElementById("fs9").value;
                // console.log(f9);
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
            $("#fs10").keyup(function(){
                f10 = document.getElementById("fs10").value;
                // console.log(f10);
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
            $("#fs11").keyup(function(){
                f11 = document.getElementById("fs11").value;
                // console.log(f4);
			    document.getElementById('fsof11').value = f11;
                $("#fs12").attr('disabled', false);
            });
        });
        $(document).ready(function(){
            if(document.getElementById("fs12").value != ''){
                f12 = document.getElementById("fs12").value;
                document.getElementById('fsof12').value = f12;
            }
            $("#fs12").keyup(function(){
                f12 = document.getElementById("fs12").value;
                // console.log(f12);
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
    	     		$("#wedc, #pwd, #youth, #sc, #plwhiv, #cnsp").prop("checked", false);
        		}
		    });
        	$("#wedc").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#fhona, #pwd, #youth, #sc, #plwhiv, #cnsp").prop("checked", false);
        		}
		    });
        	$("#pwd").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#wedc, #fhona, #youth, #sc, #plwhiv, #cnsp").prop("checked", false);
        		}
		    });
        	$("#youth").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#wedc, #pwd, #fhona, #sc, #plwhiv, #cnsp").prop("checked", false);
        		}
		    });
        	$("#sc").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#wedc, #pwd, #youth, #fhona, #plwhiv, #cnsp").prop("checked", false);
        		}
		    });
        	$("#plwhiv").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#wedc, #pwd, #youth, #sc, #fhona, #cnsp").prop("checked", false);
        		}
		    });
        	$("#cnsp").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#wedc, #pwd, #youth, #sc, #plwhiv, #fhona").prop("checked", false);
        		}
		    });
        });
        
        $(function () {
        	$("#solo").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#ip, #drug, #4ps, #dwell, #mental, #asylum, #osc").prop("checked", false);
        		}
		    });
        	$("#ip").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#solo, #drug, #4ps, #dwell, #mental, #asylum, #osc").prop("checked", false);
        		}
		    });
        	$("#drug").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#ip, #solo, #4ps, #dwell, #mental, #asylum, #osc").prop("checked", false);
        		}
		    });
        	$("#4ps").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#ip, #drug, #solo, #dwell, #mental, #asylum, #osc").prop("checked", false);
        		}
		    });
        	$("#dwell").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#ip, #drug, #4ps, #solo, #mental, #asylum, #osc").prop("checked", false);
        		}
		    });
        	$("#mental").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#ip, #drug, #4ps, #dwell, #solo, #asylum, #osc").prop("checked", false);
        		}
		    });
        	$("#asylum").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#ip, #drug, #4ps, #dwell, #mental, #solo, #osc").prop("checked", false);
        		}
		    });
        	$("#osc").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#ip, #drug, #4ps, #dwell, #mental, #asylum, #solo").prop("checked", false);
        		}
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
    	     		$("#items, #kits, #devices").prop("checked", false);
        		}
		    });
        	$("#items").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#packs, #kits, #devices").prop("checked", false);
        		}
		    });
        	$("#kits").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#items, #packs, #devices").prop("checked", false);
        		}
		    });
        	$("#devices").click(function () {
	        	if ($(this).prop("checked")) {
    	     		$("#items, #kits, #packs").prop("checked", false);
        		}
		    });
        });
    </script>
</html>