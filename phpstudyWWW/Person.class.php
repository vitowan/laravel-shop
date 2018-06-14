<?php
header("content-type:text/html;charset=utf-8");
//********person；类定义
//文件名与类名相同 Person.class.php
//类名每个单词的首字母必须大写，是最为严格的驼峰式写法
//驼峰式：personAction 严格的驼峰式写法：PersonAction
/*class Person{
	public $name='user1';
	public $age=20;
	public $sex='man';
	function say(){
		$n='name';
		echo "hello wrold,my name is {$this -> $n},my age is{$this->age}";//前者带个变量必须加{}，后者是调用属性可加可不加
	}
}
$user=new Person();
$user->say();
//调用属性前面不能加$
echo $user->age;
echo $user->sex;

*/





//***********构造函数
/*class Person{
	public $name;
	public $age;
	public $sex;
	//构造方法，方便传参调用 2个下划线
	function __construct($n,$a,$s){
		$this->name=$n;
		$this->age=$a;
		$this->sex=$s;
	}
	//方法
	function say(){
		$n='name';
		echo "您好，{$this->$n},{$this->age}";
	}

	//析构方法，释放资源
	function __destruct(){
		echo "我是 {$this->name}";
	}
}

$user=new Person('user1',20,'nv');
$user->say();
*/




//***************类的对象链
/*class Person{
	public $name;
	function __construct($user){
		$this->name=$user;
	}
	function say(){
		echo "我";
		return $this;
	}
	function eat(){
		echo "你";
		return $this;
	}
	function sleep(){
		echo "它";
	}
	function __destruct(){
		echo "释放了";		
	}

}
$use=new person('user1');
$use->say();
$use->eat();
$use->sleep();
$use->say()->eat()->sleep();*/

/*封装
public
private
protected

*/




//::的使用，只能用在方法上 方法里面没$this就不能用此法
/*class Person{
	public $name;

	function __construct($n){
		$this->name=$n;
	}
	function say($n){
		echo $n;
	}
}
//$user=new Person();
//$user->say();
//echo $user->age;
//echo $user->sex;
//Person::say('我');
*/





//**********继承 extends，例子中 it继承了person 父子关系
/*class Person{
	public $name;

	function __construct($n){
		$this->name=$n;
	}
	function say(){
		echo '啊啊啊啊';
	}
}

class it extends Person{
	//public $name;
	public $program;

	function __construct($n,$p){
		//$this->name=$n;
		parent::__construct($n);//替换上面一行父元素中重复的，parent也可以用到方法中，写法一样
		$this->program=$p;
	}
	//function say(){
		//echo $this->name;
	//}
	function develop(){
		echo "我在开发";
	}
}

$it=new it("小李","开发");
echo $it->name;
$it->say();
$it->develop();
*/




//封装
//public 内外都可使用（本类，子类，外面都能用）
//private 隐私内外都不能用（只能用在本类里面）
//protected 受保护的属性 子元素内部能用，然后外部再调用子元素的（能用在本类和子类里面）

?>