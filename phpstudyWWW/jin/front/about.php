<?php include('header.php');?>

<div class="about inner clearfix">
	<div class='fl'>
		<h2>关于金岭</h2>
		<ul>
			<li><a href="">领导致辞</a></li>
			<li><a href="">公司概况</a></li>
			<li><a href="">领导关怀</a></li>
			<li><a href="">企业荣誉</a></li>
			<li><a href="">企业资质</a></li>
			<li><a href="">下属公司</a></li>
		</ul>
		<div><img src="img/left_pic_about.jpg" alt=""></div>
	</div>


	<div class="fr">
		<div class="bread_nav clearfix">
			<div class="fl"><img src="img/aboutLogo.png" alt=""></div>
			<div class="fr">当前位置 : 首页 &gt; 关于金岭 &gt; 公司概况 <img src="img/jiantou.png" alt=""></div>
		</div>

		<div> 
			<?php
				$sql="select * from `article` where `pid` =10";
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