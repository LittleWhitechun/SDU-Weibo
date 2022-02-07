<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/18
 * Time: 17:20
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
//    $arr=array("data"=>"error");
}

$keywords=$_POST['keywords'];
$keyword=explode(" ",$keywords);

$sql="select * from blog_blogs where author='$keyword[0]'or style='$keyword[0]' or title like '%$keyword[0]%'";
for($i=0;$i<count($keyword);$i++){
    if($i!=0){
        $sql=$sql."and title like '%$keyword[$i]%'";
    }
}

$query=$conn->query($sql);
$blogs=array();
while ($row=$query->fetch_row()){
    $blogs[]=$row;
}
$json=json_encode(array("blogs"=>$blogs));
echo $json;


$conn->close();

?>