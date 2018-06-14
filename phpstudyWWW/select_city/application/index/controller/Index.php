<?php
namespace app\index\controller;
use think\Db;
use think\Cache;

class Index extends \think\Controller
{
    public function index()
    {
    	//phpinfo();
    	$province=Cache::get('allprovince');
    	if(!$province){
	    	$province = DB::table('rc_district')->field('district_id,district')->where('pid','1')->select();
	    	//dump($province);
	    	Cache::set('allprovince',$province);    	
    	}

		$this->assign('province',$province);
        return view();

    }
    public function ajaxgetarea(){
    	//echo $_POST['pid'];
    	$area=Cache::get('area_'.$_POST['pid']);
    	if(!$area){
     		$area = DB::table('rc_district')->field('district_id,district')->where('pid',$_POST['pid'])->select();   
     		Cache::set('area_'.$_POST['pid'],$area); 		
    	}

    	//dump($area);
        return $area;
    	//echo json_encode($area);

    }








}
