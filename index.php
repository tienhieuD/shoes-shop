<?php session_start(); ?>

<!DOCTYPE html>
<html>

<head>
    <title>Shop Giầy Shoes</title>
    <?php 
		require('libralies.php'); 
	?>
</head>

<body>
	<?php
		require_once("header.php"); 
	?>
    <div class="paragraph" id="mark">
		<?php require_once("show-product.php"); ?>
    </div>
	
    <?php
		require_once("footer.php"); 
	?>
	
</body>

</html>