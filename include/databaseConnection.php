<?php
	$server_name="localhost";
	$username="root";
	$password="";
	$db_name = "pos";

	$conn = new mysqli($server_name,$username,$password,$db_name);

	if($conn->connect_error){
		die("Failed to connect, ". $conn->connect_error);
	}
	date_default_timezone_set('Africa/Dar_es_Salaam');
	// error_reporting(0);

?>
