<?php
	error_reporting(0);
	session_start();
	include ("db_config.php");
	include ("db_config2.php");
	// include ("db_config3.php");

	class User{

		//Database
	
		public $db;
		public $name;
		
		public function __construct(){

			$this->db =  mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
				if(mysqli_connect_errno()) 	 {
					die("Database connection failed: " . 
						mysqli_connect_error() . 
						" (" . mysqli_connect_errno() . ")"
					);
				}
			$this->db2 =  mysqli_connect(DB_SERVER2, DB_USERNAME2, DB_PASSWORD2, DB_DATABASE2);
				if(mysqli_connect_errno()) {
					die("Database connection failed: " . 
						mysqli_connect_error() . 
						" (" . mysqli_connect_errno() . ")"
					);
				}
			}
			

			/*** for login process ***/
			public function check_login($user, $pass){
				$username = mysqli_real_escape_string($this->db2,$user); 
				$password = mysqli_real_escape_string($this->db2,$pass); 
				
				$sqlquery="SELECT * from employee_info WHERE empuser='{$username}' and emppass='{$password}'";
		
				//checking if the username is available in the table
				$result = mysqli_query($this->db2,$sqlquery);
				while($row = mysqli_fetch_assoc($result)) {
						$user = $row['empuser'];
						$pass = $row['emppass'];
				
				if(($user === $username) && ($pass === $password)){
					return true;
				}
				else{
					return false;
				}
				}
			}
		
			//check nya ang status kung pwd sa maka login kung active ba sya
			public function check_status($user, $pass){
				$username = mysqli_real_escape_string($this->db2,$user); 
				$password = mysqli_real_escape_string($this->db2,$pass); 
				
				$query = "SELECT status FROM employee_info
				LEFT JOIN tbl_employment USING (empnum)
				LEFT JOIN cpms_account USING (empid)
				WHERE empuser='{$username}' and emppass='{$password}';";
				$result = mysqli_query($this->db2,$query);

				$row = mysqli_fetch_assoc($result);

				$data = $row['status'];

				if($data === 'Activated'){
					return true;
				}
				else{
					return false;
				}
			}
		
			//nagakuha sa position sa user para makapli ug asa sya iredirect
			public function check_user($id){
				$id = mysqli_real_escape_string($this->db2,$id);

				$query = "SELECT * FROM tbl_employment
				LEFT JOIN employee_info  USING (empnum)
				LEFT JOIN cpms_account USING (empid)
				WHERE empid = '{$id}';";
				
				$result = mysqli_query($this->db2,$query);
				$row = mysqli_fetch_assoc($result);
				
				$data['office_id'] = $row['office_id'];
				$data['position'] = $row['position'];
				$data['fullname'] = strtoupper($row['empfname'] ." ". (!empty($row['empmname'][0])?$row['empmname'][0] .". ":""). $row['emplname'] ." ". (!empty($row['empext'][0])?$row['empext'][0] .".":""));
				if($data){
					return $data;
				}
				else {
					return false;
				}
			}

			public function login_log(){
				$datenow = date("Y-m-d H:i:s");

				$query = "INSERT INTO user_log(empid, office_id, login_datetime) VALUES
				('{$_SESSION['userId']}', '{$_SESSION['f_office']}', '{$datenow}')";
				$result = mysqli_query($this->db, $query);

				if($result){
					return $result;
				}else{
					return false;
				}
			}

			public function logout_log(){
				$datenow = date("Y-m-d H:i:s");
				$now = date("Y-m-d");

				$query = "UPDATE user_log SET logout_datetime = '{$datenow}' 
				WHERE empid = '{$_SESSION['userId']}' AND login_datetime LIKE '%{$now}%' AND logout_datetime IS NULL";
				$result = mysqli_query($this->db, $query);

				if($result){
					return $result;
				}else{
					return false;
				}
			}

		// public function Forgot_to_logout(){
		// 	$datenow = date("18:00:00");
			

		// 	$query = "UPDATE user_log SET logout_datetime = '{$datenow}' 
		// 	WHERE empid = '{$_SESSION['userId']}' AND logout_datetime IS NULL";
		// 	$result = mysqli_query($this->db, $query);

		// 	if($result){
		// 		return $result;
		// 	}
		// }
		
			//kuha ug user id para isesson sa linking sa nag encode
			public function getUserId($username, $password){
				$query = "SELECT i.empnum, e.empid, i.emppass, i.empuser 
				FROM tbl_employment e
				LEFT JOIN employee_info i USING (empnum) 
				WHERE empuser = '{$username}' and emppass='{$password}';";
				$result = mysqli_query($this->db2,$query);
				$row = mysqli_fetch_assoc($result);
				$data = $row['empid'];
				if($data){
					return $data;
				}
				else {
					return false;
				}
			}

			public function getuserInfo($id){
				$query = "SELECT i.empfname, i.empmname, i.emplname, i.empext, i.empsex, i.empstatus, i.empnum, e.empid, c.position, c.status, c.office_id 
				FROM employee_info i
				LEFT JOIN tbl_employment e USING (empnum)
				LEFT JOIN cpms_account c USING (empid)
				WHERE empid='{$id}';";
				$result = mysqli_query($this->db2, $query);
				$row = mysqli_fetch_assoc($result);
				if($row){
					return $row;
				}
				else {
					return false;
				}
			}

			public function getuserFullname($id){
				$query = "SELECT i.empfname, i.empmname, i.emplname, i.empext, i.empnum, e.empid, c.*
				FROM employee_info i
				LEFT JOIN tbl_employment e USING (empnum) 
				LEFT JOIN cpms_account c USING (empid) WHERE empid='{$id}';";
				$result = mysqli_query($this->db2, $query);
				$row = mysqli_fetch_assoc($result);
				if($row){
					$fullname = strtoupper($row['empfname'] ." ".(!empty($row['empmname'])?$row['empmname'][0] .". ":""). $row['emplname'] .' '. (!empty($row['empext'])?$row['empext'].".":"") );
					return $fullname;
				}else{
					return "";
				}
			}

			/** Field Offices Page Functions */
			public function optionoffice(){  // Show all rows in table region to SELECT tag of php
				$query = "SELECT * FROM field_office";
				$result = mysqli_query($this->db,$query);
				$rows = mysqli_num_rows($result);
				if($rows > 0){
					return $result;
				}else{
					return false;
				}
			}

			// public function get_offices_to_admin_table(){	// Show all
			// 	$query = "SELECT * FROM field_office;";
			// 	$result = mysqli_query($this->db,$query);
				
			// 	if(mysqli_num_rows($result) > 0) {
			// 		return $result;
			// 	}
			// 	else{
			// 		return false;
			// 	}
			// }

			public function addOffice($officename, $officeacronym, $descrip, $m){
				$municipal = explode("/", $m);
				
				$query = "SELECT LEFT('{$municipal['1']}', 6) as code";
				$result = mysqli_query($this->db,$query);
				$row = mysqli_fetch_assoc($result);
				
				$query = "SELECT office_id FROM field_office WHERE office_id LIKE '%".$row['code']."%';";
				$result = mysqli_query($this->db,$query);
				$num_row = mysqli_num_rows($result);
				$num_row = $num_row + 1;

				$num = sprintf("%02d", $num_row);
				$office_id = $row['code']."-".$num;

				$query = "INSERT INTO field_office(office_id, office_name, office_accronym, description) VALUES
						('{$office_id}', '{$officename}', '{$officeacronym}', '{$descrip}')";
				$result = mysqli_query($this->db,$query);
				
				if($result) {
					return $result;
				}
				else{
					return false;
				}
			}

			public function updateOffice($officename, $officeacronym, $descrip, $m, $fo_id){
				$municipal = explode("/", $m);
				
				$query = "SELECT LEFT('{$municipal['1']}', 6) as code";
				$result = mysqli_query($this->db,$query);
				$row = mysqli_fetch_assoc($result);
				
				$query = "SELECT * FROM field_office WHERE office_id LIKE '%".$row['code']."%';";
				$result = mysqli_query($this->db,$query);
				$num_row = mysqli_num_rows($result);
				$num_row = $num_row + 1;

				$num = sprintf("%02d", $num_row);
				$office_id = $row['code']."-".$num;

				$query = "SELECT LEFT('{$fo_id}', 6) as code";
				$result = mysqli_query($this->db,$query);
				$row1 = mysqli_fetch_assoc($result);
				
				$query = "UPDATE field_office SET ";
				if($row1['code'] != $row['code']){
					$query = "office_id = '{$office_id}', ";
				}
				$query .= "office_name = '{$officename}', description = '{$descrip}', office_accronym = '{$officeacronym}'  WHERE office_id = '{$fo_id}'"; 
				$result = mysqli_query($this->db,$query);
				
				if($result) {
					return $result;
				}
				else{
					return false;
				}
			}

			public function show_office_data($officeid){
				$query = "SELECT * FROM field_office WHERE office_id = '{$officeid}';";
				$result = mysqli_query($this->db,$query);
				$row = mysqli_fetch_assoc($result);
				$rows = mysqli_num_rows($result);
				
				if($rows > 0){
					return $row;
				}
				else{
					return false;
				}
			}

			public function get_office_name($officeid){
				$query = "SELECT * FROM field_office WHERE office_id = '{$officeid}';";
				$result = mysqli_query($this->db,$query);
				$row = mysqli_fetch_assoc($result);
				$rows = mysqli_num_rows($result);
				
				if($rows > 0){
					return $row['office_name'];
				}
				else{
					return false;
				}
			}

			/** Employee Page Functions */
			public function getallEmployee(){
				$query = "SELECT i.empfname, i.empmname, i.emplname, i.empext, i.empsex, i.empstatus, i.empnum, e.empid, c.position, c.status, c.office_id 
				FROM tbl_employment e
				LEFT JOIN employee_info i using (empnum)
				LEFT JOIN cpms_account c using (empid);";
				$result = mysqli_query($this->db2, $query);
				
				return $result;
			}

			public function getEmpData($id){
				$query = "SELECT i.empfname, i.empmname, i.emplname, i.empext, i.empsex, i.empstatus, i.empnum, e.empid, c.position, c.status, c.office_id
				FROM tbl_employment e
				LEFT JOIN employee_info i using (empnum)
				LEFT JOIN cpms_account c using (empid)
				WHERE empid = '{$id}';";
				$result = mysqli_query($this->db2, $query);
				$row = mysqli_fetch_assoc($result);
				
				if($row){
					return $row;
				}else{
					return false;
				}
			}
		
			public function RequestData($id){
				$query = "SELECT * FROM user_request
					WHERE emp_num = '{$id}' AND (date_granted IS NULL AND date_cancel IS NULL);";
				$result = mysqli_query($this->db, $query);
				$row = mysqli_fetch_assoc($result);
				
				if($row){
					return $row;
				}else{
					return false;
				}
			}


			public function compareEmpNum($empnum){
				$query = "SELECT * FROM user_request WHERE emp_num = '{$empnum}' AND (date_granted IS NULL AND date_cancel IS NULL);";
				$result = mysqli_query($this->db, $query);
				$rows = mysqli_fetch_assoc($result);
				$row = mysqli_num_rows($result);
				if($row > 0){
					return $row;
				}else{
					return false;
				}
			}

			public function compareEmpNumSA($empnum, $office){
				$query = "SELECT * FROM user_request WHERE emp_num = '{$empnum}' AND (date_granted IS NULL AND date_cancel IS NULL);";
				$result = mysqli_query($this->db, $query);
				$rows = mysqli_fetch_assoc($result);
				$row = mysqli_num_rows($result);
				if($row > 0){
					return $row;
				}else{
					return false;
				}
			}

			public function updateEmployee($empid, $id, $position, $status, $office){
				if($position != "" && $status != ""){
					$query = "UPDATE cpms_account SET empid = '{$id}', position = '{$position}', status = '{$status}', office_id = '{$office}' WHERE empid = '{$empid}'";
					$result = mysqli_query($this->db2, $query);
				}
				$query = "SELECT empnum FROM  tbl_employment WHERE empid = '{$empid}'";
				$result = mysqli_query($this->db2, $query);
				$row = mysqli_fetch_assoc($result);

				$query = "UPDATE tbl_employment SET empid = '{$id}' WHERE empid = '{$empid}'";
				$result = mysqli_query($this->db2, $query);

				return $result;
			}

			public function cancelRequest($id){
				$datenow = date("Y-m-d H:i:s"); //serve as date_request
				
				$query = "UPDATE user_request SET date_cancel = '{$datenow}' WHERE emp_num = '{$id}'";
				$result = mysqli_query($this->db, $query);

				return $result;
			}

			public function grantRequest($position, $id, $num, $office){
				$datenow = date("Y-m-d H:i:s"); //serve as date_request
				$query = "SELECT * FROM cpms_account WHERE empid = '{$id}'";
				$result = mysqli_query($this->db2, $query);
				$rows = mysqli_fetch_assoc($result);
				$row = mysqli_num_rows($result);
				
				if($row <= 0){
					$query = "UPDATE user_request SET date_granted = '{$datenow}' WHERE emp_num = '{$num}'";
					$result = mysqli_query($this->db, $query);

					$query = "INSERT INTO cpms_account(empid, position, status, office_id) VALUES 
							('{$id}','{$position}','Activated', '{$office}')";
					$result = mysqli_query($this->db2, $query);

					if($result){
						echo "<script>alert('Request Granted')</script>";
						echo "<script>window.location='Employee.php';</script>";
						echo "<meta http-equiv='refresh' content='0'>";
					}else{
						echo "<script>alert('Error! Please Try Again')</script>";
						echo "<script>window.location='Employee.php';</script>";
						echo "<meta http-equiv='refresh' content='0'>";
					}
				}elseif($rows['position'] == $position && $rows['office_id'] == $office){
					
					$query = "UPDATE user_request SET date_cancel = '{$datenow}' WHERE emp_num = '{$num}'";
					$result = mysqli_query($this->db, $query);

					echo "<script>alert('Employee is Already Activated with the same Request')</script>";
					echo "<script>window.location='Employee.php';</script>";
					echo "<meta http-equiv='refresh' content='0'>";
					
				}elseif($rows['position'] != $position || $rows['office_id'] != $office){
					
					$query = "UPDATE cpms_account SET ";
					if($rows['position'] != $position){
					$query .= "position = '{$position}', ";
					}
					if($rows['office_id'] != $office){	
						$query .= "office_id = '{$office}', ";	
					}
					$query .= "status = 'Activated' WHERE empid = '{$id}' ";
					$result = mysqli_query($this->db2, $query);

					if($rows['position'] != $position || $rows['office_id'] != $office){
						$query = "UPDATE user_request SET date_granted = '{$datenow}' WHERE emp_num = '{$num}'";
						$result = mysqli_query($this->db, $query);

						echo "<script>alert('Employee Request Granted')</script>";
						echo "<script>window.location='Employee.php';</script>";
						echo "<meta http-equiv='refresh' content='0'>";
					}else{
						echo "<script>alert('Error! Please Try Again')</script>";
						echo "<script>window.location='Employee.php';</script>";
						echo "<meta http-equiv='refresh' content='0'>";
					}
				}
			}

			public function searchEmployeeforRequest($val){
				$value = mysqli_real_escape_string($this->db2,$val); 
		
				$query = "SELECT empnum, empfname, emplname, empmname, empext FROM employee_info
				WHERE ((CONCAT
				(empfname, ' ',empmname, ' ',emplname)
				LIKE '%".$value."%') 
				OR (CONCAT
				(emplname, ' ',empmname, ' ',empfname)
				LIKE '%".$value."%') 
				OR (CONCAT
				(empmname, ' ',empfname, ' ',emplname)
				LIKE '%".$value."%') 
				OR (CONCAT
				(emplname, ' ',empfname, ' ',empmname)
				LIKE '%".$value."%') 
				OR (CONCAT
				(empmname, ' ',emplname, ' ',empfname)
				LIKE '%".$value."%') 
				OR (CONCAT
				(empfname, ' ',emplname, ' ',empmname)
				LIKE '%".$value."%')) 
				LIMIT 5";
		
				$result = mysqli_query($this->db2, $query);
		
				if($result){
					return $result;
				}
				else{
					return false;
				}
			}

			public function get_employee_data($val){
				$value = mysqli_real_escape_string($this->db2,$val); 
		
				$query = "SELECT * FROM tbl_employment
					LEFT JOIN employee_info using (empnum)
					LEFT JOIN cpms_account using (empid)
					WHERE empnum = '{$value}';";
				$result = mysqli_query($this->db2, $query);
				$row = mysqli_fetch_assoc($result);
				
				if($row){
					return $row;
				}else{
					return false;
				}
			}

		public function insert_request($id, $position, $office){
			$datenow = date("Y-m-d H:i:s"); //serve as date_request
			
			$query = "INSERT INTO user_request(emp_num, request_position, request_office, date_request) VALUES
					('{$id}', '{$position}', '{$office}', '{$datenow}')";
			$result = mysqli_query($this->db, $query);
			if($result){
				return $result;
			}else{
				return false;
			}
		}
		
		public function validateid($id){
			$query = "SELECT * FROM user_request where emp_num = '{$id}' AND (date_granted IS NULL AND date_cancel IS NULL);";
			$result = mysqli_query($this->db, $query);
			$row = mysqli_num_rows($result);

			if($row > 0){
				return $row;
			}else{
				return false;
			}
		}

		// List of information

			public function getdistrictlist(){
				$query = "SELECT * FROM tbl_district;";
				$result = mysqli_query($this->db, $query);
				$rows = mysqli_fetch_assoc($result);
				
				if($rows){
					return $result;
				}else{
					return false;
				}
			}

			public function getDistrict($code) {
				
				$municipalitycode = explode(" /", $code);
				$sql= "SELECT d_id FROM municipality WHERE psgc_code LIKE '{$municipalitycode[1]}%''";
				$result = mysqli_query($this->db, $sql);
				$rows = mysqli_fetch_assoc($result);

				$sql= "SELECT * FROM tbl_district WHERE psgc_code LIKE '{$municipalitycode[1]}%''";
				$result = mysqli_query($this->db, $sql);
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
					$district = $row["district_name"];
					return $district;
                }
			}

			public function getrelationshiplist(){
				$query = "SELECT * FROM tbl_relationship";
				$result = mysqli_query($this->db, $query);
				$rows = mysqli_fetch_assoc($result);
	
				if($rows){
					return $result;
				}else{
					return false;
				}
			}
		
			//Logout
			
			public function user_logout() {
				$_SESSION['login'] = FALSE;
				session_unset();
				session_destroy();  
				
				return true;
			}
			
			//Clear Duplicate
			
			public function cleardup() {
				$query = "UPDATE client_data SET client_id = '-1' WHERE client_id = ''";
				$result = mysqli_query($this->db,$query);

				$query = "UPDATE beneficiary_data SET bene_id = '-1' WHERE bene_id = ''";
				$result = mysqli_query($this->db,$query);
				
				return true;
			}
			
			public function no_dup() {
				$query = "SELECT COUNT(auto_increment_4_id) as dup_no_client FROM client_data WHERE client_id = ''";
				$result = mysqli_query($this->db,$query);
				$row = mysqli_fetch_assoc($result);
				
				$dup_no_client_data = $row['dup_no_client'];
				
				
				$query = "SELECT COUNT(auto_increment_id_bene) as dup_no_bene FROM beneficiary_data WHERE bene_id = ''";
				$result = mysqli_query($this->db,$query);
				$row = mysqli_fetch_assoc($result);
				
				$dup_no_bene_data = $row['dup_no_bene'];
				
				 $a = intval($dup_no_bene_data) + intval($dup_no_client_data);
				
				return $a;
			}
			//Registration
			
			//pag insert ni ddto gikan sa modal sa registration sa users
			public function get_users_data($id, $fullname, $position, $username, $password, $initials){
				$query = "INSERT INTO users (emp_id, fullname, position, username, password, initials, status)
				VALUES
				('{$id}', '{$fullname}', '{$position}', '{$username}', '{$password}', '{$initials}')";
				
				$result = mysqli_query($this->db,$query);
				if($result){
					return true;
				}
				else {
					return false;
				}
			}
		
			//Search Function show data
			
			//pag search sa encoder
			// public  function search_for_socialwork($val){

			// 	$value = mysqli_real_escape_string($this->db,$val); 
				
			// 	$query = "SELECT * FROM client_data
			// 	LEFT JOIN client_address ON client_data.client_id = client_address.client_id
			// 	LEFT JOIN beneficiary_data ON client_data.client_id = beneficiary_data.client_id
			// 	LEFT JOIN transact ON client_data.client_id = transact.client_id 
			// 	WHERE status_client = 'Pending' OR status_client = 'Serving' 
			// 	ORDER BY date_entered ASC;" ;
			// 	$result = mysqli_query($this->db,$query);
		
			// 	if(mysqli_num_rows($result) > 0){
			// 			return $result;
			// 	}else{
			// 		return false;
			// 	}		
			// }
		
			//Admin
			
			//search users
			// public  function search_users($val){

			// 	$value = mysqli_real_escape_string($this->db,$val); 
				
			// 	$query = "SELECT * FROM users WHERE fullname LIKE '%".$value."%';" ;
			// 	$result = mysqli_query($this->db,$query);
		
			// 	if(mysqli_num_rows($result) > 0){
			// 			return $result;
			// 	}else{
			// 		return false;
			// 	}		
			// }
		
			//Show All Employee Data
			public function show_user_data($id){
				
				$id = mysqli_real_escape_string($this->db2,$id);
				
				$query = "SELECT * FROM tbl_employment
				LEFT JOIN employee_info  USING (empnum)
				LEFT JOIN cpms_account USING (empid)
				WHERE empid = '{$id}';";

				$result = mysqli_query($this->db2,$query);
				$row = mysqli_fetch_assoc($result);
				
				if($row){
					return $row;
				}
				else{
					return false;
				}
			}
		
			//pagdisplay sa data sa providers sa admin
			public function get_provider_to_admin_table(){
				$query = "SELECT * FROM provider;";
				$result = mysqli_query($this->db,$query);
				
				if(mysqli_num_rows($result) > 0){
					return $result;
				}
				else{
					return false;
				}
			}
		
			//pag display sa providers na data sa admin
			public function show_provider_data($cid){
				$query = "SELECT * FROM provider WHERE company_id = '{$cid}';";
				$result = mysqli_query($this->db,$query);
				$row = mysqli_fetch_assoc($result);
				$rows = mysqli_num_rows($result);
				
				if($rows > 0){
					return $row;
					
				}
				else{
					return false;
				}
			}		
		
			//update nya ang provider
			public function updateProvider($addresseename, $addresseeposition, $companyid, $addresseetomention, $companyname, $companyaddress){	// UPDATE certain Provider
				$id = $_SESSION['userId'];
				$query1 = "SELECT * FROM tbl_employment
				LEFT JOIN employee_info  USING (empnum)
				LEFT JOIN cpms_account USING (empid)
				WHERE empid = '{$id}';";
				$result1 = mysqli_query($this->db2, $query1);
				
				$row1 = mysqli_fetch_assoc($result1);
				$fullname = strtoupper($row1['empfname'] ." ". (!empty($row1['empmname'][0])?$row1['empmname'][0].'. ':''). $row1['emplname'] ." ". (!empty($row1['empext'][0])?$row1['empext'][0].'.':''));

				$addresseename = mysqli_escape_string($this->db,$addresseename);
				$addresseeposition = mysqli_escape_string($this->db,$addresseeposition);
				$addresseetomention = mysqli_escape_string($this->db,$addresseetomention);
				$addresseetomention = ucwords(strtolower($addresseetomention));
				$companyname = mysqli_escape_string($this->db,$companyname);
				$companyaddress = mysqli_escape_string($this->db,$companyaddress);

				$query = "UPDATE provider SET addressee_name='{$addresseename}', addressee_position='{$addresseeposition}', to_mention='{$addresseetomention}', company_name='{$companyname}', company_address='{$companyaddress}', action_executed_by='{$fullname}' WHERE company_id = {$companyid};";
				
				$result = mysqli_query($this->db,$query);
				if($result){
					return true;
				}
				else {
					return false;
				}
			}
		
			//mag add siya ug company
			public function addCompany($addressee_name, $addressee_position, $addresseetomention, $company_name, $company_address){	// Add Provider
				$id = $_SESSION['userId'];
				$query1 = "SELECT * FROM employee_info 
				LEFT JOIN tbl_employment USING (empnum) 
				LEFT JOIN cpms_account USING (empid) WHERE empid='{$id}';";
				$result1 = mysqli_query($this->db2, $query1);
				
				$row1 = mysqli_fetch_assoc($result1);
				$fullname = strtoupper($row1['empfname'] ." ". (!empty($row1['empmname'][0])?$row1['empmname'][0].'. ':'') . $row1['emplname'] ." ". (!empty($row1['empext'])?$row1['empext'].'.':''));
				$addressee_name = mysqli_escape_string($this->db,$addressee_name);
				$addressee_position = mysqli_escape_string($this->db,$addressee_position);
				$addresseetomention = mysqli_escape_string($this->db,$addresseetomention);
				$addresseetomention = ucwords(strtolower($addresseetomention));
				$company_name = mysqli_escape_string($this->db,$company_name);
				$company_address = mysqli_escape_string($this->db,$company_address);

				$query = "INSERT INTO provider(addressee_name, addressee_position, company_name, to_mention, company_address, action_executed_by) 
				VALUES ('{$addressee_name}','{$addressee_position}','{$company_name}','{$addresseetomention}','{$company_address}','{$fullname}');";

				$result = mysqli_query($this->db,$query);
				if($result){
					return true;
				}
				else{
					
					return false;
				}
			}
		
			//search signatory
			public function search_signatory($val){
				$value = mysqli_real_escape_string($this->db,$val); 
				
				$query = "SELECT * FROM signatory WHERE ((CONCAT
				(first_name, ' ',middle_I, ' ',last_name)
				LIKE '%".$value."%')
				OR (position LIKE '%".$value."%');";
				$result = mysqli_query($this->db,$query);
		
				if(mysqli_num_rows($result) > 0){
						return $result;
				}else{
					return false;
				}		
			}
		
			//i show nya ang tanang data dsto sa admin table
			public function get_signatory_to_admin_table(){	// Show all Signatory
				$query = "SELECT * FROM signatory;";
				$result = mysqli_query($this->db,$query);
				
				if(mysqli_num_rows($result) > 0) {
					return $result;
				}
				else{
					return false;
				}
			}
			
			public function show_signatory_data($signatory_id){	// Get certain Signatory Details
				$query = "SELECT * FROM signatory WHERE signatory_id = '{$signatory_id}';";
				$result = mysqli_query($this->db,$query);
				$row = mysqli_fetch_assoc($result);
				$rows = mysqli_num_rows($result);
				
				if($rows > 0){
					return $row;
				}
				else{
					return false;
				}
			}
		
			public function updatesignatory($signatory_firstname, $signatory_lastname, $signatory_middleI, $signatory_initials, $signatory_position, $signatory_options_GIS, $signatory_options_GL, $signatory_id){	// UPDATE certain Signatory Details
				$query = "UPDATE signatory SET first_name='{$signatory_firstname}', last_name='{$signatory_lastname}', middle_I='{$signatory_middleI}', initials='{$signatory_initials}', position='{$signatory_position}', option_GIS='{$signatory_options_GIS}', option_GL='{$signatory_options_GL}' WHERE signatory_id = '{$signatory_id}';";
				$result = mysqli_query($this->db,$query);
				if($result){
					return true;
				}
				else {
					return false;
				}
			}
		
			public function addsignatory($signatory_firstname, $signatory_lastname, $signatory_middleI, $signatory_initials, $signatory_position, $signatory_options_GIS, $signatory_options_GL, $range_start, $range_end){	// Add Signatory
				$query = "INSERT INTO signatory (first_name, last_name, middle_I, initials, position, option_GIS, option_GL) VALUES ('{$signatory_firstname}',"; 
				$query .= "'{$signatory_lastname}', '{$signatory_middleI}', '{$signatory_initials}', '{$signatory_position}', '{$signatory_options_GIS}', '{$signatory_options_GL}');";
				$result = mysqli_query($this->db,$query);

				if($result){
					return true;
				}
				else{
					return false;
				}
			}
		
			public function get_psgc_to_admin_table(){	//Show all datas regarding the PSGC/Philippine Standard Geographic Code
				$query = "SELECT * FROM psgc_relation 
				RIGHT JOIN region using (psgc_code)
				RIGHT JOIN province using (psgc_code)
				RIGHT JOIN municipality using (psgc_code)
				RIGHT JOIN barangay using (psgc_code) ORDER BY psgc_code ASC";
				$result = mysqli_query($this->db,$query);
				
				if($result) {
					return $result;
				}
				else{
					return false;
				}
			}
		
			public function show_psgc_data($psgc_code){	// Show a certain row datas regarding the PSGC/Philippine Standard Geographic Code
				$query = "SELECT * FROM psgc WHERE psgc_code = '{$psgc_code}'";
				$result = mysqli_query($this->db,$query);
				$row = mysqli_fetch_assoc($result);
				$rows = mysqli_num_rows($result);
				
				if($rows > 0){
					return $row;
				}
				else{
					return false;
				}
			}
		
			public function getregion($psgc_code){
				$query = "SELECT LEFT('{$psgc_code}', 2) as code";
				$result = mysqli_query($this->db,$query);
				$row1 = mysqli_fetch_assoc($result);
				
				$query = "SELECT * FROM region WHERE psgc_code LIKE '{$row1['code']}%';";
				$result = mysqli_query($this->db,$query);
				$row = mysqli_fetch_assoc($result);
				$rows = mysqli_num_rows($result);
				// echo "<script>console.log('".$row['r_name']."')</script>";
				
				if($rows > 0){
					return $row;
				}else{
					return false;
				}
			}
			
			public function getprovince($psgc_code){
				$query = "SELECT LEFT('{$psgc_code}', 4) as code";
				$result = mysqli_query($this->db,$query);
				$row = mysqli_fetch_assoc($result);
				
				$query = "SELECT * FROM province WHERE psgc_code LIKE '{$row['code']}%';";
				$result = mysqli_query($this->db,$query);
				$row = mysqli_fetch_assoc($result);
				$rows = mysqli_num_rows($result);
				if($rows > 0){
					return $row;
				}else{
					return false;
				}
			}
			
			public function getmunicipality($psgc_code){
				$query = "SELECT LEFT('{$psgc_code}', 6) as code";
				$result = mysqli_query($this->db,$query);
				$row = mysqli_fetch_assoc($result);
				
				$query = "SELECT * FROM municipality WHERE psgc_code LIKE '{$row['code']}%';";
				$result = mysqli_query($this->db,$query);
				$row = mysqli_fetch_assoc($result);
				$rows = mysqli_num_rows($result);
				
				if($rows > 0){
					return $row;
				}else{
					return false;
				}
			}
			
			public function getbarangay($psgc_code){
				$query = "SELECT LEFT('{$psgc_code}', 9) as code";
				$result = mysqli_query($this->db,$query);
				$row = mysqli_fetch_assoc($result);
				
				$query = "SELECT * FROM barangay WHERE psgc_code LIKE '{$row['code']}%';";
				$result = mysqli_query($this->db,$query);
				$row = mysqli_fetch_assoc($result);
				$rows = mysqli_num_rows($result);
				if($rows > 0){
					return $row;
				}else{
					return false;
				}
			}
			
			public function optionregion(){  // Show all rows in table region to SELECT tag of php
				$query = "SELECT * FROM region ORDER BY r_name ASC;";
				$result = mysqli_query($this->db,$query);
				$rows = mysqli_num_rows($result);
				if($rows > 0){
					return $result;
				}else{
					return false;
				}
			}
			
			public function optionprovince($region){  // Show all rows in table province to SELECT tag of php
				$query = "SELECT LEFT('{$region}', 2) as code";
				$result = mysqli_query($this->db,$query);
				$row = mysqli_fetch_assoc($result);
				
				$query = "SELECT * FROM province WHERE psgc_code LIKE '{$row['code']}%' ORDER BY p_name asc;";
				$result = mysqli_query($this->db,$query);
				$row = mysqli_fetch_assoc($result);
				$rows = mysqli_num_rows($result);
				if($rows > 0){
					return $result;
				}else{
					return false;
				}
			}
			
			public function optionmunicipality($province){ // Show all rows in table municipality to SELECT tag of php
				$query = "SELECT LEFT('{$province}', 4) as code";
				$result = mysqli_query($this->db,$query);
				$row = mysqli_fetch_assoc($result);
				
				$query = "SELECT * FROM municipality WHERE psgc_code LIKE '{$row['code']}%' ORDER BY m_name asc;";
				$result = mysqli_query($this->db,$query);
				$row = mysqli_fetch_assoc($result);
				$rows = mysqli_num_rows($result);
				if($rows > 0){
					return $result;
				}else{
					return false;
				}
			}
			
			public function optionbarangay($municipality){ // Show all rows in table barangay to SELECT tag of php
				$query = "SELECT LEFT('{$municipality}', 6) as code";
				$result = mysqli_query($this->db,$query);
				$row = mysqli_fetch_assoc($result);
				
				$query = "SELECT * FROM barangay WHERE psgc_code LIKE '{$row['code']}%' ORDER BY b_name asc;";
				$result = mysqli_query($this->db,$query);
				$row = mysqli_fetch_assoc($result);
				$rows = mysqli_num_rows($result);
				if($rows > 0){
					return $result;
				}else{
					return false;
				}
			}
		
		

			public function addPSGCtable($addcode, $addname, $setcategory, $district_name){  // Inserting data to database in table's region,psgc,psgc_codes and getting id of region via select statement and assigning temporary variables for each id;
				if(!empty($district_name)){
					$query = "INSERT INTO psgc (psgc_name, psgc_code, psgc_category, district) VALUES ('{$addname}', '{$addcode}', '{$setcategory}', '{$district_name}');";
					$result = mysqli_query($this->db,$query);
				} else { 
					$query = "INSERT INTO psgc (psgc_name, psgc_code, psgc_category) VALUES ('{$addname}', '{$addcode}', '{$setcategory}');";
					$result = mysqli_query($this->db,$query);
				}
				
				if($result){
					return true;
				} else {
					return false;
				}
			}
		
			public function deleteDescription($setPSGC){ // UPDATING all tables region, province, municipality, and barangay
				$query = "DELETE FROM psgc WHERE psgc_code = '{$setPSGC}';";
				$result = mysqli_query($this->db,$query);
				if($result){
					return true;
				} else {
					return false;
				}
			}
			
			//pagdisplay sa data sa providers sa admin
			public function get_ass_opt_to_admin_table(){
				$query = "SELECT * FROM gisassessment;";
				$result = mysqli_query($this->db,$query);
				
				if(mysqli_num_rows($result) > 0){
					return $result;
				}
				else{
					return false;
				}
			}

			//mag add siya ug GIS Assessment
			public function addassessment($opt, $prob, $ass){	// Add Provider
				$query = "INSERT INTO gisassessment (ass_opt, prob_pres, ass_socwork) VALUES ('{$opt}', '{$prob}', '{$ass}');";
				
				$result = mysqli_query($this->db,$query);
				if($result){
					
					return true;
				}
				else{
					
					return false;
				}
			}
			
			public function show_ass_data($opt){
				$query = "SELECT * FROM gisassessment WHERE ass_opt = '{$opt}';";
				$result = mysqli_query($this->db,$query);
				$row = mysqli_fetch_assoc($result);
				$rows = mysqli_num_rows($result);
				
				if($rows > 0){
					return $row;
					
				}
				else{
					return false;
				}
			}
			
			//update nya ang assessment
			public function updateAssessment($newopt, $prob, $ass, $opt){	// UPDATE certain assessment
				$query = "UPDATE gisassessment SET ass_opt='{$newopt}', prob_pres='{$prob}', ass_socwork='{$ass}' WHERE ass_opt = '{$opt}';";
				$result = mysqli_query($this->db,$query);
				if($result){
					return true;
				}
				else {
					return false;
				}
			}

			//add fundsource addmin function
			public function addFundS($funds,$desc) {
				$query = "INSERT INTO tbl_fundsource(fundsource, fs_description) VALUES ('{$funds}', '{$desc}');";
				$result = mysqli_query($this->db, $query);
				if($result){
					return true;
				}else{
					return false;
				}
			}
			
			//fetch all tbl_fundsource data's
			public function get_fundsource_to_admin_table() {
				$query = "SELECT * FROM tbl_fundsource";
				
				$result = mysqli_query($this->db, $query);
				
				if($result){
					return $result;
				}else{
					return false;
				}
			}

			//fetch data from tbl_fundsource
			public function show_fundsource_data($id) {
				$query = "SELECT * FROM tbl_fundsource WHERE id = '{$id}';";

				$result = mysqli_query($this->db, $query);
				$rows = mysqli_fetch_assoc($result);
				if($result){
					return $rows;
				}else{
					return false;
				}
			}

			public function UpdateFundsource($id, $funds, $desc) {
				$query = "UPDATE tbl_fundsource SET fundsource = '{$funds}', fs_description = '{$desc}' WHERE id = '{$id}';";

				$result = mysqli_query($this->db, $query);
				if($result){
					return true;
				}else{
					return false;
				}
			}

			public function getClientAndEmp($date1, $date2) {
				$query = "SELECT tbl_transaction.trans_id, tbl_transaction.date_accomplished, tbl_transaction.encoded_encoder, tbl_transaction.encoded_socialWork,
						client_data.firstname, client_data.middlename, client_data.lastname, client_data.extraname, beneficiary_data.b_fname, 
						beneficiary_data.b_mname, beneficiary_data.b_lname, beneficiary_data.b_exname FROM tbl_transaction
						LEFT JOIN client_data using (client_id)
						LEFT JOIN beneficiary_data using (bene_id) WHERE (date_accomplished BETWEEN '{$date1}' AND '{$date2}');";

				$result = mysqli_query($this->db, $query);
				return $result;
			}

			public function getClientAndEmpNum($date1, $date2) {
				$query = "SELECT tbl_transaction.trans_id, tbl_transaction.date_accomplished, tbl_transaction.encoded_encoder, tbl_transaction.encoded_socialWork,
						client_data.firstname, client_data.middlename, client_data.lastname, client_data.extraname, beneficiary_data.b_fname, 
						beneficiary_data.b_mname, beneficiary_data.b_lname, beneficiary_data.b_exname FROM tbl_transaction
						LEFT JOIN client_data using (client_id)
						LEFT JOIN beneficiary_data using (bene_id) WHERE (date_accomplished BETWEEN '{$date1}' AND '{$date2}');";

				$result = mysqli_query($this->db, $query);
				$row = mysqli_num_rows($result);
				return $row;
			}

			public function getClientAndEmpSet($emp, $date1, $date2) {
			$query = "SELECT tbl_transaction.trans_id, tbl_transaction.date_accomplished, tbl_transaction.encoded_encoder, tbl_transaction.encoded_socialWork,
						client_data.firstname, client_data.middlename, client_data.lastname, client_data.extraname, beneficiary_data.b_fname, 
						beneficiary_data.b_mname, beneficiary_data.b_lname, beneficiary_data.b_exname FROM tbl_transaction
						LEFT JOIN client_data using (client_id)
						LEFT JOIN beneficiary_data using (bene_id)
						WHERE (encoded_encoder = '{$emp}' OR encoded_socialWork = '{$emp}') AND (date_accomplished BETWEEN '{$date1}' AND '{$date2}');";

				$result = mysqli_query($this->db, $query);
				return $result;
			}
			public function getClientAndEmpSetNum($emp, $date1, $date2) {
				$query = "SELECT tbl_transaction.trans_id, tbl_transaction.date_accomplished, tbl_transaction.encoded_encoder, tbl_transaction.encoded_socialWork,
						client_data.firstname, client_data.middlename, client_data.lastname, client_data.extraname, beneficiary_data.b_fname, 
						beneficiary_data.b_mname, beneficiary_data.b_lname, beneficiary_data.b_exname FROM tbl_transaction
						LEFT JOIN client_data using (client_id)
						LEFT JOIN beneficiary_data using (bene_id)
						WHERE (encoded_encoder = '{$emp}' OR encoded_socialWork = '{$emp}') AND (date_accomplished BETWEEN '{$date1}' AND '{$date2}');";

				$result = mysqli_query($this->db, $query);
				$row = mysqli_num_rows($result);
				return $row;
			}

			public function encodersummarylist() {
				$query = "SELECT distinct encoded_encoder FROM tbl_transaction WHERE status_client = 'Done';";
				$result = mysqli_query($this->db, $query);
				// $row = mysqli_fetch_assoc($result);

				// return $row;
				if ($result) {
					return $result;
				}else{
					return false;
				}
			}

			public function swsummarylist() {
				$query = "SELECT distinct encoded_socialWork FROM tbl_transaction WHERE status_client = 'Done';";
				$result = mysqli_query($this->db, $query);
				// $row = mysqli_fetch_assoc($result);

				// return $row;
				if ($result) {
					return $result;
				}else{
					return false;
				}
			}

			public function getClientAndEmpSetforOsap($emp, $date1, $date2) {
				$query = "SELECT o.trans_id, o.osap_created, o.signatory, o.empid, t.date_accomplished, c.firstname, c.middlename, c.lastname, 
						c.extraname, b.b_fname, b.b_mname, b.b_lname, b.b_exname FROM tbl_osap o
						LEFT JOIN tbl_transaction t using (trans_id)
						LEFT JOIN client_data c using (client_id)
						LEFT JOIN beneficiary_data b using (bene_id)
						WHERE o.empid = '{$emp}' AND o.osap_created BETWEEN '{$date1}' AND '{$date2}';";

				$result = mysqli_query($this->db, $query);
				return $result;
			}

			public function getClientAndEmpSetNumforOsap($emp, $date1, $date2) {
				$query = "SELECT o.trans_id FROM tbl_osap o
						LEFT JOIN tbl_transaction t using (trans_id)
						LEFT JOIN client_data c using (client_id)
						LEFT JOIN beneficiary_data b using (bene_id)
						WHERE o.empid = '{$emp}' AND o.osap_created BETWEEN '{$date1}' AND '{$date2}';";


				$result = mysqli_query($this->db, $query);
				$row = mysqli_num_rows($result);
				return $row;
			}

			public function encoderosaplist() {
				$query = "SELECT distinct empid FROM tbl_osap;";
				$result = mysqli_query($this->db, $query);
				// $row = mysqli_fetch_assoc($result);

				// return $row;
				if ($result) {
					return $result;
				}else{
					return false;
				}
			}
			
			//show client datas for cancellation of gl
			public function show_client_data_for_cancellation_of_gl($id){
				$query = "SELECT * FROM client_data
					LEFT JOIN tbl_transaction using (client_id)
					LEFT JOIN service using (trans_id)
					LEFT JOIN assistance using (trans_id)
					LEFT JOIN beneficiary_data using (bene_id)
					LEFT JOIN gl using (trans_id)
					LEFT JOIN assessment using (trans_id)
					WHERE trans_id = '{$id}';";
				$result = mysqli_query($this->db,$query);
				$row = mysqli_fetch_assoc($result);
				$rows = mysqli_num_rows($result);
				
				if($rows > 0){
					return $row;
				}
				else{
					return false;
				}
			}

			public function cancelGLofClient($id) {
				$now = date("Y-m-d H:i:s");

				$query = "UPDATE tbl_transaction SET status_client = 'Cancelled' WHERE trans_id = '{$id}';";
				$result = mysqli_query($this->db,$query);

				$query = "INSERT INTO cancelgl (trans_id, date_cancelled, empid) VALUES
				('{$id}','{$now}','{$_SESSION['userId']}')";
				$result = mysqli_query($this->db,$query);
				
				if($result){
					return true;
				}else{
					return false;
				}
			}

			public function summaryDataTablecancelledGL($date1, $date2, $datenow, $datenow2) {
				if (empty($datenow) && empty($datenow2)) {
					$query = "SELECT g.trans_id, g.date_cancelled, g.empid, c.lastname, c.firstname, c.middlename, c.extraname, b.b_lname, b.b_fname, b.b_mname, b.b_exname, t.status_client, t.relation, t.date_accomplished
					FROM cancelgl g
					LEFT JOIN tbl_transaction t using (trans_id)
					LEFT JOIN client_data c using (client_id)
					LEFT JOIN beneficiary_data b using (bene_id)
					WHERE (t.status_client = 'Cancelled') AND (g.date_cancelled BETWEEN '{$date1}' AND '{$date2}') ORDER BY g.date_cancelled DESC";
				}else{
					$query = "SELECT g.trans_id, g.date_cancelled, g.empid, c.lastname, c.firstname, c.middlename, c.extraname, b.b_lname, b.b_fname, b.b_mname, b.b_exname, t.status_client, t.relation, t.date_accomplished
					FROM cancelgl g
					LEFT JOIN tbl_transaction t using (trans_id)
					LEFT JOIN client_data c using (client_id)
					LEFT JOIN beneficiary_data b using (bene_id)
					WHERE (t.status_client = 'Cancelled') AND (g.date_cancelled BETWEEN '{$datenow}' AND '{$datenow2}') ORDER BY g.date_cancelled DESC";
				}
				$result = mysqli_query($this->db, $query);
				return $result;
			}
			public function summaryGetNumRowscancelledGL($date1, $date2, $datenow, $datenow2) {
				if (empty($datenow) && empty($datenow2)) {
					$query = "SELECT g.trans_id, g.date_cancelled, g.empid, c.lastname, c.firstname, c.middlename, c.extraname, b.b_lname, b.b_fname, b.b_mname, b.b_exname, t.status_client, t.relation, t.date_accomplished
					FROM cancelgl g
					LEFT JOIN tbl_transaction t using (trans_id)
					LEFT JOIN client_data c using (client_id)
					LEFT JOIN beneficiary_data b using (bene_id)
					WHERE (t.status_client = 'Cancelled') AND (g.date_cancelled BETWEEN '{$date1}' AND '{$date2}') ORDER BY g.date_cancelled DESC";
					$result = mysqli_query($this->db, $query);
					$rownum = mysqli_num_rows($result);
				}else{
					$query = "SELECT g.trans_id, g.date_cancelled, g.empid, c.lastname, c.firstname, c.middlename, c.extraname, b.b_lname, b.b_fname, b.b_mname, b.b_exname, t.status_client, t.relation, t.date_accomplished
					FROM cancelgl g
					LEFT JOIN tbl_transaction t using (trans_id)
					LEFT JOIN client_data c using (client_id)
					LEFT JOIN beneficiary_data b using (bene_id)
					WHERE (t.status_client = 'Cancelled') AND (g.date_cancelled BETWEEN '{$datenow}' AND '{$datenow2}') ORDER BY g.date_cancelled DESC";
					$result = mysqli_query($this->db, $query);
					$rownum = mysqli_num_rows($result);
				}
				return $rownum;
			}
		

			//show datas
			
			//display sa tanang data ddto sa pag view sa fulldetails sa encoder
			public function show_client_data($id){
				$query = "SELECT * FROM client_data
					LEFT JOIN tbl_transaction using (client_id)
					LEFT JOIN service using (trans_id)
					LEFT JOIN assistance using (trans_id)
					LEFT JOIN beneficiary_data using (bene_id)
					LEFT JOIN gl using (trans_id)
					LEFT JOIN assessment using (trans_id)
					WHERE trans_id = '{$id}';";
				$result = mysqli_query($this->db,$query);
				$row = mysqli_fetch_assoc($result);
				$rows = mysqli_num_rows($result);
				
				if($rows > 0){
					return $row;
				}
				else{
					return false;
				}
			}
		
			public function getsocialWork($id){ // get socialwork data on specific id
				$query = "SELECT * FROM tbl_employment
				LEFT JOIN employee_info  USING (empnum)
				LEFT JOIN cpms_account USING (empid)
				WHERE empid = '{$id}';";
				$result = mysqli_query($this->db2,$query);
				$row = mysqli_fetch_assoc($result);
				if($row){
					return $row['empfname'].' '.(!empty($row['empmname'][0])?$row['empmname'][0].'. ':'').$row['emplname'].' '.((empty($row['empext'])||($row['empext']=='none'))?"":$row['empext'].".");
				}
				else {
					return false;
				}
			}

			public function getupdateby($id){ // get employee data on specific id
				$query = "SELECT * FROM tbl_employment
				LEFT JOIN employee_info  USING (empnum)
				LEFT JOIN cpms_account USING (empid)
				WHERE empid = '{$id}';";
				$result = mysqli_query($this->db2,$query);
				$row = mysqli_fetch_assoc($result);
				if($row){
					return $row['empfname'].' '.(!empty($row['empmname'][0])?$row['empmname'][0].'. ':'').$row['emplname'].' '.((empty($row['empext'])||($row['empext']=='none'))?"":$row['empext'].".");
				}
				else {
					return false;
				}
			}

			public function getEncoder($id){ // get encoder data on specific id
				
				$query = "SELECT * FROM employee_info 
				LEFT JOIN tbl_employment USING (empnum)
				LEFT JOIN cpms_account USING (empid)
				WHERE empid='{$id}';";
				$result = mysqli_query($this->db2,$query);
				$row = mysqli_fetch_assoc($result);
				if($row){
					return $row['empfname'].' '.(!empty($row['empmname'][0])?$row['empmname'][0].'. ':'').$row['emplname'].' '.((empty($row['empext'])||($row['empext']=='none'))?"":$row['empext'].".");
				}
				else {
					return false;
				}
			}
		
			public function dateformat($now){
				$d = new DateTime( $now );
				$date = $d->format( 'F d, Y' );
				return $date;
			}

			public function threemonth($now){
				$d = strtotime($now);
				$date = date('F d, Y', strtotime('+ 91 days', $d));
				if($date){
					return $date;
				}
				else {
					return false;
				}
			}

			public function comparefivedays($d){
				// $days = strtotime($d);
				// echo $datefive1 = date("Y-m-t", $days);
				// echo $datefive = date('Y-m-d', strtotime('+ 5 days', $datefive1));
				// $datenow = date("Y-m-d");
				
				$date = date("Y-m-t", strtotime($d));
				$dateafterfivedays = date('Y-m-d', strtotime($date. ' + 5 days')); 
				$presentdate = date("Y-m-d");
				// $presentdate = date("Y-m-d", strtotime(date("Y-m-d"). "+ 4 days"));
				
				if($dateafterfivedays >= $presentdate){
					return 2;
				}else{
					return 1;
				}

				// if($datefive >= $datenow){
				// 	return 2;
				// }else{
				// 	return 1;
				// }
			}

			public function get_days($date1, $date2) { 
				$current = date_create($date1); 
				$datetime2 = date_create($date2); 
				$diff = date_diff($current, $datetime2);
				$days = $diff->format("%a Day/s");
				if($days){
					return $days;
				}
				else {
					return false;
				} 
			} 
		
			public function datediffFromToEnd($now){ 
				$e = strtotime($now);
				$dateEnd = date('Y-m-d', strtotime('+ 91 days', $e));
				
				$dateStart = date('Y-m-d');
				
				//$dateStart = new DateTime($dateStart);
				//$date = DateTime::createFromFormat('Y-m-d', $now)->diff($dateEnd)->d;
				if($dateEnd >= $dateStart){
					$date = $this->get_days($dateStart, $dateEnd);
				}else{
					$date = $this->get_days(1999-12-12, 1999-12-12);
				}
				if($date){
					return $date;
				}
				else {
					return false;
				}
			}
		
			//Encoder //New Client
			
			//sa paginsert sa client data na sya mismo ang beneficiary
			public function insertClient($f, $m, $l, $e, $sex, $bday, $age, $occupation, $salary, $category, $cstatus,$contact,
			$r, $p, $c, $brgy, $d, $street){ 
				
				$datenow = date("Y-m-d H:i:s"); //serve as date_entered
				$relation = "Self";
				$encoder = $_SESSION['userId'];
				$office_id = $_SESSION['f_office'];
				// $catered = "no";
				$status_client = "Pending";
				$note = "yes";
				// $action = "passed";
				
				// $query = "SELECT office FROM cpms_account where empid = '{$encoder}'";
				// $result = mysqli_query($this->db2, $query);
				// $row = mysqli_fetch_assoc($result);

				$now = DateTime::createFromFormat('U.u', number_format(microtime(true), 6, '.', ''));
				$datetoid = date_format($now, 'YmdHisu');
				$newtransid = $office_id.'-'.$datetoid;
				
				$query = "INSERT INTO `client_data`(`lastname`, `firstname`, `middlename`, `extraname`, `sex`, 
				`civil_status`, `date_birth`, `occupation`, `salary`, `contact`, `category`, 
				`client_region`, `client_province`, `client_municipality`, `client_barangay`, `client_street`, `client_district`, date_inserted) 
				VALUES ('{$l}','{$f}','{$m}','{$e}','{$sex}','{$cstatus}','{$bday}','{$occupation}',
				'{$salary}','{$contact}','{$category}','{$r}','{$p}','{$c}','{$brgy}','{$street}','{$d}', '{$datenow}')";
				$result = mysqli_query($this->db,$query);
				
				$query = "SELECT auto_increment_4_id FROM client_data WHERE lastname = '{$l}' AND firstname = '{$f}' AND middlename = '{$m}' AND date_inserted = '{$datenow}'";
				$result = mysqli_query($this->db,$query);
				$row = mysqli_fetch_assoc($result);
				
				$newclientid = "C-".$row['auto_increment_4_id'];
				$query = "UPDATE client_data SET client_id = '{$newclientid}' WHERE auto_increment_4_id = '{$row['auto_increment_4_id']}'";
				$result = mysqli_query($this->db,$query);
				$query = "INSERT INTO tbl_transaction (trans_id, client_id, relation, date_entered, encoded_encoder, note, status_client, clientonly) VALUES 
				('{$newtransid}','{$newclientid}', '{$relation}', '{$datenow}', '{$encoder}', '{$note}','{$status_client}',1)";
				$result = mysqli_query($this->db,$query);
				
				if($result){
					return $newtransid;
				}
				else{
					return false;
				}
				
			}

		//pag insert sa data sa client na naa syay benefeciary
		public function insertClientWB($f, $m, $l, $e, $sex, $bday, $occupation, $salary, $category,
		$cstatus, $contact, $r, $p, $c, $brgy, $d, $street, $relationship, $bf, $bm, $bl, $be, $b_bday, 
		$b_sex, $b_cstatus, $b_contact, $b_occupation, $b_salary, $b_category, $b_region, $b_province, $b_city, $b_district, $b_barangay, $b_street){ 
			$datenow = date("Y-m-d H:i:s"); //serve as date_entered
			$encoder = $_SESSION['userId'];
			// $catered = "no";
			$status_client = "Pending";
			$office_id = $_SESSION['f_office'];
			$note = "yes";
			// $action = "passed";
			
			// $query = "SELECT office FROM cpms_account where empid = '{$encoder}'";
			// $result = mysqli_query($this->db2, $query);
			// $row = mysqli_fetch_assoc($result);

			$now = DateTime::createFromFormat('U.u', number_format(microtime(true), 6, '.', ''));
			$datetoid = date_format($now, 'YmdHisu');
			$newtransid = $office_id.'-'.$datetoid;
			
			$query = "INSERT INTO `client_data`(`lastname`, `firstname`, `middlename`, `extraname`, `sex`, 
			`civil_status`, `date_birth`, `occupation`, `salary`, `contact`, `category`, 
			`client_region`, `client_province`, `client_municipality`, 
			`client_barangay`, `client_street`, `client_district`, date_inserted) VALUES ('{$l}','{$f}','{$m}',
			'{$e}','{$sex}','{$cstatus}','{$bday}','{$occupation}','{$salary}','{$contact}','{$category}',
			'{$r}','{$p}','{$c}','{$brgy}','{$street}','{$d}', '{$datenow}')";
		 	$result = mysqli_query($this->db,$query);
			
			$query = "SELECT auto_increment_4_id FROM client_data WHERE lastname = '{$l}' AND firstname = '{$f}' AND middlename = '{$m}' AND date_inserted = '{$datenow}'";
			$result = mysqli_query($this->db,$query);
			$row = mysqli_fetch_assoc($result);
			
			$newclientid = "C-".$row['auto_increment_4_id'];
			
			$query = "UPDATE client_data SET client_id = '{$newclientid}' WHERE auto_increment_4_id = '{$row['auto_increment_4_id']}'";
			$result = mysqli_query($this->db,$query);

			$query = "INSERT INTO `beneficiary_data`(`b_fname`, `b_mname`, `b_lname`, `b_exname`, 
			`b_civilStatus`, `b_contact`, `b_bday`, `b_sex`, `b_occupation`, `b_salary`, `b_category`, `b_region`, 
			`b_province`, `b_municipality`, `b_barangay`, `b_district`, `b_street`, b_date_inserted) VALUES ('{$bf}','{$bm}',
			'{$bl}','{$be}','{$b_cstatus}','{$b_contact}','{$b_bday}','{$b_sex}','{$b_occupation}','{$b_salary}','{$b_category}',
			'{$b_region}','{$b_province}','{$b_city}','{$b_barangay}','{$b_district}','{$b_street}', '{$datenow}')";
			$result = mysqli_query($this->db,$query);
			
			$query = "SELECT auto_increment_id_bene FROM beneficiary_data WHERE b_lname = '{$bl}' AND b_fname = '{$bf}' AND b_mname = '{$bm}' AND b_date_inserted = '{$datenow}'";
			$result = mysqli_query($this->db,$query);
			$row = mysqli_fetch_assoc($result);

			$newbeneid = "B-".$row['auto_increment_id_bene'];
			
			$query = "UPDATE beneficiary_data SET bene_id = '{$newbeneid}' WHERE auto_increment_id_bene = '{$row['auto_increment_id_bene']}'";
			$result = mysqli_query($this->db,$query);
			
			$query = "INSERT INTO tbl_transaction (trans_id, client_id, bene_id, relation, date_entered, encoded_encoder, note, status_client, clientonly, clientsamebene, benetoclient) VALUES 
			('{$newtransid}', '{$newclientid}', '{$newbeneid}', '{$relationship}', '{$datenow}', '{$encoder}', '{$note}','{$status_client}',1,1,1)";
			$result = mysqli_query($this->db,$query);

			if($result){
				return $newtransid;
			}
			else{
				return false;
			}
		}
		
		public function insertClientPassed($transid, $f, $m, $l, $e, $sex, $bday, $occupation, $salary, $category, $subcat, 
		$cstatus,$contact, $r, $p, $c, $brgy, $d, $street, $note){ 
			$datenow = date("Y-m-d H:i:s"); //serve as date_entered
			$relation = "Self";
			$encoder = $_SESSION['userId'];
			$office_id = $_SESSION['f_office'];
			// $catered = "no";
			$status_client = "Pending";
			// $action = "passed";
			if(empty($note)){
				$note = "yes";
			}

			// $query = "SELECT office FROM cpms_account where empid = '{$encoder}'";
			// $result = mysqli_query($this->db2, $query);
			// $row = mysqli_fetch_assoc($result);

			$now = DateTime::createFromFormat('U.u', number_format(microtime(true), 6, '.', ''));
			$datetoid = date_format($now, 'YmdHisu');
			$newtransid = $office_id.'-'.$datetoid;

			$query = "SELECT * FROM tbl_transaction WHERE trans_id = '{$transid}'";
			$result = mysqli_query($this->db,$query);
			$row = mysqli_fetch_assoc($result);

			$query = "INSERT INTO tbl_transaction (trans_id, client_id, relation, date_entered, encoded_encoder, note, status_client, clientonly) 
			VALUES ('{$newtransid}', '{$row['client_id']}', '{$relation}', '{$datenow}', '{$encoder}', '{$note}','{$status_client}', 1)";
			$result = mysqli_query($this->db,$query);

			$query = "UPDATE tbl_transaction SET clientonly = 0 WHERE trans_id = '{$transid}'";
			$result = mysqli_query($this->db,$query);

			$query ="SELECT * FROM client_data WHERE client_id = '{$row['client_id']}'";
			$result = mysqli_query($this->db, $query);
			$row0 = mysqli_fetch_assoc($result);
			
			if($row0['firstname']!=$f||$row0['middlename']!=$m||$row0['lastname']!=$l||$row0['extraname']!=$e||$row0['sex']!=$sex||$row0['date_birth']!=$bday||$row0['occupation']!=$occupation||$row0['salary']!=$salary||
			$row0['category']!=$category||$row0['subCategory']!=$subcat||$row0['civil_status']!=$cstatus||$row0['contact']!=$contact||$row0['client_region']!=$r||$row0['client_province']!=$p||$row0['client_municipality']!=$c||
			$row0['client_barangay']!=$brgy||$row0['client_district']!=$d||$row0['client_street']!=$street){
				$query = "UPDATE client_data SET ";
				if($row0['firstname']!=$f){$query .= "firstname = '{$f}',";}
				if($row0['middlename']!=$m){$query .= "middlename = '{$m}',";}
				if($row0['lastname']!=$l){$query .= "lastname = '{$l}',";}
				if($row0['extraname']!=$e){$query .= "extraname = '{$e}',";}
				if($row0['sex']!=$sex){$query .= "sex = '{$sex}',";}
				if($row0['date_birth']!=$bday){$query .= "date_birth = '{$bday}',";}
				if($row0['occupation']!=$occupation){$query .= "occupation = '{$occupation}',";}
				if($row0['salary']!=$salary){$query .= "salary = '{$salary}',";}
				if($row0['category']!=$category){$query .= "category = '{$category}',";}
				if($row0['subCategory']!=$subcat){$query .= "subCategory = '{$subcat}',";}
				if($row0['civil_status']!=$cstatus){$query .= "civil_status = '{$cstatus}',";}
				if($row0['contact']!=$contact){$query .= "contact = '{$contact}',";}
				if($row0['client_region']!=$r){$query .= "client_region = '{$r}',";}
				if($row0['client_province']!=$p){$query .= "client_province = '{$p}',";}
				if($row0['client_municipality']!=$c){$query .= "client_municipality = '{$c}',";}
				if($row0['client_barangay']!=$brgy){$query .= "client_barangay = '{$brgy}',";}
				if($row0['client_district']!=$d){$query .= "client_district = '{$d}',";}
				if($row0['client_street']!=$street){$query .= "client_street = '{$street}' ";}
				$query .= "WHERE client_id = '{$row['client_id']}'";
				$result = mysqli_query($this->db,$query);
			}
			
			if($row){
				return $newtransid;
			}
			else{
				return false;
			}
			
		}
		
		public function insertClientWBPassed($transid, $f, $m, $l, $e, $sex, $bday, 
		$occupation, $salary, $category, $subcategory, $cstatus, $contact, $r, $p, $c, $brgy, $d, $street, 
		$relationship, $bf, $bm, $bl, $be, $b_bday, $b_sex, $b_cstatus, $b_contact, $b_category, $b_subCat,
		 $b_region, $b_province, $b_city, $b_district, $b_barangay, $b_street, $note){ 
			$datenow = date("Y-m-d H:i:s"); //serve as date_entered
			$encoder = $_SESSION['userId'];
			$office_id = $_SESSION['f_office'];
			// $catered = "no";
			$status_client = "Pending";
			// $action = "passed";
			if(empty($note)){
				$note = "yes";
			}
			
			// $query = "SELECT office FROM cpms_account where empid = '{$encoder}'";
			// $result = mysqli_query($this->db2, $query);
			// $row = mysqli_fetch_assoc($result);

			$now = DateTime::createFromFormat('U.u', number_format(microtime(true), 6, '.', ''));
			$datetoid = date_format($now, 'YmdHisu');
			$newtransid = $office_id.'-'.$datetoid;

			$query = "SELECT * FROM tbl_transaction WHERE trans_id = '{$transid}'";
			$result = mysqli_query($this->db,$query);
			$row = mysqli_fetch_assoc($result);

			$client_id = $row['client_id'];
			
			$query ="SELECT * FROM client_data WHERE client_id = '{$client_id}'";
			$result = mysqli_query($this->db, $query);
			$row0 = mysqli_fetch_assoc($result);
			
			if($row0['firstname']!=$f||$row0['middlename']!=$m||$row0['lastname']!=$l||$row0['extraname']!=$e||$row0['sex']!=$sex||$row0['date_birth']!=$bday||$row0['occupation']!=$occupation||$row0['salary']!=$salary||
			$row0['category']!=$category||$row0['subCategory']!=$subcategory||$row0['civil_status']!=$cstatus||$row0['contact']!=$contact||$row0['client_region']!=$r||$row0['client_province']!=$p||$row0['client_municipality']!=$c||
			$row0['client_barangay']!=$brgy||$row0['client_district']!=$d||$row0['client_street']!=$street){
				$query = "UPDATE client_data SET ";
				if($row0['firstname']!=$f){$query .= "firstname = '{$f}',";}
				if($row0['middlename']!=$m){$query .= "middlename = '{$m}',";}
				if($row0['lastname']!=$l){$query .= "lastname = '{$l}',";}
				if($row0['extraname']!=$e){$query .= "extraname = '{$e}',";}
				if($row0['sex']!=$sex){$query .= "sex = '{$sex}',";}
				if($row0['date_birth']!=$bday){$query .= "date_birth = '{$bday}',";}
				if($row0['occupation']!=$occupation){$query .= "occupation = '{$occupation}',";}
				if($row0['salary']!=$salary){$query .= "salary = '{$salary}',";}
				if($row0['category']!=$category){$query .= "category = '{$category}',";}
				if($row0['subCategory']!=$subcategory){$query .= "subCategory = '{$subcategory}',";}
				if($row0['civil_status']!=$cstatus){$query .= "civil_status = '{$cstatus}',";}
				if($row0['contact']!=$contact){$query .= "contact = '{$contact}',";}
				if($row0['client_region']!=$r){$query .= "client_region = '{$r}',";}
				if($row0['client_province']!=$p){$query .= "client_province = '{$p}',";}
				if($row0['client_municipality']!=$c){$query .= "client_municipality = '{$c}',";}
				if($row0['client_barangay']!=$brgy){$query .= "client_barangay = '{$brgy}',";}
				if($row0['client_district']!=$d){$query .= "client_district = '{$d}',";}
				if($row0['client_street']!=$street){$query .= "client_street = '{$street}' ";}
				$query .= "WHERE client_id = '{$row['client_id']}'";
				$result = mysqli_query($this->db,$query);
			}

			$query = "INSERT INTO `beneficiary_data`(`b_fname`, `b_mname`, `b_lname`, `b_exname`, 
			`b_civilStatus`, `b_contact`, `b_bday`, `b_sex`, `b_category`, `b_subCategory`, `b_region`, 
			`b_province`, `b_municipality`, `b_barangay`, `b_district`, `b_street`, b_date_inserted) VALUES ('{$bf}','{$bm}',
			'{$bl}','{$be}','{$b_cstatus}','{$b_contact}','{$b_bday}','{$b_sex}','{$b_category}','{$b_subCat}',
			'{$b_region}','{$b_province}','{$b_city}','{$b_barangay}','{$b_district}','{$b_street}', '{$datenow}')";
			$result = mysqli_query($this->db,$query);
			
			$query = "SELECT auto_increment_id_bene FROM beneficiary_data WHERE b_lname = '{$bl}' AND b_fname = '{$bf}' AND b_mname = '{$bm}' AND b_date_inserted = '{$datenow}'";
			$result = mysqli_query($this->db,$query);
			$row = mysqli_fetch_assoc($result);

			$newbeneid = "B-".$row['auto_increment_id_bene'];
			
			$query = "UPDATE beneficiary_data SET bene_id = '{$newbeneid}' WHERE auto_increment_id_bene = '{$row['auto_increment_id_bene']}'";
			$result = mysqli_query($this->db,$query);

			$query = "INSERT INTO tbl_transaction (trans_id, client_id, bene_id, relation, date_entered, encoded_encoder, note, status_client, clientonly, clientsamebene, benetoclient) 
			VALUES ('{$newtransid}', '{$client_id}', '{$newbeneid}', '{$relationship}', '{$datenow}', '{$encoder}', '{$note}','{$status_client}', 1, 1, 1)";
			$result = mysqli_query($this->db,$query);
			
			$query = "UPDATE tbl_transaction SET clientonly = 0 WHERE trans_id = '{$transid}'";
			$result = mysqli_query($this->db,$query);
			
			if($result){
				return $newtransid;
			}
			else{
				return false;
			}
		}
		
		//sa paginsert sa client data na sya mismo ang beneficiary
		public function insertBeneAsClient($transid, $f, $m, $l, $e, $sex, $bday, $occupation, $salary, $category, 
		$subcat, $cstatus,$contact, $r, $p, $c, $brgy, $d, $street, $note){
			$datenow = date("Y-m-d H:i:s"); //serve as date_entered
			$relation = "Self";
			$encoder = $_SESSION['userId'];
			$office_id = $_SESSION['f_office'];
			// $catered = "no";
			$status_client = "Pending";
			if(empty($note)){
				$note = "yes";
			}
			// $action = "passed";
			
			// $query = "SELECT office FROM cpms_account where empid = '{$encoder}'";
			// $result = mysqli_query($this->db2, $query);
			// $row = mysqli_fetch_assoc($result);

			$now = DateTime::createFromFormat('U.u', number_format(microtime(true), 6, '.', ''));
			$datetoid = date_format($now, 'YmdHisu');
			$newtransid = $office_id.'-'.$datetoid;
			
			$query = "INSERT INTO `client_data`(`lastname`, `firstname`, `middlename`, `extraname`, `sex`, 
			`civil_status`, `date_birth`, `occupation`, `salary`, `contact`, `category`, `subCategory`, 
			`client_region`, `client_province`, `client_municipality`, `client_barangay`, `client_street`, `client_district`, date_inserted) 
			VALUES ('{$l}','{$f}','{$m}','{$e}','{$sex}','{$cstatus}','{$bday}','{$occupation}',
			'{$salary}','{$contact}','{$category}','{$subcat}','{$r}','{$p}','{$c}','{$brgy}','{$street}','{$d}', '{$datenow}')";
		 	$result = mysqli_query($this->db,$query);
			
			$query = "SELECT auto_increment_4_id FROM client_data WHERE lastname = '{$l}' AND firstname = '{$f}' AND middlename = '{$m}' AND date_inserted = '{$datenow}'";
			$result = mysqli_query($this->db,$query);
			$row = mysqli_fetch_assoc($result);
			
			$newclientid = "C-".$row['auto_increment_4_id'];
			
			$query = "UPDATE client_data SET client_id = '{$newclientid}' WHERE auto_increment_4_id = '{$row['auto_increment_4_id']}'";
			$result = mysqli_query($this->db,$query);
 
			$query = "INSERT INTO tbl_transaction (trans_id, client_id, relation, date_entered, encoded_encoder, note, status_client, clientonly) VALUES 
			('{$newtransid}','{$newclientid}', '{$relation}', '{$datenow}', '{$encoder}', '{$note}','{$status_client}',1)";
			$result = mysqli_query($this->db,$query);

			$query = "UPDATE tbl_transaction SET benetoclient = 0 WHERE trans_id = '{$transid}'";
			$result = mysqli_query($this->db,$query);
			
			if($result){
				return $newtransid;
			}
			else{
				return false;
			}
			
		}

		//pag insert sa data sa client na naa syay benefeciary
		public function insertBeneAsClientWB($transid, $f, $m, $l, $e, $sex, $bday, $occupation, $salary, $category, $subcategory, 
		$cstatus, $contact, $r, $p, $c, $brgy, $d, $street, $relationship, $bf, $bm, $bl, $be, $b_bday, $b_sex, $b_cstatus, 
		$b_contact, $b_category, $b_subCat, $b_region, $b_province, $b_city, $b_district, $b_barangay, $b_street, $note){ 
			$datenow = date("Y-m-d H:i:s"); //serve as date_entered
			$encoder = $_SESSION['userId'];
			$office_id = $_SESSION['f_office'];
			// $catered = "no";
			$status_client = "Pending";
			if(empty($note)){
				$note = "yes";
			}
			// $action = "passed";

			// $query = "SELECT office FROM cpms_account where empid = '{$encoder}'";
			// $result = mysqli_query($this->db2, $query);
			// $row = mysqli_fetch_assoc($result);

			$now = DateTime::createFromFormat('U.u', number_format(microtime(true), 6, '.', ''));
			$datetoid = date_format($now, 'YmdHisu');
			$newtransid = $office_id.'-'.$datetoid;
			
			$query = "INSERT INTO `client_data`(`lastname`, `firstname`, `middlename`, `extraname`, `sex`, 
			`civil_status`, `date_birth`, `occupation`, `salary`, `contact`, `category`, `subCategory`, 
			`client_region`, `client_province`, `client_municipality`, 
			`client_barangay`, `client_street`, `client_district`, date_inserted) VALUES ('{$l}','{$f}','{$m}',
			'{$e}','{$sex}','{$cstatus}','{$bday}','{$occupation}','{$salary}','{$contact}','{$category}','{$subcategory}',
			'{$r}','{$p}','{$c}','{$brgy}','{$street}','{$d}', '{$datenow}')";
		 	$result = mysqli_query($this->db,$query);
			
			$query = "SELECT auto_increment_4_id FROM client_data WHERE lastname = '{$l}' AND firstname = '{$f}' AND middlename = '{$m}' AND date_inserted = '{$datenow}'";
			$result = mysqli_query($this->db,$query);
			$row = mysqli_fetch_assoc($result);
			
			$newclientid = "C-".$row['auto_increment_4_id'];
			
			$query = "UPDATE client_data SET client_id = '{$newclientid}' WHERE auto_increment_4_id = '{$row['auto_increment_4_id']}'";
			$result = mysqli_query($this->db,$query);

			$query = "INSERT INTO `beneficiary_data`(`b_fname`, `b_mname`, `b_lname`, `b_exname`, 
			`b_civilStatus`, `b_contact`, `b_bday`, `b_sex`, `b_category`, `b_subCategory`, `b_region`, 
			`b_province`, `b_municipality`, `b_barangay`, `b_district`, `b_street`, b_date_inserted) VALUES ('{$bf}','{$bm}',
			'{$bl}','{$be}','{$b_cstatus}','{$b_contact}','{$b_bday}','{$b_sex}','{$b_category}','{$b_subCat}',
			'{$b_region}','{$b_province}','{$b_city}','{$b_barangay}','{$b_district}','{$b_street}', '{$datenow}')";
			$result = mysqli_query($this->db,$query);
			
			$query = "SELECT auto_increment_id_bene FROM beneficiary_data WHERE b_lname = '{$bl}' AND b_fname = '{$bf}' AND b_mname = '{$bm}' AND b_date_inserted = '{$datenow}'";
			$result = mysqli_query($this->db,$query);
			$row = mysqli_fetch_assoc($result);

			$newbeneid = "B-".$row['auto_increment_id_bene'];
			
			$query = "UPDATE beneficiary_data SET bene_id = '{$newbeneid}' WHERE auto_increment_id_bene = '{$row['auto_increment_id_bene']}'";
			$result = mysqli_query($this->db,$query);
			
			$query = "INSERT INTO tbl_transaction (trans_id, client_id, bene_id, relation, date_entered, encoded_encoder, note, status_client, clientonly, clientsamebene, benetoclient) VALUES 
			('{$newtransid}', '{$newclientid}', '{$newbeneid}', '{$relationship}', '{$datenow}', '{$encoder}', '{$note}','{$status_client}',1,1,1)";
			$result = mysqli_query($this->db,$query);

			$query = "UPDATE tbl_transaction SET benetoclient = 0 WHERE trans_id = '{$transid}'";
			$result = mysqli_query($this->db,$query);
			
			if($result){
				return $newtransid;
			}
			else{
				return false;
			}
		}
		
		public function insertClientWithTheSameBenePass($transid, $f, $m, $l, $e, $sex, $bday, 
		$occupation, $salary, $category, $subcategory, $cstatus, $contact, $r, $p, $c, $brgy, $d, $street, 
		$relationship, $bf, $bm, $bl, $be, $b_bday, $b_sex, $b_cstatus, $b_contact, $b_category, $b_subCat,
		 $b_region, $b_province, $b_city, $b_district, $b_barangay, $b_street, $note){ 
			$datenow = date("Y-m-d H:i:s"); //serve as date_entered
			$encoder = $_SESSION['userId'];
			$office_id = $_SESSION['f_office'];
			// $catered = "no";
			$status_client = "Pending";
			// $action = "passed";
			if(empty($note)){
				$note = "yes";
			}
			
			// $query = "SELECT office FROM cpms_account where empid = '{$encoder}'";
			// $result = mysqli_query($this->db2, $query);
			// $row = mysqli_fetch_assoc($result);

			$now = DateTime::createFromFormat('U.u', number_format(microtime(true), 6, '.', ''));
			$datetoid = date_format($now, 'YmdHisu');
			$newtransid = $office_id.'-'.$datetoid;

			$query = "SELECT * FROM tbl_transaction WHERE trans_id = '{$transid}'";
			$result = mysqli_query($this->db,$query);
			$row = mysqli_fetch_assoc($result);
			$client_id = $row['client_id'];
			$bene_id = $row['bene_id'];

			$query = "INSERT INTO tbl_transaction (trans_id, client_id, bene_id, relation, date_entered, encoded_encoder, note, status_client, clientonly, clientsamebene, benetoclient) 
			VALUES ('{$newtransid}', '{$client_id}', '{$bene_id}', '{$relationship}', '{$datenow}', '{$encoder}', '{$note}','{$status_client}', 1, 1, 1)";
			$result = mysqli_query($this->db,$query);
			
			$query = "UPDATE tbl_transaction SET clientsamebene = 0 WHERE trans_id = '{$transid}'";
			$result = mysqli_query($this->db,$query);
			
			$query ="SELECT * FROM client_data WHERE client_id = '{$client_id}'";
			$result = mysqli_query($this->db, $query);
			$row0 = mysqli_fetch_assoc($result);
			
			if($row0['firstname']!=$f||$row0['middlename']!=$m||$row0['lastname']!=$l||$row0['extraname']!=$e||$row0['sex']!=$sex||$row0['date_birth']!=$bday||$row0['occupation']!=$occupation||$row0['salary']!=$salary||
			$row0['category']!=$category||$row0['subCategory']!=$subcategory||$row0['civil_status']!=$cstatus||$row0['contact']!=$contact||$row0['client_region']!=$r||$row0['client_province']!=$p||$row0['client_municipality']!=$c||
			$row0['client_barangay']!=$brgy||$row0['client_district']!=$d||$row0['client_street']!=$street){
				$query = "UPDATE client_data SET ";
				if($row0['firstname']!=$f){$query .= "firstname = '{$f}',";}
				if($row0['middlename']!=$m){$query .= "middlename = '{$m}',";}
				if($row0['lastname']!=$l){$query .= "lastname = '{$l}',";}
				if($row0['extraname']!=$e){$query .= "extraname = '{$e}',";}
				if($row0['sex']!=$sex){$query .= "sex = '{$sex}',";}
				if($row0['date_birth']!=$bday){$query .= "date_birth = '{$bday}',";}
				if($row0['occupation']!=$occupation){$query .= "occupation = '{$occupation}',";}
				if($row0['salary']!=$salary){$query .= "salary = '{$salary}',";}
				if($row0['category']!=$category){$query .= "category = '{$category}',";}
				if($row0['subCategory']!=$subcategory){$query .= "subCategory = '{$subcategory}',";}
				if($row0['civil_status']!=$cstatus){$query .= "civil_status = '{$cstatus}',";}
				if($row0['contact']!=$contact){$query .= "contact = '{$contact}',";}
				if($row0['client_region']!=$r){$query .= "client_region = '{$r}',";}
				if($row0['client_province']!=$p){$query .= "client_province = '{$p}',";}
				if($row0['client_municipality']!=$c){$query .= "client_municipality = '{$c}',";}
				if($row0['client_barangay']!=$brgy){$query .= "client_barangay = '{$brgy}',";}
				if($row0['client_district']!=$d){$query .= "client_district = '{$d}',";}
				if($row0['client_street']!=$street){$query .= "client_street = '{$street}' ";}
				$query .= "WHERE client_id = '{$client_id}'";
				$result = mysqli_query($this->db,$query);
			}

			$query ="SELECT * FROM beneficiary_data WHERE bene_id = '{$bene_id}'";
			$result = mysqli_query($this->db, $query);
			$row1 = mysqli_fetch_assoc($result);
			
			if($row1['b_fname']!=$bf||$row1['b_mname']!=$bm||$row1['b_lname']!=$bl||$row1['b_exname']!=$be||$row1['b_sex']!=$b_sex||$row1['b_bday']!=$b_bday||
			$row1['b_category']!=$b_category||$row1['b_subCategory']!=$b_subCat||$row1['b_civilStatus']!=$b_cstatus||$row1['b_contact']!=$b_contact||$row1['b_region']!=$b_region||
			$row1['b_province']!=$b_province||$row1['b_municipality']!=$b_city||$row1['b_barangay']!=$b_barangay||$row1['b_district']!=$b_district||$row1['b_street']!=$b_street){
				$query = "UPDATE beneficiary_data SET ";
				if($row1['b_fname']!=$bf){$query .= "b_fname = '{$bf}',";}
				if($row1['b_mname']!=$bm){$query .= "b_mname = '{$bm}',";}
				if($row1['b_lname']!=$bl){$query .= "b_lname = '{$bl}',";}
				if($row1['b_exname']!=$be){$query .= "b_exname = '{$be}',";}
				if($row1['b_sex']!=$b_sex){$query .= "b_sex = '{$b_sex}',";}
				if($row1['b_bday']!=$b_bday){$query .= "b_bday = '{$b_bday}',";}
				if($row1['b_category']!=$b_category){$query .= "b_category = '{$b_category}',";}
				if($row1['b_subCategory']!=$b_subCat){$query .= "b_subCategory = '{$b_subCat}',";}
				if($row1['b_civilStatus']!=$b_cstatus){$query .= "b_civilStatus = '{$b_cstatus}',";}
				if($row1['b_contact']!=$b_contact){$query .= "b_contact = '{$b_contact}',";}
				if($row1['b_region']!=$b_region){$query .= "b_region = '{$b_region}',";}
				if($row1['b_province']!=$b_province){$query .= "b_province = '{$b_province}',";}
				if($row1['b_municipality']!=$b_city){$query .= "b_municipality = '{$b_city}',";}
				if($row1['b_barangay']!=$b_barangay){$query .= "b_barangay = '{$b_barangay}',";}
				if($row1['b_district']!=$b_district){$query .= "b_district = '{$b_district}',";}
				if($row1['b_street']!=$b_street){$query .= "b_street = '{$b_street}' ";}
				$query .= "WHERE bene_id = '{$bene_id}'";
				$result = mysqli_query($this->db,$query);
			}
						
			if($result){
				return $newtransid;
			}
			else{
				return false;
			}
		}

		//Age Calculation
		
		public function getAge($date){			
			return  $age = date_diff(date_create($date), date_create('now'))->y;
		}
		
		//SOCIAL Work
		
		//show/retrieve data sa gi search
		public function show_data_socialwork(){ //show client data to socialwork
			$query = "SELECT * FROM client_data WHERE enc_soc = 'passed'";	
			$result = mysqli_query($this->db,$query);
			if($result){
				return $result;
			}
			else {
				return false;
			}
		}
		
		public function show_data_to_socialwork(){
			$query = "SELECT * FROM client_data 
			LEFT JOIN transact ON client_data.client_id = transact.client_id
			LEFT JOIN client_address ON client_data.client_id = client_address.client_id
			LEFT JOIN beneficiary_data ON client_data.client_id = beneficiary_data.client_id
			WHERE (status_client = 'Pending' OR status_client = 'Serving') ORDER BY date_entered DESC;";
			$result = mysqli_query($this->db,$query);
			
			if($result){
				return $result;
			}
			else{
				return false;
			}
		}

		// public function cateredno($id){
		// 	$query = "UPDATE client_data SET catered = 'yes' WHERE client_id = {$id};";
		// 	$result = mysqli_query($this->db,$query);
		// 	if($result){
		// 		return true;
		// 	}
		// 	else {
		// 		return false;
		// 	}
		// }
		
		//Getting the half data of client, for GIS
		public function clientData($id){
			$query = "SELECT client_data.*, beneficiary_data.*, tbl_transaction.* FROM client_data  
			LEFT JOIN tbl_transaction USING (client_id)
			LEFT JOIN beneficiary_data USING (bene_id)
			WHERE trans_id = '{$id}';";
			$result = mysqli_query($this->db, $query);
			$data = mysqli_fetch_assoc($result);
	
			if($data){
				return $data;
			}
			else {
				return false;
			}
		}
		
		//Getting the half data of client, for GIS
		public function newclient($id){
			$query = "SELECT * ";
			$query .= "FROM client_data LEFT JOIN beneficiary_data "; 
			$query .= "ON beneficiary_data.client_id = client_data.client_id ";
			$query .= "LEFT JOIN b_address ON b_address.b_id = beneficiary_data.b_id ";
			$query .= "LEFT JOIN client_address ON client_data.client_id = client_address.client_id ";
			$query .= "WHERE client_data.client_id = '{$id}';";
			$result = mysqli_query($this->db, $query);
			$data = mysqli_fetch_assoc($result);
			if($data){
				return $data;
			}
			else {
				return false;
			}
		}

		//return check  if naa sya sa document sa COE
		public function returnCheck($docs, $type){
			$type = strtolower($type);
			$docs = strtolower($docs);
			if(substr_count($docs, $type) > 0){
				return " &#x2714;";
			}else{
				return false;
			}
		}

		public function getClientId($id){
			$query = "SELECT * FROM tbl_transaction
			WHERE trans_id = '{$id}';";
			$result = mysqli_query($this->db, $query);
			$data = mysqli_fetch_assoc($result);
			$client_id = $data['client_id'];
			if($client_id){
				return $client_id;
			}
			else {
				return false;
			}
		}

		//All information in GIS
		public function insertGIS($empid, $trans_id, $id, $p1, $p2, $p3, $rb1, $rb2, $rb3, $e1, $e2, $e3, $t1, $t2, $t3, $b1, $b2, $b3, $s1, $s2, $s3, $s4, $ref_name,
									$type1, $pur1, $a1, $m1, $f1, $type2, $pur2, $a2, $m2, $f2, $mode_ad, $num, $gis_opt, $prob, $ass, $signatoryGIS,
									$fs1, $fs2, $fs3, $fs4, $fs5, $targets, $subcat, $others_subcat, $if_medical, $if_burial, $financial, $material){
		$query = "";
			if(!empty($p1)){
				$query = "INSERT INTO family (trans_id, name, relation_bene, age, occupation, salary) VALUES ('{$trans_id}','{$p1}','{$rb1}', '{$e1}', '{$t1}', '{$b1}')";
				if(!empty($p2)){$query .= ",('{$trans_id}','{$p2}','{$rb2}', {$e2}, '{$t2}', '{$b2}')";}
				if(!empty($p3)){$query .= ",('{$trans_id}','{$p3}','{$rb3}', {$e3}, '{$t3}', '{$b3}')";}
				$query .= ";";
			}
			
						
			//insert sa service 
			$query .= "INSERT INTO service (trans_id, service1, service2, service3, service4, ref_name) 
						VALUES ('{$trans_id}','{$s1}','{$s2}','{$s3}', '{$s4}','{$ref_name}');"; 	
			if(!empty($fs1)){
				$query .= "INSERT INTO tbl_coe_fund (trans_id, fundsource)	VALUES 
						('{$trans_id}', '{$fs1}')";
					if(!empty($fs2)){$query .= ",('{$trans_id}', '{$fs2}')";}
					if(!empty($fs3)){$query .= ",('{$trans_id}', '{$fs3}')";}
					if(!empty($fs4)){$query .= ",('{$trans_id}', '{$fs4}')";}
					if(!empty($fs5)){$query .= ",('{$trans_id}', '{$fs5}')";}
				$query .= ";";
			}else{
				$query .= "INSERT INTO tbl_coe_fund (trans_id, fundsource, fs_amount)	VALUES 
					('{$trans_id}', '{$f1}', '{$a1}');";
			}
			//insert Assistance need by client, 1 or 2 lng iyang ma cater na assistance 
			$query .= "INSERT INTO assistance (trans_id, type, if_medical, if_burial, financial, material, amount, mode, fund, purpose, type_description) 
					VALUES ('{$trans_id}', '{$type1}', '{$if_medical}', '{$if_burial}', '{$financial}', '{$material}', '{$a1}', '{$m1}', '', '{$pur1}', 'Type1')";
					if($type2 !=""){
						$query .= " ,('{$trans_id}', '{$type2}', '{$a2}', '{$m2}', '{$f2}', '{$pur2}', 'Type2')";
					}
			$query .= ";";
			
			//INSERT TO ASSESSMENT
			$query .= "INSERT INTO assessment (trans_id, target_sector, subcat_ass, others_subcat, gis_option, problem, soc_ass, mode_admission, client_num) 
			VALUES ('{$trans_id}', '{$targets}', '{$subcat}', '{$others_subcat}', '{$gis_opt}','{$prob}', '{$ass}', '{$mode_ad}', {$num});"; 

			//update the tbl_transaction table
			// $sign_id = $this->getsignatureid($signatoryGIS);//get the id of signaturory using fullname
			$sign_id = $signatoryGIS;
			$query .= "UPDATE tbl_transaction SET signatory_id = '{$sign_id}'";
			if($m1 == "GL"){ 
				$amountcon = str_replace(",","", $a1);
				if($amountcon < 50001){ $query .= ", signatory_GL = '{$sign_id}'"; }
			}
			if($m2 == "GL"){ 
				$amountcon2 = str_replace(",","", $a2);
				if($amountcon2 < 50001){ $query .= ", signatory_GL = '{$sign_id}'"; }
			} 
			$query .= " WHERE trans_id = '{$trans_id}';";
			$result = mysqli_multi_query($this->db, $query);
		
			if($result){
				echo "<script>alert('Assessment Successfully Saved!');</script>";
				echo "<meta http-equiv='refresh' content='0'>";
			}else{
				echo "<script>alert('Something Went Wrong!');</script>";
			}
			
		}
		
		public function getsignatureid($signature){
			$signatory = explode('-', $signature);
			//print_r($signatory);
			$signname = explode(' ', $signatory[0]);
			// print_r($signatory);
			$size = sizeof($signname);
			$query = "SELECT * FROM signatory WHERE first_name LIKE '%{$signname[0]}%' AND last_name LIKE '%{$signname[$size-1]}%';";
			
			$result = mysqli_query($this->db,$query);
			$row = mysqli_fetch_assoc($result);
			if($row){
				return $row['signatory_id'];
			}else{
				return false;
			}
		}
		public function getfundsourcedata($id) {
			$query = "SELECT * FROM tbl_coe_fund WHERE trans_id = '{$id}';";
			$result = mysqli_query($this->db, $query);

			$num = 0;
			//$data = mysqli_fetch_row($result);
			while($row = mysqli_fetch_assoc($result)){
				$num++; //array index start as 1
				$data[$num] = $row;
			}
			if(empty($data)){
				return ""; //pass as dimensional array
			}else{
				return $data;
			}
			
		}

		public function updateGIS($empid, $trans_id, $id, $p1, $p2, $p3, $rb1, $rb2, $rb3, $e1, $e2, $e3, $t1, $t2, $t3, $b1, $b2, $b3, $s1, $s2, $s3, $s4, $ref_name,
			$type1, $pur1, $a1, $m1, $f1, $type2, $pur2, $a2, $m2, $f2, $mode_ad, $num, $gis_opt, $prob, $ass, $signatoryGIS, $fs1, $fs2, $fs3, $fs4, $fs5, 
			$targets, $subcat, $others_subcat, $if_medical, $if_burial, $financial, $material){
			$query ="";
			$query .= "DELETE FROM family where trans_id='{$trans_id}';"; //delete first fmily then update 
			if(!empty($p1)){
				$query .= "INSERT INTO family (trans_id, name, relation_bene, age, occupation, salary) VALUES ('{$trans_id}','{$p1}', '{$rb1}', {$e1}, '{$t1}', '{$b1}')";
				if(!empty($p2)){$query .= ",('{$trans_id}','{$p2}', '{$rb2}', {$e2}, '{$t2}', '{$b2}')";}
				if(!empty($p3)){$query .= ",('{$trans_id}','{$p3}', '{$rb3}', {$e3}, '{$t3}', '{$b3}')";}
				$query .= ";";
			}
			$assistance = $this-> getAssistanceData($trans_id);
			//insert sa service 
			$query .= "DELETE FROM service WHERE trans_id = '{$trans_id}';";
			$query .= "INSERT INTO service (trans_id, service1, service2, service3, service4, ref_name) 
						VALUES ('{$trans_id}','{$s1}','{$s2}','{$s3}', '{$s4}','{$ref_name}');"; 
			
			/*$query .= " UPDATE service SET service1={$s1}, service2={$s2}, service3={$s3}, service4={$s4}, ref_name='{$ref_name}' WHERE trans_id = '{$trans_id}';";*/
			
			//UPDATE assessment need by client/ 1 or 2 lng iyang ma cater na assistance 
			$query .= "DELETE FROM assessment WHERE trans_id = '{$trans_id}';";
			$query .= "INSERT INTO assessment (trans_id, target_sector, subcat_ass, others_subcat, gis_option, problem, soc_ass, mode_admission, client_num) 
			VALUES ('{$trans_id}', '{$targets}', '{$subcat}', '{$others_subcat}', '{$gis_opt}','{$prob}', '{$ass}', '{$mode_ad}', {$num});"; 

			/*$query .= " UPDATE assessment SET problem = '{$prob}', soc_ass='{$ass}', mode_admission='{$mode_ad}', client_num='{$num}'
						WHERE trans_id='{$trans_id}';";*/
		
			//UPDATE assissstance
			$query .= "DELETE FROM assistance WHERE trans_id = '{$trans_id}';";
			$query .= "INSERT INTO assistance (trans_id, type, if_medical, if_burial, financial, material, amount, mode, fund, purpose, type_description) 
					VALUES ('{$trans_id}', '{$type1}', '{$if_medical}', '{$if_burial}', '{$financial}', '{$material}', '{$a1}', '{$m1}', '', '{$pur1}', 'Type1')";
					if($type2 !=""){
						$query .= " ,('{$trans_id}', '{$type2}', '{$a2}', '{$m2}', '{$f2}', '{$pur2}', 'Type2')";
					}
			$query .= ";";

			$query .= "DELETE FROM tbl_coe_fund WHERE trans_id = '{$trans_id}';";
			$query .= "INSERT INTO tbl_coe_fund (trans_id, fundsource, fs_amount) ";
			if (empty($f1)) {
				$query .= "VALUES ('{$trans_id}', '{$fs1}', '')";
				if (!empty($fs2)) {
					$query .= ",('{$trans_id}', '{$fs2}', '')";
				}
				if (!empty($fs3)) {
					$query .= ",('{$trans_id}', '{$fs3}', '')";
				}
				if (!empty($fs4)) {
					$query .= ",('{$trans_id}', '{$fs4}', '')";
				}
				if (!empty($fs5)) {
					$query .= ",('{$trans_id}', '{$fs5}', '')";
				}
			} else {
				$query .= "VALUES ('{$trans_id}', '{$f1}', '{$a1}')";
			}
			$query .= ";";
			/*$query .= "UPDATE assistance SET type = '{$type1}', amount = '{$a1}', mode ='{$m1}', fund = '{$f1}', purpose = '{$pur1}' WHERE trans_id = '{$trans_id}' AND type_description = 'Type1'";
			$query .= ";";
			if($type2 !="" && !empty($assistance[2]['mode']) != ""){
				$query .= "UPDATE assistance SET type = '{$type2}', amount = '{$a2}', mode ='{$m2}', fund = '{$f2}', purpose = '{$pur2}' WHERE trans_id = '{$trans_id}' AND type_description = 'Type2';";
			}elseif($type2 == ""){
				$query .= "DELETE FROM assistance WHERE trans_id = '{$trans_id}' AND type_description = 'Type2';";
			}elseif($type2 != "" && !empty($assistance[2]['mode']) == ""){
				$query .= "INSERT INTO assistance (trans_id, type, amount, mode, fund, purpose, type_description) VALUES
				('{$trans_id}', '{$type2}', '{$a2}', '{$m2}', '{$f2}', '{$pur2}', 'Type2');";
			}*/

			// $sign_id = $this->getsignatureid($signatoryGIS);//get the id of signaturory using fullname
			$sign_id = $signatoryGIS;
			$query .= "UPDATE tbl_transaction SET signatory_id = '{$sign_id}', encoded_socialWork='{$empid}'";
			if($m1 == "GL"){ 
				$amountcon = str_replace(",","", $a1);
				if($amountcon < 50001){ $query .= ", signatory_GL = '{$sign_id}'"; }
				elseif($amountcon >= 50001){ $query .= ", signatory_GL = ''"; }
			}
			if($m2 == "GL"){ 
				$amountcon2 = str_replace(",","", $a2);
				if($amountcon2 < 50001){ $query .= ", signatory_GL = '{$sign_id}'"; }
				elseif($amountcon2 >= 50001){ $query .= ", signatory_GL = ''"; }
			}
			$query .= " WHERE trans_id = '{$trans_id}';";
			$result = mysqli_multi_query($this->db, $query);
			
			if($result){
				echo "<script>alert('Assessment Successfully UPDATED!');</script>";
				echo "<script>document.getElementById('toCOE').style.visibility='visible';</script>";
				echo "<meta http-equiv='refresh' content='0'>";
			}else{
				echo "<script>alert('Something Went Wrong!');</script>";
				echo "<meta http-equiv='refresh' content='0'>";
			}
			
		}

		public function updateGISbyEncoder($empid, $trans_id, $id, $p1, $p2, $p3, $e1, $e2, $e3, $t1, $t2, $t3, $b1, $b2, $b3, $s1, $s2, $s3, $s4, $ref_name,
			$type1, $pur1, $a1, $m1, $f1,$type2, $pur2, $a2, $m2, $f2, $mode_ad, $num, $gis_opt, $prob, $ass, $signatoryGIS, $fs1, $fs2, $fs3, $fs4, $fs5){
			
			$encoder = $_SESSION['userId'];
			$remark = "Updated by the Encoder with ID = ".$encoder;
			
			
			$query ="";
			$query .= "DELETE FROM family where trans_id='{$trans_id}';"; //delete first fmily then update 
			if(!empty($p1)){
				$query .= "INSERT INTO family (trans_id, name, age, occupation, salary) VALUES ('{$trans_id}','{$p1}', {$e1}, '{$t1}', '{$b1}')";
				if(!empty($p2)){$query .= ",('{$trans_id}','{$p2}', {$e2}, '{$t2}', '{$b2}')";}
				if(!empty($p3)){$query .= ",('{$trans_id}','{$p3}', {$e3}, '{$t3}', '{$b3}')";}
				$query .= ";";
			}
						
			
			//insert sa service 
			$query .= " UPDATE service SET service1={$s1}, service2={$s2}, service3={$s3}, service4={$s4}, ref_name='{$ref_name}', remark_service_update='{$encoder}' WHERE trans_id = '{$trans_id}';";
			
			$assistance = $this->getAssistanceData($trans_id);
			
			//UPDATE assessment need by client/ 1 or 2 lng iyang ma cater na assistance 
			$query .= " UPDATE assessment SET problem = '{$prob}', gis_option = '{$gis_opt}', soc_ass='{$ass}', mode_admission='{$mode_ad}', client_num='{$num}', remark_onupdate='{$encoder}'
						WHERE trans_id='{$trans_id}';";
		
			//UPDATE assissstance
			$query .= "UPDATE assistance SET type = '{$type1}', amount = '{$a1}', mode ='{$m1}', fund = '', purpose = '{$pur1}', remark_assist_update = '{$encoder}' WHERE trans_id = '{$trans_id}' AND type_description = 'Type1';";
			//UPDATE fundsource
			// $query .= "UPDATE tbl_coe_fund SET fundsource1 = '{$fs1}', fundsource2 = '{$fs2}', fundsource3 ='{$fs3}', fundsource4 = '{$fs4}', fundsource5 = '{$fs5}' WHERE trans_id = '{$trans_id}';";
			$query .= "DELETE FROM tbl_coe_fund WHERE trans_id = '{$trans_id}';";
			$query .= "INSERT INTO tbl_coe_fund (trans_id, fundsource, fs_amount) ";
            if (empty($f1)) {
                $query .= "VALUES ('{$trans_id}', '{$fs1}', '')";
				if (!empty($fs2)) {$query .= ",('{$trans_id}', '{$fs2}', '')";}
				if (!empty($fs3)) {$query .= ",('{$trans_id}', '{$fs3}', '')";}
				if (!empty($fs4)) {$query .= ",('{$trans_id}', '{$fs4}', '')";}
				if (!empty($fs5)) {$query .= ",('{$trans_id}', '{$fs5}', '')";}
            }else{
                $query .= "VALUES ('{$trans_id}', '{$f1}', '{$a1}')";
            }
			$query .= ";";

			if($type2 !="" && !empty($assistance[2]['mode']) != ""){
				$query .= "UPDATE assistance SET type = '{$type2}', amount = '{$a2}', mode ='{$m2}', fund = '{$f2}', purpose = '{$pur2}', remark_assist_update = '{$encoder}' WHERE trans_id = '{$trans_id}' AND type_description = 'Type2';";
			}elseif($type2 =="" && !empty($assistance[2]['mode']) != ""){
				$query .= "DELETE FROM assistance WHERE trans_id = '{$trans_id}' AND type_description = 'Type2'";
			}elseif($type2 !="" && !empty($assistance[2]['mode']) == ""){
				$query .= "INSERT INTO assistance (trans_id, type, amount, mode, fund, purpose, type_description) VALUES
					('{$trans_id}', '{$type2}', '{$a2}', '{$m2}', '{$f2}', '{$pur2}', 'Type2')";
			}
			$query .= ";";

			$sign_id = $this->getsignatureid($signatoryGIS);//get the id of signaturory using fullname
			$query .= "UPDATE tbl_transaction SET signatory_id = '{$sign_id}', remarks='{$remark}'";
			if($m1 == "GL"){ 
				$amountcon = str_replace(",","", $a1);
				if($amountcon < 50001){ $query .= ", signatory_GL = '{$sign_id}'"; }
				elseif($amountcon >= 50001){ $query .= ", signatory_GL = ''"; }
			}
			if($m2 == "GL"){ 
				$amountcon2 = str_replace(",","", $a2);
				if($amountcon2 < 50001){ $query .= ", signatory_GL = '{$sign_id}'"; }
				elseif($amountcon2 >= 50001){ $query .= ", signatory_GL = ''"; }
			}
			$query .= " WHERE trans_id = '{$trans_id}';";
			
			
			$result = mysqli_multi_query($this->db, $query);
			if($result){
				echo "<script>alert('Assessment Successfully UPDATED!');</script>";
				echo "<script>document.getElementById('toCOE').style.visibility='visible';</script>";
				echo "<meta http-equiv='refresh' content='0'>";
			}else{
				echo "<script>alert('Something Went Wrong!');</script>";
				echo "<meta http-equiv='refresh' content='0'>";
			}
			
		}
		public function updateGISbySocialWork($empid, $trans_id, $id, $p1, $p2, $p3, $e1, $e2, $e3, $t1, $t2, $t3, $b1, $b2, $b3, $s1, $s2, $s3, $s4, $ref_name,
			$type1, $pur1, $a1, $m1, $f1,$type2, $pur2, $a2, $m2, $f2, $mode_ad, $num, $gis_opt, $prob, $ass, $signatoryGIS, $fs1, $fs2, $fs3, $fs4, $fs5){
			
			$socialwork = $_SESSION['userId'];
			$remark = "Updated by the Social Worker with ID = ".$socialwork;
			
			
			$query ="";
			$query .= "DELETE FROM family where trans_id='{$trans_id}';"; //delete first fmily then update 
			if(!empty($p1)){
				$query .= "INSERT INTO family (trans_id, name, age, occupation, salary) VALUES ('{$trans_id}','{$p1}', {$e1}, '{$t1}', '{$b1}')";
				if(!empty($p2)){$query .= ",('{$trans_id}','{$p2}', {$e2}, '{$t2}', '{$b2}')";}
				if(!empty($p3)){$query .= ",('{$trans_id}','{$p3}', {$e3}, '{$t3}', '{$b3}')";}
				$query .= ";";
			}
						
			
			//insert sa service 
			$query .= " UPDATE service SET service1={$s1}, service2={$s2}, service3={$s3}, service4={$s4}, ref_name='{$ref_name}', remark_service_update='{$socialwork}' WHERE trans_id = '{$trans_id}';";
			
			$assistance = $this->getAssistanceData($trans_id);
			
			//UPDATE assessment need by client/ 1 or 2 lng iyang ma cater na assistance 
			$query .= " UPDATE assessment SET problem = '{$prob}', gis_option = '{$gis_opt}', soc_ass='{$ass}', mode_admission='{$mode_ad}', client_num='{$num}', remark_onupdate='{$socialwork}'
						WHERE trans_id='{$trans_id}';";
		
			//UPDATE assissstance
			$query .= "UPDATE assistance SET type = '{$type1}', amount = '{$a1}', mode ='{$m1}', fund = '', purpose = '{$pur1}', remark_assist_update = '{$socialwork}' WHERE trans_id = '{$trans_id}' AND type_description = 'Type1';";
			// UPDATE fundsource
			// $query .= "UPDATE tbl_coe_fund SET fundsource1 = '{$fs1}', fundsource2 = '{$fs2}', fundsource3 ='{$fs3}', fundsource4 = '{$fs4}', fundsource5 = '{$fs5}' WHERE trans_id = '{$trans_id}';";
			$query .= "DELETE FROM tbl_coe_fund WHERE trans_id = '{$trans_id}';";
			$query .= "INSERT INTO tbl_coe_fund (trans_id, fundsource, fs_amount) ";
			if (empty($f1)) {
				$query .= "VALUES ('{$trans_id}', '{$fs1}', '')";
				if (!empty($fs2)) {
					$query .= ",('{$trans_id}', '{$fs2}', '')";
				}
				if (!empty($fs3)) {
					$query .= ",('{$trans_id}', '{$fs3}', '')";
				}
				if (!empty($fs4)) {
					$query .= ",('{$trans_id}', '{$fs4}', '')";
				}
				if (!empty($fs5)) {
					$query .= ",('{$trans_id}', '{$fs5}', '')";
				}
			} else {
				$query .= "VALUES ('{$trans_id}', '{$f1}', '{$a1}')";
			}
			$query .= ";";
            
			
			if($type2 !="" && !empty($assistance[2]['mode']) != ""){
				$query .= "UPDATE assistance SET type = '{$type2}', amount = '{$a2}', mode ='{$m2}', fund = '{$f2}', purpose = '{$pur2}', remark_assist_update = '{$socialwork}' WHERE trans_id = '{$trans_id}' AND type_description = 'Type2';";
			}elseif($type2 =="" && !empty($assistance[2]['mode']) != ""){
				$query .= "DELETE FROM assistance WHERE trans_id = '{$trans_id}' AND type_description = 'Type2';";
			}elseif($type2 !="" && !empty($assistance[2]['mode']) == ""){
				$query .= "INSERT INTO assistance (trans_id, type, amount, mode, fund, purpose, type_description) VALUES
					('{$trans_id}', '{$type2}', '{$a2}', '{$m2}', '{$f2}', '{$pur2}', 'Type2');";
			}

			$sign_id = $signatoryGIS;//get the id of signaturory using fullname
			$query .= "UPDATE tbl_transaction SET signatory_id = '{$sign_id}', remarks='{$remark}'";
			if($m1 == "GL"){ 
				$amountcon = str_replace(",","", $a1);
				if($amountcon < 50001){ $query .= ", signatory_GL = '{$sign_id}'"; }
				elseif($amountcon >= 50001){ $query .= ", signatory_GL = ''"; }
			}
			if($m2 == "GL"){ 
				$amountcon2 = str_replace(",","", $a2);
				if($amountcon2 < 50001){ $query .= ", signatory_GL = '{$sign_id}'"; }
				elseif($amountcon2 >= 50001){ $query .= ", signatory_GL = ''"; }
			}
			$query .= " WHERE trans_id = '{$trans_id}';";
			
			
			$result = mysqli_multi_query($this->db, $query);
			if($result){
				echo "<script>alert('Assessment Successfully UPDATED!');</script>";
				echo "<script>document.getElementById('toCOE').style.visibility='visible';</script>";
				echo "<meta http-equiv='refresh' content='0'>";
			}else{
				echo "<script>alert('Something Went Wrong!');</script>";
				echo "<meta http-equiv='refresh' content='0'>";
			}
			
		}

		public function getChargableagainst($id){
			$query = "SELECT *  FROM tbl_coe_fund WHERE trans_id = '{$id}'";
			$result = mysqli_query($this->db, $query);
			
			$num = 0;
			//$data = mysqli_fetch_row($result);
			while($rows = mysqli_fetch_assoc($result)){
				$num++; //array index start as 1
				$row[$num] = $rows;
			}

			$data = "";
			if(!empty($row[1]['fundsource'])){
				$data = $row[1]['fundsource']." = ".$row[1]["fs_amount"];
			}
			if(!empty($row[2]['fundsource'])){
				$data .= "/". $row[2]['fundsource']." = ".$row[2]["fs_amount"];
			}
			if(!empty($row[3]['fundsource'])){
				$data .= "/". $row[3]['fundsource']." = ".$row[3]["fs_amount"];
			}
			if(!empty($row[4]['fundsource'])){
				$data .= "/". $row[4]['fundsource']." = ".$row[4]["fs_amount"];
			}
			if(!empty($row[5]['fundsource'])){
				$data .= "/". $row[5]['fundsource']." = ".$row[5]["fs_amount"];
			}
			
			return $data;
		}

		public function showallClientdata($id){ //show all data of client on specified id
			$query = "SELECT beneficiary_data.*, client_data.*, assistance.*, service.*, assessment.*, tbl_transaction.* FROM assistance
						LEFT JOIN tbl_transaction using (trans_id)
						LEFT JOIN service using (trans_id)
						LEFT JOIN assessment using (trans_id)
						LEFT JOIN client_data using (client_id)
						LEFT JOIN beneficiary_data using (bene_id)
						WHERE trans_id = '{$id}'";
			$result = mysqli_query($this->db,$query);
			$row = mysqli_fetch_assoc($result);
			
			if(mysqli_num_rows($result) > 0){
				return $row;
			}else{
				return false;
			}
		}

		public function theTime($full){ //Gi split ang date to return time
			$date = explode(' ', $full);
			return $date[1];
		}

		public function signatory(){ //get all signatory
			$query = "SELECT * FROM signatory;";
			$result = mysqli_query($this->db,$query);
			if($result){
				return $result;
			}
			else {
				return false;
			}
		}

		public function signatoryosap(){ //get all signatory
			$query = "SELECT c.empid, t.empnum, e.empfname, c.position, e.emplname, e.empmname, e.empext FROM cpms_account c
			LEFT JOIN tbl_employment t on c.empid = t.empid
			LEFT JOIN employee_info e on t.empnum = e.empnum
			WHERE c.position = 'Social Worker';";
			$result = mysqli_query($this->db2,$query);
			if($result){
				return $result;
			}
			else {
				return false;
			}
		}
		
		public function signatoryGIS(){
			$query = "SELECT * FROM signatory WHERE option_GL = '1';";
			$result = mysqli_query($this->db,$query);
			if($result){
				return $result;
			}
			else {
				return false;
			}
		}
		
		public function getinitials($id){
			
			$getuser = $this->show_user_data($id);
			// $initials = "";
			if(!empty($getuser['empfname'])){
				$firstname = explode(" ",$getuser['empfname']);
				if(!empty($firstname[0])){
					$initials = strtoupper($firstname[0][0]);
				}
				if(!empty($firstname[1])){
					$initials .= strtoupper($firstname[1][0]);
				}
				if(!empty($firstname[2])){
					$initials .= strtoupper($firstname[2][0]);
				}
			}
			
			if(!empty($getuser['empmname'])){
				$middlename = explode(" ",$getuser['empmname']);
				if(!empty($middlename[0])){
					$initials .= strtoupper($middlename[0][0]);
				}
			}
		
			if(!empty($getuser['emplname'])){
				$lastname = explode(" ",$getuser['emplname']);
				if(!empty($lastname[0])){
					$initials .= strtoupper($lastname[0][0]);
				}
			}

			return $initials;
		}
		public function getinitialsSignatory($id){
			
			$getsignatory = $this->getsignatory($id);
			$initials = "";
			if(!empty($getsignatory['first_name'])){
				$firstname = explode(" ",$getsignatory['first_name']);
				if(!empty($firstname[0])){
					$initials = strtoupper($firstname[0][0]);
				}
				if(!empty($firstname[1])){
					$initials .= strtoupper($firstname[1][0]);
				}
				if(!empty($firstname[2])){
					$initials .= strtoupper($firstname[2][0]);
				}
			}
			
			if(!empty($getsignatory['middle_I'])){
				$middlename = explode(" ",$getsignatory['middle_I']);
				if(!empty($middlename[0])){
					$initials .= strtoupper($middlename[0][0]);
				}
			}
		
			if(!empty($getsignatory['last_name'])){
				$lastname = explode(" ",$getsignatory['last_name']);
				if(!empty($lastname[0])){
					$initials .= strtoupper($lastname[0][0]);
				}
			}

			return $initials;
		}

		public function signatoryGL(){
			$query = "SELECT * FROM signatory WHERE option_GL = '1';";
			$result = mysqli_query($this->db,$query);
				$data = "<datalist id='gls'>";
			while($row = mysqli_fetch_assoc($result)){
				$name = strtoupper($row['first_name'] ." ". $row['middle_I'] .". ". $row['last_name']);
				$data .= "<option>{$name}-{$row['position']}</option>";
			}
				$data .= "</datalist>";
			return $data;
		}
		
		public function returntime($id){ //get data on new client id
			$query = "SELECT * FROM client_data WHERE client_id = '{$id}';";
			$result = mysqli_query($this->db,$query);
			$row = mysqli_fetch_assoc($result);
			
			if(mysqli_num_rows($result) > 0){
				return $row;
			}else{
				return false;
			}
		}

		function toWord($num){
			$f = new NumberFormatter("en", NumberFormatter::SPELLOUT); //object ba mo convert sa word
			
			$money = explode(".", $num);    
			$size = sizeof($money);
			$money[0] = str_replace(",", "", $money[0]); //change ',' to blank
	
			$str1 = (string) $f->format(intval($money[0])) ." PESOS "; //gi convert nag word
	
			if($size == 2 && $money[1] != "00"){
				$str2 = (string) $f->format($money[1]) ." CENTAVOS ";
				$str2 = "AND ". $str2;
			}else{
				$str2 = "";
			}
			$str = $str1 . $str2 ."ONLY";
			$str1 = str_replace("-", " ", $str);
			return strtoupper($str1);
		}

		public function getsignatory($id){ // get signatory data on specific id
			$query = "SELECT * FROM signatory WHERE signatory_id = '{$id}';";
			$result = mysqli_query($this->db,$query);
			$row = mysqli_fetch_assoc($result);
			if($row){
				return $row;
			}
			else {
				return false;
			}
		}

		public function getSignatoryFullname($id){
			$query = "SELECT name_title, first_name, middle_I, last_name, position, initials FROM signatory WHERE signatory_id = '{$id}';";
			$result = mysqli_query($this->db,$query);
			$row = mysqli_fetch_assoc($result);
			$data = (empty($row['name_title'])?"":$row['name_title']." "). $row['first_name'] ." ". (empty($row['middle_I'])?"":$row['middle_I'].". "). $row['last_name'] ."-". $row['position']."-". $id;
			if($data){
				return $data;
			}
			else {
				return false;
			}
		}

		public function testing(){
			echo "<script>document.getElementById('Final').style.visibility='visible';</script>";  
		}
		
		//Kwaun ang mga info nga need sa pag create og GL
		public function getInfoGL($id){
			$query = "SELECT * FROM assistance 
				LEFT JOIN transact ON transact.client_id = assistance.client_id  
				WHERE client_id = '{$id}'";
			$result = mysqli_query($this->db, $query);
			$data = mysqli_fetch_assoc($result);
			if($data){
				return $data;
			}
			else {
				return false;
			}
		}
		
		public function insertCOE($id, $docu, $id_pres, $signName, $others_input, $others_medical, $others_burial, $amount1, $amount2, $amount3, $amount4, $amount5, $am, $mode, $id_sign, $sd_officer){
			$others_input = mysqli_real_escape_string($this->db,$others_input);
			$signid = 0;
			
			$signid = $signName;

			if(empty($amount2)){
				$amount1 = $am;
			}
			
			$data = $this->getfundsourcedata($id);
			// print_r($data);
			$query = "INSERT INTO coe (trans_id, document, id_presented, others_input, others_medical, others_burial) 
						VALUES 
						('{$id}','{$docu}','{$id_pres}','{$others_input}','{$others_medical}','{$others_burial}');";
			if($am >= 50001 && $mode == "GL"){
				$query .= "UPDATE tbl_transaction SET signatory_GL = '{$signid}' WHERE trans_id = '{$id}';";
			}
			if (!empty($data[2]['fundsource'])) {
				$query .= "DELETE FROM tbl_coe_fund WHERE trans_id = '{$id}';";
				$query .= "INSERT INTO tbl_coe_fund (trans_id, fundsource, fs_amount) 
						VALUES ('{$id}', '{$data[1]['fundsource']}', '{$amount1}')";
				if (!empty($data[2]['fundsource'])) {$query .= ",('{$id}', '{$data[2]['fundsource']}', '{$amount2}')";}
				if (!empty($data[3]['fundsource'])) {$query .= ",('{$id}', '{$data[3]['fundsource']}', '{$amount3}')";}
				if (!empty($data[4]['fundsource'])) {$query .= ",('{$id}', '{$data[4]['fundsource']}', '{$amount4}')";}
				if (!empty($data[5]['fundsource'])) {$query .= ",('{$id}', '{$data[5]['fundsource']}', '{$amount5}')";}
				$query .= ";";
			}
			// echo $query;
			// $query .= "UPDATE tbl_coe_fund SET fs_amount1 = '{$amount1}', fs_amount2 = '{$amount2}', fs_amount3 = '{$amount3}', fs_amount4 = '{$amount4}', fs_amount5 = '{$amount5}' WHERE trans_id = '{$id}'";
			
			if (!empty($sd_officer)) {
				$query .= "DELETE FROM cash WHERE trans_id = '{$id}';";
				$query .= "INSERT INTO cash (trans_id, sd_officer) 
							VALUES 
							('{$id}', '{$sd_officer}');";
			}
		
			$result = mysqli_multi_query($this->db, $query);
			
			// $query;
			if($result){
				echo "<script>alert('Successfully Saved!');</script>";
				echo "<meta http-equiv='refresh' content='0'>";
			}else{
				echo "<script>alert('Something Went Wrong!');</script>";
			}
		}

		public function updateCOE($id, $docu, $id_pres, $signName, $others_input, $others_medical, $others_burial, $amount1, $amount2, $amount3, $amount4, $amount5, $am, $mode, $id_sign, $sd_officer){
			$others_input = mysqli_real_escape_string($this->db,$others_input);
			$signid = 0;
			if(!empty($signName)){
				$signid = $this->getsignatureid($signName);
			}
			
			$signid = $signName;
			
			if(empty($amount2)){
				$amount1 = $am;
			}
			
			$data = $this->getfundsourcedata($id);

			$query = "UPDATE coe SET document='{$docu}', id_presented='{$id_pres}', others_input='{$others_input}', others_medical='{$others_medical}', others_burial='{$others_burial}' where trans_id = '{$id}';";
			if($am >= 50001 && $mode == "GL"){
				$query .= "UPDATE tbl_transaction SET signatory_GL = '{$signid}' WHERE trans_id = '{$id}';";
			}if($am < 50001){
				$query .= "UPDATE tbl_transaction SET signatory_GL = '{$id_sign}' WHERE trans_id = '{$id}';";
			}

			if (!empty($data[2]['fundsource'])) {
				$query .= "DELETE FROM tbl_coe_fund WHERE trans_id = '{$id}';";
				$query .= "INSERT INTO tbl_coe_fund (trans_id, fundsource, fs_amount) 
						VALUES ('{$id}', '{$data[1]['fundsource']}', '{$amount1}')";
				if (!empty($data[2]['fundsource'])) {$query .= ",('{$id}', '{$data[2]['fundsource']}', '{$amount2}')";}
				if (!empty($data[3]['fundsource'])) {$query .= ",('{$id}', '{$data[3]['fundsource']}', '{$amount3}')";}
				if (!empty($data[4]['fundsource'])) {$query .= ",('{$id}', '{$data[4]['fundsource']}', '{$amount4}')";}
				if (!empty($data[5]['fundsource'])) {$query .= ",('{$id}', '{$data[5]['fundsource']}', '{$amount5}')";}
				$query .= ";";
            }
			
			if (!empty($sd_officer)) {
				$query .= "DELETE FROM cash WHERE trans_id = '{$id}';";
				$query .= "INSERT INTO cash (trans_id, sd_officer) 
							VALUES 
							('{$id}', '{$sd_officer}');";
			}
			// echo $query;
			// $query .= "UPDATE tbl_coe_fund SET fs_amount1 = '{$amount1}', fs_amount2 = '{$amount2}', fs_amount3 = '{$amount3}', fs_amount4 = '{$amount4}', fs_amount5 = '{$amount5}' WHERE trans_id = '{$id}';";
			$result = mysqli_multi_query($this->db, $query);
			
			if($result){
				echo "<script>alert('Successfully Updated!');</script>";
				echo "<meta http-equiv='refresh' content='0'>";
			}else{
				echo "<script>alert('Something Went Wrong!');</script>";
			}
		}
	
		public function getCash($id){
				$query ="SELECT * FROM cash where trans_id = '{$id}'";
				$result = mysqli_query($this->db,$query);
				$row = mysqli_fetch_assoc($result);
			if($row > 1){
				return $row;
			} else {
				return false;
			}
		}
		
		public function getGL($id){
			$query ="SELECT * FROM gl where trans_id = '{$id}'";
			$result = mysqli_query($this->db,$query);
			$row = mysqli_fetch_assoc($result);
			if($row){
				return $row;
			}
			else {
				return false;
			}
		}

		public function getcharging() {
			$fundsource = $this->get_fundsource_to_admin_table();
			$row = mysqli_fetch_assoc($fundsource);
			if($row){
				return $row;
			}else{
				return false;
			}
		}
		
		public function chargings(){
			$funds = $this->get_fundsource_to_admin_table();
			$data='
			<datalist id="chargings">';
			foreach($funds as $index => $value){
				$data .= '<option value='. $value["fundsource"] .'>'. $value['fundsource'] .'</option>';
			}
			$data .= '</datalist>
			';
			return $data;
		}
		
		public function listOfProvider(){
			$data = "";
			$query = "SELECT * from provider";
			$result = mysqli_query($this->db, $query);
			while($row = mysqli_fetch_assoc($result)){
				$data .= "<option value='".$row['company_name']."'>";
			}
			if($data){
				return $data;
			}
			else {
				return false;
			}
		}
    //Insert to Cash
    public function insertCash($id, $sd_officer){
		$query = "INSERT INTO cash (trans_id, sd_officer) 
						VALUES 
						('{$id}', '{$sd_officer}');";
		
		$result = mysqli_query($this->db, $query);
		if($result){
			echo "<script>alert('Cash Successfully Saved!');</script>";
			echo "<script>document.getElementById('done').style.visibility='visible';</script>";
			echo "<meta http-equiv='refresh' content='0'>";
		}else{
			echo "<script>alert('Something Went Wrong!');</script>";
		}
	}
	
	public function updateCash($id, $sd_officer){
		$query = "DELETE FROM cash WHERE trans_id='{$id}';";
		$query .= "INSERT INTO cash (trans_id, sd_officer) 
					VALUES 
					('{$id}', '{$sd_officer}');";
		$result = mysqli_multi_query($this->db, $query);
		
        if($result){
			echo "<script>alert('Cash Successfully UPDATED!');</script>";
			echo "<script>document.getElementById('done').style.visibility='visible';</script>";
			echo "<meta http-equiv='refresh' content='0'>";
		}else{
			echo "<script>alert('Something Went Wrong!');</script>";
		}
	}

	public function updateCashbyEncoder($id, $sd_officer){
		$encoder = $_SESSION['userId'];

		$query = "UPDATE cash SET sd_officer='{$sd_officer}', remark_cash_update = '{$encoder}'
					WHERE trans_id='{$id}'";
		$result = mysqli_query($this->db, $query);
		
		if($result){
			echo "<script>alert('Cash Successfully UPDATED!');</script>";
			echo "<script>document.getElementById('done').style.visibility='visible';</script>";
			echo "<meta http-equiv='refresh' content='0'>";
		}else{
			echo "<script>alert('Something Went Wrong!');</script>";
		}
			
	}
	public function glfundsource($id) {
		$query = "SELECT * FROM tbl_coe_fund WHERE trans_id = '{$id}';";
		$result = mysqli_query($this->db, $query);
		$num = 0;
		
		while($rows = mysqli_fetch_assoc($result)){
			$num++; //array index start as 1
			$row[$num] = $rows;
		}

		if(!empty($row[1]['fundsource'])){
  	    	$data = $row[1]['fundsource'];
        }
        if (!empty($row[2]['fundsource'])) {
            $data .= '/'. $row[2]['fundsource'];
        }
		if (!empty($row[3]['fundsource'])) {
            $data .= '/'. $row[3]['fundsource'];
        }
        if (!empty($row[4]['fundsource'])) {
            $data .= '/'. $row[4]['fundsource'];
        }
		if (!empty($row[5]['fundsource'])) {
            $data .= '/'. $row[5]['fundsource'];
        }
		return $data;
	}
	// get all gl from year and month then count to generate an ID
	
	
	public function getfundsource($id) {
		$query = "SELECT * FROM tbl_coe_fund WHERE trans_id = '{$id}';";
		$result = mysqli_query($this->db, $query);

		$num = 0;
		while($rows = mysqli_fetch_assoc($result)){
			$num++; //array index start as 1
			$row[$num] = $rows;
		}
		
		if($row){
			return $row;
		}
		else{
			return false;
		}
	}
	
	public function controlNumberForGL(){
		$count = 1;
		$cid = date("Y-m");
		$query="SELECT office_accronym FROM field_office WHERE office_id = '{$_SESSION['f_office']}';";
		$result = mysqli_query($this->db, $query);
		$row = mysqli_fetch_assoc($result);
		$office = $row['office_accronym'];

		$query="SELECT LEFT(control_no, 7) AS controlNumber FROM gl;";
		$result = mysqli_query($this->db, $query);
		// $rows = mysqli_fetch_assoc($result);
        
		/*while ($row = mysqli_fetch_array($result)) {
			if($row['controlNumber'] == $cid){
				$count = $count + 1;
			}
		}*/
		// $query="SELECT RIGHT('{$count}', 6) as glid;";
		// $result = mysqli_query($this->db, $query);
		// $row = mysqli_fetch_assoc($result);
		$glid = date("dHis");
		return $cid."-".$glid." ".$office;
	}

	
    //INSERT INTO GL
    public function insertGL($id, $control_no, $signatory, $addressee, $a_pos, $forthe, $cname, $add, $tomention){
		$now = date("Y-m-d H:i:s");
		
		$final_control_no = '';
		$control2 = $this->controlNumberForGL();
        if ($control_no == $control2) {
        	$final_control_no = $control2;
		}else{
			$final_control_no = $control_no;
		}
		$query = "INSERT INTO gl (trans_id, control_no, addressee, position, to_mention, for_the_id, cname, caddress) 
                    VALUES 
					('{$id}', '{$final_control_no}', '{$addressee}', '{$a_pos}', '{$tomention}', '{$forthe}', '{$cname}', '{$add}');";
		$signatory_id = $this->getsignatureid($signatory);//kwaun ang id sa signatory
		$query .= "UPDATE tbl_transaction SET signatory_GL = '{$signatory}' WHERE trans_id = '{$id}';";
		if($forthe != ""){
			$query .= "INSERT INTO for_the_logs (trans_id, ft_created, for_the_id, ft_empid, ft_action) 
						VALUES
						('{$id}','{$now}','{$forthe}','{$_SESSION['userId']}', 'Insert')";
		}
	
		// echo $query;
        $result = mysqli_multi_query($this->db, $query);
		
		if($result){
            echo "<script>alert('GL Successfully Saved!');</script>";
			echo "<script>document.getElementById('done').style.visibility='visible';</script>";
			echo "<meta http-equiv='refresh' content='0'>";
        }else{
            echo "<script>alert('GL Something Went Wrong!');</script>";
        }
	}

	public function updateGL($id, $control_no, $signatory, $addressee, $a_pos, $forthe, $cname, $add, $tomention){
		/*$query = "UPDATE gl set control_no='{$control_no}', addressee='{$addressee}', position='{$a_pos}', cname='{$cname}' , caddress='{$add}'
					WHERE trans_id='{$id}';";*/
		$final_control_no = '';
		$control2 = $this->controlNumberForGL();
        if ($control_no == $control2) {
        	$final_control_no = $control2;
		}else{
			$final_control_no = $control_no;
		}

		$query = "DELETE FROM gl WHERE trans_id='{$id}';";
		$query .= "INSERT INTO gl (trans_id, control_no, addressee, position, to_mention, for_the_id, cname, caddress) 
                    VALUES 
					('{$id}', '{$final_control_no}', '{$addressee}', '{$a_pos}', '{$tomention}', '{$forthe}', '{$cname}', '{$add}');";
					
		$signatory_id = $this->getsignatureid($signatory);
		$query .= "UPDATE tbl_transaction SET signatory_GL = '{$signatory}' WHERE trans_id = '{$id}';";
		if($forthe != ""){
			$query .= "INSERT INTO for_the_logs (trans_id, ft_created, for_the_id, ft_empid, ft_action) 
						VALUES
						('{$id}','{$now}','{$forthe}','{$_SESSION['userId']}', 'Update of GL')";
		}
		$result = mysqli_multi_query($this->db, $query);
		
		if($result){
            echo "<script>alert('GL Successfully UPDATED!');</script>";
			echo "<script>document.getElementById('done').style.visibility='visible';</script>";
			echo "<meta http-equiv='refresh' content='0'>";
        }else{
            echo "<script>alert('Something Went Wrong!');</script>";
        }
	}

	public function updateGLbyEncoder($id, $control_no, $signatory, $addressee, $a_pos, $forthe, $cname, $add, $tomention){
		$encoder = $_SESSION['userId'];
		$query = "UPDATE gl set control_no='{$control_no}', addressee='{$addressee}', position='{$a_pos}', for_the_id='{$forthe}', cname='{$cname}' , caddress='{$add}', to_mention='{$tomention}', remark_gl_update='{$encoder}'
					WHERE trans_id='{$id}';";
		$signatory_id = $this->getsignatureid($signatory);
		$query .= "UPDATE tbl_transaction SET signatory_GL = '{$signatory}' WHERE trans_id = '{$id}';";
		
		$result = mysqli_multi_query($this->db, $query);
		
		if($result){
            echo "<script>alert('GL Successfully UPDATED!');</script>";
			echo "<script>document.getElementById('done').style.visibility='visible';</script>";
			echo "<meta http-equiv='refresh' content='0'>";
        }else{
            echo "<script>alert('Something Went Wrong!');</script>";
        }
	}
	
	public function updateGLCash($id, $sd_officer, $c_no, $signatory, $addressee, $a_pos, $forthe, $cname, $add, $tomention){
 			$query = "DELETE FROM `cash` WHERE trans_id= '{$id}';";
			$query .= "INSERT INTO `cash` (`trans_id`, `sd_officer`)
					VALUES ('{$id}', '{$sd_officer}');";
			$query .= "DELETE FROM `gl` WHERE trans_id='{$id}';";
			$query .= "INSERT INTO gl (trans_id, control_no, addressee, position, to_mention, for_the_id, cname, caddress)
					VALUES
					('{$id}', '{$c_no}', '{$addressee}', '{$a_pos}', '{$tomention}', '{$forthe}', '{$cname}', '{$add}');";
			$signatory_id = $this->getsignatureid($signatory);//kwaun ang id sa signatory
			$query .= "UPDATE tbl_transaction SET signatory_GL = '{$signatory}' WHERE trans_id = '{$id}';";
			if($forthe != ""){
				$query .= "INSERT INTO for_the_logs (trans_id, ft_created, for_the_id, ft_empid, ft_action) 
							VALUES
							('{$id}','{$now}','{$forthe}','{$_SESSION['userId']}', 'Update of GL and Cash')";
			}
			$result = mysqli_multi_query($this->db, $query);
			
		if($result){
			echo "<script>alert('GL and Cash Successfully UPDATED!');</script>";
			echo "<script>document.getElementById('done').style.visibility='visible';</script>";
			echo "<meta http-equiv='refresh' content='0'>";
		}else{
			echo "<script>alert('Something Went Wrong!');</script>";
		}

	}

	public function updateGLCashbyEncoder($id, $sd_officer, $c_no, $signatory,
		$addressee, $a_pos, $forthe, $cname, $add, $tomention){
		
			$encoder = $_SESSION['userId'];
			
			$query = "SELECT * FROM cash WHERE trans_id='{$id}';";
			$result = mysqli_query($this->db, $query);
			$rows = mysqli_num_rows($result);
			if($rows > 0){
				$query = "UPDATE cash SET sd_officer='{$sd_officer}', remark_cash_update = '{$encoder}'
					WHERE trans_id='{$id}';";
			}else{
				$query = "INSERT INTO cash (trans_id, sd_officer) 
						VALUES 
						('{$id}', '{$sd_officer}');";				
			}
			
			$query .= "UPDATE gl set control_no='{$c_no}', addressee='{$addressee}', position='{$a_pos}', for_the_id='{$forthe}', cname='{$cname}' , caddress='{$add}', to_mention='{$tomention}', remark_gl_update='{$encoder}'
						WHERE trans_id='{$id}';";
			$signatory_id = $this->getsignatureid($signatory);
			
			$query .= "UPDATE tbl_transaction SET signatory_GL = '{$signatory_id}' WHERE trans_id = '{$id}';";
			
			$result = mysqli_multi_query($this->db, $query);
		
		if($result){
			echo "<script>alert('GL and Cash Successfully UPDATED!');</script>";
			echo "<script>document.getElementById('done').style.visibility='visible';</script>";
			echo "<meta http-equiv='refresh' content='0'>";
		}else{
			echo "<script>alert('Something Went Wrong!');</script>";
		}

    }

	public function update_for_the_print($id, $forthe){
		$p = 0;
		$now = date("Y-m-d H:i:s");

		$query = "SELECT for_the_id FROM gl WHERE trans_id = '{$id}';";
		$result = mysqli_query($this->db, $query);
		
		$rows = mysqli_fetch_assoc($result);
		
		if($rows['for_the_id'] != $forthe){
			$query = "UPDATE gl SET for_the_id = '{$forthe}', remark_gl_update = '{$_SESSION['userId']}' WHERE trans_id = '{$id}'; ";
			
			$result = mysqli_multi_query($this->db, $query);
			$p = 1;
		}else{
			$p = 2;
		}
		
		if($p == 2){
			echo "<script>alert('For The Signatory Is The Same!');</script>";
			echo "<script>document.getElementById('done').style.visibility='visible';</script>";
			echo "<meta http-equiv='refresh' content='0'>";
		}elseif($result == 1){
            echo "<script>alert('For The Signatory Successfully UPDATED!');</script>";
			echo "<script>document.getElementById('done').style.visibility='visible';</script>";
			echo "<meta http-equiv='refresh' content='0'>";
        }else{
            echo "<script>alert('Something Went Wrong!');</script>";
        }
	}

	public function done($id, $trans){
        $now = date("Y-m-d H:i:s");
		
		$query ="UPDATE tbl_transaction SET date_accomplished='{$now}',  status_client = 'Done' where trans_id = '{$trans}'";
		$result = mysqli_query($this->db,$query);
		
		if($result){
            echo "<script>window.location='../socialwork/home.php';</script>";
        }else{
            echo "<script>alert('Something Went Wrong!');</script>";
        }
	}
	public function doneupdate($id, $trans){
        $now = date("Y-m-d H:i:s");
		
		$query ="UPDATE tbl_transaction SET status_client = 'Done' where trans_id = '{$trans}'";
		$result = mysqli_query($this->db,$query);
		
		if($result){
            echo "<script>window.location='../reissue.php';</script>";
        }else{
            echo "<script>alert('Something Went Wrong!');</script>";
        }
	}
	
	public function enc_done($id, $trans){
		$now = date("Y-m-d H:i:s");
		
		$query ="UPDATE tbl_transaction SET status_client = 'Done' where trans_id = '{$trans}'";
		$result = mysqli_query($this->db,$query);
		
		if($result){
            echo "<script>window.location='../home.php';</script>";
        }else{
            echo "<script>alert('Something Went Wrong!');</script>";
        }
	}
	
	public function servingstatus($id){
		$query = "UPDATE tbl_transaction SET status_client = 'Serving' WHERE trans_id = '{$id}';";
		$result = mysqli_query($this->db,$query);
		if($result){
			return true;
        } else {
			return false;
		}
	}
	
	public function pendingstatus($id){
		$query = "UPDATE tbl_transaction SET status_client = 'Pending' WHERE trans_id = '{$id}';";
		$result = mysqli_query($this->db,$query);
		if($result){
			return true;
        } else {
			return false;
		}
	}
	
	/*public function pass($id){
        $query = "UPDATE client_data SET enc_soc='passed', status_client='Served' WHERE client_id = '{$id}'";
        $result = mysqli_query($this->db, $query);
        if($result){
			return true;
        }
    }*/
	
	//Export the data
	public function getMonthWord($num){
        if($num == 1){
            return "January";
        }elseif($num == 2){
            return "February";
        }elseif($num == 3){
            return "March";
        }elseif($num == 4){
            return "April";
        }elseif($num == 5){
            return "May";
        }elseif($num == 6){
            return "June";
        }elseif($num == 7){
            return "July";
        }elseif($num == 8){
            return "August";
        }elseif($num == 9){
            return "September";
        }elseif($num == 10){
            return "October";
        }elseif($num == 11){
            return "November";
        }elseif($num == 12){
            return "December";
        }
    }
	   //Vew data to be Export in excel
	

	   public function showExport($month, $year){
			$month = $this->getMonth($month);
			$query = "SELECT
					client_id, trans_id, date_entered, encoded_encoder, control_no,date_accomplished, 
					lastname, firstname, middlename, extraname, mode_admission
					from client_data
					LEFT JOIN tbl_transaction using (client_id)
					LEFT JOIN beneficiary_data using(bene_id)
					LEFT JOIN assessment using(trans_id)
					LEFT JOIN gl using (trans_id)
					WHERE YEAR(date_accomplished) = '{$year}' AND MONTH(date_accomplished) = '{$month}' AND tbl_transaction.status_client='Done'
					ORDER BY tbl_transaction.date_entered ASC";
		
			$result = mysqli_query($this->db,$query);
			$data = "";
			while($row = mysqli_fetch_assoc($result)){
				$mode="";
				$fullname = $this->getuserFullname($row['encoded_encoder']);
				$assistance = $this->getAssistanceData($row['trans_id']);
				//print_r($assistance);
				$data .= "<tr>
					<td>{$row['date_accomplished']}</td>
					<td>{$row['lastname']}</td>
					<td>{$row['firstname']}</td>
					<td>{$row['middlename']}</td>
					<td>". $this->translateAss($assistance[1]['type'])."</td>
					<td>{$assistance[1]['amount']}</td>
					";
				if(!empty($assistance[2]['mode'])){
					$mode = ','.$assistance[2]['mode']; //mode sa 2nd assistance
					$data .= "
						<td>{$this->translateAss($assistance[2]['type'])}</td>
						<td>{$assistance[2]['amount']}</td>";
				}else{
					$data .= "
						<td></td>
						<td></td>
					";
				}

				$data .= "
						<td>{$assistance[1]['fund']}</td>
						<td>{$assistance[1]['mode']}{$mode}</td>
					</tr>"; 
				}
				return $data;
			}
		public function getAssistanceData($id){
			$query = "SELECT type, amount, mode, fund, purpose FROM assistance WHERE trans_id = '{$id}';";
			$result = mysqli_query($this->db, $query);
			$num = 0;
			//$data = mysqli_fetch_row($result);
			while($row = mysqli_fetch_assoc($result)){
				$num++; //array index start as 1
				$data[$num] = $row;
			}
			
			if(!empty($data)){
				return $data;
			}else{
				return null;
			}
		}
		public function getAssessmentData($id){
			$query = "SELECT * FROM assessment WHERE trans_id = '{$id}';";
			$result = mysqli_query($this->db, $query);
			//$data = mysqli_fetch_row($result);
			$row = mysqli_fetch_assoc($result);
			
			if(!empty($row)){
				return $row;
			}else{
				return null;
			}
		}

		public function translateAss($type){
				
			if(substr_count(strval($type), "Medic") > 0){
				return "Medical";
			}elseif(substr_count(strval($type), "Trans") > 0){
				return "Transportation";
			}elseif(substr_count(strval($type), "Food Sub") > 0){
				return "Food";
			}elseif(substr_count(strval($type), "Burial") > 0){
				return "Burial";
			}elseif(substr_count(strval($type), "Educ") > 0){
				return "Education";
			}elseif(substr_count(strval($type), "Cash") > 0){
				return "Other Cash Assistance";
			}elseif(substr_count(strval($type), "Non") > 0){
				return "Non-Food";
			}
		}
	
		public function getclientFam($id){
			$query = "SELECT name, relation_bene, age, occupation, salary FROM family WHERE trans_id = '{$id}'";
			$result = mysqli_query($this->db, $query);
			$num = 0;
			//$data = mysqli_fetch_row($result);
			while($row = mysqli_fetch_assoc($result)){
				$num++; //array index start as 1
				$data[$num] = $row;
			}
			if(empty($data)){
				return ""; //pass as dimensional array
			}else{
				return $data;
			}
		}

		public function getGISAssistance($id){
			$query = "SELECT type, if_medical, if_burial, financial, material, amount, mode, fund, purpose FROM assistance WHERE trans_id = '{$id}';";
			$result = mysqli_query($this->db, $query);
			$num = 0;
			//$data = mysqli_fetch_row($result);
			while($row = mysqli_fetch_assoc($result)){
				$num++; //array index start as 1
				$data[$num] = $row;
			}
			
			if(!empty($data)){
				return $data;
			}else{
				return null;
			}
			
		}

		public function getGISAssistanceUsingClientId($id){
			$query = "SELECT type, amount, mode, fund, purpose FROM assistance 
			LEFT JOIN tbl_transaction using (trans_id)
			WHERE client_id = '{$id}';";
			$result = mysqli_query($this->db, $query);
			$num = 0;
			//$data = mysqli_fetch_row($result);
			while($row = mysqli_fetch_assoc($result)){
				$num++; //array index start as 1
				$data[$num] = $row;
			}
			
			if(!empty($data)){
				return $data;
			}else{
				return null;
			}
			
		}
	
		public function getGISData($id){
			$query =  " SELECT gis_option, problem, soc_ass, mode_admission, client_num, service1, service2, service3, service4, ref_name, signatory_id, subcat_ass, target_sector, others_subcat from assessment 
						LEFT JOIN service USING (trans_id) 
						LEFT JOIN tbl_transaction USING (trans_id) WHERE trans_id='{$id}'"; 
						
			$result = mysqli_query($this->db, $query);
			
			$data = mysqli_fetch_assoc($result);
			if(empty($data)){
				return null; 
			}else{
				return $data;
			}

		}
		public function getClientData($id){
			$query = "SELECT client_id FROM tbl_transaction WHERE trans_id='{$id}'";
			$result = mysqli_query($this->db, $query);
			$row = mysqli_fetch_assoc($result);

			$query = "SELECT * FROM client_data WHERE client_id='{$row['client_id']}'";
			$result = mysqli_query($this->db, $query);
			
			$data = mysqli_fetch_assoc($result);
			if(empty($data)){
				return null; 
			}else{
				return $data;
			}
		}

		public function updateClient($id, $lname, $mname, $fname, $exname, $bday, $sex, 
					$region, $province, $municipality, $barangay, $street, $district){
			
				$query ="UPDATE client_data SET firstname='{$fname}', middlename='{$mname}', lastname='{$lname}', extraname='{$exname}', 
						date_birth ='{$bday}', sex='{$sex}', 
						client_region='{$region}', client_province='{$province}', client_municipality='{$municipality}', client_barangay='{$barangay}', 
						client_street='{$street}',client_district='{$district}' 	
						WHERE client_id='{$id}'";
			$result = mysqli_query($this->db,$query);
			
			if($result){
				echo "<script>alert('Successfully Updated!');</script>";
            	echo "<meta http-equiv='refresh' content='0'>";
			}else{
				echo "<script>alert('Something Went Wrong!');</script>";
				
			}
		}
		
		//Update beneficiary in GIS
		public function updateBene($trans_id, $b_id, $relation, $lname, $mname, $fname, $exname, 
								$bday, $category, $s_category, $sex, $status, $contact,
								$region, $province, $municipality, $barangay, $district, $street){

			$query = "UPDATE tbl_transaction SET relation='{$relation}'  WHERE trans_id = '{$trans_id}';";
			$result = mysqli_query($this->db,$query);
			
			$query = "UPDATE beneficiary_data SET b_fname='{$fname}', b_mname='{$mname}', b_lname='{$lname}', b_exname='{$exname}', 
					   b_bday='{$bday}', b_category='{$category}',  b_subCategory='{$s_category}',b_sex='{$sex}', b_civilStatus='{$status}', b_contact='{$contact}',
					   b_region = '{$region}', b_province = '{$province}' , b_municipality='{$municipality}', b_barangay='{$barangay}', b_district='{$district}',
					   b_street ='{$street}'  
				 	   WHERE bene_id = '{$b_id}'";
			$result = mysqli_query($this->db,$query);
			
			if($result){
				echo "<script>alert('Successfully Updated!');</script>";
            	echo "<meta http-equiv='refresh' content='0'>";
			}else{
				echo "<script>alert('Something Went Wrong!');</script>";
				
			}
		}

		public function addBene($trans_id, $relation, $lname, $mname, $fname, $exname, 
								$bday, $category, $s_category, $sex, $status, $contact,
								$region, $province, $municipality, $barangay, $district, $street){
			
			$datenow = date("Y-m-d H:i:s"); //serve as date_entered
									
			$client_id = $this->getClient_id($trans_id); //get client_id to update relation

			
			$query = "INSERT INTO `beneficiary_data`
					(`b_fname`, `b_mname`, `b_lname`, `b_exname`, 
					`b_civilStatus`, `b_contact`, `b_bday`, `b_sex`, `b_category`, `b_subCategory`, `b_region`, 
					`b_province`, `b_municipality`, `b_barangay`, `b_district`, `b_street`, `b_date_inserted`) 
					VALUES 
					('{$fname}','{$mname}','{$lname}','{$exname}','{$status}','{$contact}','{$bday}','{$sex}','{$category}',
					'{$s_category}','{$region}','{$province}','{$municipality}','{$barangay}','{$district}','{$street}', '{$datenow}')";
			$result = mysqli_query($this->db,$query);
			
			$query = "SELECT auto_increment_id_bene FROM beneficiary_data WHERE b_lname = '{$lname}' AND b_fname = '{$fname}' AND b_mname = '{$mname}' AND b_date_inserted = '{$datenow}'";
			$result = mysqli_query($this->db,$query);
			$row = mysqli_fetch_assoc($result);

			$newbeneid = "B-".$row['auto_increment_id_bene'];
			
			$query = "UPDATE beneficiary_data SET bene_id = '{$newbeneid}' WHERE auto_increment_id_bene = '{$row['auto_increment_id_bene']}'";
			$result = mysqli_query($this->db,$query);
			
			$query = "UPDATE tbl_transaction SET bene_id='{$newbeneid}', relation='{$relation}', clientsamebene=1, benetoclient=1 WHERE trans_id = '{$trans_id}';";
			$result = mysqli_query($this->db,$query);
			
			if($result){
				echo "<script>alert('Beneficiary Successfully Added!');</script>";
            	echo "<meta http-equiv='refresh' content='0'>";
			}else{
				echo "<script>alert('Something Went Wrong!');</script>";
				
			}
		}
		
		public function getCOEData($id){
			$query = "SELECT * from coe where trans_id = '{$id}'";
			$result = mysqli_query($this->db, $query);
			$data = mysqli_fetch_assoc($result);
			if(empty($data)){
				return null; 
			}else{
				return $data;
			}
		}
		
		public function checkCheck($type1, $type2, $str){
			$type1 = strtolower($type1);
			$type2 = strtolower($type2);
			$str = strtolower($str);
			if(substr_count(strval($type1), $str) > 0 || substr_count(strval($type2), $str) > 0){
				return "checked";
			}
		}

		public function coe_check($sub, $str){
			$sub = strtolower($sub);
			$str = strtolower($str);
			if(substr_count(strval($str), $sub) > 0){
				return "&#x2714;";
			}else{
				return "";
			}
		}

		public function casestudy($sub, $str, $amount){
			$sub = strtolower($sub);
			$str = strtolower($str);
			if(substr_count(strval($str), $sub) > 0 || $amount >= 5001){
				return "";
			}else{
				return "hidden";
			}
		}

	public function checkService($type1, $type2, $content1, $content2, $str){
			$type1 = strtolower($type1); // type1 of service
			$type2 = strtolower($type2); // type2 of service
			if(empty($type2)){
				$type2 = "";
			}
			$content1 =  strtolower($content1); // content of type1 to be echoed
			$content2 =  strtolower($content2); // content of type2 to be echoed
			if(empty($content2)){
				$content2 = "";
			}
			$str = strtolower($str); // the type of content to be compared
			if(substr_count(strval($type1), $str) > 0 || substr_count(strval($type2), $str) > 0){
				if(substr_count(strval($type1), $str) > 0){
					return strtoupper($content1);
					// return strtoupper("current fund");
				}elseif (substr_count(strval($type2), $str) > 0) {
					return strtoupper($content2);
					// return strtoupper("current fund");
				}
			}else{
				return "";
			}
	}

	public function checkFAssistance($type1, $str){
		$type1 = strtolower($type1); // type1 of service
		$str = strtolower($str); // the type of content to be compared
		if(substr_count(strval($type1), $str) > 0){
			return "checked";
			// return strtoupper("current fund");
		}else{
			return "";
		}
	}
	
	public function listOfMonths(){
        $data =  '
        <datalist id="months">
            <option>January</option>
            <option>February</option>
            <option>March</option>
            <option>April</option>
            <option>May</option>
            <option>June</option>
            <option>July</option>
            <option>August</option>
            <option>September</option>
            <option>October<option>
            <option>November</option>
            <option>December</option>
        </datalist>
        ';
        return $data;
	}
    public function getMonth($num){
        if($num == "January"){
            return 1;
        }elseif($num == "February"){
            return 2;
        }elseif($num == "March"){
            return 3;
        }elseif($num == "April"){
            return 4;
        }elseif($num == "May"){
            return 5;
        }elseif($num == "June"){
            return 6;
        }elseif($num == "July"){
            return 7;
        }elseif($num == "August"){
            return 8;
        }elseif($num == "September"){
            return 9;
        }elseif($num == "October"){
            return 10;
        }elseif($num == "November"){
            return 11;
        }elseif($num == "December"){
            return 12;
        }
	}
	
	//mag show ug data sa table ddto sa encoder
	public function showdataServed(){
		$query = "SELECT client_data.*, beneficiary_data.*, tbl_transaction.* FROM client_data
		LEFT JOIN tbl_transaction using (client_id)
		LEFT JOIN beneficiary_data using (bene_id)
		WHERE (status_client = 'Done' OR status_client = 'Decline') 
		limit 5;";
		$result = mysqli_query($this->db,$query);
		
		if($result){
			return $result;
		}
		else{
			return false;
		}
	}
	public function showdataServedforReissue(){
		$query = "SELECT client_data.*, beneficiary_data.*, tbl_transaction.* FROM client_data
		LEFT JOIN tbl_transaction using (client_id)
		LEFT JOIN beneficiary_data using (bene_id)
		WHERE status_client = 'Done'
		limit 5;";
		$result = mysqli_query($this->db,$query);
		
		if($result){
			return $result;
		}
		else{
			return false;
		}
	}
	// public function showdataImported(){
	// 	$query = "SELECT * FROM client_info
	// 	limit 5;";
	// 	$result = mysqli_query($this->db3,$query);
		
	// 	if($result){
	// 		return $result;
	// 	}
	// 	else{
	// 		return false;
	// 	}
	// 	}
		
		public function showdataUnserved(){
			
		$now = date("Y-m-d H:i:s");
		$now2 = date('Y-m-d H:i:s', strtotime('-5 days'));
		$query = "SELECT * FROM tbl_transaction
		LEFT JOIN client_data USING (client_id)
		LEFT JOIN beneficiary_data USING (bene_id) 
		WHERE (status_client = 'Pending' OR status_client = 'Serving') AND encoded_encoder IS NOT NULL AND (date_entered BETWEEN '{$now2}' AND '{$now}')
		ORDER BY date_entered DESC;";
		$result = mysqli_query($this->db,$query);
		
		if($result){
			return $result;
		}
		else{
			return false;
		}
		}
		public function getTransidOffice($trans_id){
		$query = "SELECT LEFT('".$trans_id."', 9) as foid";
		
		$result = mysqli_query($this->db,$query);
		
		$row = mysqli_fetch_assoc($result);
		
		if($result){
			return $row;
		}
		else{
			return false;
		}
		}
	
	// public function searchUnserved($val){
	// 	$value = mysqli_real_escape_string($this->db,$val); 

	// 	$query = "SELECT * FROM client_data 
	// 	LEFT JOIN beneficiary_data ON client_data.client_id = beneficiary_data.client_id
	// 	LEFT JOIN transact ON client_data.client_id = transact.client_id
	// 	WHERE catered = 'no' AND (status_client = 'Pending' OR status_client = 'Serving')
	// 	AND (CONCAT(firstname, ' ',middlename, ' ',lastname, ' ',b_fname, ' ',b_mname, ' ',b_lname) LIKE '%".$value."%')
	// 	ORDER BY date_entered DESC";
		
	// 	$result = mysqli_query($this->db, $query);
		
	// 	if($result){
	// 		return $result;
	// 	}
	// 	else{
	// 		return false;
	// 	}
	// }

	public function getBeneData($id){
		// echo $id;
		$id = mysqli_real_escape_string($this->db,$id);
		
		$query = "SELECT beneficiary_data.*, tbl_transaction.relation FROM tbl_transaction
		LEFT JOIN beneficiary_data USING (bene_id)
		where trans_id = '$id'";
		
		$result = mysqli_query($this->db, $query);
		$data = mysqli_fetch_assoc($result);

		if($result){
			return $data;
		}else{
			return false;
		}

	}

	public function searchServed($val){
		$value = mysqli_real_escape_string($this->db,$val); 

		$query = "SELECT c.lastname, c.firstname, c.middlename, c.extraname, b.b_lname, b.b_fname, b.b_mname, b.b_exname, t.status_client, t.trans_id, t.relation, t.date_accomplished, t.clientonly, t.clientsamebene, t.benetoclient
		FROM client_data c 
		LEFT JOIN tbl_transaction t using (client_id)
		LEFT JOIN beneficiary_data b using (bene_id)
		WHERE (status_client = 'Done' OR status_client = 'Decline')
		AND ((CONCAT
		(firstname, ' ',middlename, ' ',lastname)
		 LIKE '%".$value."%') 
		 OR (CONCAT
		 (b_fname, ' ',b_mname, ' ',b_lname)
		 LIKE '%".$value."%')
		 OR (CONCAT
		(lastname, ' ',middlename, ' ',firstname)
		 LIKE '%".$value."%') 
		 OR (CONCAT
		 (b_mname, ' ',b_fname, ' ',b_lname)
		  LIKE '%".$value."%') 
		 OR (CONCAT
		(middlename, ' ',firstname, ' ',lastname)
		 LIKE '%".$value."%') 
		 OR (CONCAT
		(b_lname, ' ',b_mname, ' ',b_fname)
		 LIKE '%".$value."%') 
		 OR (CONCAT
		(lastname, ' ',firstname, ' ',middlename)
		 LIKE '%".$value."%') 
		 OR (CONCAT
		(b_lname, ' ',b_fname, ' ',b_mname)
		 LIKE '%".$value."%') 
		 OR (CONCAT
		(middlename, ' ',lastname, ' ',firstname)
		 LIKE '%".$value."%') 
		 OR (CONCAT
		(b_mname, ' ',b_lname, ' ',b_fname)
		 LIKE '%".$value."%') 
		 OR (CONCAT
		(firstname, ' ',lastname, ' ',middlename)
		 LIKE '%".$value."%') 
		 OR (CONCAT
		(b_fname, ' ',b_lname, ' ',b_mname)
		 LIKE '%".$value."%')) 
		 ORDER BY date_entered DESC LIMIT 3";

		$result = mysqli_query($this->db, $query);

		if($result){
			return $result;
		}
		else{
			return false;
		}
	}
	
	public function searchServedforReissue($val){
		$value = mysqli_real_escape_string($this->db,$val); 

		$query = "SELECT c.lastname, c.firstname, c.middlename, c.extraname, b.b_lname, b.b_fname, b.b_mname, b.b_exname, t.status_client, t.trans_id, t.relation, t.date_accomplished, t.clientonly, t.clientsamebene, t.benetoclient
		FROM client_data as c
		LEFT JOIN tbl_transaction as t using (client_id)
		LEFT JOIN beneficiary_data as b using (bene_id)
		WHERE (status_client = 'Done')
		AND ((CONCAT
		(firstname, ' ',middlename, ' ',lastname)
		 LIKE '%".$value."%') 
		 OR (CONCAT
		 (b_fname, ' ',b_mname, ' ',b_lname)
		 LIKE '%".$value."%')
		 OR (CONCAT
		(lastname, ' ',middlename, ' ',firstname)
		 LIKE '%".$value."%') 
		 OR (CONCAT
		 (b_mname, ' ',b_fname, ' ',b_lname)
		  LIKE '%".$value."%') 
		 OR (CONCAT
		(middlename, ' ',firstname, ' ',lastname)
		 LIKE '%".$value."%') 
		 OR (CONCAT
		(b_lname, ' ',b_mname, ' ',b_fname)
		 LIKE '%".$value."%') 
		 OR (CONCAT
		(lastname, ' ',firstname, ' ',middlename)
		 LIKE '%".$value."%') 
		 OR (CONCAT
		(b_lname, ' ',b_fname, ' ',b_mname)
		 LIKE '%".$value."%') 
		 OR (CONCAT
		(middlename, ' ',lastname, ' ',firstname)
		 LIKE '%".$value."%') 
		 OR (CONCAT
		(b_mname, ' ',b_lname, ' ',b_fname)
		 LIKE '%".$value."%') 
		 OR (CONCAT
		(firstname, ' ',lastname, ' ',middlename)
		 LIKE '%".$value."%') 
		 OR (CONCAT
		(b_fname, ' ',b_lname, ' ',b_mname)
		 LIKE '%".$value."%')) 
		ORDER BY date_entered DESC LIMIT 3";

		$result = mysqli_query($this->db, $query);

		if($result){
			return $result;
		}
		else{
			return false;
		}
	}

	public function showdataServed_reissued(){
		$query = "SELECT * FROM reissuelog LIMIT 5";

		$result = mysqli_query($this->db, $query);
		
		if($result){
			return $result;
		}
		else{
			return false;
		}
	}

	public function searchReissue_log($val){
		$value = mysqli_real_escape_string($this->db,$val); 

		$query = "SELECT c.lastname, c.firstname, c.middlename, c.extraname, b.b_lname, b.b_fname, b.b_mname, b.b_exname, t.relation, t.trans_id, t.status_client, r.* 
		FROM client_data c
		LEFT JOIN tbl_transaction t using (client_id)
		LEFT JOIN beneficiary_data b using (bene_id)
        LEFT JOIN reissuelog r USING (trans_id)
		WHERE (t.status_client = 'Done') 
        AND r.date_reissued is NOT NULL
        AND ((CONCAT
		(c.firstname,' ',c.middlename,' ',c.lastname) LIKE '%". $value ."%') 
		 OR (CONCAT (b.b_fname, ' ',b.b_mname, ' ',b.b_lname) LIKE '%". $value ."%')
		 OR (CONCAT (c.lastname, ' ',c.middlename, ' ',c.firstname) LIKE '%". $value ."%') 
		 OR (CONCAT (b.b_lname, ' ',b.b_mname, ' ',b.b_fname) LIKE '%". $value ."%') 
		 OR (CONCAT (c.lastname, ' ',c.firstname, ' ',c.middlename) LIKE '%". $value ."%'))
		 ORDER BY t.date_entered DESC LIMIT 8";

		$result = mysqli_query($this->db, $query);

		if($result){
			return $result;
		}
		else{
			return false;
		}
	}

	public function searchReissue_log_noData($val){
		$value = mysqli_real_escape_string($this->db,$val); 

		$query = "SELECT c.*, b.*, t.*, r.* FROM client_data c
		LEFT JOIN tbl_transaction t using (client_id)
		LEFT JOIN beneficiary_data b using (bene_id)
        LEFT JOIN reissuelog r USING (trans_id)
		WHERE (t.status_client = 'Done') 
        AND r.date_reissued is NOT NULL		   
        ORDER BY r.date_reissued DESC LIMIT 8";

		$result = mysqli_query($this->db, $query);

		if($result){
			return $result;
		}
		else{
			return false;
		}
	}



	public function search_on_summary_encoder($value){
		$value = mysqli_real_escape_string($this->db,$value); 
		$encoder = $_SESSION['userId'];
		$query = "SELECT * FROM client_data 
		LEFT JOIN transact ON client_data.client_id = transact.client_id
		LEFT JOIN assistance ON client_data.client_id = assistance.client_id
		LEFT JOIN beneficiary_data ON client_data.client_id = beneficiary_data.client_id
		WHERE encoded_encoder = '".$encoder."';";

		$result = mysqli_query($this->db, $query);

		if($result){
			return $result;
		}
		else{
			return false;
		}
	}

	public function show_socialwork_summary($id){
		 $query = "SELECT * FROM client_data 
		LEFT JOIN tbl_transaction using (client_id)
		LEFT JOIN beneficiary_data using (bene_id)
		WHERE encoded_socialWork = '{$id}';";

		$result = mysqli_query($this->db, $query);

		if($result){
			return $result;
		}
		else{
			return false;
		}
	}
	public function get_encoder_to_socialwork_summary($id){
		$query = "SELECT * FROM tbl_employment
		LEFT JOIN employee_info  USING (empnum)
		LEFT JOIN cpms_account USING (empid)
		WHERE empid = '{$id}';";

		$result = mysqli_query($this->db2, $query);
		$row = mysqli_fetch_assoc($result);


		if($result){
			return $row;
		}
		else{
			return false;
		}
	}
	public function show_encoder_summary(){
		$encoder = $_SESSION['userId'];
		$query = "SELECT * FROM client_data 
		LEFT JOIN tbl_transaction using (client_id)
		LEFT JOIN beneficiary_data using (bene_id)
		WHERE encoded_encoder = '{$encoder}';";

		$result = mysqli_query($this->db, $query);

		if($result){
			return $result;
		}
		else{
			return false;
		}
	}
	public function get_socialwork_to_encoder_summary($id){
		$query = "SELECT * FROM employee_info 
			LEFT JOIN tbl_employment USING (empnum)
			LEFT JOIN cpms_account USING (empid)
			WHERE empid='{$id}';";

		$result = mysqli_query($this->db2, $query);
		$row = mysqli_fetch_assoc($result);

		if($result){
			return $row;
		}
		else{
			return false;
		}


	}
	public function show_data_encoder_summary_filter($date_from, $date_to){
		$encoder = $_SESSION['userId'];
		$query = "SELECT * FROM client_data 
		LEFT JOIN transact ON client_data.client_id = transact.client_id
		LEFT JOIN assistance on client_data.client_id = assistance.client_id 
		LEFT JOIN beneficiary_data ON client_data.client_id = beneficiary_data.client_id
		WHERE encoded_encoder = '".$encoder."' AND 
		CAST(date_accomplished as date)  BETWEEN '".$date_from."' AND '".$date_to."';";

		$result = mysqli_query($this->db,$query);

		if($result){
			return $result;
		}
		else{
			return false;
		}
	}

	public function summaryDataTableEncoder($date1, $date2, $datenow, $datenow2) {
		if (empty($datenow) && empty($datenow2)) {
			$query = "SELECT client_id, trans_id, lastname, firstname, middlename, extraname, date_accomplished, encoded_socialWork, b_fname, b_mname, b_lname, b_exname 
			FROM `client_data` 
			LEFT JOIN tbl_transaction USING (client_id) 
			LEFT JOIN beneficiary_data USING (bene_id)
			where (status_client = 'Done' AND encoded_encoder = '{$_SESSION['userId']}' AND (date_accomplished BETWEEN '{$date1}' AND '{$date2}')) ORDER BY `tbl_transaction`.`date_accomplished` DESC";
		}else{
			$query = "SELECT client_id, trans_id, lastname, firstname, middlename, extraname, date_accomplished, encoded_socialWork, b_fname, b_mname, b_lname, b_exname 
			FROM `client_data` 
			LEFT JOIN tbl_transaction USING (client_id) 
			LEFT JOIN beneficiary_data USING (bene_id)
			where status_client = 'Done' AND encoded_encoder = '{$_SESSION['userId']}' AND (date_accomplished BETWEEN '{$datenow}' AND '{$datenow2}') ORDER BY `tbl_transaction`.`date_accomplished` DESC";
		}
		$result = mysqli_query($this->db, $query);
		return $result;
	}
	public function summaryGetNumRowsEnc($date1, $date2, $datenow, $datenow2) {
		if (empty($datenow) && empty($datenow2)) {
			$query = "SELECT client_id, trans_id, lastname, firstname, middlename, extraname, date_accomplished, encoded_socialWork, b_fname, b_mname, b_lname, b_exname 
			FROM `client_data` 
			LEFT JOIN tbl_transaction USING(client_id) 
			LEFT JOIN beneficiary_data USING (bene_id)
			where (status_client = 'Done' AND encoded_encoder = '{$_SESSION['userId']}' AND (date_accomplished BETWEEN '{$date1}' AND '{$date2}'));";
			$result = mysqli_query($this->db, $query);
			$rownum = mysqli_num_rows($result);
		}else{
			$query = "SELECT client_id, trans_id, lastname, firstname, middlename, extraname, date_accomplished, encoded_socialWork, b_fname, b_mname, b_lname, b_exname 
			FROM `client_data` 
			LEFT JOIN tbl_transaction USING(client_id) 
			LEFT JOIN beneficiary_data USING (bene_id)
			where (status_client = 'Done' AND encoded_encoder = '{$_SESSION['userId']}' AND (date_accomplished BETWEEN '{$datenow}' AND '{$datenow2}'));";
			$result = mysqli_query($this->db, $query);
			$rownum = mysqli_num_rows($result);
		}
		return $rownum;
	}

	public function summaryDataTableSocialWork($date1, $date2, $datenow, $datenow2) {
		if (empty($datenow) && empty($datenow2)) {
			$query = "SELECT client_id, trans_id, lastname, firstname, middlename, extraname, date_accomplished, encoded_encoder, b_fname, b_mname, b_lname, b_exname 
            FROM `client_data` 
            LEFT JOIN tbl_transaction USING (client_id) 
            LEFT JOIN beneficiary_data USING (bene_id)
            where (status_client = 'Done' AND encoded_socialWork = '{$_SESSION['userId']}' AND (date_accomplished BETWEEN '{$date1}' AND '{$date2}')) ORDER BY `tbl_transaction`.`date_accomplished` DESC";
        }else{
			$query = "SELECT client_id, trans_id, lastname, firstname, middlename, extraname, date_accomplished, encoded_encoder, b_fname, b_mname, b_lname, b_exname 
            FROM `client_data` 
            LEFT JOIN tbl_transaction USING (client_id) 
            LEFT JOIN beneficiary_data USING (bene_id)
            where status_client = 'Done' AND encoded_socialWork = '{$_SESSION['userId']}' AND (date_accomplished BETWEEN '{$datenow}' AND '{$datenow2}') ORDER BY `tbl_transaction`.`date_accomplished` DESC";
        }
		$result = mysqli_query($this->db, $query);
		return $result;
	}
	public function summaryGetNumRowsSocWork($date1, $date2, $datenow, $datenow2) {
        if (empty($datenow) && empty($datenow2)) {
            $query = "SELECT client_id, trans_id, lastname, firstname, middlename, extraname, date_accomplished, encoded_encoder, b_fname, b_mname, b_lname, b_exname 
            FROM `client_data` 
            LEFT JOIN tbl_transaction USING (client_id) 
            LEFT JOIN beneficiary_data USING (bene_id)
            where (status_client = 'Done' AND encoded_socialWork = '{$_SESSION['userId']}' AND (date_accomplished BETWEEN '{$date1}' AND '{$date2}'))";
            $result = mysqli_query($this->db, $query);
            $rownum = mysqli_num_rows($result);
        } else {
            $query = "SELECT client_id, trans_id, lastname, firstname, middlename, extraname, date_accomplished, encoded_encoder, b_fname, b_mname, b_lname, b_exname 
            FROM `client_data` 
            LEFT JOIN tbl_transaction USING (client_id) 
            LEFT JOIN beneficiary_data USING (bene_id)
            where (status_client = 'Done' AND encoded_socialWork = '{$_SESSION['userId']}' AND (date_accomplished BETWEEN '{$datenow}' AND '{$datenow2}'));";
            $result = mysqli_query($this->db, $query);
            $rownum = mysqli_num_rows($result);
        }
		return $rownum;
    }

	public function getsignatoryINI($id){
		$query = "SELECT initials FROM signatory WHERE signatory_id = '{$id}';";
		$result = mysqli_query($this->db,$query);
		$row = mysqli_fetch_assoc($result);
		$data = $row['initials'];
		if($result){
			return $data;
		}
		else{         
			return false;
		}
	}
	public function getsocialWorkINI($id){
		$query = "SELECT * FROM tbl_employment
		LEFT JOIN employee_info  USING (empnum)
		LEFT JOIN cpms_account USING (empid)
		WHERE empid = '{$id}';";
		$result = mysqli_query($this->db2,$query);
		$row = mysqli_fetch_assoc($result);
		$data = $row['empfname'][0].'';
		if(!empty($row['empmname'][0])){
			$data .= $row['empmname'][0].'';
		}
		$data .= $row['emplname'][0];
		if($result){
			return $data;
		}
		else{
			return false;
		}
	}

	public function get_assistance_mode($trans_id){
		$query = "SELECT mode FROM assistance WHERE trans_id = '{$trans_id}';";
		
		$result = mysqli_query($this->db, $query);
		$num = mysqli_num_rows($result);
		$index = 1;
		if($num > 1){
			while($row = mysqli_fetch_assoc($result)){
				$mode[$index] = $row['mode'];
				$index++;
			}
			$data = $mode[1] .", ". $mode[2];
		}else{
			while($row = mysqli_fetch_assoc($result)){
				$data = $row['mode'];
			}
		}
		
		return $data;
	}

	public function getencoderINI($id){
		$query = "SELECT * FROM tbl_employment
		LEFT JOIN employee_info  USING (empnum)
		LEFT JOIN cpms_account USING (empid)
		WHERE empid = '{$id}';";
		$result = mysqli_query($this->db2,$query);
		$row = mysqli_fetch_assoc($result);
		$data = $row['empfname'][0].'';
		if(!empty($row['empmname'][0])){
			$data .= $row['empmname'][0].'';
		}
		$data .= $row['emplname'][0];
		if($result){
			return $data;
		}
		else{
			return false;
		}
	}
	public function decline_client_to_socialWork($id,$swid){
        $now = date("Y-m-d H:i:s");
		$query = "UPDATE tbl_transaction SET status_client='Decline', date_accomplished='{$now}', encoded_socialWork='{$swid}'
		WHERE trans_id='{$id}';";
		$result = mysqli_query($this->db, $query);

		if($result){
			return true;
		}
		else{
			return false;
		}
	}
	public function decline_client_to_socialWork_Serving($id,$swid){
        $now = date("Y-m-d H:i:s");
		$query = "UPDATE client_data SET status_client='Decline', date_accomplished='{$now}'
		WHERE trans_id='{$id}';";
		$query .= " UPDATE transact SET encoded_socialWork='{$swid}' WHERE client_id='{$id}';";
		$result = mysqli_multi_query($this->db, $query);

		if($result){
			return true;
		}
		else{
			return false;
		}
	}

	public function get_data_of_the_decline_client($id){
		$query = "SELECT * FROM client_data 
		LEFT JOIN tbl_transaction using (client_id)
		WHERE trans_id = '{$id}' AND (status_client = 'Pending' OR status_client = 'Serving');";
		$result = mysqli_query($this->db, $query);

		if($result){
			return $result;
		}
		else{
			return false;
		}
	}
	public function readOnly($str){
		if(strtolower($str) == "self"){
			echo "readonly";
		}else{
			"";
		}
	}
	public function show_client_history_data($id){
			
		$query = "SELECT tbl_transaction.date_accomplished, client_data.firstname, client_data.lastname, client_data.middlename, client_data.extraname, beneficiary_data.b_fname, beneficiary_data.b_lname, beneficiary_data.b_mname, beneficiary_data.b_exname, tbl_transaction.relation FROM client_data
			LEFT JOIN tbl_transaction using (client_id)
			LEFT JOIN beneficiary_data using (bene_id)
			LEFT JOIN service using (trans_id) 
			LEFT JOIN gl using (trans_id) 
			WHERE client_id = '{$id}' and (status_client = 'Done' or status_client ='Decline');";

		$result = mysqli_query($this->db,$query);
		
		if(!empty($result)){
			return $result;
		}
		else{
			return false;
		}
		
	}
	public function getClient_id($id){
		$query = "SELECT client_id FROM tbl_transaction WHERE trans_id = '{$id}'";
		$result = mysqli_query($this->db,$query);
		$row = mysqli_fetch_assoc($result);
		return $row['client_id'];
	}
	public function getBene_id($id){
		$query = "SELECT bene_id FROM tbl_transaction WHERE trans_id = '{$id}'";
		$result = mysqli_query($this->db,$query);
		$row = mysqli_fetch_assoc($result);
		return $row['bene_id'];
	}
	
	public function getClientImage($id){
		$query = "SELECT * FROM webcam WHERE trans_id='{$id}'";
		$result = mysqli_query($this->db,$query);
		$row = mysqli_fetch_assoc($result);
		$img = "../clientImages/no_avatar.gif";
		if(!empty($row['image'])){
			$img = $row['image'];
		}
		return $img;
	}

	public function assessment_by_socialwork(){
		$query = "SELECT * from gisassessment";
		$result = mysqli_query($this->db, $query);
		if($result){
			return $result;
		}
		else {
			return false;
		}
	}

	public function getosap($id) {
		$year   = intval(Date("Y"));
		$year1  = intval(date("Y", strtotime("+1 days")));
		
		$day    = intval(Date("d"));
		if(strlen($day)==1){
			$day = '0'.$day;
		}else{
			$day = $day;
		}
		$month  = intval(date('m'));
		if(strlen($month)==1){
			$monthnum = '0'.$month;
		}else{
			$monthnum = $month;
		}
		$month1  = intval(date('m', strtotime('+1 days')));
		if(strlen($month1)==1){
			$monthnum1 = '0'.$month1;
		}else{
			$monthnum1 = $month1;
		}
		$day1 = intval(date('d', strtotime('+1 days')));
		if(strlen($day1)==1){
			$day1 = '0'.$day1;
		}else{
			$day1 = $day1;
		}
		$date1 = $year.'-'.$monthnum.'-'.$day.' 00:00:00';
		$date2 = $year1.'-'.$monthnum1.'-'.$day1.' 00:00:00';;

		$query = "SELECT * from tbl_osap where trans_id = '{$id}' and (osap_created between '{$date1}' and '{$date2}')";
		$result = mysqli_query($this->db, $query);

		$rows = mysqli_fetch_assoc($result);
		if($rows){
			return $rows;
		}else{
			return false;
		}
	}

	public function create_osap($id, $req_by, $sign){
		$now = date("Y-m-d H:i:s"); //serve as date_entered
		
		$query = "INSERT INTO tbl_osap(trans_id, osap_created, requested_by, signatory, empid) VALUES
		('{$id}', '{$now}', '{$req_by}', '{$sign}', '{$_SESSION['userId']}');";
		$result = mysqli_query($this->db, $query);
		
		if($result){
			return true;
		}else{
			return false;
		}
	}

	public function update_osap($id, $req_by, $sign){
		$now = date("Y-m-d H:i:s"); //serve as date_entered
		
		$query = "UPDATE tbl_osap SET osap_created = '{$now}', requested_by = '{$req_by}', 
		signatory = '{$sign}', empid = '{$_SESSION['userId']}' where trans_id = '{$id}';";
		$result = mysqli_query($this->db, $query);
		
		if($result){
			return true;
		}else{
			return false;
		}
	}

	public function ReissueDocument($id){
		$now = date("Y-m-d H:i:s"); //serve as date_entered
		
		$query = "INSERT INTO reissuelog(trans_id, date_reissued, empid, office_id) VALUES
		('{$id}', '{$now}', '{$_SESSION['userId']}', '{$_SESSION['f_office']}');";
		$result = mysqli_query($this->db, $query);
		
		if($result){
			echo "<script>alert('Succesfully Reissued')</script>";
		}else{
			return false;
		}
	}

	public function getReissueData($id){
		$query = "SELECT * FROM reissuelog WHERE trans_id = '{$id}';";
		$result = mysqli_query($this->db, $query);
		$row = mysqli_fetch_assoc($result);
		$rows = mysqli_num_rows($result);
		if($rows > 0){
			return $row;
		}
		else {
			return false;
		}
	}

	// public function reissue($id, $updatedamount1, $updatedamount2){
	// 	$now = date("Y-m-d H:i:s"); //serve as date_entered
	// 	$update = 'Reissued On Updated Amount Of Guarantee Letter';
	// 	$query = "SELECT * FROM client_data 
	// 	LEFT JOIN client_address ON client_data.client_id = client_address.client_id
	// 	LEFT JOIN beneficiary_data ON client_data.client_id = beneficiary_data.client_id
	// 	LEFT JOIN b_address ON beneficiary_data.b_id = b_address.b_id
	// 	LEFT JOIN transact ON client_data.client_id = transact.client_id
	// 	LEFT JOIN coe ON client_data.client_id = coe.client_id
	// 	LEFT JOIN assistance ON client_data.client_id = assistance.client_id
	// 	LEFT JOIN service ON client_data.client_id = service.client_id
	// 	LEFT JOIN webcam ON client_data.client_id = webcam.client_id
	// 	LEFT JOIN gl ON client_data.client_id = gl.client_id
	// 	LEFT JOIN cash ON client_data.client_id = cash.client_id
	// 	WHERE client_data.client_id='{$id}'";
	// 	$result = mysqli_query($this->db, $query);
	// 	$data = mysqli_fetch_assoc($result);		

	// 	$query = "INSERT INTO reissuelog(client_id, date_entered, date_accomplished, status)
	// 	VALUES
	// 	('{$id}','{$data['date_entered']}','{$data['date_accomplished']}','{$update}')";
	// 	$result = mysqli_query($this->db,$query);
		
	// 	$query = "SELECT reissue_id FROM reissuelog WHERE client_id='{$id}' AND date_entered='{$data['date_entered']}' 
	// 	AND date_accomplished='{$data['date_accomplished']}' AND status='{$update}' ";
	// 	$result = mysqli_query($this->db,$query);
	// 	$reissueid = mysqli_fetch_assoc($result);

	// 	$query = "UPDATE client_data SET date_entered = '{$now}', date_accomplished = '{$now}' 
	// 	WHERE client_id ='{$id}';";
	// 	$result = mysqli_query($this->db,$query);


	// 	if($updatedamount1 != 0){
	// 		$query = "UPDATE reissuelog SET amount1 = '{$data['amount1']}' WHERE reissue_id={$reissueid['reissue_id']};";
	// 		$result = mysqli_query($this->db,$query);
			
	// 		$query = "UPDATE assistance SET amount1 = '{$updatedamount1}' WHERE client_id='{$id}';";
	// 		$result = mysqli_query($this->db,$query);
	// 	}
	// 	if(!empty($data['type2'])){
	// 		if($updatedamount2 != 0){
	// 			$query = "UPDATE reissuelog SET amount2 = '{$data['amount2']}' WHERE reissue_id={$reissueid['reissue_id']};";
	// 			$result = mysqli_query($this->db,$query);
				
	// 			$query = "UPDATE assistance SET amount2 = '{$updatedamount2}' WHERE client_id='{$id}';";
	// 			$result = mysqli_query($this->db,$query);
	// 		}
	// 	}

	// 	if($result){
	// 		return $id;
	// 	}else{
	// 		return false;
	// 	}
	// }

	// public function reissueexpired($id){
	// 	$now = date("Y-m-d H:i:s"); //serve as date_entered
	// 	$update = 'Reissued On Expired Guarantee Letter';

	// 	$query = "SELECT * FROM client_data 
	// 	LEFT JOIN client_address ON client_data.client_id = client_address.client_id
	// 	LEFT JOIN beneficiary_data ON client_data.client_id = beneficiary_data.client_id
	// 	LEFT JOIN b_address ON beneficiary_data.b_id = b_address.b_id
	// 	LEFT JOIN transact ON client_data.client_id = transact.client_id
	// 	LEFT JOIN coe ON client_data.client_id = coe.client_id
	// 	LEFT JOIN assistance ON client_data.client_id = assistance.client_id
	// 	LEFT JOIN service ON client_data.client_id = service.client_id
	// 	LEFT JOIN webcam ON client_data.client_id = webcam.client_id
	// 	LEFT JOIN gl ON client_data.client_id = gl.client_id
	// 	LEFT JOIN cash ON client_data.client_id = cash.client_id
	// 	WHERE client_data.client_id='{$id}'";
	// 	$result = mysqli_query($this->db, $query);
	// 	$data = mysqli_fetch_assoc($result);		

	// 	$query = "INSERT INTO reissuelog(client_id, date_entered, date_accomplished, status)
	// 	VALUES
	// 	('{$id}','{$now}','{$now}','{$update}')";
	// 	$result = mysqli_query($this->db,$query);

	// 	if($result){
	// 		return $id;
	// 	}else{
	// 		return false;
	// 	}
	// }
	public function gis_client_history($id){
			
		$query = "SELECT * FROM gis_log WHERE trans_id='{$id}'";

		$result = mysqli_query($this->db,$query);
		$row = mysqli_num_rows($result);
		
		if($row > 0){
			return $result;
		}
		else{
			return false;
		}
		
	}
	public function last_client_history($id){
			
		$query = "SELECT * FROM last_log WHERE trans_id='{$id}'";

		$result = mysqli_query($this->db,$query);
		$row = mysqli_num_rows($result);
		
		if($row > 0){
			return $result;
		}
		else{
			return false;
		}
		
	}
	
	public function reissue_client_history($id){
			
		$query = "SELECT * FROM reissuelog WHERE client_id='{$id}' ORDER BY date_reissue ASC;";

		$result = mysqli_query($this->db,$query);
		$row = mysqli_num_rows($result);
		
		if($row > 0){
			return $result;
		}
		else{
			return false;
		}
		
	}

	public function webcamimagesource($id){
			
		$query = "SELECT * FROM webcam WHERE trans_id='{$id}'";

		$result = mysqli_query($this->db,$query);
		$rows = mysqli_fetch_assoc($result);
		$row = mysqli_num_rows($result);
		
		if($row > 0){
			return $rows;
		}
		else{
			return false;
		}
		
	}

	public function setsw($empid, $transid){
		$query = "UPDATE tbl_transaction SET encoded_socialWork = '{$empid}' WHERE trans_id = '{$transid}'";
		$result = mysqli_query($this->db,$query);
	}
	public function unsetsw($transid){
		$query = "UPDATE tbl_transaction SET encoded_socialWork = '' WHERE trans_id = '{$transid}'";
		$result = mysqli_query($this->db,$query);
	}

	

	public function initials_gl($sign_tree, $swid, $eid, $a) {
		$ini = "";
		
		if($sign_tree == "CURRENTHEAD1"){
			$query = "SELECT initials FROM signatory WHERE signatory_tree = 'CURRENTHEAD1'";
			$result = mysqli_query($this->db,$query);
			$rows = mysqli_fetch_assoc($result);
			$ini = $rows['initials'];
			$query = "SELECT initials FROM signatory WHERE signatory_tree = 'CURRENTHEAD2'";
			$result = mysqli_query($this->db,$query);
			$rows = mysqli_fetch_assoc($result);
			$ini .= "/".$rows['initials'];
			$query = "SELECT initials FROM signatory WHERE signatory_tree = 'CURRENTHEAD3'";
			$result = mysqli_query($this->db,$query);
			$rows = mysqli_fetch_assoc($result);
			$ini .= "/".$rows['initials'];
			$query = "SELECT initials FROM signatory WHERE signatory_tree = 'CURRENTHEAD4'";
			$result = mysqli_query($this->db,$query);
			$rows = mysqli_fetch_assoc($result);
			$ini .= "/".$rows['initials'];
			$query = "SELECT initials FROM signatory WHERE signatory_tree = 'CURRENTHEAD5'";
			$result = mysqli_query($this->db,$query);
			$rows = mysqli_fetch_assoc($result);
			$ini .= "/".$rows['initials']."/";
			
		}if($sign_tree == "CURRENTHEAD2"){
			$query = "SELECT initials FROM signatory WHERE signatory_tree = 'CURRENTHEAD2'";
			$result = mysqli_query($this->db,$query);
			$rows = mysqli_fetch_assoc($result);
			$ini = $rows['initials'];
			$query = "SELECT initials FROM signatory WHERE signatory_tree = 'CURRENTHEAD3'";
			$result = mysqli_query($this->db,$query);
			$rows = mysqli_fetch_assoc($result);
			$ini .= "/".$rows['initials'];
			$query = "SELECT initials FROM signatory WHERE signatory_tree = 'CURRENTHEAD4'";
			$result = mysqli_query($this->db,$query);
			$rows = mysqli_fetch_assoc($result);
			$ini .= "/".$rows['initials'];
			$query = "SELECT initials FROM signatory WHERE signatory_tree = 'CURRENTHEAD5'";
			$result = mysqli_query($this->db,$query);
			$rows = mysqli_fetch_assoc($result);
			$ini .= "/".$rows['initials']."/";

		}if($sign_tree == "CURRENTHEAD3"){
			$query = "SELECT initials FROM signatory WHERE signatory_tree = 'CURRENTHEAD3'";
			$result = mysqli_query($this->db,$query);
			$rows = mysqli_fetch_assoc($result);
			$ini = $rows['initials'];
			$query = "SELECT initials FROM signatory WHERE signatory_tree = 'CURRENTHEAD4'";
			$result = mysqli_query($this->db,$query);
			$rows = mysqli_fetch_assoc($result);
			$ini .= "/".$rows['initials'];
			$query = "SELECT initials FROM signatory WHERE signatory_tree = 'CURRENTHEAD5'";
			$result = mysqli_query($this->db,$query);
			$rows = mysqli_fetch_assoc($result);
			$ini .= "/".$rows['initials']."/";

		}if($sign_tree == "CURRENTHEAD4"){
			$query = "SELECT initials FROM signatory WHERE signatory_tree = 'CURRENTHEAD4'";
			$result = mysqli_query($this->db,$query);
			$rows = mysqli_fetch_assoc($result);
			$ini = $rows['initials'];
			$query = "SELECT initials FROM signatory WHERE signatory_tree = 'CURRENTHEAD5'";
			$result = mysqli_query($this->db,$query);
			$rows = mysqli_fetch_assoc($result);
			$ini .= "/".$rows['initials']."/";

		}if($sign_tree == "CURRENTHEAD5"){
			$query = "SELECT initials FROM signatory WHERE signatory_tree = 'CURRENTHEAD5'";
			$result = mysqli_query($this->db,$query);
			$rows = mysqli_fetch_assoc($result);
			$ini .= $rows['initials']."/";

		}if($sign_tree == "CURRENTHEAD6" || $_SESSION['f_office'] == "112402-01"){ // region
			$query = "SELECT initials FROM signatory WHERE signatory_tree = 'CURRENTHEAD6'";
			$result = mysqli_query($this->db,$query);
			$rows = mysqli_fetch_assoc($result);
			$ini .= $rows['initials'];

		}if($sign_tree == "CURRENTHEAD7" || $_SESSION['f_office'] == "112402-02"){ // davao 3rd dist
			$query = "SELECT initials FROM signatory WHERE signatory_tree = 'CURRENTHEAD7'";
			$result = mysqli_query($this->db,$query);
			$rows = mysqli_fetch_assoc($result);
			$ini .= $rows['initials'];

		}if($sign_tree == "CURRENTHEAD8" || $_SESSION['f_office'] == "112403-01"){ // davao del sur
			$query = "SELECT initials FROM signatory WHERE signatory_tree = 'CURRENTHEAD8'";
			$result = mysqli_query($this->db,$query);
			$rows = mysqli_fetch_assoc($result);
			$ini .= $rows['initials'];

		}if($sign_tree == "CURRENTHEAD9" || $_SESSION['f_office'] == "112319-01"){ // davao del norte
			$query = "SELECT initials FROM signatory WHERE signatory_tree = 'CURRENTHEAD9'";
			$result = mysqli_query($this->db,$query);
			$rows = mysqli_fetch_assoc($result);
			$ini .= $rows['initials'];

		}if($sign_tree == "CURRENTHEAD10" || $_SESSION['f_office'] == "118201-01"){ // davao de oro
			$query = "SELECT initials FROM signatory WHERE signatory_tree = 'CURRENTHEAD10'";
			$result = mysqli_query($this->db,$query);
			$rows = mysqli_fetch_assoc($result);
			$ini .= $rows['initials'];

		}if($sign_tree == "CURRENTHEAD11" || $_SESSION['f_office'] == "112509-01"){ // davao oriental
			$query = "SELECT initials FROM signatory WHERE signatory_tree = 'CURRENTHEAD12'";
			$result = mysqli_query($this->db,$query);
			$rows = mysqli_fetch_assoc($result);
			$ini .= $rows['initials'];

		}if($sign_tree == "CURRENTHEAD12" || $_SESSION['f_office'] == "118602-01"){ // davao occidental
			$query = "SELECT initials FROM signatory WHERE signatory_tree = 'CURRENTHEAD11'";
			$result = mysqli_query($this->db,$query);
			$rows = mysqli_fetch_assoc($result);
			$ini .= $rows['initials'];

		}if($sign_tree == "CURRENTHEAD13" || $_SESSION['f_office'] == "112402-03"){ // davao spmc
			$query = "SELECT initials FROM signatory WHERE signatory_tree = 'CURRENTHEAD13'";
			$result = mysqli_query($this->db,$query);
			$rows = mysqli_fetch_assoc($result);
			$ini .= $rows['initials'];

		}if($sign_tree == "CURRENTHEAD14" || $_SESSION['f_office'] == "112402-04"){ // davao drmc
			$query = "SELECT initials FROM signatory WHERE signatory_tree = 'CURRENTHEAD14'";
			$result = mysqli_query($this->db,$query);
			$rows = mysqli_fetch_assoc($result);
			$ini .= $rows['initials'];

		}if($_SESSION['f_office'] == "112402-04" || empty($a) || $a == 0){ // special
			$query = "SELECT initials FROM signatory WHERE signatory_tree = 'CURRENTHEAD15'";
			$result = mysqli_query($this->db,$query);
			$rows1 = mysqli_fetch_assoc($result);
			
			$query = "SELECT special_ini FROM signatory WHERE signatory_tree = 'CURRENTHEAD6'";
			$result = mysqli_query($this->db,$query);
			$rows = mysqli_fetch_assoc($result);
			
			if($rows["special_ini"] != 1){
				$ini .= "/".$rows1['initials'];
			}

			
		}
		$sw = $this->getsocialWorkINI($swid);
		$e = $this->getencoderINI($eid);
		$ini .= strtolower("/".$sw."/".$e);
		return $ini;
	}
	

// public function searchImported($val){
// 		$value = mysqli_real_escape_string($this->db,$val); 
		
// 		$sql = "SELECT * FROM client_info
// 		WHERE ((CONCAT
// 		(firstname, ' ',middlename, ' ',lastname)
// 		LIKE '%".$value."%')
// 		OR (CONCAT
// 		(firstname, ' ',lastname, ' ',middlename)
// 		LIKE '%".$value."%')
// 		OR (CONCAT
// 		(middlename, ' ',firstname, ' ',lastname)
// 		 LIKE '%".$value."%')
// 		 OR (CONCAT
// 		(middlename, ' ',lastname, ' ',firstname)
// 		 LIKE '%".$value."%')
// 		 OR (CONCAT
// 		(lastname, ' ',middlename, ' ',firstname)
// 		 LIKE '%".$value."%')
// 		 OR (CONCAT
// 		(lastname, ' ',firstname, ' ',middlename)
// 		 LIKE '%".$value."%') 
// 		 OR (CONCAT
// 		(b_fname, ' ',b_mname, ' ',b_lname)
// 		 LIKE '%".$value."%')
// 		 OR (CONCAT
// 		(b_fname, ' ',b_lname, ' ',b_mname)
// 		 LIKE '%".$value."%')
// 		 OR (CONCAT
// 		(b_mname, ' ',b_fname, ' ',b_lname)
// 		 LIKE '%".$value."%')
// 		 OR (CONCAT
// 		(b_mname, ' ',b_lname, ' ',b_fname)
// 		 LIKE '%".$value."%')
// 		 OR (CONCAT
// 		(b_lname, ' ',b_fname, ' ',b_mname)
// 		 LIKE '%".$value."%')
// 		 OR (CONCAT
// 		(b_lname, ' ',b_mname, ' ',b_fname)
// 		 LIKE '%".$value."%'))";

// 		 $result = mysqli_query($this->db3, $sql);

// 		 if($result){
// 			 return $result;
// 		 }
// 		 else{
// 			 return false;
// 		 }
// 	}
	// public function createosapdatas() {
	// 	$query = "SELECT DISTINCT t.bene_id,c.lastname,c.middlename,c.firstname,c.extraname, b.b_fname,b.b_lname,b.b_mname,DATEDIFF(now(),DATE(t.date_accomplished)) as days,
	// 	date(t.date_accomplished) as date_accomplished,a.mode,a.type from tbl_transaction t
	// 	LEFT OUTER JOIN client_data c on c.client_id = t.client_id 
	// 	LEFT OUTER JOIN beneficiary_data b on b.bene_id = t.bene_id 
	// 	INNER JOIN assistance a on a.trans_id = t.trans_id 
	// 	WHERE status_client = 'Done' and DATEDIFF(now(),DATE(t.date_accomplished)) < 90 GROUP BY t.client_id";
		
	// }
}


?>