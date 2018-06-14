<?php 
include 'home_header.php' ;
include 'public/mysqli_connect.php';
/*$sql="select * from `article`";
$query=mysqli_query($link,$sql);*/


$page = isset($_GET['page'])?$_GET['page']:1;
//分页
$sql="select * from `article`";
$query=mysqli_query($link,$sql);
//var_dump($query);
//总数据条数$num
$num=mysqli_num_rows($query);
//echo $num;
$show=10;
//判断分几页page_count
if(($num<=5)&&($num>0)){
	$page_count=1;
	$show=$num;
}
if($num%$show !=0){
	$page_count=intval($num/$show)+1;
}else{
	$page_count=$num/$show;
}
if($num==0){
	$page_count=0;
	$show=0;
}


//上一页
if($page>1){
	$beforepage=$page-1;
}else{
	$beforepage=1;
}

//下一页
if($page<$page_count){
	$afterpage=$page+1;
}else{
	$afterpage=$page_count;
}



?>

<div class="right_side art_mana">

	<div style="width:1250px;height:720px;margin:10px auto;">
		<h3>文章管理</h3>
		<ul>
			<li><span>ID</span><span>标题</span><span>简介</span><span>内容</span><span>图片</span><span>发布时间</span><span>作者</span><span>pid</span><span>操作</span></li>
		
		<?php
			//取数据

			$start=($page-1)*$show;
			$sql="select * from `article` order by `id` desc limit $start,$show ";
			$query=mysqli_query($link,$sql);
			while($result=mysqli_fetch_assoc($query)){

		?>		

		<li>
			<span><?php echo $result['id'];?></span><span><?php echo $result['title'];?></span><span><?php echo $result['intro'];?></span><span><?php echo $result['content'];?></span><span><?php echo $result['pic'];?></span><span><?php echo $result['date']?></span><span><?php echo $result['author']?></span><span><?php echo $result['pid'];?></span><span><a href="art_update.php?m=edit&id=<?php echo $result['id'];?>">修改</a> | <a href="art_del.php?m=del&id=<?php echo $result['id'];?>">删除</a></span>
		</li>


		<?php
			}
	
		?>

		</ul>

		<ol>
			<li><a href="art_mana.php?page=<?php echo 1;?>">首页</a></li>
			<li><a href="art_mana.php?page=<?php echo $beforepage;?>">上一页</a></li>
		<?php
			for($i=1;$i<=$page_count;$i++){
				echo "<li><a href='art_mana.php?page=$i'> $i </a></li>";
			}
		?>
			<li><a href="art_mana.php?page=<?php echo $afterpage;?>">下一页</a></li>
			<li><a href="art_mana.php?page=<?php echo $page_count;?>">尾页</a></li>
		</ol>


	</div>



</div>

<?php include 'home_footer.php';?>