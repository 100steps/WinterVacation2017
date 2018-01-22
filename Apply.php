<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 2018/1/22
 * Time: 11:39
 */
session_start();
$username=$_POST['UserName'];
$userid=$_POST['UserId'];
$userpassword=$_POST['UserPassword'];
$code=$_POST['Code'];
$str="/(.)+\/((.)+)/";
preg_match($str,$_FILES["UserPhoto"]["type"],$output);
$diction="userphoto/".$userid.".".$output[2];
move_uploaded_file($_FILES["UserPhoto"]["tmp_name"], $diction);
if($code!=$_SESSION['code']){
    $msg="验证码错误！";
    $result="N";
    $id="";
}else{
    $msg="";
    include_once("pdo_db.php");
    $sql = "insert into users values(null,'$username','$userid','$userpassword','$diction')";
    $res = $dbh->exec($sql);
    if($res){
        $result="Y";
        $id=$userid;
    }else{
        $result="N";
        $msg="未录入数据库";
        $id="";
    }
}
echo json_encode(array('result'=>$result,'msg'=>$msg,'userid'=>$id));






