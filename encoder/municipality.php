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
  if(isset($_POST['provinceCname'])){
	$result = $user->optionmunicipality($_POST["provinceCname"]);
	
	foreach($result as $index => $value) {
	echo '<option value="'. $value['m_name']  .' /'. $value['psgc_code'] .'">';
	echo $value["psgc_code"];
	echo '</option>';
	}
  }
  elseif(isset($_POST['provinceBname'])){
	
	$result = $user->optionmunicipality($_POST["provinceBname"]);
	
	foreach($result as $index => $value) {
	echo '<option value="'. $value['m_name']  .' /'. $value['psgc_code'] .'">';
	echo $value["psgc_code"];
	echo '</option>';
	}
  }
?>