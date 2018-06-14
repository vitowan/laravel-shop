<?php  include 'public/mysqli_connect.php'; 


if(isset($_POST['title'])){

	$title=$_POST['title'];
	$url=$_POST['url'];
	$intro=$_POST['intro'];
	//$intro=$_POST['banner'];
	$banner='../uploads/'.$_FILES['banner']['name'];
	move_uploaded_file($_FILES['banner']['tmp_name'], $banner );
	$time=date('Y-m-d H:i:s');
session_start();
$id=$_SESSION['id'];
$sql="update `nav` set `title`='$title',`url`='$url',`intro`='$intro',`banner`='$banner',`times`='$time' where `id`='$id'";
mysqli_query($link,$sql);

if(mysqli_affected_rows($link)){
	echo "<script>alert('更改成功');location.href='nav_mana.php'</script>";
}else{
	echo "<script>alert('更改失败');location.href='nav_mana.php'</script>";
}

}
?>
