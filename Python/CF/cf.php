<?php
  header("Content-Type: text/html; charset=utf-8");
  session_start();
  $user_num = $_GET['user_num'] == "" ? "" : $_GET['user_num'];
  $result = shell_exec('python itemcf.py ' . escapeshellarg($user_num));
  $resultData = json_decode($result, true);
  $count = count($resultData);
  require_once("connMysql.php");
  $data = array();
  for($i=1;$i<=$count;$i++){
    $sql="SELECT 
            shop.s_num,
            shop.s_name,
            shop.s_slogan,
            shop.s_logo,
            shop.s_pic,
            ROUND(AVG(shopcomment.s_rating),0) 's_rating' 
          FROM 
            goods
          INNER JOIN 
            shop
          ON 
            goods.s_num = shop.s_num
          INNER JOIN
            shopcomment
          WHERE 
            goods.g_num = $resultData[$i]
          GROUP BY
            shopcomment.s_num";
    $result = mysqli_query($link,$sql);
    $row = mysqli_fetch_assoc($result);
    $data[] = $row;
    $newdata[] =$row;
    
  }
  $k = $count-1;
  for($i=0;$i<$k;$i++){
    foreach($newdata as $key => $value){
      if($data[$i]['s_num'] == $value['s_num'] && $i != $key){
        array_splice($newdata, $i, 1);
      }
    }
  }
  
 
  echo(json_encode($newdata));
 


?>