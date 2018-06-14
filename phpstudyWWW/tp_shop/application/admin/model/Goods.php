<?php
namespace app\admin\model;

class Goods extends \think\Model{
	function getGoodsStatusAttr($value){
		$goods_status=[1=>'上架',0=>'下架'];
		return $goods_status[$value];
	}

	function getGoodsPidAttr($value){
		$cate=new \app\admin\model\Cate();
		$result1=$cate::get($value);
		$result2=$cate::get($result1['pid']);
		$result3=$cate::get($result2['pid']);
		$a=$result1['name'];
		$b=$result2['name'];
		$c=$result3['name'];


		return $c." &gt;&gt; ".$b." &gt;&gt; ".$a;
	}




}




?>