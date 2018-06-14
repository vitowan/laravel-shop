<?php
/*
setcookie('name','wanxiao',time()+1000);//设置cookie

setcookie('name','',time()-100);//取消cookie
*/


session_start();//开启新的会话或者打开已经存在的会话
$_SESSION['name']="wan";
$_SESSION['age']="18";


?>