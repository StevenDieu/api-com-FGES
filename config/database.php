<?php

$host = 'localhost';
$database = 'comin';
$user = 'root';
$password = '';

$strCon = "mysql:host=$host;dbname=$database";
$arrExtraParam = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
$dbh = new PDO($strCon, $user, $password, $arrExtraParam);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);