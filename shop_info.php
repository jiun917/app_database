<?php
header("Content-Type: text/html; charset=utf-8");
date_default_timezone_set("Asia/Taipei");
header("Access-Control-Allow-Origin: *");





$s_num = $_GET['s_num'] == "" ? "" : $_GET['s_num'];

$rsp = array();
if($s_num==""){
    $rsp['ok']=false;
    $rsp['err_msg']='系統錯誤';
    echo json_encode($rsp);
    exit();
}


//連結資料庫
require_once("connMysql.php");


$sql = "SELECT 
            `s_name`,
            `s_longitude`,
            `s_latitude`
        FROM 
            `shop`
        WHERE
            `s_num` = $s_num";


$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);

if($row){
    $datas['s_name'] = $row['s_name'];
    $datas['s_longitude'] = $row['s_longitude'];
    $datas['s_latitude'] = $row['s_latitude'];
}
echo(json_encode($datas));



mysqli_close($link);
?>