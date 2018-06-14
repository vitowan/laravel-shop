<?php
include 'public/mysqli_connect.php';
session_start();
if(isset($_POST['user'])){
	$user=$_POST['user'];
	$pass=$_POST['password'];

	$sql="select * from `staff` where `user`='$user'";
	$query=mysqli_query($link,$sql);
	//var_dump($query);
	$assoc=mysqli_fetch_assoc($query);
	//var_dump($assoc);
	if($pass==$assoc['password']){
		$_SESSION['name']=$user;
		echo "<script>alert('登录成功');location.href='home.php'</script>";
	}else{
		echo "<script>alert('登录失败');location.href='login.php'</script>";
	}


}





?>