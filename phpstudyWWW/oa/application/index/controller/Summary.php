<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use app\index\model;
use think\Session;


class Summary extends Controller{
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



	function day_summary(){
		$username=Session::get('username');		
		$sum=new model\Summary();
		$user=new model\User();
		$u=$user::get(['username'=>$username])->toArray();
		$name=$u['name'];
		$result=$sum::all(['name'=>$name]);

		//dump($result);
		$this->assign('sum',$result);
		
		return view('summary/day_summary');
	}

	function sum_write(){
		return view('summary/sum_add');
	}

	function do_sum_add(){

		$username=Session::get('username');
		$user=new model\User();
		$sum=new model\Summary();
		//user表查询
		$u=$user::get(['username'=>$username])->toArray();
		$name=$u['name'];
		$position=$u['position'];
		//echo $name;
		$arr=['name'=>$name,'department'=>$position,'content'=>$_POST['content']];
		$result=$sum->save($arr);
		if($result){
			$this->success('添加成功','summary/day_summary');
		}else{
			$this->error('添加失败','summary/sum_add');
		}

	}

	function summary_check(){
		$sum=new model\Summary();
		$username=Session::get('username');
		$user=new model\User();
		$u=$user::get(['username'=>$username])->toArray();

		
		$result=$sum::all(['department'=>$u['position']]);
		//dump($result);
		$this->assign('daily',$result);
		return view('summary/summary_check');
	}

	function summary_com(){
		$sum=new model\Summary();
		$result=$sum::get($_GET['id'])->toArray();
		$con=$result['content'];
		$id=$result['id'];
		$this->assign('con',$con);
		$this->assign('id',$id);
		return view('summary/summary_com');
	}

	function do_sum_com(){
		//return 111;
		//dump($_POST['text']);
		$user=new model\User;
		$sum=new model\Summary();
		$com=new model\Comment();
		$username=Session::get('username');
		$u=$user::get(['username'=>$username])->toArray();
		$comment_name=$u['name'];
		$comment_pos=$u['department'];
		$pid=$_POST['id'];

		$arr=['comment_name'=>$comment_name,'comment_pos'=>$comment_pos,'pid'=>$pid,'com_content'=>$_POST['text']];

		$result=$com->save($arr);
		if($result){
			$this->success('评论成功','summary/summary_check');
		}else{
			$this->error('评论失败','summary/summary_check');
		}		

	}


	//每条日志中领导评论的内容的方法
	function leader_comments(){
		$id=$_GET['id'];	
		$sum=new model\Summary();
		$summary=$sum::get($id)->toArray();
		$comment=$summary['content'];
		//echo $comment;

		$sum=new model\Comment();
		$arr=$sum::where('pid',$id)->select();

//dump($result);
		$this->assign('comment',$comment);
		$this->assign('arr',$arr);

		return view('summary/leader_comments');
	}


}









?>