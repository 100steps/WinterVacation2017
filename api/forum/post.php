<?php
$method = $_SERVER['REQUEST_METHOD'];
require_once '../object/postClass.php';
$post=new postClass();
switch ($method) {
    case "POST":
        $post->post();
        break;
    case "DELETE":
        $post->delete();
        break;
    case "GET":
        $post->get();
        break;
    case "PUT":
        $post->put();
        break;
}