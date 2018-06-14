@extends('admin.layout.layout')
@section('title1','用户管理')
@section('title2','用户列表')

@section('main')

@if(session('message'))
<script>
	layer.alert("{{session('message')}}");
</script>
	
@endif
<div class="col-xs-12">

	<div class="table-responsive">

<form action={{URL('admin/user')}} method='get' class="form-inline" style="margin-bottom:5px;display:inline-block;">
  <div class="form-group">
    <input type="text" class="form-control" name='search' value="{{$search}}" placeholder="请输入用户名查询" style='height:42px;width:200px'>
  </div>
  <button type="submit" class="btn btn-default">搜索</button>
</form>
<a class="btn btn-primary" href="{{URL('admin/user/create')}}" role="button" style='display:inline-block;margin-left:100px'>添加用户</a>
		<table id="sample-table-1" class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th  class='text-center'>ID</th>
					<th  class='text-center'>用户名</th>
					<th  class='text-center'">密码</th>
					<th  class='text-center'>性别</th>
					<th  class='text-center'>手机</th>
					<th  class='text-center'>邮箱</th>
					<th  class='text-center'>头像</th>
					<th  class='text-center'>状态</th>
					<th  class='text-center'>所属组</th>
					<th  class='text-center'>
						<i class="icon-time bigger-110 hidden-480"></i>
						更新时间
					</th>
					<th class="hidden-480">操作</th>
				</tr>
			</thead>

			<tbody>
				@foreach($result as $v)
				<tr>
					<td  class='text-center'>{{$v->id}}</td>
					<td  class='text-center'>{{$v->username}}</td>					
					<td  class='text-center'>{{$v->password}}</td>
			        <td class='text-center'> @if($v->sex == 1) 男 @else 女 @endif</td>
					<td  class='text-center'>{{$v->phone}}</td>
					<td  class='text-center'>{{$v->email}}</td>
					<td  class='text-center'><img src="{{URL('').$v->pic}}" width='60px' height='60px' alt=""></td>
					<td  class='text-center'> @if($v->status == 1) 开启 @else 禁用 @endif </td>
					<td  class='text-center'>{{$v->group_id}}</td>
					<td  class='text-center'>{{$v->date}}</td>
					<td class='text-center'>
						<a href="javascript:;" onclick=fun({{$v->id}})><i class="icon-trash bigger-120"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
						<a href="{{URL('admin/user/').'/'.$v->id.'/edit'}}"><i class="icon-edit bigger-120"></i></a>
					</td>
				</tr>
				@endforeach

			</tbody>
		</table>

		<div class="row">
		  <div class="col-md-6 col-md-offset-5">		
		  	{{$result->appends(['search'=>$request->search])->links()}}
		  </div>
		</div>

	</div><!-- /.table-responsive -->
</div>
<script>
	function fun(id){
		$.post("{{URL('admin/user')}}"+'/'+id,{'_token':"{{csrf_token()}}",'_method':'delete'},function(r){
              if(r==1){
                    alert('删除成功！');
                    window.location.reload();
              }else{
                  alert('删除失败！');
                  window.location.reload();
              }			
		});
	}
</script>
@endsection

