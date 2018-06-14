<?php  include 'public/mysqli_connect.php'; 


if(isset($_POST['title'])){

	$title=$_POST['title'];
	$intro=$_POST['intro'];
	$content=$_POST['content'];
	$file='../uploads/'.$_FILES['pic']['name'];
	move_uploaded_file($_FILES['pic']['tmp_name'], '../uploads/'.$file );
	$author=$_POST['author'];
	$pid=$_POST['pid'];
	$id=$_POST['id'];


$sql="update `article` set `title`='$title',`intro`='$intro',`content`='$content',`pic`='$file',`author`='$author',`pid`='$pid' where `id`='$id'";
mysqli_query($link,$sql);

if(mysqli_affected_rows($link)){
	echo "<script>alert('更改成功');location.href='art_mana.php'</script>";
}else{
	echo "<script>alert('更改失败');location.href='art_mana.php'</script>";
}

}
?>