<?php
class MVCFunction{
	static $obj;
	static function C($name,$method){
		include ROOT.'controller/'.$name.'Controller.class.php';
		$classname=$name.'Controller';
		self::$obj=new $classname();
		self::$obj->$method();
		//return self::$obj;
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

	static function S(){
		include ROOT.'smarty/libs/Smarty.class.php';
		self::$obj=new Smarty();
		self::$obj->setTemplateDir(ROOT.'view');

		self::$obj->setCompileDir(ROOT.'Smarty/com');

		self::$obj->left_delimiter='<{';
		self::$obj->right_delimiter='}>';
		return self::$obj;
	}

}





?>