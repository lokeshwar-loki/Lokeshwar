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
	<?php include('hero-banner.php'); ?>

    <?php include('ad-top.php'); ?>


    <section class="my-md-5 my-2">
	
	 
        <div class="container-fluid px-md-4 px-0 row mx-auto">
            <div class="container">
                <div class="row">		
				
            <div class="col-md-6">
                <div class="p-4 cus-shadow">
                <div class="text-center" style="margin:20px;">
                    <h3><span class="bottom-short-border" >Tell Us Your Requirements</span></h3>
                </div>

                  
<form role="form">
                    <div class="border rounded position-relative p-2 mb-4">
                        <label class="position-absolute mt-n3 px-3 bg-white small">Your Name</label>
                        <input type="text" name="name" id="name" class="form-control no-focus border-0" required>
                    </div>

                    <div class="border rounded position-relative p-2 mb-4">
                        <label class="position-absolute mt-n3 px-3 bg-white small">Email</label>
                        <input type="email" name="email" id="email" class="form-control no-focus border-0" required>
                    </div>

                    <div class="border rounded position-relative p-2 mb-4">
                        <label class="position-absolute mt-n3 px-3 bg-white small">Phone</label>
                        <input type="number" name="phone" id="phone" class="form-control no-focus border-0" required>
                    </div>

                    <div class="border rounded position-relative p-2 mb-4">
                        <label class="position-absolute mt-n3 px-3 bg-white small">Your Message</label>
                        <textarea name="message" id="message" class="form-control no-focus border-0" rows="5" required></textarea>
                    </div>

                    <input type="submit" onclick="submitContactUsForm()" class="btn btn-warning w-100 py-3 submitBtnContact" value="Submit Contact Form">
                </form>
                </div>
 
                 
            </div>
                <div class="col-lg-6">
                        <div class="contact-information">
                            <h3 class="contact-title">Contact Us</h3>
                            <p>Global Enterprises <br>
							 Banglore, Karnataka,<br>
							 Building No: 4618,<br> Test Street,<br>
                             
                            </p>
                            <ul>
                                <li><i class="fa fa-map-marker"></i> Address : Banglore</li>
                                <li><i class="fa fa-phone-square"></i> +91 1234567, +91 123456</li>
                                <li><i class="fa fa-envelope-o"></i> test@gmail.com</li>
                                 <li><i class="fa fa-user-o"></i> Contact person Name</li>
                            </ul>
                        </div>
                    </div>
            </div>


            <div class="col-md-2 d-md-block d-none">
                 
            </div>
        </div>
		</div>
		  
		
		
    </section>
	
	<section class="contact-map-section">
        					<div class="row">
							<?php  
                        if(mysqli_num_rows($locationResult) > 0){
                             while($alllocation = mysqli_fetch_assoc($locationResult)){
                          
                            ?>
                            <div class="col-md-6">
							
						
					<iframe src="<?php echo $alllocation['location_map'];?> " width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
					<br>
                          
						<h4><center><u><?php echo $alllocation['location_name']; ?></center></u></h4> 
						 </div><?php }} ?></div>
    </section>
	
	<script>
function submitContactUsForm(){
    var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    var name = $('#name').val();
    var email = $('#email').val();
    var phone = $('#phone').val();
	var message = $('#message').val();
    
    if(name.trim() == '' ){
        alert('Please enter your name.');
        $('#name').focus();
        return false;
    }else if(email.trim() == '' ){
        alert('Please enter your email.');
        $('#email').focus();
        return false;
    }else if(email.trim() != '' && !reg.test(email)){
        alert('Please enter valid email.');
        $('#email').focus();
        return false;
    }else if(phone.trim() == '' ){
        alert('Please enter your Mobile No.');
        $('#phone').focus();
        return false;
    }
	else if(message.trim() == '' ){
        alert('Please enter Message.');
        $('#message').focus();
        return false;
    }
	 
	 else{
        $.ajax({
            type:'POST',
            url:'submit_contact.php',
            data:'contactFrmSubmit=1&name='+name+'&email='+email+'&phone='+phone+'&message='+message,
            beforeSend: function () {
                $('.submitBtnContact').attr("disabled","disabled");
               // $('.modal-body').css('opacity', '.5');
            },
			
            success:function(msg){
				 
				 var result = $.trim(msg);
                if(result == 'ok'){
                    $('#name').val('');
                    $('#email').val('');
                    $('#phone').val('');
					$('#message').val('');
					 
					toastr.success('Message has been sent successfully,<br>we will reach you soon. Thankyou!!.');
                    //$('.statusMsg').html('<span style="color:green;">Product Added to Cart,<br>we will reach you soon. Thankyou!!.</p>');
                }else{
					toastr.error('Message was not Submitted <br>Please try again!!.');
                 //   $('.statusMsg').html('<span style="color:red;">Product Already Added to Cart.</span>');
                }
                $('.submitBtnContact').removeAttr("disabled");
                $('.modal-body').css('opacity', '');
            }
        });
    }
}
</script>

    <?php include('footer.php'); ?>

</body>
</html>