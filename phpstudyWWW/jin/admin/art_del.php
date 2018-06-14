<?php
include 'public/mysqli_connect.php';
if($_GET['m']=='del'){
	$id=$_GET['id'];

}
$sql="delete from `article` where `id`='$id'";
mysqli_query($link,$sql);
if(mysqli_affected_rows($link)){
	echo "<script>alert('删除成功');location.href='art_mana.php'</script>";
}else{
	echo "<script>alert('删除失败');location.href='art_mana.php'</script>";
}
?>