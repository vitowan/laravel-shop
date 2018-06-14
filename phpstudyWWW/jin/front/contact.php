<?php include('header.php');?>
<div class="about inner clearfix">
	<div class='fl'>
		<h2>联系我们</h2>

		<div><img src="img/left_pic_fw.jpg"></div>
	</div>


	<div class="fr">
		<div class="bread_nav clearfix">
			<div class="fl"><img src="img/aboutLogo.png" alt=""></div>
			<div class="fr">当前位置 : 首页 &gt; 服务中心 &gt;联系我们 <img src="img/jiantou.png"></div>
		</div>

		<div>
			<?php
				$sql="select * from `article` where `pid` =18";
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