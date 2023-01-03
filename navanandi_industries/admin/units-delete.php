<?php

    require('config.php');

    if(isset($_GET['id'])){
        $id = sanitise($_GET['id']);
        $usefulNumberDeleteSQL = "DELETE FROM global_uom WHERE id = '$id'";
        mysqli_query($connection, $usefulNumberDeleteSQL);
    }
    header("Location:uom.php");

?>