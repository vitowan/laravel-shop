@extends('admin.layout.layout')
@section('title1','产品管理')
@section('title2','添加产品')

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
	<form class="form-horizontal" role="form" action="{{ URL('admin/goods') }}" method='post' enctype='multipart/form-data'>
		{{csrf_field()}}
		<div class="form-group" style="margin-top:20px">
			<label class="col-sm-3 control-label no-padding-right" for="goods_name"> 产品名</label>

			<div class="col-sm-9">
				<input type="text" name='goods_name' id="goods_name" class="col-xs-10 col-sm-5">
			</div>
		</div>
		<div class="form-group" style="">
			<label class="col-sm-3 control-label no-padding-right" for="goods_brand"> 品牌</label>

			<div class="col-sm-9">
				<input type="text" name='goods_brand' id="goods_brand" class="col-xs-10 col-sm-5">
			</div>
		</div>
		<div class="form-group" style="">
			<label class="col-sm-3 control-label no-padding-right" for="goods_price"> 价格</label>

			<div class="col-sm-9">
				<input type="text" name='goods_price' id="goods_price" class="col-xs-10 col-sm-5">
			</div>
		</div>
		<div class="form-group" style="">
			<label class="col-sm-3 control-label no-padding-right" for="goods_sales"> 销量</label>

			<div class="col-sm-9">
				<input type="text" name='goods_sales' id="goods_sales" class="col-xs-10 col-sm-5">
			</div>
		</div>
		<div class="form-group" style="">
			<label class="col-sm-3 control-label no-padding-right" for="goods_inventory"> 库存</label>

			<div class="col-sm-9">
				<input type="text" name='goods_inventory' id="goods_inventory" class="col-xs-10 col-sm-5">
			</div>
		</div>

		<div class="form-group" style="">
			<label class="col-sm-3 control-label no-padding-right" for="goods_inventory"> 产品描述</label>

			<div class="col-sm-9">
				<textarea  id="" cols="30" rows="10" style="height:110px;width:415px;resize:none" name='goods_des'>.....</textarea>
			</div>
		</div>

		<div class="form-group" style="">
			<label class="col-sm-3 control-label no-padding-right" for="goods_status"> 是否上架</label>

			<div class="col-xs-3">
				<label>
					<input name="goods_status" class="ace ace-switch ace-switch-6" type="checkbox" value='1'  checked >
					<span class="lbl"></span>
				</label>
			</div>	
		</div>

		<div class="form-group" style="">
			<label class="col-sm-3 control-label no-padding-right" for="goods_status"> 上传商品图</label>

			<div class="col-xs-3">
				<label>
					<input name="goods_picpid[]" class="ace ace-switch ace-switch-6" type="file" multiple >
					<span class="lbl"></span>
				</label>
			</div>	
		</div>		


		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="cate_name"> 所属分类</label>

			<div class="col-sm-9">
				<select name="" multiple class="col-xs-3 level" id="level1" a='level2' style='height:150px'>
					<option value="" disabled style='background:#f5f5f5'>请先选则一个类别</option>
					@foreach($data as $v)
					<option value="{{$v->id}}">{{'&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;- '.$v->cate_name}}</option>
					@endforeach

				</select>

				<select name="" multiple class="col-xs-3 level" id="level2" a='level3' style='height:150px;display:none'>
					<option value="" style='background:#f5f5f5'>再选我</option>
				</select>

				<select name="goods_pid" multiple class="col-xs-3" id="level3" style='height:150px;display:none'>
					<option value="" style='background:#f5f5f5'>最后选我</option>

				</select>
			</div>
		</div>

		<div class="clearfix form-actions" style="margin-top:50px">
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
	//下拉菜单
$('.level').change(function(){
	
	var next=$(this).attr('a');
	if(next=='level2'){
		//alert(next);
		$('#level2').css('display','inline-block');
		$('#level3').css('display','none');
		$('#level2 option:not(:first)').remove();
		$('#level3 option:not(:first)').remove();			
	}else if(next=='level3'){
		$('#level3 option:not(:first)').remove();
		$('#level3').css('display','inline-block');
	}
	//alert(1);

	var id=$(this).val();
	$.post("{{URL('admin/goodselect/createselect')}}",{'id':id,'_token':"{{csrf_token()}}"},function(r){
		var optionhtml='';
		console.log(r);
		$.each(r,function(k,v){
			//alert(v.cate_name);
			optionhtml+='<option value="' + v.id +'">' +"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;---" +v.cate_name+ "</option>";
			//optionhtml += '<option value="'+ v.id +'">'+v.cate_name+'</option>';
		});
		$('#'+next).append(optionhtml);


	});
});



</script>



@endsection