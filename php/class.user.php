<?php
	session_start();
	include ("db_config.php");
	include ("db_config2.php");


	class User{

		public $db;
		public $db2;
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
    
			

			public function check_login($user, $pass){
				$username = mysqli_real_escape_string($this->db2,$user); 
				$password = mysqli_real_escape_string($this->db2,$pass); 
				
				$sqlquery="SELECT * from employee_info WHERE empuser='{$username}' and emppass='{$password}'";
		
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
				$query = "SELECT i.empfname, i.empmname, i.emplname, i.empext, i.empsex, i.empstatus, i.empnum, e.empid, c.position, c.status, c.office_id, e.emp_position, c.sw_license_no, c.sw_license_expiry  
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

			public function optionoffice(){
				$query = "SELECT * FROM field_office";
				$result = mysqli_query($this->db,$query);
				$rows = mysqli_num_rows($result);
				if($rows > 0){
					return $result;
				}else{
					return false;
				}
			}

			public function addOffice($officename, $officeacronym, $descrip, $m){
				$municipal = explode("/", $m);
				
				$query = "SELECT LEFT('{$municipal['1']}', 6) as code";
				$result = mysqli_query($this->db,$query);
				$row = mysqli_fetch_assoc($result);
				
				$query = "SELECT * FROM field_office WHERE office_id LIKE '%".$row['code']."%';";
				$result = mysqli_query($this->db,$query);
				$num_row = mysqli_num_rows($result);
				
				if($num_row > 0){
					$check = "SELECT * FROM field_office WHERE office_name = '{$officename}' OR office_accronym = '{$officeacronym}'";
					$result = mysqli_query($this->db,$check);
					$rows = mysqli_num_rows($result);
					if($rows > 0){
						return "exists";
					}
				}

				$num_row = $num_row + 1;

				$num = sprintf("%02d", $num_row);
				$office_id = $row['code']."-".$num;

				$query = "INSERT INTO field_office(office_id, office_name, office_accronym, description) VALUES
						('{$office_id}', '{$officename}', '{$officeacronym}', '{$descrip}')";
				$result = mysqli_query($this->db,$query);
				
				if($result) {
					return "success";
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

				if($num_row > 0){
					$check = "SELECT * FROM field_office WHERE office_name = '{$officename}' AND office_accronym = '{$officeacronym}'";
					$result = mysqli_query($this->db,$check);
					$rows = mysqli_num_rows($result);
					if($rows > 0){
						return "exists";
					}
				}

				$num_row = $num_row + 1;

				$num = sprintf("%02d", $num_row);
				$office_id = $row['code']."-".$num;

				$query = "SELECT LEFT('{$fo_id}', 6) as code";
				$result = mysqli_query($this->db,$query);
				$row1 = mysqli_fetch_assoc($result);
				
				$query = "UPDATE field_office SET ";
				if($row1['code'] != $row['code']){
					$query .= "office_id = '{$office_id}', ";
				}
				$query .= "office_name = '{$officename}', description = '{$descrip}', office_accronym = '{$officeacronym}'  WHERE office_id = '{$fo_id}'"; 
				$result = mysqli_query($this->db,$query);
				
				if($result) {
					return "success";
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

			public function getallEmployee(){
				$query = "SELECT i.empfname, i.empmname, i.emplname, i.empext, i.empsex, i.empstatus, i.empnum, e.empid, c.position, c.status, c.office_id 
				FROM tbl_employment e
				LEFT JOIN employee_info i using (empnum)
				LEFT JOIN cpms_account c using (empid);";
				$result = mysqli_query($this->db2, $query);
				
				return $result;
			}
			public function getEmpData($id){
				$query = "SELECT i.empfname, i.empmname, i.emplname, i.empext, i.empsex, i.empstatus, i.empnum, e.empid, c.position, c.status, c.office_id, i.empuser, i.emppass
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
				$query = "SELECT office_accronym FROM field_office WHERE office_id = '{$office}'";
				$result = mysqli_query($this->db, $query);
				$rowoffice = mysqli_fetch_assoc($result);

				$query = "SELECT * FROM cpms_account WHERE empid = '{$empid}'";
				$result = mysqli_query($this->db2, $query);
				$row = mysqli_num_rows($result);

				if($row <= 0){
					$query = "INSERT INTO cpms_account(empid, position, status, office, office_id) VALUES 
							('{$id}','{$position}','{$status}', '{$rowoffice['office_accronym']}','{$office}')";
					$result = mysqli_query($this->db2, $query);
				}else{
					$query = "UPDATE cpms_account SET empid = '{$id}', position = '{$position}', status = '{$status}', office_id = '{$office}', office = '{$rowoffice['office_accronym']}' WHERE empid = '{$empid}'";
					$result = mysqli_query($this->db2, $query);
				}
				
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

					$query = "INSERT INTO cpms_account(empid, position, status, office, office_id) VALUES 
							('{$id}','{$position}','Activated', '-', '{$office}')";
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
		
			public function user_logout() {
				$_SESSION['login'] = FALSE;
				session_unset();
				session_destroy();  
				
				return true;
			}
		
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

			public function updatesw($id, $license, $expiry){
				$query = "UPDATE cpms_account SET sw_license_no = '{$license}', sw_license_expiry = '{$expiry}' WHERE empid = '{$id}';";

				$result = mysqli_multi_query($this->db2, $query);
				if($result){
					return true;
				}
				else {
					return false;
				}
			}
		
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
		
			public function updateProvider($addresseename, $addresseeposition, $companyid, $addresseetomention, $companyname, $companyaddress){
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
				
				$query = "SELECT * FROM provider WHERE addressee_name = '{$addresseename}' AND addressee_position = '{$addresseeposition}' AND '{$companyname}' AND company_address = '{$companyaddress}'";
				$result = mysqli_query($this->db,$query);
				$rows = mysqli_num_rows($result);
				if($rows > 0){
					return "exists";
				}

				$query = "UPDATE provider SET addressee_name='{$addresseename}', addressee_position='{$addresseeposition}', to_mention='{$addresseetomention}', company_name='{$companyname}', company_address='{$companyaddress}', action_executed_by='{$fullname}' WHERE company_id = {$companyid};";
				
				$result = mysqli_query($this->db,$query);
				if($result){
					return "success";
				}
				else {
					return false;
				}
			}
		
			public function addCompany($addressee_name, $addressee_position, $addresseetomention, $company_name, $company_address){
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

				$query = "SELECT * FROM provider WHERE company_name = '{$company_name}' AND company_address = '{$company_address}'";
				$result = mysqli_query($this->db,$query);
				$rows = mysqli_num_rows($result);
				if($rows > 0){
					return "exists";
				}

				$query = "INSERT INTO provider(addressee_name, addressee_position, company_name, to_mention, company_address, action_executed_by) 
				VALUES ('{$addressee_name}','{$addressee_position}','{$company_name}','{$addresseetomention}','{$company_address}','{$fullname}');";

				$result = mysqli_query($this->db,$query);
				if($result){
					return "success";
				}
				else{					
					return false;
				}
			}
		
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
		
			public function get_signatory_to_admin_table(){
				$query = "SELECT * FROM signatory;";
				$result = mysqli_query($this->db,$query);
				
				if(mysqli_num_rows($result) > 0) {
					return $result;
				}
				else{
					return false;
				}
			}
			
			public function show_signatory_data($signatory_id){
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
		
			public function updatesignatory($signatory_title, $signatory_firstname, $signatory_lastname, $signatory_middleI, $signatory_initials, $signatory_position, $signatory_options_GIS, $signatory_options_GL, $signatory_tree, $special_sign, $signatory_id){
				$query = "UPDATE signatory SET name_title='{$signatory_title}', first_name='{$signatory_firstname}', last_name='{$signatory_lastname}', middle_I='{$signatory_middleI}', initials='{$signatory_initials}', position='{$signatory_position}', ";
				$query .= "option_GIS='{$signatory_options_GIS}', option_GL='{$signatory_options_GL}', signatory_tree='{$signatory_tree}', special_ini='{$special_sign}' WHERE signatory_id = '{$signatory_id}';";
				$result = mysqli_query($this->db,$query);
				if($result){
					return true;
				}
				else {
					return false;
				}
			}
		
			public function addsignatory($signatory_title, $signatory_firstname, $signatory_lastname, $signatory_middleI, $signatory_initials, $signatory_position, $signatory_options_GIS, $signatory_options_GL, $signatory_tree, $special_sign){
				$query = "SELECT * FROM signatory WHERE first_name = '{$signatory_firstname}' AND last_name = '{$signatory_lastname}' AND middle_I = '{$signatory_middleI}'";
				$result = mysqli_query($this->db,$query);
				$rows = mysqli_num_rows($result);
				if($rows > 0){
					return "exists";
				}
				
				$query = "INSERT INTO signatory (name_title, first_name, last_name, middle_I, initials, position, option_GIS, option_GL, signatory_tree, special_ini) VALUES ('{$signatory_title}', '{$signatory_firstname}',"; 
				$query .= "'{$signatory_lastname}', '{$signatory_middleI}', '{$signatory_initials}', '{$signatory_position}', '{$signatory_options_GIS}', '{$signatory_options_GL}', '{$signatory_tree}', '{$special_sign}');";
				$result = mysqli_query($this->db,$query);

				if($result){
					return "success";
				}
				else{
					return false;
				}
			}
		
			public function get_psgc_to_admin_table(){
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
			
			public function optionregion(){
				$query = "SELECT * FROM region ORDER BY r_name ASC;";
				$result = mysqli_query($this->db,$query);
				$rows = mysqli_num_rows($result);
				if($rows > 0){
					return $result;
				}else{
					return false;
				}
			}
			
			public function optionprovince($region){
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
			
			public function optionmunicipality($province){
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
			
			public function optionbarangay($municipality){
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
		
		

			public function addPSGCtable($addcode, $addname, $setcategory, $district_name){
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
		
			public function deleteDescription($setPSGC){
				$query = "DELETE FROM psgc WHERE psgc_code = '{$setPSGC}';";
				$result = mysqli_query($this->db,$query);
				if($result){
					return true;
				} else {
					return false;
				}
			}
			
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

			public function addassessment($opt, $prob, $ass){
				
				$check_query = "SELECT * FROM gisassessment WHERE ass_opt = '{$opt}'";
				$check_result = mysqli_query($this->db, $check_query);
				if(mysqli_num_rows($check_result) > 0){
					return "exists";
				}
				
				$query = "INSERT INTO gisassessment (ass_opt, prob_pres, ass_socwork) VALUES ('{$opt}', '{$prob}', '{$ass}');";
				
				$result = mysqli_query($this->db,$query);
				if($result){
					
					return "success";
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
			
			public function updateAssessment($newopt, $prob, $ass, $opt){
				$check_query = "SELECT * FROM gisassessment WHERE ass_opt = '{$newopt}' AND ass_opt != '{$opt}'";
				$check_result = mysqli_query($this->db, $check_query);
				if(mysqli_num_rows($check_result) > 0){
					return "exists";
				}
				$query = "UPDATE gisassessment SET ass_opt='{$newopt}', prob_pres='{$prob}', ass_socwork='{$ass}' WHERE ass_opt = '{$opt}';";
				$result = mysqli_query($this->db,$query);
				if($result){
					return true;
				}
				else {
					return false;
				}
			}

			public function addFundS($funds,$desc) {
				$query = "SELECT * FROM tbl_fundsource WHERE fundsource = '{$funds}';";
				$result = mysqli_query($this->db, $query);
				if(mysqli_num_rows($result)>0){
					return "exists";
				}else{
					$query = "INSERT INTO tbl_fundsource(fundsource, fs_description) VALUES ('{$funds}', '{$desc}');";
					$result = mysqli_query($this->db, $query);
					if($result){
						return "success";
					}else{
						return false;
					}
				}
			}
			
			public function get_fundsource_to_admin_table() {
				$query = "SELECT * FROM tbl_fundsource";
				
				$result = mysqli_query($this->db, $query);
				
				if($result){
					return $result;
				}else{
					return false;
				}
			}

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
				$query = "SELECT * FROM tbl_fundsource WHERE id = '{$id}';";
				$result = mysqli_query($this->db, $query);
				$rows = mysqli_fetch_assoc($result);
				if(!$rows){
					return false;
				}else{
					$check_query = "SELECT * FROM tbl_fundsource WHERE fundsource = '{$funds}' AND id != '{$id}';";
					$check_result = mysqli_query($this->db, $check_query);
					if(mysqli_num_rows($check_result) > 0){
						return "exists";
					}else{
						if($rows['fundsource'] == $funds && $rows['fs_description'] == $desc){
							return "nochange";
						}else{
							$query = "UPDATE tbl_fundsource SET fundsource = '{$funds}', fs_description = '{$desc}' WHERE id = '{$id}';";

							$result = mysqli_query($this->db, $query);
							if($result){
								return "success";
							}else{
								return false;
							}
						}
					}
				}
			}

			public function getClientAndEmp($date1, $date2) {
				$query = "SELECT tbl_transaction.trans_id, tbl_transaction.date_accomplished, tbl_transaction.encoded_encoder, tbl_transaction.encoded_socialWork,
						client_data.firstname, client_data.middlename, client_data.lastname, client_data.extraname, beneficiary_data.b_fname, 
						beneficiary_data.b_mname, beneficiary_data.b_lname, beneficiary_data.b_exname FROM tbl_transaction
						LEFT JOIN client_data using (client_id)
						LEFT JOIN beneficiary_data using (bene_id) WHERE (date_accomplished BETWEEN '{$date1} 00:01:01' AND '{$date2} 23:59:59');";

				$result = mysqli_query($this->db, $query);
				return $result;
			}

			public function getClientAndEmpNum($date1, $date2) {
				$query = "SELECT tbl_transaction.trans_id, tbl_transaction.date_accomplished, tbl_transaction.encoded_encoder, tbl_transaction.encoded_socialWork,
						client_data.firstname, client_data.middlename, client_data.lastname, client_data.extraname, beneficiary_data.b_fname, 
						beneficiary_data.b_mname, beneficiary_data.b_lname, beneficiary_data.b_exname FROM tbl_transaction
						LEFT JOIN client_data using (client_id)
						LEFT JOIN beneficiary_data using (bene_id) WHERE (date_accomplished BETWEEN '{$date1} 00:01:01' AND '{$date2} 23:59:59');";

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
						WHERE (encoded_encoder = '{$emp}' OR encoded_socialWork = '{$emp}') AND (date_accomplished BETWEEN '{$date1} 00:01:01' AND '{$date2} 23:59:59');";

				$result = mysqli_query($this->db, $query);
				return $result;
			}
			public function getClientAndEmpSetNum($emp, $date1, $date2) {
				$query = "SELECT tbl_transaction.trans_id, tbl_transaction.date_accomplished, tbl_transaction.encoded_encoder, tbl_transaction.encoded_socialWork,
						client_data.firstname, client_data.middlename, client_data.lastname, client_data.extraname, beneficiary_data.b_fname, 
						beneficiary_data.b_mname, beneficiary_data.b_lname, beneficiary_data.b_exname FROM tbl_transaction
						LEFT JOIN client_data using (client_id)
						LEFT JOIN beneficiary_data using (bene_id)
						WHERE (encoded_encoder = '{$emp}' OR encoded_socialWork = '{$emp}') AND (date_accomplished BETWEEN '{$date1} 00:01:01' AND '{$date2} 23:59:59');";
				
				$result = mysqli_query($this->db, $query);
				$row = mysqli_num_rows($result);
				return $row;
			}

			public function encodersummarylist() {
				$query = "SELECT distinct encoded_encoder FROM tbl_transaction WHERE status_client = 'Done';";
				$result = mysqli_query($this->db, $query);
				if ($result) {
					return $result;
				}else{
					return false;
				}
			}

			public function swsummarylist() {
				$query = "SELECT distinct encoded_socialWork FROM tbl_transaction WHERE status_client = 'Done';";
				$result = mysqli_query($this->db, $query);
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
				if ($result) {
					return $result;
				}else{
					return false;
				}
			}
			
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
		
			public function getsocialWork($id){
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

			public function getupdateby($id){
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

			public function getEncoder($id){
				
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
				$date = date("Y-m-t", strtotime($d));
				$dateafterfivedays = date('Y-m-d', strtotime($date. ' + 5 days')); 
				$presentdate = date("Y-m-d");
				
				if($dateafterfivedays >= $presentdate){
					return 2;
				}else{
					return 1;
				}
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
		
			public function insertClient($f, $m, $l, $e, $sex, $bday, $age, $occupation, $salary, $category, $pantawid, $cstatus,$contact,
			$r, $p, $c, $brgy, $d, $street){ 
				
				$datenow = date("Y-m-d H:i:s"); //serve as date_entered
				$relation = "Self";
				$encoder = $_SESSION['userId'];
				$office_id = $_SESSION['f_office'];
				$status_client = "Pending";
				$note = "yes";

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
				$query = "INSERT INTO tbl_transaction (trans_id, client_id, relation, pantawid_bene, type_of_client, date_entered, encoded_encoder, note, status_client, clientonly) VALUES 
				('{$newtransid}','{$newclientid}', '{$relation}', '{$pantawid}', 'New', '{$datenow}', '{$encoder}', '{$note}','{$status_client}',1)";
				$result = mysqli_query($this->db,$query);
				
				if($result){
					return $newtransid;
				}
				else{
					return false;
				}
				
			}

		public function insertClientWB($f, $m, $l, $e, $sex, $bday, $occupation, $salary, $category, $pantawid,
		$cstatus, $contact, $r, $p, $c, $brgy, $d, $street, $relationship, $bf, $bm, $bl, $be, $b_bday, 
		$b_sex, $b_cstatus, $b_contact, $b_occupation, $b_salary, $b_category, $b_region, $b_province, $b_city, $b_district, $b_barangay, $b_street){ 
			$datenow = date("Y-m-d H:i:s"); //serve as date_entered
			$encoder = $_SESSION['userId'];
			$status_client = "Pending";
			$office_id = $_SESSION['f_office'];
			$note = "yes";

			$now = DateTime::createFromFormat('U.u', number_format(microtime(true), 6, '.', ''));
			$datetoid = date_format($now, 'YmdHisu');
			$newtransid = $office_id.'-'.$datetoid;
			
			$query = "INSERT INTO `client_data`(`lastname`, `firstname`, `middlename`, `extraname`, `sex`, 
			`civil_status`, `date_birth`, `occupation`, `salary`, `contact`, `category`, 
			`client_region`, `client_province`, `client_municipality`, 
			`client_barangay`, `client_street`, `client_district`, date_inserted) VALUES ('{$l}','{$f}','{$m}',
			'{$e}','{$sex}','{$cstatus}','{$bday}','{$occupation}','{$salary}','{$contact}','{$category}',
			'{$r}','{$p}','{$c}','{$brgy}','{$street}','{$d}', '{$datenow}');";
		 	$result = mysqli_query($this->db,$query);
			
			$query = "SELECT auto_increment_4_id FROM client_data WHERE lastname = '{$l}' AND firstname = '{$f}' AND middlename = '{$m}' AND date_inserted = '{$datenow}';";
			$result = mysqli_query($this->db,$query);
			$row = mysqli_fetch_assoc($result);
			
			$newclientid = "C-".$row['auto_increment_4_id'];
			
			$query = "UPDATE client_data SET client_id = '{$newclientid}' WHERE auto_increment_4_id = '{$row['auto_increment_4_id']}';";
			$result = mysqli_query($this->db,$query);

			$query = "INSERT INTO `beneficiary_data`(`b_fname`, `b_mname`, `b_lname`, `b_exname`, 
			`b_civilStatus`, `b_contact`, `b_bday`, `b_sex`, `b_occupation`, `b_salary`, `b_category`, `b_region`, 
			`b_province`, `b_municipality`, `b_barangay`, `b_district`, `b_street`, b_date_inserted) VALUES ('{$bf}','{$bm}',
			'{$bl}','{$be}','{$b_cstatus}','{$b_contact}','{$b_bday}','{$b_sex}','{$b_occupation}','{$b_salary}','{$b_category}',
			'{$b_region}','{$b_province}','{$b_city}','{$b_barangay}','{$b_district}','{$b_street}', '{$datenow}');";
			$result = mysqli_query($this->db,$query);
			
			$query = "SELECT auto_increment_id_bene FROM beneficiary_data WHERE b_lname = '{$bl}' AND b_fname = '{$bf}' AND b_mname = '{$bm}' AND b_date_inserted = '{$datenow}';";
			$result = mysqli_query($this->db,$query);
			$row = mysqli_fetch_assoc($result);

			$newbeneid = "B-".$row['auto_increment_id_bene'];
			
			$query = "UPDATE beneficiary_data SET bene_id = '{$newbeneid}' WHERE auto_increment_id_bene = '{$row['auto_increment_id_bene']}';";
			$result = mysqli_query($this->db,$query);
			
			$query = "INSERT INTO tbl_transaction (trans_id, client_id, bene_id, relation, pantawid_bene, type_of_client, date_entered, encoded_encoder, note, status_client, clientonly, clientsamebene, benetoclient) VALUES 
			('{$newtransid}', '{$newclientid}', '{$newbeneid}', '{$relationship}', '{$pantawid}', 'New', '{$datenow}', '{$encoder}', '{$note}','{$status_client}',1,1,1);";
			$result = mysqli_query($this->db,$query);

			if($result){
				return $newtransid;
			}
			else{
				return false;
			}
		}
		
		public function insertClientPassed($transid, $f, $m, $l, $e, $sex, $bday, $occupation, $salary, $pantawid, $category, 
		$cstatus, $contact, $r, $p, $c, $brgy, $d, $street, $note, $clientonly, $clientbene){

			$datenow = date("Y-m-d H:i:s"); //serve as date_entered
			$relation = "Self";
			$encoder = $_SESSION['userId'];
			$office_id = $_SESSION['f_office'];
			$status_client = "Pending";
			if(empty($note)){
				$note = "yes";
			}

			$now = DateTime::createFromFormat('U.u', number_format(microtime(true), 6, '.', ''));
			$datetoid = date_format($now, 'YmdHisu');
			$newtransid = $office_id.'-'.$datetoid;

			$query = "SELECT * FROM tbl_transaction WHERE trans_id = '{$transid}'";
			$result = mysqli_query($this->db,$query);
			$row = mysqli_fetch_assoc($result);
			
			$client_id = $row['client_id'];

			
			
			$query = "INSERT INTO `client_data`(`lastname`, `firstname`, `middlename`, `extraname`, `sex`, 
			`civil_status`, `date_birth`, `occupation`, `salary`, `contact`, `category`, 
			`client_region`, `client_province`, `client_municipality`, 
			`client_barangay`, `client_street`, `client_district`, date_inserted) VALUES ('{$l}','{$f}','{$m}',
			'{$e}','{$sex}','{$cstatus}','{$bday}','{$occupation}','{$salary}','{$contact}','{$category}',
			'{$r}','{$p}','{$c}','{$brgy}','{$street}','{$d}', '{$datenow}');";
			$result = mysqli_query($this->db,$query);

			$query = "SELECT auto_increment_4_id  FROM client_data WHERE lastname = '{$l}' AND firstname = '{$f}' AND middlename = '{$m}' AND
			extraname = '{$e}' AND date_birth = '{$bday}' AND date_inserted = '{$datenow}'";
			$result = mysqli_query($this->db,$query);
			$row1 = mysqli_fetch_assoc($result);

			$client_id = 'C-'.$row1['auto_increment_4_id'];

			$query = "UPDATE client_data SET client_id = '{$client_id}' WHERE auto_increment_4_id = '{$row1['auto_increment_4_id']}'";
			$result = mysqli_query($this->db,$query);
			$query = "INSERT INTO tbl_transaction (trans_id, client_id, relation, pantawid_bene, type_of_client, date_entered, encoded_encoder, note, status_client, clientonly) 
			VALUES ('{$newtransid}', '{$client_id}', '{$relation}', '{$pantawid}', 'Returning', '{$datenow}', '{$encoder}', '{$note}','{$status_client}', 1)";
			$result = mysqli_query($this->db,$query);

			if($clientonly > 0){
				$query = "UPDATE tbl_transaction SET clientonly = 0 WHERE trans_id = '{$transid}'";
			}elseif($clientbene > 0){
				$query = "UPDATE tbl_transaction SET benetoclient = 0 WHERE trans_id = '{$transid}'";
			}
			$result = mysqli_query($this->db,$query);

			if($row){
				return $newtransid;
			}
			else{
				return false;
			}
			
		}
		
		public function insertClientWBPassed($transid, $f, $m, $l, $e, $sex, $bday, 
		$occupation, $salary, $pantawid, $category, $cstatus, $contact, $r, $p, $c, $brgy, $d, $street, 
		$relationship, $bf, $bm, $bl, $be, $b_bday, $b_sex, $b_cstatus, $b_contact, $b_category,
		 $b_region, $b_province, $b_city, $b_district, $b_barangay, $b_street, $note, $clientonly, $samebene, $clientbene){
			$datenow = date("Y-m-d H:i:s"); //serve as date_entered
			$encoder = $_SESSION['userId'];
			$office_id = $_SESSION['f_office'];
			$status_client = "Pending";
			if(empty($note)){
				$note = "yes";
			}

			$now = DateTime::createFromFormat('U.u', number_format(microtime(true), 6, '.', ''));
			$datetoid = date_format($now, 'YmdHisu');
			$newtransid = $office_id.'-'.$datetoid;

			$query = "SELECT client_id, bene_id FROM tbl_transaction WHERE trans_id = '{$transid}'";
			$result = mysqli_query($this->db,$query);
			$row = mysqli_fetch_assoc($result);

			$client_id = $row['client_id'];
			$bene_id = $row['bene_id'];

			$query = "INSERT INTO `client_data`(`lastname`, `firstname`, `middlename`, `extraname`, `sex`, 
			`civil_status`, `date_birth`, `occupation`, `salary`, `contact`, `category`, 
			`client_region`, `client_province`, `client_municipality`, 
			`client_barangay`, `client_street`, `client_district`, date_inserted) VALUES ('{$l}','{$f}','{$m}',
			'{$e}','{$sex}','{$cstatus}','{$bday}','{$occupation}','{$salary}','{$contact}','{$category}',
			'{$r}','{$p}','{$c}','{$brgy}','{$street}','{$d}', '{$datenow}');";
			$result = mysqli_query($this->db,$query);

			$query = "SELECT auto_increment_4_id  FROM client_data WHERE lastname = '{$l}' AND firstname = '{$f}' AND middlename = '{$m}' AND
			extraname = '{$e}' AND date_birth = '{$bday}' AND date_inserted = '{$datenow}'";
			$result = mysqli_query($this->db,$query);
			$row1 = mysqli_fetch_assoc($result);

			$client_id = 'C-'.$row1['auto_increment_4_id'];

			$query = "UPDATE client_data SET client_id = '{$client_id}' WHERE auto_increment_4_id = '{$row1['auto_increment_4_id']}'";
			$result = mysqli_query($this->db,$query);			
				$query = "INSERT INTO `beneficiary_data`(`b_fname`, `b_mname`, `b_lname`, `b_exname`, 
				`b_civilStatus`, `b_contact`, `b_bday`, `b_sex`, `b_category`, `b_region`, 
				`b_province`, `b_municipality`, `b_barangay`, `b_district`, `b_street`, b_date_inserted) VALUES ('{$bf}','{$bm}',
				'{$bl}','{$be}','{$b_cstatus}','{$b_contact}','{$b_bday}','{$b_sex}','{$b_category}',
				'{$b_region}','{$b_province}','{$b_city}','{$b_barangay}','{$b_district}','{$b_street}', '{$datenow}')";
				$result = mysqli_query($this->db,$query);
				
				$query = "SELECT auto_increment_id_bene FROM beneficiary_data WHERE b_lname = '{$bl}' AND b_fname = '{$bf}' AND b_mname = '{$bm}' AND b_date_inserted = '{$datenow}'";
				$result = mysqli_query($this->db,$query);
				$row = mysqli_fetch_assoc($result);

				$bene_id = "B-".$row['auto_increment_id_bene'];
				
				$query = "UPDATE beneficiary_data SET bene_id = '{$bene_id}' WHERE auto_increment_id_bene = '{$row['auto_increment_id_bene']}'";
				$result = mysqli_query($this->db,$query);
			

			$query = "INSERT INTO tbl_transaction (trans_id, client_id, bene_id, relation, pantawid_bene, type_of_client, date_entered, encoded_encoder, note, status_client, clientonly, clientsamebene, benetoclient) 
			VALUES ('{$newtransid}', '{$client_id}', '{$bene_id}', '{$relationship}', '{$pantawid}', 'Returning', '{$datenow}', '{$encoder}', '{$note}','{$status_client}', 1, 1, 1)";
			$result = mysqli_query($this->db,$query);
			
			if($clientonly > 0){
				$query = "UPDATE tbl_transaction SET clientonly = 0 WHERE trans_id = '{$transid}'";
			}elseif($samebene > 0){
				$query = "UPDATE tbl_transaction SET clientsamebene = 0 WHERE trans_id = '{$transid}'";
			}elseif($clientbene > 0){
				$query = "UPDATE tbl_transaction SET benetoclient = 0 WHERE trans_id = '{$transid}'";
			}
			$result = mysqli_query($this->db,$query);
			if($result){
				return $newtransid;
			}
			else{
				return false;
			}
		}
		
		public function getAge(?string $date): ?int {
			if ($date === null || trim($date) === '') {
				return null;
			}
			
			try {
				$birthDate = new DateTime($date);
				$today = new DateTime('now');
				
				return $today->diff($birthDate)->y;
			} catch (Exception $e) {
				return null;
			}
		}

		public function calculate_age_by_date_accomplished(?string $bday, ?string $date_accomplished): ?int {
			if ($bday === null || $date_accomplished === null) {
				return null;
			}
			
			try {
				$birthDate = new DateTime($bday);
				$dateAccomplished = new DateTime($date_accomplished);
				
				return $dateAccomplished->diff($birthDate)->y;
			} catch (Exception $e) {
				return null;
			}
		}
		
		public function show_data_socialwork(){
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

		
		public function clientData($id){
			$query = "SELECT client_data.*, beneficiary_data.*, tbl_transaction.* FROM tbl_transaction  
			LEFT JOIN client_data USING (client_id)
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

		public function insertGIS($empid, $trans_id, $csubcat, $id, $familyData, $s1, $s2, $s3, $s4, $s5, $s6, $program, $rl1, $rl2, $rl3, $ref_name,
									$type1, $pur1, $a1, $m1, $f1, $type2, $pur2, $a2, $m2, $f2, $mode_ad, $num, $gis_opt, $prob, $ass, $signatoryGIS,
									$fs1, $fs2, $fs3, $fs4, $fs5, $fs6, $fs7, $fs8, $fs9, $fs10, $fs11, $fs12, $targets, $subcat, $c_disability, $others_subcat, $if_medical, $if_burial, $financial, $material,
									$docu_otherinfo, $otherProgram, $belowMonthly, $diagnosis_cause_of_death, $severity, $crisis, $crisis1, $support, $external, $selfhelp, $vulnerability,
									$SOI_wage, $SOI_profit, $SOI_domesticsource, $SOI_abroad, $SOI_governmenttransfer, $SOI_pension, $SOI_otherincome){
										
			if(strtolower($mode_ad) == "walk-in"){
				$rl1 = "";
				$rl2 = "";
				$rl3 = "";
			}
			$query = "SELECT client_id FROM tbl_transaction WHERE trans_id = '{$trans_id}';";
			$result = mysqli_query($this->db, $query);
			$data = mysqli_fetch_assoc($result);


			$query = "UPDATE client_data SET subCategory = '{$csubcat}' WHERE client_id = '{$data['client_id']}';";
			$result = mysqli_query($this->db, $query);

			if (!empty($familyData)) {
				$query = "INSERT INTO family (trans_id, name, relation_bene, age, occupation, salary) VALUES ";

				$family_values = [];
				foreach ($familyData as $member) {
					$membername = strtoupper($member['name']);
					$memberrelation = strtoupper($member['relation_bene']);
					$memberage = $member['age'];
					$memberoccupation = strtoupper($member['occupation']);
					$membersalary = $member['salary'];

					$family_values[] = "('{$trans_id}', '{$membername}', '{$memberrelation}', '{$memberage}', '{$memberoccupation}', '{$membersalary}')";
				}

				$query .= implode(', ', $family_values);
				$query .= ";";
			}
			
						
			$query .= "INSERT INTO service (trans_id, service1, service2, service3, service4, service5, service6, ref_name, refer1, refer2, refer3) 
						VALUES ('{$trans_id}','{$s1}','{$s2}','{$s3}', '{$s4}','{$s5}', '{$s6}','{$ref_name}', '{$rl1}','{$rl2}', '{$rl3}');"; 	
			if(!empty($fs1)){
				$query .= "INSERT INTO tbl_coe_fund (trans_id, fundsource)	VALUES 
						('{$trans_id}', '{$fs1}')";
					if(!empty($fs2)){$query .= ",('{$trans_id}', '{$fs2}')";}
					if(!empty($fs3)){$query .= ",('{$trans_id}', '{$fs3}')";}
					if(!empty($fs4)){$query .= ",('{$trans_id}', '{$fs4}')";}
					if(!empty($fs5)){$query .= ",('{$trans_id}', '{$fs5}')";}
					if(!empty($fs6)){$query .= ",('{$trans_id}', '{$fs6}')";}
					if(!empty($fs7)){$query .= ",('{$trans_id}', '{$fs7}')";}
					if(!empty($fs8)){$query .= ",('{$trans_id}', '{$fs8}')";}
					if(!empty($fs9)){$query .= ",('{$trans_id}', '{$fs9}')";}
					if(!empty($fs10)){$query .= ",('{$trans_id}', '{$fs10}')";}
					if(!empty($fs11)){$query .= ",('{$trans_id}', '{$fs11}')";}
					if(!empty($fs12)){$query .= ",('{$trans_id}', '{$fs12}')";}
				$query .= ";";
			}else{
				$query .= "INSERT INTO tbl_coe_fund (trans_id, fundsource, fs_amount)	VALUES 
					('{$trans_id}', '{$f1}', '{$a1}');";
			}
			$query .= "INSERT INTO assistance (trans_id, type, if_medical, if_burial, cause_of_death, financial, material, amount, mode, fund, purpose, type_description) 
					VALUES ('{$trans_id}', '{$type1}', '{$if_medical}', '{$if_burial}', '{$diagnosis_cause_of_death}', '{$financial}', '{$material}', '{$a1}', '{$m1}', '', '{$pur1}', 'Type1')";
					if($type2 !=""){
						$query .= " ,('{$trans_id}', '{$type2}', '{$a2}', '{$m2}', '{$f2}', '{$pur2}', 'Type2')";
					}
			$query .= ";";
			
			$query .= "INSERT INTO assessment (trans_id, target_sector, type_of_disability, subcat_ass, below_monthly_income, others_subcat, gis_option, problem, soc_ass, mode_admission, client_num) 
			VALUES ('{$trans_id}', '{$targets}', '{$c_disability}', '{$subcat}', '{$belowMonthly}', '{$others_subcat}', '{$gis_opt}','{$prob}', '{$ass}', '{$mode_ad}', {$num});"; 
			
			$query .= "INSERT INTO other_client_information (trans_id, otherClientInformation, crisisSeverityQuestion1, crisisSeverityQuestion2, crisisSeverityQuestion3, supportSystemAvailability, externalResources, selfHelp, vulnerability_riskFactor) 
			VALUES ('{$trans_id}', '{$docu_otherinfo}', '{$severity}', '{$crisis}', '{$crisis1}', '{$support}', '{$external}', '{$selfhelp}', '{$vulnerability}');"; 

			$query .= "INSERT INTO source_of_income (trans_id, wage, profit, domestic_source, abroad, government_transfer, pension, other_income) 
			VALUES ('{$trans_id}', '{$SOI_wage}', '{$SOI_profit}', '{$SOI_domesticsource}', '{$SOI_abroad}', '{$SOI_governmenttransfer}', '{$SOI_pension}', '{$SOI_otherincome}');"; 

			$sign_id = $signatoryGIS;
			$query .= "UPDATE tbl_transaction SET signatory_id = '{$sign_id}', program_type = '{$program}'";
			if($m1 == "GL"){ 
				$amountcon = str_replace(",","", $a1);
				if($amountcon < 50001){ $query .= ", signatory_GL = '{$sign_id}'"; }
			}
			if($m2 == "GL"){ 
				$amountcon2 = str_replace(",","", $a2);
				if($amountcon2 < 50001){ $query .= ", signatory_GL = '{$sign_id}'"; }
			} 
			if(strtolower($program) == "other"){ 
				$query .= ", other_program = '{$otherProgram}'"; 
			} 
			$query .= " WHERE trans_id = '{$trans_id}';";
			$result = mysqli_multi_query($this->db, $query);
		
			if($result){
				echo "<script>alert('Assessment Successfully Saved!');</script>";
				echo "<meta http-equiv='refresh' content='0'>";
			}else{
				echo "<script>alert('Something Went Wrong!');</script>";
				echo "<meta http-equiv='refresh' content='0'>";
			}
			
		}
		
		public function getsignatureid($signature){
			$signatory = explode('-', $signature);
			$signname = explode(' ', $signatory[0]);
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
			while($row = mysqli_fetch_assoc($result)){
				$num++;
				$data[$num] = $row;
			}
			if(empty($data)){
				return "";
			}else{
				return $data;
			}
			
		}
		public function getfundsourceclient($id) {
			$query = "SELECT program_type, date_accomplished, other_program FROM tbl_transaction WHERE trans_id = '{$id}';";
			$result = mysqli_query($this->db, $query);
			$row = mysqli_fetch_assoc($result);
			$data = "";

			$year = '';
			if (!empty($row["date_accomplished"])) {
				$timestamp = strtotime($row["date_accomplished"]);
				if ($timestamp !== false) {
					$year = date("Y", $timestamp);
				}
			}

			if ($row["program_type"] == "1") {
				$data = "AKAP Fund " . $year;
			} elseif ($row["program_type"] == "0") {
				$data = "Current Fund" . $year;
			} elseif ($row["program_type"] == "other") {
				$data = $row["other_program"] . " Fund " . $year;
			} else {
				$data = "Other Fund " . $year;
			}

			return $data = trim($data);
		}

		public function updateGIS($empid, $trans_id, $csubcat, $id, $familyData, $s1, $s2, $s3, $s4, $s5, $s6, $program, $rl1, $rl2, $rl3, $ref_name,
			$type1, $pur1, $a1, $m1, $f1, $type2, $pur2, $a2, $m2, $f2, $mode_ad, $num, $gis_opt, $prob, $ass, $signatoryGIS, $fs1, $fs2, $fs3, $fs4, $fs5, $fs6, $fs7, $fs8, $fs9, $fs10, $fs11, $fs12, 
			$targets, $subcat, $c_disability, $others_subcat, $if_medical, $if_burial, $financial, $material,
			$docu_otherinfo, $otherProgram, $belowMonthly, $diagnosis_cause_of_death, $severity, $crisis, $crisis1, $support, $external, $selfhelp, $vulnerability,
            $SOI_wage, $SOI_profit, $SOI_domesticsource, $SOI_abroad, $SOI_governmenttransfer, $SOI_pension, $SOI_otherincome){
				
			if(strtolower($mode_ad) == "walk-in"){
				$rl1 = "";
				$rl2 = "";
				$rl3 = "";
			}
			$query = "SELECT client_id FROM tbl_transaction WHERE trans_id = '{$trans_id}';";
			$result = mysqli_query($this->db, $query);
			$data = mysqli_fetch_assoc($result);


			$query = "UPDATE client_data SET subCategory = '{$csubcat}' WHERE client_id = '{$data['client_id']}';";
			$result = mysqli_query($this->db, $query);

			$query ="";
			$query .= "DELETE FROM family where trans_id='{$trans_id}';";
			if (!empty($familyData)) {
				$query .= "INSERT INTO family (trans_id, name, relation_bene, age, occupation, salary) VALUES ";

				$family_values = [];
				foreach ($familyData as $member) {
					$membername = strtoupper($member['name']);
					$memberrelation = strtoupper($member['relation_bene']);
					$memberage = $member['age'];
					$memberoccupation = strtoupper($member['occupation']);
					$membersalary = $member['salary'];

					$family_values[] = "('{$trans_id}', '{$membername}', '{$memberrelation}', '{$memberage}', '{$memberoccupation}', '{$membersalary}')";
				}

				$query .= implode(', ', $family_values);
				$query .= ";";
			}
			$assistance = $this-> getAssistanceData($trans_id);
			$query .= "DELETE FROM service WHERE trans_id = '{$trans_id}';";
			$query .= "INSERT INTO service (trans_id, service1, service2, service3, service4, service5, service6, ref_name, refer1, refer2, refer3) 
						VALUES ('{$trans_id}','{$s1}','{$s2}','{$s3}', '{$s4}','{$s5}', '{$s6}','{$ref_name}', '{$rl1}','{$rl2}', '{$rl3}');";

			$query .= "DELETE FROM assessment WHERE trans_id = '{$trans_id}';";
			$query .= "INSERT INTO assessment (trans_id, target_sector, type_of_disability, subcat_ass, below_monthly_income, others_subcat, gis_option, problem, soc_ass, mode_admission, client_num) 
			VALUES ('{$trans_id}', '{$targets}', '{$c_disability}', '{$subcat}', '{$belowMonthly}', '{$others_subcat}', '{$gis_opt}','{$prob}', '{$ass}', '{$mode_ad}', {$num});"; 
		
			$query .= "DELETE FROM assistance WHERE trans_id = '{$trans_id}';";
			$query .= "INSERT INTO assistance (trans_id, type, if_medical, if_burial, cause_of_death, financial, material, amount, mode, fund, purpose, type_description) 
					VALUES ('{$trans_id}', '{$type1}', '{$if_medical}', '{$if_burial}', '{$diagnosis_cause_of_death}', '{$financial}', '{$material}', '{$a1}', '{$m1}', '', '{$pur1}', 'Type1')";
					if($type2 !=""){
						$query .= " ,('{$trans_id}', '{$type2}', '{$a2}', '{$m2}', '{$f2}', '{$pur2}', 'Type2')";
					}
			$query .= ";";

			$query .= "DELETE FROM other_client_information WHERE trans_id = '{$trans_id}';";
			$query .= "INSERT INTO other_client_information (trans_id, otherClientInformation, crisisSeverityQuestion1, crisisSeverityQuestion2, crisisSeverityQuestion3, supportSystemAvailability, externalResources, selfHelp, vulnerability_riskFactor) 
			VALUES ('{$trans_id}', '{$docu_otherinfo}', '{$severity}', '{$crisis}', '{$crisis1}', '{$support}', '{$external}', '{$selfhelp}', '{$vulnerability}');"; 

			$query .= "DELETE FROM source_of_income WHERE trans_id = '{$trans_id}';";
			$query .= "INSERT INTO source_of_income (trans_id, wage, profit, domestic_source, abroad, government_transfer, pension, other_income) 
			VALUES ('{$trans_id}', '{$SOI_wage}', '{$SOI_profit}', '{$SOI_domesticsource}', '{$SOI_abroad}', '{$SOI_governmenttransfer}', '{$SOI_pension}', '{$SOI_otherincome}');"; 


			$query .= "DELETE FROM tbl_coe_fund WHERE trans_id = '{$trans_id}';";
			$query .= "INSERT INTO tbl_coe_fund (trans_id, fundsource, fs_amount) ";
			if (!empty($fs1)) {
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
				if (!empty($fs6)) {
					$query .= ",('{$trans_id}', '{$fs6}', '')";
				}
				if (!empty($fs7)) {
					$query .= ",('{$trans_id}', '{$fs7}', '')";
				}
				if (!empty($fs8)) {
					$query .= ",('{$trans_id}', '{$fs8}', '')";
				}
				if (!empty($fs9)) {
					$query .= ",('{$trans_id}', '{$fs9}', '')";
				}
				if (!empty($fs10)) {
					$query .= ",('{$trans_id}', '{$fs10}', '')";
				}
				if (!empty($fs11)) {
					$query .= ",('{$trans_id}', '{$fs11}', '')";
				}
				if (!empty($fs12)) {
					$query .= ",('{$trans_id}', '{$fs12}', '')";
				}
			} else {
				$query .= "VALUES ('{$trans_id}', '{$f1}', '{$a1}')";
			}
			$query .= ";";
			
			$sign_id = $signatoryGIS;
			$query .= "UPDATE tbl_transaction SET signatory_id = '{$sign_id}', program_type = '{$program}', encoded_socialWork='{$empid}'";
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
			if(strtolower($program) == "other"){ 
				$query .= ", other_program = '{$otherProgram}'"; 
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
			$query .= "DELETE FROM family where trans_id='{$trans_id}';";
			if(!empty($p1)){
				$query .= "INSERT INTO family (trans_id, name, age, occupation, salary) VALUES ('{$trans_id}','{$p1}', {$e1}, '{$t1}', '{$b1}')";
				if(!empty($p2)){$query .= ",('{$trans_id}','{$p2}', {$e2}, '{$t2}', '{$b2}')";}
				if(!empty($p3)){$query .= ",('{$trans_id}','{$p3}', {$e3}, '{$t3}', '{$b3}')";}
				$query .= ";";
			}
						
			
			$query .= " UPDATE service SET service1={$s1}, service2={$s2}, service3={$s3}, service4={$s4}, ref_name='{$ref_name}', remark_service_update='{$socialwork}' WHERE trans_id = '{$trans_id}';";
			
			$assistance = $this->getAssistanceData($trans_id);
			
			$query .= " UPDATE assessment SET problem = '{$prob}', gis_option = '{$gis_opt}', soc_ass='{$ass}', mode_admission='{$mode_ad}', client_num='{$num}', remark_onupdate='{$socialwork}'
						WHERE trans_id='{$trans_id}';";
		
			$query .= "UPDATE assistance SET type = '{$type1}', amount = '{$a1}', mode ='{$m1}', fund = '', purpose = '{$pur1}', remark_assist_update = '{$socialwork}' WHERE trans_id = '{$trans_id}' AND type_description = 'Type1';";

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

			$sign_id = $signatoryGIS;
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
			while($rows = mysqli_fetch_assoc($result)){
				$num++;
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

		public function showallClientdata($id){
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

		public function theTime($full){
			$date = explode(' ', $full);
			return $date[1];
		}

		public function signatory(){
			$query = "SELECT * FROM signatory;";
			$result = mysqli_query($this->db,$query);
			if($result){
				return $result;
			}
			else {
				return false;
			}
		}

		public function signatoryosap(){
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
		
		public function returntime($id){
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
			$f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
			
			$money = explode(".", $num);    
			$size = sizeof($money);
			$money[0] = str_replace(",", "", $money[0]);
	
			$str1 = (string) $f->format(intval($money[0])) ." PESOS ";
	
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

		public function getsignatory($id){
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
		public function getSignatoryFullnameCOE($id){
			$query = "SELECT name_title, first_name, middle_I, last_name, position, initials FROM signatory WHERE signatory_id = '{$id}';";
			$result = mysqli_query($this->db,$query);
			$row = mysqli_fetch_assoc($result);
			$data = (empty($row['name_title'])?"":$row['name_title']." "). $row['first_name'] ." ". (empty($row['middle_I'])?"":$row['middle_I'].". "). $row['last_name'] ."-". $row['position'];
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
		
		public function insertCOE($id, $client_id, $docu, $id_pres, $signName, $others_input, $others_medical, $others_burial, $amount1, $amount2, $amount3, $amount4, 
		$amount5, $amount6, $amount7, $amount8, $amount9, $amount10, $amount11, $amount12, $am, $mode, $id_sign, $sd_officer, $client_work, $client_salary, $client_agency){
			$others_input = mysqli_real_escape_string($this->db,$others_input);
			$signid = 0;
			
			$signid = $signName;

			if(empty($amount2)){
				$amount1 = $am;
			}
			
			$data = $this->getfundsourcedata($id);
			$query = "INSERT INTO coe (trans_id, document, id_presented, others_input, others_medical, others_burial) 
						VALUES 
						('{$id}','{$docu}','{$id_pres}','{$others_input}','{$others_medical}','{$others_burial}');";
			$result = mysqli_query($this->db, $query);
			if($am >= 50001 && $mode == "GL"){
				$query = "UPDATE tbl_transaction SET signatory_GL = '{$signid}' WHERE trans_id = '{$id}';";
				$result = mysqli_query($this->db, $query);
			}
			if (!empty($data[2]['fundsource'])) {
				$query = "DELETE FROM tbl_coe_fund WHERE trans_id = '{$id}'; ";
				$result = mysqli_query($this->db, $query);
				$query = "INSERT INTO tbl_coe_fund (trans_id, fundsource, fs_amount) 
						VALUES ('{$id}', '{$data[1]['fundsource']}', '{$amount1}')";
				if (!empty($data[2]['fundsource'])) {$query .= ",('{$id}', '{$data[2]['fundsource']}', '{$amount2}')";}
				if (!empty($data[3]['fundsource'])) {$query .= ",('{$id}', '{$data[3]['fundsource']}', '{$amount3}')";}
				if (!empty($data[4]['fundsource'])) {$query .= ",('{$id}', '{$data[4]['fundsource']}', '{$amount4}')";}
				if (!empty($data[5]['fundsource'])) {$query .= ",('{$id}', '{$data[5]['fundsource']}', '{$amount5}')";}
				if (!empty($data[6]['fundsource'])) {$query .= ",('{$id}', '{$data[6]['fundsource']}', '{$amount6}')";}
				if (!empty($data[7]['fundsource'])) {$query .= ",('{$id}', '{$data[7]['fundsource']}', '{$amount7}')";}
				if (!empty($data[8]['fundsource'])) {$query .= ",('{$id}', '{$data[8]['fundsource']}', '{$amount8}')";}
				if (!empty($data[9]['fundsource'])) {$query .= ",('{$id}', '{$data[9]['fundsource']}', '{$amount9}')";}
				if (!empty($data[10]['fundsource'])) {$query .= ",('{$id}', '{$data[10]['fundsource']}', '{$amount10}')";}
				if (!empty($data[11]['fundsource'])) {$query .= ",('{$id}', '{$data[11]['fundsource']}', '{$amount11}')";}
				if (!empty($data[12]['fundsource'])) {$query .= ",('{$id}', '{$data[12]['fundsource']}', '{$amount12}')";}
				$query .= ";";
				$result = mysqli_query($this->db, $query);
			}

			if (!empty($sd_officer)) {
				$query = "DELETE FROM cash WHERE trans_id = '{$id}'; ";
				$result = mysqli_query($this->db, $query);
				$query = "INSERT INTO cash (trans_id, sd_officer) 
							VALUES 
							('{$id}', '{$sd_officer}');";
				$result = mysqli_query($this->db, $query);
			}

			$client_salary = str_replace(',','',$client_salary);

			if (!empty($client_work) && !empty($client_salary) && !empty($client_agency)) {
				$query = "UPDATE client_data SET occupation = '{$client_work}', salary = '{$client_salary}', agency = '{$client_agency}' WHERE client_id = '{$client_id}';";
				$result = mysqli_query($this->db, $query);
			}
		
			if($result){
				echo "<script>alert('Successfully Saved!');</script>";
				echo "<meta http-equiv='refresh' content='0'>";
			}else{
				echo "<script>alert('Something Went Wrong!');</script>";
			}
		}

		public function updateCOE($id, $client_id, $docu, $id_pres, $signName, $others_input, $others_medical, $others_burial, $amount1, $amount2, $amount3, $amount4, 
		$amount5, $amount6, $amount7, $amount8, $amount9, $amount10, $amount11, $amount12, $am, $mode, $id_sign, $sd_officer, $client_work, $client_salary, $client_agency){
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
				if (!empty($data[6]['fundsource'])) {$query .= ",('{$id}', '{$data[6]['fundsource']}', '{$amount6}')";}
				if (!empty($data[7]['fundsource'])) {$query .= ",('{$id}', '{$data[7]['fundsource']}', '{$amount7}')";}
				if (!empty($data[8]['fundsource'])) {$query .= ",('{$id}', '{$data[8]['fundsource']}', '{$amount8}')";}
				if (!empty($data[9]['fundsource'])) {$query .= ",('{$id}', '{$data[9]['fundsource']}', '{$amount9}')";}
				if (!empty($data[10]['fundsource'])) {$query .= ",('{$id}', '{$data[10]['fundsource']}', '{$amount10}')";}
				if (!empty($data[11]['fundsource'])) {$query .= ",('{$id}', '{$data[11]['fundsource']}', '{$amount11}')";}
				if (!empty($data[12]['fundsource'])) {$query .= ",('{$id}', '{$data[12]['fundsource']}', '{$amount12}')";}
				$query .= ";";
            }
			
			if (!empty($sd_officer)) {
				$query .= "DELETE FROM cash WHERE trans_id = '{$id}';";
				$query .= "INSERT INTO cash (trans_id, sd_officer) 
							VALUES 
							('{$id}', '{$sd_officer}');";
			}
			
			if (!empty($client_work) && !empty($client_salary) && !empty($client_agency)) {
				$query .= "UPDATE client_data SET occupation = '{$client_work}', salary = '{$client_salary}', agency = '{$client_agency}' WHERE client_id = '{$client_id}';";
			}
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

	
	public function glfundsource($id) {
		$query = "SELECT * FROM tbl_coe_fund WHERE trans_id = '{$id}';";
		$result = mysqli_query($this->db, $query);
		$num = 0;
		
		while($rows = mysqli_fetch_assoc($result)){
			$num++;
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
		
		$glid = date("dHis");
		return $cid."-".$glid." ".$office;
	}

	public function getTransactionProcessed($id){

		$query="SELECT LEFT('{$id}', 9) AS office";
		$result = mysqli_query($this->db, $query);
		$row = mysqli_fetch_assoc($result);

		$office = $row['office'];
		
		$query="SELECT description FROM field_office WHERE office_id = '{$office}';";
		$result = mysqli_query($this->db, $query);
		$row = mysqli_fetch_assoc($result);
		$description = $row['description'];
		
		if(strtoupper($description) === "MALASAKIT"){
			return true;
		}else{
			return false;
		}
	}

	
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
		$now = date("Y-m-d H:i:s");
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
	
	public function updateGLCash($id, $sd_officer, $c_no, $signatory, $addressee, $a_pos, $forthe, $cname, $add, $tomention){
			$now = date("Y-m-d H:i:s");
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
			while($row = mysqli_fetch_assoc($result)){
				$num++;
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
			}elseif(substr_count(strval($type), "Funeral") > 0){
				return "Funeral";
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
			$data = [];

			while($row = mysqli_fetch_assoc($result)){
				$data[] = [
					'name' => $row['name'],
					'relation_bene' => $row['relation_bene'],
					'age' => $row['age'],
					'occupation' => $row['occupation'],
					'salary' => $row['salary']
				];
			}
		
			if(empty($data)){
				return "";
			} else {
				return $data;
			}
		}

		public function getGISAssistance($id){
			$query = "SELECT type, if_medical, if_burial, cause_of_death, financial, material, amount, mode, fund, purpose FROM assistance WHERE trans_id = '{$id}';";
			$result = mysqli_query($this->db, $query);
			$num = 0;
			while($row = mysqli_fetch_assoc($result)){
				$num++;
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
			while($row = mysqli_fetch_assoc($result)){
				$num++;
				$data[$num] = $row;
			}
			
			if(!empty($data)){
				return $data;
			}else{
				return null;
			}
			
		}
	
		public function getGISData($id){
			$query =  " SELECT gis_option, problem, soc_ass, mode_admission, client_num, service1, service2, service3, service4, service5, service6,
								ref_name, refer1, refer2, refer3, signatory_id, subcat_ass, below_monthly_income, target_sector, type_of_disability, others_subcat, pantawid_bene, program_type from assessment 
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

		public function getOtherInformations($id){
			$query =  " SELECT source_of_income.*, other_client_information.* from source_of_income 
						LEFT JOIN other_client_information USING (trans_id) 
						LEFT JOIN tbl_transaction USING (trans_id) WHERE trans_id='{$id}'"; 
						
			$result = mysqli_query($this->db, $query);
			
			$data = mysqli_fetch_assoc($result);
			if(empty($data)){
				return null; 
			}else{
				return $data;
			}

		}
		public function totalSourceOfIncome($id){
			$query =  " SELECT source_of_income.* from source_of_income WHERE trans_id='{$id}'"; 
						
			$result = mysqli_query($this->db, $query);
			$row = mysqli_fetch_assoc($result);
			$wage = floatval(str_replace(',','',$row['wage']));
			$profit = floatval(str_replace(',','',$row['profit']));
			$domestic = floatval(str_replace(',','',$row['domestic_source']));
			$abroad = floatval(str_replace(',','',$row['abroad']));
			$transfer = floatval(str_replace(',','',$row['government_transfer']));
			$pension = floatval(str_replace(',','',$row['pension']));
			$other_income = floatval(str_replace(',','',$row['other_income']));
			$total = $wage + $profit + $domestic + $abroad + $transfer + $pension + $other_income;

			$data = number_format($total, 2);

			if(empty($data)){
				return null; 
			}else{
				return $data;
			}

		}

		function ParseInputs($inputString) {
			$cleaned = preg_replace('/(?<=\d)(?=\d)/', '', $inputString ?? '');
			$segments = explode('-', $cleaned);
		
			$results = [];
		
			foreach ($segments as $segment) {
				if (strpos($segment, '=') !== false) {
					list($key, $value) = explode('=', $segment, 2);
					$results[$key] = $value;
				} else {
					$results[$segment] = true;
				}
			}

			return $results;
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
		
		public function updateBene($trans_id, $b_id, $relation, $lname, $mname, $fname, $exname, 
								$bday, $category, $sex, $status, $contact,
								$region, $province, $municipality, $barangay, $district, $street){

			$query = "UPDATE tbl_transaction SET relation='{$relation}'  WHERE trans_id = '{$trans_id}';";
			$result = mysqli_query($this->db,$query);
			
			$query = "UPDATE beneficiary_data SET b_fname='{$fname}', b_mname='{$mname}', b_lname='{$lname}', b_exname='{$exname}', 
					   b_bday='{$bday}', b_category='{$category}',b_sex='{$sex}', b_civilStatus='{$status}', b_contact='{$contact}',
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
								$bday, $category, $sex, $status, $contact,
								$region, $province, $municipality, $barangay, $district, $street){
			
			$datenow = date("Y-m-d H:i:s"); //serve as date_entered
									
			$client_id = $this->getClient_id($trans_id); //get client_id to update relation

			
			$query = "INSERT INTO `beneficiary_data`
					(`b_fname`, `b_mname`, `b_lname`, `b_exname`, 
					`b_civilStatus`, `b_contact`, `b_bday`, `b_sex`, `b_category`, `b_region`, 
					`b_province`, `b_municipality`, `b_barangay`, `b_district`, `b_street`, `b_date_inserted`) 
					VALUES 
					('{$fname}','{$mname}','{$lname}','{$exname}','{$status}','{$contact}','{$bday}','{$sex}','{$category}',
					'{$region}','{$province}','{$municipality}','{$barangay}','{$district}','{$street}', '{$datenow}')";
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
			if(substr_count(strval($str), $sub) > 0 || $amount >= 10001){
				return "";
			}else{
				return "hidden";
			}
		}

	public function checkService($type1, $type2, $content1, $content2, $str){
			$type1 = strtolower($type1);
			$type2 = strtolower($type2);
			if(empty($type2)){
				$type2 = "";
			}
			$content1 =  strtolower($content1);
			$content2 =  strtolower($content2);
			if(empty($content2)){
				$content2 = "";
			}
			$str = strtolower($str);
			if(substr_count(strval($type1), $str) > 0 || substr_count(strval($type2), $str) > 0){
				if(substr_count(strval($type1), $str) > 0){
					return strtoupper($content1);
				}elseif (substr_count(strval($type2), $str) > 0) {
					return strtoupper($content2);
				}
			}else{
				return "";
			}
	}

	public function checkFAssistance($type1, $str){
		$type1 = strtolower($type1);
		$str = strtolower($str);
		if(substr_count(strval($type1), $str) > 0){
			return "checked";
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
            <option>October</option>
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
	
	public function getBeneData($id){
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

		$value = mysqli_real_escape_string($this->db, $val);

		$words = explode(" ", trim($value));
		$booleanSearch = "";

		foreach ($words as $word) {
			if (!empty($word)) {
				$booleanSearch .= "+" . $word . "* ";
			}
		}

		$query = "
		SELECT 
			c.lastname, c.firstname, c.middlename, c.extraname,
			b.b_lname, b.b_fname, b.b_mname, b.b_exname,
			t.status_client, t.trans_id, t.relation,
			t.date_accomplished, t.clientonly, 
			t.clientsamebene, t.benetoclient
		FROM client_data c
		LEFT JOIN tbl_transaction t ON t.client_id = c.client_id
		LEFT JOIN beneficiary_data b ON b.bene_id = t.bene_id
		WHERE 
			t.status_client IN ('Done','Decline')
		AND (
			MATCH(c.firstname, c.middlename, c.lastname)
				AGAINST ('$booleanSearch' IN BOOLEAN MODE)
			OR
			MATCH(b.b_fname, b.b_mname, b.b_lname)
				AGAINST ('$booleanSearch' IN BOOLEAN MODE)
		)
		ORDER BY t.date_entered DESC
		LIMIT 3
		";

		return mysqli_query($this->db, $query);
	}
	
	public function searchServedforReissue($val){
		$value = mysqli_real_escape_string($this->db, $val);

		$words = explode(" ", trim($value));
		$booleanSearch = "";

		foreach ($words as $word) {
			if (!empty($word)) {
				$booleanSearch .= "+" . $word . "* ";
			}
		}

		$query = "
		SELECT 
			c.lastname, c.firstname, c.middlename, c.extraname,
			b.b_lname, b.b_fname, b.b_mname, b.b_exname,
			t.status_client, t.trans_id, t.relation,
			t.date_accomplished, t.clientonly, 
			t.clientsamebene, t.benetoclient
		FROM client_data c
		LEFT JOIN tbl_transaction t ON t.client_id = c.client_id
		LEFT JOIN beneficiary_data b ON b.bene_id = t.bene_id
		WHERE 
			t.status_client IN ('Done')
		AND (
			MATCH(c.firstname, c.middlename, c.lastname)
				AGAINST ('$booleanSearch' IN BOOLEAN MODE)
			OR
			MATCH(b.b_fname, b.b_mname, b.b_lname)
				AGAINST ('$booleanSearch' IN BOOLEAN MODE)
		)
		ORDER BY t.date_entered DESC
		LIMIT 3
		";

		return mysqli_query($this->db, $query);
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
			where (status_client = 'Done' AND encoded_encoder = '{$_SESSION['userId']}' AND (date_accomplished BETWEEN '{$date1} 00:01:01' AND '{$date2} 23:59:59')) ORDER BY `tbl_transaction`.`date_accomplished` DESC";
		}else{
			$query = "SELECT client_id, trans_id, lastname, firstname, middlename, extraname, date_accomplished, encoded_socialWork, b_fname, b_mname, b_lname, b_exname 
			FROM `client_data` 
			LEFT JOIN tbl_transaction USING (client_id) 
			LEFT JOIN beneficiary_data USING (bene_id)
			where status_client = 'Done' AND encoded_encoder = '{$_SESSION['userId']}' AND (date_accomplished BETWEEN '{$datenow} 00:01:01' AND '{$datenow2} 23:59:59') ORDER BY `tbl_transaction`.`date_accomplished` DESC";
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
			where (status_client = 'Done' AND encoded_encoder = '{$_SESSION['userId']}' AND (date_accomplished BETWEEN '{$date1} 00:01:01' AND '{$date2} 23:59:59'));";
			$result = mysqli_query($this->db, $query);
			$rownum = mysqli_num_rows($result);
		}else{
			$query = "SELECT client_id, trans_id, lastname, firstname, middlename, extraname, date_accomplished, encoded_socialWork, b_fname, b_mname, b_lname, b_exname 
			FROM `client_data` 
			LEFT JOIN tbl_transaction USING(client_id) 
			LEFT JOIN beneficiary_data USING (bene_id)
			where (status_client = 'Done' AND encoded_encoder = '{$_SESSION['userId']}' AND (date_accomplished BETWEEN '{$datenow} 00:01:01' AND '{$datenow2} 23:59:59'));";
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
            where (status_client = 'Done' AND encoded_socialWork = '{$_SESSION['userId']}' AND (date_accomplished BETWEEN '{$date1} 00:01:01' AND '{$date2} 23:59:59')) ORDER BY `tbl_transaction`.`date_accomplished` DESC";
        }else{
			$query = "SELECT client_id, trans_id, lastname, firstname, middlename, extraname, date_accomplished, encoded_encoder, b_fname, b_mname, b_lname, b_exname 
            FROM `client_data` 
            LEFT JOIN tbl_transaction USING (client_id) 
            LEFT JOIN beneficiary_data USING (bene_id)
            where status_client = 'Done' AND encoded_socialWork = '{$_SESSION['userId']}' AND (date_accomplished BETWEEN '{$datenow} 00:01:01' AND '{$datenow2} 23:59:59') ORDER BY `tbl_transaction`.`date_accomplished` DESC";
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
            where (status_client = 'Done' AND encoded_socialWork = '{$_SESSION['userId']}' AND (date_accomplished BETWEEN '{$date1} 00:01:01' AND '{$date2} 23:59:59'))";
            $result = mysqli_query($this->db, $query);
            $rownum = mysqli_num_rows($result);
        } else {
            $query = "SELECT client_id, trans_id, lastname, firstname, middlename, extraname, date_accomplished, encoded_encoder, b_fname, b_mname, b_lname, b_exname 
            FROM `client_data` 
            LEFT JOIN tbl_transaction USING (client_id) 
            LEFT JOIN beneficiary_data USING (bene_id)
            where (status_client = 'Done' AND encoded_socialWork = '{$_SESSION['userId']}' AND (date_accomplished BETWEEN '{$datenow} 00:01:01' AND '{$datenow2} 23:59:59'));";
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
		$img = "../images/noAvatar.png";
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
			$query = "SELECT initials FROM signatory WHERE signatory_tree = 'CURRENTHEAD11'";
			$result = mysqli_query($this->db,$query);
			$rows = mysqli_fetch_assoc($result);
			$ini .= $rows['initials'];

		}if($sign_tree == "CURRENTHEAD12" || $_SESSION['f_office'] == "118602-01"){ // davao occidental
			$query = "SELECT initials FROM signatory WHERE signatory_tree = 'CURRENTHEAD12'";
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
	

}


?>