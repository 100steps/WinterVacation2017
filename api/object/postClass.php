<?php
/**
 * Created by PhpStorm.
 * User: HL
 * Date: 2018/2/3
 * Time: 16:24
 */
require_once '../object/replyClass.php';
class postClass extends basisHandleMysql
{

    function post(){
        $title=$_POST['title'];
        $text=$_POST['text'];
        $section=$_POST['section'];
        date_default_timezone_set("Asia/Shanghai");
        $dateTime=date('Y-m-d-H-i-s');
        $author=$_SESSION['name'];
        $sql="insert into post (title,text,section,dateTime,author) values
                  ('{$title}','{$text}','{$section}','{$dateTime}','{$author}')";
        if($this->dbh->exec($sql)==1){
            $reply = array("code" => 201);
            echo json_encode($reply);
        }else{
            $reply = array("code" => 400,"error"=>"创建失败");
            echo json_encode($reply);
        }
    }

    function put(){
        parse_str(file_get_contents('php://input'), $arguments);
        $title=$arguments['title'];
        $text=$arguments['text'];
        $id=$arguments['id'];
        if(!$this->isExist('post','id',"$id")){
            $reply = array("code" => 404,"error"=>"空帖子");
            echo json_encode($reply);
            return ;
        }
        $data=$this->selectData('post','id',$id);
        $section=$this->selectData('sections','name',"$data[0][section]");
        if($_SESSION['id']==00001||$section[0]['moderator']==$_SESSION['name']||$_SESSION['name']==$data[0]['author']){
            $sql="update user set title='{$title}',text='{$text}'";
            if($this->dbh->exec($sql)==1){
                $reply = array("code" => 201);
                echo json_encode($reply);
            }else{
                $reply = array("code" => 500,"error"=>"修改失败");
                echo json_encode($reply);
            }
        }else{
            $reply = array("code" => 401,"error"=>"没有权限");
            echo json_encode($reply);
        }
    }

    function get(){
        $id=$_GET['id'];
        $data=$this->selectData('post','id',$id);
        if($data){
            $obj=new replyClass();
            $data=$data[0];
            $data['code']=200;
            $data['reply']=$obj->get($id,1,10);
        }else{
            $data['code']=404;
            $data['error']="查询失败";
        }
        echo json_encode($data);
    }

    function delete(){
        parse_str(file_get_contents('php://input'), $arguments);
        $id=$arguments['id'];
        if(!$this->isExist('post','id',"$id")){
            $reply = array("code" => 404,"error"=>"空帖子");
            echo json_encode($reply);
            return ;
        }
        $data=$this->selectData('post','id',$id);
        $section=$this->selectData('sections','name',"$data[0][section]");
        if($_SESSION['id']==00001||$section[0]['moderator']==$_SESSION['name']||$_SESSION['name']==$data[0]['author']){
            if($this->deleteRow('sections','name',"{$section}")){
                $reply = array("code" => 204);
                echo json_encode($reply);
            }else{
                $reply = array("code" => 404,"error"=>"删除失败");
                echo json_encode($reply);
            }
        }else{
            $reply = array("code" => 401,"error"=>"没有权限");
            echo json_encode($reply);
        }
    }
}