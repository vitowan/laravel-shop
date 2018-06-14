@extends('admin.layout.layout')
@section('title1','权限管理')
@section('title2','权限列表')

@section('main')

@if(session('message'))
<script>
	layer.alert("{{session('message')}}");
</script>
	
@endif
<div class="col-xs-12">

	<div class="table-responsive">

<form action={{URL('admin/permission')}} method='get' class="form-inline" style="margin-bottom:5px;display:inline-block;">
  <div class="form-group">
    <input type="text" class="form-control" name='search' value="" placeholder="请输入权限名查询" style='height:42px;width:200px'>
  </div>
  <button type="submit" class="btn btn-default">搜索</button>
</form>
<a class="btn btn-primary" href="{{URL('admin/permission/create')}}" role="button" style='display:inline-block;margin-left:100px'>添加权限</a>
		<table id="sample-table-1" class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th  class='text-center'>ID</th>
					<th  class='text-center'>权限</th>
					<th  class='text-center'">路由方法</th>
					<th  class='text-center'>操作</th>
				</tr>
			</thead>

			<tbody>
				@foreach($result as $v)
				<tr>
					<td  class='text-center'>{{$v->permission_id}}</td>
					<td  class='text-center'>{{$v->permission_name}}</td>					
					<td  class='text-center'>{{$v->action}}</td>
			        <td class='text-center'> <a href="javascrit:;" class="permissiondel" permission_id="{{$v->permission_id}}">删除</a> | <a href="{{URL('admin/permission').'/'.$v->permission_id.'/edit'}}">更改</a></td>

				</tr>
				@endforeach
				<script>
					$('.permissiondel').click(function(){
						permission_id=$(this).attr('permission_id');
						obj=$(this);
						layer.confirm('确定删除吗？',{btn:['确定','取消']},function(index){
							$.post("{{URL('admin/permission')}}"+'/'+permission_id,{'_token':"{{csrf_token()}}",'_method':'delete'},function(r){
								if(r==1){
									obj.parent().parent().css('display','none');
								}else{
									layer.alert('删除失败');
								}
		
							});	
							layer.close(index);						
						});

					});						
				</script>
			
			

			</tbody>
		</table>
		<div class="col-md-6 col-md-offset-5">		
		  	{{$result->appends(['search'=>$request->search])->links()}}
		 </div>

		<div class="row">
		  <div class="col-md-6 col-md-offset-5">		
		 
		  </div>
		</div>

	</div><!-- /.table-responsive -->
</div>

@endsection

