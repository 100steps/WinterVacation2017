<?php
require_once '../object/thumbnail.php';
require_once '../object/basisHandleMysql.php';
session_start();
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case "GET":
        header('content-type:image/jpg;');
        if(is_file("../../userImage/".$_GET['name'].".jpg"))
            $fileName="../../userImage/".$_GET['name'].".jpg";
        else
            $fileName="../../userImage/userImage.jpg";
        if($_GET['type']=="original"){
            $content=file_get_contents($fileName);
            echo $content;
        }else{
            $th=new thumbnail();
            $content=$th->img_create_small($fileName,$_GET['width'],$_GET['length']);
        }
        break;
    case "PUT":
        if(!$_SESSION['name']){
            $reply=array("code"=>401,"error"=>"用户未登陆");
            echo json_encode($reply);
            break;
        }
        $file="../../userImage/".$_SESSION['name'].".jpg";
        if(!is_file($file)){
            $obj=new basisHandleMysql();
            $sql="update user set imageUrl='{$file}' where name='{$_SESSION['name']}'";
            if($obj->dbh->exec($sql)!=1){
                $reply = array("code"=>422,"error"=>"写入数据库失败");
                echo json_encode($reply);
                break;
            }
        }
        $put=fopen('php://input','r');   //更新头像
        $fileName="../../userImage/".$_SESSION['name'].".jpg";
        $image=fopen($fileName,'w');
        while(!feof($put)){
            fwrite($image,fgets($put));
        }
        fclose($image);
        fclose($put);
//        header('content-type:image/jpg;');
//        $content=file_get_contents('hhh');
//        echo $content;
//        print_r(getimagesize('php://input'));
//        echo file_get_contents('php://input');
        //$file=$_FILES['file'];
        //$address="./userImage/user200.jpg";
        //move_uploaded_file($file['tmp_name'],$address);
        $reply = array("code"=>201);
        echo json_encode($reply);
        break;
}