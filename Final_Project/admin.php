<?php

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
		
	//delete functionality
		if ($_GET['delete_id']){
		$id = $_GET['delete_id'];
		
		$success = mysql_query ("DELETE FROM tblUser WHERE pkUserID = $id", $connectID)
			or die ("unable to delete record from database");
			if ($success){
				print "Record Deleted";
			}
		}
		
	if ($_GET['modify_id']){
	$id = $_GET['modify_id'];
		}
	//insert	
		if (($_POST['submitted'])){ //&& (!$_GET['modify_id'])){
					$Posts= ($_POST['Posts']);
					$UserID= ($_POST['UserID']);
					$UserName= ($_POST['UserName']);
					$FName = ($_POST['FName']);
					$LName= ($_POST['LName']);
					$Email= ($_POST['Email']);
					$Zip= ($_POST['Zip']);
					$Pass= ($_POST['Pass']);
					
					mysql_query ("INSERT into tblUser (fName,lName, email, userName, pass, zip) VALUES ('$FName', '$LName', '$Email', '$UserName', '$Pass', '$Zip')",$connectID)
					or die ("unable to insert record into User table");
					
					mysql_query ("INSERT into tblPost (fkuserName) VALUE ('$UserName')", $connectID)
					or die ("unable to insert record into Post table");
					print "Record successfully added";
				}//if
				
	//modify functionality
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
					elseif (($_POST['editSubmitted']) && ($_GET['modify_id'])){
					}
					else{}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="author" content="Jake Ryan" />
	<meta name="description" content="The Hookup" />
	<link rel="stylesheet" type="text/css" href="FlyStyle.css" media="screen" />	
	<title>The HookUp</title>

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
			<td colspan="4">
			<h1>The HookUp</h1>
			</td>
		</tr>
		<tr>
			<td style="text-align:center">
				<h3>Admin.</h3>
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
				<h4>Insert a Record</h4>
				<form method="post" action="https://www.uvm.edu/~jryan6/cs148/Final%20Project/admin.php">
<!--				<label for="category">Category</label>
				
				<select name="category" size="1">
				<option name="none">Select an Option</option>
				<option name="1">Update Record</option>
				<option name="2">Delete Record</option>
				</select>
				<label for="table">Table</label>
				<select name="table" size="1">
				<option name="none">Select a Table to Modify</option>
				<option name="3">Posts</option>
				<option name="4">Users</option>
				</select>-->
				<fieldset>
				<label for="UserID">User ID</label>
				<input name="UserID" type="text" size="30" id="UserID" value="" />
				
				<label for="UserName">Username</label>
				<input name="UserName" type="text" size="30" id="UserName" value="" />
				
				<label for="FName">First Name</label>
				<input name="FName" type="text" size="30" id="FName" value="" />
			
				<label for="LName">Last Name</label>
				<input name="LName" type="text" size="30" id="LName" value="" />
				
				<label for="Email">Email Address</label>
				<input name="Email" type="text" size="30" id="Email" value="" />
				
				<label for="Zip">Zip Code</label>
				<input name="Zip" type="text" size="30" id="Zip" value="" />
				
				<label for="Pass">Password</label>
				<input name="Pass" type="password" size="30" id="Pass" value="" />
				
				<input type="submit" value="Submit" name="submitted" />
				</fieldset>
				</form>
				</div>
			<?php
				
				//*******************
					
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
					//edit + delete links
						$id=$row['pkUserID'];
						
						print '<td><a href="https://www.uvm.edu/~jryan6/cs148/Final%20Project/modify.php?modify_id='.$id.'">Edit</td>';
						print '<td><a href="';
						print ($_SERVER['PHP_SELF']);
						print '?delete_id='.$id.'">Delete</a></td>';
												
						print '</tr>'."\n"; 
					}
					print '</table>'."\n";
				?>
			</td>
			<td>
				<div>
				<h4>Modify a Record</h4>
				<form method="post" action="https://www.uvm.edu/~jryan6/cs148/Final%20Project/admin.php">
				<fieldset>
				<label for="UserID">User ID</label>
				<input name="UserID" type="text" size="30" id="UserID" value="<?php print $record_data['pkUserID']; ?>" />
				
				<label for="UserName">Username</label>
				<input name="UserName" type="text" size="30" id="UserName" value="<?php print $record_data['userName']; ?>" />
				
				<label for="FName">First Name</label>
				<input name="FName" type="text" size="30" id="FName" value="<?php print $record_data['fName']; ?>" />
			
				<label for="LName">Last Name</label>
				<input name="LName" type="text" size="30" id="LName" value="<?php print $record_data['lName']; ?>" />
				
				<label for="Email">Email Address</label>
				<input name="Email" type="text" size="30" id="Email" value="<?php print $record_data['email']; ?>" />
				
				<input type="submit" value="Submit" name="editSubmitted" />
				</fieldset>
				</form>
				</div>
			</td>
		</tr>
	</table>
</body>
</html>