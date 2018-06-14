@extends('admin.layout.layout')
@section('title1','评论管理')
@section('title2','评论列表')

@section('main')

@if(session('message'))
<script>
	layer.alert("{{session('message')}}");
</script>
	
@endif
<div class="col-xs-12">

	<div class="table-responsive">
		<table id="sample-table-1" class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th  class='text-center'>评论ID</th>
					<th  class='text-center'>商品ID</th>
					<th  class='text-center'>商品名</th>
					<th  class='text-center'">评论用户</th>
					<th  class='text-center'>评论内容</th>
					<th  class='text-center'>评价等级</th>
					<th  class='text-center'>评论时间</th>
					<th  class='text-center'>操作</th>
				</tr>
			</thead>

			<tbody>
				@foreach($res as $v)
				<tr>
					<td  class='text-center'> {{$v->comment_id}}</td>
					<td  class='text-center'>{{$v->goods_id}}</td>					
					<td  class='text-center'>{{$v->goods_name}}}</td>
					<td  class='text-center'>{{$v->username}}</td>
					<td  class='text-center'>{{$v->comment_con}}</td>
					<td  class='text-center'>{{$v->comment_score}}</td>
					<td  class='text-center'>{{$v->comment_date}}</td>
			        <td class='text-center'> <a href="javascrit:;" class="permissiondel" permission_id="">删除</a> | <a href="javascrit:;" class="permissiondel" permission_id="">更改</a>| <a href="javascript:;">回复</a></td>

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

		 </div>

		<div class="row">
		  <div class="col-md-6 col-md-offset-5">		
		 
		  </div>
		</div>

	</div><!-- /.table-responsive -->
</div>

@endsection

