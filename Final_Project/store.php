<!-- 

session_start();

// set timeout period in seconds
	$inactive = 900;
// check to see if $_SESSION['timeout'] is set
	if(isset($_SESSION['timeout']) ) {
	$session_life = time() - $_SESSION['timeout'];
	if($session_life > $inactive)
	{ session_destroy(); header("Location: home.php"); 
	echo("<li style='color: #ff6666'>Your session has expired. Please log back in.");
	}
	}
	$_SESSION['timeout'] = time();

if(isset($_SESSION['loggedIn'])){
		echo ("Welcome Back.");
	}

if ($_POST['submitted']) {
	}
		$hostUrl= "webdb.uvm.edu";
		$userName= "jryan6";
		$password= "iepivaej";
		$connectID= mysql_connect($hostUrl, $userName, $password)
			or die ("Sorry, cannot connect to database");
		
		mysql_select_db ("JRYAN6", $connectID)
			or die ("Sorry, unable to select database");
		print "<br/>";

?>
-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="author" content="Jake Ryan" />
	<meta name="description" content="The Hookup" />
	<link rel="stylesheet" type="text/css" href="FlyStyle.css" media="screen" />	
	<title>The Store.</title>
</head>

<body>
	<table width="100%" border="0">
        <tr>
			<td>
                <h1>
                    HFH Apparel
                </h1>
                <h5>
                    Burlington, VT
                </h5>
            </td>
        </tr>
		<tr>
			<td>
				<h3>Store.</h3>
			</td>
		</tr>
		<tr valign="top">
			<td style="width:100px; text-align:top;">
				<ul id="navigationMenu">
				<li>
					<a class="home" href="home.php">
						<span>Home</span>
					</a>
				</li>
				<li>
					<a class="about" href="AboutUs.php">
						<span>About Us</span>
					</a>
				</li>
				<li>
					 <a class="hookup" href="theHookup.php">
						<span>The HookUp</span>
					 </a>
				</li>
				<li>
					<a class="store" href="store.php">
						<span>Store</span>
					</a>
				</li>
				</ul>
			</td>
			<td>
			</td>
			<td>
				<table class="apparel">
					<tr>
						<td style="width: 300px; height:400px; background:url('HFH1.jpg') no-repeat; border:solid 1px #82EFEC;">					
						</td>
						<td>
							<div>The Tanktop.
							<br />
							<br />
							$25
							</div>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>
