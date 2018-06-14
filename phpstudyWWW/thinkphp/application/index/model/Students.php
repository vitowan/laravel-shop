<?php
namespace app\index\model;
use think\Model;
class Students extends Model{

	function setPasswordAttr($value){
		return md5($value);
	}

	function getSexAttr($value){
		if($value=='man'){
			return '男';

		}else{
			return '女';
		}
	}
}







?>