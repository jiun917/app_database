<?php
header("Content-Type: text/html; charset=utf-8");
date_default_timezone_set("Asia/Taipei");
header("Access-Control-Allow-Origin: *");


//連結資料庫
require_once("connMysql.php");

//選擇資料庫
// $sql = "SELECT shop_s.s_name,shop_s.s_slogan,good_s.g_name,good_s.g_description,good_s.g_price FROM shop_s INNER JOIN good_s ON shop_s.s_num=good_s.s_num  where shop_s.s_num = $data_shop_num";
// $sql = "SELECT shop_s.s_name,shop_s.s_slogan,good_s.g_name,good_s.g_description,good_s.g_price,orderdetail_s.g_rating,AVG(shopcomment_s.s_rating) FROM shop_s INNER JOIN good_s ON shop_s.s_num = good_s.s_num INNER JOIN shopcomment_s ON shop_s.s_num=shopcomment_s.s_num LEFT JOIN orderdetail_s ON good_s.g_num = orderdetail_s.g_num WHERE shop_s.s_num = $data_shop_num";
$sql = "SELECT 
            order.o_num,
            goods.g_name,
            orderdetail.g_price,
            orderdetail.g_quantity
        FROM  `order`
        LEFT JOIN orderdetail
        ON 
            order.o_num = orderdetail.o_num
        LEFT JOIN goods
        ON
            orderdetail.g_num = goods.g_num";

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