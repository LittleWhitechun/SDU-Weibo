<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/10
 * Time: 20:22
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
//$account='newaccount';
$sql1="select user_account from blog_attention where attentor_account='$account'";
$query1=$conn->query($sql1);
$users=array();
while ($row=$query1->fetch_row()){
    $users[]=$row;
}

$sql2="select * from blog_actpsw where";
for($i=0;$i<count($users);$i++){
    if($i<count($users)-1){
        $sql2=$sql2." account='".$users[$i][0]."' or";
    }else{
        $sql2=$sql2." account='".$users[$i][0]."'";
    }
}
//echo $sql2;
$query2=$conn->query($sql2);

$blogs=array();
if($query2){
    while($row=$query2->fetch_array()){
        $blogs[]=$row;
    }
}

$json=json_encode(array("blogs"=>$blogs));
echo $json;
?>