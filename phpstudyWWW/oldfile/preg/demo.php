<?php
header('content-type:text/html;charset=utf-8');
/*$str='18872239969';
$preg='/^1[345678]\d{9}$/';
$str='wan363@sohu.comwqewqe';
$preg1='/\w+@\w+\.\w+$/';
$str='0396-18777890';
$preg1='/^1[34578][0-9]{9}$|^0\d{2,3}-\d{7,8}$/';

$a=preg_match($preg1,$str,$arr);
//var_dump($a);
if($a){
	echo '匹配';
}else{
	echo '不匹配';
}
*/


/*$str='hello 321';
$p='/\d/';
$rep='中公';

$a=preg_replace($p,$rep,$str);
print_r($a);//hello 中公中公中公

*/
/*$str='hello 321';
$p=array('/\d{3}/','/\w/');
$rep=array('中公','华图');

$a=preg_replace($p,$rep,$str);
print_r($a);//华图华图华图华图华图 中公

*/

$arr=array('qwe','qw2','123','2w2');
$p='/[a-z]/';
$args=preg_grep($p,$arr);
print_r($args);

?>