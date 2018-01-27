<?php
include_once("pdo_db.php");
date_default_timezone_set("Asia/Shanghai");
$time=date("Y-m-d H:i:s");
$content=$_POST['Content'];
$quoter=$_POST['Floor'];
$noteid=$_POST['Noteid'];
if(isset($_COOKIE['userid'])){
    $userid=$_COOKIE['userid'];
    $sql="INSERT INTO `$noteid` (`id`, `floorcontent`, `userid`, `quoter`, `time`, `praise`) VALUES (NULL, '$content', '$userid', '$quoter', '$time', NULL)";
    $res=$dbh->exec($sql);
    if($res){
        $result="Y";
        $msg="";
    }else{
        $result="N";
        $msg="录入数据库失败";
    }
}else{
    $result="N";
    $msg="未登录";
}
echo json_encode(array("result"=>$result,"msg"=>$msg));