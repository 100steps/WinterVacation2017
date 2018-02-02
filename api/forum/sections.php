<?php
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case "POST":
        $reply = array("code" => 201);
        echo json_encode($reply);
        break;
    case "DELETE":
        $reply = array("code" => 204);
        echo json_encode($reply);
        break;
    case "GET":
        $reply = array("code"=>200,"amount"=>2,
            1=>array("name"=>"生活","moderator"=>"user","introduce"=>"此版块暂无介绍"),
            2=>array("name"=>"学习","moderator"=>"user","introduce"=>"此版块暂无介绍"));
        echo json_encode($reply);
        break;
    case "PUT":
        $reply = array("code"=>201);
        echo json_encode($reply);
        break;
}