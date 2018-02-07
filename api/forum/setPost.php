<?php
$method = $_SERVER['REQUEST_METHOD'];
session_start();
require_once '../object/basisHandleMysql.php';
$obj=new basisHandleMysql();
switch ($method) {
    case "PUT":
        parse_str(file_get_contents('php://input'), $arguments);
        $id=$arguments['id'];
        $top=$arguments['top'];
        $essential=$arguments['essential'];
        $data=$obj->selectData('post','id',$id);
        $section=$obj->selectData('sections','name',$data[0]['section']);
        if($_SESSION['id']==1||$section[0]['moderator']==$_SESSION['name']){    //判断权限
            $obj->dbh->beginTransaction();
            $topExec=1;           //初始化三个变量，记录数据库是否操作成功
            $listTop=1;
            $essentialExec=1;
            if($top!=$data[0]['top']){
                $sql="update postlist set top='{$top}'where id='{$id}'";
                $listTop=$obj->dbh->exec($sql);
                $sql="update post set top='{$top}'where id='{$id}'";
                $topExec=$obj->dbh->exec($sql);
            }
            if($essential!=$data[0]['essential']){
                $sql="update post set essential='{$essential}'where id='{$id}'";
                $essentialExec=$obj->dbh->exec($sql);
            }
            //echo $top."lt".$listTop."e".$essential."le".$listEssential;
            if($topExec==1&&$listTop==1&&$essentialExec==1){
                $reply = array("code" => 201);
                $obj->dbh->commit();
                echo json_encode($reply);
            }
            else{
                $obj->dbh->rollBack();
                $reply = array("code" => 500,"error"=>"修改失败");
                echo json_encode($reply);
            }
        }else{
            $reply = array("code" => 401,"error"=>"没有权限");
            echo json_encode($reply);
        }
}