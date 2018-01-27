<?php

class connectdb
{
    public $dbh;
    function __construct($dbname,$user="root",$pass="") {
        try {
            $this->dbh = new PDO("mysql:host=localhost;dbname=$dbname", $user, $pass);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}