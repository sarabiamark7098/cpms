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
    <div class="container page1" id="gisv2_print" style="font-size:12px; padding:0%; font-family: Arial, sans-serif; border: solid 1px black; padding: 15px">
        
        <!--HEADER-->
        <div class="row" style="margin-top:0px; margin-bottom: 2%;">
            <div class="col-6">
                <img src="../../images/dswd_olog.png" alt="" width="230px" height="60px">
                <img src="../../images/AICS.png" alt="" width="70px" height="60px">
                <img src="../../images/BP.png" alt="" width="70px" height="60px">
            </div>
            <div class="col-6 ml-md-auto" style="color: #000000; ">
            </div>
        </div>
        
        <div class="row">
            <div class="col-12" style="text-align: center; margin-top: -7px">
                <div class="row">
                    <div class="col-12">
                        <p class="header" style="margin-top: -7px; margin-left:-15px; margin-right:-15px;"><b style="font-size: 24px">GENERAL INTAKE SHEET</b></p>
                    </div>
                </div>                
            </div>
        </div>
        <div class="row" style="margin-top: -18px; padding: 0%;">
            <div class="col-2" style="border: 1px solid black; font-size:14px; padding: 0%;">
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
            <div class="col-2" style="border: 1px solid black; font-size:14px; padding: 0%;">
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
            <div class="col-3" style="border: 1px solid black; font-size:14px; padding: 0%;">
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
            <div class="col-2" style="border: 1px solid black; border-right: none; font-size:14px; padding: 0%;">
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
            <div class="col-3 text-center" style="border: 1px solid black; border-left: none; font-size:14px; padding: 0%;">
                <div class="row" style="font-size: 14px; margin-top:20%;">
                    <div class="col-sm-2 center">
                        <p class="text-center">Date:</p>
                    </div>
                    <div class="col-sm-10">
                        <input class="text-center" style="width: 50px; font-size: 14px; padding:0; border: 1px solid black;" type="text" value='<?php echo date("m", strtotime($client['date_accomplished'])) ?>'>
                        <input class="text-center" style="width: 50px; font-size: 14px; padding:0; border: 1px solid black;" type="text" value='<?php echo date("d", strtotime($client['date_accomplished'])) ?>'>
                        <input class="text-center" style="width: 70px; font-size: 14px; padding:0; border: 1px solid black;" type="text" value='<?php echo date("Y", strtotime($client['date_accomplished'])) ?>'>
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
        <div class="row" style="padding-top: 8px; border: solid 1px black;">
            <div class="col-12">
                <div class="row">
                    <div class="col-12" style="margin-bottom: 8px;">
                        <b style="font-size: 18px">Client's Name</b>
                    </div>
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
                <div class="row">
                    <div class="col-3" style="margin-bottom: 8px;">
                        <b style="font-size: 18px">Beneficiary's Name</b>
                    </div>
                    <div class="col-9" style="margin-bottom: 8px;">
                        <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo (strtolower($client['relation'])=="self"? "&#x2714;" : "") ?>'>
                        <b>&nbsp;SAME AS ABOVE</b>
                    </div>
                    <div class="col-4">
                        <input class="text-center" style="width: 100%; height:80%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo !empty($client["b_lname"])?$client["b_lname"]:"" ?>'>
                    </div>
                    <div class="col-4">
                        <input class="text-center" style="width: 100%; height:80%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo !empty($client["b_fname"])?$client["b_fname"]:"" ?>'>
                    </div>
                    <div class="col-3">
                        <input class="text-center" style="width: 100%; height:80%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo !empty($client["b_mname"])?$client["b_mname"]:"" ?>'>
                    </div>
                    <div class="col-1">
                        <input class="text-center" style="width: 100%; height:80%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo !empty($client["b_exname"])?$client["b_exname"]:"" ?>'>
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
            </div>
        </div>
        <div class="row" style="padding: 8px 0px 5px; border: solid 1px black; border-bottom: none;">
            <div class="col-12">
                <div class="row">
                    <div class="col-12" style="margin: 3px 0px;">
                        <b style="font-size: 16px">PURPOSE OF ASSISTANCE  :&emsp;</b><input style="text-indent: 20px; width: 70%; height:80%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo !empty($client_assistance[1]['purpose'])?$client_assistance[1]['purpose']:"" ?>'>
                    </div>
                    <div class="col-12" style="margin: 3px 0px;">
                        <b style="font-size: 16px">DIAGNOSIS/CAUSE OF DEATH (if funeral)  :&emsp;</b><input style="text-indent: 20px; width: 60%; height:80%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo !empty($client_assistance[1]["cause_of_death"])?$client_assistance[1]["cause_of_death"]:"" ?>'>
                    </div>
                    <div class="col-12" style="margin: 3px 0px;">
                        <b style="font-size: 16px">MODE OF ASSISTANCE  :</b>
                        <input class="check-box text-center" style="margin-left: 10px; width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo (($client_assistance[1]['mode']) == "CAV"? "&#x2714;" : "") ?>'>
                        <b class="text-center" style="margin-right: 10px;">&nbsp;Outright Cash</b>
                        <input class="check-box text-center" style="margin-left: 10px; width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo (($client_assistance[1]['mode']) == "GL"? "&#x2714;" : "") ?>'>
                        <b class="text-center" style="margin-right: 10px;">&nbsp;Guarantee Letter</b>
                        <input class="check-box text-center" style="margin-left: 10px; width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo ((!empty($client_assistance[1]['material']))? "&#x2714;" : "") ?>'>
                        <b class="text-center" style="margin-right: 10px;">&nbsp;Material Assistance</b>
                        <input class="check-box text-center" style="margin-left: 10px; width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo ((!empty($gis["service5"]))||(!empty($gis["service6"]))? '&#x2714;': "") ?>'>
                        <b class="text-center" style="margin-right: 10px;">&nbsp;Psychosocial Support</b>
                        <input class="check-box text-center" style="margin-left: 10px; width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo (((!empty($gis['refer1']))||(!empty($gis['refer2']))||(!empty($gis['refer3'])))? "&#x2714;" : "") ?>'>
                        <b class="text-center">&nbsp;Referral Service</b>
                    </div>
                    <div class="col-12 text-center" style="margin: 3px 0px;">
                        <b style="font-size: 16px">AMOUNT NEEDED  :&emsp; Php </b><input style="text-indent: 20px; width: 60%; height:80%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo !empty($client_assistance[1]["amount"])?$client_assistance[1]["amount"]:"" ?>'>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="margin-bottom: 15px;">
            <div class="col-6">
                <div class="row" style="border: solid 1px black; margin-right:5px">
                    <div class="col-12" style="margin: 5px 0px;">
                        <p class="header" style="margin-top: -7px; margin-left:-15px; margin-right:-15px; text-indent: 14px;"><b style="font-size: 16px"> I. INCOME AND FINANCIAL RESOURCES</b></p>
                        <div class="row">
                            <div class="col-12">
                                <label style="margin-top: -12px; text-indent: 30px;"><b style="font-size: 16px"> Occupation/s of family member</b></label>                        
                            </div>
                            <div class="col-12" style="margin-top: -8px;">
                                <label style="text-indent: 60px; font-size: 14px;">Employed</label>
                            </div>
                            <div class="col-12" style="margin-top: -12px;">
                                <label style="text-indent: 60px; font-size: 14px;">(indicate number of members working)</label>
                                <input style="text-indent: 10px; width: 25%; height:80%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo (isset($otherClientInformation['employed'])?$otherClientInformation['employed']:"")?>'>
                            </div>
                            <div class="col-12" style="margin-top: -8px;">
                                <p style="text-indent: 60px; font-size: 14px;">Seasonal Employee</p>
                            </div>
                            <div class="col-12" style="margin-top: -20px;">
                                <label style="text-indent: 60px; font-size: 14px;">(indicate number of members working)</label>
                                <input style="text-indent: 10px; width: 25%; height:80%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo (isset($otherClientInformation['seasonal'])?$otherClientInformation['seasonal']:"")?>'>
                            </div>
                            <div class="col-12" style="margin-top: 3px;">
                                <label style="text-indent: 60px; font-size: 14px; margin-right: 70px;"><b>Combined Family Income</b></label>
                                <input style="text-indent: 10px; width: 25%; height:80%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo (isset($otherClientInformation['familyincome'])?$otherClientInformation['familyincome']:"")?>'>
                            </div>
                            <div class="col-12" style="margin-top: 3px;">
                                <input class="check-box text-center" style="margin-left: 30%; width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo (isset($otherClientInformation['insurance'])? "&#x2714;" : "") ?>'>
                                <label style="font-size: 14px; margin-left: 10px;"><b>Insurance coverage</b></label>
                            </div>
                            <div class="col-12">
                                <input class="check-box text-center" style="margin-left: 30%; width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo (isset($otherClientInformation['savings'])? "&#x2714;" : "") ?>'>
                                <label style="font-size: 14px; margin-left: 10px;"><b>Savings</b></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <p class="header" style="margin-top: -7px; margin-left:-15px; margin-right:-15px; text-indent: 14px;"><b style="font-size: 16px"> II. BUDGET AND EXPENSES</b></p>
                        <div class="row">
                            <div class="col-12" style="margin-top: -5px; margin-left: 30px;">
                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; border: 1px solid black;" type="text" value='<?php echo (isset($otherClientInformation['monthlyexpense'])? "&#x2714;" : "") ?>'>
                                <label style="text-indent: 10px; font-size: 14px; margin-right: 35px;"><b>Monthly expense of the family</b></label>
                                <input style="text-indent: 10px; width: 25%; height:80%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo (isset($otherClientInformation['monthlyexpense'])?$otherClientInformation['monthlyexpense']:"")?>'>
                            </div>
                            <div class="col-12" style="margin: -12px 0px 0px 60px;">
                                <label style="font-size: 13px; margin-left: 10px; width: 50%;">(Utility bills, Maintenance and Medication, Mortgage/Rent, Debt, and Others)</label>
                            </div>
                            <div class="col-12" style="margin-left: 30px;">
                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo (isset($otherClientInformation['emergencyfund'])? "&#x2714;" : "") ?>'>
                                <label style="font-size: 14px; margin-left: 10px;"><b>Availability of emergency fund</b></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <p class="header" style="margin-left:-15px; margin-right:-15px; text-indent: 14px;"><b style="font-size: 16px"> III. SEVERITY OF THE CRISIS</b></p>
                        <div class="row">
                            <div class="col-12">
                                <label style="margin-top: -5px; margin-left: 30px; line-height: 1.1;"><b style="font-size: 14px"> How long does the patient suffer from the disease?</b></label>                        
                            </div>
                            <div class="col-12" style="margin-left: 30px;">
                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; border: 1px solid black;" type="text" value='<?php echo (($otherinfo['crisisSeverityQuestion1']==1)? "&#x2714;" : "") ?>'>
                                <label style="text-indent: 10px; font-size: 14px; margin-right: 35px;">Recently Diagnosed (3mos & below)</label>
                            </div>
                            <div class="col-12" style="margin-left: 30px;">
                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo (($otherinfo['crisisSeverityQuestion1']==2)? "&#x2714;" : "") ?>'>
                                <label style="text-indent: 10px; font-size: 14px; margin-right: 35px;">3 Months to a Year</label>
                            </div>
                            <div class="col-12" style="margin-left: 30px;">
                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; border: 1px solid black;" type="text" value='<?php echo (($otherinfo['crisisSeverityQuestion1']==3)? "&#x2714;" : "") ?>'>
                                <label style="text-indent: 10px; font-size: 14px; margin-right: 35px;">Chronic or Lifelong</label>
                            </div>
                            <div class="col-12" style="margin-left: 30px;">
                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo (($otherinfo['crisisSeverityQuestion1']==0)? "&#x2714;" : "") ?>'>
                                <label style="text-indent: 10px; font-size: 14px; margin-right: 35px;">Not Applicable</label>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 8px;">
                            <div class="col-12">
                                <label style="margin-top: -5px; margin-left: 30px; line-height: 1.1;"><b style="font-size: 14px"> In the past three (3) months, did the family experience at least one crisis?															
                                </b></label>                        
                            </div>
                            <div class="col-3" style="margin-left: 30px;">
                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; border: 1px solid black;" type="text" value='<?php echo (($otherinfo['crisisSeverityQuestion2']==1)? "&#x2714;" : "") ?>'>
                                <label style="text-indent: 10px; font-size: 14px; margin-right: 35px;">YES</label>
                            </div>
                            <div class="col-3">
                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo (($otherinfo['crisisSeverityQuestion2']==0)? "&#x2714;" : "") ?>'>
                                <label style="text-indent: 10px; font-size: 14px; margin-right: 35px;">NO</label>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 8px;">
                            <div class="col-12">
                                <label style="margin-top: -5px; margin-left: 30px; line-height: 1.1;"><b style="font-size: 14px"> If yes, which among the following crises did the family experience in the past three (3) months (check all that apply):</b></label>                        
                            </div>
                            <div class="col-12" style="margin-left: 30px;">
                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo (isset($crisisSeverityQuestion3[1])? "&#x2714;" : "") ?>'>
                                <label style="text-indent: 10px; font-size: 14px; margin-right: 35px;">Hospitalization</label>
                            </div>
                            <div class="col-12" style="margin-left: 30px;">
                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo (isset($crisisSeverityQuestion3[2])? "&#x2714;" : "") ?>'>
                                <label style="text-indent: 10px; font-size: 14px; margin-right: 35px;">Death of a family member</label>
                            </div>
                            <div class="col-12" style="margin-left: 30px;">
                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo (isset($crisisSeverityQuestion3[3])? "&#x2714;" : "") ?>'>
                                <label style="text-indent: 10px; font-size: 14px; margin-right: 35px;">Catastrophic Event (fire, earthquake, flooding, etc.)</label>
                            </div>
                            <div class="col-12" style="margin-left: 30px;">
                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo (isset($crisisSeverityQuestion3[4])? "&#x2714;" : "") ?>'>
                                <label style="text-indent: 10px; font-size: 14px; margin-right: 35px;">Disablement</label>
                            </div>
                            <div class="col-12" style="margin-left: 30px;">
                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo (isset($crisisSeverityQuestion3[5])? "&#x2714;" : "") ?>'>
                                <label style="text-indent: 10px; font-size: 14px; margin-right: 35px;">Loss of Livelihood</label>
                            </div>
                            <div class="col-12" style="margin-left: 30px;">
                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo (isset($crisisSeverityQuestion3[6])? "&#x2714;" : "") ?>'>
                                <label style="text-indent: 10px; font-size: 14px; margin-right: 35px;">Others, specify</label>
                                <input style="text-indent: 10px; width: 45%; height:80%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo (isset($crisisSeverityQuestion3[6])?$crisisSeverityQuestion3[6]:"")?>'>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="row" style="border: solid 1px black; margin-left: 5px;">
                    <div class="col-12" style="margin: 5px 0px;">
                        <p class="header" style="margin-top: -7px; margin-left:-15px; margin-right:-15px; text-indent: 14px;"><b style="font-size: 16px">  IV. AVAILABILITY OF SUPPORT SYSTEMS</b></p>
                        <div class="row" style="margin: 5px 0px;">
                            <div class="col-12" style="margin-left: 30px;">
                                <input class="check-box text-center" style="width: 20px; height: 20px; font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo (isset($supportSystemAvailability[1])? "&#x2714;" : "") ?>'>
                                <label style="text-indent: 10px; font-size: 14px; margin-right: 35px;">Family</label>
                            </div>
                            <div class="col-12" style="margin-left: 30px;">
                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo (isset($supportSystemAvailability[2])? "&#x2714;" : "") ?>'>
                                <label style="text-indent: 10px; font-size: 14px; margin-right: 35px;">Relatives</label>
                            </div>
                            <div class="col-12" style="margin-left: 30px;">
                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo (isset($supportSystemAvailability[3])? "&#x2714;" : "") ?>'>
                                <label style="text-indent: 10px; font-size: 14px; margin-right: 35px;">Friend/s</label>
                            </div>
                            <div class="col-12" style="margin-left: 30px;">
                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo (isset($supportSystemAvailability[4])? "&#x2714;" : "") ?>'>
                                <label style="text-indent: 10px; font-size: 14px; margin-right: 35px;">Employer</label>
                            </div>
                            <div class="col-12" style="margin-left: 30px;">
                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo (isset($supportSystemAvailability[5])? "&#x2714;" : "") ?>'>
                                <label style="text-indent: 10px; font-size: 14px; margin-right: 35px;">Church/Community Organization</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="border: solid 1px black; margin-left:5px">
                    <div class="col-12" style="margin: 5px 0px;">
                        <p class="header" style="margin-top: -7px; margin-left:-15px; margin-right:-15px; text-indent: 14px;"><b style="font-size: 16px"> V. EXTERNAL RESOURCES TAPPED BY THE FAMILY</b></p>
                        <div class="row" style="margin: 15px 0px;">
                            <div class="col-12" style="margin-left: 30px;">
                                <input class="check-box text-center" style="width: 20px; height: 20px; font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo (isset($externalResources[1])? "&#x2714;" : "") ?>'>
                                <label style="text-indent: 10px; font-size: 14px; margin-right: 35px;">Philhealth</label>
                            </div>
                            <div class="col-12" style="margin-left: 30px;">
                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo (isset($externalResources[2])? "&#x2714;" : "") ?>'>
                                <label style="text-indent: 10px; font-size: 14px; margin-right: 35px;">Health Card</label>
                            </div>
                            <div class="col-12" style="margin-left: 30px;">
                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo (isset($externalResources[3])? "&#x2714;" : "") ?>'>
                                <label style="text-indent: 10px; font-size: 14px; margin-right: 35px;">Guarantee Letter from other agencies</label>
                            </div>
                            <div class="col-12" style="margin-left: 30px;">
                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo (isset($externalResources[4])? "&#x2714;" : "") ?>'>
                                <label style="text-indent: 10px; font-size: 14px; margin-right: 35px;">MSS Discount</label>
                            </div>
                            <div class="col-12" style="margin-left: 30px;">
                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo (isset($externalResources[5])? "&#x2714;" : "") ?>'>
                                <label style="text-indent: 10px; font-size: 14px; margin-right: 35px;">Senior Citizen Discount</label>
                            </div>
                            <div class="col-12" style="margin-left: 30px;">
                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo (isset($externalResources[6])? "&#x2714;" : "") ?>'>
                                <label style="text-indent: 10px; font-size: 14px; margin-right: 35px;">PWD Discount</label>
                                <input style="text-indent: 10px; width: 45%; height:80%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo (isset($externalResources[6])?$externalResources[6]:"")?>'>
                            </div>
                            <div class="col-12" style="margin-left: 30px;">
                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo (isset($externalResources[7])? "&#x2714;" : "") ?>'>
                                <label style="text-indent: 10px; font-size: 14px; margin-right: 35px;">Others, specify</label>
                                <input style="text-indent: 10px; width: 45%; height:80%; font-size: 13px; padding:0; border:none; border-bottom: 1px solid black;" type="text" height="30px" value='<?php echo (isset($externalResources[7])?$externalResources[7]:"")?>'>
                            </div>
                            <div class="col-12" style="margin-left: 30px;">
                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo (isset($externalResources[0])? "&#x2714;" : "") ?>'>
                                <label style="text-indent: 10px; font-size: 14px; margin-right: 35px;">Not Applicable</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="border: solid 1px black; margin-left:5px">
                    <div class="col-12" style="margin: 5px 0px;">
                        <p class="header" style="margin-top: -7px; margin-left:-15px; margin-right:-15px; text-indent: 14px;"><b style="font-size: 16px"> VI. SELF HELP AND CLIENT EFFORTS</b></p>
                        <div class="row" style="margin: 15px 0px;">
                            <div class="col-1" style="margin-left: 30px;">
                                <input class="check-box text-center" style="width: 20px; height: 20px; font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo (isset($selfHelp[1])? "&#x2714;" : "") ?>'>
                            </div>
                            <div class="col-10">
                                <label style="text-indent: 10px; font-size: 14px; margin-right: 35px;">Successfully sought employment opportunities or explored additional income sources</label>
                            </div>
                            <div class="col-1" style="margin-left: 30px;">
                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo (isset($selfHelp[2])? "&#x2714;" : "") ?>'>
                            </div>
                            <div class="col-10">
                                <label style="text-indent: 10px; font-size: 14px; margin-right: 35px;">Successfully  reached out to relevant organizations or agencies for financial assistance or support</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="border: solid 1px black; margin-left:5px">
                    <div class="col-12" style="margin: 5px 0px;">
                        <p class="header" style="margin-top: -7px; margin-left:-15px; margin-right:-15px; text-indent: 14px;"><b style="font-size: 16px"> VII. VULNERABILITY AND RISK FACTORS</b></p>
                        <div class="row" style="margin: 15px 0px;">
                            <div class="col-1" style="margin-left: 30px;">
                                <input class="check-box text-center" style="width: 20px; height: 20px; font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo (isset($vulnerability_riskFactor[1])? "&#x2714;" : "") ?>'>
                            </div>
                            <div class="col-10">
                                <label style="text-indent: 10px; font-size: 14px; margin-right: 35px;">There are elderly/ Child in need/ PWD/ Pregnant in the household</label>
                            </div>
                            <div class="col-1" style="margin-left: 30px;">
                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo (isset($vulnerability_riskFactor[2])? "&#x2714;" : "") ?>'>
                            </div>
                            <div class="col-10">
                                <label style="text-indent: 10px; font-size: 14px; margin-right: 35px;">A member is physically or mentally incapacitated to work</label>
                            </div>
                            <div class="col-1" style="margin-left: 30px;">
                                <input class="check-box text-center" style="width: 20px; height: 20px; font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo (isset($vulnerability_riskFactor[3])? "&#x2714;" : "") ?>'>
                            </div>
                            <div class="col-10">
                                <label style="text-indent: 10px; font-size: 14px; margin-right: 35px;">Inability to secure stable employment</label>
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
    <div class="container page2" id="gisv2_print" style="font-size:12px; padding:0%; font-family: Arial, sans-serif; margin-top: 24px; border: solid 1px black; padding: 0px 15px;">
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
                                                        <label style="font-size: 12px; margin-left: 10px;">Recovering Person Who Used Drugs</label>
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
                                                <label style="font-size: 11px; margin-left: 10px;">Speech Impairment</label><br>
                                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo ($gis['type_of_disability'] == 2? '&#x2714;':'') ?>'>
                                                <label style="font-size: 14px; margin-left: 10px;">Learning Disability</label><br>
                                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo ($gis['type_of_disability'] == 3? '&#x2714;':'') ?>'>
                                                <label style="font-size: 11px; margin-left: 10px;">Psychosocial Disability</label><br>
                                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo ($gis['type_of_disability'] == 4? '&#x2714;':'') ?>'>
                                                <label style="font-size: 11px; margin-left: 10px;">Deaf/Hard-of-Hearing</label><br>
                                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo ($gis['type_of_disability'] == 5? '&#x2714;':'') ?>'>
                                                <label style="font-size: 14px; margin-left: 10px;">Cancer</label>
                                            </div>
                                            <div class="col-6">
                                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo ($gis['type_of_disability'] == 6? '&#x2714;':'') ?>'>
                                                <label style="font-size: 14px; margin-left: 10px;">Mental Disability</label><br>
                                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo ($gis['type_of_disability'] == 7? '&#x2714;':'') ?>'>
                                                <label style="font-size: 14px; margin-left: 10px;">Visual Disability</label><br>
                                                <input class="check-box text-center" style="width: 20px; height: 20px;  font-size: 14px; padding:0; text-indent: 1px; border: 1px solid black;" type="text" value='<?php echo ($gis['type_of_disability'] == 8? '&#x2714;':'') ?>'>
                                                <label style="font-size: 11px; margin-left: 10px;">Intellectual Disability</label><br>
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
                                <b>Interviewed by:</b>
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