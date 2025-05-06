 <style>
	
	.attestfooter{
        position:absolute;
        bottom:0;
        width:90%;
        height:90px;
    }
	
 </style>
<div class="container" id="attestation_v1print" style=" width:100%; font-family: Arial; font-size:12px; padding:2%; padding-left:70px; padding-right: 80px;">

    <!--HEADER-->
    <div class="row" style="margin-top:0px;">
        <div class="col-6">
            <img src="../images/DSWD Field Office XI.png" alt="" width="230px" height="80px">
        </div>
        <div class="col-6 ml-md-auto" style="color: #000000; ">
            <!-- <p class="text-center" style="font-size: 14px; margin-top: 0px;">DSWD-PMB-GF-015 | REV 02 | 08 JAN 2024</p> -->
        </div>
    </div>
    <div class="row">
        <div class="col-12" style="text-align: right; margin-top: 10px;">
            <b style="font-size: 24px">ANNEX A</b>                
        </div>
    </div>
    <div class="row">
        <div class="col-12" style="text-align: center; margin-top: 40px;">
            <b style="font-size: 28px">CERTIFICATE OF ATTESTATION</b>                
        </div>
    </div>
    <div class="row" style="margin-bottom: 50px;">
        <div class="col-12 justify" style="margin-top: 40px; text-indent: 50px; font-size: 20px;">
            <p>This is to certify that Mr./Ms. <b><?php echo strtoupper($name) ?></b>, <b><?php echo $age_client?></b> years old, residing 
            at <b><?php echo strtoupper($c_add) ?></b> is currently working as a
            <b><?php echo strtoupper($client['occupation']) ?></b> at <b><?php echo strtoupper($client['agency']) ?></b>
            earning a monthly income of <b><?php echo "Php ". number_format($client['salary']) ?></b>. 
            </p>
            <p>Following a thorough assessment and validation of the client's socio-economic profile conducted by the undersigned social worker, 
                it has been determined that Mr./Ms.
            <b><?php echo strtoupper($name) ?></b> is an individual receiving income below the regional minimum wage and is facing significant 
            financial challenges because of the effects of inflation, like the rising prices of goods and services. The above-mentioned income remains insufficient to meet the unforeseen expenses for food, on top of the family's monthly household expenses amounting to Php
            <b><?php echo $otherClientInformation['monthlyexpense'] ?></b>, thus further straining their limited financial resources.
            </p>
            
            <p>This certification is issued upon the request of the above-named person for whatever legal purpose/s it may serve.</p>
            <p>Issued on <b><?php echo date("jS")." day of ".date("F Y")  ?></b> at <b>DSWD Field Office</b>.
            </p>
        </div>
    </div>
    <div class="row" style="font-size: 24px;">
        <div class="col-2">                  
        </div>
        <div class="col-8 text-center">
            <input id="signatory" style="font-weight: bold; text-transform:uppercase; width:100%; border:none; text-align: center;" value="<?php echo ucwords(strtolower($soc_workFullname)) ?>"><br>
            Name and Signature of Social Welfare Officer<br>
            <input id="license" style="border: none; width: 100%; text-align: center;" value="License No.: <?php echo $soc_worker['sw_license_no'] ?>">
        </div>
        <div class="col-2">                  
        </div>
    </div>
    <div class="row" style="margin-bottom: 50px;">
        <div class="col-12 justify" style="margin-top: 40px; text-indent: 50px; font-size: 20px;">
            <p style="font-style: italic;">"I declare under pain of criminal prosecution that all the information provided herewith are TRUE, CORRECT, VALID, and COMPLETE pursuant to existing laws, rules, and regulations of the Republic of the Philippines. I authorize the Agency Head/Authorized Representatives to verify and validate the contents stated herein. I also AGREE that any misrepresentation and information/acts to defraud the government may lead to the filing of appropriate cases against me, and may cause disqualification to receive financial assistance from the DSWD."
            </p>
        </div>
    </div>
    <div class="row" style="font-size: 24px;">
        <div class="col-2">                  
        </div>
        <div class="col-8 text-center">
            <input id="client" style="font-weight: bold; text-transform:uppercase; width:100%; border:none; text-align: center;" value="<?php echo ucwords(strtolower($name)) ?>"><br>
            Name and Signature of Client
        </div>
        <div class="col-2">                  
        </div>
    </div>
    <div class="attestfooter row">
        <div class="col-11">
            <div style="border-bottom: solid 1px black;"></div>
            <p class="text-center">Page 1 of 1<br>
                DSWD Field Office XI, Ramon Magsaysay Avenue, corner Damaso Suazo Street, Davao City, Philippines 8000<br>
                Website: http://fo11.dswd.gov.ph Tel Nos.: (082) 227 1964 </p>
        </div>
        <!-- <div class="col-2">
            <img src="../images/dswd-ISO.png" alt="" width="110px" height="60px">
        </div> -->
    </div>
    <!--Container-->
</div>