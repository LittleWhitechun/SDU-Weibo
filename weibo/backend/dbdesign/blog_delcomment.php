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

$id=$_POST['id'];
$sql="delete from blog_comment where c_id='$id'";
$query=$conn->query($sql);

if($query){
    echo "delsuccess";
}else{
    echo "delerror";
}
?>