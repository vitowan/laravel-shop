<?php
header('Content-type:text/html;charset=utf-8');
$link = mysqli_connect('localhost','root','123') or die('连接数据库失败！！！');
mysqli_select_db($link,'snake_girl') or die('数据库不存在或没有权限！！！');
mysqli_query($link,'set names utf8');
if (isset($_POST['user']))
{
    $user = $_POST['user'];
    $pass = md5($_POST['pass']);
    $sql = "insert into `user`(`username`,`password`) values('$user','$pass')";
    $query = mysqli_query($link,$sql);
    echo mysqli_affected_rows($link);

}