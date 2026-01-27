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
<div id="GL" style="font-family: Arial;font-size: 24px; width:100%; margin-left: 118px; padding-right: 1100px; margin-top: 35px;">
    <br>
	
    <div style="">
        <div class="container">
			<div class="row">
				<div class="col-5">
				</div>
				<div class="col-7 ml-md-auto" style="color: #0000cc; text-align:right;">
					<b style="font-size: 29px; font-family: arial, sans-serif;" class="right"><br><p style="font-size: 17px; text-indent: 20px; margin-top: -10px;"></p></b>
				</div>
			</div><br>
			<div class="row" style="margin-bottom: 10px;">
				<div class="col-12">
                    <b style="font-size:24px;">GL No: </b><span id="number" style="text-transform:uppercase;"><?php echo $gl['control_no']?></span><br>
					<b style="text-left">Date:</b> <input id="signatory" style="text-transform:capitalize;width:60%;border-bottom:none; " value="<?php echo date(" F j, Y ", strtotime($client['date_accomplished']))?>">
					<br>
				</div>
			</div>
            <div class="row">
                <?php //kung walay addresse
                if($gl['addressee']==""){
                    echo '<div class="col-12 mr-auto">
                            <div>
                                <p style="margin-bottom:-1px;text-transform: uppercase; font-size: 25px;"><b id="receiver">'. $gl['position'].'</b><br></p>
                                <p style="margin:-1px; font-size: 23px;" id="position"></p>
                            </div>
                            <p style="margin:-1px; font-size: 20px;" id="c_name">'. ucwords(strtolower($gl['cname'])) .'</p>
                            <p id="c_add" style="margin-top:-1px; font-size: 20px;" id="c_add">'. ucwords(strtolower($gl['caddress'])) .'</p>
                        </div>';
                }else{
                    echo '<div class="col-12 mr-auto">
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
                       <p>Dear <b><?php echo (!empty($gl['to_mention'])?ucwords(strtolower($gl['to_mention'])):"Sir/Madam") ?></b>,</p>
                    <br>
                </div>
            </div>
            <div class="justify" style="font-family: Arial; font-size: 24px;">
                <?php   
                if(strtolower($client['relation']) == "self"){
                    /*echo '<p class="">The Department of Social Welfare and Development Field Office XI (DSWD FO XI) guarantees to pay the amount of 
                    <b>'. $user->toWord($client_assistance[1]["amount"]) .' (Php'. $client_assistance[1]['amount'].')</b> for <b>'.strtoupper($name).'</b> of '. ucwords(strtolower($c_add)) .' 
					for '. (strtolower($client['sex'])=='male'?'his': 'her') .' '. $client_assistance[1]['type'] .'. </p>';

                    echo '<p class="">Please be informed that the check is payable to your company. Should you have any query, you may coordinate with DSWD FO XI Crisis Intervention Section 
					with the telephone number 227-1964 local 1133.</p>';
					echo '<p class="">Thank you for your consideration.</p><br>';
					echo '<p class="">Valid within 7 days upon receipt.</p>';
					*/
					echo '<p class="">This has reference to the request for the <b>'. ucwords(strtolower($client_assistance[1]['type'])) .'</b> of herein client,
					<b>'.strtoupper($name).'</b>, from '. ucwords(strtolower($c_add)) .'.</p>';

                    echo '<p class="">The Department of Social Welfare and Development has assessed and validated the said request for assistance through the Crisis Intervention Section. 
					Thus, the Department is issuing this letter to guarantee the payment of the bill in the amount of <b>'. $user->toWord($client_assistance[1]["amount"]) .' (Php'. $client_assistance[1]['amount'].')</b>.</p>';
					
                    echo '<p class="">To facilitate the payment, please submit to the Crisis Intervention Section through CIS Finance Unit the following documents for the preparation of the
					Disbursement Voucher within one week after the service has been completed.</p>';
					
					echo "<p><input class='fas fa-check' type='input' style='height: 20px; width:20px; border: solid 1px black; border-radius: 40%;'> &emsp; Guarantee Letter (GL) from the DSWD with your company's 'received' stamp or 
                    signature over printed name of the authorize representative<br>
					<input class='fas fa-check' type='input' style='height: 20px; width:20px; border: solid 1px black; border-radius: 40%;'> &emsp; Statement of Accounts (SOA) or Billing Statement or Sales Invoice with corresponding 
                    operative technique of charge slip addressed to DSWD</p>";
					
					echo "<p>Please be informed that the payment will be directly deposited to your company's bank account. Should there be any query, you may coordinate with DSWD FO XI Crisis Intervention Section 
					with the telephone number 227-1964 local 1133.</p>";
					
                }else{
                    /*echo '<p class="">The Department of Social Welfare and Development Field Office XI (DSWD FO XI) guarantees to pay the amount of 
                    <b>'. $user->toWord($client_assistance[1]["amount"]) .' (Php'. $client_assistance[1]['amount'].')</b> for <b>'.strtoupper($name).'</b> of '. ucwords(strtolower($b_add)) .' 
					for '. $client_assistance[1]['type'] .' intended for <b>'.$bname.'</b>.</p>';

                    echo '<p class="">Please be informed that the check is payable to your company. Should you have any query, you may coordinate with DSWD FO XI Crisis Intervention Section 
					with the telephone number 227-1964 local 1133.</p>';
					echo '<p class="">Thank you for your consideration.</p><br>';
					echo '<p class="">Valid within 7 days upon receipt.</p>';
					*/
					echo '<p class="">This has reference to the request for the <b>'. ucwords(strtolower($client_assistance[1]['type'])) .'</b> of herein client,
					<b>'.strtoupper($name).'</b>, from '. ucwords(strtolower($c_add)) .', for his/her <b>'.ucwords(strtolower($client['relation'])).'</b> , <b>'.strtoupper($bname).'</b> of '. (($b_add!=$c_add)?ucwords(strtolower($b_add)):"the same address") .'.</p>';

                    echo '<p class="">The Department of Social Welfare and Development has assessed and validated the said request for assistance through the Crisis Intervention Section. 
					Thus, the Department is issuing this letter to guarantee the payment of the bill in the amount of <b>'. $user->toWord($client_assistance[1]["amount"]) .' (Php'. $client_assistance[1]['amount'].')</b>.</p>';
					
                    echo '<p class="">To facilitate the payment, please submit to the Crisis Intervention Section through CIS Finance Unit the following documents for the preparation of the
					Disbursement Voucher within one week after the service has been completed.</p>';
					
					echo "<p><input class='fas fa-check' type='input' style='height: 20px; width:20px; border: solid 1px black; border-radius: 40%;'> &emsp; Guarantee Letter (GL) from the DSWD with your company's 'received' stamp or 
                    signature over printed name of the authorize representative<br>
					<input class='fas fa-check' type='input' style='height: 20px; width:20px; border: solid 1px black; border-radius: 40%;'> &emsp; Statement of Accounts (SOA) or Billing Statement or Sales Invoice with corresponding 
                    operative technique of charge slip addressed to DSWD</p>";

					echo "<p>Please be informed that the payment will be directly deposited to your company's bank account. Should there be any query, you may coordinate with DSWD FO XI Crisis Intervention Section 
					with the telephone number 227-1964 local 1133.</p>";
                }
            ?>
            </div>

            <div class="row" style="margin-top:50px">
                <div class="col-5">
					<p class="text-left">Thank you for your consideration.</p>
                    <p class="text-left">Very truly yours,</p><br>
                </div>
				<div class="col-2">
                </div>
            <?php if(!empty($gl['for_the_id'])){ ?>
				<div class="col-4" style="padding-top: 60px;">
					For the <?php echo $forthepositiongl ?>,
                </div>
            <?php }?>
            </div>
            <?php if(empty($gl['for_the_id'])){ ?>
            <div class="row">
                <div class="col-6"><br>
					<input id="signatory" style="font-weight: bold;text-transform:uppercase;width:100%;border:none;" value="<?php echo strtoupper((!empty($signatoryGL["name_title"])?$signatoryGL['name_title'] ." ":""). strtoupper($signatoryGL['first_name'] ." ". (!empty($signatoryGL["middle_I"])?$signatoryGL['middle_I'] .". ":""). $signatoryGL['last_name'] ."-". $signatoryGL['position'])) ?>"><br>
					<input id="s_position" style="border: none;width:100%;" value="<?php echo (!empty($signatoryGL['position'])?$signatoryGL['position']:"") ?>"><br>
					<br>
					<p class="">Valid within 7 days upon receipt.</p>
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
                <div class="col-6"><br>
					<input id="signatory" style="font-weight: bold;text-transform:uppercase;width:100%;border:none;" value="<?php echo strtoupper((!empty($signatoryGL["name_title"])?$signatoryGL['name_title'] ." ":""). strtoupper($signatoryGL['first_name'] ." ". (!empty($signatoryGL["middle_I"])?$signatoryGL['middle_I'] .". ":""). $signatoryGL['last_name'] ."-". $signatoryGL['position'])) ?>"><br>
					<input id="s_position" style="border: none;width:100%;" value="<?php echo (!empty($signatoryGL['position'])?$signatoryGL['position']:"") ?>">
                </div>
                <div class="col-1"></div>
                <div class="col-5"><br>
					<input id="signatory" style="font-weight: bold;text-transform:uppercase;width:100%;border:none;" value="<?php echo strtoupper((!empty($signatoryforthe['name_title'])?$signatoryforthe['name_title']." ":"").$signatoryforthe['first_name']." ".(!empty($signatoryforthe['middle_I'])?$signatoryforthe['middle_I'].". ":"").$signatoryforthe['last_name']) ?>"><br>
					<input id="s_position" style="border: none;width:100%;" value="<?php echo $signatoryforthe['position'] ?>"><br>
                </div>
            </div><br>
			<p class="">Valid within 7 days upon receipt.</p>
            <p class="cn " style="font-size:18Opx ">
                <?php 
                //Mga initial ni diri buset
					echo $user->initials_gl($signatoryGL['signatory_tree'],$client['encoded_socialWork'],$client['encoded_encoder'],$signatoryGL['special_ini']);
				?>
            </p>
				<span>Not valid without seal<span><br>
            <?php } ?>
        </div>
        <br style="page-break-after:always ">
        <div style="page-break-after:always "></div>
        <div>&nbsp;</div>
        <br>
    </div>

</div>