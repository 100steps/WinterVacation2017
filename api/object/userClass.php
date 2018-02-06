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
            $_SESSION['name']=$name;
            return TRUE;
        }

        else
            return FALSE;
    }



}