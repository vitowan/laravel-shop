<?php include 'home_header.php'; 

include 'public/mysqli_connect.php';

//var_dump($_GET);
if($_GET['m']=='edit'){
	$id=$_GET['id'];
}
$sql="select * from `nav` where `id`='$id'";
$query=mysqli_query($link,$sql);

$result=mysqli_fetch_assoc($query);

$_SESSION['id']=$_GET['id'];


?>


	<div class="right_side">
		<h3 style="margin-top:20px;margin-left:40px;">栏目更改</h3>
		<form action="do_nav_update.php" method="POST" enctype="multipart/form-data" style="margin:50px 300px;">
			栏目标题：<input type="text" name="title" value="<?php echo $result['title']?>" style="margin-bottom:20px;width:300px;height:30px;"><br>
			URL：<input type="text" name="url" value="<?php echo $result['url'] ?>" style="margin-bottom:20px;width:300px;height:30px;"><br>
			栏目简介：<br><br><textarea name="intro" id="" cols="40" rows="10" style="width:400px;margin-bottom:20px;"><?php echo $result['intro']?></textarea><br>
			banner图：<input type="file" name="banner" value="<?php echo $result['banner']?>" style="margin-bottom:20px;"><br>
			<input type="submit" value="确认修改" style="width:100px;height:30px;">
		</form>
	</div>



<?php include 'home_footer.php';?>


