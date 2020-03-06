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
    if(isset($_POST["municode"])){
		$municipalitycode = explode(" /", $_POST["municode"]);
        $output = '';
        $sql= "SELECT * FROM psgc WHERE psgc_code LIKE '{$municipalitycode[1]}%' AND psgc_category = 'Municipality'";
        $result = mysqli_query($user->db, $sql);
        if(mysqli_num_rows($result) > 0){
			$row = mysqli_fetch_assoc($result);
			$district = $row["district"];
					
			$json = array('Client_district' => $district);
			echo json_encode($json);
		}
		else{
			echo 'Data not Found';
		}
    }
?>