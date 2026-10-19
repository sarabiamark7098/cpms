<?php
	include('../../php/class.user.php');
	$user = new User();
?>
<?php
	if(!$_SESSION['login']){
		header('Location:../index.php');
		}
?>
<?php
if(isset($_POST['municipalityCname'])){
	$getbarangay = $user->optionbarangay($_POST['municipalityCname']);
	//Loop through results
	foreach($getbarangay as $index => $value){
		//Display info
		echo '<option value="'. $value['b_name']  .' /'. $value['psgc_code'] .'">';
		echo $value['psgc_code'];
		echo'</option>';
	}
}
elseif(isset($_POST['municipalityBname'])){
	$getbarangay = $user->optionbarangay($_POST['municipalityBname']);
	//Loop through results
	foreach($getbarangay as $index => $value){
		//Display info
		echo '<option value="'. $value['b_name'] .' /'. $value['psgc_code'] .'">';
		echo $value['psgc_code'];
		echo'</option>';
	}
}
?>