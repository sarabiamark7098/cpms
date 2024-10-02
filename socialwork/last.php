<?php 
    include('../php/class.user.php');
    $user = new User();
    if(isset($_GET['confirmdone'])){
        if($_GET['confirmdone']== 1){
            echo "<script type='text/javascript'>alert('Transaction Successful');</script>";
            $user->done($_GET["id"],$_GET['transid']);
        }
    }
    if(isset($_GET['id'])){
        $id = $user->getClientId($_GET['id']);
        $client = $user->clientData($_GET['id']); ; //kuha sa mga data sa bene/client data
        $client_assistance = $user->getGISAssistance($_GET['id']); //kuha sa data sa assistance table
        $signatoryGL = $user->getsignatory($client['signatory_GL']); 
        $record = $user->getCOEData($_GET['id']); //kwaun ang data sa coe table
		$timeentry = $user->theTime($client['date_entered']);//kwaun ang time
		$client_fam = $user->getclientFam($_GET['id']);
		$gis = $user->getGISData($_GET['id']); //kwaun ang mga data if ever naa na xay inputed data sa assessment/service only
    
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
        $GISsignatoryName = strtoupper((!empty($GISsignatory['name_title'])?($GISsignatory['name_title'] != " "?$GISsignatory['name_title'] ." ":""):""). $GISsignatory['first_name'] ." ". (!empty($GISsignatory['middle_I'])?($GISsignatory['middle_I'] != " "?$GISsignatory['middle_I'] .". ":""):""). $GISsignatory['last_name']);
        $GISsignatoryPosition = $GISsignatory['position'];
        
		$GLsignatory=$user->getsignatory($client['signatory_GL']); //get data sa GIS na signatory
        $GLsignatoryName = strtoupper((!empty($GLsignatory['name_title'])?($GLsignatory['name_title'] != " "?$GLsignatory['name_title'] ." ":""):""). $GLsignatory['first_name'] ." ". (!empty($GLsignatory['middle_I'])?($GLsignatory['middle_I'] != " "?$GLsignatory['middle_I'] .". ":""):""). $GLsignatory['last_name']);
        $GLsignatoryPosition = $GLsignatory['position'];
		
		$soc_worker = $user->getuserInfo($client['encoded_socialWork']);
        //fullname of social worker
        $soc_workFullname = $soc_worker['empfname'] .' '.(!empty($soc_worker['empmname'][0])?$soc_worker['empmname'][0] . '. ':''). $soc_worker['emplname'] . (!empty($soc_worker['empext'])? ' ' . $soc_worker['empext'] . '.' : '');
       
    }

	if(!$_SESSION['login']){
		header('Location:../index.php');
		}

?>

<!DOCTYPE>
<html>
    <head>
		<meta charset="utf-8">
		<!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link rel="icon" type="image/png" href="../images/icons/ciu.ico"/>
		<link rel="stylesheet" href="../css/coe.css">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"> 
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
		
        <script defer src="../js/solid.js"></script>
        <script defer src="../js/fontawesome.js"></script>
        <script src="../js/jquery.slim.min.js"></script>
        <script src="../js/popper.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../js/main.js"></script>
        <script type="text/javascript" src="../js/maince.js"></script>
		
        <script type="text/javascript" src="../js/jquery-3.2.1.slim.min.js"></script>
        <script type="text/javascript" src="../js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../js/jquery.min.js"></script>
		<script type="text/javascript" src="../js/bootstrap-3.3.7.min.js"></script>
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
        <div class="container"><br><br>
            <form action="last.php?id=<?php echo $_GET['id']?>" method="post">
                <?php     
                    if(!empty($mode2)){
                        if($mode1 == "GL" || $mode2 =="GL"){
                            echo '<div class="form-group row">
                                    <div class="card border-info mb3" style="width:100%;">
                                        <h4 class="card-header text-success">Guarantee Letter Information</h4>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="input-group input-group-lg">
                                                        <input type="text" class="form-control mr-sm-2 b" id="c_no" onblur="checkNum('.$_GET['id'].')" value="' .$GLid. '" name="c_no" placeholder="Control No." required readonly>
                                                        <span id="gl_error" style="color:red"></span>
                                                    </div>
                                                </div>
                                                <div class="col"><input list="gls" type="text" class="form-control mr-sm-2 b" id="gl_signatory" name="gl_signatory" value="'.$signatoryGLNamePos.'" placeholder="Guarantee Letter Signatory" readonly> '. $user->signatoryGL() .' <br></div>
                                            </div><br>
                                            <h3>Providers Info</h3>
                                            <input list="providers" type="text" class="form-control mr-sm-2 b" id="comp_name" name="comp_name" value="'.$gl['cname'].'" placeholder="Providers Company Name" required><br>
                                            <datalist id="providers">'. $user->listOfProvider().'</datalist>
                                            <input type="text" class="form-control mr-sm-2 b" id="address"     name="caddress" value="'.$gl['caddress'].'" placeholder="Providers Company Address" required><br>
                                            <input type="text" class="form-control mr-sm-2 b" name="addressee" id="addressee" value="'.$gl['addressee'].'" placeholder="Addressee Name"><br>
                                            <input type="text" class="form-control mr-sm-2 b" id="a_pos"      name="a_pos" value="'.$gl['position'].'" placeholder="Addressee Position" required><br>
                                            <div class="row">
                                                <div class="checkbox col-3">
                                                    <label data-toggle="collapse" for="radiobutton" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                        <input type="checkbox" id="radiobutton" class="checkbutton" name="forthebtn" style="height:15px;width:15px;margin: 10px" '. (!empty($gl['for_the_id'])?'checked':'').'> Set "For The" SIGNATORY
                                                    </label>
                                                </div>
                                                <div id="collapseOne" aria-expanded="false" class="collapse col-9">
                                                    <input list="signatory" type="text" class="form-control mr-sm-2 for_the" id="for_the" name="for_the" placeholder="Select For the Signatory" value="'. (empty($gl['for_the_id']) ? '' : $user->getSignatoryFullname($gl['for_the_id'])) .'">
                                                    <datalist id="signatory">';
                                                        $data = $user->signatoryGIS();
                                                        foreach ($data as $index => $value) {
                                                            $signatoryname = (!empty($value["name_title"])?$value['name_title'] ." ":""). $value['first_name'] . " " . (!empty($signatoryGL["middle_I"])?$signatoryGL['middle_I'] ." ":"").  $value['last_name'];
                                                            echo "<option value='" . strtoupper($signatoryname) . "-" . $value['position'] . "-" . $value['signatory_id'] ."'></option>";
                                                        }
                        echo                        '</datalist>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                        }
                        if($mode1 == "CAV" || $mode2=="CAV"){
                            echo '<div class="form-group row">
                                    <div class="card border-info mb3" style="width:100%;">
                                        <h4 class="card-header text-success">CASH Information</h4>
                                        <div class="card-body">
                                            <h3>Cash Voucher Info</h3>
                                            <input type="text" style="text-transform: uppercase" class="form-control mr-sm-2 b" name="sd_officer" value="'.$cash['sd_officer'].'" id="sd_officer" placeholder="Special Disbursing Officer" required><br>
                                            <input type="text" class="form-control mr-sm-2 b" name="payee"   value="'.(!empty($cash['payee'])?$cash['payee']:$name).'" id="payee" placeholder="PAYEE / OFFICE" required><br> 
                                            <input type="text" class="form-control mr-sm-2 b" name="cash_address" value="'.(!empty($cash['address'])?$cash['address']:$cash_add).'" id="cash_address" placeholder="ADDRESS" required><br>
                                        </div>
                                    </div>
                                </div>';
                        }
                        if($mode1=="DS"|| $mode2=="DS"){
                            echo '<div class="form-group row">
                                    <div class="card border-info mb3" style="width:100%;">
                                        <h4 class="card-header text-success">Distribution Sheet Information</h4>
                                        <div class="card-body">
                                            <br>
                                            <h4 style="color:blue">Distribution sheet is not available in the system</h4>
                                        </div>
                                    </div>
                                </div>';
                        }
                    }else{
                        if($mode1 == "GL"){
                            echo '<div class="form-group row">
                                    <div class="card border-info mb3" style="width:100%;">
                                        <h4 class="card-header text-success">Guarantee Letter Information</h4>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="input-group input-group-lg">
                                                        <input type="text" class="form-control mr-sm-2 b" id="c_no" onblur="checkNum('.$_GET['id'].')" value="' .$GLid. '" name="c_no" placeholder="Control No." required readonly>
                                                        <span id="gl_error" style="color:red"></span>
                                                    </div>
                                                </div>
                                                <div class="col"><input list="gls" type="text" class="form-control mr-sm-2 b" id="gl_signatory" name="gl_signatory" value="'.$signatoryGLNamePos.'" placeholder="Guarantee Letter Signatory" readonly> '. $user->signatoryGL() .' <br></div>
                                            </div><br>
                                            <h3>Providers Info</h3>
                                            <input list="providers" type="text" class="form-control mr-sm-2 b" id="comp_name" name="comp_name" value="'.$gl['cname'].'" placeholder="Providers Company Name" required><br>
                                            <datalist id="providers">'. $user->listOfProvider().'</datalist>
                                            <input type="text" class="form-control mr-sm-2 b" id="address"     name="caddress" value="'.$gl['caddress'].'" placeholder="Providers Company Address" required><br>
                                            <input type="text" class="form-control mr-sm-2 b" name="addressee" id="addressee" value="'.$gl['addressee'].'" placeholder="Addressee Name"><br>
                                            <input type="text" class="form-control mr-sm-2 b" id="a_pos"      name="a_pos" value="'.$gl['position'].'" placeholder="Addressee Position" required><br>
                                            <input type="text" class="form-control mr-sm-2 b" id="tomention"     name="tomention" value="'.$gl['to_mention'].'" placeholder="Addressee to Mention in GL" hidden><br>
                                            <div class="row">
                                                <div class="checkbox col-3">
                                                    <label data-toggle="collapse" for="radiobutton" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                        <input type="checkbox" id="radiobutton" class="checkbutton" name="forthebtn" style="height:15px;width:15px;margin: 10px" '. (!empty($gl['for_the_id'])?'checked':'').'> Set "For The" SIGNATORY
                                                    </label>
                                                </div>
                                                <div id="collapseOne" aria-expanded="false" class="collapse col-9">
                                                    <input list="signatory" type="text" class="form-control mr-sm-2 for_the" id="for_the" name="for_the" placeholder="Select For the Signatory" value="'. (empty($gl['for_the_id']) ? '' : $user->getSignatoryFullname($gl['for_the_id'])) .'">
                                                    <datalist id="signatory">';
                                                        $data = $user->signatoryGIS();
                                                        foreach ($data as $index => $value) {
                                                            $signatoryname = (!empty($value["name_title"])?$value['name_title'] ." ":""). $value['first_name'] . " " . (!empty($signatoryGL["middle_I"])?$signatoryGL['middle_I'] ." ":"").  $value['last_name'];
                                                            echo "<option value='" . strtoupper($signatoryname) . "-" . $value['position'] . "-" . $value['signatory_id'] ."'></option>";
                                                        }
                        echo                        '</datalist>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                        }
                        if($mode1 == "CAV"){
                            echo '<div class="form-group row">
                                    <div class="card border-info mb3" style="width:100%;">
                                        <h4 class="card-header text-success">CASH Information</h4>
                                        <div class="card-body">
                                            <h3>Cash Voucher Info</h3>
                                            <input type="text" style="text-transform: uppercase" class="form-control mr-sm-2 b" name="sd_officer" value="'.$cash['sd_officer'].'" id="sd_officer" placeholder="Special Disbursing Officer" required><br>
                                            <input type="text" class="form-control mr-sm-2 b" name="payee"   value="'.(!empty($cash['payee'])?$cash['payee']:$name).'" id="payee" placeholder="PAYEE / OFFICE" required><br> 
                                            <input type="text" class="form-control mr-sm-2 b" name="cash_address" value="'.(!empty($cash['address'])?$cash['address']:$cash_add).'" id="cash_address" placeholder="ADDRESS" required><br>
                                        </div>
                                    </div>
                                </div>';
                        }
                        if($mode1=="DS"){
                            echo '<div class="form-group row">
                                    <div class="card border-info mb3" style="width:100%;">
                                        <h4 class="card-header text-success">Distribution Sheet Information</h4>
                                        <div class="card-body">
                                            <br>
                                            <h4 style="color:blue">Distribution sheet is not available in the system</h4>
                                        </div>
                                    </div>
                                </div>';
                        }
                    }  
                ?>
                <div class="row">
                    <?php if ($gis['program_type'] == '1'){ ?> 
                    <div class="col"><input type="button" class="btn btn-<?php echo (!empty($gl) || !empty($cash) || $mode1=="DS" || $mode2=="DS")?"primary":"secondary" ?> btn-block" value="Print Attestation" name="printa" onclick="printAttest()" <?php echo (!empty($gl) || !empty($cash) || $mode1=="DS" || $mode2=="DS")?"":"disabled" ?> ></div>
                    <?php } ?>
                    <div class="col"><input type="button" class="btn btn-<?php echo (!empty($gl) || !empty($cash) || $mode1=="DS" || $mode2=="DS")?"primary":"secondary" ?> btn-block" value="Print GIS" name="printgis" onclick="printGISinCE()" <?php echo (!empty($gl) || !empty($cash) || $mode1=="DS" || $mode2=="DS")?"":"disabled" ?> ></div>
					<div class="col"><input type="button" class="btn btn-<?php echo (!empty($gl) || !empty($cash) || $mode1=="DS" || $mode2=="DS")?"primary":"secondary" ?> btn-block" value="Print CE" name="printce" onclick="printCOE()" <?php echo (!empty($gl) || !empty($cash) || $mode1=="DS" || $mode2=="DS")?"":"disabled" ?> ></div>
					<div class="col">
                        <input type="button" class="btn btn-<?php echo (($mode1=="GL" || $mode2=="GL") && $gl != "")?"primary":"secondary" ?> btn-block no-print"  value="Print GL" name="print" onclick="printGLNow()" <?php echo (($mode1=="GL" || $mode2=="GL") && $gl != "")?"":"disabled" ?>>
                    </div>
                    <div class="col">
                        <input type="button" class="btn btn-<?php echo (($mode1=="CAV" || $mode2=="CAV") && $cash != "")? "primary":"secondary" ?> btn-block no-print"  value="Print CAV" name="print" onclick="printCAVNow()" <?php echo (($mode1=="CAV" || $mode2=="CAV") && $cash != "")?"":"disabled" ?>>
                    </div>
                </div><br>
				<div class="row">
                    <?php if(((strtolower(!empty($client_assistance[1]['type'])) == "cash assistance") && (!empty($client_assistance[2]['type']) == "")) || ((strtolower(!empty($client_assistance[1]['type'])) == "non-food items") && (!empty($client_assistance[2]['type']) == ""))){ ?>
                        <div class="col"><a href="gis.php?id=<?php echo $_GET['id']?>" class="btn btn-success btn-block"><span class="fa fa-reply"></span> GIS</a></div>
                    <?php } else { ?>
                        <div class="col"><a href="coe.php?id=<?php echo $_GET['id']?>" class="btn btn-success btn-block"><span class="fa fa-reply"></span> COE</a></div>
                    <?php } ?>
                        <?php 
                            if($mode1 == "GL" || $mode1 == "CAV"){
                                if($cash || $gl){
                                    echo '<div class="col"><input type="submit" class="btn btn-primary btn-block no-print"  value="Update" name="update"></div>';
                                }else{
                                    echo '<div class="col"><input type="submit" class="btn btn-primary btn-block no-print"  value="Save" name="save"></div>';
                                }
                            }
                        ?>
                    <div class="col"><input type="button" class="btn btn-success btn-block no-print" id="done" value="Done" onclick="confirmdone(<?php echo "'".$id."','".$_GET['id']."'" ?>)"/></div>
                </div>
            </form>
            <div id="gl" class="printable" hidden><br>
                <?php     
                    if($mode1 == "GL"){
                        include('gl_sheet.php');
                    }
                    if(!empty($mode2)){
                        if($mode2 == "GL"){
                            include('gl_sheet2.php');
                        }
                    }
                ?>
            </div>
            <div id="cav" class="printable" hidden><br>
                <?php
                    if($mode1 == "CAV" || !empty($mode2) == "CAV"){
                        include('cash.php');
                    }
                ?>
            </div>
            <div id="attest" hidden><br>
                <?php
                        include('attestation.php');
                ?>
            </div>
			<div id="gisce" hidden><br>
			<?php 
				 include("gisv2_print.php"); 
			?>
			</div>
			<div id="coe" class="printable" hidden>
			<?php 
                if($mode1 == "CAV" || !empty($mode2) == "CAV"){
				    include("coev2_print_cav.php"); 
                }elseif($mode1 == "GL" || !empty($mode2) == "GL"){
				    include("coev2_print_gl.php"); 
                }else{
				    include("coev2_print.php"); 
                }
				
				?>
			</div>
        </div>
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
                    // console.log("require");
                    $(".for_the").attr('required', '');
                } else {
                    // console.log("wla na require");
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
                //console.log(txt);
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
    </script>

    <?php 
        //SAVA NA PART
        if(isset($_POST['save'])){
            $mode1 = "";
            $mode2 = "";
            if(!empty($client_assistance[1])){
                $mode1 = $client_assistance[1]['mode'];
            }
            if(!empty($client_assistance[2])){
                $mode2 = $client_assistance[2]['mode'];
            }
            
            if(strtolower($mode1) == "cav" || strtolower($mode2) == "cav"){

                $sd_officer = mysqli_real_escape_string($user->db,strtoupper($_POST['sd_officer']));
                                                                                        
                                                                                            
                //print_r($_POST);
                $user->insertCash($_GET['id'], $sd_officer);
            }

            if(strtolower($mode1) == "gl" || strtolower($mode2)=="gl"){
                $c_no= mysqli_real_escape_string($user->db,$_POST['c_no']);
                $signatory = mysqli_real_escape_string($user->db,strtoupper($client['signatory_GL']));
                $addressee= mysqli_real_escape_string($user->db,strtoupper($_POST['addressee']));
                $a_pos= mysqli_real_escape_string($user->db,$_POST['a_pos']);
                $forthe = '';
                if(!empty($_POST['forthebtn'])){
                    $forthe_id = explode('-',$_POST['for_the']);
                    if(!empty($forthe_id[3])){
                        $forthe = mysqli_real_escape_string($user->db,$forthe_id[3]);
                    }else{
                        $forthe = mysqli_real_escape_string($user->db,$forthe_id[2]);
                    }
                }
                $cname= mysqli_real_escape_string($user->db,$_POST['comp_name']); 
                $add = mysqli_real_escape_string($user->db,$_POST['caddress']); //company address
                $tomention= mysqli_real_escape_string($user->db,$_POST['tomention']); 
                //print_r($_POST);
                 $user->insertGL($_GET['id'], $c_no, $signatory, $addressee, $a_pos, $forthe, $cname, $add, $tomention);
            }
        }

        if(isset($_POST['update'])){
            //if client has 2 services bth GL $ CASH
            $mode1 = "";
            $mode2 = "";
            if(!empty($client_assistance[1])){
                $mode1 = $client_assistance[1]['mode'];
            }
            if(!empty($client_assistance[2])){
                $mode2 = $client_assistance[2]['mode'];
            }
            $if1 = (strtolower($mode1) == "gl" && strtolower($mode2) == "cav");
            $if2= (strtolower($mode1) == "cav" && strtolower($mode2) == "gl");

            if( $if1 || $if2 ){
                //GL 
                // print_r($_POST["c_no"]);
                $c_no= mysqli_real_escape_string($user->db,$_POST['c_no']);
                $signatory = mysqli_real_escape_string($user->db,strtoupper($client['signatory_GL']));
                $addressee= mysqli_real_escape_string($user->db,strtoupper($_POST['addressee']));
                $a_pos= mysqli_real_escape_string($user->db,$_POST['a_pos']);
                $forthe = '';
                if(!empty($_POST['forthebtn'])){
                    $forthe_id = explode('-',$_POST['for_the']);
                    if(!empty($forthe_id[3])){
                        $forthe = mysqli_real_escape_string($user->db,$forthe_id[3]);
                    }else{
                        $forthe = mysqli_real_escape_string($user->db,$forthe_id[2]);
                    }
                }
                $cname= mysqli_real_escape_string($user->db,$_POST['comp_name']); 
                $add = mysqli_real_escape_string($user->db,$_POST['caddress']); //company address
                $tomention= mysqli_real_escape_string($user->db,$_POST['tomention']); 
                //CASH
                $sd_officer = mysqli_real_escape_string($user->db,strtoupper($_POST['sd_officer']));

                $user->updateGLCash($_GET['id'], $sd_officer, $c_no, $signatory, $addressee, $a_pos, $forthe, $cname, $add, $tomention);

            }else{
                if((strtolower($mode1) == "cav" || strtolower($mode2) == "cav")){
                
                    $sd_officer = mysqli_real_escape_string($user->db,strtoupper($_POST['sd_officer']));
                    //pag empty mag insert sya kay basig gi update lang and GIS    
                    if(empty($cash)){
                        $user->insertCash($_GET['id'], $sd_officer);
                    }else{
                        $user->updateCash($_GET['id'], $sd_officer);
                    }
                }else{
                    
                    $c_no= mysqli_real_escape_string($user->db,$_POST['c_no']);
                    $signatory = mysqli_real_escape_string($user->db,strtoupper($client['signatory_GL']));
                    $addressee= mysqli_real_escape_string($user->db,strtoupper($_POST['addressee']));
                    $a_pos= mysqli_real_escape_string($user->db,$_POST['a_pos']);
                    $forthe = '';
                    if(!empty($_POST['forthebtn'])){
                        $forthe_id = explode('-',$_POST['for_the']);
                        if(!empty($forthe_id[3])){
                            $forthe = mysqli_real_escape_string($user->db,$forthe_id[3]);
                        }else{
                            $forthe = mysqli_real_escape_string($user->db,$forthe_id[2]);
                        }
                    }
                    $cname= mysqli_real_escape_string($user->db,$_POST['comp_name']); 
                    $add = mysqli_real_escape_string($user->db,$_POST['caddress']); //company address
                    $tomention = mysqli_real_escape_string($user->db,$_POST['tomention']); 
        
                    //pag empty mag insert sya kay basig gi update lang and GIS
                    if(empty($gl)){
                        $user->insertGL($_GET['id'], $c_no, $signatory, $addressee, $a_pos, $forthe, $cname, $add, $tomention);
                    }else{
                        $user->updateGL($_GET['id'], $c_no, $signatory, $addressee, $a_pos, $forthe, $cname, $add, $tomention);
                    }
                }
            }     
        }
        
    ?>
    <script type="text/javascript">
        $(document).ready(function () {
            var afterPrint = function () {
                window.location='last.php?id=<?php echo $_GET['id'] ?>';
            };

            window.onafterprint = afterPrint;
        });
    </script>
 </html>