<?php
    $userid = $_POST['Userid'];
    include_once('pdo_db.php');
    $sql = "select `username`,`userphoto` from `users` where `userid`= $userid ";
    $res = $dbh->query($sql);
    while($row = $res->fetch()) {
        $username = $row['username'];
        $userphoto = $row['userphoto'];
    }
    echo json_encode(array("username"=>$username,"userphoto"=>$userphoto));
 ?>