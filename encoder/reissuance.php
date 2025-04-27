<?php 
    include('../php/class.user.php');
    $user = new User();
    
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    
    $client = $user->showallClientdata(intval($id));
    $name = $client["lastname"].", ". $client["firstname"]." ". $client["middlename"];
    if(!empty($client['extraname'])){
		$name .= " ". $client['extraname'];
    }
    
    $coename = $client['firstname']." ";
    if(!empty($client['middlename'])){
        $coename .= $client['middlename'][0].". ";
    }
    $coename .= $client['lastname']." ";
    if(!empty($client['extraname'])){
		$coename .= " ". $client['extraname'];
	}
	
    $bname = $client["b_lname"].", ". $client["b_fname"]." ". $client["b_mname"];
	if(!empty($client['b_exname'])){
		$bname .= $client['b_exname'];
    }
    
    $coebname = $client['b_fname']." ";
    if(!empty($client['b_mname'])){
        $coebname .= $client['b_mname'][0].". ";
    }
    $coebname .= $client['b_lname']." ";
    if(!empty($client['b_exname'])){
		$coebname .= " ". $client['b_exname'];
	}
    $_SESSION["client_id_assess"] = $_GET["id"];
    $dateentered = date("Y-m-d H:i:s");
    $timeentry = $user->theTime($dateentered);
    $client_fam = $user->getclientFam($id);
    $gis = $user->getGISData($id);
    $otherinfo = $user->getOtherInformations($_GET['id']);
    $totalSourceofIncome = $user->totalSourceOfIncome($_GET['id']);
    $otherClientInformation = $user->ParseInputs($otherinfo['otherClientInformation']);
    $crisisSeverityQuestion3 = $user->ParseInputs($otherinfo['crisisSeverityQuestion3']);
    $supportSystemAvailability = $user->ParseInputs($otherinfo['supportSystemAvailability']);
    $externalResources = $user->ParseInputs($otherinfo['externalResources']);
    $selfHelp = $user->ParseInputs($otherinfo['selfHelp']);
    $vulnerability_riskFactor = $user->ParseInputs($otherinfo['vulnerability_riskFactor']);
        
    $soc_worker = $user->getuserInfo($client['encoded_socialWork']);
    $soc_workerFullname = $soc_worker['empfname'].' '.$soc_worker['empmname'][0].'. '.$soc_worker['emplname'].' '.$soc_worker['empext'];
    $encoder = $user->getuserInfo($client['encoded_encoder']);
    $signatory = $user->show_signatory_data($client['signature']);
    $glsignatory = $user->show_signatory_data($client['signatureGL']);
    $Ccity = explode("/", $client['client_municipality']);$Cbrgy = explode("/", $client['client_barangay']);$Cprovince = explode("/", $client['client_province']);
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
    $amountToWord = $user->toWord($client["amount1"]);
    $signatoryName = strtoupper($signatory['first_name'] ." ". $signatory['middle_I'] .". ". $signatory['last_name']);
    $glsignatoryname = strtoupper($glsignatory['first_name'] ." ". $glsignatory['middle_I'] .". ". $glsignatory['last_name']);
    $cash = $user->getCash($id);
    $gl = $user->getGL($id);
    $coe = $user->getCOEData($id);
    $dateaccomplished = explode("-",$client['date_accomplished']);
    $dateenter = explode("-",$dateentered);
    $reconsignatory = $user->show_signatory_data($coe['sign_id']);
	$reconsignatoryName = strtoupper($reconsignatory['first_name'] ." ". $reconsignatory['middle_I'] .". ". $reconsignatory['last_name']);
	if($coe){
		$CEsignatory= $user->getsignatory($coe['sign_id']);
		$CEINIAprroved = strtoupper($CEsignatory['first_name'][0] ."". $CEsignatory['middle_I'][0] ."". $CEsignatory['last_name'][0]);
	}
	$toif = explode(".",$client['amount1']);
	$am = (str_replace(",","",$toif[0]));
	if($client['amount2'] != ""){
		$toif2 = explode(".",$client['amount2']);
		$am2 = (str_replace(",","",$toif2[0]));
	}
    if(isset($_POST['save'])){
        $setamount1 = $_POST["type1amount"];
        $setamount2 = "";
        if(!empty($_POST["type2amount"])){
            $setamount2 = $_POST["type2amount"];
        }
        $execute = $user->reissue($_GET['id'],$setamount1,$setamount2);
        if($execute){
            echo "<script>alert('Client Successfully Reissued!');</script>";
            echo "<script>window.location='reissuance.php?id=".$execute."&stat=1';</script>";
            echo "<meta http-equiv='refresh' content='0'>";
        }
        else{
            echo "<script>alert('Sorry Error on Reissue!');</script>";
            echo "<script>window.location='home.php';</script>";
            echo "<meta http-equiv='refresh' content='0'>";
        }
    }
    if(isset($_POST['done'])){
        echo "<script>alert('Client Successfully Reissued!');</script>";
        echo "<script>window.location='home.php';</script>";
        echo "<meta http-equiv='refresh' content='0'>";
    }

?>
<?php
	if(!$_SESSION['login']){
		header('Location:../index.php');
		}

?>
<!DOCTYPE>
<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link rel="icon" type="image/png" href="../images/icons/ciu.ico"/>
		<link rel="stylesheet" type="text/css" href="../css/main.css">
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">	
		<link rel="stylesheet" type="text/css" href="../css/table.responsive.css">
		<link rel="stylesheet" type="text/css" href="../css/gis.css">
        <link rel="stylesheet" type="text/css" href="../style5.css">
        
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
		
		<link rel="stylesheet" type="text/css" href="../datatables/datatables.css">
		<script type="text/javascript" charset="utf8" src="../datatables/datatables.js"></script>
		<script type="text/javascript" src="../js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../js/bootstrap-3.3.7.min.js"></script>
        <script type="text/javascript" src="../js/jquery.mask.min.js"></script>
    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-info" style="position: fixed; width: 100%">
        <a href="home.php"><img src="../images/dswd-logo_final.png" class="img-responsive" alt="unkown" width="200" height="55"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        
    </nav>
<!-- Modal for Updating Amount -->


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
        
        function printInformationSheet() {
            //unsa na div iyang e print
            var divElements = document.getElementById('isheet').innerHTML;;
            //nag gunit sa whole page 
            var oldPage = document.body.innerHTML;

            //gi set ang div as a whole page
            document.body.innerHTML =
                "<html><head><title></title></head><body>" +
                divElements + "</body>";
            //Print Page
            window.print();
            //gi balik ang old page
            document.body.innerHTML = oldPage;

            //setInputCOE(arr); //gi pang butang sa input ang mga input sa user
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
            var divElements = document.getElementById('gl').innerHTML;
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
            var divElements = document.getElementById('cav').innerHTML;
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
        $('.money').mask("#,000,000.00", {reverse: true});
    </script>
        <br><br><br><br><br> 
        <div class="row">
            <div class="col-1"></div>
            <div class="col"></div>
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
                <h4 class="card-header text-success">Reissuance on Update Amount of Assistance</h4>
                <div class="card-body">
                <form class="form-group" action="reissuance.php?id=<?php echo $id ?>&stat=0" method="POST" autocomplete="off">
                    <div class="row text-center" <?php echo $_GET['stat']==0? 'style="display:none"' : ""?>>
                        <div class="col"> <button class="btn btn-primary btn-block no-print" onclick="printGIS()" <?php echo $_GET['stat']==0?'disabled':'';?>>GIS</button></div>
                        <div class="col"> <button class="btn btn-primary btn-block no-print" onclick="printInformationSheet()" <?php echo $_GET['stat']==0?'disabled':'';?>>Information Sheet</button></div>
                        <div class="col"> <button class="btn btn-primary btn-block no-print" onclick="printCOE()" <?php echo $_GET['stat']==0?'disabled':'';?>>COE</button></div>
                        <div class="col"> <button class="btn btn-<?php echo empty($gl)?"default":"success" ?> btn-block no-print" onclick="printGL()" <?php echo empty($gl)?"disabled":"" ?>>GL</button></div>
                        <div class="col"> <button class="btn btn-<?php echo empty($cash)?"default":"success" ?> btn-block no-print" onclick="printCAV()" <?php echo empty($cash)?"disabled":"" ?>>CASH</button></div>
                    </div>
                    <br>
                    <?php if($_GET['stat']==0){ ?>
                    <div class="row form-group" style="margin-top: 2%; height:10%;">
                        <div class="form-group col-lg-2">
                        </div>
                        <div class="form-group col-lg-4">
                            <input value="<?php echo empty($client['amount1'])? "":$client['amount1'] ?>" id="type1amount" name="type1amount" type="text" class="form-control money">
                            <label class="active" for="type1amount">Type 1 Amount</label>
                        </div>
                        <?php if(!empty($client['amount2'])){ ?>
                        <div class="form-group col-lg-4">
                            <input value="<?php echo empty($client['amount2'])? "":$client['amount2'] ?>" id="type2amount" name="type2amount" type="text" class="form-control money">
                            <label class="active" for="type2amount">Type 2 Amount</label>
                        </div>
                        <div class="form-group col-lg-2">
                        </div>
                        <?php } ?>
                    </div>
                    <?php } ?>
                    <br>
                    <div class="row text-center">
                        <div class="col"></div>
                        <div class="col"><button class="btn btn-<?php echo $_GET['stat']==1?'dark disabled':'success' ?> btn-block no-print" name="save" id="save" <?php echo $_GET['stat']==1?'disabled':'';?>>Save</button></div>
                        <div class="col"><button class="btn btn-<?php echo $_GET['stat']==0?'dark':'success' ?> btn-block no-print " name="done" id="done" <?php echo $_GET['stat']==0?'disabled':'';?>>Done</button></div>
                        <div class="col"></div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
   <div id="gis" hidden>
        <?php 
            include('gis_sheet.php');
        ?>
    </div>
    <div id="coe" hidden>
        <?php 
            include('coev2_print_gl.php');
        ?>
    </div>
    <div id="isheet" hidden>
        <?php 
            include('information_sheet.php');
        ?>
    </div>
    <div>
        <div id="cav" hidden>
            <?php 
                if(($client['mode1'] == "CAV" || $client['mode2'] == "CAV")){
                    include('cash.php');
                }
            ?>
        </div>
    </div>
    <div id="gl" hidden>
        <?php 
            if($client['mode1'] == "GL"){
                include('gl_sheet.php');
            }
            if($client['mode2'] == "GL"){
                include('gl_sheet2.php');
            }
        ?>
    </div>
</body>
</html>