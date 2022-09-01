<?php
header("Content-Type: text/html; charset=utf-8");
date_default_timezone_set("Asia/Taipei");
header("Access-Control-Allow-Origin: *");


$rsp = array();
//接收前端的資料
$s_num = $_GET['s_num'] == "" ? "" : $_GET['s_num'];
$new_g_name = $_GET['new_g_name'] == "" ? "" : $_GET['new_g_name'];
$new_g_description = $_GET['new_g_description'] == "" ? "" : $_GET['new_g_description'];
$new_g_price = $_GET['new_g_price'] == "" ? "" : $_GET['new_g_price'];


$rsp = array();
if($s_num=="" || $new_g_name=="" || $new_g_price=="" || $new_g_description==""){
    $rsp['ok']=false;
    $rsp['err_msg']='資料表名稱不可為空';
    echo json_encode($rsp);
    exit();
}

//連結資料庫
require_once("connMysql.php");


$sql = "INSERT INTO 
            goods(s_num,g_name,g_description,g_price)
        VALUES
            ('$s_num','$new_g_name','$new_g_description','$new_g_price')";

$result = mysqli_query($link, $sql);





mysqli_close($link)
?>