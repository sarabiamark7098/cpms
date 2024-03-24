<?php 
    include('../php/class.user.php');
    $user = new User();
    
    if(isset($_GET['id'])){
        $transid = $_GET['id'];
    }

    $clientid = $user->getClient_id($_GET['id']);
    $client = $user->showallClientdata($transid);
    $rec_amount = 50001;
    $name = $client["lastname"].", ". $client["firstname"]." ". $client["middlename"];
    
    if(!empty($client['extraname'])){
		$name .= " ". $client['extraname'].".";
    }
    $coename = $client['firstname']." ";
    if(!empty($client['middlename'])){
        if($client['middlename'] != " "){
            $coename .= $client['middlename'][0].". ";
        }
    }
    $coename .= $client['lastname']." ";
    if(!empty($client['extraname'])){ 
		$coename .= " ". $client['extraname'] .".";
    }
    $clientAge = $user->getAge($client['date_birth']);
	
    $bname = $client["b_lname"].", ". $client["b_fname"]." ". $client["b_mname"];
	if(!empty($client['b_exname'])){
		$bname .= $client['b_exname'].".";
    }
    
    $coebname = $client['b_fname']." ";
    if(!empty($client['b_mname'])){
        if($client['b_mname'] != " "){
            $coebname .= $client['b_mname'][0].". ";
        }
    }
    $coebname .= $client['b_lname']." ";
    if(!empty($client['b_exname'])){
		$coebname .= " ". $client['b_exname'].".";
    }
    $beneAge = $user->getAge($client['b_bday']);

    // $_SESSION["client_id_assess"] = $_GET["id"];
    $timeentry = $user->theTime($client['date_entered']);
    $gis = $user->getGISData($transid);
    $client_assistance = $user->getGISAssistance($transid);
    // print_r($client_assistance);
    $soc_worker = $user->getuserInfo($client['encoded_socialWork']);
    $soc_workerFullname = $soc_worker['empfname'].' '.(!empty($soc_worker['empmname'][0])?$soc_worker['empmname'][0].'. ':"").$soc_worker['emplname'].(!empty($soc_worker['empext'])?' '.$soc_worker['empext'].".":"");
	$fundsourcedata = $user->getfundsourcedata($transid);
    $encoder = $user->getuserInfo($client['encoded_encoder']);
    $signatory = $user->show_signatory_data($client['signatory_id']);
    $glsignatory = $user->show_signatory_data($client['signatory_GL']);
    $Ccity = explode("/", $client['client_municipality']);
	$Cbrgy = explode("/", $client['client_barangay']);
	$Cprovince = explode("/", $client['client_province']);
    $address['client'] = '';
	if(!empty($client['client_street'])){
		$address['client'] .= $client['client_street'] .", ";
	}
	$address['client'] .=  $Cbrgy[0] .", ". $Ccity[0] .", ". $Cprovince[0];
    $Bcity = explode("/", $client['b_municipality']);$Bbrgy = explode("/", $client['b_barangay']);$Bprovince = explode("/", $client['b_province']);
    $address['beneficiary'] = '';
	if(!empty($client['b_street'])){
		$address['beneficiary'] .= $client['b_street'] .", ";
	}
	$address['beneficiary'] .= $Bbrgy[0] .", ". $Bcity[0].", ". $Bprovince[0];
    
    $client_fam = $user->getclientFam($transid);
    $cash = $user->getCash($transid);
    $cash_add = $Cbrgy[0] .', '. $Ccity[0]; 
    $gl = $user->getGL($transid);
    $coe = $user->getCOEData($transid);
	$reconsignatory = $user->show_signatory_data($client['signatory_GL']);
	$reconsignatoryName = strtoupper((!empty($reconsignatory['name_title'])?$reconsignatory['name_title'] .". ":""). $reconsignatory['first_name'] ." ". (!empty($reconsignatory['middle_I'])?$reconsignatory['middle_I'] .". ":""). $reconsignatory['last_name']);
    $funds1 = "";
    $signatoryName = strtoupper((!empty($signatory['name_title'])?$signatory['name_title'] .". ":""). $signatory['first_name'] ." ". (!empty($signatory['middle_I'])?$signatory['middle_I'] .". ":""). $signatory['last_name']);
    $signatoryposition = (!empty($signatory['position'])?$signatory['position'] ." ":"");
    $glsignatoryname = strtoupper((!empty($glsignatory['name_title'])?$glsignatory['name_title'] .". ":""). $glsignatory['first_name'] ." ". (!empty($glsignatory['middle_I'])?$glsignatory['middle_I'] .". ":""). $glsignatory['last_name']);
    $glsignatoryposition = (!empty($glsignatory['position'])?$glsignatory['position'] ." ":"");
    if(!empty($client_assistance[1])){
        if(empty($fundsourcedata[2]['fundsource'])){
            $funds1 = $fundsourcedata[1]['fundsource'];
        } else {
            $funds1 = $fundsourcedata[1]['fundsource'].'/'.$fundsourcedata[2]['fundsource'];
        }
        if(!empty($fundsourcedata[3]['fundsource'])){
            $funds1 .= '/'.$fundsourcedata[3]['fundsource'];
        }
        if(!empty($fundsourcedata[4]['fundsource'])){
            $funds1 .= '/'.$fundsourcedata[4]['fundsource'];
        }
        if (!empty($fundsourcedata[5]['fundsource'])) {
            $funds1 .= '/'.$fundsourcedata[5]['fundsource'];
        }
        // $funds1 = "CURRENT FUND";
    }
    $am = (str_replace(",","",$client_assistance[1]['amount']));
    if(!empty($client_assistance[2]['amount'])){
        if($client_assistance[2]['amount'] != ""){
            $am2 = (str_replace(",","",$client_assistance[2]['amount']));
        }
    }
    
    if($am >= $rec_amount){
        if($coe){
            $COEsignatoryini= $user->getinitialsSignatory($client['signatory_id']); //kwaun ang data sa signatory using sign_id 
        }
    }
    $GLsignatoryini= $user->getinitialsSignatory($client['signatory_GL']); //kwaun ang data sa signatory using sign_id 

    if(!$_SESSION['login']){
		header('Location:../index.php');
		}

    $mode1 = "";
    $mode2 = "";
    
    $mode1 = $client_assistance[1]["mode"];
    if(!empty($client_assistance[2]["mode"])){
        $mode2 = $client_assistance[2]["mode"];
    }

    // print_r($client_assistance);
    // print_r($client_assistance[1]["mode"]);
?>
<!DOCTYPE>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link rel="icon" type="image/png" href="../images/icons/ciu.ico"/>
		<link rel="stylesheet" type="text/css" href="../css/gis.css">
        <link rel="stylesheet" type="text/css" href="../css/coe.css">
		<link rel="stylesheet" type="text/css" href="../css/main.css">
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">	
		
		<script defer src="../js/solid.js"></script>
		<script defer src="../js/fontawesome.js"></script>
		<script src="../js/jquery.slim.min.js"></script>
		<script src="../js/popper.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../js/jquery-3.2.1.slim.min.js"></script>
		<script type="text/javascript" src="../js/main.js"></script>
		<script type="text/javascript" src="../js/PSGC.js"></script>
		<script type="text/javascript" src="../js/jquery.min.js"></script>
		
		<!-- added -->
		<script type="text/javascript" src="../js/bootstrap-3.3.7.min.js"></script>
        <script type="text/javascript" src="../js/jquery.mask.min.js"></script>
		
    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-dark" style="position: fixed; width: 100%;  z-index:100; background: #6d7fcc;">
        <a href="home.php"><img src="../images/dswd-logo_final.png" class="img-responsive" alt="unkown" width="200" height="55"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        
    </nav>
	<script>
		function printGIS(){

            var divElements = document.getElementById('gis').innerHTML;
            //Get the HTML of whole page
            var oldPage = document.body.innerHTML;
            //Reset the page's HTML with div's HTML only
            document.body.innerHTML = 
            "<html><head><title></title></head><body>" + 
            divElements + "</body>";
            //Print Page
            window.print();
            //Restore orignal HTML
            document.body.innerHTML = oldPage;

		}
        function printCOE(){
            var divElements = document.getElementById('coe').innerHTML;
            //Get the HTML of whole page
            var oldPage = document.body.innerHTML;
            //Reset the page's HTML with div's HTML only
            document.body.innerHTML = 
            "<html><head><title></title></head><body>" + 
            divElements + "</body>";
            //Print Page
            window.print();
            //Restore orignal HTML
            document.body.innerHTML = oldPage;
        }
        function printGL(){
            var divElements = $('#GL').html();
            //Get the HTML of whole page
            var oldPage = document.body.innerHTML;
            //Reset the page's HTML with div's HTML only
            document.body.innerHTML = 
            "<html><head><title></title></head><body>" + 
            divElements + "</body>";
            //Print Page
            window.print();
            //Restore orignal HTML
            document.body.innerHTML = oldPage;
        }

        function printCAV(){
            var divElements = $('#CAV').html();
            //Get the HTML of whole page
            var oldPage = document.body.innerHTML;
            //Reset the page's HTML with div's HTML only
            document.body.innerHTML = 
            "<html><head><title></title></head><body>" + 
            divElements + "</body>";
            //Print Page
            window.print();
            //Restore orignal HTML
            document.body.innerHTML = oldPage;
        }
    </script>
        <br><br><br><br><br> 
        <div class="row">
            <div class="col-1"></div>
            <div class="col"> <a type="button" href="home.php" class="btn btn-primary btn-block no-print"><span class="fa fa-reply"></span> BACK</a></div>
            <div class="col-9"></div>
        </div>
    <br><br><br>
    <div class="container">
        <div class="row">
            <h3>Client Name: <?php echo $name?></h3>
        </div>
        <br>
        <div class="form-group row">
            <div class="card border-info mb3" style="width:100%">
                <h4 class="card-header text-success">Reprinting of Documents</h4>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col"> <button class="btn btn-primary btn-block no-print" onclick="printGIS()">GIS</button></div>
                        <div class="col"> <button class="btn btn-primary btn-block no-print" onclick="printCOE()">COE</button></div>
                        <div class="col"> <button class="btn btn-<?php echo (strtolower($client_assistance[1]["mode"])=="gl")?"success":"dark" ?> btn-block no-print" onclick="printGL()" <?php echo (strtolower($client_assistance[1]["mode"])=="gl")?"":"disabled" ?>>GL</button></div>
                        <div class="col"> <button class="btn btn-<?php echo (strtolower($client_assistance[1]["mode"])=="cash" || strtolower($client_assistance[2]["mode"])=="cash")?"success":"dark" ?> btn-block no-print" onclick="printCAV()" <?php echo (strtolower($client_assistance[1]["mode"])=="cash" || strtolower($client_assistance[2]["mode"])=="cash")?"":"disabled" ?>>CASH</button></div>
                    </div>  
                </div>
            </div>
        </div>
    </div>
    <div id="gis" hidden>
        
        <?php // include('gis_sheet.php');
            include('gisv2_print.php');
        ?>

    </div>
    <div id="coe" hidden>
        
        <?php 
        // if(substr_count(strval($client_assistance[1]['type']), "Medic") > 0){
        //             include("coe_med.php"); 
        //         }elseif(substr_count(strval($client_assistance[1]['type']), "Trans") > 0){
        //             include("coe_trans.php");
        //         }elseif(substr_count(strval($client_assistance[1]['type']), "Food Sub") > 0){
        //             include("coe_food.php");
        //         }elseif(substr_count(strval($client_assistance[1]['type']), "Burial") > 0){
        //             include("coe_burial.php");
        //         }elseif(substr_count(strval($client_assistance[1]['type']), "Educ") > 0){
        //             include("coe_educ.php");
        //         }elseif(substr_count(strval($client_assistance[1]['type']), "Cash") > 0){
        //             include("coe_cash.php");
        //         }elseif(substr_count(strval($client_assistance[1]['type']), "Non") > 0){
        //             include("coe_non_food.php");
        //         }

        //         if(!empty(substr_count(strval($client_assistance[2]['type']), "Food Sub") > 0)){
		// 			include("coe_food.php");
        //         }
            include('coev2_print.php');
        ?>
    </div>
    <div>
        <div id="CAV" hidden>
            <?php 
                if($mode1 == "CAV" || $mode2 == "CAV"){
                    include('cash.php');
                }
            ?>
        </div>
    </div>
    <div id="GL" hidden>
        <?php 
            if($mode1 == "GL"){
                include('gl_sheet.php');
            }
            if($mode2 == "GL"){
                include('gl_sheet2.php');
            }
        ?>
    </div>
    <!---->

    </body>
</html>