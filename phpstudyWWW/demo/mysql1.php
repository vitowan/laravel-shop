<?php
header('Content-type:text/html;charset=utf-8');
//连接写法1
/*if($link=mysqli_connect('localhost','root','root')){
	//echo "成功";
	if(mysqli_select_db($link,'php122')){
		//echo '连接到数据库';
		$sql='set names utf8';
		mysqli_query($link,$sql);
		//echo '设置完成了';
	}else{
		echo "未连接到库，或没权限";
	}
}else{
	echo "失败";
}*/


//连接写法2
/*if($link=mysqli_connect('localhost','root','root','php122')){
	mysqli_query($link,'set names uft8');
}else{
	echo '失败';
}
*/
//连接写法3
/*
$link=mysqli_connect('localhost','root','root') or die('连接失败');
mysqli_select_db($link,'php122') or die('没有找到数据库');
mysqli_query($link,'set names utf8');
*/

//连接写法4
/*define('HOST','localhost');
define('USER','root');
define('PASSWORD','root');*/
const HOST='localhost' ;
const USER='root';
const PASSWORD='ro1ot';

$link=mysqli_connect(HOST,USER,PASSWORD) or die('错了');
mysqli_select_db($link,'php122') or die('没有找到数据库');
mysqli_query($link,'set names utf8');

//$sql="select * from `stu` order by `id` desc ";
$sql="select * from `stu` where `id`=3";
$query=mysqli_query($link,$sql);
//$assoc=mysqli_fetch_assoc($query);//关联数组
//print_r($assoc);

//$array=mysqli_fetch_array($query);//索引和关联
//print_r($array);

//$row=mysqli_fetch_row($query);//索引数组
//print_r($row);

$object=mysqli_fetch_object($query);//取一条做对象数组
print_r($object);

?>