<nav id='nav'>
	<ul>
		<li><a href='/site_home.xhtml'>Home</a>
		</li>
		<li><a href='/site_1.xhtml'>New</a>
		</li>
		<li><a href='/site_2.xhtml'>Saleoff</a>
		</li>
		<li><a href='/site_3.xhtml'>Giỏ hàng</a>
		</li>
	</ul>
</nav>
<div class='logo'>
	<a href='/index.php'>MatGiay<p class='slogan'> Shob best shoe in Vitnomsee.</p> </a>
</div>
<div class='main-menu' id ="main-menu">

	<?php 
		require('connect.php');
		
		$sqlloaihang = "SELECT * FROM loaihang";
		$result = $conn->query($sqlloaihang);
		
		if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$maloaihang = $row["MALOAIHANG"];
			$tenloaihang = $row["TENLOAIHANG"];
			
			echo "<a href='#'> $tenloaihang </a>";
		}
		} else {
			echo "0 results";
		}
		$conn->close();
	?>
	</div>
	<div class='search'>
	<input type='text' placeholder='Gõ để tìm kiếm...'/>
	<button> Tìm </button>
</div>

<style>
.btn-group {        font-size: 0;
    margin-top: 25px;}
.btn-group a {    border: 1px solid;
    padding: 5px 12px;
    font-size: 15px;
    margin: 2px;
    border-radius: 2px;}
.btn-group a:hover {    
background-color: #78909C;
    color: #fff;
    transition: 0.5s;
    border: 1px solid #607D8B;
	}
.search {
display: inline-block;
    background: #FFF;
    padding: 0;
    border: 1px solid #CFD8DC;
    margin: 10px 10px 0 10px;
    position: absolute;
    right: 0;
}
.search input[type='text'] {
	    border: 0;
    font-size: 13px;
    font-family: segoe ui light;
    outline: none;
}
.search button {
background: #FFF;
    border: 0;
    padding-right: 10px;
    text-transform: uppercase;
    font-family: segoe ui light;
    font-weight: bold;
    margin-top: 5px;
    padding-left: 9px;
    border-left: 1px solid #F5F5F5;
    outline: none;
    color: #607D8B;
}
.main-menu a {
	color: #FFF;
    display: inline-block;
    margin: 6px 10px 6px 0px;
    font-size: 10pt;
    text-transform: uppercase;
    border-right: 1px solid #B0BEC5;
    padding-right: 10px;
}
.main-menu>a:nth-last-child(1){
    border-right: none;
}
.main-menu {
	background: #90A4AE;
    color: #FFF;
    padding: 5px 20px;
    font-size: 0;
}
</style>