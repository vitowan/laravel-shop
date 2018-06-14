<?php
header('Content-type:text/html;charset=utf-8');
abstract class Person{
	public $name;
	public $age;
	static $height=170;
	function __construct($n,$a){
		$this->name=$n;
		$this->age=$a;
	}
	abstract function eat();
	function sleep(){
		echo "我在睡觉";
	}
}


class Son extends Person{
	function eat(){
		echo "我在吃饭";
	}

}

echo Person::$height;
$p=new Son('li',20);
$p->eat();
$p->sleep();
echo $p->name;


?>