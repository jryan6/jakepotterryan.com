<!DOCTYPE html>
<html lang="en">
	<head>
		<?php if (@$redirectURL) print '<meta http-equiv="REFRESH" content="0;url="'.$redirectURL.'">'; ?>
		<meta charset="utf-8">
		<meta name="author" content="Jake P. Ryan">
		<meta name="description" content=<?php echo '"'.$pageDesc.'"' ?> >
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<title>Blink Securities</title> 
		<script src="http://code.jquery.com/jquery-git.js" type="text/javascript"></script>
        <script src="blink/js/bootstrap.min.js"></script>
		<script src="blink/js/mainPage.js" type="text/javascript"></script>
        <script src="blink/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="blink/js/bootstrap-select.min.js" type="text/javascript"></script>
		<?php
			$url=explode("/", $_SERVER["REQUEST_URI"]);
			if (end($url)=="connect"||"otherurlwithcode") echo "<script src='https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js?skin=sunburst'></script>";
		?>
		<!-- conditional script statement -->
        <link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
        <link href="blink/bootstrap.min.css" rel="stylesheet">
        <link href="blink/bootstrap-select.css" rel="stylesheet">
        <link rel="stylesheet" href="blink/style.css" type="text/css" media="screen">
        <link rel="shortcut icon" href="blink/images/favicon.ico" type="image/x-icon">
		<link rel="icon" href=<?php echo '"'.$rootLoc.'/images/favicon.ico"'; ?> type="image/x-icon">
		<!--[if lt IE 9]> 
			<script src="//html5shim.googlecode.com/sin/trunk/html5.js"></script>
		<![endif] --> <!-- cond. comment - HTML5 shim for older browsers -->
	</head>
	<body>