@extends('admin.layout.layout')
@section('title1','分类管理')
@section('title2','添加分类')

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
	<form class="form-horizontal" role="form" action="{{ URL('admin/cate') }}" method='post' enctype='multipart/form-data'>
		{{csrf_field()}}
		<div class="form-group" style="margin-top:50px">
			<label class="col-sm-3 control-label no-padding-right" for="cate_name"> 分类名</label>

			<div class="col-sm-9">
				<input type="text" name='cate_name' id="cate_name" class="col-xs-10 col-sm-5">
			</div>
		</div>


		<div class="form-group" style="margin-top:50px">
			<label class="col-sm-3 control-label no-padding-right" for="group_id"> 所属组 </label>

			<div class="col-sm-9">
				<select name="cate_pid" id="group_id" class="col-xs-10 col-sm-5">
					<option value="0">顶级分类</option>
					@foreach($result as $v)
					<option value="{{$v->id}}">{{$v->cate_strname}}</option>
					@endforeach
				</select>
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