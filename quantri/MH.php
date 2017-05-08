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
		
?>


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
