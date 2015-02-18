<?php 

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
	
	//link to admin page
	print ("<a href='admin.php'>Back to the admin page</a>");
	
	//if modify
		if (($_POST['editSubmitted']) && (!$_GET['modify_id'])){
					
						$id = ($_GET['modify_id']);
						
						$Posts= ($_POST['Posts']);
						$UserID= ($_POST['UserID']);
						$UserName= ($_POST['UserName']);
						$FName = ($_POST['FName']);
						$LName= ($_POST['LName']);
						$Email= ($_POST['Email']);
						
						$success= mysql_query ("UPDATE tblUser SET pkUserID = '$UserID', userName = '$UserName', fName = '$FName', lName = 'LName', email = '$Email' WHERE pkUserID = '$id'", $connectID);
							if ($success){
							//	header ('Location: https://www.uvm.edu/~jryan6/cs148/Final%20Project/modify.php?updated=1');
								print ("Successfully Updated");
							}
					}//if
//					mysql_query ("INSERT into tblUser (pkUserID, fname, lname, userName, email) VALUES ('$UserID', '$FName',// '$LName', '$UserName', '$Email')", $connectID)
//					or die ("unable to insert record into database");
//					print "Record successfully added";
		
					if ((!$_POST['editSubmitted']) && ($_GET['modify_id'])){
				
					$id = ($_GET['modify_id']);
					
					$Posts= ($_POST['Posts']);
					$UserID= ($_POST['UserID']);
					$UserName= ($_POST['UserName']);
					$FName = ($_POST['FName']);
					$LName= ($_POST['LName']);
					$Email= ($_POST['Email']);
						
						$this_Record = mysql_query("SELECT tblUser.pkUserID, tblUser.userName, tblUser.fName, tblUser.lName, tblUser.email, tblPost.post AS pkUserID FROM tblUser, tblPost WHERE tblUser.pkUserID = tblPost.fkuserName AND tblUser.pkUserID = '$id'", $connectID)
					or die ("cannot read the record");
					//while ($record_data = mysql_fetch_array($myResult, MYSQL_ASSOC)){
//							foreach ($record_data as $key => $value){
//								print "$key => $value<br />";
//							}
//						}
					}
					if (($_POST['editSubmitted']) && ($_GET['modify_id'])){
					
						$id = ($_GET['modify_id']);
						
						$Posts= ($_POST['Posts']);
						$UserID= ($_POST['UserID']);
						$UserName= ($_POST['UserName']);
						$FName = ($_POST['FName']);
						$LName= ($_POST['LName']);
						$Email= ($_POST['Email']);
						
						$success= mysql_query ("UPDATE tblUser SET pkUserID = '$UserID', userName = '$UserName', fName = '$FName', lName = 'LName', email = '$Email' WHERE pkUserID = '$id'", $connectID);
							if ($success){
								print ("Successfully Updated");
							}
					}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="author" content="Jake Ryan" />
	<meta name="description" content="The Hookup" />
	<link rel="stylesheet" type="text/css" href="FlyStyle.css" media="screen" />	
	<title>Modify Record</title>
	
	<style type="text/css">
	<!--
	label {display:block; margin:8px o 2px o;}
	a{display:block; color:#FFFFFF; margin:3px o 10px;}
	input[type="submit"] {display:block; margin-top:8px;}
	-->
	</style>
</head>

<body>
	<table width="100%" border="0">
		<tr>
			<td colspan="3">
			<h1>The HookUp</h1>
			</td>
		</tr>
		<tr>
			<td style="text-align:center">
				<h3>Modify</h3>
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
				<div>
				<h4>Modify a Record</h4>
				<form method="post" action="https://www.uvm.edu/~jryan6/cs148/Final%20Project/modify.php">
				<fieldset>
				<label for="UserID">User ID</label>
				<input name="UserID" type="text" size="30" id="UserID" value="<?php print $record_data['$UserID']; ?>" />
				
				<label for="UserName">Username</label>
				<input name="UserName" type="text" size="30" id="UserName" value="<?php print $record_data['$UserName']; ?>" />
				
				<label for="FName">First Name</label>
				<input name="FName" type="text" size="30" id="FName" value="<?php print $record_data['$FName']; ?>" />
			
				<label for="LName">Last Name</label>
				<input name="LName" type="text" size="30" id="LName" value="<?php print $record_data['$LName']; ?>" />
				
				<label for="Email">Email Address</label>
				<input name="Email" type="text" size="30" id="Email" value="<?php print $record_data['$Email']; ?>" />
				
				<input type="submit" value="Submit" name="editSubmitted" />
				</fieldset>
				</form>
				</div>
				<?php
					
					$myResult= mysql_query('SELECT tblUser.*, tblPost.* FROM tblUser, tblPost WHERE tblUser.userName=tblPost.fkuserName ORDER BY tblUser.pkUserID', $connectID)
						or die ("Unable to select users from database");
						 print "<table class='records'>"."\n";
						 print '<tr>'."\n";
						print '<td><p>User ID</p></td>';
						print '<td><p>Username</p></td>';
						print '<td><p>Date Joined</p></td>';
					
					while ($row = mysql_fetch_array($myResult, MYSQL_ASSOC)){

						print '<tr>'."\n";
						print '<td>'.$row['pkUserID'].'</td>'."\n";
						print '<td>'.$row['userName'].'</td>'."\n";
						//print '<td>'.$row['fname'].'</td>'."\n";
						//print '<td>'.$row['lname'].'</td>'."\n";
						print '<td>'.$row['dateJoined'].'</td>'."\n";
						
					//	print '<td><a href="'.$row[''].'" >'.$row[''];
						print'</a></td>';
					}
				?>
			</td>
		</tr>
	</table>
</body>
</html>
<?php mysql_close($connectID); ?>