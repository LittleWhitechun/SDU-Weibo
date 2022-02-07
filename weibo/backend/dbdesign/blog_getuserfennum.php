<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/11
 * Time: 20:33
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
$sql="select * from blog_attention where user_account='$account'";
$query=$conn->query($sql);
echo $query->num_rows;
?>