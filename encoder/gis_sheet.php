<?php
	if(!$_SESSION['login']){
		header('Location:../index.php');
		}

?>

<div class="container" id="gis_sheet" style="font-size:12px; page-break-after:always">
		        
    <!--HEADER-->
	<br><br>
    <div class="row">
        <div class="col"><img src="../images/dswd_olog.png" alt="" width="150px" height="70px"></div>
        <div class="col-6 col-md-auto" style="text-align: center;">
            <br><b style="font-size: 15px">GENERAL INTAKE SHEET</b>
            <p style="font-size: 15px">Crisis Intervention Unit</p>
        </div>
        <div class="col ml-md-auto"><img  class="right" src="../images/maagap_logo.png" alt="" width="150px" height="70px"></div>
    </div>
	<hr style="margin-bottom: -1px; margin-top: -15px;margin-bottom: 3px">
        <!--PETSA-->
    <div class="row" style="font-size: 13px; margin-top: -5px">
        <div class="col-sm-2 center"><p class="text-center" >Petsa Ngayon<br>(Date Today)</p> 
        </div>
        <div class="col-sm-2"><input class="form-control input-lg border-dark" type="text" height="80px" value='<?php echo date("Y-m-d" , strtotime($client['date_entered']))?>'>
        </div>
        <div class="col-sm-2" ><p class="text-center">Oras ng Pagpasok:<br>(Time of Entry)</p></div>
        <div class="col-sm-2" ><input class="form-control input-lg border-dark" type="text" value="<?php echo $timeentry ?>"></div>
        <div class="col-sm-2" ><p class="text-center">Bilang ng<br>kliyente:</p></div>
        <div class="col-sm-2" style="margin-top:5px"><div style="border:1px solid #000000;height: 40px;width:100%"><p id="theNum" class="text-center" style="font-size:20px"><?php echo $client['client_num']?></p></div></div>
    </div>
    <!---->
    <p class="header" style="margin-top: -10px; margin-left:-15px">&emsp; IMPORMASYON UKOL SA KLIYENTE (Client's Identifying Information)</p>
        <!--PANGALAN-->
    <div class="row" style="margin-top: -5px;font-size: 12px">
        <div class="col-sm-1" style="margin-top: -10px;"><p class="text-left">PANGALAN: <br>(Name)</p></div>
        <div class="col-sm-11" style="margin-top: -10px;"> <input type="text" class="form-control input-lg border-dark" value="<?php echo $name;?>"></div>
    </div>
    <div class="row" style="font-size: 10px; margin-top: -18px;">
        <div class="col-sm-2 col-xs-1"></div>
        <div class="col-sm-3 col-xs-3" >&emsp;&emsp;Apelyido</div>
        <div class="col-sm-3 col-xs-3" >Unang Pangalan</div>
        <div class="col-sm-2 col-xs-3" >Gitnang Pangalan</div>
        <div class="col-sm-2 col-xs-2" >Extension Name</div>
    </div>
    <div class="row" style="font-size: 10px;margin-top: -10px;">
        <div class="col-sm-2 col-xs-1"></div>
        <div class="col-sm-3 col-xs-3" >&emsp;(Last Name)</div>
        <div class="col-sm-3 col-xs-3" >(First Name)</div>
        <div class="col-sm-2 col-xs-3" >(Middle Name)</div>
        <div class="col-sm-2 col-xs-2" >&emsp;&emsp;(Jr/Sr)</div>
    </div>
    <!--KAPANAKAN-->
    <div class="row" style="margin-top: 4px;font-size:12px">
        <div class="col-sm-2">
            <p>PETSA NG KAPANGANAKAN</p><div class="w-100"></div><p style=
            "font-size: 12px;margin-top: -15px;">(Birthday)</p>
        </div>
        <div class="col-sm-3"><input type="text" class="form-control input-lg border-dark" value="<?php echo $client['date_birth'];?>"></div>
        <div class="col-sm-1"><p class="text-center">EDAD<br>Age</p></div>
        <div class="col-sm-2"><input type="text" class="form-control input-lg border-dark" value="<?php echo $clientAge; ?>"></div>
        <div class="col-sm-1"><p class="text-center">KASARIAN<br>(SEX)</p></div>
        <div class="col-sm-1">
        <?php 
            if(strtolower($client['sex']) == "male"){
                 echo '<input type="text" class="form-control input-sm border-dark text-center" style="height:20px" value=" &#x2714;">
                        <input type="text" class="form-control input-sm border-dark text-center" style="height:20px">';
            }elseif(strtolower($client['sex']) == "female"){
                 echo '<input type="text" class="form-control input-sm border-dark text-center" style="height:20px">
                <input type="text" class="form-control input-sm border-dark text-center" style="height:20px" value=" &#x2714;">';
            }
        ?>
        </div>
        <div class="col-sm-1"><p>Male<br>Female</p></div>
    </div>
    <!--CONTACT-->
    <div class="row" style="font-size: 12px; margin-top:-10px">
        <div class="col-sm-1"><p>CONTACT<br>NUMBER</p></div>
        <div class="col-sm-3"><input type="text" class="form-control input-lg border-dark"value="<?php echo $client["contact"] ?>"></div>
        <div class="col-sm-2"><p class="text-right" style="font-size:10px">STATUS SIBIL<br>Civil Status</p></div>
        <div class="col-sm-1">
            <input type="text" class="form-control input-sm border-dark text-center" style="height:20px" value="<?php echo (strtolower($client["civil_status"]) == 'single'? ' &#x2714;' : '' ); ?>">
            <input type="text" class="form-control input-sm border-dark text-center" style="height:20px" value="<?php echo (strtolower($client["civil_status"]) == 'married'? ' &#x2714;' : '' ); ?>">
        </div>
        <div class="col-sm-1"><p>SINGLE<br>MARRIED</p></div>
        <div class="col-sm-1"></div>
        <div class="col-sm-1">
            <input type="text" class="form-control input-sm border-dark text-center" style="height:20px" value="<?php echo (strtolower($client["civil_status"]) == 'widow/widower'? ' &#x2714;' : '' ); ?>">
            <input type="text" class="form-control input-sm border-dark text-center" style="height:20px" value="<?php echo (strtolower($client["civil_status"]) == 'common-law' || strtolower($client["b_civilStatus"]) == 'separated'? '&#x2714;' : '' ); ?>">
    </div>
        <div class="col-sm-1"><p>Widower/er<br>Others</p></div>

    </div>
    <!--RELASYON-->
    <div class="row" style="font-size: 12px;margin-top:-8px">
        <div class="col-sm-3"><p>RELASYON SA BENEPISYARYO<br>(Relationship to Beneficiary)</p></div>
        <div class="col-sm-9"><input type="text" class="form-control input-lg border-dark" value="<?php echo $client["relation"]?>"></div>
    </div>
    <!--TIRAHAN-->
    <div class="row" style="margin-top: -10px;font-size: 12px">
        <div class="col-sm-1" ><p class="text-left">TIRAHAN: <br>(Address)</p></div>
        <div class="col-sm-11"> <input type="text" class="form-control input-lg border-dark" value="<?php echo $address['client']?>"></div>
    </div>
    <div class="row" style="margin-top: -10px;font-size: 12px">
            <div class="col-sm-2 col-xs-1"></div>
            <div class="col-sm-3 col-xs-3" >&emsp;&emsp;No./Street/Purok</div>
            <div class="col-sm-3 col-xs-3">Barangay</div>
            <div class="col-sm-2 col-xs-3">Municipality</div>
            <div class="col-sm-2 col-xs-2">Province</div>
    </div>
    <!--TRABAHO-->
    <div class="row" style="font-size: 12px">
        <div  class="col-sm-1"><p>TRABAHO<br>(Occupation)</p></div>
        <div  class="col-sm-5"><input type="text" class="form-control input-lg border-dark" value="<?php echo $client["occupation"] ?>"></div>
        <div  class="col-sm-2"><p>SWELDO: &emsp;(Salary) </p></div>
        <div  class="col-sm-4"><input type="text" class="form-control input-lg border-dark" value="<?php echo $client["salary"] ?>"></div>
    </div>

    <!--BENEFICIARY INFO-->
    <p class="header" style="margin-top: -10px; margin-left: -15px">&emsp; IMPORMASYON UKOL SA BENEPISYARYO (Beneficiary's Identifying Information)</p>
    <!--PANGALAN-->
    <div class="row" style="margin-top: -5px;font-size: 12px">
        <div class="col-sm-1" style="margin-top: -10px;"><p class="text-left">PANGALAN: <br>(Name)</p></div>
        <div class="col-sm-11" style="margin-top: -10px;"> <input type="text" class="form-control input-lg border-dark" value="<?php echo ($client["relation"] == 'Self'? '' : $bname); ?>"></div>
    </div>
    <div class="row" style="font-size: 12px;margin-top: -18px;">
        <div class="col-sm-2 col-xs-1"></div>
        <div class="col-sm-3 col-xs-3" >&emsp;&emsp;Apelyido</div>
        <div class="col-sm-3 col-xs-3" >Unang Pangalan</div>
        <div class="col-sm-2 col-xs-3" >Gitnang Pangalan</div>
        <div class="col-sm-2 col-xs-2" >Extension Name</div>
    </div>
    <div class="row" style="font-size: 12px;margin-top: -10px;">
        <div class="col-sm-2 col-xs-1"></div>
        <div class="col-sm-3 col-xs-3" >&emsp;(Last Name)</div>
        <div class="col-sm-3 col-xs-3" >(First Name)</div>
        <div class="col-sm-2 col-xs-3" >(Middle Name)</div>
        <div class="col-sm-2 col-xs-2" >&emsp;&emsp;(Jr/Sr)</div>
    </div>
    <!--KAPANAKAN-->
    <div class="row" style="margin-top: 4px">
        <div class="col-sm-2">
            <p style="font-size:15px">Petsa ng Kapanakan</p><div class="w-100"></div><p style=
            "font-size: 12px;margin-top: -15px;">(Birthday)</p>
        </div>
        <div class="col-sm-3"><input type="text" class="form-control input-lg border-dark" value="<?php echo ($client["relation"] == 'Self'? '' : $client['b_bday']);?>"></div>
        <div class="col-sm-1"><p class="text-center">EDAD<br>Age</p></div>
        <div class="col-sm-2"><input type="text" class="form-control input-lg border-dark" value="<?php echo ($client["relation"] == 'Self'? '' : $beneAge);?>"></div>
        <div class="col-sm-1"><p class="text-center">KASARIAN<br>(SEX)</p></div>
        <div class="col-sm-1">
        <?php 
            if($client["relation"] != 'Self'){
                if(strtolower($client['b_sex']) == "male"){
                    echo '<input type="text" class="form-control input-sm border-dark text-center" style="height:20px" value=" &#x2714;">
                            <input type="text" class="form-control input-sm border-dark text-center" style="height:20px">';
                }else{
                    echo '<input type="text" class="form-control input-sm border-dark text-center" style="height:20px">
                    <input type="text" class="form-control input-sm border-dark text-center" style="height:20px" value=" &#x2714;">';
                }
            }else{
                echo "";
            }
        ?>
        </div>
        <div class="col-sm-1"><p>Male<br>Female</p></div>
    </div>
    <!--CONTACT-->
    <div class="row" style="font-size: 13px; margin-top: -10px">
        <div class="col-sm-1"><p>CONTACT<br>NUMBER</p></div>
        <div class="col-sm-3"><input type="text" class="form-control input-lg border-dark" value="<?php echo ($client["relation"] == 'Self'? '' : $client['b_contact']);?>"></div>
        <div class="col-sm-2"><p class="text-right" style="font-size:12px">STATUS SIBIL<br>Civil Status</p></div>
        <div class="col-sm-1">
            <input type="text" class="form-control input-sm border-dark text-center" style="height:20px" value="<?php echo ($client["relation"] == 'Self'? '' : strtolower($client["b_civilStatus"]) == 'single'? ' &#x2714;' : ''); ?>">
            <input type="text" class="form-control input-sm border-dark text-center" style="height:20px" value="<?php echo ($client["relation"] == 'Self'? '' : strtolower($client["b_civilStatus"]) == 'married'? ' &#x2714;' : ''); ?>">
        </div>
        <div class="col-sm-1"><p>SINGLE<br>MARRIED</p></div>
        <div class="col-sm-1"></div>
        <div class="col-sm-1">
            <input type="text" class="form-control input-sm border-dark text-center" style="height:20px" value="<?php echo ($client["relation"] == 'Self'? '' : strtolower($client["b_civilStatus"]) == 'widow/widower'? ' &#x2714;' : ''); ?>">
            <input type="text" class="form-control input-sm border-dark text-center" style="height:20px" value="<?php echo ($client["relation"] == 'Self'? '' : strtolower($client["b_civilStatus"]) == 'common-law' || strtolower($client["b_civilStatus"]) == 'separated'? '&#x2714;' : '' ); ?>">
    </div>
        <div class="col-sm-1"><p>Widower/er<br>Others</p></div>

    </div>
    <!--TIRAHAN-->
    <div class="row" style="margin-top: -10px;font-size: 12px">
        <div class="col-sm-1" ><p class="text-left">TIRAHAN: <br>(Address)</p></div>
        <div class="col-sm-11"> <input type="text" class="form-control input-lg border-dark" value="<?php echo ($client["relation"] == 'Self'? '' : $address['beneficiary'] );?>"></div>
    </div>
    <div class="row" style="margin-top: -12px;font-size: 12px">
        <div class="col-sm-2 col-xs-1"></div>
        <div class="col-sm-3 col-xs-3" >&emsp;&emsp;No./Street/Purok</div>
        <div class="col-sm-3 col-xs-3">Barangay</div>
        <div class="col-sm-2 col-xs-3">Municipality</div>
        <div class="col-sm-2 col-xs-2">Province</div>
    </div>
    <!--KOMPOSISYON SA PAMILYA:-->
    <b style="border-top: -5px; font-size: 14px">KOMPOSISYON SA PAMILYA: </b>
    <table style="width:100%; font-size: 13px">
        <tr>
            <th width="40%" height="20">Pangalan</th>
            <th width="5%" height="20">Edad</th>
            <th width="40%" height="20">Trabaho</th>
            <th width="10%" height="20">Buwanang Sahod</th>
        </tr>
        <tr>
            <td height="20"><p style="font-size:13px; margin: 0; padding:0;" id='pangan1'><?php echo empty($client_fam[1])? "":$client_fam[1]['name']; ?></p></td>
            <td height="20"><p class="text-center" style="font-size:13px; margin: 0; padding:0;" id='edad1'><?php echo empty($client_fam[1])? "":$client_fam[1]['age']?></p></td>
            <td height="20"><p class="text-center" style="font-size:13px; margin: 0; padding:0;" id='trabaho1'><?php echo empty($client_fam[1])? "":$client_fam[1]['occupation']?></p></td>
            <td height="20"><p class="text-center" style="font-size:13px; margin: 0; padding:0;" id='sahod1'><?php echo empty($client_fam[1])? "":$client_fam[1]['salary']?></p></td>
        </tr>
        <tr>
            <td height="20"><p style="font-size:13px; margin: 0; padding:0;" id='pangan2'><?php echo empty($client_fam[2])? "":$client_fam[2]['name']?></p></td>
            <td height="20"><p class="text-center" style="font-size:13px; margin: 0; padding:0;" id='edad2'><?php echo empty($client_fam[2])? "":$client_fam[2]['age']?></p></td>
            <td height="20"><p class="text-center" style="font-size:13px; margin: 0; padding:0;" id='trabaho2'><?php echo empty($client_fam[2])? "":$client_fam[2]['occupation']?></p></td>
            <td height="20"><p class="text-center" style="font-size:13px; margin: 0; padding:0;" id='sahod2'><?php echo empty($client_fam[2])? "":$client_fam[2]['salary']?></p></td>
        </tr>
        <tr>
            <td height="20"><p style="font-size:13px; margin: 0; padding:0;" id='pangan3'><?php echo empty($client_fam[3])? "":$client_fam[3]['name']?></p></td>
            <td height="20"><p class="text-center" style="font-size:13px; margin: 0; padding:0;" id='edad3'><?php echo empty($client_fam[3])? "":$client_fam[3]['age']?></p></td>
            <td height="20"><p class="text-center" style="font-size:13px; margin: 0; padding:0;" id='trabaho3'><?php echo empty($client_fam[3])? "":$client_fam[3]['occupation']?></p></td>
            <td height="20"><p class="text-center" style="font-size:13px; margin: 0; padding:0;" id='sahod3'><?php echo empty($client_fam[3])? "": $client_fam[3]['salary'] ?></p></td>
        </tr>
    </table>
    <hr style="margin-top: 4px">
    <!--Client Category-->
    <div class="row" style="margin-top: -10px; font-size: 12px">
        <div class="col-sm-3">CLIENT'S CATEGORY</div>
        <div class="col-sm-3"><input type="text" style="font-size:10px;" class="form-control input-lg border-dark" value="<?php echo $client["category"] ?>"></div>
        <div class="col-sm-3"><p class="text-right">Sub-Category</p></div>
        <div class="col-sm-3"><input type="text" class="form-control input-lg border-dark" value="<?php echo $client["subCategory"] ?>"></div>
    </div>
    <div class="row" style="font-size: 12px">
        <div class="col-sm-3">BENEFICIARY'S CATEGORY</div>
        <div class="col-sm-3"><input type="text" style="font-size:10px;" class="form-control input-lg border-dark" value="<?php echo ($client["relation"] == 'Self'? '' : $client['b_category']);?>"></div>
        <div class="col-sm-3"><p class="text-right">Sub-Category</p></div>
        <div class="col-sm-3"><input type="text" class="form-control input-lg border-dark" value="<?php echo ($client["relation"] == 'Self'? '' : $client['b_subCategory']);?>"></div>
    </div>
    <!--ASSESSMENT-->
    <br><p style="margin:-1px;font-size: 14px;margin-top: -15px">ASSESSMENT (Use addtional sheets as neccessary)</p>
    <div style="border:1px solid #000000; height: 80px; width: 100%">
        <b style="font-size: 12px">&nbsp;PROBLEM PRESENTED</b><br>
        <textarea id="problem" class="no-border" style="height:60px;width: 100%;font-size:12px;"><?php echo $client['problem']?></textarea>
    </div><br>
    <div style="border:1px solid #000000; height: 100px; width: 100%;margin-top: -20px">
        <b style="font-size: 12px">&nbsp;SOCIAL WORKER'S ASSESSMENT</b>
        <textarea id="soc_ass" class="no-border" style="height:80px;width: 100%;font-size:12px;"><?php echo $client['soc_ass']?></textarea>
    </div>
    <br><p style="font-size: 12px;margin-top:-20px;margin-bottom:4px"><b>RECOMMENDED SERVICE AND ASSISTANCE</b></p>
    <div class="row" style="margin-left: 2px;margin-bottom: 5px;font-size: 12px">
        <div class="col-sm-3"><input id="psychosocial" type="checkbox" <?php echo ($gis['service1']==1?'checked':'') ?>>&emsp; Psychosocial Support</div>
        <div class="col-sm-3"><input id="legal" type="checkbox" <?php echo ($gis['service2']==1?'checked':'') ?>>&emsp;Legal Assisstance</div>
        <div class="col-sm-6"><input id="referral" type="checkbox" <?php echo ($gis['service3']==1?'checked':'') ?>>&emsp;Referral (Specify): <span id="i_ref_name" style="text-transform:uppercase"></span></div>
        <div class="col-sm-1"></div>
        <div class="w-100" style="margin:4px"></div>
        <div class="col-sm-3"><input id="financial" type="checkbox" <?php echo ($gis['service4']==1?'checked':'') ?> >&emsp; Financial Assisstance</div>
    </div>
    <!--Medical Assistant-->
    <div>
        <table style="width:100%;font-size: 13px">
            <tr>
                <th width="19%" height="10"></th>
                <th width="32%" height="10">PURPOSE</th>
                <th width="19%" height="10">AMOUNT OF ASSISTANCE</th>
                <th width="17%" height="10">MODE OF ASSISTANCE</th>
                <th width="17%" height="10">FUND SOURCE</th>
            </tr>
            <tr>
                <td>Medical Needs</td>
                <td id="medic-p"><?php
                if(!empty($client_assistance[2]['type']) && !empty($client_assistance[2]['purpose'])){
                    echo $user->checkService($client_assistance[1]['type'], $client_assistance[2]['type'],$client_assistance[1]['purpose'], $client_assistance[2]['purpose'], "med");
                }else{
                    echo $user->checkService($client_assistance[1]['type'], "",$client_assistance[1]['purpose'], "", "med");
                }?></td>
                <td class="text-center" id="medic-a"><?php 
                if(!empty($client_assistance[2]['type']) && !empty($client_assistance[2]['amount'])){
                    echo $user->checkService($client_assistance[1]['type'], $client_assistance[2]['type'],$client_assistance[1]['amount'], $client_assistance[2]['amount'], "med");
                }else{
                    echo $user->checkService($client_assistance[1]['type'], "",$client_assistance[1]['amount'], "", "med");
                }?></td>
                <td class="text-center" id="medic-m"><?php 
                if(!empty($client_assistance[2]['type']) && !empty($client_assistance[2]['mode'])){
                    echo $user->checkService($client_assistance[1]['type'], $client_assistance[2]['type'],$client_assistance[1]['mode'], $client_assistance[2]['mode'], "med");
                }else{
                    echo $user->checkService($client_assistance[1]['type'], "",$client_assistance[1]['mode'], "", "med");
                }?></td>
                <td class="text-center" id="medic-f"><?php 
                if(!empty($client_assistance[2]['type']) && !empty($client_assistance[2]['fund'])){
                    echo $user->checkService($client_assistance[1]['type'], $client_assistance[2]['type'],$client_assistance[1]['fund'], $client_assistance[2]['fund'], "med");
                }else{
                    echo $user->checkService($client_assistance[1]['type'], "",$client_assistance[1]['fund'], "", "med");
                }?></td>
            </tr>
            <tr>
                <td>Burial Needs</td>
                <td id="burial-p"><?php 
                if(!empty($client_assistance[2]['type']) && !empty($client_assistance[2]['purpose'])){
                    echo $user->checkService($client_assistance[1]['type'], $client_assistance[2]['type'],$client_assistance[1]['purpose'], $client_assistance[2]['purpose'], "burial");
                }else{
                    echo $user->checkService($client_assistance[1]['type'], "",$client_assistance[1]['purpose'], "", "burial");
                }?></td>
                <td class="text-center" id="burial-a"><?php 
                if(!empty($client_assistance[2]['type']) && !empty($client_assistance[2]['amount'])){
                    echo $user->checkService($client_assistance[1]['type'], $client_assistance[2]['type'],$client_assistance[1]['amount'], $client_assistance[2]['amount'], "burial");
                }else{
                    echo $user->checkService($client_assistance[1]['type'], "",$client_assistance[1]['amount'], "", "burial");
                }?></td>
                <td class="text-center" id="burial-m"><?php 
                if(!empty($client_assistance[2]['type']) && !empty($client_assistance[2]['mode'])){
                    echo $user->checkService($client_assistance[1]['type'], $client_assistance[2]['type'],$client_assistance[1]['mode'], $client_assistance[2]['mode'], "burial");
                }else{
                    echo $user->checkService($client_assistance[1]['type'], "",$client_assistance[1]['mode'], "", "burial");
                }?></td>
                <td class="text-center" id="burial-f"><?php 
                if(!empty($client_assistance[2]['type']) && !empty($client_assistance[2]['fund'])){
                    echo $user->checkService($client_assistance[1]['type'], $client_assistance[2]['type'],$client_assistance[1]['fund'], $client_assistance[2]['fund'], "burial");
                }else{
                    echo $user->checkService($client_assistance[1]['type'], "",$client_assistance[1]['fund'], "", "burial");
                }?></td>
            </tr>
            <tr>
                <td>Transportation Needs</td>
                <td id="trans-p"><?php 
                if(!empty($client_assistance[2]['type']) && !empty($client_assistance[2]['purpose'])){
                    echo $user->checkService($client_assistance[1]['type'], $client_assistance[2]['type'],$client_assistance[1]['purpose'], $client_assistance[2]['purpose'], "trans");
                }else{
                    echo $user->checkService($client_assistance[1]['type'], "",$client_assistance[1]['purpose'], "", "trans");
                }?></td>
                <td class="text-center" id="trans-a"><?php 
                if(!empty($client_assistance[2]['type']) && !empty($client_assistance[2]['amount'])){
                    echo $user->checkService($client_assistance[1]['type'], $client_assistance[2]['type'],$client_assistance[1]['amount'], $client_assistance[2]['amount'], "trans");
                }else{
                    echo $user->checkService($client_assistance[1]['type'], "",$client_assistance[1]['amount'], "", "trans");
                }?></td>
                <td class="text-center" id="trans-m"><?php 
                if(!empty($client_assistance[2]['type']) && !empty($client_assistance[2]['mode'])){
                    echo $user->checkService($client_assistance[1]['type'], $client_assistance[2]['type'],$client_assistance[1]['mode'], $client_assistance[2]['mode'], "trans");
                }else{
                    echo $user->checkService($client_assistance[1]['type'], "",$client_assistance[1]['mode'], "", "trans");
                }?></td>
                <td class="text-center" id="trans-f"><?php 
                if(!empty($client_assistance[2]['type']) && !empty($client_assistance[2]['fund'])){
                    echo $user->checkService($client_assistance[1]['type'], $client_assistance[2]['type'],$client_assistance[1]['fund'], $client_assistance[2]['fund'], "trans");
                }else{
                    echo $user->checkService($client_assistance[1]['type'], "",$client_assistance[1]['fund'], "", "trans");
                }?></td>
            </tr>
            <tr>
                <td>Educational Support</td>
                <td id="educ-p"><?php 
                if(!empty($client_assistance[2]['type']) && !empty($client_assistance[2]['purpose'])){
                    echo $user->checkService($client_assistance[1]['type'], $client_assistance[2]['type'],$client_assistance[1]['purpose'], $client_assistance[2]['purpose'], "educ");
                }else{
                    echo $user->checkService($client_assistance[1]['type'], "",$client_assistance[1]['purpose'], "", "educ");
                }?></td>
                <td class="text-center" id="educ-a"><?php 
                if(!empty($client_assistance[2]['type']) && !empty($client_assistance[2]['amount'])){
                    echo $user->checkService($client_assistance[1]['type'], $client_assistance[2]['type'],$client_assistance[1]['amount'], $client_assistance[2]['amount'], "educ");
                }else{
                    echo $user->checkService($client_assistance[1]['type'], "",$client_assistance[1]['amount'], "", "educ");
                }?></td>
                <td class="text-center" id="educ-m"><?php 
                if(!empty($client_assistance[2]['type']) && !empty($client_assistance[2]['mode'])){
                    echo $user->checkService($client_assistance[1]['type'], $client_assistance[2]['type'],$client_assistance[1]['mode'], $client_assistance[2]['mode'], "educ");
                }else{
                    echo $user->checkService($client_assistance[1]['type'], "",$client_assistance[1]['mode'], "", "educ");
                }?></td>
                <td class="text-center" id="educ-f"><?php 
                if(!empty($client_assistance[2]['type']) && !empty($client_assistance[2]['fund'])){
                    echo $user->checkService($client_assistance[1]['type'], $client_assistance[2]['type'],$client_assistance[1]['fund'], $client_assistance[2]['fund'], "educ");
                }else{
                    echo $user->checkService($client_assistance[1]['type'], "",$client_assistance[1]['fund'], "", "educ");
                }?></td>
            </tr>
            <tr>
                <td>Food Subsidy Support</td>
                <td id="food-p"><?php 
                if(!empty($client_assistance[2]['type']) && !empty($client_assistance[2]['purpose'])){
                    echo $user->checkService($client_assistance[1]['type'], $client_assistance[2]['type'],$client_assistance[1]['purpose'], $client_assistance[2]['purpose'], "food sub");
                }else{
                    echo $user->checkService($client_assistance[1]['type'], "",$client_assistance[1]['purpose'], "", "food sub");
                }?></td>
                <td class="text-center" id="food-a"><?php 
                if(!empty($client_assistance[2]['type']) && !empty($client_assistance[2]['amount'])){
                    echo $user->checkService($client_assistance[1]['type'], $client_assistance[2]['type'],$client_assistance[1]['amount'], $client_assistance[2]['amount'], "food sub");
                }else{
                    echo $user->checkService($client_assistance[1]['type'], "",$client_assistance[1]['amount'], "", "food sub");
                }?></td>
                <td class="text-center" id="food-m"><?php 
                if(!empty($client_assistance[2]['type']) && !empty($client_assistance[2]['mode'])){
                    echo $user->checkService($client_assistance[1]['type'], $client_assistance[2]['type'],$client_assistance[1]['mode'], $client_assistance[2]['mode'], "food sub");
                }else{
                    echo $user->checkService($client_assistance[1]['type'], "",$client_assistance[1]['mode'], "", "food sub");
                };?></td>
                <td class="text-center" id="food-f"><?php 
                if(!empty($client_assistance[2]['type']) && !empty($client_assistance[2]['fund'])){
                    echo $user->checkService($client_assistance[1]['type'], $client_assistance[2]['type'],$client_assistance[1]['fund'], $client_assistance[2]['fund'], "food sub");
                }else{
                    echo $user->checkService($client_assistance[1]['type'], "",$client_assistance[1]['fund'], "", "food sub");
                }?></td>
            </tr>
            <tr>
                <td>Non-Food Items</td>
                <td id="non-p"><?php 
                if(!empty($client_assistance[2]['type']) && !empty($client_assistance[2]['purpose'])){
                    echo $user->checkService($client_assistance[1]['type'], $client_assistance[2]['type'],$client_assistance[1]['purpose'], $client_assistance[2]['purpose'], "non");
                }else{
                    echo $user->checkService($client_assistance[1]['type'], "",$client_assistance[1]['purpose'], "", "non");
                }?></td>
                <td class="text-center" id="non-a"><?php 
                if(!empty($client_assistance[2]['type']) && !empty($client_assistance[2]['amount'])){
                    echo $user->checkService($client_assistance[1]['type'], $client_assistance[2]['type'],$client_assistance[1]['amount'], $client_assistance[2]['amount'], "non");
                }else{
                    echo $user->checkService($client_assistance[1]['type'], "",$client_assistance[1]['amount'], "", "non");
                }?></td>
                <td class="text-center" id="non-m"><?php 
                if(!empty($client_assistance[2]['type']) && !empty($client_assistance[2]['mode'])){
                    echo $user->checkService($client_assistance[1]['type'], $client_assistance[2]['type'],$client_assistance[1]['mode'], $client_assistance[2]['mode'], "non");
                }else{
                    echo $user->checkService($client_assistance[1]['type'], "",$client_assistance[1]['mode'], "", "non");
                };?></td>
                <td class="text-center" id="non-f"><?php if(!empty($client_assistance[2]['type']) && !empty($client_assistance[2]['fund'])){
                    echo $user->checkService($client_assistance[1]['type'], $client_assistance[2]['type'],$client_assistance[1]['fund'], $client_assistance[2]['fund'], "non");
                }else{
                    echo $user->checkService($client_assistance[1]['type'], "",$client_assistance[1]['fund'], "", "non");
                }?></td>
            </tr>
            <tr>
                <td>Cash Assistance</td>
                <td id="cash-p"><?php 
                if(!empty($client_assistance[2]['type']) && !empty($client_assistance[2]['purpose'])){
                    echo $user->checkService($client_assistance[1]['type'], $client_assistance[2]['type'],$client_assistance[1]['purpose'], $client_assistance[2]['purpose'], "cash");
                }else{
                    echo $user->checkService($client_assistance[1]['type'], "",$client_assistance[1]['purpose'], "", "cash");
                }?></td>
                <td class="text-center" id="cash-a"><?php 
                if(!empty($client_assistance[2]['type']) && !empty($client_assistance[2]['amount'])){
                    echo $user->checkService($client_assistance[1]['type'], $client_assistance[2]['type'],$client_assistance[1]['amount'], $client_assistance[2]['amount'], "cash");
                }else{
                    echo $user->checkService($client_assistance[1]['type'], "",$client_assistance[1]['amount'], "", "cash");
                }?></td>
                <td class="text-center" id="cash-m"><?php 
                if(!empty($client_assistance[2]['type']) && !empty($client_assistance[2]['mode'])){
                    echo $user->checkService($client_assistance[1]['type'], $client_assistance[2]['type'],$client_assistance[1]['mode'], $client_assistance[2]['mode'], "cash");
                }else{
                    echo $user->checkService($client_assistance[1]['type'], "",$client_assistance[1]['mode'], "", "cash");
                }?></td>
                <td class="text-center" id="cash-f"><?php if(!empty($client_assistance[2]['type']) && !empty($client_assistance[2]['fund'])){
                    echo $user->checkService($client_assistance[1]['type'], $client_assistance[2]['type'],$client_assistance[1]['fund'], $client_assistance[2]['fund'], "cash");
                }else{
                    echo $user->checkService($client_assistance[1]['type'], "",$client_assistance[1]['fund'], "", "cash");
                }?></td>
            </tr>
        </table>
    </div>
    <!--Below Table-->
    <div class="row" style="font-size: 12px">
        <div class="col-sm-2 col-xs-1">Interviewed by:</div>
        <div class="col-sm-3 col-xs-4" style="padding-left:50px">Reviewed and Approved by:</div>
        <div class="col-sm-3 col-xs-2" ></div>
        <div class="col-sm-2 col-xs-2" >Client</div>
        <div class="col-sm-2 col-xs-2" style="border:1px solid #000000;height: 100px;"></div>
        </div>  
    <!--Thumbmark-->
    <div class="row" style="font-size: 12px">
        <div class="col-sm-2 col-xs-1"></div>
        <div class="col-sm-3 col-xs-3" ></div>
        <div class="col-sm-3 col-xs-3" ></div>
        <div class="col-sm-2 col-xs-2" ></div>
        <div class="col-sm-2 col-xs-2">Client Thumbmark</div>
    </div>  
    <div class="row text-center" style="margin:-80px; margin-left: 1px">
        <div class="col-2" style="margin-right: 25px;">
            <input type="text" style="font-weight: bold; text-transform:uppercase;width:130%; border-bottom:1px solid black;" class="ubos text-center" id="soc_work" value="<?php echo strtoupper($soc_workerFullname); ?>"><br>
            <input type="text" class="text-center" style="width:130%;border:none;text-transform:none;" id="soc_pos" value="CIU-Social Worker">
        </div>
        <div class="col-3">
            <div style=" height: 20px;width:100%;" class="text-center">
                <input type="text" style="border-bottom:1px solid #000000;font-weight: bold;text-transform:uppercase;width:100%;" class="ubos text-center" id="signatory" value="<?php echo strtoupper($signatory['first_name']." ". $signatory['middle_I'].". ". $signatory['last_name']); ?>"><br>
                <input type="text" class="text-center" style="border:none;width:100%;text-transform:none;" value="<?php echo $signatory['position'] ?>">
            </div>
        </div>
        <div class="col-4"  style="margin-left: 50px">
            <input class="ubos text-center" type="text" id="client" style="width: 75%;border-bottom:1px solid black;text-transform:uppercase;" value="<?php echo $client["firstname"]." ". (empty($client["middlename"][0])? "" : strtoupper($client["middlename"][0]) .". "). $client["lastname"]." ". (empty($client["extraname"])?"": $client['extraname'])."" ?>"><br>
            <input class="ubos text-center" type="text" style="width: 75%;border:none;text-transform:none;" value="Client">
        </div>
    </div>
    
    <div style="page-break-after:always"></div>
    <div>&nbsp;</div>
	<br>
    <!--Container-->    
</div>