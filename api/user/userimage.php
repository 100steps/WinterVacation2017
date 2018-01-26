<?php
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case "GET":
        header('content-type:image/jpg;');
        $content=file_get_contents('./userimage/userimage.jpg');
        echo $content;
        break;
    case "PUT":
        $reply = array("code"=>201);
        echo json_encode($reply);
        break;
}