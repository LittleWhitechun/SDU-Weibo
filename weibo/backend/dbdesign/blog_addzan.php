<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/18
 * Time: 16:31
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
$account=$_POST['account'];
$newsid=$_POST['newsid'];

//$conn->query("set names 'gbk'");
$sql="insert into blog_thumbsup (account,newsid) values ('$account','$newsid')";
if ($conn->query($sql)) {
    echo "addsuccess";
} else {
    echo "adderror";
}

$conn->close();
?>