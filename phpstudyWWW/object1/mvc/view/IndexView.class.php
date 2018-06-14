<?php

class IndexView{
	function index(){
		//echo "我在view视图里面";

	}
	function add(){
		//echo "我在view视图里面";
/*	if(!isset($_SESSION['name'])){
		echo "<script>  location.href='index.php?c=user&m=register';</script>";
		}*/
/*	echo "<form method='post' action='index.php?c=index&m=insert'>
       		标题： <input type='text' name='title'>
       		简介： <input type='text' name='intro'>
       		<input type='submit' value='添加'>
        <form>";*/
	    //MVCFunction::S();
		//$GLOBALS['smarty']->assign('arr',$result);
		//$GLOBALS['smarty']->display('add.html');


	}
	function update($result){
/*		if(!isset($_SESSION['name'])){
		echo "<script>  location.href='index.php?c=user&m=register';</script>";
		}*/
/*	echo "<form method='post' action='index.php?c=index&m=update1'>
       		标题： <input type='text' name='title' value= {$result['title']} >
       		简介： <input type='text' name='intro' value= {$result['intro']} >
			<input type='hidden' name='id' value= {$result['id']} >
       		<input type='submit' value='修改'>
        <form>";*/

/*	    MVCFunction::S();
		$GLOBALS['smarty']->assign('arr',$result);
		$GLOBALS['smarty']->display('update.html');*/
	}





	function register(){

/*	echo "<form action='index.php?c=user&m=insert' method='POST'>
		    用户名： <input type='text' name='user' placeholder='填写用户名'><br><br>
	   		密码： <input type='text' name='password' placeholder='填写密码'><br><br>
	   		<input type='submit' value='注册'>
	   	</form>";*/

/*	   	MVCFunction::S();
		$GLOBALS['smarty']->display('register.html');*/

	}

	function login(){
/*
	echo "<form action='index.php?c=user&m=wel' method='POST'>
		    用户名： <input type='text' name='user' placeholder='填写用户名'><br><br>
	   		密码： <input type='text' name='password' placeholder='填写密码'><br><br>
	   		<input type='submit' value='登录'>
	   	</form>";*/
/*	   	MVCFunction::S();
		$GLOBALS['smarty']->display('login.html');*/
	}


/*	function welcome(){
		//var_dump($_SESSION);
		if(!isset($_SESSION['name'])){
		echo "<script>  location.href='index.php?c=user&m=register';</script>";
		}
		//echo "hi {$_SESSION['name']}  欢迎来到我的世界";
		echo "<script>  location.href='index.php';</script>";

	}
*/


}












?>