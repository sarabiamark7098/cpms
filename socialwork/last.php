<?php 
fuck
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

        if($client_assistance[1]['amount'] > 5000){
            if($record){
                $COEsignatory= $user->getsignatory($record['sign_Id']); //kwaun ang data sa signatory using sign_id 
                $COEsignatoryini = strtoupper($COEsignatory['first_name'][0] ." ". $COEsignatory['middle_I'][0] .". ". $COEsignatory['last_name'][0]);
            }
        }

        $name =  $client["firstname"]." ". strtoupper($client["middlename"][0]) .". ". $client["lastname"];
		if(!empty($client['extraname'])){
			$name .= " ". $client['extraname'];
		}
		$bname =  $client["b_fname"]." ". strtoupper($client["b_mname"][0]) .". ". $client["b_lname"]."". strtoupper($client['b_exname'] != ""? " ".$client['b_exname']: "");
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

        $mode1 = "";
        $mode2 = "";

        $mode1 = $client_assistance[1]['mode'];
        
        if(!empty($client_assistance[2]['mode'])){
            $mode2 = $client_assistance[2]['mode'];
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
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm"><i>'. $client_assistance[1]['fund'] .'-</i></span>
                                                        </div>
                                                        <input type="number" class="form-control mr-sm-2 b" id="c_no" onblur="checkNum('.$_GET['id'].')" value="' .$gl['control_no']. '" name="c_no" placeholder="Control No." required>
                                                        <span id="gl_error" style="color:red"></span>
                                                    </div>
                                                </div>
                                                <div class="col"><input list="gls" type="text" class="form-control mr-sm-2 b" id="gl_signatory" name="gl_signatory" value="'.$signatoryGLNamePos.'" placeholder="Guarantee Letter Signatory" required> '. $user->signatoryGL() .' <br></div>
                                            </div><br>
                                            <h3>Providers Info</h3>
                                            <input list="providers" type="text" class="form-control mr-sm-2 b" id="comp_name" name="comp_name" value="'.$gl['cname'].'" placeholder="Providers Company Name" required><br>
                                            <datalist id="providers">'. $user->listOfProvider().'</datalist>
                                            <input type="text" class="form-control mr-sm-2 b" id="address"     name="caddress" value="'.$gl['caddress'].'" placeholder="Providers Company Address" required><br>
                                            <input type="text" class="form-control mr-sm-2 b" name="addressee" id="addressee" value="'.$gl['addressee'].'" placeholder="Addressee Name"><br>
                                            <input type="text" class="form-control mr-sm-2 b" id="a_pos"      name="a_pos" value="'.$gl['position'].'" placeholder="Addressee Position" required><br>
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
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm"><i>'. $client_assistance[1]['fund'] .'-</i></span>
                                                        </div>
                                                        <input type="number" class="form-control mr-sm-2 b" id="c_no" onblur="checkNum('.$_GET['id'].')" value="' .$gl['control_no']. '" name="c_no" placeholder="Control No." required>
                                                        <span id="gl_error" style="color:red"></span>
                                                    </div>
                                                </div>
                                                <div class="col"><input list="gls" type="text" class="form-control mr-sm-2 b" id="gl_signatory" name="gl_signatory" value="'.$signatoryGLNamePos.'" placeholder="Guarantee Letter Signatory" required> '. $user->signatoryGL() .' <br></div>
                                            </div><br>
                                            <h3>Providers Info</h3>
                                            <input list="providers" type="text" class="form-control mr-sm-2 b" id="comp_name" name="comp_name" value="'.$gl['cname'].'" placeholder="Providers Company Name" required><br>
                                            <datalist id="providers">'. $user->listOfProvider().'</datalist>
                                            <input type="text" class="form-control mr-sm-2 b" id="address"     name="caddress" value="'.$gl['caddress'].'" placeholder="Providers Company Address" required><br>
                                            <input type="text" class="form-control mr-sm-2 b" name="addressee" id="addressee" value="'.$gl['addressee'].'" placeholder="Addressee Name"><br>
                                            <input type="text" class="form-control mr-sm-2 b" id="a_pos"      name="a_pos" value="'.$gl['position'].'" placeholder="Addressee Position" required><br>
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
                    <?php if((strtolower($client_assistance[1]['type']) == "cash assistance") && ($client_assistance[2]['type'] == "") || (strtolower($client_assistance[1]['type']) == "non-food items") && ($client_assistance[2]['type'] == "")){ ?>
                    <div class="col"><a href="gis.php?id=<?php echo $_GET['id']?>" class="btn btn-success btn-block"><span class="fa fa-reply"></span> GIS</a></div>
                    <?php } else { ?>
                    <div class="col"><a href="coe.php?id=<?php echo $_GET['id']?>" class="btn btn-success btn-block"><span class="fa fa-reply"></span> COE</a></div>
                    <?php } ?>
                    <div class="col">
                        <input type="button" class="btn btn-<?php echo (($mode1=="GL" || $mode2=="GL") && $gl != "")?"primary":"secondary" ?> btn-block no-print"  value="Print GL" name="print" onclick="printGLNow()"<?php echo (($mode1=="GL" || $mode2=="GL") && $gl != "")?"":"disabled" ?>>
                    </div>
                    <div class="col">
                        <input type="button" class="btn btn-<?php echo (($mode1=="CAV" || $mode2=="CAV") && $cash != "")? "primary":"secondary" ?> btn-block no-print"  value="Print CAV" name="print" onclick="printCAVNow()"<?php echo (($mode1=="CAV" || $mode2=="CAV") && $cash != "")?"":"disabled" ?>>
                    </div>
                        <?php 
                            if($cash || $gl){
                                echo '<div class="col"><input type="submit" class="btn btn-primary btn-block no-print"  value="Update" name="update"></div>';
                            }else{
                                echo '<div class="col"><input type="submit" class="btn btn-primary btn-block no-print"  value="Save" name="save" ></div>';
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
                $signatory = mysqli_real_escape_string($user->db,strtoupper($_POST['gl_signatory']));
                $addressee= mysqli_real_escape_string($user->db,strtoupper($_POST['addressee']));
                $a_pos= mysqli_real_escape_string($user->db,$_POST['a_pos']);
                $cname= mysqli_real_escape_string($user->db,$_POST['comp_name']); 
                $add = mysqli_real_escape_string($user->db,$_POST['caddress']); //company address
                //print_r($_POST);
                $user->insertGL($_GET['id'], $c_no, $signatory, $addressee, $a_pos, $cname, $add);
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
                $c_no= mysqli_real_escape_string($user->db,$_POST['c_no']);
                $signatory = mysqli_real_escape_string($user->db,strtoupper($_POST['gl_signatory']));
                $addressee= mysqli_real_escape_string($user->db,strtoupper($_POST['addressee']));
                $a_pos= mysqli_real_escape_string($user->db,$_POST['a_pos']);
                $cname= mysqli_real_escape_string($user->db,$_POST['comp_name']); 
                $add = mysqli_real_escape_string($user->db,$_POST['caddress']); //company address
                //CASH
                $sd_officer = mysqli_real_escape_string($user->db,strtoupper($_POST['sd_officer']));

                $user->updateGLCash($_GET['id'], $sd_officer, $c_no, $signatory, $addressee, $a_pos, $cname, $add);

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
                    $signatory = mysqli_real_escape_string($user->db,strtoupper($_POST['gl_signatory']));
                    $addressee= mysqli_real_escape_string($user->db,strtoupper($_POST['addressee']));
                    $a_pos= mysqli_real_escape_string($user->db,$_POST['a_pos']);
                    $cname= mysqli_real_escape_string($user->db,$_POST['comp_name']); 
                    $add = mysqli_real_escape_string($user->db,$_POST['caddress']); //company address
        
                    //pag empty mag insert sya kay basig gi update lang and GIS
                    if(empty($gl)){
                        $user->insertGL($_GET['id'], $c_no, $signatory, $addressee, $a_pos, $cname, $add);
                    }else{
                        $user->updateGL($_GET['id'], $c_no, $signatory, $addressee, $a_pos, $cname, $add);
                    }
                }
                
            
        

            }     
        }
        
    ?>
 </html>