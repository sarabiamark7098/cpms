<?php 
    include('../php/class.user.php');
	$user = new User();

    if(isset($_GET['id'])){
        $id = $user->getClientId($_GET['id']); //id sa client
        $client = $user->clientData($_GET['id']); //kuha sa mga data sa bene/client data
        $client_assistance = $user->getGISAssistance($_GET['id']); //kuha sa data sa assistance table

        $gis = $user->getGISData($client['trans_id']);
        $timeentry = $user->theTime($client['date_entered']);//kwaun ang time
        $client_fam = $user->getclientFam($_GET['id']);
        // print_r($client_fam);
        $GISsignatory=$user->getsignatory($gis['signatory_id']); //get data sa GIS na signatory
        $GISsignatoryName = strtoupper((!empty($GISsignatory['name_title'])?($GISsignatory['name_title'] != " "?$GISsignatory['name_title'] ." ":""):""). $GISsignatory['first_name'] ." ". (!empty($GISsignatory['middle_I'])?($GISsignatory['middle_I'] != " "?$GISsignatory['middle_I'] .". ":""):""). $GISsignatory['last_name']);
        $GISsignatoryPosition = $GISsignatory['position'];
        
		$name =  $client["firstname"]." ". (!empty($client["middlename"][0])?($client["middlename"][0] != " "?strtoupper($client["middlename"][0]) .". ":""):""). $client["lastname"]." ". (!empty($client['extraname'])?$client['extraname'].".":"");
        $bname =  $client["b_fname"]." ". (!empty($client["b_mname"][0])?($client["b_mname"][0] != " "?strtoupper($client["b_mname"][0]) .". ":""):""). $client["b_lname"]." ". (!empty($client['b_exname'])?$client['b_exname'].".":""); 
        if(!empty($client["b_lname"])){
			$today = date("Y-m-d");
			$diff = date_diff(date_create($client['b_bday']), date_create($today));
			$age_bene = $diff->format('%y');
		}elseif(!empty($client["lastname"])){
			$today = date("Y-m-d");
			$diff = date_diff(date_create($client['date_birth']), date_create($today));
			$age_client = $diff->format('%y');
		}else{
			$age_bene = "";
		}
		
		$soc_worker = $user->getuserInfo($_SESSION['userId']);
        //fullname of social worker
        $soc_workFullname = $soc_worker['empfname'] .' '.(!empty($soc_worker['empmname'][0])?$soc_worker['empmname'][0] . '. ':''). $soc_worker['emplname'] . (!empty($soc_worker['empext'])? ' ' . $soc_worker['empext'] . '.' : '');
        
        $clientbarangay = explode(" /", $client["client_barangay"]);
		$clientmunicipality = explode(" /", $client["client_municipality"]);
		$clientprovince = explode(" /", $client["client_province"]);
        
        $address = '';
		if(!empty($client["client_street"])){
			$address .= $client["client_street"].", ";
		}
        $address .= $clientbarangay[0].", ". $clientmunicipality[0] .", ". $clientprovince[0];
        
        $amountToWord = $user->toWord($client_assistance[1]['amount']);
  
        $record = $user->getCOEData($_GET['id']); //kwaun ang data sa coe table
        $fundsourcedata = $user->getfundsourcedata($_GET['id']);
        
        if($record){
            $COEsignatory= $user->getsignatory($client['signatory_GL']); //kwaun ang data sa signatory using sign_id 
            $COEsignatoryName = (!empty($COEsignatory['name_title'])?$COEsignatory['name_title'] ." ":""). strtoupper($COEsignatory['first_name'] ." ". (!empty($COEsignatory['middle_I'])?$COEsignatory['middle_I'] .". ":""). $COEsignatory['last_name']);
        }
        
        $soc_worker = $user->getuserInfo($_SESSION['userId']); //get soc-worker data from database
    
        $am = (str_replace(",","",$client_assistance[1]['amount']));
        $am2 = "";
        
        if(!empty($client_assistance[2]['amount'])){
			$amountToWord2 = $user->toWord($client_assistance[2]['amount']);
			$am2 = (str_replace(",","",$client_assistance[2]['amount']));
        }
        //print_r($record);
        $fund2 = "";
        
        if(!empty($client_assistance[2]['fund'])){
            $fund2 = explode("/",$client_assistance[2]['fund']);
        }
        $type = strval($client_assistance[1]['type']);
        $rec_amount = 50001;
		
		$GLsignatory=$user->getsignatory($client['signatory_GL']); //get data sa GIS na signatory
        $GLsignatoryName = strtoupper((!empty($GLsignatory['name_title'])?($GLsignatory['name_title'] != " "?$GLsignatory['name_title'] ." ":""):""). $GLsignatory['first_name'] ." ". (!empty($GLsignatory['middle_I'])?($GLsignatory['middle_I'] != " "?$GLsignatory['middle_I'] .". ":""):""). $GLsignatory['last_name']);
        $GLsignatoryPosition = $GLsignatory['position'];
		
        $mode1 = $client_assistance[1]['mode'];
        $cash = $user->getCash($_GET['id']); //cash table
    }

    if(isset($_GET['option'])){
        if($_GET['option'] = 2){
            if(!empty($record)){
                echo "<script>window.location='last.php?id=".$_GET['id']."'</script>";
            }else{
                echo "<script>window.location='coe.php?id=".$_GET['id']."'</script>";
            }
        }
    }
		
		

?>
<?php
	if(!$_SESSION['login']){
		header('Location:../index.php');
		}
?> 

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"> 
        <script type="text/javascript" src="../js/maince.js"></script>
        <link rel="icon" type="image/png" href="../images/icons/ciu.ico"/>
        <script type="text/javascript" src="../js/jquery.min.js"></script>
        <script type="text/javascript" src="../js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../js/jquery.mask.min.js"></script>
        <title>COE</title>
        <style>
            input[type=checkbox]
            {
                /* Double-sized Checkboxes */
                -ms-transform: scale(2); /* IE */
                -moz-transform: scale(2); /* FF */
                -webkit-transform: scale(2); /* Safari and Chrome */
                -o-transform: scale(2); /* Opera */
                padding: 10px;
                margin: 10px;
                font-size: 20px;
            }
            input{
                background: transparent;
                border: none;
                border-bottom: 1px solid #000000;
                -webkit-box-shadow: none;
                box-shadow: none;
                border-radius: 0;
            }
            #center-input{
                padding-left:10px;
                width:45px;
                text-align:center;
            }
            .row{
                font-size: 20px;
                font-family: Geneva, Verdana, sans-serif Arial, sans-serif;
            }
        </style>   
        <script>
            $(document).ready(function () {
                var afterPrint = function () {
                    window.location='coe.php?id=<?php echo $_GET['id'] ?>';
                };

                window.onafterprint = afterPrint;
            });
                $(document).ready(function() {
                    var totaldist = parseFloat("<?php echo $am; ?>");
                    var amount1 = parseFloat(0.00);
                    var amount2 = parseFloat(0.00);
                    var amount3 = parseFloat(0.00);
                    var amount4 = parseFloat(0.00);
                    var amount5 = parseFloat(0.00);
                    var amount6 = parseFloat(0.00);
                    var amount7 = parseFloat(0.00);
                    var amount8 = parseFloat(0.00);
                    var amount9 = parseFloat(0.00);
                    var amount10 = parseFloat(0.00);
                    var amount11 = parseFloat(0.00);
                    var amount12 = parseFloat(0.00);

                    var amountf1 = document.getElementById("amountf1");
                    if(amountf1 !== null && document.getElementById("amountf1").value.length > 0){
                        amount1 = document.getElementById("amountf1").value;
                        amount1 = parseFloat(amount1.replace(",",""));
                    }
                    if($("#amountf2").val() != undefined){
                        if(document.getElementById("amountf2").value.length > 0){
                            amount2 = document.getElementById("amountf2").value;
                            amount2 = parseFloat(amount2.replace(",",""));
                        }
                    }
                    if($("#amountf3").val() != undefined){
                        if(document.getElementById("amountf3").value.length > 0){
                            amount3 = document.getElementById("amountf3").value;
                            amount3 = parseFloat(amount3.replace(",",""));
                        }
                    }
                    if($("#amountf4").val() != undefined){
                        if(document.getElementById("amountf4").value.length > 0){
                            amount4 = document.getElementById("amountf4").value;
                            amount4 = parseFloat(amount4.replace(",",""));
                        }
                    }
                    if($("#amountf5").val() != undefined){
                        if(document.getElementById("amountf5").value.length > 0){
                            amount5 = document.getElementById("amountf5").value;
                            amount5 = parseFloat(amount5.replace(",",""));
                        }
                    }
                    if($("#amountf6").val() != undefined){
                        if(document.getElementById("amountf6").value.length > 0){
                            amount6 = document.getElementById("amountf6").value;
                            amount6 = parseFloat(amount6.replace(",",""));
                        }
                    }
                    if($("#amountf7").val() != undefined){
                        if(document.getElementById("amountf7").value.length > 0){
                            amount7 = document.getElementById("amountf7").value;
                            amount7 = parseFloat(amount7.replace(",",""));
                        }
                    }
                    if($("#amountf8").val() != undefined){
                        if(document.getElementById("amountf8").value.length > 0){
                            amount8 = document.getElementById("amountf8").value;
                            amount8 = parseFloat(amount8.replace(",",""));
                        }
                    }
                    if($("#amountf9").val() != undefined){
                        if(document.getElementById("amountf9").value.length > 0){
                            amount9 = document.getElementById("amountf9").value;
                            amount9 = parseFloat(amount9.replace(",",""));
                        }
                    }
                    if($("#amountf10").val() != undefined){
                        if(document.getElementById("amountf10").value.length > 0){
                            amount10 = document.getElementById("amountf10").value;
                            amount10 = parseFloat(amount10.replace(",",""));
                        }
                    }
                    if($("#amountf11").val() != undefined){
                        if(document.getElementById("amountf11").value.length > 0){
                            amount11 = document.getElementById("amountf11").value;
                            amount11 = parseFloat(amount11.replace(",",""));
                        }
                    }
                    if($("#amountf12").val() != undefined){
                        if(document.getElementById("amountf12").value.length > 0){
                            amount12 = document.getElementById("amountf12").value;
                            amount12 = parseFloat(amount12.replace(",",""));
                        }
                    }
                    
                    
                    var total = Number(0.00);
                    var total2 = Number(0.00);
                    $("#totalamount").val(CurrencyFormat(totaldist));
                    $("#dtotalamount").val(0.00);
                    
                    var amountf1 = document.getElementById("amountf1");
                    if(amountf1 !== null && document.getElementById("amountf1").value.length > 0){
                        total = parseFloat(amount1 + amount2 + amount3 + amount4 + amount5 + amount6 + amount7 + amount8 + amount9 + amount10 + amount11 + amount12);
                        total = parseFloat(totaldist - total);
                        
                        // total = parseFloat(Number(total).toFixed(2))
                        $("#totalamount").val(CurrencyFormat(total));
                        total2 = parseFloat(amount1 + amount2 + amount3 + amount4 + amount5 + amount6 + amount7 + amount8 + amount9 + amount10 + amount11 + amount12);
                        // total2 = parseFloat(Number(total2).toFixed(2));
                        $("#dtotalamount").val(CurrencyFormat(total2));
                    }

                    $("#amountf1, #amountf2, #amountf3, #amountf4, #amountf5, #amountf6, #amountf7, #amountf8, #amountf9, #amountf10, #amountf11, #amountf12").keyup(function() {
                        amount1 = parseFloat(0);
                        // console.log(amount1);
                        amount2 = parseFloat(0);
                        // console.log(amount2);
                        amount3 = parseFloat(0);
                        // console.log(amount3);
                        amount4 = parseFloat(0);
                        // console.log(amount4);
                        amount5 = parseFloat(0);
                        // console.log(amount5);
                        amount6 = parseFloat(0);
                        // console.log(amount5);
                        amount7 = parseFloat(0);
                        // console.log(amount5);
                        amount8 = parseFloat(0);
                        // console.log(amount3);
                        amount9 = parseFloat(0);
                        // console.log(amount4);
                        amount10 = parseFloat(0);
                        // console.log(amount5);
                        amount11 = parseFloat(0);
                        // console.log(amount5);
                        amount12 = parseFloat(0);
                        // console.log(amount5);
                        if(document.getElementById("amountf1").value.length > 0){
                            amount1 = document.getElementById("amountf1").value;
                            amount1 = parseFloat(amount1.replace(",",""));
                        }
                        if($("#amountf2").val() != undefined){
                            if(document.getElementById("amountf2").value.length > 0){
                                amount2 = document.getElementById("amountf2").value;
                                amount2 = parseFloat(amount2.replace(",",""));
                            }
                        }
                        if($("#amountf3").val() != undefined){
                            if(document.getElementById("amountf3").value.length > 0){
                                amount3 = document.getElementById("amountf3").value;
                                amount3 = parseFloat(amount3.replace(",",""));
                            }
                        }
                        if($("#amountf4").val() != undefined){
                            if(document.getElementById("amountf4").value.length > 0){
                                amount4 = document.getElementById("amountf4").value;
                                amount4 = parseFloat(amount4.replace(",",""));
                            }
                        }
                        if($("#amountf5").val() != undefined){
                            if(document.getElementById("amountf5").value.length > 0){
                                amount5 = document.getElementById("amountf5").value;
                                amount5 = parseFloat(amount5.replace(",",""));
                            }
                        }
                        if($("#amountf6").val() != undefined){
                            if(document.getElementById("amountf6").value.length > 0){
                                amount6 = document.getElementById("amountf6").value;
                                amount6 = parseFloat(amount6.replace(",",""));
                            }
                        }
                        if($("#amountf7").val() != undefined){
                            if(document.getElementById("amountf7").value.length > 0){
                                amount7 = document.getElementById("amountf7").value;
                                amount7 = parseFloat(amount7.replace(",",""));
                            }
                        }
                        if($("#amountf8").val() != undefined){
                            if(document.getElementById("amountf8").value.length > 0){
                                amount8 = document.getElementById("amountf8").value;
                                amount8 = parseFloat(amount8.replace(",",""));
                            }
                        }
                        if($("#amountf9").val() != undefined){
                            if(document.getElementById("amountf9").value.length > 0){
                                amount9 = document.getElementById("amountf9").value;
                                amount9 = parseFloat(amount9.replace(",",""));
                            }
                        }
                        if($("#amountf10").val() != undefined){
                            if(document.getElementById("amountf10").value.length > 0){
                                amount10 = document.getElementById("amountf10").value;
                                amount10 = parseFloat(amount10.replace(",",""));
                            }
                        }
                        if($("#amountf11").val() != undefined){
                            if(document.getElementById("amountf11").value.length > 0){
                                amount11 = document.getElementById("amountf11").value;
                                amount11 = parseFloat(amount11.replace(",",""));
                            }
                        }
                        if($("#amountf12").val() != undefined){
                            if(document.getElementById("amountf12").value.length > 0){
                                amount12 = document.getElementById("amountf12").value;
                                amount12 = parseFloat(amount12.replace(",",""));
                            }
                        }
                        total = parseFloat(amount1 + amount2 + amount3 + amount4 + amount5 + amount6 + amount7 + amount8 + amount9 + amount10 + amount11 + amount12);
                        total = parseFloat(totaldist - total);
                        // total = parseFloat(Number(total).toFixed(2))
                        // console.log(amount1);console.log(amount2);
                        $("#totalamount").val(CurrencyFormat(total));
                    });

                    $("#amountf1, #amountf2, #amountf3, #amountf4, #amountf5, #amountf6, #amountf7, #amountf8, #amountf9, #amountf10, #amountf11, #amountf12").keyup(function() {
                        total2 = parseFloat(amount1 + amount2 + amount3 + amount4 + amount5 + amount6 + amount7 + amount8 + amount9 + amount10 + amount11 + amount12);
                        // total2 = parseF-loat(Number(total2).toFixed(2));
                        $("#dtotalamount").val(CurrencyFormat(total2));
                    });
                    
                });
                $('.salary_monthly').mask("#,000,000,000", {reverse: true});
                $('.money').mask("#,000,000.00", {reverse: true,});
                
                function CurrencyFormat(number)
                {
                    var decimalplaces = 2;
                    var decimalcharacter = ".";
                    var thousandseparater = ",";
                    number = parseFloat(number);
                    var sign = number < 0 ? "-" : "";
                    var formatted = new String(number.toFixed(decimalplaces));
                    if( decimalcharacter.length && decimalcharacter != "." ) { formatted = formatted.replace(/\./,decimalcharacter); }
                    var integer = "";
                    var fraction = "";
                    var strnumber = new String(formatted);
                    var dotpos = decimalcharacter.length ? strnumber.indexOf(decimalcharacter) : -1;
                    if( dotpos > -1 )
                    {
                        if( dotpos ) { integer = strnumber.substr(0,dotpos); }
                        fraction = strnumber.substr(dotpos+1);
                    }
                    else { integer = strnumber; }
                    if( integer ) { integer = String(Math.abs(integer)); }
                    while( fraction.length < decimalplaces ) { fraction += "0"; }
                    temparray = new Array();
                    while( integer.length > 3 )
                    {
                        temparray.unshift(integer.substr(-3));
                        integer = integer.substr(0,integer.length-3);
                    }
                    temparray.unshift(integer);
                    integer = temparray.join(thousandseparater);
                    return sign + integer + decimalcharacter + fraction;
                }
                
                $(document).ready(function() { 
                    var totalamount = document.getElementById("totalamount");
                    if(totalamount !== null && document.getElementById("totalamount").value !== 0.00){
                        // console.log("dri ra");
                        $('#update').attr('disabled','disabled');
                        $('#save').attr('disabled','disabled');
                        $('#save').removeClass('btn-primary').addClass('btn-dark ');
                        $(this).addClass('btn-default').removeClass('btn-primary ');
                        $('#update').removeClass('btn-primary').addClass('btn-dark ');
                        $(this).addClass('btn-default').removeClass('btn-primary ');
                    } else {
                        // console.log("dd2 ra");
                        $('#update').removeAttr('disabled');
                        $('#save').removeAttr('disabled');
                        $('#save').removeClass('btn-dark').addClass('btn-primary');
                        $(this).addClass('btn-default').removeClass('btn-dark');
                        $('#update').removeClass('btn-dark').addClass('btn-primary');
                        $(this).addClass('btn-default').removeClass('btn-dark');
                    }
                    $("#amountf1, #amountf2, #amountf3, #amountf4, #amountf5, #amountf6, #amountf7, #amountf8, #amountf9, #amountf10, #amountf11, #amountf12").keyup(function() {
                        if(document.getElementById("totalamount").value != 0.00){
                            // console.log("dri");
                            $('#update').attr('disabled','disabled');
                            $('#save').attr('disabled','disabled');
                            $('#save').removeClass('btn-primary').addClass('btn-dark ');
                            $(this).addClass('btn-default').removeClass('btn-primary ');
                            $('#update').removeClass('btn-primary').addClass('btn-dark ');
                            $(this).addClass('btn-default').removeClass('btn-primary ');
                        } else {
                            // console.log("dd2");
                            $('#update').removeAttr('disabled');
                            $('#save').removeAttr('disabled');
                            $('#save').removeClass('btn-dark').addClass('btn-primary ');
                            $(this).addClass('btn-default').removeClass('btn-dark ');
                            $('#update').removeClass('btn-dark').addClass('btn-primary ');
                            $(this).addClass('btn-default').removeClass('btn-dark ');
                        }
                    });
                });
                $(document).ready(function() { 
                    $("#coesignatoryid1").keyup(function() {

                        var inputValue = document.getElementById("coesignatoryid").value.trim();

                        if (/^\d*\.?\d+$/.test(inputValue)) {
                            var numericValue = parseFloat(inputValue);
                            
                            $('#update').removeAttr('disabled');
                            $('#save').removeAttr('disabled');
                            $('#save').removeClass('btn-dark').addClass('btn-primary ');
                            $(this).addClass('btn-default').removeClass('btn-dark ');
                            $('#update').removeClass('btn-dark').addClass('btn-primary ');
                            $(this).addClass('btn-default').removeClass('btn-dark ');
                        }else{
                            $('#update').attr('disabled','disabled');
                            $('#save').attr('disabled','disabled');
                            $('#save').removeClass('btn-primary').addClass('btn-dark ');
                            $(this).addClass('btn-default').removeClass('btn-primary ');
                            $('#update').removeClass('btn-primary').addClass('btn-dark ');
                            $(this).addClass('btn-default').removeClass('btn-primary ');
                        }
                    });
                });
            
            $("#coesignatoryid").ready(function() {
                if(document.getElementById("coesignatoryid").value == ""){
                    // console.log("dri sa");
                    $('#update').attr('disabled','disabled');
                    $('#save').attr('disabled','disabled');
                    $('#save').removeClass('btn-primary').addClass('btn-dark ');
                    $(this).addClass('btn-default').removeClass('btn-primary ');
                    $('#update').removeClass('btn-primary').addClass('btn-dark ');
                    $(this).addClass('btn-default').removeClass('btn-primary ');
                } else {
                    // console.log("dd2 sa");
                    $('#update').removeAttr('disabled');
                    $('#save').removeAttr('disabled');
                    $('#save').removeClass('btn-dark').addClass('btn-primary ');
                    $(this).addClass('btn-default').removeClass('btn-dark ');
                    $('#update').removeClass('btn-dark').addClass('btn-primary ');
                    $(this).addClass('btn-default').removeClass('btn-dark ');
                }
                $("#coesignatoryid").keyup(function() {
                    if(document.getElementById("coesignatoryid").value == ""){
                        // console.log("dri sa");
                        $('#update').attr('disabled','disabled');
                        $('#save').attr('disabled','disabled');
                        $('#save').removeClass('btn-primary').addClass('btn-dark ');
                        $(this).addClass('btn-default').removeClass('btn-primary ');
                        $('#update').removeClass('btn-primary').addClass('btn-dark ');
                        $(this).addClass('btn-default').removeClass('btn-primary ');
                    } else {
                        // console.log("dd2 sa");
                        $('#update').removeAttr('disabled');
                        $('#save').removeAttr('disabled');
                        $('#save').removeClass('btn-dark').addClass('btn-primary ');
                        $(this).addClass('btn-default').removeClass('btn-dark ');
                        $('#update').removeClass('btn-dark').addClass('btn-primary ');
                        $(this).addClass('btn-default').removeClass('btn-dark ');
                    }
                });
                
                document.getElementById("coesignatoryid1").addEventListener('input', function(e) { 
                    var input = e.target,
                        list = input.getAttribute('list'),
                        options = document.querySelectorAll('#' + list + ' option'),
                        hiddenInput = document.getElementById('coesignatoryid'),
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
            });
            
        </script>
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
                    
                </h4>
			 </div>
			</div>
    </nav>
        <br><br><br><br>
        <div>
            <h2 class="text-center"><b><u>Certificate of Eligibility</u></b></h2><br>
        </div>
        <br> 
        <form action="coe.php?id=<?php echo $_GET['id']?>" method="post">
            <div class="container">
                <?php if($am >= $rec_amount || $am2 >= $rec_amount){?>
                    <div class="row">
                        <div class="container">
                        <div class="card">
                            <div class="card-header bg-success border-success text-white">
                                <b>Signatory</b>
                            </div>
                            <div class="card-body">
                                Amount is more than Twenty Thousand Pesos (Php 50,000).
                                <div>
                                <label> Approved By : </label>&nbsp&nbsp&nbsp
                                    <input style="text-transform: uppercase; width:50%" id="coesignatoryid1" list="coesign" name="coesignName1" value="<?php echo empty($client['signatory_GL'])?"":$user->getSignatoryFullnameCOE($client['signatory_GL']) ?>" required>
                                    <datalist id="coesign">
                                        <?php 
                                            $data = $user->signatoryGIS();
                                            foreach($data as $index => $value){
                                                $signatoryname = (empty($value['name_title'])?"":$value['name_title'] ." "). $value['first_name'] ." ". $value['middle_I'] .". ". $value['last_name'];
                                                echo "<option data-value='". $value['signatory_id'] ."'>".strtoupper($signatoryname)."-".$value['position']."</option>";
                                            } 
                                        ?>
                                    </datalist>
                                    <input type="hidden" id="coesignatoryid" name="coesignName" value="<?php echo empty($client['signatory_GL'])?"":$client['signatory_GL'] ?>">
                                </div>
                            </div>
                        </div> 
                        <br> 
                        </div>
                    </div>
                <?php }?>
				<?php if(strtolower($mode1) == "cav"){?>
                    <div class="row">
                        <div class="container">
                        <div class="card">
                            <div class="card-header bg-success border-success text-white">
                                <b>Cash Assistance Voucher SDO</b>
                            </div>
                            <div class="card-body">
                                <div>
									<label> Special Disbursing Officer : </label>&nbsp&nbsp&nbsp
									<input type="text" style="text-transform: uppercase" class="form-control mr-sm-2 b" name="sd_officer" value="<?php echo $cash['sd_officer'] ?>" id="sd_officer" placeholder="Special Disbursing Officer"><br>
                                </div>
                            </div>
                        </div> 
                        <br> 
                        </div>
                    </div>
                <?php }?>
                <div class="row">
                    <div class="col-6"> 
                        <div class="card border-secondary">
                            <div class="card-header  border-secondary bg-secondary text-white">
                                Records
                            </div>
                            <div class="card-body">
                                <div class="container">
                                    <div class="row">
                                        <div><input type="checkbox" class="lg" name="ref" value="Referral Letter" <?php echo $user->checkCheck($record['document'], "", "Referral") ?>> Referral Letter</div>
                                    </div>
                                    <div class="row">
                                        <div><input type="checkbox" class="lg" name="soc" value="Social Case Study" <?php echo $user->checkCheck($record['document'], "", "Social") ?>> Social Case Study Report</div>
                                    </div>
                                    <div class="row">
                                        <div><input type="checkbox" class="lg" name="just" value="Justification" <?php echo $user->checkCheck($record['document'], "", "Justification") ?>> Justification</div>
                                    </div>
                                    <div class="row">
                                        <div>
                                            <input type="checkbox" class="lg" name="val_id" value="Valid ID:" <?php echo $user->checkCheck($record['document'], "", "Valid ID") ?>> Valid ID Presented: 
                                            <input list="valid" type="text" id="pres_id" class="text-left center-input" name="pres_id" value=" <?php echo $record['id_presented'] ?>">
                                            <datalist id="valid">
                                                <option>School-ID</option>
                                                <option>Voter's ID</option>
                                                <option>PhilHealth ID</option>
                                                <option>Postal ID</option>
                                                <option>Driver's License</option>
                                                <option>Senior Citizen ID</option>
                                                <option>OFW ID</option>
                                                <option>Philippine Passport</option>
                                                <option>SSS UMID Card</option>
                                                <option>TIN Card</option>
                                                <option>PRC ID</option>
                                            </datalist>
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <div><input type="checkbox" class="lg" name="cont_emp" value="Contract of Employment" <?php echo $user->checkCheck($record['document'], "", "Contract of Employment") ?>> Contract of Employment</div>
                                    </div>
                                    <div class="row">
                                        <div><input type="checkbox" class="lg" name="cert_emp" value="Certificate of Employment" <?php echo $user->checkCheck($record['document'], "", "Certificate of Employment") ?>> Certificate of Employment</div>
                                    </div>
                                    <div class="row">
                                        <div><input type="checkbox" class="lg" name="itr" value="Income Tax Return" <?php echo $user->checkCheck($record['document'], "", "Income Tax Return") ?>> Income Tax Return</div>
                                    </div>
                                    <!-- <div class="row">
                                        <div><input type="checkbox" class="lg" name="brgy" value="4ps"  <?php echo $user->checkCheck($record['document'], "", "4ps") ?>> 4PS DSWD I.D.</div>
                                    </div> -->
                                    <div class="row">
                                        <div><input type="checkbox" class="lg" name="others" value="Others"  <?php echo $user->checkCheck($record['document'], "", "Others") ?>> Others: 
                                            <input type="text" class="text-left center-input" name="others_input" value=" <?php echo $record['others_input'] ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card border-secondary">
                            <div class="card-header border-secondary bg-secondary text-white">
                                <?php echo $client_assistance[1]['type'] ?> Records
                            </div>
                            <div class="card-body">
                                <div class="container">
                                <?php
                                    if(substr_count(strval($type), "Medic") > 0){
                                        echo '
                                        <div class="row">
                                            <div><input type="checkbox" class="lg" name="med_cer" id="med_cer" value="MEDICAL CERTIFICATE" '.$user->checkCheck($record['document'], "", "MEDICAL").'> Medical Certificate/Abstract</div>
                                        </div>
                                        <div class="row">
                                            <div><input type="checkbox" class="lg" name="dt_sum" id="dt_sum" value="DEATH SUMMARY" '.$user->checkCheck($record['document'], "", "DEATH SUMMARY").'> Death Summary</div>
                                        </div>
                                        <div class="row">   
                                            <div><input type="checkbox" class="lg" name="dis_sum" id="dis_sum" value="DISCHARGE SUMMARY" '.$user->checkCheck($record['document'], "", "DISCHARGE").'> Discharge Summary</div>
                                        </div>
                                        <div class="row">
                                            <div><input type="checkbox" class="lg" name="tr_pro" id="tr_pro" value="TREATMENT PROTOCOL" '.$user->checkCheck($record['document'], "", "TREATMENT").'> Treatment Protocol</div>
                                        </div>
                                        <div class="row">
                                            <div><input type="checkbox" class="lg" name="lab_req" id="lab_req" value="LAB REQUEST" '.$user->checkCheck($record['document'], "", "LAB REQUEST").'> Laboratory Request</div>
                                        </div>
                                        <div class="row">
                                            <div><input type="checkbox" class="lg" name="qout" id="qout" value="QUOTATION" '.$user->checkCheck($record['document'], "", "QUOTATION").'> Quotation/Chargeslip</div>
                                        </div>  
                                        <div class="row">
                                            <div><input type="checkbox" class="lg" name="pres" id="pres" value="PRESCRIPTIONS" '.$user->checkCheck($record['document'], "", "PRESCRIPTION").'> Prescription</div>
                                        </div>
                                        <div class="row">
                                            <div><input type="checkbox" class="lg" name="stat_acc" id="stat_acc" value="STATEMENT OF ACCOUNT" '.$user->checkCheck($record['document'], "", "STATEMENT OF ACCOUNT").'> Statement of Account</div>
                                        </div>
                                        <div class="row">
                                            <div><input type="checkbox" class="lg" name="promissory" id="promissory" value="PROMISSORY NOTE" '.$user->checkCheck($record['document'], "", "PROMISSORY NOTE").'> Promissory Note</div>
                                        </div>
                                        ';
                                    }elseif(substr_count(strval($type), "Trans") > 0){
                                        echo 'None';   
                                    }elseif(substr_count(strval($type), "Educ") > 0){
                                        echo 'None'; 
                                    }elseif(substr_count(strval($type), "Funeral") > 0){
                                        echo '
                                        <div class="row">
                                            <div><input type="checkbox" class="lg" name="regD" id="regD" value="REGISTERED DEATH CERTIFICATE" '.$user->checkCheck($record['document'], "", "DEATH CERTIFICATE").'> Death Certificate</div>
                                        </div>
                                        <div class="row">
                                            <div><input type="checkbox" class="lg" name="funC" id="funC" value="FUNERAL CONTRACT" '.$user->checkCheck($record['document'], "", "FUNERAL").'> Funeral Contact</div>
                                        </div>
                                        <div class="row">
                                            <div><input type="checkbox" class="lg" name="dt_sum" id="dt_sum" value="DEATH SUMMARY" '.$user->checkCheck($record['document'], "", "DEATH SUMMARY").'> Death Summary</div>
                                        </div>
                                        ';
                                    }elseif(substr_count(strval($type), "Food") > 0){
                                        echo 'None';
                                    }elseif(substr_count(strval(strtolower($type)), "non-food") > 0) {
                                        echo 'None';
                                    }
                                ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><br>

                <?php   
                    if(!empty($fundsourcedata[1]['fundsource']) && !empty($fundsourcedata[2]['fundsource'])){ ?>
                    <div class=row>
                        <div class="col-2"></div>
                        <div class="col-8">
                            <div class="card border-secondary">
                                <div class="card-header border-secondary bg-secondary text-white">
                                    Fund Source Distribution
                                </div>
                                <div class="card-body">
                                    <div class="container">
                                        <div class="row">
                                            <?php if(!empty($fundsourcedata[2]['fundsource']) && !empty($fundsourcedata[1]['fundsource'])){ ?>
                                            <div class="col-12" >
                                            <h5 style="text-indent: 100px"></h5>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <h6 class="text-center">Amount to Be Distributed: </h6>
                                                        <h6 class="text-center">Php 
                                                        <input type="text" class="money" id="totalamount" readonly /></h6>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="input-group input-group-md">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm"><i><?php echo $fundsourcedata[1]['fundsource']." = " ?></i></span>
                                                        </div>
                                                        <input type="text" class="form-control mr-sm-2 b money" id="amountf1" name="amountf1" value="<?php echo !empty($fundsourcedata[1]['fs_amount'])?$fundsourcedata[1]['fs_amount']:''?>" placeholder="Amount" required>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="input-group input-group-md">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm"><i><?php echo $fundsourcedata[2]['fundsource']." = " ?></i></span>
                                                        </div>
                                                        <input type="text" class="form-control mr-sm-2 b money" id="amountf2" name="amountf2" value="<?php echo !empty($fundsourcedata[2]['fs_amount'])?$fundsourcedata[2]['fs_amount']:''?>" placeholder="Amount" required>
                                                    </div>
                                                </div>
                                                <br>
                                                <?php if(!empty($fundsourcedata[3]['fundsource'])) { ?>
                                                <div class="row">
                                                    <div class="input-group input-group-md">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm"><i><?php echo $fundsourcedata[3]['fundsource']." = " ?></i></span>
                                                        </div>
                                                        <input type="text" class="form-control mr-sm-2 b money" id="amountf3" name="amountf3" value="<?php echo !empty($fundsourcedata[3]['fs_amount'])?$fundsourcedata[3]['fs_amount']:''?>" placeholder="Amount" required>
                                                    </div>
                                                </div>
                                                <br>
                                                <?php }
                                                
                                                if(!empty($fundsourcedata[4]['fundsource'])) { ?>
                                                <div class="row">
                                                    <div class="input-group input-group-md">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm"><i><?php echo $fundsourcedata[4]['fundsource']." = " ?></i></span>
                                                        </div>
                                                        <input type="text" class="form-control mr-sm-2 b money" id="amountf4" name="amountf4" value="<?php echo !empty($fundsourcedata[4]['fs_amount'])?$fundsourcedata[4]['fs_amount']:''?>" placeholder="Amount" required>
                                                    </div>
                                                </div>
                                                <br>
                                                <?php }
                                                
                                                if(!empty($fundsourcedata[5]['fundsource'])) { ?>
                                                <div class="row">
                                                    <div class="input-group input-group-md">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm"><i><?php echo $fundsourcedata[5]['fundsource']." = " ?></i></span>
                                                        </div>
                                                        <input type="text" class="form-control mr-sm-2 b money" id="amountf5" name="amountf5" value="<?php echo !empty($fundsourcedata[5]['fs_amount'])?$fundsourcedata[5]['fs_amount']:''?>" placeholder="Amount" required>
                                                    </div>
                                                </div>
                                                <br>
                                                <?php } 
                                                
                                                if(!empty($fundsourcedata[6]['fundsource'])) { ?>
                                                <div class="row">
                                                    <div class="input-group input-group-md">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm"><i><?php echo $fundsourcedata[6]['fundsource']." = " ?></i></span>
                                                        </div>
                                                        <input type="text" class="form-control mr-sm-2 b money" id="amountf6" name="amountf6" value="<?php echo !empty($fundsourcedata[6]['fs_amount'])?$fundsourcedata[6]['fs_amount']:''?>" placeholder="Amount" required>
                                                    </div>
                                                </div>
                                                <br>
                                                <?php } 
                                                
                                                if(!empty($fundsourcedata[7]['fundsource'])) { ?>
                                                <div class="row">
                                                    <div class="input-group input-group-md">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm"><i><?php echo $fundsourcedata[7]['fundsource']." = " ?></i></span>
                                                        </div>
                                                        <input type="text" class="form-control mr-sm-2 b money" id="amountf7" name="amountf7" value="<?php echo !empty($fundsourcedata[7]['fs_amount'])?$fundsourcedata[7]['fs_amount']:''?>" placeholder="Amount" required>
                                                    </div>
                                                </div>
                                                <br>
                                                <?php } 
                                                
                                                if(!empty($fundsourcedata[8]['fundsource'])) { ?>
                                                <div class="row">
                                                    <div class="input-group input-group-md">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm"><i><?php echo $fundsourcedata[8]['fundsource']." = " ?></i></span>
                                                        </div>
                                                        <input type="text" class="form-control mr-sm-2 b money" id="amountf8" name="amountf8" value="<?php echo !empty($fundsourcedata[8]['fs_amount'])?$fundsourcedata[8]['fs_amount']:''?>" placeholder="Amount" required>
                                                    </div>
                                                </div>
                                                <br>
                                                <?php } 
                                                                                                
                                                if(!empty($fundsourcedata[9]['fundsource'])) { ?>
                                                <div class="row">
                                                    <div class="input-group input-group-md">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm"><i><?php echo $fundsourcedata[9]['fundsource']." = " ?></i></span>
                                                        </div>
                                                        <input type="text" class="form-control mr-sm-2 b money" id="amountf9" name="amountf9" value="<?php echo !empty($fundsourcedata[9]['fs_amount'])?$fundsourcedata[9]['fs_amount']:''?>" placeholder="Amount" required>
                                                    </div>
                                                </div>
                                                <br>
                                                <?php } 
                                                                                                                                                                                                
                                                if(!empty($fundsourcedata[10]['fundsource'])) { ?>
                                                <div class="row">
                                                    <div class="input-group input-group-md">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm"><i><?php echo $fundsourcedata[10]['fundsource']." = " ?></i></span>
                                                        </div>
                                                        <input type="text" class="form-control mr-sm-2 b money" id="amountf10" name="amountf10" value="<?php echo !empty($fundsourcedata[10]['fs_amount'])?$fundsourcedata[10]['fs_amount']:''?>" placeholder="Amount" required>
                                                    </div>
                                                </div>
                                                <br>
                                                <?php } 
                                                                                                                                                                                                                                                                                                                                                                                                
                                                if(!empty($fundsourcedata[11]['fundsource'])) { ?>
                                                <div class="row">
                                                    <div class="input-group input-group-md">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm"><i><?php echo $fundsourcedata[11]['fundsource']." = " ?></i></span>
                                                        </div>
                                                        <input type="text" class="form-control mr-sm-2 b money" id="amountf11" name="amountf11" value="<?php echo !empty($fundsourcedata[11]['fs_amount'])?$fundsourcedata[11]['fs_amount']:''?>" placeholder="Amount" required>
                                                    </div>
                                                </div>
                                                <br>
                                                <?php } 
                                                if(!empty($fundsourcedata[12]['fundsource'])) { ?>
                                                <div class="row">
                                                    <div class="input-group input-group-md">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm"><i><?php echo $fundsourcedata[12]['fundsource']." = " ?></i></span>
                                                        </div>
                                                        <input type="text" class="form-control mr-sm-2 b money" id="amountf12" name="amountf12" value="<?php echo !empty($fundsourcedata[12]['fs_amount'])?$fundsourcedata[12]['fs_amount']:''?>" placeholder="Amount" required>
                                                    </div>
                                                </div>
                                                <br>
                                                <?php } ?>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <h6 class="text-center">Amount Distributed: </h6>
                                                        <h6 class="text-center">Php 
                                                        <input type="text" class="text-center money" id="dtotalamount" readonly/></h6></h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php }  ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-2"></div>
                    </div>
                    <br>
                    <br>
                <?php } ?>
                

                <div class="container">
                    <div class="form-group row" >
                        <div class="col"><a href="gis.php?id=<?php echo $_GET['id']?>" class="btn btn-success btn-block"><span class="fa fa-reply"></span> GIS</a></div>
                        <!--
						<div class="col"><input type="button" class="btn btn-<?php //echo (empty($record))?"secondary":"primary" ?> btn-block" value="Print GIS" name="printgis" onclick="printGISinCE()"<?php //echo (empty($record))?"disabled":"" ?> ></div>
                        <div class="col"><input type="button" class="btn btn-<?php //echo (empty($record))?"secondary":"primary" ?> btn-block" value="Print CE" name="printce" onclick="printCOE()"<?php //echo (empty($record))?"disabled":"" ?> ></div>
                        -->
						<?php 
                            if($record){
                        ?>
                            <div class="col"><input type="submit" class="btn btn-primary btn-block"  value="Update" id="update" name="update"></div>
                        <?php }else{ 
                        ?>
                            <div class="col"><input type="submit" class="btn btn-primary btn-block"  value="Save" id="save" name="save"></div>
                        <?php }
                        ?>
                        <div class="col" style="margin-right:3px"><a href="last.php?id=<?php echo $_GET['id']?>" type="button" class="btn btn-success btn-block text-white" id="Final">Next<span class='fa fa-share'></span></a></div>
                    </div>
                </div>
            </div>
        </form>
        <div id="gisce" hidden>
        <?php 
            // include("gis_sheet_in_coe.php"); 
            //  include("gisv2_print.php"); 
        ?>
        </div>
        <div id="coe" class="printable" hidden>
        <?php 
			/* if(substr_count(strval($type), "Medic") > 0){
                include("coe_med.php"); 
            }elseif(substr_count(strval($type), "Trans") > 0){
                include("coe_trans.php");
            }elseif(substr_count(strval($type), "Food Sub") > 0){
                include("coe_food.php");
            }elseif(substr_count(strval($type), "Burial") > 0){
                include("coe_burial.php");
            }elseif(substr_count(strval($type), "Educ") > 0){
                include("coe_educ.php");
            }elseif(substr_count(strval($type), "Cash") > 0){
				include("coe_cash.php");
			}elseif(substr_count(strval($type), "Non") > 0){
				include("coe_non_food.php");
			}

            if(!empty($client_assistance[2]['type'])){
                include("coe_food2.php");
            }  */ 

			// include("coev2_print.php"); 
			
            ?>
        </div>
    </body>
    <?php 
    if(isset($_POST["save"])){
        $docu = "";
        $id_pres = "";
        $others_input = "";
        $others_medical = "";
        $others_burial = "";
        $signName = "";
        $amount1 = "";
        $amount2 = "";
        $amount3 = "";
        $amount4 = "";
        $amount5 = "";
        $amount6 = "";
        $amount7 = "";
        $amount8 = "";
        $amount9 = "";
        $amount10 = "";
        $amount11 = "";
        $amount12 = "";
		$sdo = "";
            $id_sign = $client['signatory_id'];
        if(isset($_POST['coesignName'])){
            $signName = mysqli_real_escape_string($user->db, $_POST['coesignName']);
        }
		if(isset($_POST['sd_officer'])){
            $sdo = mysqli_real_escape_string($user->db, trim(strtoupper($_POST['sd_officer'])));
        }
        foreach($_POST as $key => $value) {
                $docu .=   $value . '-';
        }
   
        if(isset($_POST['val_id'])){
            $id_pres = mysqli_real_escape_string($user->db, trim(strtoupper($_POST['pres_id'])));
        }

        if(isset($_POST['others'])){ //if na check si other
            $others_input = mysqli_real_escape_string($user->db, trim(strtoupper($_POST['others_input'])));
        }
        
        if(isset($_POST['others_m'])){ //if na check si other
            $others_medical = mysqli_real_escape_string($user->db, trim(strtoupper($_POST['others_medical'])));
        } 
        
        if(isset($_POST['others_b'])){ //if na check si other
            $others_burial = mysqli_real_escape_string($user->db, trim(strtoupper($_POST['others_burial'])));
        }

        if(isset($_POST['amountf1'])){
            $amount1 = $_POST['amountf1'];
        }

        if(isset($_POST['amountf2'])){
            $amount2 = $_POST['amountf2'];
        }
        
        if(isset($_POST['amountf3'])){
            $amount3 = $_POST['amountf3'];
        }

        if(isset($_POST['amountf4'])){
            $amount4 = $_POST['amountf4'];
        }

        if(isset($_POST['amountf5'])){
            $amount5 = $_POST['amountf5'];
        }

        if(isset($_POST['amountf6'])){
            $amount6 = $_POST['amountf6'];
        }

        if(isset($_POST['amountf7'])){
            $amount7 = $_POST['amountf7'];
        }

        if(isset($_POST['amountf8'])){
            $amount8 = $_POST['amountf8'];
        }

        if(isset($_POST['amountf9'])){
            $amount9 = $_POST['amountf9'];
        }

        if(isset($_POST['amountf10'])){
            $amount10 = $_POST['amountf10'];
        }

        if(isset($_POST['amountf11'])){
            $amount11 = $_POST['amountf11'];
        }

        if(isset($_POST['amountf12'])){
            $amount12 = $_POST['amountf12'];
        }
        $docu=mysqli_real_escape_string($user->db,$docu);
        $modecon = $client_assistance[1]['mode'];
        //echo $docu ."-". $id_pres ."-". $others_input ."-". $signName;
        $user->insertCOE($_GET['id'], $docu, $id_pres, $signName, $others_input, $others_medical, $others_burial, $amount1, $amount2, $amount3, $amount4, $amount5, $amount6, $amount7, $amount8, 
        $amount9, $amount10, $amount11, $amount12, $am, $modecon, $id_sign, $sdo);
    }


    if(isset($_POST['update'])){
        $docu = "";
        $id_pres = "";
        $others_input = "";
		$sdo = "";
        if(!empty($_POST['coesignName'])){
            $signName = mysqli_real_escape_string($user->db, $_POST['coesignName']);
        }else{
            $signName = "";
        }
		if(isset($_POST['sd_officer'])){
            $sdo = mysqli_real_escape_string($user->db, trim(strtoupper($_POST['sd_officer'])));
        }
        $id_sign = $client['signatory_id'];
		$amount1 = "";
        $amount2 = "";
		$amount3 = "";
        $amount4 = "";
        $amount5 = "";
        $amount6 = "";
        $amount7 = "";
        $amount8 = "";
        $amount9 = "";
        $amount10 = "";
        $amount11 = "";
        $amount12 = "";
        foreach($_POST as $key => $value) {
                $docu .=   $value . '-';
        }

       
        if(isset($_POST['val_id'])){
            $id_pres = mysqli_real_escape_string($user->db, trim(strtoupper($_POST['pres_id'])));
        }
        
        if(isset($_POST['others'])){ //if na check si other
            $others_input = mysqli_real_escape_string($user->db, trim(strtoupper($_POST['others_input'])));
        }
        
        if(isset($_POST['others_m'])){ //if na check si other
            $others_medical = mysqli_real_escape_string($user->db, trim(strtoupper($_POST['others_medical'])));
        } 
        
        if(isset($_POST['others_b'])){ //if na check si other
            $others_burial = mysqli_real_escape_string($user->db, trim(strtoupper($_POST['others_burial'])));
        }

		if(isset($_POST['amountf1'])){
            $amount1 = $_POST['amountf1'];
        }

        if(isset($_POST['amountf2'])){
            $amount2 = $_POST['amountf2'];
        }
        
        if(isset($_POST['amountf3'])){
            $amount3 = $_POST['amountf3'];
        }

        if(isset($_POST['amountf4'])){
            $amount4 = $_POST['amountf4'];
        }

        if(isset($_POST['amountf5'])){
            $amount5 = $_POST['amountf5'];
        }

        if(isset($_POST['amountf6'])){
            $amount6 = $_POST['amountf6'];
        }

        if(isset($_POST['amountf7'])){
            $amount7 = $_POST['amountf7'];
        }

        if(isset($_POST['amountf8'])){
            $amount8 = $_POST['amountf8'];
        }

        if(isset($_POST['amountf9'])){
            $amount9 = $_POST['amountf9'];
        }

        if(isset($_POST['amountf10'])){
            $amount10 = $_POST['amountf10'];
        }

        if(isset($_POST['amountf11'])){
            $amount11 = $_POST['amountf11'];
        }

        if(isset($_POST['amountf12'])){
            $amount12 = $_POST['amountf12'];
        }
        $docu=mysqli_real_escape_string($user->db,$docu);
        $modecon = $client_assistance[1]['mode'];
        // echo $signName;
        $user->updateCOE($_GET['id'], $docu, $id_pres, $signName, $others_input, $others_medical, $others_burial, $amount1, $amount2, $amount3, $amount4, $amount5, $amount6, $amount7, $amount8, 
        $amount9, $amount10, $amount11, $amount12, $am, $modecon, $id_sign, $sdo);
    }
?>
   

</html>
