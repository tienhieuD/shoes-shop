<nav id='nav'>
	<ul>
		<li><a href='index.php'>Home</a>
		</li>
		<li><a href='site_new.php'>New</a>
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
	<div class='search'>
	<input type='text' placeholder='Gõ để tìm kiếm...'/>
	<button> Tìm </button>
</div>