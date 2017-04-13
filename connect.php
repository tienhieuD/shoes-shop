<?php 
	
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "qlbangiay";
	
	$conn = mysqli_connect($servername, $username, $password, $dbname, 3306);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	mysqli_set_charset($conn,"utf8");
?>