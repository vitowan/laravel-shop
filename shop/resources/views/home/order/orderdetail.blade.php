@extends('home.layout.layoutPer')
@section('personal')
<div class="pull-right">
	<div class="user-content__box clearfix bgf">
		<div class="title">订单中心-订单{{$orderres->order_code}}</div>
		<div class="order-info__box">
			<div class="order-addr">收货地址：<span class="c6">{{$orderres->receiver_name}}，{{$orderres->receiver_tel}}，{{$orderres->address_detail}}</span></div>
			<div class="order-info">
				订单信息
				<table>
					<tr>
						<td>订单编号：{{$orderres->order_code}}</td>
						<td>支付宝交易号：@if($orderres->pay_method==1)支付宝@elseif($orderres->pay_method==2)微信@endif</td>
						<td>创建时间：{{$orderres->order_date}}</td>
					</tr>
					<tr>
						<td>付款时间：{{$orderres->order_paydate}}</td>
						<td>成交时间：{{$orderres->order_donedate}}</td>
						<td></td>
					</tr>
				</table>
			</div>
			<div class="table-thead">
				<div class="tdf3">商品</div>
				<div class="tdf1">状态</div>
				<div class="tdf1">数量</div>
				<div class="tdf1">单价</div>
				<div class="tdf2">优惠</div>
				<div class="tdf1">总价</div>
				<div class="tdf1">运费</div>
			</div>
			<div class="order-item__list">
				@foreach($orderlistres as $v)
				<div class="item">
					<div class="tdf3">
						<a href="item_show.html"><div class="img"><img src="{{URL('').$v->goods_photo}}" alt="" class="cover"></div>
						<div class="ep2 c6">{{$v->goods_name}}</div></a>
						<div class="attr ep">颜色分类：深棕色  尺码：均码</div>
					</div>
					<div class="tdf1">
						@if($orderres->order_status==0)
						<a href="{{URL('home/order/orderpay').'/'.$v->order_id}}" class="btn btn-default">待支付</a>
						@elseif($orderres->order_status==4)
							@if($v->detail_comment==1)
						<a href="javascript:;" >已评论</a>
							@else
							<a href="{{URL('home/orderlist1/comment').'/'.$v->detail_id}}" class='btn btn-primary' style="color:white;font-size:20px;margin-top: 20px" >去评论</a>
							@endif
						@else
						<a href="javascript:;" class=''>未评论</a>
						@endif

						<!-- 已确认收货 --></div>
					<div class="tdf1">{{$v->goods_num}}</div>
					<div class="tdf1">¥ {{number_format($v->order_subtotal)}}</div>
					<div class="tdf2">
						<!-- <div class="ep2">活动8折优惠<br>优惠：¥4.0</div> -->
						无
					</div>
					<div class="tdf1">¥ {{number_format($v->order_subtotal)}}</div>
					<div class="tdf1">
						<div class="ep2">快递<br>¥0.00</div>
					</div>
				</div>
				@endforeach

			</div>
			<div class="price-total">
				<div class="fz12 c9"><!-- 使用优惠券【满￥20.0减￥2.0】优惠￥2.0元<br> -->快递运费 ￥0.0</div>
				<div class="fz18 c6">实付款：<b class="cr">¥ {{$orderres->order_total}}</b></div>
				<!-- <div class="fz12 c9">（本单可获 <span class="c6">380</span> 积分）</div> -->
			</div>
		</div>
	</div>
</div>

@endsection