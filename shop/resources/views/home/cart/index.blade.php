@extends('home.layout.layout')
@section('main')

	<!-- 顶部标题 -->
	<div class="bgf5 clearfix">
		<div class="top-user">
			<div class="inner">
				<a class="logo" href="{{URL('home/home/index')}}"><img src="{{URL('home/images/icons/logo.jpg')}}" alt="U袋网" class="cover"></a>
				<div class="title">购物车</div>
			</div>
		</div>
	</div>
	<div class="content clearfix bgf5">
		<section class="user-center inner clearfix">
			<div class="user-content__box clearfix bgf">
				<div class="title">购物车</div>
				<form action="{{URL('home/order/doorder')}}" method='post' id="cartformdel" class="shopcart-form__box">
					{{csrf_field()}}
					<table class="table table-bordered">
						<thead>
							<tr>
								<th width="150">
									<label class="checked-label"><!-- <input type="checkbox" class="check-all cart_checkedall"><i></i> 全选 --></label>
								</th>
								<th width="300">商品信息</th>
								<th width="150">单价</th>
								<th width="200">数量</th>
								<th width="200">现价</th>
								<th width="200">添加时间</th>
								<th width="80">操作</th>
							</tr>
						</thead>
						<tbody>
							@foreach($res as $v)
							<tr>
								<th scope="row">
									<label class="checked-label "><input cart_id="{{$v->cart_id}}" class="cart_checked"  name="{{$v->cart_id}}" value='1'  type="checkbox" @if($v->cart_checked==1) checked @endif ><i></i>
										<div class="img"><img src="{{URL('').$v->goods_photo}}" alt="" class="cover"></div>
									</label>
								</th>
								<td>
									<div class="name ep3">{{$v->goods_name}}</div>
									<div class="type c9">颜色分类：深棕色  尺码：均码</div>
								</td>
								<td>¥ {{number_format($v->goods_price,2)}}</td>
								<td>
									<div class="cart-num__box">
										<input type="button" class="sub" cart_id="{{$v->cart_id}}" value="-">
										<input type="text" class="val" value="{{$v->goods_num}}" maxlength="2">
										<input type="button" class="add" cart_id="{{$v->cart_id}}" value="+">
									</div>
								</td>
								<td class='total'>¥ {{number_format($v->cart_subtotal,2)}}</td>
								<td>{{$v->cart_savedate}}</td>
								<td><a href="javacript:;" cart_id="{{$v->cart_id}}" class='cartdel'>删除</a></td>
							</tr>
							@endforeach

						</tbody>
					</table>
					<div class="user-form-group tags-box shopcart-submit pull-right">
						<button type="submit" class="btn" id="btnsub">提交订单</button>
					</div>
					<div class="checkbox shopcart-total">
						<label><input type="button" class="check-all cart_checkedall btn btn-default" value="全选/全不选"><i></i> </label>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" id='cart_del'>删除</a>
						<div class="pull-right">
							已选商品 <span>{{$n}}</span> 件
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;合计（不含运费）
							<b class="cr">¥ <span class="fz24" id='total'>{{$total}}</span></b>
						</div>
					</div>
					<script>
						$(document).ready(function(){

				/*			var $item_checkboxs = $('.shopcart-form__box tbody input[type="checkbox"]'),
								$check_all = $('.check-all');
							// 全选
							$check_all.on('change', function() {
								$check_all.prop('checked', $(this).prop('checked'));
								$item_checkboxs.prop('checked', $(this).prop('checked'));
							});
							// 点击选择
							$item_checkboxs.on('change', function() {
								var flag = true;
								$item_checkboxs.each(function() {
									if (!$(this).prop('checked')) { flag = false }
								});
								$check_all.prop('checked', flag);
							});*/
							// 个数限制输入数字
							$('input.val').onlyReg({reg: /[^0-9.]/g});
							// 加减个数
							$('.cart-num__box').on('click', '.sub,.add', function() {
								var value = parseInt($(this).siblings('.val').val());
								if ($(this).hasClass('add')) {
									$(this).siblings('.val').val(Math.min((value += 1),99));
								} else {
									$(this).siblings('.val').val(Math.max((value -= 1),1));
								}
							});
						});
					</script>

					<script>
						//点击加号时，让金额发生变化
						$('.add').on('click',function(){
							//获得当前的cart_id
							obj=$(this);
							cart_id=$(this).attr('cart_id');
							//post传当前的id
							$.post("{{URL('home/cart/cartup')}}",{'cart_id':cart_id,"_token":"{{csrf_token()}}"},function(r){
									if(r!=0){
										//console.log(r);
										$('#total').html(r['total']);

										obj.parent().parent().siblings('.total').html('￥'+r['cart_subtotal']);

									}
									
							});

						});
						//点击减号时
						$('.sub').on('click',function(){
							obj=$(this);
							cart_id=$(this).attr('cart_id');
							//post传当前的id
							$.post("{{URL('home/cart/cartdown')}}",{'cart_id':cart_id,"_token":"{{csrf_token()}}"},function(r){
									if(r!=0){
										//console.log(r);
										$('#total').html(r['total']);
										obj.parent().parent().siblings('.total').html('￥'+r['cart_subtotal']);
										obj.siblings('val').val(r['goods_num']);
									}
									
							});
						})

						//点击删除的时候
						$('.cartdel').click(function(){
							cart_id=$(this).attr('cart_id');
							layer.confirm('确定要删除吗？',{btn:['残忍删除','先留着']},function(){
								
								$.post("{{URL('home/cart/cartdel')}}",{'cart_id':cart_id,"_token":"{{csrf_token()}}"},function(r){
										//alert(r);
										if(r!=0){
											//alert(r);
											$('#total').html('￥ '+r);
											layer.msg('删除成功',{time:2000});
											window.location.reload();
										}else{
											layer.msg('删除失败',{time:2000});
										}
										
								});									
							});
						
						});


					</script>
				</form>
				<script>
					//通过全选按钮附近点删除的时候
					$('#cart_del').click(function(){
						//点击删除，让提交地址发生改变后，再提交
						$('#cartformdel').attr('action',"{{URL('home/cart/cartlistdel')}}");
						$('#cartformdel').submit();
					});

				</script>

				<script>
					//单个复选框选中时
					$('.cart_checked').change(function(){
						//获得当前id
						cart_id=$(this).attr('cart_id');
						$.post("{{URL('home/cart/cart_onechecked')}}",{'cart_id':cart_id,"_token":"{{csrf_token()}}"},function(r){
								if(r){
									window.location.reload();
								}else{
									layer.msg('发生错误',{time:2000});
								}
								
						});						
						

					});

					//点击全选的时候
					var num = 0;
					$('.cart_checkedall').click(function(){

						$.each($('.cart_checked'),function(index,val){
							// console.log(val);
							if(num%2==0){
								val.checked = false;
								
							}else{
								val.checked = true;
							}
						});
						num++;

						
						//获得当前id
						cart_id=$(this).attr('cart_id');
						$.post("{{URL('home/cart/cart_checkedall')}}",{"_token":"{{csrf_token()}}"},function(r){
								if(r){
									//alert(1);
									window.location.reload();
								}else{
									layer.msg('发生错误',{time:2000});
								}
								
						});	
						
					});

				</script>
			</div>
		</section>
	</div>

@endsection