<?php include('header.php');?>
<div class="about inner clearfix">
	<div class='fl'>
		<h2>社会责任</h2>
		<ul>
			<li><a href="">安全生产</a></li>
			<li><a href="">环境保护</a></li>
			<li><a href="">公益事业</a></li>
		</ul>
		<div><img src="img/left_pic_shzr.jpg"></div>
	</div>


	<div class="fr">
		<div class="bread_nav clearfix">
			<div class="fl"><img src="img/aboutLogo.png" alt=""></div>
			<div class="fr">当前位置 : 首页 &gt; 社会责任 &gt;安全生产 <img src="img/jiantou.png"></div>
		</div>

		<div>
			
			<?php
				$sql="select * from `article` where `pid` =15";
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