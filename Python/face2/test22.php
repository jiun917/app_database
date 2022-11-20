<?php
  header("Content-Type: text/html; charset=utf-8");
  session_start();
	$countt = 10;
	$pre = trim($_GET['pre']);
	// 儲存的圖片路徑
	
	// 儲存圖片

	$picture_name = 'pic/'. $countt . $pre . '.jpg';
	$result = move_uploaded_file($_FILES['webcam']['tmp_name'], $picture_name);

	if (!$result) {
		echo "儲存圖片失敗";
		exit();
	}

	$url_raw = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI'])  . $picture_name;
	$url = str_replace('\\', '/', $url_raw);
	echo "上傳成功 \n" . "圖片路徑:" . $url;
	
	if ($pre == 10){
		exec("py rrr.py");
	}
	
?> 
