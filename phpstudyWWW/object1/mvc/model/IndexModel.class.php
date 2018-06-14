<?php
// include ROOT.'DB.class.php';
class IndexModel{
	function index(){
		$query=$GLOBALS['db']->getSelect('nav','*');
		//var_dump($query);
//var_dump($GLOBALS['db']);
		if(!isset($_SESSION['name'])){
		echo "<script>  location.href='index.php?c=user&m=register';</script>";
		}
		
		while($result=mysqli_fetch_assoc($query)){
			$arr[]=$result;
			//var_dump($result);
		}
		//var_dump($arr);
		$smarty=MVCFunction::S();
		$smarty->assign('arr1',$arr);
		$smarty->display('index.html');


/*
		echo "<table width='800px' border='1px' cellspacing='0' align='center'>
			<tr>
				<th>ID</th>
				<th>标题</th>
				<th>简介</th>
				<th>时间</th>
				<th>操作</th>
			</tr>";

		while($result=mysqli_fetch_assoc($query)){
			echo "<tr>
					<td> {$result['id']} </td>
					<td>{$result['title']}</td>
					<td>{$result['intro']}</td>
					<td>{$result['date']}</td>
					<td><a href='index.php?c=index&m=delete&id={$result['id']}'>删除</a> | <a href='index.php?c=index&m=update&id={$result['id']}'>修改</a></td>
				</tr>";
		}

		echo "</table>";
		echo "<a href='index.php?c=index&m=add'>添加添加添加添加添加添加添加添加添加</a>";
*/
	}


	function add(){
		return $query=$GLOBALS['db']->getInsert('nav',$_POST);
	}

	function delete(){

		return $result=$GLOBALS['db']->getDelete('nav',array('id'=>$_GET['id']));
	}

	function update(){
//var_dump($_POST);
		return $result=$GLOBALS['db']->getUpdate('nav',$_POST);
	}

	function insert(){

		return $GLOBALS['db']->getInsert('user',$_POST);
	}

	function login(){

		if(isset($_POST['user'])){
			$user=$_POST['user'];
			//var_dump($user);
			$password=$_POST['password'];
			//var_dump($password);
			$query=$GLOBALS['db']->getSelect1('user','*',array('user'=>$user));
			$result=mysqli_fetch_assoc($query);
			//var_dump($result);
			//die;
			if($password==$result['password']){
				$_SESSION['name']=$user;
				//var_dump($_SESSION['name']);
				echo "<script>alert('登录成功！！！');location.href='index.php';</script>";
			}else{

           		echo "<script>alert('登录失败！！！');location.href='index.php?c=user&m=login';</script>";
       	 	}
		}

		
	}

	function login1(){
		if(isset($_POST['user'])){
			$user=$_POST['user'];
			//var_dump($user);
			$password=$_POST['password'];
			//var_dump($password);
			$query=$GLOBALS['db']->getSelect1('user','*',array('user'=>$user));
			$result=mysqli_fetch_assoc($query);
			//var_dump($result);
			//die;
			if($password==$result['password']){
				$_SESSION['name']=$user;
				//var_dump($_SESSION['name']);
				echo "<script>alert('登录成功！！！');location.href='index.php';</script>";
			}else{

           		echo "<script>alert('登录失败！！！');location.href='index.php?c=user&m=login';</script>";
       	 	}
		}
	}


}




?>