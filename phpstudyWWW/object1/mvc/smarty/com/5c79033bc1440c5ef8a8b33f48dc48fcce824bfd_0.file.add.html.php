<?php
/* Smarty version 3.1.30, created on 2018-02-25 21:40:39
  from "E:\WWW\object1\mvc\view\add.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a92bcd7762236_39620012',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5c79033bc1440c5ef8a8b33f48dc48fcce824bfd' => 
    array (
      0 => 'E:\\WWW\\object1\\mvc\\view\\add.html',
      1 => 1519565995,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a92bcd7762236_39620012 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form method='post' action='index.php?c=index&m=insert'>
   		标题： <input type='text' name='title'>
   		简介： <input type='text' name='intro'>
   		<input type='submit' value='添加'>
    <form>
</body>
</html><?php }
}
