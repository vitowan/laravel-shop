	<?php
	include('mysqli_connect.php');



	$user=$_POST['user'];
	$password=$_POST['password'];
	if(empty($user)||empty($password)){
		die ('账号或密码不能为空');
	}

	//账号，字母开头2-20位字母数字下划线组成
	$ptn='/^[a-z]\w{1,19}$/';
	if(!preg_match($ptn,$user)){
		echo "<script> alert('开头是字母，最少2位最多20位'); </script>"; 
		echo "<script> window.location.href='index.php'; </script>";
			die;
	}  

	//密码：6--20位数字字母下划线



	$sql="insert into user values(null,'$user','$password')";
	mysqli_query($link,$sql);
	header('location:login.php');


	?>
