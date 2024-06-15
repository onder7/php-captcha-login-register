<?php

session_start();

// CAPTCHA oluştur
$captcha = rand(1000,9999);
$_SESSION['captcha'] = $captcha;

// CAPTCHA görüntüsünü oluştur
$im = imagecreate(100, 40);
$bg = imagecolorallocate($im, 255, 255, 255);
$textcolor = imagecolorallocate($im, 11, 22, 11);
imagestring($im, 15, 10, 15, $captcha, $textcolor);

// CAPTCHA görüntüsünü göster
header('Content-type: image/png');
imagepng($im);
imagedestroy($im);