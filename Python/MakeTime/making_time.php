<?php
header("Content-Type: text/html; charset=utf-8");
date_default_timezone_set("Asia/Taipei");
header("Access-Control-Allow-Origin: *");

$o_num = $_GET['o_num'] == "" ? "" : $_GET['o_num'];

//連結資料庫
require_once("connMysql.php");

//選擇餐廳的代碼、名稱、標語、和所有餐廳評分做平均
$sql = "SELECT 
            orderdetail.o_num,
            goods.g_num,
            orderdetail.g_quantity,
            goods.g_maketime
        FROM 
            orderdetail
        LEFT JOIN
            goods
        ON 
            goods.g_num=orderdetail.g_num
        where
            orderdetail.o_num = $o_num";

$result = mysqli_query($link, $sql);


$x = 0;
while ($row = mysqli_fetch_assoc($result))
      {
      	$g_maketime = (int)$row['g_maketime'];
		$x += (int)$g_maketime;
      }


mysqli_close($link);//關閉資料庫

$result = shell_exec('python tem.py ' . escapeshellarg($x));
$resultData = json_decode($result, true);
echo($resultData)
// echo (json_encode($resultData))
?>