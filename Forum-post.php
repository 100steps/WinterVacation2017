<?php
if(isset($_COOKIE['userid'])){
    $userid=$_COOKIE['userid'];
    $notename=$_POST['Notename'];
    $notecontent=$_POST['Content'];
    date_default_timezone_set("Asia/Shanghai");
    $time=date("Y-m-d H:i:s");
//$date1=date_create("$time");
//$date2=date_create("2017-01-24");
//$diff=date_diff($date1,$date2);
//echo $diff->format("%R%a days");

    include_once("pdo_db.php");
//录入标题集表
    $sql="insert into forum values(null,'$userid','$notename','0','$time','$time','0')";
    $res=$dbh->exec($sql);
    if($res){
        $sql2="select id from forum order by id desc limit 1";
        $res2=$dbh->query($sql2);
        $noteid=$res2->fetch()['id'];
    }else{
        $result="N";
        $msg="无法录入数据库";
    }
//为新帖子建表
    $createform="CREATE TABLE `tieba`.`$noteid` (
    `id` INT NOT NULL auto_increment,
    `floorcontent` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_bin  NOT NULL,
    `userid` BIGINT(18) NOT NULL ,
    `quoter` INT,
    `time` DATETIME NOT NULL,
    `praise` TEXT CHARACTER SET utf8 COLLATE utf8_bin,
    PRIMARY KEY (`id`)
    )";
    $res3=$dbh->exec($createform);
//向新表录入帖子内容和用户id
  $sql3="INSERT INTO `$noteid` (`id`, `floorcontent`, `userid`, `quoter`, `time`, `praise`) VALUES (NULL, '$notecontent', '$userid','0', '$time', NULL);";
  $res4=$dbh->exec($sql3);
  if($res4){
      $result="Y";
      $msg="成功发帖";
  }else{
      $result="N";
      $msg="无法录入数据库";
  }
//返回结果
//{
//1.result："Y"  (成功)  msg: ""
//2.result："N"  (失败)  msg: "无法录入数据库"   数据库出现异常的情况--请联系后端
//}
    echo json_encode(array('result'=>$result,'msg'=>$msg));
}else{
    echo json_encode(array('result'=>"N",'msg'=>"请先登录"));
}