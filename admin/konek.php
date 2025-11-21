<?php
$usr = "root";
$pas = "";
$hos = "localhost";
$dbs = "wds";

try {
    $dbh = new PDO("mysql:host=$hos;dbname=$dbs;charset=utf8", $usr, $pas);
} 
catch (PDOException $e) {
    
}
