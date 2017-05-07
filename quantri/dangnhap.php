<?php
	session_start();
	require('../connect.php');
	
	if (isset($_POST['txtMaNV']))
	{
		$mnv = $_POST['txtMaNV'];
		$mk  = $_POST['txtMatKhau'];
		$sql = "SELECT * FROM NHANVIEN
				WHERE MANHANVIEN = '$mnv'
				AND MATKHAU = '$mk' ";
		echo "Sai thông tin đăng nhập";
		
		$kq = $conn->query($sql);
		if ($kq->num_rows > 0) {
			$_SESSION['ssmanv'] = $mnv;
			
			$URL = '../quantri.php';
			header("Location: $URL");
		}
	}
	
?>
<!DOCTYPE html>
<html>
<head>	
</head>
<body>
	<div>Trang Đăng Nhập<div>
	<form method='POST'>
		<input type='text' name='txtMaNV' required='required'/><br/>
		<input type='password' name='txtMatKhau' required='required'/><br/>
		<input type='submit' value='Login'/>
	</form>
</body>
</html>
