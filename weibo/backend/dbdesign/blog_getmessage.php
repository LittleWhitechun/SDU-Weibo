<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/11
 * Time: 18:56
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

$account=$_POST['account'];
$sql="select * from blog_message where receive_id='$account' or send_id='$account' order by m_id desc ";
$query=$conn->query($sql);

$blogs=array();
while($row=$query->fetch_array()){
    $blogs[]=$row;
}
$json=json_encode(array("blogs"=>$blogs));
echo $json;
?>