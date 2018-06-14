<?php
header('content-type:text/html;charset=utf-8');
session_start();
define('HOST','localhost');
define('USER','root');
define('PASSWORD','root');

$link=mysqli_connect(HOST,USER,PASSWORD) or die('链接数据库失败');
mysqli_select_db($link,'test') or die('链接demo库失败');
mysqli_query($link,'set names utf8');



?>