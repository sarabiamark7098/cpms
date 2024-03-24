<div id="GL" style="font-family: Arial;font-size: 24px; width:100%; margin-left: 118px; padding-right: 1100px; margin-top: 80px;">
    <br><br>
    <div style="">
        <br><br><br>
        <div class="container" style="">

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
                <div class="col-5 ml-auto text-right">
                    <p style="text-transform:uppercase; font-size:22px;">Control No: <span id="number"><?php echo $gl['control_no']?></span></p>
                </div>
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
                    '.(strtolower($client['sex'])=='male'?'He is': 'She is').' a resident of '. ucwords(strtolower($c_add)) .' for '. (strtolower($client['sex'])=='male'?'his': 'her') .' '. $client_assistance[1]['type'] .' in '. ucwords(strtolower($gl['cname'])) .'. </p>';

                    echo '<p class="">This guarantee letter is valid within 30 days upon receipt by the client and is not convertible to cash.</p>';
                    echo '<p class="">Please be informed that the check is payable to your institution upon receipt of the Statement of Account.</p>';
                    echo '<p class="">Should you have further inquiries, you may coordinate with DSWD FO XI Crisis Intervention Section with the telephone number 2271964 local 425</p>';
                }else{
                    echo '<p class="">This is to inform you that the Department of Social Welfare and Development Field Office XI (DSWD FO XI) guarantee to pay the amount of 
                    <b>'. $user->toWord($client_assistance[1]["amount"]) .' (Php'. $client_assistance[1]['amount'].')</b> as requested by <b>'.(strtolower($client['sex'])=='male'?'MR.': 'MS.').' '.strtoupper($name).'</b>. 
                    '.(strtolower($client['sex'])=='male'?'He is': 'She is').' a resident of '. ucwords(strtolower($c_add)) .' for the '. $client_assistance[1]['type'] .' of <b>'.(strtolower($client['b_sex'])=='male'?'MR.': 'MS.').' '.$bname.'</b> in '. ucwords(strtolower($gl['cname'])) .'. </p>';

                    echo '<p class="">This guarantee letter is valid within 30 days upon receipt by the client and is not convertible to cash.</p>';
                    echo '<p class="">Please be informed that the check is payable to your institution upon receipt of the Statement of Account.</p>';
                    echo '<p class="">Should you have further inquiries, you may coordinate with DSWD FO XI Crisis Intervention Section with the telephone number 2271964 local 425</p>';
                }
            ?>
            </div>

            <div class="row" style="margin-top:60px">
                <div class="col-md-5">
                    <p class="text-left">Very truly yours,</p><br>
                </div>
            </div>
            <br>
            <?php if(empty($gl['for_the_id'])){ ?>
            <div class="row">
                <div class="col-6">
                    <div style="height: 25px;width:100%; margin-bottom: 15px">
                        <input id="signatory" style="font-weight: bold;text-transform:uppercase;width:100%;border:none;" value="<?php echo strtoupper($signatoryGL['first_name']." ".(!empty($signatoryGL['middle_I'])?$signatoryGL['middle_I'].". ":"").$signatoryGL['last_name']) ?>"><br>
                        <input id="s_position" style="border: none;width:100%;" value="<?php echo $signatoryGL['position'] ?>"><br>
                        <b style="text-left">Date:</b> <input id="signatory" style="text-transform:capitalize;width:60%;border-bottom:1px solid #000000; " value="<?php echo date(" F j, Y ", strtotime($client['date_accomplished']))?>"><br>

                    </div>
                </div>
                <div class="col-6" style="position: absolute; margin-top:5%;"><br><br><br><br><br>
                    <span >Not valid without seal<span><br>
                </div>
            </div>
            <?php }else{ ?>
            <div class="row">
                <div class="col-6">
                    <div style="height: 150px;width:100%; margin-bottom: 15px">
                        <input id="signatory" style="font-weight: bold;text-transform:uppercase;width:100%;border:none;" value="<?php echo strtoupper($signatoryGL['first_name']." ".(!empty($signatoryGL['middle_I'])?$signatoryGL['middle_I'].". ":"").$signatoryGL['last_name']) ?>"><br>
                        <input id="s_position" style="border: none;width:100%;" value="<?php echo $signatoryGL['position'] ?>"><br><br>
                        For the <?php echo $forthepositiongl ?>,<br><br><br>

                        <input id="signatory" style="font-weight: bold;text-transform:uppercase;width:100%;border:none;" value="<?php echo strtoupper($signatoryforthe['first_name']." ".(!empty($signatoryforthe['middle_I'])?$signatoryforthe['middle_I'].". ":"").$signatoryforthe['last_name']) ?>"><br>
                        <input id="s_position" style="border: none;width:100%;" value="<?php echo $signatoryforthe['position'] ?>"><br>
                        <b style="text-left">Date:</b> <input id="signatory" style="text-transform:capitalize;width:60%;border-bottom:1px solid #000000; " value="<?php echo date(" F j, Y ", strtotime($client['date_accomplished']))?>"><br>

                    </div>
                </div>
                <div class="col-6" style="position: absolute; margin-top:18%;"><br><br><br><br><br>
                    <span>Not valid without seal<span><br>
                </div>
            </div><br>
            <?php } ?>
            <br>
            <br><br>
            <p class="cn " style="font-size:18Opx ">
                <br>
                <?php 
                //Mga initial ni diri buset
				$soc_worker = $user->getinitials($client['encoded_socialWork']);
				$encoder = $user->getinitials($client['encoded_encoder']);
				 echo '<small>'. strtoupper($GLsignatoryini) ."/". (!empty($COEsignatoryini)?strtoupper($COEsignatoryini) ."/":"") ."". (!empty($ft_signatoryini)?$ft_signatoryini."/":"") ."". strtolower($soc_worker) ."/". strtolower($encoder) .'</small>';
            ?>
            </p>
        </div>
        <br style="page-break-after:always ">
        <div style="page-break-after:always "></div>
        <div>&nbsp;</div>
        <br>
    </div>

</div>