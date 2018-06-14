<?php
header('Content-type:text/html;charset=utf-8');
class Person{
	public $name;
	public $age;
	private $tel;
	function __construct($n,$a,$tel){
		$this->name=$n;
		$this->age=$a;
		$this->tel=$tel;
		//return $this;
	}
	function say(){
		//echo "$this->name 说 $this->age 了，世界和平，死了都要爱 {$this->tel}";
		return $this->show();
	}
	private function show(){
		return $this->name;
	}

}

$p= new Person('li',20,111);
//echo $p->name;
//echo $p->age;
//var_dump($p->__construct('li',20)) ;
echo $p->say();
//echo $p->name;






?>