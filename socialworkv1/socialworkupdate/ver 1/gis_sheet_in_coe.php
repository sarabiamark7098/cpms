
<div class="container" id="gis_sheet_in_ce" style="font-size:12px">
<br>

    <!--HEADER-->
    <div class="row">
        <div class="col"><img src="../../images/dswd_olog.png" alt="" width="150px" height="70px"></div>
        <div class="col-6 col-md-auto" style="text-align: center;">
            <br><b style="font-size: 15px">GENERAL INTAKE SHEET</b>
            <p style="font-size: 15px">Crisis Intervention Unit</p>
        </div>
        <div class="col ml-md-auto"><img  class="right" src="../../images/maagap_logo.png" alt="" width="150px" height="70px" style="float:right;"></div>
    </div>
	<hr style="margin-bottom: -1px; margin-top: -15px;margin-bottom: 3px">
        <!--PETSA-->
    <div class="row" style="font-size: 13px; margin-top: -5px">
        <div class="col-sm-2 center" style="margin-top: 5px;"><p class="text-center" >Petsa Ngayon<br>(Date Today)</p> 
        </div>
        <div class="col-sm-2" style="margin-top: 5px;"><input class="form-control input-lg border-dark" type="text" height="80px" value='<?php echo date("Y-m-d")?>'>
        </div>
        <div class="col-sm-2"  style="margin-top: 5px;"><p class="text-center">Oras ng Pagpasok:<br>(Time of Entry)</p></div>
        <div class="col-sm-2"  style="margin-top: 5px;"><input class="form-control input-lg border-dark" type="text" value="<?php echo $timeentry; ?>"></div>
        <div class="col-sm-2"  style="margin-top: 5px;"><p class="text-center">Bilang ng<br>kliyente:</p></div>
        <div class="col-sm-2" style="margin-top:5px"><div style="border:1px solid #000000;height: 40px;width:100%"><p id="theNum" class="text-center" style="font-size:20px"><?php echo $gis["client_num"]; ?></p></div></div>
    </div>
    <!---->
    <p class="header" style="margin-top: -10px; margin-left:-15px;background-color: black !important;color: white;-webkit-print-color-adjust: exact;font-size: 14px;">&emsp; IMPORMASYON UKOL SA KLIYENTE (Client's Identifying Information)</p>
        <!--PANGALAN-->
    <div class="row" style="margin-top: -5px;font-size: 12px">
        <div class="col-sm-1" style="margin-top: -10px;"><p class="text-left">PANGALAN: <br>(Name)</p></div>
        <div class="col-sm-11" style="margin-top: -10px;"> <input type="text" class="form-control input-lg border-dark" value="<?php echo $name;?>"></div>
    </div>
    <div class="row" style="font-size: 10px; margin-top: -18px;">
        <div class="col-sm-2 col-xs-1" style="margin-top: 5px;"></div>
        <div class="col-sm-3 col-xs-3" >&emsp;&emsp;Apelyido</div>
        <div class="col-sm-3 col-xs-3"  >Unang Pangalan</div>
        <div class="col-sm-2 col-xs-3"  style="margin-top: 5px;">Gitnang Pangalan</div>
        <div class="col-sm-2 col-xs-2"  style="margin-top: 5px;">Extension Name</div>
    </div>
    <div class="row" style="font-size: 10px;margin-top: -10px;">
        <div class="col-sm-2 col-xs-1" style="margin-top: 5px;"></div>
        <div class="col-sm-3 col-xs-3" >&emsp;(Last Name)</div>
        <div class="col-sm-3 col-xs-3" >(First Name)</div>
        <div class="col-sm-2 col-xs-3"  style="margin-top: 5px;">(Middle Name)</div>
        <div class="col-sm-2 col-xs-2"  style="margin-top: 5px;">&emsp;&emsp;(Jr/Sr)</div>
    </div>
    <!--KAPANAKAN-->
    <div class="row" style="margin-top: 0px;font-size:12px">
        <div class="col-sm-2" style="margin-top: 5px;">
            <p>PETSA NG KAPANGANAKAN</p><div class="w-100"></div><p style=
            "font-size: 12px;margin-top: -15px;">(Birthday)</p>
        </div>
        <div class="col-sm-3"><input type="text" class="form-control input-lg border-dark" value="<?php echo $client['date_birth'];?>"></div>
        <div class="col-sm-1"><p class="text-center">EDAD<br>Age</p></div>
        <div class="col-sm-2"><input type="text" class="form-control input-lg border-dark" value="<?php echo $user->getAge($client['date_birth'])?>"></div>
        <div class="col-sm-1"><p class="text-center" style="font-size: 12px;">KASARIAN<br>(SEX)</p></div>
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
        <div class="col-sm-1" style="font-size: 12px;"><p>Male<br>Female</p></div>
    </div>
    <!--CONTACT-->
    <div class="row" style="font-size: 12px; margin-top:-10px">
        <div class="col-sm-1" style="font-size: 12px;"><p>CONTACT<br>NUMBER</p></div>
        <div class="col-sm-3"><input type="text" class="form-control input-lg border-dark"value="<?php echo $client["contact"] ?>"></div>
        <div class="col-sm-2" style="margin-top: 5px;"><p class="text-right" style="font-size:10px">STATUS SIBIL<br>Civil Status</p></div>
        <div class="col-sm-1">
            <input type="text" class="form-control input-sm border-dark text-center" style="height:20px" value="<?php echo (strtolower($client["civil_status"]) == 'single'? ' &#x2714;' : '' ); ?>">
            <input type="text" class="form-control input-sm border-dark text-center" style="height:20px" value="<?php echo (strtolower($client["civil_status"]) == 'married'? ' &#x2714;' : '' ); ?>">
        </div>
        <div class="col-sm-1" style="font-size: 12px;"><p>SINGLE<br>MARRIED</p></div>
        <div class="col-sm-1"></div>
        <div class="col-sm-1">
            <input type="text" class="form-control input-sm border-dark text-center" style="height:20px" value="<?php echo (strtolower($client["civil_status"]) == 'widow/widower'? ' &#x2714;' : '' ); ?>">
            <input type="text" class="form-control input-sm border-dark text-center" style="height:20px" value="<?php echo (strtolower($client["civil_status"]) == 'common-law' || strtolower($client["civil_status"]) == 'separated'? '&#x2714;' : '' ); ?>">
    </div>
        <div class="col-sm-1" style="font-size: 12px;"><p>Widower/er<br>Others</p></div>

    </div>
    <!--RELASYON-->
    <div class="row" style="font-size: 12px;margin-top:-8px">
        <div class="col-sm-3"><p>RELASYON SA BENEPISYARYO<br>(Relationship to Beneficiary)</p></div>
        <div class="col-sm-9"><input type="text" class="form-control input-lg border-dark" value="<?php echo $client["relation"]?>"></div>
    </div>
    <!--TIRAHAN-->
    <div class="row" style="margin-top: -10px;font-size: 12px">
        <div class="col-sm-1" ><p class="text-left">TIRAHAN: <br>(Address)</p></div>
        <div class="col-sm-11"> <input type="text" class="form-control input-lg border-dark" value="<?php echo $address?>"></div>
    </div>
    <div class="row" style="margin-top: -10px;font-size: 12px">
            <div class="col-sm-2 col-xs-1" style="margin-top: 5px;"></div>
            <div class="col-sm-3 col-xs-3" >&emsp;&emsp;No./Street/Purok</div>
            <div class="col-sm-3 col-xs-3">Barangay</div>
            <div class="col-sm-2 col-xs-3" style="margin-top: 5px;">Municipality</div>
            <div class="col-sm-2 col-xs-2" style="margin-top: 5px;">Province</div>
    </div>
    <!--TRABAHO-->
    <div class="row" style="font-size: 12px">
        <div  class="col-sm-1"><p>TRABAHO<br>(Occupation)</p></div>
        <div  class="col-sm-5"><input type="text" class="form-control input-lg border-dark" value="<?php echo $client["occupation"] ?>"></div>
        <div  class="col-sm-2" style="margin-top: 5px;"><p>SWELDO: &emsp;(Salary) </p></div>
        <div  class="col-sm-4"><input type="text" class="form-control input-lg border-dark" value="<?php echo $client["salary"] ?>"></div>
    </div>

    <!--BENEFICIARY INFO-->
    <p class="header" style="margin-top: -10px; margin-left: -15px;background-color: black !important;color: white;-webkit-print-color-adjust: exact;font-size: 14px;">&emsp; IMPORMASYON UKOL SA BENEPISYARYO (Beneficiary's Identifying Information)</p>
    <!--PANGALAN-->
    <div class="row" style="margin-top: -5px;font-size: 12px">
        <div class="col-sm-1" style="margin-top: -10px;"><p class="text-left">PANGALAN: <br>(Name)</p></div>
        <div class="col-sm-11" style="margin-top: -10px;"> <input type="text" class="form-control input-lg border-dark" value="<?php echo ($client["relation"] == 'Self'? '' : $bname); ?>"></div>
    </div>
    <div class="row" style="font-size: 12px;margin-top: -18px;">
        <div class="col-sm-2 col-xs-1" style="margin-top: 5px;"></div>
        <div class="col-sm-3 col-xs-3" >&emsp;&emsp;Apelyido</div>
        <div class="col-sm-3 col-xs-3" >Unang Pangalan</div>
        <div class="col-sm-2 col-xs-3"  style="margin-top: 5px;">Gitnang Pangalan</div>
        <div class="col-sm-2 col-xs-2"  style="margin-top: 5px;">Extension Name</div>
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
            <p style="font-size:12px">Petsa ng Kapanakan</p><div class="w-100"></div><p style=
            "font-size: 12px;margin-top: -25px;">(Birthday)</p>
        </div>
        <div class="col-sm-3"><input type="text" class="form-control input-lg border-dark" value="<?php echo ($client["relation"] == 'Self'? '' : $client['b_bday']);?>"></div>
        <div class="col-sm-1" style="font-size: 12px;"><p class="text-center">EDAD<br>Age</p></div>
        <div class="col-sm-2" style="margin-top: 5px;"><input type="text" class="form-control input-lg border-dark" value="<?php echo ($client["relation"] == 'Self'? '' : $user->getAge($client['b_bday']));?>"></div>
        <div class="col-sm-1" style="font-size: 12px;"><p class="text-center">KASARIAN<br>(SEX)</p></div>
        <div class="col-sm-1" style="font-size: 12px;">
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
        <div class="col-sm-2" style="margin-top: 5px;"><p class="text-right" style="font-size:12px">STATUS SIBIL<br>Civil Status</p></div>
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
        <div class="col-sm-11"> <input type="text" class="form-control input-lg border-dark" value="<?php echo ($client["relation"] == 'Self'? '' : $address );?>"></div>
    </div>
    <div class="row" style="margin-top: -12px;font-size: 12px">
        <div class="col-sm-2 col-xs-1" style="margin-top: 5px;"></div>
        <div class="col-sm-3 col-xs-3" >&emsp;&emsp;No./Street/Purok</div>
        <div class="col-sm-3 col-xs-3">Barangay</div>
        <div class="col-sm-2 col-xs-3" style="margin-top: 5px;">Municipality</div>
        <div class="col-sm-2 col-xs-2" style="margin-top: 5px;">Province</div>
    </div>
    <!--KOMPOSISYON SA PAMILYA:-->
    <b style="border-top: -5px; font-size: 14px">KOMPOSISYON SA PAMILYA: </b>
    <table style="width:100%; font-size: 13px" class="text-center">
        <tr>
            <th width="40%" height="20">Pangalan</th>
            <th width="5%" height="20">Edad</th>
            <th width="40%" height="20">Trabaho</th>
            <th width="10%" height="20">Buwanang Sahod</th>
        </tr>
        <tr>
            <td height="20" style="border: 1px solid black;border-collapse: collapse;"><p style="font-size:13px; margin: 0; padding:0;" id='pangan1'><?php echo (!empty($client_fam)?(!empty($client_fam[1])?$client_fam[1]["name"]:""):"") ?></p></td>
            <td height="20" style="border: 1px solid black;border-collapse: collapse;"><p class="text-center" style="font-size:13px; margin: 0; padding:0;" id='edad1'><?php echo (!empty($client_fam)?(!empty($client_fam[1])?$client_fam[1]["age"]:""):"") ?></p></td>
            <td height="20" style="border: 1px solid black;border-collapse: collapse;"><p class="text-center" style="font-size:13px; margin: 0; padding:0;" id='trabaho1'><?php echo (!empty($client_fam)?(!empty($client_fam[1])?$client_fam[1]["occupation"]:""):"") ?></p></td>
            <td height="20" style="border: 1px solid black;border-collapse: collapse;"><p class="text-center" style="font-size:13px; margin: 0; padding:0;" id='sahod1'><?php echo (!empty($client_fam)?(!empty($client_fam[1])?$client_fam[1]["salary"]:""):"") ?></p></td>
        </tr>
        <tr>
            <td height="20" style="border: 1px solid black;border-collapse: collapse;"><p style="font-size:13px; margin: 0; padding:0;" id='pangan2'><?php echo (!empty($client_fam)?(!empty($client_fam[2])?$client_fam[2]["name"]:""):"") ?></p></td>
            <td height="20" style="border: 1px solid black;border-collapse: collapse;"><p class="text-center" style="font-size:13px; margin: 0; padding:0;" id='edad2'><?php echo (!empty($client_fam)?(!empty($client_fam[2])?$client_fam[2]["age"]:""):"") ?></p></td>
            <td height="20" style="border: 1px solid black;border-collapse: collapse;"><p class="text-center" style="font-size:13px; margin: 0; padding:0;" id='trabaho2'><?php echo (!empty($client_fam)?(!empty($client_fam[2])?$client_fam[2]["occupation"]:""):"") ?></p></td>
            <td height="20" style="border: 1px solid black;border-collapse: collapse;"><p class="text-center" style="font-size:13px; margin: 0; padding:0;" id='sahod2'><?php echo (!empty($client_fam)?(!empty($client_fam[2])?$client_fam[2]["salary"]:""):"") ?></p></td>
        </tr>
        <tr>
            <td height="20" style="border: 1px solid black;border-collapse: collapse;"><p style="font-size:13px; margin: 0;" id='pangan3'><?php echo (!empty($client_fam)?(!empty($client_fam[3])?$client_fam[3]["name"]:""):"") ?></p></td>
            <td height="20" style="border: 1px solid black;border-collapse: collapse;"><p class="text-center" style="font-size:13px; margin: 0; padding:0;" id='edad3'><?php echo (!empty($client_fam)?(!empty($client_fam[3])?$client_fam[3]["age"]:""):"") ?></p></td>
            <td height="20" style="border: 1px solid black;border-collapse: collapse;"><p class="text-center" style="font-size:13px; margin: 0; padding:0;" id='trabaho3'><?php echo (!empty($client_fam)?(!empty($client_fam[3])?$client_fam[3]["occupation"]:""):"") ?></p></td>
            <td height="20" style="border: 1px solid black;border-collapse: collapse;"><p class="text-center" style="font-size:13px; margin: 0; padding:0;" id='sahod3'><?php echo (!empty($client_fam)?(!empty($client_fam[3])?$client_fam[3]["salary"]:""):"") ?></p></td>
        </tr>
    </table>
    <hr style="margin-top: 4px">
    <!--Client Category-->
    <div class="row" style="margin-top: -10px; font-size: 12px">
        <div class="col-sm-2" style="margin-top: 5px;">CLIENT'S CATEGORY</div>
        <div class="col-sm-4"><input type="text" class="form-control input-lg border-dark text-center" style="font-size: 10px;" value="<?php echo $client["category"] ?>"></div>
        <div class="col-sm-2" style="margin-top: 5px;"><p class="text-right">Sub-Category</p></div>
        <div class="col-sm-4"><input type="text" class="form-control input-lg border-dark text-center" style="font-size: 10px;" value="<?php echo $client["subCategory"] ?>"></div>
    </div>
    <div class="row" style="font-size: 12px">
        <div class="col-sm-2" style="margin-top: 5px;">BENEFICIARY'S CATEGORY</div>
        <div class="col-sm-4"><input type="text" class="form-control input-lg border-dark text-center" style="font-size: 10px;" value="<?php echo ($client["relation"] == 'Self'? '' : $client['b_category']);?>"></div>
        <div class="col-sm-2" style="margin-top: 5px;"><p class="text-right">Sub-Category</p></div>
        <div class="col-sm-4"><input type="text" class="form-control input-lg border-dark text-center" style="font-size: 10px;" value="<?php echo ($client["relation"] == 'Self'? '' : $client['b_subCategory']);?>"></div>
    </div>
    <!--ASSESSMENT-->
    <br><p style="margin:-1px;font-size: 14px;margin-top: -15px">ASSESSMENT (Use addtional sheets as neccessary)</p>
    <div style="border:1px solid #000000; height: 70px; width: 100%">
        <b style="font-size: 12px">&nbsp;PROBLEM PRESENTED</b><br>
        <textarea id="problem" class="no-border" style="height:60px;width: 100%;font-size:12px;border: 0;box-shadow: none;margin-top: 10px;
    margin: 0px 0px;
    padding: 5px;
    line-height: 10px;
    display: block;
    margin: 0px auto;overflow:hidden;"><?php echo $gis["problem"]; ?></textarea>
    </div><br>
    <div style="border:1px solid #000000; height: 120px; width: 100%;margin-top: -15px">
        <b style="font-size: 12px">&nbsp;SOCIAL WORKER'S ASSESSMENT</b>
        <textarea id="soc_ass" class="no-border" style="height:110px;width: 100%;font-size:12px;border: 0;box-shadow: none;margin-top: 10px;
    margin: 0px 0px;
    padding: 5px;
    line-height: 15px;
    display: block;
    margin: 0px auto;overflow:hidden;"><?php echo $gis["soc_ass"]; ?></textarea>
    </div>
    <br><p style="font-size: 12px;margin-top:-15px;margin-bottom:4px"><b>RECOMMENDED SERVICE AND ASSISTANCE</b></p>
    <div class="row" style="margin-left: 2px;margin-bottom: 5px;font-size: 12px">
        <div class="col-sm-3"><input id="psychosocial" type="checkbox" style="transform: scale(2);border: #000000;" <?php echo ((!empty($gis)?(($gis["service1"] == 1)?"checked":""):"")) ?>>&emsp; Psychosocial Support</div>
        <div class="col-sm-3"><input id="legal" type="checkbox" style="transform: scale(2);border: #000000;" <?php echo ((!empty($gis)?(($gis["service2"] == 1)?"checked":""):"")) ?>>&emsp;Legal Assisstance</div>
        <div class="col-sm-6"><input id="referral" type="checkbox" style="transform: scale(2);border: #000000;" <?php echo ((!empty($gis)?(($gis["service3"] == 1)?"checked":""):"")) ?>>&emsp;Referral (Specify): <span id="i_ref_name" style="text-transform:uppercase;font-size:15px;"><?php echo ((!empty($gis)?(($gis["service4"] == 1)?$gis["ref_name"]:""):"")) ?></span></div>
        <div class="col-sm-1"></div>
        <div class="w-100" style="margin:4px"></div>
        <div class="col-sm-3"><input id="financial" type="checkbox" style="transform: scale(2);border: #000000;" <?php echo ((!empty($gis)?(($gis["service4"] == 1)?"checked":""):"")) ?>>&emsp; Financial Assisstance</div>
    </div>
    <!--Medical Assistant-->
    <div>
        <table style="width:100%;font-size: 13px">
            <tr>
                <th width="19%" height="10" style="text-align: center;font-weight: normal;border: 1px solid black;"></th>
                <th width="24%" height="10" class="text-center" style="text-align: center;font-weight: normal;border: 1px solid black;">PURPOSE</th>    
                <th width="19%" height="10" style="text-align: center;font-weight: normal;border: 1px solid black;">AMOUNT OF ASSISTANCE</th>
                <th width="17%" height="10" style="text-align: center;font-weight: normal;border: 1px solid black;">MODE OF ASSISTANCE</th>
                <th width="30%" height="10" style="text-align: center;font-weight: normal;border: 1px solid black;">FUND SOURCE</th>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse: collapse;">Medical Needs</td>
                <td id="medic-p" style="border: 1px solid black;border-collapse: collapse;"><?php
                if(!empty($client_assistance[2]['type']) && !empty($client_assistance[2]['purpose'])){
                    echo $user->checkService($client_assistance[1]['type'], $client_assistance[2]['type'],$client_assistance[1]['purpose'], $client_assistance[2]['purpose'], "med");
                }else{
                    echo $user->checkService($client_assistance[1]['type'], "",$client_assistance[1]['purpose'], "", "med");
                }?></td>
                <td class="text-center" id="medic-a" style="border: 1px solid black;border-collapse: collapse;"><?php 
                if(!empty($client_assistance[2]['type']) && !empty($client_assistance[2]['amount'])){
                    echo $user->checkService($client_assistance[1]['type'], $client_assistance[2]['type'],$client_assistance[1]['amount'], $client_assistance[2]['amount'], "med");
                }else{
                    echo $user->checkService($client_assistance[1]['type'], "",$client_assistance[1]['amount'], "", "med");
                }?></td>
                <td class="text-center" id="medic-m" style="border: 1px solid black;border-collapse: collapse;"><?php 
                if(!empty($client_assistance[2]['type']) && !empty($client_assistance[2]['mode'])){
                    echo $user->checkService($client_assistance[1]['type'], $client_assistance[2]['type'],$client_assistance[1]['mode'], $client_assistance[2]['mode'], "med");
                }else{
                    echo $user->checkService($client_assistance[1]['type'], "",$client_assistance[1]['mode'], "", "med");
                }?></td>
                <td class="text-center" id="medic-f" style="border: 1px solid black;border-collapse: collapse;"><?php 
                    echo (!empty($fundsourcedata[1]['fundsource'])?$fundsourcedata[1]['fundsource']."=".$fundsourcedata[1]['fs_amount']:"");
                ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse: collapse;">Burial Needs</td>
                <td id="burial-p" style="border: 1px solid black;border-collapse: collapse;"><?php 
                if(!empty($client_assistance[2]['type']) && !empty($client_assistance[2]['purpose'])){
                    echo $user->checkService($client_assistance[1]['type'], $client_assistance[2]['type'],$client_assistance[1]['purpose'], $client_assistance[2]['purpose'], "burial");
                }else{
                    echo $user->checkService($client_assistance[1]['type'], "",$client_assistance[1]['purpose'], "", "burial");
                }?></td>
                <td class="text-center" id="burial-a" style="border: 1px solid black;border-collapse: collapse;"><?php 
                if(!empty($client_assistance[2]['type']) && !empty($client_assistance[2]['amount'])){
                    echo $user->checkService($client_assistance[1]['type'], $client_assistance[2]['type'],$client_assistance[1]['amount'], $client_assistance[2]['amount'], "burial");
                }else{
                    echo $user->checkService($client_assistance[1]['type'], "",$client_assistance[1]['amount'], "", "burial");
                }?></td>
                <td class="text-center" id="burial-m" style="border: 1px solid black;border-collapse: collapse;"><?php 
                if(!empty($client_assistance[2]['type']) && !empty($client_assistance[2]['mode'])){
                    echo $user->checkService($client_assistance[1]['type'], $client_assistance[2]['type'],$client_assistance[1]['mode'], $client_assistance[2]['mode'], "burial");
                }else{
                    echo $user->checkService($client_assistance[1]['type'], "",$client_assistance[1]['mode'], "", "burial");
                }?></td>
                <td class="text-center" id="burial-f" style="border: 1px solid black;border-collapse: collapse;"><?php
                    echo (!empty($fundsourcedata[2]['fundsource'])?$fundsourcedata[2]['fundsource']."=".$fundsourcedata[2]['fs_amount']:"");
                ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse: collapse;">Transportation Needs</td>
                <td id="trans-p" style="border: 1px solid black;border-collapse: collapse;"><?php 
                if(!empty($client_assistance[2]['type']) && !empty($client_assistance[2]['purpose'])){
                    echo $user->checkService($client_assistance[1]['type'], $client_assistance[2]['type'],$client_assistance[1]['purpose'], $client_assistance[2]['purpose'], "trans");
                }else{
                    echo $user->checkService($client_assistance[1]['type'], "",$client_assistance[1]['purpose'], "", "trans");
                }?></td>
                <td class="text-center" id="trans-a" style="border: 1px solid black;border-collapse: collapse;"><?php 
                if(!empty($client_assistance[2]['type']) && !empty($client_assistance[2]['amount'])){
                    echo $user->checkService($client_assistance[1]['type'], $client_assistance[2]['type'],$client_assistance[1]['amount'], $client_assistance[2]['amount'], "trans");
                }else{
                    echo $user->checkService($client_assistance[1]['type'], "",$client_assistance[1]['amount'], "", "trans");
                }?></td>
                <td class="text-center" id="trans-m" style="border: 1px solid black;border-collapse: collapse;"><?php 
                if(!empty($client_assistance[2]['type']) && !empty($client_assistance[2]['mode'])){
                    echo $user->checkService($client_assistance[1]['type'], $client_assistance[2]['type'],$client_assistance[1]['mode'], $client_assistance[2]['mode'], "trans");
                }else{
                    echo $user->checkService($client_assistance[1]['type'], "",$client_assistance[1]['mode'], "", "trans");
                }?></td>
                <td class="text-center" id="trans-f" style="border: 1px solid black;border-collapse: collapse;"><?php 
                    echo (!empty($fundsourcedata[3]['fundsource'])?$fundsourcedata[3]['fundsource']."=".$fundsourcedata[3]['fs_amount']:"");
                ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse: collapse;">Educational Support</td>
                <td id="educ-p" style="border: 1px solid black;border-collapse: collapse;"><?php 
                if(!empty($client_assistance[2]['type']) && !empty($client_assistance[2]['purpose'])){
                    echo $user->checkService($client_assistance[1]['type'], $client_assistance[2]['type'],$client_assistance[1]['purpose'], $client_assistance[2]['purpose'], "educ");
                }else{
                    echo $user->checkService($client_assistance[1]['type'], "",$client_assistance[1]['purpose'], "", "educ");
                }?></td>
                <td class="text-center" id="educ-a" style="border: 1px solid black;border-collapse: collapse;"><?php 
                if(!empty($client_assistance[2]['type']) && !empty($client_assistance[2]['amount'])){
                    echo $user->checkService($client_assistance[1]['type'], $client_assistance[2]['type'],$client_assistance[1]['amount'], $client_assistance[2]['amount'], "educ");
                }else{
                    echo $user->checkService($client_assistance[1]['type'], "",$client_assistance[1]['amount'], "", "educ");
                }?></td>
                <td class="text-center" id="educ-m" style="border: 1px solid black;border-collapse: collapse;"><?php 
                if(!empty($client_assistance[2]['type']) && !empty($client_assistance[2]['mode'])){
                    echo $user->checkService($client_assistance[1]['type'], $client_assistance[2]['type'],$client_assistance[1]['mode'], $client_assistance[2]['mode'], "educ");
                }else{
                    echo $user->checkService($client_assistance[1]['type'], "",$client_assistance[1]['mode'], "", "educ");
                }?></td>
                <td class="text-center" id="educ-f" style="border: 1px solid black;border-collapse: collapse;"><?php 
                    echo (!empty($fundsourcedata[4]['fundsource'])?$fundsourcedata[4]['fundsource']."=".$fundsourcedata[4]['fs_amount']:"");
                ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse: collapse;">Food Subsidy Support</td>
                <td id="food-p" style="border: 1px solid black;border-collapse: collapse;"><?php 
                if(!empty($client_assistance[2]['type']) && !empty($client_assistance[2]['purpose'])){
                    echo $user->checkService($client_assistance[1]['type'], $client_assistance[2]['type'],$client_assistance[1]['purpose'], $client_assistance[2]['purpose'], "food sub");
                }else{
                    echo $user->checkService($client_assistance[1]['type'], "",$client_assistance[1]['purpose'], "", "food sub");
                }?></td>
                <td class="text-center" id="food-a" style="border: 1px solid black;border-collapse: collapse;"><?php 
                if(!empty($client_assistance[2]['type']) && !empty($client_assistance[2]['amount'])){
                    echo $user->checkService($client_assistance[1]['type'], $client_assistance[2]['type'],$client_assistance[1]['amount'], $client_assistance[2]['amount'], "food sub");
                }else{
                    echo $user->checkService($client_assistance[1]['type'], "",$client_assistance[1]['amount'], "", "food sub");
                }?></td>
                <td class="text-center" id="food-m" style="border: 1px solid black;border-collapse: collapse;"><?php 
                if(!empty($client_assistance[2]['type']) && !empty($client_assistance[2]['mode'])){
                    echo $user->checkService($client_assistance[1]['type'], $client_assistance[2]['type'],$client_assistance[1]['mode'], $client_assistance[2]['mode'], "food sub");
                }else{
                    echo $user->checkService($client_assistance[1]['type'], "",$client_assistance[1]['mode'], "", "food sub");
                };?></td>
                <td class="text-center" id="food-f" style="border: 1px solid black;border-collapse: collapse;"><?php 
                    echo (!empty($fundsourcedata[5]['fundsource'])?$fundsourcedata[5]['fundsource']."=".$fundsourcedata[5]['fs_amount']:"");
                ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse: collapse;">Non-Food Items</td>
                <td id="non-p" style="border: 1px solid black;border-collapse: collapse;"><?php 
                if(!empty($client_assistance[2]['type']) && !empty($client_assistance[2]['purpose'])){
                    echo $user->checkService($client_assistance[1]['type'], $client_assistance[2]['type'],$client_assistance[1]['purpose'], $client_assistance[2]['purpose'], "non");
                }else{
                    echo $user->checkService($client_assistance[1]['type'], "",$client_assistance[1]['purpose'], "", "non");
                }?></td>
                <td class="text-center" id="non-a" style="border: 1px solid black;border-collapse: collapse;"><?php 
                if(!empty($client_assistance[2]['type']) && !empty($client_assistance[2]['amount'])){
                    echo $user->checkService($client_assistance[1]['type'], $client_assistance[2]['type'],$client_assistance[1]['amount'], $client_assistance[2]['amount'], "non");
                }else{
                    echo $user->checkService($client_assistance[1]['type'], "",$client_assistance[1]['amount'], "", "non");
                }?></td>
                <td class="text-center" id="non-m" style="border: 1px solid black;border-collapse: collapse;"><?php 
                if(!empty($client_assistance[2]['type']) && !empty($client_assistance[2]['mode'])){
                    echo $user->checkService($client_assistance[1]['type'], $client_assistance[2]['type'],$client_assistance[1]['mode'], $client_assistance[2]['mode'], "non");
                }else{
                    echo $user->checkService($client_assistance[1]['type'], "",$client_assistance[1]['mode'], "", "non");
                };?></td>
                <td class="text-center" id="non-f" style="border: 1px solid black;border-collapse: collapse;"></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse: collapse;">Cash Assistance</td>
                <td id="cash-p" style="border: 1px solid black;border-collapse: collapse;"><?php 
                if(!empty($client_assistance[2]['type']) && !empty($client_assistance[2]['purpose'])){
                    echo $user->checkService($client_assistance[1]['type'], $client_assistance[2]['type'],$client_assistance[1]['purpose'], $client_assistance[2]['purpose'], "cash");
                }else{
                    echo $user->checkService($client_assistance[1]['type'], "",$client_assistance[1]['purpose'], "", "cash");
                }?></td>
                <td class="text-center" id="cash-a" style="border: 1px solid black;border-collapse: collapse;"><?php 
                if(!empty($client_assistance[2]['type']) && !empty($client_assistance[2]['amount'])){
                    echo $user->checkService($client_assistance[1]['type'], $client_assistance[2]['type'],$client_assistance[1]['amount'], $client_assistance[2]['amount'], "cash");
                }else{
                    echo $user->checkService($client_assistance[1]['type'], "",$client_assistance[1]['amount'], "", "cash");
                }?></td>
                <td class="text-center" id="cash-m" style="border: 1px solid black;border-collapse: collapse;"><?php 
                if(!empty($client_assistance[2]['type']) && !empty($client_assistance[2]['mode'])){
                    echo $user->checkService($client_assistance[1]['type'], $client_assistance[2]['type'],$client_assistance[1]['mode'], $client_assistance[2]['mode'], "cash");
                }else{
                    echo $user->checkService($client_assistance[1]['type'], "",$client_assistance[1]['mode'], "", "cash");
                }?></td>
                <td class="text-center" id="cash-f" style="border: 1px solid black;border-collapse: collapse;"><?php 
                    echo (!empty($client_assistance[2]['type'])?$client_assistance[2]['fund']."=".$client_assistance[2]['amount']:"");
                ?></td>
            </tr>
        </table>
    </div>
    <!--Below Table-->
    <div class="row" style="font-size: 12px">
        <div class="col-sm-2 col-xs-1" style="margin-top: 5px;">Interviewed by:</div>
        <div class="col-sm-3 col-xs-4" style="padding-left:50px">Reviewed and Approved by:</div>
        <div class="col-sm-3 col-xs-2" ></div>
        <div class="col-sm-2 col-xs-2" style="margin-top: 5px;" >Client</div>
        <div class="col-sm-2 col-xs-2"  style="margin-top: 5px;border:1px solid #000000;height: 100px;"></div>
        </div>  
    <!--Thumbmark-->
    <div class="row" style="font-size: 12px">
        <div class="col-sm-2 col-xs-1"  style="margin-top: 5px;"></div>
        <div class="col-sm-3 col-xs-3" ></div>
        <div class="col-sm-3 col-xs-3" ></div>
        <div class="col-sm-2 col-xs-2"  style="margin-top: 5px;"></div>
        <div class="col-sm-2 col-xs-2"  style="margin-top: 5px;">Client Thumbmark</div>
    </div>  
    
    <div class="row text-center" style="margin:-80px; margin-left: 1px">
        <div class="col-2"><input type="text" style="font-weight: bold; text-transform:uppercase;width: 150%; border-bottom:1px solid black;background: transparent;
    border: none;
    border-bottom: 1px solid #000000;
    -webkit-box-shadow: none;
    box-shadow: none;
    border-radius: 0;
    text-align: center;font-size:13px;margin-top: 8px;" class="ubos" id="soc_work" value="<?php echo strtoupper($soc_workFullname); ?>"><br>
        <input type="text" class="text-center" style="width:130%;border:none;text-transform:none;font-size:12px" id="soc_pos" value="CIU-Social Worker">
        </div>

        <div class="col-sm-3">
            <div style="height: 20px;width:100%;margin-left:60px;margin-top:10px;" class="text-center">
                <p id="signature" style="border-bottom:1px solid #000000;font-weight: bold; text-transform:uppercase;width:100%;font-size:13px;"><?php echo $GISsignatoryName ?></p><br>
                <p style="margin-top:-30px;border:none;text-transform:none;" id="s_position"></p>
            </div>
        </div>

        <div class="col-4"  style="margin-left: 60px"><input class="ubos" type="text" id="client" style="width: 90%;background: transparent;
    border: none;
    border-bottom: 1px solid #000000;
    -webkit-box-shadow: none;
    box-shadow: none;
    border-radius: 0;
    text-align: center;font-size:13px;" value="<?php echo $name ?>">
        <br><p style="font-size: 12px;">Client</p>
        </div>
    </div>
    <!--Container-->    
</div>