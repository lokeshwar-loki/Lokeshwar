<?php
    require('config.php');
    if(isset($_GET['id'])){

        $id = sanitise($_GET['id']);

        $enquiryStatusSQL = "SELECT * FROM enquiry WHERE enquiry_id = '$id'";
        $enquiryStatusResult = mysqli_query($connection, $enquiryStatusSQL);
        if(mysqli_num_rows($enquiryStatusResult) == 1){
            $enquiryStatusRow = mysqli_fetch_assoc($enquiryStatusResult);
            if($enquiryStatusRow['status'] == 0){
                $enquiryStatusUpdateSQL = "UPDATE enquiry SET status = 1 WHERE enquiry_id = '$id'";
            }else{
                $enquiryStatusUpdateSQL = "UPDATE enquiry SET status = 0 WHERE enquiry_id = '$id'";
            }
            mysqli_query($connection, $enquiryStatusUpdateSQL);
        }
    }
    if(isset($_SERVER['HTTP_REFERER'])){
        header("Location:".$_SERVER['HTTP_REFERER']);
    }else{
        header("Location:index.php");
    }
?>