<?php
header("Content-Type: text/html; charset=utf-8");
date_default_timezone_set("Asia/Taipei");
header("Access-Control-Allow-Origin: *");


$rsp = array();
//接收前端的資料

$user_num = $_GET['user_num'] == "" ? "" : $_GET['user_num'];
$date = $_GET['date'] == "" ? "" : $_GET['date'];
$rating_info = $_GET['rating_info'] == "" ? "" : $_GET['rating_info'];






//連結資料庫
require_once("connMysql.php");

    
    $data = array();

    foreach($rating_info as $key => $value) {
        $data = json_decode($value,true);
        $s_num = mysqli_real_escape_string($link, $data["s_num"]);
        $star = mysqli_real_escape_string($link, $data["star"]);
        $text = mysqli_real_escape_string($link, $data["text"]);
        echo($s_num);
        
        $sql="UPDATE shopcomment 
              SET s_commentdate='$date',s_rating='$star',s_comment='$text' 
              WHERE s_num=$s_num AND user_num=$user_num";
        mysqli_query($link,$sql);
    }
    



mysqli_close($link)
?>