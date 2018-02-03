<?php
require_once '../object/sectionsClass.php';
$method = $_SERVER['REQUEST_METHOD'];
$sections=new sectionsClass();
switch ($method) {
    case "POST":
        $name=$_POST['name'];
        $moderator=$_POST['moderator'];
        $introduce=$_POST['introduce'];
        $sections->postSection($name,$moderator,$introduce);
        break;
    case "DELETE":
        parse_str(file_get_contents('php://input'), $arguments);
        $name=$arguments['name'];
        $sections->deleteSection($name);
        break;
    case "GET":
        $sections->getSections();
        break;
    case "PUT":
        parse_str(file_get_contents('php://input'), $arguments);
        $name=$arguments['name'];
        $moderator=$arguments['moderator'];
        $introduce=$arguments['introduce'];
        $sections->putSections($name,$moderator,$introduce);
        break;
}