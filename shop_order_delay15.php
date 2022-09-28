<?php
header("Content-Type: text/html; charset=utf-8");
date_default_timezone_set("Asia/Taipei");
header("Access-Control-Allow-Origin: *");



$o_num = $_GET['o_num'] == "" ? "" : $_GET['o_num'];


//連結資料庫
require_once("connMysql.php");


$sql = "SELECT 
            date_add(o_finishtime,interval 15 minute)
        FROM 
            `order`
        WHERE
            `o_num`=$o_num";


$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);
$time = $row['date_add(o_finishtime,interval 15 minute)'];
if($row){
    $data['time'] = $row['date_add(o_finishtime,interval 15 minute)'];
}



$sql = "UPDATE 
            `order`
        SET 
            `o_finishtime` = '$time'
        WHERE
            `o_num` = $o_num";
$result = mysqli_query($link, $sql);


echo(json_encode($data));


mysqli_close($link)
?>