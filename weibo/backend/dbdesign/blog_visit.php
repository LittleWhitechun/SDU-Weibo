<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/10
 * Time: 16:04
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
    echo "dberror";
}
$visitor=$_POST['visitor'];
$user=$_POST['user'];
$time=date('y-m-d H:i:s',time());

$sql="insert into blog_visitor (visitor_account,user_account,visitor_time) values ('$visitor','$user','$time')";
if($conn->query($sql)){
    echo "visit";
}else{
    echo "dberror";
}

?>