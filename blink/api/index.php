<?php session_start(); $_SESSION["debug"]=true; //$_SESSION["debug"]=( (isset($_SERVER["REMOTE_USER"]) && ($_SERVER["REMOTE_USER"]=="cdavenp1") ) || $_SERVER["HTTP_HOST"]=="localhost")? true : false; ?>
<?php # MAIN PAGE FOR BLINK WEBSITE
//#### global requires (model functions)
	require_once('../m/miscFunctions.php'); //includes debug

//### page init variables
	$url=getURL(); //miscFunctions.php: returns an array with info about the url. uvm.edu/~cdavenp1/blink/store/product/bracelet/1 ["root"=".../blink","dir"="store","subdir"=["product","bracelet","1"]]
	$rootLoc = $url["root"]; //used for absolute links aka most html links
	$pageDesc = "Blink Securities - Your life, secured."; //head.php: meta tag, page description

	require_once("../v/head.php");
?>

	<p>Hello! Welcome to the Blink API! Please enter the path to your resource</p>

<?php require_once("../v/foot.php"); ?> 