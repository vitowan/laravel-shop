<?php
header('content-type:text/html;charset=utf-8');

$link=mysqli_connect('localhost','root','root','nav_demo') or die('没链接上');

$sql="select * from nav";
$query=mysqli_query($link,$sql);


?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>demo</title>
	<style>
		li{
			list-style:none;
		}
	</style>
</head>
<body>
	<ul>
	<?php
	$arr=[];
	$arr1=[];
	while($result=mysqli_fetch_assoc($query)){
		$num=substr_count($result['path'],'-');
		$pre=str_repeat(' - ',$num);
		if($result['pid']>0){
			$result['tree']='| '.$pre.$result['name'];
		}else{
			$result['tree']=$result['name'];
		}
		
		$arr[]=$result['tree'];
		$arr1[]=$result['path'].'-'.$result['id'];
	
	}

	array_multisort($arr1,$arr);
/*	foreach($arr as $v){
		echo "<li>$v</li>";
	}*/
	echo "<pre>";
	var_dump($arr);
/*		foreach($arr as $v){
		echo "<li>$v</li>";
		}
*/
	?>
	</ul>
	
</body>
</html>






