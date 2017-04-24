<?php 
	require_once('connect.php');
	$q = $_GET['q'];
	$sql = "SELECT * FROM mathang where TENHANG like '%{$q}%'";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc())
		{
			$tenhang = $row["TENHANG"];
			echo $tenhang . "<br/>";
		}
	}
	else echo 'Vo hox';
	
?>