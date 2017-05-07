<p style='text-align: right;
    padding: 10px 0;
    font-size: small;
    font-style: italic;'>
	<?php
		include('connect.php');
		session_start();
		if (isset($_SESSION['ssmanv']))
		{
			echo "Xin chào {$_SESSION['ssmanv']} ";
			echo "<a href='quantri/thoat.php'>Thoát</a>";
		}
		else 
		{
			$URL = 'quantri/dangnhap.php';
			header("Location: $URL");
		}
		
	?>
</p>
<!DOCTYPE html>
<html>
<head>
	<style> table td {vertical-align: top; padding:5px 10px;} 
	hr {       margin: 0;
    padding: 0;
    border: none;
    padding-top: 2px;
    background: #fff;}
	hr:last-child {
		display:none;
	}
	tr:nth-child(even) {background: #dfdfdf}
	.menu>a {display: block;
    background: #ECEFF1;
    padding: 5px 5px 8px;
    border-radius: 3px;
    margin: 3px;
    width: 33%;}
	h2 {    margin-top: 50%;
	    color: #fff;
    background: #90A4AE;
    padding: 20px;}
	</style>
	<?php require('libralies.php');  ?>
</head>
<body>
	<a href="#" style="
		background: #607D8B;
		color: #FFF;
		padding: 10px 10px;
		border-radius: 4px;
		text-transform: uppercase;
		position: fixed;
		bottom: 10px;
		right: 10px;
	">MENU</a>
	<div class='menu' align='center'>
	<h1 style="
		text-align: center;
	">Trang quản trị viên</h1>
	<a href='#ddh'>Quản lý hóa đơn đặt hàng</a>
	<a href='#kh'>Quản lý khách hàng</a>
	<a href='#mh'>Quản lý mặt hàng</a>
	<a href='#lh'>Quản lý loại hàng</a>
	<a href='#ncc'>Quản lý nhà cung cấp</a>
	<a href='#nv'>Quản lý nhân viên</a>
	<div>
	
	<div class='noidung'>
		<div id='ddh'>
			<h2>Đơn đặt hàng</h2>
			<table class="tg">
			<tr style="
				background: #607D8B;
				color: #FFF;
			">
				<th class="tg-uztx">#</th>
				<th class="tg-uztx">NGAY ĐẶT</th>
				<th class="tg-yw4l">NƠI GIAO HÀNG</th>
				<th class="tg-yw4l">MẶT HÀNG</th>
				<th class="tg-yw4l">SL</th>
				<th class="tg-yw4l">GIÁ TRỊ</th>
				<th class="tg-yw4l">Thao tác</th>
			</tr>
			<?php
				$sql = "SELECT * FROM dondathang WHERE NGAYCHUYENHANG is NULL ORDER BY SOHOADON DESC";
				$kq = $conn->query($sql);
				
				if ($kq->num_rows > 0)
				{
					while($r = $kq->fetch_assoc())
					{
						$sohd 		= $r['SOHOADON'];
						$ngaydh 	= $r['NGAYDATHANG'];
						$noigh 		= $r['NOIGIAOHANG'];
						$dsmathang 	= explode("|",$r['DSMATHANG']);
						$mamathang 	= toStr($dsmathang);
						$tenmh 		= getTenMH($dsmathang);
						$dssoluong 	= explode("|",$r['DSSOLUONG']);
						$soluong 	= toStr($dssoluong);
						$ngaych		= $r['NGAYCHUYENHANG'] != "" ? "đã thanh toán" : "chưa thanh toán";
						$tonggia 	= getGiaTri($dsmathang,$dssoluong);
						echo "<tr>
								<td class='tg-yw4l'> $sohd</td>
								<td class='tg-b7b8'> $ngaydh</td>
								<td class='tg-yw4l'> $noigh</td>
								<td class='tg-b7b8'> $tenmh</td>
								<td class='tg-yw4l'> $soluong</td>
								<td class='tg-b7b8' style='text-align: right;'>$tonggia</td>
								<td class='tg-yw4l'>
									<a href='#'>Xác nhận</a><br/>
									<a href='#'>Hủy</a>
								</td>
							  </tr>";
					}
				}
			?>
			</table>
		</div>
		
		<div id='kh'>
			<h2>Khách hàng</h2>
		</div>
		
		<div id='mh'>
			<h2>Mặt hàng</h2>
		</div>
		
		<div id='lh'>
			<h2>Loại hàng</h2>
		</div>
		
		<div id='ncc'>
			<h2>Nhà cung cấp</h2>
		</div>
		
		<div id='nv'>
			<h2>Nhân viên</h2>
		</div>
	</div>
</body>
</html>
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
	
	function toStr($array) {
		$str = "";
		foreach ($array as $item){
			$str = $str . " " . $item . "<hr/>";
		}
		return $str;
	}
	
	function getTenMH($arrayMaMH) {
		include('connect.php');
		$str = "";
		
		foreach ($arrayMaMH as $item) {
			$sql = "SELECT * FROM mathang WHERE mathang.MAHANG = '$item'";
			$kq = $conn->query($sql);
			
			if ($kq->num_rows > 0)
			{
				while($r = $kq->fetch_assoc())
				{
					$tenmh 		= $r['TENHANG'];
					$str = $str . " " . $tenmh . "<hr/>";
				}
			}
			
		}
		return $str;
	}
	
	function getGiaTri($arrayMaMH, $arraySL) {
		include('connect.php');
		$str = "";
		$i=0;
		$tong=0;
		foreach ($arrayMaMH as $item) {
			$sql = "SELECT * FROM mathang WHERE mathang.MAHANG = '$item'";
			$kq = $conn->query($sql);
			
			if ($kq->num_rows > 0)
			{
				while($r = $kq->fetch_assoc())
				{
					$dongia 		= $r['GIA'];
					$gia = $dongia * $arraySL[$i];
					$tong += $gia;
					$str = $str . " " . toMoney($gia) . " đ<hr/>";
				}
			}
			$i++;
		}
		if (count($arrayMaMH)>1)
			$str .= "<b>Tổng: ". toMoney($tong) . " đ</b><hr/>";;
		return $str;
	}
?>