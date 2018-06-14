<?php
header('Content-type:text/html;charset=utf-8');
//定义一个绝对路径   项目路径
define('ROOT',getcwd().'\\');

/*include_once ROOT.'controller/IndexController.class.php';

include_once ROOT.'controller/ShowController.class.php';

$c = new IndexController();

$c = new ShowController();

$c->index();*/
//使用get方式接受控制器类
$name = isset($_GET['c']) ? $_GET['c'] : 'Index';
//使用get方式接受控制器类中的方法
$method = isset($_GET['m']) ? $_GET['m'] : 'index';
//引入控制器脚本
//include ROOT.'controller/'.$c.'Controller.class.php';
//获取类名
//$className = $c.'Controller';
//实例化控制器
//$controller = new $className();
//调用控制器中的方法
//$controller->$m();
//引入实例化MVC层级的类
include ROOT.'MVCFunction.class.php';

//调用控制器
MVCFunction::C($name,$method);
