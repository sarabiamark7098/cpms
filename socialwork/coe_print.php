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
    
    .page1 {
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
    <div class="container" id="coev2_print" style="font-size:15px; padding:0%; border: solid 1px black; padding: 0px 15px; margin-top: 20px;">
        <br>
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
                <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;border:1px solid black;" value="&#x2714;" />&emsp;FIELD OFFICE <input class="text-center" style="width: 20%; height:30%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="20px" value='XI'>
            </div>
        </div>
        <div class="row">
            <div class="col-12" style="text-align: center; margin-bottom: 20px;">
                <b style="font-size: 30px">CERTIFICATE OF ELIGIBILITY</b>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="row" style="font-size: 15px; margin-top: -15px">
                    <div class="col-sm-1 center">
                        <p class="text-center">QN:</p>
                    </div>
                    <div class="col-sm-10">
                        <input class="form-control input-lg border-dark" style="font-size: 15px; padding:0; text-indent: 8px; border: 1px solid black;" type="text" value="<?php echo $gis['client_num']; ?>">
                    </div>
                </div>
            </div>
            <div class="col-6">
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
            <div class="col-3 text-center" style="font-size:14px; padding: 0%;">
                <div class="row" style="font-size: 14px;">
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
        <!--Second Row-->
        <div class="row" style="margin-top: -18px; padding: 0%;">
            <div class="col-2" style="font-size:14px; padding: 0%;">
                <div class="row" style="font-size: 14px; padding:0; margin-top: 10px; margin-left:12px; margin-bottom: 5px;">
                    <div class="col-12">
                        <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo ((($client['program_type'])==0)||(empty($client['program_type']))? "&#x2714;" : "") ?>'>
                        <b class="text-center">&nbsp;AICS</b>
                    </div>
                    <div class="col-12"  style="padding-top: 3px;">
                        <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo (($client['program_type']==1)? "&#x2714;" : "") ?>'>
                        <b class="">&nbsp;AKAP</b>
                    </div>
                    <div class="col-12"  style="padding-top: 3px;">
                        <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo (($client['program_type']=="other")? "&#x2714;" : "") ?>'>
                        <b class="">&nbsp;Others:</b>
                    </div>
                    <div class="col-12"  style="padding-top: 5px;">
                        <input class="text-center" style="width: 80%; height:80%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo !empty($client["other_program"])?$client["other_program"]:"" ?>'>
                    </div>
                </div>
            </div>
            <div class="col-2" style="font-size:14px; padding: 0%;">
                <div class="row" style="font-size: 14px; padding:0; margin-top: 10px; margin-left:12px; margin-bottom: 5px;">
                    <div class="col-12">
                        <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black; border-radius: 50%;" type="text" value='<?php echo (strtolower($client['type_of_client'])=="new"? "&#x2714;" : "") ?>'>
                        <b class="text-center">&nbsp;New</b>
                    </div>
                    <div class="col-12"  style="padding-top: 3px;">
                        <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black; border-radius: 50%;" type="text" value='<?php echo (strtolower($client['type_of_client'])=="returning"? "&#x2714;" : "") ?>'>
                        <b class="">&nbsp;Returning</b>
                    </div>
                </div>
            </div>
            <div class="col-3" style="font-size:14px; padding: 0%;">
                <div class="row" style="font-size: 14px; padding:0; margin-top: 10px; margin-left:12px; margin-bottom: 5px;">
                    <div class="col-12">
                        <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo (($user->getTransactionProcessed($_GET['id']))? "" : "&#x2714;") ?>'>
                        <b class="text-center">&nbsp;Onsite</b>
                    </div>
                    <div class="col-12"  style="padding-top: 3px;">
                        <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo (($user->getTransactionProcessed($_GET['id']))? "&#x2714;" : "") ?>'>
                        <b class="">&nbsp;Malasakit Center</b>
                    </div>
                    <div class="col-12"  style="padding-top: 3px;">
                        <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value=''>
                        <b class="">&nbsp;Offsite</b>
                    </div>
                </div>
            </div>
            <div class="col-2" style="border-right: none; font-size:14px; padding: 0%;">
                <div class="row" style="font-size: 14px; padding:0; margin-top: 10px; margin-left:12px; margin-bottom: 5px;">
                    <div class="col-12">
                        <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black; border-radius: 50%;" type="text" value='<?php echo (strtolower($gis['mode_admission'])=="walk-in"? "&#x2714;" : "") ?>'>
                        <b class="text-center">&nbsp;Walk-in</b>
                    </div>
                    <div class="col-12"  style="padding-top: 3px;">
                        <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black; border-radius: 50%;" type="text" value='<?php echo (strtolower($gis['mode_admission'])=="referral"? "&#x2714;" : "") ?>'>
                        <b class="">&nbsp;Referral</b>
                    </div>
                </div>
            </div>
            <div class="col-3 text-center" style="font-size:14px; padding: 0%;">
                <div class="row" style="font-size: 14px; margin-top:15%;">
                    <div class="col-sm-2 center">
                        <p class="text-center">Birthdate:</p>
                    </div>
                    <div class="col-sm-10">
                        <input class="text-center" style="width: 50px; font-size: 14px; padding:0; border: 1px solid black;" type="text" value='<?php echo !empty($client["date_birth"])?date("m" ,strtotime($client["date_birth"])):"" ?>'>
                        <input class="text-center" style="width: 50px; font-size: 14px; padding:0; border: 1px solid black;" type="text" value='<?php echo !empty($client["date_birth"])?date("d" ,strtotime($client["date_birth"])):"" ?>'>
                        <input class="text-center" style="width: 70px; font-size: 14px; padding:0; border: 1px solid black;" type="text" value='<?php echo !empty($client["date_birth"])?date("Y" ,strtotime($client["date_birth"])):"" ?>'>
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
        <!--Assistance-->
        <div style="margin-top: 5px; font-size: 15px; text-transform: justify; padding-bottom: 5px;">
            This is to certify that, <input class="text-center" style=" border: none; border-bottom: 1px solid black; padding:0px; margin:0px; height: 18px; width: 62%;" value="<?php echo (!empty($client["firstname"])?$client["firstname"]." ":"") . (!empty($client["middlename"])?$client["middlename"]." ":""). (!empty($client["lastname"])?$client["lastname"]." ":"") . (!empty($client["extraname"])?$client["extraname"]." ":"") ?>" />, 
            <input class="text-center" style=" border: none; border-bottom: 1px solid black; padding:0px; margin:0px; height: 18px; width: 8%;" value="<?php echo $client['sex'] ?>" />, 
            <input class="text-center" style=" border: none; border-bottom: 1px solid black; padding:0px; margin:0px; height: 18px; width: 8%;" value="<?php echo $age_client ?>" /> year/s<br>
            <div class="row">
				<div class="col-3"></div>
				<div class="text-center col-3"><div contenteditable="true" style="word-wrap: break-word; word-break: break-word;width: 450px; font-size: 14px;line-height:12px;"><b>First Name Middle Name Last Name Extension Name</b></div></div> 
				<div class="col-3"></div>
				<div class="text-center col-1"><div contenteditable="true" style="margin-left: 10px; word-wrap: break-word; word-break: break-word;width: 60px; font-size: 14px;line-height:12px;"><b>Sex</b></div></div> 
				<div class="text-center col-1"><div  contenteditable="true" style="margin-left:15px; word-wrap: break-word; word-break: break-word;width: 60px; font-size: 14px;line-height:12px;"><b>Age</b></div></div>
            </div>
			and presently residing at <input class="text-center" style=" border: none; border-bottom: 1px solid black; padding:0px; margin:0px; height: 18px;  width: 80%;" 
			value="<?php echo $c_add?>" /><br>
            <a style="margin-left: 43%;"><b>Complete Address </b></a><br> 
            has been found eligible for assistance after the assessment and validation conducted, for his/herself or through the representation of his/her <br> 
            <input class="text-center" style=" border: none; border-bottom: 1px solid black; padding:0px; margin:0px; height: 20px; width: 45%;" value="<?php echo (strtolower($client['relation'])!='self'?$client['relation']:"Self") ?>" />, 
                <input class="text-center" style=" border: none; border-bottom: 1px solid black; padding:0px; margin:0px; height: 20px; width: 50%;"
                value="<?php echo ((!empty($client["b_fname"])?$client["b_fname"]." ":"") . (!empty($client["b_mname"])?$client["b_mname"]." ":""). (!empty($client["b_lname"])?$client["b_lname"]." ":"") . (!empty($client["b_exname"])?$client["b_exname"]." ":"")) ?>" />.<br>
            <div class="row">
				<div class="col-1"></div>
				<div class="text-center col-4"><div contenteditable="true" style="word-wrap: break-word; word-break: break-word;width: 320px; font-size: 14px;line-height:12px;"><b>Relationship of the Beneficiary to the Client</b></div></div> 
				<div class="col-1"></div>
				<div class="text-center col-4"><div contenteditable="true" style="word-wrap: break-word; word-break: break-word;width: 420px; font-size: 14px;line-height:12px;"><b>First Name Middle Name Last Name Extension Name</b></div></div>
            </div>
        </div>

        <!-- Checker of Documents Presented -->
        <div class="row">
            <div class="col " style="border: 1px solid black;margin-top: 3px; padding: 0px 0px 4px 0px;">
                <p class="text-center" style="font-size: 15px; border: 1px solid black; background-color: #bfbfbf; font-size:15px; padding:0%; margin-bottom:2%; font-weight: bold;">RECORDS OF THE CASE SUCH AS THE FOLLOWING ARE CONFIDENTIALLY FILED AT THE CRISIS INTERVENTION SECTION</p>
                <div class="row" style="font-size: 15px;margin:0px 2px 0px 2px">
                    <div class="col" style="padding-top: 0px; margin-top: -8px;">
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;border:1px solid black;" value="&#x2714;" />&emsp;General Intake Sheet<br>
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:1px;margin-bottom:7px;border:1px solid black;" value="<?php echo $user->coe_check('justification',  'document'])?>" />&emsp;Justification<br>
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('valid id', $record['document'])?>" />&emsp;Valid I.D. Presented:<br>
                        <p class="text-center" style="width: 100%;height:20px; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;"><?php echo $record['id_presented']?></p>
                    </div>
                    <div class="col" style="padding-top: 0px; margin-top: -8px;">
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;border:1px solid black;" value="<?php echo $user->coe_check('medical certificate', $record['document'])?>" />&emsp;Medical Certificate/Abstract<br>
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('prescription', $record['document'])?>" />&emsp;Prescriptions<br>
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('statement', $record['document'])?>" />&emsp;Statement of Account<br>
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('treatment', 
                        $record['document'])?>" />&emsp;Treatment Protocol<br>
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('quotation', $record['document'])?>" />&emsp;Quotation/Charge Slip<br>
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;border:1px solid black;" value="<?php echo $user->coe_check('discharge', $record['document'])?>" />&emsp;Discharge Summary<br>
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('social case study', $record['document'])?>" />&emsp;Social Case Study Report<br>
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;border:1px solid black;" value="<?php echo $user->coe_check('case summary', $record['document'])?>" />&emsp;Case Summary Report
                    </div>
                    <div class="col" style="padding-top: 0px; margin-top: -8px;">
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('lab request', $record['document'])?>" />&emsp;Laboratory Request<br>
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('promissory', $record['document'])?>" />&emsp;Promissory Note/ <br> &emsp;&emsp;Certificate of Balance<br>
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('funeral', $record['document'])?>" />&emsp;Funeral Contract<br>
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('transfer permit', $record['document'])?>" />&emsp;Transfer Permit<br>
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('death certificate', $record['document'])?>" />&emsp;Death Certificate<br>
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;border:1px solid black;" value="<?php echo $user->coe_check('death summary', $record['document'])?>" />&emsp;Death Summary<br>
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('referral', $record['document'])?>" />&emsp;Referral Letter
                    </div>
                    <div class="col" style="padding-top: 0px; margin-top: -8px;">
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('contract of employment', $record['document'])?>" />&emsp;Contract of Employment<br>
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('certificate of employment', $record['document'])?>" />&emsp;Certificate of Employment<br>
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('certificate of attestation', $record['document'])?>" />&emsp;Certificate of Attestation<br>
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('income tax return', $record['document'])?>" />&emsp;Income Tax Return<br>
                        <?php if(!empty($user->coe_check('Others', $record['document']))){ ?>
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('Others', $record['document'])?>" />&emsp;Others:<br>
                        <p class="text-center" style="width: 100%;height:20px; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black; margin-bottom: 0%;"><?php echo $record['others_input']?></p>
                        <?php } else {?>
                        <input class="text-center" type="text" style="font-size:18px;width:18px;height:18px;margin-top:1px;border:1px solid black;" value="" />&emsp;Others:<br>
                        <input class="text-center" style="width: 100%;height:20px; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black; margin-bottom: 0%;" type="text" height="30px" value="">
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <!--Assistance-->
        <div class="row">
            <div class="col-6 " style="border: 1px solid black;margin-top: 3px; padding: 0px 0px 4px 0px;">
                <p class="text-center" style="font-size: 15px; border: 1px solid black; background-color: #bfbfbf; font-size:15px; padding:0%; margin-bottom:2%; font-weight: bold;">If Outright Cash</p>
                <div style="padding: 20px 50px;">
                    <div class="row" style="font-size: 15px; height: 30px;">
                    </div>
                    <div class="row" style="font-size: 15px; position: static;">
                        <div class="col-12" style="text-align: justify; text-indent: 85px; float:left; line-height: 40px;">
                        <?php
                            if($mode1 == "CAV" || (!empty($mode2) && $mode2 == "CAV")){
                                echo "The client is hereby recommended to receive <u>&emsp;". ucwords(strtolower(explode(" ", strtoupper($client_assistance[1]['type']))[0])) ."&emsp;</u> assistance for <u>&emsp;". ucwords(strtolower(!empty($client_assistance[1]['purpose'])?$client_assistance[1]['purpose']:"")) ."&emsp;</u> in the amount of <u>&emsp;". ucwords(strtolower($amountToWord)) ."&emsp;</u> Php<u>&nbsp;". $client_assistance[1]['amount'] ."&emsp;</u>.";
                            }elseif($mode1 == "GL" || (!empty($mode2) && $mode2 == "GL")){
                                echo "The client is hereby recommended to receive <u>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</u> assistance for <u>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</u> in the amount of <u>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</u> Php<u>&emsp;&emsp;&emsp;&emsp;&emsp;</u>.";
                            }
                        ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 " style="border: 1px solid black;margin-top: 3px; padding: 0px 0px 4px 0px;">
                <p class="text-center" style="font-size: 15px; border: 1px solid black; background-color: #bfbfbf; font-size:15px; padding:0%; margin-bottom:2%; font-weight: bold;">If Guarantee Letter</p>
                <div style="padding: 10px 50px;">
                    <div class="row" style="font-size: 15px;">
                        <div class="col-sm-3 center">
                        </div>
                        <div class="col-sm-3 center">
                            <p class="text-center">GL No.:</p>
                        </div>
                        <div class="col-sm-6">
                            <input class="text" style="width: 100%; font-size: 15px; padding:0; text-indent: 8px; border: 1px solid black;" type="text" value='<?php echo (($mode1 == "GL" || (!empty($mode2) && $mode2 == "GL"))?$GLid:"") ?>'>
                        </div>
                    </div>
                    <div class="row" style="font-size: 15px; position: static;">
                        <div class="col-12" style="text-align: justify; text-indent: 85px; float:left; line-height: 30px;">
                        <?php
                            if($mode1 == "GL" || (!empty($mode2) && $mode2 == "GL")){
                                echo "The client is hereby recommended to receive <u>&emsp;". ucwords(strtolower(explode(" ", strtoupper($client_assistance[1]['type']))[0])) ."&emsp;</u> assistance for <u>&emsp;". ucwords(strtolower(!empty($client_assistance[1]['purpose'])?$client_assistance[1]['purpose']:"")) ."&emsp;</u> in the amount of <u>&emsp;". ucwords(strtolower($amountToWord)) ."&emsp;</u> Php<u>&nbsp;". $client_assistance[1]['amount'] ."&emsp;</u> payable to <u>&emsp;". ucwords(strtolower($gl['cname'])) ."&emsp;</u>, <u>&emsp;".ucwords(strtolower($gl['caddress']))."&emsp;</u>.";
                            }elseif($mode1 == "CAV" || (!empty($mode2) && $mode2 == "GL")){
                                echo "The client is hereby recommended to receive <u>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</u> assistance for <u>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</u> in the amount of <u>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</u> Php<u>&emsp;&emsp;&emsp;&emsp;&emsp;</u> payable to <u>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</u>, <u>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</u>.";
                            }
                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row text-center" style="font-size: 16px;">
            <div class="col">
                <b>Prepared and Certified by:</b>
            </div>
            <div class="col">
                <b>Approved by:</b>
            </div>
        </div><br><br>
        <div class="row" style="font-size: 16px; line-height: 15px;">
            <div class="col text-center">
                <input class="text-center" style="width: 100%; font-size: 16px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo strtoupper($soc_workFullname); ?>'>
                <b>Social Worker</b>
                <p>(Signature Over Printed Name)</p>
                <div style="margin-top: -10px;">
                    <label>License no.:</label><input class="text-center" style="width: 20%; border-bottom: 1px solid black;" type="text" value='<?php echo $soc_worker['sw_license_no']; ?>'><br>
                </div>
            </div>
            <div class="col text-center">
                <input class="text-center" style="width: 100%; font-size: 16px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo (strtolower($mode1) == "cav"?$GISsignatoryName:$GLsignatoryName) ?>'>
                <b>Approving Authority</b>
                <p>(Signature Over Printed Name)</p>
            </div>
        </div>
        <div class="row">
            <div class="col" style="border: 1px solid black;margin-top: 3px; padding: 0px 0px 4px 0px;">
                <p class="text-center" style="font-size: 15px; border: 1px solid black; background-color: #bfbfbf; font-size:15px; padding:0%; margin-bottom:2%; font-weight: bold;">ACKNOWLEDGMENT RECEIPT</p>
                <div class="row">
                    <div class="col-3">
                    </div>
                    <div class="col-6">
                    </div>
                    <div class="col-3 text-center" style="font-size:14px; padding: 0%;">
                        <div class="row" style="font-size: 14px;">
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
                <div class="row" style="margin-top: 10px;">
                    <div class="col">
                        <?php echo "<p style='text-indent: 50px; padding: 0px 50px 0px 100px;'>I acknowledge receipt of assistance in the amount of  <u>&emsp;". ucwords(strtolower($amountToWord)) ."&emsp;</u> Php<u>&emsp;". $client_assistance[1]['amount'] ."&emsp;</u>.</p>" ?>
                    </div>
                </div>
                <div class="row text-center" style="font-size: 16px;">
                    <div class="col">
                        <b>Received by:</b>
                    </div>
                </div><br><br>
                <div class="row" style="font-size: 16px; line-height: 15px;">
                    <div class="col text-center">
                        <input class="text-center" style="width: 40%; font-size: 16px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo ((!empty($client["firstname"])?$client["firstname"]." ":"") . (!empty($client["middlename"])?$client["middlename"][0].". ":""). (!empty($client["lastname"])?$client["lastname"]." ":"") . (!empty($client["extraname"])?$client["extraname"]." ":"")) ?>'><br>
                        <b>Client</b><br>
                        <p>(Signature Over Printed Name)</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="footer row">
            <div class="col-12 text-center" style="height: 20px; font-size: 14px;">
            <label>Page 1 of 1</label>
            </div>
            <div class="col-12" style="border-top: solid 1px black;">
            <p class="text-center">
                DSWD Field Office XI, Ramon Magsaysay Avenue corner Damaso Suazo Street, Davao City, Philippines 8000<br>
                Website: http://fo11.dswd.gov.ph Tel Nos.: (082) 227 1964</p>
            </div>
        </div>
	</div>
</body>

</html>