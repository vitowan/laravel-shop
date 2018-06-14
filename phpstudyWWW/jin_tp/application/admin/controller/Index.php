<?php
namespace app\admin\controller;
use think\Controller;
use app\index\model;
use think\Db;
use think\Request;


class Index extends Controller{

	function index(){
		return view('index/login');
		//return 111;
	}

	function dologin(){
		$user=new model\Staff();
		$u=$user::all(['user'=>$_POST['user'],'password'=>$_POST['password']]);
		if(count($u)>0){

			$this->success('登录成功，正在跳转','index/home');
			//echo '666';
		}else{
			$this->error('登录失败，正在返回','index/index');
		}

	}

	function home(){
		return view();
	}

	function nav_add(){
		return view();
	}

	function do_nav_add(){
		$a=new model\Nav();
		$aff=$a->save($_POST);
		if($aff>0){
			$this->success('添加成功，正在跳转','index/nav_mana');
		}else{
			$this->error('添加失败','index/nav_mana');
		}

	}

	function nav_mana(){
		$nav= new model\Nav();
		$result=$nav::all();
		$this->assign('result',$result);
		return view();
	}

	function delete(){
		$nav= new model\Nav();
		//$result=$nav::all($_GET['id']);
		$aff=$nav::destroy($_GET['id']);
		if($aff>0){
			$this->success('删除成功，正在跳转','index/nav_mana');
		}else{
			$this->error('删除失败','index/nav_mana');
		}

	}

	function nav_update(){
		$nav= new model\Nav();
		$result=$nav::get($_GET['id'])->toArray();
		//dump($result);
		$this->assign('result',$result);
		return view();
	}



	function do_nav_update(){
		//return 1111;
	$nav= new model\Nav();
	$title=$_POST['title'];
	$url=$_POST['url'];
	$intro=$_POST['intro'];
	$banner='/jin_tp/public/static/uploads/'.$_FILES['banner']['name'];
	//echo $banner;

	//$banner='/jin_tp/public/static/uploads/'.$_FILES['banner']['name'];
	//move_uploaded_file($_FILES['banner']['tmp_name'], $banner );

	$file=request()->file('banner');
	$file->move('static/uploads','');
	//dump($aff);
	//return 123;/jin_tp/public/static/uploads/book_13.jpg

	$arr=['title'=>$title,'url'=>$url,'intro'=>$intro,'banner'=>$banner];

		$aff=$nav->save($arr,['id'=>$_POST['id']]);
		if($aff>0){
			$this->success('更改成功，正在跳转','index/nav_mana');
		}else{
			$this->error('更改失败','index/nav_mana');
		}

	}

	function art_add(){
		return view();
	}

	function do_art_add(){
		$a=new model\Article();
		$title=$_POST['title'];
		$intro=$_POST['intro'];
		$content=$_POST['content'];
		$pic='/jin_tp/public/static/uploads/'.$_FILES['pic']['name'];
		$author=$_POST['author'];
		$pid=$_POST['pid'];

	$file=request()->file('pic');
	$file->move('static/uploads','');


	$arr=['title'=>$title,'intro'=>$intro,'content'=>$content,'pic'=>$pic,'author'=>$author,'pid'=>$pid];

		$aff=$a->save($arr);
		if($aff>0){
			$this->success('文章添加成功，正在跳转','index/art_mana');
		}else{
			$this->error('文章添加失败','index/art_mana');
		}

	}


	function art_mana(){
		$a=new model\Article();
		$result=$a::all();
		$this->assign('result',$result);
		return view();

	}

	function art_del(){
		$a=new model\Article();
		$aff=$a->destroy($_GET['id']);
		if($aff>0){
			$this->success('文章删除成功，正在跳转','index/art_mana');
		}else{
			$this->error('文章删除失败','index/art_mana');
		}

	}

	function art_update(){
		$a=new model\Article();
		$result=$a::get($_GET['id'])->toArray();
		//dump($result);
		$this->assign('result',$result);
		return view();

		//return 1111;
	}

	function do_art_update(){
		$a=new model\Article();
		$title=$_POST['title'];
		$intro=$_POST['intro'];
		$content=$_POST['content'];
		$pic='/jin_tp/public/static/uploads/'.$_FILES['pic']['name'];
		$author=$_POST['author'];
		$pid=$_POST['pid'];

	$file=request()->file('pic');
	$file->move('static/uploads','');


	$arr=['title'=>$title,'intro'=>$intro,'content'=>$content,'pic'=>$pic,'author'=>$author,'pid'=>$pid];

		$aff=$a->save($arr,['id'=>$_POST['id']]);
		if($aff>0){
			$this->success('文章添加成功，正在跳转','index/art_mana');
		}else{
			$this->error('文章添加失败','index/art_mana');
		}

	}





}







?>