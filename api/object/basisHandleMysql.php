<?php
//等待修改用户部分

class basisHandleMysql
{
    public $dbh;
    function __construct($dbname="no_hole-forum",$user="root",$pass="") {
        try {
            $this->dbh = new PDO("mysql:host=localhost;dbname=$dbname", $user, $pass);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    function selectData($table, $column, $value){
        $sql="select*from {$table} where {$column} = '{$value}'";
        $stmt=$this->dbh->query($sql);
        if($stmt){
            $result=$stmt->fetchAll();
            return $result;
        }
        else
            return FALSE;
    }

    function  isExist($table, $column, $value){
        if($this->selectData($table, $column, $value))     //无关闭查询
            return TRUE;
        else
            return FALSE;
    }

    function  deleteRow($table,$column,$value){
        $sql="delete from '{$table}' where '{$column}' = '{$value}'";
        if($this->dbh->exec($sql)==1)
            return TRUE;
        else
            return FALSE;
    }


}