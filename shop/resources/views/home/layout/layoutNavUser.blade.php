@extends('home.layout.layoutNav')
@section('main1')

	<!-- 首页导航栏 -->
	<div class="top-nav bg3">
		<div class="nav-box inner">
			<div class="all-cat">
				<div class="title"><i class="iconfont icon-menu"></i> 全部分类</div>
				<div class="cat-list__box">
					@foreach($all as $k=>$v)
					<div class="cat-box">
						<div class="title">
							<i class="iconfont icon-skirt ce"></i> {{$v->cate_name}}
						</div>
						<ul class="cat-list clearfix">
							@foreach($v->child as $k1=>$v1)
							@if($k1<2)
							<li>{{$v1->cate_name}}</li>
							@endif
							@endforeach
						</ul>
						<div class="cat-list__deploy">
							<div class="deploy-box">
								@foreach($v->child as $kk=>$vv)
								<div class="genre-box clearfix">
									<span class="title">{{$vv->cate_name}}：</span>
									<div class="genre-list">
										@foreach($vv->child as $vvv)
										<a href="{{URL('home/category/index').'/'.$vvv->id}}">{{$vvv->cate_name}}</a>
										@endforeach

									</div>
								</div>
								@endforeach

							</div>
						</div>
					</div>
					@endforeach

				</div>
			</div>
			<ul class="nva-list">
				<a href="{{URL('home/home/index')}}"><li class="active">首页</li></a>
				<a href="temp_article/udai_article10.html"><li>企业简介</li></a>
				<a href="temp_article/udai_article5.html"><li>新手上路</li></a>
				<a href="class_room.html"><li>布袋学堂</li></a>
				<a href="enterprise_id.html"><li>企业账号</li></a>
				<a href="udai_contract.html"><li>诚信合约</li></a>
				<a href="item_remove.html"><li>实时下架</li></a>
			</ul>
			<div class="user-info__box">
				<div class="login-box">
					<div class="avt-port">
						<img src="{{asset('home/images/icons/default_avt.png')}}" alt="欢迎来到布袋网" class="cover b-r50">
					</div>
					<!-- 已登录 -->
					@if(session('username'))
					<div class="name c6">Hi~ <span class="cr">{{session('username')}}</span></div>
					<!-- <div class="point c6">积分: 30</div> -->
					<a class="btn btn-primary btn-block" href="#" role="button">签到领积分</a>
					@else

					<!-- 未登录 -->
					<div class="name c6">Hi~ 你好</div>
					<div class="point c6"><a href="">点此登录</a>，发现更多精彩</div>
					<div class="report-box">
						<span class="badge">+30</span>
						<!-- <a class="btn btn-info btn-block disabled" href="#" role="button">已签到1天</a> -->
						<a class="btn btn-primary btn-block" href="#" role="button">签到领积分</a>
					</div>
					@endif
				</div>
				<div class="agent-box">
					<a href="#" class="agent">
						<i class="iconfont icon-fushi"></i>
						<p>申请网店代销</p>
					</a>
					<a href="javascript:;" class="agent">
						<i class="iconfont icon-agent"></i>
						<p><span class="cr">9527</span>位代销商</p>
					</a>
				</div>
				<div class="verify-qq">
					<div class="title">
						<i class="fake"></i>
						<span class="fz12">真假QQ客服验证-远离骗子</span>
					</div>
					<form class="input-group">
						<input class="form-control" placeholder="输入客服QQ号码" type="text">
						<span class="input-group-btn">
							<button class="btn btn-primary submit" id="verifyqq" type="button">验证</button>
						</span>
					</form>
					<script>
						$(function() {
							$('#verifyqq').click(function() {
								DJMask.open({
								　　width:"400px",
								　　height:"150px",
								　　title:"U袋网提示您：",
								　　content:"<b>该QQ不是客服-谨防受骗！</b>"
							　　});
							});
						});
					</script>
				</div>
				<div class="tags">
					<div class="tag"><i class="iconfont icon-real fz16"></i> 品牌正品</div>
					<div class="tag"><i class="iconfont icon-credit fz16"></i> 信誉认证</div>
					<div class="tag"><i class="iconfont icon-speed fz16"></i> 当天发货</div>
					<div class="tag"><i class="iconfont icon-tick fz16"></i> 人工质检</div>
				</div>
			</div>
		</div>
	</div>

	@section('main2')



	@show


@endsection