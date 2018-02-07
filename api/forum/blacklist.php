<?php
/**
 * Created by PhpStorm.
 * User: HL
 * Date: 2018/2/7
 * Time: 18:18
 */
$method = $_SERVER['REQUEST_METHOD'];
session_start();
require_once '../object/blacklistClass.php';
$obj=new blacklistClass();
switch ($method) {
    case "POST":
        if($obj->checkPrivilege($_SESSION['name'],$_POST['section']))
            if($obj->add($_POST['section'],$_POST['name']))
                $reply = array("code" => 201);
            else
                $reply = array("code" => 400,"error"=>"加入黑名单失败");
        else
            $reply = array("code" => 401,"error"=>"没有权限");
        echo json_encode($reply);
        break;

    case "DELETE":
        parse_str(file_get_contents('php://input'), $arguments);
        $name=$arguments['name'];
        $section=$arguments['section'];
        if(!$obj->isExist('user','name',$name)){
            $reply = array("code" => 404,"error"=>"没有该用户");
        }else{
            if($obj->checkPrivilege($name,$section)){
                if($obj->delete($name, $section))
                    $reply = array("code" => 204);
                else
                    $reply = array("code" => 404,"error"=>"取消黑名单失败");
            }
            else
                $reply = array("code" => 401,"error"=>"没有权限");
        }
        echo json_encode($reply);
        break;

    case "GET":
        $obj=new blacklistClass();
        if(!$obj->checkPrivilege($_SESSION['name'],$_GET['section'])){
            $reply = array("code" => 401,"error"=>"没有权限");
            echo json_encode($reply);
            break;
        }
        $data=$obj->get($_GET['section']);
        if($data!=0){
            $reply['code']=200;
            $reply['amount']=count($data);
            $reply['list']=$data;
        }else{
            $reply=array('code'=>404,'error'=>"查询失败");
        }
        echo json_encode($reply);
        break;
}