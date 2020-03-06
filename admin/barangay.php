<?php
	include('../php/class.user.php');
	$user = new User();
?>
<?php
	if(!$_SESSION['login']){
		header('Location:../index.php');
		}

?>
<?php
if(isset($_POST['municipalityCname'])){
	$_SESSION['municipalityCname'] = $_POST['municipalityCname'];
	$getbarangay = $user->optionbarangay($_POST['municipalityCname']);
	//Loop through results
	foreach($getbarangay as $index => $value){
		//Display info
		echo '<option data_id="'. $value['psgc_name'] .'" value="'. $value['psgc_name'] .'/'.$value['psgc_code'].'">';
		echo $value['psgc_code'];
		echo '</option>';
	}
}
?>