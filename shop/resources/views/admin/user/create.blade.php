@extends('admin.layout.layout')
@section('title1','用户管理')
@section('title2','添加用户')

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
	<form class="form-horizontal" role="form" action="{{ URL('admin/user') }}" method='post' enctype='multipart/form-data'>
		{{csrf_field()}}
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="username"> 用户名 </label>

			<div class="col-sm-9">
				<input type="text" name='username' id="username" class="col-xs-10 col-sm-5">
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="password"> 密&nbsp;&nbsp;&nbsp;&nbsp;码 </label>
			<div class="col-sm-9">
				<input type="password" name='password' id="password"  class="col-xs-10 col-sm-5">
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right"> 性&nbsp;&nbsp;&nbsp;&nbsp;别 </label>
			<div class="col-sm-9">
				<label class="radio-inline">
				  <input type="radio" name="sex" checked value="1"> 男
				</label>
				&nbsp;&nbsp;&nbsp;
				<label class="radio-inline">
				  <input type="radio" name="sex" value="0"> 女
				</label>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="phone"> 电&nbsp;&nbsp;&nbsp;&nbsp;话 </label>

			<div class="col-sm-9">
				<input type="text" name='phone' id="phone" class="col-xs-10 col-sm-5">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="email"> 邮&nbsp;&nbsp;&nbsp;&nbsp;箱 </label>

			<div class="col-sm-9">
				<input type="email" name='email' id="email" class="col-xs-10 col-sm-5">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="group_id"> 所属组 </label>

			<div class="col-sm-9">
				<select name="role_id" id="group_id" class="col-xs-10 col-sm-5">
					@foreach($role as $v)
					<option value="{{$v->role_id}}">{{$v->role_name}}</option>
					@endforeach

				</select>
			</div>
		</div>		
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="status"> 状&nbsp;&nbsp;&nbsp;&nbsp;态 </label>

			<div class="col-sm-9">
				<label class="radio-inline">
				  <input type="radio" name="status" checked value="1"> 开启
				</label>
				&nbsp;&nbsp;&nbsp;
				<label class="radio-inline">
				  <input type="radio" name="status" value="0"> 禁用
				</label>
			</div>
		</div>		
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 头&nbsp;&nbsp;&nbsp;&nbsp;像 </label>

			<div class="row">
		    	<div class="col-sm-5 col-md-2" >
		        	 <div class="thumbnail" >
		           		 <img id='img_upload' style="width:150px;height:140px" src="{{URL('').'/uploads/upload.jpg'}}" 
		             alt="个人头像">
		           		 <div class="caption">
			                <p>
			                	<input type="file" id='file' name='pic' style='display:none'>
			                    <a href="javascript:;" id='btn_up' class="btn btn-primary" role="button" style='display:block'>
			                        上传
			                    </a> 
			                    <a href="javascript:;" id='btn_change' class="btn btn-default" role="button" style='display:none'>
			                        更改
			                    </a>
			                </p>
			             </div>   
		            </div>
		         </div>
		    </div>
		</div>


		<div class="clearfix form-actions">
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
$('#btn_up').click(function(){
	$('#file').trigger('click');
});
$('#btn_change').click(function(){
	$('#file').trigger('click');
});

//选择图片后ajax传输图片资源
$('#file').change(function(){
	$('#btn_up').css('display','none');
	$('#btn_change').css('display','block');
	var fileobj = $('#file').get(0).files[0];
	var maxSize = 1048576; 
	//console.log(fileobj);
	//正则判断类型
	if(!/image\/\w+/.test(fileobj.type)){
		alert('文件必须是图片！');
		return false;
	}else if(fileobj.size>=maxSize){
		alert('图片大小不能超过1M！');
		return false;
	}
	var formData = new FormData();
	formData.append('file_data',fileobj);//对象里插入要传的文件
	formData.append('_token',"{{csrf_token()}}");//对象里插入要传的文件
	//$.post();
	$.ajax({
		url:"{{URL('admin/userthumb/user_thumb')}}",
		type:'POST',
		data:formData, //传值
		async: false,
		cache: false,
		contentType: false, 
		processData: false, 
		success:function(r){
			//alert(r);
			//document.write(r);
			//document.write({{URL('')}});
			$('#img_upload').attr('src',"{{URL('')}}"+r);//更换显示的缩略图
		}
	});	
});



</script>



@endsection