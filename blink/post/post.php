<?
include("/usr/local/uvm-inc/atetreau.inc");

/* //////////////// single post var ////////////// */
/*if( ($_SERVER['REQUEST_METHOD'] == 'POST') ) { 
	
	$name = $_POST['name']; // getting post data from regular post array
	
	$sql = "INSERT INTO tblInfo VALUES('".$name."','')";
	$data = mysql_query($sql,$dbh) or die("MySQL error: ".mysql_errno() ." : ".mysql_error());
}

$sql = "SELECT * FROM tblInfo";
$data = mysql_query($sql,$dbh) or die("MySQL error: ".mysql_errno() ." : ".mysql_error());

while($row = mysql_fetch_row($data)){
	$userList[] = $row[0];
}

$html = "";

if($userList) {
	foreach($userList as $user) { // check if user is already registered
		$html .= "<p>".$user."</p>";
	}
}

echo $html;*/
/* /////////////////// /////////////////// */

if( ($_SERVER['REQUEST_METHOD'] == 'POST') ) {
	$jsonInput = file_get_contents('php://input');
	$jsonArray = json_decode( $jsonInput, TRUE );
	
	/*$sql = "INSERT INTO tblInfo VALUES ('".$jsonArray["fldFirstName"]."','".$jsonArray["fldLastName"]."','".$jsonArray["fldSecurityQuestion1"]."','".$jsonArray["fldSecurityAnswer1"]."','')";
	if( mysql_query( $sql, $dbh ) ) {
		header('HTTP/1.1 201 Created');//, true, 201);
	} else {
		error_log("MySQL error: ".mysql_errno() ." : ".mysql_error());
		header('HTTP/1.1 500 Internal Server Error');//, true, 500);
	}*/
	header('HTTP/1.1 200 OK');//, true, 201);
}
?>