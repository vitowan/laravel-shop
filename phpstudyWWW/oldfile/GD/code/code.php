<?php 
session_start();
//生成一个验证码

//1 准备好纸（画布） 笔（染料）

//创建基于真彩色的画布
//定义变量规定 验证码的长度和类型
$count = 4;
$type = 2;
//图像的宽度
$width= 20*$count;
$height =30;
//获取随机字符串
$code = getCode($type,$count);
// setcookie('code',$code,time()+3600,'/');
$_SESSION['code'] = $code;
//创建画布
$im =imagecreatetruecolor($width,$height);

//准备染料

$bg[0] = imagecolorallocate($im,200,200,230);
$bg[1] = imagecolorallocate($im,210,247,220);
$color[0] = imagecolorallocate($im,0,0,0);
$color[1] = imagecolorallocate($im,123,100,5);
$color[2] = imagecolorallocate($im,255,0,0);
$color[3] = imagecolorallocate($im,0,255,0);
$color[4]= imagecolorallocate($im,0,0,255);



//2开始画画

imagefill($im,0,0,$bg[rand(0,1)]);

for ($i=0; $i < $count; $i++) { 
	
	imagettftext($im,18,rand(-30,30),8+18*$i,24,$color[rand(0,4)],'./msyh.ttf',$code[$i]);
}

//画100个干扰点
for ($i=0; $i < 100; $i++) { 
	$s = imagecolorallocate($im,rand(0,150),rand(0,255),rand(0,255));
	imagesetpixel($im,rand(1,$width),rand(1,$height),$s);
}


//画5条干扰线
for ($i=0; $i < 5; $i++) { 
	$s = imagecolorallocate($im,rand(0,150),rand(0,255),rand(0,255));
	imageline($im,rand(0,$width),rand(0,$height),rand(0,$width),rand(0,$height),$s);
}

imagerectangle($im,0,0,$width,30,$color[0]);




//3打算留着还是卖了（浏览器输出或者保存到文件里）
header('Content-type:image/jpeg');
imagejpeg($im);


//4收拾东西，走人
imagedestroy($im);






function getCode($type=1,$len=4)
{
	$str='123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ';
	if($type == 1){
		$m = 8;
	}
	if($type == 2){
		$m  = 33;
	}
	if($type == 3){
		$m  = 58;
	}
	$mess='';
	for ($i=0; $i < $len ; $i++) { 
		$mess.=$str[rand(0,$m)];
	}
	return $mess;
}

  
   