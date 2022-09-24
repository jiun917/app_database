<?php
header("Content-Type: text/html; charset=utf-8");
date_default_timezone_set("Asia/Taipei");
header("Access-Control-Allow-Origin: *");






//連結資料庫
require_once("connMysql.php");


$sql = "SELECT 
            s_num,
            s_name,
            s_longitude,
            s_latitude,
            s_logo
        FROM 
            shop";


$result = mysqli_query($link, $sql);


if ($result) {
    // mysqli_num_rows方法可以回傳我們結果總共有幾筆資料
    if (mysqli_num_rows($result)>0) {
        // 取得大於0代表有資料
        // while迴圈會根據資料數量，決定跑的次數
        // mysqli_fetch_assoc方法可取得一筆值
        while ($row = mysqli_fetch_assoc($result)) {
            // 每跑一次迴圈就抓一筆值，最後放進data陣列中
            $datas[] = $row;
        }
    }
}else{
    die($link->error);
}


echo(json_encode($datas));





mysqli_close($link)
?>