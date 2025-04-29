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

	
 </style>
     <!-- Page 1 -->
    <div class="container page1" id="informationSheet_print" style="font-size:12px; padding:0%; font-family: Arial, sans-serif; border:solid 1px black; padding: 15px">
        
        <!--HEADER-->
        <div class="row" style="margin-top:0%; margin-bottom: 3%;">
            <div class="col-6">
                <img src="/cpms/images/dswd_olog.png" alt="" width="230px" height="60px">
                <img src="/cpms/images/AICS.png" alt="" width="70px" height="60px">
                <img src="/cpms/images/BP.png" alt="" width="70px" height="60px">
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
                        <p style="margin-top: -7px; margin-left:-15px; margin-right:-15px;"><b style="font-size: 32px">INFORMATION SHEET</b></p>
                    </div>
                </div>                
            </div>
        </div>
        <div class="row" style="padding: 0%; margin-bottom: 3%;">
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

        <div class="row" style="margin-top: -2px;">
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
        <div class="row" style="margin-top: -2px;">
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
        <div class="row" style="margin-top: -2px;">
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
        <div class="row" style="margin-top: -2px;">
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
        <p class="header" style="margin-top: 0px; margin-left: -15px; margin-right: -15px; font-size: 15px;"><b>&emsp; IMPORMASYON NG BENEPISYARYO</b> <span style="font-style: italic;">(Beneficiary's Identifying Information)</span> <span style="float:right; font-size: 13px; margin-right: 20px;"><input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black; background-color: #ffffff;" type="text" value="<?php echo (strtolower($client["relation"])=="self")?"&#x2714;":"" ?>"></input> KATULAD NG NASA ITAAS</span></p>

        <div class="row" style="margin-top: -2px; ">
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
        <div class="row" style="margin-top: -2px;">
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
        <div class="row" style="margin-top: -2px;">
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
        <div class="row" style="margin-top: -5px; margin-bottom: 0px">
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
                <div class="row" style="padding: 10px 0px 10px 5px;">
                    <div class="col-12"> 
                        <p style="line-height: 14px; font-size: 10px;">Ikaw ba ay nakakuha na ng tulong mula sa DSWD?<br>
                        <span style="color: #777777">(Have you received any assistance from the DSWD?)</span></p>
                    </div>
                    <div class="col-3">
                        <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black; float:right" type="text" value=''>
                    </div>
                    <div class="col-9">
                        Oo
                    </div>
                    <div class="col-3">
                        <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black; float:right" type="text" value=''>
                    </div>
                    <div class="col-9">
                        Hindi
                    </div>
                </div>
            </div>
            <div class="col-4" style="border-right: solid 1px #000000;">
                <div class="row" style="padding: 10px 0px;">
                    <div class="col-12">   
                        <p style="line-height: 14px; font-size: 10px; margin:0%;">Natanggap na tulong sa DSWD 
                        <span style="color: #777777">(Assistance received from DSWD)<br>
                        Gamitin ang likurang bahagi ng papel kung kinakailangan</span></p>
                    </div>
                    <div class="col-12">
                        1. &nbsp; <input class="text-center" style="width: 90%; font-size: 14px; padding:0; text-indent: 1px; border-bottom: 1px solid black;" type="text" value=''>
                    </div>
                    <div class="col-12">
                        2. &nbsp; <input class="text-center" style="width: 90%; font-size: 14px; padding:0; text-indent: 1px; border-bottom: 1px solid black;" type="text" value=''>
                    </div>
                    <div class="col-12">
                        3. &nbsp; <input class="text-center" style="width: 90%; font-size: 14px; padding:0; text-indent: 1px; border-bottom: 1px solid black;" type="text" value=''>
                    </div>
                    <div class="col-12">
                        4. &nbsp; <input class="text-center" style="width: 90%; font-size: 14px; padding:0; text-indent: 1px; border-bottom: 1px solid black;" type="text" value=''>
                    </div>
                    <div class="col-12">
                        5. &nbsp; <input class="text-center" style="width: 90%; font-size: 14px; padding:0; text-indent: 1px; border-bottom: 1px solid black;" type="text" value=''>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="row" style="padding: 10px 5px;;">
                    <div class="col-12">
                        <p style="line-height: 14px; font-size: 10px; margin:0%;">Petsa ng tulong 
                        <span style="color: #777777">(Date of assistance received)</span><br>.</p>
                    </div>
                    <div class="col-12">
                        1. &nbsp; <input class="text-center" style="width: 90%; font-size: 14px; padding:0; text-indent: 1px; border-bottom: 1px solid black;" type="text" value=''>
                    </div>
                    <div class="col-12">
                        2. &nbsp; <input class="text-center" style="width: 90%; font-size: 14px; padding:0; text-indent: 1px; border-bottom: 1px solid black;" type="text" value=''>
                    </div>
                    <div class="col-12">
                        3. &nbsp; <input class="text-center" style="width: 90%; font-size: 14px; padding:0; text-indent: 1px; border-bottom: 1px solid black;" type="text" value=''>
                    </div>
                    <div class="col-12">
                        4. &nbsp; <input class="text-center" style="width: 90%; font-size: 14px; padding:0; text-indent: 1px; border-bottom: 1px solid black;" type="text" value=''>
                    </div>
                    <div class="col-12">
                        5. &nbsp; <input class="text-center" style="width: 90%; font-size: 14px; padding:0; text-indent: 1px; border-bottom: 1px solid black;" type="text" value=''>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="row" style="border: solid 1px black;">
                    <div class="col-12" style="margin: 5px 0px;">
                        <p class="header" style="margin: -5px -17px 0px -15px; text-indent: 14px; font-size: 16px; margin-bottom: 0%;"><b>KOMPOSISYON NG PAMILYA</b> <span style="font-style: italic;">(Family Composition)</span> <span style="float:right; font-size: 13px; margin-right: 20px;">Paalala: Gamitin ang likurang bahagi ng papel kung kinakailangan.</span></p>
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-4 text-center" style="font-size:14px; padding: 0%;">
                                        <b>Buong Pangalan</b><p style="font-size: smaller; margin: 0%; margin-top: -5px; padding: 0%;"><span style="color: #777777">(Full Name)</span></p>
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
                                        <b>Buwanang Kita</b><p style="font-size: smaller; margin: 0%; margin-top: -5px; padding: 0%;"><span style="color: #777777">(Monthly Salary)</p>
                                    </div>
                                </div>
                                <div class="row text-center" style="border: 1px solid black; padding:0px; font-size:14px; line-height: 15px;">
                                    <div class="col-4" style="padding:0px; height: 28px; border: solid 1px">
                                        <div class="row">
                                            <div class="col-2" style="border-right: solid 1px black; height: 28px; text-align: center; padding: 5px;">
                                                <label style="display: absolute;  position: center;">1.</label>
                                            </div>
                                            <div class="col-10" style="border-left: solid 1px black; height: 28px;">
                                                <p><?php echo (!empty($client_fam)?(!empty($client_fam[0])?$client_fam[0]["name"]:""):"") ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3" style="padding:0px; max-height: 28px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[0])?$client_fam[0]["relation_bene"]:""):"") ?></p>
                                    </div>
                                    <div class="col-1" style="padding:0px; max-height: 28px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[0])?$client_fam[0]["age"]:""):"") ?></p>
                                    </div>
                                    <div class="col-2" style="padding:0px; max-height: 28px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[0])?$client_fam[0]["occupation"]:""):"") ?></p>
                                    </div>
                                    <div class="col-2" style="padding:0px; max-height: 28px; border: solid 1px black;">
                                        <input class="text-center salary_monthly" style="width: 100%; height:70%; font-size: 13px; padding:0; border:none;" type="text" height="30px" value='<?php echo (!empty($client_fam)?(!empty($client_fam[0])?$client_fam[0]["salary"]:""):"") ?>'>
                                    </div>
                                    <div class="col-4" style="padding:0px; height: 28px; border: solid 1px">
                                        <div class="row">
                                            <div class="col-2" style="border-right: solid 1px black; height: 28px; text-align: center; padding: 5px;">
                                                <label style="display: absolute;  position: center;">2.</label>
                                            </div>
                                            <div class="col-10" style="border-left: solid 1px black; height: 28px;">
                                                <p><?php echo (!empty($client_fam)?(!empty($client_fam[1])?$client_fam[1]["name"]:""):"") ?></p>
                                            </div>
                                        </div>
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
                                    <div class="col-4" style="padding:0px; height: 28px; border: solid 1px">
                                        <div class="row">
                                            <div class="col-2" style="border-right: solid 1px black; height: 28px; text-align: center; padding: 5px;">
                                                <label style="display: absolute;  position: center;">3.</label>
                                            </div>
                                            <div class="col-10" style="border-left: solid 1px black; height: 28px;">
                                                <p><?php echo (!empty($client_fam)?(!empty($client_fam[2])?$client_fam[2]["name"]:""):"") ?></p>
                                            </div>
                                        </div>
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
                                    <div class="col-4" style="padding:0px; height: 28px; border: solid 1px">
                                        <div class="row">
                                            <div class="col-2" style="border-right: solid 1px black; height: 28px; text-align: center; padding: 5px;">
                                                <label style="display: absolute;  position: center;">4.</label>
                                            </div>
                                            <div class="col-10" style="border-left: solid 1px black; height: 28px;">
                                                <p><?php echo (!empty($client_fam)?(!empty($client_fam[3])?$client_fam[3]["name"]:""):"") ?></p>
                                            </div>
                                        </div>
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
                                    <div class="col-4" style="padding:0px; height: 28px; border: solid 1px">
                                        <div class="row">
                                            <div class="col-2" style="border-right: solid 1px black; height: 28px; text-align: center; padding: 5px;">
                                                <label style="display: absolute;  position: center;">5.</label>
                                            </div>
                                            <div class="col-10" style="border-left: solid 1px black; height: 28px;">
                                                <p><?php echo (!empty($client_fam)?(!empty($client_fam[4])?$client_fam[4]["name"]:""):"") ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3" style="padding:0px; max-height: 28px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[4])?$client_fam[4]["relation_bene"]:""):"") ?></p>
                                    </div>
                                    <div class="col-1" style="padding:0px; max-height: 28px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[4])?$client_fam[4]["age"]:""):"") ?></p>
                                    </div>
                                    <div class="col-2" style="padding:0px; max-height: 28px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[4])?$client_fam[4]["occupation"]:""):"") ?></p>
                                    </div>
                                    <div class="col-2" style="padding:0px; max-height: 28px; border: solid 1px black;">
                                        <input class="text-center salary_monthly" style="width: 100%; height:70%; font-size: 13px; padding:0; border:none;" type="text" height="30px" value='<?php echo (!empty($client_fam)?(!empty($client_fam[4])?$client_fam[4]["salary"]:""):"") ?>'>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-12" style="margin: 5px 0px;">
                        <p class="header" style="margin: -5px -17px 0px -15px; text-indent: 14px; font-size: 16px; margin-bottom: 0%;"><b>DEKLARASYON NG PAHINTULOT</b> <span style="font-style: italic;">(Consent Form)</span></p>
                        <div class="row">
                            <div class="col-12" style="padding: 15px 42px 0px 42px;">
                                <p style="text-align:justify; text-indent: 16px;">Ako ay nagdedeklara sa ilalim ng parusa ng pagsisinungaling (perjury), na ang lahat ng impormasyon sa aplikasyon na ito ay totoo at tama batay sa aking personal na kaalaman at mga autentikong rekord na isinumite sa Department of Social Welfare and Development (DSWD). Anumang mali o mapanlinlang na impormasyon na ibinigay, o paggawa ng pekeng/pinagwaglit na mga dokumento ay magiging sanhi ng nararapat na hakbang na legal laban sa akin at awtomatikong magpawalang-bisa sa anumang tulong na ibibigay kaugnay ng aplikasyon na ito.</p><br>
                                <p style="text-align:justify; text-indent: 16px;">Ako ay sumasang-ayon na ang lahat ng personal na datos (ayon sa depinisyon sa ilalim ng Republic Act 10173 o Data Privacy Law ng 2012 at mga patnubay nito) at impormasyon o mga rekord ng mga transaksyon sa account sa DSWD ay maaaring iproseso, i-profile, o ibahagi sa mga humihiling na partido o para sa layunin ng anumang hukuman, proseso ng batas, pagsusuri, inquiry, audit, o imbestigasyon ng anumang awtoridad.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-8 text-center">
                <div style="position: relative; height: 200px;">
                    <div style="position: absolute; bottom: 30px; left: 50%; transform: translateX(-50%); width: 60%; text-align: center;">
                        <input class="text-center"
                            style="width: 100%; font-size: 13.5px; padding: 0; border: none; border-bottom: 1px solid black; text-transform: uppercase;"
                            type="text" value='<?php echo ((!empty($client["firstname"])?$client["firstname"]." ":"") . (!empty($client["middlename"])?$client["middlename"][0].". ":""). (!empty($client["lastname"])?$client["lastname"]." ":"") . (!empty($client["extraname"])?$client["extraname"]." ":"")) ?>'>
                        <br>
                        <b>Lagda sa ibabaw ng Buong Pangalan ng Kinatawan/Kliyente</b>
                        <p style="color: #777777; font-style: italic; margin: 0;">
                            (Signature Over Printed Name of the Authorized Representative/Client)
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
                <div class="row" style="border: solid 1px black;">
                    <div class="col-12" style="margin: 5px 0px 0px 0px;">
                        <p class="header" style="margin: -5px -17px 0px -15px; text-indent: 14px; font-size: 16px;"><b>NATANGGAP NA TULONG MULA SA DSWD</b> <span style="font-style: italic;">(Assistance Received from DSWD)</span></p>
                        <div class="row">
                            <div class="col-12">
                                <div class="row" style="padding: 5px 0px;">
                                    <div class="col-7 text-center" style="font-size:14px; padding: 0%;">
                                        <p style="margin: 0%; margin-top: 5px; padding: 0%;"><b>Natanggap na tulong</b><span style="color: #777777"> (Assistance received)</span></p>
                                    </div>
                                    <div class="col-5 text-center" style="font-size:14px; padding: 0%;">
                                        <p style="margin: 0%; margin-top: 5px; padding: 0%;"><b>Petsa ng tulong</b><span style="color: #777777"> (Date of assistance received)</span></p>
                                    </div>
                                </div>
                                <div class="row text-center" style="border: 1px solid black; padding:0px; font-size:14px; line-height: 15px;">
                                    <div class="col-7" style="padding:0px; height: 36px; border: solid 1px">
                                        <div class="row">
                                            <div class="col-1" style="border-right: solid 1px black; height: 36px; text-align: center; padding: 5px;">
                                                <label style="display: absolute;  position: center;">6.</label>
                                            </div>
                                            <div class="col-11" style="border-left: solid 1px black; height: 36px;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-5" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                    </div>
                                    <div class="col-7" style="padding:0px; height: 36px; border: solid 1px">
                                        <div class="row">
                                            <div class="col-1" style="border-right: solid 1px black; height: 36px; text-align: center; padding: 5px;">
                                                <label style="display: absolute;  position: center;">7.</label>
                                            </div>
                                            <div class="col-11" style="border-left: solid 1px black; height: 36px;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-5" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                    </div>
                                    <div class="col-7" style="padding:0px; height: 36px; border: solid 1px">
                                        <div class="row">
                                            <div class="col-1" style="border-right: solid 1px black; height: 36px; text-align: center; padding: 5px;">
                                                <label style="display: absolute;  position: center;">8.</label>
                                            </div>
                                            <div class="col-11" style="border-left: solid 1px black; height: 36px;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-5" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                    </div>
                                    <div class="col-7" style="padding:0px; height: 36px; border: solid 1px">
                                        <div class="row">
                                            <div class="col-1" style="border-right: solid 1px black; height: 36px; text-align: center; padding: 5px;">
                                                <label style="display: absolute;  position: center;">9.</label>
                                            </div>
                                            <div class="col-11" style="border-left: solid 1px black; height: 36px;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-5" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                    </div>
                                    <div class="col-7" style="padding:0px; height: 36px; border: solid 1px">
                                        <div class="row">
                                            <div class="col-1" style="border-right: solid 1px black; height: 36px; text-align: center; padding: 5px;">
                                                <label style="display: absolute;  position: center;">10.</label>
                                            </div>
                                            <div class="col-11" style="border-left: solid 1px black; height: 36px;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-5" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                    </div>
                                    <div class="col-7" style="padding:0px; height: 36px; border: solid 1px">
                                        <div class="row">
                                            <div class="col-1" style="border-right: solid 1px black; height: 36px; text-align: center; padding: 5px;">
                                                <label style="display: absolute;  position: center;">11.</label>
                                            </div>
                                            <div class="col-11" style="border-left: solid 1px black; height: 36px;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-5" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                    </div>
                                    <div class="col-7" style="padding:0px; height: 36px; border: solid 1px">
                                        <div class="row">
                                            <div class="col-1" style="border-right: solid 1px black; height: 36px; text-align: center; padding: 5px;">
                                                <label style="display: absolute;  position: center;">12.</label>
                                            </div>
                                            <div class="col-11" style="border-left: solid 1px black; height: 36px;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-5" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                    </div>
                                    <div class="col-7" style="padding:0px; height: 36px; border: solid 1px">
                                        <div class="row">
                                            <div class="col-1" style="border-right: solid 1px black; height: 36px; text-align: center; padding: 5px;">
                                                <label style="display: absolute;  position: center;">13.</label>
                                            </div>
                                            <div class="col-11" style="border-left: solid 1px black; height: 36px;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-5" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                    </div>
                                    <div class="col-7" style="padding:0px; height: 36px; border: solid 1px">
                                        <div class="row">
                                            <div class="col-1" style="border-right: solid 1px black; height: 36px; text-align: center; padding: 5px;">
                                                <label style="display: absolute;  position: center;">14.</label>
                                            </div>
                                            <div class="col-11" style="border-left: solid 1px black; height: 36px;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-5" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                    </div>
                                    <div class="col-7" style="padding:0px; height: 36px; border: solid 1px">
                                        <div class="row">
                                            <div class="col-1" style="border-right: solid 1px black; height: 36px; text-align: center; padding: 5px;">
                                                <label style="display: absolute;  position: center;">15.</label>
                                            </div>
                                            <div class="col-11" style="border-left: solid 1px black; height: 36px;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-5" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                    </div>
                                    <div class="col-7" style="padding:0px; height: 36px; border: solid 1px">
                                        <div class="row">
                                            <div class="col-1" style="border-right: solid 1px black; height: 36px; text-align: center; padding: 5px;">
                                                <label style="display: absolute;  position: center;">16.</label>
                                            </div>
                                            <div class="col-11" style="border-left: solid 1px black; height: 36px;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-5" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                    </div>
                                    <div class="col-7" style="padding:0px; height: 36px; border: solid 1px">
                                        <div class="row">
                                            <div class="col-1" style="border-right: solid 1px black; height: 36px; text-align: center; padding: 5px;">
                                                <label style="display: absolute;  position: center;">17.</label>
                                            </div>
                                            <div class="col-11" style="border-left: solid 1px black; height: 36px;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-5" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                    </div>
                                    <div class="col-7" style="padding:0px; height: 36px; border: solid 1px">
                                        <div class="row">
                                            <div class="col-1" style="border-right: solid 1px black; height: 36px; text-align: center; padding: 5px;">
                                                <label style="display: absolute;  position: center;">18.</label>
                                            </div>
                                            <div class="col-11" style="border-left: solid 1px black; height: 36px;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-5" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                    </div>
                                    <div class="col-7" style="padding:0px; height: 36px; border: solid 1px">
                                        <div class="row">
                                            <div class="col-1" style="border-right: solid 1px black; height: 36px; text-align: center; padding: 5px;">
                                                <label style="display: absolute;  position: center;">19.</label>
                                            </div>
                                            <div class="col-11" style="border-left: solid 1px black; height: 36px;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-5" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                    </div>
                                    <div class="col-7" style="padding:0px; height: 36px; border: solid 1px">
                                        <div class="row">
                                            <div class="col-1" style="border-right: solid 1px black; height: 36px; text-align: center; padding: 5px;">
                                                <label style="display: absolute;  position: center;">20.</label>
                                            </div>
                                            <div class="col-11" style="border-left: solid 1px black; height: 36px;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-5" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                    </div>
                                    <div class="col-7" style="padding:0px; height: 36px; border: solid 1px">
                                        <div class="row">
                                            <div class="col-1" style="border-right: solid 1px black; height: 36px; text-align: center; padding: 5px;">
                                                <label style="display: absolute;  position: center;">21.</label>
                                            </div>
                                            <div class="col-11" style="border-left: solid 1px black; height: 36px;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-5" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                    </div>
                                    <div class="col-7" style="padding:0px; height: 36px; border: solid 1px">
                                        <div class="row">
                                            <div class="col-1" style="border-right: solid 1px black; height: 36px; text-align: center; padding: 5px;">
                                                <label style="display: absolute;  position: center;">22.</label>
                                            </div>
                                            <div class="col-11" style="border-left: solid 1px black; height: 36px;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-5" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="row" style="border: solid 1px black;">
                    <div class="col-12" style="margin: 5px 0px;">
                        <p class="header" style="margin: -5px -17px 0px -15px; text-indent: 14px; font-size: 16px; margin-bottom: 0%;"><b>KOMPOSISYON NG PAMILYA</b> <span style="font-style: italic;">(Family Composition)</span></p>
                        <div class="row">
                            <div class="col-12">
                                <div class="row" style="padding: 10px 0px;">
                                    <div class="col-4 text-center" style="font-size:14px; padding: 0%;">
                                        <b>Buong Pangalan</b><p style="font-size: smaller; margin: 0%; margin-top: -5px; padding: 0%;"><span style="color: #777777">(Full Name)</span></p>
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
                                        <b>Buwanang Kita</b><p style="font-size: smaller; margin: 0%; margin-top: -5px; padding: 0%;"><span style="color: #777777">(Monthly Salary)</p>
                                    </div>
                                </div>
                                <div class="row text-center" style="border: 1px solid black; padding:0px; font-size:14px; line-height: 15px;">
                                    <div class="col-4" style="padding:0px; height: 28px; border: solid 1px">
                                        <div class="row">
                                            <div class="col-2" style="border-right: solid 1px black; height: 28px; text-align: center; padding: 5px;">
                                                <label style="display: absolute;  position: center;">6.</label>
                                            </div>
                                            <div class="col-10" style="border-left: solid 1px black; height: 28px;">
                                                <p><?php echo (!empty($client_fam)?(!empty($client_fam[5])?$client_fam[5]["name"]:""):"") ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3" style="padding:0px; max-height: 28px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[5])?$client_fam[5]["relation_bene"]:""):"") ?></p>
                                    </div>
                                    <div class="col-1" style="padding:0px; max-height: 28px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[5])?$client_fam[5]["age"]:""):"") ?></p>
                                    </div>
                                    <div class="col-2" style="padding:0px; max-height: 28px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[5])?$client_fam[5]["occupation"]:""):"") ?></p>
                                    </div>
                                    <div class="col-2" style="padding:0px; max-height: 28px; border: solid 1px black;">
                                        <input class="text-center salary_monthly" style="width: 100%; height:70%; font-size: 13px; padding:0; border:none;" type="text" height="30px" value='<?php echo (!empty($client_fam)?(!empty($client_fam[5])?$client_fam[5]["salary"]:""):"") ?>'>
                                    </div>
                                    <div class="col-4" style="padding:0px; height: 36px; border: solid 1px">
                                        <div class="row">
                                            <div class="col-2" style="border-right: solid 1px black; height: 36px; text-align: center; padding: 5px;">
                                                <label style="display: absolute;  position: center;">7.</label>
                                            </div>
                                            <div class="col-10" style="border-left: solid 1px black; height: 36px;">
                                                <p><?php echo (!empty($client_fam)?(!empty($client_fam[6])?$client_fam[6]["name"]:""):"") ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[6])?$client_fam[6]["relation_bene"]:""):"") ?></p>
                                    </div>
                                    <div class="col-1" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[6])?$client_fam[6]["age"]:""):"") ?></p>
                                    </div>
                                    <div class="col-2" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[6])?$client_fam[6]["occupation"]:""):"") ?></p>
                                    </div>
                                    <div class="col-2" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <input class="text-center salary_monthly" style="width: 100%; height:70%; font-size: 13px; padding:0; border:none;" type="text" height="30px" value='<?php echo (!empty($client_fam)?(!empty($client_fam[6])?$client_fam[6]["salary"]:""):"") ?>'>
                                    </div>
                                    <div class="col-4" style="padding:0px; height: 36px; border: solid 1px">
                                        <div class="row">
                                            <div class="col-2" style="border-right: solid 1px black; height: 36px; text-align: center; padding: 5px;">
                                                <label style="display: absolute;  position: center;">8.</label>
                                            </div>
                                            <div class="col-10" style="border-left: solid 1px black; height: 36px;">
                                                <p><?php echo (!empty($client_fam)?(!empty($client_fam[7])?$client_fam[7]["name"]:""):"") ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[7])?$client_fam[7]["relation_bene"]:""):"") ?></p>
                                    </div>
                                    <div class="col-1" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[7])?$client_fam[7]["age"]:""):"") ?></p>
                                    </div>
                                    <div class="col-2" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[7])?$client_fam[7]["occupation"]:""):"") ?></p>
                                    </div>
                                    <div class="col-2" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <input class="text-center salary_monthly" style="width: 100%; height:70%; font-size: 13px; padding:0; border:none;" type="text" height="30px" value='<?php echo (!empty($client_fam)?(!empty($client_fam[7])?$client_fam[7]["salary"]:""):"") ?>'>
                                    </div>
                                    <div class="col-4" style="padding:0px; height: 36px; border: solid 1px">
                                        <div class="row">
                                            <div class="col-2" style="border-right: solid 1px black; height: 36px; text-align: center; padding: 5px;">
                                                <label style="display: absolute;  position: center;">9.</label>
                                            </div>
                                            <div class="col-10" style="border-left: solid 1px black; height: 36px;">
                                                <p><?php echo (!empty($client_fam)?(!empty($client_fam[8])?$client_fam[8]["name"]:""):"") ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[8])?$client_fam[8]["relation_bene"]:""):"") ?></p>
                                    </div>
                                    <div class="col-1" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[8])?$client_fam[8]["age"]:""):"") ?></p>
                                    </div>
                                    <div class="col-2" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[8])?$client_fam[8]["occupation"]:""):"") ?></p>
                                    </div>
                                    <div class="col-2" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <input class="text-center salary_monthly" style="width: 100%; height:70%; font-size: 13px; padding:0; border:none;" type="text" height="30px" value='<?php echo (!empty($client_fam)?(!empty($client_fam[8])?$client_fam[8]["salary"]:""):"") ?>'>
                                    </div>
                                    <div class="col-4" style="padding:0px; height: 36px; border: solid 1px">
                                        <div class="row">
                                            <div class="col-2" style="border-right: solid 1px black; height: 36px; text-align: center; padding: 5px;">
                                                <label style="display: absolute;  position: center;">10.</label>
                                            </div>
                                            <div class="col-10" style="border-left: solid 1px black; height: 36px;">
                                                <p><?php echo (!empty($client_fam)?(!empty($client_fam[9])?$client_fam[9]["name"]:""):"") ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[9])?$client_fam[9]["relation_bene"]:""):"") ?></p>
                                    </div>
                                    <div class="col-1" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[9])?$client_fam[9]["age"]:""):"") ?></p>
                                    </div>
                                    <div class="col-2" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[9])?$client_fam[9]["occupation"]:""):"") ?></p>
                                    </div>
                                    <div class="col-2" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <input class="text-center salary_monthly" style="width: 100%; height:70%; font-size: 13px; padding:0; border:none;" type="text" height="30px" value='<?php echo (!empty($client_fam)?(!empty($client_fam[9])?$client_fam[9]["salary"]:""):"") ?>'>
                                    </div>
                                    <div class="col-4" style="padding:0px; height: 36px; border: solid 1px">
                                        <div class="row">
                                            <div class="col-2" style="border-right: solid 1px black; height: 36px; text-align: center; padding: 5px;">
                                                <label style="display: absolute;  position: center;">11.</label>
                                            </div>
                                            <div class="col-10" style="border-left: solid 1px black; height: 36px;">
                                                <p><?php echo (!empty($client_fam)?(!empty($client_fam[10])?$client_fam[10]["name"]:""):"") ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[10])?$client_fam[10]["relation_bene"]:""):"") ?></p>
                                    </div>
                                    <div class="col-1" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[10])?$client_fam[10]["age"]:""):"") ?></p>
                                    </div>
                                    <div class="col-2" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[10])?$client_fam[10]["occupation"]:""):"") ?></p>
                                    </div>
                                    <div class="col-2" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <input class="text-center salary_monthly" style="width: 100%; height:70%; font-size: 13px; padding:0; border:none;" type="text" height="30px" value='<?php echo (!empty($client_fam)?(!empty($client_fam[10])?$client_fam[10]["salary"]:""):"") ?>'>
                                    </div>
                                    <div class="col-4" style="padding:0px; height: 36px; border: solid 1px">
                                        <div class="row">
                                            <div class="col-2" style="border-right: solid 1px black; height: 36px; text-align: center; padding: 5px;">
                                                <label style="display: absolute;  position: center;">12.</label>
                                            </div>
                                            <div class="col-10" style="border-left: solid 1px black; height: 36px;">
                                                <p><?php echo (!empty($client_fam)?(!empty($client_fam[11])?$client_fam[11]["name"]:""):"") ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[11])?$client_fam[11]["relation_bene"]:""):"") ?></p>
                                    </div>
                                    <div class="col-1" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[11])?$client_fam[11]["age"]:""):"") ?></p>
                                    </div>
                                    <div class="col-2" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[11])?$client_fam[11]["occupation"]:""):"") ?></p>
                                    </div>
                                    <div class="col-2" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <input class="text-center salary_monthly" style="width: 100%; height:70%; font-size: 13px; padding:0; border:none;" type="text" height="30px" value='<?php echo (!empty($client_fam)?(!empty($client_fam[11])?$client_fam[11]["salary"]:""):"") ?>'>
                                    </div>
                                    <div class="col-4" style="padding:0px; height: 36px; border: solid 1px">
                                        <div class="row">
                                            <div class="col-2" style="border-right: solid 1px black; height: 36px; text-align: center; padding: 5px;">
                                                <label style="display: absolute;  position: center;">13.</label>
                                            </div>
                                            <div class="col-10" style="border-left: solid 1px black; height: 36px;">
                                                <p><?php echo (!empty($client_fam)?(!empty($client_fam[12])?$client_fam[12]["name"]:""):"") ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[12])?$client_fam[12]["relation_bene"]:""):"") ?></p>
                                    </div>
                                    <div class="col-1" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[12])?$client_fam[12]["age"]:""):"") ?></p>
                                    </div>
                                    <div class="col-2" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[12])?$client_fam[12]["occupation"]:""):"") ?></p>
                                    </div>
                                    <div class="col-2" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <input class="text-center salary_monthly" style="width: 100%; height:70%; font-size: 13px; padding:0; border:none;" type="text" height="30px" value='<?php echo (!empty($client_fam)?(!empty($client_fam[12])?$client_fam[12]["salary"]:""):"") ?>'>
                                    </div>
                                    <div class="col-4" style="padding:0px; height: 36px; border: solid 1px">
                                        <div class="row">
                                            <div class="col-2" style="border-right: solid 1px black; height: 36px; text-align: center; padding: 5px;">
                                                <label style="display: absolute;  position: center;">14.</label>
                                            </div>
                                            <div class="col-10" style="border-left: solid 1px black; height: 36px;">
                                                <p><?php echo (!empty($client_fam)?(!empty($client_fam[13])?$client_fam[13]["name"]:""):"") ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[13])?$client_fam[13]["relation_bene"]:""):"") ?></p>
                                    </div>
                                    <div class="col-1" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[13])?$client_fam[13]["age"]:""):"") ?></p>
                                    </div>
                                    <div class="col-2" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[13])?$client_fam[13]["occupation"]:""):"") ?></p>
                                    </div>
                                    <div class="col-2" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <input class="text-center salary_monthly" style="width: 100%; height:70%; font-size: 13px; padding:0; border:none;" type="text" height="30px" value='<?php echo (!empty($client_fam)?(!empty($client_fam[13])?$client_fam[13]["salary"]:""):"") ?>'>
                                    </div>
                                    <div class="col-4" style="padding:0px; height: 36px; border: solid 1px">
                                        <div class="row">
                                            <div class="col-2" style="border-right: solid 1px black; height: 36px; text-align: center; padding: 5px;">
                                                <label style="display: absolute;  position: center;">15.</label>
                                            </div>
                                            <div class="col-10" style="border-left: solid 1px black; height: 36px;">
                                                <p><?php echo (!empty($client_fam)?(!empty($client_fam[14])?$client_fam[14]["name"]:""):"") ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[14])?$client_fam[14]["relation_bene"]:""):"") ?></p>
                                    </div>
                                    <div class="col-1" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[14])?$client_fam[14]["age"]:""):"") ?></p>
                                    </div>
                                    <div class="col-2" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[14])?$client_fam[14]["occupation"]:""):"") ?></p>
                                    </div>
                                    <div class="col-2" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <input class="text-center salary_monthly" style="width: 100%; height:70%; font-size: 13px; padding:0; border:none;" type="text" height="30px" value='<?php echo (!empty($client_fam)?(!empty($client_fam[14])?$client_fam[14]["salary"]:""):"") ?>'>
                                    </div>
                                    <div class="col-4" style="padding:0px; height: 36px; border: solid 1px">
                                        <div class="row">
                                            <div class="col-2" style="border-right: solid 1px black; height: 36px; text-align: center; padding: 5px;">
                                                <label style="display: absolute;  position: center;">16.</label>
                                            </div>
                                            <div class="col-10" style="border-left: solid 1px black; height: 36px;">
                                                <p><?php echo (!empty($client_fam)?(!empty($client_fam[15])?$client_fam[15]["name"]:""):"") ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[15])?$client_fam[15]["relation_bene"]:""):"") ?></p>
                                    </div>
                                    <div class="col-1" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[15])?$client_fam[15]["age"]:""):"") ?></p>
                                    </div>
                                    <div class="col-2" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[15])?$client_fam[15]["occupation"]:""):"") ?></p>
                                    </div>
                                    <div class="col-2" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <input class="text-center salary_monthly" style="width: 100%; height:70%; font-size: 13px; padding:0; border:none;" type="text" height="30px" value='<?php echo (!empty($client_fam)?(!empty($client_fam[15])?$client_fam[15]["salary"]:""):"") ?>'>
                                    </div>
                                    <div class="col-4" style="padding:0px; height: 36px; border: solid 1px">
                                        <div class="row">
                                            <div class="col-2" style="border-right: solid 1px black; height: 36px; text-align: center; padding: 5px;">
                                                <label style="display: absolute;  position: center;">17.</label>
                                            </div>
                                            <div class="col-10" style="border-left: solid 1px black; height: 36px;">
                                                <p><?php echo (!empty($client_fam)?(!empty($client_fam[16])?$client_fam[16]["name"]:""):"") ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[16])?$client_fam[16]["relation_bene"]:""):"") ?></p>
                                    </div>
                                    <div class="col-1" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[16])?$client_fam[16]["age"]:""):"") ?></p>
                                    </div>
                                    <div class="col-2" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[16])?$client_fam[16]["occupation"]:""):"") ?></p>
                                    </div>
                                    <div class="col-2" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <input class="text-center salary_monthly" style="width: 100%; height:70%; font-size: 13px; padding:0; border:none;" type="text" height="30px" value='<?php echo (!empty($client_fam)?(!empty($client_fam[16])?$client_fam[16]["salary"]:""):"") ?>'>
                                    </div>
                                    <div class="col-4" style="padding:0px; height: 36px; border: solid 1px">
                                        <div class="row">
                                            <div class="col-2" style="border-right: solid 1px black; height: 36px; text-align: center; padding: 5px;">
                                                <label style="display: absolute;  position: center;">18.</label>
                                            </div>
                                            <div class="col-10" style="border-left: solid 1px black; height: 36px;">
                                                <p><?php echo (!empty($client_fam)?(!empty($client_fam[17])?$client_fam[17]["name"]:""):"") ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[17])?$client_fam[17]["relation_bene"]:""):"") ?></p>
                                    </div>
                                    <div class="col-1" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[17])?$client_fam[17]["age"]:""):"") ?></p>
                                    </div>
                                    <div class="col-2" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[17])?$client_fam[17]["occupation"]:""):"") ?></p>
                                    </div>
                                    <div class="col-2" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <input class="text-center salary_monthly" style="width: 100%; height:70%; font-size: 13px; padding:0; border:none;" type="text" height="30px" value='<?php echo (!empty($client_fam)?(!empty($client_fam[17])?$client_fam[17]["salary"]:""):"") ?>'>
                                    </div>
                                    <div class="col-4" style="padding:0px; height: 36px; border: solid 1px">
                                        <div class="row">
                                            <div class="col-2" style="border-right: solid 1px black; height: 36px; text-align: center; padding: 5px;">
                                                <label style="display: absolute;  position: center;">19.</label>
                                            </div>
                                            <div class="col-10" style="border-left: solid 1px black; height: 36px;">
                                                <p><?php echo (!empty($client_fam)?(!empty($client_fam[18])?$client_fam[18]["name"]:""):"") ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[18])?$client_fam[18]["relation_bene"]:""):"") ?></p>
                                    </div>
                                    <div class="col-1" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[18])?$client_fam[18]["age"]:""):"") ?></p>
                                    </div>
                                    <div class="col-2" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[18])?$client_fam[18]["occupation"]:""):"") ?></p>
                                    </div>
                                    <div class="col-2" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <input class="text-center salary_monthly" style="width: 100%; height:70%; font-size: 13px; padding:0; border:none;" type="text" height="30px" value='<?php echo (!empty($client_fam)?(!empty($client_fam[18])?$client_fam[18]["salary"]:""):"") ?>'>
                                    </div>
                                    <div class="col-4" style="padding:0px; height: 36px; border: solid 1px">
                                        <div class="row">
                                            <div class="col-2" style="border-right: solid 1px black; height: 36px; text-align: center; padding: 5px;">
                                                <label style="display: absolute;  position: center;">20.</label>
                                            </div>
                                            <div class="col-10" style="border-left: solid 1px black; height: 36px;">
                                                <p><?php echo (!empty($client_fam)?(!empty($client_fam[19])?$client_fam[19]["name"]:""):"") ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[19])?$client_fam[19]["relation_bene"]:""):"") ?></p>
                                    </div>
                                    <div class="col-1" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[19])?$client_fam[19]["age"]:""):"") ?></p>
                                    </div>
                                    <div class="col-2" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[19])?$client_fam[19]["occupation"]:""):"") ?></p>
                                    </div>
                                    <div class="col-2" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <input class="text-center salary_monthly" style="width: 100%; height:70%; font-size: 13px; padding:0; border:none;" type="text" height="30px" value='<?php echo (!empty($client_fam)?(!empty($client_fam[19])?$client_fam[19]["salary"]:""):"") ?>'>
                                    </div>
                                    <div class="col-4" style="padding:0px; height: 36px; border: solid 1px">
                                        <div class="row">
                                            <div class="col-2" style="border-right: solid 1px black; height: 36px; text-align: center; padding: 5px;">
                                                <label style="display: absolute;  position: center;">21.</label>
                                            </div>
                                            <div class="col-10" style="border-left: solid 1px black; height: 36px;">
                                                <p><?php echo (!empty($client_fam)?(!empty($client_fam[20])?$client_fam[20]["name"]:""):"") ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[20])?$client_fam[20]["relation_bene"]:""):"") ?></p>
                                    </div>
                                    <div class="col-1" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[20])?$client_fam[20]["age"]:""):"") ?></p>
                                    </div>
                                    <div class="col-2" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[20])?$client_fam[20]["occupation"]:""):"") ?></p>
                                    </div>
                                    <div class="col-2" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <input class="text-center salary_monthly" style="width: 100%; height:70%; font-size: 13px; padding:0; border:none;" type="text" height="30px" value='<?php echo (!empty($client_fam)?(!empty($client_fam[20])?$client_fam[20]["salary"]:""):"") ?>'>
                                    </div>
                                    <div class="col-4" style="padding:0px; height: 36px; border: solid 1px">
                                        <div class="row">
                                            <div class="col-2" style="border-right: solid 1px black; height: 36px; text-align: center; padding: 5px;">
                                                <label style="display: absolute;  position: center;">22.</label>
                                            </div>
                                            <div class="col-10" style="border-left: solid 1px black; height: 36px;">
                                                <p><?php echo (!empty($client_fam)?(!empty($client_fam[21])?$client_fam[21]["name"]:""):"") ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[21])?$client_fam[21]["relation_bene"]:""):"") ?></p>
                                    </div>
                                    <div class="col-1" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[21])?$client_fam[21]["age"]:""):"") ?></p>
                                    </div>
                                    <div class="col-2" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <p><?php echo (!empty($client_fam)?(!empty($client_fam[21])?$client_fam[21]["occupation"]:""):"") ?></p>
                                    </div>
                                    <div class="col-2" style="padding:0px; max-height: 36px; border: solid 1px black;">
                                        <input class="text-center salary_monthly" style="width: 100%; height:70%; font-size: 13px; padding:0; border:none;" type="text" height="30px" value='<?php echo (!empty($client_fam)?(!empty($client_fam[21])?$client_fam[21]["salary"]:""):"") ?>'>
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