<?php

session_start();
$SERVER = '127.0.0.1';
$USER = 'root';
$PASS = '';
$DATABASE = 'gamersstore';
    
 
$conn = new mysqli($SERVER, $USER, $PASS, $DATABASE);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>