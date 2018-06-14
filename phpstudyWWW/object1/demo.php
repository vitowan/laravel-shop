<?php
header('content-type:text/html;charset=utf-8');
class Person{

	function __toString(){
		return "不能打印对象";
	}

	function __call($name,$arguments){
		echo "世界和平 $name" .print_r($arguments);
	}
}

$p=new Person();
echo $p;
$p->eat('wan','20');
//


function __autoload($name){
	return include_once $name.'.php';
}
$a=new demo1();
$a->show1();






?>