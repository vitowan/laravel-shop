<?php
header('content-type:text/html;charset=utf-8');
$a=array('a','d','c','d');
//var_dump($a);

$ja=json_encode($a);
var_dump($ja);
$jaa=json_decode($ja);
echo '<br>';
print_r($jaa);
echo '<br>';

$b=array('m'=>'a','d','c','d');
print_r($b);
echo '<br>';
$jb=json_encode($b);
var_dump($jb);
echo '<br>';
$jbb=json_decode($jb,true);
//echo $jbb['m'];
print_r($jbb);
echo '<br>';

//$c='{"m":"a","0":"d","1":"c","2":"d"}';
//var_dump($c);

//$json='{"m":"a","0":"d","1":"c"}';
$json="{'m':'a','0':'d','1':'c'}";
$json='{"a","d","c"}';
$json='["a","d","c"]';
$json="['a','d','c']";

//$json="{'a','b','c'}";
$jbb=json_decode($json,true);
var_dump($jbb);






?>