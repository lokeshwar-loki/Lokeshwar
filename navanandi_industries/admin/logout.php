<?php
    require('config.php');
    unset($_SESSION['admin']);
    session_unset();
    session_destroy();
    header("Location:login.php");
?>