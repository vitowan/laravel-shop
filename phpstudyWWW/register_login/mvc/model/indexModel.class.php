<?php
class indexModel{
	function index(){
		echo '这是indexModel的index方法';
	}

	function delete(){
		echo $_GET['id'];
		return $result=$GLOBALS['db']->getDelete('nav',array('id'=> $_GET['id']));
	}

	function insert(){
		//print_r($_POST);
		return $result=$GLOBALS['db']->getInsert('nav',$_POST);
	}

	function update(){
		$query=$GLOBALS['db']->getSelect1('nav','*',array('id'=>$_GET['id']));
		$result=mysqli_fetch_assoc($query);
		//echo $result['title'];
		MVCFunction::V('index')->update($result);
	}

	function update1(){
		//print_r($_POST);
		return $result=$GLOBALS['db']->getUpdate('nav',$_POST);
	}

	function insert1(){
		//print_r($_POST);
		return $result=$GLOBALS['db']->getInsert('user',$_POST);
	}



}




?>