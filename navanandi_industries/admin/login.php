<?php
    require('config.php');
    if(isset($_SESSION['admin'])){
        header("Location:index.php");
    }
    $loginFlow = true;

    if(isset($_POST['login'])){
        $loginEmail = sanitise($_POST['email']);
        $loginPassword = md5(sanitise($_POST['password']));
  $loginSQL = "SELECT * FROM `global_users` WHERE email ='$loginEmail' AND password = '$loginPassword'";
        $loginResult = mysqli_query($connection, $loginSQL);
        if(mysqli_num_rows($loginResult) == 1){
            $loginRow = mysqli_fetch_assoc($loginResult);

            $_SESSION['admin'] = array(
                'id' => $loginRow['id'],
                'name' => $loginRow['name'],
                'email' => $loginRow['email']
            );

            header("Location:index.php");

        }else{
            $loginFlow = false;
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <?php include('links.php'); ?>
</head>
<body>

    <div class="row py-md-5 py-0">
        <div class="col-xl-4 col-lg-6 col-md-8 col-12 mx-auto cus-shadow p-5">
            <div class="text-center">
                <h4 class="mb-5">Login</h4>
            </div>

            <?php
                if($loginFlow == false){
                    print('<div class="alert alert-danger small text-center mb-4">Wrong Login ID or Password</div>');
                }
            ?>


            <form method="POST" action="">
                <div class="border rounded position-relative p-2">
                    <label class="position-absolute px-2 bg-white mt-n3 small text-muted">Email</label>
                    <input type="text" name="email" class="form-control border-0 px-3 font-weight-bold">
                </div>
                <br>
                <div class="border rounded position-relative p-2">
                    <label class="position-absolute px-2 bg-white mt-n3 small text-muted">Password</label>
                    <input type="password" name="password" class="form-control border-0 px-3 font-weight-bold">
                </div>
                <br>
                <input type="submit" name="login" value="Login" class="btn btn-primary w-100 py-3">
            </form>
        </div>
    </div>
    

    <?php include('links-footer.php'); ?>
</body>
</html>