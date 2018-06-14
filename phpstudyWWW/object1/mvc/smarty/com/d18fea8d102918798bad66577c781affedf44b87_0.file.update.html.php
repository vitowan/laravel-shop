<?php
/* Smarty version 3.1.30, created on 2018-02-25 21:39:31
  from "E:\WWW\object1\mvc\view\update.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a92bc9372fc82_40096617',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd18fea8d102918798bad66577c781affedf44b87' => 
    array (
      0 => 'E:\\WWW\\object1\\mvc\\view\\update.html',
      1 => 1519565541,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a92bc9372fc82_40096617 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form method='post' action='index.php?c=index&m=update1'>
   		标题： <input type='text' name='title' value= <?php echo $_smarty_tpl->tpl_vars['arr']->value['title'];?>
 >
   		简介： <input type='text' name='intro' value= <?php echo $_smarty_tpl->tpl_vars['arr']->value['intro'];?>
 >
		<input type='hidden' name='id' value= <?php echo $_smarty_tpl->tpl_vars['arr']->value['id'];?>
 >
   		<input type='submit' value='修改'>
    <form>
</body>
</html><?php }
}
