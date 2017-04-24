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
	$trang        = isset($_GET['page']) ? $_GET['page'] : 1;
	$soSpMotTrang = 3;
	$spBatDau     = ($trang - 1) * $soSpMotTrang;
	$tongSoSp     = $conn->query("SELECT * FROM mathang")->num_rows;

	$sql    = "SELECT * FROM mathang ORDER BY mahang DESC LIMIT $spBatDau,$soSpMotTrang";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$mahang  = $row["MAHANG"];
			$tenhang = $row["TENHANG"];
			$giatien = $row["GIA"];
			
			//Đổi sang định dạng tiền
			$money = toMoney($giatien);
			
			echo "<div class='product-item'>
					<div class='product-img' style='background-image: url(img/product/$mahang.jpg);'>
						<div class='product-money'> {$money}đ </div>
						<div class='product-addtocart'><img src='img/icon/cart.png' height='13'/></div>
					</div>
					<a href='require/show-detail.php?masanpham={$mahang}'><div class='product-name'>
						$tenhang
					</div></a>
				</div>";
		}
	} else {
		echo "0 results";
	}

	//Phân trang
	$tongSoTrang = $tongSoSp / $soSpMotTrang;
	echo '<div class="btn-group">';
	for ($i = 0; $i < $tongSoTrang; $i++) {
		$page = $i + 1;
		if ($page != $trang)
			echo '<a href="index.php?page=' . $page . '#main-menu">' . $page . '</a>';
		else
			echo '<a href="index.php?page=' . $page . '#main-menu" class="clicked-page">' . $page . '</a>';
	}
	echo '</div>';

	$conn->close();
	unset($trang,$soSpMotTrang,$spBatDau,$tongSoSp,$sql,$result,$tongSoTrang);
?>