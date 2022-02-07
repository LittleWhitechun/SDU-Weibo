<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/11
 * Time: 9:36
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

$newsid=$_POST['newsid'];

$sql="select * from blog_comment where newsid=".$newsid;
$query=$conn->query($sql);
$blogs=array();

while($row=$query->fetch_array()){
    $blogs[]=$row;
}
$json=json_encode(array("blogs"=>$blogs));
echo $json;

?>