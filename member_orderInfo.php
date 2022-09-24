<?php
header("Content-Type: text/html; charset=utf-8");
date_default_timezone_set("Asia/Taipei");
header("Access-Control-Allow-Origin: *");


$rsp = array();
//接收前端的資料
$order_num = $_GET['order_num'] == "" ? "" : $_GET['order_num'];
if($order_num==""){
    $rsp['ok']=false;
    $rsp['err_msg']='資料表名稱不可為空';
    echo json_encode($rsp);
    exit();
}

//連結資料庫
require_once("connMysql.php");

//選擇資料庫


$sql = "SELECT 
            orderdetail.o_num,
            goods.g_name,
            orderdetail.g_num,
            orderdetail.g_price,
            orderdetail.g_quantity,
            order.s_num,
            order.o_state,
            order.o_discount,
            order.o_datetime,
            shop.s_name,
            shop.s_logo,
            shop.s_pic
        FROM  orderdetail
        LEFT JOIN goods
        ON 
            goods.g_num = orderdetail.g_num 
        INNER JOIN `order`
        ON 
            orderdetail.o_num = order.o_num
        INNER JOIN shop
        ON
            order.s_num = shop.s_num
        WHERE 
            orderdetail.o_num = $order_num";

$result = mysqli_query($link, $sql);
if ($result) {
    // mysqli_num_rows方法可以回傳我們結果總共有幾筆資料
    if (mysqli_num_rows($result)>0) {
        // 取得大於0代表有資料
        // while迴圈會根據資料數量，決定跑的次數
        // mysqli_fetch_assoc方法可取得一筆值
        while ($row = mysqli_fetch_assoc($result)) {
            // 每跑一次迴圈就抓一筆值，最後放進data陣列中
            $datas[] = $row;
        }
    }
}; // 從結果集中取得一行作為列舉陣列，存入row陣列中
echo(json_encode($datas)); //返回相應陣列，不是用return

mysqli_free_result($result);
mysqli_close($link);
?>