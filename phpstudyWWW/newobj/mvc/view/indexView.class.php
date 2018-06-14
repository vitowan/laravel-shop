<?php
class indexView{
	function index(){
		echo '这是indexView的index方法';
	}

	function select(){
		echo "<table width='500px' border='1'>
			<tr>
			<th>ID</th>
			<th>标题</th>
			<th>简介</th>
			<th>时间</th>
			<th>操作</th>
			</tr>";
			$query=$GLOBALS['db']->getSelect('nav','*');
			while($result=mysqli_fetch_assoc($query)){
				echo "<tr>
						<td> {$result['id']}</td>
						<td>{$result['title']}</td>
						<td>{$result['intro']}</td>
						<td>{$result['date']}</td>
						<td><a href='index.php?c=index&m=update&id={$result['id']}'>修改</a> | 
						<a href='index.php?c=index&m=delete&id={$result['id']}'>删除</a></td>
					</tr>";
			}

		echo "</table>";
		echo "<br>";
		echo "<a href='index.php?c=index&m=add'>添加信息</a>";
	}

	function add(){
		echo "<form action='index.php?c=index&m=insert' method='POST'>
			标题：<input type='text' name='title'>
			简介：<input type='text' name='intro'>
			<input type='submit' value='添加'>
			
			</form>";
	}

	function update($result){
		echo "<form action='index.php?c=index&m=update1' method='POST'>
			标题：<input type='text' name='title' value={$result['title']}>
			简介：<input type='text' name='intro' value={$result['intro']}>
			<input type='hidden' name='id' value={$result['id']}>
			<input type='submit' value='确定修改'>
			
			</form>";
	}

	function register(){
		echo "<form action='index.php?c=user&m=insert' method='POST'>
			用户名：<input type='text' name='user'>
			密码：<input type='text' name='password'>
			<input type='submit' value='注册'>
			
			</form>";
	}

	function login(){
		echo "<form action='index.php?c=user&m=wel' method='POST'>
			用户名：<input type='text' name='user'>
			密码：<input type='text' name='password'>
			<input type='submit' value='登录'>
			
			</form>";
	}

	function welcome(){
		echo '欢迎来到我的世界';
	}



}




?>