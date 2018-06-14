<?php
header('Content-type:text/html;charset=utf-8');
$link=mysqli_connect('localhost','root','root') or die('数据库连接失败');
mysqli_select_db($link,'demo') or die('无此数据库，或者无权限');
mysqli_query($link,'set names utf8');

//var_dump($_POST);
//die;
if(isset($_POST['user'])){
	$user=$_POST['user'];
	$pass=$_POST['password'];

	$sql="select * from `user` where `user`= '$user' and `password`='$pass'";
	$query=mysqli_query($link,$sql);
	//$result=mysqli_fetch_assoc($query);
	echo mysqli_num_rows($query);
	//var_dump($result);
	//var_dump($assoc);
/*	if($pass==$result['password']){
		//$_SESSION['name']=$user;
		echo "登录成功; ";
	}else{
		echo "登录失败";
	}*/
}



?>