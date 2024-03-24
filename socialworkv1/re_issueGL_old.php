<div id="GL" style="font-family: Times New Roman;font-size: 23px;">
<br><br><br><br><br><br><br><br>
    <div style="font-size: 20px">
    <br>
    <div class="container" style="font-size: 20px">
		
        <div class="row"> 
            <div class="col-7 mr-auto">
                <div id="">
                    <p style="margin-bottom:-1px;text-transform: uppercase;"><b id="receiver"><?php echo (!empty($gl['addressee'])? $gl['addressee']:$gl['position'] ) ?></b><br></p>
                    <p style="margin:-1px;" id="position"><?php echo (!empty($gl['addressee'])? $gl['position']:"");?></p>
                </div>
                <p style="margin:-1px" id="c_name"><?php echo $gl['cname']?></p>
                <p id="c_add" style="margin-top:-1px" id="c_add"><?php echo $gl['caddress']?></p>
            </div>
			<div class="col-5 ml-auto text-right">
				<p style="text-transform:uppercase">Control No: <?php echo empty($fundsourcedata[1]['fundsource'])? "" : (empty($fundsourcedata[2]['fundsource'])?$fundsourcedata[1]['fundsource']:$fundsourcedata[1]['fundsource'].'/'.$fundsourcedata[2]['fundsource'].''.(!empty($fundsourcedata[3]['fundsource'])?'/'.$fundsourcedata[3]['fundsource']:"").''.(!empty($fundsourcedata[4]['fundsource'])?'/'.$fundsourcedata[4]['fundsource']:"").''.(!empty($fundsourcedata[5]['fundsource'])?'/'.$fundsourcedata[5]['fundsource']:"")) ?>-<span id="number"><?php echo $gl['control_no']; ?></span></p>
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
            <div class="col-md-3 ml-md-auto">
                <p class="text-right" style="margin-right:20%;">Very truly yours,</p><br>
            </div>
        </div>
        <div class="row">
            <div class="col-4 ml-auto text-center">
                <div style="border-bottom:1px solid #000000; height: 25px;width:100%; margin-bottom: 15px">
                    <p id="signatory" style="font-weight: bold;text-transform:uppercase"><?php echo explode('-', $signatoryGLNamePos)[0]?></p>
                    <p id="s_position" style="margin-top:-20px;margin-left:12%;padding-top:-15px" ><?php echo $signatoryGL['position']?></p>
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
				 echo '<small>'. $signatory ."/". $soc_worker ."/". $encoder .'</small>';
            ?>
        </p> 
    </div>
	 <br style="page-break-after:always">
	 <div style="page-break-after:always"></div>
	 <div>&nbsp;</div>
     <br>
    </div>
     
</div>  