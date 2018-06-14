	<?php
	include '../public/mysqli_connect.php';
/*	include('mysqli_connect.php');

	$user=isset($_POST['user'])?$_POST['user']:"";
	$password=isset($_POST['password'])?$_POST['password']:"";
	//var_dump($user,$password);
	$sql="select * from `user` where `user`='$user' and `password`='$password'";
	$query=mysqli_query($link,$sql);
	//select `password` from `user`;
	$assoc=mysqli_fetch_assoc($query);

	//echo "<pre>";
	//var_dump($assoc);
	if($assoc){
		echo "hi,$user 欢迎回来";

	}else{
		echo "滚犊子去";
	}
*/
	//var_dump($_SESSION);
//$name=$_SESSION['name'];
	
 echo " {$_SESSION['name']}, 回来了";


	?>