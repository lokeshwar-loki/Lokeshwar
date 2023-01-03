	<?php
    require('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php print('Career | '.WEBSITE_NAME.' | '.WEBSITE_TAGLINE); ?></title>
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
	<div class="col-md-2">
                
            </div>
           <div class="col-md-8">
                <div class="p-4 cus-shadow">
                <div class="text-center">
                    <h3><span class="bottom-short-border">Tell Us Your Requirements</span></h3>
                </div>
				<br>

                 
                
<form role="form">

                    <div class="border rounded position-relative p-2 mb-4">
                        <label class="position-absolute mt-n3 px-3 bg-white small">Product Name</label>
                        <input type="text" name="product_name" id="product_name" class="form-control no-focus border-0" required>
                    </div>
					
					<div class="border rounded position-relative p-2 mb-4">
                        <label class="position-absolute mt-n3 px-3 bg-white small">Total Product</label>
                        <input type="text" name="usage_Application" id="usage_Application" class="form-control no-focus border-0" required>
                    </div>
					
					<div class="border rounded position-relative p-2 mb-4">
                        <label class="position-absolute mt-n3 px-3 bg-white small">User Name</label>
                        <input type="text" name="company_name" id="company_name" class="form-control no-focus border-0" required>
                    </div>
					
					<div class="border rounded position-relative p-2 mb-4">
                        <label class="position-absolute mt-n3 px-3 bg-white small">User Name</label>
                        <input type="text" name="contact_name" id="contact_name" class="form-control no-focus border-0" required>
                    </div>
					
					<div class="border rounded position-relative p-2 mb-4">
                        <label class="position-absolute mt-n3 px-3 bg-white small">User Name</label>
                        <input type="number" name="required_quantity" id="required_quantity" class="form-control no-focus border-0" required>
                    </div>

                    <div class="border rounded position-relative p-2 mb-4">
                        <label class="position-absolute mt-n3 px-3 bg-white small">Email</label>
                        <input type="email" name="email_address" id="email_address" class="form-control no-focus border-0" required>
                    </div>

                    <div class="border rounded position-relative p-2 mb-4">
                        <label class="position-absolute mt-n3 px-3 bg-white small">Phone</label>
                        <input type="number" name="phone" id="phone" class="form-control no-focus border-0" required>
                    </div>
					
					<div class="border rounded position-relative p-2 mb-4">
                        <label class="position-absolute mt-n3 px-3 bg-white small">Address</label>
                        <input type="text" name="contact_address" id="contact_address" class="form-control no-focus border-0" required>
                    </div>

                   <!-- <div class="border rounded position-relative p-2 mb-4">
                        <label class="position-absolute mt-n3 px-3 bg-white small">Your Message</label>
                        <textarea name="message" id="message" class="form-control no-focus border-0" rows="5" required></textarea>
                    </div>-->

                     <input type="submit" onclick="submitQuickPadForm()" class="btn btn-warning w-100 py-3 submitBtnQuickpad" value="Submit">
                </form>
                </div>
 </div>
                 
            </div>
			</section>
			
			<script>
function submitQuickPadForm(){
    var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    var product_name = $('#product_name').val();
    var usage_Application = $('#usage_Application').val();
    var required_quantity = $('#required_quantity').val();
	var company_name = $('#company_name').val();
	var contact_name = $('#contact_name').val();
    var phone = $('#phone').val();
    var email_address = $('#email_address').val();
	var contact_address = $('#contact_address').val();
    
    
    if(product_name.trim() == '' ){
        alert('Please enter Product name.');
        $('#product_name').focus();
        return false;
    }else if(usage_Application.trim() == '' ){
        alert('Please enter Usage Application/Industry.');
        $('#usage_Application').focus();
        return false;
    }else if(company_name.trim() == '' ){
        alert('Please enter Company Name.');
        $('#company_name').focus();
        return false;
    }else if(contact_name.trim() == '' ){
        alert('Please enter Contact Name.');
        $('#contact_name').focus();
        return false;
    }else if(phone.trim() == '' ){
        alert('Please enter your Mobile No.');
        $('#phone').focus();
        return false;
    }else if(email_address.trim() == '' ){
        alert('Please enter your email.');
        $('#email_address').focus();
        return false;
    }else if(email_address.trim() != '' && !reg.test(email)){
        alert('Please enter valid email.');
        $('#email_address').focus();
        return false;
    }
	 
	 
	 else{
        $.ajax({
            type:'POST',
            url:'submit_quikpad.php',
            data:'contactFrmSubmit=1&product_name='+product_name+'&usage_Application='+usage_Application+'&required_quantity='+required_quantity+'&company_name='+company_name+'&contact_name='+contact_name+'&phone='+phone+'&email_address='+email_address+'&contact_address='+contact_address,
            beforeSend: function () {
                $('.submitBtnQuickpad').attr("disabled","disabled");
               // $('.modal-body').css('opacity', '.5');
            },
			
            success:function(msg){
				 
				 var result = $.trim(msg);
                if(result == 'ok'){
                    $('#product_name').val('');
                    $('#usage_Application').val('');
                    $('#required_quantity').val('');
					$('#company_name').val('');
					$('#contact_name').val('');
                    $('#phone').val('');
                    $('#email_address').val('');
					$('#contact_address').val('');
					 
					toastr.success('Enquiry has been sent successfully,<br>we will reach you soon. Thankyou!!.');
                    //$('.statusMsg').html('<span style="color:green;">Product Added to Cart,<br>we will reach you soon. Thankyou!!.</p>');
                }else{
					toastr.error('Enquiry was not Submitted <br>Please try again!!.');
                 //   $('.statusMsg').html('<span style="color:red;">Product Already Added to Cart.</span>');
                }
                $('.submitBtnQuickpad').removeAttr("disabled");
                $('.modal-body').css('opacity', '');
            }
        });
    }
}
</script>

			<?php include('footer.php'); ?>

</body>
</html>