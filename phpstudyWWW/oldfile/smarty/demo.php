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
//注册变量修改器
$smarty->registerPlugin('modifier','func','test');
/*function test($var,$color='#f00',$size='5'){
	return "<font color='$color' size='$size'>$var</font>";

}*/
function test(){
	return 'php';
}



$smarty->registerPlugin('function','fund','test1');
function test1($args,$smarty){
	//return "<font color='$args[color]' size='$args[size]'>$args[content]</font>";
	return "$args[a], $args[b], $args[c]";
}


$smarty->registerPlugin('block','fune','test3');
function test3($arr,$content,$smarty)
{
    //return "<font color='$args[color]' size='$args[size]'>$content</font>";
    return "$arr[f], $content";

}



$smarty->display('demo.html');




?>