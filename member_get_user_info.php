<?php
header("Content-Type: text/html; charset=utf-8");
date_default_timezone_set("Asia/Taipei");
header("Access-Control-Allow-Origin: *");





$user_num = $_GET['user_num'] == "" ? "" : $_GET['user_num'];

$rsp = array();
if($user_num==""){
    $rsp['ok']=false;
    $rsp['err_msg']='系統錯誤';
    echo json_encode($rsp);
    exit();
}


//連結資料庫
require_once("connMysql.php");


$sql = "SELECT 
            `name`,
            `password`,
            `birthday`,
            `email`,
            `address`,
            `phone`,
            `avatar`,
            `gender`,
            `point`
        FROM 
            `user`
        WHERE
            `user_num` = $user_num";


$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);

if($row){
    $datas['name'] = $row['name'];
    $datas['password'] = $row['password'];
    $datas['birthday'] = $row['birthday'];
    $datas['email'] = $row['email'];
    $datas['address'] = $row['address'];
    $datas['phone'] = $row['phone'];
    $datas['avatar'] = $row['avatar'];
    $datas['gender'] = $row['gender'];
    $datas['point'] = $row['point'];
}
echo(json_encode($datas));



mysqli_close($link);
?>