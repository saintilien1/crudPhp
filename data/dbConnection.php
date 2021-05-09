<?php
try{
    $pdo = new PDO("mysql:host=localhost;dbname=userlist;charset=utf8", "root", "");
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("ERROR: Could not connect. " . $e->getMessage());
}

include_once"pages/connect.php";
