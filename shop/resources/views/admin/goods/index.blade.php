@extends('admin.layout.layout')
@section('title1','产品管理')
@section('title2','产品列表')

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
		<a class="btn btn-primary" href="{{URL('admin/goods/create')}}" role="button" style='display:inline-block;margin-left:100px'>添加产品</a>

		<table id="sample-table-1" class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th  class='text-center'>ID</th>
					<th  class='text-center'>产品名</th>
					<th  class='text-center'>品牌名</th>
					<th  class='text-center '>价格</th>
					<th  class='text-center'>销量</th>
					<th  class='text-center'>库存</th>
					<th  class='text-center'>产品描述</th>
					<th  class='text-center'>所属分类</th>
					<th  class='text-center'>是否上架</th>
					<th  class='text-center'>主图</th>
					<th  class='text-center col-xs-2'>
						<i class="icon-time bigger-110 hidden-480"></i>
						更新时间
					</th>
					<th class="hidden-480 text-center">操作</th>
				</tr>
			</thead>

			<tbody>
				@foreach($result as $v)
				<tr>
					<td  class='text-center'>{{$v->goods_id}}</td>
					<td  class='text-center'>{{$v->goods_name}}</td>
					<td  class='text-center'>{{$v->goods_brand}}</td>
					<td  class='text-center'>{{$v->goods_price}}</td>
					<td  class='text-center'>{{$v->goods_sales}}</td>
					<td  class='text-center'>{{$v->goods_inventory}}</td>
					<td  class='text-center'>{{$v->goods_des}}</td>
					<td  >{{$v->catename}}</td>
					<td  class='text-center'>@if($v->goods_status==1) 上架 @else 下架  @endif</td>
					<td  class='text-center'><img src="{{$v->goods_photo}}" alt="" width='80px'></td>
					<td  class='text-center'>{{$v->goods_date}}</td>
					<td class='text-center'>
						<a href="javascript:;" onclick=fun({{$v->goods_id}})>删除</a> | 
						<a href="{{URL('admin/goods').'/'.$v->goods_id.'/edit'}}">更新</a> | 
						<a href="{{URL('admin/goodsintro/goods_intro').'/'.$v->goods_id}}">产品介绍</a> | 
						<a href="{{URL('admin/goodspic/goods_picmana').'/'.$v->goods_id}}">图片管理</a>
					</td>
				</tr>
				@endforeach


			</tbody>
		</table>
		<div class="col-md-6 col-md-offset-5">
		{{$result->links()}}
		</div>
		<div class="col-md-6 col-md-offset-5">

		</div>

		<div class="row">
		  <div class="col-md-6 col-md-offset-5">		

		  </div>
		</div>

	</div><!-- /.table-responsive -->
</div>
<script>
	function fun(id){
		$.post("{{URL('admin/goods')}}"+'/'+id,{'_token':"{{csrf_token()}}",'_method':'delete'},function(r){
			//console.log(r);
			if(r){
				alert('删除成功');
				window.location.reload();
			}else{
				alert('删除失败');
				window.location.reload();				
			}

		});
	}
</script>
@endsection

