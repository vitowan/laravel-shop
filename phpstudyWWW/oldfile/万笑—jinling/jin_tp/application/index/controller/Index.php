<?php
namespace app\index\controller;
use think\Controller;
use app\index\model;
use think\Db;

class Index extends Controller
{

	function _initialize(){
		parent::_initialize();
		$nav= new model\Nav();
    	$result=$nav::all();
   	if(isset($_GET['id'])){
    		$id=$_GET['id'];
    		$a=$nav::all($id);
    		foreach($a as $v){
    			$p=$v->toArray();
    			$photo=$p['banner'];
    		}
    	}else{
    		$photo='/jin_tp/public/static/uploads/banner_a.jpg';
    	}
//$photo='/jin_tp/public/static/uploads/banner_a.jpg';

    	$this->assign('result',$result);
    	$this->assign('photo',$photo);
	}




    public function index()
    {
    	
    	//集团新闻
        $ar= new model\News();
    	$article= new model\Article();
    	$art=$ar::all();

    	//通知公告
		$notice=$article::all(['pid'=>'19']);

		//销售信息
		$sale=$article::all(['pid'=>'20']);

		//集团概况
		$intro=$article::all(10);



    	$this->assign('article',$art);
    	$this->assign('notice',$notice);
    	$this->assign('sale',$sale);
    	$this->assign('intro',$intro);
        return view();
    }

    function about(){
    	//return view('index/about');
    	//dump($_GET['id']);
    	//$this->index();

    	$a=new model\Article;

    	$arr=$a::all($_GET['id']);
    	//dump($arr);
    	$this->assign('arr',$arr);
    	return view();
    	//return 1111;
    }

    function news(){
    	$a=new model\News();
    	$b=new model\Nav();
    	$arr=$a::order('id','desc')->select();
    	$this->assign('arr',$arr);
    	$this->assign('photo','/jin_tp/public/static/uploads/news.jpg');
    	return view();
    }

    
}


