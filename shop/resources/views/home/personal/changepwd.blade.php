@extends('home.layout.layoutPer')
@section('personal')	

			<div class="pull-right">
				<div class="user-content__box clearfix bgf">
					<div class="title">账户信息-修改登陆密码</div>
					<div class="modify_div">
						<div class="clearfix">
							<a href="{{URL('home/personal/changepwd_step1')}}" role="button" class="but">修改登陆密码</a>
							<a href="{{URL('home/login/login')}}" role="button" class="but">忘记登陆密码</a>
						</div>
						<div class="help-block">随时都能更改密码，保障您账户的安全</div>
					</div>
				</div>
			</div>


@endsection