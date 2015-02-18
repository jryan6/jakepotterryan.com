<?php
	require('class.DB.php');
	class dao extends DB {

		//specific SQL sub-methods required for getting or submitting go here
 		function setDeviceActive($pin){ //Sets the timestamp for given Pin on tblDevice, called from queryUUID
			$pin=API::sanitize($pin);
			//API::output("device.setDeviceActive.pre");
			$sql = "UPDATE device SET fldLastActivated = CURRENT_TIMESTAMP WHERE pkPin=".$pin.";";
			$this->execSQL($sql);
			//API::output("device.setDeviceActive.post");
			return $this;
		}


		function queryUUID($pin){ //Retrieves UUID from tblDevice for a given Pin, received via the api
			$pin=API::sanitize($pin);
			$sql="SELECT fldUUID FROM device WHERE pkPin='".$pin."';";
			//API::output($sql);
			$result=$this->querySQL($sql);
			$result=$result->fetch(PDO::FETCH_ASSOC);
			if (!$result) API::output( array("status"=>"Error", "code"=>"404", "err"=>"Resource Not Found", "location"=>"queryUUID@device.dao.php") ); //if result returns an empty set
			else {
				//$this->setDeviceActive($pin);
				API::output(array("status"=>"Success", "code"=>"302", "data"=>array("UUID"=>$result['fldUUID']), "location"=>"GET(".$pin.")@device.dao.php") ); exit();
			}
			return $result['fldUUID'];
		}
		// #######################

		//specific SQL sub-methods required for getting or submitting go here, example - 
		function GET($id=NULL, $field=NULL){
			if(!is_null($id)){
				if(!is_null($field)){
					#two parameter GET for resource - e.g. GET /api/template/id/field
					API::output( array("status"=>"Error", "code"=>"501", "err"=>"Not Implemented", "location"=>"GET(".$id.",".$field.")@device.dao.php") ); //issue bad request
				} else {
					#one parameter GET for resource - e.g. GET /api/template/id
					if (ctype_digit($id)){ #check for numbers only in PIN
						// API::output("device.get.1.numeric");
						//$this->setDeviceActive($id);

						// API::output("device.get.2.numeric");
						$uuid=$this->queryUUID($id);
						//API::output($uuid);
					} else {
						API::output(array("status"=>"Error", "code"=>"400", "err"=>"Non Numeric", "location"=>"GET(".$id.")@device.dao.php") ); //issue bad request
					}
					
				}
			} else {
				#zero parameter or generic GET for resource - e.g. GET /api/template
				API::output(array("status"=>"Error", "code"=>"501", "err"=>"Not Implemented", "location"=>"GET()@device.dao.php")); //issue bad request
			}
		}
	}
?>