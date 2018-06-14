<?php
/* Smarty version 3.1.30, created on 2018-02-25 18:20:19
  from "E:\WWW\smarty\tpl\demo.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a928de3ed8463_54951728',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '00c859c6a371a1970b0e7eddc0f18a9c3c601ac9' => 
    array (
      0 => 'E:\\WWW\\smarty\\tpl\\demo.html',
      1 => 1519553794,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a928de3ed8463_54951728 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<!-- 	{$c}
{$c}
 -->
	<br>
	<?php echo test($_smarty_tpl->tpl_vars['var']->value);?>

	<br>
	<?php echo test($_smarty_tpl->tpl_vars['var']->value,'#ff0','7');?>

	<br>

	<?php echo test1(array('a'=>'1','b'=>'2','c'=>'3'),$_smarty_tpl);?>

	<br>

	<?php $_block_plugin1 = isset($_smarty_tpl->smarty->registered_plugins['block']['fune'][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fune'][0] : null;
if (!is_callable($_block_plugin1)) {
throw new SmartyException('block tag \'fune\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fune', array('f'=>'11111'));
$_block_repeat1=true;
echo $_block_plugin1(array('f'=>'11111'), null, $_smarty_tpl, $_block_repeat1);
while ($_block_repeat1) {
ob_start();
?>

		66666
	<?php $_block_repeat1=false;
echo $_block_plugin1(array('f'=>'11111'), ob_get_clean(), $_smarty_tpl, $_block_repeat1);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>



</body>
</html><?php }
}
