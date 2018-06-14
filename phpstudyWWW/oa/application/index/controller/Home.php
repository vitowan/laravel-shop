<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use app\index\model;
use think\Session;
use app\index\Validate;

class Home extends Controller{

	function _initialize(){
		parent::_initialize();
		if(!Session::has('username')){
			$this->redirect('index/index');	
		}

		$username=Session::get('username');
		$user=new model\User();
		$department=new model\Department();
		$purview=new model\Purview();
		//user表查询
		$u=$user::get(['username'=>$username])->toArray();
		$did=$u['did'];
		//dump($did);
		//部门表查询
		$depart=$department::get($did)->toArray();
		//dump($depart);
		$pur=$user_purview=$depart['user_purview'];
		//dump($pur);
		//权限表查询
		
		$result=$purview::where('id','in',$pur)->select();
		$this->assign('name',$u['name']);
		$this->assign('result',$result);

	}

//权限登录的方法
	function Index(){
/*		$username=Session::get('username');
		$user=new model\User();
		$department=new model\Department();
		$purview=new model\Purview();
		//user表查询
		$u=$user::get(['username'=>$username])->toArray();
		$did=$u['did'];
		//dump($did);
		//部门表查询
		$depart=$department::get($did)->toArray();
		//dump($depart);
		$pur=$user_purview=$depart['user_purview'];
		//dump($pur);
		//权限表查询
		$result=$purview::where('id','in',$pur)->select();*/
		//dump($result);

		return view('index/home');

	}

//退出登录
	function rm_session(){

		Session::delete('username');
		$this->redirect('index/index');	
	}

	//修改密码的页面
	function pass_change(){
		$username=Session::get('username');
		$user=new model\User();
		$department=new model\Department();
		$purview=new model\Purview();
		//user表查询
		$u=$user::get(['username'=>$username])->toArray();
		$this->assign('id',$u['id']);
		return view('index/password');
	}

	function _empty(){
		$this->redirect('Error/show');

	}

	function page404(){
		return view('index/page404');
	}


//个人登录后的个人信息页面
	function person_info(){

		$username=Session::get('username');
		//echo Session::get('username');
		$user=new model\User();
		$department=new model\Department();
		$purview=new model\Purview();
		//user表查询
		$u=$user::get(['username'=>$username])->toArray();
		//echo $u['id'];

		$this->assign('u',$u);
		return view('index/person_info');
	}
//更改密码方法
	function password(){
		$user=new model\User();
		$result=$user->save(['password'=>$_POST['password']],['id'=>$_POST['id']]);
		if($result){
			$this->success('更改成功，正在跳转','home/index');
		}else{
			$this->error('更改失败，正在跳转','home/pass_change');
		}	

	}





}










?>