<?php
header("Content-Type: text/html; charset=utf-8");
date_default_timezone_set("Asia/Taipei");
header("Access-Control-Allow-Origin: *");


// $rsp = array();
// //接收前端的資料
// $data_shop_num = $_GET['data_shop_num'] == "" ? "" : $_GET['data_shop_num'];
// if($data_shop_num==""){
//     $rsp['ok']=false;
//     $rsp['err_msg']='資料表名稱不可為空';
//     echo json_encode($rsp);
//     exit();
// }

//連結資料庫
require_once("connMysql.php");

//選擇資料庫
$sql = "SELECT 
            goods.g_num,
            goods.g_name,
            goods.g_description,
            goods.g_price,
            goods.g_maketime
        FROM  goods
        where
            s_num = 1 ";

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