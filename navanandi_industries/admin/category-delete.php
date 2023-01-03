<?php

    require('config.php');

    if(isset($_GET['id'])){
        $id = sanitise($_GET['id']);
        $categoryDeleteSQL = "DELETE FROM global_category WHERE id = '$id'";
        mysqli_query($connection, $categoryDeleteSQL);
    }
    header("Location:category.php");

?>