<?php 
	
	$servername = "duongnguyen1216@gmail.com";
	$username = "sql12266394";
	$password = "umTXf9YMQ3";
	$dbname = "sql12266394";
	
	$conn = mysqli_connect($servername, $username, $password, $dbname, 3306);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	mysqli_set_charset($conn,"utf8");

?>