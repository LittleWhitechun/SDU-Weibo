<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/9
 * Time: 16:20
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



$sql_getallaccount="select account from blog_thumbsup";
$query_getallaccount=$conn->query($sql_getallaccount);
$allaccount=array();
while($eveaccount=$query_getallaccount->fetch_array()){
    $allaccount[]=$eveaccount[0];
}
//创建一个带有存有每一个用户和每一个作者的表，对应值为对应的点赞数，便于后续进行协同过滤推荐算法

//根据用户数创建表，sql语句需要动态拼接
$sql_create="create TEMPORARY table 'tuijian'(
'name' varchar(255) not null ";
for($i=0;$i<count($allaccount);$i++){
    $sql_create=$sql_create."'".$allaccount[$i]."' int(255) default NULL";
}
$sql_create=$sql_create." PRIMARY KEY  ('name')";
$conn->query($sql_create);


while($eveaccount=$query_getallaccount->fetch_array()){

    $curaccount=$eveaccount[0];
    $sql="SELECT newsid FROM blog_thumbsup where account='$curaccount' order by id desc limit 20";
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
    //这个用户对每一个作者对应的点赞数
    $authors=array_count_values($authors);

    $authorname=array_keys ($authors);
    $authorzan=array_values($authors);
    $sql_attr="name ";
    $sql_val="$curaccount ";
    for($i2=0;$i2<count($authorname);$i2++){
        $sql_attr=$sql_attr.$authorname[$i2]." ";
        $sql_val=$sql_val."'".$authorzan[$i2]."' ";
    }
    //向临时数据表中插入对应用户点赞的作者和点赞数信息
    $sql_insertinto="insert into tuijian (".$sql_attr.") values (".$sql_val.")";
}
//创建数据表完毕
$sql_getall="select * from tuijian";
$query_all=$conn->query($sql_getall);
$array=array();
while ($row=$query_all->fetch_row()){
    $array[]=$row;
}

$cos = array();
$cos[0] = 0;
$fm1 = 0;
//开始计算cos
//计算分母1，分母1是第一个公式里面 “*”号左边的内容，分母二是右边的内容
for($i2=0;$i2<count($array);$i2++){
    if($array[$i2][0]==$account){//$i2对应的行就是$account对应的行
        for($i=1;$i<15;$i++){
            if($array[$i2][$i] != null){//当前用户对每一个热门作者的点赞数
                $fm1 += $array[$i2][$i] * $array[$i2][$i];
            }
        }
        $fm1 = sqrt($fm1);

        for($i=0;$i<count($array);$i++){
            $fz = 0;
            $fm2 = 0;
            echo "Cos(".$array[$i2][0].",".$array[$i][0].")=";

            for($j=1;$j<15;$j++){
                //计算分子
                if($array[$i2][$j] != null && $array[$i][$j] != null){
                    $fz += $array[$i2][$j] * $array[$i][$j];
                }
                //计算分母2
                if($array[$i][$j] != null){
                    $fm2 += $array[$i][$j] * $array[$i][$j];
                }
            }
            $fm2 = sqrt($fm2);
            $cos[$i] = $fz/$fm1/$fm2;
//            echo $cos[$i]."<br/>";
        }
    }
}

//对计算结果进行排序,用快速排序
function quicksort($str){
    if(count($str)<=1) return $str;//如果个数不大于一，直接返回
    $key=$str[0];//取一个值，稍后用来比较；
    $left_arr=array();
    $right_arr=array();

    for($i=1;$i<count($str);$i++){//比$key大的放在右边，小的放在左边；
        if($str[$i]>=$key)
            $left_arr[]=$str[$i];
        else
            $right_arr[]=$str[$i];
    }
    $left_arr=quicksort($left_arr);//进行递归；
    $right_arr=quicksort($right_arr);
    return array_merge($left_arr,array($key),$right_arr);//将左中右的值合并成一个数组；
}

$neighbour = array();//$neighbour只是对cos值进行排序并存储
$neighbour = quicksort($cos);

//$neighbour_set 存储最近邻的人和cos值
$neighbour_set = array();
for($i=0;$i<3;$i++){
    for($j=0;$j<5;$j++){
        if($neighbour[$i] == $cos[$j]){
            $neighbour_set[$i][0] = $j; //用户名字
            $neighbour_set[$i][1] = $cos[$j]; //相似度cos值
            $neighbour_set[$i][2] = $array[$j][1];//邻居对第一个作者的评分
            $neighbour_set[$i][3] = $array[$j][2];//邻居对第二个作者评分
            $neighbour_set[$i][4] = $array[$j][3];
            $neighbour_set[$i][5] = $array[$j][4];
            $neighbour_set[$i][6] = $array[$j][5];
            $neighbour_set[$i][7] = $array[$j][6];
            $neighbour_set[$i][8] = $array[$j][7];
            $neighbour_set[$i][9] = $array[$j][8];
            $neighbour_set[$i][10] = $array[$j][9];
            $neighbour_set[$i][11] = $array[$j][10];
            $neighbour_set[$i][12] = $array[$j][11];
            $neighbour_set[$i][13] = $array[$j][12];
            $neighbour_set[$i][14] = $array[$j][13];
            $neighbour_set[$i][15] = $array[$j][14];
            $neighbour_set[$i][16] = $array[$j][15];

        }
    }
}
print_r($neighbour_set);
echo "<p><br/>";

$tui_author=array();
//predict 预测$account对15个作者的评分
for($i=0;$i<15;$i++){
    $p_arr = array();
    $pfz_f = 0;
    $pfm_f = 0;
    for($i2=0;$i2<3;$i2++){
        $pfz_f += $neighbour_set[$i2][1] * $neighbour_set[$i2][$i];
        $pfm_f += $neighbour_set[$i2][1];
    }
    $p_arr[0][0] = $account;
    $p_arr[0][1] = $pfz_f/sqrt($pfm_f);
    if($p_arr[0][1]>3){
        echo "推荐".$i."作者";
        $tui_author[]=$i;
    }
}

$sql_finalget="select * from blog_blogs where author=$tui_author[0]";
$row=$conn->query($sql_finalget);
echo $row[0];







?>