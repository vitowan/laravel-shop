<?php
session_start();
if(!isset($_SESSION['name'])){
	echo "<script>  location.href='login.php';</script>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>后台页面</title>
	<script src='js/jquery-1.8.2.min.js'></script>
	<style>
		*{
			padding:0;
			margin:0;
		}
		body{
			font-size:16px;
		}
		a{
			text-decoration:none;
		}
		ul li,ol li{
			list-style:none;
		}
		.inner{
			width:100%;
			height:800px;
			margin:0 auto;
			background:#dde6ea;
		}
		.inner .nav{
			height:50px;
			width:100%;
			background:#b7c2e2;
			line-height:50px;
		}
		.inner .con{
			margin-top:8px;
		}
		.inner .con .left_side{
			float:left;
			margin-left:8px;
		}
		.inner .con .right_side{
			float:left;
			margin-left:20px;
			background:#8eafce;
			width:1330px;
			height:720px;
		}
		.inner .con .left_side>li span{
			display:block;
			width:130px;
			height:40px;
			line-height:40px;
			text-align:center;
			background:#4e9ec8;
			cursor:pointer;
			margin-bottom:1px;
		}
		.inner .con .left_side>li{
			margin-bottom:2px;
		}
		.inner .con .left_side li ol{
			/*display:none;*/
		}
		.inner .con .left_side li ol li a{
			display:block;
			width:130px;
			height:40px;
			line-height:40px;
			background:#6092ad;
			color:#fff;
			text-align:center;
			margin-bottom:1px;
		}

		.inner .nav span{
			color:#333;
		}
		.inner .nav .left_span{
			float:left;
			margin-left:5%;
		}
		.inner .nav .left_span a{
			margin-right:30px;
			color:#333;
		}
		.inner .nav .right_span{
			float:right;
			margin-right:5%;
		}

		/* 栏目管理 */
		.nav_mana h3{
			margin-bottom:10px;
		}
		.nav_mana ul li{
			line-height:40px;
			/*margin-top:5px;*/
		}
		.nav_mana ul li span{
			display:inline-block;
			margin-right:5px;
			text-align:center;
			overflow:hidden;
			white-space: nowrap;
			text-overflow:ellipsis;

		}
		.nav_mana ul li span:nth-child(1){
			width:40px;
			height:40px;
			border:1px #000 solid;
		}
		.nav_mana ul li span:nth-child(2){
			width:90px;
			height:40px;
			border:1px #000 solid;
		}

		.nav_mana ul li span:nth-child(3){
			width:200px;
			height:40px;
			border:1px #000 solid;
		}

		.nav_mana ul li span:nth-child(4){
			width:280px;
			height:40px;
			border:1px #000 solid;
		}
		.nav_mana ul li span:nth-child(5){
			width:200px;
			height:40px;
			border:1px #000 solid;
		}
		.nav_mana ul li span:nth-child(6){
			width:200px;
			height:40px;
			border:1px #000 solid;
		}
		.nav_mana ul li span:nth-child(7){
			width:100px;
			height:40px;
			border:1px #000 solid;
		}

		/* 文章管理 */
		.art_mana h3{
			margin-bottom:20px;
		}
		.art_mana ul li span{
			display:inline-block;
			border:1px solid #000;
			height:35px;
			text-align:center;
			line-height:35px;
			overflow:hidden;
			white-space: nowrap;
			text-overflow:ellipsis;

		}
		.art_mana ul li span:nth-child(1){
			width:40px;	
		}
		.art_mana ul li span:nth-child(2){
			width:100px;	
		}
		.art_mana ul li span:nth-child(3){
			width:150px;	
		}
		.art_mana ul li span:nth-child(4){
			width:300px;	
		}
		.art_mana ul li span:nth-child(5){
			width:150px;	
		}
		.art_mana ul li span:nth-child(6){
			width:150px;	
		}
		.art_mana ul li span:nth-child(7){
			width:100px;	
		}
		.art_mana ul li span:nth-child(8){
			width:40px;	
		}
		.art_mana ul li span:nth-child(9){
			width:150px;	
		}
		/*  分页区*/
		.art_mana div ol li{
			float:left;
			margin-right:10px;
			margin-top:20px;
		}
		.art_mana div ol li a{
			display:inline-block;
			width:80px;
			height:30px;
			border:1px solid #ccc;
			text-align:center;
			line-height:30px;
		}

	</style>
</head>
<body>
	<?php
		date_default_timezone_set("Asia/Shanghai");
		//session_start();
		//var_dump($_SESSION);
		//var_dump($_POST)
	?>
	<div class='inner'>
		<div class="nav">
			<span class="left_span"><a href="home.php">首页</a>hi,<?php echo $_SESSION['name']?>欢迎回来</span><span class="right_span"><?php echo date('Y-m-d H:i:s');?></span>
		</div>

		<div class="con">
			<ul class="left_side">
				<li><span>栏目</span>
					<ol>
						<li><a href="nav_add.php">添加栏目</a></li>
						<li><a href="nav_mana.php">栏目管理</a></li>
					</ol>
				</li>
				<li><span>文章</span>
					<ol>
						<li><a href="art_add.php">添加文章</a></li>
						<li><a href="art_mana.php">文章管理</a></li>
					</ol>
				</li>
			</ul>




<!-- 
<script>

	$(function(){
		$('.con li span').click(function(){
			$(this).next('ol').slideToggle();
		});

	});

</script> -->