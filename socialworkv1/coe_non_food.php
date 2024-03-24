<div id='transpo' style="page-break-after:always">
	<br><br>
	<div class="container">
		<div class="row">
			<div class="col">
			<img class="responsive-img" src="../images/dswdlogo.png" width="150px" height="70px" alt="DSWD Logo">
			</div>
			<div class="col-6 col-md-auto">
			<br><p class="text-center">Republic of the Philippines<br>DEPARTMENT OF SOCIAL WELFARE AND DEVELOPMENT<br>Field Office XI, Davao City<p>
			</div>
			<div class="col ml-md-auto">
			<img class="responsive-img right" src="../images/ciu.png" width="180px" height="100px" alt="DSWD Logo" style="margin-top:-15px">
			</div>
		</div>
		<div class="row">
			<div class="col">
			</div>
			<div class="col-6 col-md-auto">
			<p class="text-center font-weight-bold">CRISIS INTERVENTION UNIT<p>
			</div>
			<div class="col ml-md-auto">
			</div>
		</div>
		<div class="row">
			<div class="col">
			</div>
			<div class="col-8 d-flex justify-content-center">
			<input class="text-center font-weight-bold " style="width: 100%; font-size: 22px;" value="C E R T I F I C A T E &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp O F &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp E L I G I B I L I T Y"></input>
			</div>
			<div class="col ml-md-auto">
			</div>
		</div>
		<div class="row">
			<div class="col">
				<br><p>This is to certify that &nbsp&nbsp&nbsp 
				<input class="text-center" style="heigth: 100%; width: 35%;text-transform: uppercase;" value="<?php echo $name?>"></input>
				, &nbsp 
				<input class="text-center" style="heigth: 100%; width: 15%;text-transform: uppercase;" value="<?php echo $client["sex"]?>"></input>
				, &nbsp 
				<input class="text-center" style="heigth: 100%; width: 10%;" value="<?php echo $user->getAge($client["date_birth"])?>"></input>
				&nbsp&nbsp years old and presently residing at &nbsp
				<input class="text-center" style="heigth: 100%; width: 73%; text-transform:uppercase" value="<?php echo $address?>"></input> 
				&nbsp&nbsp has been eligible for education assistance for &nbsp&nbsp 
				<input class="text-center" style="heigth: 100%; width: 45%;" value="<?php echo ($client['relation'] == "Self"? "SELF": $bname)?>"></input> 
				&nbsp&nbsp after thorough assessment has been conducted.</p>
			</div>
		</div>
		<p style="font-size: 15px;;"><b>RECORDS OF THE CASE SUCH AS:</b></p>
		<div class="row">
			<div class="col-6">
			<table style="width: 90%;;">
				<tr style="border: solid 1px;">
					<td style="border-right: solid 1px; width: 20%;"><input class="text-center" style="width: 100%; border: none;" value="&#x2714;"></input></td>
					<td style="width: 80%;" class="text-center">GENERAL INTAKE SHEET</td>
				</tr>
				<tr style="border: solid 1px;">
					<td style="border-right: solid 1px; width: 20%;"><input class="text-center" style="width: 100%; border: none;" value="<?php echo $user->coe_check('referral', $record['document'])?>"></input></td>
					<td style="width: 80%;" class="text-center">REFERRAL LETTER</td>
				</tr>
				<tr style="border: solid 1px;">
					<td style="border-right: solid 1px; width: 20%;"><input class="text-center" style="width: 100%; border: none;" value="<?php echo $user->coe_check('social case', $record['document'])?>"></input></td>
					<td style="width: 80%;" class="text-center">SOCIAL CASE STUDY</td>
				</tr>
				<tr style="border: solid 1px;">
					<td style="border-right: solid 1px; width: 20%;"><input class="text-center" style="width: 100%; border: none;" value="<?php echo $user->coe_check('justification', $record['document'])?>"></input></td>
					<td style="width: 80%;" class="text-center">JUSTIFICATION</td>
				</tr>
				<tr style="border: solid 1px;">
					<td style="border-right: solid 1px; width: 20%;"><input class="text-center" style="width: 100%; border: none;" value="<?php echo $user->coe_check('valid id', $record['document'])?>"></input></p></td>
					<td style="width: 80%;" class="text-center">VALID I.D PRESENTED: &nbsp <u id="i_pres_id"><?php echo $record['id_presented']?></u></td>
				</tr>
				<tr style="border: solid 1px;">
					<td style="border-right: solid 1px; width: 20%;"><input class="text-center" style="width: 100%; border: none;" value="<?php echo $user->coe_check('barangay', $record['document'])?>"></input></td>
					<td style="width: 80%;" class="text-center">BRGY. CERTIFICATE / BRGY. INDIGENCY</td>
				</tr>
				<tr style="border: solid 1px;">
					<td style="border-right: solid 1px; width: 20%;"><input class="text-center" style="width: 100%; border: none;" value="<?php echo $user->coe_check('other', $record['document'])?>"></input></td>
					<td style="width: 80%;" class="text-center">OTHERS: <u><?php echo empty($record)? "": $record['others_input']?></u></td>
				</tr>
			</table>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<br><p>are confidential filed at the Crisis Intervention Unit. The Client is hereby recommended to received assistance for &nbsp 
				<input class="text-center" value="Educational Assistance" style="heigth: 100%; width: 20%; border: none;"></input> 
				&nbsp&nbsp for purpose of &nbsp 
				<b class="text-center" style="heigth: 100%; padding:5px 25px; border-bottom:1px solid black;"><?php echo $client_assistance[1]['purpose']?></b> 
				&nbsp&nbsp in the amount of <br>
				<b class="text-center" style="heigth: 100%; padding:5px 5px; border-bottom:1px solid black;"><?php echo $amountToWord?></b>
				&nbsp&nbsp PHP 
				<input class="text-center" style="heigth: 100%; width: 13%;" value="<?php echo $client_assistance[1]['amount'] ?>"></input></p>
			</div>
		</div>
		<div class="row">
			<div class="col-3">
				<br><p>Chargeable Against : <br>Client Category :  <br>Mode of Admission: </p><br>
			</div>
			<div class="col">
				<br><input class="text-center" style="heigth: 80%; width: 50%; font-size: 16px;" value="AICS Fund"></input><br>
				<input class="text-center" style="heigth: 80%; width: 50%; font-size: 16px;" value="<?php echo $client["category"]; ?>"></input><br>
				<input class="text-center" style="heigth: 80%; width: 50%;" value="<?php echo strtoupper((strtolower($gis["mode_admission"]) == "referral")?"R":"W")?>"></input>
			</div>
		</div>
		<div class="row">
			<div class="col-5">
			</div>
			<div class="col-1">
			</div>
			<div class="col ml-md-auto">
				<p class="right" style="width: 65%;">Prepared by : &nbsp&nbsp&nbsp&nbsp&nbsp <br><br>
				<input class="text-center" style="heigth: 90%; width: 130%; margin-left:50px; font-weight:bold;text-transform: uppercase;" value="<?php echo $soc_worker['empfname'].' '.$soc_worker['empmname'][0].'. '.$soc_worker['emplname'].' '.$soc_worker['empext']?>"/> <br>
				<input class='text-center' style="heigth: 90%; width: 130%; margin-left:50px; border:none" value="CIU-Social Worker"/></p>
				
			</div>
		</div>
		<div class="row">
			<div class="col-5">
				<br><p>Conforme:<br><br>
				<input class="text-center" style="heigth: 90%; width:100%;font-weight:bold;text-transform: uppercase;" value="<?php echo $name?>"/>
				<input class="text-center" style="heigth: 90%; width:100%; border:none" value="<?php echo "Signature Over Printed Name"?>"/>
				<input class="text-center" style="heigth: 90%; width:100%; border:none" value="<?php echo "REQUESTING PARTYs"?>"/></p>
			</div>
			<div class="col-1">
			</div>
			<div class="col ml-md-auto">
				<?php if($am < $rec_amount){ ?>
					<br><p class="right" style="width: 65%;">Approved by : &nbsp&nbsp&nbsp&nbsp&nbsp <br><br>
					<input class="text-center" style="heigth: 90%; width: 130%; margin-left:50px; font-weight:bold;text-transform: uppercase;" value="<?php echo $GISsignatoryName?>"/><br>
					<input class="text-center" style="heigth: 90%; width: 130%; margin-left:50px;  border:none" value="<?php echo $GISsignatory['position']?>"/></p>
				<?php } elseif($am >= $rec_amount){ ?>
					<br><p class="right" style="width: 65%;">Recommending Approval : &nbsp&nbsp&nbsp&nbsp&nbsp <br><br>
					<input class="text-center" style="heigth: 90%; width: 130%; margin-left:50px; font-weight:bold;text-transform: uppercase;" value="<?php echo $GISsignatoryName ?>"/><br>
					<input class="text-center" style="heigth: 90%; width: 130%; margin-left:50px;  border:none" value="<?php echo $GISsignatory['position']?>"/></p>
				<?php } ?>
			</div>
		</div>
		<div class="row">
			<div class="col-5" style="padding-left: 50px; padding-top: 20px;">
				<div <?php echo $user->casestudy('social case', $record['document'], $am)?> >
					<h4>
					NOTE:
					<br>
					<p style="text-indent: 60px"> CASE STUDY REPORT</p>
					<p style="text-indent: 60px; margin-top: -20px"> ON FILE</p>
					</h4>
				</div>
			</div>
			<div class="col-1">
			</div>
			<div class="col ml-md-auto">
				<?php if($am >= $rec_amount){ ?>
					<p class="right" style="width: 65%;">Approved by : &nbsp&nbsp&nbsp&nbsp&nbsp <br><br>
					<input class="text-center" style="heigth: 90%; width: 130%; margin-left:50px; font-weight:bold;text-transform: uppercase;" value="<?php echo $COEsignatoryName?>"/><br>
					<input class="text-center" style="heigth: 90%; width: 130%; margin-left:50px;  border:none" value="<?php echo $COEsignatory['position']?>"/></p>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
