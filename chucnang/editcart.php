<?php 
	session_start();
	include('../connect.php');
	$makh;
	$masanpham;
	$soluongmua;
	$size;
	
	if (isset($_GET['makh']))
	{
		$makh		=$_GET['makh'];
		$masanpham	=$_GET['masanpham'];
		$soluongmua	=$_GET['soluongmua'];
		$size		=$_GET['size'];
		
		$sql = "UPDATE `giohang` 
				SET 
					`SOLUONG`='$soluongmua'
				WHERE 
					`MAKHACHHANG`='$makh' AND
					`MAHANG`='$masanpham' AND
					`SIZE`='$size' AND
					`DATHANHTOAN`='0'";
					
		$conn->query($sql);
		
		echo $sql;
		
		$URL="../site_cart.php";
		header("Location: $URL");
	}

	/* if (isset($_GET['masanpham'])
		&&isset($_GET['soluongmua'])
		&&isset($_GET['size']))
	{
		//Trường hợp đã đăng nhập
		if (isset($_SESSION['sstaikhoan']))
		{
			$email = $_SESSION['sstaikhoan'];
			$sql_lay_ma_kh = "SELECT * FROM KHACHHANG WHERE email = '$email'";
			
			$kq = $conn->query($sql_lay_ma_kh);
			if ($kq->num_rows > 0) {
				$r = $kq->fetch_assoc();
				$makh = $r['MAKHACHHANG'];
				$masp = $_GET['masanpham'];
				$solg = $_GET['soluongmua'];
				$size = $_GET['size'];
				
				$sql_them_vao_cart = "INSERT INTO `giohang`
									(`MAKHACHHANG`, `MAHANG`, `SIZE`, `SOLUONG`, `DATHANHTOAN`) 
									VALUES 
									('$makh','$masp','$size','$solg','0')";
				$conn->query($sql_them_vao_cart);
				
				$URL="../site_cart.php";
				header("Location: $URL");
			}
		}
		else //Trường hợp chưa đăng nhập
		{
			//chuyển trang đăng nhập
			$URL="login.php";
			header("Location: $URL");
		}
		
	}
	else 
	{
		//$URL="404.php";
		//header("Location: $URL");
	} */
	
?>