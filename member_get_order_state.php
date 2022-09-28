<?php
header("Content-Type: text/html; charset=utf-8");
date_default_timezone_set("Asia/Taipei");
header("Access-Control-Allow-Origin: *");





$order_num = $_GET['order_num'] == "" ? "" : $_GET['order_num'];





//連結資料庫
require_once("connMysql.php");


$sql = "SELECT 
            o_finishtime,
            o_state
        FROM
            `order`
        WHERE
            o_num = $order_num";


$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);

if ($row) {
    echo json_encode($row);
}

mysqli_close($link)
?>