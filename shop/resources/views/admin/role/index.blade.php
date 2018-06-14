@extends('admin.layout.layout')
@section('title1','角色管理')
@section('title2','角色列表')

@section('main')

@if(session('message'))
<script>
	layer.alert("{{session('message')}}");
</script>
	
@endif
<div class="col-xs-12">

	<div class="table-responsive">

<a class="btn btn-primary" href="{{URL('admin/role/create')}}" role="button" style='margin-bottom: 5px'>添加角色</a>
		<table id="sample-table-1" class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th  class='text-center'>ID</th>
					<th  class='text-center'>角色名</th>
					<th  class='text-center'>操作</th>
				</tr>
			</thead>

			<tbody>
				@foreach($result as $v)
				<tr>
					<td  class='text-center'>{{$v->role_id}}</td>
					<td  class='text-center'>{{$v->role_name}}</td>					
			        <td class='text-center'> <a href="javascript:;" class='roledel' role_id="{{$v->role_id}}">删除</a> | <a href="{{URL('admin/role').'/'.$v->role_id.'/edit'}}">更改</a> | <a href="{{URL('admin/roles/perm_assign').'/'.$v->role_id}}">权限分配</a></td>

				</tr>
				@endforeach
				<script>
					//删除角色
					$('.roledel').click(function(){
						role_id=$(this).attr('role_id');
						obj=$(this);
						layer.confirm('确定删除吗？',{btn:['确定','取消']},function(index){
							$.post("{{URL('admin/role')}}"+'/'+role_id,{'_token':"{{csrf_token()}}",'_method':'delete'},function(r){
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
		  	{{$result->links()}}
		 </div>

		<div class="row">
		  <div class="col-md-6 col-md-offset-5">		
		 
		  </div>
		</div>

	</div><!-- /.table-responsive -->
</div>

@endsection

