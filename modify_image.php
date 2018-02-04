<?php
$username=$_POST['UserName'];
$userid=$_POST['UserId'];
$userpassword=$_POST['UserPassword'];
$sex=$_POST['Sex'];
$birth=$_POST['Birth'];
$QQ=$_POST['QQ'];
$email=$_POST['Email'];
$xuliehao=$_POST['Number'];

if($xuliehao=="fklajKLAJD544658ikO9" or $xuliehao=="iexikKWJIK54654ueO8" or $xuliehao=="fkaldKJFKIE87458kdJ7"){
    $power="1";
}else{
    $power="0";
}


if($sex=="性别未知"){
    $sex="null";
}else{
    $sex="'".$sex."'";
}
if($birth==""){
    $birth="null";
}else{
    $birth="'".$birth."'";
}
if($QQ==""){
    $QQ="null";
}else{
    $QQ="'".$QQ."'";
}
if($email==""){
    $email="null";
}else{
    $email="'".$email."'";
}
if($_FILES['UserPhoto']['size']>0) {
    $str = "/(.)+\/((.)+)/";
    preg_match($str, $_FILES["UserPhoto"]["type"], $output);
    $diction = "userphoto/" . $userid . "." . $output[2];
    move_uploaded_file($_FILES["UserPhoto"]["tmp_name"], $diction);
}else{
    $diction="userphoto/root.png";
}
include_once("pdo_db.php");
$sql="update `users` set `username`='$username',`userpassword`='$userpassword',`userphoto`='$diction',`sex`=$sex,`birth`=$birth,`QQ`=$QQ,`email`=$email,`power`=`$power` where `userid`=$userid";
$res=$dbh->exec($sql);