<?php
require_once '../object/thumbnail.php';
session_start();
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case "GET":
        header('content-type:image/jpg;');
        $fileName="./userImage/".$_GET['id'].".jpg";
        if($_GET['type']=="original"){
            $content=file_get_contents($fileName);
            echo $content;
        }else{
            $th=new thumbnail();
            $content=$th->img_create_small($fileName,$_GET['width'],$_GET['length']);
        }
        break;
    case "PUT":
        $put=fopen('php://input','r');   //更新头像
        $fileName="./userImage/".$_SESSION['id'].".jpg";
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