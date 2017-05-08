<style>
	form{position: fixed;
  top: 50%;
  left: 50%;
  /* bring your own prefixes */
  transform: translate(-50%, -80%);}
  input{outline: none;
    padding: 5px 10px;
    width: 360px;
    border: none;
    border-bottom: 3px solid #ddd;
    font-family: segoe ui light;
    transition: 1s;
}
input:focus, textarea:focus{
	border-color: #0066ff;
	border-width: 3px;
}
textarea {
	outline: none;
    padding: 5px 10px;
    width: 360px;
	max-width: 360px;
    border: none;
    border-bottom: 3px solid #ddd;
    font-family: segoe ui light;
    transition: 0.2s;
	
}

input[type=submit] {
	    background: #03A9F4;
    color: #fff;
    border-color: #0288D1;
    width: 125px;
}
</style>

<?php
	session_start();
	if($_GET['thaotac']=="them")
	{
?>
	<form class='form'>
		<input placeholder='Tên mặt hàng' type='text' name='tenmh' required='required'/><br/>
		<input placeholder='Nhà cung cấp' type='text' name='tenmh' required='required'/><br/>
		<input placeholder='Loại hàng' type='text' name='tenmh' required='required'/><br/>
		<input placeholder='Số lượng' type='text' name='tenmh' required='required'/><br/>
		<input placeholder='Giá' type='number' name='tenmh' required='required'/><br/>
		<textarea placeholder='Mô tả' type='text' name='tenmh' required='required'></textarea>
		<p align='center'>
			<input type='submit' value='THÊM'/>
		</p>
	</form>
<?php
	}
	else if($_GET['thaotac']=="sua")
	{
		$ma = $_GET['ma'];
	}
	else if($_GET['thaotac']=="xoa")
	{
		$ma = $_GET['ma'];
	}
?>
