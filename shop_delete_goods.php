<?php
header("Content-Type: text/html; charset=utf-8");
date_default_timezone_set("Asia/Taipei");
header("Access-Control-Allow-Origin: *");


$rsp = array();
//接收前端的資料
$g_num = $_GET['g_num'] == "" ? "" : $_GET['g_num'];



$rsp = array();
if($g_num==""){
    $rsp['ok']=false;
    $rsp['err_msg']='系統錯誤';
    echo json_encode($rsp);
    exit();
}

//連結資料庫
require_once("connMysql.php");


$sql = "DELETE FROM
            goods
        WHERE 
            g_num = $g_num";

$result = mysqli_query($link, $sql);





mysqli_close($link)
?>