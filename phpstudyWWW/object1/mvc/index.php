<?php
header('Content-type:text/html;charset=utf-8');
session_start();
/*
if(!isset($_SESSION['name'])){
	echo "<script>  location.href='index.php?c=user&m=register';</script>";
}*/
//echo getcwd();
define('ROOT',getcwd().'\\');
include ROOT.'DB.class.php';

$name = isset($_GET['c']) ? $_GET['c'] : 'index';
$method = isset($_GET['m']) ? $_GET['m'] : 'index';
//echo $name;
//echo ROOT;
//echo  ROOT.'controller/IndexController.class.php';
//include_once ROOT.'controller/IndexController.class.php';
include ROOT.'MVCFunction.class.php';
MVCFunction::C($name,$method);
//var_dump(MVCFunction::C($name,$method));

?>
