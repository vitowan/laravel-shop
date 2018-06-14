@extends('home.layout.layout')
@section('main')	


	<!-- 顶部标题 -->
	<div class="bgf5 clearfix">
		<div class="top-user">
			<div class="inner">
				<a class="logo" href="{{URL('home/home/index')}}"><img src="{{URL('home/images/icons/logo.jpg')}}" alt="U袋网" class="cover"></a>
				<div class="title">购物车</div>
			</div>
		</div>
	</div>
	<div class="content clearfix bgf5">
		<section class="user-center inner clearfix">
			<div class="user-content__box clearfix bgf">
				<div class="title">购物车-确认支付 </div>
				<div class="shop-title">收货地址</div>
				<form action="" class="shopcart-form__box">
					<div class="addr-radio">
				<!-- 		<div class="radio-line radio-box active">
					<label class="radio-label ep" title="福建省 福州市 鼓楼区 温泉街道 五四路159号世界金龙大厦20层B北 福州rpg.blue网络 （喵喵喵 收） 153****9999">
						<input name="addr" checked="" value="0" autocomplete="off" type="radio"><i class="iconfont icon-radio"></i>
						福建省 福州市 鼓楼区 温泉街道
						五四路159号世界金龙大厦20层B北 福州rpg.blue网络
						（喵喵喵 收） 153****9999
					</label>
					<a href="javascript:;" class="default">默认地址</a>
					<a href="udai_address_edit.html" class="edit">修改</a>
				</div> -->
						@foreach($address as $v)
						@if($v->address_default==1)
						<div class="radio-line radio-box active">
							<label class="radio-label ep" title="">
								<input name="addr" value="1" autocomplete="off" address_id="{{$v->address_id}}" type="radio" checked class='address_radio'><i class="iconfont icon-radio"></i>
								{{$v->address_detail}}  &nbsp;&nbsp;&nbsp;&nbsp; (收件人： {{$v->receiver_name}})&nbsp;&nbsp;&nbsp;&nbsp;{{$v->receiver_tel}}
							</label>

							@if($v->address_default==1)
							<a href="javascript:;" class="default active" style='color:red'>默认地址</a>
							@else
							<a href="javascript:;" class="default addr_default" address_id="{{$v->address_id}}">设为默认</a>
							@endif

							<a href="{{URL('home/personal/addressupdate').'/'.$v->address_id}}" class="edit">修改</a>
						</div>
						@else



						<div class="radio-line radio-box">
							<label class="radio-label ep" title="">
								<input name="addr" value="1" autocomplete="off" address_id="{{$v->address_id}}" type="radio" class='address_radio'><i class="iconfont icon-radio"></i>
								{{$v->address_detail}}  &nbsp;&nbsp;&nbsp;&nbsp; (收件人： {{$v->receiver_name}})&nbsp;&nbsp;&nbsp;&nbsp;{{$v->receiver_tel}}
							</label>

							@if($v->address_default==1)
							<a href="javascript:;" class="default active" style='color:red'>默认地址</a>
							@else
							<a href="javascript:;" class="default addr_default" address_id="{{$v->address_id}}">设为默认</a>
							@endif


							<a href="{{URL('home/personal/addressupdate').'/'.$v->address_id}}" class="edit">修改</a>
						</div>
						@endif

						@endforeach


					</div>
					<div class="add_addr"><a href="{{URL('home/personal/peraddress')}}">++ 添加新地址</a></div>
					<div class="shop-title">确认订单</div>
					<div class="shop-order__detail">
						<table class="table">
							<thead>
								<tr>
									<th width="120">商品图</th>
									<th width="300">商品信息</th>
									<th width="150">单价</th>
									<th width="200">数量</th>
									<th width="200">运费</th>
									<th width="80">总价</th>
								</tr>
							</thead>
							<tbody>
								@foreach($result as $v)
								<tr>
									<th scope="row"><a href="item_show.html"><div class="img"><img src="{{URL('').$v->goods_photo}}" alt="{{$v->goods_name}}" class="cover"></div></a></th>
									<td>
										<div class="name ep3">{{$v->goods_name}}</div>
										<div class="type c9">颜色分类：深棕色  尺码：均码</div>
									</td>
									<td>{{number_format($v->goods_price,2)}}</td>
									<td>{{$v->goods_num}}</td>
									<td>¥0.0</td>
									<td>{{number_format($v->order_subtotal,2)}}</td>
								</tr>
								@endforeach

							</tbody>
						</table>
					</div>
					<div class="shop-cart__info clearfix">
						
						<div class="pull-left text-left">
							<div class="info-line text-nowrap">下单时间：<span class="c6">{{$res->order_code}}</span></div>
							<div class="info-line text-nowrap">交易类型：<span class="c6">担保交易</span></div>
							<div class="info-line text-nowrap">订单号：<span class="c6">{{$res->order_date}}</span></div> 
						</div>

					<div class="pull-right text-right">
							<div class="form-group">
								<label for="coupon" class="control-label">优惠券使用：</label>
								<select id="coupon" >
									<option value="-1" selected>- 请选择可使用的优惠券 -</option>
									<option value="1">【满￥20.0元减￥2.0】</option>
									<option value="2">【满￥30.0元减￥2.0】</option>
									<option value="3">【满￥25.0元减￥1.0】</option>
									<option value="4">【满￥10.0元减￥1.5】</option>
									<option value="5">【满￥15.0元减￥1.5】</option>
									<option value="6">【满￥20.0元减￥1.0】</option>
								</select>
							</div>
							<script>
								$('#coupon').bind('change',function() {
									console.log($(this).val());
								})
							</script>
							<div class="info-line">优惠活动：<span class="c6">无</span></div>
							<div class="info-line">运费：<span class="c6">¥0.00</span></div>
							<div class="info-line"><span class="favour-value">已优惠 ¥ 0</span>合计：<b class="fz18 cr">¥{{$total}}</b></div>
							<div class="info-line fz12 c9">（可获 <span class="c6">20</span> 积分）</div>
						</div>
					</div>
					<!-- <div class="shop-title">确认订单</div> -->
					<div class="pay-mode__box">
<!-- 
						<div class="radio-line radio-box">
							<label class="radio-label ep">
								<input name="pay-mode" value="1" autocomplete="off" type="radio"><i class="iconfont icon-radio"></i>
								<span class="fz16">余额支付</span><span class="fz14">（可用余额：¥88.0）</span>
							</label>
							<div class="pay-value">支付<b class="fz16 cr">18.00</b>元</div>
						</div>
						 -->
						<div class="radio-line radio-box active">
							<label class="radio-label ep">
								<input name="pay-mode" value="1" checked autocomplete="off" type="radio" class='pay_method'><i class="iconfont icon-radio"></i>
								<img src="{{URL('home/images/icons/alipay.png')}}" alt="支付宝支付">
							</label>
							<div class="pay-value">支付 <b class="fz16 cr" >{{$total}}</b>元</div>
						</div>
						<div class="radio-line radio-box">
							<label class="radio-label ep">
								<input name="pay-mode" value="2" autocomplete="off" type="radio" class='pay_method'><i class="iconfont icon-radio"></i>
								<img src="{{URL('home/images/icons/paywechat.png')}}" alt="微信支付">
							</label>
							<div class="pay-value">支付 <b class="fz16 cr">{{$total}}</b>元</div>
						</div>
					</div>
					<div class="user-form-group shopcart-submit">
						<input type="button" class="btn" id='doorder' pay_method='' address_id="" value='继续支付'>
					</div>
					<script>
						//选择支付方式
						$(document).ready(function(){
							$(this).on('change','input',function() {
								$(this).parents('.radio-box').addClass('active').siblings().removeClass('active');
							})
						});
					</script>

					<script>
							//点击继续支付后
						$('.address_radio').click(function(){
							//如果发生了选择地址的点击事件，说明用户可能选的不是默认地址，此时找到用户点击的是哪个地址，把地址先赋到继续支付按钮上
							$address_id=$(this).attr('address_id');
							$('#doorder').attr('address_id',$address_id);//选择了说明有地址id或者为空
							//alert($address_id);			
						});
						$('.pay_method').click(function(){
							//alert(1);同上如果点击了支付方式，获得当前的value值
							$pay_method=$(this).val();//1或者2，或者空
							//alert($pay_method);

							$('#doorder').attr('pay_method',$pay_method);


						});
						$('#doorder').click(function(){
							//alert($(this).attr('address_id'));
							//传值到订单处理页面
							$address_id=$(this).attr('address_id');
							$pay_method=$(this).attr('pay_method');
							$.get("{{URL('home/order/doorderpay').'/'.$res->order_id}}",{'address_id':$address_id,'pay_method':$pay_method},function(r){
								if(r==1){
									layer.msg('恭喜您，购买成功,正在跳转到首页',{time:5000});
									window.location.href="{{URL('home/orderlist')}}";
								}else{
									layer.msg('糟糕，发生了错误！',{time:3000});
								}
							});
						});

					</script>
				</form>
			</div>
		</section>
	</div>
	<script>
		//设置默认地址
		$('.addr_default').click(function(){
			//alert(1);
			address_id=$(this).attr('address_id');
			$.get("{{URL('home/personal/addr_default')}}",{'address_id':address_id},function(r){
				//alert(r);
				if(r){

					window.location.reload();
				}
			});
		});
	</script>





@endsection