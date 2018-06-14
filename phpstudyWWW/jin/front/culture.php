<?php include('header.php');?>
<div class="about inner clearfix">
	<div class='fl'>
		<h2>企业文化</h2>
		<ul>
			<li><a href="">金岭观念</a></li>


		</ul>
		<div><img src="img/left_pic_wh1.jpg"></div>
	</div>


	<div class="fr">
		<div class="bread_nav clearfix">
			<div class="fl"><img src="img/aboutLogo.png" alt=""></div>
			<div class="fr">当前位置 : 首页 &gt; 企业文化 &gt;金岭观念 <img src="img/jiantou.png"></div>
		</div>

		<div>
			<?php
				$sql="select * from `article` where `pid` =14";
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