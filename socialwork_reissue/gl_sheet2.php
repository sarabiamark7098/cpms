<?php
	if(!$_SESSION['login']){
		header('Location:../index.php');
		}

?>
<div id="GL" style="font-family: Times New Roman;font-size: 23px; page-break-after:always">
    <div style="font-size: 20px">
    <br>
    <div class="container" style="font-size: 20px">
		<br><br><br><br><br><br><br><br><br><br>
        <div class="row">
			<?php //kung walay addresse
				if($gl['addressee']==""){
					echo '<div class="col-7 mr-auto">
							<div>
								<p style="margin-bottom:-1px;text-transform: uppercase;"><b id="receiver">'. $gl['position'].'</b><br></p>
								<p style="margin:-1px;" id="position"></p>
							</div>
							<p style="margin:-1px" id="c_name">'. ucwords(strtolower($gl['cname'])) .'</p>
							<p id="c_add" style="margin-top:-1px" id="c_add">'. ucwords(strtolower($gl['caddress'])) .'</p>
						</div>';
				}else{
					echo '<div class="col-7 mr-auto">
							<div>
								<p style="margin-bottom:-1px;text-transform: uppercase;"><b id="receiver">'. $gl['addressee'].'</b><br></p>
								<p style="margin:-1px;" id="position">'. $gl['position'].'</p>
							</div>
							<p style="margin:-1px" id="c_name">'. ucwords(strtolower($gl['cname'])) .'</p>
							<p id="c_add" style="margin-top:-1px" id="c_add">'. ucwords(strtolower($gl['caddress'])) .'</p>
						</div>';
				}
				?>
			<div class="col-5 ml-auto text-right">
				<p>Control No: <?php echo strtoupper($client_assistance[1]['fund']);?>-<span id="number2"><?php echo $gl['control_no']?></span></p>
                <p><?php echo empty($dateexpiredcreatenew)?date("F j, Y",strtotime($client['date_accomplished'])):$dateexpiredcreatenew?></p>
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
                    <b>'. $user->toWord($client_assistance[2]["amount"]) .' (Php'. $client_assistance[2]['amount'] .')</b> requested by <b>'.strtoupper($coename).'</b>. 
                    This is intended for '. (strtolower($client['sex'])=='male'?'his': 'her') .' <b>'. strtoupper($client_assistance[2]['type']) .'</b>  from '. (strtoupper($address['client'])) .'.</p>';
                }else{
                    echo '<p class="first">The Department of Social Welfare and Development (DSWD) guarantees to pay the amount of 
                    <b>'. $user->toWord($client_assistance[2]["amount"]) .' (Php '. $client_assistance[2]['amount'] .')</b> requested by <b>'.strtoupper($coename).'</b>. 
                    This is intended for '. (strtolower($client['sex'])=='male'?'his': 'her') .' <b>'. strtoupper($client_assistance[2]['type']) .'</b>  from '. (strtoupper($address['beneficiary'])) .'.</p>';
                }
            ?>
        </div>
        
        <p class="first">Please be informed that the check is payable to your institution.</p>
        <p class="first">Thank you for your consideration.</p>
        <div class="row" style="margin-top:60px">
            <div class="col-md-3 ml-md-auto">
                <p class="text-right">Very truly yours,</p><br>
            </div>
        </div>
        <div class="row">
            <div class="col-4 ml-auto">
                <div style="border-bottom:1px solid #000000; height: 25px;width:100%; margin-bottom: 15px">
                    <p id="signatory" style="font-weight: bold;text-transform:uppercase" class="text-center"><?php echo $glsignatory['first_name'] ." ". $glsignatory['middle_I'] .". ". $glsignatory['last_name'] ?></p>
                </div>
                <div class="text-center">
                <p id="s_position" style="margin-top:-20px;margin-left:12%;padding-top:-15px" ><?php echo $glsignatory['position']?></p>
                </div>
            </div>
        </div>
        <br>
        <br><br>
        <p class="cn" style="font-size:18Opx">
            Valid within 30 days upon issuance and is not convertible to cash.
            <br><?php 
				$SignatureINI = $user->getsignatoryINI($signatory['signatory_id']);
				$socialWorkINI = $user->getencoderINI($client['encoded_socialWork']);
				$EncoderINI = $user->getencoderINI($client['encoded_encoder']);
				echo '<small>'.($CEINIAprroved!=""?strtoupper($CEINIAprroved).'/':""). strtoupper($SignatureINI).'/'. strtolower($socialWorkINI) .'/'. strtolower($EncoderINI) .'</small>';
            ?>
        </p> 
    </div>
	 <br style="page-break-after:always">
	 <div style="page-break-after:always"></div>
	 <div>&nbsp;</div>
	 </div>
</div>