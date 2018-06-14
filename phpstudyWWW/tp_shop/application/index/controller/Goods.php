<?php

namespace app\index\controller;
use think\Db;
use think\Page;
class Goods extends \think\Controller{

    public function goodsList($goods_pid){
    	//return 1111;
    	$result=DB::table('goods')->where('goods_pid',$goods_pid)->where('goods_status',1)->select();
    	$page=new Page(count($result),4);
    	$result=DB::table('goods')->where('goods_pid',$goods_pid)->where('goods_status',1)->limit($page->firstRow,$page->listRows)->select();
    	//dump($result);die;
    	$html=$page->show();
    	$this->assign('result',$result);
    	$this->assign('html',$html);
    	return view('goods/goods_list');
    }

}








?>