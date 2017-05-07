<?php
	session_start();

			unset($_SESSION['ssmanv']);
			
			$URL = '../quantri.php';
			header("Location: $URL");

	
?>
