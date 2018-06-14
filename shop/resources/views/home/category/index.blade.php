@extends('home.layout.layoutNav')
@section('main1')

	<div class="content inner">
		<section class="filter-section clearfix">
			<ol class="breadcrumb">
				<li><a href="{{URL('home/home/index')}}">首页</a></li>
				<li class="active">商品筛选</li>
			</ol>
			<div class="filter-box">
				<div class="all-filter">
					<div class="filter-value">
						<div class="filter-title">选择商品分类 <i class="iconfont icon-down"></i></div>
						<!-- 全部大分类 -->
						<ul class="catelist-card">
							<a href="{{URL('home/category/index')}}"><li class="active">全部分类</li></a>
							@foreach($data as $v)
							<a href="{{URL('home/category/index').'/'.$v->id}}" > <li>{{$v->cate_name}}</li></a>
							@endforeach
	
						</ul>
						<!-- 已选选项 -->
						<div class="ul_filter">

							<span class="pull-left" style='padding:7px 10px;height:28px;font-size:14px;margin-top:2px';>
								全部分类
							</span>
							<span class="pull-left" style='border:none;width:20px;padding-right: 5px'>
							&gt;&gt;
							</span>								

							<span class="pull-left" id='catename' style='padding:7px 10px;height:28px;font-size:14px;margin-top:2px';>
								{{$cate_name}}
							</span>

							<span class="pull-left" id='level1' style='padding:7px 10px;height:28px;font-size:14px;margin-top:2px;border:none;'>
								
							</span>

 							<span class="pull-left" id='level2' style='padding:7px 10px;height:28px;font-size:14px;margin-top:2px;border:none';>
								
							</span>
<!-- 							<span class="pull-left" style='border:none;width:20px;padding-right: 5px'>
&gt;&gt;
</span>							
<select name="" id="" class=" " style='line-height: 24px;margin-bottom:5px;float:left;margin-top: 2px;height:28px;font-size:14px'>

	<option value="">精选上装</option>


</select>
<span class="pull-left" style='border:none;width:20px;padding-right: 5px'>
&gt;&gt;
</span>								
<select name="" id="" class=" " style='line-height: 24px;float:left;margin-top: 2px;height:28px;font-size:14px'>

	
	<option value="">精选上装</option>
	

</select>	 -->
							

<!-- 
							<span class="pull-left" style='border:none;width:20px;padding-right: 5px;'>
							&gt;&gt;
							</span>
							<span class="pull-left">
								颜色：红色 <a href="javascript:;" class="close" >&times;</a>
							</span>
							<span class="pull-left">
								尺寸：XXL <a href="javascript:;" class="close" >&times;</a>
							</span> -->

												
						</div>
						<a class="reset pull-right" href="{{URL('home/category/index')}}">重置</a>
					</div>
				</div>

				<div class="filter-prop-item" style="">
					<span class="filter-prop-title">分类：</span>
					<ul class="clearfix" id='catetop'>
						<a href="javascript:;" "><li class="active">全部</li></a>
						@foreach($result as $v)
						
						<a href="javascript:;" onclick="cateclick({{$v->id}},this)" ><li>{{$v->cate_name}}</li></a>
						@endforeach
						
					</ul>
				</div>

				<div class="filter-prop-item" style="{{$dis}}">
					<span class="filter-prop-title">细分类：</span>
					<ul class="clearfix" id='catebottom'>
						<a href=""><li class="active">全部</li></a>
						
						@foreach($result as $v)
							@foreach($v->child as $v)
						<a href="javascript:;" onclick="cateclick({{$v->id}},this)"><li>{{$v->cate_name}}</li></a>
							@endforeach
						@endforeach
						
					</ul>
				</div>


				<div class="filter-prop-item">
					<span class="filter-prop-title">价格：</span>
					<ul class="clearfix">
						<a href=""><li class="active">全部</li></a>
						<a href=""><li>0-20</li></a>
						<a href=""><li>20-40</li></a>
						<a href=""><li>40-80</li></a>
						<a href=""><li>80-100</li></a>
						<a href=""><li>100-150</li></a>
						<a href=""><li>150以上</li></a>
						<form class="price-order">
							<input type="text">
							<span class="cc">-</span>
							<input type="text">
							<input type="button" value="确定">
						</form>
					</ul>
				</div>
			</div>
			<div class="sort-box bgf5">
				<div class="sort-text">排序：</div>
				<a href=""><div class="sort-text">销量 <i class="iconfont icon-sortDown"></i></div></a>
				<a href=""><div class="sort-text">评价 <i class="iconfont icon-sortUp"></i></div></a>
				<a href=""><div class="sort-text">价格 <i class="iconfont"></i></div></a>
				<div class="sort-total pull-right">共1688个商品</div>
			</div>
		</section>
		<section class="item-show__div clearfix">
			<div class="pull-left">

				<div class="item-list__area clearfix" >
					
					@if(count($categoods))
						@foreach($categoods as $v)
						<div class="item-card">
							<a href="{{URL('home/goodsdetail/index').'/'.$v->goods_id}}" class="photo">
								<img src="{{URL('').$v->goods_photo}}" alt="{{$v->goods_name}}" class="cover">
								<div class="name">{{$v->goods_name}}</div>
							</a>
							<div class="middle">
								<div class="price"><small>￥</small>{{$v->goods_price}}</div>
								<div class="sale"><a href="">加入购物车</a></div>
							</div>
							<div class="buttom">
								<div>销量 <b>{{$v->goods_sales}}</b></div>
								<div>人气 <b>888</b></div>
								<div>评论 <b>1688</b></div>
							</div>
						</div>
						@endforeach
						@else
							<div style='text-align: center;margin:100px auto'>
								啊哦，没有查询到相关内容!!!
							</div>
								
					@endif

				 
				</div>

				<!-- 分页 -->
				<div class="page text-right clearfix">
					<style>
						.pagination li{
							display:inline-block;
						}
						.pagination .active{
							background:blue;
						}
						.pagination .active span{
							padding:10px 15px;
							margin:5px;
							line-height:1em;
							display:inline-block;
							color:#fff;
					
						}
						.pagination .disabled span{
							padding:10px 15px;
							margin:5px;
							line-height:1em;
							display:inline-block;
							border:1px solid;
						}
					</style>

				{{$html}}

<!-- 
					<a class="">上一页</a>
 					<a class="select">1</a>
					<a href="">2</a>
					<a href="">3</a>
					<a href="">4</a>
					<a href="">5</a> 
					<a class="" href="">下一页</a>
					<a class="disabled">1/5页</a>
					<form action="" class="page-order">
						到第
						<input type="text" name="page">
						页
						<input class="sub" type="submit" value="确定">
					</form> -->
				</div>
			</div>
			<div class="pull-right">
				
				<div class="desc-segments__content">
					<div class="lace-title">
						<span class="c6">爆款推荐</span>
					</div>
					<div class="picked-box">
						<a href="" class="picked-item"><img src="{{URL('home/images/temp/S-001.jpg')}}" alt="" class="cover"><span class="look_price">¥134.99</span></a>
						<a href="" class="picked-item"><img src="{{URL('home/images/temp/S-001.jpg')}}" alt="" class="cover"><span class="look_price">¥134.99</span></a>
						<a href="" class="picked-item"><img src="{{URL('home/images/temp/S-001.jpg')}}" alt="" class="cover"><span class="look_price">¥134.99</span></a>
						<a href="" class="picked-item"><img src="{{URL('home/images/temp/S-001.jpg')}}" alt="" class="cover"><span class="look_price">¥134.99</span></a>
						<a href="" class="picked-item"><img src="{{URL('home/images/temp/S-001.jpg')}}" alt="" class="cover"><span class="look_price">¥134.99</span></a>
						<a href="" class="picked-item"><img src="{{URL('home/images/temp/S-001.jpg')}}" alt="" class="cover"><span class="look_price">¥134.99</span></a>
						<a href="" class="picked-item"><img src="{{URL('home/images/temp/S-001.jpg')}}" alt="" class="cover"><span class="look_price">¥134.99</span></a>
						<a href="" class="picked-item"><img src="{{URL('home/images/temp/S-001.jpg')}}" alt="" class="cover"><span class="look_price">¥134.99</span></a>
						<a href="" class="picked-item"><img src="{{URL('home/images/temp/S-001.jpg')}}" alt="" class="cover"><span class="look_price">¥134.99</span></a>
						<a href="" class="picked-item"><img src="{{URL('home/images/temp/S-001.jpg')}}" alt="" class="cover"><span class="look_price">¥134.99</span></a>
					</div>
				</div>
			</div>
		</section>
	</div>


<style>
	.color_red{
		color:red!important;
	}

</style>
<script>

	//alert($);

	//选择商品分类点击当前的分类时传到控制器数据
	function cateclick(id,obj){
		 console.log(obj);

		 $('.color_red').removeClass('color_red');
		$(obj).children('li').addClass('color_red');

		$.get("{{URL('home/category/cateclick')}}",{'id':id},function(r){
			//console.log(r);
			//选择类之后先移除所有的产品，下面再循环遍历出新的
			$('.pull-left .item-list__area .item-card').remove();
			$.each(r,function(kkk,vvv){
					//console.log(vvv);
				$('.pull-left .item-list__area').append(
			'<div class="item-card"><a href="'+"{{URL('home/goodsdetail/index')}}"+'/'+vvv['goods_id']+'" class="photo"><img src="'+"{{URL('')}}"+vvv['goods_photo']+'" alt="'+vvv['goods_name']+'"+ class="cover"><div class="name">'+vvv['goods_name']+'</div></a><div class="middle"><div class="price"><small>￥</small>'+vvv['goods_price']+'</div><div class="sale"><a href="">加入购物车</a></div></div><div class="buttom"><div>销量 <b>'+vvv['goods_sales']+'</b></div><div>人气 <b>888</b></div><div>评论 <b>1688</b></div></div></div>'

				);

			});

		});

	}
</script>

@endsection

