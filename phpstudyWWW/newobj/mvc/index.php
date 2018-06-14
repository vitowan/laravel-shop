<?php
header('content-type:text/html;charset=utf-8');

define('ROOT',getcwd().'\\');
//echo getcwd();
//echo ROOT;
include ROOT.'DB.class.php';

$name=isset($_GET['c'])?$_GET['c']:'index';
$method=isset($_GET['m'])?$_GET['m']:'index';
include ROOT.'MVCFunction.class.php';
//echo ROOT.'MVCFunction.class.php';
MVCFunction::C($name,$method);


?>