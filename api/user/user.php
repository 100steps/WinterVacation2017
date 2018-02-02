//待加修改密码接口，修改密码方法，改进程序结构
<?php
require_once '../object/pdoHandleMysql.php';
$method = $_SERVER['REQUEST_METHOD'];
switch ($method){
    case "POST":
        $name=$_POST['name'];
        $email=$_POST['email'];
        $password=$_POST['password'];
        $captcha=$_POST['captcha'];
        if($captcha!=$_SESSION['captcha']) {
            $reply=array("code"=>422,"error"=>"验证码错误");
            echo json_encode($reply);
            break;
        }
        $obj=new pdoHandleMysql("no_hole-forum");
        if($obj->isExist('user','name',"{$name}")){
            $reply=array("code"=>422,"error"=>"用户名已注册");
            echo json_encode($reply);
            break;
        }
        if($obj->isExist('user','email',"{$email}")){
            $reply=array("code"=>422,"error"=>"邮箱已注册");
            echo json_encode($reply);
            break;
        }
        if($obj->postUser($name,$email,$password)){
            $reply=array("code"=>201);
            echo json_encode($reply);
        }
        else{
            $reply=array("code"=>422,"error"=>"写入数据库失败");
            echo json_encode($reply);
        }
        break;
    case "DELETE":
        parse_str(file_get_contents('php://input'), $arguments);
        $id=$arguments['id'];
        $password=$arguments['password'];
        $captcha=$arguments['captcha'];
        if($captcha!=$_SESSION['captcha']) {
            $reply=array("code"=>422,"error"=>"验证码错误");
            echo json_encode($reply);
            break;
        }
        if($id!=$_SESSION['id']){
            $reply=array("code"=>401,"error"=>"无权限");
            echo json_encode($reply);
            break;
        }
        $obj=new pdoHandleMysql("no_hole-forum");
        if(!$obj->isExist('user','id',"{$id}")){
            $reply=array("code"=>422,"error"=>"用户名已注册");
            echo json_encode($reply);
            break;
        }
        $data=$obj->selectPassword("user","id","{$id}");
        if($data[0][$password]==$password){
            if($obj->deleteUser("{$id}")){
                $reply=array("code"=>204);
                echo json_encode($reply);
                break;
            }
            else{
                $reply=array("code"=>400,"error"=>"用户注销失败");
                echo json_encode($reply);
                break;
            }
        }
        else{
            $reply=array("code"=>401,"error"=>"用户密码错误");
            echo json_encode($reply);
            break;
        }
        break;
    case "GET":
        $id=$_GET['id'];
        $obj=new pdoHandleMysql("no_hole-forum");
        if(!$obj->isExist('user','id','{$id}')){
            $reply=array("code"=>404,"error"=>"用户不存在");
            echo json_encode($reply);
            break;
        }
        $data=$obj->selectData('user','id',"{$id}");
        $data=$data[0];
        $data["code"]=200;   //添加code
        echo json_encode($data);
        break;
    case "PUT":
        parse_str(file_get_contents('php://input'), $arguments);
        $id=$arguments['id'];
        $name=$arguments['name'];
        $email=$arguments['email'];
        $sex=$arguments['sex'];
        $birthday=$arguments['birthday'];
        $province=$arguments['province'];
        $city=$arguments['city'];
        $phoneNumber=$arguments['phoneNumber'];
        $qq=$arguments['qq'];
        $signature=$arguments['signature'];
        $imageUrl=$arguments['imageUrl'];
        if($id!=$_SESSION['id']){
            $reply=array("code"=>401,"error"=>"用户没有权限");
            echo json_encode($reply);
            break;
        }
        if($obj->putUser($id,$name,$email,$sex,$birthday,$province,$city,$phoneNumber,$qq,$signature,$imageUrl)){
            $reply=array("code"=>201);
            echo json_encode($reply);
            break;
        }
        else{
            $reply=array("code"=>400,"error"=>"修改失败");
            echo json_encode($reply);
            break;
        }
        break;
}