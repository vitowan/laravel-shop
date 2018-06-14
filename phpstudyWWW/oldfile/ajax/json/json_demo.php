<?php

$arr=array(
	array('name'=>'wan','age'=>'18','sex'=>'man'),
	array('name'=>'li','age'=>'28','sex'=>'man'),
	array('name'=>'he','age'=>'38','sex'=>'woman')
);
$json=json_encode($arr);
//print_r($json);
file_put_contents('index.json',$json);

//$a=json_decode($json);
//print_r($a);





?>