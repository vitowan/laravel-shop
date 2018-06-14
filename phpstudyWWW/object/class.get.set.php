<?php

class Person{
	public $name;
	private $sex='man';
	public static $obj;
	static function show(){
		//echo __CLASS__;
		$classname = __CLASS__;
		if(empty(self::$obj)){
			self::$obj=new $classname();
		}
		return self::$obj;
	}
}

Person::show();
Person::show();
Person::show();





?>