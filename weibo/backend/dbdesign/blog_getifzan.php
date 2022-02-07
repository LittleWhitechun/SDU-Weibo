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
$account=$_POST['account'];
//$newsid=20;
//$account=20;
$sql="select count(*) as zannum from blog_thumbsup where newsid = '$newsid' and account='$account'";

$query=$conn->query($sql);
$ifzan;
while($row=$query->fetch_row()){
    if($row[0]==0){
        $ifzan="nozan";
    }else{
        $ifzan="zaned";
    }
}

echo $ifzan;


$conn->close();

?>