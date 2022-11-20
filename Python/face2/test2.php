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
			document.getElementById('my_result').innerHTML = '<img id="img_uri" src="'+data_uri+'"/>';
		});
	}
    // 圖片字首
	var pre = 0;
	
	function upload() {
		var img_uri = document.getElementById('img_uri').src;    // 圖片資訊
		pre += 1;
		if (img_uri.length == 0) {
			alert("拍照失敗");
			return false;
		}

		// 將引數一起傳給PHP
		Webcam.upload(img_uri, 'test22.php?pre='+pre, function(code, text) {
			alert(text);
			if (pre == 10){
			location.href='best.php';
			}
		});

		
	}
	</script>

	</form>
	
</body> 
</html>