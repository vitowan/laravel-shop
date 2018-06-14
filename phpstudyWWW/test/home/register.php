<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>注册页面</title>
	<script src="jquery-1.8.2.min.js" type="text/javascript"></script>
	<style>

		div{
			width:600px;
			height:300px;
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
			color:red;
		}
	</style>
</head>
<body>
	<h1>注册页面</h1>

	<div>
		<form action="doregister.php" method="POST">
		<span>账号：<input type="text" name='user' id="user" placeholder='填选择用户名'></span><span class="text_span"></span><br>
		<span>密码：<input type="password" name='password' id="password" placeholder="请设置密码"></span><span class="pass_span"></span><br>
		<span>再次输入密码：<input type="password" name='password' id="password1" placeholder="再次输入密码"></span><span class="pass_span1"></span><br>
		<span><input type="submit" value="注册" id="btn1"></span>
		</form>
	</div>



</body>
</html>
<script>
	$( function(){
	//alert($);
	//账号验证
	form1=true;
	form2=true;
	form3=true;
	$('#user').blur(function(){
		var user=$('#user').val();
		//console.log(user);
		if(user.match(/^\w{6,18}$/)){
			$('.text_span').html('账号可用');
			$('.text_span').css('color','green');
			form1=true;

		}else{
			$('.text_span').html('用户名必须有6-18位数字字母下划线组成');
			$('.text_span').css('color','red');
			form1=false;
		}

	});

//密码验证
	$('#password').blur(function(){
	var pass=$('#password').val();
	//console.log(user);
	if(pass.match(/^\w{6,18}$/)){
		$('.pass_span').html('账号可用');
		$('.pass_span').css('color','green');
		form2=true;
	}else{
		$('.pass_span').html('密码必须有6-18位数字字母下划线组成');
		$('.pass_span').css('color','red');
		form2=false;
	}

	});

//第二次验证
	$('#password1').blur(function(){
	var pass1=$('#password1').val();
	var pass=$('#password').val();
	//console.log(user);
	if(pass1!=pass){
		$('.pass_span1').html('密码不一致');
		$('.pass_span1').css('color','red');
		form3=false;
	}
});

$('#btn1').click(function(){
if(form1 && form2 && form3){
	return true;
}else{
	return false;
}


});


	});

</script>



