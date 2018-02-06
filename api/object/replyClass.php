<?php
/**
 * Created by PhpStorm.
 * User: HL
 * Date: 2018/2/3
 * Time: 22:24
 */
require_once 'basisHandleMysql.php';
class replyClass extends basisHandleMysql
{
    function post(){
        $id=$_POST['id'];
        $text=$_POST['text'];
        date_default_timezone_set("Asia/Shanghai");
        $date=date('Y-m-d H:i:s');
        $user=$_SESSION['name'];
        $data=$this->selectData('post','id',$id);
        if(!$data){
            $reply = array("code" => 404,"error"=>"空帖子");
            return $reply;
        }
        $this->dbh->beginTransaction();
        $replyAmount=$data[0]['replyAmount']+1;
        $replyNumber=$data[0]['replyNumber']+1;
        $sql="update post set replyAmount='{$replyAmount}',replyNumber='{$replyNumber}'where id='{$id}'";
        $set=$this->dbh->exec($sql);
        $delete=$this->deleteRow('postList','id',$id);
        $sql="insert into postList (id) values ('{$id}')";
        $put=$this->dbh->exec($sql);
        $sql="insert into reply (id,text,date,user,number) values
                  ('{$id}','{$text}','{$date}','{$user}','{$replyNumber}')";
        $insert=$this->dbh->exec($sql);
        if($insert==1&&$set==1&&$put==1&&$delete){
            $reply = array("code" => 201);
            $this->dbh->commit();
            return $reply;
        }else{
            $reply = array("code" => 400,"error"=>"创建失败");
            $this->dbh->rollBack();
            return $reply;
        }
    }

    function get($id,$number,$amount){
//        $begin=$number-1;
//        $end=$number+$amount;
        //$sql="select*from reply where id = '{$id}' and number > '{$begin}' and number <'{$end}'";
        $stmt=$this->selectData('reply','id',$id);
        //$stmt=$this->dbh->query($sql);
        if($stmt){
            if(count($stmt)<=$amount){
                $data['reply']=$stmt;
                $data['amount']=count($stmt);
            }else{
                $end=$number+$amount;               //$number指第几个回复（从1开始），数组从0开始
                $tmp=0;
                $reply=array();
                for(;$number<$end;$number++){        //填充回复的数组
                    $reply[$tmp++]=$stmt[$number-1];
                }
                $data['reply']=$reply;
                $data['amount']=$amount;
            }
            $data['code']=200;
        }
        else{
            $data['code']=404;
            $data['error']="查询失败";
        }
        return $data;
    }

    function delete(){
        parse_str(file_get_contents('php://input'), $arguments);
        $id=$arguments['id'];
        $number=$arguments['number'];
        if(!($this->isExist('post','id',"$id")
            &&$this->select('reply',"*","number=$number and id=$id"))){
            $reply = array("code" => 404,"error"=>"空回复");
            return $reply;
        }
        $data=$this->selectData('post','id',$id);
        $section=$this->selectData('sections','name',$data[0]['section']);
        $reply=$this->selectData('reply','number',$number);
        if($_SESSION['id']==1||$section[0]['moderator']==$_SESSION['name']
            ||$_SESSION['name']==$data[0]['author']||$_SESSION['name']==$reply[0]['user']){
            $data=$this->selectData('post','id',$id);
            $replyAmount=$data[0]['replyAmount']-1;
            $this->dbh->beginTransaction();
            $delete=$this->deleteRow2('reply',"id='{$id}' and number='{$number}'");
            if($delete)
            echo $delete.'ppppppppppp';
            $sql="update post set replyAmount='{$replyAmount}'where id ='{$id}'";
            if($delete && ($this->dbh->exec($sql)==1)){
                $reply = array("code" => 204);
                $this->dbh->commit();
                return $reply;
            }else{
                $this->dbh->rollBack();
                $reply = array("code" => 404,"error"=>"删除失败");
                return $reply;
            }
        }else{
            $reply = array("code" => 401,"error"=>"没有权限");
            return $reply;
        }
    }
}