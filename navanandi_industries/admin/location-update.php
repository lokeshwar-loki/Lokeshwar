<?php
    require('config.php');

    if(isset($_GET['delete']) && is_numeric($_GET['delete'])){
        $adId = sanitise($_GET['delete']);
        mysqli_query($connection, "DELETE FROM `global_location` WHERE `id` = '$adId'");
    }
	
	if(isset($_GET['id'])){

        $id = sanitise($_GET['id']);

        $usefulNumbersStatusSQL = "SELECT * FROM global_location WHERE id = '$id'";
        $usefulNumbersStatusResult = mysqli_query($connection, $usefulNumbersStatusSQL);
        if(mysqli_num_rows($usefulNumbersStatusResult) == 1){
            $usefulNumbersStatusRow = mysqli_fetch_assoc($usefulNumbersStatusResult);
            if($usefulNumbersStatusRow['status'] == 1){
                $usefulNumbersStatusUpdateSQL = "UPDATE global_location SET status = 0 WHERE id = '$id'";
            }else{
                $usefulNumbersStatusUpdateSQL = "UPDATE global_location SET status = 1 WHERE id = '$id'";
            }
            mysqli_query($connection, $usefulNumbersStatusUpdateSQL);
        }
    }

    header('Location:location.php');
?>