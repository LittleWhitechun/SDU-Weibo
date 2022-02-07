<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/10
 * Time: 17:02
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

$attentor=$_POST['attentor'];
$user=$_POST['user'];
$sql="select a_id from blog_attention where attentor_account='$attentor' and user_account='$user'";
$query=$conn->query($sql);
if($query->num_rows!=0){
    echo "attention";
}else{
    echo "no attention";
}
?>