<?php
/**
 * Created by PhpStorm.
 * User: HL
 * Date: 2018/2/7
 * Time: 19:58
 */
$method = $_SERVER['REQUEST_METHOD'];
session_start();
switch ($method) {
    case "GET":
        if(!($_SESSION['id']&&$_SESSION['name'])){
            $reply['code']=404;
            $reply['error']="未登录";
        }else{
            $reply=array('code'=>200,'name'=>$_SESSION['name'],'id'=>$_SESSION['id']);
        }
        echo json_encode($reply);
        break;
}