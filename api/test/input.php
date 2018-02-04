<?php
/**
 * Created by PhpStorm.
 * User: HL
 * Date: 2018/2/1
 * Time: 21:06
 */
//parse_str(file_get_contents('php://input'), $arguments);//未验证，ddl到了，=_=!
//print_r($arguments);
//echo "this is a vaul{$arguments[0]}";
//
//require_once '../object/thumbnail.php';
//$th=new thumbnail();
//header('content-type:image/jpg;');
//echo $th->img_create_small("../user/userImage/userImage.jpg",600,600);

//$im = imagecreate(160,50);
//imagecolorallocate($im, 255, 255, 255);
//$text_color = imagecolorallocate($im, 0, 0, 0);
//imagestring($im, 5, 20, 20,  'A  G  H  9  K  ', $text_color);
//header('Content-Type: image/jpeg');
//imagejpeg('../user/userImage/userImage.jpg');


require_once '../object/captchaImageClass.php';
//$im = imagecreatetruecolor(160,50);
////imagecolorallocate($im, 255, 255, 255);
//$text_color = imagecolorallocate($im, 255, 0, 0);
//imagestring($im, 5, 20, 20,  'm  m  m  m  m', $text_color);
//header('Content-Type: image/jpeg');
//$th=new thumbnail();
//echo $im;
$i=new captchaImage_class();
$i->createImage(50,160);