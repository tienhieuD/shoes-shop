<?php
	//session_start();
	include('../connect.php');
	$shd=$_GET['shd'];
	//form
	$sql="DELETE FROM `dondathang` WHERE `SOHOADON`='$shd'";
	$conn->query($sql);
	$conn->close();
	
	//echo $sql;
	$URL = '../quantri.php#ddh';
	header("Location: $URL");
?>