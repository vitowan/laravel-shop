@extends('admin.layout.layout')
@section('title1','分类管理')
@section('title2','分类列表')

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
		    <input type="text" class="form-control" value="{{$search}}" name='search' placeholder="请输入用户名查询" style='height:42px;width:200px'>
		  </div>
		  <button type="submit" class="btn btn-default">搜索</button>
		</form>
		<a class="btn btn-primary" href="{{URL('admin/cate/create')}}" role="button" style='display:inline-block;margin-left:100px'>添加商品分类</a>

		<table id="sample-table-1" class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th  class='text-center'>ID</th>
					<th  class='text-center col-xs-4'>类别名</th>
					<th  class='text-center'">父级pid</th>
					<th  class='text-center col-xs-2'>
						<i class="icon-time bigger-110 hidden-480"></i>
						更新时间
					</th>
					<th class="hidden-480 text-center">操作</th>
				</tr>
			</thead>

			<tbody>
				@foreach($items as $v)
				<tr>
					<td  class='text-center'>{{$v->id}}</td>
					<td  style="padding-left:150px;">{{$v->cate_strname}}</td>					
					<td  class='text-center'>{{$v->cate_pid}}</td>
					<td  class='text-center'>{{$v->cate_date}}</td>
					<td class='text-center'>
						<a href="javascript:;" onclick=fun({{$v->id}})><i class="icon-trash bigger-120"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
						<a href="{{URL('admin/cate').'/'.$v->id.'/edit'}}"><i class="icon-edit bigger-120"></i></a>
					</td>
				</tr>
				@endforeach


			</tbody>
		</table>
		<div class="col-md-6 col-md-offset-5">
		{{$html}}
		</div>

		<div class="row">
		  <div class="col-md-6 col-md-offset-5">		

		  </div>
		</div>

	</div><!-- /.table-responsive -->
</div>
<script>
	function fun(id){
		$.post("{{URL('admin/cate')}}"+'/'+id,{'_token':"{{csrf_token()}}",'_method':'delete'},function(r){
			//console.log(r);
              if(r==1){
                    alert('删除成功！');
                    window.location.reload();
              }else if(r==0){
                  alert('此类别有子分类，如需删除，请先删除其子分类！');
              }else{
                  alert('删除失败！');         	
              }			
		});
	}
</script>
@endsection

