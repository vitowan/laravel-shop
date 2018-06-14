<?php

/*setcookie('name','',time()-100);
var_dump($_COOKIE);
*/
session_start();
//var_dump($_SESSION);
//var_dump($_COOKIE);
var_dump($_SESSION);

echo "<hr>";
var_dump($_COOKIE);//session会带来cookie（session_name()和session_id()）
echo "<hr>";
var_dump(session_name());
echo "<hr>";
var_dump(session_id());

//销毁session的三步骤
session_unset();//销毁服务器端的session变量
session_destroy();//销毁一个会话中的全部数据
setcookie(session_name(),"",time()-1,"/");





?>