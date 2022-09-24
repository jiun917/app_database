<?php
header("Content-Type: text/html; charset=utf-8");
date_default_timezone_set("Asia/Taipei");
header("Access-Control-Allow-Origin: *");


$rsp = array();
$datas = array();
//接收前端的資料
$account = $_GET['account'] == "" ? "" : $_GET['account'];
$password = $_GET['password'] == "" ? "" : $_GET['password'];

if($account==""){
    $rsp['ok']=false;
    $rsp['err_msg']='帳號不可為空';
    echo json_encode($rsp);
    exit();
}else if($password==""){
    $rsp['ok']=false;
    $rsp['err_msg']='密碼不可為空';
    echo json_encode($rsp);
    exit();
}

//連結資料庫
require_once("connMysql.php");

//選擇資料庫
$sql = "SELECT `s_num`
        FROM `shop`
        WHERE `s_account`='$account' AND `s_password`='$password'";

$result = mysqli_query($link, $sql);

$row = mysqli_fetch_assoc($result);
// echo(json_encode($row));


if($row){
    $datas['s_num'] = $row['s_num'];
    $datas['ok'] = true;
}else{
    $datas['err_msg']='登入失敗，帳號或密碼錯誤';
    $datas['ok'] = false;
}
echo json_encode($datas); 


mysqli_close($link);
?>