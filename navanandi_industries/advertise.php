<?php
    require('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php print('Advertise | '.WEBSITE_NAME); ?></title>
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
                <div class="container mx-auto mb-5 my-0 p-4 cus-shadow">
                    <div class="text-center pt-3">
                        <h3><span class="bottom-short-border">Advertise with us</span></h3>
                    </div>
                    <?php
                        if(isset($_GET['plan']) && !empty($_GET['plan'])){
                            include('advertise-book.php');
                        }else{
                            include('advertise-plans.php');
                        }
                    ?>
                </div>

                <?php include('ad-slider.php'); ?>

            </div>

            <div class="col-md-2 d-md-block d-none">
                <?php include('ad-right.php'); ?>
            </div>
        </div>
    </section>


    <?php include('footer.php'); ?>

</body>
</html>