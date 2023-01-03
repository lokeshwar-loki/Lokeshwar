<?php
    require('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php print('Enquirey Form | '.WEBSITE_NAME.' | '.WEBSITE_TAGLINE); ?></title>
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
                <?php
                    $enquiryFlow = false;
                    if(isset($_GET['url'])){
                        $enquiryURL = sanitise($_GET['url']);
                        $enquiryResult = mysqli_query($connection, "SELECT * FROM `listing` WHERE `url` = '$enquiryURL'");
                        if(mysqli_num_rows($enquiryResult) == 1){
                            $enquiryFlow = true;
                        }
                    }
                    if($enquiryFlow){
                        $enquiryRow = mysqli_fetch_assoc($enquiryResult);
                        ?>
                            <div class="cus-shadow p-4 m-3">
                                <h4 class="text-center mt-4 mb-5">Enquire about <?php print(ucwords($enquiryRow['name'])); ?></h4>
                                <?php
                                    if(isset($_POST['enquirySubmit'])){
                                        $name = sanitise($_POST['enquiryName']);
                                        $listing = $enquiryRow['listing_id'];
                                        $email = sanitise($_POST['enquiryEmail']);
                                        $phone = sanitise($_POST['enquiryPhone']);
                                        $message = sanitise($_POST['enquiryMessage']);
                                        $time = time();
                                        if(mysqli_query($connection,"INSERT INTO `enquiry`(`name`,`email`,`phone`,`type`,`listing`,`message`,`time`,`status`)VALUES('$name','$email','$phone','1','$listing','$message','$time','0')")){
                                            print('<div class="alert alert-success text-center small mb-4">Your Enquiry Request has been recived, we will contact you soon</div>');
                                        }else{
                                            print('<div class="alert alert-danger text-center small mb-4">Opps!! Something went wrong.</div>');
                                        }
                                    }
                                ?>
                                <form method="POST" action="">
                                    <div class="row">
                                        <div class="col-md-6 col-12 mb-4">
                                            <div class="position-relative p-2 border rounded">
                                                <label class="small position-absolute mt-n3 px-2 bg-white">Your Name</label>
                                                <input type="text" class="form-control border-0 no-focus" name="enquiryName">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12 mb-4">
                                            <div class="position-relative p-2 border rounded">
                                                <label class="small position-absolute mt-n3 px-2 bg-white">Enquire About Bussiness</label>
                                                <input type="text" class="form-control border-0 no-focus bg-white" value="<?php print($enquiryRow['name']); ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12 mb-4">
                                            <div class="position-relative p-2 border rounded">
                                                <label class="small position-absolute mt-n3 px-2 bg-white">Your Email</label>
                                                <input type="text" class="form-control border-0 no-focus" name="enquiryEmail">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12 mb-4">
                                            <div class="position-relative p-2 border rounded">
                                                <label class="small position-absolute mt-n3 px-2 bg-white">Your Phone</label>
                                                <input type="text" class="form-control border-0 no-focus" name="enquiryPhone">
                                            </div>
                                        </div>
                                        <div class="col-12 mb-4">
                                            <div class="position-relative p-2 border rounded">
                                                <label class="small position-absolute mt-n3 px-2 bg-white">Your Enquiry Here</label>
                                                <textarea class="form-control border-0 no-focus" rows="5" name="enquiryMessage"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="submit" name="enquirySubmit" class="btn btn-warning px-0 w-100 py-2" value="GET ENQUIRY DATA">
                                </form>
                            </div>
                        <?php 
                    }else{
                        print('<div class="text-center pb-5">');
                        print('<h1 class="text-center display-2 text-warning mt-5">404</h1>');
                        print('<p class="text-center mb-4">The Page you were looking for was not found here</p>');
                        print('<a class="btn btn-warning px-4 py-3" href="'.WEBSITE_URL.'">Go to Home</a>');
                        print('</div>');
                    }
                ?>
                <div class="p-3">
                    <?php include('ad-slider.php'); ?>
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