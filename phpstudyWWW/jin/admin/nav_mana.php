<?php 
include 'home_header.php' ;
include 'public/mysqli_connect.php';

$sql="select * from `nav`";
$query=mysqli_query($link,$sql);





?>



<div class="right_side nav_mana">
	<div style="width:1200px;height:720px;margin:10px auto;">
		<h3>栏目管理</h3>
		<ul>
			<li><span>ID</span><span>标题</span><span>url</span><span>简介</span><span>banner图</span><span>创建时间</span><span>操作</span></li>
			<?php
			while($result=mysqli_fetch_assoc($query)){
			?>
			<li><span><?php echo $result['id'] ?></span><span><?php echo $result['title'] ?></span><span><?php echo $result['url'] ?></span><span><?php echo $result['intro'] ?></span><span><?php echo $result['banner'] ?></span><span><?php echo $result['times'] ?></span><span><a href="nav_update.php?m=edit&id=<?php echo $result['id']?>">更改</a> | <a href="nav_del.php?m=del&id=<?php echo $result['id']?>">删除</a></span>
			</li>
			<?php
				}
				
			?>





		
		</ul>

	</div>
	



</div>



<?php include 'home_footer.php';?>