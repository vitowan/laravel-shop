<?php
abstract class Father{
	public $num1;
	public $num2;
	function __construct($n1,$n2){
		$this->num1=$n1;
		$this->num2=$n2;
	}
	abstract function result();
}
class Add extends Father{
	function result(){
		return $this->num1+$this->num2;
	}
}
class Sub extends Father{
	function result(){
		return $this->num1-$this->num2;
	}
}
class Mul extends Father{
	function result(){
		return $this->num1*$this->num2;
	}
}
class Div extends Father{
	function result(){
		return $this->num1/$this->num2;
	}
}
//$sum=new Add(6,2);
//$sum=new Sub(6,2);
//$sum=new Mul(6,2);
//$sum=new Div(6,2);

echo $sum->result();









?>