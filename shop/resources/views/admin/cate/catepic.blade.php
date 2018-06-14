@extends('admin.layout.layout')
@section('title1','分类管理')
@section('title2','主分类广告图')

@section('main')
<div style='color:red'>
	@if(session('mes'))
	**{{session('mes')}}
	@endif

</div>
@if(session('message'))
<script>
	layer.alert("{{session('message')}}");
</script>
	
@endif

<div class="col-xs-12">

	<div class="table-responsive">

		<form action={{URL('admin/catepic/cate_picadd')}} method='post' enctype='multipart/form-data' class="form-inline" style="margin-bottom:5px">
			{{csrf_field()}}
			<select name="id" id="" style='height:42px;width:150px'>

				<option value="">请先选择主分类</option>
				@foreach($res as $v)
				<option value="{{$v->id}}">{{$v->cate_name}}</option>
				@endforeach

			</select>
			<input type="hidden" name='goods_picpid' value="">
		  <div class="form-group">
		    <input type="file" class="form-control" value="" name='cate_picurl[]' multiple="true" style='height:42px;width:200px'>
		  </div>

		  <button type="submit" class="btn btn-default">添加图片</button>
		</form>


		<table id="sample-table-1" class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th  class='text-center'>ID</th>					
					<th  class='text-center'>分类</th>					
					<th  class='text-center'>图片</th>
					<th  class='text-center'>最新更新时间</th>
					<th  class='text-center'>操作</th>
				</tr>
			</thead>
			<style>
				.picview{
					width:200px;
					/*height:400px;*/
					position:relative;
					margin-right:20px;
					overflow:hidden;
				}
				.picview .delpic{
					position:absolute;
					top:10px;
					right:10px;
					display:none;		
				}
				.picview .delpics{
					width:30px;
					height:30px;					
				}
				.bigpic{
					/*width:200px;*/
					height:400px;

				}
				.picview:hover .delpic{
					display:block;
				}
				.goodspicsort{
					position:absolute;
					left:10px;
					top:10px;
					width:50px;
					display:none;

				}
				.imgdisplay{
					display:flex;
					/*flex-direction: center;*/
					justify-content: center;
					/*width:800px;*/
					flex-wrap: wrap;
				}
				.bigpic:hover{
					transform:scale(1.1);
			        -ms-transform:scale(1.1);
			        -webkit-transform:scale(1.1);
			        -o-transform:scale(1.1);
			        -moz-transform:scale(1.1);
				}
				.sortmanage{
					width:100px;
				}
				.sortcancel,.sortconfirm{
					display:none;
					margin-top:10px;
				}
			</style>

			<tbody>
				@foreach($res as $v)
				<form action="{{URL('admin/catepic/cate_picsort').'/'.$v->id}}" method='get'>
				<tr>
					<td  class='text-center'>{{$v->id}}</td>					
					<td  class='text-center'>{{$v->cate_name}}</td>					
					<td  class='imgdisplay'>
						@foreach($v->cate_pic as $vv)
						<div class='picview'>
							<img src="{{URL('').$vv->cate_picurl}}" style='' title='点击看大图' class='bigpic'>
							<a class='delpic' href="javascript:;" cate_picid="{{$vv->cate_picid}}"><img src="{{URL('').'/admin/icons/delpic.png'}}" alt="" class='delpics' title='删除''>		</a>
							<input type="text" name="{{$vv->cate_picid}}" value="{{$vv->cate_picsort}}" class='goodspicsort' >

						</div>
						@endforeach
					</td>
					<td  class='text-center'>{{$v->cate_date}}</td>
					<td  class='text-center sortmanage' ><button  type='button' class='btn btn-primary sortset'  title='把序号设定为当前行的最大值即可'>设置主图</button> <button  type='button' class='btn btn-default sortcancel'>取消设置</button> <button  type='submit' class='btn btn-success sortconfirm'>确定设置</button> 
				</tr>
				</form>
				@endforeach
				<script>
					//删除分类图片
					$('.delpic').click(function(r){
						cate_picid=$(this).attr('cate_picid');
						obj=$(this)
						layer.confirm('确定删除吗？',{btn:['确定','取消']},function(index){
							$.get("{{URL('admin/catepic/cate_picdel')}}",{'cate_picid':cate_picid},function(r){
								layer.close(index);
								if(r==1){
									obj.parent().css('display','none');
								}else if(r==2){
									layer.alert('此图为分类主图，请先设定其它图为主图才能删除此图',{skin:'layui-layer-lan'});
								}else{
									layer.alert('删除失败',{time:2000});
								}
							});
						});
						

					});

					//排序
					$('.sortset').click(function(){
						//alert(1);
						$(this).css('display','none');
						$(this).parent().siblings('.imgdisplay').find('.goodspicsort').css('display','block');
						$(this).siblings('.sortcancel').css('display','block');
						$(this).siblings('.sortconfirm').css('display','block');

					});
					$('.sortcancel').click(function(){
						$(this).css('display','none');
						$(this).siblings('.sortconfirm').css('display','none');
						$(this).siblings('.goodspicsort').css('display','block');
						$(this).siblings('.sortset').css('display','block');
						$(this).parent().siblings('.imgdisplay').find('.goodspicsort').css('display','none');
						// $('')
					});
					$('.sortconfirm').click(function(){
						//alert(1);
						res=$(this).parent().siblings('.imgdisplay').find('.goodspicsort')
						console.log(res);
					});

				</script>

		


			</tbody>
		</table>

	</div><!-- /.table-responsive -->
</div>



@endsection