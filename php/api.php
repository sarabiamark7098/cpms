<?php
	session_start();
	include ("db_config.php");
	include ("db_config2.php");


	class User{
	
		public $db;
		public $db2;
		
		public function __construct(){

			$this->db =  mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
				if(mysqli_connect_errno()) 	 {
					die("Database connection failed: " . 
						mysqli_connect_error() . 
						" (" . mysqli_connect_errno() . ")"
					);
				}
            // mysqli_query($this->db, "set global sql_mode=''");
			$this->db2 =  mysqli_connect(DB_SERVER2, DB_USERNAME2, DB_PASSWORD2, DB_DATABASE2);
				if(mysqli_connect_errno()) {
					die("Database connection failed: " . 
						mysqli_connect_error() . 
						" (" . mysqli_connect_errno() . ")"
					);
				}
            // mysqli_query($this->db2, "set global sql_mode=''");
			}

            public function api(){
                $mysqli = new mysqli("example.com", "user", "password", "database");
                $result = $mysqli->query("SELECT 'Hello, dear MySQL user!' AS _message FROM DUAL");
                $row = $result->fetch_assoc();
                echo htmlentities($row['_message']);
            }
    
    }
?>