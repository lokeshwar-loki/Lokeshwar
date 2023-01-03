<?php
    require('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php print('Contact | '.WEBSITE_NAME.' | '.WEBSITE_TAGLINE); ?></title>
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
                
            </div>

            <div class="col-md-8">
                <div class="p-4 cus-shadow">
                <div class="text-center">
                    <h3><span class="bottom-short-border">Contact</span></h3>
                </div>

                <?php
                    if(isset($_POST['contact-submit'])){
                        $contactName = sanitise($_POST['name']);
                        $contactEmail = sanitise($_POST['email']);
                        $contactPhone = sanitise($_POST['phone']);
                        $contactType = '3';
                        $contactMessage = sanitise($_POST['message']);
                        $contactTime = (String)time();

                        $contactSQL = "INSERT INTO `enquiry`(`name`,`email`,`phone`,`type`,`message`,`time`)";
                        $contactSQL .= "VALUES('$contactName','$contactEmail','$contactPhone','$contactType','$contactMessage','$contactTime')";

                        if(mysqli_query($connection, $contactSQL)){
                            print('<div class="alert alert-info text-center mt-5 mb-n2">Your contact request has been received, we will reach you soon. Thankyou!!</div>');
                        }else{
                            print('<div class="alert alert-danger text-center mt-5 mb-n2">Looks like something went wrong, Please try again later</div>');
                        }
                    }
                ?>
                
                <form class="pt-5" method="POST" action="<?php print($_SERVER['PHP_SELF']); ?>">

                    <div class="border rounded position-relative p-2 mb-4">
                        <label class="position-absolute mt-n3 px-3 bg-white small">Your Name</label>
                        <input type="text" name="name" class="form-control no-focus border-0" required>
                    </div>

                    <div class="border rounded position-relative p-2 mb-4">
                        <label class="position-absolute mt-n3 px-3 bg-white small">Email</label>
                        <input type="email" name="email" class="form-control no-focus border-0" required>
                    </div>

                    <div class="border rounded position-relative p-2 mb-4">
                        <label class="position-absolute mt-n3 px-3 bg-white small">Phone</label>
                        <input type="number" name="phone" class="form-control no-focus border-0" required>
                    </div>

                    <div class="border rounded position-relative p-2 mb-4">
                        <label class="position-absolute mt-n3 px-3 bg-white small">Your Message</label>
                        <textarea name="message" class="form-control no-focus border-0" rows="5" required></textarea>
                    </div>

                    <input type="submit" name="contact-submit" class="btn btn-warning w-100 py-3" value="Submit Contact Form">
                </form>
                </div>

                <div class="row pt-md-5 pt-4 px-3">

                    <div class="col-12 mb-4 py-4 bg-light">
                        <div class="text-center">
                            <div class="rounded-circle border border-warning bg-white text-warning d-inline-block card-icon-rounded">
                                <i class="fa fa-user-o"></i>
                            </div>
                            <h4 class="font-weight-light py-3 m-0">Manager</h4>
                            <div><?php print(CONTACT_PERSON.',<br>'.CONTACT_PERSON_POST); ?></div>
                        </div>
                    </div>

                    <div class="col-12 mb-4 py-4 bg-light">
                        <div class="text-center">
                            <div class="rounded-circle border border-warning bg-white text-warning d-inline-block card-icon-rounded">
                                <i class="fa fa-envelope-o"></i>
                            </div>
                            <h4 class="font-weight-light py-3 m-0">Email</h4>
                            <div><?php print(CONTACT_EMAIL); ?></div>
                        </div>
                    </div>

                    <div class="col-12 mb-4 py-4 bg-light">
                        <div class="text-center">
                            <div class="rounded-circle border border-warning bg-white text-warning d-inline-block card-icon-rounded">
                                <i class="fa fa-phone"></i>
                            </div>
                            <h4 class="font-weight-light py-3 m-0">Phone</h4>
                            <div><?php print(CONTACT_PHONE); ?></div>
                        </div>
                    </div>

                </div>
                 
            </div>

            <div class="col-md-2 d-md-block d-none">
                 
            </div>
        </div>
    </section>

    <?php include('footer.php'); ?>

</body>
</html>