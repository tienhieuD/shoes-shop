<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<?php include('libralies.php');
		include('connect.php');
		
		//Thong tin khach hang
		$flag = isset($_SESSION['sstaikhoan']);
		$email = $_SESSION['sstaikhoan'];
		$sql1 = "select * from khachhang where email = '$email'";
		$kq = $conn->query($sql1);
		
		$tenkh = "";
		$diachi = "";
		$dienthoai = "";
		$ghichu = "";
		$makhach = "";
		
		if ($kq->num_rows > 0)
		{
			while ($row = $kq->fetch_assoc()) {
				$tenkh = $row['TENKHACHHANG'];
				$diachi = $row['DIACHI'];
				$dienthoai = $row['DIENTHOAI'];
				$ghichu = $row['GHICHU'];
				$makhach = $row['MAKHACHHANG'];
			}
		}
		
		//ThongTinSanPham
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
		$mahang = $_GET['masanpham'];
		$tenhang = "";
		$nhacc = "";
		$loaihang ="";
		$gia="";
		$mota="";
		$ngungcc="";
		$soluongcon="";
		$donvitinh="";
		$size=$_GET['size'];
		
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
				$donvitinh=$row["DONVITINH"];
				$dssoluong= explode("|",$row['DSSOLUONG']);
				$soluongcon= isset($dssoluong[$size-38]) ? $dssoluong[$size-38] : 0;
			}
		}
		
		//Them hoa don
		if(isset($_GET['tenkh'])) {
			$noinhanhang = $_GET['ghichu']=="" ? $_GET['diachi'] : $_GET['ghichu'];
			$sql2 = "INSERT INTO `dondathang`(`MAKHACHHANG`, `NGAYDATHANG`, `NOIGIAOHANG` , DSMATHANG, DSSOLUONG) 
			VALUES ('{$_GET['makh']}', CURRENT_TIMESTAMP(),'$noinhanhang', '$mahang', '{$_GET['soluongmua']}')";
			if($conn->query($sql2)){
				$makh = $_GET['makh'] * 12 - 01 + 1996;
				$URL="hoadon.php?12011996=$makh";
				header("Location: $URL");
			}
			else {
				$URL="404.php?makh={$_GET['makh']}";
				header("Location: $URL");
			}
		}
	?>
    <title>
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
	<style>
	input[type='text'] {width: 90%}
	red {color: red;}
	
	</style>
	<div class='paragraph' style='text-align: center; display: <?php echo $flag ? "block" : "none"; ?>'>
		<h1 style='text-align: center;'>ĐẶT HÀNG NHANH</h1>
		
		<div class='product-item'>
			<div class='product-img' style='background-image: url(img/product/<?php echo $mahang?>.jpg);'>
				<div class='product-money'><?php echo toMoney($gia);?>đ</div>
				<div class='product-addtocart'><?php echo " Còn $soluongcon $donvitinh" ?></div>
			</div>
			<div class='product-name'><?php echo $tenhang;?></div>
		</div><br/><br/>
		
		<p align='center' style="font-style: italic;">
			Mua <b><?php echo $_GET['soluongmua']; ?></b> 
			sản phẩm size <b><?php echo $_GET['size']; ?></b>, 
			thành tiền <b><?php echo toMoney($_GET['soluongmua'] * $gia); ?></b> VNĐ.<br/>
		</p>
		
		<form>
			<table style='	position: relative;
							text-align: left;
							left: 50%;
							margin-left: -200px;
							width: 400px;'>
				<tr><td>Tên khách hàng <red>*</red>	</td><td><input required name='tenkh' type='text' value='<?php echo $tenkh; ?>'/></td></tr>
				<tr><td>Địa chỉ	<red>*</red>		</td><td><input required name='diachi' type='text' value='<?php echo $diachi; ?>'/></td></tr>
				<tr><td>Email <red>*</red>			</td><td><input required name='email' type='text' value='<?php echo $email; ?>'/></td></tr>
				<tr><td>Điện thoại <red>*</red>		</td><td><input required name='dienthoai' type='text' value='<?php echo $dienthoai; ?>'/></td></tr>
				<tr><td>Địa chỉ giao hàng			</td><td><input name='ghichu' type='text'/></td></tr>
				<input name='masanpham' type='hidden' value='<?php echo $_GET['masanpham']; ?>'/>
				<input name='soluongmua' type='hidden' value='<?php echo $_GET['soluongmua']; ?>'/>
				<input name='makh' type='hidden' value='<?php echo $makhach; ?>'/>
				<input name='size' type='hidden' value='<?php echo $size; ?>'/>
			</table><br/>
			<input <?php echo $soluongcon < $_GET['soluongmua'] ? "disabled" : ""; ?> type='submit' value='<?php echo $soluongcon < $_GET['soluongmua'] ? "TẠM THỜI KHÔNG ĐỦ SỐ LƯỢNG BÁN" : "ĐẶT HÀNG NGAY"; ?>'/>
		</form>
	</div>
	<?php
		
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
<?php $conn->close(); ?>