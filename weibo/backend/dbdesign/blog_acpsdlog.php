<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/18
 * Time: 11:21
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

$sql1="select password from blog_actpsw where account='$account'";
$query1=$conn->query($sql1);
$i=0;
if($query1->num_rows!=0){
    while($row=$query1->fetch_array()){
        if($row){
    //        echo $row['password'];
            if($row['password']==$psd){
                $time=date('y-m-d H:i:s',time());
                $sql_last_login_time="update blog_actpsw set last_login_time='$time' where account='$account'";
                $conn->query($sql_last_login_time);
                echo "logsuccess";
            }else{
                echo "passwordfalse";
            }
        }else{
            echo "noaccount1";
        }
    }
}else{
    echo "noaccount";
}

$conn->close();
?>