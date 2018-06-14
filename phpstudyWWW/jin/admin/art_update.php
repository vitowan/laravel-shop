<?php 
include 'home_header.php' ;
include 'public/mysqli_connect.php';

//var_dump($_GET);
if($_GET['m']=='edit'){
	$id=$_GET['id'];
}
$sql="select * from `article` where `id`='$id'";
$query=mysqli_query($link,$sql);

$result=mysqli_fetch_assoc($query);


?>




	<div class="right_side">
		<h3 style="margin-top:20px;margin-left:40px;">栏目更改</h3>
		<form action="do_art_update.php" method="POST" enctype="multipart/form-data" style="margin:20px 300px;">
			标题：<input type="text" name="title" value="<?php echo $result['title'] ;?>" style="margin-bottom:10px;width:400px;height:30px;"><br>
			简介：<br><br><textarea name="intro" id="" cols="40" rows="10" style="width:500px;height:100px;margin-bottom:10px;"><?php echo $result['intro'] ;?></textarea><br>
			内容：<br><br><textarea name="content" id="" cols="40" rows="10" style="width:500px;height:200px;margin-bottom:10px;"><?php echo $result['content'] ;?></textarea><br>
			图片：<input type="file" name="pic" style="margin-bottom:10px;"><br>
			作者：<input type="text" name="author" value="<?php echo $result['author'] ;?>" style="margin-bottom:10px;width:400px;height:30px;"><br>
			<input type="hidden" name="id" value="<?php echo $id;?>">
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