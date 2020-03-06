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
if(isset($_POST['regionCname'])){
	$result = $user->optionprovince($_POST['regionCname']);

	foreach($result as $index => $value) {
		echo '<option value="'. $value["p_name"]  .' /'. $value['psgc_code'] .'">';
		echo $value["psgc_code"];
		echo '</option>';
	}
}
?>