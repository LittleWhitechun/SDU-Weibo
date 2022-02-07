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
//    $arr=array("data"=>"error");
}

$newsid=$_POST['newsid'];
//$newsid=20;

$sql="select count(*) as zannum from blog_thumbsup where newsid = '$newsid'";

$query=$conn->query($sql);
$zannum=0;
while ($row=$query->fetch_row()){
    $zannum=$row[0];
}

echo $zannum;


$conn->close();

?>