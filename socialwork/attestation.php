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
    <div class="container" id="attestation_v1print" style="font-size:12px; padding:0%; font-family: Arial: sans-serif;">
        
        <!--HEADER-->
        <div class="row" style="margin-top:0px">
            <div class="col-6">
                <img src="../images/dswd_olog.png" alt="" width="230px" height="60px">
                <img src="../images/AICS.png" alt="" width="70px" height="60px">
                <img src="../images/BP.png" alt="" width="70px" height="60px">
            </div>
            <div class="col-6 ml-md-auto" style="color: #000000; ">
                <p class="text-center" style="font-size: 14px; font-family: arial, sans-serif; margin-top: -40px;">DSWD-PMB-GF-015 | REV 02 | 08 JAN 2024</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12" style="text-align: center; margin-top: -15px">
                <b style="font-size: 30px">CERTIFICATE OF ATTESTATION</b>                
            </div>
        </div>
        <div class="row"> 
            <div class="col-7 mr-auto">
                <div id="">
                    <p style="margin-bottom:-1px;text-transform: uppercase;"><b id="receiver"></b><br></p>
                    <p style="margin:-1px;" id="position"></p>
                </div>
                <p style="margin:-1px" id="c_name"></p>
                <p id="c_add" style="margin-top:-1px" id="c_add"></p>
            </div>
			<div class="col-5 ml-auto text-right">
				<p style="text-transform:uppercase">Control No: <?php echo $client_assistance[1]['fund'];?>-<span id="number"><?php echo $gl['control_no']?></span></p>
				<p><?php echo date("F j, Y")?></p>
			</div>
        </div>
        <div class="row">
            <div class="col-auto mr-auto">
                    <br class="ubos">    
                    <p>Dear <b>Sir/Madam</b>:</p>
            </div>
        </div>
        <div class="justify">
            <?php   
                if(strtolower($client['relation']) == "self"){
                    echo '<p class="first">The Department of Social Welfare and Development (DSWD) guarantees to pay the amount of 
                    <b>'. $user->toWord($client_assistance[2]["amount"]) .' (Php '. $client_assistance[2]['amount'].')</b> requested by <b>'.strtoupper($name).'</b>. 
                    This is intended for '. strtolower($sex) .' <b>'. strtoupper($client_assistance[2]['type']) .'</b>  
                    from '. strtoupper($c_add) .'.</p>';
                }else{
                    echo '<p class="first">The Department of Social Welfare and Development (DSWD) guarantees to pay the amount of 
                    <b>'. $user->toWord($client_assistance[2]["amount"]) .' (Php '. $client_assistance[2]['amount'].')</b> requested by <b>'.strtoupper($name).'</b>. 
                    This is intended for the <b>'. strtoupper($client_assistance[2]['type']) .'</b> of <b>'.$bname.'</b> from '. strtoupper($b_add) .'.</p>';
                }
            ?>
        </div>
        
        <p class="first">Please be informed that the check is payable to your institution.</p>
        <p class="first">Thank you for your consideration.</p>
        <div class="row" style="margin-top:60px">
            <div class="col-md-3 ml-md-auto">
                <p class="text-right" style="margin-right:20%;">Very truly yours,</p><br>
            </div>
        </div>
        <div class="row">
            <div class="col-4 ml-auto text-center">
                <div style="border-bottom:1px solid #000000; height: 25px;width:100%; margin-bottom: 15px">
                <input class="text-center" id="signatory" style="font-weight: bold;text-transform:uppercase;width:100%;border-bottom:1px solid #000000; " value="<?php echo strtoupper($signatoryGL['first_name']." ".$signatoryGL['middle_I'].". ".$signatoryGL['last_name']) ?>"><br>
                    <input class="text-center" id="s_position" style="border: none;width:100%;" value="<?php echo $signatoryGL['position'] ?>">
                </div>
            </div>
        </div>
        <br>
        <br><br>
        <p class="cn" style="font-size:18Opx">
            Valid within 30 days upon issuance and is not convertible to cash.
            <br><?php 
                //Mga initial ni diri buset
				$soc_worker = $user->getinitials($client['encoded_socialWork']);
				$encoder = $user->getinitials($client['encoded_encoder']);
				 echo '<small>'. strtoupper($GLsignatoryini) ."/". (!empty($COEsignatoryini)?strtoupper($COEsignatoryini) ."/":"") ."". strtolower($soc_worker) ."/". strtolower($encoder) .'</small>';
            ?>
        </p><br><br>
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