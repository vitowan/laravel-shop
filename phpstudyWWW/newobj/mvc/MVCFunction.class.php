<?php
class MVCFunction{
	static $obj;
	static function C($name,$method){
		include ROOT.'controller/'.$name.'Controller.class.php';
		$classname=$name.'Controller';
		self::$obj=new $classname();
		self::$obj->$method();

	}

	static function M($name){
		include ROOT.'model/'.$name.'Model.class.php';
		$classname=$name.'Model';
		self::$obj=new $classname();
		return self::$obj;
	}

	static function V($name){
		include ROOT.'view/'.$name.'View.class.php';
		$classname=$name.'View';
		self::$obj=new $classname();
		return self::$obj;
	}



}





?>