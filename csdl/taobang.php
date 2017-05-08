<?php
   include('../connect.php');

   $query_file = 'qlbangiay.sql';
   
   $fp    = fopen($query_file, 'r');
   $sql = fread($fp, filesize($query_file));
   fclose($fp); 
   
   //echo $sql;
   if (mysqli_multi_query($conn, $sql)) 
	   echo "Thành công!!! Đợi vài giây rồi
   
   <br/><a href='../index.php'>Bấm đây để về trang chủ</a>"; 
   else 
	   echo "False!!!";
?>