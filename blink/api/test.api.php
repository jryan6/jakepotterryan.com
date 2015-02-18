<?php
	$pageDesc = "TESTPAGE";
	//require_once("../v/head.php");
	require_once("m/class.api.php");
	$api = new API();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="author" content="Fritz Davenport">
		<meta name="description" content=<?php echo '"'.$pageDesc.'"' ?> >
		<title>Blink Securities</title> 
	</head>
	<body>
	<section>
<?php 		$api->printServer;
?>
	</section>

<?php require_once("../v/foot.php"); ?>