<?php
/* Smarty version 3.1.30, created on 2018-02-28 23:37:53
  from "E:\WWW\object1\mvc\view\index.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a96ccd1d04d62_80359344',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9527d03d50e416c841c2943b81d11367d322e9bb' => 
    array (
      0 => 'E:\\WWW\\object1\\mvc\\view\\index.html',
      1 => 1519710676,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a96ccd1d04d62_80359344 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>后台展示页面</title>
</head>
<body>
	


<table width='800px' border='1px' cellspacing='0' align='center'>
	<tr>
		<th>ID</th>
		<th>标题</th>
		<th>简介</th>
		<th>时间</th>
		<th>操作</th>
	</tr>
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arr1']->value, 'v');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['v']->value) {
?>
	<tr>
		<td><?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['v']->value['title'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['v']->value['intro'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['v']->value['date'];?>
</td>
<!--  		<td><a href='index.php?c=index&m=delete&id=<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
'>删除</a> | <a href='index.php?c=index&m=update&id=<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
'>修改</a></td>  -->
		<td><input type="button" value='删除' onclick=del() index="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
"> | <a href='index.php?c=index&m=update&id=<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
'> 修改 </a></td>
	</tr>
	<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>




</table>
<a href='index.php?c=index&m=add'>添加添加添加添加添加添加添加添加添加</a>


</body>
</html>
<?php echo '<script'; ?>
>
	 //btn=document.getElementById('btn');
	

	function del(){
		alert(getAttribute('index'));
		//var sid=btn.index;
		//alert(sid);
/*		if(window.ActiveXObject){
			xhr=new ActiveXObject('microsoft');
		}else{
			xhr=new XMLHttpRequest();
		}
		xhr.open('get','ajax.php',true);

		xhr.onreadystatechange=function(){
			if(xhr.readyState==4 && xhr.status==200){
				alert(xhr.responseText);
			}
		}

		xhr.send(null);

*/





	}
<?php echo '</script'; ?>
>
<?php }
}
