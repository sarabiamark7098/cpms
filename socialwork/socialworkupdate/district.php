<?php
	include('../../php/class.user.php');
	$user = new User();
?>
<?php
	if(!$_SESSION['login']){
		header('Location:../../index.php');
	}
?>
<?php
    if(isset($_POST["barangayCname"])){
		$municipalitycode = explode("/", $_POST["barangayCname"]);
        $output = '';
		$sql = "SELECT LEFT('".$_POST["barangayCname"]."',6) AS m";
        $result = mysqli_query($user->db, $sql);
		$rows = mysqli_fetch_assoc($result);
		
		$sql = "SELECT d_id FROM municipality WHERE psgc_code LIKE '{$rows['m']}%'";
		$result = mysqli_query($user->db, $sql);
		$rows = mysqli_fetch_assoc($result);

		$sql= "SELECT * FROM tbl_district WHERE d_id = '{$rows['d_id']}'";
		$result = mysqli_query($user->db, $sql);
        if(mysqli_num_rows($result) > 0){
			$row = mysqli_fetch_assoc($result);
			$district = $row["district_name"];

			$getdistrict = $user->getdistrictlist();
			// Loop through results
			// echo "<option value='".(!empty($district)?$district:'Select District')."'>".(!empty($district)?$district:'Select District')."</option>";
			echo "<option value=''>Select District</option>";
			foreach($getdistrict as $index => $value){
				//Display info
				echo '<option value="'. $value['district_name'] .'" '.(($district == $value['district_name'])?"selected":"").'> ';
				echo $value['district_name'];
				echo '</option>';
			}
		}
		else{
			$getdistrict = $user->getdistrictlist();
			// Loop through results
			// echo "<option value='".(!empty($district)?$district:'Select District')."'>".(!empty($district)?$district:'Select District')."</option>";
			echo "<option value=''>Select District</option>";
			foreach($getdistrict as $index => $value){
				//Display info
				echo '<option value="'. $value['district_name'] .'"> ';
				echo $value['district_name'];
				echo '</option>';
			}

		}
    }

	if(isset($_POST["barangayBname"])){
		$municipalitycode = explode("/", $_POST["barangayBname"]);
        $output = '';
		$sql = "SELECT LEFT('".$_POST["barangayBname"]."',6) AS m";
        $result = mysqli_query($user->db, $sql);
		$rows = mysqli_fetch_assoc($result);
		
		$sql = "SELECT d_id FROM municipality WHERE psgc_code LIKE '{$rows['m']}%'";
		$result = mysqli_query($user->db, $sql);
		$rows = mysqli_fetch_assoc($result);

		$sql= "SELECT * FROM tbl_district WHERE d_id = '{$rows['d_id']}'";
		$result = mysqli_query($user->db, $sql);
        if(mysqli_num_rows($result) > 0){
			$row = mysqli_fetch_assoc($result);
			$district = $row["district_name"];

			$getdistrict = $user->getdistrictlist();
			// Loop through results
			// echo "<option value='".(!empty($district)?$district:'Select District')."'>".(!empty($district)?$district:'Select District')."</option>";
			echo "<option value=''>Select District</option>";
			foreach($getdistrict as $index => $value){
				//Display info
				echo '<option value="'. $value['district_name'] .'" '.(($district == $value['district_name'])?"selected":"").'> ';
				echo $value['district_name'];
				echo '</option>';
			}
		}
		else{
			$getdistrict = $user->getdistrictlist();
			// Loop through results
			// echo "<option value='".(!empty($district)?$district:'Select District')."'>".(!empty($district)?$district:'Select District')."</option>";
			echo "<option value=''>Select District</option>";
			foreach($getdistrict as $index => $value){
				//Display info
				echo '<option value="'. $value['district_name'] .'"> ';
				echo $value['district_name'];
				echo '</option>';
			}

		}
    }
?>