<?php
	$pageDesc = "TESTPAGE";
	$rootLoc = ((@$_SERVER["HTTPS"])?'https://':'http://').$_SERVER["SERVER_NAME"]."/~cdavenp1/blink";
	//require_once("../v/head.php");
	require_once("m/class.DB.php");
	require_once("m/class.api.php");
	$db = new DB("debug");
	// API::output( $db->queryUUID('1111') ); 

	$json = json_encode(array("data"=>array("fldUsername"=>"tester","fldPassword"=>"password")));
	API::output($json);
	$json = json_decode($json, true);
	API::output($json);

	if (strtolower($_SERVER['REQUEST_METHOD'])=="post"){
		echo "INPOST";
		API::output($_POST); //nothing
		API::output(file_get_contents( 'php://input' )); //html encoded
		$data = json_decode( file_get_contents( 'php://input' ), true );
		API::output($data);
		if (!$data){ 
			API::output("NO DATA DETECTED");
		}
	}
?>