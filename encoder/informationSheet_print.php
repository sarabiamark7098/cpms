<html>
<body>
 <style> 
    @page {
        size: A4;
        margin: 0mm 10mm;
    }

	.header{
		background-color: black !important;
		color: white;
		-webkit-print-color-adjust: exact; 
		font-size: 14px;
	}
    #informationSheet_print input{
        text-transform:uppercase;
    }
    .page1 {
            position: relative;
            height: 1492px; /* approx height for A4 at 96dpi */
            page-break-after: always;
            padding: 0mm;
            box-sizing: border-box;
        }
    .page2 {
        position: relative;
        height: 1492px; /* approx height for A4 at 96dpi */
        page-break-after: always;
        padding: 0mm;
        box-sizing: border-box;
    }

    @media print {
    .footer {
        position: absolute;
        bottom: 0;
        left: 15px;
        padding: 0;
        width: 100%;
        background-color: white; /* Optional: ensure background doesn't inherit page bg */
    }

    
}
<?php
function getPrintFontSize($text, $defaultSize = 15) {
    $len = strlen(trim($text));
    if ($len > 35) return 9;
    if ($len > 25) return 10.5;
    if ($len > 18) return 12;
    if ($len > 12) return 13.5;
    return $defaultSize;
}

function fitSpan($value, $height = 36, $withBorder = true, $bold = false) {
    $raw    = trim((string)$value);
    $fs     = getPrintFontSize($raw);
    $safe   = htmlspecialchars($raw, ENT_QUOTES);
    $border = $withBorder ? 'border-bottom:1px solid black;' : '';
    $weight = $bold ? 'font-weight:bold;' : '';
    return '<span class="d-flex align-items-center justify-content-center text-center" style="width:100%; height:' . $height . 'px; font-size:' . $fs . 'px; line-height:1.1; ' . $border . $weight . ' overflow:hidden; word-break:break-word; text-transform:uppercase;">' . $safe . '</span>';
}

// Prepare cleaned string variables
$street       = !empty($client["client_street"]) ? htmlspecialchars($client["client_street"], ENT_QUOTES) : "";
$barangay     = !empty($client["client_barangay"]) ? htmlspecialchars(explode("/", $client["client_barangay"])[0], ENT_QUOTES) : "";
$municipality = !empty($client["client_municipality"]) ? htmlspecialchars(explode("/", $client["client_municipality"])[0], ENT_QUOTES) : "";
$province     = !empty($client["client_province"]) ? htmlspecialchars(explode("/", $client["client_province"])[0], ENT_QUOTES) : "";
$region       = !empty($client["client_region"]) ? htmlspecialchars(explode("(", $client["client_region"])[0], ENT_QUOTES) : "";
?>
 </style>
     <!-- Page 1 -->
    <div class="container page1" id="informationSheet_print" style="font-size:12px; padding:0%; font-family: Arial, sans-serif; border:solid 1px black; padding: 15px">
        
        <!--HEADER-->
        <div class="row" style="margin-top:0%; margin-bottom: 3%;">
            <div class="col-6">
                <img src="../images/dswd_olog.png" alt="" width="230px" height="60px">
                <img src="../images/BP.png" alt="" width="70px" height="60px" style="margin-left: 5px;">
            </div>
            <div class="col-3 ml-md-auto" style="color: #000000; ">
            </div>
            <div class="col-3 ml-md-auto" style="color: #000000; ">
                <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;border:1px solid black;" value="" />&emsp;CENTRAL OFFICE<br>
                <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;border:1px solid black;" value="&#x2714;" />&emsp;FIELD OFFICE <input class="text-center" style="width: 40%; height:30%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="20px" value='XI'>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12" style="text-align: center; margin-top: 0px">
                
                <div class="row">
                    <div class="col-12">
                        <p style="margin-top: 0px; margin-left:-15px; margin-right:-15px;"><b style="font-size: 36px">INFORMATION SHEET</b></p>
                    </div>
                </div>                
            </div>
        </div>
        <div class="row" style="padding: 0%; margin-bottom: 4%; margin-top: 2%;">
            <div class="col-9" style="font-size:14px; padding: 0%;">
                <div class="row">
                    <div class="col-sm-1 center" style="margin-left: 5px;">
                        <p class="text-center">PCN:</p>
                    </div>
                    <div class="col-sm-10">
                        <input class="text-center" style="width: 18px; font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value=''>
                        <input class="text-center" style="margin-left:-5; width: 18px; font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value=''>
                        <input class="text-center" style="margin-left:-5; width: 18px; font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value=''>
                        <input class="text-center" style="margin-left:-5; width: 18px; font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value=''>
                        <input class="text-center" style="margin-left:-5; width: 18px; font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value=''>
                        <input class="text-center" style="margin-left:-5; width: 18px; font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value=''>
                        <input class="text-center" style="margin-left:-5; width: 18px; font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value=''>
                        <input class="text-center" style="margin-left:-5; width: 18px; font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value=''>
                        <input class="text-center" style="margin-left:-5; width: 18px; font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value=''>
                        <input class="text-center" style="margin-left:-5; width: 18px; font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value=''>
                        <input class="text-center" style="margin-left:-5; width: 18px; font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value=''>
                        <input class="text-center" style="margin-left:-5; width: 18px; font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value=''>
                        <input class="text-center" style="margin-left:-5; width: 18px; font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value=''>
                        <input class="text-center" style="margin-left:-5; width: 18px; font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value=''>
                        <input class="text-center" style="margin-left:-5; width: 18px; font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value=''>
                        <input class="text-center" style="margin-left:-5; width: 18px; font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value=''>
                    </div>
                </div>
            </div>
            <div class="col-3 text-center" style="font-size:14px; padding: 0%;">
                <div class="row">
                    <div class="col-sm-2 center">
                        <p class="text-center">Date:</p>
                    </div>
                    <div class="col-sm-10">
                        <input class="text-center" style="width: 50px; font-size: 14px; padding:0; border: 1px solid black;" type="text" value='<?php echo date("m", strtotime($client["date_accomplished"])) ?>'>
                        <input class="text-center" style="width: 50px; font-size: 14px; padding:0; border: 1px solid black;" type="text" value='<?php echo date("d", strtotime($client["date_accomplished"])) ?>'>
                        <input class="text-center" style="width: 70px; font-size: 14px; padding:0; border: 1px solid black;" type="text" value='<?php echo date("Y", strtotime($client["date_accomplished"])) ?>'>
                    </div>
                    <div class="col-sm-2 center">
                    </div>
                    <div class="col-sm-10" style="margin-top: -15px;">
                        <input class="text-center" style="width: 50px; font-size: 14px; padding:0; border: none;" type="text" value='MM'>
                        <input class="text-center" style="width: 50px; font-size: 14px; padding:0; border: none;" type="text" value='DD'>
                        <input class="text-center" style="width: 70px; font-size: 14px; padding:0; border: none;" type="text" value='YYYY'>
                    </div>
                </div>
            </div>
        </div>
        <p class="header" style="margin-top: 20px; margin-left: -15px; margin-right: -15px; font-size: 15px;"><b>&emsp; IMPORMASYON NG ITINALAGANG KINATAWAN/KLIYENTE</b> <span style="font-style: italic;">(Authorized Representative's/Client's Identifying Information)</span></p>

        <div class="row d-flex align-items-stretch" style="margin-top: 30px;">
            <div class="col-4">
                <?php echo fitSpan($client["lastname"]); ?>
            </div>
            <div class="col-4">
                <?php echo fitSpan($client["firstname"]); ?>
            </div>
            <div class="col-3">
                <?php echo fitSpan($client["middlename"]); ?>
            </div>
            <div class="col-1">
                <?php echo fitSpan($client["extraname"]); ?>
            </div>
        </div>
        <div class="row" style="margin-top: 0px;">
            <div class="col-4">
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>Apelyido</b> <span style="color: #777777;">(Last Name)</span></p>
            </div>
            <div class="col-4">
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>Unang Pangalan</b> <span style="color: #777777;">(First Name)</span></p>
            </div>
            <div class="col-3">
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>Gitnang Pangalan</b> <span style="color: #777777;">(Middle Name)</span></p>
            </div>
            <div class="col-1">
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>Ext.</b> <span style="color: #777777;">(Sr.,Jr.)</span></p>
            </div>
        </div>
        <div class="row d-flex align-items-stretch" style="margin-top: 10px;">
            <div class="col-3">
                <?php echo fitSpan($street); ?>
            </div>
            <div class="col-3">
                <?php echo fitSpan($barangay); ?>
            </div>
            <div class="col-2">
                <?php echo fitSpan($municipality); ?>
            </div>
            <div class="col-2">
                <?php echo fitSpan($province); ?>
            </div>
            <div class="col-2">
                <?php echo fitSpan($region); ?>
            </div>
        </div>
        <div class="row" style="margin-top: 0px;">
            <div class="col-3">
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>Numbero ng Bahay/Kalye</b> <span style="color: #777777;">(Street Address)</span></p>
            </div>
            <div class="col-3">
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>Barangay</b> <span style="color: #777777;">(Ex. 23-C)</span></p>
            </div>
            <div class="col-2">
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>Lungsod/Bayan</b> <span style="color: #777777;">(City/Municipality)</span></p>
            </div>
            <div class="col-2">
                <p class="text-center" style="width: 100%; height:80%; font-size: 9px; "><b>Lalawigan/Distrito</b> <span style="color: #777777;">(Province/District)</span></p>
            </div>
            <div class="col-2">
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>Rehiyon</b> <span style="color: #777777;">(Region)</span></p>
            </div>
        </div>
        <div class="row" style="margin-top: 10px;">
            <div class="col-2">
                <?php echo fitSpan(!empty($client["contact"])?$client["contact"]:""); ?>
            </div>
            <div class="col-2">
                <?php echo fitSpan(!empty($client["date_birth"])?date("m-d-Y" ,strtotime($client["date_birth"])):""); ?>
            </div>
            <div class="col-1">
                <?php echo fitSpan(!empty($client["date_birth"])?$age_client:""); ?>
            </div>
            <div class="col-1">
                <?php echo fitSpan(!empty($client["sex"])?$client["sex"]:""); ?>
            </div>
            <div class="col-3">
                <?php echo fitSpan(!empty($client["gender_identity"])?$client["gender_identity"]:""); ?>
            </div>
            <div class="col-3">
                <?php echo fitSpan(!empty($client["civil_status"])?$client["civil_status"]:""); ?>
            </div>
        </div>
        <div class="row" style="height: 35px; margin-top: 0px;">
            <div class="col-2">
                <p class="text-center" style="width: 100%; height:80%; font-size: 8px; "><b>Numero ng Mobile</b> <span style="color: #777777;">(Mobile No.)</span></p>
            </div>
            <div class="col-2">
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; line-height:10px;"><b>Petsa ng Kapanganakan</b> <span style="color: #777777;">(Birthdate MM-DD-YYYY)</span></p>
            </div>
            <div class="col-1">
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>Edad</b> <span style="color: #777777;">(Age)</span></p>
            </div>
            <div class="col-1">
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>Kasarian</b></p>
            </div>
            <div class="col-3">
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>Pagkakakilanlan ng Kasarian</b> <span style="color: #777777;">(Gender Identity)</span></p>
            </div>
            <div class="col-3">
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>Katayuang Sibil</b> <span style="color: #777777;">(Civil Status)</span></p>
            </div>
           
        </div>
        <div class="row" style="margin-top: 10px;">
            <div class="col-3">
                <?php echo fitSpan(!empty($client["occupation"])?$client["occupation"]:""); ?>
            </div>
            <div class="col-2">
                <?php echo fitSpan(!empty($client["salary"])?$client["salary"]:""); ?>
            </div>
            <div class="col-4">
                <?php echo fitSpan(!empty($client["relation"])?$client["relation"]:"Self"); ?>
            </div>
            <div class="col-3">
            </div>
        </div>
        <div class="row" style="height: 25px; margin-top: 0px;">
            <div class="col-3">
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>Hanapbuhay</b> <span style="color: #777777;">(Occupation)</span></p>
            </div>
            <div class="col-2">
                <p class="text-center" style="width: 100%; height:80%; font-size: 7px; line-height: 10px;"><b>Buwanang Kita</b> <span style="color: #777777;">(Monthly Income)</span></p>
            </div>
            <div class="col-4">
                <p class="text-center" style="width: 100%; font-size: 10px; "><b>Relasyon sa Benepisyaryo</b> <span style="color: #777777;">(Relationship to the Beneficiary)</span></p>
            </div>
            <div class="col-3">
            </div>
        </div>

        <!--BENEFICIARY INFO-->
        <p class="header" style="margin-top: 20px; margin-left: -15px; margin-right: -15px; font-size: 15px;"><b>&emsp; IMPORMASYON NG BENEPISYARYO</b> <span style="font-style: italic;">(Beneficiary's Identifying Information)</span> <span style="float:right; font-size: 13px; margin-right: 20px;"><input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black; background-color: #ffffff;" type="text" value="<?php echo (strtolower($client["relation"])=="self")?"&#x2714;":"" ?>"></input> KATULAD NG NASA ITAAS</span></p>

        <div class="row" style="margin-top: 30px; ">
            <div class="col-4">
                <?php echo fitSpan(!empty($client["b_lname"])?$client["b_lname"]:""); ?>
            </div>
            <div class="col-4">
                <?php echo fitSpan(!empty($client["b_fname"])?$client["b_fname"]:""); ?>
            </div>
            <div class="col-3">
                <?php echo fitSpan(!empty($client["b_mname"])?$client["b_mname"]:""); ?>
            </div>
            <div class="col-1">
                <?php echo fitSpan(!empty($client["b_exname"])?$client["b_exname"]:""); ?>
            </div>
        </div>
        <div class="row" style="margin-top: 0px;">
            <div class="col-4">
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>Apelyido</b> <span style="color: #777777;">(Last Name)</span></p>
            </div>
            <div class="col-4">
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>Unang Pangalan</b> <span style="color: #777777;">(First Name)</span></p>
            </div>
            <div class="col-3">
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>Gitnang Pangalan</b> <span style="color: #777777;">(Middle Name)</span></p>
            </div>
            <div class="col-1">
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>Ext.</b> <span style="color: #777777;">(Sr.,Jr.)</span></p>
            </div>
        </div>
        <div class="row" style="margin-top: 10px;">
            <div class="col-3">
                <?php echo fitSpan(!empty($client["b_street"])?$client["b_street"]:""); ?>
            </div>
            <div class="col-3">
                <?php echo fitSpan(!empty($client["b_barangay"])?explode("/",$client["b_barangay"])[0]:""); ?>
            </div>
            <div class="col-2">
                <?php echo fitSpan(!empty($client["b_municipality"])?explode("/",$client["b_municipality"])[0]:""); ?>
            </div>
            <div class="col-2">
                <?php echo fitSpan(!empty($client["b_province"])?explode("/",$client["b_province"])[0]:""); ?>
            </div>
            <div class="col-2">
                <?php echo fitSpan(!empty($client["b_region"])?explode("(",$client["b_region"])[0]:""); ?>
            </div>
        </div>
        <div class="row" style="margin-top: 0px;">
            <div class="col-3">
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>Numbero ng Bahay/Kalye</b> (Street Address)</p>
            </div>
            <div class="col-3">
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>Barangay</b> (Ex. 23-C)</p>
            </div>
            <div class="col-2">
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>Lungsod/Bayan</b> (City/Municipality)</p>
            </div>
            <div class="col-2">
                <p class="text-center" style="width: 100%; height:80%; font-size: 9px; "><b>Lalawigan/Distrito</b> (Province/District)</p>
            </div>
            <div class="col-2">
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>Rehiyon</b> (Region)</p>
            </div>
        </div>
        <div class="row" style="margin-top: 10px;">
            <div class="col-2">
                <?php echo fitSpan(!empty($client["b_contact"])?$client["b_contact"]:""); ?>
            </div>
            <div class="col-2">
                <?php echo fitSpan(!empty($client["b_bday"])?date("m, d, Y" ,strtotime($client["b_bday"])):""); ?>
            </div>
            <div class="col-1">
                <?php echo fitSpan(!empty($client["b_bday"])?$age_bene:""); ?>
            </div>
            <div class="col-1">
                <?php echo fitSpan(!empty($client["b_sex"])?$client["b_sex"]:""); ?>
            </div>
            <div class="col-3">
                <?php echo fitSpan(!empty($client["b_gender_identity"])?$client["b_gender_identity"]:""); ?>
            </div>
            <div class="col-3">
                <?php echo fitSpan(!empty($client["b_civilStatus"])?$client["b_civilStatus"]:""); ?>
            </div>
        </div>
        <div class="row" style="margin-top: 0px;">
            <div class="col-2">
                <p class="text-center" style="width: 100%; height:80%; font-size: 8px; "><b>Numero ng Mobile</b>  <span style="color: #777777">(Mobile No.)</span></p>
            </div>
            <div class="col-2">
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; line-height: 10px;"><b>Petsa ng Kapanganakan</b> <span style="color: #777777">(Birthdate MM-DD-YYYY)</span></p>
            </div>
            <div class="col-1">
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>Edad</b> <span style="color: #777777">(Age)</span></p>
            </div>
            <div class="col-1">
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>Kasarian</b></p>
            </div>
            <div class="col-3">
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>Pagkakakilanlan ng Kasarian</b> <span style="color: #777777">(Gender Identity)</span></p>
            </div>
            <div class="col-3">
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>Katayuang Sibil</b> <span style="color: #777777">(Civil Status)</span></p>
            </div>
        </div>
        
        <div class="row" style="margin-top: 10px;">
            <div class="col-3">
                <?php echo fitSpan(!empty($client["b_occupation"])?$client["b_occupation"]:""); ?>
            </div>
            <div class="col-2">
                <?php echo fitSpan(!empty($client["b_salary"])?$client["b_salary"]:""); ?>
            </div>
            <div class="col-4">
            </div>
            <div class="col-3">
            </div>
        </div>
        <div class="row" style="height: 25px; margin-top: 0px; margin-bottom: 10px;">
            <div class="col-3">
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>Hanapbuhay</b> <span style="color: #777777;">(Occupation)</span></p>
            </div>
            <div class="col-2">
                <p class="text-center" style="width: 100%; height:80%; font-size: 7px; line-height: 10px;"><b>Buwanang Kita</b> <span style="color: #777777;">(Monthly Income)</span></p>
            </div>
            <div class="col-4">
            </div>
            <div class="col-3">
            </div>
        </div>

        <?php $recList = array_map(function($__r){ return strtolower($__r["received"] ?? ""); }, $records ?? array()); $recOther = ""; foreach(($records ?? array()) as $__r){ if(strtolower($__r["received"] ?? "")==="other"){ $recOther = $__r["other_specify"]; } } ?>
        <p class="header" style="margin-top: 10px; margin-left: -15px; margin-right: -15px; font-size: 15px;"><b>&emsp; NATANGGAP NA TULONG MULA SA DSWD</b> <span style="font-style: italic;">(Assistance Received from DSWD)</span></p>

        <div class="row" style="margin-top: -18px; border: solid 1px black; height: 325px;">
            <div class="col-6"">
                <div class="row" style="padding: 10px 0px 10px 5px;">
                    <div class="col-12" style="margin-left: 12px;"> 
                        <p style="line-height: 15px;"><b style="font-size: 15px;">Ikaw ba ay nakakuha na ng tulong mula sa DSWD?</b><br>
                        <span style="color: #777777 font-size: 13px;">(Have you received any assistance from the DSWD?)</span></p>
                    </div>
                    <div class="col-12" style="margin-top: 12px;">
                        <div class="row">
                            <div class="col-2">
                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black; float:right" type="text" value='<?php echo (!empty($records)?"&#x2714;":"") ?>'>
                            </div>
                            <div class="col-10">
                                Oo
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12" style="margin-top: 12px;">
                        <div class="row">
                            <div class="col-2">
                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black; float:right" type="text" value='<?php echo (empty($records)?"&#x2714;":"") ?>'>
                            </div>
                            <div class="col-10">
                                Hindi
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6"">
                <div class="row" style="padding: 10px 0px;">
                    <div class="col-12" style="margin-bottom: 24px;">   
                        <p style="line-height: 14px;"><b style="font-size: 15px;">Natanggap na tulong sa DSWD</b><br> 
                        <span style="color: #777777 font-size: 13px;">(Assistance received from DSWD)<br></p>
                    </div>
                    <div class="col-12">
                        <div class="row" style="margin-bottom: 10px;">
                            <div class="col-2">
                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black; float:right" type="text" value='<?php echo (in_array('aics',$recList)?"&#x2714;":"") ?>'>
                            </div>
                            <div class="col-10">
                                Assistance to the Individual in Crisis Situation (AICS)
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row" style="margin-bottom: 10px;">
                            <div class="col-2">
                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black; float:right" type="text" value='<?php echo (in_array('wgp',$recList)?"&#x2714;":"") ?>'>
                            </div>
                            <div class="col-10">
                                Walang Gutom Program (WGP)
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row" style="margin-bottom: 10px;">
                            <div class="col-2">
                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black; float:right" type="text" value='<?php echo (in_array('4ps',$recList)?"&#x2714;":"") ?>'>
                            </div>
                            <div class="col-10">
                                Pantawid Pamilyang Pilipino Program (4Ps)
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row" style="margin-bottom: 10px;">
                            <div class="col-2">
                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black; float:right" type="text" value='<?php echo (in_array('slp',$recList)?"&#x2714;":"") ?>'>
                            </div>
                            <div class="col-10">
                                Sustainable Livelihood Program (SLP)
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row" style="margin-bottom: 10px;">
                            <div class="col-2">
                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black; float:right" type="text" value='<?php echo (in_array('kalahi',$recList)?"&#x2714;":"") ?>'>
                            </div>
                            <div class="col-10">
                                Kapit-Bisig Laban sa Kahirapan-Comprehensive and Integrated Delivery of Social Services (KALAHI-CIDSS)
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row" style="margin-bottom: 10px;">
                            <div class="col-2">
                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black; float:right" type="text" value='<?php echo (in_array('other',$recList)?"&#x2714;":"") ?>'>
                            </div>
                            <div class="col-10">
                                Others:
                                <?php echo htmlspecialchars((string)$recOther, ENT_QUOTES) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer row">
            <div class="col-12 text-center" style="height: 20px; font-size: 14px;">
            <label>Page 1 of 2</label>
            </div>
            <div class="col-12" style="border-top: solid 1px black;">
            <p class="text-center">
                DSWD Field Office XI, Ramon Magsaysay Avenue corner Damaso Suazo Street, Davao City, Philippines 8000<br>
                Website: http://fo11.dswd.gov.ph Tel Nos.: (082) 227 1964</p>
            </div>
        </div>
        <!--Container-->
    </div>
    <div class="page-break"></div>
    <!-- Page 2 -->
    <div class="container page2" id="gisv2_print" style="font-size:12px; font-family: Arial, sans-serif; margin-top: 24px; border:solid 1px black; padding: 15px; padding-top: 0px;">
        <div class="row" style="margin-bottom: 15px;">
            <div class="col-12">
                <div class="row" style="border: solid 1px black; border-bottom: none;">
                    <div class="col-12" style="margin: 5px 0px;">
                        <p class="header" style="margin: -5px -17px 0px -15px; text-indent: 14px; font-size: 16px; margin-bottom: 0%;"><b>KOMPOSISYON NG PAMILYA</b> <span style="font-style: italic;">(Family Composition)</span></p>
                        <div class="row">
                            <div class="col-12">
                                <div class="row" style="padding: 10px 0px;">
                                    <div class="col-4 text-center" style="font-size:14px; padding: 0%;">
                                        <b>Buong Pangalan</b><p style="font-size: smaller; margin: 0%; margin-top: -5px; padding: 0%;"><span style="color: #777777">(Last Name, First Name, Middle Name, Extension Name)</span></p>
                                    </div>
                                    <div class="col-3 text-center" style="font-size:14px; padding: 0%;">
                                        <b>Relasyon sa Benepisyaryo</b><p style="font-size: smaller; margin: 0%; margin-top: -5px; padding: 0%;"><span style="color: #777777">(Relationship to the Beneficiary)</span></p>
                                    </div>
                                    <div class="col-1 text-center" style="font-size:14px; padding: 0%;">
                                        <b>Edad</b><p style="font-size: smaller; margin: 0%; margin-top: -5px; padding: 0%;"><span style="color: #777777">(Age)</span></p>
                                    </div>
                                    <div class="col-2 text-center" style="font-size:14px; padding: 0%;">
                                        <b>Hanapbuhay</b><p style="font-size: smaller; margin: 0%; margin-top: -5px; padding: 0%;"><span style="color: #777777">(Occupation)</span></p>
                                    </div>
                                    <div class="col-2 text-center" style="font-size:14px; padding: 0%;">
                                        <b>Buwanang Kita</b><p style="font-size: smaller; margin: 0%; margin-top: -5px; padding: 0%;"><span style="color: #777777">(Monthly Income)</p>
                                    </div>
                                </div>
                                <div class="row text-center" style="border: 1px solid black; padding:0px; font-size:14px; line-height: 15px;">
                                    <?php for ($i = 0; $i < 15; $i++):
                                        $h    = 50;                 
                                        $num  = $i + 1;
                                        $fam  = (!empty($client_fam) && !empty($client_fam[$i])) ? $client_fam[$i] : null;
                                        $fName = $fam ? htmlspecialchars((string)$fam["name"], ENT_QUOTES) : "";
                                        $fRel  = $fam ? htmlspecialchars((string)$fam["relation_bene"], ENT_QUOTES) : "";
                                        $fAge  = $fam ? htmlspecialchars((string)$fam["age"], ENT_QUOTES) : "";
                                        $fOcc  = $fam ? htmlspecialchars((string)$fam["occupation"], ENT_QUOTES) : "";
                                        $fSal  = $fam ? $fam["salary"] : "";
                                    ?>
                                        <div class="col-4" style="padding:0px; height: <?php echo $h; ?>px; border: solid 1px black;">
                                            <div class="row no-gutters h-100">
                                                <div class="col-2 d-flex align-items-center justify-content-center" style="border-right: solid 1px black; height: <?php echo $h; ?>px;">
                                                    <label style="margin: 0;"><?php echo $num; ?>.</label>
                                                </div>
                                                <div class="col-10 d-flex align-items-center justify-content-center" style="height: <?php echo $h; ?>px;">
                                                    <?php echo fitSpan($fName, $h, false); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3 d-flex align-items-center justify-content-center" style="padding:0px; height: <?php echo $h; ?>px; border: solid 1px black;">
                                            <?php echo fitSpan($fRel, $h, false); ?>
                                        </div>
                                        <div class="col-1 d-flex align-items-center justify-content-center" style="padding:0px; height: <?php echo $h; ?>px; border: solid 1px black;">
                                            <p style="margin: 0; text-align: center; width: 100%;"><?php echo $fAge; ?></p>
                                        </div>
                                        <div class="col-2 d-flex align-items-center justify-content-center" style="padding:0px; height: <?php echo $h; ?>px; border: solid 1px black;">
                                            <?php echo fitSpan($fOcc, $h, false); ?>
                                        </div>
                                        <div class="col-2 d-flex align-items-center justify-content-center" style="padding:0px; height: <?php echo $h; ?>px; border: solid 1px black;">
                                            <?php echo fitSpan($fSal, $h, false); ?>
                                        </div>
                                    <?php endfor; ?>

                                    <!-- TOTAL FAMILY INCOME ROW -->
                                    <div class="col-10 d-flex align-items-center justify-content-end" style="padding:0px; height: 50px; border: solid 1px black;">
                                        <label style="font-weight: bold; font-size: 18px; margin: 0 10px 0 0;">TOTAL FAMILY INCOME</label>
                                    </div>
                                    <div class="col-2 d-flex align-items-center justify-content-center" style="padding:0px; height: 50px; border: solid 1px black;">
                                        <?php echo fitSpan(number_format($total_family_income, 2), 50, false, true); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12" style="margin: 5px 0px;">
                                <p class="header" style="margin: -10px -17px 0px -15px; text-indent: 14px; font-size: 16px; margin-bottom: 0%;"><b>DEKLARASYON NG PAHINTULOT</b> <span style="font-style: italic;">(Consent Form)</span></p>
                                <div class="row">
                                    <div class="col-12" style="padding: 15px 42px 0px 42px;">
                                        <p style="text-align:justify; text-indent: 16px; font-size: 14px;">Ako ay nagdedeklara sa ilalim ng parusa ng pagsisinungaling (perjury), na ang lahat ng impormasyon sa aplikasyon na ito ay totoo at tama batay sa aking personal na kaalaman at mga autentikong rekord na isinumite sa Department of Social Welfare and Development (DSWD). Anumang mali o mapanlinlang na impormasyon na ibinigay, o paggawa ng pekeng/pinagwaglit na mga dokumento ay magiging sanhi ng nararapat na hakbang na legal laban sa akin at awtomatikong magpawalang-bisa sa anumang tulong na ibibigay kaugnay ng aplikasyon na ito.</p><br>
                                        <p style="text-align:justify; text-indent: 16px; font-size: 14px;">Ako ay sumasang-ayon na ang lahat ng personal na datos (ayon sa depinisyon sa ilalim ng Republic Act 10173 o Data Privacy Act of 2012 at mga patnubay nito) at impormasyon o mga rekord ng mga transaksyon sa account sa DSWD ay maaaring iproseso, i-profile, at kung kinakailangan at pinahihintulutan ng batas at mga patakaran, ilathala ang aking pangalan sa opisyal na website ng DSWD, alinsunod sa probisyon ng RA 12314 or the General Appropriations Act, para sa transparency at accountability, o ibahagi sa mga humihiling na partido o para sa layunin ng anumang hukuman, proseso ng batas, pagsusuri, inquiry, audit, o imbestigasyon ng anumang awtoridad.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-8 text-center">
                        <div style="position: relative; height: 200px;">
                            <div style="position: absolute; bottom: 30px; left: 50%; transform: translateX(-50%); width: 60%; text-align: center;">
                                <?php echo fitSpan(((!empty($client["lastname"])?$client["lastname"].", ":"") . (!empty($client["firstname"])?$client["firstname"]." ":"") . (!empty($client["middlename"])?$client["middlename"][0].". ":""). (!empty($client["extraname"])?$client["extraname"]." ":"")), 30, true); ?>
                                <br>
                                <b>Lagda sa ibabaw ng Buong Pangalan ng Kinatawan/Kliyente</b>
                                <p style="margin: 0; font-size: 11px;">Last Name, First Name, Middle Name, Extension Name</p>
                                <p style="color: #777777; font-style: italic; margin: 0;">
                                    (Signature over Printed Name of the Authorized Representative/Client)
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div style="height: 170px; width: 150px; border: solid 1px #000000; margin: 10px 50px; text-align: center; position: relative;">
                            <div style="position: absolute; bottom: 10; left: 50%; transform: translateX(-50%);">
                                Thumbmark
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer row">
            <div class="col-12 text-center" style="height: 20px; font-size: 14px;">
            <label>Page 2 of 2</label>
            </div>
            <div class="col-12" style="border-top: solid 1px black;">
            <p class="text-center">
                DSWD Field Office XI, Ramon Magsaysay Avenue corner Damaso Suazo Street, Davao City, Philippines 8000<br>
                Website: http://fo11.dswd.gov.ph Tel Nos.: (082) 227 1964</p>
            </div>
        </div>
        <!--Container-->
    </div>

</body>

</html>