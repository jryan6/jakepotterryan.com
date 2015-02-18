<?php

	// [PHP_SELF] => /~cdavenp1/blink/index.php/cat 
 	// [SCRIPT_NAME] => /~cdavenp1/blink/index.php
	// [REQUEST_URI] => /~cdavenp1/blink/cat 
	// [REQUEST_TIME] => 1384186494

	echo "<section>";

    @debug($_GET["q"]);
	@debug($url);
	@debug($_GET);
	@debug($_SERVER);
	@debug($_REQUEST);
	echo "</section>";

?>