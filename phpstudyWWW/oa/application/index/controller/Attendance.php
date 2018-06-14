<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use app\index\model;
use think\Session;


class Attendance extends Controller{
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

	function attend(){
		$username=Session::get('username');
		$user=new model\User();
		$u=$user::get(['username'=>$username])->toArray();
		$name=$u['name'];
		$department=$u['position'];

		$attend=new model\Attendance();

		$arr=['name'=>$name,'department'=>$department];
		$result=$attend->save($arr);

		if($result){
			$this->redirect('attendance/attendance');
		}else{
			$this->error('打卡失败，正在跳转','attendance/attendance');
		}	
		//return view('attendance/attendance');
	}

	function attendance(){
		$username=Session::get('username');
		$user=new model\User();
		$u=$user::get(['username'=>$username])->toArray();
		$name=$u['name'];

		$attend=new model\Attendance();
		$time=$attend::all(['name'=>$name]);
		//dump($time);
		$this->assign('time',$time);
		
		return view('attendance/attendance');
	}




}




?>