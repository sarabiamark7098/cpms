<?php 
    include('../php/class.user.php');
    $user = new User();
    
    if(isset($_GET['id'])){
        $id = $user->getClientId($_GET['id']);
        $client = $user->clientData($_GET['id']); ; //kuha sa mga data sa bene/client data
        $client_assistance = $user->getGISAssistance($_GET['id']); //kuha sa data sa assistance table
        $signatoryGL = $user->getsignatory($client['signatory_GL']); 
        
        $record = $user->getCOEData($_GET['id']); //kwaun ang data sa coe table
		$timeentry = $user->theTime($client['date_entered']);//kwaun ang time
		$client_fam = $user->getclientFam($_GET['id']);
		$gis = $user->getGISData($_GET['id']); //kwaun ang mga data if ever naa na xay inputed data sa assessment/service only
        $otherinfo = $user->getOtherInformations($_GET['id']);
        $totalSourceofIncome = $user->totalSourceOfIncome($_GET['id']);
        $otherClientInformation = $user->ParseInputs($otherinfo['otherClientInformation']);
        $crisisSeverityQuestion3 = $user->ParseInputs($otherinfo['crisisSeverityQuestion3']);
        $supportSystemAvailability = $user->ParseInputs($otherinfo['supportSystemAvailability']);
        $externalResources = $user->ParseInputs($otherinfo['externalResources']);
        $selfHelp = $user->ParseInputs($otherinfo['selfHelp']);
        $vulnerability_riskFactor = $user->ParseInputs($otherinfo['vulnerability_riskFactor']);
    
        $fundsourcedata = $user->getfundsourcedata($_GET['id']);
			
        $am = str_replace(",","",$client_assistance[1]['amount']);
		
        if($am > 50000){
            if($record){
                $COEsignatoryini= $user->getinitialsSignatory($client['signatory_id']); //kwaun ang data sa signatory using sign_id 
            }
        }
        $GLsignatoryini= $user->getinitialsSignatory($client['signatory_GL']); //kwaun ang data sa signatory using sign_id 

        $name =  $client["firstname"]." ". (!empty($client["middlename"][0])?($client["middlename"][0] != " "?strtoupper($client["middlename"][0]) .". ":""):""). $client["lastname"];
		if(!empty($client['extraname'])){
			$name .= " ". strtoupper($client['extraname']) .".";
		}
		$bname =  $client["b_fname"]." ". (!empty($client["b_mname"][0])?($client["b_mname"][0] != " "?strtoupper($client["b_mname"][0]) .". ":""):""). $client["b_lname"]."". strtoupper($client['b_exname'] != ""? " ".$client['b_exname'].".": "");
        $signatoryGLNamePos = "";
        if(!empty($signatoryGL)){
            $signatoryGLNamePos = (!empty($signatoryGL["name_title"])?$signatoryGL['name_title'] ." ":""). strtoupper($signatoryGL['first_name'] ." ". (!empty($signatoryGL["middle_I"])?$signatoryGL['middle_I'] .". ":""). $signatoryGL['last_name'] ."-". $signatoryGL['position']);
        }
		
		if(!empty($client["b_lname"])){
			$today = date("Y-m-d");
			$diff = date_diff(date_create($client['b_bday']), date_create($today));
			$age_bene = $diff->format('%y');
		}else{
			$age_bene = "";
		}
		if(!empty($client["lastname"])){
			$today = date("Y-m-d");
			$diff = date_diff(date_create($client['date_birth']), date_create($today));
			$age_client = $diff->format('%y');
		}
        
		//ADDRESS
        $c_add = '';
        $b_add = '';
        $cash_add=""; //set as the payee address for CAV
        
        $sex = $client['sex'] == 'Male'? "her" : "his"; //magamit ni sa g_sheet for grammar
       //gipangkwaan og '-'
        $city = explode("/", $client['client_municipality']);
        $brgy = explode("/", $client['client_barangay']);
        $province = explode("/", $client['client_province']);
        $bcity = explode("/", $client['b_municipality']); 
        $bbrgy = explode("/", $client['b_barangay']);
        $bprovince = explode("/", $client['b_province']);

        //if street kay way sulod ma blank lg sta
		if(!empty($client['b_street'])){
			$b_add .= $client['b_street'].", ";
		}
	
		if(!empty($client['client_street'])){
            $c_add .= $client['client_street'] .", ";
            $cash_add .= $client['client_street'] .", ";
		}
        
        $b_add .= $bbrgy[0] .", ". $bcity[0].", ". $bprovince[0]; //client final address
        $c_add .= $brgy[0] .", ". $city[0] .", ". $province[0]; //client final address
        $cash_add .= $brgy[0] .", ". $city[0]; //address for CAV
        
        //magkuhag data if ever naa na s database
        $gl = $user->getGL($_GET['id']); //gl table
        $cash = $user->getCash($_GET['id']); //cash table
        $ft_signatoryini = "";
        $forthepositiongl = "";
        $signatoryforthe = "";
        if(!empty($gl['for_the_id'])){
            $signatoryforthe = $user->getsignatory($gl['for_the_id']);
            $z = explode('/', $signatoryGL['position']);
            if(!empty($z[1])){ 
                $forthepositiongl = $z[1];
            }else{
                $forthepositiongl = $z[0];
            }
            $ft_signatoryini = $user->getinitialsSignatory($gl['for_the_id']);
        }
        $GLid = "";
        if (empty($gl['control_no'])) {
            $GLid = $user->controlNumberForGL();
        }else{
            $GLid = $gl['control_no'];
        }
        $mode1 = "";
        $mode2 = "";
        		
        $mode1 = $client_assistance[1]['mode'];
        
        if(!empty($client_assistance[2]['mode'])){
            $mode2 = $client_assistance[2]['mode'];
        }
		
        $amountToWord = $user->toWord($client_assistance[1]['amount']);
  
		$soc_worker = $user->getuserInfo($_SESSION['userId']);
        //fullname of social worker
        $soc_workFullname = $soc_worker['empfname'] .' '.(!empty($soc_worker['empmname'][0])?$soc_worker['empmname'][0] . '. ':''). $soc_worker['emplname'] . (!empty($soc_worker['empext'])? ' ' . $soc_worker['empext'] . '.' : '');
        
		$GISsignatory=$user->getsignatory($gis['signatory_id']); //get data sa GIS na signatory
        $GISsignatoryName = strtoupper((!empty($GISsignatory['name_title'])?($GISsignatory['name_title'] != " "?$GISsignatory['name_title'] ." ":""):""). (!empty($GISsignatory['first_name'])?$GISsignatory['first_name'] ." ":"") . (!empty($GISsignatory['middle_I'])?($GISsignatory['middle_I'] != " "?$GISsignatory['middle_I'] .". ":""):""). (!empty($GISsignatory['last_name'])?$GISsignatory['last_name']:""));
        $GISsignatoryPosition = !empty($GISsignatory['position'])?$GISsignatory['position']:"";
        
		$GLsignatory=$user->getsignatory($client['signatory_GL']); //get data sa GIS na signatory
        $GLsignatoryName = strtoupper((!empty($GLsignatory['name_title'])?($GLsignatory['name_title'] != " "?$GLsignatory['name_title'] ." ":""):""). (!empty($GLsignatory['first_name'])? $GLsignatory['first_name'] ." ":"") . (!empty($GLsignatory['middle_I'])?($GLsignatory['middle_I'] != " "?$GLsignatory['middle_I'] .". ":""):""). (!empty($GLsignatory['last_name'])?$GLsignatory['last_name']:""));
        $GLsignatoryPosition = $GLsignatory['position'];
		
		$soc_worker = $user->getuserInfo($client['encoded_socialWork']);
        //fullname of social worker
        $soc_workFullname = $soc_worker['empfname'] .' '.(!empty($soc_worker['empmname'][0])?$soc_worker['empmname'][0] . '. ':''). $soc_worker['emplname'] . (!empty($soc_worker['empext'])? ' ' . $soc_worker['empext'] . '.' : '');
        
    }
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
        
        function printInformationSheet(){
            var divElements = $('#information_sheet').html();
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
                        <div class="col"> <button class="btn btn-primary btn-block no-print" onclick="printInformationSheet()">IS</button></div>
                        <div class="col"> <button class="btn btn-primary btn-block no-print" onclick="printCOE()">COE</button></div>
                        <div class="col"> <button class="btn btn-<?php echo (strtolower($client_assistance[1]["mode"])=="gl")?"success":"dark" ?> btn-block no-print" onclick="printGL()" <?php echo (strtolower($client_assistance[1]["mode"])=="gl")?"":"disabled" ?>>GL</button></div>
                        <!-- <div class="col"> <button class="btn btn-<?php echo (strtolower($client_assistance[1]["mode"])=="cav")?"success":"dark" ?> btn-block no-print" onclick="printCAV()" <?php echo (strtolower($client_assistance[1]["mode"])=="cav")?"":"disabled" ?>>CASH</button></div> -->
                    </div>  
                </div>
            </div>
        </div>
    </div>
    <div id="gis" hidden>
        
        <?php 
            include('gisv2_print.php');
        ?>

    </div>
    <div id="coe" hidden>
        <?php 
            include('coev2_print.php');
		?>
    </div>
    
    <div id="information_sheet" hidden>
        <?php 
            include('informationSheet_print.php');
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