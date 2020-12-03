<?php
    //logout logic
    session_start(); //start session
    unset($_SESSION); //unset the session
    session_destroy(); //destroy the session
    session_write_close(); //close the session
    header("Location:../index.php"); //redirect to home page
    exit();
?>