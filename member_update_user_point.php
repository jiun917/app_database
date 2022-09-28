<?php
header("Content-Type: text/html; charset=utf-8");
date_default_timezone_set("Asia/Taipei");
header("Access-Control-Allow-Origin: *");


$rsp = array();
//接收前端的資料
$user_num = $_GET['user_num'] == "" ? "" : $_GET['user_num'];
$point = $_GET['point'] == "" ? "" : $_GET['point'];



$rsp = array();
if($user_num=="" || $point==""){
    $rsp['ok']=false;
    $rsp['err_msg']='系統錯誤';
    echo json_encode($rsp);
    exit();
}


//連結資料庫
require_once("connMysql.php");


$sql = "UPDATE 
            `user`
        SET 
            `point` = '$point'
        WHERE
            user_num = $user_num";

$result = mysqli_query($link, $sql);





mysqli_close($link)
?>