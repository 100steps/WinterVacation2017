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
        $reply = array("code"=>200,
            1=>array("number"=>1,"user"=>"user","date"=>"2018-1-26","text"=>"这是第一个回复"));
        echo json_encode($reply);
        break;
}