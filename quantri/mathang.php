<table class="tg">
			<tr style="
				background: #607D8B;
				color: #FFF;
			">
				<th class="tg-uztx">#MAHANG</th>
				<th class="tg-uztx">TENHANG</th>
				<th class="tg-yw4l">TENNHACUNGCAP</th>
				<th class="tg-uztx">TENLOAIHANG</th>
				<th class="tg-yw4l">DONVITINH</th>
				<th class="tg-uztx">GIA</th>
				<th class="tg-yw4l">NGUNGCUNGCAP</th>
				<th class="tg-yw4l">THAO TÁC</th>
			</tr>
			
<?php
	require_once('../connect.php');
	if($_GET['q']!="")
	{
		$q = $_GET['q'];
		$sql = "SELECT * FROM `mathang` 
				INNER JOIN nhaccungcap ON mathang.MANHACUNGCAP= nhaccungcap.MANHACUNGCAP
				INNER JOIN loaihang on mathang.MALOAIHANG = loaihang.MALOAIHANG
				WHERE TENHANG like '%{$q}%'
				OR MAHANG like '%{$q}%'
				";
		$kq = $conn->query($sql);
		if ($kq->num_rows > 0)
		{
			while($r = $kq->fetch_assoc())
			{
				$ma =  $r['MAHANG'];
				$te =  $r['TENHANG'];
				$nc =  $r['TENNHACUNGCAP'];
				$tl =  $r['TENLOAIHANG'];
				$dv =  $r['DONVITINH'];
				$gi =  $r['GIA'];
				$st =  $r['NGUNGCUNGCAP'];
				echo "<tr>
						<td class='tg-yw4l'> $ma</td>
						<td class='tg-b7b8'> $te</td>
						<td class='tg-yw4l'> $nc</td>
						<td class='tg-b7b8'> $tl</td>
						<td class='tg-yw4l'> $dv</td>
						<td class='tg-b7b8'> $gi</td>
						<td class='tg-yw4l'> $st</td>
						<td class='tg-b7b8'>
							<a href='quantri/MH.php?thaotac=sua'>Sửa</a>
							<a href='quantri/MH.php?thaotac=xoa'>Xóa</a>
						</td>
					  </tr>";
			}
		}
		else echo "<tr>
						<td class='tg-yw4l'> N/A</td>
						<td class='tg-b7b8'> N/A</td>
						<td class='tg-yw4l'> N/A</td>
						<td class='tg-b7b8'> N/A</td>
						<td class='tg-yw4l'> N/A</td>
						<td class='tg-b7b8'> N/A</td>
						<td class='tg-yw4l'> N/A</td>
						<td class='tg-b7b8'>
							N/A
						</td>
					  </tr>";
	}
?>

</table>
