<?php
    require('config.php');
    session_destroy();
    header("Location:".WEBSITE_URL.'/login');
?>