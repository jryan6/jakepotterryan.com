<?php
	require('class.DB.php');
	class dao extends DB {

		//specific SQL sub-methods required for getting or submitting go here, example - 
		// function insertUser();
		// function getName();
		// function updateCredentials();
		// #######################

		function GET($id=NULL, $field=NULL){
			if(!is_null($id)){
				if(!is_null($field)){
					#two parameter POST for resource - e.g. POST /api/template/id/field
					API::output(array("status"=>"Error", "code"=>"501", "err"=>"Not Implemented", "location"=>"GET(".$id.",".$field.")@device.dao.php")); //issue bad request
				} else {
					#one parameter POST for resource - e.g. POST /api/template/id
					API::output(array("status"=>"Error", "code"=>"501", "err"=>"Not Implemented", "location"=>"GET(".$id.")@device.dao.php")); //issue bad request
				}
			} else {
				#zero parameter or generic POST for resource - e.g. POST /api/template
				API::output(array("status"=>"Error", "code"=>"501", "err"=>"Not Implemented", "location"=>"GET()@device.dao.php")); //issue bad request
			}
		}

		function POST($id=NULL, $field=NULL){
			if(!is_null($id)){
				if(!is_null($field)){
					#two parameter POST for resource - e.g. POST /api/template/id/field
					API::output(array("status"=>"Error", "code"=>"501", "err"=>"Not Implemented", "location"=>"POST(".$id.",".$field.")@device.dao.php")); //issue bad request
				} else {
					#one parameter POST for resource - e.g. POST /api/template/id
					API::output(array("status"=>"Error", "code"=>"501", "err"=>"Not Implemented", "location"=>"POST(".$id.")@device.dao.php")); //issue bad request
				}
			} else {
				#zero parameter or generic POST for resource - e.g. POST /api/template
				API::output(array("status"=>"Error", "code"=>"501", "err"=>"Not Implemented", "location"=>"POST()@device.dao.php")); //issue bad request
			}
		}

		function PUT($id=NULL, $field=NULL){
			if(!is_null($id)){
				if(!is_null($field)){
					#two parameter POST for resource - e.g. POST /api/template/id/field
					API::output(array("status"=>"Error", "code"=>"501", "err"=>"Not Implemented", "location"=>"PUT(".$id.",".$field.")@device.dao.php")); //issue bad request
				} else {
					#one parameter POST for resource - e.g. POST /api/template/id
					API::output(array("status"=>"Error", "code"=>"501", "err"=>"Not Implemented", "location"=>"PUT(".$id.")@device.dao.php")); //issue bad request
				}
			} else {
				#zero parameter or generic POST for resource - e.g. POST /api/template
				API::output(array("status"=>"Error", "code"=>"501", "err"=>"Not Implemented", "location"=>"PUT()@device.dao.php")); //issue bad request
			}
		}

		function DELETE($id=NULL, $field=NULL){
			if(!is_null($id)){
				if(!is_null($field)){
					#two parameter POST for resource - e.g. POST /api/template/id/field
					API::output(array("status"=>"Error", "code"=>"501", "err"=>"Not Implemented", "location"=>"DELETE(".$id.",".$field.")@device.dao.php")); //issue bad request
				} else {
					#one parameter POST for resource - e.g. POST /api/template/id
					API::output(array("status"=>"Error", "code"=>"501", "err"=>"Not Implemented", "location"=>"DELETE(".$id.")@device.dao.php")); //issue bad request
				}
			} else {
				#zero parameter or generic POST for resource - e.g. POST /api/template
				API::output(array("status"=>"Error", "code"=>"501", "err"=>"Not Implemented", "location"=>"DELETE()@device.dao.php")); //issue bad request
			}
		}
	}
?>