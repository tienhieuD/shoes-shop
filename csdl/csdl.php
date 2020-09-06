<?php
	$con=mysqli_connect("remotemysql.com","YsaajcRdeH","zbEsWNGZvk", "YsaajcRdeH", 3306);
	if (mysqli_connect_errno($con)){
		echo "<br>Không thể kết nối đến CSDL: " . mysqli_connect_error($con);
		echo "<br>Không thể kết nối đến CSDL: Mã lỗi là " . mysqli_connect_errno($con);
	}
	$sql="CREATE DATABASE IF NOT EXISTS `YsaajcRdeH` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;";
	if (mysqli_query($con,$sql)){
		echo "CSDL QLBANGIAY đã được tạo";
		echo "<br/><a href='taobang.php'>Bấm đây để tạo bảng và dữ liệu</a>";
	}else{
		echo "<br>Lỗi khi tạo CSDL: " . mysqli_connect_error($con);
		echo "<br>Lỗi khi tạo CSDL: Mã lỗi là " . mysqli_connect_errno($con);
	}
	
	
?>

