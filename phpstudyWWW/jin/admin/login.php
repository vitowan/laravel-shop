	<?php
		
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
		<span><input type="submit" value="登录">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
		</form>
	</div>
	

</body>
</html>