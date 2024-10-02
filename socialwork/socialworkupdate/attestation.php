<html>
<body>
 <style>
    
	@page {
		size: 8.3in 11.7in;
		margin: .10in /* change the margins as you want them to be. */
	}

	@media print{
		html, body {
			width: 210mm;
			height: 297mm;
		}
	}
    
	.header{
		background-color: black !important;
		color: white;
		-webkit-print-color-adjust: exact; 
		font-size: 14px;
	}
    .footer{
        position:absolute;
        bottom:0;
        width:90%;
        height:90px;
    }
	
 </style>
    <div class="container" id="attestation_v1print" style="font-size:12px; padding:2%; font-family: Arial: sans-serif; padding-left:70px; padding-right: 80px;">
        
        <!--HEADER-->
        <div class="row" style="margin-top:40px;">
            <div class="col-6">
                <img src="../../images/dswd_olog.png" alt="" width="230px" height="60px">
                <img src="../../images/AICS.png" alt="" width="70px" height="60px">
                <img src="../../images/BP.png" alt="" width="70px" height="60px">
            </div>
            <div class="col-6 ml-md-auto" style="color: #000000; ">
                <p class="text-center" style="font-size: 14px; margin-top: 0px;">DSWD-PMB-GF-015 | REV 02 | 08 JAN 2024</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12" style="text-align: right; margin-top: 20px;">
                <b style="font-size: 24px">ANNEX A</b>                
            </div>
        </div>
        <div class="row">
            <div class="col-12" style="text-align: center; margin-top: 100px;">
                <b style="font-size: 30px">CERTIFICATE OF ATTESTATION</b>                
            </div>
        </div>
        <div class="row" style="margin-bottom: 90px;">
            <div class="col-12 justify" style="margin-top: 40px; text-indent: 50px; font-size: 24px;">
                <p>This is to certify that Mr./Mrs. <b><?php echo strtoupper($name) ?></b>, <b><?php echo $age_client?></b> years old residing 
                at <b><?php echo strtoupper($c_add) ?></b> is currently working or has employment history as 
                <b><?php echo strtoupper($client['occupation']) ?></b> in <b><?php echo strtoupper($client['agency']) ?></b>
                earning <b><?php echo "Php ". number_format($client['salary']) ?></b> per month. 
                </p><br>
                <p>Based on the assessment and validation conducted by the undersigned, the abovementioned income remains
                    insufficient to meet the family's daily sustenance for <b><?php echo ucwords(strtolower($client_assistance[1]['purpose'])) ?></b> and currently 
                    experiencing financial difficulties due to rising inflation. 
                </p><br>
                <p>Issued this <?php echo date("jS")." day of ".date("F Y")  ?> at DSWD Field Office.
                </p>
            </div>
        </div>
        <div class="row" style="font-size: 24px;">
            <div class="col-6">                  
            </div>
            <div class="col-6">
                <input id="signatory" style="font-weight: bold; text-transform:uppercase; width:100%; border:none;" value="<?php echo ucwords(strtolower($soc_workFullname)) ?>"><br>
                <input id="s_position" style="border: none;width:100%;" value="<?php echo ucwords(strtolower($soc_worker['emp_position'])) ?>">
                License no: &nbsp; <input id="license" style="border: none; width: 50%;" value="<?php echo $soc_worker['sw_license_no'] ?>">
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