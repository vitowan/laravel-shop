@extends('admin.layout.layout')
@section('title1','订单管理')
@section('title2','订单详情')
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
					<th  class='text-center'>商品ID</th>
					<th  class='text-center '>商品名</th>
					<th  class='text-center'>数量</th>
					<th  class='text-center'>单价</th>
					<th  class='text-center'>优惠</th>
					<th  class='text-center'>总价</th>
					<th  class='text-center'>运费</th>
					<th  class='text-center'>评论信息</th>

				</tr>
			</thead>

			<tbody>
				@foreach($res as $v)
				<tr>
					<td  class='text-center'>{{$v->goods_id}}</td>
					<td  class='text-center'>{{$v->goods_name}} <br><span>颜色分类：深棕色  尺码：均码</span></td>
					<td  class='text-center'>{{$v->goods_num}}</td>
					<td  class='text-center'>
						￥ {{number_format($v->goods_price)}}</td>
					<td  class='text-center'>无</td>
					<td  class='text-center'>￥ {{number_format($v->order_subtotal)}}</td>
					<td  class='text-center'>无</td>
					<td  class='text-center'>评论信息(1)</td>
				</tr>	
				@endforeach
				<tr>
					<td colspan='5'></td>
					<td>总计：￥ {{$result->order_total}}</td>
					<td colspan='2'></td>

				</tr>


			</tbody>
		</table>
		<div class="col-md-6 col-md-offset-5">
		</div>

	</div>
</div>

@endsection