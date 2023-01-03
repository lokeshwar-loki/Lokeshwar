<?php
    require('config.php');
    if(isset($_GET['id'])){

        $id = sanitise($_GET['id']);

        $categoryStatusSQL = "SELECT * FROM global_category WHERE id = '$id'";
        $categoryStatusResult = mysqli_query($connection, $categoryStatusSQL);
        if(mysqli_num_rows($categoryStatusResult) == 1){
            $categoryStatusRow = mysqli_fetch_assoc($categoryStatusResult);
            if($categoryStatusRow['status'] == 1){
                $categoryStatusUpdateSQL = "UPDATE global_category SET status = 0 WHERE id = '$id'";
            }else{
                $categoryStatusUpdateSQL = "UPDATE global_category SET status = 1 WHERE id = '$id'";
            }
            mysqli_query($connection, $categoryStatusUpdateSQL);
        }
    }
    header("Location:category.php");
?>