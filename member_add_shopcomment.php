<?php
header("Content-Type: text/html; charset=utf-8");
date_default_timezone_set("Asia/Taipei");
header("Access-Control-Allow-Origin: *");



//接收前端的資料

$user_num = $_GET['user_num'] == "" ? "" : $_GET['user_num'];
$shop_num = $_GET['shop_num'] == "" ? "" : $_GET['shop_num'];
$order_num = $_GET['order_num'] == "" ? "" : $_GET['order_num'];



//連結資料庫
require_once("connMysql.php");

    

$sql = "INSERT INTO 
            shopcomment(user_num,s_num,o_num)
        VALUES
            ('$user_num','$shop_num','$order_num')";

$result = mysqli_query($link, $sql);




mysqli_close($link)
?>