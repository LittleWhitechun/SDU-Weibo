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

$account=$_POST['account'];
//$limit=1;
$sql="select last_login_time from blog_actpsw where account='$account'";
$query=$conn->query($sql);

$blogs=array();
while($row=$query->fetch_array()){
    $blogs[]=$row;
//        echo " title:".$row["title"]." content:".$row["content"]." style:".$row['style'];
}
$json=json_encode(array("blogs"=>$blogs));
echo $json;

$conn->close();

?>