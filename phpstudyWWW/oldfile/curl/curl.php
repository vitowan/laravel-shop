<?php
//对CURL进行初始化
$ch = curl_init();
//获取上传的文件
$file = "@D:/Photo/1.jpg";
//写出一个数组  让$_FILES接受
$arr = array('name'=>$file);
//上传的路径
$path = "http://localhost/p1218/zz/post.php";
//定义上传路径
curl_setopt($ch,CURLOPT_URL,$path);
//不以文件流的形式返回
curl_setopt($ch,CURLOPT_RETURNTRANSFER,0);
//CURL头信息
curl_setopt($ch,CURLOPT_HEADER,0);
//选择提交方式
curl_setopt($ch,CURLOPT_POST,1);
//执行的回执时间
curl_setopt($ch,CURLOPT_TIMEOUT,30);
//上传
curl_setopt($ch,CURLOPT_POSTFIELDS,$arr);
//执行curl
curl_exec($ch);
//关闭资源
curl_close($ch);
?>
<form>
    <input type="file" name="file">
</form>
