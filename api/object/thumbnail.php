<?php

class thumbnail
{
    function img_create_small($big_img, $width, $height, $small_img=null) {//原图地址，缩略图宽度，高度，缩略图地址
        $image = getimagesize($big_img);
        switch ($image[2]) {
            case 2:
                $im = imagecreatefromjpeg($big_img);
                break;
            case 3:
                $im = imagecreatefrompng($big_img);
                break;
        }
        $src_W = $image[0]; //获取原图宽度
        $src_H = $image[1]; //获取原图高度
        $tn = imagecreatetruecolor($width, $height); //创建缩略图
        imagecopyresampled($tn, $im, 0, 0, 0, 0, $width, $height, $src_W, $src_H); //复制图像并改变大小
        header('Content-Type: image/jpeg');
        return imagejpeg($tn, $small_img);

    }

}