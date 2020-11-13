<?php

    if(isset($_GET['logout'])){
        session_destroy();
        $_SESSION[];
        header("Location:index.php");
        exit();
    }
    /*
    session_start();
    unset($_SESSION);
    session_destroy();
    session_write_close();
    header("Location:index.php");
    exit();
    */
?>