<?php
namespace app\index\model;
use think\Model;

class User extends Model{
	function setPasswordAttr($value){
		return md5($value);
	}

	function setPositionAttr($value){
		if($value==1){
			return '人事部';
		}else if($value==2){
			return '市场部';
		}else if($value==3){
			return '行政';
		}else if($value==4){
			return '技术部';
		}
	}

	function setDepartmentAttr($value){
		if($value==1){
			return '部门经理';
		}else if($value==2){
			return '专员';
		}
	}
}









?>