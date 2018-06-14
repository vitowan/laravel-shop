<?php
namespace app\index\controller;

use think\Controller;
use think\Request;

class Demo extends Controller{

/*	function index(){
		$r=request();
		dump($r->url());
	}
*/

	function index(Request $r){
		//dump($r);
		//dump($r->url());//此函数跟上面方法效果一样
		//echo $r->ext();//打印伪地址后缀，例如.html
		//dump($r->root());//入口地址
		//dump($r->pathinfo());
		//dump($r->domain());//域名
		//dump($r->ip());
		//dump($r->isAjax());//是否ajax请求
		//dump($r->isGet());
		dump($r->controller());//打印控制器
		//dump($r->action());//打印当前方法名
	}




}












?>