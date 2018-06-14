<?php include('header.php');?>
<div class="about inner clearfix">
	<div class='fl'>
		<h2>人力资源</h2>
		<ul>
			<li><a href="">用人理念</a></li>
			<li><a href="">招聘信息</a></li>

		</ul>
		<div><img src="img/left_pic_rl.jpg"></div>
	</div>


	<div class="fr">
		<div class="bread_nav clearfix">
			<div class="fl"><img src="img/aboutLogo.png" alt=""></div>
			<div class="fr">当前位置 : 首页 &gt; 人力资源 &gt;用人理念 <img src="img/jiantou.png"></div>
		</div>

		<div>
			<?php
				$sql="select * from `article` where `pid` =16";
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