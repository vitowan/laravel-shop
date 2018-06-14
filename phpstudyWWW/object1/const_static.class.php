<?php

class A {
 
    const c = 9;
    public static $b = 5;
 
    public function setst ($ca) {
        self::$b = $ca;
    }
}
 
$obj = new A;
//echo $obj->c;//出错，是类的属性，不是对象的属性
//echo $obj->$b;//出错，是类的属性，不是对象的属性
echo $obj::c;//ok，
echo A::c;//ok
echo $obj::$b;//ok
echo A::$b;//ok
$obj->setst(100);//更改静态变量的值
echo $obj::$b;//更改成功
 


/*结论：
　　静态变量和常量都是类的属性，类的属性都用双冒号访问(::),通过对象或者类名都可以访问。
　　常量是不可变的，静态变量可以通过self来赋值改变。内部访问常量或静态变量都是用self::

静态变量必须带$符号，访问也必须带，静态static不用带
　　const常量：类的不变属性

　　static变量：类的可变属性

*/


/*
1、const是一个语言结构；而define是一个函数，可以通过第三个参数来指定是否区分大小写。true表示大小写不敏感，默认为false

define('PI', 3.14, true);

2、const简单易读，编译时要比define快很多。

3、const可用在类的属性中，用于类成员常量定义，不可用到类的方法中，但可通过外部文件引入到类的方法中，定义后不可修改；define不能用于类成员常量定义，可以用到类的方法中，可用于全局变量

4、const是在编译时定义，因此必须处于最顶端的作用区域，不能在函数，循环及if条件中使用；而define是函数，也就是能调用函数的地方都可以使用
if (...){
const FOO = 'BAR';    // 无效的invalid
}
if (...) {
define('FOO', 'BAR'); // 有效的valid
}

5、const只能用普通的常量名，define常量名中可以有表达式

const  FOO = 'BAR';
for ($i = 0; $i < 32; ++$i) {
define('BIT_' . $i, 1 << $i);
}

6、const定义的常量只能是静态常量，define可以是任意表达式

const BIT_5 = 1 << 5;    // valid since PHP 5.6
define('BIT_5', 1 << 5); // 有效的valid


*/





?>







