<?php
require_once '../object/captchaImageClass.php';
$obj=new captchaImageClass();
$method = $_SERVER['REQUEST_METHOD'];
session_start();
switch ($method) {
    case "GET":
        header('content-type:image/jpg;');
        $image=$obj->createImage($_GET['length'],$_GET['width']);
        $content=file_get_contents($image);
        $_SESSION['captcha']=$obj->getCaptcha();//验证码保留在SESSION中，收到客户端的验证码时与之对比
        echo $content;
        unlink($image);
        break;
}