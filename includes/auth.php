<?php
session_start();
if(!isset($_SESSION['user'])){
    //echo "Logged in user" . $_SESSION['user'];
    header("Location: login.php");
}
if(isset($_GET['logout'])){
    session_unset();
}
?>