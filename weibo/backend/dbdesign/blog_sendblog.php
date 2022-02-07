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
$author=$_POST['author'];
$title=$_POST['title'];
$img=$_POST['img'];
$img2=$_POST['img2'];
$img3=$_POST['img3'];
$content=$_POST['content'];
$time=$_POST['time'];
$style=$_POST['style'];

//$conn->query("set names 'gbk'");
$sql="insert into blog_blogs (title,content,img,img2,img3,time,author,style) values ('$title','$content','$img','$img2','$img3','$time','$author','$style')";
if ($conn->query($sql)) {
    $time=date('y-m-d H:i:s',time());
    $sql_last_update_time="update blog_actpsw set last_update_time='$time' where account='$author'";
    if($conn->query($sql_last_update_time)){
        echo "sendsuccess";
    }else{
        echo "senderror";
    }

} else {
    echo "senderror";
}

$conn->close();
?>