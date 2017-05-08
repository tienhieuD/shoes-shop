<?php session_start(); 
unset($_SESSION['sstaikhoan']);
$URL= "login.php";
		header("Location: $URL");
?>

<!DOCTYPE html>
<html>
<head>
</head>
<body>
	<a href='index.php'>Trở lại trang chủ</a>
</body>

</html>