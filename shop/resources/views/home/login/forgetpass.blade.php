<!DOCTYPE html>
<html>
	<head lang="en">
		<meta charset="UTF-8">
		<title>登录</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta name="format-detection" content="telephone=no">
		<meta name="renderer" content="webkit">
		<meta http-equiv="Cache-Control" content="no-siteapp" />
		<script src="{{asset('amazeUI/AmazeUI-2.4.2/assets/js/jquery.min.js')}}"></script>

		<link rel="stylesheet" href="{{asset('amazeUI/AmazeUI-2.4.2/assets/css/amazeui.css')}}" />
		<link href="{{asset('amazeUI/css/dlstyle.css')}}" rel="stylesheet" type="text/css">
		<style>
			.forget input {
				margin:30px;
				display:block;
				width:400px;
				margin-left:150px;
			}
			.login-banner .login-main h1{
				text-align: center;
				padding-top: 50px;
				color:white;
				font-size:20px;
			}
			.login-banner .login-main #getcode{
				width:200px;
			}
			.login-banner .login-main #codebtn{
				width:100px;
				display:inline-block;
				height:40px;
				color:white;
				cursor:pointer;
			}	
			.login-banner .login-main .subbtn{

				display:block;
				margin:50px auto;
				width:200px;
				height:40px;
			}

		</style>
	</head>

	<body>

		<div class="login-boxtitle">
			<a href="home.html"><img alt="logo" src="{{URL('amazeUI/images/logobig.png')}}" /></a>
		</div>

		<div class="login-banner">
			<div class="login-main login1" style='display:block' >
				<h1>找回密码</h1>

				<form action="javascript:;" class='forget' method='post'>
					{{csrf_field()}}
					<input type="text" placeholder="请输入注册的手机号" id='usercheck'><div id='error' style='text-align:center'></div>
					<input type="text" id="getcode" style='display:inline-block;' placeholder='请填写手机验证码'>
					<div id='codebtn'  >发送验证码</div>
					<button type="submit" class="subbtn" id= "submitphone" value="">下一步</button>

				</form>					
			</div>

			<div class="login-main login2" style='display:none'>
				<h1>重新设置密码</h1>

				<form action="{{URL('home/login/changepass')}}" class='forget' method='post' id='subpass'>
					{{csrf_field()}}
					<input type="text" name='password' id='password' placeholder="请设置新的密码,数字字母或者下划线组成，3-20位" >
					<div style="color:yellow;text-align: center" id='err'></div>
					<input type="text" name='repassword' id='repassword' placeholder="请再次输入新密码">
					<input type="button" class="subbtn" id='subbtn' value="设置完成" style='text-align: center;padding-left:10px;font-size:18px'>
				</form>					
			</div>
		</div>
		<script>
			//alert($);
			//找回密码
			$('#submitphone').attr('disabled',true);//没填写数据前，提交按钮失效
			$('#codebtn').click(function(){
				var usercheck=$('#usercheck').val();

				$.post("{{URL('home/login/docheckpass')}}",{'usercheck':usercheck,"_token":"{{csrf_token()}}"},function(r){
					//alert(r);
					if(r==1){
						//如果收到短信验证码codebtn
						num=3;
						$('#codebtn').css('width','250px');
						$('#codebtn').html("请在*<span style='color:yellow;font-size:30px'>59</span>*秒内填写手机验证码");
						t=setInterval(function(){
							$('#codebtn').html('请在*<span style="color:yellow;font-size:30px">'+num+'</span>*秒内填写手机验证码');
							if(num<1){
								clearInterval(t);
								$('#codebtn').html('重新发送验证码');
							}else{
								num--;
							}
							
						},1000);
						//提交按钮可用
					$('#submitphone').attr('disabled',false);

					}else if(r==2){//如果没有填写手机号码
						$('#error').css('color','yellow');	
						$('#error').html('******请填写正确的账号');
						//提交按钮失效
						$('#submitphone').attr('disabled',true);

					}else{//如果验证码发送失败
						$('#error').css('color','yellow');	
						$('#error').html('******验证码发送失败');

					}
				});
			});

		</script>

		<script>
			//点击下一步
			$('#submitphone').click(function(){
				//alert($);
				var getcode =$('#getcode').val();
				$.post("{{URL('home/login/donextcheckpass')}}",{'getcode':getcode,"_token":"{{csrf_token()}}"},function(r){
					if(r==1){
						$('.login1').css('display','none');
						$('.login2').css('display','block');

					}else{
						$('#error').css('color','yellow');
						$('#error').html('*******验证码填写错误');	
					}
				});


			});
		</script>

		<script>
			//设置密码

			preg=/^\w{3,20}$/;//数字字母下划线3-20位
			//$('#subbtn').on('click',function(){
				$('#password').blur(function(){//失焦时匹配正则
					password=$('#password').val();
					if(!preg.test(password)){
						$('#err').html('******请输入正确的密码格式')
						$('#password').css('border-color','yellow')
					}
				});
				
				$('#password').focus(function(){//失焦时匹配正则
					$('#err').html('');					

				});

/*				$('#repassword').blur(function(){
					password=$('#password').val();
					repassword=$('#repassword').val();	
					if(password!=repassword ){
						$('#err').html('密码不匹配')
					}

				});

				$('#repassword').focus(function(){
						$('#err').html('');
				});	*/			
				//alert(password);

				$('#subbtn').click(function(){
					password=$('#password').val();
					repassword=$('#repassword').val();	
					if(preg.test(password) && password==repassword){
						$('#subpass').submit();

					}else{
						$('#err').html('******密码不匹配');	
					}				
				});
				$('#repassword').focus(function(){
						$('#err').html('');
				});

		
			//});




		</script>






		<div class="footer ">
			<div class="footer-hd ">
				<p>
					<a href="# ">恒望科技</a>
					<b>|</b>
					<a href="# ">商城首页</a>
					<b>|</b>
					<a href="# ">支付宝</a>
					<b>|</b>
					<a href="# ">物流</a>
				</p>
			</div>
			<div class="footer-bd ">
				<p>
					<a href="# ">关于恒望</a>
					<a href="# ">合作伙伴</a>
					<a href="# ">联系我们</a>
					<a href="# ">网站地图</a>
					<em>© 2015-2025 Hengwang.com 版权所有. 更多模板 <a href="http://www.cssmoban.com/" target="_blank" title="模板之家">模板之家</a> - Collect from <a href="http://www.cssmoban.com/" title="网页模板" target="_blank">网页模板</a></em>
				</p>
			</div>
		</div>
	</body>

</html>