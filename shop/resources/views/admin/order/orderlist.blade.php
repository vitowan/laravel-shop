@extends('admin.layout.layout')
@section('title1','订单管理')
@section('title2','添加产品')
@section('main')

@if(session('message'))
<script>
	layer.alert("{{session('message')}}");
</script>
	
@endif
<div class="col-xs-12">

	<div class="table-responsive">

		<form action={{URL('admin/cate')}} method='get' class="form-inline" style="margin-bottom:5px;display:inline-block">
		  <div class="form-group">
		    <input type="text" class="form-control" value="" name='search' placeholder="请输入用户名查询" style='height:42px;width:200px'>
		  </div>
		  <button type="submit" class="btn btn-default">搜索</button>
		</form>

		<table id="sample-table-1" class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th  class='text-center'>订单ID</th>
					<th  class='text-center'>
						<i class="icon-time bigger-110 hidden-480"></i>
						订单时间
					</th>
					<th  class='text-center'>用户名</th>
					<th  class='text-center'>订单号</th>
					<th  class='text-center '>订单总金额</th>
					<th  class='text-center'>收件人姓名</th>
					<th  class='text-center'>收件人电话</th>
					<th  class='text-center'>收件地址</th>
					<th  class='text-center'>付款方式</th>
					<th  class='text-center'>订单详情</th>
					<th  class='text-center'>状态操作</th>

				</tr>
			</thead>

			<tbody>
				@foreach($res as $v)
				<tr>
					<td  class='text-center'>{{$v->order_id}}</td>
					<td  class='text-center'>{{$v->order_date}}</td>
					<td  class='text-center'>{{$v->user_id}}</td>
					<td  class='text-center'>{{$v->order_code}}</td>
					<td  class='text-center'>{{number_format($v->order_total,2)}}</td>
					<td  class='text-center'>{{$v->receiver_name}}</td>
					<td  class='text-center'>{{$v->receiver_tel}}</td>
					<td  class='text-center'>{{$v->address_detail}}</td>
					<td  class='text-center'>@if($v->pay_method==1)支付宝 @else 微信@endif</td>
					<td  class='text-center'><a href="{{URL('admin/order/orderdetails').'/'.$v->order_id}}">详情</a></td>
					<td  class='text-center'> 
						@if($v->order_status==1)
						<a href='javascript:;' order_id="{{$v->order_id}}" order_status="{{$v->order_status}}" class="btn btn-danger order_status">新订单</a>
						@elseif($v->order_status==2)
						<a href='javascript:;' order_id="{{$v->order_id}}" order_status="{{$v->order_status}}" class="btn btn-primary order_status">已发货</a>
						@elseif($v->order_status==3)
						<a href='javascript:;' order_id="{{$v->order_id}}" order_status="{{$v->order_status}}" class="btn btn-warning order_status">货已到</a>
						@elseif($v->order_status==4 || $v->order_status==6)
						<a href='javascript:;' order_id="{{$v->order_id}}" order_status="{{$v->order_status}}" class="btn btn-success order_status">已收货</a>
						@elseif($v->order_status==5)
						<a href='javascript:;' order_id="{{$v->order_id}}" order_status="{{$v->order_status}}" class="btn btn-default order_status">已取消</a>
						@elseif($v->order_status==0)
						<a href='javascript:;' order_id="{{$v->order_id}}" order_status="{{$v->order_status}}" class="btn btn-default order_status">未支付</a>
						@endif

						</button>
					</td>

				</tr>
				@endforeach
				<script>
					//点击订单状态传递订单id
					$('.order_status').click(function(){
						order_id=$(this).attr('order_id');
						order_status=$(this).attr('order_status');
						$obj=$(this);
						//alert(order_id);
						if(order_status==1){
							layer.confirm('确认后会变成"已发货"，确定后不可返回',{btn:['确定','取消'],icon: 0, title:'! ! ! 注意'},function(){
								$.get("{{URL('admin/order/order_statuschange')}}",{'order_id':order_id,'order_status':order_status},function(r){
									if(r){
										window.location.reload();

									}
								});
							

							});

						}else if(order_status==2){
							layer.confirm('确认后说明物流已到，客户订单信息显示"确认收货"，确定后不可返回',{btn:['确定','取消'],icon: 0, title:'! ! ! 注意'},function(){
								$.get("{{URL('admin/order/order_statuschange')}}",{'order_id':order_id,'order_status':order_status},function(r){
									if(r){
										window.location.reload();

									}
								});
							

							});
						}



					});
				</script>
				


			</tbody>
		</table>
		<div class="col-md-6 col-md-offset-5">
		{{$res->links()}}
		</div>

	</div>
</div>










@endsection