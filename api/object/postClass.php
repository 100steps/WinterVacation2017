<?php
/**
 * Created by PhpStorm.
 * User: HL
 * Date: 2018/2/3
 * Time: 16:24
 */
require_once 'basisHandleMysql.php';
require_once 'replyClass.php';
require_once '../object/blacklistClass.php';
class postClass extends basisHandleMysql
{

    function post(){
        $title=$_POST['title'];
        $text=$_POST['text'];
        $section=$_POST['section'];
        $captcha=$_POST['captcha'];
        date_default_timezone_set("Asia/Shanghai");
        $date=date('Y-m-d H:i:s');
        $author=$_SESSION['name'];
        if(strcasecmp($captcha,$_SESSION['captcha'])!=0||!$_SESSION['captcha']){//检测验证码是否为空以防不请求验证码直接访问
            $reply = array("code" => 401,"error"=>"验证码错误");
            $_SESSION['captcha']=null;
            return $reply;
        }
        $_SESSION['captcha']=null;
        $black=new blacklistClass();
        if($black->isBlack($author,$section)){
            $reply = array("code" => 401,"error"=>"已被关进小黑屋");
            return $reply;
        }
        if(!$this->isExist('sections','name',$section)){
            $reply = array("code" => 204,"error"=>"无此版块");
            return $reply;
        }
        $this->dbh->beginTransaction();//开启事务，更新post和postList都成功才能成功
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
        $captcha=$arguments['captcha'];
        if(strcasecmp($captcha,$_SESSION['captcha'])!=0||!$_SESSION['captcha']){
            $reply = array("code" => 401,"error"=>"验证码错误");
            $_SESSION['captcha']=null;
            return $reply;
        }
        $_SESSION['captcha']=null;
        if(!$this->isExist('post','id',"$id")){
            $reply = array("code" => 404,"error"=>"空帖子");
            return $reply;
        }
        $data=$this->selectData('post','id',$id);
        $section=$this->selectData('sections','name',$data[0]['section']);
        $black=new blacklistClass();
        if($black->isBlack($_SESSION['name'],$section)){
            $reply = array("code" => 401,"error"=>"已被关进小黑屋");
            return $reply;
        }
        if($_SESSION['id']==1||$section[0]['moderator']==$_SESSION['name']||$_SESSION['name']==$data[0]['author']){//检测权限
            $this->dbh->beginTransaction();//通过删除再插入来更新在number
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
        $amount=$_GET['amount'];
        $data=$this->selectData('post','id',$id);
        if($data!=0){
            $obj=new replyClass();
            $data=$data[0];
            $data['code']=200;
            $data['reply']=$obj->get($id,1,$amount);
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
            $this->dbh->beginTransaction();//在post和postList中删除
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