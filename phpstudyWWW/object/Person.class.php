<?php
header('Content-type:text/html;charset=utf-8');
class Person{
	public $name='tom';
	public $age=18;
	public $height=170;
	function say(){
		$n='name';
		echo 'hello world'."<br>";
		echo "{$this->$n} 说，我的年龄$this->age,我的身高$this->height 。";
	}

	function eat(){
		echo "<br>";
		echo " {$this->name} 说，$this->name 在吃饭了 。";
	}
}
$user= new Person();
echo $user->name;
echo '<br>';
$user->name='bruce';
echo $user->name;
echo '<br>';
$user->say();
$user->eat();







?>