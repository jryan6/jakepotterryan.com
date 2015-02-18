<?php
	require('class.DB.php');
	class dao extends DB {

		//specific SQL sub-methods required for getting or submitting go here, example - 
		// function insertUser();
		// function getName();
		// function updateCredentials();

		function checkPassword($email, $pass){ //sanitizes
			$pin=API::sanitize($pin);
			$sql="SELECT fldHash FROM user WHERE pkEmail='".$email."';";
			//API::output($sql);
			$result=$this->querySQL($sql);
			$hash=$result->fetch(PDO::FETCH_ASSOC);
			if (!$result) {
				API::output( array("status"=>"Error", "code"=>"404", "err"=>"Email/Password Not Found", "location"=>"checkPassword@user.dao") );
			} else { //there was a resulting hash pulled from the database
				if(DB::verify($pass, $hash) ) API::output("Login Success");
				else API::output( array("status"=>"Error", "code"=>"404", "err"=>"Email/Password Not Found", "location"=>"checkPassword@user.dao") );
			}
			return $result['fldUUID'];
		}

		function createUser($uncleanDataArray, $table='user'){
		//VARIABLES TO BE SENT: pkEmail, fldFirstName, fldLastName, fldSecurityQuestion1, fldSecurityQuestion2, fldSecurityAnswer1, fldSecurityAnswer2
		//ALSO SENT: fldPin, fldPassword => fldHash
		//ALSO SET: fldDateJoined

			unset($this->user["fields"]["fldHash"]); //they don't need to know about this bit
			unset($this->user["fields"]["fldDateJoined"]); //they don't need to know about this bit either

			$extra = array();
			$missing = array();
			# ADD VALIDATION FUNCTIONS

			foreach ($uncleanDataArray as $key => $value) {
				$value = API::sanitize($value);
				API::output($key);
				API::output($value);
				switch ($key) {
					case 'fldPassword': $cleanDataArray["fldHash"] = DB::generateHash($value); break; //hash the password using secure blowfish algo, in class.db
					case 'fldPin' :  $cleanDataArray["fldPin"] = $value; break; //won't exist in the actual table, so needs to be specified.
					case 'pkEmail' : if ( $this->alreadyExists($value) ) $this->respondUserAlreadyExists($value); else $cleanDataArray[$key] = $value;
					default:
						if ( array_key_exists ( $key, $this->user["fields"] ) ) $cleanDataArray[$key] = $value; //if its a field that is supposed to exist, clean it and pass it on
						else $extra[]=$key; #else $this->respondSentIncorrectData();
					break;
				}
			}
				##### TODO MAKE SURE MISSING AND EXTRA ARE CORRECT
			$missing = array_diff_key ($cleanDataArray , $this->user["fields"] ); //compare the two arrays, return an array of the difference
			$cleanDataArray["fldDateJoined"] = time(); //get the timestamp for dateJoined
			
			if( !$extra && !$missing ){ #if they have the correct number of fields
				if ( isset($cleanDataArray['fldPin']) ){ // if they gave us a pin to activate, lets activate it. 
					if (!$this->alreadyExists( $cleanDataArray['fldPin'], 'device', 'fkEmail' ) ) { //if its taken alreadyExists gives a 1, else a 0.
							#### TODO alreadyExists didn't work. Make sure mySQL errors appropriatly bubble 
						$this->respondPinAlreadyTaken($cleanDataArray['fldPin']);
						exit; //should already be exited from API::respond
					} else { //if the pin hasn't already been taken
						$this->setDeviceActive($cleanDataArray['fldPin'], $cleanDataArray['pkEmail']);
						unset($cleanDataArray['fldPin']);
						$this->insert($cleanDataArray, $table);
					}
				} else { //don't bother with the pin
					$this->insert($cleanDataArray, $table);
				}
				$this->respondUserCreated($cleanDataArray['pkEmail']); // give them a response that the user has been created
			} else {
				$this->respondSentIncorrectData($extra, $missing); # missing fields or too many fields or alreadyExists
			}
		}

		function setDeviceActive($pin,$email){ //Sets the timestamp for given Pin on tblDevice, called from queryUUID
			##### TODO
			# check if it was already active
			# if it was, respond 409(conflict) 400(badrequest) "Pin200 Already Taken"
			# else --->>>>

			$sql = "UPDATE device SET fkEmail = '".$email."' WHERE pkPin='".$pin."';";

			API::output($sql);

			$this->execSQL($sql);

			$sql = "UPDATE device SET fldLastActivated = CURRENT_TIMESTAMP WHERE pkPin=".$pin.";";
			$this->execSQL($sql);
			//API::output("device.setDeviceActive.post");
			return $this;
		}

		function respondSentIncorrectData($extra=null, $missing=null){
			$response = '';
			if ( !! $extra ) $response .= "The following fields are not accepted: ".implode(", ", array_keys($extra) )." .";
			if ( !! $missing ) $response .= "The following fields are missing: ".implode(", ", array_keys($missing) )." .";
			API::output( array("status"=>"Error", "code"=>"400", "err"=>$response, "location"=>"POST()@user.dao.php") ); //responds and exits
		}

		function respondUserAlreadyExists($email){ //respond that the email that was posted already exists, and therefore can't be created again
			API::output( array("status"=>"Error", "code"=>"409", "err"=>"Selected Email ".$email." Already Exists", "location"=>"POST()@user.dao.php") );	//responds and exits		
		}

		function respondPinAlreadyTaken($pin){
			API::output( array("status"=>"Error", "code"=>"409", "err"=>"Selected Pin ".$pin." Has Already Been Taken", "location"=>"POST()@user.dao.php") );	//responds and exits
		}

		function respondUserCreated($email){
			API::output( array("status"=>"Success - User ".$email." Created", "code"=>"201", "location"=>"POST()@user.dao.php") ); //responds and exits			
		}

		// #######################


		function GET($id=NULL, $field=NULL){ // always comes sani'd
			//echo "i".$id."f".$field;

			if(!is_null($id)){
				if(!is_null($field)){
					#two parameter GET for resource - e.g. GET /api/template/id/field
					dao::respondNotImplemented();
				} else {
					#one parameter GET for resource - e.g. GET /api/template/id
					$id = API::sanitize($id);
					// get /user/email should respond 302 -> found, or 204 no content.
					if ( $this->alreadyExists($id) ) {
						API::output( array("status"=>"Success - User Exists", "code"=>"302", "location"=>"GET(".$id.")@user.dao.php") );
					} else {
						API::output( array("status"=>"Error - User Does Not Exist", "code"=>"404", "location"=>"GET(".$id.")@user.dao.php") );
					}
				}
			} else {
				#zero parameter or generic GET for resource - e.g. GET /api/template
				API::output( array("err"=>"Error - Please Specify A User ID", "code"=>"400", "location"=>"GET(".$id.")@user.dao.php") );
			}
		}

		function POST($postArray=NULL, $id=NULL){
			if( @is_array($postArray) && isset( $postArray["pkEmail"]) ){  //if there is data, and its an array
				$email = $postArray["pkEmail"];
				if (!$this->alreadyExists($email, 'user') ) $this->createUser($postArray['data']);
				else $this->respondUserAlreadyExists( $email );
			} else {
				#zero parameter or generic POST for resource - e.g. POST /api/template
				API::output(array("status"=>"Error", "code"=>"400", "err"=>"No Data Submitted", "location"=>"POST()@user.dao.php")); //issue bad request
			}
		}
	}
?>