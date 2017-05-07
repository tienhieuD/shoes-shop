<?php 
	session_start();
	include('../connect.php');
	$makh;
	$dsSP;
	$dsSL;
	
	if (strlen($_GET['dsSP'])<1) {
		$URL="../404.php";
		header("Location: $URL");
		exit();
	}
	
	if (isset($_GET['makh']))
	{
		$makh		=$_GET['makh'];
		$dsSP		=$_GET['dsSP'];
		$dsSL		=$_GET['dsSL'];
		
		$sql1 = "select * from khachhang where MAKHACHHANG = '$makh'";
		$kq = $conn->query($sql1);
		
		$tenkh = "";
		$diachi = "";
		$dienthoai = "";
		$ghichu = "";
		$makhach = "";
		$email = "";
		
		if ($kq->num_rows > 0)
		{
			$row = $kq->fetch_assoc();
			$tenkh = $_GET['tenkh'];
			$diachi = $_GET['diachi'];
			$dienthoai = $_GET['dienthoai'];
			$ghichu = $_GET['ghichu'];
			$makhach = $row['MAKHACHHANG'];
			$email = $row['EMAIL'];
		}

		$sql_themHD = "
		INSERT INTO `dondathang`
		(`MAKHACHHANG`, `NGAYDATHANG`, `NOIGIAOHANG` , DSMATHANG, DSSOLUONG) 
		VALUES 
		('$makh', CURRENT_TIMESTAMP(),'$diachi ', '$dsSP', '$dsSL')";
		
		$sql_xoaCart = "DELETE FROM `giohang` WHERE MAKHACHHANG = '$makh' ";
		
		$conn->query($sql_themHD);
		$conn->query($sql_xoaCart);
		
		$makh2=$makh * 12 - 01 + 1996;
		$URL="../hoadon.php?12011996=$makh2";
		header("Location: $URL");
	}
?>