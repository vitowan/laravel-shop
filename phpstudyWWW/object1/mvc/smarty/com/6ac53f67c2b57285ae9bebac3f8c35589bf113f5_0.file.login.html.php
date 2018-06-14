<?php
/* Smarty version 3.1.30, created on 2018-02-27 10:28:08
  from "E:\WWW\object1\mvc\view\login.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a94c23834e391_35552811',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6ac53f67c2b57285ae9bebac3f8c35589bf113f5' => 
    array (
      0 => 'E:\\WWW\\object1\\mvc\\view\\login.html',
      1 => 1519698131,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a94c23834e391_35552811 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>

    用户名： <input type='text' name='user' placeholder='填写用户名'><br><br>
	密码： <input type='text' name='password' placeholder='填写密码'><br><br>
	<input type='submit' value='登录' onclick="log()">

</body>
</html>
<?php echo '<script'; ?>
>
    function log() {
        var txt = document.getElementById('txt').value;
        var pass = document.getElementById('pass').value;
        var strPoat = 'user='+txt+'&password='+pass;
        //alert(strPoat);
        var xhr = null;
        if (window.ActiveXObject) {
            xhr = new ActiveXObject('microsoft');
        }
        else {
            xhr = new XMLHttpRequest();
        }

        xhr.open('post','index.php?c=user&m=login1');

        //get请求中直接发送就可以了   但是post请求中  需要一个头文件
        xhr.setRequestHeader('content-type','application/x-www-form-urlencoded');

        xhr.onreadystatechange = function()
        {
            if (xhr.readyState == 4 && xhr.status == 200)
            {
                alert(xhr.responseText);

            }
        }

        //发送一个ajax请求  传入的是表单中的值
        xhr.send(strPoat);
    }

    
<?php echo '</script'; ?>
><?php }
}
