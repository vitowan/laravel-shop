	<?php
/*	include('mysqli_connect.php');

	$user=isset($_POST['user'])?$_POST['user']:"";
	$password=isset($_POST['password'])?$_POST['password']:"";
	//var_dump($user,$password);
	$sql="select * from `user` where `user`='$user' and `password`='$password'";
	$query=mysqli_query($link,$sql);
	//select `password` from `user`;
	$assoc=mysqli_fetch_assoc($query);

	//echo "<pre>";
	//var_dump($assoc);
	if($assoc){
		echo "hi,$user 欢迎回来";

	}else{
		echo "滚犊子去";
	}
*/
	?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>登录页面</title>
		<style>
		div{
			width:300px;
			height:200px;
			background:#ccc;
			margin:100px auto;
		}

		div span{
			display:inline-block;
			padding-top:30px;
			padding-left:30px;			
		}
		h1{
			text-align:center;
			color:blue;
		}
	</style>
</head>
<body>
	<h1>登录页面</h1>
	<div>

		<form action="dologin.php" method="POST">
		<span>账号：<input type="text" name='user' placeholder='填选择用户名'></span><br>
		<span>密码：<input type="password" name='password' placeholder="请设置密码"></span><br>
		<span><input type="submit" value="登录">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="register.php">立即注册</a></span>
		</form>
	</div>
	

</body>
</html>