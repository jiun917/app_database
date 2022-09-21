<?php
header("Content-Type: text/html; charset=utf-8");
date_default_timezone_set("Asia/Taipei");
header("Access-Control-Allow-Origin: *");





$shop_num = $_GET['shop_num'] == "" ? "" : $_GET['shop_num'];




//連結資料庫
require_once("connMysql.php");


$sql = "SELECT 
            shop.s_num,
            shop.s_name,
            shop.s_slogan,
            ROUND(AVG(shopcomment.s_rating),0) 's_rating' 
        FROM 
            shopcomment
        INNER JOIN 
            shop 
        ON 
            shop.s_num = shopcomment.s_num 
        WHERE
            shop.s_num = $shop_num
        GROUP BY 
            shopcomment.s_num";


$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);

if($row){
    $datas['s_name'] = $row['s_name'];
    $datas['s_num'] = $row['s_num'];
    $datas['s_slogan'] = $row['s_slogan'];
    $datas['s_rating'] = $row['s_rating'];
}
echo(json_encode($datas));

// $result = mysqli_query($link, $sql);
// if ($result) {
//     // mysqli_num_rows方法可以回傳我們結果總共有幾筆資料
//     if (mysqli_num_rows($result)>0) {
//         // 取得大於0代表有資料
//         // while迴圈會根據資料數量，決定跑的次數
//         // mysqli_fetch_assoc方法可取得一筆值
//         while ($row = mysqli_fetch_assoc($result)) {
//             // 每跑一次迴圈就抓一筆值，最後放進data陣列中
//             $datas[] = $row;
//         }
//     }
// }else{
//     die($link->error);
// }
// echo(json_encode($datas));





mysqli_close($link)
?>