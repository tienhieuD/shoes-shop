<?php 
	session_start();
	include('../connect.php');
	
	function spDaCoTrongCart($maspx,$size,$makh)
	{
		$sql_ktra = "SELECT * FROM giohang
					WHERE MAHANG = '$maspx'
					AND SIZE = '$size'
					AND MAKHACHHANG = '$makh'
					AND DATHANHTOAN = '0'";
		$kq_ktra = $GLOBALS['conn']->query($sql_ktra);
		if ($kq_ktra->num_rows > 0)
			return true;
		return false;
	}
	
	
	$makh;

	if (isset($_GET['masanpham'])
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
				
				$ktra = spDaCoTrongCart($masp,$size,$makh);
				if (!$ktra) {
					$sql_them_vao_cart = "INSERT INTO `giohang`
										(`MAKHACHHANG`, `MAHANG`, `SIZE`, `SOLUONG`, `DATHANHTOAN`) 
										VALUES 
										('$makh','$masp','$size','$solg','0')";
					$conn->query($sql_them_vao_cart);
				}
				else {
					$sql_sua_cart = "	UPDATE `giohang`
										SET 
											SOLUONG			= SOLUONG + $solg
										WHERE 
											MAHANG			= '$masp'
										AND SIZE 			= '$size'
										AND MAKHACHHANG 	= '$makh'
										AND DATHANHTOAN 	= '0'";
					$conn->query($sql_sua_cart);
					//echo $sql_sua_cart;
				}
				
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
		$URL="../404.php";
		header("Location: $URL");
	}
	
?>