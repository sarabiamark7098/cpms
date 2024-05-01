<html>
<body>
 <style>
	.header{
		background-color: black !important;
		color: white;
		-webkit-print-color-adjust: exact; 
		font-size: 14px;
	}
    #gisv2_print input{
        text-transform:uppercase;
    }

	
 </style>
    <div class="container" id="gisv2_print" style="font-size:12px; padding:0%; font-family: Arial: sans-serif;">
        
        <!--HEADER-->
        <div class="row" style="margin-top:0px">
            <div class="col-6">
                <img src="../images/dswd_olog.png" alt="" width="230px" height="60px">
                <img src="../images/AICS.png" alt="" width="70px" height="60px">
                <img src="../images/BP.png" alt="" width="70px" height="60px">
            </div>
            <div class="col-6 ml-md-auto" style="color: #000000; ">
                <p class="text-center" style="font-size: 30px; font-family: arial, sans-serif; font-weight: bold;">CRISIS INTERVENTION SECTION</p><br>
                <p class="text-center" style="font-size: 17px; font-family: arial, sans-serif; margin-top: -45px;">Cor. Suazo St. R. Magsaysay Ave. Davao City</p><br>
                <p class="text-center" style="font-size: 14px; font-family: arial, sans-serif; margin-top: -40px;">DSWD-PMB-GF-11 | REV 02 | 08 JAN 2024</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12" style="text-align: center; margin-top: -10px">
                <b style="font-size: 30px">GENERAL INTAKE SHEET</b>
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-6">
                        <p class="header" style="margin-top: -10px; margin-left:-25px;border-radius: 30px 30px 30px 30px;"><b>MAAARING MAGPATULONG SUMAGOT SA DSWD PERSONNEL</b></p>
                    </div>
                    <div class="col-3"></div>
                </div>
                
            </div>
        </div>
        <div class="row">
            <div class="col-2">
                <div class="row" style="font-size: 14px; margin-top: -5px">
                    <div class="col-sm-1 center">
                        <p class="text-center">QN:</p>
                    </div>
                    <div class="col-sm-8">
                        <input class="form-control input-lg border-dark" style="font-size: 14px; padding:0; text-indent: 8px; border: 1px solid black;" type="text" value="<?php echo $gis['client_num']; ?>">
                    </div>
                </div>
            </div>
            <div class="col-5">
                <div class="row" style="font-size: 14px; margin-top: -5px">
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
            <div class="col-2">
            </div>
            <div class="col-3">
                <div class="row" style="font-size: 14px; margin-top: -5px">
                    <div class="col-sm-2 center">
                        <p class="text-center">Date:</p>
                    </div>
                    <div class="col-sm-10">
                        <input class="" style="width: 50px; font-size: 14px; padding:0; text-indent: 8px; border: 1px solid black;" type="text" value='<?php echo date("m", strtotime($client["date_accomplished"])) ?>'>
                        <input class="" style="width: 50px; font-size: 14px; padding:0; text-indent: 8px; border: 1px solid black;" type="text" value='<?php echo date("d", strtotime($client["date_accomplished"])) ?>'>
                        <input class="" style="width: 70px; font-size: 14px; padding:0; text-indent: 8px; border: 1px solid black;" type="text" value='<?php echo date("Y", strtotime($client["date_accomplished"])) ?>'>
                    </div>
                </div>
            </div>
        </div>
        

        <!--Assistance-->
        <!-- <p class="header" style="margin-top: -5px; margin-left:-15px; font-size: 15px;"><b>&emsp; NAIS HINGIIN NA TULONG </b>(Assistance Requested)</p>

        <div class="row">
            <div class="col">
                <div class="row" style="font-size: 14px; margin-top: -10px;">
                    <div class="col-sm-7" style="margin-top: -2px; margin-left:-10px;">
						<input class="text-center" type="text" style="font-size:18px; width:20px;height:20px; border: 1px solid black;" value="<?php echo !empty($client_assistance[1]['type'])?'&#x2714;':'' ?>"/>
                        <b class="text-center" style="width: 100px;">The Client need Assistance for:</b>
                        <input class="" style="width: 250px; font-size: 14px; padding:0; text-indent: 8px; border:none; border-bottom: 1px solid black;" type="text" value='<?php echo $client_assistance[1]['type']?>'>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="row" style="font-size:14px;">
                    <div class="col-sm-8" style="margin-left:0px; font-size:11px;">
						<div style="padding-top: 3px;">
							<b class="text-center" style="font-size:13px;">If Medical</b>
							<a style="margin-left: 18px"></a>
							<input style="width: 10px; margin-left:-4px; width: 20px;padding:0;" type="radio" value='1 ' <?php echo ($client_assistance[1]['if_medical'] == 1?"checked":"")?>>Hospital Bill
							<a style="margin-left: 8px"></a>
							<input style="width: 10px; margin-left:-4px; width: 20px;padding:0;" type="radio" value='1 ' <?php echo ($client_assistance[1]['if_medical'] == 2?"checked":"")?>>Medicine
							<a style="margin-left: 8px"></a>
							<input style="width: 10px; margin-left:-4px; width: 20px;padding:0;" type="radio" value='1 ' <?php echo ($client_assistance[1]['if_medical'] == 3?"checked":"")?>>Chemotheraphy
							<a style="margin-left: 8px"></a>
							<input style="width: 10px; margin-left:-4px; width: 20px;padding:0;" type="radio" value='1 ' <?php echo ($client_assistance[1]['if_medical'] == 4?"checked":"")?>>Dialysis
							<a style="margin-left: 8px"></a>
							<input style="width: 10px; margin-left:-4px; width: 20px;padding:0;" type="radio" value='1 ' <?php echo ($client_assistance[1]['if_medical'] == 5?"checked":"")?>>Procedures
							<a style="margin-left: 8px"></a>
							<input style="width: 10px; margin-left:-4px; width: 20px;padding:0;" type="radio" value='1 ' <?php echo ($client_assistance[1]['if_medical'] == 6?"checked":"")?>>Laboratory
							<a style="margin-left: 8px"></a>
							<input style="width: 10px; margin-left:-4px; width: 20px;padding:0;" type="radio" value='1 ' <?php echo ($client_assistance[1]['if_medical'] == 7?"checked":"")?>>Implant
						</div>
					</div>
					<div class="col-sm-4" style="margin-left:0px;">
						<div style="font-size:11px; padding-top: 3px;">
							<b class="text-center" style="margin-left:-25px; font-size:13px;">If Funeral</b>
							<a style="margin-right: 0px"></a>
							<input style="width: 10px; margin-left:-4; width: 20px;padding:0; text-indent: 2px;" type="radio" value='1 ' <?php echo ($client_assistance[1]['if_burial'] == 1?"checked":"")?>>Funeral Bill
							<a style="margin-left: 8px"></a>
							<input style="width: 10px; margin-left:-4; width: 20px;padding:0; text-indent: 2px;" type="radio" value='1 ' <?php echo ($client_assistance[1]['if_burial'] == 2?"checked":"")?>>Transfer of Cadever
							<a style="margin-left: 8px"></a>
							<input style="width: 10px; margin-left:-4; width: 20px;padding:0; text-indent: 2px;" type="radio" value='1 ' <?php echo ($client_assistance[1]['if_burial'] == 3?"checked":"")?>>Interment

						</div>
					</div>
                </div>
            </div>
        </div> -->

        <!--Client INFO-->
        <p class="header" style="margin-top: -10px; margin-left: -15px; margin-right: -15px; font-size: 15px;"><b>&emsp; Part I. To be filled out by client</b></p>
        <p class="header" style="margin-top: -20px; margin-left: -15px; margin-right: -15px; font-size: 15px;"><b>&emsp; IMPORMASYON NG KINATAWAN</b> (Representative's Identifying Information)</p>

        <div class="row" style="margin-top: -5px;">
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
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>Apelyido</b> (Last Name)</p>
            </div>
            <div class="col-4">
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>Unang Pangalan</b> (First Name)</p>
            </div>
            <div class="col-3">
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>Gitnang Pangalan</b> (Middle Name)</p>
            </div>
            <div class="col-1">
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>Ext.</b> (Sr.,Jr.)</p>
            </div>
        </div>
        <div class="row" style="margin-top: -5px;">
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
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>House No./Street/Purok</b> (Ex. Purok 12)</p>
            </div>
            <div class="col-3">
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>Barangay</b> (Ex. 23-C)</p>
            </div>
            <div class="col-2">
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>Municipality</b> (Ex. Davao City)</p>
            </div>
            <div class="col-2">
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>Province/District</b> (Ex. Dist. I)</p>
            </div>
            <div class="col-2">
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>Region</b> (XI)</p>
            </div>
        </div>
        <div class="row" style="margin-top: -5px;">
            <div class="col-2">
                <input class="text-center" style="width: 100%; height:80%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo !empty($client["contact"])?$client["contact"]:"" ?>'>
            </div>
            <div class="col-2">
                <input class="text-center" style="width: 100%; height:80%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo !empty($client["date_birth"])?date("m, d, Y" ,strtotime($client["date_birth"])):"" ?>'>
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
        <div class="row" style="height: 25px; margin-top: -5px;">
            <div class="col-2">
                <p class="text-center" style="width: 100%; height:80%; font-size: 8px; "><b>Numero ng Telepono</b> (Mobile No.)</p>
            </div>
            <div class="col-2">
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>Kapanganakan</b> (Birthdate)</p>
            </div>
            <div class="col-1">
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>Edad</b> (Age)</p>
            </div>
            <div class="col-1">
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>Kasarian</b></p>
            </div>
            <div class="col-2">
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>Civil Status</b> (Katayuang Sibil)</p>
            </div>
            <div class="col-3">
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>Trabaho</b> (Occupation)</p>
            </div>
            <div class="col-1">
                <p class="text-center" style="width: 100%; height:80%; font-size: 7px; "><b>Buwanang Kita</b></p>
            </div>
        </div>
        <div class="row" style="margin-top: -5px;">
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
                <p class="text-center" style="width: 100%; font-size: 10px; "><b>Relasyon sa Benepisyaryo</b> (Relationship to the Beneficiary)</p>
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
        <p class="header" style="margin-top: -5px; margin-left: -15px; margin-right: -15px; font-size: 15px;"><b>&emsp; IMPORMASYON NG BENEPISYARYO</b> (Beneficiary's Identifying Information)</p>

        <div class="row" style="margin-top:-5px; ">
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
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>Apelyido</b> (Last Name)</p>
            </div>
            <div class="col-4">
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>Unang Pangalan</b> (First Name)</p>
            </div>
            <div class="col-3">
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>Gitnang Pangalan</b> (Middle Name)</p>
            </div>
            <div class="col-1">
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>Ext.</b> (Sr.,Jr.)</p>
            </div>
        </div>
        <div class="row" style="margin-top: -5px;">
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
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>House No./Street/Purok</b> (Ex. Purok 12)</p>
            </div>
            <div class="col-3">
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>Barangay</b> (Ex. 23-C)</p>
            </div>
            <div class="col-2">
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>Municipality</b> (Ex. Davao City)</p>
            </div>
            <div class="col-2">
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>Province/District</b> (Ex. Dist. I)</p>
            </div>
            <div class="col-2">
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>Region</b> (XI)</p>
            </div>
        </div>
        <div class="row" style="margin-top: -5px;">
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
                <p class="text-center" style="width: 100%; height:80%; font-size: 8px; "><b>Numero ng Telepono</b> (Mobile No.)</p>
            </div>
            <div class="col-2">
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>Kapanganakan</b> (Birthdate)</p>
            </div>
            <div class="col-1">
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>Edad</b> (Age)</p>
            </div>
            <div class="col-1">
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>Kasarian</b></p>
            </div>
            <div class="col-2">
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>Civil Status</b> (Katayuang Sibil)</p>
            </div>
            <div class="col-3">
                <p class="text-center" style="width: 100%; height:80%; font-size: 10px; "><b>Trabaho</b> (Occupation)</p>
            </div>
            <div class="col-1">
                <p class="text-center" style="width: 100%; height:80%; font-size: 7px; "><b>Buwanang Kita</b></p>
            </div>
        </div>
        
        <!--FAMILY COMPOSITION INFO-->
        <p class="header" style="margin-top: 5px; margin-left: -20px; margin-right: -15px; font-size: 15px;"><b>&emsp; KOMPOSISYON NG PAMILYA</b> (Family Composition) &emsp;&emsp;&emsp;&emsp;&emsp;Note: Gamitin ang Likurang bahagi ng papel kung kinakailangan </p>
        
        <div class="row" style="margin-top: -8px;">
            <div class="col-4 text-center" style="border: 1px solid black; background-color: #bfbfbf; font-size:14px; ">
                <b>Buong Pangalan</b><p style="font-size: smaller; margin-top: -5px; border solid 1px black;">(Complete Name)</p>
            </div>
            <div class="col-3 text-center" style="border: 1px solid black; background-color: #bfbfbf; font-size:14px;">
                <b>Relasyon sa Benepisyaryo</b><p style="font-size: smaller; margin-top: -5px;">(Relationship to the Beneficiary)</p>
            </div>
            <div class="col-1 text-center" style="border: 1px solid black; background-color: #bfbfbf; font-size:14px;">
                <b>Edad</b><p style="font-size: smaller; margin-top: -5px;">(Age)</p>
            </div>
            <div class="col-2 text-center" style="border: 1px solid black; background-color: #bfbfbf; font-size:14px;">
                <b>Trabaho</b><p style="font-size: smaller; margin-top: -5px;">(Occupation)</p>
            </div>
            <div class="col-2 text-center" style="border: 1px solid black; background-color: #bfbfbf; font-size:14px;">
                <b>Buwanang Kita</b><p style="font-size: smaller; margin-top: -5px;">(Monthly Salary)</p>
            </div>
        </div>
        <div class="row text-center" style="border: 1px solid black; padding:0px; padding-top: 5px; font-size:14px; min-height: 65px; max-height: 1000px; line-height: 15px;">
            <div class="col-4" style="padding:0px; height: 20px;">
                <p><?php echo (!empty($client_fam)?(!empty($client_fam[1])?$client_fam[1]["name"]:""):"") ?></p>
            </div>
            <div class="col-3" style="padding:0px; max-height: 28px;">
                <p><?php echo (!empty($client_fam)?(!empty($client_fam[1])?$client_fam[1]["relation_bene"]:""):"") ?></p>
            </div>
            <div class="col-1" style="padding:0px; max-height: 28px;">
                <p><?php echo (!empty($client_fam)?(!empty($client_fam[1])?$client_fam[1]["age"]:""):"") ?></p>
            </div>
            <div class="col-2" style="padding:0px; max-height: 28px;">
                <p><?php echo (!empty($client_fam)?(!empty($client_fam[1])?$client_fam[1]["occupation"]:""):"") ?></p>
            </div>
            <div class="col-2" style="padding:0px; max-height: 28px;">
                <input class="text-center salary_monthly" style="width: 100%; height:70%; font-size: 13px; padding:0; border:none;" type="text" height="30px" value='<?php echo (!empty($client_fam)?(!empty($client_fam[1])?$client_fam[1]["salary"]:""):"") ?>'>
            </div>
            <div class="col-4" style="padding:0px; height: 20px;">
                <p><?php echo (!empty($client_fam)?(!empty($client_fam[2])?$client_fam[2]["name"]:""):"") ?></p>
            </div>
            <div class="col-3" style="padding:0px; max-height: 28px;">
                <p><?php echo (!empty($client_fam)?(!empty($client_fam[2])?$client_fam[2]["relation_bene"]:""):"") ?></p>
            </div>
            <div class="col-1" style="padding:0px; max-height: 28px;">
                <p><?php echo (!empty($client_fam)?(!empty($client_fam[2])?$client_fam[2]["age"]:""):"") ?></p>
            </div>
            <div class="col-2" style="padding:0px; max-height: 28px;">
                <p><?php echo (!empty($client_fam)?(!empty($client_fam[2])?$client_fam[2]["occupation"]:""):"") ?></p>
            </div>
            <div class="col-2" style="padding:0px; max-height: 28px;">
                <input class="text-center salary_monthly" style="width: 100%; height:70%; font-size: 13px; padding:0; border:none;" type="text" height="30px" value='<?php echo (!empty($client_fam)?(!empty($client_fam[2])?$client_fam[2]["salary"]:""):"") ?>'>
            </div>
            <div class="col-4" style="padding:0px; height: 20px;">
                <p><?php echo (!empty($client_fam)?(!empty($client_fam[3])?$client_fam[3]["name"]:""):"") ?></p>
            </div>
            <div class="col-3" style="padding:0px; max-height: 28px;">
                <p><?php echo (!empty($client_fam)?(!empty($client_fam[3])?$client_fam[3]["relation_bene"]:""):"") ?></p>
            </div>
            <div class="col-1" style="padding:0px; max-height: 28px;">
                <p><?php echo (!empty($client_fam)?(!empty($client_fam[3])?$client_fam[3]["age"]:""):"") ?></p>
            </div>
            <div class="col-2" style="padding:0px; max-height: 28px;">
                <p><?php echo (!empty($client_fam)?(!empty($client_fam[3])?$client_fam[3]["occupation"]:""):"") ?></p>
            </div>
            <div class="col-2" style="padding:0px; max-height: 28px;">
                <input class="text-center salary_monthly" style="width: 100%; height:70%; font-size: 13px; padding:0; border:none;" type="text" height="30px" value='<?php echo (!empty($client_fam)?(!empty($client_fam[3])?$client_fam[3]["salary"]:""):"") ?>'>
            </div>

        </div>

        <!--Filled By DSWD CIS Social Worker-->
        <!-- <div class="row" style="height: 15px">
            <div class="col-10">
                <p style="margin-top: -10px; margin-left: -15px; font-size:12px;"><b>&emsp; HUWAG SUSULATAN, ANG DSWD LAMANG ANG PWEDE GUMAMIT</b> (DO NOT WRITE BELOW THIS PART FOR DSWD'S USE ONLY.)</p>
            </div>
            <div class="col-2">
                <div class="row" style="font-size: 14px; margin-top: -10px; margin-left:-120px; height: 20px;">
                    <div class="col-sm-5 center" style="margin-top: -2px; width: 100px; height: 20px;">
                        <p class="text-center" style="width: 100px;">Time Start:</p>
                    </div>
                    <div class="col-sm-7" style="margin-top: -2px; margin-left:-30px; width: 100px; height: 20px;">
                        <input class="" style="width: 170px; font-size: 14px; padding:0; text-indent: 8px; border: 1px solid black;" type="text" value='<?php echo date("H:i:s") ?>'>
                    </div>
                </div>
            </div>
        </div><br> -->
        
        <p class="header text-center" style="margin-top: 12px; margin-left: -15px; margin-right:-15px;margin-bottom: 5px;  font-size: 16px;"><b>&emsp; HUWAG SUSULATAN, ANG DSWD LAMANG ANG PWEDE GUMAMIT</b> (Do not write below this part for DSWD'S use only.)</p>
        <!--Assessment-->
        <div class="row">
            <div class="col-5 text-center" style="border: 1px solid black; background-color: #bfbfbf; font-size:14px;">
                <b>Client Category</b>
            </div>
            <div class="col-7 text-center" style="border: 1px solid black; background-color: #bfbfbf; font-size:14px;">
                <b>Social Worker's Assessment</b>
            </div>
        </div>
        <div class="row">
            <div class="col-2" style="border: 1px solid black; font-size:11px;">
                <b> &emsp; TARGET SECTOR</b><br>
                <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:3px;border: 1px solid black;" value="<?php echo ($gis['target_sector'] == 1? '&#x2714;':'') ?>" /> &emsp; FHONA<br>
                <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:2px;border: 1px solid black;" value="<?php echo ($gis['target_sector'] == 2? '&#x2714;':'') ?>" /> &emsp; WEDC<br>
                <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:2px;border: 1px solid black;" value="<?php echo ($gis['target_sector'] == 3? '&#x2714;':'') ?>" /> &emsp; PWD<br>
                <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:2px;border: 1px solid black;" value="<?php echo ($gis['target_sector'] == 4? '&#x2714;':'') ?>" /> &emsp; YNSP<br>
                <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:2px;border: 1px solid black;" value="<?php echo ($gis['target_sector'] == 5? '&#x2714;':'') ?>" /> &emsp; SC<br>
                <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:2px;border: 1px solid black;" value="<?php echo ($gis['target_sector'] == 6? '&#x2714;':'') ?>" /> &emsp; PLHHIV<br>
                <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:2px;border: 1px solid black;" value="<?php echo ($gis['target_sector'] == 7? '&#x2714;':'') ?>" /> &emsp; CNSP
            </div>
            <div class="col-3" style="border: 1px solid black; font-size:11px; padding: 0; padding-left: 2px; padding-bottom: 5px;">
                <b> &emsp; SPECIFY SUB-CATEGORY</b><br>
                <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:3px;border: 1px solid black;" value="<?php echo ($gis['subcat_ass'] == 1? '&#x2714;':'') ?>" />&nbsp;Solo Parents<br>
                <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:2px;border: 1px solid black;" value="<?php echo ($gis['subcat_ass'] == 2? '&#x2714;':'') ?>" />&nbsp;Indigenous People<br>
                <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:2px;border: 1px solid black;" value="<?php echo ($gis['subcat_ass'] == 3? '&#x2714;':'') ?>" />&nbsp;Recovering Person who used Drugs<br>
                <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:2px;border: 1px solid black;" value="<?php echo ($gis['subcat_ass'] == 4? '&#x2714;': ($gis['pantawid_bene'] == 'Yes'? '&#x2714;':'')) ?>" />&nbsp;4PS DSWD Beneficiary<br>
                <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:2px;border: 1px solid black;" value="<?php echo ($gis['subcat_ass'] == 5? '&#x2714;':'') ?>" />&nbsp;Street Dwellers<br>
                <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:2px;border: 1px solid black;" value="<?php echo ($gis['subcat_ass'] == 6? '&#x2714;':'') ?>" />&nbsp;Psychosocial/Mental/Learning Disability<br>
                <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:2px;border: 1px solid black;" value="<?php echo ($gis['subcat_ass'] == 7? '&#x2714;':'') ?>" />&nbsp;Stateless Persons/Asylum Seekers/Refugees<br>
                <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:2px;border: 1px solid black;" value="<?php echo ($gis['subcat_ass'] == 8? '&#x2714;':'') ?>" />&nbsp;Others:
                <input class="text-center" style="width: 70%; height: 15 	px; font-size: 12px; padding:0; border:none; border-bottom: 1px solid black;" type="text" value='<?php echo (($gis['subcat_ass'] == 8)&&!empty($gis['others_subcat'])? $gis["others_subcat"]:'') ?>'>
            </div>
            <div class="col-7 text-center" style="border: 1px solid black; font-size:14px;line-height: 13px;"> <br>
                <p><?php echo $gis["soc_ass"]; ?></p>
            </div>
        </div>

        <!-- Assistance -->
        <!-- <div class="row">
            <div class="col text-center" style="border: 1px solid black; background-color: #bfbfbf; font-size:14px;">
                <b>Type of Assistance</b>
            </div>
        </div>
        <div class="row" style="border: 1px solid black; border-bottom: none;">
            <div class="col">
                <div class="row" style="font-size:14px;">
                    <div class="col-sm-8" style="margin-left:0px; font-size:11px;">
                        <div style="padding-top: 3px;">
                            <b class="text-center" style="font-size:13px;">If Medical</b>
                            <a style="margin-left: 18px"></a>
                            <input style="width: 10px; margin-left:-4px; width: 20px;padding:0;" type="radio" value='1 ' <?php echo ($client_assistance[1]['if_medical'] == 1?"checked":"")?>>Hospital Bill
                            <a style="margin-left: 8px"></a>
                            <input style="width: 10px; margin-left:-4px; width: 20px;padding:0;" type="radio" value='1 ' <?php echo ($client_assistance[1]['if_medical'] == 2?"checked":"")?>>Medicine
                            <a style="margin-left: 8px"></a>
                            <input style="width: 10px; margin-left:-4px; width: 20px;padding:0;" type="radio" value='1 ' <?php echo ($client_assistance[1]['if_medical'] == 3?"checked":"")?>>Chemotheraphy
                            <a style="margin-left: 8px"></a>
                            <input style="width: 10px; margin-left:-4px; width: 20px;padding:0;" type="radio" value='1 ' <?php echo ($client_assistance[1]['if_medical'] == 4?"checked":"")?>>Dialysis
                            <a style="margin-left: 8px"></a>
                            <input style="width: 10px; margin-left:-4px; width: 20px;padding:0;" type="radio" value='1 ' <?php echo ($client_assistance[1]['if_medical'] == 5?"checked":"")?>>Procedures
                            <a style="margin-left: 8px"></a>
                            <input style="width: 10px; margin-left:-4px; width: 20px;padding:0;" type="radio" value='1 ' <?php echo ($client_assistance[1]['if_medical'] == 6?"checked":"")?>>Laboratory
                            <a style="margin-left: 8px"></a>
                            <input style="width: 10px; margin-left:-4px; width: 20px;padding:0;" type="radio" value='1 ' <?php echo ($client_assistance[1]['if_medical'] == 7?"checked":"")?>>Implant
                        </div>
                    </div>
                    <div class="col-sm-4" style="margin-left:0px;">
                        <div style="font-size:11px; padding-top: 3px;">
                            <b class="text-center" style="margin-left:-25px; font-size:13px;">If Funeral</b>
                            <a style="margin-right: 0px"></a>
                            <input style="width: 10px; margin-left:-4; width: 20px;padding:0; text-indent: 2px;" type="radio" value='1 ' <?php echo ($client_assistance[1]['if_burial'] == 1?"checked":"")?>>Funeral Bill
                            <a style="margin-left: 8px"></a>
                            <input style="width: 10px; margin-left:-4; width: 20px;padding:0; text-indent: 2px;" type="radio" value='1 ' <?php echo ($client_assistance[1]['if_burial'] == 2?"checked":"")?>>Transfer of Cadever
                            <a style="margin-left: 8px"></a>
                            <input style="width: 10px; margin-left:-4; width: 20px;padding:0; text-indent: 2px;" type="radio" value='1 ' <?php echo ($client_assistance[1]['if_burial'] == 3?"checked":"")?>>Interment

                        </div>
                    </div>
                </div>
            </div>
        </div>-->
        <!--<div class="row" style="border-left: 1px solid black; border-right: 1px solid black;">
            <div class="col">
                <div class="row" style="font-size: 14px;">
                    <b class="text-center" style="font-size: 13;">FINANCIAL ASSISTANCE</b>
                    <div class="col-sm-9" style="margin-left:-30px; margin-bottom:5px; font-size:12px;">
                        <div> -->
                            <!-- <a style="margin-left: 25px"></a>
                            <input style="width: 10px; margin-left:-5; width: 20px;padding:0; text-indent: 2px;" type="radio" value='1' <?php //echo $user->checkFAssistance($client_assistance[1]['type'], "med"); ?>>Medical Assistance
                            <a style="margin-left: 13px"></a>
                            <input style="width: 10px; margin-left:-5; width: 20px;padding:0; text-indent: 2px;" type="radio" value='1' <?php //echo $user->checkFAssistance($client_assistance[1]['type'], "trans"); ?>>Transportation Assistance
                            <a style="margin-left: 6px"></a>
                            <input style="width: 10px; margin-left:-5; width: 20px;padding:0; text-indent: 2px;" type="radio" value='1' <?php //echo $user->checkFAssistance($client_assistance[1]['type'], "food"); ?>>Food Assistance
                            <br>
                            <a style="margin-left: 25px"></a>
                            <input style="width: 10px; margin-left:-5; width: 20px;padding:0; text-indent: 2px;" type="radio" value='1' <?php //echo $user->checkFAssistance($client_assistance[1]['type'], "financial"); ?>>Financial Assistance
                            <a style="margin-left: 5px"></a>
                            <input style="width: 10px; margin-left:-5; width: 20px;padding:0; text-indent: 2px;" type="radio" value='1' <?php //echo $user->checkFAssistance($client_assistance[1]['type'], "educ"); ?>>Educational Assistance
                            <a style="margin-left: 20px"></a>
                            <input style="width: 10px; margin-left:-5; width: 20px;padding:0; text-indent: 2px;" type="radio" value='1' <?php //echo $user->checkFAssistance($client_assistance[1]['type'], "cash"); ?>>Cash Assistance or Other Support Services -->
                        
                            <!--<a style="margin-left: 25px"></a>
                            <input style="width: 10px; margin-left:-5; width: 20px;padding:0; text-indent: 2px;" type="radio" value='1' <?php echo ($client_assistance[1]['financial'] == 1?"checked":"")?>>Medical Assistance
                            <a style="margin-left: 13px"></a>
                            <input style="width: 10px; margin-left:-5; width: 20px;padding:0; text-indent: 2px;" type="radio" value='1' <?php echo ($client_assistance[1]['financial'] == 2?"checked":"")?>>Transportation Assistance
                            <a style="margin-left: 6px"></a>
                            <input style="width: 10px; margin-left:-5; width: 20px;padding:0; text-indent: 2px;" type="radio" value='1' <?php echo ($client_assistance[1]['financial'] == 3?"checked":"")?>>Food Assistance
                            <br>
                            <a style="margin-left: 25px"></a>
                            <input style="width: 10px; margin-left:-5; width: 20px;padding:0; text-indent: 2px;" type="radio" value='1' <?php echo ($client_assistance[1]['financial'] == 4?"checked":"")?>>Funeral Assistance
                            <a style="margin-left: 5px"></a>
                            <input style="width: 10px; margin-left:-5; width: 20px;padding:0; text-indent: 2px;" type="radio" value='1' <?php echo ($client_assistance[1]['financial'] == 5?"checked":"")?>>Educational Assistance
                            <a style="margin-left: 20px"></a>
                            <input style="width: 10px; margin-left:-5; width: 20px;padding:0; text-indent: 2px;" type="radio" value='1' <?php echo ($client_assistance[1]['financial'] == 6?"checked":"")?>>Cash Assistance or Other Support Services
                        </div>
                    </div>
                    <div class="col-sm-2" style="margin-left:-60px; padding:0;">
                        <input style="width: 18px; height: 18px; font-size: 18px; padding:0; text-indent: 2px; border: 1px solid black;" type="text" value="<?php echo ((!empty($gis)?(($gis["service1"] == 1)?'&#x2714;':""):"")) ?>">
                        <b style="font-size: 13px;">PSYCHOSOCIAL</b>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="border: 1px solid black; border-top: none">
            <div class="col">
                <div class="row" style="font-size: 14px;">
                    <b class="text-center" style="font-size: 13;">MATERIAL ASSISTANCE</b>
                    <div class="col-sm-9" style="margin-left:-30px; font-size:12px;">
                        <div>
                            <a style="margin-left: 28px"></a>
                            <input style="width: 10px; margin-left:-5; width: 20px;padding:0; text-indent: 2px;" type="radio" value='1' <?php echo ($client_assistance[1]['material'] == 1?"checked":"")?>>Family Food Packs
                            <a style="margin-left: 15px"></a>
                            <input style="width: 10px; margin-left:-5; width: 20px;padding:0; text-indent: 2px;" type="radio" value='1' <?php echo ($client_assistance[1]['material'] == 2?"checked":"")?>>Other Food Items
                            <a style="margin-left: 20px"></a>
                            <input style="width: 10px; margin-left:-5; width: 20px;padding:0; text-indent: 2px;" type="radio" value='1' <?php echo ($client_assistance[1]['material'] == 3?"checked":"")?>>Hygiene or Sleeping Kits
                            <a style="margin-left: 15px"></a>
                            <input style="width: 10px; margin-left:-5; width: 20px;padding:0; text-indent: 2px;" type="radio" value='1' <?php echo ($client_assistance[1]['material'] == 4?"checked":"")?>>Assistive Devices and Technologies
                        </div>
                    </div>
                    <div class="col-sm-2" style="margin-left:-55px; padding:0; margin-top: -15px">
                        <input style="width: 18px; height: 18px; font-size: 18px; padding:0; text-indent: 2px; border: 1px solid black;" type="text" value='<?php echo ((!empty($gis)?(($gis["service3"] == 1)?'&#x2714;':""):"")) ?>'>
                        <b style="font-size: 13px;">REFERRAL SERVICES</b>
                    </div>
                </div>
            </div>
        </div>-->

        <!-- Assistance -->
        <div class="row" style="border-left: 1px solid black; border-right: 1px solid black;">
            <div class="col">
                <div class="row">
                    <div class="col-4" style="font-size: 14px;">
                        <b class="text-center" style="font-size: 13;">FINANCIAL ASSISTANCE</b>
                    </div>
                    <div class="col-3" style="font-size: 14px;">
                        <b class="text-center" style="font-size: 13;">MATERIAL ASSISTANCE</b>
                    </div>
                    <div class="col-3" style="font-size: 14px;padding-left:60px;">
                        <b class="text-center" style="font-size: 13;">PSYCHOSOCIAL SUPPORT</b>
                    </div>
                    <div class="col-2" style="font-size: 14px;">
                        <b class="text-center" style="font-size: 13;">REFERRAL</b>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2" style="margin-left:-30px; margin-bottom:5px; font-size:14px;">
                        <div>
                            <a style="margin-left: 25px"></a>
                            <input style="width: 10px; margin-left:-5; width: 20px;padding:0; text-indent: 2px;" type="radio" value='1' <?php echo ($client_assistance[1]['financial'] == 1?"checked":"")?>>Medical<br>
                            <a style="margin-left: 25px"></a>
                            <input style="width: 10px; margin-left:-5; width: 20px;padding:0; text-indent: 2px;" type="radio" value='1' <?php echo ($client_assistance[1]['financial'] == 2?"checked":"")?>>Transportation<br>
                            <a style="margin-left: 25px"></a>
                            <input style="width: 10px; margin-left:-5; width: 20px;padding:0; text-indent: 2px;" type="radio" value='1' <?php echo ($client_assistance[1]['financial'] == 4?"checked":"")?>>Funeral<br>
                            <a style="margin-left: 25px"></a>
                            <input style="width: 10px; margin-left:-5; width: 20px;padding:0; text-indent: 2px;" type="radio" value='1' <?php echo ($client_assistance[1]['financial'] == 5?"checked":"")?>>Educational<br>
                            </div>
                    </div>
                    <div class="col-3" style="margin-left:-30px; margin-bottom:5px; font-size:14px;">
                        <div>
                            <a style="margin-left: 0px"></a>
                            <input style="width: 10px; margin-left:-5; width: 20px;padding:0; text-indent: 2px;" type="radio" value='1' <?php echo ($client_assistance[1]['financial'] == 3?"checked":"")?>>Food Assistance<br>
                            <a style="margin-left: 0px"></a>
                            <input style="width: 10px; margin-left:-5; width: 20px;padding:0; text-indent: 2px;" type="radio" value='1' <?php echo ($client_assistance[1]['financial'] == 6?"checked":"")?>>Cash Assistance for Other Support Services<br>
                        </div>
                    </div>
                    <div class="col-4" style="margin-left:-30px; margin-bottom:5px; font-size:14px;">
                        <div>
                            <a style="margin-left: 0px"></a>
                            <input style="width: 10px; margin-left:-5; width: 20px;padding:0; text-indent: 2px;" type="radio" value='1' <?php echo ($client_assistance[1]['material'] == 1?"checked":"")?>>Family Food Packs<br>
                            <a style="margin-left: 0px"></a>
                            <input style="width: 10px; margin-left:-5; width: 20px;padding:0; text-indent: 2px;" type="radio" value='1' <?php echo ($client_assistance[1]['material'] == 2?"checked":"")?>>Other Food Items<br>
                            <a style="margin-left: 0px"></a>
                            <input style="width: 10px; margin-left:-5; width: 20px;padding:0; text-indent: 2px;" type="radio" value='1' <?php echo ($client_assistance[1]['material'] == 3?"checked":"")?>>Hygiene or Sleeping Kits<br>
                            <a style="margin-left: 0px"></a>
                            <input style="width: 10px; margin-left:-5; width: 20px;padding:0; text-indent: 2px;" type="radio" value='1' <?php echo ($client_assistance[1]['material'] == 4?"checked":"")?>>Assistive Devices and Technologies<br>
                        </div>
                    </div>
                    <div class="col-2" style="margin-left:-20px; margin-bottom:5px; font-size:13px;">
                        <div>
                            <a style="margin-left: -10px"></a>
                            <input style="width: 10px; margin-left:-5; width: 20px;padding:0; text-indent: 2px;" type="radio" value='1' <?php echo ($gis["service5"] == 1?"checked":"")?>>Psychological FIrst Aid (PFA)<br>
                            <a style="margin-left: -10px"></a>
                            <input style="width: 10px; margin-left:-5; width: 20px;padding:0; text-indent: 2px;" type="radio" value='1' <?php echo ($gis["service6"] == 1?"checked":"")?>>Social Work Counseling<br>
                            
                        </div>
                    </div>
                    <div class="col-2" style="margin-left:15px; margin-bottom:5px; font-size:12px;">
                        <div>
                            <input style="width: 10px; margin-left:-5; width: 120px;padding:0; text-indent: 2px; border-bottom: 1px solid black;" type="text" value='<?php echo ($gis["refer1"] != ""?$gis["refer1"]:"")?>'><br>
                            <input style="width: 10px; margin-left:-5; width: 120px;padding:0; text-indent: 2px; border-bottom: 1px solid black;" type="text" value='<?php echo ($gis["refer2"] != ""?$gis["refer2"]:"")?>'><br>
                            <input style="width: 10px; margin-left:-5; width: 120px;padding:0; text-indent: 2px; border-bottom: 1px solid black;" type="text" value='<?php echo ($gis["refer3"] != ""?$gis["refer3"]:"")?>'><br>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Assistance Amount and Allocation of Referrals -->
        <div class="row" style="margin-top: 0px; font-size:14px;">
            <div class="col-4 text-center" style="border: 1px solid black; background-color: #bfbfbf;">
                <!-- <b>Purpose</b> -->
                <b>Provided</b>
            </div>
            <div class="col-2 text-center" style="border: 1px solid black; background-color: #bfbfbf;">
                <b>Amount of Assistance</b>
            </div>
            <!-- <div class="col-2 text-center" style="border: 1px solid black; background-color: #bfbfbf;">
                <b>Mode of Assistance</b>
            </div> -->
            <div class="col-6 text-center" style="border: 1px solid black; background-color: #bfbfbf;">
                <b>Fund Source</b>
            </div>
        </div>
        <div class="row">
            <div class="col-4 text-center" style="border: 1px solid black; font-size: 13px;">
                <a><?php echo $client_assistance[1]['purpose']; ?></a>
            </div>
            <div class="col-2 text-center" style="border: 1px solid black; font-size: 13px;">
                <a><?php echo $client_assistance[1]['amount']; ?></a>
            </div>
            <!-- <div class="col-2 text-center" style="border: 1px solid black; font-size: 13px;">
                <a><?php //echo $client_assistance[1]['mode']; ?></a>
            </div> -->
            <div class="col-6 text-center" style="border: 1px solid black; font-size: 13px; line-height:15px; padding-top: 2px;">
                <p><?php echo (!empty($fundsourcedata[1]['fundsource'])?$fundsourcedata[1]['fundsource']."=".(!empty($fundsourcedata[1]['fs_amount'])?$fundsourcedata[1]['fs_amount']:$client_assistance[1]['amount']).", ":"").
                (!empty($fundsourcedata[3]['fundsource'])?$fundsourcedata[3]['fundsource']."=".$fundsourcedata[3]['fs_amount'].", ":"").
                (!empty($fundsourcedata[2]['fundsource'])?$fundsourcedata[2]['fundsource']."=".$fundsourcedata[2]['fs_amount'].", ":"").
                (!empty($fundsourcedata[4]['fundsource'])?$fundsourcedata[4]['fundsource']."=".$fundsourcedata[4]['fs_amount'].", ":"").
                (!empty($fundsourcedata[5]['fundsource'])?$fundsourcedata[5]['fundsource']."=".$fundsourcedata[5]['fs_amount'].", ":"").
                (!empty($fundsourcedata[6]['fundsource'])?$fundsourcedata[6]['fundsource']."=".$fundsourcedata[6]['fs_amount'].", ":"").
                (!empty($fundsourcedata[7]['fundsource'])?$fundsourcedata[7]['fundsource']."=".$fundsourcedata[7]['fs_amount'].", ":"").
                (!empty($fundsourcedata[8]['fundsource'])?$fundsourcedata[8]['fundsource']."=".$fundsourcedata[8]['fs_amount'].", ":"").
                (!empty($fundsourcedata[9]['fundsource'])?$fundsourcedata[9]['fundsource']."=".$fundsourcedata[9]['fs_amount'].", ":"").
                (!empty($fundsourcedata[10]['fundsource'])?$fundsourcedata[10]['fundsource']."=".$fundsourcedata[10]['fs_amount'].", ":"").
                (!empty($fundsourcedata[11]['fundsource'])?$fundsourcedata[11]['fundsource']."=".$fundsourcedata[11]['fs_amount'].", ":"").
                (!empty($fundsourcedata[12]['fundsource'])?$fundsourcedata[12]['fundsource']."=".$fundsourcedata[12]['fs_amount']:""); ?></p>
            </div>
            <div class="col-7 text-center" style="border: 1px solid black; font-size: 13px;">
                <a><?php echo $client_assistance[2]['purpose']; ?></a>
            </div>
            <div class="col-3 text-center" style="border: 1px solid black; font-size: 13px;">
                <a><?php echo $client_assistance[2]['amount']; ?></a>
            </div>
            <!-- <div class="col-2 text-center" style="border: 1px solid black; font-size: 13px;">
                <a><?php //echo $client_assistance[2]['mode']; ?></a>
            </div> -->
            <div class="col-2 text-center" style="border: 1px solid black; font-size: 13px;">
                <a><?php echo (!empty($client_assistance[2]['type'])?$client_assistance[2]['fund']."=".$client_assistance[2]['amount']:""); ?></a>
            </div>
        </div>

        <!-- Signatures in GIS -->
        <div class="row">
            <div class="col-6">
                <div class="row">
                    <div class="col-9 text-center" style="border: 1px solid black; font-size:12px;">
                        <!--Sa aking pagpirma, ako ay pumapayag na gamitin, ipaskil, at ibahagi ng DSWD ang aking personal na impormasyon na nakalagay sa dokumentong ito, pati na rin ang mga dokumentaryo na ipinasa upang makakuha ng tulong, alinsunod sa Republic Act No. 10173, mga
                        tuntunin at regulasyon nito, at anumang batas o regulasyon na naaayon. *-->
                        We are committed to protect and respect the privacy of our clients and beneficiaries and we will only collect, 
                        record, store, process and use personal information in accordance with Republic Act No. 10173 or the Data Privacy Act of 2012. 
                        By signing this form you are giving your consent to the DSWD and hereby agree to the terms and conditions set herein and with 
                        the applicable Data Privacy Policy of the Department.
                        <br><br><br>
                        <input class="text-center" style="width: 100%; font-size: 13.5px; padding:0; border:none; border-bottom: 1px solid black; text-transform: uppercase;" type="text" height="30px" value='<?php echo ((!empty($client["firstname"])?$client["firstname"]." ":"") . (!empty($client["middlename"])?$client["middlename"][0].". ":""). (!empty($client["lastname"])?$client["lastname"]." ":"") . (!empty($client["extraname"])?$client["extraname"]." ":"")) ?>'>
                        <b>Buong Pangalan at Pirma</b>
                        <p>Signature Over Printed Name</p>
                    </div>
                    <div class="col-3 text-center" style="border: 1px solid black;">

                        <p style="margin-top: 180px; font-size:12px;">Thumbmark</p>
                    </div>
                </div>
            </div>
            <div class="col-3 text-center" style="border: 1px solid black; font-size:13px;">
                <br><br>
                <br>
                <b>Interviewed by:</b>
                <br><br><br><br><br>
                <input class="text-center" style="width: 100%; font-size: 13.5px; padding:0; border:none; border-bottom: 1px solid black; text-transform: uppercase;" type="text" height="30px" value='<?php echo strtoupper($soc_workFullname); ?>'>
                <b>Social Worker</b>
                <p>Signature Over Printed Name</p>
            </div>
            <div class="col-3 text-center" style="border: 1px solid black; font-size:13px;">
                <br><br>
                <br>
                <b>Reviewed & Approved by:</b>
                <br><br><br><br><br>
                <input class="text-center" style="width: 100%; font-size: 13.5px; padding:0; border:none; border-bottom: 1px solid black; text-transform: uppercase;" type="text" height="30px" value='<?php echo strtoupper($GISsignatoryName) ?>'>
                <!-- <b>Crisis Intervention Section Division Chief</b> -->
                <b><?php echo $GISsignatoryPosition ?></b>
                <p>Signature Over Printed Name</p>
            </div>
        </div><br><br>
        <div class="footer row">
            <div class="col-10">
                <div style="border-bottom: solid 1px black;"></div>
                <p class="text-center">Page 1 of 1<br>
                DSWD Field Office XI, Ramon Magsaysay Avenue corner Damaso Suazo Street, Davao City, Philippines 8000<br>
                Website: http://fo11.dswd.gov.ph Tel Nos.: (082)_227 1964 / (082) 227 8746 / (082)_227 1435 Telefax: (082) 226 2857</p>
            </div>
            <div class="col-2">
                <img src="../images/dswd-ISO.png" alt="" width="110px" height="60px">
            </div>
        </div>
        <!--Container-->
    </div>
</body>

</html>