<?php

$host ='localhost';
$dbname = 'dnsc_events';
$username = 'root';
$password = '';

try{
    $conn = new PDO ("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



}catch(PDOException $e){
    die("Connection Failed: ".$e->getMessage());
}

?>