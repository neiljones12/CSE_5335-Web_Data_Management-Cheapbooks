<?php 
session_start();

if (isset($_GET['userName'])) { 
    $_SESSION["username"] = $_GET['userName'];
}
?>