<?php
if(isset($_POST["submit"])) {
	include('../connect.php');
	$masp 	= $_POST['masanpham'];
	$tenmh	= $_POST['tenmh'];
	$ncc	= $_POST['ncc'];
	$loai	= $_POST['loai'];
	$slg	= $_POST['slg'];
	$gia	= $_POST['gia'];
	$mota	= $_POST['mota'];
	$sql	= "
				UPDATE `mathang` SET 
						`TENHANG`='$tenmh',
						`MANHACUNGCAP`='$ncc',
						`MALOAIHANG`='$loai',
						`DSSOLUONG`='$slg',
						`DONVITINH`='đôi',
						`GIA`='$gia',
						`MOTA`='$mota',
						`NGUNGCUNGCAP`='0'
						WHERE `MAHANG`='$masp'
";
	$conn->query($sql);

	$mamh = $_POST['masanpham'];
}
?>


<?php
if(isset($_POST["submit"])) {
	//$mamh = $_POST['mamh'];
	$target_dir = "../img/product/";
	$target_file = $target_dir . "$mamh.jpg";//basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !== false) {
			echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			echo "File is not an image.";
			$uploadOk = 0;
		}
	}
	// Check if file already exists
	if (file_exists($target_file)) {
		echo "Đã tồn tại file này";
		$uploadOk = 1;
	}
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 500000) {
		echo "File quá lớn thử lại sau";
		$uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		echo "Hình ảnh không hợp lệ, xin thử lại sau!";
		$uploadOk = 1;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo "Hình ảnh không hợp lệ, xin thử lại sau!";
	// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
			$URL= "../quantri.php#mh";
			header("Location: $URL");
		} else {
			echo "Sorry, there was an error uploading your file.";
		}
	}
}

		$URL= "../quantri.php#mh";
		header("Location: $URL");
?>