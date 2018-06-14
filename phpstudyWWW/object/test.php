<?php
header('content-type:text/html;charset=utf-8');
/*class Person{
	const sex='man';
	public $name;
	private $age;
	protected $height;

	function __construct($n,$a,$h){
		$this->name=$n;
		$this->age=$a;
		echo "我是构造函数 $this->name<br>" ;
		//echo self::sex;
	}
	function eat(){
		echo "$this->name 在吃饭，有$this->age 岁了";
	}
	function __destruct(){
		//echo " $this->name  说这是析构函数  ".self::sex;
	}

}


class Son extends Person{
	protected $weight;
	const sex='woman';
	function __construct($n,$a,$h,$w){
		parent::__construct($n,$a,$h);
		$this->weight=$w;
	}
}
//$user1=new Person('tom',18,170);
//$user->eat();
$user=new Son('tom',18,170,60);
echo $user->name;
echo "<br>";
$user->eat();
echo "<br>";
$user=new Son('tom',18,170,60);
echo $user::sex;

*/
$x=0;
$y=0;
if($x==0 || ++$y=$x++ ){
	++$x;
}
echo "x: $x ";
echo "y: $y ";



$x=0;
$y=0;
if($x==0 && ++$y=$x++ ){
	++$x;
}
echo "x: $x";
echo "y: $y";
?>


