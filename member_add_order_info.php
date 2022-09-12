<?php
header("Content-Type: text/html; charset=utf-8");
date_default_timezone_set("Asia/Taipei");
header("Access-Control-Allow-Origin: *");


$rsp = array();
//接收前端的資料

$order_info = $_GET['order_info'] == "" ? "" : $_GET['order_info'];
$order_num = $_GET['order_num'] == "" ? "" : $_GET['order_num'];

echo($order_num);



//連結資料庫
require_once("connMysql.php");

    
    $data = array();

    

    foreach($order_info as $key => $value) {
        $data = json_decode($value,true);
        $val1 = mysqli_real_escape_string($link, $data["num"]);
        $val2 = mysqli_real_escape_string($link, $data["quantity"]);
        $val3 = mysqli_real_escape_string($link, $data["price"]);
        
        $sql="INSERT INTO orderdetail(o_num,g_num,g_quantity,g_price) VALUES ($order_num,'".$val1."','".$val2."','".$val3."')";
        mysqli_query($link,$sql);
    }
    

// $sql = "INSERT INTO 
//             goods(s_num,g_name,g_description,g_price)
//         VALUES
//             ('$s_num','$new_g_name','$new_g_description','$new_g_price')";

// $result = mysqli_query($link, $sql);





mysqli_close($link)
?>