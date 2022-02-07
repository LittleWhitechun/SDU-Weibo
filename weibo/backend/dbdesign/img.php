<?php
header('Access-Control-Allow-Origin:*');
$servername = "localhost";
$username = "root";
$password = "";
$dbname="test";

// 创建连接
$conn= new mysqli($servername, $username, $password,$dbname);
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}
$imgsrc=$_POST['imgsrc'];
$imgname=$_POST['imgname'];
$sql="insert into imgsrc (imgsrc,name) values ('$imgsrc','$imgname')";
if($conn->query($sql)){
    echo "ok";
}else{
    echo "nook";
}
$conn->close();
?>
