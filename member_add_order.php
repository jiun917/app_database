<?php
header("Content-Type: text/html; charset=utf-8");
date_default_timezone_set("Asia/Taipei");
header("Access-Control-Allow-Origin: *");





$user_num = $_GET['user_num'] == "" ? "" : $_GET['user_num'];
$s_num = $_GET['s_num'] == "" ? "" : $_GET['s_num'];
$date = $_GET['date'] == "" ? "" : $_GET['date'];
$o_discount = $_GET['o_discount'] == "" ? "" : $_GET['o_discount'];



//連結資料庫
require_once("connMysql.php");


$sql = "INSERT INTO 
            `order`(user_num,s_num,o_datetime,o_state,o_discount)
        VALUES
            ('$user_num','$s_num','$date','未接單','$o_discount')";

// $result = mysqli_query($link, $sql);
if (mysqli_query($link, $sql)) {
    $last_id = mysqli_insert_id($link);
    echo ($last_id);
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($link);
}




mysqli_close($link)
?>