<?php
include 'DB.class.php';

if(isset($_POST['user_reg'])){
	$user=$_POST['user_reg'];
/*	$sql="select * from `user` where `user`='$user'";
	$result=mysqli_query($link,$sql);*/
	$query=$GLOBALS['db']->getSelect1('user','*',array('user'=>$user));
//var_dump($result);
	$num=mysqli_num_rows($query);
	if($num){
		echo '账号重复，请换个用户名';
	}else{
		echo '账号可以注册';
	}

}







?>