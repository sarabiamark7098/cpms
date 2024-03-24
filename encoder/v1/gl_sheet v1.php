<style>
	@page {
		size: 8.5in 13in;
		margin: .10in /* change the margins as you want them to be. */
	}

	@media print{
		html, body {
			width: 210mm;
			height: 297mm;
		}
	}
</style>
<div id="GL" style="font-family: Arial;font-size: 24px; width:100%; margin-left: 118px; padding-right: 1100px; margin-top: 10px;">
    <br><br>
	
    <div style="">
        <div class="container">
			<div class="row">
				<div class="col-5">
				</div>
				<div class="col-7 ml-md-auto" style="color: #0000cc; text-align:right;">
					<b style="font-size: 29px; font-family: arial, sans-serif;" class="right">CRISIS INTERVENTION SECTION<br><p style="font-size: 17px; text-indent: 20px; margin-top: -10px;">Cor. Suazo St. R. Magsaysay Ave. Davao City</p></b>
				</div>
			</div>
			<div class="row">
				<div class="col-7">
					<br><br><br>
                    <p style="text-transform:uppercase; font-size:24px;">Control No: <span id="number"><?php echo $gl['control_no']?></span></p>
					<br>
					<b style="text-left">Date:</b> <input id="signatory" style="text-transform:capitalize;width:60%;border-bottom:none; " value="<?php echo date(" F j, Y ", strtotime($client["date_accomplished"]))?>">
					<br><br>
				</div>
				<div class="col-5 ml-md-auto" style="color: #0000cc; text-align:right;">
				</div>
			</div>
            <div class="row">
                <?php //kung walay addresse
                if($gl['addressee']==""){
                    echo '<div class="col-7 mr-auto">
                            <div>
                                <p style="margin-bottom:-1px;text-transform: uppercase; font-size: 25px;"><b id="receiver">'. $gl['position'].'</b><br></p>
                                <p style="margin:-1px; font-size: 23px;" id="position"></p>
                            </div>
                            <p style="margin:-1px; font-size: 20px;" id="c_name">'. ucwords(strtolower($gl['cname'])) .'</p>
                            <p id="c_add" style="margin-top:-1px; font-size: 20px;" id="c_add">'. ucwords(strtolower($gl['caddress'])) .'</p>
                        </div>';
                }else{
                    echo '<div class="col-7 mr-auto">
                            <div>
                                <p style="margin-bottom:-1px;text-transform: uppercase; font-size: 25px;"><b id="receiver">'. $gl['addressee'].'</b><br></p>
                                <p style="margin:-1px; font-size: 23px;" id="position">'. $gl['position'].'</p>
                            </div>
                            <p style="margin:-1px; font-size: 20px;" id="c_name">'. ucwords(strtolower($gl['cname'])) .'</p>
                            <p id="c_add" style="margin-top:-1px; font-size: 20px;" id="c_add">'. ucwords(strtolower($gl['caddress'])) .'</p>
                        </div>';
                }
                ?>
                
            </div>
            <div class="row">
                <div class="col-auto mr-auto">
                    <br class="ubos">
                    <br>
                       <p>Dear <b><?php echo (!empty($gl['to_mention'])?ucwords(strtolower($gl['to_mention'])):"Sir/Madam") ?></b>,</p>
                    <br>
                </div>
            </div>
            <div class="justify" style="font-family: Arial; font-size: 24px;">
                <?php   
                if(strtolower($client['relation']) == "self"){
                    echo '<p class="">This is to inform you that the Department of Social Welfare and Development Field Office XI (DSWD FO XI) guarantee to pay the amount of 
                    <b>'. $user->toWord($client_assistance[1]["amount"]) .' (Php'. $client_assistance[1]['amount'].')</b> as requested by <b>'.(strtolower($client['sex'])=='male'?'MR.': 'MS.').' '.strtoupper($name).'</b>. 
                    '. (strtolower($client['sex'])=='male'?'He is': 'She is') .' a resident of '. ucwords(strtolower($c_add)) .' for '. (strtolower($client['sex'])=='male'?'his': 'her') .' '. $client_assistance[1]['type'] .' in '. ucwords(strtolower($gl['cname'])) .'. </p>';

                    echo '<p class="">Please be informed that the check is payable to your company. Should you have any query, you may coordinate with DSWD FO XI Crisis Intervention Section with the telephone number 2271964 local 425</p>';
					echo '<p class="">Valid within 30 days upon receipt.</p>';
                }else{
                    echo '<p class="">This is to inform you that the Department of Social Welfare and Development Field Office XI (DSWD FO XI) guarantee to pay the amount of 
                    <b>'. $user->toWord($client_assistance[1]["amount"]) .' (Php'. $client_assistance[1]['amount'].')</b> as requested by <b>'.(strtolower($client['sex'])=='male'?'MR.': 'MS.').' '.strtoupper($name).'</b>. 
                    '. (strtolower($client['sex'])=='male'?'He is': 'She is') .' a resident of '. ucwords(strtolower($b_add)) .' for the '. $client_assistance[1]['type'] .' of <b>'.(strtolower($client['b_sex'])=='male'?'MR.': 'MS.').' '.$bname.'</b> in '. ucwords(strtolower($gl['cname'])) .'. </p>';

                    echo '<p class="">Please be informed that the check is payable to your company. Should you have any query, you may coordinate with DSWD FO XI Crisis Intervention Section with the telephone number 2271964 local 425</p>';
                }
            ?>
            </div>

            <div class="row" style="margin-top:60px">
                <div class="col-md-5">
                    <p class="text-left">Very truly yours,</p><br>
                </div>
            </div>
            <br>
			<div class="row">
                <div class="col-6">
					<input id="Social_W" style="font-weight: bold;text-transform:uppercase;width:100%;border:none;" value="<?php echo $soc_workFullname ?>"><br>
					<input id="SW_position" style="border: none;width:100%;" value="Social Worker">                  
                </div>
                <div class="col-1"></div>
                <div class="col-5">
				</div>
            </div><br>
            <?php if(empty($gl['for_the_id'])){ ?>
            <div class="row">
                <div class="col-6">
					Approved by:<br><br><br>
                        <input id="signatory" style="font-weight: bold;text-transform:uppercase;width:100%;border:none;" value="<?php echo strtoupper((!empty($signatoryGL['name_title'])?$signatoryGL['name_title']." ":"").$signatoryGL['first_name']." ".(!empty($signatoryGL['middle_I'])?$signatoryGL['middle_I'].". ":"").$signatoryGL['last_name']) ?>"><br>
                        <input id="s_position" style="border: none;width:100%;" value="<?php echo $signatoryGL['position'] ?>"><br>
						<br>
						<p class="cn " style="font-size:18Opx ">
							<?php 
								echo $user->initials_gl($signatoryGL['signatory_tree'],$client['encoded_socialWork'],$client['encoded_encoder'],$signatoryGL['special_ini']);
							?>
						</p>
                    <span >Not valid without seal<span><br>
                </div>
            </div>
            
            <?php }else{ ?>
            <div class="row">
                <div class="col-6">
					Approved by:<br><br><br>
					<input id="signatory" style="font-weight: bold;text-transform:uppercase;width:100%;border:none;" value="<?php echo strtoupper((!empty($signatoryGL['name_title'])?$signatoryGL['name_title']." ":"").$signatoryGL['first_name']." ".(!empty($signatoryGL['middle_I'])?$signatoryGL['middle_I'].". ":"").$signatoryGL['last_name']) ?>"><br>
					<input id="s_position" style="border: none;width:100%;" value="<?php echo $signatoryGL['position'] ?>">                  
                </div>
                <div class="col-1"></div>
                <div class="col-5">
					For the <?php echo $forthepositiongl ?>,<br><br><br>

					<input id="signatory" style="font-weight: bold;text-transform:uppercase;width:100%;border:none;" value="<?php echo strtoupper((!empty($signatoryforthe['name_title'])?$signatoryforthe['name_title']." ":"").$signatoryforthe['first_name']." ".(!empty($signatoryforthe['middle_I'])?$signatoryforthe['middle_I'].". ":"").$signatoryforthe['last_name']) ?>"><br>
					<input id="s_position" style="border: none;width:100%;" value="<?php echo $signatoryforthe['position'] ?>"><br>

                </div>
            </div><br>
            <p class="cn " style="font-size:18Opx ">
                <?php 
                //Mga initial ni diri buset
					echo $user->initials_gl($signatoryGL['signatory_tree'],$client['encoded_socialWork'],$client['encoded_encoder'],$signatoryGL['special_ini']);
				?>
				<br><br>
				<span>Not valid without seal<span><br>
            </p>
            <?php } ?>
        </div>
        <br style="page-break-after:always ">
        <div style="page-break-after:always "></div>
        <div>&nbsp;</div>
        <br>
    </div>

</div>