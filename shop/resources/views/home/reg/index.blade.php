<!DOCTYPE html>
<html>

	<head lang="en">
		<meta charset="UTF-8">
		<title>注册</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta name="format-detection" content="telephone=no">
		<meta name="renderer" content="webkit">
		<meta http-equiv="Cache-Control" content="no-siteapp" />

		<link rel="stylesheet" href="{{asset('amazeUI/AmazeUI-2.4.2/assets/css/amazeui.min.css')}}" />
		<link href="{{asset('amazeUI/css/dlstyle.css')}}" rel="stylesheet" type="text/css">
		<script src="{{asset('amazeUI/AmazeUI-2.4.2/assets/js/jquery.min.js')}}"></script>
		<script src="{{asset('amazeUI/AmazeUI-2.4.2/assets/js/amazeui.min.js')}}"></script>
	</head>
	<body>
		<div class="login-boxtitle">
			<a href="home/demo.html"><img alt="" src="{{URL('amazeUI/images/logobig.png')}}" /></a>
		</div>

		<div class="res-banner">
			<div class="res-main">
				<div class="login-banner-bg"><span></span><img src="{{URL('amazeUI/images/big.jpg')}}" /></div>
				<div class="login-box">

					<div class="am-tabs" id="doc-my-tabs">
						<ul class="am-tabs-nav am-nav am-nav-tabs am-nav-justify">
							<li class="am-active"><a href="">邮箱注册</a></li>
							<li><a href="">手机号注册</a></li>
						</ul>

						<div class="am-tabs-bd">
							<div class="am-tab-panel am-active">
								<form method="post">
										
								   <div class="user-email">
										<label for="email"><i class="am-icon-envelope-o"></i></label>
										<input type="email" name="" id="email" placeholder="请输入邮箱账号">
	                 				</div>	

	                 				<div class="user-pass">
									    <label for="password1"><i class="am-icon-lock"></i></label>
									    <input type="password" name="" id="password1" placeholder="设置密码">
	                 				</div>	

	                 				<div class="user-pass">
									    <label for="passwordRepeat1"><i class="am-icon-lock"></i></label>
									    <input type="password" name="" id="passwordRepeat1" placeholder="确认密码">
	                 				</div>	
                 
                 				</form>
                 
								<div class="login-links">
									<label for="reader-me">
									<input id="reader-me" type="checkbox"> 点击表示您同意商城《服务协议》
									</label>
							  	</div>

								<div class="am-cf">
									<input type="submit" name="" value="注册" class="am-btn am-btn-primary am-btn-sm am-fl">
								</div>
								<div class=partner>已有账号？<a href="{{URL('home/login/login')}}">点我登录</a></div>

							</div>

							<!-- 手机号注册 -->

							<div class="am-tab-panel">
								<span style='color:red'>@if(session('mes')) {{session('mes')}}@endif</span>
								<form method="post" action="{{URL('home/reg/doreg')}}" id='formsubmit1'>
									{{csrf_field()}}
									<div class="user-pass">
								    	<label for="username"><i class="am-icon-user"></i></label>
								    	<input type="text" name="username" id="username" placeholder="请输入用户名">
                 					</div>	
                 					<div class="user-phone">
									    <label for="phone"><i class="am-icon-mobile-phone am-icon-md"></i></label>
									    <input type="tel" name="phone" value="{{old('phone')}}" id="phone" placeholder="请输入手机号">
                 					</div>																			
									<div class="verification">
										<label for="code"><i class="am-icon-code-fork"></i></label>
										<input type="tel" name="code" value="" id="code" placeholder="请在60秒内输入验证码">
										<a class="btn" href="javascript:void(0);" onclick="sendMobileCode();" id="sendMobileCode">
											<span id="dyMobileButton">获取</span>
										</a>
										<a style='display:none' class="btn" href="javascript:void(0);" id="sendMobileCode1">
											<span id="dyMobileButton1"></span>
										</a>										
									</div>
                 					<div class="user-pass">
								    	<label for="password"><i class="am-icon-lock"></i></label>
								    	<input type="password" name="password" id="password" placeholder="设置密码">
                 					</div>										

								</form>

								<div class="login-links">
									<label for="reader-me">
										<input id="reader-me" type="checkbox"> 点击表示您同意商城《服务协议》
									</label>
							  	</div>

								<div class="am-cf">
									<input type="submit" name="" onclick="btn1()" value="注册" class="am-btn am-btn-primary am-btn-sm am-fl" id='submitphone'>
								</div>
								<div class=partner>已有账号？<a href="{{URL('home/login/login')}}">点我登录</a></div>

							</div>

							

							<script>
								$(function() {
								    $('#doc-my-tabs').tabs();
								  })
							</script>

						</div>

					</div>

				</div>
			</div>
			
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
		</div>
	</body>

</html>

<script>
	//ajax传电话号码
	function sendMobileCode(){
		//获取电话
		phone=$('#phone').val();
		if(phone){
			//点击获取验证码时ajax传值
			$.get("{{URL('home/reg/getcode')}}",{'phone':phone},function(r){
				//alert(r);
				if(r==1){
					//如果收到验证码
					$('#sendMobileCode').css('display','none');
					$('#dyMobileButton1').html('59 s');
					$('#dyMobileButton1').css('color','#f00');
					$('#sendMobileCode1').css('display','block');
					num=3;
					t=setInterval(function(){
						$('#dyMobileButton1').html(num+' s');
						if(num<1){
							//num=0;
							clearInterval(t);
							$('#sendMobileCode').css('display','block');
							$('#sendMobileCode1').css('display','none');
							$('#dyMobileButton').html('获取');
						}else{
							num--;							
						}


					},1000)
				}else{
					//如果没收到验证码，边框变红色
					$('#code').css('border-color','red');	
					$('#submitphone').attr('disabled',true);				
				}
			});
		}else{
			$('#phone').css('border-color','red');
		}

	}

</script>

<script>
	//提交电话注册的表单
	function btn1(){
		$('#formsubmit1').submit();
	}

</script>