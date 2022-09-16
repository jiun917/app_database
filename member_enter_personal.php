<?php
header("Content-Type: text/html; charset=utf-8");
date_default_timezone_set("Asia/Taipei");
header("Access-Control-Allow-Origin: *");


$msg = array();

$account = $_GET['account'] == "" ? "" : $_GET['account'];
$name = $_GET['name'] == "" ? "" : $_GET['name'];
$date = $_GET['date'] == "" ? "" : $_GET['date'];
$mail = $_GET['mail'] == "" ? "" : $_GET['mail'];
$phone = $_GET['phone'] == "" ? "" : $_GET['phone'];
$address = $_GET['address'] == "" ? "" : $_GET['address'];






//連結資料庫
require_once("connMysql.php");

$msg['account'] = $account;
$msg['name'] = $name;
$msg['date'] = $date;
$msg['mail'] = $mail;
$msg['phone'] = $phone;
$msg['address'] = $address;

// $sql = "UPDATE 
//             goods
//         SET 
//             g_name = '$new_g_name',
//             g_description = '$new_g_description',
//             g_price = '$new_g_price'
//         WHERE
//             g_num = $g_num";

$sql = "UPDATE 
            `user` 
        SET 
            `name` = '$name',
            `birthday` = '$date',
            `email` = '$mail',
            `address` = '$address',
            `phone` = '$phone'
        WHERE
            `account` = '$account'";


$result = mysqli_query($link, $sql);

if($result){
    $msg['ok'] = true;
}
echo json_encode($msg);


mysqli_close($link)
?>