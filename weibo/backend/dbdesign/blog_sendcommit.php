<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/11
 * Time: 9:29
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
$content=$_POST['content'];
$time=date('y-m-d H:i:s',time());
$sql="insert into blog_comment (account,newsid,content,commit_time) values ('$account','$newsid','$content','$time')";
if($conn->query($sql)){
    echo "commit";
}else{
    echo 'commit false';
}
?>