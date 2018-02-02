<?php
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case "GET":
        $reply = array("code"=>200,"number"=>1,
            array("id"=>000001,"title"=>"这是第一个帖子","author"=>"user","date"=>"2018-1-26",
                "reply"=>1,"url"=>"http://localhost/no_hole-forum-doc/api/forum/post.php?id=000001"));
        echo json_encode($reply);
        break;
}