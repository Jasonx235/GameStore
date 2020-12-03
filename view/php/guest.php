<?php 

//if not guest, go back to index (home)
if(!isset($_GET['guest'])) {
    header("Location:../index.php");
    exit();
}

//if user is logged in, go to profile
if(isset($_SESSION['source']))
{
	header("Location:../profile.php");
	exit();
}

session_start(); //start session

$_SESSION['guest'] = true; //user is now a guest

header("Location:../games.php"); //redirect to store

?>