<?php
class User{
	private $link;

    public function __construct(){
        include 'config.php';

        $this->link = mysqli_connect(HOST,USER,PASSWORD,DB) or die('连接数据库失败！！！');

        mysqli_query($this->link,'set names utf8');
    }

	function Login(){
		
	if(isset($_POST['user'])){
		$user=$_POST['user'];
		$pass=$_POST['password'];

		$sql="select * from `staff` where `user`='$user'";
		$query=mysqli_query($link,$sql);

		$assoc=mysqli_fetch_assoc($query);

		if($pass==$assoc['password']){
			echo "<script>alert('登录成功');location.href='home.php'</script>";
		}else{
			echo "<script>alert('登录失败');location.href='login.php'</script>";
		}


	}

}



}
$U=new User();
$U->login();








?>