@extends('admin.layout.layout')
@section('title1','产品管理')
@section('title2','产品列表 - 产品更新')

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
	<form class="form-horizontal" role="form" action="{{ URL('admin/goods').'/'.$result->goods_id }}" method='post' enctype='multipart/form-data'>
		{{csrf_field()}}
		<input type="hidden" name="_method" value='put'>
		<div class="form-group" style="margin-top:20px">
			<label class="col-sm-3 control-label no-padding-right" for="goods_name"> 产品名</label>

			<div class="col-sm-9">
				<input type="text" name='goods_name' value="{{$result->goods_name}}" id="goods_name" class="col-xs-10 col-sm-5">
			</div>
		</div>
		<div class="form-group" style="">
			<label class="col-sm-3 control-label no-padding-right" for="goods_brand"> 品牌</label>

			<div class="col-sm-9">
				<input type="text" name='goods_brand' value="{{$result->goods_brand}}" id="goods_brand" class="col-xs-10 col-sm-5">
			</div>
		</div>
		<div class="form-group" style="">
			<label class="col-sm-3 control-label no-padding-right" for="goods_price"> 价格</label>

			<div class="col-sm-9">
				<input type="text" name='goods_price' value="{{$result->goods_price}}" id="goods_price" class="col-xs-10 col-sm-5">
			</div>
		</div>
		<div class="form-group" style="">
			<label class="col-sm-3 control-label no-padding-right" for="goods_sales"> 销量</label>

			<div class="col-sm-9">
				<input type="text" name='goods_sales' value="{{$result->goods_sales}}" id="goods_sales" class="col-xs-10 col-sm-5">
			</div>
		</div>
		<div class="form-group" style="">
			<label class="col-sm-3 control-label no-padding-right" for="goods_inventory"> 库存</label>

			<div class="col-sm-9">
				<input type="text" name='goods_inventory' value="{{$result->goods_inventory}}" id="goods_inventory" class="col-xs-10 col-sm-5">
			</div>
		</div>
		<div class="form-group" style="">
			<label class="col-sm-3 control-label no-padding-right" for="goods_status"> 是否上架</label>

			<div class="col-xs-3">
			<div class="col-sm-9">
				<label class="radio-inline">
				  <input type="radio" name="goods_status" @if($result->goods_status==1) checked @else @endif value="1"> 上架
				</label>
				&nbsp;&nbsp;&nbsp;
				<label class="radio-inline">
				  <input type="radio" name="goods_status"  @if($result->goods_status==0) checked @else @endif value="0"> 下架
				</label>
			</div>

			</div>	
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="cate_name"> 所属分类</label>

			<div class="col-sm-9">

				<select name="" multiple class="col-xs-3 level" id="level1" a='level2' style='height:150px'>
					<option value="" disabled style='background:#f5f5f5'>请先选则一个类别</option>
					@foreach($data as $v)
					<option value="{{$v->id}}" @if($result3->id==$v->id) selected @else @endif>{{'&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;- '.$v->cate_name}}</option>
					@endforeach
				</select>

				<select name="" multiple class="col-xs-3 level" id="level2" a='level3' style='height:150px'>
					<option value="" style='background:#f5f5f5'>再选我</option>
					<option value="{{$result2->id}}" selected style='background:#f5f5f5'>{{$result2->cate_name}}</option>
				</select>

				<select name="goods_pid" multiple class="col-xs-3" id="level3" style='height:150px'>
					<option value="" style='background:#f5f5f5'>最后选我</option>
					<option value="{{$result1->id}}" selected style='background:#f5f5f5'>{{$result1->cate_name}}</option>
				</select>

			</div>
		</div>
		<script>
/*			$("#level1 option[value={$result3->id}]").attr('selected',true);
			$("#level2 option[value={$result2->id}]").attr('selected',true);
		  	$("#level3 option[value={$result1->id}]").attr('selected',true);*/
		</script>
	

		<div class="clearfix form-actions" style="margin-top:50px">
			<div class="col-md-offset-4 col-md-9">
				<button class="btn btn-info" type="submit">
					<i class="icon-ok bigger-110"></i>
					确认更改
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