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
            shop.s_pic,
            ROUND(AVG(shopcomment.s_rating),0) 's_rating' 
        FROM 
            shopcomment
        RIGHT JOIN 
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
    $datas['s_pic'] = $row['s_pic'];
    $datas['s_rating'] = $row['s_rating'];
}
echo(json_encode($datas));

mysqli_close($link)
?>