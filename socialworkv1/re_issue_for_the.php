<?php 
    include('../php/class.user.php');
    $user = new User();
    
    if(isset($_GET['d'])){
        if($_GET['d']==1){
            $result = $user->ReissueDocument($_GET['id']);
            echo "<script>window.location='reissue.php'</script>";
        }
    }

    if(isset($_GET['id'])){
        $id = $user->getClientId($_GET['id']);
        $client = $user->clientData($_GET['id']); ; //kuha sa mga data sa bene/client data
        $client_assistance = $user->getGISAssistance($_GET['id']); //kuha sa data sa assistance table
        $signatoryGL = $user->getsignatory($client['signatory_GL']); 
        
        $name =  $client["firstname"]." ". (!empty($client["middlename"][0])?($client["middlename"][0] != " "?strtoupper($client["middlename"][0]) .". ":""):""). $client["lastname"];
		if(!empty($client['extraname'])){
			$name .= " ". $client['extraname'].".";
		}
		$bname =  $client["b_fname"]." ". (!empty($client["b_mname"][0])?($client["b_mname"][0] != " "?strtoupper($client["b_mname"][0]) .". ":""):""). $client["b_lname"]."". strtoupper($client['b_exname'] != ""? " ".$client['b_exname'].".": "");
        $signatoryGLNamePos = "";
        if(!empty($signatoryGL)){
            $signatoryGLNamePos = strtoupper($signatoryGL['first_name'] ." ". (!empty($signatoryGL['middle_I'])?$signatoryGL['middle_I'] .". ":""). $signatoryGL['last_name'] ."-". $signatoryGL['position'] ."-". $signatoryGL['initials']);
        }
        $am = str_replace(",","",$client_assistance[1]['amount']);
        if($am > 20000){
            $COEsignatoryini= $user->getinitialsSignatory($client['signatory_id']); //kwaun ang data sa signatory using sign_id 
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
        $fundsourcedata = $user->getfundsourcedata($_GET['id']);

        $mode1 = "";
        $mode2 = "";

        $mode1 = $client_assistance[1]['mode'];
        
        if(!empty($client_assistance[2]['mode'])){
            $mode2 = $client_assistance[2]['mode'];
        }
        if(!empty($gl['for_the_id'])){
            $signatoryforthe = $user->getsignatory($gl['for_the_id']);
            $z = explode('/', $signatoryGL['position']);
            if(!empty($z[1])){ 
                $forthepositiongl = $z[1];
            }else{
                $forthepositiongl = $z[0];
            }
            $ftsignatoryini= $user->getinitialsSignatory($gl['for_the_id']);
        }
    }

    if(isset($_POST['update'])){
        $forthe_id = explode('-',$_POST['for_the']);
        if(!empty($forthe_id[3])){
            $forthe = mysqli_real_escape_string($user->db,$forthe_id[3]);
        }else{
            $forthe = mysqli_real_escape_string($user->db,$forthe_id[2]);
        }
        
        $user->update_for_the_print($_GET['id'], $forthe);
        
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
		<meta charset="utf-8">
		<!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link rel="icon" type="image/png" href="../images/icons/ciu.ico"/>
		<link rel="stylesheet" href="../css/coe.css">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
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
		
        <script type="text/javascript" src="../js/jquery-3.2.1.slim.min.js"></script>
        <script type="text/javascript" src="../js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../js/main.js"></script>
        <script type="text/javascript" src="../js/jquery.min.js"></script>
		<script type="text/javascript" src="../js/bootstrap-3.3.7.min.js"></script>
        <title>RE-ISSUE</title>
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
            @page {
                size: 8.5in 13in;
                margin: .10in /* change the margins as you want them to be. */
            }

            @media print{
                html, body {
                    width: 210mm;
                    height: 297mm;
                }
            }
		</style>
    </head>
    <script>
        function re_issue_for_the(name, id){
            if(confirm('Are you sure you want to re-issue with "For the" '+ name + '?')){
                var divElements = document.getElementById('gl').innerHTML;
                //set una para pag set sa div na e print naa nay value
                //pag naa xay beneficiary ~ kani e prin
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
                window.location='re_issue_for_the.php?id=' + id + '&d=1';
            }else{
                console.log('unconfirm!');
            }
                
        }

            function back(){
                window.location='reissue.php';
            }
    </script>
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
            <div class="container">
                <div class="row">
                    <div class="container">
                        <div class="card">
                            <div class="card-header bg-success border-success text-white">
                                <b>Client Info</b>
                            </div>
                            <div class="card-body">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-2">
                                            <label for="email"> <b>Client Name</b></label>
                                        </div>
                                        <div class="col-10">
                                        <input type="email" class="form-control text-dark" value="<?php echo $name ?>" readonly>
                                        </div>
                                    </div><br>
                                    <?php if(!empty($bname)){ if($bname != " "){ ?>
                                    <div class="row">
                                        <div class="col-2">
                                            <label for="email"> <b>Beneficiary Name</b></label>
                                        </div>
                                        <div class="col-10">
                                        <input type="email" class="form-control text-dark" value="<?php echo $bname ?>" readonly>
                                        </div>
                                    </div><br>
                                    <?php }} ?>
                                    <div class="row">
                                        <div class="col-2">
                                            <label for="email"> <b>Service</b></label>
                                        </div>
                                        <div class="col-10">
                                            <input type="email" class="form-control text-dark" value="<?php echo $client_assistance[1]['type'] ?>" readonly>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-2">
                                            <label for="email"> <b>Amount</b></label>
                                        </div>
                                        <div class="col-10">
                                            <input type="email" class="form-control text-dark" value="<?php echo $client_assistance[1]['amount'] ?>" readonly>
                                        </div>
                                    </div><br>
                                    <?php if(isset($client_assistance[2])){ ?>
                                    <div class="row">
                                        <div class="col-2">
                                            <label for="email"> <b>Second Service</b></label>
                                        </div>
                                        <div class="col-10">
                                            <input type="email" class="form-control text-dark" value="<?php echo $client_assistance[2]['type'] ?>" readonly>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-2">
                                            <label for="email"> <b>Second Amount</b></label>
                                        </div>
                                        <div class="col-10">
                                            <input type="email" class="form-control text-dark" value="<?php echo $client_assistance[2]['amount'] ?>" readonly>
                                        </div>
                                    </div><br>
                                <?php }?>
                                    <div class="row">
                                        <div class="col-2">
                                            <label for="email"> <b>Date Accomplished</b></label>
                                        </div>
                                        <div class="col-10">
                                            <input type="email" class="form-control text-dark" value="<?php echo date("F j, Y, g:i a", strtotime($client['date_accomplished'])) ?>" readonly>
                                        </div>
                                    </div><br>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                            
            <form action="re_issue_for_the.php?id=<?php echo $_GET['id']?>" method="post"  class="form-horizontal">
                <?php  if($mode1 == "GL"){ ?>
                        <div class="container">
                            <div class="row">
                                <div class="container">
                                    <div class="card">
                                        <div class="card-header bg-success border-success text-white">
                                            <b>Guarantee Letter Information </b>
                                        </div>
                                        <div class="card-body">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-2">
                                                        <label for="email"> <b>GL NUMBER (mode-number)</b></label>
                                                    </div>
                                                    <div class="col-10">
                                                    <input type="email" class="form-control text-dark" <?php echo empty($client_assistance[1]) ? "" : "onkeyup='verifyfirst()'" ?> value="<?php echo (empty($fundsourcedata[1]['fundsource'])? "" : (empty($fundsourcedata[2]['fundsource'])?$fundsourcedata[1]['fundsource']:$fundsourcedata[1]['fundsource'].'/'.$fundsourcedata[2]['fundsource'].''.(!empty($fundsourcedata[3]['fundsource'])?'/'.$fundsourcedata[3]['fundsource']:"").''.(!empty($fundsourcedata[4]['fundsource'])?'/'.$fundsourcedata[4]['fundsource']:"").''.(!empty($fundsourcedata[5]['fundsource'])?'/'.$fundsourcedata[5]['fundsource']:"")) ."-". $gl['control_no']) ?>" readonly>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-2">
                                                        <label for="email"> <b>SIGNATORY</b></label>
                                                    </div>
                                                    <div class="col-10">
                                                    <input type="email" class="form-control text-dark" value="<?php echo $signatoryGLNamePos ?>" readonly>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="header h4">
                                                    <b>Providers Information</b>
                                                </div><br>
                                                <div class="row">
                                                    <div class="col-2">
                                                        <label for="email"> <b>Company name:</b></label>
                                                    </div>
                                                    <div class="col-10">
                                                    <input type="email" class="form-control text-dark" value="<?php echo $gl['cname'] ?>" readonly>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-2">
                                                        <label for="email"> <b>Company Address:</b></label>
                                                    </div>
                                                    <div class="col-10">
                                                    <input type="email" class="form-control text-dark" value="<?php echo $gl['caddress'] ?>" readonly>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-2">
                                                        <label for="email"> <b>Addressee Name:</b></label>
                                                    </div>
                                                    <div class="col-10">
                                                    <input type="email" class="form-control text-dark" value="<?php echo $gl['addressee'] ?>" readonly>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-2">
                                                        <label for="email"> <b>Addressee Position:</b></label>
                                                    </div>
                                                    <div class="col-10">
                                                    <input type="email" class="form-control text-dark" value="<?php echo $gl['position'] ?>" readonly>
                                                    </div>
                                                </div>
                                                <br>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="container">
                                    <div class="card">
                                        <div class="card-header bg-success border-success text-white">
                                            <b>"For the" Signatory</b>
                                        </div>
                                        <div class="card-body">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-2">
                                                        <label for="email"> <b>Signatory: </b></label>
                                                    </div>
                                                    <div class="col-10">
                                                    <input list="signatory" type="text" class="form-control mr-sm-2 for_the" id="for_the" name="for_the" placeholder="Select For the Signatory" value="<?php echo (empty($gl['for_the_id']) ? '' : $user->getSignatoryFullname($gl['for_the_id'])) ?>">
                                                        <datalist id="signatory">
                                                        <?php
                                                            $data = $user->signatoryGIS();
                                                            foreach ($data as $index => $value) {
                                                                $signatoryname = $value['first_name'] . " " . $value['middle_I'] . ". " . $value['last_name'];
                                                                echo "<option value='" . strtoupper($signatoryname) . "-" . $value['position'] . "-" . $value['signatory_id'] ."'></option>";
                                                            }
                                                        ?>
                                                        </datalist>
                                                    </div>
                                                </div>
                                                <br><br>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <input class="btn btn-dark btn-block" id="btnBack"  value="Back" onclick="back()">
                                </div>
                                <div class="col-4">
                                    <input type="submit" class="btn btn-primary btn-block no-print"  value="Update" name="update" >
                                </div>
                                <div class="col-4">
                                    <input class="btn btn-primary btn-block"  value="Print" onclick="re_issue_for_the('<?php echo $name?>', '<?php echo $_GET['id']?>')">
                                </div>
                            </div>
                        </div>
                    


                <?php } ?>
                
            </form>
            <div id="gl" class="printable" hidden><br>
                <?php     
                    if($mode1 == "GL"){
                        include('re_issueGL_for_the.php');
                    }
                ?>
            </div>
        </div>
    </body>

 </html>