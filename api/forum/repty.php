<?php
require_once '../object/replyClass.php';
$obj=new replyClass();
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case "POST":
        $obj->post();
        break;
    case "DELETE":
        $obj->delete();
        break;
    case "GET":
        parse_str(file_get_contents('php://input'), $arguments);
        $id=$arguments['id'];
        $number=$arguments['number'];
        $amount=$arguments['amount'];
        echo json_encode($obj->get($id,$number,$amount));
        break;
}