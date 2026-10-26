<?php 
    include('../../php/class.user.php');
    $user = new User();
    if(isset($_GET['confirmdone'])){
        if($_GET['confirmdone']== 1){
            echo "<script type='text/javascript'>alert('Transaction Successful');</script>";
            $user->doneupdatefinance($_GET["id"],$_GET['transid']);
        }
    }
    // Finance may update ONLY the GL signatory here, and only for amounts over 50,000
    // (re-checked inside financeUpdateSignatoryGL). Runs before the data load so the page
    // renders the new signatory.
    if(isset($_POST['update_gl_signatory']) && isset($_GET['id'])){
        $user->financeUpdateSignatoryGL($_GET['id'], $_POST['gl_signatory'] ?? '');
    }
    if(isset($_GET['id'])){
        $id = $user->getClientId($_GET['id']);
        $client = $user->clientData($_GET['id']); ; //kuha sa mga data sa bene/client data
        $client_assistance = $user->getGISAssistance($_GET['id']); //kuha sa data sa assistance table
        $signatoryGL = $user->getsignatory($client['signatory_GL']); 
        $record = $user->getCOEData($_GET['id']); //kwaun ang data sa coe table
		$timeentry = $user->theTime($client['date_entered']);//kwaun ang time
		$client_fam = $user->getclientFam($_GET['id']);
		$records = $user->getRecords($_GET['id']); // Assistance Received from DSWD
		$total_family_income = $user->getTotalFamilyIncome($_GET['id']);
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
		
		$today = date("Y-m-d");
        $diff = date_diff(date_create($client['date_birth']), date_create($today));
        $age_client = $diff->format('%y');
		if(!empty($client["b_lname"])){
			$today = date("Y-m-d");
			$diff = date_diff(date_create($client['b_bday']), date_create($today));
			$age_bene = $diff->format('%y');
        }else{
			$age_bene = "";
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

        if(!empty($client['client_street'])){
            $c_add .= $client['client_street'] .", ";
            $cash_add .= $client['client_street'] .", ";
		}
        $c_add .= $brgy[0] .", ". $city[0] .", ". $province[0]; //client final address
        
        //if street kay way sulod ma blank lg sta
		if(!empty($client['b_street'])){
			$b_add .= $client['b_street'].", ";
		}
	    if(!empty($client['b_barangay'])){
            $bbrgy = explode("/", $client['b_barangay']);
            $b_add .= $bbrgy[0] .", "; 
        }else{
            $bbrgy[0] = "";
        }
        if(!empty($client['b_municipality'])){
            $bcity = explode("/", $client['b_municipality']);
            $b_add .= $bcity[0].", "; 
        }else{
            $bcity[0] = "";
        }
        if(!empty($client['b_province'])){
            $bprovince = explode("/", $client['b_province']);
            $b_add .= $bprovince[0];
        }else{
            $bprovince[0] = "";
        }
       
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
        $GISsignatoryName = "";
        $GISsignatoryPosition = "";
        if(!empty($gis['signatory_id'])){
            $GISsignatory=$user->getsignatory($gis['signatory_id']); //get data sa GIS na signatory
            $GISsignatoryName = strtoupper((!empty($GISsignatory['name_title'])?($GISsignatory['name_title'] != " "?$GISsignatory['name_title'] ." ":""):""). $GISsignatory['first_name'] ." ". (!empty($GISsignatory['middle_I'])?($GISsignatory['middle_I'] != " "?$GISsignatory['middle_I'] .". ":""):""). $GISsignatory['last_name']);
            $GISsignatoryPosition = $GISsignatory['position'];
        }
        $GLsignatoryName = "";
        $GLsignatoryPosition = "";
        if(!empty($client['signatory_GL'])){
            $GLsignatory=$user->getsignatory($client['signatory_GL']); //get data sa GIS na signatory
            $GLsignatoryName = strtoupper((!empty($GLsignatory['name_title'])?($GLsignatory['name_title'] != " "?$GLsignatory['name_title'] ." ":""):""). $GLsignatory['first_name'] ." ". (!empty($GLsignatory['middle_I'])?($GLsignatory['middle_I'] != " "?$GLsignatory['middle_I'] .". ":""):""). $GLsignatory['last_name']);
            $GLsignatoryPosition = $GLsignatory['position'];
        }
		$soc_worker = $user->getuserInfo($client['encoded_socialWork']);
        //fullname of social worker
        $soc_workFullname = $soc_worker['empfname'] .' '.(!empty($soc_worker['empmname'][0])?$soc_worker['empmname'][0] . '. ':''). $soc_worker['emplname'] . (!empty($soc_worker['empext'])? ' ' . $soc_worker['empext'] . '.' : '');
        
    }
	
	if(!$_SESSION['login']){
		header('Location:../../index.php');
		}

?>

<!DOCTYPE>
<html>
    <head>
		<meta charset="utf-8">
		<!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link rel="icon" type="image/png" href="../../images/icons/ciu.ico"/>
		<link rel="stylesheet" href="../../css/coe.css">
        <link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css"> 
        <link rel="stylesheet" type="text/css" href="../../css/font-awesome.min.css">
		
        <script defer src="../../js/solid.js"></script>
        <script defer src="../../js/fontawesome.js"></script>
        <script src="../../js/jquery.slim.min.js"></script>
        <script src="../../js/popper.min.js"></script>
        <script src="../../js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../../js/main.js"></script>
        <script type="text/javascript" src="../../js/maince.js"></script>
		
        <script type="text/javascript" src="../../js/jquery-3.2.1.slim.min.js"></script>
        <script type="text/javascript" src="../../js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../../js/jquery.min.js"></script>
		<script type="text/javascript" src="../../js/bootstrap-3.3.7.min.js"></script>
        <title>LAST</title>
        <style type="text/css">
			.first{
                padding-top: 1em;
                text-indent: 92px;
            }
            .justify{
                font-size: 17pt;
                font-family: 'Times New Roman', Times, serif;
                text-align: justify;
            }
		</style>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark" style="position: fixed; width: 100%; z-index:100; background: #6d7fcc;">
            <a href="../home.php"><img src="../../images/dswd-logo_final.png" class="img-responsive" alt="unkown" width="200" height="55"></a>
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
        <div class="container"><br>
            <form action="last.php?id=<?php echo $_GET['id']?>" method="post">
                <?php
                    // Finance print hub shows a read-only summary only (no provider editing).
                    $isGL = ($mode1 == "GL" || $mode2 == "GL");
                    $hasBene = (strtolower($client['relation'] ?? '') !== 'self') && (trim($bname) !== '');
                ?>
                <div class="card border-info mb-3" style="width:100%;">
                    <h4 class="card-header text-white" style="background:#1e88e5;">Transaction Details</h4>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6"><b>Client:</b> <?php echo htmlspecialchars($name); ?></div>
                            <?php if ($hasBene) { ?>
                            <div class="col-md-6"><b>Beneficiary:</b> <?php echo htmlspecialchars($bname); ?></div>
                            <?php } ?>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6"><b>GL Number:</b> <?php echo $isGL ? htmlspecialchars($GLid) : 'N/A'; ?></div>
                        </div>
                        <?php if ($isGL && (float)$am > 50000) {
                            $glSigPrefill = '';
                            if (!empty($signatoryGL) && !empty($signatoryGL['first_name'])) {
                                $glSigPrefill = strtoupper($signatoryGL['first_name'].' '.$signatoryGL['middle_I'].'. '.$signatoryGL['last_name']).'-'.$signatoryGL['position'];
                            }
                        ?>
                        <div class="row mt-3">
                            <div class="col-md-10">
                                <label class="mb-1"><b>GL Signatory</b> <small class="text-muted">(required for amounts over 50,000)</small></label>
                                <div class="input-group">
                                    <input list="gls" type="text" class="form-control" id="gl_signatory" name="gl_signatory"
                                           value="<?php echo htmlspecialchars($glSigPrefill); ?>" placeholder="Select GL Signatory" autocomplete="off">
                                    <?php echo $user->signatoryGL(); // <datalist id="gls"> ?>
                                    <div class="input-group-append">
                                        <button type="submit" name="update_gl_signatory" class="btn btn-primary">Update Signatory</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <table class="table table-sm table-bordered mt-3 mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Type of Assistance</th>
                                    <th class="text-right">Amount of Assistance</th>
                                    <th class="text-center">Mode of Assistance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo htmlspecialchars($client_assistance[1]['type'] ?? ''); ?></td>
                                    <td class="text-right">&#8369;<?php echo htmlspecialchars($client_assistance[1]['amount'] ?? ''); ?></td>
                                    <td class="text-center"><?php echo htmlspecialchars($client_assistance[1]['mode'] ?? ''); ?></td>
                                </tr>
                                <?php if (!empty($client_assistance[2]['type']) || !empty($client_assistance[2]['amount'])) { ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($client_assistance[2]['type'] ?? ''); ?></td>
                                    <td class="text-right">&#8369;<?php echo htmlspecialchars($client_assistance[2]['amount'] ?? ''); ?></td>
                                    <td class="text-center"><?php echo htmlspecialchars($client_assistance[2]['mode'] ?? ''); ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                        <?php
                            // Fund sources — view only (finance edits them on the update page, not here).
                            $fsRows = array();
                            for ($i = 1; $i <= 12; $i++) {
                                if (!empty($fundsourcedata[$i]['fundsource'])) { $fsRows[] = $fundsourcedata[$i]; }
                            }
                        ?>
                        <h6 class="mt-3 mb-1" style="font-weight:bold;">Fund Source <small class="text-muted">(view only)</small></h6>
                        <?php if (!empty($fsRows)) { ?>
                        <table class="table table-sm table-bordered mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Fund Source</th>
                                    <th class="text-right">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($fsRows as $fs) { ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($fs['fundsource']); ?></td>
                                    <td class="text-right">&#8369;<?php echo htmlspecialchars($fs['fs_amount'] ?? ''); ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <?php } else { ?>
                        <p class="text-muted mb-0">No fund source recorded.</p>
                        <?php } ?>
                    </div>
                </div>
                <div class="row">
                    <?php if ($gis['program_type'] == '1'){ ?>
                    <div class="col"><input type="button" class="btn btn-<?php echo (!empty($gl) || !empty($cash) || $mode1=="DS" || $mode2=="DS")?"primary":"secondary" ?> btn-block" value="Print Attestation" name="printa" onclick="printAttest()" <?php echo (!empty($gl) || !empty($cash) || $mode1=="DS" || $mode2=="DS")?"":"disabled" ?> ></div>
                    <?php } ?>
                    <div class="col"><input type="button" class="btn btn-<?php echo (!empty($gl) || !empty($cash) || $mode1=="DS" || $mode2=="DS")?"primary":"secondary" ?> btn-block" value="Print GIS" name="printgis" onclick="printGISinCE()" <?php echo (!empty($gl) || !empty($cash) || $mode1=="DS" || $mode2=="DS")?"":"disabled" ?> ></div>
                    <div class="col"><input type="button" class="btn btn-<?php echo (!empty($gl) || !empty($cash) || $mode1=="DS" || $mode2=="DS")?"primary":"secondary" ?> btn-block" value="Print IS" name="printis" onclick="printInformationSheet()" <?php echo (!empty($gl) || !empty($cash) || $mode1=="DS" || $mode2=="DS")?"":"disabled" ?> ></div>
					<div class="col"><input type="button" class="btn btn-<?php echo (!empty($gl) || !empty($cash) || $mode1=="DS" || $mode2=="DS")?"primary":"secondary" ?> btn-block" value="Print CE" name="printce" onclick="printCOE()" <?php echo (!empty($gl) || !empty($cash) || $mode1=="DS" || $mode2=="DS")?"":"disabled" ?> ></div>
					<div class="col">
                        <input type="button" class="btn btn-<?php echo (($mode1=="GL" || $mode2=="GL") && $gl != "")?"primary":"secondary" ?> btn-block no-print"  value="Print GL" name="print" onclick="printGLNow()" <?php echo (($mode1=="GL" || $mode2=="GL") && $gl != "")?"":"disabled" ?>>
                    </div>
                    <!-- <div class="col">
                        <input type="button" class="btn btn-<?php echo (($mode1=="CAV" || $mode2=="CAV") && $cash != "")? "primary":"secondary" ?> btn-block no-print"  value="Print CAV" name="print" onclick="printCAVNow()" <?php echo (($mode1=="CAV" || $mode2=="CAV") && $cash != "")?"":"disabled" ?>>
                    </div> -->
                </div><br>
				<div class="row">
                        <?php
                            // Finance does NOT update the provider (GL / cash) here — print only.
                        ?>
                    <div class="col"><input type="button" class="btn btn-success btn-block no-print" id="done" value="Done" onclick="confirmdone(<?php echo "'".$id."','".$_GET['id']."'" ?>)"/></div>
                </div>

            </form>
            <?php  
            $printables = [
                'gl' => [
                    'file' => 'gl_sheet.php',
                    'condition' => ($mode1 == "GL")
                ],
                'cav' => [
                    'file' => 'cash.php',
                    'condition' => ($mode1 == "CAV")
                ],
                'attest' => [
                    'file' => 'attestation.php',
                    'condition' => true
                ],
                'gisce' => [
                    'file' => 'gis_print.php',
                    'condition' => true
                ],
                'isheet' => [
                    'file' => 'informationSheet_print.php',
                    'condition' => true
                ],
                'coe' => [
                    'file' => 'coe_print.php',
                    'condition' => true
                ]
            ];
            
            foreach ($printables as $id => $item) {
                echo '<div id="' . $id . '" class="printable" hidden><br>';
                if ($item['condition']) {
                    include($item['file']);
                }
                echo '</div>';
            }
            ?>
    </body>
    <?php 
        if(!empty($gl || $cash)|| ($mode1=="DS" && !empty($mode2)=="DS") || ($mode1=="DS" && empty($mode2)) || (empty($mode1) && $mode2=="DS")){
            echo "<script>document.getElementById('done').style.visibility='visible';</script>";
        }else{
            echo "<script>document.getElementById('done').style.visibility='hidden';</script>";
        }
        
    ?>
	<script type="text/javascript">
        $(function () {
            $("#radiobutton").click(function () {
                if ($(this).is(":checked")) {
                    $("#collapseOne").show();
                } else {
                    $("#collapseOne").hide();
                }
            });
        });

        $(document).ready(function(){
            if ($("#radiobutton").is(":checked")) {
                $("#collapseOne").show();
                $(".for_the").attr('required', '');
            } else {
                $("#collapseOne").hide();
                $(".for_the").removeAttr('required');
            }
        });

        $(function () {
            $("#radiobutton").click(function () {
                if ($(this).is(":checked")) {
                    $(".for_the").attr('required', '');
                } else {
                    $(".for_the").removeAttr('required');
                }
            });
        });

        function confirmdone(id, trans){
            var retval = confirm("Do you want to Proceed Done client?");
            if(retval == true){
                window.location="last.php?id="+id+"&transid="+trans+"&confirmdone=1";
            }
        }
    	$(document).ready(function(){
             $('#comp_name').keyup(function(){  //On pressing a key on "Search box". This function will be called
                var txt = $('#comp_name').val(); //Assigning search box value to javascript variable.
                if(txt != ''){ //Validating, if "name" is empty.
                    $.ajax({
                        type: "post", //method to use
                        url: "fetch.php", //ginapasa  sa diri nga file and data
                        data: {search:txt}, //mao ni nga data
                        success: function(html){  //If result found, this funtion will be call
                            
                            var json = JSON.parse(html);
                            $('#a_pos').val( json["position"]);
                            $('#tomention').val( json["to_mention"]);
                            $('#addressee').val( json["aname"]);
                            $('#address').val( json["address"]);
                        }
                    });
                }else{
                $('#search_result').html(""); 
                }
            });
        });

            function checkNum(id){
                //alert("came");
                var clientid = id;
                var no = $("#c_no").val();// value in field email
                
                $.ajax({
                    type:'post',
                    url:'fetch.php',// put your real file name 
                    data:{num: no, id: clientid},
                    success: function(msg){
                        if(msg==1){
                            document.getElementById("c_no").style.borderColor = "red";
                            document.getElementById('gl_error').innerHTML = '*Client Number is already been used!';
                            $('#update').attr('disabled','disabled');
                            $('#save').attr('disabled','disabled');
                            $('#save').removeClass('btn-primary').addClass('btn-dark ');
                            $(this).addClass('btn-success').removeClass('btn-primary ');
                            $('#update').removeClass('btn-primary').addClass('btn-dark ');
                            $(this).addClass('btn-success').removeClass('btn-primary ');
                        }else{
                            document.getElementById("c_no").style.borderColor = "green";
                            document.getElementById('gl_error').innerHTML = '';
                            $('#update').removeAttr('disabled');
                            $('#save').removeAttr('disabled');
                            $('#save').removeClass('btn-dark').addClass('btn-primary ');
                            $(this).addClass('btn-success').removeClass('btn-dark ');
                            $('#update').removeClass('btn-dark').addClass('btn-primary ');
                            $(this).addClass('btn-success').removeClass('btn-dark ');
                        }  
                    }
                });
            }
            function printAttest() {
                 //unsa na div iyang e print
                var divElements = document.getElementById('attest').innerHTML;;
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

            }
    
        /* disable-print-done-on-change */
        (function () {
            var form = document.querySelector('form');
            if (!form) return;
            function disablePrintDone() {
                document.querySelectorAll('[name="printa"],[name="printgis"],[name="printis"],[name="printce"],[name="print"]').forEach(function (b) {
                    b.disabled = true;
                    b.classList.remove('btn-primary');
                    b.classList.add('btn-secondary');
                });
                var done = document.getElementById('done');
                if (done) {
                    done.disabled = true;
                    done.classList.remove('btn-success');
                    done.classList.add('btn-secondary');
                }
            }
            form.addEventListener('input', disablePrintDone);
            form.addEventListener('change', disablePrintDone);
        })();
    </script>

    <?php 
        // Finance print hub: this page does NOT update the provider (GL / cash) records.
        // The provider details are set by the social worker; finance only prints here.

    ?>
    <script type="text/javascript">
        $(document).ready(function () {
            var afterPrint = function () {
                window.location='last.php?id=<?php echo $_GET['id'] ?>';
            };

            window.onafterprint = afterPrint;
        });

        // Finance print hub has no provider input fields, so the shared printGLNow()
        // (which reads those inputs via getGLvalue/setContentGL) would blank the GL and
        // error out. The GL sheet is already fully rendered from the database, so here we
        // simply print the #gl block as-is.
        function printGLNow() {
            var el = document.getElementById('gl');
            if (!el) { return; }
            var divElements = el.innerHTML;
            var oldPage = document.body.innerHTML;
            document.body.innerHTML = "<html><head><title></title></head><body>" + divElements + "</body>";
            window.print();
            document.body.innerHTML = oldPage;
        }
    </script>
 </html>