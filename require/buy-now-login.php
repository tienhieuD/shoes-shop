<!DOCTYPE html>
<html>
<head>
	<link rel="STYLESHEET" type="text/css" href="../stylesheet/styles.css" />
	<link rel="STYLESHEET" type="text/css" href="../stylesheet/footer.css" />
	<link rel="STYLESHEET" type="text/css" href="../stylesheet/header.css" />
	<link rel="STYLESHEET" type="text/css" href="../stylesheet/listproduct.css" />
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />  
    <title>
		<?php 
			function toMoney($giatien)
			{
				$ungiatien = "";
				$money     = "";
				for ($i = 0; $i < strlen($giatien); $i++) {
					$ungiatien = substr($giatien, $i, 1) . $ungiatien;
				}
				for ($i = 0; $i < strlen($ungiatien); $i++) {
					$money = substr($ungiatien, $i, 1) . $money;
					if ($i % 3 == 2 && $i != strlen($ungiatien) - 1)
						$money = "," . $money;
				}
				return $money;
			}
		
			include('../connect.php');
			$mahang = $_GET['masanpham'];
			$tenhang = "";
			$nhacc = "";
			$loaihang ="";
			$gia="";
			$mota="";
			$ngungcc="";
			
			$sql = "SELECT * FROM mathang 
					INNER JOIN nhaccungcap ON mathang.MANHACUNGCAP = nhaccungcap.MANHACUNGCAP
					INNER JOIN loaihang on mathang.MALOAIHANG = loaihang.MALOAIHANG
					WHERE mathang.MAHANG = '$mahang'";
			$result = $conn -> query($sql);
			
			if ($result->num_rows > 0)
			{
				while ($row = $result->fetch_assoc())
				{
					$tenhang = $row["TENHANG"];
					$nhacc = $row["TENNHACUNGCAP"];
					$loaihang =$row["TENLOAIHANG"];
					$gia=$row["GIA"];
					$mota=$row["MOTA"];
					$ngungcc=$row["NGUNGCUNGCAP"] == 0 ? "Đang kinh doanh" : "Ngừng kinh doanh";
				}
			}
			echo "Mua ngay " . $tenhang;
		?>
	</title>
</head>
<body style='margin-top: 40px;'>
	<nav id='nav'>
		<ul>
			<li><a href='/index.php'>Home</a>
			</li>
			<li><a href='/site_new.php'>New</a>
			</li>
			<li><a href='/site_sale.php'>Saleoff</a>
			</li>
			<li><a href='/site_cart.php'>Giỏ hàng</a>
			</li>
		</ul>
	</nav>
	
	<form method='post'>
	<table style='    
				position: relative;
				width: 300px;
				top: 35px;
				left: 50%;
				margin-left: -150px;'>
		<tr><td>Tên đăng nhập:	</td><td><input type='text' name='taikhoan'/></td></tr>
		<tr><td>Mật khẩu:		</td><td><input type='password' name='matkhau'/></td></tr>
		<tr><td colspan='2' align='right'><input type='submit' value='Đăng nhập và tiến hành mua'/></td></tr>
		</table>
	</form>
	
    <?php
		require_once("../require/footer.php"); 
	?>
	
	<!--Replace bbcode-->
	<script language="javascript">
		var msg=document.getElementsByName("chitietsp");
			for(var i=0;i<msg.length;i++){
			var txt=document.getElementsByName("chitietsp")[i].innerHTML;
			//txt=txt.replace(/\[br\]/ig,'<br/>');
			txt=txt.replace(/\[/ig,'<');
			txt=txt.replace(/\]/ig,'>');
			document.getElementsByName("chitietsp")[i].innerHTML=txt;
		}
	</script>	
</body>

</html>