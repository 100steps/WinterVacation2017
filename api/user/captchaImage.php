<?php
require_once '../object/captchaImageClass.php';
$obj=new captchaImageClass();
$method = $_SERVER['REQUEST_METHOD'];
//session_start();
switch ($method) {
    case "GET":
        header('content-type:image/jpg;');
        $content=$obj->createImage($_GET['length'],$_GET['width']);
        $_SESSION['captcha']=$obj->getCaptcha();
        echo $content;
        break;
}