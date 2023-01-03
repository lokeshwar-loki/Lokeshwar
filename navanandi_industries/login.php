<?php
    require('config.php');

    if(isset($_SESSION['user'])){
        header("Location".WEBSITE_URL);
    }

    if(isset($_POST['login'])){
        $email = sanitise($_POST['email']);
        $pass = md5(sanitise($_POST['password']));
        $loginSQL = "SELECT * FROM `user` WHERE email = '$email' AND pass = '$pass'";
        $loginResult = mysqli_query($connection, $loginSQL);
        if(mysqli_num_rows($loginResult) == 1){
            $loginRow = mysqli_fetch_assoc($loginResult);
            if($loginRow['status'] == 0){
                $loginError = '<div class="alert alert-primary text-center small mb-3">Please Verify your account an Verification link has been send to you on '.$email.'</div>';
            }else if($loginRow['status'] == 1){
                $_SESSION['user'] = array(
                    'id' => $loginRow['user_id'],
                    'name' => $loginRow['name'],
                    'email' => $loginRow['email']
                );
                if(isset($_SERVER['HTTP_REFERER'])){
                    if(basename($_SERVER['PHP_SELF']) == 'login.php'){
                        header("Location:".WEBSITE_URL);
                    }else{
                        header("Location:".$_SERVER['HTTP_REFERER']);
                    }
                }else{
                    header("Location:".WEBSITE_URL);
                }
            }else{
                $loginError = '<div class="alert alert-danger text-center small mb-3">Your Account has been suspended</div>';
            }
        }else{
            $loginError = '<div class="alert alert-danger text-center small mb-3">Wrong email or password</div>';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php print('Login | '.WEBSITE_NAME); ?></title>
    <?php include('links.php'); ?>
</head>
<body class="hero-banner-lg">
    <div class="container m-auto py-md-5 py-0 px-0">
        <div class="row m-0 p-0">
            <div class="col-md-8 col-lg-5 col-12 m-auto p-3">
                <div class="card bg-light shadow-sm border-0 px-4 py-5 my-md-4 my-0">
                    <div class="text-center"><h2 class="pb-4">Login</h2></div>
                    <?php
                        if(isset($loginError)){
                            print($loginError);
                        }
                    ?>
                    <form method="POST" action="">
                        <div class="input-group mb-3 border rounded bg-white p-2 focus-within">
                            <div class="input-group-prepend"><span class="input-group-text bg-white border-0"><i class="fa fa-user-o"></i></span></div>
                            <input type="text" name="email" class="form-control no-focus border-0" placeholder="Email Address" required>
                        </div>
                        <div class="input-group mb-3 border rounded bg-white p-2 focus-within">
                            <div class="input-group-prepend"><span class="input-group-text bg-white border-0"><i class="fa fa-lg fa-lock"></i></span></div>
                            <input type="password" name="password" class="form-control no-focus border-0" placeholder="Password" required>
                        </div>
                        <input type="submit" name="login" value="LOGIN" class="btn btn-warning w-100 py-2">
                    </form>
                    <div class="row border-top mt-3 mx-0 px-0 pt-4">
                        <div class="col-6 pl-0">
                            <a href="#" class="btn btn-outline-warning w-100 px-0 py-2">Forgot Password</a>
                        </div>
                        <div class="col-6 pr-0">
                            <a href="<?php print(WEBSITE_URL.'/signup'); ?>" class="btn btn-outline-warning w-100 px-0 py-2">Signup</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>