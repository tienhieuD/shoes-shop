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
	<style>
	*{margin:0;padding:0}
	body{    width: 300px;
    /* height: 300px; */
    /* border: 1px solid #000; */
    top: 50%;
    left: 50%;
    transform: translate(-50%,-55%);
    position: absolute;}
	form{}
	
	input{    font-family: segoe ui light;border: none;
    border-bottom: 3px solid;
    width: 100%;
    padding: 10px;
    margin-bottom: 5px;
    outline: none;
    border-color: #E0E0E0;
	    transition: 0.5s;
}
	input:hover{border-color: #009688;}
	
	input[type=submit]{    background: #009688;
    width: 100px;
    color: #FFF;
    border: none;
    text-transform: uppercase;
    left: 50%;
    position: absolute;
    margin-left: -50px;}
	 input[type=submit]:hover{   background: #4DB6AC;}
	div{padding: 10px;
    text-transform: uppercase;
    color: #009688;
    font-family: segoe ui light;
    font-size: 16pt;
    text-align: center;
    padding-bottom: 60px;}
	</style>
</head>
<body>
	<div>Trang Đăng Nhập<div>
	<form method='POST'>
		<input type='text' placeholder='Mã đăng nhập' name='txtMaNV' required='required'/><br/>
		<input type='password' placeholder='Mật khẩu' name='txtMatKhau' required='required'/><br/>
		<input type='submit' value='Login'/>
	</form>
</body>
</html>
