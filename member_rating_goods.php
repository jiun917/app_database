<?php
header("Content-Type: text/html; charset=utf-8");
date_default_timezone_set("Asia/Taipei");
header("Access-Control-Allow-Origin: *");


$rsp = array();
//接收前端的資料

$o_num = $_GET['o_num'] == "" ? "" : $_GET['o_num'];
$date = $_GET['date'] == "" ? "" : $_GET['date'];
$rating_info = $_GET['rating_info'] == "" ? "" : $_GET['rating_info'];






//連結資料庫
require_once("connMysql.php");

    
    $data = array();

    foreach($rating_info as $key => $value) {
        $data = json_decode($value,true);
        $g_num = mysqli_real_escape_string($link, $data["g_num"]);
        $star = mysqli_real_escape_string($link, $data["star"]);
        $text = mysqli_real_escape_string($link, $data["text"]);
        
        $sql="UPDATE orderdetail 
              SET g_commentdate='$date',g_rating='$star',g_comment='$text' 
              WHERE o_num=$o_num AND g_num=$g_num";
        mysqli_query($link,$sql);
    }
    



mysqli_close($link)
?>