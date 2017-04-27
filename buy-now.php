<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<?php include('libralies.php');
		$flag = isset($_SESSION['sstaikhoan']);
	?>
    <title>
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
	
	<div class='paragraph' style='text-align: center; display: <?php echo $flag ? "block" : "none"; ?>'>
		<h1>ĐẶT HÀNG NHANH</h1>
	</div>
	<?php
		
	?>
	
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