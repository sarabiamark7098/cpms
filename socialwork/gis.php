<?php
include('../php/class.user.php');
$user = new User();

if (isset($_GET['id'])) {
    $user->setsw($_SESSION['userId'], $_GET['id']);
    $id = $user->getClient_id($_GET['id']); //id sa client
    $user->servingstatus($_GET['id']); //update data as serving
    $client = $user->clientData($_GET['id']); //kuha sa mga data sa bene/client data
    $name = $client["lastname"] . ", " . $client["firstname"] . " " . $client["middlename"] . " " . $client['extraname'];
    $bname = $client["b_lname"] . ", " . $client["b_fname"] . " " . $client["b_mname"] . " " . $client['b_exname'];
       
    $timeentry = $user->theTime($client['date_entered']);//kwaun ang time
    $client_assisstance = $user->getGISAssistance($_GET['id']);
    $client_fam = $user->getclientFam($_GET['id']);
    $gis = $user->getGISData($_GET['id']); //kwaun ang mga data if ever naa na xay inputed data sa assessment/service only
    $soc_worker = $user->getuserInfo($_SESSION['userId']);
    //fullname of social worker
    $soc_workFullname = $soc_worker['empfname'] .' '.(!empty($soc_worker['empmname'][0])?$soc_worker['empmname'][0] . '. ':''). $soc_worker['emplname'] . (!empty($soc_worker['empext'])? ' ' . $soc_worker['empext'] : '');
    
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
                <button class="btn btn-<?php echo (empty($gis) ? "success" : "secondary") ?> btn-block" <?php echo (empty($gis)?'onclick="back()"':'') ?>>
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
                <small>(Please Save/Update before printing)</small>
                <div class="form-group row">
                    <div class="card border-info mb3" style="width:100%;">
                        <h5 class="card-header text-success">FAMILY COMPOSITION</h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="col"></div>
                                <div class="col">Pangalan</div>
                                <div class="col">Edad</div>
                                <div class="col">Trabaho</div>
                                <div class="col">Buwanang Sahod</div> 
                            </div><br>
                            <div class="row">
                                <div class="col">Person 1:</div>
                                <div class="col"><input class="form-control" id="p1" name="p1" type="text"    value="<?php echo empty($client_fam[1]) ? "" : $client_fam[1]['name'] ?>"></div>
                                <div class="col"><input type= "number" class="form-control" id="e1" name="e1" max="99" onKeyPress="if(this.value.length==3) return false;" value="<?php echo empty($client_fam[1])||$client_fam[1]['age']==0? "" : $client_fam[1]['age'] ?>"></div>
                                <div class="col"><input class="form-control" id="t1" name="t1" type="text"    value="<?php echo empty($client_fam[1]) ? "" : $client_fam[1]['occupation'] ?>"></div>
                                <div class="col"><input class="form-control" onkeypress="return rangeKey(event)" id="b1" name="b1" value="<?php echo empty($client_fam[1]) ? "" : $client_fam[1]['salary'] ?>"></div>  
                            </div><br>
                            <div class="row">
                                <div class="col">Person 2:</div>
                                <div class="col"><input class="form-control" id="p2" name="p2" type="text"    value="<?php echo empty($client_fam[2]) ? "" : $client_fam[2]['name'] ?>"></div>
                                <div class="col"><input type= "number" class="form-control" id="e2" name="e2" max="99" onKeyPress="if(this.value.length==3) return false;" value="<?php echo empty($client_fam[2])||$client_fam[2]['age']==0? "" : $client_fam[2]['age'] ?>"></div>
                                <div class="col"><input class="form-control" id="t2" name="t2" type="text"    value="<?php echo empty($client_fam[2]) ? "" : $client_fam[2]['occupation'] ?>"></div>
                                <div class="col"><input class="form-control" onkeypress="return rangeKey(event)" id="b2" name="b2" value="<?php echo empty($client_fam[2]) ? "" : $client_fam[2]['salary'] ?>"></div>  
                            </div><br>
                            <div class="row">
                                <div class="col">Person 3:</div>
                                <div class="col"><input class="form-control" id="p3" name="p3" type="text"    value="<?php echo empty($client_fam[3]) ? "" : $client_fam[3]['name'] ?>"></div>
                                <div class="col"><input type= "number" class="form-control" id="e3" name="e3" max="99" onKeyPress="if(this.value.length==3) return false;" value="<?php echo empty($client_fam[3])||$client_fam[3]['age']==0? "" : $client_fam[3]['age'] ?>"></div>
                                <div class="col"><input class="form-control" id="t3" name="t3" type="text"    value="<?php echo empty($client_fam[3]) ? "" : $client_fam[3]['occupation'] ?>"></div>
                                <div class="col"><input class="form-control" onkeypress="return rangeKey(event)" id="b3" name="b3" value="<?php echo empty($client_fam[3]) ? "" : $client_fam[3]['salary'] ?>"></div>  
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="form-group row">
                    <div class="card border-info mb3" style="width:100%;">
                        <h5 class="card-header text-success" style="background:#f0edff">ASSESSMENT INFORMATION</h5>
                        <div class="card-body text-dark">
                            <div class="row">
                                <label class="col-sm-2 label" style="font-size: 18px">Client Number</label>
                                <div class="col-sm-3">
                                    <input type="number" class="form-control mr-sm-2" id="client_num" name="num" value="<?php echo empty($gis['client_num']) ? "" : $gis['client_num'] ?>" required>  
                                </div>&nbsp;
                                <label class="col-sm-3 label text-right" style="font-size: 20px">Mode of Admission</label>
                                <div class="col-sm-3">
                                <select type="text" class="form-control mr-sm-2" id="mode_ad" name="mode_ad" required>
                                        <option selected="selected"><?php echo empty($gis['mode_admission']) ? "" : $gis['mode_admission'] ?></option>
                                        <option>Walk-In</option>
                                        <option>Referral</option>
                                    </select>
                                </div>&nbsp;
                            </div><br>
                            <div class="row">
                                <div class="col">SERVICE:</div>
                                <div class="col"><input type="checkbox" id="group" class="col-lg-1" name="psy" value="Psychosocial" <?php echo $gis['service1']==0? "": "checked"; ?> required> Psychosocial</div>
                                <div class="col"><input type="checkbox" id="group" class="col-lg-1" name="leg" value="Legal Assisstance" <?php echo $gis['service2']==0? "": "checked"; ?> required> Legal Assistance</div>
                                <div class="col"><input type="checkbox" id="group" class="col-lg-1" name="ref" value="Referral" <?php echo $gis['service3']==0? "": "checked";; ?> required> Referral 
                                    <input type="text" style="border: none;border-bottom: 1px solid #000000;" id="ref_name" name="ref_name" placeholder="Type Refferal Office" value="<?php echo $gis['ref_name'] ?>">
                                </div>
                                <div class="col"><input type="checkbox" id="group" class="col-lg-1" name="fin" value="Financial Assistance" <?php echo $gis['service4']==0? "": "checked";; ?> required > Financial</div> 
                            </div><br><h5 class="text-dark">Assistance: </h5>
                            <div class="row"> 
                                <div class="col text-center">TYPE</div>
                                <div class="col text-center">PURPOSE</div>
                                <div class="col text-center">AMOUNT</div>
                                <div class="col text-center">MODE OF ASSISTANCE</div>
                                <div class="col text-center">FUND SOURCE</div> 
                            </div>
                            <div class="row"> 
                                <div class="col">
                                    <input list="types" type="text" id="type1" class="form-control" name="type1" <?php echo empty($client_assisstance[1]) ? "" : "onkeyup='verifyfirst()'" ?> required value="<?php echo empty($client_assisstance[1]) ? "" : $client_assisstance[1]['type'] ?>">
                                    <datalist id="types">
                                        <option value="Food Subsidy Assistance"></option>
                                        <option value="Medical Assistance"></option>
                                        <option value="Burial Assistance"></option>
                                        <option value="Transportation Assistance"></option>
                                        <option value="Educational Assistance"></option>
                                        <option value="Cash Assistance"></option>
                                    </datalist>
                                </div>
                                <div class="col"><input class="form-control" id="pur1" name="pur1" type="text" <?php echo empty($client_assisstance[1])? "" : "onkeyup='verifyfirst()'" ?> required value="<?php echo empty($client_assisstance[1])? "" : $client_assisstance[1]['purpose']; ?>"></div>
                                <div class="col"><input class="form-control money" id="a1" name="a1" <?php echo empty($client_assisstance[1])? "" : "onkeyup='verifyfirst()'" ?> required value="<?php echo empty($client_assisstance[1])? "" : $client_assisstance[1]['amount']; ?>"></div>
                                <div class="col">
                                    <select class="form-control" id="m1" name="m1" type="text" <?php echo empty($client_assisstance[1])? "" : "onkeyup='verifyfirst()'" ?> required>
                                        <option selected="selected"><?php echo empty($client_assisstance[1])? "" : $client_assisstance[1]['mode']; ?></option>
                                        <option>GL</option>
                                        <option>CAV</option>
                                        <option>DS</option>
                                    </select>
                                </div>
                                <div class="col"> <!--Source of Fund-->
                                    <input list="chargings" class="form-control" id="f1" name="f1" type="text" <?php echo empty($client_assisstance[1]) ? "" : "onkeyup='verifyfirst()'" ?> value="<?php echo empty($client_assisstance[1])? "" : $client_assisstance[1]['fund'] ?>" required/>
                                    <?php echo $user->chargings(); ?>
                                </div> 
                            </div><br>
                            <div class="row">
                                <div class="col">
                                    <input list="types2" type="text" id="type2" class="form-control" name="type2" <?php echo empty($client_assisstance[2]) ? "" : "onkeyup='verifysecond()'" ?> value="<?php echo empty($client_assisstance[2]) ? "" : $client_assisstance[2]['type']; ?>" onkeyup="typerequire()">
                                    <datalist id="types2">
                                        <option value="Food Subsidy Assistance"></option>
                                    </datalist>
                                </div>
                                <div class="col"><input class="form-control" id="pur2" name="pur2" <?php echo empty($client_assisstance[2]) ? "" : "onkeyup='verifysecond()'" ?> type="text" value="<?php echo empty($client_assisstance[2]) ? "" : $client_assisstance[2]['purpose']; ?>"></div>
                                <div class="col"><input class="form-control money" id="a2" name="a2" <?php echo empty($client_assisstance[2])? "" : "onkeyup='verifysecond()'" ?> value="<?php echo empty($client_assisstance[2]) ? "" : $client_assisstance[2]['amount']; ?>"></div>
                                <div class="col">
                                    <select class="form-control" id="m2" name="m2" <?php echo empty($client_assisstance[2]) ? "" : "onkeyup='verifysecond()'" ?> type="text">
                                        <option selected="selected"><?php echo empty($client_assisstance[2]['mode']) ? "" : $client_assisstance[2]['mode']; ?></option>
                                        <option>GL</option>
                                        <option>CAV</option>
                                        <option>DS</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <input list="chargings" class="form-control" id="f2" name="f2" <?php echo empty($client_assisstance[2]) ? "" : "onkeyup='verifysecond()'" ?> type="text" value="<?php echo empty($client_assisstance[2]) ? "" : $client_assisstance[2]['fund'] ?>"/>
                                </div> 
                            </div>
                            <br>
                            <div class="row"> 
                                <div class="col-lg-12">
                                    <br>
                                    <input type="hidden" name="selection" id="selection" />
                                    <select id="assess" name="swatype" class="form-control col-sm-4"  onchange="getSelectedValue();">
                                        <option value="<?php //echo empty($gis['gis_option'])?'':$gis['gis_option'] ?>" <?php //echo empty($gis['gis_option'])?'disabled':'' ?> selected><?php //echo empty($gis['gis_option'])?'Select your option':$gis['gis_option'] ?></option>;
                                            <?php 
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
                                <div class="col-lg-12">
                                    <label>Problem Presented</label>
                                    <textarea class="form-control" type="text" id="prob" name="prob" style="height:70px;font-size:12px" required><?php echo empty($gis['problem'])? "" : $gis['problem']; ?></textarea>
                                </div>
                            </div>
                            <div class="row"> 
                                <div class="col-lg-12">
                                    <label>Social Work Assessment</label>
                                    <textarea class="form-control"  style="height:75px;font-size:12px;margin-top:-8px" type="text" id="ass" name="ass" id="type" required><?php echo empty($gis['soc_ass'])? "" : $gis['soc_ass']; ?></textarea>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 15px">
                                <label class="col-sm-2 label" style="font-size: 20px">Approved by:</label>
                                <div class="col-sm-4">
                                    <input list="signatory" type="text" class="form-control mr-sm-2" id="approved" name="approved" required value="<?php echo (empty($gis['signatory_id']) ? '' : $user->getSignatoryFullname($gis['signatory_id'])); ?>" required>
                                    <datalist id="signatory">
                                        <?php
                                            $data = $user->signatoryGIS();
                                            foreach ($data as $index => $value) {
                                                $signatoryname = $value['first_name'] . " " . $value['middle_I'] . ". " . $value['last_name'];
                                                echo "<option value='" . strtoupper($signatoryname) . "-" . $value['position'] ."'></option>";
                                            }
                                        ?>
                                    </datalist>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Mga buttons-->
                <div class="form-group row" >
                    <div class="col"></div>
                    <div class="col" ><input type="button" class="btn btn-<?php echo (empty($gis) ? "secondary" : "primary") ?> btn-block"  value="Print" name="print" id="print" onclick="printGIS()" <?php echo (empty($gis) ? "disabled" : "") ?> ></div>
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
                        $("#f2").attr('required', '');
                    } else {
                        $("#a2").removeAttr('required');
                        $("#pur2").removeAttr('required');
                        $("#m2").removeAttr('required');
                        $("#f2").removeAttr('required');
                    }
            }
            
        </script>


        <?php
        if (isset($_POST['save'])) {
            $empid = $_SESSION['userId']; // id sa social worker
            $trans_id = $_GET['id'];
            //FAMILY DATA
            $p1="";$p2="";$p3="";$e1="";$e2="";$e3="";$t1="";$t2="";$t3="";$b1="";$b2="";$b3=""; //blank sa una 

            if(isset($_POST['p1'])){
                $p1 = mysqli_real_escape_string($user->db, strtoupper($_POST['p1']));
                $e1 = $_POST['e1'];
                $t1 = mysqli_real_escape_string($user->db, strtoupper($_POST['t1']));
                $b1 = mysqli_real_escape_string($user->db, $_POST['b1']);
            }

            if(isset($_POST['p2'])){
                $p2 = mysqli_real_escape_string($user->db, strtoupper($_POST['p2']));
                $e2 = $_POST['e2'];
                $t2 = mysqli_real_escape_string($user->db, strtoupper($_POST['t2']));
                $b2 = mysqli_real_escape_string($user->db, $_POST['b2']);
            }

            if(isset($_POST['p3'])){
                $p3 = mysqli_real_escape_string($user->db, strtoupper($_POST['p3']));
                $e3 = $_POST['e3'];
                $t3 = mysqli_real_escape_string($user->db, strtoupper($_POST['t3']));
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
            
            //Assisstance TAble Data's
            $num = $_POST['num']; //client number sa GIS lng
            $mode_ad = $_POST['mode_ad'];    
            $type1 = $_POST["type1"];
            $pur1 = mysqli_real_escape_string($user->db, strtoupper($_POST["pur1"]));
            $a1 = mysqli_real_escape_string($user->db, $_POST['a1']);
            $m1 = $_POST["m1"];
            $f1 = mysqli_real_escape_string($user->db, strtoupper($_POST["f1"]));

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
            
            //once save the data of new -> client
            $user->insertGIS($empid, $trans_id, $id, $p1, $p2, $p3, $e1, $e2, $e3, $t1, $t2, $t3, $b1, $b2, $b3, $s1, $s2, $s3, $s4, $ref_name,
                                    $type1, $pur1, $a1, $m1, $f1,$type2, $pur2, $a2, $m2, $f2, $mode_ad, $num, $gis_opt, $prob, $ass, $signatoryGIS);
        }

        if (isset($_POST['update'])) {
            $empid = $_SESSION['userId']; // id sa social worker
            $trans_id = $_GET['id'];
            //FAMILY DATA's
            $p1="";$p2="";$p3="";$e1="";$e2="";$e3="";$t1="";$t2="";$t3="";$b1="";$b2="";$b3=""; //blank sa una 

            if(isset($_POST['p1'])){
                $p1 = mysqli_real_escape_string($user->db, strtoupper($_POST['p1']));
                $e1 = $_POST['e1'];
                $t1 = mysqli_real_escape_string($user->db, strtoupper($_POST['t1']));
                $b1 = mysqli_real_escape_string($user->db, $_POST['b1']);
            }

            if(isset($_POST['p2'])){
                $p2 = mysqli_real_escape_string($user->db, strtoupper($_POST['p2']));
                $e2 = $_POST['e2'];
                $t2 = mysqli_real_escape_string($user->db, strtoupper($_POST['t2']));
                $b2 = mysqli_real_escape_string($user->db, $_POST['b2']);
            }

            if(isset($_POST['p3'])){
                $p3 = mysqli_real_escape_string($user->db, strtoupper($_POST['p3']));
                $e3 = $_POST['e3'];
                $t3 = mysqli_real_escape_string($user->db, strtoupper($_POST['t3']));
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
            
            //Assisstance TAble Data's
            $num = $_POST['num']; //client number sa GIS lng
            $mode_ad = $_POST['mode_ad'];    
            $type1 = $_POST["type1"];
            $pur1 = mysqli_real_escape_string($user->db, strtoupper($_POST["pur1"]));
            $a1 = mysqli_real_escape_string($user->db, $_POST['a1']);
            $m1 = $_POST["m1"];
            $f1 = mysqli_real_escape_string($user->db, strtoupper($_POST["f1"]));

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
            
            //once save the data of new -> client
            $user->updateGIS($empid, $trans_id, $id, $p1, $p2, $p3, $e1, $e2, $e3, $t1, $t2, $t3, $b1, $b2, $b3, $s1, $s2, $s3, $s4, $ref_name,
            $type1, $pur1, $a1, $m1, $f1,$type2, $pur2, $a2, $m2, $f2, $mode_ad, $num, $gis_opt, $prob, $ass, $signatoryGIS);
        }

            //UPDATE CLIENT
        if (isset($_POST['c_update'])) {
                //Client name
            echo $lname = mysqli_real_escape_string($user->db, strtoupper($_POST['lname']));
            echo $mname = mysqli_real_escape_string($user->db, strtoupper($_POST['mname']));
            echo $fname = mysqli_real_escape_string($user->db, strtoupper($_POST['fname']));
            echo $exname = mysqli_real_escape_string($user->db, strtoupper($_POST['exname']));
            echo $bday = $_POST['bday'];
            
            echo $region = mysqli_real_escape_string($user->db, ($_POST['region']));
            echo $province = mysqli_real_escape_string($user->db, ($_POST['province']));
            echo $municipality = mysqli_real_escape_string($user->db, ($_POST['municipality']));
            echo $barangay = mysqli_real_escape_string($user->db, ($_POST['barangay']));
            echo $street = mysqli_real_escape_string($user->db, ($_POST['street']));
            echo $district = mysqli_real_escape_string($user->db, ($_POST['district']));
            echo $sex = mysqli_real_escape_string($user->db, ($_POST['sex']));
            

            $user->updateClient($id, $lname, $mname, $fname, $exname, $bday, $sex, 
                            $region, $province, $municipality, $barangay, $street, $district);
        }

            //BENEFICIARY CLIENT
        if (isset($_POST['b_update'])) {

            $trans_id = $_GET['id'];
            $b_id = $user->getBene_id($trans_id);
            $relation = mysqli_real_escape_string($user->db, ucwords($_POST['relation']));
            $lname = mysqli_real_escape_string($user->db, strtoupper($_POST['lname']));
            $mname = mysqli_real_escape_string($user->db, strtoupper($_POST['mname']));
            $fname = mysqli_real_escape_string($user->db, strtoupper($_POST['fname']));
            $exname = mysqli_real_escape_string($user->db, strtoupper($_POST['exname']));
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
            $relation = mysqli_real_escape_string($user->db, ucwords($_POST['relation']));
            $lname = mysqli_real_escape_string($user->db, strtoupper($_POST['lname']));
            $mname = mysqli_real_escape_string($user->db, strtoupper($_POST['mname']));
            $fname = mysqli_real_escape_string($user->db, strtoupper($_POST['fname']));
            $exname = mysqli_real_escape_string($user->db, strtoupper($_POST['exname']));
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
            t1 = '<?php echo $client_assisstance[1]['type'] ?>';
            p1 = '<?php echo $client_assisstance[1]['purpose'] ?>';
            a1 = '<?php echo $client_assisstance[1]['amount'] ?>';
            m1 = '<?php echo $client_assisstance[1]['mode'] ?>';
            f1 = '<?php echo $client_assisstance[1]['fund'] ?>';
            t2 = $('#type1').val();
            p2 = $('#pur1').val();
            a2 = $('#a1').val();
            m2 = $('#m1').val();
            f2 = $('#f1').val();
            
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
            t1 = '<?php echo $client_assisstance[2]['type'] ?>';
            p1 = '<?php echo $client_assisstance[2]['purpose'] ?>';
            a1 = '<?php echo $client_assisstance[2]['amount'] ?>';
            m1 = '<?php echo $client_assisstance[2]['mode'] ?>';
            f1 = '<?php echo $client_assisstance[2]['fund'] ?>';
            t2 = $('#type2').val();
            p2 = $('#pur2').val();
            a2 = $('#a2').val();
            m2 = $('#m2').val();
            f2 = $('#f2').val();
            
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
</html>