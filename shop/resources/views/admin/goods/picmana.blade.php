@extends('admin.layout.layout')
@section('title1','产品管理')
@section('title2','产品列表 - 图片管理')

@section('main')

@if(session('message'))
<script>
	layer.alert("{{session('message')}}");
</script>
	
@endif
<style>
	.imgdisplay{
		display:flex;
		/*flex-direction: center;*/
		justify-content: center;
		/*width:800px;*/
		flex-wrap: wrap;

	}
	.delpics{
		width:25px;
		height:25px;
	}

	.picview{
		/*display:inline-block;*/
		position:relative;
		width:250px;
		height:250px;
		overflow:hidden;
		margin-right:5px;
		margin-bottom:5px;
	}
/*	.picview:hover{
		margin-top:10px;
	}*/
/* 	.picview:hover .picdel{
	display:inline-block;
} */
	.delpic{
		position:absolute;
		left:210px;
		top:10px;
		display:none;
	}
	.bigpic:hover{

        transform:scale(1.1);
        -ms-transform:scale(1.1);
        -webkit-transform:scale(1.1);
        -o-transform:scale(1.1);
        -moz-transform:scale(1.1);
        
	}
	.goodspicsort{
		position:absolute;
		/*z-index: 2;*/
		top:2px;
		left:2px;
		width:60px;
		display:none;
	}
</style>



<div style='color:red'>
	@if(session('mes'))
	**{{session('mes')}}
	@endif

</div>


<div class="col-xs-12">

	<div class="table-responsive">
		

		<form action={{URL('admin/goodspic/goods_picadd').'/'.$id}} method='post' enctype='multipart/form-data' class="form-inline" style="margin-bottom:5px;display:inline-block;">
			{{csrf_field()}}
			<input type="hidden" name='goods_picpid' value="{{$id}}">
		  <div class="form-group">
		    <input type="file" class="form-control" value="" name='goods_picurl[]' multiple="true" style='height:42px;width:200px'>
		  </div>
		  <button type="submit" class="btn btn-default">添加图片</button>
		</form>

		<button class="btn btn-primary" style='display:inline-block;margin-left:100px' id='goodspicsort'>图片排序</button>
		<button class="btn btn-default" style='display:none;margin-left:100px' id='goodspicsortc'>取消排序</button>
		<button class="btn btn-primary" style='display:none;' id='goodspicsortq'>确认排序</button>

		
		<form action="{{URL('admin/goodspic/goods_picsort').'/'.$id}}" method='post' id='picsortsub'>
			{{csrf_field()}}
		<table id="sample-table-1" class="table table-striped table-bordered table-hover" style='margin-bottom: 50px'>
			<thead>
				<tr>
					<th  class='text-center'>ID</th>					
					<th  class='text-center'><span style='color:blue;font-size:16px;margin-right: 80px'>{{$catename}}</span></th>
					<!-- <th  class='text-center'>图片</th> -->
					<!-- <th  class='text-center'>最新更新时间</th> -->
					<!-- <th  class='text-center'>操作</th> -->
				</tr>
			</thead>

			<tbody>
				<td>{{$id}}</td>
				<td class='imgdisplay'>
				@foreach ($result as $v)

					<!-- <td  class='text-center'>{{$v->goods_picid}}</td>					 -->
					<!-- <td  class='text-center'><input type="text" style='width:60px'></td> -->
					<!-- <td  class='text-center'><img src="{{URL('').$v->goods_picurl}}" alt="" style="width:150px;height:150px"></td> -->
					<!-- <td  class='text-center'>{{$v->goods_picdate}}</td> -->
					<!-- <td  class='text-center'><a href="{{URL('admin/goodspic/goods_picdel').'/'.$v->
						goods_picid}}">删除</a>  -->
						<div class='picview'>
							<img src="{{URL('').$v->goods_picurl}}" style='width:250px;' title='点击看大图' class='bigpic'>
							<a class='delpic' href="javascript:;" goods_picid="{{$v->goods_picid}}"><img src="{{URL('').'/admin/icons/delpic.png'}}" alt="" class='delpics' title'删除>		</a>
							<input type="text" name="{{$v->goods_picid}}" value="{{$v->goods_picsort}}" class='goodspicsort' >

						</div>

				@endforeach
				</td>
			</tbody>
		</table>
		</form>
		<script>
			//删除图片
			$('.delpic').click(function(){
				goods_picid=$(this).attr('goods_picid');
				obj=$(this)
				//alert(goods_picid);
				layer.confirm('确定删除吗？',{btn:['确定','取消']},function(index){
					$.get("{{URL('admin/goodspic/goods_picdel')}}",{'goods_picid':goods_picid},function(r){
						console.log(r);
						//document.write(r);
						layer.close(index);
						if(r==1){
							obj.parent().css('display','none');
						}else if(r==2){
							layer.alert('此图为商品主图，请先设定其它图为主图才能删除此图',{skin:'layui-layer-lan'});
						}else{
							layer.msg('删除失败',{time:2000});
						}
					});
				});
				
			});
			

		</script>

		<script>
			//让删除按钮消失出现
			//alert($);
			$('.picview').hover(function(){
				$(this).find('.delpic').css('display','inline-block');
				//alert(1);
			},function(){
				$(this).find('.delpic').css('display','none');
			});

			//图片排序
			$('#goodspicsort').click(function(){
				$('.goodspicsort').css('display','block');
				$(this).css('display','none');
				$('#goodspicsortc').css('display','inline-block');
				$('#goodspicsortq').css('display','inline-block');
			});
			//取消图片排序
			$('#goodspicsortc').click(function(){
				$('.goodspicsort').css('display','none');
				$(this).css('display','none');
				$('#goodspicsortq').css('display','none');
				$('#goodspicsort').css('display','inline-block');

			});
			//排序确认提交
			$('#goodspicsortq').click(function(){
				$('#picsortsub').submit();
			});






		</script>
		  </div>
		</div>

	</div><!-- /.table-responsive -->
</div>



@endsection