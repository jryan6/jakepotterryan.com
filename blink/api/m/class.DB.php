<?php #This is a mysqlDB object for the Blink web project, it will function as a wrapper for all sql calls and requests.
	class DB {
		//initialize instance variables. Change these to change the project
		public static $dbCredPath = "/usr/local/uvm-inc/cdavenp1.inc";
		public static $db_name = "CDAVENP1_blink"; //overrides included db_name in above;

		//initialize class scope variables
		public $db; //holder for the pdo db object reference.
		public $lastInsertID;
		public $lastQuery;

		//array holders for tables
		public $user; //holds the array to generate the user table
		public $device; //holds the array to generate the device table
		public $test; //holds the array to generate the test table


		function __construct($debug=NULL){ //if constructor has the DEBUG parameter set to TRUE, it will drop and recreate the tables. Used on debug.php
			if ( is_null($debug) ){
				$this->connectMYSQL();
				$this->createTables();
			} else if ($debug){
				echo "DEBUGGING";				
				$this->connectMYSQL();
				$this->debugTables();
				//exit;
			} else {
				echo "somethings wrong in the DB.php constructor";
			}
			
			return $this;
		}

		public static function verify($password, $hashedPassword) { //used to verify a password against a hash with blowfish
			return crypt($password, $hashedPassword) == $hashedPassword;
		}

		public static function generateHash($password) { //hashing code from https://techchurian.wordpress.com/2013/07/28/144/
			if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH) {  //encrypts a plaintext password using blowfish encryption
				$salt = '$2y$11$' . substr(md5(uniqid(rand(), true)), 0, 22); //generate a random alphanum salt
				return crypt($password, $salt);
			} else {
				API::output('ERROR: No Fallback Encryption Specified, generateHash@class.db.php' );
			}
		}

		function connectMYSQL(){ //connects using PDO class INCLUDES Table Check
			require(DB::$dbCredPath); //includes: $db_name = 'cdavenp1_bug', $db_username, $db_password
			try {
				$dataSource = ($_SERVER["SERVER_NAME"]=="localhost")?"localhost":"webdb.uvm.edu"; //conditional variable allowing for local testing
				$db = new PDO('mysql:host='.$dataSource.';dbname='.DB::$db_name.';', $db_username, $db_password); //use PDO to connect w/ mysql database NOTE: CHANGE NETID HERE
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch(PDOException $e) {
				API::output('ERROR: ' . $e->getMessage() );
			}
			$this->db = $db; //set the class variable to point to the mysql pdo object
			return $this; //allows for method chaining, not entirely needed
		}

		function connectSQLITE(){}

		function execSQL($sql){ // execute an sql statement, returns object
			try{ 
				$x = $this->db->exec($sql);
			} catch(PDOException $e) {
				API::output('ERROR: ' . $e->getMessage() );
			}
			//$this->lastInsertID = ($this->db->lastInsertId() )? $this->db->lastInsertId() : NULL; // only works with auto-increment id's
			// API::output( $this->lastInsertID );	
			return $x;
		}

		function querySQL($sql){ //Returns query as a PDO object, an ASSOC array, or an ASSOC and NUMERIC array.
			try{
				$q = $this->db->query($sql);
			} catch(PDOException $e) {
				API::output('ERROR: ' . $e->getMessage() );
			}
			return $q;
		}

		function deleteTables(){ //automatically finds and drops all tables in a given database
			$tables = array();
			$sql = "SHOW TABLES FROM CDAVENP1_blink";
			$q=$this->querySQL($sql);
			foreach ($q as $key => $value){
				$tables[]=$value;
			}
			// API::output($tables);
			foreach($tables as $tableName){
				$sql = "DROP TABLE CDAVENP1_blink.".$tableName["Tables_in_CDAVENP1_blink"].";";
				$x = $this->execSQL($sql);
			}
			return $this;
		}

		function createTables(){
			$this->createDeviceTable();
			$this->createUserTable();
		}

		function createUserTable(){ ##### TODO move this to dao?
			$this->user["tablename"] = "user";
			//$this->user["fields"]["pkID"]="INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY";
			$this->user["fields"]["pkEmail"]="varchar(32) NOT NULL PRIMARY KEY";
			$this->user["fields"]["fldHash"]="varchar(64) NOT NULL";
			$this->user["fields"]["fldFirstName"]="varchar(32) NOT NULL";
			$this->user["fields"]["fldLastName"]="varchar(32) NOT NULL";
			// $table["fields"][]="fldAddress varchar(32)";
			// $table["fields"][]="fldCity varchar(32)";
			// $table["fields"][]="fldState char(2)";
			// $table["fields"][]="fldZip int unsigned zerofill";
			$this->user["fields"]["fldDateJoined"]="timestamp NOT NULL";
			$this->user["fields"]["fldSecurityQuestion1"]="tinyint";
			$this->user["fields"]["fldSecurityQuestion2"]="tinyint";
			$this->user["fields"]["fldSecurityAnswer1"]="varchar(32)";
			$this->user["fields"]["fldSecurityAnswer2"]="varchar(32)";
			//$table["fields"][]="PRIMARY KEY (pkID)";
			$sql=$this->generateSQL($this->user);
			$this->execSQL($sql);
			return $this;
		}

		function createDeviceTable(){  //Creates tables if they aren't already made. Part of sanity check.
			$this->device["tablename"] = "device";
			$this->device["fields"]["pkPin"]="int AUTO_INCREMENT NOT NULL PRIMARY KEY";
			$this->device["fields"]["fldUUID"]="char(36) NOT NULL";
			$this->device["fields"]["fkEmail"]="varchar(32)";
			$this->device["fields"]["fldLastActivated"]="datetime";
			//$table["fields"][]="PRIMARY KEY (pkPin)";
			//$table["fields"][]="FOREIGN KEY (userID) REFERENCES user (pkID)";
			$this->device["options"]="AUTO_INCREMENT=1111";
			$sql=$this->generateSQL($this->device);
			$this->execSQL($sql);
			return $this;
		}

		function createTestTable(){  //Creates tables if they aren't already made. Part of sanity check.
			$table["tablename"] = "test";
			$table["fields"][]="id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY";
			$table["fields"][]="time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP";
			//$table["fields"][]="PRIMARY KEY (id)";
			//$table["fields"][]="KEY id (id)";
			$sql=$this->generateSQL($this->test);
			$this->execSQL($sql);
			return $this;
		}

		public static function generateSQL($table){ // generates CREATE TABLE sql given array( "tablename"=>"test", "fields"=>array("id"=>int AUTO_INCREMENT PRIMARY KEY, etc), "options"="AUTO_INCREMENT=1111" )
			//API::output($table);
			$fieldsAndDatatypes=array();
			@$options= ( $table["options"] )  ?  " ) ".$table["options"].";"  :  ");";
			foreach ($table["fields"] as $key => $value) $fieldsAndDatatypes[] = $key." ".$value; //prepare for implosion, not sure of an easier way to do this.
			
			//API::output($fieldsAndDatatypes);
			$sql = "CREATE TABLE IF NOT EXISTS "
					.$table["tablename"]
					." ( " //field datatype , field datatype
						.implode(", ", $fieldsAndDatatypes )
					.$options; //includes ending )
			API::output($sql);
			return $sql;
		}

		function debugTables($table=''){ //inserts data into the tables for debugging purposes, string input to tell which table
			$this->deleteTables();
			$this->createTables();
			switch ($table) {
				default: //pkPin tinyint(4) fldUUID char(36) fkOwnerID lastActivated datetime
					$ins1=array("fldUUID"=>"0410FB6E-39DA-981A-7005-854FAD594D13");
					$this->insert($ins1, "device");
					$ins2=array("fldUUID"=>"051DFA58-4D50-A16F-5977-551DB9374B59");
					$this->insert($ins2, "device"); 
				//run into user as well, by default. Get them both

				case 'user':
					$user = array( "pkEmail"=>"test@test.com", "fldHash"=>DB::generateHash("testpass"),
								"fldFirstName"=>"George", "fldLastName"=>"Clooney", "fldDateJoined"=>"CURRENT_TIMESTAMP",
								"fldSecurityQuestion1"=>"1", "fldSecurityQuestion2"=>"asdfasdf",
								"fldSecurityAnswer1"=>"Noodle", "fldSecurityAnswer2"=>"Georgett");
					$this->insert($user, "user");
				break;
				
				case 'device': //pkPin tinyint(4) fldUUID char(36) fkOwnerID lastActivated datetime
					$ins1=array("fldUUID"=>"0410FB6E-39DA-981A-7005-854FAD594D13");
					$this->insert($ins1, "device");
					$ins2=array("fldUUID"=>"051DFA58-4D50-A16F-5977-551DB9374B59");
					$this->insert($ins2, "device");
				break;
			}
		}

		public function alreadyExists($id, $table="user"){ //boolean to check if a given ID already exists
			//example, alreadyExists('email@gmail.com', 'user');
			switch ($table) { // set the primary key field based on the table, default to user table
				case 'user': 
					$pk="pkEmail";	
					$whereFld="pkEmail"; 
					$options=";";
				break;
				case 'device': 
					$pk="*"; 
					$whereFld="pkPin"; 
					$options="AND fkEMAIL IS NULL;"; 
				break;
				default: 
					API::output("you called alreadyExists with a table that isn't supported"); 
				exit;
			}
			//API::output($id);
			//select count(*) from device WHERE pkPin=1112 AND fkEmail IS NULL;
			$sql = "select COUNT(".$pk.") from ".$table." where ".$whereFld."= '".API::sanitize($id)."' ".$options;
			//API::output($sql);
			$result=$this->querySQL($sql);
			$return = $result->fetch(PDO::FETCH_NUM);

			//API::output($return);
			return $return[0];
		}

		function insert($arr=array("id"=>"''", "time"=> 'CURRENT_TIMESTAMP'), $table='test'){ //Takes an array of keys and values to insert into a given table 
			//usage: insert([firstName=>"Tom", lastName="Whittaker"], "user");
			$keys = "(".implode(",", array_keys($arr)).")"; // (key1, key2, key3)
			$values = " VALUES ('".implode("','", array_values($arr))."')"; // (val1, val2, val3)
			$sql="INSERT INTO ".$table.$keys.$values;
			$x=$this->execSQL($sql); // "INSERT INTO table (id, first, last) VALUES (1, tom, brady);"
			return $this;
		}

		function respondNotImplemented(){
			$btr=debug_backtrace(); 
			$line=$btr[0]['line']; 
			$file=basename($btr[0]['file']); 
			API::output(array("status"=>"Error", "code"=>"501", "err"=>"Not Implemented", "location"=>$file.":".$line)); //issue bad request
			exit;
		}


		function GET($id=NULL, $field=NULL){
			if(!is_null($id)){
				if(!is_null($field)){
					#two parameter GET for resource - e.g. GET /api/resource/id/field
					dao::respondNotImplemented();
				} else {
					#one parameter GET for resource - e.g. GET /api/resource/id
					dao::respondNotImplemented();
				}
			} else {
				#zero parameter or generic GET for resource - e.g. GET /api/resource
				dao::respondNotImplemented();
			}
		}

		function POST($data=NULL, $id=NULL){
			if(!is_null($data)){
				if(!is_null($id)){
					#two parameter POST for resource - e.g. POST /api/resource/id/field
					dao::respondNotImplemented();
				} else {
					#one parameter POST for resource - e.g. POST /api/resource/id
					dao::respondNotImplemented();
				}
			} else {
				#zero parameter or generic POST for resource - e.g. POST /api/resource
				dao::respondNotImplemented();
			}
		}

		function PUT($data=NULL, $id=NULL, $field=NULL){
			if(!is_null($id)){
				if(!is_null($field)){
					#two parameter PUT for resource - e.g. PUT /api/resource/id/field
					dao::respondNotImplemented();
				} else {
					#one parameter PUT for resource - e.g. PUT /api/resource/id
					dao::respondNotImplemented();
				}
			} else {
				#zero parameter or generic PUT for resource - e.g. PUT /api/resource
				dao::respondNotImplemented();
			}
		}

		function DELETE($id=NULL){
			if(!is_null($id)){
					dao::respondNotImplemented();
			} else {
				#zero parameter or generic DELETE for resource - e.g. DELETE /api/resource
				dao::respondNotImplemented();
			}
		}
	}
?>