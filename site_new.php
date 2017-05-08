<?php 
	session_start();
	include('libralies.php');
	include('connect.php');
	
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
	
	if(isset($_GET['12011996'])) 
	{
		$makh= ($_GET['12011996'] - 1996 + 1) / 12;
		$sql = "SELECT * FROM dondathang WHERE dondathang.MAKHACHHANG = '$makh' and NGAYCHUYENHANG is NULL";
		$kq = $conn->query($sql);
		
		$sohd;
		$ngaydh;
		$noigh;
		$dsmathang;
		$dssoluong;
		
	}
?>
<!DOCTYPE html>
<html>
<head>
    <title>
	</title>
	<style type="text/css">
	.tg td hr:last-child{display:none}
	hr{border: none;margin: 0;border-top: 1px solid #ccc;margin-top: 2px;}.tg{border-collapse:separate;border-color:#ccc;width:90%;margin:5%;border-spacing:5px;font-size:14px}.tg td{padding:5px 10px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#000;background-color:#fff;border-radius:2px}.tg th{font-weight:400;padding:3px 0;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#607D8B;color:#FAFAFA;background-color:#607D8B;border-radius:2px}.tg .tg-uztx{text-align:center;vertical-align:top}.tg .tg-yw4l{vertical-align:top}.tg .tg-b7b8{background-color:#f9f9f9;vertical-align:top}
	</style>
</head>
<body>
	<?php include('header.php') ?>
	<style>.logo,.main-menu,.search{display:none}</style>
	

	<h1 style="
		TEXT-ALIGN: CENTER;
		MARGIN-BOTTOM: -5%;
		MARGIN-TOP: 5%;
		COLOR: #607D8B;
	">HÓA ĐƠN CHƯA THANH TOÁN</h1>
	
	<table class="tg">
	  <tr>
		<th class="tg-uztx">SỐ HĐ</th>
		<th class="tg-uztx">NGAY ĐẶT HÀNG</th>
		<th class="tg-yw4l">NƠI GIAO HÀNG</th>
		<th class="tg-yw4l">MẶT HÀNG</th>
		<th class="tg-yw4l">SL</th>
		<th class="tg-yw4l">GIÁ TRỊ</th>
	  </tr>
	
	<?php
		if ( isset($kq) && $kq->num_rows > 0)
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
					  </tr>";
			}
		}
	?>
	
	</table>
	
	<h1 style="
		TEXT-ALIGN: CENTER;
		MARGIN-BOTTOM: -5%;
		MARGIN-TOP: 5%;
	">HÓA ĐƠN ĐÃ THANH TOÁN</h1>
	
	<table class="tg">
	  <tr>
		<th class="tg-uztx">SỐ HĐ</th>
		<th class="tg-uztx">NGAY ĐẶT HÀNG</th>
		<th class="tg-yw4l">NƠI GIAO HÀNG</th>
		<th class="tg-yw4l">MẶT HÀNG</th>
		<th class="tg-yw4l">SL</th>
		<th class="tg-yw4l">GIÁ TRỊ</th>
	  </tr>
	
	<?php
	
		if(isset($_GET['12011996'])) 
		{
			$makh= ($_GET['12011996'] - 1996 + 1) / 12;
			$sql = "SELECT * FROM dondathang WHERE dondathang.MAKHACHHANG = '$makh' and NGAYCHUYENHANG is NOT NULL";
			$kq = $conn->query($sql);
			
			$sohd;
			$ngaydh;
			$noigh;
			$dsmathang;
			$dssoluong;
			
		}
	
		if (isset($kq) && $kq->num_rows > 0)
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
						<td class='tg-yw4l'>$sohd</td>
						<td class='tg-b7b8'>$ngaydh</td>
						<td class='tg-yw4l'>$noigh</td>
						<td class='tg-b7b8'>$tenmh</td>
						<td class='tg-yw4l'>$soluong</td>
						<td class='tg-b7b8' style='text-align: right;'>$tonggia</td>
					  </tr>";
			}
		}
	?>
	
	</table>
	
	<?php 
		require_once("footer.php"); 
		$conn->close(); 
	?>
</body>

</html>
