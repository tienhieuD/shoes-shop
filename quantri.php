<p style="
    text-align: right;
    padding: 10px 0;
    font-size: small;
    font-style: italic;
    padding-right: 15px;
    ">
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
	<?php require('libralies.php');  ?>
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
	
	body {
		    font-family: 'Segoe UI Light','Open Sans', 'Roboto', sans-serif;
    font-size: 16px;
    color: #424242;
     max-width: 100%;
    margin: 0;
    border-radius: 2px;
    box-shadow: 0 1px 10px 0 rgba(0, 0, 0, .1), 0 5px 10px 0 rgba(0, 0, 0, .1);
    position: relative;
	}
	
	body p {margin:0}
	table {max-width: 90%;}
	</style>
	<script type='text/javascript'>
	var hienThiTrenID = "showHang";
	var layTuTrang = "quantri/mathang.php";
	
			function showHint(str) {
				if (str.length==0) {
					//document.getElementById(hienThiTrenID).innerHTML = '';
					str = '%20';
					//return;
				}
				
				xmlHttp = getHTTPObject();
				
				if(xmlHttp == null) {
					alert("xmlHttp-null");
					return;
				}
				
				var url=layTuTrang;
				url = url+"?q="+str;
				xmlHttp.onreadystatechange=stateChanged;
				xmlHttp.open("GET",url,true);
				xmlHttp.send(null);
			}
			
			var xmlHttp = getHTTPObject();
			
			function getHTTPObject() {
				var xmlhttp;
				if (window.XMLHttpRequest) {
					xmlhttp = new XMLHttpRequest();
				} else if (window.ActiveXObject) {
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
				return xmlhttp;
			}
			
			function stateChanged() {
				if (xmlHttp.readyState==4) {
					document.getElementById(hienThiTrenID).innerHTML = xmlHttp.responseText;
				}
			}
		</script>
</head>
<body>
	<a href="quantri.php" style="
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
	</div>
	
	<div class='noidung' align='center'>
			<?php
				if (isset($_GET['hoadondathanhtoan'])) {
					$sql = "SELECT * FROM dondathang WHERE NGAYCHUYENHANG is NOT NULL ORDER BY SOHOADON DESC";
					$x="display: none";
				}
				else{
					$sql = "SELECT * FROM dondathang WHERE NGAYCHUYENHANG is NULL ORDER BY SOHOADON DESC";
					$x=" ";
				}
			?>
			
	<!--hoadondathanhtoan-------------------------------------------------------------------->
		<div id='ddh'>
			<h2>Đơn đặt hàng</h2>
			<div class='menu' align='center'>
				<a href="quantri.php?hoadondathanhtoan=true#ddh">Xem hóa đơn đã thanh toán</a>
				<a href="quantri.php?#ddh">Xem hóa đơn đang chờ</a>
			</div>
			
			<table class="tg">
			<tr style="
				background: #607D8B;
				color: #FFF;
			">
				<th class="tg-uztx">#</th>
				<th class="tg-uztx">KHÁCH HÀNG</th>
				<th class="tg-uztx">NGAY ĐẶT</th>
				<th class="tg-yw4l">NƠI GIAO HÀNG</th>
				<th class="tg-yw4l">MẶT HÀNG</th>
				<th class="tg-yw4l">SL</th>
				<th class="tg-yw4l">GIÁ TRỊ</th>
				<th class="tg-yw4l" style='<?php echo $x ?>'>Thao tác</th>
			</tr>
			<?php
				$kq = $conn->query($sql);
				
				if ($kq->num_rows > 0)
				{
					while($r = $kq->fetch_assoc())
					{
						$makh 		= $r['MAKHACHHANG'];
						$ttkh 		= getThongtinKH($makh);
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
								<td class='tg-b7b8'> $ttkh</td>
								<td class='tg-b7b8'> $ngaydh</td>
								<td class='tg-yw4l'> $noigh</td>
								<td class='tg-b7b8'> $tenmh</td>
								<td class='tg-yw4l'> $soluong</td>
								<td class='tg-b7b8' style='text-align: right;'>$tonggia</td>
								<td class='tg-yw4l' style='$x'>
									<a href='quantri/xacnhan-hd.php?shd=$sohd'>Xác nhận</a><br/>
									<a href='quantri/xoa-hd.php?shd=$sohd'>Hủy</a>
								</td>
							  </tr>";
					}
				}
				else {
					echo "<tr><td colspan='7'><p align='center'>Không có đơn đặt hàng nào đang đợi!</p></td></tr>";
				}
			?>
			</table>
		</div>
		
		<!--khách hàng-------------------------------------------------------------------->
		
		<div id='kh'>
			<h2>Khách hàng</h2>
			<table class="tg">
			<tr style="
				background: #607D8B;
				color: #FFF;
			">
				<th class="tg-uztx">MAKHACHHANG</th>
				<th class="tg-yw4l">TENKHACHHANG</th>
				<th class="tg-uztx">DIACHI</th>
				<th class="tg-yw4l">EMAIL</th>
				<th class="tg-uztx">DIENTHOAI</th>
				<th class="tg-yw4l">GHICHU</th>
			</tr>
			<?php
				$sql = "SELECT * FROM `khachhang`";
				$kq = $conn->query($sql);
				if ($kq->num_rows > 0)
				{
					while($r = $kq->fetch_assoc())
					{
						$ma =  $r['MAKHACHHANG'];
						$te =  $r['TENKHACHHANG'];
						$dc =  $r['DIACHI'];
						$em =  $r['EMAIL'];
						$mk =  $r['MATKHAU'];
						$dt =  $r['DIENTHOAI'];
						$gc =  $r['GHICHU'];
						
						echo "<tr>
								<td class='tg-yw4l'> $ma</td>
								<td class='tg-b7b8'> $te</td>
								<td class='tg-yw4l'> $dc</td>
								<td class='tg-b7b8'> $em</td>
								<td class='tg-b7b8'> $dt</td>
								<td class='tg-yw4l'> $gc</td>
								<td class='tg-b7b8'>
									<a href='quantri/kh.php?thaotac=xoa&ma=$ma'>Xóa</a>
								</td>
							  </tr>";
					}
				}
			?>
			</table>
		</div>
		
		<!--Mặt hàng-------------------------------------------------------------------->
		<div id='mh'>
			<h2>Mặt hàng</h2>
			<div class='menu' align='center'>
				<a href="quantri/MH.php?thaotac=them">Thêm mặt hàng mới</a><br/>
			</div>
			<div align='center'>
				<input type="text" id="txt1" placeholder="Lọc sản phẩm" onkeyup="showHint(this.value)" style="WIDTH: 33.8%;">
			</div><BR/>
			<div id='showHang'>
			
			<table class="tg">
			<tr style="
				background: #607D8B;
				color: #FFF;
			">
				<th class="tg-uztx">#MAHANG</th>
				<th class="tg-uztx">TENHANG</th>
				<th class="tg-yw4l">TENNHACUNGCAP</th>
				<th class="tg-uztx">TENLOAIHANG</th>
				<th class="tg-yw4l">DONVITINH</th>
				<th class="tg-uztx">GIA</th>
				<th class="tg-yw4l">NGUNGCUNGCAP</th>
				<th class="tg-yw4l">THAO TÁC</th>
			</tr>
			<?php
				$sql = "SELECT * FROM `mathang` 
				INNER JOIN nhaccungcap ON mathang.MANHACUNGCAP= nhaccungcap.MANHACUNGCAP
				INNER JOIN loaihang on mathang.MALOAIHANG = loaihang.MALOAIHANG";
				$kq = $conn->query($sql);
				if ($kq->num_rows > 0)
				{
					while($r = $kq->fetch_assoc())
					{
						$ma =  $r['MAHANG'];
						$te =  $r['TENHANG'];
						$nc =  $r['TENNHACUNGCAP'];
						$tl =  $r['TENLOAIHANG'];
						$dv =  $r['DONVITINH'];
						$gi =  $r['GIA'];
						$st =  $r['NGUNGCUNGCAP'];
						echo "<tr>
								<td class='tg-yw4l'> $ma</td>
								<td class='tg-b7b8'> $te</td>
								<td class='tg-yw4l'> $nc</td>
								<td class='tg-b7b8'> $tl</td>
								<td class='tg-yw4l'> $dv</td>
								<td class='tg-b7b8'> $gi</td>
								<td class='tg-yw4l'> $st</td>
								<td class='tg-b7b8'>
									<a href='quantri/MH.php?thaotac=sua&ma=$ma'>Sửa</a>
									<a href='quantri/MH.php?thaotac=xoa&ma=$ma'>Xóa</a>
								</td>
							  </tr>";
					}
				}
			?>
			</table>
			</div>
		</div>
		
		
		<!--Loại hàng-------------------------------------------------------------------->
		<div id='lh'>
			<h2>Loại hàng</h2>
			
			<div class='menu' align='center'>
				<a href="quantri/LH.php?thaotac=them">Thêm loại hàng mới</a><br/>
			</div>
			
			<table class="tg">
				<tr style="
					background: #607D8B;
					color: #FFF;
				">
					<th class="tg-uztx">#ID</th>
					<th class="tg-uztx">LOẠI HÀNG</th>
					<th class="tg-yw4l">THAO TÁC</th>
				</tr>
				<?php
					$sql = "SELECT * FROM `loaihang`";
					$kq = $conn->query($sql);
					if ($kq->num_rows > 0)
					{
						while($r = $kq->fetch_assoc())
						{
							$ma =  $r['MALOAIHANG'];
							$te =  $r['TENLOAIHANG'];
							echo "<tr>
									<td class='tg-yw4l'> $ma</td>
									<td class='tg-b7b8'> $te</td>
									<td class='tg-b7b8'>
										<a href='quantri/LH.php?thaotac=sua&ma=$ma'>Sửa</a>
										<a href='quantri/LH.php?thaotac=xoa&ma=$ma'>Xóa</a>
									</td>
								  </tr>";
						}
					}
				?>
			</table>
			
		</div>
		
		<div id='ncc'>
			<h2>Nhà cung cấp</h2>
			
			<div class='menu' align='center'>
				<a href="quantri/ncc.php?thaotac=them">Thêm nhà cung cấp mới</a><br/>
			</div>
			
			<table class="tg" style="
				padding-bottom: 50%;
			">
			<tr style="
				background: #607D8B;
				color: #FFF;
			">
				<th class="tg-uztx">#ID</th>
				<th class="tg-uztx">NHÀ CUNG CẤP</th>
				<th class="tg-yw4l">ĐỊA CHỈ</th>
				<th class="tg-yw4l">ĐIỆN THOẠI</th>
				<th class="tg-yw4l">FAX</th>
				<th class="tg-yw4l">EMAIL</th>
				<th class="tg-yw4l">THAO TÁC</th>
			</tr>
			<?php
				$sql = "SELECT * FROM `nhaccungcap`";
				$kq = $conn->query($sql);
				if ($kq->num_rows > 0)
				{
					while($r = $kq->fetch_assoc())
					{
						$ma =  $r['MANHACUNGCAP'];
						$te =  $r['TENNHACUNGCAP'];
						$dc =  $r['DIACHI'];
						$dt =  $r['DIENTHOAI'];
						$fx =  $r['FAX'];
						$em =  $r['EMAIL'];
						echo "<tr>
								<td class='tg-yw4l'> $ma</td>
								<td class='tg-b7b8'> $te</td>
								<td class='tg-yw4l'> $dc</td>
								<td class='tg-b7b8'> $dt</td>
								<td class='tg-yw4l'> $fx</td>
								<td class='tg-b7b8'> $em</td>
								<td class='tg-b7b8'>
									<a href='quantri/ncc.php?thaotac=sua&ma=$ma'>Sửa</a>
									<a href='quantri/ncc.php?thaotac=xoa&ma=$ma'>Xóa</a>
								</td>
							  </tr>";
					}
				}
			?>
			</table>
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
	
	function getThongtinKH($makh) {
		include('connect.php');
		$sql1 = "select * from khachhang where MAKHACHHANG = '$makh'";
		$kq = $conn->query($sql1);
		if ($kq->num_rows > 0)
		{
			while ($row = $kq->fetch_assoc()) {
				$tenkh = $row['TENKHACHHANG'];
				$diachi = $row['DIACHI'];
				$dienthoai = $row['DIENTHOAI'];
				$ghichu = $row['GHICHU'];
				$makhach = $row['MAKHACHHANG'];
				$str = "$tenkh<br/>$dienthoai";
			}
		}
		return $str;
	}
?>