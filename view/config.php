<?php

session_start();
$SERVER = 'localhost';
$USER = 'root';
$PASS = '';
$DATABASE = 'gamersstore';
    
 
$conn = new mysqli($SERVER, $USER, $PASS, $DATABASE);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>