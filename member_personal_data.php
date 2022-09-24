<!-- <?php
header("Content-Type: text/html; charset=utf-8");
date_default_timezone_set("Asia/Taipei");
header("Access-Control-Allow-Origin: *");





$user_num = $_GET['user_num'] == "" ? "" : $_GET['user_num'];


$datas = array();

//連結資料庫
require_once("connMysql.php");


$sql = "SELECT 
            `name`,
            `point`,
            `birthday`,
            `address`,
            `gender`,
            `avatar`
        FROM 
            `user`
        WHERE
            `user_num` = $user_num";


$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);

if($row){
    $datas['name'] = $row['name'];
    $datas['point'] = $row['point'];
    $datas['birthday'] = $row['birthday'];
    $datas['address'] = $row['address'];
    $datas['gender'] = $row['gender'];
    $datas['avatar'] = $row['avatar'];
}

echo json_encode($datas); 






mysqli_close($link)
?> -->