<?php
namespace app\index\controller;
use think\Db;
class Index extends \think\Controller{

    public function index(){
    	//通过下面三行获得一个多层的大数组$result
    	$result=DB::table('cate')->order('sid','asc')->select();
    	$cate_list=new \app\index\model\Cate();
    	$result=$cate_list->cate_list($result);
    	//dump($result)
    	//把大数组分到前端页面
    	$this->assign('result',$result);
        return view();
    }

}





?>