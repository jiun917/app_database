<?php
header("Content-Type: text/html; charset=utf-8");
date_default_timezone_set("Asia/Taipei");
header("Access-Control-Allow-Origin: *");


$rsp = array();
//接收前端的資料
$o_num = $_GET['o_num'] == "" ? "" : $_GET['o_num'];
$o_state = $_GET['o_state'] == "" ? "" : $_GET['o_state'];


$rsp = array();
if($o_num=="" || $o_state==""){
    $rsp['ok']=false;
    $rsp['err_msg']='系統錯誤';
    echo json_encode($rsp);
    exit();
}
if($o_state=='未接單'){
    $state = '已拒絕';
}else{
    $state = '已取消';
}
echo($o_num.",".$state);
//連結資料庫
require_once("connMysql.php");


$sql = "UPDATE 
            `order`
        SET 
            o_state = '$state'
        WHERE
            o_num = $o_num";

$result = mysqli_query($link, $sql);





mysqli_close($link)
?>