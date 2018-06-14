<?php

namespace app\index\controller;
session_start();
use think\Controller;
use app\index\model;
use think\Db;



class Index extends Controller{
    public function index()
    {
        //return view('index/register');
        return $this->fetch('index/register');
    }

    public function register(){
    	//dump($_POST);
    	//$result=DB::table('user')->insert($_POST);
        $a= new model\User();
        $result=$a->save($_POST);
    	if($result){
     		$this->success('注册成功','index/login');  		
    	}else{
    		$this->error('注册失败正在跳转','index/login');
    	}

    }

    public function login(){
    	//return view('index/login');
       return $this->fetch('index/login');
    }

    public function doLogin(){
    	//dump($_POST);
    	//$username=$_POST['username'];
    	//$password=$_POST['password'];
    	//$result=Db::table('user')->where('username',$username)->where('password',$password)->select();
        $a=new model\User();
        $result=$a::all($_POST);
        //dump($result);
    	if(count($result)>0){
    		$_SESSION['username']=$_POST['username'];

    		$this->success('登录成功，正在跳转','index/home');
    	}else{
    		$this->error('登陆失败，正在跳转','index/login');
    	}
    }

    public function home(){
    	//dump($_SESSION['username']);
    	if(isset($_SESSION['username'])){
	     	//$result=DB::table('article')->select();
            $a=new model\Article();
            $result=$a::all();
            //dump($result);
            //$this->fetch('index/home',['article'=>$result]);
	    	$this->assign('article',$result);
	    	return $this->fetch('index/home');   		
    	}else{
    		$this->redirect('index/index');
    	}

    }

    public function delete(){
    	$id=$_GET['id'];
    	//echo $id;
    	//$result=DB::table('article')->delete($id);
        $a=new model\Article();
        $result=$a->destroy($id);
    	if($result){
    		$this->success('删除成功','index/home');
    	}else{
    		$this->error('删除失败','index/home');
    	}
    }

    public function add(){
    	//return view();
        return $this->fetch();
    }

    public function insert(){
    	//dump($_POST);
    	//$result=DB::table('article')->insert($_POST);
        $a=new model\Article();
        //$result=$a->save($_POST);
        $a->data($_POST);
        $result=$a->save();
    	if($result){
    		$this->success('添加成功','index/home');
    	}else{
    		$this->error('添加失败','index/home');
    	}
    }

    public function update(){
    	$id=$_GET['id'];
    	//$result=DB::table('article')->where('id',$id)->select();
        $a=new model\Article();
        $result=$a->all($id);
    	$this->assign('result',$result);
    	//return view('index/edit');
        return $this->fetch();
    }

    public function doUpdate(){
    	//echo 1111;
    	$id=$_POST['id'];
    	//$result=DB::table('article')->where('id',$id)->update($_POST);
        $a=new model\Article();
        $result=$a->save($_POST,['id'=>$id]);
    	if($result){
    		$this->success('修改成功','index/home');
    	}else{
    		$this->error('修改失败','index/home');
    	}

    }

    public function search(){
    	//echo 2121;
    	$title=$_POST['title'];
    	//echo $title;
    	if(strlen($title)==0){
    		$this->error('搜索内容不得为空，正在返回','index/home');
    	}else{
	    	//$result=DB::table('article')->where('title','like',"%{$title}%")->select();
            $a=new model\Article();
            $result=$a->where('title','like',"%{$title}%")->select();
	    	//dump($result);
	    	if(count($result)==0){
	    		$this->error('查无结果，正在返回','index/home');
	    	}else{
		     	$this->assign('result',$result);
		    	//return view('index/search');  
                return $this->fetch(); 		
	    	}

    	}


    }

    public function content(){
    	$id=$_GET['id'];
    	//$result=DB::table('article')->where('id',$id)->select();
    	//dump($result);
    	$this->assign('result',$result);
    	return view('index/content');
    }

    public function _empty(){
    	$this->redirect('error/index');
    }

    public function error404(){
    	//return view('index/error');
        return $this->fetch();
    }





}
