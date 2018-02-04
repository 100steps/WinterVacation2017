<?php
$id=$_GET['Id'];
$receiver=$_GET['Receiver'];
if(isset($_COOKIE['userid'])){
    include_once("pdo_db.php");
    $sender=$_COOKIE['userid'];
    $sql="select `id` from `chat-image` where `sender`=$receiver and `receiver`=$sender or `sender`=$sender and `receiver`=$receiver order by `id` desc limit 1";
    $res=$dbh->query($sql);
    while($row=$res->fetch()){
        $id2=$row['id'];
    }
    if($id!=$id2){
    $sql2="select*from `chat-image` where (`sender`=$receiver and `receiver`=$sender or `sender`=$sender and `receiver`=$receiver) and `id`>$id";
    $res2=$dbh->query($sql2);
    $new_image=array();
    $i=1;
    while($row2=$res2->fetch()){
        $new_image[$i]=array(
           "sender"=>$row2['sender'],
            "image"=>$row2['image'],
            "time"=>$row2['time']
        );
        $i++;
    }
    }else{
        $new_image="";
    }
    echo json_encode(array("new_image"=>$new_image,"id"=>$id2));
}else{
    echo "未登录";
}

