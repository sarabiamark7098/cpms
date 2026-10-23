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
                <img src="../../images/dswd_olog.png" alt="" width="230px" height="60px">
                <img src="../../images/BP.png" alt="" width="70px" height="60px" style="margin-left: 5px;">
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
                
            </div>
            <div class="col-3 text-center" style="font-size:14px; padding: 0%;">
                <div class="row" style="font-size: 14px;">
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
        <!--Second Row-->
        <div class="row" style="margin-top: -18px; padding: 0%;">
            <div class="col-3" style="font-size:14px; padding: 0%;">
                <div style="margin-top: 10px; margin-left:12px; margin-bottom: 5px;">
                    <b>Program:</b>
                    <div style="padding-top: 3px;"><input class="check-box text-center" style="width: 18px; height: 18px; font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo ((($client['program_type'])==0)||(empty($client['program_type']))? "&#x2714;" : "") ?>'> &nbsp;AICS</div>
                    <div style="padding-top: 3px;"><input class="check-box text-center" style="width: 18px; height: 18px; font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo (($client['program_type']=="ffs")? "&#x2714;" : "") ?>'> &nbsp;FFS</div>
                    <div style="padding-top: 3px;"><input class="check-box text-center" style="width: 18px; height: 18px; font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo (($client['program_type']=="other" || $client['program_type']=="wisupport")? "&#x2714;" : "") ?>'> &nbsp;Others:
                    <input class="text-center" style="width: 60%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" value='<?php echo !empty($client["other_program"])?$client["other_program"]:"" ?>'></div>
                </div>
            </div>
            <div class="col-3" style="font-size:14px; padding: 0%;">
                <div style="margin-top: 10px; margin-left:12px; margin-bottom: 5px;">
                    <b>Mode of Implementation:</b>
                    <div style="padding-top: 3px;"><input class="check-box text-center" style="width: 18px; height: 18px; font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo (($user->getTransactionProcessed($_GET['id']))? "" : "&#x2714;") ?>'> &nbsp;Onsite</div>
                    <div style="padding-top: 3px;"><input class="check-box text-center" style="width: 18px; height: 18px; font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo (($user->getTransactionProcessed($_GET['id']))? "&#x2714;" : "") ?>'> &nbsp;Malasakit Center</div>
                    <div style="padding-top: 3px;"><input class="check-box text-center" style="width: 18px; height: 18px; font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value=''> &nbsp;Offsite</div>
                </div>
            </div>
            <div class="col-3" style="font-size:14px; padding: 0%;">
                <div style="margin-top: 10px; margin-left:12px; margin-bottom: 5px;">
                    <b>Mode of Admission:</b>
                    <div class="row">
                        <div class="col-6" style="padding-top: 3px;"><input class="check-box text-center" style="width: 18px; height: 18px; font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo (strtolower($gis['mode_admission'])=="walk-in"? "&#x2714;" : "") ?>'> &nbsp;Walk-in</div>
                        <div class="col-6" style="padding-top: 3px;"><input class="check-box text-center" style="width: 18px; height: 18px; font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo (strtolower($gis['mode_admission'])=="referral"? "&#x2714;" : "") ?>'> &nbsp;Referral</div>
                        <div class="col-3"></div>
                        <div class="col-6" style="padding-top: 3px;"><input class="check-box text-center" style="width: 18px; height: 18px; font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black; border-radius: 50%;" type="text" value='<?php echo (strtolower($client['type_of_client'])=="new"? "&#x2714;" : "") ?>'> &nbsp;New</div>
                        <div class="col-3"></div>
                        <div class="col-3"></div>
                        <div class="col-6" style="padding-top: 3px;"><input class="check-box text-center" style="width: 18px; height: 18px; font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black; border-radius: 50%;" type="text" value='<?php echo (strtolower($client['type_of_client'])=="returning"? "&#x2714;" : "") ?>'> &nbsp;Returning</div>
                        <div class="col-3"></div>
                    </div>
                </div>
            </div>
            <div class="col-3 text-center" style="font-size:14px; padding: 0%;">
                
            </div>
        </div>
<!--Assistance-->
        <div style="margin-top: 5px; font-size: 15px; text-transform: justify; padding-bottom: 5px;">
            <?php
                $coe_name = (!empty($client["lastname"])?$client["lastname"].", ":"") . (!empty($client["firstname"])?$client["firstname"]." ":"") . (!empty($client["middlename"])?$client["middlename"]." ":""). (!empty($client["extraname"])?$client["extraname"]." ":"");
                $coe_relation = (strtolower($client['relation'])!='self'?$client['relation']:"Self");
                $coe_bname = (!empty($client["b_lname"])?$client["b_lname"].", ":"") . (!empty($client["b_fname"])?$client["b_fname"]." ":"") . (!empty($client["b_mname"])?$client["b_mname"]." ":""). (!empty($client["b_exname"])?$client["b_exname"]." ":"");
            ?>
            This is to certify that, <input class="text-center" style=" border: none; border-bottom: 1px solid black; padding:0px; margin:0px; height: 20px; width: 600px; font-size: <?php echo $user->coe_fit_font($coe_name, 600) ?>px;" value="<?php echo $coe_name ?>" />,
            <input class="text-center" style=" border: none; border-bottom: 1px solid black; padding:0px; margin:0px; height: 20px; width: 80px; font-size: <?php echo $user->coe_fit_font($client['sex'], 80) ?>px;" value="<?php echo $client['sex'] ?>" />, 
            <input class="text-center" style=" border: none; border-bottom: 1px solid black; padding:0px; margin:0px; height: 20px; width: 60px; font-size: <?php echo $user->coe_fit_font($age_client, 60) ?>px;" value="<?php echo $age_client ?>" /> year/s<br>
            <div class="row">
				<div class="col-3"></div>
				<div class="text-center col-3"><div contenteditable="true" style="word-wrap: break-word; word-break: break-word;width: 450px; font-size: 14px;line-height:12px;"><b>Last Name, First Name, Middle Name, Extension Name</b></div></div> 
				<div class="col-3"></div>
				<div class="text-center col-1"><div contenteditable="true" style="margin-left: 10px; word-wrap: break-word; word-break: break-word;width: 60px; font-size: 14px;line-height:12px;"><b>Sex</b></div></div> 
				<div class="text-center col-1"><div  contenteditable="true" style="margin-left:15px; word-wrap: break-word; word-break: break-word;width: 60px; font-size: 14px;line-height:12px;"><b>Age</b></div></div>
            </div>
			and presently residing at <input class="text-center" style=" border: none; border-bottom: 1px solid black; padding:0px; margin:0px; height: 20px; width: 780px; font-size: <?php echo $user->coe_fit_font($c_add, 780) ?>px;" 
			value="<?php echo $c_add?>" /><br>
            <a style="margin-left: 43%;"><b>Complete Address </b></a><br> 
            has been found eligible for assistance after the assessment and validation conducted, for him/herself or in representation of his/her <br>
            <input class="text-center" style=" border: none; border-bottom: 1px solid black; padding:0px; margin:0px; height: 20px; width: 325px; font-size: <?php echo $user->coe_fit_font($coe_relation, 325) ?>px;" value="<?php echo $coe_relation ?>" />, 
                <input class="text-center" style=" border: none; border-bottom: 1px solid black; padding:0px; margin:0px; height: 20px; width: 600px; font-size: <?php echo $user->coe_fit_font($coe_bname, 600) ?>px;"
                value="<?php echo $coe_bname ?>" />.<br>
            <div class="row">
				<div class="text-center col-4"><div contenteditable="true" style="word-wrap: break-word; word-break: break-word;width: 330px; font-size: 14px;line-height:12px; text-indent: 8px;"><b>Relationship of the Beneficiary to the Client</b></div></div> 
				<div class="col-1"></div>
				<div class="text-center col-4"><div contenteditable="true" style="word-wrap: break-word; word-break: break-word;width: 420px; font-size: 14px;line-height:12px;"><b>Last Name, First Name, Middle Name, Extension Name</b></div></div>
            </div>
        </div>

        <!-- Checker of Documents Presented -->
        <div class="row">
            <div class="col " style="border: 1px solid black;margin-top: 3px; padding: 0px 0px 4px 0px;">
                <p class="text-center" style="font-size: 14px; border: 1px solid black; background-color: #bfbfbf; padding:2px; margin-bottom:2%; font-weight: bold;">Records of the case, such as the following, are submitted and/or filed to the Crisis Intervention Program (CIP) and/or the appropriate office, as applicable</p>
                <div class="row" style="font-size: 14px; margin:0px 2px 0px 2px">
                    <div class="col-3" style="padding-top: 0px; margin-top: -8px; border-right: 1px solid black;">
                        <b>Crisis Intervention Program:</b><br>
                        <input class="text-center" type="text" style="font-size:16px;width:16px;height:16px;border:1px solid black;" value="&#x2714;" />&emsp;General Intake Sheet<br>
                        <input class="text-center" type="text" style="font-size:16px;width:16px;height:16px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('information sheet', $record['document'])?>" />&emsp;Information Sheet<br>
                        <input class="text-center" type="text" style="font-size:16px;width:16px;height:16px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('social case study', $record['document'])?>" />&emsp;Social Case Study Report/<br>&emsp;&emsp;&emsp;Case Summary Report<br>
                        <input class="text-center" type="text" style="font-size:16px;width:16px;height:16px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('referral', $record['document'])?>" />&emsp;Referral Letter<br>
                        <input class="text-center" type="text" style="font-size:16px;width:16px;height:16px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('valid id', $record['document'])?>" />&emsp;Photocopy of valid I.D.<br>
                        <p class="text-center" style="width: 100%;height:18px; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;"><?php echo $record['id_presented']?></p>
                    </div>
                    <div class="col-9" style="padding-top: 0px; margin-top: -8px;">
                        <b>Other Offices:</b>
                        <div class="row">
                            <div class="col-4" style="padding-right:0;">
                                <input class="text-center" type="text" style="font-size:16px;width:16px;height:16px;border:1px solid black;" value="<?php echo $user->coe_check_any(['medical certificate', 'abstract', 'discharge summary', 'certificate of confinement', 'death summary', 'alagang pinoy tagubilin'], $record['document'])?>" />&emsp;Medical Certificate/Abstract/<br>&emsp;&emsp;&emsp;Discharge Summary/<br>&emsp;&emsp;&emsp;Certificate of Confinement/<br>&emsp;&emsp;&emsp;Death Summary/<br>&emsp;&emsp;&emsp;Alagang Pinoy Tagubilin<br>
                                <input class="text-center" type="text" style="font-size:16px;width:16px;height:16px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('prescription', $record['document'])?>" />&emsp;Prescriptions<br>
                                <input class="text-center" type="text" style="font-size:16px;width:16px;height:16px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('lab request', $record['document'])?>" />&emsp;Laboratory Request<br>
                                <input class="text-center" type="text" style="font-size:16px;width:16px;height:16px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('treatment', $record['document'])?>" />&emsp;Treatment Protocol
                            </div>
                            <div class="col-4" style="padding-right:0;">
                                <input class="text-center" type="text" style="font-size:16px;width:16px;height:16px;border:1px solid black;" value="<?php echo $user->coe_check('statement', $record['document'])?>" />&emsp;Statement of Account<br>
                                <input class="text-center" type="text" style="font-size:16px;width:16px;height:16px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('promissory', $record['document'])?>" />&emsp;Promissory Note/<br>&emsp;&emsp;&emsp;Certificate of Balance<br>
                                <input class="text-center" type="text" style="font-size:16px;width:16px;height:16px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('funeral', $record['document'])?>" />&emsp;Funeral Contract<br>
                                <input class="text-center" type="text" style="font-size:16px;width:16px;height:16px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('death certificate', $record['document'])?>" />&emsp;Death Certificate<br>
                                <input class="text-center" type="text" style="font-size:16px;width:16px;height:16px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('transfer permit', $record['document'])?>" />&emsp;Transfer Permit<br>
                                <input class="text-center" type="text" style="font-size:16px;width:16px;height:16px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('quotation', $record['document'])?>" />&emsp;Quotation/Charge Slip
                            </div>
                            <div class="col-4" style="padding-right:0;">
                                <input class="text-center" type="text" style="font-size:16px;width:16px;height:16px;border:1px solid black;" value="<?php echo $user->coe_check('justification', $record['document'])?>" />&emsp;Justification<br>
                                <input class="text-center" type="text" style="font-size:16px;width:16px;height:16px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('valid id', $record['document'])?>" />&emsp;Photocopy of valid I.D.<br>
                                <p class="text-center" style="width: 95%;height:18px; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;"><?php echo $record['id_presented']?></p>
                                <?php if(!empty($user->coe_check('Others', $record['document']))){ ?>
                                <input class="text-center" type="text" style="font-size:16px;width:16px;height:16px;margin-top:1px;border:1px solid black;" value="<?php echo $user->coe_check('Others', $record['document'])?>" />&emsp;Others:<br>
                                <p class="text-center" style="width: 90%;height:18px; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black; margin-bottom: 0%;"><?php echo $record['others_input']?></p>
                                <?php } else {?>
                                <input class="text-center" type="text" style="font-size:16px;width:16px;height:16px;margin-top:1px;border:1px solid black;" value="" />&emsp;Others:<br>
                                <input class="text-center" style="width: 90%;height:18px; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black; margin-bottom: 0%;" type="text" value="">
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<!--Mode of Release-->
        <div class="row">
            <div class="col " style="border: 1px solid black;margin-top: 3px; padding: 0px 0px 4px 0px;">
                <p class="text-center" style="font-size: 15px; border: 1px solid black; background-color: #bfbfbf; padding:2px; margin-bottom:2%; font-weight: bold;">MODE OF RELEASE</p>
                <div class="row" style="font-size: 15px; margin: 0px 10px; align-items: center;">
                    <div class="col-3"><input class="check-box text-center" style="width: 18px; height: 18px; font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo (($mode1 == "CAV" || (!empty($mode2) && $mode2 == "CAV"))? "&#x2714;" : "") ?>'> &nbsp;Outright Cash</div>
                    <div class="col-3"><input class="check-box text-center" style="width: 18px; height: 18px; font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo (($mode1 == "GL" || (!empty($mode2) && $mode2 == "GL"))? "&#x2714;" : "") ?>'> &nbsp;Guarantee Letter</div>
                    <div class="col-2 text-right"><b>GL No.:</b></div>
                    <div class="col-4"><input class="text" style="width: 100%; font-size: 15px; padding:0; text-indent: 8px; border: 1px solid black;" type="text" value='<?php echo (($mode1 == "GL" || (!empty($mode2) && $mode2 == "GL"))?$GLid:"") ?>'></div>
                </div>
                <div class="row" style="font-size: 15px;">
                    <div class="col-12" style="text-align: justify; text-indent: 50px; line-height: 35px; padding: 12px 40px;">
                        <?php
                            // Adjust the font-size below to scale all underlined text and labels uniformly
                            $fontSize = "15px";

                            // Universal style preserving original height/width proportions across variable keys
                            $underlineStyle = "display: inline-block; font-size: {$fontSize}; min-height: 22px; line-height: 22px; border-bottom: 1px solid #000; text-align: center; vertical-align: bottom; padding: 0 5px; text-indent: 0;";

                            $recvType = (strtolower(explode(" ", strtoupper($client_assistance[1]['type'] ?? ''))[0]) == "cash" ? "Cash Relief" : ucwords(strtolower(explode(" ", strtoupper($client_assistance[1]['type'] ?? ''))[0])));
                            $recvPurpose = ucwords(strtolower(!empty($client_assistance[1]['purpose']) ? $client_assistance[1]['purpose'] : ""));
                            $recvWords = ucwords(strtolower($amountToWord ?? ''));
                            $recvAmt = $client_assistance[1]['amount'] ?? '';
                            $isGL = (($mode1 ?? '') == "GL" || (!empty($mode2) && $mode2 == "GL"));

                            echo "<span style='font-size: {$fontSize};'>The client is hereby recommended to receive <span style='{$underlineStyle} min-width: 200px;'>" . ($recvType ?: '&nbsp;') . "</span> assistance for <span style='{$underlineStyle} min-width: 270px;'>" . ($recvPurpose ?: '&nbsp;') . "</span> in the amount of <span style='{$underlineStyle} min-width: 600px;'>" . ($recvWords ?: '&nbsp;') . "</span> PhP<span style='{$underlineStyle} min-width: 150px;'>" . ($recvAmt ?: '&nbsp;') . "</span>";

                            if ($isGL) {
                                $glName = ucwords(strtolower($gl['cname'] ?? ''));
                                $glAddress = ucwords(strtolower($gl['caddress'] ?? ''));

                                echo " payable to <span style='{$underlineStyle} min-width: 800px;'>" . ($glName ?: '&nbsp;') . "</span>, <span style='{$underlineStyle} min-width: 900px;'>" . ($glAddress ?: '&nbsp;') . "</span>";
                            }

                            echo ".</span>";
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <br>
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
                <p>(Signature over Printed Name)</p>
                <div style="margin-top: -10px;">
                    <label>License Number:</label><input class="text-center" style="width: 20%; border-bottom: 1px solid black;" type="text" value='<?php echo $soc_worker['sw_license_no']; ?>'><br>
                </div>
            </div>
            <div class="col text-center">
                <input class="text-center" style="width: 100%; font-size: 16px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo (strtolower($mode1) == "cav"?$GISsignatoryName:$GLsignatoryName) ?>'>
                <b>Approving Authority</b>
                <p>(Signature over Printed Name)</p>
            </div>
        </div>
        <div class="row">
            <div class="col" style="border: 1px solid black;margin-top: 3px; padding: 0px 0px 4px 0px;">
                <p class="text-center" style="font-size: 15px; border: 1px solid black; background-color: #bfbfbf; font-size:15px; padding:0%; margin-bottom:2%; font-weight: bold;">ACKNOWLEDGMENT OF ASSISTANCE</p>
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
                <div class="row" style="margin-top: 10px;">
                    <div class="col">
                        <?php echo "<p style='padding: 0px 50px 0px 100px;'>I acknowledge receipt of assistance in the amount of  <u>&emsp;". ucwords(strtolower($amountToWord)) ."&emsp;</u> Php<u>&emsp;". $client_assistance[1]['amount'] ."&emsp;</u>.</p>" ?>
                    </div>
                </div>
                <div class="row text-center" style="font-size: 16px;">
                    <div class="col">
                        <b>Received by:</b>
                    </div>
                </div><br><br>
                <div class="row" style="font-size: 16px; line-height: 15px; position: relative;">
                    <div class="col text-center">
                        <input class="text-center" style="width: 40%; font-size: 16px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo ((!empty($client["lastname"])?$client["lastname"].", ":"") . (!empty($client["firstname"])?$client["firstname"]." ":"") . (!empty($client["middlename"])?$client["middlename"][0].". ":""). (!empty($client["extraname"])?$client["extraname"]." ":"")) ?>'><br>
                        <b>Client</b><br>
                        <p>(Signature over Printed Name)</p>
                    </div>
                    <div style="position: absolute; top: -80px; right: 60px; width: 260px; text-align: center; font-size: 12px; line-height: 14px;">
                        <div style="border: 1px solid black; height: 110px; width: 110px; margin: 0 auto 2px auto;"></div>
                        Thumbmark<br>
                        <span style="font-style: italic;">(if unable to provide specimen signature)</span>
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