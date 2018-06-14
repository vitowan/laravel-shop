<?php
namespace app\index\model;
use think\Model;

class Nav extends Model{
	function getBannerAttr($value){
		return str_replace('..','/jin_tp/public/static',$value);
	}
}






?>