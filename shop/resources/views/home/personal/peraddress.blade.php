@extends('home.layout.layoutPer')
@section('personal')	

<div class="pull-right">
	<div class="user-content__box clearfix bgf">
		<div class="title">账户信息-收货地址</div>
		<form action="{{URL('home/personal/addaddress')}}" class="user-addr__form form-horizontal" role="form" method='post'>
			{{csrf_field()}}
			<p class="fz18 cr">新增收货地址<span class="c6" style="margin-left: 20px"></span></p>
			<div class="form-group">
				<label for="name" class="col-sm-2 control-label">收货人姓名：</label>
				<div class="col-sm-6">
					<input class="form-control" id="name" name="receiver_name" placeholder="请输入姓名" type="text">
				</div>
			</div>
			<div class="form-group">
				<label for="details" class="col-sm-2 control-label">收货地址：</label>
				<div class="col-sm-10">
					<div class="addr-linkage">
						<select name="province" id="province" class='sltarea' data-next='city'>
							<option value="">请选择</option>
							@foreach($province as $v)
							<option value="{{$v->district_id}}">{{$v->district}}</option>
							@endforeach
						</select>

						<select name="city" id="city" class='sltarea' data-next='area'>
							<option value="">请选择</option>
						</select>
							
						<select name="area" id="area">
							<option value="">请选择</option>
						</select>
					</div>
					<input class="form-control" id="details" name='details' placeholder="建议您如实填写详细收货地址，例如街道名称，门牌号码等信息" maxlength="30" type="text">
				</div>
			</div>

			<div class="form-group">
				<label for="mobile" class="col-sm-2 control-label">手机号码：</label>
				<div class="col-sm-6">
					<input class="form-control" id="mobile" name="receiver_tel" placeholder="请输入手机号码" type="text">
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-6">
					<div class="checkbox">
						<label><input type="checkbox" name='address_default' value='1'><i></i> 设为默认收货地址</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-6">
					<button type="submit" class="but">保存</button>
				</div>
			</div>

			<script>
				//关于地区城市的下拉框
				$('.sltarea').change(function(){
					

					var next=$(this).attr('data-next');
					if(next=='city'){
						$('#city option:not(:first)').remove();
						$('#area option:not(:first)').remove();		
					}else if(next=='area'){
						$('#area option:not(:first)').remove();
					}
					$id=$(this).val();
					if(!$id){
						return false;
					}

					$.post(
						"{{URL('home/personal/ajaxgetarea')}}",
						{'pid':$id,'_token':"{{csrf_token()}}"},
						function(r){
							//alert(r);
							//alert(r);
							var optionhtml='';
							//var arr=$.parseJSON(r);
							//var arr=JSON.parse(r);
							//var arr = eval('(' + r + ')');
							$.each(r,function(k,v){
								//alert(v.district);
								optionhtml += '<option value="'+ v.district_id +'">'+v.district+'</option>';
							});
							$('#'+next).append(optionhtml);
						}

					);


				});

			</script>


		</form>
		<p class="fz18 cr">已保存的有效地址</p>

		<div class="table-thead addr-thead">
			<div class="tdf1">收货人</div>
			<div class="tdf1">地址</div>
			<div class="tdf1">手机</div>
			<div class="tdf1">操作</div>
			<div class="tdf1"></div>
		</div>
<!-- 		<div class="addr-list">
	<div class="addr-item">
		<div class="tdf1">喵喵喵</div>
		<div class="tdf2 tdt-a_l">福建省 福州市 晋安区</div>
		<div class="tdf3 tdt-a_l">浦下村74号</div>
		<div class="tdf1">350111</div>
		<div class="tdf1">153****7649</div>
		<div class="tdf1 order">
			<a href="udai_address_edit.html">修改</a><a href="">删除</a>
		</div>
		<div class="tdf1">
			<a href="" class="default active">默认地址</a>
		</div>
	</div> -->

			@foreach($result as $v)
			<div class="addr-item">
				<div class="tdf1">{{$v->receiver_name}}</div>
				<div class="tdf1">{{$v->address_detail}}</div>
				<div class="tdf1">{{$v->receiver_tel}}</div>
				<div class="tdf1 order">
					<a href="{{URL('home/personal/addressupdate').'/'.$v->address_id}}">修改</a><a href="javascript:;" address_id="{{$v->address_id}}" class='addressdel'>删除</a>
				</div>
				<div class="tdf1">
					@if($v->address_default==1)
					<a href="javascript:;" class="default active">默认地址</a>
					@else
					<a href="javascript:;" class="default addr_default" address_id="{{$v->address_id}}">设为默认</a>
					@endif
					
				</div>
			</div>
			@endforeach
			<script>
				//设置默认地址
				$('.addr_default').click(function(){
					//alert(1);
					address_id=$(this).attr('address_id');
					$.get("{{URL('home/personal/addr_default')}}",{'address_id':address_id},function(r){
						//alert(r);
						if(r){

							window.location.reload();
						}
					});
				});
			</script>
			<script>
				$('.addressdel').click(function(){
					address_id=$(this).attr('address_id');
					obj=$(this);
					//alert(address_id);
					layer.confirm('确定要删除吗',{btn:['确定','取消']},function(index){
						$.get("{{URL('home/personal/addressdel')}}",{'address_id':address_id},function(r){
							//alert(r);
							if(r==1){
								obj.parent().parent().css('display','none');
							}else{
								layer.msg('发生了错误',{time:2000})
							}
						});
						layer.close(index);
					});
					

				});
			</script>
			

		</div>
	</div>
</div>

@endsection