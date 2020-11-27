<?php 

if(!isset($_GET['guest'])) {
    header("Location:index.php");
    exit();
}

if(isset($_SESSION['source']))
{
	header("Location:profile.php");
	exit();
}

session_start();

$_SESSION['guest'] = true;

header("Location:games.php");

?>