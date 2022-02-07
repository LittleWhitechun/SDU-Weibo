<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/18
 * Time: 9:57
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
$account = $_POST['account'];
$psd = $_POST['password'];
$email = $_POST['email'];

//$conn->query("set names 'gbk'");
$sql2 = "insert into blog_actpsw (account,password,email) values ('$account','$psd','$email')";
if ($conn->query($sql2)) {
    echo "regsuccess";
} else {
    echo "accountbusy";
}

$conn->close();

?>