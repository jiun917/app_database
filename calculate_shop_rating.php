<?php

//連結資料庫
require_once("connMysql.php");

// $sql = "SELECT s_num, AVG(s_rating) 'Average s_rating' FROM shopcomment_s GROUP BY s_num";
// $sql = "SELECT * FROM shop_s INNER JOIN shopcomment_s ON shop_s.s_num = shopcomment_s.s_num ";
$sql = "SELECT shop_s.s_num,shop_s.s_name,shop_s.s_slogan,ROUND(AVG(s_rating),0) 's_rating' FROM shopcomment_s INNER JOIN shop_s ON shop_s.s_num=shopcomment_s.s_num GROUP BY shopcomment_s.s_num";

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
}else{
    die($link->error);
}

echo(json_encode($datas)); //返回相應陣列，不是用return


mysqli_close($link);
?>