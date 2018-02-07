<?php
require_once 'basisHandleMysql.php';
class userClass extends basisHandleMysql
{

//    function selectPassword($table, $column, $value){
//        $sql="select (password) from {$table} where {$column} = '{$value}'";
//        $stmt=$this->dbh->query($sql);
//        if($stmt){
//            $result=$stmt->fetchAll();
//            return $result;
//        }
//        else
//            return FALSE;
//    }


    function  postUser($name,$email,$password){
        $sql="insert into user (name,email,password) values ('{$name}','{$email}','{$password}')";
        if($this->dbh->exec($sql)==1)
            return TRUE;
        else
            return FALSE;
    }

    function  deleteUser($id){
        return $this->deleteRow('user','id',"{$id}");
    }
    function  putUser($id,$name,$email,$sex,$birthday,$province,$city,$phoneNumber,
                      $qq,$signature,$imageUrl){

        $sql="update user set name='{$name}',email='{$email}',sex='{$sex}',
              birthday='{$birthday}',province='{$province}',city='{$city}',phoneNumber='{$phoneNumber}',
              qq='{$qq}',signature='{$signature}',imageUrl='{$imageUrl}' where 
              id='{$id}'";


        if($this->dbh->exec($sql)==1){
            return TRUE;
        }

        else
            return FALSE;
    }


    function changeName($oldName,$newName){
        $sql="update blackList set name='{$newName}'where 
              name='{$oldName}'";
        $this->dbh->exec($sql);
        $sql="update post set author='{$newName}'where 
              author='{$oldName}'";
        $this->dbh->exec($sql);
        $sql="update reply set user='{$newName}'where 
              user='{$oldName}'";
        $this->dbh->exec($sql);
        $sql="update sections set moderator='{$newName}'where 
              moderator='{$oldName}'";
        $this->dbh->exec($sql);
        if(is_file("../../userImage/".$_SESSION['name'].".jpg")){
            $file="../../userImage/".$newName.".jpg";
            $sql="update user set imageUrl='{$file}' where id='{$_SESSION['id']}'";
            $this->dbh->exec($sql);
            rename("../../userImage/".$_SESSION['name'].".jpg",
                   "../../userImage/".$newName.".jpg");
        }
        $_SESSION['name']=$newName;
    }
}