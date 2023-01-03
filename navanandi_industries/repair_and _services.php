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
                        <input type="text" name="productname" id="productname" class="form-control no-focus border-0" required>
                    </div>
					
					<div class="border rounded position-relative p-2 mb-4">
                        <label class="position-absolute mt-n3 px-3 bg-white small">Total Product</label>
                        <input type="number" name="productcount" id="productcount" class="form-control no-focus border-0" required>
                    </div>
					
					<div class="border rounded position-relative p-2 mb-4">
                        <label class="position-absolute mt-n3 px-3 bg-white small">User Name</label>
                        <input type="text" name="customername" id="customername" class="form-control no-focus border-0" required>
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
                        <label class="position-absolute mt-n3 px-3 bg-white small">Address</label>
                        <input type="text" name="customeraddress" id="customeraddress" class="form-control no-focus border-0" required>
                    </div>

                    <div class="border rounded position-relative p-2 mb-4">
                        <label class="position-absolute mt-n3 px-3 bg-white small">Your Message</label>
                        <textarea name="message" id="message" class="form-control no-focus border-0" rows="5" required></textarea>
                    </div>

                     <input type="submit" onclick="submitRepairForm()" class="btn btn-warning w-100 py-3 submitBtnrepair" value="Submit">
                </form>
                </div>
 </div>
                 
            </div>
			</section>
			
			<script>
function submitRepairForm(){
    var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    var productname = $('#productname').val();
    var productcount = $('#productcount').val();
    var customername = $('#customername').val();
	var email = $('#email').val();
	var phone = $('#phone').val();
    var customeraddress = $('#customeraddress').val();
    var message = $('#message').val();
    
    if(productname.trim() == '' ){
        alert('Please enter Product name.');
        $('#productname').focus();
        return false;
    }else if(customername.trim() == '' ){
        alert('Please enter your Name.');
        $('#customername').focus();
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
	else if(customeraddress.trim() == '' ){
        alert('Please enter Your Address.');
        $('#customeraddress').focus();
        return false;
    }
	 
	 else{
        $.ajax({
            type:'POST',
            url:'submit_repair.php',
            data:'contactFrmSubmit=1&productname='+productname+'&productcount='+productcount+'&customername='+customername+'&email='+email+'&phone='+phone+'&customeraddress='+customeraddress+'&message='+message,
            beforeSend: function () {
                $('.submitBtnrepair').attr("disabled","disabled");
               // $('.modal-body').css('opacity', '.5');
            },
			
            success:function(msg){
				 
				 var result = $.trim(msg);
                if(result == 'ok'){
					 
                    $('#productname').val('');
                    $('#productcount').val('');
                    $('#customername').val('');
					$('#email').val('');
					$('#phone').val('');
					$('#customeraddress').val('');
					$('#message').val('');
					 
					toastr.success('Request has been sent successfully,<br>we will reach you soon. Thankyou!!.');
                    //$('.statusMsg').html('<span style="color:green;">Product Added to Cart,<br>we will reach you soon. Thankyou!!.</p>');
                }else{
					toastr.error('Email and Phone Already Exist<br>For this Product!!.');
                 //   $('.statusMsg').html('<span style="color:red;">Product Already Added to Cart.</span>');
                }
                $('.submitBtnrepair').removeAttr("disabled");
                $('.modal-body').css('opacity', '');
            }
        });
    }
}
</script>
			<?php include('footer.php'); ?>

</body>
</html>