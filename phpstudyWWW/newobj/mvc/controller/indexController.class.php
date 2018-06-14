<?php
class indexController{
	function index(){
		//echo '这是indexController的index方法';
		MVCFunction::V('index')->select();
	}

	function delete(){
		$aff=MVCFunction::M('index')->delete();
		if($aff){
			echo "<script>alert('删除成功了');location.href='index.php';</script>";
		}else{
			echo "<script>alert('删除失败了');location.href='index.php';</script>";

		}
	}

	function add(){
		MVCFunction::V('index')->add();
	}

	function insert(){
		$aff=MVCFunction::M('index')->insert();
		if($aff){
			echo "<script>alert('添加成功了');location.href='index.php';</script>";
		}else{
			echo "<script>alert('添加失败了');location.href='index.php';</script>";

		}
	}

	function update(){
		MVCFunction::M('index')->update();
	}

	function update1(){
		$aff=MVCFunction::M('index')->update1();
		if($aff){
			echo "<script>alert('修改成功了');location.href='index.php';</script>";
		}else{
			echo "<script>alert('修改失败了');location.href='index.php';</script>";

		}
	}





}









?>