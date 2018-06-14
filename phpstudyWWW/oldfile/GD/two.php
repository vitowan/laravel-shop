<?php
$img = imagecreatetruecolor(200,50);

$white = imagecolorallocate($img,255,255,255);
$black = imagecolorallocate($img,0,0,0);
$background = imagecolorallocate($img,rand(200,255),rand(200,255),rand(200,255));
$pixel = imagecolorallocate($img,rand(0,255),rand(0,255),rand(0,255));
$char = imagecolorallocate($img,rand(0,50),rand(0,50),rand(0,50));

imagefill($img,0,0,$white);

imagerectangle($img,0,0,200,50,$black);

imagefilledrectangle($img,1,1,199,49,$background);

for ($i = 0; $i < 300; $i++)
{
    imagesetpixel($img,rand(1,199),rand(1,49),$pixel);
}

$str = 'qwertyupasdfghjkzxcvbnm23456789QWERTYUPASDFGHJKZXCVBNM';
$string = '';
for ($i = 0; $i < 4; $i++)
{
    $string = $str{rand(0,strlen($str)-1)};
    imagestring($img,6,50 * $i,15,$string,$char);
}

header('Content-type:image/png');
imagepng($img);

imagedestroy($img);