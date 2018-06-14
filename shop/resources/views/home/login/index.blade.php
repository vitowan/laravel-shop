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
	</head>

	<body>

		<div class="login-boxtitle">
			<a href="home.html"><img alt="logo" src="{{URL('amazeUI/images/logobig.png')}}" /></a>
		</div>

		<div class="login-banner">
			<div class="login-main">
				<div class="login-banner-bg"><span></span><img src="{{URL('amazeUI/images/big.jpg')}}" /></div>
				<div class="login-box">

					<h3 class="title">登录商城</h3>

					<div class="clear"></div>
							
					<div class="login-form">

						<form action="{{URL('home/login/dologin')}}" method='post' id='loginform'>
							{{csrf_field()}}
							<div class="user-name">
								<label for="user"><i class="am-icon-user"></i></label>
								<input type="text" name="string" value="" id="user" placeholder="手机/用户名">
                 			</div>
                 			<div class="user-pass">
								<label for="password"><i class="am-icon-lock"></i></label>
								<input type="password" name="password" id="password" placeholder="请输入密码">
                 			</div>
              			</form>

	           		</div>
	           		<span style="color:red">@if(session('mes')) ****{{session('mes')}} @endif </span>
	            	<div class="login-links">
		                <label for="remember-me"><input id="remember-me" type="checkbox">记住密码</label>
						<a href="{{URL('home/login/forgetpass')}}" class="am-fr">忘记密码</a>
						<a href="{{URL('home/reg/reg')}}" class="zcnext am-fr am-btn-default">注册</a><br />
	            	</div>
					<div class="am-cf">
						<input type="submit" name="" id='loginbtn' value="登 录" class="am-btn am-btn-primary am-btn-sm">
					</div>

					<script>
						//登录提交
			/*			var loginbtn=document.getElementById('loginbtn');
						var loginform =document.getElementById('loginform');
						loginbtn.onlcik=function(){
							loginform.submit();
						}*/
						$('#loginbtn').click(function(){
							$('#loginform').submit();
						});
						
					</script>

					<div class="partner">		
						<h3>合作账号</h3>
						<ul class="am-btn-group">
							<li><a href="#"><i class="am-icon-qq am-icon-sm"></i><span>QQ登录</span></a></li>
							<li><a href="#"><i class="am-icon-weibo am-icon-sm"></i><span>微博登录</span> </a></li>
							<li><a href="#"><i class="am-icon-weixin am-icon-sm"></i><span>微信登录</span> </a></li>
						</ul>
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
	</body>

</html>