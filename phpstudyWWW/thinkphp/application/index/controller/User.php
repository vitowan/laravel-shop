<?php
namespace app\index\controller;
use think\Controller;

class User extends Controller{
//控制器初始化
	function _initialize(){//初始化前缀，类似于构造函数 function __construct(){}
			parent::_initialize();
			echo '可以在此用于session验证';
/*			if(!isset($_SESSION['username'])){
				$this->redirect('index/demo');
			}*/
	}


	function user(){

		return view('index/show');
		//return view();
		//return 666;

	}
//前置方法：执行方法前执行的函数
	//protected $beforeActionList=['start','start_two'];//对任何调用的函数都会调用这两个函数
	protected $beforeActionList=['start'=>['only'=>'show1'],'start_two'=>['only'=>'show']];//start函数只对show1有效，调用其它函数时无效，同理start_two也是只对show有效
	function start(){
		echo '<br>';
		echo '世界和平';
	}


	function start_two(){
		echo '<br>';
		echo '不太和平';
	}


	function show(){
		return view('index/index');
	}

	function show1(){
		return view('demo/index');
	}


	function demo(){
		return view('index/index');
	}

	function direct(){
		$this->redirect('index/index/index');//重定向的，可以定向到当前模块中的controller类，也可转到其他的模块的controller类,因为继承controller类，只能跳转到controller里面
	}


	function tiao(){//此法经常用到数据库的增改删除的判断中
		//$this->success('成功','index/test');//也可以单独用此行作为页面跳转
	//}else{
		//$this->error('失败','index/test');

	}


	function _empty(){//如果方法不存在，不会报错，会输出empty此方法的结果
		//return '您访问的方法不存在';
		//$this->redirect('page404');//跳转到page404的方法
		$this->redirect('Error/show');//方法错误跳转到Error类的show方法。Error里面没show方法，Error里面再跳转到其404链接，如果控制器错误跳转到Error里面，然后让它自己再跳转到404页面
	}


	function page404(){
		return view('index/page404');//打开view里面的404页面
	}




}






?>