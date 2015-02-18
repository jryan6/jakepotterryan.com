<?php session_start(); $_SESSION["debug"]=true; //$_SESSION["debug"]=( (isset($_SERVER["REMOTE_USER"]) && ($_SERVER["REMOTE_USER"]=="cdavenp1") ) || $_SERVER["HTTP_HOST"]=="localhost")? true : false; ?>
<?php # MEMBERS PAGE FOR BLINK WEBSITE

//#### global requires (model functions)
	require_once('m/miscFunctions.php'); //includes debug
	include('m/blinkDB.php'); //sqlDB object, wrapper for db connection, inserts, and queries. new mysqlDB

//#### page variables
	$rootLoc = getURL($_SERVER["PHP_SELF"], "members"); //gets the current URL excluding the current page and the directory in quotes
	$pageDesc = "Blink Securities - Your life, secured.";

 // main functionality
	


	require_once('../v/head.php'); # head, requires $pageDesc (for meta tag), $rootLoc(uvm.edu/~netid/whatever)
	require_once('v/header.php'); #header, includes logo. Put nav bar here later
	?> <section> <?php

	$db = new mysqlDB();

	if ( $_GET){
		debug($_GET); 
		$db->insert(); 
	}

	?> </section> <?php



	require_once('v/test.php');
	require_once('../v/foot.php');

?>