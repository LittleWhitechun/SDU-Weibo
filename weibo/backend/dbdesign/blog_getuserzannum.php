<?php
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
//$account='jiaohaoran';
$sql="SELECT COUNT(*) FROM blog_blogs,blog_thumbsup WHERE author='$account' AND blog_thumbsup.newsid=blog_blogs.id";
$query=$conn->query($sql);
$num;
$blogs=array();
while($row=$query->fetch_array()){
    $blogs[]=$row;
}

$json=json_encode(array("blogs"=>$blogs));
//$num=$blogs[0][0];
echo $json;

$conn->close();
?>