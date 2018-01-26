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
        $reply = array("code"=>200);
        echo json_encode($reply);
        break;
    case "PUT":
        $reply = array("code"=>200);
        echo json_encode($reply);
        break;
}