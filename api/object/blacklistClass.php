<?php
/**
 * Created by PhpStorm.
 * User: HL
 * Date: 2018/2/7
 * Time: 12:48
 *
 */
require_once 'basisHandleMysql.php';
class blacklistClass extends basisHandleMysql
{
    function checkPrivilege($name,$section){
        $data=$this->select('sections','moderator',"name='{$section}'");
        if($_SESSION['name']=="admin"||$name=$data[0]['moderator']){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
    function add($section,$name){
        $sql="insert into blacklist (section,name) values ('{$section}', '{$name}')";
        if($this->dbh->exec($sql)==1)
            return TRUE;
        else
            return FALSE;
    }
    function isBlack($name,$section){
        if($this->select('blacklist','*',"name='{$name}' 
        and section ='{$section}'"))
            return TRUE;
        else
            return FALSE;
    }

    function delete($name,$section){
        $sql="delete from blacklist where name = '{$name}' and section='{$section}'";
        if($this->dbh->exec($sql)==1)
            return TRUE;
        else
            return FALSE;
    }

    function get($section){
        $data=$this->select('blackList','name',"section='{$section}'");
        return $data;
    }
}