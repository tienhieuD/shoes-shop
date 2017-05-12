<style>
form{position:fixed;top:50%;left:50%;transform:translate(-50%,-50%)}input{outline:none;padding:5px 10px;width:360px;border:none;border-bottom:3px solid #ddd;font-family:segoe ui light;transition:1s}input:focus,textarea:focus{border-color:#06f;border-width:3px}textarea{outline:none;padding:5px 10px;width:360px;max-width:360px;border:none;border-bottom:3px solid #ddd;font-family:segoe ui light;transition:.2s}input[type=submit]{background:#03A9F4;color:#fff;border-color:#0288D1;width:125px}
</style>

<?php
	if(isset($_POST['email'])) 
	{
		$email = $_POST['email'];
		
		if (emailTonTai($email)) {
			showForm("Email đã tồn tại rồi!<br/>");
		}
		else {
			$mk1	=	$_POST['mk1'];
			$mk2	=	$_POST['mk2'];
			if ($mk1 != $mk2)
				showForm("Mật khẩu không trùng nhau<br/>");
			//if
			else {
				$tenkh	=	$_POST['tenkh'];
				$dc		=	$_POST['dc'];
				$dt		=	$_POST['dt'];
				$mk1 	= 	substr(md5($mk2),1,12); 
				include('connect.php');
				$sql="	INSERT INTO `khachhang`
							(`TENKHACHHANG`, `DIACHI`, `EMAIL`, `MATKHAU`, `DIENTHOAI`) 
						VALUES 
							('$tenkh','$dc','$email','$mk1','$dt')";
				$conn->query($sql);
				echo $sql;
				$URL="login.php";
				header("Location: $URL");
			}
		}
	}
	else
	{
		showForm(" ");
	} 

function emailTonTai($email) {
	include('connect.php');
	$sql="SELECT * FROM `khachhang` WHERE `EMAIL` = '$email'";
	$kq = $conn->query($sql);
	return ($kq->num_rows > 0);
}

function showForm($x) {
	echo "
	<form class='form' method='post'>
		$x
		<input placeholder='Email' 				type='email' 			name='email' pattern='[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$' required='required'/><br/>
		<input placeholder='Mật khẩu' 			type='password' 		name='mk1' 	 pattern='(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}' title='Ít nhất 6 ký tự, phải bao gồm cả chữ IN HOA và số!' required='required'/><br/>
		<input placeholder='Nhập lại mật khẩu' 	type='password' 		name='mk2'   pattern='(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}' title='Ít nhất 6 ký tự, phải bao gồm cả chữ IN HOA và số!' required='required'/><br/>
		<input placeholder='Họ và tên' 			type='text' 			name='tenkh' required='required'/><br/>
		<input placeholder='Địa chỉ' 			type='text' 			name='dc' required='required'/><br/>
		<input placeholder='Điện thoại' 		type='number' 			name='dt' required='required'/>
		<p align='center'>
			<input type='submit' name='submit' value='ĐĂNG KÝ'/>
		</p>
	</form>";
}

?>