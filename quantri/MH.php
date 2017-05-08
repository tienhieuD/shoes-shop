<style>
form{position:fixed;top:50%;left:50%;transform:translate(-50%,-50%)}input{outline:none;padding:5px 10px;width:360px;border:none;border-bottom:3px solid #ddd;font-family:segoe ui light;transition:1s}input:focus,textarea:focus{border-color:#06f;border-width:3px}textarea{outline:none;padding:5px 10px;width:360px;max-width:360px;border:none;border-bottom:3px solid #ddd;font-family:segoe ui light;transition:.2s}input[type=submit]{background:#03A9F4;color:#fff;border-color:#0288D1;width:125px}
</style>

<?php
	session_start();
	include('../connect.php');
	
	if($_GET['thaotac']=="them")
	{
?>
	<form class='form' action="MhUpload.php" method="post" enctype="multipart/form-data">
		
		<input placeholder='Tên mặt hàng' type='text' name='tenmh' required='required'/><br/>
		<!--<input placeholder='Nhà cung cấp' type='text' name='ncc' required='required'/><br/>-->
		<input placeholder='Nhà cung cấp' list = 'dsncc' name = 'ncc'>
		<datalist id = 'dsncc'>
			<?php 
				$sql = "SELECT * FROM `nhaccungcap` ORDER BY `MANHACUNGCAP` ASC";
				$kq = $conn->query($sql);
				if ($kq->num_rows > 0)
				{
					while($r = $kq->fetch_assoc())
					{
						$ma =  $r['MANHACUNGCAP'];
						$te =  $r['TENNHACUNGCAP'];
						echo "<option value = '$ma'>$te";
					}
				}
			?>
		</datalist><br/>
		<!--<input placeholder='Loại hàng' type='text' name='loai' required='required'/><br/>-->
		<input placeholder='Loại hàng' list = 'loaihang' name = 'loai'>
		<datalist id = 'loaihang'>
			<?php 
				$sql = "SELECT * FROM `loaihang`";
				$kq = $conn->query($sql);
				if ($kq->num_rows > 0)
				{
					while($r = $kq->fetch_assoc())
					{
						$ma =  $r['MALOAIHANG'];
						$te =  $r['TENLOAIHANG'];
						echo "<option value = '$ma'>$te";
					}
				}
			?>
		</datalist><br/>
		<input placeholder='Số lượng' type='text' name='slg' required='required'/><br/>
		<input placeholder='Giá' type='number' name='gia' required='required'/><br/>
		<textarea placeholder='Mô tả' type='text' name='mota' required='required'></textarea><br/>
		<input type='file' required='required' name="fileToUpload" id="fileToUpload" />
		<p align='center'>
			<input type='submit' value='THÊM' name="submit"/>
		</p>
	</form>
	
	
<?php
	}
	else if($_GET['thaotac']=="sua")
	{
		$ma = $_GET['ma'];
		$sql = "SELECT * FROM mathang 
					INNER JOIN nhaccungcap ON mathang.MANHACUNGCAP = nhaccungcap.MANHACUNGCAP
					INNER JOIN loaihang on mathang.MALOAIHANG = loaihang.MALOAIHANG
					WHERE mathang.MAHANG = '$ma'";
		$result = $conn -> query($sql);
		
		if ($result->num_rows > 0)
		{
			while ($row = $result->fetch_assoc())
			{
				$tenhang = $row["TENHANG"];
				$nhacc = $row["MANHACUNGCAP"];
				$loaihang =$row["MALOAIHANG"];
				$soluonghang = $row["DSSOLUONG"];
				$gia=$row["GIA"];
				$mota=$row["MOTA"];
			}
		}
?>
	
	<form class='form' action="MhUploadEdit.php" method="post" enctype="multipart/form-data">
		
		<input placeholder='Tên mặt hàng' type='text' name='tenmh' value='<?php echo $tenhang ?>' required='required'/><br/>
		<!--<input placeholder='Nhà cung cấp' type='text' name='ncc' required='required'/><br/>-->
		<input placeholder='Nhà cung cấp' list = 'dsncc' name = 'ncc' value='<?php echo $nhacc ?>'>
		<datalist id = 'dsncc'>
			<?php 
				$sql = "SELECT * FROM `nhaccungcap` ORDER BY `MANHACUNGCAP` ASC";
				$kq = $conn->query($sql);
				if ($kq->num_rows > 0)
				{
					while($r = $kq->fetch_assoc())
					{
						$mancc =  $r['MANHACUNGCAP'];
						$tencc =  $r['TENNHACUNGCAP'];
						echo "<option value = '$mancc'>$tencc";
					}
				}
			?>
		</datalist><br/>
		<!--<input placeholder='Loại hàng' type='text' name='loai' required='required'/><br/>-->
		<input placeholder='Loại hàng' list = 'loaihang' name = 'loai' value='<?php echo $loaihang ?>'>
		<datalist id = 'loaihang'>
			<?php 
				$sql = "SELECT * FROM `loaihang`";
				$kq = $conn->query($sql);
				if ($kq->num_rows > 0)
				{
					while($r = $kq->fetch_assoc())
					{
						$malh =  $r['MALOAIHANG'];
						$telh =  $r['TENLOAIHANG'];
						echo "<option value = '$malh'>$telh";
					}
				}
			?>
		</datalist><br/>
		<input placeholder='Số lượng' type='text' name='slg' value='<?php echo $soluonghang ?>' required='required'/><br/>
		<input placeholder='Giá' type='number' name='gia' value='<?php echo $gia ?>' required='required'/><br/>
		<textarea placeholder='Mô tả' type='text' name='mota' required='required'><?php echo $mota ?></textarea><br/>
		<input type='file' name="fileToUpload" id="fileToUpload" />
		<img id="blah" src='../img/product/<?php echo $_GET['ma']; ?>.jpg'  style="max-width:100px;max-height:100px;border-radius:3px;display:block;position:fixed;bottom:-30px">
		<input type='hidden' value='<?php echo $_GET['ma']; ?>' name="masanpham"/>
		<p align='center'>
			<input type='submit' value='SỬA' name="submit"/><br/>
			<a href="../quantri.php#mh" style="
				text-decoration: none;
				font-size: 75%;
				color: #999;
				font-family: Segoe ui light;
				text-transform: uppercase;
				padding-top: 10px;
				position: static;
			">Trở lại</a>
		</p>
	</form>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script>
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#blah').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#fileToUpload").change(function(){
		readURL(this);
	});
	</script>

<?php
	}
	else if($_GET['thaotac']=="xoa")
	{
		
		$ma = $_GET['ma'];
		$sql = "DELETE FROM `mathang` WHERE `MAHANG` = '$ma'";
		$conn->query($sql);
		$URL= "../quantri.php#mh";
		header("Location: $URL");
	}
	
	
?>
