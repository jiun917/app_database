<?php
  header("Content-Type: text/html; charset=utf-8");
  session_start();

  $request_body = file_get_contents('php://input');
  $data = json_decode($request_body, true);


 	$base64_image_content = $data['img'];
	// $base64_image_content= str_replace('data:image/jpeg;base64,', '',$base64_image_content );
	
	$path = 'C:\xampp\htdocs\app_database\Python\face\pic';
	
	$img = base64_image_content($base64_image_content,$path);

	function base64_image_content($base64_image_content,$path){
		global $time;
		$time = time();
		//匹配出圖片的格式
		if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image_content, $result)){
			$type = $result[2];
			$new_file = $path."/";
			if(!file_exists($new_file)){
				//檢查是否有該文件夾，如果沒有就創建，並給予最高權限
				mkdir($new_file, 0700);
			}
			$new_file = $new_file.$time.".{$type}";
			
			if (file_put_contents($new_file, base64_decode(str_replace($result[1], '', $base64_image_content)))){
				return $time.".{$type}";
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	

	$pic = $time.".jpeg";
	
	
	//$img = 圖片檔名+副檔名(舉例:1664882313.jpeg)
	
	$result = shell_exec('py pic\xxx.py ' . escapeshellarg($pic));
	//$resultData = json_decode($result, true);
	echo($result);
?> 
