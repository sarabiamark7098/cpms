<?php
	if(!$_SESSION['login']){
		header('Location:../index.php');
		}

?>
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
				<img class="responsive-img right" src="../images/ciu.png" width="150px" height="70px" alt="DSWD Logo">
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
			<input class="text-center font-weight-bold" style="width: 100%;font-size:22px;border:none;border-bottom: 1px solid #000000;" value="C E R T I F I C A T E &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp O F &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp E L I G I B I L I T Y"></input>
			</div>
			<div class="col ml-md-auto">
			</div>
		</div>
		<div class="row">
			<div class="col">
				<br><p>This is to certify that &nbsp&nbsp&nbsp 
				<input class="text-center" style="heigth:100%;width:35%;text-transform:uppercase;;border:none;border-bottom: 1px solid #000000;" value="<?php echo $coename?>"></input>
				, &nbsp 
				<input class="text-center" style="heigth:100%;width:15%;;border:none;border-bottom: 1px solid #000000;" value="<?php echo $client["sex"]?>"></input>
				, &nbsp 
				<input class="text-center" style="heigth:100%;width:10%;border:none;border-bottom: 1px solid #000000;" value="<?php  echo $clientAge?>"></input>
				&nbsp&nbsp year/s old and presently residing at &nbsp&nbsp 
				<input class="text-center" style="heigth: 100%; width: 75%;border:none;border-bottom: 1px solid #000000;" value="<?php echo $address['client']?>"></input> 
				&nbsp&nbsp has been eligible for financial assistance for &nbsp&nbsp 
				<input class="text-center" style="heigth: 100%; width: 45%;border:none;border-bottom: 1px solid #000000;" value="<?php echo ($client['relation']=='Self'?"SELF":$coebname)?>"></input> 
				&nbsp&nbsp after thorough assessment has been conducted.</p>
			</div>
		</div>
		<p style="font-size: 15px;;"><b>RECORDS OF THE CASE SUCH AS:</b></p>
		<div class="row">
			<div class="col-6">
			<table style="width: 90%;;">
				<tr style="border: solid 1px;">
					<td style="border-right: solid 1px; width: 20%;"><input class="text-center" style="width: 100%; border: none;" value=" &#x2714;"></input></td>
					<td style="width: 80%;" class="text-center">GENERAL INTAKE SHEET</td>
				</tr>
				<tr style="border: solid 1px;">
					<td style="border-right: solid 1px; width: 20%;"><p class="text-center" id="i_ref" style="margin-bottom:-1px"><?php echo $user->returnCheck($coe['document'], "referral");?></p></td>
					<td style="width: 80%;" class="text-center">REFERRAL LETTER</td>
				</tr>
				<tr style="border: solid 1px;">
					<td style="border-right: solid 1px; width: 20%;"><p class="text-center" id="i_soc" style="margin-bottom:-1px"><?php echo $user->returnCheck($coe['document'], "social");?></p></td>
					<td style="width: 80%;" class="text-center">SOCIAL CASE STUDY</td>
				</tr>
				<tr style="border: solid 1px;">
					<td style="border-right: solid 1px; width: 20%;"><p class="text-center" id="i_just" style="margin-bottom:-1px"><?php echo $user->returnCheck($coe['document'], "justification");?></p></td>
					<td style="width: 80%;" class="text-center">JUSTIFICATION</td>
				</tr>
				<tr style="border: solid 1px;">
					<td style="border-right: solid 1px; width: 20%;"><p class="text-center" id="i_valid_id" style="margin-bottom:-1px"><?php echo $user->returnCheck($coe['document'], "valid");?></p></td>
					<td style="width: 80%;" class="text-center">VALID I.D PRESENTED: &nbsp <u id="i_pres_id"><?php echo $coe['id_presented']?></u></td>
				</tr>
				<tr style="border: solid 1px;">
					<td style="border-right: solid 1px; width: 20%;"><p class="text-center" id="i_brgy" style="margin-bottom:-1px"><?php echo $user->returnCheck($coe['document'], "barangay");?></p></td>
					<td style="width: 80%;" class="text-center">BRGY. CERTIFICATE / BRGY. INDIGENCY</td>
				</tr>
				<tr style="border: solid 1px;">
					<td style="border-right: solid 1px; width: 20%;"><p class="text-center" id="i_others" style="margin-bottom:-1px; border: none;"><?php echo $user->returnCheck($coe['document'], "others");?></p></td>
					<td style="width: 80%;" class="text-center">OTHERS: <u><?php echo empty($coe)? "": $coe['others_input']?></u></td>
				</tr>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<br><p>are confidential filed at the Crisis Intervention Unit. The Client is hereby recommended to received assistance for &nbsp 
				<input class="text-center" value="<?php echo $client_assistance[1]['type'] ?>" style="heigth: 100%; width: 30%;border:none;border-bottom: 1px solid #000000;"></input> 
				&nbsp&nbsp for purpose of &nbsp 
				<input class="text-center" style="heigth: 100%; width: 40%;;border:none;border-bottom: 1px solid #000000;" value="<?php echo $client_assistance[1]["purpose"]?>"></input> 
				&nbsp&nbsp in the amount of 
				<input class="text-center" style="heigth: 100%; width: 70%;;border:none;border-bottom: 1px solid #000000;" value="<?php echo $user->toWord($client_assistance[1]["amount"]);?>"></input> 
				&nbsp&nbsp PHP 
				<input class="text-center" style="heigth: 100%; width: 20%;;border:none;border-bottom: 1px solid #000000;" value="<?php echo $client_assistance[1]["amount"] ?>"></input></p>
			</div>
		</div>
		<div class="row">
			<div class="col-3">
				<br><p>Chargeable Against : &nbsp&nbsp&nbsp&nbsp&nbsp <br>Client Category : &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <br>Mode of Admission : &nbsp&nbsp&nbsp&nbsp </p>
			</div>
			<div class="col">
				<p style="heigth: 60%;"></p>
				<input class="text-center" style="heigth: 80%; width: 50%;;border:none;border-bottom: 1px solid #000000;border:none;border-bottom: 1px solid #000000;" value="<?php echo $user->getChargableagainst($_GET["id"]);?>"></input><br>
				<input class="text-center" style="heigth: 80%; width: 50%;;border:none;border-bottom: 1px solid #000000;font-size:12.5px;border:none;border-bottom: 1px solid #000000;" value="<?php echo $client["category"];?>"></input><br>
				<input class="text-center" style="heigth: 80%; width: 50%;;border:none;border-bottom: 1px solid #000000;border:none;border-bottom: 1px solid #000000;" value="<?php echo strtoupper($client["mode_admission"])?>"></input>
			</div>
		</div>
		<div class="row">
			<div class="col-5">
			</div>
			<div class="col-5">
				<br><p class="right" style="width: 65%;">Prepared by : &nbsp&nbsp&nbsp&nbsp&nbsp <br><br>
				<input class="text-center" style="heigth: 90%; width: 130%; margin-left: 20%;font-weight:bold;text-transform: uppercase;border:none;border-bottom: 1px solid #000000;" value="<?php echo $soc_workerFullname?>"/> 
				<br><input class="text-center" style="margin-left:20%;border:none;width: 130%;" value="CIU-Social Worker"></input></p>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-5">
				<br><p>Conforme:<br><br>
				<input class="text-center" style="heigth: 90%; width: 100%;font-weight:bold;text-transform: uppercase;;border:none;border-bottom: 1px solid #000000;" value="<?php echo $coename?>"></p>
				<p class="text-center">Signature Over Printed Name<br>REQUESTING PARTY</p>
			</div>
			<?php if($am > 5000) {?>
				<div class="col-5">
					<br><p class="right" style="width: 65%;">Recommending Approval : &nbsp&nbsp&nbsp&nbsp&nbsp <br><br>
					<input class="text-center" style="heigth: 90%; width: 130%; margin-left: 20%;font-weight:bold;text-transform: uppercase;border:none;border-bottom: 1px solid #000000;" value="<?php echo $signatoryName?>">
					<br><input class="text-center" style="margin-left:20%;border:none;width: 130%;" value="<?php echo $signatory['position']?>"/></p>
				</div>
			<?php } elseif($am <= 5000) {?>
				<div class="col-5">
					<br><p class="right" style="width: 65%;">Approved by : &nbsp&nbsp&nbsp&nbsp&nbsp <br><br>
					<input class="text-center" style="heigth: 90%; width: 130%; margin-left: 20%;font-weight:bold;text-transform: uppercase;border:none;border-bottom: 1px solid #000000;" value="<?php echo $signatoryName?>">
					<br><input class="text-center" style="margin-left:20%;border:none;width: 130%;" value="<?php echo $signatory['position']?>"/></p>
				</div>
			<?php } ?>
		</div>
		<div class="row">
			<div class="col-5" style="padding-left: 50px; padding-top: 20px;">
				<div <?php echo $user->casestudy('social case', $coe['document'], $am)?> >
					<h4>
					NOTE:
					<br>
					<p style="text-indent: 60px"> CASE STUDY REPORT</p>
					<p style="text-indent: 60px; margin-top: -20px"> ON FILE</p>
					</h4>
				</div>
			</div>
			<?php if($am > 5000) {?>
			<div class="col-5">
				<br><p class="right" style="width: 65%;">Approved by : &nbsp&nbsp&nbsp&nbsp&nbsp <br><br>
				<input class="text-center" style="heigth: 90%; width: 130%; margin-left: 20%;font-weight:bold;text-transform: uppercase;border:none;border-bottom: 1px solid #000000;" value="<?php echo $reconsignatoryName?>">
				<br><input class="text-center" style="margin-left:20%;border:none;width: 130%;" value="<?php echo $reconsignatory['position']?>"/></p>
			</div>
			<?php } ?>
		</div>	
	</div>
</div>



