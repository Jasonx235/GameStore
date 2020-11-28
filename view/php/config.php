<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
DEFINE('SERVER', 'localhost');
DEFINE('USER', 'root');
DEFINE('PASS', '');
DEFINE('DATABASE', 'gamersstore');

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try{
    $conn = new mysqli(SERVER, USER, PASS, DATABASE);
    $conn->set_charset("utf8mb4");
} catch(Execption $e){
    error_log($e->getMessage());
    exit("Error connecting to database.");
}

?>