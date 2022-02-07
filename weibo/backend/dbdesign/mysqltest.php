<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/9
 * Time: 14:55
 */
header('Access-Control-Allow-Origin:*');
$servername = "localhost";
$username = "root";
$password = "";
$dbname="blogdb";

// 创建连接
$conn= new mysqli($servername, $username, $password,$dbname);

// 检测连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}
//    $name=$_POST['name'];
//echo "后台返回 取得名字:"."$name";
//    $sql="insert into reservation (name,tel) values ('123','123456')";
//    $testname=$_POST['name'];
$title='测试一下';
$conn->query("set names 'utf8'");
$sql="insert into blog_blogs (title,content,img,img2,img3,time,author,style) values ('$title','啊啊啊','','','','aaa','啊啊啊','啊啊啊')";
if ($conn->query($sql)) {
    echo "sendsuccess";
} else {
    echo "senderror";
}
//    $query=$conn->query($sql);
//echo $conn->error;

//    $data=array();
//    while($row=$query->fetch_array()){
//        $data[]=$row;
////        echo " name:".$row["name"]." tel:".$row["tel"];
//    }
//    $json=json_encode(array("data"=>$data));
//    echo $json;
//    echo $data;
//$row=$query->fetch_all(MYSQLI_BOTH);//参数MYSQL_ASSOC、MYSQLI_NUM、MYSQLI_BOTH规定产生数组类型
//$n=0;
//while($n<mysqli_num_rows($query)){
//    echo "ID:".$row[$n]["name"]."用户名：".$row[$n]["tel"]."密码：";
//    $n++;
//}
//    echo $row;
//    $json=json_encode(array(
//        "resultCode"=>"200",
//        "message"=>"查询成功",
//        "data"=>"somedata"
//    ));
//$raw_success = array('code' => 1, 'msg' => '验证码正确');
//$res_success = json_encode($raw_success);
//echo $res_success;
//    echo $query;
    $conn->close();
//    if($conn->query($sql)===true){
//        $conn->close();
//        echo "ok";
//    }else{
//        $conn->close();
//        echo "error".$sql." ".$conn->error;
//        echo "nook";
//    }

?>
