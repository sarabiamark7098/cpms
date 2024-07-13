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
        <div class="row" style="margin-top:5%">
            <div class="col-6">
                <img src="../images/dswd_olog.png" alt="" width="230px" height="60px">
                <img src="../images/AICS.png" alt="" width="70px" height="60px">
                <img src="../images/BP.png" alt="" width="70px" height="60px">
            </div>
            <div class="col-6 ml-md-auto" style="color: #000000; ">
                <p class="text-center" style="font-size: 30px; font-family: arial, sans-serif; font-weight: bold;">CRISIS INTERVENTION SECTION</p><br>
                <p class="text-center" style="font-size: 17px; font-family: arial, sans-serif; margin-top: -45px;">Cor. Suazo St. R. Magsaysay Ave. Davao City</p><br>
                <p class="text-center" style="font-size: 14px; font-family: arial, sans-serif; margin-top: -40px;">DSWD-PMB-GF-13 | REV 03 | 14 MAY 2024</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12" style="text-align: center;">
                <b style="font-size: 30px">CERTIFICATE OF ELIGIBILITY</b>
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-6">
                        <p style="font-size: 18px; margin-top: -10px;">(Cash Outright)</p>
                    </div>n
                    <div class="col-3"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="row" style="font-size: 15px; margin-top: -5px">
                    <div class="col-sm-1 center">
                        <p class="text-center">QN:</p>
                    </div>
                    <div class="col-sm-10">
                        <input class="form-control input-lg border-dark" style="font-size: 15px; padding:0; text-indent: 8px; border: 1px solid black;" type="text" value="<?php echo $gis['client_num']; ?>">
                    </div>
                </div>
            </div>
            <div class="col-5">
                <div class="row" style="font-size: 15px; margin-top: -5px">
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
            <div class="col-4">
                <div class="row" style="font-size: 15px; margin-top: -5px">
                    <div class="col-sm-3 center">
                        <p class="text-center">Date:</p>
                    </div>
                    <div class="col-sm-9">
                        <input class="text-center" style="width: 62px; font-size: 15px; padding:0; border: 1px solid black;" type="text" value='<?php echo date("m", strtotime($client["date_accomplished"])) ?>'>
                        <input class="text-center" style="width: 65px; font-size: 15px; padding:0; border: 1px solid black;" type="text" value='<?php echo date("d", strtotime($client["date_accomplished"])) ?>'>
                        <input class="text-center" style="width: 90px; font-size: 15px; padding:0; border: 1px solid black;" type="text" value='<?php echo date("Y", strtotime($client["date_accomplished"])) ?>'>
                    </div>
                </div>
            </div>
        </div>
        <!--Second Row-->
        <div class="row" style="margin-bottom: 15px;">
            <div class="col-2">
                <div class="row" style="font-size: 14px; padding:0; margin-top: -5px">
                    <div class="col-sm-1 center">
                        <input class="text-center" style="width: 30px; font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo ((($client['program_type'])==0)||(empty($client['program_type']))? "&#x2714;" : "") ?>'>
                    </div>
                    <div class="col-sm-3 center"  style="padding-top: 3px;">
                        <b class="text-center">&nbsp;AICS</b>
                    </div>
                    <div class="col-sm-1 center">
                        <input class="check-box" style="width: 30px; font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo (($client['program_type']==1)? "&#x2714;" : "") ?>'>
                    </div>
                    <div class="col-sm-3 center"  style="padding-top: 3px;">
                        <b class="text-center">&nbsp;AKAP</b>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="row" style="font-size: 14px; padding:0; margin-top: -5px">
                    <div class="col-sm-1 center">
                        <input class="text-center" style="width: 30px; padding:0; border: 1px solid black;" type="text" value='<?php echo (strtolower($client['type_of_client'])=="new"? "&#x2714;" : "") ?>'>
                    </div>
                    <div class="col-sm-3 center"  style="padding-top: 3px;">
                        <b class="text-center">&nbsp;New</b>
                    </div>
                    <div class="col-sm-1 center">
                        <input class="text-center" style="width: 30px; padding:0; border: 1px solid black;" type="text" value='<?php echo (strtolower($client['type_of_client'])=="returning"? "&#x2714;" : "") ?>'>
                    </div>
                    <div class="col-sm-4 center"  style="padding-top: 3px;">
                        <b class="text-center">&nbsp;Returning</b>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="row" style="font-size: 14px; padding:0; margin-top: -5px">
                    <div class="col-sm-1 center">
                    </div>
                    <div class="col-sm-1 center">
                        <input class="text-center" style="width: 30px; padding:0; border: 1px solid black; border-radius: 30px;" type="text" value='&#x2714;'>
                    </div>
                    <div class="col-sm-7 center"  style="padding-top: 3px;">
                        <b class="text-center">&nbsp;On-site</b>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="row" style="font-size: 14px; margin-top: -5px">
                    <div class="col-sm-1 center">
                        <input class="text-center" style="width: 30px; padding:0; border: 1px solid black;" type="text" value='<?php echo (strtolower($gis['mode_admission'])=="walk-in"? "&#x2714;" : "") ?>'>
                    </div>
                    <div class="col-sm-4 center"  style="padding-top: 3px;">
                        <b class="text-center">&nbsp;Walk-in</b>
                    </div>
                    <div class="col-sm-1 center">
                        <input class="text-center" style="width: 30px; padding:0; border: 1px solid black;" type="text" value='<?php echo (strtolower($gis['mode_admission'])=="referral"? "&#x2714;" : "") ?>'>
                    </div>
                    <div class="col-sm-4 center"  style="padding-top: 3px;">
                        <b class="text-center">&nbsp;Referral</b>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="row" style="font-size: 14px; margin-top: -5px">
                    <div class="col-sm-1 center">
                        <input class="text-center" style="width: 30px; padding:0; border: 1px solid black; border-radius: 30px;" type="text" value=''>
                    </div>
                    <div class="col-sm-4 center" style="padding-top: 3px;">
                        <b class="text-center">&nbsp;Off-site</b>
                    </div>
                    <div class="col-sm-1 center">
                        <input class="text-center" style="width: 30px; padding:0; border: 1px solid black; border-radius: 30px;" type="text" value=''>
                    </div>
                    <div class="col-sm-4 center" style="padding-top: 3px;">
                        <b class="text-center">&nbsp;Malasakit</b>
                    </div>
                </div>
            </div>
            
        </div>

		
        <!--Assistance-->
        <div style="margin-top: 5px; font-size: 15px; text-transform: justify">
            This is to certify that, <input class="text-center" style=" border: none; border-bottom: 1px solid black; padding:0px; margin:0px; height: 18px; width: 62%;" value="<?php echo (!empty($client["firstname"])?$client["firstname"]." ":"") . (!empty($client["middlename"])?$client["middlename"][0].". ":""). (!empty($client["lastname"])?$client["lastname"]." ":"") . (!empty($client["extraname"])?$client["extraname"]." ":"") ?>" />, 
            <input class="text-center" style=" border: none; border-bottom: 1px solid black; padding:0px; margin:0px; height: 18px; width: 8%;" value="<?php echo $client['sex'] ?>" />, 
            <input class="text-center" style=" border: none; border-bottom: 1px solid black; padding:0px; margin:0px; height: 18px; width: 8%;" value="<?php echo $age_client ?>" /> year/s<br>
            <div class="row">
				<div class="col-4"></div>
				<div class="text-center col-2"><div contenteditable="true" style="word-wrap: break-word; word-break: break-word;width: 150px; font-size: 14px;line-height:12px;"><b>Kumpletong Pangalan</b> (Complete Name)</div></div> 
				<div class="col-3"></div>
				<div class="text-center col-1"><div contenteditable="true" style="margin-left:-5px; word-wrap: break-word; word-break: break-word;width: 60px; font-size: 14px;line-height:12px;"><b>Kasarian</b> (Sex)</div></div> 
				<div class="text-center col-1"><div  contenteditable="true" style="margin-left:-5px; word-wrap: break-word; word-break: break-word;width: 60px; font-size: 14px;line-height:12px;"><b>Edad</b> (Age)</div></div>
            </div>
			and presently residing at <input class="text-center" style=" border: none; border-bottom: 1px solid black; padding:0px; margin:0px; height: 18px;  width: 80%;" 
			value="<?php echo $c_add?>" /><br>
            <a style="margin-left: 43%;"><b>Kumpletong Tirahan </b>(Complete Address)</a><br> 
            has been found eligible for assistance after assessment and validation conducted, for his/herself or through the representation of his/her <br> 
            <input class="text-center" style=" border: none; border-bottom: 1px solid black; padding:0px; margin:0px; height: 20px; width: 45%;" value="<?php echo (strtolower($client['relation'])!='self'?$client['relation']:"Self") ?>" />, 
                <input class="text-center" style=" border: none; border-bottom: 1px solid black; padding:0px; margin:0px; height: 20px; width: 50%;"
                value="<?php echo ((!empty($client["b_fname"])?$client["b_fname"]." ":"") . (!empty($client["b_mname"])?$client["b_mname"][0].". ":""). (!empty($client["b_lname"])?$client["b_lname"]." ":"") . (!empty($client["b_exname"])?$client["b_exname"]." ":"")) ?>" />.<br>
            <div class="row">
				<div class="col-1"></div>
				<div class="text-center col-4"><div contenteditable="true" style="word-wrap: break-word; word-break: break-word;width: 320px; font-size: 14px;line-height:12px;"><b>Relasyon ng Kinatawan sa Benepisyaryo</b> (Relationship of Representative to the Beneficiary)</div></div> 
				<div class="col-1"></div>
				<div class="text-center col-4"><div contenteditable="true" style="word-wrap: break-word; word-break: break-word;width: 420px; font-size: 14px;line-height:12px;"><b>Buong Pangalan ng Benepisyaryo</b> (Name of Beneficiary)</div></div>
            </div>
        </div>

        <!-- Checker of Documents Presented -->
        <div class="row">
            <div class="col " style="border: 1px solid black;margin-top: 3px; padding: 0px 0px 4px 0px;">
                <p class="text-center" style="font-size: 15px; border: 1px solid black; background-color: #bfbfbf; font-size:15px; padding:0%; margin-bottom:2%;">RECORDS OF THE CASE SUCH AS THE FOLLOWING ARE CONFIDENTIALLY FILED AT THE CRISIS INTERVENTION SECTION</p>
                <div class="row" style="font-size: 15px;margin:0px 2px 0px 2px">
                     <div class="col" style="padding-top: 0px; margin-top: -8px;">
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;border:1px solid black;" value="&#x2714;" />&emsp;General Intake Sheet<br>
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:1px;margin-bottom:7px;border:1px solid black;" value="<?php echo $user->coe_check('justification', $record['document'])?>" />&emsp;Justification<br>
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('valid id', $record['document'])?>" />&emsp;Valid I.D. Presented:<br>
                        <p class="text-center" style="width: 100%;height:20px; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;"><?php echo $record['id_presented']?></p>
                        <!-- <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('4ps', $record['document'])?>" />&emsp;4PS DSWD I.D.<br> -->
                    </div>
                    <div class="col" style="padding-top: 0px; margin-top: -8px;">
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;border:1px solid black;" value="<?php echo $user->coe_check('medical certificate', $record['document'])?>" />&emsp;Medical Certificate/Abstract<br>
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('prescription', $record['document'])?>" />&emsp;Prescriptions<br>
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('statement', $record['document'])?>" />&emsp;Statement of Account<br>
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('treatment', $record['document'])?>" />&emsp;Treatment Protocol<br>
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('quotation', $record['document'])?>" />&emsp;Quotation/Chargeslip<br>
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;border:1px solid black;" value="<?php echo $user->coe_check('discharge', $record['document'])?>" />&emsp;Discharge Summary
                    </div>
                    <div class="col" style="padding-top: 0px; margin-top: -8px;">
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('lab request', $record['document'])?>" />&emsp;Laboratory Request<br>
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('charge slip', $record['document'])?>" />&emsp;Charge Slip<br>
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('funeral', $record['document'])?>" />&emsp;Funeral Contract<br>
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('death certificate', $record['document'])?>" />&emsp;Death Certificate<br>
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;border:1px solid black;" value="<?php echo $user->coe_check('death summary', $record['document'])?>" />&emsp;Death Summary<br>
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('referral', $record['document'])?>" />&emsp;Referral Letter
                    </div>
                    <div class="col" style="padding-top: 0px; margin-top: -8px;">
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('social case study', $record['document'])?>" />&emsp;Social Case Study Report<br>
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('contract of employment', $record['document'])?>" />&emsp;Contract of Employment<br>
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('certificate of employment', $record['document'])?>" />&emsp;Certificate of Employment<br>
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('income tax return', $record['document'])?>" />&emsp;Income Tax Return<br>
                        <?php if(!empty($user->coe_check('Others', $record['document']))){ ?>
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('Others', $record['document'])?>" />&emsp;Others:<br>
                        <p class="text-center" style="width: 100%;height:20px; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;"><?php echo $record['others_input']?></p>
                        <?php } else {?>
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:1px;border:1px solid black;" value="" />&emsp;Others:<br>
                        <input class="text-center" style="width: 100%;height:20px; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value="">
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
			<input class="text-center" style="border: none; border-bottom: 1px solid black; padding:0px; margin:0px; height: 20px; width: 13%;" value="AICS Fund <?php echo Date('Y', strtotime($client["date_accomplished"]))?>" />
        </div>
<br><br>
        <!-- Signatory -->
        <div class="row" style="font-size: 17px;">
            <div class="col">
                Conforme:
            </div>
            <div class="col">
                Prepared by:
            </div>
            <div class="col">
                Approved by:
            </div>
        </div><br><br><br>
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
        </div><br>

        <!-- Acknowledgement -->
        <p class="header text-center" style="margin-top: -5px; margin-left:-15px; font-size: 15px;"><b>Acknowledgement Receipt</b></p>
        <div class="row">
			<div class="col-9"></div>
            <div class="col-3">
                <div class="row" style="font-size: 15px; margin-top: -5px">
                    <div class="col-sm-2 center">
                        <p class="text-center">Date:</p>
                    </div>
                    <div class="col-sm-10">
                        <input class="" style="width: 50px; font-size: 14px; padding:0; text-indent: 8px; border:1px solid black;" type="text" height="30px" width="100px" value='<?php echo date("m", strtotime($client["date_accomplished"])) ?>'>
                        <input class="" style="width: 50px; font-size: 14px; padding:0; text-indent: 8px; border:1px solid black;" type="text" height="30px" width="100px" value='<?php echo date("d", strtotime($client["date_accomplished"])) ?>'>
                        <input class="" style="width: 70px; font-size: 14px; padding:0; text-indent: 8px; border:1px solid black;" type="text" height="30px" width="100px" value='<?php echo date("Y", strtotime($client["date_accomplished"])) ?>'>
                    </div>
                </div>
            </div>
        </div>
		<div class="row" style="font-size: 15px; margin-top: -5px">
			<div class="col-12 center">
				<input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:6px; border:1px solid black;" value="<?php echo (!empty($client_assistance[1]['financial'])?"&#x2714;":"")?>" />&emsp;Financial Assistance : 
				<input class="text-center" type="text" style="font-size:18px;width:60%;height:18px;margin-top:6px; border-bottom:1px solid black;" value="<?php echo $user->toWord($client_assistance[1]["amount"]) ?>" />
				PHP <input class="text-center" style="border: none; border-bottom: 1px solid black; padding:0px; margin:0px; height: 20px; width: 15%;" value="<?php echo $client_assistance[1]['amount']; ?>" /> <br>
				<div style="font-size: 15px; margin-top:10px; margin-left:30px;">
					<div class="row">
						<div class="col-3">
							<a style=""></a>
							<input style="margin-left:0; width: 20px; padding:0; text-indent: 2px;" type="radio" height="30px" width="100px" value='1 ' <?php echo ($client_assistance[1]['financial'] == 1?"checked":"")?>> Medical Assistance
						</div>
						<div class="col-3">
							<a style=""></a>
							<input style="margin-left:0; width: 20px; padding:0; text-indent: 2px;" type="radio" height="30px" width="100px" value='1 ' <?php echo ($client_assistance[1]['financial'] == 2?"checked":"")?>> Transportation Assistance
						</div>
						<div class="col-3">
							<a style=""></a>
							<input style="margin-left:0; width: 20px; padding:0; text-indent: 2px;" type="radio" height="30px" width="100px" value='1 ' <?php echo ($client_assistance[1]['financial'] == 3?"checked":"")?>> Food Assistance
						</div>
					</div>
					<div class="row">
						<br>
						<div class="col-3">
							<a style=""></a>
							<input style="margin-left:0; width: 20px; padding:0; text-indent: 2px;" type="radio" height="30px" width="100px" value='1 ' <?php echo ($client_assistance[1]['financial'] == 4?"checked":"")?>> Funeral Assistance
						</div>
						<div class="col-3">
							<a style=""></a>
							<input style="margin-left:0; width: 20px; padding:0; text-indent: 2px;" type="radio" height="30px" width="100px" value='1 ' <?php echo ($client_assistance[1]['financial'] == 5?"checked":"")?>> Educational Assistance
						</div>
						<div class="col-4">
							<a style=""></a>
							<input style="margin-left:0; width: 20px; padding:0; text-indent: 2px;" type="radio" height="30px" width="100px" value='1 ' <?php echo ($client_assistance[1]['financial'] == 6?"checked":"")?>> Cash Relief Assistance
						</div>
					</div>
				</div>
			</div>
        </div><br><br>
		
        <!-- Signatory -->
        <div class="row" style="font-size: 15px;">
            <div class="col">
                Accepted by:
            </div>
			<div class="col"> 
                Paid by:
            </div>
            <div class="col">
                Witnessed by:
            </div>
        </div><br><br>
        <div class="row" style="font-size: 15px; line-height: 15px;">
            <div class="col text-center">
                <input class="text-center" style="width: 100%; font-size: 15px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo ((!empty($client["firstname"])?$client["firstname"]." ":"") . (!empty($client["middlename"])?$client["middlename"][0].". ":""). (!empty($client["lastname"])?$client["lastname"]." ":"") . (!empty($client["extraname"])?$client["extraname"]." ":"")) ?>'>
                <b>Beneficiary/Representative</b>
                <p>Signature Over Printed Name</p>
            </div>
            <div class="col text-center">
                <input class="text-center" style="width: 100%; font-size: 15px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo strtoupper($cash["sd_officer"]) ?>'>
                <!-- <b>RDO/SDO</b> -->
				<b>Special Disbursing Officer</b>
                <p>Signature Over Printed Name</p>
            </div>
            <div class="col text-center">
                <input class="text-center" style="width: 100%; font-size: 15px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo strtoupper($soc_workFullname); ?>'>
                <!-- <b>SWO/Admin</b> -->
                <b>Social Worker</b>
                <p>Signature Over Printed Name</p>
            </div>
        </div><br>

        <hr style="height:2px;border-width:0;color:gray;background-color:gray">
        <div class="row">
            <div class="col-6">
                <div style=" margin-top: -15px; "<?php echo $user->casestudy('social case', $record['document'], $am)?> >
                    <b style="font-size:20px;">NOTE: <label style="text-indent: 40px"> CASE STUDY REPORT ON FILE</label></b>
                </div>
            </div>
            <div class="col-6">
            <p style="text-align: right; margin-top: -15px; font-size: 13px;">*E.O 163 series 2022</p>
            </div>
        </div>
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