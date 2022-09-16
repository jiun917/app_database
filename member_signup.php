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
    $rsp['msg']='帳號不可為空';
    echo json_encode($rsp);
    exit();
}else if($password==""){
    $rsp['ok']=false;
    $rsp['msg']='密碼不可為空';
    echo json_encode($rsp);
    exit();
}

//連結資料庫
require_once("connMysql.php");

//選擇資料庫
$sql = "SELECT `user_num`
        FROM `user`
        WHERE `account`='$account'";

$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);


// if($row){
//     $datas['msg']='可以註冊';
//     $datas['ok'] = true;
// }else{
//     $datas['msg']='不可以註冊';
//     $datas['ok'] = false;
// }

// echo json_encode($datas); 

if($row){
    $datas['ok'] = false;
    $datas['msg'] = '帳號已經存在';
}else{
    $sql = "INSERT INTO 
                `user`(`user_num`,`account`,`password`)
            VALUE 
                ('$account','$account','$password')";
    $result = mysqli_query($link, $sql);
    
    $datas['ok'] = true;
}

echo json_encode($datas);

mysqli_close($link);
?>