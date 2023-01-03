<?php
    require('config.php');
    if(isset($_GET['signup'])){
        $message = '<div class="alert alert-primary">Kindly Confirm your account. An verificaiton link has been sent to you</div>';
    }else if(isset($_GET['verify']) && isset($_GET['key'])){
        $user = sanitise($_GET['verify']);
        $key = sanitise($_GET['key']);

        $verificationAccountSQL = "SELECT * FROM `user` WHERE `user_id` = '$user' AND `key` = '$key'";
        $verificationAccountResult = mysqli_query($connection, $verificationAccountSQL);
        if(mysqli_num_rows($verificationAccountResult) == 1){
            if(mysqli_query($connection, "UPDATE `user` SET `status` = '1', `key` = NULL WHERE `user_id` = '$user'")){
                $verificationAccountRow = mysqli_fetch_assoc($verificationAccountResult);
                $_SESSION['user'] = array(
                    'id' => $verificationAccountRow['user_id'],
                    'name' => $verificationAccountRow['name'],
                    `email` => $verificationAccountRow['email']
                );
                header("Location:".WEBSITE_URL);
            }else{
                $message = '<div>Opps!! Something went wrong.</div>';
            }
        }else{
            $message = '<div class="alert alert-danger text-center">Invalid Access Key</div>';
        }
    }else{
        header("Location:".WEBSITE_URL);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php print(WEBSITE_NAME); ?></title>
    <?php include('links.php'); ?>
</head>
<body class="p-2">
    <?php
        if(isset($message)){
            print($message);
        }
    ?>
</body>
</html>