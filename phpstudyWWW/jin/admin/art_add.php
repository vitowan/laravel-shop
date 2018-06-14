<?php 
include 'home_header.php' ;
include 'public/mysqli_connect.php';
if(isset($_POST['title'])){
	$title=$_POST['title'];
	$intro=$_POST['intro'];
	$content=$_POST['content'];
	$pid=$_POST['pid'];
	$author=$_POST['author'];
	$file='../uploads/'.$_FILES['pic']['name'];
	move_uploaded_file($_FILES['pic']['tmp_name'], $file );

	$sql="insert into `article`(`title`,`intro`,`content`,`pic`,`author`,`pid`) values('$title','$intro','$content','$file','$author','$pid')";
	$query=mysqli_query($link,$sql);

	if(mysqli_affected_rows($link)){
		echo "<script>alert('添加成功');location.href='art_mana.php';</script>";
	}else{
		echo "<script>alert('添加失败');location.href='art_add.php';</script>";
	}
}

?>


	<div class="right_side">
		<h3 style="margin-top:20px;margin-left:40px;">添加文章</h3>
		<form action="art_add.php" method="POST" enctype="multipart/form-data" style="margin:20px 300px;">
			标题：<input type="text" name="title" style="margin-bottom:10px;width:400px;height:30px;"><br>
			简介：<br><br><textarea name="intro" id="" cols="40" rows="10" style="width:500px;height:100px;margin-bottom:10px;"></textarea><br>
			内容：<br><br><textarea name="content" id="" cols="40" rows="10" style="width:500px;height:200px;margin-bottom:10px;"></textarea><br>
			图片：<input type="file" name="pic" style="margin-bottom:10px;"><br>
			作者：<input type="text" name="author" style="margin-bottom:10px;width:400px;height:30px;"><br>
			推送栏目：
			<select name="pid" style="margin-bottom:10px;" >
				<option value="10">关于金岭</option>
				<option value="9">新闻中心</option>
				<option value="12">主要产品</option>
				<option value="14">企业文化</option>
				<option value="15">社会责任</option>
				<option value="16">人力资源</option>
				<option value="18">联系我们</option>
				<option value="19">通知公告</option>
				<option value="20">销售信息</option>
			</select><br>
			<input type="submit" value="确认发布" style="width:100px;height:30px;">
		</form>
	</div>


<?php include 'home_footer.php';?>