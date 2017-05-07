<?php 
	session_start();
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
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
	<style>
		th{border-bottom:5px solid #546E7A;padding:12px;text-transform:uppercase;background:#607D8B;color:#fff}td{border-left:1px solid #ccc;border-bottom:1px dashed #ddd;text-align:center}.left{text-align:left;padding-left:20px}.wrap-giohang{padding:5%;margin:5%;width:90%}.txtSolg{width:60px;text-align:right}.tongTien{background:#EEE;color:#607D8B}.tongTien td{border:none;padding:6px;border-bottom:5px dotted #CFD8DC}
		.info td, .info tr {border: none;text-align: left;}
		input[type=text]{width: 100%;font-family: segoe ui;}
		p::selection{background:none}
		red {color:red;}
	</style>
	<script>
		function getLink(makh,masp,size,id) {
			var solg = document.getElementById(id).value;
			return 'chucnang/editcart.php?makh='+makh+'&masanpham='+masp+'&soluongmua='+solg+'&size='+size;
		}
		function suaSp(makh,masp,size,id) {
			window.location.href = getLink(makh,masp,size,id);
		}
	</script>
	<?php include('libralies.php'); ?>
</head>
<body>
	<?php include('header.php') ?>
	<style>.logo,.main-menu,.search{display:none}</style>
	
	<h1 style="
		TEXT-ALIGN: CENTER;
		MARGIN-BOTTOM: -5%;
		MARGIN-TOP: 5%;
		COLOR: #607D8B;
	">Giỏ hàng của tôi</h1>
	
	<table class='wrap-giohang'>
		<tr>
			<th>#
			</th><th>Tên mặt hàng
			</th><th>Số lượng mua
			</th><th>Size
			</th><th>Thành tiền
			</th><th>###
			</th>
		</tr>
		<?php
			$makh;
			$tongTien=0;
			$dsSP="";
			$dsSL="";
			
			if (isset($_GET['makh'])) {
				$makh = $_GET['makh'];
			}
			else {
				if (isset($_SESSION['sstaikhoan']))
				{
					$email = $_SESSION['sstaikhoan'];
					$sql_lay_ma_kh = "SELECT * FROM KHACHHANG WHERE email = '$email'";
					
					$kq = $conn->query($sql_lay_ma_kh);
					if ($kq->num_rows > 0) {
						$r = $kq->fetch_assoc();
						$makh = $r['MAKHACHHANG'];
						$tenkh = $r['TENKHACHHANG'];
						$diachi = $r['DIACHI'];
						$dienthoai = $r['DIENTHOAI'];
					}
				}
				else 
				{
					$URL="login.php?cart=conghoaxahoichunghiavietnammuonnamahihidongok";
					header("Location: $URL");
				}
			}
				$sql_cart = "SELECT * FROM `giohang` INNER JOIN mathang ON mathang.MAHANG = giohang.MAHANG WHERE DATHANHTOAN = '0' AND MAKHACHHANG ='$makh'";
				$kq = $conn->query($sql_cart);
				$i=0;
				if ($kq->num_rows > 0) {
					while ($r = $kq->fetch_array()){
						$i++;
						$masp = $r['MAHANG']; 	$dsSP .= $masp . "|";
						$tensp = $r['TENHANG']; 
						$solg = $r['SOLUONG'];	$dsSL .= $solg . "|";
						$size = $r['SIZE'];
						$gia = $r['GIA'] * $solg;
						$tongTien+=$gia;
						$giatien = toMoney($gia);
						echo "
							<tr>
								<td>$i
								</td><td class='left'><a href='show-detail.php?masanpham=$masp'><b>$tensp</b></a>
								</td><td><input id='$i' class='txtSolg' type='number' value='$solg'/>
								</td><td>$size
								</td><td>$giatien
								</td><td><small>
								<a href='#' onclick='suaSp($makh,$masp,$size,$i)'>Cập nhật</a> |
								<a href='chucnang/delfromcart.php?masp=$masp&makh=$makh&size=$size'>Xóa</a></small>
								</td>
							</tr>";
					}
				}
			

		?>
		<tr class='tongTien'>
			<td colspan='4' ><b>Tổng tiền</b>
			</td><td><b><?php echo toMoney($tongTien) ?></b>
			</td><td><b>VNĐ</b>
			</td>
		</tr>
	</table>
	
	<form 
		style='margin: 0; padding: 0; text-align: center; margin-top: -45px;' 
		method='get' 
		action='chucnang/thanhtoancart.php'
	>
		<table class='info' style='    position: relative;
    text-align: left;
    left: 50%;
    margin-left: -200px;
    width: 400px;
    background: rgba(236, 239, 241, 0.22);
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 1px 10px 0 rgba(0, 0, 0, .1), 0 5px 10px 0 rgba(0, 0, 0, .1);'>
			<tr><td colspan='2'><h1 style="
				TEXT-ALIGN: CENTER;
				font-size:22px;
				COLOR: #607D8B;
			">Thông tin thanh toán</h1></td></tr>
	
			<tr><td>Tên khách hàng <red>*</red>	</td><td><input required name='tenkh' type='text' value='<?php echo $tenkh; ?>'/></td></tr>
			<tr><td>Địa chỉ	<red>*</red>		</td><td><input required name='diachi' type='text' value='<?php echo $diachi; ?>'/></td></tr>
			<tr><td>Email <red>*</red>			</td><td><input required name='email' type='text' value='<?php echo $email; ?>'/></td></tr>
			<tr><td>Điện thoại <red>*</red>		</td><td><input required name='dienthoai' type='text' value='<?php echo $dienthoai; ?>'/></td></tr>
			<tr><td>Ghi chú						</td><td><input name='ghichu' type='text'/></td></tr>
		</table>
		<input name='makh' type='hidden' value='<?php echo $makh; ?>'/>
		<input name='dsSP' type='hidden' value='<?php echo $dsSP; ?>'/>
		<input name='dsSL' type='hidden' value='<?php echo $dsSL; ?>'/>
		<br/>
		<input type='checkbox' id='xacnhan' disabled />
		<p onclick='xacnhan()' style="
			display: inline;
			cursor: pointer;
		">Xác nhận thông tin và tiến hành thanh toán <?php echo $dsSP; ?></p>
		<br/><br/>
		<input type='submit' id='tt' disabled value='Xin vui lòng xác nhận thông tin'/>
		
		<script>
			function xacnhan() {
				var x = document.getElementById("xacnhan");
				if (x.checked == true)
				{
					x.checked = false;
					document.getElementById("tt").disabled = true;
					document.getElementById("tt").value = 'Xin vui lòng xác nhận thông tin';
				}
				else {
					x.checked=true;
					document.getElementById("tt").disabled = false;
					document.getElementById("tt").value = 'Thanh toán giỏ hàng';
				}
			}
		</script>
	</form>
	
	<?php 
		require_once("footer.php"); 
		$conn->close(); 
	?>
	
	
	
</body>

</html>
