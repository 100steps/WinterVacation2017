<?php
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case "POST":
        $nameOrEmail=$_POST['nameOrEmail'];
        $password=$_POST['password'];
        $captcha=$_POST['captcha'];
        if($captcha!=$_SESSION['captcha']){
            $reply = array("code" => 401,"error"=>"验证码错误");
            echo json_encode($reply);
            break;
        }
        $obj=new userClass();
        if(stripos($nameOrEmail,".com")){
            if(!$obj->isExist('user','email',"{$nameOrEmail}")){
                $reply = array("code" => 204,"error"=>"该邮箱未注册");
                echo json_encode($reply);
                break;
            }
            $data=$obj->selectData('user','email',"{$nameOrEmail}",'(password)');
            if($data[0]['password']==$password){
                $_SESSION['id']=$data[0]['id'];
                $reply = array("code" => 201,"id"=>"{$data[0]['id']}","name"=>"$data[0]['name']");
                echo json_encode($reply);
                break;
            }
            else{
                $reply = array("code" => 401,"error"=>"密码错误");
                echo json_encode($reply);
                break;
            }

        }
        else{
            if(!$obj->isExist('user','name',"{$nameOrEmail}")){
                $reply = array("code" => 204,"error"=>"该用户名未注册");
                echo json_encode($reply);
                break;
            }
            $data=$obj->selectData('user','name',"{$nameOrEmail}",'(password)');
            if($data[0]['password']==$password){
                $_SESSION['id']=$data[0]['id'];
                $reply = array("code" => 201,"id"=>"{$data[0]['id']}","name"=>"$data[0]['name']");
                echo json_encode($reply);
                break;
            }
            else{
                $reply = array("code" => 401,"error"=>"密码错误");
                echo json_encode($reply);
                break;
            }

        }

    case "DELETE":
        $_SESSION['id']=null;
        $reply = array("code" => 204);
        echo json_encode($reply);
        break;

}