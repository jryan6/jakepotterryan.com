<?php
	$pageDesc = "TESTPAGE";
	//require_once("../v/head.php");
	require_once("class.api.php");
	// require_once("device.dao.php");
	require_once("user.dao.php");
	$dao = new dao();
	//$dao->respondSentIncorrectData();

	// $postArray = array("data"=>array( "pkEmail"=>"test5@test.com", "fldHash"=>DB::generateHash("testpass"),
	// 							"fldFirstName"=>"George", "fldLastName"=>"Clooney", "fldDateJoined"=>$_SERVER['REQUEST_TIME'],
	// 							"fldSecurityQuestion1"=>"1", "fldSecurityQuestion2"=>"asdfasdf",
	// 							"fldSecurityAnswer1"=>"Noodle", "fldSecurityAnswer2"=>"Georgett", "fldPin"=>1112)
	// 		);


	//	{ "data":{"pkEmail":"test5@test.com", "fldPassword":"hello", "fldFirstName":"George", "fldLastName":"Clooney", "fldSecurityQuestion1":"1", "fldSecurityQuestion2":"asdfasdf", "fldSecurityAnswer1":"Noodle", "fldSecurityAnswer2":"Georgett", "fldPin":1112 } }

	// $dao->createUser($postArray['data']);

	$dao->GET("test6@test.com");

	//API::output( $dao->alreadyExists("georgiest@clooney.com") );
?>