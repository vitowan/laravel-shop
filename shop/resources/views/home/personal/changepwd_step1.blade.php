@extends('home.layout.layoutPer')
@section('personal')	

<script>
@if(session('mes2'))
		layer.alert("{{session('mes2')}}",{title:'！！！注意',icon:2});
@endif	
</script>

	
	<div class="pull-right">
		<div class="user-content__box clearfix bgf">
			<div class="title">账户信息-修改登陆密码</div>
			<div class="step-flow-box">
				<div class="step-flow__bd">
					<div class="step-flow__li step-flow__li_done">
					  <div class="step-flow__state"><i class="iconfont icon-ok"></i></div>
					  <p class="step-flow__title-top">输入旧密码</p>
					</div>
					<div class="step-flow__line step-flow__line_ing">
					  <div class="step-flow__process"></div>
					</div>
					<div class="step-flow__li">
					  <div class="step-flow__state"><i class="iconfont icon-ok"></i></div>
					  <p  class="step-flow__title-top">重置登陆密码</p>
					</div>
					<div class="step-flow__line">
					  <div class="step-flow__process"></div>
					</div>
					<div class="step-flow__li">
					  <div class="step-flow__state"><i class="iconfont icon-ok"></i></div>
					  <p class="step-flow__title-top">完成</p>
					</div>
				</div>
			</div>
			<form action="{{URL('home/personal/changepwd_step2')}}" class="user-setting__form" method='post' role="form">
				{{csrf_field()}}
				<div class="form-group">
					<input class="form-control" name="password" required=""  autocomplete="off" type="password">
					<span class="tip-text" >请输入原密码</span>
					<span class="see-pwd pwd-toggle" title="显示密码"><i class="glyphicon glyphicon-eye-open"></i></span>
					<span class="error_tip"></span>
				</div>
				<div class="user-form-group tags-box">
					<button type="submit" class="btn ">提交</button>
				</div>
				<script src="{{asset('home/js/login.js')}}"></script>
				<script>
					$(document).ready(function(){
						$('.form-control').on('blur focus',function() {
							$(this).addClass('focus');
							$('.error_tip').empty();
							if ($(this).val() == ''){$(this).removeClass('focus')}
						});
					});
				</script>
			</form>
		</div>
	</div>

	<script>
		

	</script>


@endsection