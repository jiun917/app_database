<?php
  header("Content-Type: text/html; charset=utf-8");
  session_start();
?>
<!doctype html>
<html>
  <head>
    <meta charset='utf-8'>
	<title>上傳圖片</title>
  </head>
<body>
	<form method="post" action="test01.php" enctype="multipart/form-data">
	<div id="my_camera"></div>
	<div id="my_result"></div>

	<a href="javascript:void(take_snapshot())">點選拍照</a></br></br>
	<a href="javascript:void(take_remake())">重新拍照</a></br></br>
	<a href="javascript:void(upload())">點選上傳照片</a></br>
	<!-- 引入 webcam.js 檔案 -->
	<script src="webcam.js"></script>

	<script language="JavaScript">

	//設定鏡頭的大小
	Webcam.set({
		width: 320,
		height: 240,
		image_format: 'jpeg',
		jpeg_quality: 90
	}); 

	Webcam.attach( '#my_camera' );

	// 拍照
	function take_snapshot() {
		Webcam.snap( function(data_uri) {
			// 點選拍照後，將照片放回頁面
			document.getElementById('my_camera').innerHTML = '<img id="img_uri" src="'+data_uri+'"/>';

		});
	}
	function take_remake() {
		Webcam.attach( '#my_camera' );
	}
	function upload() {
		var img_uri = document.getElementById('img_uri').src;    // 圖片資訊
		var pre     = 1;      // 圖片字首

		if (img_uri.length == 0) {
			alert("拍照失敗");
			return false;
		}

		if (pre.length == 0) {
			alert("請輸入儲存後的圖片的字首");
			return false;
		}

		// 將引數一起傳給PHP
		Webcam.upload(img_uri, 'test01.php?pre='+pre, function(code, text) {
			alert(text);
			location.reload();
		});    
	}
	</script>

	</form>
	
</body> 
</html>