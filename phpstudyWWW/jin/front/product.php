<?php include('header.php');?>
<div class="about inner clearfix">
	<div class='fl'>
		<h2>产品导航</h2>
		<ul>
			<li><a href="">集团新闻</a></li>
			<li><a href="">公告通知</a></li>
			<li><a href="">集团新闻</a></li>
			<li><a href="">公告通知</a></li>
			<li><a href="">公告通知</a></li>

		</ul>
		<div><img src="img/left_pic_cp.jpg"></div>
	</div>


	<div class="fr">
		<div class="bread_nav clearfix">
			<div class="fl"><img src="img/aboutLogo.png" alt=""></div>
			<div class="fr">当前位置 : 首页 &gt; 产品中心 <img src="img/jiantou.png"></div>
		</div>

		<div>
				<?php
				$sql="select * from `article` where `pid` =12";
				$query=mysqli_query($link,$sql);
				
				while($result=mysqli_fetch_assoc($query)){
					echo $result['content'];
			?>	
				

			<?php
				}
			?>

		</div>
	</div>

</div>




<?php include('footer.php');?>