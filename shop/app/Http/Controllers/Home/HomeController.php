<?php

namespace App\Http\Controllers\Home;
use DB;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    //主页面显示
    function index(){
    	//return view('home.home.index');
    	$all=$this->getAll(0);//从pid为0的开始，得到一个多层大集合
    	//dd($all);
    	//第一层的分类
    	//$result=$this->navLeft();
        

    	return view('home.home.index',['all'=>$all,'m'=>8,'n'=>0]);
    }

    //递归得到一个多层的大数组集合
    function getAll($id){
    	//查询所有的pid等于id的，说明他有子级
    	$all=DB::table('cate')->where('cate_pid',$id)->get();
    	foreach($all as $k=>$v){
    		//循环递归，给有子级的加上child元素，child元素可能有自己的子级
            $all[$k]->goods=DB::table('goods')->where('goods_pid',$v->id)->get();
    		$all[$k]->child=$this->getAll($v->id);


    	}
    	return $all;
    }


}
