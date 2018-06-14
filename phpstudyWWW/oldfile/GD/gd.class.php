<?php
header('content-type:text/html;charset=utf-8');
session_start();
class Gd{
	public $count;
	public $width;//$width=20*$count
	public $height;
	function __construct($c=4,$w=80,$h=30){
		$this->count=$c;
		$this->width=$w;
		$this->height=$h;
	}

	function code(){

		$img=imagecreatetruecolor($this->width,$this->height);
		$color=imagecolorallocate($img,rand(200,255),rand(200,255),rand(200,255));
		$black=imagecolorallocate($img,0,0,0);
		imagefill($img,0,0,$color);//给验证码框加个背景色
		imagerectangle($img, 0, 0, $this->width-1, $this->height-1, $black);//加个长方形的黑色边框

		//加干扰点
		for($i=0;$i<200;$i++){
			$color1=imagecolorallocate($img,rand(0,200),rand(0,200),rand(0,200));
			imagesetpixel($img,rand(1,199),rand(1,69),$color1);

		}

		//加干扰线
		for($i=0;$i<=4;$i++){
			$color2=imagecolorallocate($img,rand(0,255),rand(0,255),rand(0,255));
			imageline($img,rand(0,$this->width),rand(0,$this->height),rand(0,$this->width),rand(0,$this->height),$color2);
		}

		$str = 'qwertyupasdfghjkzxcvbnm23456789QWERTYUPASDFGHJKZXCVBNM';


		$color3=imagecolorallocate($img,rand(0,100),rand(0,100),rand(0,100));
		$string='';
		for($j=0; $j<$this->count; $j++){
			$text=$str[rand(0,strlen($str)-1)];
			$string.= $text;
			imagettftext($img,20,rand(-30,30),8+18*$j,24,$color3,'Arial.ttf',$text);
			

		}
		$_SESSION['string']=$string;
		header('content-type:image/png');
		imagepng($img);
		imagedestroy($img);

	}

}
/*$co=new Gd(4,80,30);//
$co->code();*/








?>