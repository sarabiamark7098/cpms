<html>
<body>
<style>
	.header{
		background-color: black !important;
		color: white;
		-webkit-print-color-adjust: exact; 
		font-size: 14px;
	}

	
 </style>
    <div class="container" id="coev2_print" style="font-size:12px; padding:0%;">
        <br>
        <!--HEADER-->
        <div class="row">
            <div class="col-5">
                <img src="../images/dswd_olog.png" alt="" width="230px" height="60px">
            </div>
            <div class="col-7 ml-md-auto" style="color: #0000cc; text-align:right;">
                <b style="font-size: 30px; font-family: arial, sans-serif;" class="right">CRISIS INTERVENTION SECTION<br><p style="font-size: 17px; text-indent: 20px; margin-top: -10px;">Cor. Suazo St. R. Magsaysay Ave. Davao City</p></b>
            </div>
        </div>
        <div class="row">
            <div class="col-12" style="text-align: center;">
                <b style="font-size: 30px">CERTIFICATE OF ELIGIBILITY</b>
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-6">
                        <p style="font-size: 18px; margin-top: -10px;">(Financial Assistance)</p>
                    </div>
                    <div class="col-3"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="row" style="font-size: 14px; margin-top: -5px">
                    <div class="col-sm-1 center">
                        <p class="text-center">QN:</p>
                    </div>
                    <div class="col-sm-10">
                        <input class="form-control input-lg border-dark" style="font-size: 14px; padding:0; text-indent: 8px; border: 1px solid black;" type="text" value="<?php echo $gis['client_num']; ?>">
                    </div>
                </div>
            </div>
            <div class="col-6"></div>
            <div class="col-3">
                <div class="row" style="font-size: 14px; margin-top: -5px">
                    <div class="col-sm-2 center">
                        <p class="text-center">Date:</p>
                    </div>
                    <div class="col-sm-10">
                        <input class="" style="width: 50px; font-size: 14px; padding:0; text-indent: 8px; border: 1px solid black;" type="text" value='<?php echo date("m", strtotime($client['date_entered'])) ?>'>
                        <input class="" style="width: 50px; font-size: 14px; padding:0; text-indent: 8px; border: 1px solid black;" type="text" value='<?php echo date("d", strtotime($client['date_entered'])) ?>'>
                        <input class="" style="width: 70px; font-size: 14px; padding:0; text-indent: 8px; border: 1px solid black;" type="text" value='<?php echo date("Y", strtotime($client['date_entered'])) ?>'>
                    </div>
                </div>
            </div>
        </div>
        <!--Second Row-->
        <div class="row">
            <div class="col-4">
                <div class="row" style="font-size: 14px; margin-top: -5px">
                    <div class="col-sm-1 center" style="margin-right: 5px;">
                        <p class="text-center">PCN:</p>
                    </div>
                    <div class="col-sm-10">
                        <input class="text-center" style="width: 18px; font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo $GLid[0] ?>'>
                        <input class="text-center" style="margin-left:-5; width: 18px; font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo $GLid[1] ?>'>
                        <input class="text-center" style="margin-left:-5; width: 18px; font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo $GLid[2] ?>'>
                        <input class="text-center" style="margin-left:-5; width: 18px; font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo $GLid[3] ?>'>
                        <input class="text-center" style="margin-left:-5; width: 18px; font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo $GLid[5] ?>'>
                        <input class="text-center" style="margin-left:-5; width: 18px; font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo $GLid[6] ?>'>
                        <input class="text-center" style="margin-left:-5; width: 18px; font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo $GLid[8] ?>'>
                        <input class="text-center" style="margin-left:-5; width: 18px; font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo $GLid[9] ?>'>
                        <input class="text-center" style="margin-left:-5; width: 18px; font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo $GLid[10] ?>'>
                        <input class="text-center" style="margin-left:-5; width: 18px; font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo $GLid[11] ?>'>
                        <input class="text-center" style="margin-left:-5; width: 18px; font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo $GLid[12] ?>'>
                        <input class="text-center" style="margin-left:-5; width: 18px; font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo $GLid[13] ?>'>
                        <input class="text-center" style="margin-left:-5; width: 18px; font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo $GLid[14] ?>'>
                        <input class="text-center" style="margin-left:-5; width: 18px; font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo $GLid[15] ?>'>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="row" style="font-size: 14px; margin-top: -5px; margin-right: -15px">
                    <div class="col-sm-2" style="margin-left:-55px; margin-top: -1px;">
                        <p class="text-center">On-site:</p>
                    </div>
                    <div class="col-sm-8" style="margin-left:-30px;font-size: 14px;">
                        <div style="border: 1px solid black; width: 100%">
                            <a style="margin-right: 5px"></a>
                            <input style="width: 10px; margin-left:-5; width: 20px;padding:0; text-indent: 2px;" type="radio" value='1' <?php echo (strtolower($gis['mode_admission'])==""? "checked" : "") ?>> New
                            <a style="margin-left: 5px"></a>
                            <input style="width: 10px; margin-left:-5; width: 20px;padding:0; text-indent: 2px;" type="radio" value='1' <?php echo (strtolower($gis['mode_admission'])==""? "checked" : "") ?>> Returning
                            <a style="margin-left: 5px"></a>
                            <a style="border-left: 1px solid black; margin-right: 10px"></a>
                            <input style="width: 10px; margin-left:-5; width: 20px;padding:0; text-indent: 2px;" type="radio" value='1' <?php echo (strtolower($gis['mode_admission'])=="walk-in"? "checked" : "") ?>> Walk-in
                            <a style="margin-left: 5px"></a>
                            <input style="width: 10px; margin-left:-5; width: 20px;padding:0; text-indent: 2px;" type="radio" value='1' <?php echo (strtolower($gis['mode_admission'])=="referral"? "checked" : "") ?>> Referral
                        </div>
                    </div>
                    <div class="col-sm-2" style="margin-top: -1px; margin-left:-10px;">
                        <p class="text-center">Off-site:</p>
                    </div>
                    <div class="col-sm-2" style="margin-left:-25px; margin-top: -2px;">
                        <a></a>
                        <input class="text-center" style="font-size:18px;margin-left:-5; width: 25px; height: 25px; padding:0; text-indent: 3px; border: 1px solid black;" type="text" value=''>

                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="row" style="font-size: 14px; margin-top: -5px; margin-left:-120px;">
                    <div class="col-sm-5 center" style="margin-top: -2px;">
                        <p class="text-center" style="width: 100px;">Time Start: </p>
                    </div>
                    <div class="col-sm-7" style="margin-top: -2px; margin-left:-25px; width: 100px;">
                        <input class="form-control border-black" style="width: 155px; font-size: 14px; padding:0; text-indent: 8px; border: 1px solid black;" type="text" value='<?php echo date("H:i:s", strtotime($client['date_entered'])) ?>'>
                    </div>
                </div>
            </div>
        </div>
		
        <!--Assistance-->
        <div style="margin-top: 5px; font-size: 14px; text-transform: justify">
            This is to certify that herein beneficiary, <input class="text-center" style=" border: none; border-bottom: 1px solid black; padding:0px; margin:0px; height: 18px; width: 50%;" value="<?php echo (empty($client["b_fname"])?((!empty($client["firstname"])?$client["firstname"]." ":"") . (!empty($client["middlename"])?$client["middlename"][0].". ":""). (!empty($client["lastname"])?$client["lastname"]." ":"") . (!empty($client["extraname"])?$client["extraname"]." ":"")):((!empty($client["b_fname"])?$client["b_fname"]." ":"") . (!empty($client["b_mname"])?$client["b_mname"][0].". ":""). (!empty($client["b_lname"])?$client["b_lname"]." ":"") . (!empty($client["b_exname"])?$client["b_exname"]." ":""))) ?>" />, 
            <input class="text-center" style=" border: none; border-bottom: 1px solid black; padding:0px; margin:0px; height: 18px; width: 8%;" value="<?php echo (empty($client['b_fname'])?$client['sex']:$client['b_sex']) ?>" />, 
            <input class="text-center" style=" border: none; border-bottom: 1px solid black; padding:0px; margin:0px; height: 18px; width: 8%;" value="<?php echo (empty($client['b_fname'])?$age_client:$age_bene) ?>" /> year/s<br>
            <div class="row">
				<div class="col-4"></div>
				<div class="text-center col-2"><div contenteditable="true" style="margin-left:60px; word-wrap: break-word; word-break: break-word;width: 150px; font-size: 13px;line-height:12px;"><b>Kumpletong Pangalan</b> (Complete Name)</div></div> 
				<div class="col-3"></div>
				<div class="text-center col-1"><div contenteditable="true" style="margin-left:-5px; word-wrap: break-word; word-break: break-word;width: 60px; font-size: 13px;line-height:12px;"><b>Kasarian</b> (Sex)</div></div> 
				<div class="text-center col-1"><div  contenteditable="true" style="margin-left:-5px; word-wrap: break-word; word-break: break-word;width: 60px; font-size: 13px;line-height:12px;"><b>Edad</b> (Age)</div></div>
            </div>
			and presently residing at <input class="text-center" style=" border: none; border-bottom: 1px solid black; padding:0px; margin:0px; height: 18px;  width: 80%;" 
			value="<?php echo $c_add?>" /><br>
            <a style="margin-left: 43%;"><b>Kumpletong Tirahan </b>(Complete Address)</a><br> 
            has been found eligible for assistance after assessment and validation conducted, for his/herself or through <br> 
            the representation of his/her 
            <input class="text-center" style=" border: none; border-bottom: 1px solid black; padding:0px; margin:0px; height: 20px; width: 20%;" value="<?php echo (strtolower($client['relation'])!='self'?$client['relation']:"Self") ?>" />, 
                <input class="text-center" style=" border: none; border-bottom: 1px solid black; padding:0px; margin:0px; height: 20px; width: 50%;"
                value="<?php echo ((!empty($client["firstname"])?$client["firstname"]." ":"") . (!empty($client["middlename"])?$client["middlename"][0].". ":""). (!empty($client["lastname"])?$client["lastname"]." ":"") . (!empty($client["extraname"])?$client["extraname"]." ":"")) ?>" />.<br>
            <div class="row">
				<div class="col-1"></div>
				<div class="text-center col-4"><div contenteditable="true" style="margin-left: 35px;word-wrap: break-word; word-break: break-word;width: 320px; font-size: 13px;line-height:12px;"><b>Relasyon ng Kinatawan sa Benepisyaryo</b> (Relationship of Representative with the Beneficiary)</div></div> 
				<div class="col-1"></div>
				<div class="text-center col-4"><div contenteditable="true" style="word-wrap: break-word; word-break: break-word;width: 220px; font-size: 13px;line-height:12px;"><b>Buong Pangalan ng Kinatawan</b> (Name of Representative)</div></div>
            </div>
        </div>

        <!-- Checker of Documents Presented -->
        <div class="row">
            <div class="col " style="border: 1px solid black;padding-top: 8px;margin-top: 3px; padding-bottom: 3px;">
                <p class="text-center" style="font-size: 15px;">RECORDS OF THE CASE SUCH AS THE FOLLOWING ARE CONFIDENTIALLY FILED AT THE CRISIS INTERVENTION SECTION</p>
                <div class="row" style="font-size: 14px;">
                    <div class="col" style="padding-top: 0px; margin-top: -8px;">
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;border:1px solid black;" value="&#x2714;" />&emsp;General Intake Sheet<br>
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('valid id', $record['document'])?>" />&emsp;Valid I.D. Presented:<br>
                        <input class="text-center" style="width: 100%;height:20px; font-size: 11px; padding:0; border:none; border-bottom: 1px solid black;" type="text" value="<?php echo $record['id_presented']?>"><br>
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:3px;border:1px solid black;" value="<?php echo $user->coe_check('4ps', $record['document'])?>" />&emsp;4PS DSWD I.D.<br>
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:1px;margin-bottom:7px;border:1px solid black;" value="<?php echo $user->coe_check('justification', $record['document'])?>" />&emsp;Justification
                    </div>
                    <div class="col" style="padding-top: 0px; margin-top: -8px;">
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;border:1px solid black;" value="<?php echo $user->coe_check('medical certificate', $record['document'])?>" />&emsp;Medical Certificate/Abstract<br>
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('prescription', $record['document'])?>" />&emsp;Prescriptions<br>
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('statement', $record['document'])?>" />&emsp;Statement of Account<br>
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('treatment', $record['document'])?>" />&emsp;Treatment Protocol<br>
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('quotation', $record['document'])?>" />&emsp;Quotation
                    </div>
                    <div class="col" style="padding-top: 0px; margin-top: -8px;">
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;border:1px solid black;" value="<?php echo $user->coe_check('discharge', $record['document'])?>" />&emsp;Discharge Summary<br>
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('laboratory', $record['document'])?>" />&emsp;Laboratory Request<br>
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('charge slip', $record['document'])?>" />&emsp;Charge Slip<br>
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('funeral', $record['document'])?>" />&emsp;Funeral Contract<br>
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('death certificate', $record['document'])?>" />&emsp;Death Certificate
                    </div>
                    <div class="col" style="padding-top: 0px; margin-top: -8px;">
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;border:1px solid black;" value="<?php echo $user->coe_check('death summary', $record['document'])?>" />&emsp;Death Summary<br>
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('referral', $record['document'])?>" />&emsp;Referral Letter<br>
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('social case study', $record['document'])?>" />&emsp;Social Case Study Report<br>
                        <?php if(!empty($user->coe_check('others medical', $record['document']))){ ?>
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('others medical', $record['document'])?>" />&emsp;Others:<br>
                        <input class="text-center" style="width: 100%;height:20px; font-size: 11px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value="<?php echo $record['others_medical']?>">
                        <?php } elseif(!empty($user->coe_check('others burial', $record['document']))){ ?>
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('others burial', $record['document'])?>" />&emsp;Others:<br>
                        <input class="text-center" style="width: 100%;height:20px; font-size: 11px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value="<?php echo $record['others_burial']?>">
                        <?php } else {?>
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:1px;border:1px solid black;" value="" />&emsp;Others:<br>
                        <input class="text-center" style="width: 100%;height:20px; font-size: 11px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value="">
                        <?php } ?>
                        
                        
                    </div>
                </div>
            </div>
        </div>

        <!--Assistance-->
        <div style="margin-top: 10px; font-size: 14px; text-align:justify;">
            The client is hereby recommended to receive <input class="text-center" style="border: none; border-bottom: 1px solid black; padding:0px; margin:0px; height: 20px; width: 25%;" value="<?php echo strtoupper($client_assistance[1]['type']); ?>" /> assistance for <input class="text-center" style="border: none; border-bottom: 1px solid black; padding:0px; margin:0px; height: 20px; width: 35%; text-transform: capitalize;" value="<?php echo $client_assistance[1]['purpose']; ?>" /><br> 
			in the amount of <input class="text-center" style="border: none; border-bottom: 1px solid black; padding:0px; margin:0px; height: 20px; width: 55%;" value="<?php echo $amountToWord; ?>"
            /> PHP <input class="text-center money" style="border: none; border-bottom: 1px solid black; padding:0px; margin:0px; height: 20px; width: 8%;" value="<?php echo $client_assistance[1]['amount']; ?>" />CHARGABLE AGAINST: PSP 
			<input class="text-center" style="border: none; border-bottom: 1px solid black; padding:0px; margin:0px; height: 20px; width: 13%;" value="AICS Fund <?php echo Date('Y', strtotime($client['date_entered']))?>" />
        </div>
<br>
		<?php if(strtolower(mode1)=="cav"){ ?>
        <!-- Signatory -->
        <div class="row" style="font-size: 17px;">
            <div class="col">
                Conforme:
            </div>
            <div class="col">
                Prepared by:
            </div>
            <div class="col">
                Approving Officer:
            </div>
        </div><br><br>
        <div class="row" style="font-size: 15px; line-height: 15px;">
            <div class="col text-center">
                <input class="text-center" style="width: 100%; font-size: 15px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo ((!empty($client["firstname"])?$client["firstname"]." ":"") . (!empty($client["middlename"])?$client["middlename"][0].". ":""). (!empty($client["lastname"])?$client["lastname"]." ":"") . (!empty($client["extraname"])?$client["extraname"]." ":"")) ?>'>
                <b>Beneficiary/Representative</b>
                <p>Signature Over Printed Name</p>
            </div>
            <div class="col text-center">
                <input class="text-center" style="width: 100%; font-size: 15px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo strtoupper($soc_workFullname); ?>'>
                <b>Social Worker</b>
                <p>Signature Over Printed Name</p>
            </div>
            <div class="col text-center">
                <input class="text-center" style="width: 100%; font-size: 15px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo (strtolower($mode1) == "cav"?$GISsignatoryName:$GLsignatoryName) ?>'>
                <!-- <b>CID/CIU/CIS/SWTL</b> -->
                <b><?php echo (strtolower($mode1) == "cav"?$GISsignatoryPosition:$GLsignatoryPosition) ?></b>
                <p>Signature Over Printed Name</p>
            </div>
        </div>
		<?php } else { ?>
        <!-- Signatory -->
        <div class="row" style="font-size: 15px;">
            <div class="col">
                Conforme:
            </div>
            <div class="col">
                Prepared by:
            </div>
			<?php if($am > 50000){ ?>
            <div class="col">
                Recommending Approval:
            </div>
			<?php } ?>
            <div class="col">
                Approving Officer:
            </div>
        </div><br><br>
        <div class="row" style="font-size: 15px; line-height: 15px;">
            <div class="col text-center">
                <input class="text-center" style="width: 100%; font-size: 15px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo ((!empty($client["firstname"])?$client["firstname"]." ":"") . (!empty($client["middlename"])?$client["middlename"][0].". ":""). (!empty($client["lastname"])?$client["lastname"]." ":"") . (!empty($client["extraname"])?$client["extraname"]." ":"")) ?>'>
                <b>Beneficiary/Representative</b>
                <p>Signature Over Printed Name</p>
            </div>
            <div class="col text-center">
                <input class="text-center" style="width: 100%; font-size: 15px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo strtoupper($soc_workFullname); ?>'>
                <b>Social Worker</b>
                <p>Signature Over Printed Name</p>
            </div>
			<?php if($am <= 50000){ ?>
            <div class="col text-center">
                <input class="text-center" style="width: 100%; font-size: 15px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo (strtolower($mode1) == "cav"?$GISsignatoryName:$GLsignatoryName) ?>'>
                <!-- <b>CID/CIU/CIS/SWTL</b> -->
                <b><?php echo (strtolower($mode1) == "cav"?$GISsignatoryPosition:$GLsignatoryPosition) ?></b>
                <p>Signature Over Printed Name</p>
            </div>
			<?php } else { ?>
			<div class="col text-center">
                <input class="text-center" style="width: 100%; font-size: 15px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo $GISsignatoryName ?>'>
                <!-- <b>CID/CIU/CIS/SWTL</b> -->
                <b><?php echo $GISsignatoryPosition ?></b>
                <p>Signature Over Printed Name</p>
            </div>
			<div class="col text-center">
                <input class="text-center" style="width: 100%; font-size: 15px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo $GLsignatoryName ?>'>
                <!-- <b>CID/CIU/CIS/SWTL</b> -->
                <b><?php echo $GLsignatoryPosition ?></b>
                <p>Signature Over Printed Name</p>
            </div>
			<?php } ?>
        </div>
		<?php } ?>

        <!-- Acknowledgement -->
        <p class="header text-center" style="margin-top: -5px; margin-left:-15px; font-size: 15px;"><b>Acknowledgement Receipt</b></p>
        <div class="row">
            <div class="col-3">
                <div class="row" style="font-size: 14px; margin-top: -5px">
                    <div class="col-sm-2 center">
                        <p class="text-center">Date:</p>
                    </div>
                    <div class="col-sm-10">
                        <input class="" style="width: 50px; font-size: 14px; padding:0; text-indent: 8px; border:1px solid black;" type="text" height="30px" width="100px" value='<?php echo date("m") ?>'>
                        <input class="" style="width: 50px; font-size: 14px; padding:0; text-indent: 8px; border:1px solid black;" type="text" height="30px" width="100px" value='<?php echo date("d") ?>'>
                        <input class="" style="width: 70px; font-size: 14px; padding:0; text-indent: 8px; border:1px solid black;" type="text" height="30px" width="100px" value='<?php echo date("Y") ?>'>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="row" style="font-size: 14px; margin-top: -5px">
                    <div class="col-2">
                        <p class="text-center">I Received the</p>
                    </div>
                    <div class="col-4 center">
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:6px; border:1px solid black;" value="<?php echo (!empty($client_assistance[1]['material'])?"&#x2714;":"")?>" />&emsp;Material Assistance <br>
                        <div style="font-size: 11px;">
                            <a style=""></a>
                            <input style="width: 10px; margin-left:-5; width: 20px; padding:0; text-indent: 2px;" type="radio" height="30px" width="100px" value='1 ' <?php echo ($client_assistance[1]['material'] == 1?"checked":"")?>> Family Food Packs
                            <a style=""></a>
                            <input style="width: 10px; margin-left:-5; width: 20px; padding:0; text-indent: 2px;" type="radio" height="30px" width="100px" value='1 ' <?php echo ($client_assistance[1]['material'] == 2?"checked":"")?>> Hygiene or Sleeping Kits
                            <br>
                            <a style=""></a>
                            <input style="width: 10px; margin-left:-5; width: 20px; padding:0; text-indent: 2px;" type="radio" height="30px" width="100px" value='1 ' <?php echo ($client_assistance[1]['material'] == 3?"checked":"")?>> Other Food Items
                            <a style=""></a>
                            <input style="width: 10px; margin-left:-5; width: 20px; padding:0; text-indent: 2px;" type="radio" height="30px" width="100px" value='1 ' <?php echo ($client_assistance[1]['material'] == 4?"checked":"")?>> Assistive Device and Technologies
                        </div>
                    </div>
                    <div class="col-6 center">
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:6px; border:1px solid black;" value="<?php echo (!empty($client_assistance[1]['financial'])?"&#x2714;":"")?>" />&emsp;Financial Assistance : 
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:6px; border:1px solid black;" value="<?php echo ($client_assistance[1]['mode'] == "GL"?"&#x2714;":"")?>" />&nbsp;GL
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:6px; border:1px solid black;" value="<?php echo ($client_assistance[1]['mode'] == "CAV"?"&#x2714;":"")?>" />&nbsp;CAV 
                        PHP <input class="text-center" style="border: none; border-bottom: 1px solid black; padding:0px; margin:0px; height: 20px; width: 30%;" value="<?php echo $client_assistance[1]['amount']; ?>" /> <br>
                        <div style="font-size: 11px;">
                            <!-- <a style=""></a>
                            <input style="width: 10px; margin-left:-5; width: 20px; padding:0; text-indent: 2px;" type="radio" height="30px" width="100px" value='1 ' <?php// echo $user->checkFAssistance($client_assistance[1]['type'], "med"); ?>> Medical Assistance
                            <a style=""></a>
                            <input style="width: 10px; margin-left:-5; width: 20px; padding:0; text-indent: 2px;" type="radio" height="30px" width="100px" value='1 ' <?php// echo $user->checkFAssistance($client_assistance[1]['type'], "trans"); ?>> Transportation Assistance
                            <a style=""></a>
                            <input style="width: 10px; margin-left:-5; width: 20px; padding:0; text-indent: 2px;" type="radio" height="30px" width="100px" value='1 ' <?php// echo $user->checkFAssistance($client_assistance[1]['type'], "food"); ?>> Food Assistance
                            <br>
                            <a style=""></a>
                            <input style="width: 10px; margin-left:-5; width: 20px; padding:0; text-indent: 2px;" type="radio" height="30px" width="100px" value='1 ' <?php// echo $user->checkFAssistance($client_assistance[1]['type'], "financial"); ?>> Financial Assistance
                            <a style=""></a>
                            <input style="width: 10px; margin-left:-5; width: 20px; padding:0; text-indent: 2px;" type="radio" height="30px" width="100px" value='1 ' <?php// echo $user->checkFAssistance($client_assistance[1]['type'], "educ"); ?>> Educational Assistance
                            <a style=""></a>
                            <input style="width: 10px; margin-left:-5; width: 20px; padding:0; text-indent: 2px;" type="radio" height="30px" width="100px" value='1 ' <?php// echo $user->checkFAssistance($client_assistance[1]['type'], "cash"); ?>> Cash Assistance or Other Support -->
                            <a style=""></a>
                            <input style="width: 10px; margin-left:-5; width: 20px; padding:0; text-indent: 2px;" type="radio" height="30px" width="100px" value='1 ' <?php echo ($client_assistance[1]['financial'] == 1?"checked":"")?>> Medical Assistance
                            <a style=""></a>
                            <input style="width: 10px; margin-left:-5; width: 20px; padding:0; text-indent: 2px;" type="radio" height="30px" width="100px" value='1 ' <?php echo ($client_assistance[1]['financial'] == 2?"checked":"")?>> Transportation Assistance
                            <a style=""></a>
                            <input style="width: 10px; margin-left:-5; width: 20px; padding:0; text-indent: 2px;" type="radio" height="30px" width="100px" value='1 ' <?php echo ($client_assistance[1]['financial'] == 3?"checked":"")?>> Food Assistance
                            <br>
                            <a style=""></a>
                            <input style="width: 10px; margin-left:-5; width: 20px; padding:0; text-indent: 2px;" type="radio" height="30px" width="100px" value='1 ' <?php echo ($client_assistance[1]['financial'] == 4?"checked":"")?>> Funeral Assistance
                            <a style=""></a>
                            <input style="width: 10px; margin-left:-5; width: 20px; padding:0; text-indent: 2px;" type="radio" height="30px" width="100px" value='1 ' <?php echo ($client_assistance[1]['financial'] == 5?"checked":"")?>> Educational Assistance
                            <a style=""></a>
                            <input style="width: 10px; margin-left:-5; width: 20px; padding:0; text-indent: 2px;" type="radio" height="30px" width="100px" value='1 ' <?php echo ($client_assistance[1]['financial'] == 6?"checked":"")?>> Cash Assistance or Other Support
                        </div>
                    </div>
                </div>
            </div>
        </div><br>
		
		
        <!-- Signatory -->
        <div class="row" style="font-size: 15px;">
            <div class="col">
                Accepted by:
            </div>
            <?php if(strtolower($mode1) == "cav") { ?>
			<div class="col"> 
                Paid by:
            </div>
            <?php } else { 
				if($am > 50000){?>
				<div class="col"> 
					Recommending Approval:
				</div>
				<?php } ?>
			<div class="col"> 
                Approved by:
            </div>
            <?php } ?>
            <div class="col">
                Witnessed by:
            </div>
        </div><br>
        <div class="row" style="font-size: 15px; line-height: 15px;">
            <div class="col text-center">
                <input class="text-center" style="width: 100%; font-size: 15px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo ((!empty($client["firstname"])?$client["firstname"]." ":"") . (!empty($client["middlename"])?$client["middlename"][0].". ":""). (!empty($client["lastname"])?$client["lastname"]." ":"") . (!empty($client["extraname"])?$client["extraname"]." ":"")) ?>'>
                <b>Beneficiary/Representative</b>
                <p>Signature Over Printed Name</p>
            </div>
			<?php if($am <= 50000){ ?>
            <div class="col text-center">
                <input class="text-center" style="width: 100%; font-size: 15px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo (strtolower($mode1) == "cav"?(!empty($cash["sd_officer"])?strtoupper($cash["sd_officer"]):""):strtoupper($GLsignatoryName)) ?>'>
                <!-- <b>RDO/SDO</b> -->
				<b><?php echo (strtolower($mode1) == "cav"?(!empty($cash["sd_officer"])?"Special Disbursing Officer":""):$GLsignatoryPosition) ?></b>
                <p>Signature Over Printed Name</p>
            </div>
			<?php } else { ?>
			<div class="col text-center">
                <input class="text-center" style="width: 100%; font-size: 15px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo $GISsignatoryName ?>'>
                
                <b><?php echo $GISsignatoryPosition ?></b>
                <p>Signature Over Printed Name</p>
            </div>
			<div class="col text-center">
                <input class="text-center" style="width: 100%; font-size: 15px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo $GLsignatoryName ?>'>
                
                <b><?php echo $GLsignatoryPosition ?></b>
                <p>Signature Over Printed Name</p>
            </div>
			<?php } ?>
            <div class="col text-center">
                <input class="text-center" style="width: 100%; font-size: 15px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo strtoupper($soc_workFullname); ?>'>
                <!-- <b>SWO/Admin</b> -->
                <b>Social Worker</b>
                <p>Signature Over Printed Name</p>
            </div>
        </div>

        <hr style="height:2px;border-width:0;color:gray;background-color:gray">
        <p style="text-align: right; margin-top: -15px; font-size: 13px;">*E.O 163 series 2022</p>

        <p><img src="../images/scissors.png" alt="Cut Here" width="40" height="25"> - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
            - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -</p>
        <b class="header text-center" style="float: right; margin-top: -10px; margin-left:-25px;width: 20%; border-radius: 30px 30px 30px 30px;">BENEFICIARY'S COPY</b>
		<br>
		<!--BENEFICIARY COPY-->
		<div class="row">
			<div class="col-3">
				<div class="row" style="font-size: 14px; margin-top: -5px">
					<div class="col-sm-2 center">
						<p class="text-center">Date:</p>
					</div>
					<div class="col-sm-10">
		<input class="" style="width: 50px; font-size: 14px; padding:0; text-indent: 8px; border:1px solid black;" type="text" height="30px" width="100px" value='<?php echo date("m") ?>'>
		<input class="" style="width: 50px; font-size: 14px; padding:0; text-indent: 8px; border:1px solid black;" type="text" height="30px" width="100px" value='<?php echo date("d") ?>'>
		<input class="" style="width: 70px; font-size: 14px; padding:0; text-indent: 8px; border:1px solid black;" type="text" height="30px" width="100px" value='<?php echo date("Y") ?>'>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="row" style="font-size: 14px; margin-top: -5px">
					<div class="col-2">
						<p class="text-center">I Received the</p>
					</div>
					<div class="col-4 center">
						<input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:6px; border:1px solid black;" value="<?php echo (!empty($client_assistance[1]['material'])?"&#x2714;":"")?>" />&emsp;Material Assistance <br>
						<div style="font-size: 11px;">
							<a style=""></a>
							<input style="width: 10px; margin-left:-5; width: 20px; padding:0; text-indent: 2px;" type="radio" height="30px" width="100px" value='1 ' <?php echo ($client_assistance[1]['material'] == 1?"checked":"")?>> Family Food Packs
							<a style=""></a>
							<input style="width: 10px; margin-left:-5; width: 20px; padding:0; text-indent: 2px;" type="radio" height="30px" width="100px" value='1 ' <?php echo ($client_assistance[1]['material'] == 2?"checked":"")?>> Hygiene or Sleeping Kits
							<br>
							<a style=""></a>
							<input style="width: 10px; margin-left:-5; width: 20px; padding:0; text-indent: 2px;" type="radio" height="30px" width="100px" value='1 ' <?php echo ($client_assistance[1]['material'] == 3?"checked":"")?>> Other Food Items
							<a style=""></a>
							<input style="width: 10px; margin-left:-5; width: 20px; padding:0; text-indent: 2px;" type="radio" height="30px" width="100px" value='1 ' <?php echo ($client_assistance[1]['material'] == 4?"checked":"")?>> Assistive Device and Technologies
						</div>
					</div>
					<div class="col-6 center">
						<input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:6px; border:1px solid black;" value="<?php echo (!empty($client_assistance[1]['financial'])?"&#x2714;":"")?>" />&emsp;Financial Assistance : 
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:6px; border:1px solid black;" value="<?php echo ($client_assistance[1]['mode'] == "GL"?"&#x2714;":"")?>" />&nbsp;GL
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:6px; border:1px solid black;" value="<?php echo ($client_assistance[1]['mode'] == "CAV"?"&#x2714;":"")?>" />&nbsp;CAV 
                        PHP <input class="text-center" style="border: none; border-bottom: 1px solid black; padding:0px; margin:0px; height: 20px; width: 30%;" value="<?php echo $client_assistance[1]['amount']; ?>" /> <br>
                            
						<div style="font-size: 11px;">
						    <a style=""></a>
                            <input style="width: 10px; margin-left:-5; width: 20px; padding:0; text-indent: 2px;" type="radio" height="30px" width="100px" value='1 ' <?php echo ($client_assistance[1]['financial'] == 1?"checked":"")?>> Medical Assistance
                            <a style=""></a>
                            <input style="width: 10px; margin-left:-5; width: 20px; padding:0; text-indent: 2px;" type="radio" height="30px" width="100px" value='1 ' <?php echo ($client_assistance[1]['financial'] == 2?"checked":"")?>> Transportation Assistance
                            <a style=""></a>
                            <input style="width: 10px; margin-left:-5; width: 20px; padding:0; text-indent: 2px;" type="radio" height="30px" width="100px" value='1 ' <?php echo ($client_assistance[1]['financial'] == 3?"checked":"")?>> Food Assistance
                            <br>
                            <a style=""></a>
                            <input style="width: 10px; margin-left:-5; width: 20px; padding:0; text-indent: 2px;" type="radio" height="30px" width="100px" value='1 ' <?php echo ($client_assistance[1]['financial'] == 4?"checked":"")?>> Funeral Assistance
                            <a style=""></a>
                            <input style="width: 10px; margin-left:-5; width: 20px; padding:0; text-indent: 2px;" type="radio" height="30px" width="100px" value='1 ' <?php echo ($client_assistance[1]['financial'] == 5?"checked":"")?>> Educational Assistance
                            <a style=""></a>
                            <input style="width: 10px; margin-left:-5; width: 20px; padding:0; text-indent: 2px;" type="radio" height="30px" width="100px" value='1 ' <?php echo ($client_assistance[1]['financial'] == 6?"checked":"")?>> Cash Assistance or Other Support
                        </div>
					</div>
				</div>
			</div>
		</div><br>

		<!-- Signatory -->
        <div class="row" style="font-size: 15px;">
            <div class="col">
                Accepted by:
            </div>
            <?php if(strtolower($mode1) == "cav") { ?>
			<div class="col"> 
                Paid by:
            </div>
            <?php } else { 
					if($am > 50000){?>
				<div class="col"> 
					Recommending Approval:
				</div>
				<?php } ?>
			<div class="col"> 
                Approved by:
            </div>
            <?php } ?>
            <div class="col">
                Witnessed by:
            </div>
        </div><br>
        <div class="row" style="font-size: 15px; line-height: 15px;">
            <div class="col text-center">
                <input class="text-center" style="width: 100%; font-size: 15px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo ((!empty($client["firstname"])?$client["firstname"]." ":"") . (!empty($client["middlename"])?$client["middlename"][0].". ":""). (!empty($client["lastname"])?$client["lastname"]." ":"") . (!empty($client["extraname"])?$client["extraname"]." ":"")) ?>'>
                <b>Beneficiary/Representative</b>
                <p>Signature Over Printed Name</p>
            </div>
			<?php if($am <= 50000){ ?>
            <div class="col text-center">
                <input class="text-center" style="width: 100%; font-size: 15px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo (strtolower($mode1) == "cav"?(!empty($cash["sd_officer"])?strtoupper($cash["sd_officer"]):""):strtoupper($GLsignatoryName)) ?>'>
                <!-- <b>RDO/SDO</b> -->
				<b><?php echo (strtolower($mode1) == "cav"?(!empty($cash["sd_officer"])?"Special Disbursing Officer":""):$GLsignatoryPosition) ?></b>
                <p>Signature Over Printed Name</p>
            </div>
			<?php } else { ?>
			<div class="col text-center">
                <input class="text-center" style="width: 100%; font-size: 15px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo $GISsignatoryName ?>'>
                
                <b><?php echo $GISsignatoryPosition ?></b>
                <p>Signature Over Printed Name</p>
            </div>
			<div class="col text-center">
                <input class="text-center" style="width: 100%; font-size: 15px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo $GLsignatoryName ?>'>
                
                <b><?php echo $GLsignatoryPosition ?></b>
                <p>Signature Over Printed Name</p>
            </div>
			<?php } ?>
            <div class="col text-center">
                <input class="text-center" style="width: 100%; font-size: 15px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo strtoupper($soc_workFullname); ?>'>
                <!-- <b>SWO/Admin</b> -->
                <b>Social Worker</b>
                <p>Signature Over Printed Name</p>
            </div>
        </div>
                        <!--Container-->
	</div>
</body>

</html>