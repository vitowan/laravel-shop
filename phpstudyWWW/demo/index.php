<?php

$m=new MongoClient('mongodb://ujiuye:123456@www.123.com:27017/admin');
var_dump($m);
echo "<pre>";
$database=$m->selectDB('test1');
var_dump($database);
$c=$database->tt->find();
var_dump($c);
//添加信息
//$result=$database->tt->insert(array('age'=>11111));

//查询信息
//$result=$database->tt->find(array('name'=>'wang'));

//或查询
//$query=array('$or'=>[['name'=>'zhao'],['age'=>22]]);
//$result=$database->tt->find($query);

//删除
//$deleteQuery=array('name'=>'zhao');
//$option=array('justOne'=>true);
//$database->tt->remove($deleteQuery);

//修改
$query=['name'=>'wang'];
//$data=array('name'=>'xiao');
$data=array('$set'=>['age'=<19]);
$option=array('upsert'=>true);
$res=$database->tt->update($query,$data);


$result=$database->tt->find();
foreach($result as $v){
	var_dump($v);
}











?>