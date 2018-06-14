@extends('admin.layout.layout')
@section('title1','产品管理')
@section('title2','产品列表 - 产品介绍')

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

 <script type="text/javascript" charset="utf-8" src="{{asset('admin/ueditor/ueditor.config.js')}}"></script>
    <script type="text/javascript" charset="utf-8" src="{{asset('admin/ueditor/ueditor.all.min.js')}}"> </script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="{{asset('admin/ueditor/lang/zh-cn/zh-cn.js')}}"></script>
        <div class="col-md-6 col-md-offset-5" style="color:blue;font-size:18px;margin-bottom: 10px">
            {{$goods_name}}
        </div>    
<form action="{{URL('admin/goodsdointro/goods_dointro').'/'.$id}}" method='post' enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="col-xs-12">
    <script id="editor" type="text/plain" style="height:410px" name='goods_intro' value="{{old('goods_intro')}">
        {!!$goods_intro!!}
    </script>
        <div class="clearfix form-actions" >
            <div class="col-md-offset-5 col-md-9">
                <button class="btn btn-info" type="submit">
                    <i class="icon-ok bigger-110"></i>
                    提交
                </button>
            </div>
        </div>

    </div>
</form>
<script type="text/javascript">

    //实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
    var ue = UE.getEditor('editor');


</script>

@endsection