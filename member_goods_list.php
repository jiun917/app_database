<?php
header("Content-Type: text/html; charset=utf-8");
date_default_timezone_set("Asia/Taipei");
header("Access-Control-Allow-Origin: *");


$rsp = array();
//接收前端的資料
$data_shop_num = $_GET['data_shop_num'] == "" ? "" : $_GET['data_shop_num'];
if($data_shop_num==""){
    $rsp['ok']=false;
    $rsp['err_msg']='資料表名稱不可為空';
    echo json_encode($rsp);
    exit();
}

//連結資料庫
require_once("connMysql.php");

//選擇資料庫
// $sql = "SELECT shop_s.s_name,shop_s.s_slogan,good_s.g_name,good_s.g_description,good_s.g_price FROM shop_s INNER JOIN good_s ON shop_s.s_num=good_s.s_num  where shop_s.s_num = $data_shop_num";
// $sql = "SELECT shop_s.s_name,shop_s.s_slogan,good_s.g_name,good_s.g_description,good_s.g_price,orderdetail_s.g_rating,AVG(shopcomment_s.s_rating) FROM shop_s INNER JOIN good_s ON shop_s.s_num = good_s.s_num INNER JOIN shopcomment_s ON shop_s.s_num=shopcomment_s.s_num LEFT JOIN orderdetail_s ON good_s.g_num = orderdetail_s.g_num WHERE shop_s.s_num = $data_shop_num";
$sql = "SELECT 
                shop.s_name,
                shop.s_slogan,
                shop.s_estimatedtime,
                goods.g_name,
                goods.g_description,
                goods.g_price,
                ROUND(AVG(IFNULL(shopcomment.s_rating,0)),0) 's_rating',
                ROUND(AVG(IFNULL(orderdetail.g_rating,0)),0) 'g_rating'
        FROM  goods
        LEFT JOIN orderdetail
        ON 
            goods.g_num = orderdetail.g_num 
        LEFT JOIN shop
        ON
            shop.s_num = goods.s_num
        LEFT JOIN shopcomment
        ON
            shop.s_num = shopcomment.s_num
        WHERE 
            goods.s_num = $data_shop_num
        GROUP BY goods.g_num,shop.s_num";

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