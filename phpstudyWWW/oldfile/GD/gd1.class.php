<?php
class Gd1{
	static $count;
	static $width;//$width=20*$count
	static $height;
	function __construct($c,$w,$h){
		self::$count=$c;
		self::$width=$w;
		self::$height=$h;
	}
	function code(){

		$img=imagecreatetruecolor(self::$width,self::$height);
		$color=imagecolorallocate($img,rand(200,255),rand(200,255),rand(200,255));

		imagefill($img,0,0,$color);//给验证码框加个背景色

		//加干扰点
		for($i=0;$i<200;$i++){
			$color1=imagecolorallocate($img,rand(0,200),rand(0,200),rand(0,200));
			imagesetpixel($img,rand(1,199),rand(1,69),$color1);

		}

		//加干扰线
		for($i=0;$i<=4;$i++){
			$color2=imagecolorallocate($img,rand(0,255),rand(0,255),rand(0,255));
			imageline($img,rand(0,self::$width),rand(0,self::$height),rand(0,self::$width),rand(0,self::$height),$color2);
		}

		$str = 'qwertyupasdfghjkzxcvbnm23456789QWERTYUPASDFGHJKZXCVBNM';


		$color3=imagecolorallocate($img,rand(0,100),rand(0,100),rand(0,100));
		for($j=0; $j<self::$count; $j++){
		$text=$str[rand(0,strlen($str)-1)];
			imagettftext($img,20,rand(-30,30),8+18*$j,24,$color3,'./msyh.ttf',$text);
			
		}

		header('content-type:image/png');
		imagepng($img);
		imagedestroy($img);

	}

}

$co=new Gd1(4,80,30);
$co->code();






?>