<?php
header('content-type:text/html;charset=utf8');
define('HOST','localhost');
define('USER','root');
define('PASSWORD','root');
$link=mysqli_connect(HOST,USER,PASSWORD) or die('没连接到数据库');
mysqli_select_db($link,'demo') or die('没找到数据库，或者没有权限');
mysqli_query($link,'set names utf8');
echo '准备好了';










?>