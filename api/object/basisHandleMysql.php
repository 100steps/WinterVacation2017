<?php

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
    function select($table, $column,$content){
        $sql="select $column from $table where $content";
        //echo $sql;
        $stmt=$this->dbh->query($sql);
        if($stmt){
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        else
            return 0;      //返回零以区分查询失败还是查询结果为空
    }

    function selectData($table, $column, $value,$content="*"){              //旧版本，待取消
        $sql="select $content from {$table} where {$column} = '{$value}'";
        $stmt=$this->dbh->query($sql);
        if($stmt){
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        else
            return 0;
    }

    function  isExist($table, $column, $value){
        if($this->selectData($table, $column, $value))     //无关闭查询
            return TRUE;
        else
            return FALSE;
    }

    function  deleteRow($table,$column,$value){
        $sql="delete from $table where $column = '{$value}'";
        if($this->dbh->exec($sql)==1)
            return TRUE;
        else
            return FALSE;
    }

    function deleteRow2($table,$content){
        $sql="delete from $table  where $content";
        if($this->dbh->exec($sql)==1)
            return TRUE;
        else
            return FALSE;
    }


}