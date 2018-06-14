<?php
header('Content-type:text/html;charset=utf-8');
//定义一个接口， 使用关键字interface
interface demo1{
	//接口内部只能出现常量和抽象方法
	const name='wan';
	const age=20;
	const sex='man';
	function say();
	static function eat();
}
//定义上面的一个子接口
interface demo2 extends demo1{
	function sleep();
}

//定义一个类
class show01{
	static function zou(){
		echo '快快快啊';
	}
	
}
//继承一个类，和实现2个接口，也可以只实现后面的一个或者多个接口，实现接口必须把接口里面的方法都覆写，如果继承的类是抽象类，里面的方法也必须覆写
class show1 extends show01 implements demo1,demo2{
	function say(){
		echo show1::name;
	}
	static function eat(){
		echo self::age;
	}
	function sleep(){

	}
}
show1::eat();//静态方法和属性可以这么写
show1::zou();
$show=new show1();
$show->say();
//$show->walk();
show1::zou();



?>