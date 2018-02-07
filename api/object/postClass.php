<?php
/**
 * Created by PhpStorm.
 * User: HL
 * Date: 2018/2/3
 * Time: 16:24
 */
require_once 'basisHandleMysql.php';
require_once 'replyClass.php';
class postClass extends basisHandleMysql
{

    function post(){
        $title=$_POST['title'];
        $text=$_POST['text'];
        $section=$_POST['section'];
        date_default_timezone_set("Asia/Shanghai");
        $date=date('Y-m-d H:i:s');
        $author=$_SESSION['name'];
        if(!$this->isExist('sections','name',$section)){
            $reply = array("code" => 204,"error"=>"无此版块");
            return $reply;
        }
        $this->dbh->beginTransaction();
        $sql="insert into post (title,text,section,date,author) values
                  ('{$title}','{$text}','{$section}','{$date}','{$author}')";
        $post=$this->dbh->exec($sql);
        $id=$this->select('post','id',
            "date='{$date}' and author='{$_SESSION['name']}'")[0]['id'];
        $sql="insert into postList (id,section,top) values ('{$id}',
               '{$section}',0)";
        $postList=$this->dbh->exec($sql);
        if($post==1&&$postList==1){
            $this->dbh->commit();
            $reply = array("code" => 201,"id"=>$id);
            return $reply;
        }else{
            $this->dbh->rollBack();
            $reply = array("code" => 400,"error"=>"创建失败");
            return $reply;
        }
    }

    function put(){
        parse_str(file_get_contents('php://input'), $arguments);
        $title=$arguments['title'];
        $text=$arguments['text'];
        $id=$arguments['id'];
        if(!$this->isExist('post','id',"$id")){
            $reply = array("code" => 404,"error"=>"空帖子");
            return $reply;
        }
        $data=$this->selectData('post','id',$id);
        $section=$this->selectData('sections','name',$data[0]['section']);
        if($_SESSION['id']==1||$section[0]['moderator']==$_SESSION['name']||$_SESSION['name']==$data[0]['author']){
            $this->dbh->beginTransaction();
            $data=$this->select('postList','section,top',"id = '{$id}'");
            $delete=$this->deleteRow('postList','id',$id);
            $sql="insert into postList (id,section,top) values ('{$id}',
               '{$data[0]['section']}','{$data[0]['top']}')";
            $put=$this->dbh->exec($sql);
            $sql="update post set title='{$title}',text='{$text}'where id='{$id}'";
            $set=$this->dbh->exec($sql);
            if($set==1&&$put==1&&$delete){
                $this->dbh->commit();
                $reply = array("code" => 201);
                return $reply;
            }else{
                $this->dbh->rollBack();
                $reply = array("code" => 500,"error"=>"修改失败");
                return $reply;
            }
        }else{
            $reply = array("code" => 401,"error"=>"没有权限");
            return $reply;
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
        return $data;
    }

    function delete(){
        parse_str(file_get_contents('php://input'), $arguments);
        $id=$arguments['id'];
        if(!$this->isExist('post','id',"$id")){
            $reply = array("code" => 404,"error"=>"空帖子");
            return $reply;
        }
        $data=$this->selectData('post','id',$id);
        $section=$this->selectData('sections','name',$data[0]['section']);
        if($_SESSION['id']==1||$section[0]['moderator']==$_SESSION['name']
            ||$_SESSION['name']==$data[0]['author']){
            $this->dbh->beginTransaction();
            if($this->deleteRow('post','id',$id)
                &&$this->deleteRow('postList','id',$id)){
                $this->dbh->commit();
                $reply = array("code" => 204);
                return $reply;
            }else{
                $this->dbh->rollBack();
                $reply = array("code" => 404,"error"=>"删除失败");
                return $reply;
            }
        } else{
            $reply = array("code" => 401,"error"=>"没有权限");
            return $reply;
        }
    }
}