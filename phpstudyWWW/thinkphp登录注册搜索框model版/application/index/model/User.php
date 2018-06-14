<?php
namespace app\index\model;
use think\Model;
class User extends Model{
	function setPasswordAttr($value){
		return md5($value);
	}
}




?>