<div id="GL" style="font-family: Times New Roman;font-size: 23px;">
<br><br><br><br><br><br><br><br>
    <div style="font-size: 20px">
    <br>
    <div class="container" style="font-size: 20px">
		
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
				<p style="text-transform:uppercase">Control No: <?php echo $client_assistance[1]['fund'];?>-<span id="number"><?php echo $gl['client_no']?></span></p>
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
                    <b>'. $user->toWord($client_assistance[1]["amount"]) .' (Php '. $client_assistance[1]['amount'].')</b> requested by <b>'.strtoupper($name).'</b>. 
                    This is intended for '. strtolower($sex) .' <b>'. strtoupper($client_assistance[1]['type']) .'</b>  
                    from '. strtoupper($c_add) .'.</p>';
                }else{
                    echo '<p class="first">The Department of Social Welfare and Development (DSWD) guarantees to pay the amount of 
                    <b>'. $user->toWord($client_assistance[1]["amount"]) .' (Php '. $client_assistance[1]['amount'].')</b> requested by <b>'.strtoupper($name).'</b>. 
                    This is intended for the <b>'. strtoupper($client_assistance[1]['type']) .'</b> of <b>'.$bname.'</b> from '. strtoupper($b_add) .'.</p>';
                }
            ?>
        </div>
        
        <p class="first">Please be informed that the check is payable to your institution.</p>
        <p class="first">Thank you for your consideration.</p>
        <div class="row" style="margin-top:60px">
            <div class="col-md-5 ml-md-auto">
                <p class="text-right" style="margin-right:25%;">Very truly yours,</p><br>
            </div>
        </div>
        <div class="row">
            <div class="col-5 ml-auto text-center">
                <div style="height: 25px;width:100%; margin-bottom: 15px">
                    <input class="text-center" id="signatory" style="font-weight: bold;text-transform:uppercase;width:100%;border-bottom:1px solid #000000; " value="<?php echo explode('-', $signatoryGLNamePos)[0] ?>"><br>
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
				$signatory = explode('-', $signatoryGLNamePos)[2];
				$soc_worker = $user->getencoderINI($client['encoded_socialWork']);
				$encoder = $user->getencoderINI($client['encoded_encoder']);
				 echo '<small>'. strtoupper($signatory) ."/". (!empty($COEsignatoryini)?strtoupper($COEsignatoryini) ."/":"") ."". strtolower($soc_worker) ."/". strtolower($encoder) .'</small>';
            ?>
        </p> 
    </div>
	 <br style="page-break-after:always">
	 <div style="page-break-after:always"></div>
	 <div>&nbsp;</div>
     <br>
    </div>
     
</div>  