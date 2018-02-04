<?php
$dbms = 'mysql';
$host = 'localhost';
$dbName = 'users_moment';
$user = 'root';
$pass = '';
$dsn = "$dbms:host=$host;dbname=$dbName";
$dbh = new PDO($dsn, $user, $pass);
$dbh->query('set names utf8');
?>