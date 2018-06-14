@extends('admin.layout.layout')
@section('title1','权限管理')
@section('title2','更改')

@section('main')
<div class='col-xs-12'>
	@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('message'))
<script>
	layer.alert("{{session('message')}}");
</script>
	
@endif
	<form class="form-horizontal" role="form" action="{{ URL('admin/permission').'/'.$res->permission_id }}" method='post'>
		{{csrf_field()}}
		<input type="hidden" name="_method" value="put">
		<div class="form-group" style="margin-top:50px">
			<label class="col-sm-3 control-label no-padding-right" for="permission_name"> 权限名</label>

			<div class="col-sm-9">
				<input type="text" name='permission_name' id="permission_name" value="{{$res->permission_name}}" class="col-xs-10 col-sm-5">
			</div>
		</div>

		<div class="form-group" style="margin-top:50px">
			<label class="col-sm-3 control-label no-padding-right" for="action"> 路由方法</label>

			<div class="col-sm-9">
				<input type="text" name='action' id="action" value="{{$res->action}}" class="col-xs-10 col-sm-5">
			</div>
		</div>

		<div class="form-group" style="margin-top:30px">

			
			<div class="col-md-offset-3">
				@foreach($role as $v)
				<label class="checkbox-inline" style="margin-right:5px">
				  {{$v->role_name}}<input type="checkbox" name="role_id[]" value="{{$v->role_id}}" {{isset($v->checked)? 'checked':""}} >
				</label>
			    @endforeach
			</div>
			
		</div>

		<div class="clearfix form-actions" style="margin-top:100px">
			<div class="col-md-offset-4 col-md-9">
				<button class="btn btn-info" type="submit">
					<i class="icon-ok bigger-110"></i>
					更改
				</button>

				&nbsp; &nbsp; &nbsp; &nbsp;
				<button class="btn" type="reset">
					<i class="icon-undo bigger-110"></i>
					重置
				</button>
			</div>
		</div>
	</form>
</div>

<script>
//上传图片



</script>



@endsection