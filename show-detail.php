<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<?php include('libralies.php') ?>
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
		
			include('connect.php');
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
			echo "Xem sản phẩm " . $tenhang;
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
	
	<table style="
		width: 100%;
		padding: 3%;
	">
	  <tr>
		<td colspan='2' style="
			    color: #888;
				text-align: center;
				font-size: 26px;
				font-weight: bold;
				text-transform: uppercase;
				display: none;
		"><?php echo $tenhang ?></td>
	  </tr>
	  <tr>
		<td style='text-align: right;'>
			<img src='img/product/<?php echo $mahang ?>.jpg'  style="max-height: 360px;border-radius: 3px;padding-top: 50px;">
		</td>
		<td>
			<ul style="
				padding-top: 40px;
			">
				<li>Tên giầy: <?php echo $tenhang ?></li>
				<li>Loại giầy: <?php echo $loaihang ?></li>
				<li>Nhà cung cấp: <?php echo $nhacc ?></li>
				<li>Trạng thái: <?php echo $ngungcc ?></li>
				<li>Giá tiền: <?php echo toMoney($gia) . "đ" ?></li>
				
				<form action='login.php'>
				Số lượng mua: <input style='width: 40px' type='number' min='1' value='1' name='soluongmua'/> 
				Size 
				<select name="size">
					<option value="38">38
					</option><option value="38">39
					</option><option value="40">40
					</option><option value="41">41
					</option><option value="42">42
					</option><option value="43">43
					</option><option value="44">44
					</option>
				</select><br/>
				<input style='display: none' type='text' min='1' value='<?php echo $mahang ?>' name='masanpham'/>
				<input type='submit' value='Mua hàng ngay'/>	
				<form>
				
				<br/>
				<a href='#'>Thêm vào giỏ hàng</a>
			</ul>
		</td>
	  </tr>
	  <tr>
		<td colspan="2">
			<p style="
				color: #888;
				text-align: center;
				font-size: 26px;
				font-weight: bold;
				text-transform: uppercase;
				padding-top: 50px;
			">Chi tiết sản phẩm</p>
			<p name='chitietsp' style='margin: 30px 10%;'><?php echo $mota ?></p>
			
		</td>
	  </tr>
	</table>
	
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