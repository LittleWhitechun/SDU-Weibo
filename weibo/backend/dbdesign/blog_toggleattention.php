<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/10
 * Time: 19:24
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
$attentor=$_POST['attentor'];
$user=$_POST['user'];
$sql="select * from blog_attention where attentor_account='$attentor' and user_account='$user'";
$query=$conn->query($sql);
if($query->num_rows!=0){
    $sql_del="delete from blog_attention where attentor_account='$attentor' and user_account='$user'";
    $conn->query($sql_del);
    echo "delete attention";
}else{
    $sql_add="insert into blog_attention (attentor_account,user_account) values ('$attentor','$user')";
    $conn->query($sql_add);
    echo "add attention";
}
?>