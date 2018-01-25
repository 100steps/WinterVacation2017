<?php
$dbms = 'mysql';
$host = 'localhost';
$dbName = 'tieba';
$user = 'root';
$pass = '';
$dsn = "$dbms:host=$host;dbname=$dbName";
$dbh = new PDO($dsn, $user, $pass);
$dbh->query('set names utf8');
setcookie("userid","123");
?>