<?php
include 'header.php';
?>



<div class="inner content">
	<div class="content1 clearfix">

		<div class='content1_left fl'>
			<h2><a class="fl content1_left_a1" href="">集团新闻</a><a class="fr content_left_a2" href=""><img src="img/jiantou.png" alt=""></a></h2>
			<div class="clearfix">
				<!-- <div class="slide_img fl"></div> -->
			
				<ul class='fl'>
					<?php
					$sql="select * from `article` where pid=9";
					$query=mysqli_query($link,$sql);
					while($result=mysqli_fetch_assoc($query)){
					?>

						<li><a href="news.php"><?php  echo $result['title'];?></a></li>
					<?php
					}
					?>
		<!-- 			<li><a href="">济南市工商联考察团到公司考察</a></li>
		<li><a href="">金岭集团再次上榜中国石油和化工民营企业百强</a></li>
		<li><a href="">国家环保部环境保护对外合作中心陈亮主任到公司调研</a></li>
		<li><a href="">东营市侨联主席赵军到公司调研</a></li>
		<li><a href="">济南市工商联考察团到公司考察</a></li>
		<li><a href="">金岭集团再次上榜中国石油和化工民营企业百强</a></li>
		<li><a href="">国家环保部环境保护对外合作中心陈亮主任到公司调研</a></li>
		<li><a href="">国家环保部环境保护对外合作中心陈亮主任到公司调研</a></li>  -->
				</ul>
			</div>
		</div>

		<div class="content1_right fr">
			<div class="div_up">
				<h2><a class="fl content1_right_a1" href="">通知公告</a><a class="fr content_right_a2" href=""><img src="img/jiantou.png" alt=""></a></h2>
				<ul>
			<?php
				$sql="select * from `article` where `pid` =19";
				$query=mysqli_query($link,$sql);
				
				while($result=mysqli_fetch_assoc($query)){
					
			?>	
				<li><a href='news.php'><?php echo $result['content'];?></a></li>

			<?php
				}
			?>
<!-- 
					<li><a href="">山东金岭新材料有限公司苯胺二车间不锈</a></li>
					<li><a href="">山东金岭新材料有限公司苯胺二车间不锈</a></li>
					<li><a href="">山东金岭新材料有限公司苯胺二车间不锈</a></li>
					<li><a href="">山东金岭新材料有限公司苯胺二车间不锈</a></li>
					<li><a href="">山东金岭新材料有限公司苯胺二车间不锈</a></li>
					<li><a href="">山东金岭新材料有限公司苯胺二车间不锈</a></li> -->
				</ul>
					
			</div>
			<div class="div_down">
				<h2><a class="fl content1_right_a1" href="">销售信息</a><a class="fr content_right_a2" href=""><img src="img/jiantou.png" alt=""></a></h2>
				<ul>
			<?php
				$sql="select * from `article` where `pid` =20";
				$query=mysqli_query($link,$sql);
				
				while($result=mysqli_fetch_assoc($query)){
					
			?>	
				<li><a href='news.php'><?php echo $result['content'];?></a></li>

			<?php
				}
			?>
					
				
				</ul>
			</div>


		</div>
	</div>

	<!-- 内容区下面的 -->

	<div class="content1 clearfix">
		<div class="content1_left fl">
			<h2><a class="content1_left_a1" href="">集团概况</a><a class="content1_left_a2" href=""><img src="img/jiantou.png" alt=""></a></h2>
			<div class="text">
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

		<div class="content1_right fr">
			<div class="div_up">
				<h2><a class="fl content1_right_a1" href="">下属公司</a><a class="fr content_right_a2" href=""><img src="img/jiantou.png" alt=""></a></h2>				
			</div>
			<div class="company_son">
				<div class="fl">
					<div>
						<a href=""><img src="img/jlhg.jpg" alt=""></a>
					</div>
					<div>金岭化工</div>
				</div>
				<div class="fr">
					<div>
						<a href=""><img src="img/jlhx.jpg" alt=""></a>
					</div>
					<div>金岭化工</div>
				</div>
						<div class="fl">
					<div>
						<a href=""><img src="img/jlhx.jpg" alt=""></a>
					</div>
					<div>金岭化工</div>
				</div>
						<div class="fr">
					<div>
						<a href=""><img src="img/jlhx.jpg" alt=""></a>
					</div>
					<div>金岭化工</div>
				</div>
	

			</div>
		</div>
	</div>


</div> 

<?php  include('footer.php');?>


