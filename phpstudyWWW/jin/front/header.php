<?php
include '../admin/public/mysqli_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>金岭集团</title>
	<link rel="stylesheet" href="css/public.css">
	<link rel="stylesheet" href="css/index.css">
	<link rel="stylesheet" href="css/about.css">
</head>
<body>
	<div class="inner header clearfix">
		



		
		<div class="fl"><a href="#"><img src="img/aboutLogo.png"></a></div>
		<ul class=" clearfix fr"> 
			
			
			<?php
				
				$sql="select * from `nav`";
				$query=mysqli_query($link,$sql);
				while($result=mysqli_fetch_assoc($query)){
					//$photo=$result['banner'];
					//var_dump($result);
			?>
				<li><a href="<?php echo $result['url'];?>?id=<?php echo $result['id']?>"><?php echo $result['title'];?></a></li>
			<?php
				}
			?>

		<!-- 	<li><a href="about.php">关于金岭</a></li>
		<li><a href="news.php">新闻中心</a></li>
		<li><a href="product.php">主要产品</a></li>
		<li><a href="culture.php">企业文化</a></li>
		<li><a href="responsibility.php">社会责任</a></li>
		<li><a href="hr.php">人力资源</a></li>
		<li><a href="">电采平台</a></li>
		<li><a href="contact.php">联系我们</a></li> -->
			<li><a href=""><img src="img/english.png" alt=""></a></li>
		</ul>
	</div>
		<?php
		//$url=$result['url'];
		//var_dump($result);
		if(isset($_GET['id'])){
			$id=$_GET['id'];
			$sql="select `banner` from `nav` where `id` = '$id'";
			$query=mysqli_query($link,$sql);
			$result=mysqli_fetch_assoc($query);
			$banner=$result['banner'];
		}else{
			$banner='../uploads/banner_a.jpg';
			}
		?>
		

	<!-- banner区 -->
	<div class="banner">
		<a href=""><img src="<?php 


		echo $banner;


		?>" alt=""></a>
	</div>


