<?php

/*function show($arr){

	foreach($arr as $k => $v){
		if(!is_array($v)){

			echo $v."<br>";

		}else{
			show($v);
			
		}

	}

}

$arr1=array(1,3,5,6,2,3,6,7,array(1,4,7),array(1,9,9,20));

show($arr1);
*/


/*function demo($arr){

	foreach($arr as $k=>$v){
		if(!is_array($v)){
			$a[]=$v;
		}else{
			$b[]=$v;
		}
	}
//return $a;
return $b;

}
$arr1=array(1,3,5,6,2,3,6,7,array(1,4,7),array(1,9,9,20),5,6,2,3,6,7);
echo "<pre>";
print_r(demo($arr1));*/

//demo($arr1);



//创建视图表,as后面可以接任何查询语句
create view view_score as select stu.name, scores.html,scores.css from stu,sc
ores where stu.id=scores.pid;

//查询视图的结构
 show create view view_score;
 //查询视图，跟一般查询一帮
 select * from view_score;


 //在视图中对数据的增删改查与在表中都一样

 //删除视图
 drop view view_score;

 视图是一张虚拟的表，不占用物理内存
 视图不存放数据，数据只存在基表中，但是他们发生变化都会互相影响
 性能差  ：  查询的效率偏低，每次查询是都要转换
 修改限制  ：  对于复杂视图来说（多表查询）修改是非常麻烦的



 //数据库备份，也可以从mysql后台备份，备份出来的文件一样，备份库或者表都是一样的方式
E:\>mysqldump -u root -p demo hongbao >E:\WWW\hong.sql //备份表，如备份多个用,逗号隔开，后面路径是绝对路径
Enter password: ****
E:\>mysqldump -u root -p demo>E:\WWW\demo.sql//备份库
Enter password: ****

使用SQL语句进行备份 ：  mysqldump  -u root  -p  数据库名  数据表名1、表名2   密码  >  路径

使用SQL语句进行还原  ：  mysql  -u  root  -p  密码  数据库名  <  路径
E:\>mysql -u root -p demo<E:\WWW\hong.sql//还原表
Enter password: ****
E:\>mysql -u root -p demo<E:\WWW\demo.sql//还原库
Enter password: ****
















索引
	索引介绍
		用处  ：  几乎所有的索引都是添加到字段中的
		作用  ：  使用索引，是为了加快查询速度，提高查询效率，约束数据的有效性
		原理  ：  系统根据某种算法或者未来添加的数据，单独建立一个文件，实现快速匹配查找

	索引的优点
		通过唯一索引可以创建出每一行数据的唯一性
		可大大提高数据库的检索速度，这是最主要的原因
		加强表与表之间的联系，实现多表查询
		在分组和排序中，同样可以少耗费很多时间
		可以提高表的性能

	索引的分类
**********主键索引
			作用  ：  确定数据表中一条特定数据记录的位置
			关键字  ：  primary  key
			创建  ：  一般创建在建表时候  id  int  not  null  auto_increment  primary  key
			注意  ：  主键不能为空，一个表中只能有一个主键索引
**********外键索引
			概念  ：  外面的键，不是在自己的表中，如果一张表中的一个字段（非主键）指向另一张表中的主键，那么可以称该字段为外键
			作用  ：  用来在多表查询的时候方便联系两表数据
			关键字  ：  foreign  key
			使用  ：  foreign  key（外键名）  references  主表（主键）
			约束
				对子表  ：  在对子表进行增和改的时候，如果外键对应在父表中找不到，那么就会失败
				对父表  ：  在对父表进行删和改的时候，如果在主表中已有数据被引用，那么也将失败
			外键的形成条件
				要求表类型必须是innodb
				如果不是innodb，那么及时创表成功，也没有了约束的效果
				外键的数据类型必须与主键的数据类型一致
				在一张表中外键名不能重复
				如果数据存在，那么必须保证外键中的数据和附表中的主键数据一致

**********唯一索引
			作用  ：  唯一索引是为了避免出现重复的值，他的存在不是为了提高访问速度，而是避免出现重复数据
			关键字  ：  unique
			使用  ：  一般在创建列的时候使用   name  char（30）  not  null  default  ‘DB’  unique
			注意  ：  只有确认某一列不能出现重复的值得时候才能使用
			
**********普通索引
			概念  ：  普通索引依附在某一列上，提高查询速度
			关键字  ：  index
			使用  ：  create  index  索引名  on  表名（列名）
		索引的操作
			查看索引  ：  show  index   from  表名
			删除索引   ：  drop  index  索引名  on  表名
	索引的缺点
		运行速度  ：  添加索引会延缓插入数据和修改数据的速度
		耗费空间  ：  索引本身产生的文件就有可能比数据的文件还要大
		消耗时间  ：  创建索引和维护索引要耗费时间，这种时间使根据数据量的增加而增加
