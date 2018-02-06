<?php
$method = $_SERVER['REQUEST_METHOD'];
session_start();
require_once '../object/postClass.php';
$post=new postClass();
switch ($method) {
    case "POST":
        echo json_encode($post->post());
        break;
    case "DELETE":
        echo json_encode($post->delete());
        break;
    case "GET":
        echo json_encode($post->get());
        break;
    case "PUT":
        echo json_encode($post->put());
        break;
}