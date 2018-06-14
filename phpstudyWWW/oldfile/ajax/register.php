<?php
header('Content-type:text/html;charset=utf-8');
$link=mysqli_connect('localhost','root','root') or die('数据库连接失败');
mysqli_select_db($link,'demo') or die('无此数据库，或者无权限');
mysqli_query($link,'set names utf8');

//var_dump($_POST);
//die;
//验证的注册页面
if(isset($_POST['user'])){
	$user=$_POST['user'];
	$pass=md5($_POST['pass']);
	$sql="insert into `user` values(null,'$user','$pass')";
	$query=mysqli_query($link,$sql);

	echo mysqli_affected_rows($link);


}
//验证的注册页面
if(isset($_POST['user_reg'])){
	$user=$_POST['user_reg'];
	$sql="select * from `user` where `user`='$user'";
	$query=mysqli_query($link,$sql);
	//$result=mysqli_fetch_assoc($query);
	echo mysqli_num_rows($query);
/*	if($num){
		echo '账号重复，请换个用户名';
	}else{
		echo '账号可以注册';
	}*/

}







?>