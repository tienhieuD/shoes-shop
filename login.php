<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<?php include('libralies.php') ?>
    <title>
		<?php 
			
		?>
	</title>
</head>
<body>
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
	<?php 
		
		$masanpham = isset($_GET['masanpham']) ? $_GET['masanpham'] : '0';
		$soluongmua = isset($_GET['soluongmua']) ? $_GET['soluongmua'] : '0';
		
		//Nếu đã đăng nhập
		if (isset($_SESSION['sstaikhoan'])) 
		{
			if ($masanpham != '0') {
				$URL="buy-now.php?masanpham=$masanpham&soluongmua=$soluongmua";
				header("Location: $URL");
			}
			else {
				$URL="index.php";
				header("Location: $URL");
			}
		}
		else //Chưa đăng nhập
		{
			//Nếu đã ấn đăng nhập
			if (isset($_POST['taikhoan'])) 
			{
				include('connect.php');
				$taikhoan = $_POST['taikhoan'];
				$matkhau = $_POST['matkhau'];
				
				
				$sql = " SELECT * FROM KHACHHANG WHERE EMAIL = '{$taikhoan}' AND MATKHAU = '{$matkhau}' ";
				$result = $conn -> query($sql);
				
				if ($result -> num_rows > 0) {
					$_SESSION['sstaikhoan'] = $taikhoan;
					if ($masanpham != '0') {
						$URL="buy-now.php?masanpham=$masanpham&soluongmua=$soluongmua";
						header("Location: $URL");
					}
					else {
						$URL="index.php";
						header("Location: $URL");
					}
				}
				else  
				{
					echo "<script> alert('Sai thông tin đăng nhập!'); </script>";
					$URL="login.php?masanpham=$masanpham&soluongmua=$soluongmua";
					header("Location: $URL");
				}	
			}
			else //Chưa ấn nút đăng nhập
			{
				echo " <form method='post'>
					<table style=' position: relative; width: 300px; top: 35px; left: 50%; margin-left: -150px;'>
						<tr><td>Tên đăng nhập:	</td><td><input type='text' name='taikhoan' required='required' placeholder='email@domain.com'/></td></tr>
						<tr><td>Mật khẩu:		</td><td><input type='password' name='matkhau' required='required' placeholder='********'/></td></tr>
						<tr><td colspan='2' align='right'><input type='submit' value='Đăng nhập'/></td></tr>
					</table>
					<input type='hidden' name='soluongmua' value='{$masanpham}'/>
					<input type='hidden' name='masanpham' value='{$soluongmua}'/>
				</form>";
			}
		}
	?>
	
    <?php
		require_once("footer.php"); 
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