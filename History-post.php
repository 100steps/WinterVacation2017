<?php
$userid=$_GET['Userid'];
include_once("pdo_db.php");
$sql_note="select `id`,`notename`,`notename`,`time` from `forum` where `userid`=$userid";
$res_note=$dbh->query($sql_note);
$note=array();
$i=1;
while($row_note=$res_note->fetch()){
    $sql="select `username`,`userphoto` from `users` where `userid`=$userid";
    $res=$dbh->query($sql);
    while($row=$res->fetch()){
        $note[$i]=array(
            "noteid"=>$row_note['id'],
            "notename"=>$row_note['notename'],
            "time"=>$row_note['time'],
            "username"=>$row['username'],
            "userphoto"=>$row['userphoto'],
            "userid"=>$userid
        );
    }
    $i++;
}
echo json_encode(array("note"=>$note));