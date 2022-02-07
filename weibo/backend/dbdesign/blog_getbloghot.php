<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/18
 * Time: 17:20
 */
header('Access-Control-Allow-Origin:*');
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "blogdb";

// 创建连接
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// 检测连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
    $arr=array("data"=>"error");
}


$sql="SELECT newsid FROM blog_thumbsup GROUP BY newsid ORDER BY COUNT(*) DESC";
$query=$conn->query($sql);

$blogs=array();
while($row=$query->fetch_array()){
    $hotid=$row[0];
    $sql2="select * from blog_blogs where id='$hotid'";
    $query2=$conn->query($sql2);
    while($row2=$query2->fetch_array()){
        $blogs[]=$row2;
    }

//        echo " title:".$row["title"]." content:".$row["content"]." style:".$row['style'];
}
$json=json_encode(array("blogs"=>$blogs));
echo $json;

$conn->close();

?>