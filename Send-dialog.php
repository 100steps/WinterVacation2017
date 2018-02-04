<?php
if(isset($_COOKIE['userid'])){
    $sender=$_COOKIE['userid'];
    $receiver=$_POST['Receiver'];
    $chattext=$_POST['ChatText'];
    date_default_timezone_set("Asia/Shanghai");
    $time=date("Y-m-d H:i:s");
    include_once("pdo_db.php");
    $sql="insert into `chat-image` values(null,'$sender','$receiver','$chattext','$time')";
    $res=$dbh->exec($sql);
}