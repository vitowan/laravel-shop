@extends('home.layout.layoutPer')
@section('personal')	
	<div class="pull-right">
		<div class="user-content__box clearfix bgf">
			<div class="title">订单中心-我的订单</div>
			<div class="order-list__box bgf">
				<div class="order-panel">
					<ul class="nav user-nav__title" role="tablist">
						<li role="presentation" class="nav-item active"><a href="#all" aria-controls="all" role="tab" data-toggle="tab">所有订单</a></li>
						<li role="presentation" class="nav-item "><a href="#pay" aria-controls="pay" role="tab" data-toggle="tab">待付款 <span class="cr">0</span></a></li>
						<li role="presentation" class="nav-item "><a href="#emit" aria-controls="emit" role="tab" data-toggle="tab">待发货 <span class="cr">0</span></a></li>
						<li role="presentation" class="nav-item "><a href="#take" aria-controls="take" role="tab" data-toggle="tab">待收货 <span class="cr">0</span></a></li>
						<li role="presentation" class="nav-item "><a href="#eval" aria-controls="eval" role="tab" data-toggle="tab">待评价 <span class="cr">0</span></a></li>
					</ul>

					<div class="tab-content">
						<div role="tabpanel" class="tab-pane fade in active" id="all">
							<table class="table text-center">
								<tr>
									<th width="60">ID</th>
									<th width="200">付款时间</th>
									<th width="">订单号</th>
									<th width="">总价</th>
									<th width="120">交易状态</th>
									<th width="120">交易操作</th>
								</tr>
								@foreach($result as $v)
								<tr class="order-item">
									<td>{{$v->order_id}}</td>
									<td>{{$v->order_date}}</td>
									<td>{{$v->order_code}}</td>
									<td>￥ {{number_format($v->order_total,2)}}<br><span class="fz12 c6 text-nowrap">(含运费: ¥0.00)</span></td>

									<td class="state">
										<!-- <a class="but c6">交易成功</a> -->
										<a href="javascript:;" class="but cr">查看物流</a>
										<a href="{{URL('home/orderlist').'/'.$v->order_id}}" class="but c9">订单详情</a>
									</td>
									<td class="order">
									<!-- 	<div class="del"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></div> -->
										
											@if($v->order_status==0)
											<a href="{{URL('home/order/orderpay').'/'.$v->order_id}}" class="btn btn-danger">立即付款</a>
											<a href="javascript:;" class="but c3 returnorder" order_id="{{$v->order_id}}">取消订单</a>
											@elseif($v->order_status==1)
											<a href="JavaScript:;" class="btn btn-info">等待发货</a>
											<a href="" class="but c3">退款/退货</a>
											@elseif($v->order_status==2)
											<a href="javascript:;" class="btn btn-warning">已 发 货</a>
											<a href="" class="but c3">退款/退货</a>
											@elseif($v->order_status==3)
											<a href="javascript:;" class="btn btn-success orderreceived" order_id="{{$v->order_id}}">确认收货</a>
											<a href="javascript:;" class="but c3">退款/退货</a>
											@elseif($v->order_status==4)
												@if($v->order_comment==1)
													<a href="javascript:;" class="btn btn-default">已 完 成</a>
												@else
													<a href="{{URL('home/orderlist').'/'.$v->order_id}}" class="btn btn-default">去 评 价</a>
												@endif
											
											@elseif($v->order_status==5)
											<a href="javacript:;" class="btn btn-default">已 取 消</a>
											@endif
										
										
									</td>
								</tr>
								@endforeach
							</table>

	

							<style>
								.pagination li{
									display:inline-block;
								}
								.pagination .active{
									border:1px solid;
									color:#666;
									padding:10px 15px;
									margin:5px;
									line-height: 1em;
									background:#428bca;
								}
								.pagination .disabled {
									display:none;
								}


							</style>
							<div class="page text-right clearfix" id="page" style="margin-top: 40px;display:inline-block">
								{{$result->links()}}
							</div>

						</div>
						<div role="tabpanel" class="tab-pane fade" id="pay">
							<table class="table text-center">
								<tr>
									<th width="60">ID</th>
									<th width="200">付款时间</th>
									<th width="">订单号</th>
									<th width="">总价</th>
									<th width="120">交易状态</th>
									<th width="120">交易操作</th>
								</tr>
								@foreach($pay as $v)
								<tr class="order-item">
									<td>{{$v->order_id}}</td>
									<td>{{$v->order_date}}</td>
									<td>{{$v->order_code}}</td>
									<td>￥ {{number_format($v->order_total,2)}}<br><span class="fz12 c6 text-nowrap">(含运费: ¥0.00)</span></td>

									<td class="state">
										<!-- <a class="but c6">交易成功</a> -->
										<a href="javascript:;" class="but cr">查看物流</a>
										<a href="{{URL('home/orderlist').'/'.$v->order_id}}" class="but c9">订单详情</a>
									</td>
									<td class="order">
									<!-- 	<div class="del"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></div> -->
										
											@if($v->order_status==0)
											<a href="{{URL('home/order/orderpay').'/'.$v->order_id}}" class="btn btn-danger">立即付款</a>
											<a href="javascript:;" class="but c3 returnorder" order_id="{{$v->order_id}}">取消订单</a>
											@elseif($v->order_status==1)
											<a href="JavaScript:;" class="btn btn-info">等待发货</a>
											<a href="" class="but c3">退款/退货</a>
											@elseif($v->order_status==2)
											<a href="javascript:;" class="btn btn-warning">已 发 货</a>
											<a href="" class="but c3">退款/退货</a>
											@elseif($v->order_status==3)
											<a href="javascript:;" class="btn btn-success orderreceived" order_id="{{$v->order_id}}">确认收货</a>
											<a href="" class="but c3">退款/退货</a>
											@elseif($v->order_status==4)
											<a href="{{URL('home/orderlist').'/'.$v->order_id}}" class="btn btn-default">去 评 价</a>
											@elseif($v->order_status==5)
											<a href="javacript:;" class="btn btn-default">已 取 消</a>
											@endif
										
									</td>
								</tr>
								@endforeach
								<tr class="order-empty"><td colspan='6'>
									<div class="empty-msg">最近订单不给力，家里好像缺了点什么！<br><a href="JavaScript:;">要不瞧瞧去？</a></div>
								</td></tr>
							</table>
							<div class="page text-right clearfix" id="page" style="margin-top: 40px;display:inline-block">
								{{$pay->links()}}
							</div>
						</div>
						<div role="tabpanel" class="tab-pane fade" id="emit">
							<table class="table text-center">

								<tr>
									<th width="60">ID</th>
									<th width="200">付款时间</th>
									<th width="">订单号</th>
									<th width="">总价</th>
									<th width="120">交易状态</th>
									<th width="120">交易操作</th>
								</tr>
								@foreach($emit as $v)
								<tr class="order-item">
									<td>{{$v->order_id}}</td>
									<td>{{$v->order_date}}</td>
									<td>{{$v->order_code}}</td>
									<td>￥ {{number_format($v->order_total,2)}}<br><span class="fz12 c6 text-nowrap">(含运费: ¥0.00)</span></td>

									<td class="state">
										<!-- <a class="but c6">交易成功</a> -->
										<a href="javascript:;" class="but cr">查看物流</a>
										<a href="{{URL('home/orderlist').'/'.$v->order_id}}" class="but c9">订单详情</a>
									</td>
									<td class="order">
									<!-- 	<div class="del"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></div> -->
										
											@if($v->order_status==0)
											<a href="{{URL('home/order/orderpay').'/'.$v->order_id}}" class="btn btn-danger">立即付款</a>
											<a href="javascript:;" class="but c3 returnorder" order_id="{{$v->order_id}}">取消订单</a>
											@elseif($v->order_status==1)
											<a href="JavaScript:;" class="btn btn-info">等待发货</a>
											<a href="" class="but c3">退款/退货</a>
											@elseif($v->order_status==2)
											<a href="javascript:;" class="btn btn-warning">已 发 货</a>
											<a href="" class="but c3">退款/退货</a>
											@elseif($v->order_status==3)
											<a href="javascript:;" class="btn btn-success orderreceived" order_id="{{$v->order_id}}">确认收货</a>
											<a href="" class="but c3">退款/退货</a>
											@elseif($v->order_status==4)
											<a href="{{URL('home/orderlist').'/'.$v->order_id}}" class="btn btn-default">去 评 价</a>
											@elseif($v->order_status==5)
											<a href="javacript:;" class="btn btn-default">已 取 消</a>
											@endif
										
									</td>
								</tr>
								@endforeach



							</table>
							<div class="page text-right clearfix" id="page" style="margin-top: 40px;display:inline-block">
								{{$emit->links()}}
							</div>
						</div>
						<div role="tabpanel" class="tab-pane fade" id="take">
							<table class="table text-center">
								<tr>
									<th width="60">ID</th>
									<th width="200">付款时间</th>
									<th width="">订单号</th>
									<th width="">总价</th>
									<th width="120">交易状态</th>
									<th width="120">交易操作</th>
								</tr>
								@foreach($take as $v)
								<tr class="order-item">
									<td>{{$v->order_id}}</td>
									<td>{{$v->order_date}}</td>
									<td>{{$v->order_code}}</td>
									<td>￥ {{number_format($v->order_total,2)}}<br><span class="fz12 c6 text-nowrap">(含运费: ¥0.00)</span></td>

									<td class="state">
										<!-- <a class="but c6">交易成功</a> -->
										<a href="javascript:;" class="but cr">查看物流</a>
										<a href="{{URL('home/orderlist').'/'.$v->order_id}}" class="but c9">订单详情</a>
									</td>
									<td class="order">
									<!-- 	<div class="del"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></div> -->
										
											@if($v->order_status==0)
											<a href="{{URL('home/order/orderpay').'/'.$v->order_id}}" class="btn btn-danger">立即付款</a>
											<a href="javascript:;" class="but c3 returnorder" order_id="{{$v->order_id}}">取消订单</a>
											@elseif($v->order_status==1)
											<a href="JavaScript:;" class="btn btn-info">等待发货</a>
											<a href="" class="but c3">退款/退货</a>
											@elseif($v->order_status==2)
											<a href="javascript:;" class="btn btn-warning">已 发 货</a>
											<a href="" class="but c3">退款/退货</a>
											@elseif($v->order_status==3)
											<a href="javascript:;" class="btn btn-success orderreceived" order_id="{{$v->order_id}}">确认收货</a>
											<a href="" class="but c3">退款/退货</a>
											@elseif($v->order_status==4)
											<a href="{{URL('home/orderlist').'/'.$v->order_id}}" class="btn btn-default">去 评 价</a>
											@elseif($v->order_status==5)
											<a href="javacript:;" class="btn btn-default">已 取 消</a>
											@endif
										
									</td>
								</tr>
								@endforeach
								<tr class="order-empty"><td colspan='6'>
									<div class="empty-msg">最近订单不给力，家里好像缺了点什么！<br><a href="Javascript:;">要不瞧瞧去？</a></div>
								</td></tr>
							</table>
							<div class="page text-right clearfix" id="page" style="margin-top: 40px;display:inline-block">
								{{$take->links()}}
							</div>
						</div>
						<div role="tabpanel" class="tab-pane fade" id="eval">
							<table class="table text-center">
								<tr>
									<th width="60">ID</th>
									<th width="200">付款时间</th>
									<th width="">订单号</th>
									<th width="">总价</th>
									<th width="120">交易状态</th>
									<th width="120">交易操作</th>
								</tr>
								@foreach($eval as $v)
								<tr class="order-item">
									<td>{{$v->order_id}}</td>
									<td>{{$v->order_date}}</td>
									<td>{{$v->order_code}}</td>
									<td>￥ {{number_format($v->order_total,2)}}<br><span class="fz12 c6 text-nowrap">(含运费: ¥0.00)</span></td>

									<td class="state">
										<!-- <a class="but c6">交易成功</a> -->
										<a href="javascript:;" class="but cr">查看物流</a>
										<a href="{{URL('home/orderlist').'/'.$v->order_id}}" class="but c9">订单详情</a>
									</td>
									<td class="order">
									<!-- 	<div class="del"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></div> -->
										
											@if($v->order_status==0)
											<a href="{{URL('home/order/orderpay').'/'.$v->order_id}}" class="btn btn-danger">立即付款</a>
											<a href="javascript:;" class="but c3 returnorder" order_id="{{$v->order_id}}">取消订单</a>
											@elseif($v->order_status==1)
											<a href="JavaScript:;" class="btn btn-info">等待发货</a>
											<a href="" class="but c3">退款/退货</a>
											@elseif($v->order_status==2)
											<a href="javascript:;" class="btn btn-warning">已 发 货</a>
											<a href="" class="but c3">退款/退货</a>
											@elseif($v->order_status==3)
											<a href="javascript:;" class="btn btn-success orderreceived" order_id="{{$v->order_id}}">确认收货</a>
											<a href="" class="but c3">退款/退货</a>
											@elseif($v->order_status==4)
												
											<a href="{{URL('home/orderlist').'/'.$v->order_id}}" class="btn btn-default">去 评 价</a>
												
											@elseif($v->order_status==5)
											<a href="javacript:;" class="btn btn-default">已 取 消</a>
											@endif
										
									</td>
								</tr>
								@endforeach
	
							</table>
							<div class="page text-right clearfix" id="page" style="margin-top: 40px;display:inline-block">
								{{$eval->links()}}
							</div>
						</div>
					</div>
				</div>
			</div>
		
		</div>
	</div>


						<script>
								//取消订单
								$('.returnorder').click(function(){
									order_id=$(this).attr('order_id');
									layer.confirm('确定取消订单吗？',{btn:['确定','点错了'],icon:5,title:'！！注意'},function(){
										$.post("{{URL('home/orderlist')}}"+'/'+order_id,{'_token':"{{csrf_token()}}",'_method':'put'},function(r){
											//alert(r);
											window.location.reload();
										});										
									});

								});

								//确认收货
								$('.orderreceived').click(function(){
									order_id=$(this).attr('order_id');
									layer.confirm('收到货后再点击“确定”，点击确定后不可返回操作',{btn:['确定','取消'],icon:0,title:'！！注意'},function(){
										$.post("{{URL('home/orderlist1/update1')}}"+'/'+order_id,{'_token':"{{csrf_token()}}"},function(r){
											//alert(r);
											window.location.reload();
										});										
									});

								});
								
							</script>	


@endsection