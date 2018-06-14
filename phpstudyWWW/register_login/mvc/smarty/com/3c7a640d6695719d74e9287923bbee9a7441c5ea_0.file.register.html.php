<?php
/* Smarty version 3.1.30, created on 2018-03-09 10:30:43
  from "E:\phpStudy\WWW\register_login\mvc\view\register.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5aa26253a46e74_25411676',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3c7a640d6695719d74e9287923bbee9a7441c5ea' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\register_login\\mvc\\view\\register.html',
      1 => 1520000087,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5aa26253a46e74_25411676 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>注册</title>
	<style>
		input{
			margin-top:20px;
		}
	</style>
</head>
<body>
	<div>
		账号：<input type="text"><br>
		密码：<input type="password"><br>
		确认密码：<input type="password"><br>
		邮箱：<input type="text"><br>
		电话：<input type="text"><br>
		QQ：<input type="text"><br>
		请输入验证码：<input type="text"> <img src="" alt=""><br>
		<input type="button" value='确认注册'> <a href="">点我登录</a>
	</div>

</body>
</html><?php }
}
