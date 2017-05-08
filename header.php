<?php
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>

<nav id='nav'>
	<ul>
		<li><a href='index.php'>Home</a>
		</li>
		<li><a href='csdl/csdl.php'>Database</a>
		</li>
		<li><a href='hoadon.php'>Hóa đơn</a>
		</li>
		<li><a href='site_cart.php'>Giỏ hàng</a>
		</li>
	</ul>
</nav>
<div class='logo'>
	<a href='index.php'>Shoes <p class='slogan'> Rule the world.</p> </a>
</div>
<div class='main-menu' id ="main-menu">
	<?php 
		require('connect.php');
		
		$sqlloaihang = "SELECT * FROM loaihang";
		$result = $conn->query($sqlloaihang);
		
		if ($result->num_rows > 0) 
		{
			// output data of each row
			while($row = $result->fetch_assoc())
			{
				$maloaihang = $row["MALOAIHANG"];
				$tenloaihang = $row["TENLOAIHANG"];
				
				echo "<a href='index.php?mlh=$maloaihang'> $tenloaihang </a>";
			}
		} 
		else 
		{
			echo "Danh mục nào";
		}
		//$conn->close();
	?>
	</div>
	<form action="index.php" method="GET">
		<div class='search'>
		<input type='text' placeholder='Nhập tên sản phẩm...'/ name="search">
		<input type="submit" value="Tìm">
	</form>
</div>