<?php
	// include("connect.php");
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbName = "3278a2";
	 
	// create connection
	$con = new mysqli($servername,$username,$password,$dbName);
	 
	// check connection
	if ($con->connect_error) {
		die("Fail to connect: " . $conn->connect_error);
	} 

?>
