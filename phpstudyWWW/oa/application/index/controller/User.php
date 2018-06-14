<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use app\index\model;
use think\Session;
class User extends Controller{
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

	function index(){

		$user=new model\User();
		$result=$user::all();
		//dump($result);
		//return view('index/user');
		$this->assign('res',$result);
		return view('index/user');
	}

	function user_add(){

		return view('index/user_add');
	}

	function do_user_add(){
		$user=new model\User();
		//dump($_POST);
		$arr=['username'=>$_POST['username'],'password'=>$_POST['password'],'name'=>$_POST['name'],'sex'=>$_POST['sex'],'birth'=>$_POST['birth'],'age'=>$_POST['age'],'education'=>$_POST['education'],'school'=>$_POST['school'],'department'=>$_POST['did'],'position'=>$_POST['pid'],'tel'=>$_POST['tel'],'email'=>$_POST['email'],'did'=>$_POST['did'],'pid'=>$_POST['pid']];
		
		$result=$user->save($arr);
		if($result>0){
			$this->success('添加成功，跳转中','user/index');

		}else{
			$this->success('删除失败，跳转中','user/user_add');
		}

	}

	function user_del(){
		$user=new model\User();
		$result=$user->destroy($_GET['id']);
		if($result>0){
			$this->success('删除成功，跳转中','user/index');

		}else{
			$this->success('删除失败，跳转中','user/index');
		}
	}

	function user_update(){
		$user=new model\User();
		$u=$user::get($_GET['id'])->toArray();
		//dump($u);
		$this->assign('u',$u);
		return view('index/user_update');

	}

	function do_user_update(){
		$user=new model\User();
		$arr=['username'=>$_POST['username'],'password'=>$_POST['password'],'name'=>$_POST['name'],'sex'=>$_POST['sex'],'birth'=>$_POST['birth'],'age'=>$_POST['age'],'education'=>$_POST['education'],'school'=>$_POST['school'],'department'=>$_POST['did'],'position'=>$_POST['pid'],'tel'=>$_POST['tel'],'email'=>$_POST['email'],'did'=>$_POST['did'],'pid'=>$_POST['pid']];
		$result=$user->save($arr,['id'=>$_POST['id']]);
		if($result>0){
			$this->success('更新成功，跳转中','user/index');

		}else{
			$this->success('更新失败，跳转中','user/user_update');
		}



		//return 1111;
	}

	function user_detail(){
		$user=new model\User();
		$result=$user::get($_GET['id'])->toArray();
		//dump($u);
		$this->assign('u',$result);
		return view('index/user_detail');
	}










}
















?>