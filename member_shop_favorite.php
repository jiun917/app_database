<?php
header("Content-Type: text/html; charset=utf-8");
date_default_timezone_set("Asia/Taipei");
header("Access-Control-Allow-Origin: *");





$user_num = $_GET['user_num'] == "" ? "" : $_GET['user_num'];
$shop_num = $_GET['shop_num'] == "" ? "" : $_GET['shop_num'];




//連結資料庫
require_once("connMysql.php");


$sql = "INSERT INTO 
            `collect`(`user_num`,`s_num`)
        VALUES
            ('$user_num','$shop_num')";


$result = mysqli_query($link, $sql);



mysqli_close($link)
?>