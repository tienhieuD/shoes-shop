<!DOCTYPE html>
<html>
	<head>
		<script type='text/javascript'>
			function showHint(str) {
				if (str.length==0) {
					document.getElementById('txtHint').innerHTML = '';
					return;
				}
				
				xmlHttp = getHTTPObject();
				
				if(xmlHttp == null) {
					alert("Vohox");
					return;
				}
				
				var url='getnameajax.php';
				url = url+"?q="+str;
				xmlHttp.onreadystatechange=stateChanged;
				xmlHttp.open("GET",url,true);
				xmlHttp.send(null);
			}
			
			var xmlHttp = getHTTPObject();
			
			function getHTTPObject() {
				var xmlhttp;
				if (window.XMLHttpRequest) {
					xmlhttp = new XMLHttpRequest();
				} else if (window.ActiveXObject) {
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
				return xmlhttp;
			}
			
			function stateChanged() {
				if (xmlHttp.readyState==4) {
					document.getElementById('txtHint').innerHTML = xmlHttp.responseText;
				}
			}
		</script>
	</head>

	<body>
		<form>
			Tên sản phẩm: <input type='text' id='txt1' onkeyup='showHint(this.value)'/>
		</form>
		<p> Danh sách sản phẩm: </p>
		<span id='txtHint'></span>
	</body>
</html>