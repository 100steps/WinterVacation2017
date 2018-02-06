<?php
/**
 * Created by PhpStorm.
 * User: HL
 * Date: 2018/2/3
 * Time: 12:21
 */
require_once 'basisHandleMysql.php';
class sectionsClass extends basisHandleMysql
{
    function getSections(){
        $data=$this->selectData('sections',1,1);
        if($data){
            $num=count($data);
            $data['code']=200;
            $data['amount']=$num;
        }else{
            $data['code']=404;
            $data['error']="查询失败";
        }
        echo json_encode($data);
    }

    function deleteSection($section){
        if($_SESSION['id']==1){
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

    function postSection($name,$moderator,$introduce){
        if($_SESSION['id']==1){
            $sql="insert into sections (name,moderator,introduce) values
                  ('{$name}','{$moderator}','{$introduce}')";
            if($this->dbh->exec($sql)==1){
                $reply = array("code" => 201);
                return $reply;
            }else{
                $reply = array("code" => 500,"error"=>"创建失败");
                return $reply;
            }
        }else{
            $reply = array("code" => 401,"error"=>"没有权限");
            return $reply;
        }
    }

    function putSections($oldName,$newName,$moderator,$introduce){
        if($_SESSION['id']==1){
            $sql="update sections set name='{$newName}',moderator='{$moderator}',introduce='{$introduce}'where name='{$oldName}'";
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
}