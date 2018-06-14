<?php
namespace app\index\controller;
use think\Controller;

class Error extends Controller{//如果类不存在，会跳到这个方法里面
	public function _empty(){
		$this->redirect('Index/test');
	}
	/*
	每一个线上项目都需要空操作和空控制器
	在每一个控制器中都需要一个空操作
	无论前端还是后端，都需要加一个空控制器


	*/




}






?>