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
		while($result=mysqli_fetch_assoc($query)){
			if($result['pid']==0 && $result[]){
				echo "<li> {$result['name']} </li>";
			}
		}


	?>

	</ul>
	
</body>
</html>






