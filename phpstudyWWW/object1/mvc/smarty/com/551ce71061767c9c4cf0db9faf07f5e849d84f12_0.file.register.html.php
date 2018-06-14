<?php
/* Smarty version 3.1.30, created on 2018-02-26 20:13:27
  from "E:\WWW\object1\mvc\view\register.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a93f9e7a99c19_67999145',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '551ce71061767c9c4cf0db9faf07f5e849d84f12' => 
    array (
      0 => 'E:\\WWW\\object1\\mvc\\view\\register.html',
      1 => 1519647205,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a93f9e7a99c19_67999145 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form action='index.php?c=user&m=insert' method='POST'>
	    用户名： <input type='text' name='user' placeholder='填写用户名' id='user'><span id='span'></span><br><br>
   		密码： <input type='text' name='password' placeholder='填写密码'><br><br>
   		<input type='submit' value='注册'> &nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php?c=user&m=login">有账号点我登录</a>
	</form>
</body>
</html>

<?php echo '<script'; ?>
>
	var user= document.getElementById('user');
	user.onblur=function(){
		var span=document.getElementById('span');
		var value=user.value;
		//alert(value);
		var str='user_reg='+value;

		if (window.ActiveXObject) {
            xhr = new ActiveXObject('microsoft');
        }
        else {
            xhr = new XMLHttpRequest();
        }

        xhr.open('post','ajax.php',true);
        xhr.setRequestHeader('content-type','application/x-www-form-urlencoded');
        xhr.onreadystatechange=function(){
        	if(xhr.readyState==4 && xhr.status==200){
        		span.innerHTML=xhr.responseText;

        	}
        }

        xhr.send(str);
    }
<?php echo '</script'; ?>
><?php }
}
