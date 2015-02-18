

<?php //if ($_POST['submitted']) {

//session_start();
/*
// set timeout period in seconds
	$inactive = 900;
// check to see if $_SESSION['timeout'] is set
	if(isset($_SESSION['timeout']) ) {
	$session_life = time() - $_SESSION['timeout'];
	if($session_life > $inactive)
	{ session_destroy(); header("Location: home.php"); 
	print("<li class='red'>Your session has expired. Please log back in.");
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

	//link to admin page
	//print ("<a href='admin.php'>Back to the admin page</a>");
*/?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="author" content="Jake Ryan" />
	<meta name="description" content="HFH Apparel" />
	<link rel="stylesheet" type="text/css" href="FlyStyle.css" media="screen" />	
	<title>HFH Apparel</title>

</head>
<body>
<?php
//**********************
	//initialize varbls
		$first_name="";
		$last_name="";
		$email_address="";
		$pkUsername="";
		$Password="";
		$Zip="";
		//log in
		$existUsername="";
		$existPass="";

//validate entered info-log in
		if (isset($_POST['loginsubmitted']))
			{
			$existUsername= ($_POST['ExistUsername']);
			$existPass= ($_POST['ExistPass']);
	
	//remove quotes
			$existUsername= htmlentities($existUsername, ENT_QUOTES);
			$existPass= htmlentities($existPass, ENT_QUOTES);
	//check if username exists
			$check = mysql_query("SELECT * FROM tblUser WHERE userName = '".$_POST['ExistUsername']."'")or die(mysql_error	());
			$check2 = mysql_num_rows($check);
	
			if ($check2 == 0) {
	
			echo("<li class= 'red'>That user does not exist in our database. Please try again or register.");
			}
	//**********check if password exists**************************************************************
			 while($info = mysql_fetch_array( $check )) 	
			 {
			 $check3 = mysql_query("SELECT * FROM tblUser WHERE pass = '".$_POST['ExistPass']."'")or die(mysql_error());
			  $check4 = mysql_num_rows($check3);
			  
		//session starts if password matches the database
			  if ($check4 != 0){
				$_SESSION['loggedIn'] = "true";
				
				 $admin="Admin";
				
				if($_POST['ExistUsername'] == $admin){
						print ("Welcome Back, Admin. <br/><a href='admin.php'>Please continue to the admin page</a>.");
					}
				
				elseif(isset($_SESSION['loggedIn'])){
					echo ("Welcome Back, $existUsername .");
				}
				//if
			  
			  else {
			  	echo("<li class='red'>Incorrect password, please try again.");
			  }
			  }
			}//while
	//if fields empty	
		$errorMsg= array();
			if ($existUsername==""){
				$errorMsg[]="Please enter your existing Username";
			}
			
			if ($existPass==""){
				$errorMsg[]="Please enter your password";
			}
			
	//display errors in errorMsg array	
		if($errorMsg){
			foreach($errorMsg as $err){
				echo "<li class='red'>" . $err . "</li>\n";
				}
			}

		}//if statement login submitted
			
//validate entered info- register
		if (isset($_POST['submitted']))
			{
			$first_name= ($_POST['firstName']);
			$last_name= ($_POST['lastName']);
			$email_address= ($_POST['email']);
			$pkUsername= ($_POST['Username']);
			$Password= ($_POST['Pass']);
			$Zip= ($_POST['zip']);
		
	//remove quotes
			$first_name= htmlentities($first_name, ENT_QUOTES);
			$last_name= htmlentities($last_name, ENT_QUOTES);
			$email_address= htmlentities($email_address, ENT_QUOTES);
			$pkUsername= htmlentities($pkUsername,ENT_QUOTES);
			$Password= htmlentities($Password, ENT_QUOTES);
			$Zip= htmlentities($Zip, ENT_QUOTES);
			
	//error messages- stored in array, displayed if field empty
			$errorMsg= array();
				if($first_name==""){
					$errorMsg[]="Please enter your First Name";
				}
				if($last_name==""){
					$errorMsg[]="Please enter your Last Name";
				} 
				if($pkUsername==""){
					$errorMsg[]="Please enter your desired Username";
				}
				if($Password==""){
					$errorMsg[]="Please enter your desired password";
				}
				if($Zip==""){
					$errorMsg[]="Please enter your zip code";
				}

	//email verification		
			function verifyEmail ($testString) { 
					return (preg_match("/^([[:alnum:]]|_|\.|-)+@([[:alnum:]]|\.|-)+(\.)([a-z]{2,4})$/", $testString));
				}
				
				if($email_address==""){
					$errorMsg[]="Please enter your Email Address";
				} elseif (!verifyEmail($email_address)){
					$errorMsg[]="Email must be in a valid format (e.g. john@yahoo.com )";
				}
	//display errors in errorMsg array	
			if($errorMsg){
				foreach($errorMsg as $err){
					echo "<li class='red'>" . $err . "</li>\n";
					}
				}
			//if no errors found insert into database
					else{
						mysql_query ("INSERT into tblUser (fName,lName, email, userName, pass, zip) VALUES ('$first_name', '$last_name', '$email_address', '$pkUsername', '$Password', '$Zip')",$connectID) 
				or die ("<li class='red'>*We're sorry, the username you have chosen is already in use, <br/>please press back and try another.");
				
						mysql_query("INSERT into tblPost (fkuserName) VALUE ('$pkUsername')", $connectID)
						or die("<li class='red'>*We're sorry, failed to insert fk <br/>please press back and try another.");
				
				echo"<li class='green'>Thanks For Registering.<br/> Check your email for a confirmation.";
						
					//send email with first, last names, username and pass contained.
					$destination_email= $email_address;
					$email_subject= "Thanks For Registering with The HookUp!";
					$email_body= "Here is your info, $first_name. Be sure to save your password somewhere safe. \n\nUsername: $pkUsername\nPassword: *$Password\n";
					//send the email
					mail ($destination_email, $email_subject, $email_body);
					
					}//else
				}//original if statement
?>
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
            <td colspan="2" class="notice">
                <p style="color:grey;">**Note: this site is old and the sql database previously used has been closed. The PHP still works, but only to a certain extent, merely to represent a sample.</p>
            </td>
        </tr>
		<tr>
			<td valign="baseline" style="text-align:center;">
				<h3>Home.</h3>
			</td>
		</tr>
		<tr valign="top">
			<td style="width:180px; text-align:top;">
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
			<td style="text-align:left; width:300px">
				<div>
				<form action="http://www.jakepotterryan.com/Final_Project/home.php" method="post">
				<fieldset>
				<legend><span class="style1">Log In</span></legend>
				<label for="ExistUsername">Username</label><br />
					<input name="ExistUsername" type="text" id="ExistUsername" size="20" maxlength="20"/>
				<br />
				<label for="ExistPass">Password</label><br/>
					<input type="password" name="ExistPass" id="ExistPass" size="15" maxlength="15"/>
				<br />
				<br />
				<input name="loginsubmitted" type="submit" value="Submit" />
				</fieldset>
				</form>
				</div>
			</td>
			<td style="text-align:left; width:300px">
				<form action="http://www.jakepotterryan.com/Final_Project/home.php" method="post">
				<fieldset>
				<legend><span class="style1">Register</span></legend>
					<label for="firstName"></label>
					First Name <br />
					<input type="text" name="firstName" id="firstName" size="20" maxlength="32" />
					<br />
					
					<label for="lastName"></label>
					Last Name <br />
					<input type="text" name="lastName" id="lastName" size="20" maxlength="32"/>
					<br />
				
					<label for="Username">Desired Username</label><br />
					<input type="text" name="Username" id="Username" value="&lt; 20 characters" size="20" maxlength="20"/>
					<br />
				
					<label for="Pass">Password</label><br/>
					<input type="password" size="15" maxlength="15" id="Pass" name="Pass"/>
					<br />
				
					<label for="email">Email Address </label><br/>
					<input type="text" name="email" id="email" value="eg: John.Smithers@aol.com" size="35" maxlength="35"/>
					<br />
					
					<label for="zip">Zip Code </label><br/>
					<input type="text" id="zip" size="6" maxlength="10" name="zip"/>
					<br />
					<br />	
					<input name="submitted" type="submit" value="Submit" />
				</fieldset>
				</form> 
			</td>
		</tr>
	</table>
</body>
</html>