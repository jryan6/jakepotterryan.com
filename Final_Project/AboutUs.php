<?php /*

session_start();

// set timeout period in seconds
	$inactive = 900;
// check to see if $_SESSION['timeout'] is set
	if(isset($_SESSION['timeout']) ) {
	$session_life = time() - $_SESSION['timeout'];
	if($session_life > $inactive){
	session_destroy(); 
	header("Location: home.php"); 
	echo("<li class='red'>Your session has expired. Please log back in.");
	}
	}
	$_SESSION['timeout'] = time();
	
//welcome back if logged in
	if(isset($_SESSION['loggedIn'])){
					echo ("Welcome Back.");
				}

ini_set("arg_separator.output", "&");
ini_set("url_rewriter.tags", "a=href,area=href,frame=src,input=src");

		$hostUrl= "webdb.uvm.edu";
		$userName= "jryan6";
		$password= "iepivaej";
		$connectID= mysql_connect($hostUrl, $userName, $password)
			or die ("Sorry, cannot connect to database");
		
		mysql_select_db ("JRYAN6", $connectID)
			or die ("Sorry, unable to select database");
		print "<br/>";

*/?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="author" content="Jake Ryan" />
	<meta name="description" content="The Hookup" />
	<link rel="stylesheet" type="text/css" href="FlyStyle.css" media="screen" />	
	<title>About Us.</title>
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
			<td colspan="3" valign="baseline">
				<h3>About Us.</h3>
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
			<td style= "text-align:center" >
				<p>Welcome to The HookUp, quality apparel out of  Burlington, VT. </p>
				<p>It's simply not just a company, but instead, a <em>culture</em>. Feel free to log in or register if you haven't already. Post on the Hookup page things like public events, music, pictures and anything else that may float your boat.</p>
				<p> The idea behind The HookUp started as merely a place to sell and advertise our clothes to the public. Then, over time, it has evolved into a culture, making it a mecca for anybody living in the Burlington area. The goal is to have a place where people can both shop for clothes <em>and</em> browse through or post events, music and videos. This will create a space focused on sharing culture, but more specifically, the Burlington culture. This will, in turn, generate more publicity for the events, music, videos and The Hookup clothing.</p>
				<p> Enjoy. <br /> <br /></p>
			</td>
		</tr>
	</table>
</body>
</html>