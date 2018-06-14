<?php
/* Smarty version 3.1.30, created on 2018-02-25 23:02:23
  from "E:\WWW\object1\mvc\smarty\tpl\demo.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a92cfff90dde7_35139774',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0c8ee1817f523c4d3b286321bd8a9d06b91199d4' => 
    array (
      0 => 'E:\\WWW\\object1\\mvc\\smarty\\tpl\\demo.html',
      1 => 1519570883,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a92cfff90dde7_35139774 (Smarty_Internal_Template $_smarty_tpl) {
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
	<!-- 调用不带参数的变量修改器函数 -->
	<?php echo test($_smarty_tpl->tpl_vars['var']->value);?>

	<br>
	<!-- 调用带参数的变量修改器函数 -->
	<?php echo test($_smarty_tpl->tpl_vars['var']->value,'#ff0','7');?>

	<br>

<!-- 调用函数 -->
	<?php echo test1(array('a'=>'1','b'=>'2','c'=>'3'),$_smarty_tpl);?>

	<br>
<!-- 调用块函数 -->
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

	<br>

<!-- smarty模板在html中定义变量的几种方式 -->
<?php $_smarty_tpl->_assignInScope('m', 11);
?>

<?php echo $_smarty_tpl->tpl_vars['m']->value;?>


<?php $_smarty_tpl->_assignInScope('m', 11);
echo $_smarty_tpl->tpl_vars['m']->value;?>


<?php $_smarty_tpl->_assignInScope('m', 11);
echo $_smarty_tpl->tpl_vars['m']->value;?>

	<br>
<!-- smarty里面写if语句 -->
<!-- 
	Eq:等于号
	Gt:大于号
	Lt：小于号
	Ne：不等于
	Ge：大于等于
	Le：小于等于	

 -->
<?php $_smarty_tpl->_assignInScope('var', 12);
if ($_smarty_tpl->tpl_vars['var']->value < 10) {?>
变量小于10
<?php } else { ?>
变量大于10
<?php }?>

<!-- smarty里面写for循环 -->
<ul>
<?php
$_smarty_tpl->tpl_vars['var'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['var']->step = 1;$_smarty_tpl->tpl_vars['var']->total = (int) ceil(($_smarty_tpl->tpl_vars['var']->step > 0 ? 10+1 - (0) : 0-(10)+1)/abs($_smarty_tpl->tpl_vars['var']->step));
if ($_smarty_tpl->tpl_vars['var']->total > 0) {
for ($_smarty_tpl->tpl_vars['var']->value = 0, $_smarty_tpl->tpl_vars['var']->iteration = 1;$_smarty_tpl->tpl_vars['var']->iteration <= $_smarty_tpl->tpl_vars['var']->total;$_smarty_tpl->tpl_vars['var']->value += $_smarty_tpl->tpl_vars['var']->step, $_smarty_tpl->tpl_vars['var']->iteration++) {
$_smarty_tpl->tpl_vars['var']->first = $_smarty_tpl->tpl_vars['var']->iteration == 1;$_smarty_tpl->tpl_vars['var']->last = $_smarty_tpl->tpl_vars['var']->iteration == $_smarty_tpl->tpl_vars['var']->total;?>
<li><?php echo $_smarty_tpl->tpl_vars['var']->value;?>
</li>
<?php }
}
?>

</ul>

<!-- smarty里面写foreach循环遍历 -->
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arr']->value, 'v', false, 'k');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
?>
	<?php echo $_smarty_tpl->tpl_vars['v']->value;?>


	<?php echo $_smarty_tpl->tpl_vars['k']->value;?>


<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>


</body>
</html><?php }
}
