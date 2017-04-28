<?php
	$filecu = $_REQUEST['filename'];
	$filemoi = $_REQUEST['filename2'];
	
	echo $filecu;
	
	ini_set('max_execution_time', 0);
	$file = fopen($filecu,'r');
	$nfile = fopen($filemoi,'w');
	
	while(!feof($file)) {
		$str = fgets($file);
		fwrite($nfile,$str);
	}
	fclose($file);
	fclose($nfile);
?>