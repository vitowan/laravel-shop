<?php
namespace app\index\model;

class Cate extends \think\Model{

//无限极分类得到一个大数组,之后在前台调用
	function cate_list($data,$pid=0){
		$arr=[];
		foreach($data as $k=>$v){
			if($v['pid']==$pid){
				$v['children']=$this->cate_list($data,$v['id']);
				$arr[]=$v;

			}

		}
		return $arr;
	}



}




?>