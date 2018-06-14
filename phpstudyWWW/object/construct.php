<?php
header('Content-type:text/html;charset=utf-8');
class Person{
	public $name;
	public $age;
	function __construct($n,$a){
		$this->name=$n;
		$this->age=$a;
		//return $this;
		echo $n;

	}
	function say($i){
		echo "$this->name 说 $this->age 了，世界和平，{$i}死了都要爱";
		//return $this;
	}
	function __destruct(){

		echo "世界和平，注销了{$this->name}";
		echo "<br>";
	}

}
$user1=new Person('li',20);
$user2=new Person('li1',20);
$user3=new Person('li2',20);
$user1->say(1);
//$user2->say(1);
//$user3->say(1);
//echo $user->say('wang');
//echo "<br>";
//var_dump($user);

//echo $user->say('wang');
//echo "<br>";






?>