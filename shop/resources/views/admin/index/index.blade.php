@extends('admin.layout.layout')
@section('title1','首页')
@section('title2','查看')

@section('main')
@if(session('message'))
<script>
	layer.alert("{{session('message')}}");
</script>
	
@endif
我是主页，还不确定写啥
@endsection