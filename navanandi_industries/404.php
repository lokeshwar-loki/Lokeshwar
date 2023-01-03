<?php
    http_response_code(404);
    require('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Page Not Found</title>
    <?php
        include('links.php');
    ?>
</head>
<body>
    
    <?php include('header.php'); ?>

    <?php include('ad-top.php'); ?>

    <section class="my-md-5 my-2">
        <div class="container-fluid px-md-4 px-0 row mx-auto">
            <div class="col-md-2 d-md-block d-none">
                <?php include('ad-left.php'); ?>
            </div>

            <div class="col-md-8">
                <div class="my-5 text-center">
                    <h1 class="text-warning display-2">404</h1>
                    <p class="text-dark">The Page you were looking for was not found here</p>
                    <a class="btn btn-warning px-4 py-3" href="<?php print(WEBSITE_URL); ?>">Go to Home</a>
                </div>
            </div>

            <div class="col-md-2 d-md-block d-none">
                <?php include('ad-right.php'); ?>
            </div>
        </div>
    </section>

    <?php include('footer.php'); ?>

</body>
</html>