<?php
namespace app\index\controller;

use think\Db;
use think\Controller;

class Index extends Controller
{
    public function index()
    {

    	$query=Db::query("select * from `nav`");
    	//$query=Db::table('nav')->select();
    	//dump($query);
    	$this->assign('nav',$query);

        return View('index/index');
    }

    function add(){
    	//return 2222;
    	return view('index/add');
    }

    function insert(){
    	//dump($_POST);
    	$title=$_POST['title'];
    	$intro=$_POST['intro'];
    	$query=Db::execute("insert into `nav`(`title`,`intro`) values('$title','$intro')");
    	if($query>0){
    		$this->success('添加成功','index/index');
    	}else{
    		$this->error('添加失败','index/index');
    	}
    }

    function delete(){
    	//dump($_GET['id']);
    	$id=$_GET['id'];
    	$query=Db::execute("delete from `nav` where `id`='$id'");
    	if($query>0){
    		$this->success('删除成功','index/index');
    	}else{
    		$this->error('删除失败','index/index');
    	}
    }

    function update(){
    	$id=$_GET['id'];
    	//dump($id);
    	$query=Db::query("select * from `nav` where `id`=$id");
    	//$query=Db::table('nav')->where('id',$id)->select();
    	//dump($query);
    	$this->assign('result',$query);    	
     	return view('index/edite');   	
    }

    function upd(){
		//return 7777777;
    	$id=$_POST['id'];
    	//echo $id;
    	//dump($_POST);
    	$title=$_POST['title'];
    	$intro=$_POST['intro'];
     	$query=Db::execute("update `nav` set `title`='$title',`intro`='$intro' where `id`='$id'");
     	if($query>0){
     		$this->success('更改成功','index/index');
     	}else{
     		$this->error('更改失败','index/index');
     	}
    }



/*    public function insert{
    	$query=Db::execute("insert into ");
    }*/



}
