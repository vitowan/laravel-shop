<?php
include '../public/mysqli_connect.php';
if(isset($_POST['user'])){
	$user=$_POST['user'];
	$pass=md5($_POST['password']);

	$sql="insert into `user`(`user`,`password`) values('$user','$pass')";
	$query=mysqli_query($link,$sql);
	if(mysqli_affected_rows($link)){
		echo "<script>alert('注册成功');location.href='login.php'</script>";
	}else{
		echo "<script>alert('注册失败');location.href='register.php'</script>";
	}

}



?>