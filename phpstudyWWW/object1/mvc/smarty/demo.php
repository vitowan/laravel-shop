<?php
include 'libs/Smarty.class.php';
$smarty=new Smarty();
$smarty->setTemplateDir('./tpl');
$smarty->setCompileDir('./com');
$smarty->left_delimiter='<{';
$smarty->right_delimiter='}>';

//$con='hello 世界';
//$smarty->assign('c',$con);


$smarty->assign('var','hihihihihihi');
//注册变量修改器在html页面调用   一共三个参数   1、修改器类型  2、  修改器名字   3、函数
$smarty->registerPlugin('modifier','func','test');
/*function test($var,$color='#f00',$size='5'){
	return "<font color='$color' size='$size'>$var</font>";

}*/
function test(){
	return 'php';
}


//注册一个函数，在html页面调用
$smarty->registerPlugin('function','fund','test1');
function test1($args,$smarty){
	//return "<font color='$args[color]' size='$args[size]'>$args[content]</font>";
	return "$args[a], $args[b], $args[c]";
}

//注册一个块函数，在html页面调用
$smarty->registerPlugin('block','fune','test3');
function test3($arr,$content,$smarty)
{
    //return "<font color='$args[color]' size='$args[size]'>$content</font>";
    return "$arr[f], $content";

}



$smarty->assign('arr',array(11,22,33,44));

$smarty->display('demo.html');




?>