<?php
class userController{

	function register(){
		MVCFunction::V('index')->register();
	}

	function insert(){
		$aff=MVCFunction::M('index')->insert1();
		if($aff){
			echo "<script>alert('注册成功了');location.href='index.php?c=user&m=login';</script>";
		}else{
			echo "<script>alert('注册失败了');location.href='index.php?c=user&m=register';</script>";

		}
	}

	function login(){
		MVCFunction::V('index')->login();
	}

	function wel(){
		MVCFunction::V('index')->welcome();
	}


}



?>