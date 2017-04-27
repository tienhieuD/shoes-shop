<div class="chan-trang"></div>
<div align="right">
	<div id="footer">
		<div class="footer">
			<p class="email">
				<?php 
				if (isset($_SESSION['sstaikhoan']))
					echo $_SESSION['sstaikhoan'] . " <a href='log-out.php'>(Đăng xuất)</a>"; 
				else 
					echo "<a href='login.php'>Đăng nhập để mua hàng</a>";
				?>
			</p>
		</div>
	</div>
</div>