<?php
/**
 * Created by PhpStorm.
 * User: HL
 * Date: 2018/2/5
 * Time: 11:42
 */
header('content-type:text/html;charset=utf-8');
require_once '../object/userClass.php';
$method = $_SERVER['REQUEST_METHOD'];
session_start();
switch ($method) {
    case "PUT":
        if(!$_SESSION['id']){
            $reply=array("code"=>401,"error"=>"用户未登陆");
            echo json_encode($reply);
            break;
        }
        parse_str(file_get_contents('php://input'), $arguments);
        $oldPassword=$arguments['oldPassword'];
        $newPassword=$arguments['newPassword'];
        $newPassword=password_hash($newPassword, PASSWORD_DEFAULT);
        $obj=new userClass();
        $password=$obj->selectData('user','id',$_SESSION['id'],'(password)');
        $password=$password[0]['password'];
        if(!$password){
            $reply=array("code"=>422,"error"=>"用户未注册");
            echo json_encode($reply);
            break;
        }
        if(password_verify($oldPassword,$password)){
            $sql="update user set password='{$newPassword}'where id='{$_SESSION['id']}'";
            if($obj->dbh->exec($sql)==1){
                $reply=array("code"=>201);
                echo json_encode($reply);
                break;
            }
            else
                $reply=array("code"=>400,"error"=>"修改失败");
            echo json_encode($reply);
            break;
        }else{
            $reply = array("code" => 401,"error"=>"密码错误");
            echo json_encode($reply);
            break;
        }
}