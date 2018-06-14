<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use app\index\model;
use think\Session;
//use app\index\Validate;

class Index extends Controller{

//登录方法
    public function index()
    {
        return view('index/login');
    }

    function dologin(){
    	//$v=new validate\Rule();
    	$user=new model\User();
    	$a=$user::all(['username'=>$_POST['username'],'password'=>md5($_POST['password'])]);
    	//dump($a);
    	//dump($_POST['code']);
    	if(captcha_check($_POST['code']) && count($a)>0){

    		Session::set('username',$_POST['username']);
    		$this->redirect('Home/index');
    	}else{
    		$this->error('请输入正确的用户名，密码和验证码，正在返回','index/index');
    	}
    }






}
