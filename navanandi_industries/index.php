<?php
    require('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php print(WEBSITE_NAME.' | '.WEBSITE_TAGLINE); ?></title>
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
                 <div class="top-catgories text-center">
                    <h3><span class="">Latest Products</span></h3>
                </div>
            </div>
			
			</div>
			</section>

<div class="container">

<div class="related_post_area">
                             
                            <div class="related_post_container">
                                <div class="row">
                    <?php
                        if(count($productList) < 6){
                            for($i=0; $i<count($productList); $i++){
                                ?>
                               <div class="col-lg-4 col-md-6 col-sm-6">
                                    <a href="<?php print(WEBSITE_URL.'/product-details?url='.$productList[$i]['product_sku']); ?>">
                                        <div class="single_related_post wow fadeInUp" data-wow-delay="0.1s" data-wow-duration="1.1s">
                                            <div class="related_thumb">
											<?php 
		 if($productList[$i]['image'] > 0){?>
                                            <img src="<?php print(WEBSITE_URL.'/admin/files/'.$productList[$i]['image']); ?>" class="card-img" style="width:100%; height: 230px; object-fit: fill;">
		 <?php } else { ?>	
<img src="<?php print(WEBSITE_URL.'/images/products.jpg'); ?>" class="card-img" style="width:100%; height: 230px; object-fit: fill;"> <?php } ?>
		 <div class="related_post_text">
                                     
                                                <h5 class="card-title pt-md-3 pt-2 my-0"><?php print(ucwords($productList[$i]['product_name'])); ?></h5>
                                            </div>
											  </div>
	           
												
											</div>
                                        
										</a>
                                    </div>
                                 
                                <?php
                            }
                        }else{
                            for($i=0; $i<6; $i++){
                                ?>
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <a href="<?php print(WEBSITE_URL.'/product-details?url='.$productList[$i]['product_sku']); ?>">
                                        <div class="single_related_post wow fadeInUp" data-wow-delay="0.1s" data-wow-duration="1.1s">
                                            <div class="related_thumb">
											<?php 
		 if($productList[$i]['image'] > 0){?>
                                            <img src="<?php print(WEBSITE_URL.'/admin/files/'.$productList[$i]['image']); ?>" class="card-img" style="width:100%; height: 230px; object-fit: fill;">
		 <?php } else { ?>	
<img src="<?php print(WEBSITE_URL.'/images/products.jpg'); ?>" class="card-img" style="width:100%; height: 230px; object-fit: fill;"> <?php } ?>
	                                         
											  <div class="related_post_text">
                                     
                                                <h5 class="card-title pt-md-3 pt-2 my-0"><?php print(ucwords($productList[$i]['product_name'])); ?></h6>
                                            </div>
											  </div>
	           
												
											</div>
                                        
										</a>
                                    </div>
                                <?php
                            }
                        }
                    ?>
</div>

                    <div class="col-12 text-center pb-5">
                        <a href="<?php print(WEBSITE_URL.'/product'); ?>" class="btn btn-outline-warning px-5 py-3 rounded">
                            View All products <span class="through-fro-animation d-inline-block"><i class="fa fa-angle-double-right"></i></span>
                        </a>
                    </div>

                     

                </div>
            </div>
			
			
			<div class="related_post_area">
                             
                            <div class="related_post_container">
							 
                                <div class="row">
								
								<?php  
                        if(mysqli_num_rows($catalogResult) > 0){  
                             while($allcatalog = mysqli_fetch_assoc($catalogResult)){
                         
						  
                            ?>
                                    <div class="col-lg-3 col-md-3 col-sm-6">
                                        <div class="single_related_post wow fadeInUp" data-wow-delay="0.1s" data-wow-duration="1.1s">
                                            <div class="related_thumb">
											<?php 
		 if($allcatalog['catalog'] > 0){?>
                                            <img src="<?php print(WEBSITE_URL.'/admin/files/'.$allcatalog['catalog']); ?>" class="card-img" style="width:100%; height: 180px; object-fit: fill;">
		 <?php } else { ?>	
<img src="<?php print(WEBSITE_URL.'/images/blog3.jpg'); ?>" class="card-img" style="width:100%; height: 180px; object-fit: fill;"> <?php } ?>
		  							
      
                                            </div>
                                            <div class="related_post_text">
                                                <p><?php echo date("d M Y", strtotime($allcatalog['created_date']));?></p>
                                                <h3> <a href="#"><?php echo $allcatalog['catalog_name'];?></a> </h3>
                                            </div>
						</div>
                                    </div><?php }} ?>
                                     
                                     
                                </div>
                            </div>
                        </div>

			 </div>
			
			 
			
			<section class="my-md-5 my-2">
        <div class="container-fluid px-md-4 px-0 row mx-auto">
		<div class="col-md-2">
                
            </div>
            <div class="col-md-8">
                 <div class="top-catgories text-center">
                    <h3><span class="">Enquire Product??..</span></h3>
                </div>
            </div>
			
			</div>
			</section>
			
	<div class="contact-area section-padding">
            <div class="container">
                <div class="row">
				
				<div class="col-lg-6">
                        <div class="contact-information">
                             
                    <img src="images/testimonial-position.png" alt="">
                
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="contact-message">
                  
<form role="form">

<div class="row">

                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <input name="product_name" id="product_name" placeholder="Enter Required Product Name *" type="text" required>
                                    </div>
									<div class="col-lg-12 col-md-12 col-sm-12">
                                        <input type="number" name="required_quantity" id="required_quantity" placeholder="Enter Required Quantity *" >
                                    </div>
					
									<div class="col-lg-12 col-md-12 col-sm-12">
                                        <input type="text" name="usage_Application" id="usage_Application" placeholder="Enter Usage Application/Industry *"  required>
                                    </div>
									
									<div class="col-lg-12 col-md-12 col-sm-12">
                                        <input type="text" name="company_name" id="company_name" placeholder="Enter Company Name *"  required>
                                    </div>
									<div class="col-lg-6 col-md-6 col-sm-6">
                                        <input type="text" name="contact_name" id="contact_name" placeholder="Contact Person*"   >
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <input type="number" name="phone" id="phone" placeholder="Phone *"  required>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <input type="email" name="email" id="email" placeholder="Email *"  required>
                                    </div>
					
									<div class="col-12">
                                        <div class="contact2-textarea text-center">
                                            <textarea  name="contact_address" id="contact_address" class="form-control2"  placeholder="Addres *"></textarea>
                                        </div>
                                        <div class="contact-btn">
										 
										<button type="submit" onclick="submitEnquiryForm()" class="btn btn-warning submitBtnEnquiry" value="SEND MESSAGE">SEND MESSAGE</button>
                                             
                                        </div>
                                    </div>

                      
                </div>
				</form>
                </div>
 </div>
        </div>         
            </div>
			</div>
			 
			
			<script>
function submitEnquiryForm(){
    var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    var product_name = $('#product_name').val();
	var required_quantity = $('#required_quantity').val();
    var usage_Application = $('#usage_Application').val();
	var company_name = $('#company_name').val();
	var contact_name = $('#contact_name').val();
    var phone = $('#phone').val();
	var email = $('#email').val();
	var contact_address = $('#contact_address').val();
     
    
    if(product_name.trim() == '' ){
        alert('Please enter Product name.');
        $('#product_name').focus();
        return false;
    }else if(required_quantity.trim() == '' ){
        alert('Please enter required quantity.');
        $('#required_quantity').focus();
        return false;
    }else if(usage_Application.trim() == '' ){
        alert('Please enter usage_Application.');
        $('#usage_Application').focus();
        return false;
    }else if(company_name.trim() == '' ){
        alert('Please enter company Name.');
        $('#company_name').focus();
        return false;
    }else if(phone.trim() == '' ){
        alert('Please enter your Mobile No.');
        $('#phone').focus();
        return false;
    }else if(email.trim() == '' ){
        alert('Please enter your email.');
        $('#email').focus();
        return false;
    }else if(email.trim() != '' && !reg.test(email)){
        alert('Please enter valid email.');
        $('#email').focus();
        return false;
    } else if(contact_address.trim() == '' ){
        alert('Please enter your Name.');
        $('#contact_address').focus();
        return false;
    }
	 else{
        $.ajax({
            type:'POST',
            url:'submit_enquiry.php',
            data:'contactFrmSubmit=1&product_name='+product_name+'&required_quantity='+required_quantity+'&usage_Application='+usage_Application+'&company_name='+company_name+'&contact_name='+contact_name+'&phone='+phone+'&email='+email+'&contact_address='+contact_address,
            beforeSend: function () {
                $('.submitBtnEnquiry').attr("disabled","disabled");
               // $('.modal-body').css('opacity', '.5');
            },
			
            success:function(msg){
				 
				 var result = $.trim(msg);
                if(result == 'ok'){
					 
                    $('#product_name').val('');
					$('#required_quantity').val('');
                    $('#usage_Application').val('');
					$('#company_name').val('');
					$('#contact_name').val('');
					$('#phone').val('');
					$('#email').val('');
					$('#contact_address').val('');
					 
					toastr.success('Request has been sent successfully,<br>we will reach you soon. Thankyou!!.');
                    //$('.statusMsg').html('<span style="color:green;">Product Added to Cart,<br>we will reach you soon. Thankyou!!.</p>');
                }else{
					toastr.error('Email and Phone Already Exist<br>For this Product!!.');
                 //   $('.statusMsg').html('<span style="color:red;">Product Already Added to Cart.</span>');
                }
                $('.submitBtnEnquiry').removeAttr("disabled");
               // $('.modal-body').css('opacity', '');
            }
        });
    }
}
</script>
			 
 
 
     

    <?php include('footer.php'); ?>

</body>
</html>