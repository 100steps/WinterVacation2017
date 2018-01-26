<?php
$method = $_SERVER['REQUEST_METHOD'];
switch ($method){
    case "POST":
        $reply=array("code"=>201);
        echo json_encode($reply);
        break;
    case "DELETE":
        $reply=array("code"=>204);
        echo json_encode($reply);
        break;
    case "GET":
        $reply=array("code"=>200,"name"=>"user","email"=>"123@qq.com","sex"=>"male","birthday"=>"2017-1-1",
            "province"=>"广东","city"=>"广州","phoneNumber"=>"123456","qq"=>123456,"signature"=>"哈哈哈哈",
            "imageurl"=>"http://localhost/no_hole-forum-doc/api/user/userimage.php");
        echo json_encode($reply);
        break;
    case "PUT":
        $reply=array("code"=>200);
        echo json_encode($reply);
        break;
}