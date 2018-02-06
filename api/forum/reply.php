<?php
require_once '../object/replyClass.php';
$obj=new replyClass();
$method = $_SERVER['REQUEST_METHOD'];
session_start();
switch ($method) {
    case "POST":
        echo json_encode($obj->post());
        break;
    case "DELETE":
        echo json_encode($obj->delete());
        break;
    case "GET":
        $id=$_GET['id'];
        $number=$_GET['number'];
        $amount=$_GET['amount'];
        echo json_encode($obj->get($id,$number,$amount));
        break;
}