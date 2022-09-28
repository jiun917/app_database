<?php
header("Content-Type: text/html; charset=utf-8");
date_default_timezone_set("Asia/Taipei");
header("Access-Control-Allow-Origin: *");


$rsp = array();
//接收前端的資料
$o_num = $_GET['o_num'] == "" ? "" : $_GET['o_num'];
$maketime = $_GET['maketime'] == "" ? "" : $_GET['maketime'];
$finishtime = $_GET['finishtime'] == "" ? "" : $_GET['finishtime'];

echo($maketime);

$rsp = array();
if($o_num=="" || $maketime==""){
    $rsp['ok']=false;
    $rsp['err_msg']='系統錯誤';
    echo json_encode($rsp);
    exit();
}


//連結資料庫
require_once("connMysql.php");


$sql = "UPDATE 
            `order`
        SET 
            `o_maketime` = '$maketime',
            `o_finishtime` = '$finishtime'
        WHERE
            `o_num` = $o_num";

$result = mysqli_query($link, $sql);





mysqli_close($link)
?>