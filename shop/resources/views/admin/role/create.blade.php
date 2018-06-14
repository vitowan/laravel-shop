@extends('admin.layout.layout')
@section('title1','角色管理')
@section('title2','添加角色')

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
	<form class="form-horizontal" role="form" action="{{ URL('admin/role') }}" method='post'>
		{{csrf_field()}}
		<div class="form-group" style="margin-top:50px">
			<label class="col-sm-3 control-label no-padding-right" for="role_name"> 角色名</label>

			<div class="col-sm-9">
				<input type="text" name='role_name' id="role_name" class="col-xs-10 col-sm-5">
			</div>
		</div>

		<div class="form-group" style="margin-top:30px">

			
			<div class="col-md-offset-1">
				@foreach($res as $v)
				<label class="checkbox-inline" style="margin-right:5px">
				  {{$v->permission_name}}<input type="checkbox" value="{{$v->permission_id}}" name="permission_id[]">
				</label>
			    @endforeach
			</div>
			
		</div>

		<div class="clearfix form-actions" style="margin-top:100px">
			<div class="col-md-offset-4 col-md-9">
				<button class="btn btn-info" type="submit">
					<i class="icon-ok bigger-110"></i>
					添加
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