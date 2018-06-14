<?php
header('Content-type:text/html;charset=utf-8');
class Person{
	public $name;
	public $age;
	public $tel;
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

class Son extends Person{
	public $height;
	function __construct($n,$a,$tel,$hei){
		parent::__construct($n,$a,$tel);
		$this->height=$hei;
	}
	function say(){

	}
}
//$p= new Person('li',20,111);

$p=new Son('tom',20,110,120);
echo $p->name;
echo $p->age;
echo $p->tel;
echo $p->height;
//echo $p->height;












?>