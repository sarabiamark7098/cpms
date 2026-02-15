<?php 
    include('../php/class.user.php');
    $user = new User();
    
    if(isset($_GET['d'])){
        if($_GET['d']==1){
            echo "<script>window.location='home.php'</script>";
        }
    }

    if(isset($_GET['id'])){
        $id = $user->getClientId($_GET['id']);
        $client = $user->clientData($_GET['id']); ; //kuha sa mga data sa bene/client data
        $client_assistance = $user->getGISAssistance($_GET['id']); //kuha sa data sa assistance table
        $signatoryGL = $user->getsignatory($client['signatory_GL']); 
        $osap = $user->getosap($_GET['id']);
        
        $name =  $client["firstname"]." ". (!empty($client["middlename"])?strtoupper($client["middlename"][0]) .". ":"")."". $client["lastname"];
		if(!empty($client['extraname'])){
			$name .= " ". $client['extraname'];
		}
		$bname =  $client["b_fname"]." ". (!empty($client["b_mname"])?strtoupper($client["b_mname"][0]) .". ":"")."". $client["b_lname"]."". strtoupper($client['b_exname'] != ""? " ".$client['b_exname']: "");
        $signatoryGLNamePos = "";
        if(!empty($signatoryGL)){
            $signatoryGLNamePos = strtoupper($signatoryGL['first_name'] ." ". $signatoryGL['middle_I'] .". ". $signatoryGL['last_name'] ."-". $signatoryGL['position'] ."-". $signatoryGL['initials']);
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

        $wordamount = $user->toWord($client_assistance[1]['amount']);

        if(!empty($osap)){
            $osap_data = explode("-", $osap['signatory']);
            $signature_osap_ini = $user->getinitialsSignatory($osap_data[2]);
            $encoder = $user->getEmpData($_SESSION['userId']);
            $encode = explode(" ", $encoder['empfname']);
            // $encoder_ini = $user->getinitials($osap['empid']);
        }
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
        function create_osap(name, id){
            if(confirm('Are you sure you want to create OSAP for '+ name + '?')){
                var divElements = document.getElementById('osap').innerHTML;
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
                window.location='osap_page.php?id=' + id + '&d=1';
            }else{
                console.log('unconfirm!');
            }
                
        }

            function back(){
                window.location='home.php';
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
        <br><br><br>
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
                                    <div class="row">
                                        <div class="col-2">
                                            <label for="email"> <b>Beneficiary Name</b></label>
                                        </div>
                                        <div class="col-10">
                                        <input type="email" class="form-control text-dark" value="<?php echo (!empty($client['b_fname'])?$bname:"Self") ?>" readonly>
                                        </div>
                                    </div><br>
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
                                    <!-- <?php //if(isset($client_assistance[2])){ ?>
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
                                    <?php // }?> -->
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
                            
            <form action="osap_page.php?id=<?php echo $_GET['id']?>" method="post"  class="form-horizontal">
                <?php  // if($mode1 == "GL"){ ?>
                        <div class="container">
                            <div class="row">
                                <div class="container">
                                    <div class="card">
                                        <div class="card-header bg-success border-success text-white">
                                            <b>OSAP </b>
                                        </div>
                                        <div class="card-body">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-2">
                                                        <label for="email"> <b>Requested by</b></label>
                                                    </div>
                                                    <div class="col-10">
                                                    <input type="text" name="req_by" class="form-control text-dark text-capitalize" value="<?php echo (!empty($osap['requested_by'])?$osap['requested_by']:'') ?>" placeholder="Lastname" required>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-2">
                                                        <label for="email"> <b>SIGNATORY</b></label>
                                                    </div>
                                                    <div class="col-10">
                                                        <input type="text" list="signatory" class="form-control text-dark" name="signatory_osap" value="<?php echo (!empty($osap['signatory'])?$osap['signatory']:'') ?>" placeholder="Signatory" required>
                                                        <datalist id="signatory">
                                                            <?php
                                                                // $data = $user->signatoryGL();
                                                                $data = $user->signatory();
                                                                foreach ($data as $index => $value) {
                                                                    $signatoryname = $value['first_name'] . " " . $value['middle_I'] . ". " . $value['last_name'];
                                                                    echo "<option value='" . strtoupper($signatoryname) . "-" . $value['position'] ."-". $value['signatory_id'] ."'></option>";
                                                                }
                                                                $data2 = $user->signatoryosap();
                                                                foreach ($data2 as $index => $value) {
                                                                    $positionsocialworker = "CIS Social Worker";
                                                                    $signatoryname = $value['empfname'] . " " . (!empty($value['empmname'])?$value['empmname'] . ". ":"") . $value['emplname'] . " " . (!empty($value['empext'])?$value['empext'].".":"");
                                                                    echo "<option value='" . strtoupper($signatoryname) . "-" . $positionsocialworker ."-". $value['empid'] ."'></option>";
                                                                }
                                                            ?>
                                                        </datalist>
                                                    </div>
                                                </div>
                                                <br>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <input class="btn btn-dark btn-block" id="btnBack"  value="Back" onclick="back()">
                                </div>
                                <div class="col-3">
                                </div>
                                <div class="col-3">
                                    <?php if(empty($osap)){ ?>
                                        <button type="submit" class="btn btn-success btn-block" name="save" >Save</button>
                                    <?php } else { ?>
                                        <button type="submit" class="btn btn-success btn-block" name="update" >Update</button>
                                    <?php } ?>
                                </div>
                                <div class="col-3">
                                    <input class="btn btn-<?php echo (!empty($osap)?'primary':'secondary') ?> btn-block" <?php echo (!empty($osap)?'':'disabled') ?> value="Print" onclick="create_osap('<?php echo $name?>', '<?php echo $_GET['id']?>')">
                                </div>
                            </div>
                        </div>
                    


                <?php //} ?>
                
            </form>
            <div id="osap" class="printable" hidden><br>
                <?php     
                    include('osap.php');
                ?>
            </div>
        </div>
        <?php 
        //SAVA NA PART
        if(isset($_POST['save'])){
                $transid= mysqli_real_escape_string($user->db,$_GET['id']);
                $req_by= mysqli_real_escape_string($user->db,ucwords(strtolower($_POST['req_by'])));
                $signatory = mysqli_real_escape_string($user->db,$_POST['signatory_osap']);
                $result = $user->create_osap($transid, $req_by, $signatory);

                if($result){
    				echo "<script>alert('Successfully Saved!');</script>";
    				echo "<meta http-equiv='refresh' content='0'>";
                }else{
                	echo "<script>alert('Some Error Occurred! Saving Failed');</script>";
    				echo "<meta http-equiv='refresh' content='0'>";
                }
        }
        if(isset($_POST['update'])){
                $transid= mysqli_real_escape_string($user->db,$_GET['id']);
                $req_by= mysqli_real_escape_string($user->db,ucwords(strtolower($_POST['req_by'])));
                $signatory = mysqli_real_escape_string($user->db,$_POST['signatory_osap']);
                $result = $user->update_osap($transid, $req_by, $signatory);

                if($result){
    				echo "<script>alert('Successfully Updated!');</script>";
    				echo "<meta http-equiv='refresh' content='0'>";
                }else{
                	echo "<script>alert('Some Error Occurred! Updating Failed');</script>";
    				echo "<meta http-equiv='refresh' content='0'>";
                }
        }
        
    ?>
    </body>
 </html>