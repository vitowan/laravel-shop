<?php   
include 'home_header.php';
include 'public/mysqli_connect.php';

if(isset($_POST['title'])){

	$title=$_POST['title'];
	$intro=$_POST['intro'];
	$file='../uploads/'.$_FILES['banner']['name'];
	$time=date('Y-m-d H:i:s');
	//echo "<pre>";
	//var_dump($file);
	move_uploaded_file($_FILES['banner']['tmp_name'], '../uploads/'.$file );
	$sql="insert into `nav`(`title`,`intro`,`banner`,`times`) values('$title','$intro','$file','$time')";
	$query=mysqli_query($link,$sql);
	if(mysqli_affected_rows($link)){
		echo "<script>alert('添加成功');location.href='nav_mana.php';</script>";
	}else{
		echo "<script>alert('添加失败');location.href='nav_add.php';</script>";
	}
}



?>


	<div class="right_side">
		<h3 style="margin-top:20px;margin-left:40px;">添加栏目</h3>
		<form action="nav_add.php" method="POST" enctype="multipart/form-data" style="margin:50px 300px;">
			栏目标题：<input type="text" name="title" style="margin-bottom:20px;width:300px;height:30px;"><br>
			URL：<input type="text" style="margin-bottom:20px;width:300px;height:30px;"><br>
			栏目简介：<br><br><textarea name="intro" id="" cols="40" rows="10" style="width:400px;margin-bottom:20px;"></textarea><br>
			banner图：<input type="file" name="banner" style="margin-bottom:20px;"><br>
			<input type="submit" value="确认提交" style="width:100px;height:30px;">
		</form>
	</div>







<?php include 'home_footer.php';?>