<?php
/**
 * Created by PhpStorm.
 * User: HL
 * Date: 2018/2/2
 * Time: 20:15
 */
require_once 'thumbnail.php';
class captchaImage_class
{
    private $captcha='';
    private $captchaI='';
    private $width;
    private $length;
    private $x;
    private $y;
    private $captchaArray=array('Z','S','E','4','X','d','R','5','C','f','T','6',
        'V','g','Y','7','B','h','u','8','N','J','i','9','m','k','O','0','l','P',
        'a','w','3','q','1','2');


    function getXY(){
        $this->x=rand(0,$this->length);
        $this->y=rand(0,$this->width);
    }

    function doCaptcha(){
        for($i=0;$i<5;$i++){
            $tmp=$this->captchaArray[rand(0,35)];
            $this->captcha.=$tmp;
            $this->captchaI.=$tmp."  ";
        }

    }

    function getCaptcha(){
        return $this->captcha;
    }

    function disturb($image,$num){
        for(;$num>0;$num--){
            $color=imagecolorallocate($image,rand(0,255),rand(0,255),rand(0,255));
            imageline($image,rand(0,40),rand(0,50),rand(120,160),rand(0,50),$color);
        }
    }

    public function createImage($length,$width)
    {
        $this->width=$width;
        $this->length=$length;
        $this->getXY();
        $this->doCaptcha();
        $im = imagecreate(160,50);
        imagecolorallocate($im, 255, 255, 255);
        $text_color = imagecolorallocate($im, 0, 0, 0);
        imagestring($im, 5, 20, 20,  $this->captchaI, $text_color);
        $file="../user/tmpImage/".$_SESSION['id'].".jpg";
        $this->disturb($im,10);
        imagejpeg($im,$file);

        header('Content-Type: image/jpeg');
        $th=new thumbnail();
        $th->img_create_small($file,$width,$length);
        //unlink($file);
    }

}