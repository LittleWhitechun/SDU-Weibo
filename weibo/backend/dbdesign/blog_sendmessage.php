<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/11
 * Time: 16:55
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

$sender=$_POST['sender'];
$receiver=$_POST['receiver'];
$content=$_POST['content'];
$time=date('y-m-d H:i:s',time());

$sql1="select * from blog_actpsw where account='$receiver'";
$query1=$conn->query($sql1);
if($query1->num_rows!=0){
    $sql2="insert into blog_message (send_id,receive_id,content,time) values ('$sender','$receiver','$content','$time')";
    if($conn->query($sql2)){
        echo "message success";
    }else{
        echo "message false";
    }
}else{
    echo "no receiver";
}
?>