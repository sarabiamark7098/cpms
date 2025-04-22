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
    #gisv2_print input{
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

	
 </style>
     <!-- Page 1 -->
    <div class="container page1" id="informationSheet_print" style="font-size:12px; padding:0%; font-family: Arial, sans-serif;">
        
        <!--HEADER-->
        <div class="row" style="margin-top:0%; margin-bottom: 3%;">
            <div class="col-6">
                <img src="../images/dswd_olog.png" alt="" width="230px" height="60px">
                <img src="../images/AICS.png" alt="" width="70px" height="60px">
                <img src="../images/BP.png" alt="" width="70px" height="60px">
            </div>
            <div class="col-3 ml-md-auto" style="color: #000000; ">
            </div>
            <div class="col-3 ml-md-auto" style="color: #000000; ">
                <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;border:1px solid black;" value="" />&emsp;CENTRAL OFFICE<br>
                <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;border:1px solid black;" value="&#x2714;" />&emsp;FIELD OFFICE <input class="text-center" style="width: 40%; height:30%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="20px" value='XI'>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12" style="text-align: center; margin-top: -7px">
                
                <div class="row">
                    <div class="col-12">
                        <p style="margin-top: -7px; margin-left:-15px; margin-right:-15px;"><b style="font-size: 24px">INFORMATION SHEET</b></p>
                    </div>
                </div>                
            </div>
        </div>
        <div class="row" style="padding: 0%; margin-bottom: 3%;">
            <div class="col-9" style="font-size:14px; padding: 0%;">
                <div class="row">
                    <div class="col-sm-1 center" style="margin-right: 5px;">
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
                        <input class="text-center" style="width: 50px; font-size: 14px; padding:0; border: 1px solid black;" type="text" value='<?php echo date("m") ?>'>
                        <input class="text-center" style="width: 50px; font-size: 14px; padding:0; border: 1px solid black;" type="text" value='<?php echo date("d") ?>'>
                        <input class="text-center" style="width: 70px; font-size: 14px; padding:0; border: 1px solid black;" type="text" value='<?php echo date("Y") ?>'>
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
        <p class="header" style="margin-top: -20px; margin-left: -15px; margin-right: -15px; font-size: 15px;"><b>&emsp; IMPORMASYON NG KINATAWAN</b> <span style="font-style: italic;">(Representative's Identifying Information)</span></p>

        <div class="row" style="margin-top: -8px;">
            <div class="col-4">
                <input class="text-center" style="width: 100%; height:80%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo !empty($client["lastname"])?$client["lastname"]:"" ?>'>
            </div>
            <div class="col-4">
                <input class="text-center" style="width: 100%; height:80%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo !empty($client["firstname"])?$client["firstname"]:"" ?>'>
            </div>
            <div class="col-3">
                <input class="text-center" style="width: 100%; height:80%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo !empty($client["middlename"])?$client["middlename"]:"" ?>'>
            </div>
            <div class="col-1">
                <input class="text-center" style="width: 100%; height:80%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo !empty($client["extraname"])?$client["extraname"]:"" ?>'>
            </div>
        </div>
        <div class="row" style="margin-top: -5px;">
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
        <div class="row" style="margin-top: -8px;">
            <div class="col-3">
                <input class="text-center" style="width: 100%; height:80%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo !empty($client["client_street"])?$client["client_street"]:"" ?>'>
            </div>
            <div class="col-3">
                <input class="text-center" style="width: 100%; height:80%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo !empty($client["client_barangay"])?explode("/",$client["client_barangay"])[0]:"" ?>'>
            </div>
            <div class="col-2">
                <input class="text-center" style="width: 100%; height:80%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo !empty($client["client_municipality"])?explode("/",$client["client_municipality"])[0]:"" ?>'>
            </div>
            <div class="col-2">
                <input class="text-center" style="width: 100%; height:80%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo !empty($client["client_province"])?explode("/",$client["client_province"])[0]:"" ?>'>
            </div>
            <div class="col-2">
                <input class="text-center" style="width: 100%; height:80%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo !empty($client["client_region"])?explode("(",$client["client_region"])[0]:"" ?>'>
            </div>
        </div>
        <div class="row" style="margin-top: -5px;">
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
        <div class="row" style="margin-top: -8px;">
            <div class="col-2">
                <input class="text-center" style="width: 100%; height:80%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo !empty($client["contact"])?$client["contact"]:"" ?>'>
            </div>
            <div class="col-2">
                <input class="text-center" style="width: 100%; height:80%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo !empty($client["date_birth"])?date("m-d-Y" ,strtotime($client["date_birth"])):"" ?>'>
            </div>
            <div class="col-1">
                <input class="text-center" style="width: 100%; height:80%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo !empty($client["date_birth"])?$age_client:"" ?>'>
            </div>
            <div class="col-1">
                <input class="text-center" style="width: 100%; height:80%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo !empty($client["sex"])?$client["sex"]:"" ?>'>
            </div>
            <div class="col-2">
                <input class="text-center" style="width: 100%; height:80%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo !empty($client["civil_status"])?$client["civil_status"]:"" ?>'>
            </div>
            <div class="col-3">
                <input class="text-center" style="width: 100%; height:80%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo !empty($client["occupation"])?$client["occupation"]:"" ?>'>
            </div>
            <div class="col-1">
                <input class="text-center" style="width: 100%; height:80%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo !empty($client["salary"])?$client["salary"]:"" ?>'>
            </div>
        </div>
        <div class="row" style="height: 35px; margin-top: -5px;">
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
            <div class="col-2">
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>Katayuang Sibil</b> <span style="color: #777777;">(Civil Status)</span></p>
            </div>
            <div class="col-3">
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>Hanapbuhay</b> <span style="color: #777777;">(Occupation)</span></p>
            </div>
            <div class="col-1">
                <p class="text-center" style="width: 100%; height:80%; font-size: 7px; line-height: 10px;"><b>Buwanang Kita</b> <span style="color: #777777;">(Monthly Income)</span></p>
            </div>
        </div>
        <div class="row" style="margin-top: -8px;">
            <div class="col-4">
                <input class="text-center" style="width: 100%; height:80%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo !empty($client["relation"])?$client["relation"]:"Self" ?>'>
            </div>
            <div class="col-2">
            </div>
            <div class="col-3">
            </div>
            <div class="col-2">
            </div>
            <div class="col-1">
            </div>
        </div>
        <div class="row" style="height: 25px; margin-top: -5px;">
            <div class="col-4">
                <p class="text-center" style="width: 100%; font-size: 10px; "><b>Relasyon sa Benepisyaryo</b> <span style="color: #777777;">(Relationship to the Beneficiary)</span></p>
            </div>
            <div class="col-2">
            </div>
            <div class="col-3">
            </div>
            <div class="col-1">
            </div>
            <div class="col-2">
            </div>
        </div>

        <!--BENEFICIARY INFO-->
        <p class="header" style="margin-top: -5px; margin-left: -15px; margin-right: -15px; font-size: 15px;"><b>&emsp; IMPORMASYON NG BENEPISYARYO</b> <span style="font-style: italic;">(Beneficiary's Identifying Information)</span> <span style="float:right; font-size: 13px; margin-right: 20px;"><input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black; background-color: #ffffff;" type="text" value="<?php echo (strtolower($client["relation"])=="self")?"&#x2714;":"" ?>"></input> KATULAD NG NASA ITAAS</span></p>

        <div class="row" style="margin-top:-8px; ">
            <div class="col-4">
                <input class="text-center" style="width: 100%; height:80%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" value='<?php echo !empty($client["b_lname"])?$client["b_lname"]:"" ?>'>
            </div>
            <div class="col-4">
                <input class="text-center" style="width: 100%; height:80%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" value='<?php echo !empty($client["b_fname"])?$client["b_fname"]:"" ?>'>
            </div>
            <div class="col-3">
                <input class="text-center" style="width: 100%; height:80%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" value='<?php echo !empty($client["b_mname"])?$client["b_mname"]:"" ?>'>
            </div>
            <div class="col-1">
                <input class="text-center" style="width: 100%; height:80%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" value='<?php echo !empty($client["b_exname"])?$client["b_exname"]:"" ?>'>
            </div>
        </div>
        <div class="row" style="margin-top: -5px;">
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
        <div class="row" style="margin-top: -8px;">
            <div class="col-3">
                <input class="text-center" style="width: 100%; height:80%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo !empty($client["b_street"])?$client["b_street"]:"" ?>'>
            </div>
            <div class="col-3">
                <input class="text-center" style="width: 100%; height:80%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo !empty($client["b_barangay"])?explode("/",$client["b_barangay"])[0]:"" ?>'>
            </div>
            <div class="col-2">
                <input class="text-center" style="width: 100%; height:80%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo !empty($client["b_municipality"])?explode("/",$client["b_municipality"])[0]:"" ?>'>
            </div>
            <div class="col-2">
                <input class="text-center" style="width: 100%; height:80%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo !empty($client["b_province"])?explode("/",$client["b_province"])[0]:"" ?>'>
            </div>
            <div class="col-2">
                <input class="text-center" style="width: 100%; height:80%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo !empty($client["b_region"])?explode("(",$client["b_region"])[0]:"" ?>'>
            </div>
        </div>
        <div class="row" style="margin-top: -5px;">
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
        <div class="row" style="margin-top: -8px;">
            <div class="col-2">
                <input class="text-center" style="width: 100%; height:80%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo !empty($client["b_contact"])?$client["b_contact"]:"" ?>'>
            </div>
            <div class="col-2">
                <input class="text-center" style="width: 100%; height:80%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo !empty($client["b_bday"])?date("m, d, Y" ,strtotime($client["b_bday"])):"" ?>'>
            </div>
            <div class="col-1">
                <input class="text-center" style="width: 100%; height:80%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo !empty($client["b_bday"])?$age_bene:"" ?>'>
            </div>
            <div class="col-1">
                <input class="text-center" style="width: 100%; height:80%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo !empty($client["b_sex"])?$client["b_sex"]:"" ?>'>
            </div>
            <div class="col-2">
                <input class="text-center" style="width: 100%; height:80%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo !empty($client["b_civilStatus"])?$client["b_civilStatus"]:"" ?>'>
            </div>
            <div class="col-3">
                <input class="text-center" style="width: 100%; height:80%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo !empty($client["b_occupation"])?$client["b_occupation"]:"" ?>'>
            </div>
            <div class="col-1">
                <input class="text-center salary_monthly" style="width: 100%; height:80%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo !empty($client["b_salary"])?$client["b_salary"]:"" ?>'>
            </div>
        </div>
        <div class="row" style="margin-top: -5px; margin-bottom: -15px">
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
            <div class="col-2">
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>Katayuang Sibil</b> <span style="color: #777777">(Civil Status)</span></p>
            </div>
            <div class="col-3">
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>Hanapbuhay</b> <span style="color: #777777">(Occupation)</span></p>
            </div>
            <div class="col-1">
                <p class="text-center" style="width: 100%; height:80%; font-size: 7px; line-height: 10px;"><b>Buwanang Kita</b> <span style="color: #777777">(Monthly Income)</span></p>
            </div>
        </div>
        <div class="row" style="padding: 0px; border: solid 1px black;">
            <div class="col-4" style="border-right: solid 1px #000000;">
                <div class="row" style="padding: 5px;">
                    <div class="col-12"> 
                        <p style="line-height: 14px; font-size: 10px;">Ikaw ba ay nakakuha na ng tulong mula sa DSWD?<br>
                        <span style="color: #777777">(Have you received any assistance from the DSWD?)</span></p>
                    </div>
                    <div class="col-3">
                        <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black; float:right" type="text" value='<?php echo (isset($otherClientInformation['emergencyfund'])? "&#x2714;" : "") ?>'>
                    </div>
                    <div class="col-9">
                        Oo
                    </div>
                    <div class="col-3">
                        <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black; float:right" type="text" value='<?php echo (isset($otherClientInformation['emergencyfund'])? "&#x2714;" : "") ?>'>
                    </div>
                    <div class="col-9">
                        Hindi
                    </div>
                </div>
            </div>
            <div class="col-4" style="border-right: solid 1px #000000;">
                <div class="row" style="padding: 5px;">
                    <div class="col-12">   
                        <p style="line-height: 14px; font-size: 10px; margin:0%;">Natanggap na tulong sa DSWD 
                        <span style="color: #777777">(Assistance received from DSWD)<br>
                        Gamitin ang likurang bahagi ng papel kung kinakailangan</span></p>
                    </div>
                    <div class="col-12">
                        1. &nbsp; <input class="text-center" style="width: 90%; font-size: 14px; padding:0; text-indent: 1px; border-bottom: 1px solid black;" type="text" value='<?php echo (isset($otherClientInformation['emergencyfund'])? "&#x2714;" : "") ?>'>
                    </div>
                    <div class="col-12">
                        2. &nbsp; <input class="text-center" style="width: 90%; font-size: 14px; padding:0; text-indent: 1px; border-bottom: 1px solid black;" type="text" value='<?php echo (isset($otherClientInformation['emergencyfund'])? "&#x2714;" : "") ?>'>
                    </div>
                    <div class="col-12">
                        3. &nbsp; <input class="text-center" style="width: 90%; font-size: 14px; padding:0; text-indent: 1px; border-bottom: 1px solid black;" type="text" value='<?php echo (isset($otherClientInformation['emergencyfund'])? "&#x2714;" : "") ?>'>
                    </div>
                    <div class="col-12">
                        4. &nbsp; <input class="text-center" style="width: 90%; font-size: 14px; padding:0; text-indent: 1px; border-bottom: 1px solid black;" type="text" value='<?php echo (isset($otherClientInformation['emergencyfund'])? "&#x2714;" : "") ?>'>
                    </div>
                    <div class="col-12">
                        5. &nbsp; <input class="text-center" style="width: 90%; font-size: 14px; padding:0; text-indent: 1px; border-bottom: 1px solid black;" type="text" value='<?php echo (isset($otherClientInformation['emergencyfund'])? "&#x2714;" : "") ?>'>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="row" style="padding: 5px;">
                    <div class="col-12">
                        <p style="line-height: 14px; font-size: 10px; margin:0%;">Petsa ng tulong 
                        <span style="color: #777777">(Date of assistance received)</span><br>.</p>
                    </div>
                    <div class="col-12">
                        1. &nbsp; <input class="text-center" style="width: 90%; font-size: 14px; padding:0; text-indent: 1px; border-bottom: 1px solid black;" type="text" value='<?php echo (isset($otherClientInformation['emergencyfund'])? "&#x2714;" : "") ?>'>
                    </div>
                    <div class="col-12">
                        2. &nbsp; <input class="text-center" style="width: 90%; font-size: 14px; padding:0; text-indent: 1px; border-bottom: 1px solid black;" type="text" value='<?php echo (isset($otherClientInformation['emergencyfund'])? "&#x2714;" : "") ?>'>
                    </div>
                    <div class="col-12">
                        3. &nbsp; <input class="text-center" style="width: 90%; font-size: 14px; padding:0; text-indent: 1px; border-bottom: 1px solid black;" type="text" value='<?php echo (isset($otherClientInformation['emergencyfund'])? "&#x2714;" : "") ?>'>
                    </div>
                    <div class="col-12">
                        4. &nbsp; <input class="text-center" style="width: 90%; font-size: 14px; padding:0; text-indent: 1px; border-bottom: 1px solid black;" type="text" value='<?php echo (isset($otherClientInformation['emergencyfund'])? "&#x2714;" : "") ?>'>
                    </div>
                    <div class="col-12">
                        5. &nbsp; <input class="text-center" style="width: 90%; font-size: 14px; padding:0; text-indent: 1px; border-bottom: 1px solid black;" type="text" value='<?php echo (isset($otherClientInformation['emergencyfund'])? "&#x2714;" : "") ?>'>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="row" style="border: solid 1px black;">
                    <div class="col-12" style="margin: 5px 0px;">
                        <p class="header" style="margin-top: -7px; margin-left:-15px; margin-right:-15px; text-indent: 14px; font-size: 16px; margin-bottom: 0%;"><b>KOMPOSISYON NG PAMILYA</b> <span style="font-style: italic;">(Family Composition)</span> <span style="float:right; font-size: 13px; margin-right: 20px;">Paalala: Gamitin ang likurang bahagi ng papel kung kinakailangan.</span></p>
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-4 text-center" style="border: 1px solid black; font-size:14px; padding: 0%;">
                                        <b>Buong Pangalan</b><p style="font-size: smaller; margin: 0%; margin-top: -5px; padding: 0%;"><span style="color: #777777">(Full Name)</span></p>
                                    </div>
                                    <div class="col-3 text-center" style="border: 1px solid black; font-size:14px; padding: 0%;">
                                        <b>Relasyon sa Benepisyaryo</b><p style="font-size: smaller; margin: 0%; margin-top: -5px; padding: 0%;"><span style="color: #777777">(Relationship to the Beneficiary)</span></p>
                                    </div>
                                    <div class="col-1 text-center" style="border: 1px solid black; font-size:14px; padding: 0%;">
                                        <b>Edad</b><p style="font-size: smaller; margin: 0%; margin-top: -5px; padding: 0%;"><span style="color: #777777">(Age)</span></p>
                                    </div>
                                    <div class="col-2 text-center" style="border: 1px solid black; font-size:14px; padding: 0%;">
                                        <b>Trabaho</b><p style="font-size: smaller; margin: 0%; margin-top: -5px; padding: 0%;"><span style="color: #777777">(Occupation)</span></p>
                                    </div>
                                    <div class="col-2 text-center" style="border: 1px solid black; font-size:14px; padding: 0%;">
                                        <b>Buwanang Kita</b><p style="font-size: smaller; margin: 0%; margin-top: -5px; padding: 0%;"><span style="color: #777777">(Monthly Salary)</p>
                                    </div>
                                </div>
                                <div class="row text-center" style="border: 1px solid black; padding:0px; padding-top: 0px; font-size:14px; min-height: 65px; max-height: 1000px; line-height: 15px;">
                                    <div class="col-4" style="padding:0px; height: 28px; border: solid 1px">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[1])?$client_fam[1]["name"]:""):"") ?></p>
                                    </div>
                                    <div class="col-3" style="padding:0px; max-height: 28px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[1])?$client_fam[1]["relation_bene"]:""):"") ?></p>
                                    </div>
                                    <div class="col-1" style="padding:0px; max-height: 28px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[1])?$client_fam[1]["age"]:""):"") ?></p>
                                    </div>
                                    <div class="col-2" style="padding:0px; max-height: 28px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[1])?$client_fam[1]["occupation"]:""):"") ?></p>
                                    </div>
                                    <div class="col-2" style="padding:0px; max-height: 28px; border: solid 1px black;">
                                        <input class="text-center salary_monthly" style="width: 100%; height:70%; font-size: 13px; padding:0; border:none;" type="text" height="30px" value='<?php echo (!empty($client_fam)?(!empty($client_fam[1])?$client_fam[1]["salary"]:""):"") ?>'>
                                    </div>
                                    <div class="col-4" style="padding:0px; height: 28px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[2])?$client_fam[2]["name"]:""):"") ?></p>
                                    </div>
                                    <div class="col-3" style="padding:0px; max-height: 28px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[2])?$client_fam[2]["relation_bene"]:""):"") ?></p>
                                    </div>
                                    <div class="col-1" style="padding:0px; max-height: 28px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[2])?$client_fam[2]["age"]:""):"") ?></p>
                                    </div>
                                    <div class="col-2" style="padding:0px; max-height: 28px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[2])?$client_fam[2]["occupation"]:""):"") ?></p>
                                    </div>
                                    <div class="col-2" style="padding:0px; max-height: 28px; border: solid 1px black;">
                                        <input class="text-center salary_monthly" style="width: 100%; height:70%; font-size: 13px; padding:0; border:none;" type="text" height="30px" value='<?php echo (!empty($client_fam)?(!empty($client_fam[2])?$client_fam[2]["salary"]:""):"") ?>'>
                                    </div>
                                    <div class="col-4" style="padding:0px; height: 28px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[3])?$client_fam[3]["name"]:""):"") ?></p>
                                    </div>
                                    <div class="col-3" style="padding:0px; max-height: 28px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[3])?$client_fam[3]["relation_bene"]:""):"") ?></p>
                                    </div>
                                    <div class="col-1" style="padding:0px; max-height: 28px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[3])?$client_fam[3]["age"]:""):"") ?></p>
                                    </div>
                                    <div class="col-2" style="padding:0px; max-height: 28px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[3])?$client_fam[3]["occupation"]:""):"") ?></p>
                                    </div>
                                    <div class="col-2" style="padding:0px; max-height: 28px; border: solid 1px black;">
                                        <input class="text-center salary_monthly" style="width: 100%; height:70%; font-size: 13px; padding:0; border:none;" type="text" height="30px" value='<?php echo (!empty($client_fam)?(!empty($client_fam[3])?$client_fam[3]["salary"]:""):"") ?>'>
                                    </div>

                                </div>
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
    <div class="container page2" id="gisv2_print" style="font-size:12px; padding:0%; font-family: Arial, sans-serif; margin-top: 24px;">
        <div class="row" style="margin-bottom: 15px;">
            <div class="col-12">
                <div class="row" style="border: solid 1px black; border-bottom: none;">
                    <div class="col-12" style="margin: 5px 0px;">
                        <p class="header" style="margin-top: -7px; margin-left:-15px; margin-right:-15px; text-indent: 14px;"><b style="font-size: 16px"> I. INCOME AND FINANCIAL RESOURCES</b></p>
                        <div class="row" style="margin-top:-16px;">
                            <div class="col-3" style="border: solid 1px black; border-bottom: none;">
                                <div class="row">
                                    <div class="col-12">
                                        <label style="margin-top: 12px; text-indent: 3px;"><b style="font-size: 16px"> Target Sector: </b></label>                        
                                    </div>
                                    <div class="col-6" style="margin-top: 3px;">
                                        <input class="check-box text-center" style="margin-left: 10%; width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo ($gis['target_sector'] == 1? '&#x2714;':'') ?>'>
                                        <label style="font-size: 14px; margin-left: 10px;">FHONA</label>
                                    </div>
                                    <div class="col-6">
                                        <input class="check-box text-center" style="margin-left: 10%; width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo ($gis['target_sector'] == 2? '&#x2714;':'') ?>'>
                                        <label style="font-size: 14px; margin-left: 10px;">SC</label>
                                    </div>
                                    <div class="col-6" style="margin-top: 3px;">
                                        <input class="check-box text-center" style="margin-left: 10%; width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo ($gis['target_sector'] == 3? '&#x2714;':'') ?>'>
                                        <label style="font-size: 14px; margin-left: 10px;">WEDC</label>
                                    </div>
                                    <div class="col-6">
                                        <input class="check-box text-center" style="margin-left: 10%; width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo ($gis['target_sector'] == 4? '&#x2714;':'') ?>'>
                                        <label style="font-size: 14px; margin-left: 10px;">YNSP</label>
                                    </div>
                                    <div class="col-6" style="margin-top: 3px;">
                                        <input class="check-box text-center" style="margin-left: 10%; width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo ($gis['target_sector'] == 5? '&#x2714;':'') ?>'>
                                        <label style="font-size: 14px; margin-left: 10px;">PWD</label>
                                    </div>
                                    <div class="col-6">
                                        <input class="check-box text-center" style="margin-left: 10%; width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo ($gis['target_sector'] == 6? '&#x2714;':'') ?>'>
                                        <label style="font-size: 14px; margin-left: 10px;">PLHIV</label>
                                    </div>
                                    <div class="col-6" style="margin-top: 3px;">
                                        <input class="check-box text-center" style="margin-left: 10%; width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo ($gis['target_sector'] == 7? '&#x2714;':'') ?>'>
                                        <label style="font-size: 14px; margin-left: 10px;">CNSP</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="row">
                                    <div class="col-6">
                                        <label style="margin-top: 12px; text-indent: 30px;"><b style="font-size: 16px">Specify Sub-category:</b></label>                        
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo ($gis['subcat_ass'] == 1? '&#x2714;':'') ?>'>
                                                        <label style="font-size: 14px; margin-left: 10px;">Solo Parent</label>
                                                    </div>
                                                    <div class="col-12">
                                                        <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo ($gis['subcat_ass'] == 2? '&#x2714;':'') ?>'>
                                                        <label style="font-size: 14px; margin-left: 10px;">Indigenous People</label>
                                                    </div>
                                                    <div class="col-12">
                                                        <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo ($gis['subcat_ass'] == 5? '&#x2714;':'') ?>'>
                                                        <label style="font-size: 14px; margin-left: 10px;">Street Dwellers</label>
                                                    </div>
                                                    <div class="col-12">
                                                        <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo ($gis['subcat_ass'] == 9? '&#x2714;':'') ?>'>
                                                        <label style="font-size: 14px; margin-left: 10px;">KIA/WIA</label>
                                                    </div>
                                                    <div class="col-12">
                                                        <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo ($gis['subcat_ass'] == 4? '&#x2714;':'') ?>'>
                                                        <label style="font-size: 14px; margin-left: 10px;">4PS Beneficiary</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="row">
                                                    <div class="col-2">
                                                        <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo ($gis['subcat_ass'] == 3? '&#x2714;':'') ?>'>
                                                    </div>
                                                    <div class="col-10">
                                                        <label style="font-size: 14px; margin-left: 10px;">Recovering Person Who Used Drugs</label>
                                                    </div>
                                                    <div class="col-2">
                                                        <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo ($gis['subcat_ass'] == 10? '&#x2714;':'') ?>'>
                                                    </div>
                                                    <div class="col-10">
                                                        <label style="font-size: 14px; margin-left: 10px;">Minimum Wage Earner</label>
                                                    </div>
                                                    <div class="col-2">
                                                        <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo ($gis['subcat_ass'] == 11? '&#x2714;':'') ?>'>
                                                    </div>
                                                    <div class="col-10">
                                                        <label style="font-size: 14px; margin-left: 10px;">Below Minimum Wage Earner</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6" style="border: solid 1px #000000; position: absolute; right: 0; top: 0;">
                                        <label style="margin-top: 12px; text-indent: 30px;"><b style="font-size: 16px">Type of Disability:</b></label>                        
                                        <div class="row">
                                            <div class="col-6">
                                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo ($gis['type_of_disability'] == 1? '&#x2714;':'') ?>'>
                                                <label style="font-size: 14px; margin-left: 10px;">Speech Impairment</label><br>
                                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo ($gis['type_of_disability'] == 2? '&#x2714;':'') ?>'>
                                                <label style="font-size: 14px; margin-left: 10px;">Learning Disability</label><br>
                                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo ($gis['type_of_disability'] == 3? '&#x2714;':'') ?>'>
                                                <label style="font-size: 12px; margin-left: 10px;">Psychosocial Disability</label><br>
                                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo ($gis['type_of_disability'] == 4? '&#x2714;':'') ?>'>
                                                <label style="font-size: 14px; margin-left: 10px;">Deaf/Hard-of-Hearing</label><br>
                                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo ($gis['type_of_disability'] == 5? '&#x2714;':'') ?>'>
                                                <label style="font-size: 14px; margin-left: 10px;">Cancer</label>
                                            </div>
                                            <div class="col-6">
                                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo ($gis['type_of_disability'] == 6? '&#x2714;':'') ?>'>
                                                <label style="font-size: 14px; margin-left: 10px;">Mental Disability</label><br>
                                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo ($gis['type_of_disability'] == 7? '&#x2714;':'') ?>'>
                                                <label style="font-size: 14px; margin-left: 10px;">Visual Disability</label><br>
                                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo ($gis['type_of_disability'] == 8? '&#x2714;':'') ?>'>
                                                <label style="font-size: 14px; margin-left: 10px;">Intellectual Disability</label><br>
                                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo ($gis['type_of_disability'] == 9? '&#x2714;':'') ?>'>
                                                <label style="font-size: 14px; margin-left: 10px;">Physical Disability</label><br>
                                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo ($gis['type_of_disability'] == 10? '&#x2714;':'') ?>'>
                                                <label style="font-size: 14px; margin-left: 10px;">Rare Disease</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3" style="border: solid 1px black; border-top: none; border-bottom: none;">
                                <div class="row">
                                    <div class="col-6">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="row">
                                            <div class="col-12">
                                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo ($gis['subcat_ass'] == 13? '&#x2714;':'') ?>'>
                                                <label style="font-size: 14px; margin-left: 10px;">Stateless Person</label>
                                            </div>
                                            <div class="col-12">
                                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo ($gis['subcat_ass'] == 14? '&#x2714;':'') ?>'>
                                                <label style="font-size: 14px; margin-left: 10px;">Asylum Seeker</label>
                                            </div>
                                            <div class="col-12">
                                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo ($gis['subcat_ass'] == 15? '&#x2714;':'') ?>'>
                                                <label style="font-size: 14px; margin-left: 10px;">Refugees</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="row">
                                            <div class="col-12">
                                                <label style="font-size: 14px; margin-left: 10px;">(specify approximate</label>
                                            </div>
                                            <div class="col-12" style="margin-top: -10px;">
                                                <label style="font-size: 14px; margin-left: 10px;">monthly income)</label>
                                                &emsp;Php<input style="text-indent: 10px; width: 30%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo !empty($gis['below_monthly_income'])? $gis['below_monthly_income']: ""; ?>'>
                                            </div>
                                            <div class="col-12" style="margin-top: 5px;">
                                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo ($gis['subcat_ass'] == 12? '&#x2714;':'') ?>'>
                                                <label style="font-size: 14px; margin-left: 10px;">No Regular Income</label>
                                            </div>
                                            <div class="col-12">
                                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo ($gis['subcat_ass'] == 8? '&#x2714;':'') ?>'>
                                                <label style="font-size: 14px; margin-left: 10px;">Others:</label>
                                                <input style="text-indent: 10px; width: 50%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo !empty($gis['others_subcat'])? $gis['others_subcat']: ""; ?>'>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3" style="border: solid 1px black; border-top: none;">
                                <div class="row">
                                    <div class="col-6">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="row">
                                    <div class="col-3">
                                    </div>
                                    <div class="col-9">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-7" style="margin-top: 8px;">
                                                        <p style="font-size: 16px; text-indent: 48px;"><b>Source of Income:</b></p>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo !empty($otherinfo['wage'])? '&#x2714;': ""; ?>'>
                                                                <label style="font-size: 14px; margin-left: 10px;">Salaries/Wages from Employment</label>
                                                            </div>
                                                            <div class="col-12">
                                                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo !empty($otherinfo['profit'])? '&#x2714;': ""; ?>'>
                                                                <label style="font-size: 14px; margin-left: 10px;">Entrepreneurial income/profits</label>
                                                            </div>
                                                            <div class="col-12">
                                                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo !empty($otherinfo['domestic_source'])? '&#x2714;': ""; ?>'>
                                                                <label style="font-size: 14px; margin-left: 10px;">Cash assistance from domestic source</label>
                                                            </div>
                                                            <div class="col-12">
                                                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo !empty($otherinfo['abroad'])? '&#x2714;': ""; ?>'>
                                                                <label style="font-size: 14px; margin-left: 10px;">Cash assistance from abroad</label>
                                                            </div>
                                                            <div class="col-12">
                                                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo !empty($otherinfo['government_transfer'])? '&#x2714;': ""; ?>'>
                                                                <label style="font-size: 14px; margin-left: 10px;">Transfers from the government (e.g. 4Ps)</label>
                                                            </div>
                                                            <div class="col-12">
                                                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo !empty($otherinfo['pension'])? '&#x2714;': ""; ?>'>
                                                                <label style="font-size: 14px; margin-left: 10px;">Pension</label>
                                                            </div>
                                                            <div class="col-12">
                                                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo !empty($otherinfo['other_income'])? '&#x2714;': ""; ?>'>
                                                                <label style="font-size: 14px; margin-left: 10px;">Other income</label>
                                                            </div>
                                                            <div class="col-12">
                                                                <p style="font-size: 15px; margin-left: 10px; text-align: right;"><b>Total income in the last 6 months</b></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-5" style="margin-top: 8px;">
                                                        <p style="font-size: 16px; text-indent: 48px;">.</p>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                Php&emsp;<input style="text-indent: 10px; width: 60%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black; margin-bottom: 8px;" type="text" height="30px" value='<?php echo !empty($otherinfo['wage'])? $otherinfo['wage']: ""; ?>'>
                                                            </div>
                                                            <div class="col-12">
                                                                Php&emsp;<input style="text-indent: 10px; width: 60%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black; margin-bottom: 8px;" type="text" height="30px" value='<?php echo !empty($otherinfo['profit'])? $otherinfo['profit']: ""; ?>'>
                                                            </div>
                                                            <div class="col-12">
                                                                Php&emsp;<input style="text-indent: 10px; width: 60%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black; margin-bottom: 9px;" type="text" height="30px" value='<?php echo !empty($otherinfo['domestic_source'])? $otherinfo['domestic_source']: ""; ?>'>
                                                            </div>
                                                            <div class="col-12">
                                                                Php&emsp;<input style="text-indent: 10px; width: 60%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black; margin-bottom: 9px;" type="text" height="30px" value='<?php echo !empty($otherinfo['abroad'])? $otherinfo['abroad']: ""; ?>'>
                                                            </div>
                                                            <div class="col-12">
                                                                Php&emsp;<input style="text-indent: 10px; width: 60%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black; margin-bottom: 10px;" type="text" height="30px" value='<?php echo !empty($otherinfo['government_transfer'])? $otherinfo['government_transfer']: ""; ?>'>
                                                            </div>
                                                            <div class="col-12">
                                                                Php&emsp;<input style="text-indent: 10px; width: 60%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black; margin-bottom: 10px;" type="text" height="30px" value='<?php echo !empty($otherinfo['pension'])? $otherinfo['pension']: ""; ?>'>
                                                            </div>
                                                            <div class="col-12">
                                                                Php&emsp;<input style="text-indent: 10px; width: 60%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black; margin-bottom: 10px;" type="text" height="30px" value='<?php echo !empty($otherinfo['other_income'])? $otherinfo['other_income']: ""; ?>'>
                                                            </div>
                                                            <div class="col-12">
                                                                Php&emsp;<input style="text-indent: 10px; width: 60%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black; margin-bottom: 5px;" type="text" height="30px" value='<?php echo !empty($totalSourceofIncome)? $totalSourceofIncome: ""; ?>'>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <p class="header" style="margin-top: -7px; margin-left:-15px; margin-right:-15px; text-indent: 14px;"><b style="font-size: 16px"> IX. PROBLEM PRESENTED</b></p>
                        <div class="row" style="height: 100px">
                            <div class="col-12 text-center" style="font-size:14px;line-height: 16px; margin-top: -15px;"> <br>
                                <p><?php echo $gis["problem"]; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <p class="header" style="margin-left:-15px; margin-right:-15px; text-indent: 14px;"><b style="font-size: 16px"> X. SOCIAL WORKER'S ASSESSMENT</b></p>
                        <div class="row" style="height: 150px">
                            <div class="col-12 text-center" style="font-size:14px; line-height: 16px; margin-top: -15px;"> <br>
                                <p><?php echo $gis["soc_ass"]; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row" style="border-left: 1px solid black; border-right: 1px solid black;">
                            <div class="col">
                                <div class="row">
                                    <div class="col-12">
                                    <p class="header" style="margin-left:-15px; margin-right:-15px; text-indent: 14px;"><b style="font-size: 15px">
                                        <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black; background-color: #ffffff;" type="text" value='<?php echo !empty($client_assistance[1]['financial'])? '&#x2714;': ""; ?>'>&nbsp;FINANCIAL ASSISTANCE<span style="margin-right: 100px"></span>
                                        <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black; background-color: #ffffff;" type="text" value='<?php echo !empty($client_assistance[1]['material'])? '&#x2714;': ""; ?>'>&nbsp;MATERIAL ASSISTANCE<span style="margin-right: 40px"></span>
                                        <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black; background-color: #ffffff;" type="text" value='<?php echo !empty($gis["service5"])||!empty($gis["service6"])? '&#x2714;': ""; ?>'>&nbsp;PSYCHOSOCIAL SUPPORT<span style="margin-right: 40px"></span>
                                        <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black; background-color: #ffffff;" type="text" value='<?php echo !empty($gis["refer1"])? '&#x2714;': ""; ?>'>&nbsp;REFERRAL :
                                    </b></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-2" style="margin-left:0px; margin-bottom:5px; font-size:14px;">
                                        <div>
                                            <a style="margin-left: 15px"></a>
                                            <input class="check-box text-center" style="width: 15px; height: 15px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo ($client_assistance[1]['financial'] == 1)? '&#x2714;': ""; ?>'>&nbsp;Medical<br>
                                            <a style="margin-left: 15px"></a>
                                            <input class="check-box text-center" style="width: 15px; height: 15px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo ($client_assistance[1]['financial'] == 4)? '&#x2714;': ""; ?>'>&nbsp;Funeral<br>
                                            <a style="margin-left: 15px"></a>
                                            <input class="check-box text-center" style="width: 15px; height: 15px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo ($client_assistance[1]['financial'] == 2)? '&#x2714;': ""; ?>'>&nbsp;Transportation<br>
                                            <a style="margin-left: 15px"></a>
                                            <input class="check-box text-center" style="width: 15px; height: 15px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo ($client_assistance[1]['financial'] == 5)? '&#x2714;': ""; ?>'>&nbsp;Educational<br>
                                            </div>
                                    </div>
                                    <div class="col-3" style="margin-left:-40px; margin-bottom:5px; font-size:14px;">
                                        <div>
                                            <a style="margin-left: 0px"></a>
                                            <input class="check-box text-center" style="width: 15px; height: 15px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo ($client_assistance[1]['financial'] == 3)? '&#x2714;': ""; ?>'>&nbsp;Food Assistance<br>
                                            <a style="margin-left: 0px"></a>
                                            <input class="check-box text-center" style="width: 15px; height: 15px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo ($client_assistance[1]['financial'] == 6)? '&#x2714;': ""; ?>'>&nbsp;Cash Relief Assistance<br>
                                        </div>
                                    </div>
                                    <div class="col-4" style="margin-left:-60px; margin-bottom:5px; font-size:14px;">
                                        <div>
                                            <a style="margin-left: 0px"></a>
                                            <input class="check-box text-center" style="width: 15px; height: 15px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo ($client_assistance[1]['material'] == 1)? '&#x2714;': ""; ?>'>&nbsp;Family Food Packs<br>
                                            <a style="margin-left: 0px"></a>
                                            <input class="check-box text-center" style="width: 15px; height: 15px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo ($client_assistance[1]['material'] == 2)? '&#x2714;': ""; ?>'>&nbsp;Other Food Items<br>
                                            <a style="margin-left: 0px"></a>
                                            <input class="check-box text-center" style="width: 15px; height: 15px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo ($client_assistance[1]['material'] == 3)? '&#x2714;': ""; ?>'>&nbsp;Hygiene or Sleeping Kits<br>
                                            <a style="margin-left: 0px"></a>
                                            <input class="check-box text-center" style="width: 15px; height: 15px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo ($client_assistance[1]['material'] == 4)? '&#x2714;': ""; ?>'>&nbsp;Assistive Devices and Technologies<br>
                                            <a style="margin-left: 0px"></a>
                                            <input class="check-box text-center" style="width: 15px; height: 15px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo ($client_assistance[1]['material'] == 5)? '&#x2714;': ""; ?>'>&nbsp;Rice
                                        </div>
                                    </div>
                                    <div class="col-3" style="margin-left:-70px; font-size:13px;">
                                        <div>
                                            <a style="margin-left: -20px"></a>
                                            <input class="check-box text-center" style="width: 15px; height: 15px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo ($gis["service5"] == 1)? '&#x2714;': ""; ?>'>&nbsp;Psychological FIrst Aid (PFA)<br>
                                            <a style="margin-left: -20px"></a>
                                            <input class="check-box text-center" style="width: 15px; height: 15px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo ($gis["service6"] == 1)? '&#x2714;': ""; ?>'>&nbsp;Social Work Counseling<br>
                                            
                                        </div>
                                    </div>
                                    <div class="col-2" style="margin-left:-30px; margin-bottom:5px; font-size:12px;">
                                        <div>
                                            <input style="width: 10px; margin-left:-5; width: 120px;padding:0; text-indent: 2px; border-bottom: 1px solid black;" type="text" value='<?php echo ($gis["refer1"] != ""?$gis["refer1"]:"")?>'><br>
                                            <input style="width: 10px; margin-left:-5; width: 120px;padding:0; text-indent: 2px; border-bottom: 1px solid black;" type="text" value='<?php echo ($gis["refer2"] != ""?$gis["refer2"]:"")?>'><br>
                                            <input style="width: 10px; margin-left:-5; width: 120px;padding:0; text-indent: 2px; border-bottom: 1px solid black;" type="text" value='<?php echo ($gis["refer3"] != ""?$gis["refer3"]:"")?>'><br>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-5 text-center">
                            <p class="header" style="margin-left:-15px; margin-right:-15px; text-indent: 14px;"><b style="font-size: 16px"> Purpose of Assistance</b></p>
                            </div>
                            <div class="col-2 text-center">
                            <p class="header" style="margin-left:-15px; margin-right:-15px; text-indent: 14px;"><b style="font-size: 16px"> Amount</b></p>
                            </div>
                            <div class="col-5 text-center">
                            <p class="header" style="margin-left:-15px; margin-right:-15px; text-indent: 14px;"><b style="font-size: 16px"> Fund Source</b></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5 text-center" style="font-size:14px; margin-top: -18px; border: solid 1px #000000;">
                                <div class="row">
                                    <div class="col-1 text-center" style="font-size:14px; border: solid 1px #000000;">
                                        1
                                    </div>
                                    <div class="col-11 text-center">
                                        <span><?php echo $client_assistance[1]['purpose']; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2 text-center" style="font-size:14px; margin-top: -18px; border: solid 1px #000000;">
                                <span><?php echo $client_assistance[1]['amount']; ?></span>
                            </div>
                            <div class="col-5 text-center" style="font-size:14px; margin-top: -18px; border: solid 1px #000000;">
                                <span><?php
                                    for ($i = 1; $i <= 12; $i++) {
                                        if (!empty($fundsourcedata[$i]['fundsource'])) {
                                            echo $fundsourcedata[$i]['fundsource'] . "=" . 
                                                (!empty($fundsourcedata[$i]['fs_amount']) ? $fundsourcedata[$i]['fs_amount'] : $client_assistance[1]['amount']) . ", ";
                                        }
                                    }
                                ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row" style="height: 220px">
                            <div class="col-6 text-center" style="font-size:14px; line-height: 16px; padding-top: 30px;">
                                <b>Interviewed by:</b><br>
                                <input class="text-center" style="width: 80%; border-bottom: 1px solid black; margin-top: 40px;" type="text" value='<?php echo strtoupper($soc_workFullname); ?>'><br>
                                <label>Social Worker</label><br>
                                <label style="margin-top: -10px;">(Signature over Printed Name)</label><br>
                                <div style="margin-top: -10px;">
                                <label>License no.:</label><input class="text-center" style="width: 20%; border-bottom: 1px solid black;" type="text" value='<?php echo $soc_worker['sw_license_no']; ?>'><br>
                                </div>
                            </div>
                            <div class="col-6 text-center" style="font-size:14px; line-height: 16px; padding-top: 30px;">
                                <b>Reviewed & Approved by:</b>
                                <input class="text-center" style="width: 80%; border-bottom: 1px solid black; margin-top: 40px;" type="text" value='<?php echo strtoupper($GISsignatoryName) ?>'><br>
                                <label>Approving Authority</label><br>
                                <label style="margin-top: -10px;">(Signature over Printed Name)</label><br>
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