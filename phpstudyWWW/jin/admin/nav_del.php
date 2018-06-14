<?php
include 'public/mysqli_connect.php';
//var_dump($_GET);
if($_GET['m']=='del'){
	$id=$_GET['id'];


}
$sql="delete from `nav` where `id`='$id'";

mysqli_query($link,$sql);
if(mysqli_affected_rows($link)){
	echo "<script>alert('删除成功');location.href='nav_mana.php'</script>";
}else{
	echo "<script>alert('删除失败');location.href='nav_mana.php'</script>";
}

?>