<?php
namespace app\index\controller;
//use app\index\model;
use app\admin\model\Index as adminIndex;
use think\Db;
use think\Url;
class Index{
    public function index()
    {
    	//return view();
		$a = new \app\admin\model\Index();
        //$a = new model\Index();
        //return $a->asd();
    	//$b=new model\index();
		//echo $b->asd();
        //return 'index';
       // $a=controller('admin/Index');
       // echo $a->index();
       // echo action('admin/Index/index');
        echo 1;

        echo "<hr>";


    }
	

    public function show(){
    	//return view();
        //$a = new model\Index();
        //$a = new adminIndex();
        //echo $a->asd();
        //dump(input('id'));
        //ECHO 1;
        //dump(input());
        dump($_POST);
        //return view('index/index');
       // return view('index');
        return view('index/index');


    }

    function user(){
        $user = Db::table('user')->where('id',1)->select();
        dump($user);
    }

    function demo(){

        //return 'haha';
        dump(url::build('index/index/demo'));
        //echo url('indexIndex/show');
    }

    function test(){
        return '我是controller里面的index类里面的test方法';
    }
    function _empty(){//如果方法不存在，不会报错，会输出empty此方法的结果
        //return '您访问的方法不存在';
        //$this->redirect('page404');//跳转到page404的方法
        $this->redirect('Error');
    }


}
