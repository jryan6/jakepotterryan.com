<?php
	$pageDesc = "TESTPAGE";
	$rootLoc = ((@$_SERVER["HTTPS"])?'https://':'http://').$_SERVER["SERVER_NAME"]."/~cdavenp1/blink";
	//require_once("../v/head.php");
	require_once("class.DB.php");
	require_once("class.api.php");
	//DB::generateSQL( array("tablename"=>"test", "fields"=>array("id"=>"int AUTO_INCREMENT PRIMARY KEY", "lchaim"=>"technobeat"), "options"=>"AUTO_INCREMENT=1111") );
	//$db = new DB();
	// API::output( $db->queryUUID('1111') ); 
	API::output("TESTING ENCRYPTION FUNCTIONS");
	$hash =  DB::generateHash("thisisapass");
	$hash2 =  DB::generateHash("thisisapass");
	API::output($hash); //two separate hashes for the same password
	API::output($hash2);
	API::output( DB::verify("thisisapess", $hash2) ); //returns false
	API::output( DB::verify("thisisapass", $hash2) ); //returns true
	API::output( DB::verify("thisisapass", "$2y$11$24346b9408b3d1e3c7058u4l/Ulb2kYUBeiRteQSq8SNm.rfCcpKC") ); //testing previously computed hash
?>