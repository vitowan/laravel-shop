<?php
header('Content-type:text/html;charset=utf-8');

/*function connect($host,$user,$password,$db}){
	$link=mysqli_connect($host,$user,$password) or die('未连接到数据库');

	mysqli_query($link,"set names utf8");

}*/
 class Connect{
 	public $host;
 	public $user;
 	public $password;
 	public $db;
 	function __construct($h,$u,$p,$d){
 		$this->host=$h;
 		$this->user=$u;
 		$this->password=$p;
 		$this->db=$d;
 	}
 	function con(){
 		$this->link=mysqli_connect($this->host,$this->user,$this->password,$this->db) or die('未连接到数据库');
 		mysqli_query($this->link,'set names utf8');
 		echo "连接成功了";
 	}
 	function close(){//关闭数据库
 		mysqli_close($this->link);
 	}

 	function delete($table,$condition){//删除
 		mysqli_query($this->link,"delete from $table $condition ");
 		if(mysqli_affected_rows($this->link)){
 			echo '删除成功';
 		}
 	}
 	function update($table,$condition){//修改
 		mysqli_query($this->link,"update $table $condition ");
 		if(mysqli_affected_rows($this->link)){
 			echo '修改成功';
 		}
 	}
 	 function insert($sql){//插入
 		mysqli_query($this->link,$sql);
 		if(mysqli_affected_rows($this->link)){
 			echo '插入成功';
 		}
 	}

 }


$con=new Connect('localhost','root','root','demo');
//$con->con();
//$con->delete('user','where id=111125');
//$con->update('user','set user= 9990 where id=1' );
//$con->insert('insert into user values(null,13,13)');


?>