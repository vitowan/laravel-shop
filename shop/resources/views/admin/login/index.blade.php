<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>登录页面</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<!-- basic styles -->

	<link href="{{URL('admin/assets')}}/css/bootstrap.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="{{URL('admin/assets')}}/css/font-awesome.min.css" />

	<!--[if IE 7]>
	  <link rel="stylesheet" href="{{URL('admin/assets')}}/css/font-awesome-ie7.min.css" />
	<![endif]-->

	<!-- page specific plugin styles -->

	<!-- fonts -->

	<link rel="stylesheet" href="{{URL('admin/assets')}}/css/googleleapis.css" />

	<!-- ace styles -->

	<link rel="stylesheet" href="{{URL('admin/assets')}}/css/ace.min.css" />
	<link rel="stylesheet" href="{{URL('admin/assets')}}/css/ace-rtl.min.css" />
	<script src="{{URL('admin/assets')}}/js/jquery-2.0.3.min.js"></script>
	<!--[if lte IE 8]>
	  <link rel="stylesheet" href="{{URL('admin/assets')}}/css/ace-ie.min.css" />
	<![endif]-->

	<!-- inline styles related to this page -->

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

	<!--[if lt IE 9]>
	<script src="{{URL('admin/assets')}}/js/html5shiv.js"></script>
	<script src="{{URL('admin/assets')}}/js/respond.min.js"></script>
	<![endif]-->
</head>

<body class="login-layout">
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">
							<div class="center">
								<h1>
									<i class="icon-leaf green"></i>
									<span class="red">php</span>
									<span class="white">世界最好语言</span>
								</h1>
								<h4 class="blue">&copy; 我的商城后台</h4>
							</div>

							<div class="space-6"></div>

							<div class="position-relative">
								<div id="login-box" class="login-box visible widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header blue lighter bigger">
												<i class="icon-coffee green"></i>
												请输入登录信息
											</h4>

											<div class="space-6"></div>

											<form action="{{URL('admin/login/login')}}" method='POST'>
												@if(session('mes'))
												<span style='color:red'>{{session('mes')}}</span>
												
												@endif
												{{csrf_field()}}
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" name='username' class="form-control" placeholder="用户名" />
															<i class="icon-user"></i>
														</span>
													</label>

												@if(session('mes1'))
												<span style='color:red'>{{session('mes1')}}</span>
												
												@endif
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" name='password' class="form-control" placeholder="密码" />
															<i class="icon-lock"></i>
														</span>
													</label>

													<div class="space"></div>

													<div class="clearfix">
														<label class="inline">
															<input type="checkbox" class="ace" />
															<span class="lbl"> 记住账号</span>
														</label>

														<button type="submit" class="width-35 pull-right btn btn-sm btn-primary">
															<i class="icon-key"></i>
															登录
														</button>
													</div>

													<div class="space-4"></div>
												</fieldset>
											</form>

										</div><!-- /widget-main -->

									</div><!-- /widget-body -->
								</div><!-- /login-box -->

							</div><!-- /position-relative -->
						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div>
		</div><!-- /.main-container -->



		<script type="text/javascript">
			window.jQuery || document.write("<script src='{{URL('admin/assets')}}/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='{{URL('admin/assets')}}/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

	<script type="text/javascript">
		if("ontouchend" in document) document.write("<script src='{{URL('admin/assets')}}/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
	</script>

	<!-- inline scripts related to this page -->

	<script type="text/javascript">
		function show_box(id) {
		 jQuery('.widget-box.visible').removeClass('visible');
		 jQuery('#'+id).addClass('visible');
		}
	</script>

</body>
</html>
