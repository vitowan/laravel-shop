<?php
namespace app\index\controller;
use think\Controller;

class Error extends Controller{
	function _empty(){
		$this->redirect('Home/page404');
	}
}




?>