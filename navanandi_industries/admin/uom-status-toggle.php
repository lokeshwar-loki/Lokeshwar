<?php
    require('config.php');
    if(isset($_GET['id'])){

        $id = sanitise($_GET['id']);

        $usefulNumbersStatusSQL = "SELECT * FROM global_uom WHERE id = '$id'";
        $usefulNumbersStatusResult = mysqli_query($connection, $usefulNumbersStatusSQL);
        if(mysqli_num_rows($usefulNumbersStatusResult) == 1){
            $usefulNumbersStatusRow = mysqli_fetch_assoc($usefulNumbersStatusResult);
            if($usefulNumbersStatusRow['status'] == 1){
                $usefulNumbersStatusUpdateSQL = "UPDATE global_uom SET status = 0 WHERE id = '$id'";
            }else{
                $usefulNumbersStatusUpdateSQL = "UPDATE global_uom SET status = 1 WHERE id = '$id'";
            }
            mysqli_query($connection, $usefulNumbersStatusUpdateSQL);
        }
    }
    header("Location:uom.php");
?>