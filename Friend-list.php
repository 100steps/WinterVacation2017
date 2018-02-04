<?php
if(isset($_COOKIE['userid'])) {
    $userid = $_COOKIE['userid'];
    include_once("pdo_usersdb.php");
    $sql = "select*from `$userid` order by `id`";
    $res = $dbh->query($sql);
    $friend = array();
    $i = 1;
    while ($row = $res->fetch()) {
        $friend[$i] = $row['userid'];
        $i++;
    }
    include_once("pdo_db.php");
    for ($i = 1; $i <= count($friend); $i++) {
        $userid2 = $friend[$i];
        $sql2 = "select `username`,`userphoto` from `users` where `userid`=$userid2";
        $res2 = $dbh->query($sql2);
        while ($row2 = $res2->fetch()) {
            $friend[$i] = array(
                "friendname" => $row2['username'],
                "friendid" => $userid2,
                "friendphoto" => $row2['userphoto']
            );
        }
    }
    echo json_encode(array("friend"=>$friend));
}