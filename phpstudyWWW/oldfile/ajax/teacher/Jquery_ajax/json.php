<?php
header('Content-type:text/html;charset=utf-8');
//索引数组  一维数组和二维数组
/*$array = array(12,34,56,78,array(1,2,3),array(4,5,ar76));

$json = json_encode($array);

var_dump($json);*/

/*$array = array('a'=>1,'b'=>2,'c'=>3,"z"=>array('d'=>4,"e"=>5));

//'{"a":1,"b":2,"c":3}';

$json = json_encode($array);

var_dump($json);*/

$array = array(
  array("name"=>"张三","sex"=>"man","age"=>"25"),
    array("name"=>"李四","sex"=>"woman","age"=>"28"),
    array("name"=>"郑文阳","sex"=>"woman","age"=>"18")
);

$json = json_encode($array);

//写入文件  ：  将$json写入到index.json文件中  如果index.json文件不存在   则创建它
file_put_contents('index.json',$json);

$arr = json_decode($json);

var_dump($arr);
