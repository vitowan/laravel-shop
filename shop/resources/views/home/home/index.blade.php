@extends('home.layout.layoutNav')

@section('leftnav')
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

@endsection


@section('user_info')

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


@endsection


@section('main1')

	<!-- 顶部轮播 -->
    <div class="swiper-container banner-box">
        <div class="swiper-wrapper">
            <div class="swiper-slide"><a href="item_show.html"><img src="{{asset('home/images/temp/banner_1.jpg')}}" class="cover"></a></div>
            <div class="swiper-slide"><a href="item_show.html"><img src="{{asset('home/images/temp/banner_2.jpg')}}" class="cover"></a></div>
            <div class="swiper-slide"><a href="item_category.html"><img src="{{asset('home/images/temp/banner_3.jpg')}}" class="cover"></a></div>
            <div class="swiper-slide"><a href="item_show.html"><img src="{{asset('home/images/temp/banner_4.jpg')}}" class="cover"></a></div>
            <div class="swiper-slide"><a href="item_sale_page.html"><img src="{{asset('home/images/temp/banner_5.jpg')}}" class="cover"></a></div>
            
        </div>
        <div class="swiper-pagination"></div>
    </div>
    <!-- 首页楼层导航 -->
	<nav class="floor-nav visible-lg-block">
		<!-- <span class="scroll-nav active">爆款推荐</span> -->
		@foreach($all as $v)
		<span class="scroll-nav">{{$v->cate_name}}</span>
		@endforeach

	</nav>
	<!-- 楼层内容 -->
	<div class="content inner" style="margin-bottom: 40px;">
<!-- 
		<section class="scroll-floor floor-1 clearfix">
			<div class="pull-left">
				<div class="floor-title">
					<i class="iconfont icon-tuijian fz16"></i> 爆款推荐
					<a href="" class="more"><i class="iconfont icon-more"></i></a>
				</div>
				<div class="con-box">
					<a class="left-img hot-img" href="">
						<img src="images/floor_1.jpg" alt="" class="cover">
					</a>
					<div class="right-box hot-box">
						<a href="item_show.html" class="floor-item">
							<div class="item-img hot-img">
								<img src="images/temp/S-001.jpg" alt="纯色圆领短袖T恤活a动衫弹" class="cover">
							</div>
							<div class="price clearfix">
								<span class="pull-left cr fz16">￥18.0</span>
								<span class="pull-right c6">进货价</span>
							</div>
							<div class="name ep" title="纯色圆领短袖T恤活a动衫弹力柔软">纯色圆领短袖T恤活a动衫弹力柔软</div>
						</a>
						<a href="item_show.html" class="floor-item">
							<div class="item-img hot-img">
								<img src="images/temp/S-002.jpg" alt="纯色圆领短袖T恤活a动衫弹" class="cover">
							</div>
							<div class="price clearfix">
								<span class="pull-left cr fz16">￥18.0</span>
								<span class="pull-right c6">进货价</span>
							</div>
							<div class="name ep" title="纯色圆领短袖T恤活a动衫弹力柔软">纯色圆领短袖T恤活a动衫弹力柔软</div>
						</a>
						<a href="item_show.html" class="floor-item">
							<div class="item-img hot-img">
								<img src="images/temp/S-003.jpg" alt="纯色圆领短袖T恤活a动衫弹" class="cover">
							</div>
							<div class="price clearfix">
								<span class="pull-left cr fz16">￥18.0</span>
								<span class="pull-right c6">进货价</span>
							</div>
							<div class="name ep" title="纯色圆领短袖T恤活a动衫弹力柔软">纯色圆领短袖T恤活a动衫弹力柔软</div>
						</a>
						<a href="item_show.html" class="floor-item">
							<div class="item-img hot-img">
								<img src="images/temp/S-004.jpg" alt="纯色圆领短袖T恤活a动衫弹" class="cover">
							</div>
							<div class="price clearfix">
								<span class="pull-left cr fz16">￥18.0</span>
								<span class="pull-right c6">进货价</span>
							</div>
							<div class="name ep" title="纯色圆领短袖T恤活a动衫弹力柔软">纯色圆领短袖T恤活a动衫弹力柔软</div>
						</a>
						<a href="item_show.html" class="floor-item">
							<div class="item-img hot-img">
								<img src="images/temp/S-005.jpg" alt="纯色圆领短袖T恤活a动衫弹" class="cover">
							</div>
							<div class="price clearfix">
								<span class="pull-left cr fz16">￥18.0</span>
								<span class="pull-right c6">进货价</span>
							</div>
							<div class="name ep" title="纯色圆领短袖T恤活a动衫弹力柔软">纯色圆领短袖T恤活a动衫弹力柔软</div>
						</a>
						<a href="item_show.html" class="floor-item">
							<div class="item-img hot-img">
								<img src="images/temp/S-006.jpg" alt="纯色圆领短袖T恤活a动衫弹" class="cover">
							</div>
							<div class="price clearfix">
								<span class="pull-left cr fz16">￥18.0</span>
								<span class="pull-right c6">进货价</span>
							</div>
							<div class="name ep" title="纯色圆领短袖T恤活a动衫弹力柔软">纯色圆领短袖T恤活a动衫弹力柔软</div>
						</a>
					</div>
				</div>
			</div>
			<div class="pull-right">
				<div class="floor-title">
					<i class="iconfont icon-horn fz16"></i> 平台公告
					<a href="udai_notice.html" class="more"><i class="iconfont icon-more"></i></a>
				</div>
				<div class="con-box">
					<div class="notice-box bgf5">
						<div class="swiper-container">
							<div class="swiper-wrapper">
								<a class="swiper-slide ep" href="udai_notice.html">【公告】U袋网平台已上线，您还在等什么呢？是吧~</a>
								<a class="swiper-slide ep" href="udai_notice.html">【资讯】P站服务器爆炸啦。国内86%地区IP被限制~</a>
								<a class="swiper-slide ep" href="udai_notice.html">【公告】六趣公司9月底将彻底关闭66RPG论坛~</a>
								<a class="swiper-slide ep" href="udai_notice.html">【资讯】Project1站将接盘66RPG，新域名rpg.blue</a>
								<a class="swiper-slide ep" href="udai_notice.html">【新闻】央行决定对普惠金融实施定向降准政策 最高下调1.5个百分点</a>
								<a class="swiper-slide ep" href="udai_notice.html">【新闻】那些年看的剧里十大虐心情节，谁戳中了你的泪点？</a>
								<a class="swiper-slide ep" href="udai_notice.html">【新闻】惨遭魔改？派拉蒙将拍真人版《你的名字。》</a>
								<a class="swiper-slide ep" href="udai_notice.html">【新闻】外媒称中国限制日本跟团游?旅行社:仍正常发团</a>
								<a class="swiper-slide ep" href="udai_notice.html">【新闻】广电总局：电台电视台应在重要法定节日播放国歌</a>
								<a class="swiper-slide ep" href="udai_notice.html">【新闻】高校性教育课成"爆款" 老师都讲哪些"大尺度"内容?</a>
								<a class="swiper-slide ep" href="udai_notice.html">【新闻】vivo X20全面屏手机首销火爆 陈赫欧豪现身助力</a>
								<a class="swiper-slide ep" href="udai_notice.html">【新闻】“拒绝妻子手术”现场医生：病人丈夫被冤枉了</a>
								<a class="swiper-slide ep" href="udai_notice.html">【新闻】游客们注意了！国庆你要避开十大坑</a>
								<a class="swiper-slide ep" href="udai_notice.html">【新闻】他卖了1.5万双假货，现在面临10年牢狱！</a>
								<a class="swiper-slide ep" href="udai_notice.html">【新闻】10月1日起国家再次提高部分优抚对象抚恤补助标准 烈属抚恤每年23130元</a>
							</div>
						</div>
					</div>
					<div class="buts-box bgf5">
						<div class="but-div">
							<a href="">
								<i class="but-icon"></i>
								<p>物流查询</p>
							</a>
						</div>
						<div class="but-div">
							<a href="item_sale_page.html">
								<i class="but-icon"></i>
								<p>热卖专区</p>
							</a>
						</div>
						<div class="but-div">
							<a href="item_sale_page.html">
								<i class="but-icon"></i>
								<p>满减专区</p>
							</a>
						</div>
						<div class="but-div">
							<a href="item_sale_page.html">
								<i class="but-icon"></i>
								<p>折扣专区</p>
							</a>
						</div>
					</div>
				</div>
			</div>
		</section>
		 -->
		@foreach($all as $k=>$v)
		<section class="scroll-floor floor-2">
			<div class="floor-title">
				<i class="iconfont icon-skirt fz16"></i> <a href="{{URL('home/category/index').'/'.$v->id}}">{{$v->cate_name}}</a>
				<div class="case-list fz0 pull-right">
					@foreach($v->child as $kk=>$vv)
					<a href="{{URL('home/category/index').'/'.$vv->id}}">{{$vv->cate_name}}</a>
					@endforeach

				</div>
			</div>
			<div class="con-box">

				<a class="left-img hot-img" href="{{URL('home/category/index').'/'.$v->id}}">
					<img src="{{URL('').$v->cate_pic}}" alt="" class="cover">
				</a>

			<?php $n=0 ?>
				<div class="right-box">
					@foreach($v->child as $kk=>$vv)

						@foreach($vv->child as $kkk=>$vvv)
							@foreach($vvv->goods as $kkkk=>$vvvv)

							
								@if($n<8)
								<?php $n++ ?>
								
							
					<a href="{{URL('home/goodsdetail/index').'/'.$vvvv->goods_id}}" class="floor-item">
						<div class="item-img hot-img">
							<img src="{{URL('').$vvvv->goods_photo}}" alt="{{$vvvv->goods_name}}" class="cover">
						</div>
						<div class="price clearfix">
							<span class="pull-left cr fz16">￥{{$vvvv->goods_price}}</span>
							<span class="pull-right c6">进货价</span>
						</div>
						<div class="name ep" title="{{$vvvv->goods_name}}">{{$vvvv->goods_name}}</div>
					</a>
								@endif
							@endforeach
						@endforeach
					@endforeach

				</div>
			</div>
		</section>
		@endforeach

	</div>
	<script>
		$(document).ready(function(){ 
			// 顶部banner轮播
			var banner_swiper = new Swiper('.banner-box', {
				autoplayDisableOnInteraction : false,
				pagination: '.banner-box .swiper-pagination',
				paginationClickable: true,
				autoplay : 5000,
			});
			// 新闻列表滚动
			var notice_swiper = new Swiper('.notice-box .swiper-container', {
				paginationClickable: true,
				mousewheelControl : true,
				direction : 'vertical',
				slidesPerView : 10,
				autoplay : 2e3,
			});
			// 楼层导航自动 active
			$.scrollFloor();
			// 页面下拉固定楼层导航
			$('.floor-nav').smartFloat();
			$('.to-top').toTop({position:false});
		});
	</script>

@endsection

