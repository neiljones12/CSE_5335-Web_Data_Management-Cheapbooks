<?php
// Start the session
session_start();
if (isset($_GET['userName'])) {
    $_SESSION["username"] = null;
}
?>