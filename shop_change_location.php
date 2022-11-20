<?php
header("Content-Type: text/html; charset=utf-8");
date_default_timezone_set("Asia/Taipei");
header("Access-Control-Allow-Origin: *");


$rsp = array();
//接收前端的資料
$s_num = $_GET['s_num'] == "" ? "" : $_GET['s_num'];
$x = $_GET['x'] == "" ? "" : $_GET['x'];
$y = $_GET['y'] == "" ? "" : $_GET['y'];



$rsp = array();
if($s_num=="" || $x=="" || $y==""){
    $rsp['ok']=false;
    $rsp['err_msg']='資料表名稱不可為空';
    echo json_encode($rsp);
    exit();
}

//連結資料庫
require_once("connMysql.php");


$sql = "UPDATE 
            shop
        SET 
            s_longitude = '$x',
            s_latitude = '$y'
        WHERE
            s_num = $s_num";

$result = mysqli_query($link, $sql);





mysqli_close($link)
?>