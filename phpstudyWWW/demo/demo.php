<?php
header("content-type:text/html;charset=utf-8");
$link=mysqli_connect("localhost",'root','root','demo') or die("数据库链接失败");
mysqli_query($link,'set names utf8');

//数据库事物
mysqli_autocommit($link,false);//关闭自动提交功能
$money=5000;
$sql="update `hongbao` set `money`=`money`-$money where `id`=1";
$query=mysqli_query($link,$sql);
//var_dump($query);
if(!$query){
	echo '转账失败';
	//mysqli_rollback($link);

}else{

	$sql="update `hongbao` set `money`=`money`+$money where `id`=2";
	$query=mysqli_query($link,$sql);
	if(!$query){
		echo "收款失败了";

	}else{
		echo "转账和收款都成功了";
		mysqli_commit($link);//代码执行成功后，再提交数据库
	}
}
mysqli_close($link);

?>