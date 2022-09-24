<?php
header("Content-Type: text/html; charset=utf-8");
date_default_timezone_set("Asia/Taipei");
header("Access-Control-Allow-Origin: *");


$rsp = array();
//接收前端的資料
$user_num = $_GET['user_num'] == "" ? "" : $_GET['user_num'];
if($user_num==""){
    $rsp['ok']=false;
    $rsp['err_msg']='資料表名稱不可為空';
    echo json_encode($rsp);
    exit();
}

//連結資料庫
require_once("connMysql.php");

//選擇資料庫


$sql = "SELECT 
            shop.s_name,
            shop.s_num,
            shop.s_classification,
            shop.s_logo,
            ROUND(AVG(shopcomment.s_rating),0) 's_rating' 
        FROM  shop
        INNER JOIN collect
        ON 
            shop.s_num = collect.s_num
        LEFT JOIN shopcomment
        ON
            shop.s_num = shopcomment.s_num 
        WHERE 
            collect.user_num = $user_num
        GROUP BY 
            shopcomment.s_num";

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
    }else{
        $datas['ok'] = 'nodata';
    }
}; // 從結果集中取得一行作為列舉陣列，存入row陣列中
echo(json_encode($datas)); //返回相應陣列，不是用return

mysqli_close($link);
?>