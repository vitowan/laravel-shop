<?php
namespace app\index\controller;
use think\Controller;

class Error extends Controller{
	function _empty(){
		//return view('index/error');
		$this->redirect('index/error404');		
	}

}








?>