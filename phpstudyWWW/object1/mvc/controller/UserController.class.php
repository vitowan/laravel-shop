<?php
class UserController{

	function register(){

		//MVCFunction::V('Index')->register();
		$smarty=MVCFunction::S();
		$smarty->display('register.html');

	}

	function insert(){

		$aff=MVCFunction::M('Index')->insert();
		if($aff){
            echo "<script>alert('注册成功！！！');location.href='index.php?c=user&m=login';</script>";
        }
        else
        {
            echo "<script>alert('注册失败！！！');location.href='index.php';</script>";
        }

	}

	function login(){

		//MVCFunction::V('Index')->login();
		$smarty=MVCFunction::S();
		$smarty->display('login.html');

	}
	function wel(){

		MVCFunction::M('Index')->login();

	}
/*
	function welcome(){

		MVCFunction::V('Index')->welcome();

	}*/

	function login1(){
		MVCFunction::M('Index')->login1();
	}



}







?>