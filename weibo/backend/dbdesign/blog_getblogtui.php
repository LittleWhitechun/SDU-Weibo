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

$account=$_POST['account'];
//$account='jiaohaoran';
// 检测连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
    $arr=array("data"=>"error");
}


$sql="SELECT newsid FROM blog_thumbsup where account='$account' order by id desc limit 10";
$query=$conn->query($sql);

$blogs=array();
$authors=array();
while($row=$query->fetch_array()){
    $newsid=$row[0];
    $sql2="select author from blog_blogs where id='$newsid'";
    $query2=$conn->query($sql2);
    while($row2=$query2->fetch_array()){
        $authors[]=$row2;
    }
}
for($i=0;$i<count($authors);$i++){
    $authors[$i]=$authors[$i][0];
}
//print_r($authors);
$authors=array_count_values($authors);
arsort($authors);
reset($authors);
$first=key($authors);
$second=$first;
$third=$first;
//echo "first:".$first." second:".$second." third:".$third;
//如果用户最近点赞的前十个微博里的作者数量为二
if(count($authors)>=2){
    next($authors);
    $second=key($authors);
}

//如果用户最近点赞的前十个微博里的作者数量为三
if(count($authors)>=3){
    next($authors);
    $third=key($authors);
}

//echo "first:".$first." second:".$second." third:".$third;
//作者为最近点赞十个之内作者的微博 然后把这个微博按照点赞数量排序
$newsidsql="select newsid from blog_thumbsup where newsid in (select id from blog_blogs where author='$first' or author='$second' or author='$second') group by newsid order by count(*) desc";
$newsidquery=$conn->query($newsidsql);
while($row=$newsidquery->fetch_array()){
    $tuinewsid=$row[0];
    $newssql="select * from blog_blogs where id='$tuinewsid'";
    $newsquery=$conn->query($newssql);
    while($row2=$newsquery->fetch_array()){
        $blogs[]=$row2;
    }
}
$json=json_encode(array("blogs"=>$blogs));
echo $json;

$conn->close();

?>