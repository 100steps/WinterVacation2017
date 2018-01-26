<?php
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case "GET":
        header('content-type:image/jpg;');
        $content=file_get_contents('./userImage/userImage.jpg');
        echo $content;
        break;
}