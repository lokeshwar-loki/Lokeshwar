<?php
    require('config.php');
    $isValid = false;
    if(isset($_GET['url'])){
        $url = sanitise($_GET['url']);
        $listingResult = mysqli_query($connection, "SELECT p.*,(select i.image FROM global_product_image i where i.product_id=p.id order by i.id desc limit 1)image FROM `global_product` p WHERE p.`product_sku` = '$url' AND p.`status` = 1");
        if(mysqli_num_rows($listingResult) == 1){
            $listingData = mysqli_fetch_assoc($listingResult);
            $isValid = true;
        }
    }

    if($isValid == false){
        header("Location:".WEBSITE_URL.'/404');
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php print(ucwords($listingData['product_name']).' | '.WEBSITE_NAME); ?></title>
    <?php
        include('links.php');
    ?>
	 
</head>
<body>
    
    <?php include('header.php'); ?>

    <?php include('hero-banner.php'); ?>

	  

<section class="my-md-5 my-2">
        <div class="container-fluid px-md-4 px-0 row mx-auto">
		<div class="col-md-2">
                
            </div>
            <div class="col-md-8">
                 <div class="top-catgories text-center" >
                    <h3><span class="">Product details</span></h3>
                </div>
				
            </div>
			
			</div>
			</section>	
			 	 
		
			<div class="content-area" id="capp">
			<div class="container">
        <div class="image_loader"></div>
		
        <div class="col-xl-8 col-md-7 col-sm-7" style="float: left;">
            <div class="gap no-gap">
                <div class="inner-bg">
                     
                    <div id="product-details">
                        <div class='gap no-top'>
                            <div class='product-details-wrapper paddlr70'>
                                <div class='product-detail paddlr100'>
								
                                    <div class='row'>
                                        <div class='col-lg-12 col-md-12'>
                                            <div class='row'>
                                                <div class='col-md-4'>
                                                    <div class='product_image'>
													
													 
                                                        <?php 
		 if($listingData['image'] > 0){
                                     
                                    print('<img  src="'.WEBSITE_URL.'/admin/files/'.$listingData['image'].'" style="width:100%; height: 200px; object-fit: fill;">');
		 }
else
{
	print('<img  src="'.WEBSITE_URL.'/images/products.jpg" style="width:100%; height: 200px; object-fit: fill;">');
}
	
             ?>
                                                    </div>

                                                    <div class='product_image'>
                                                        <img style="width='100%'; height: 230px;    object-fit: fill;">
                                                    </div>

                                                </div>
                                                <div class='col-md-8'>
                                                    <div class='product-detail-info'>
                                                        <h1 class="py-3 px-2 text-center" style='margin-top: 0px'>
                                                           <span> <?php print(ucwords($listingData['product_name']));?></span></h1>
                                                        <ul class='description'>
                                                             <div class=" text-muted text-justify">
                                                            <li>Product SKU: <strong><?php print(ucwords($listingData['product_sku']));?></strong></li>
                                                           	 
                                               <?php if(!empty($listingData['specification'])){
                                                     ?>
											  <li>Specification: <strong><?php print($listingData['specification']);?></strong></li><?php } ?>
                                                      
												<?php if(!empty($listingData['usage_application'])){
                                                     ?>
														                         
															 
													  <li>Usage Application: <strong><?php print($listingData['usage_application']);?></strong></li><?php } ?>
                                                        </ul>
                                                         

                                                        <div class='cart-quantity text-right py-3'>
                                                                          <div>
																		  
                                                                   <button class='btn-st  read__sample rd-30 goto-cart-btn' data-toggle="modal" data-target="#addCartModel">
                                    
                                                                        <i class='fa fa-shopping-cart'></i>Add to cart </button>
                                                                 
                                                            </div>
                                                        </div>
														<hr>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

  </div>
                        </div>
						
						 </div>
                        </div>

  </div>
                        
	   

<div class="modal fade" id="addCartModel" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0">
            <div class="modal-header p-3">
               Add Product to Cart
                <button class="btn close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
             
            <!-- Modal Body -->
            <div class="modal-body">
               <!-- <p class="statusMsg"></p>-->
                <form role="form">
				 
                        <input type="hidden" id="producturl" class="form-control border-0 no-focus p-4" value="<?php echo $_GET['url'];?>" required>
                     
				<div class="border rounded position-relative w-100 mb-4">
                        <label class="position-absolute mt-n2 px-2 bg-white small ml-2">Your Name</label>
                        <input type="text" id="customername" class="form-control border-0 no-focus p-4" required>
                    </div>
					<div class="border rounded position-relative w-100 mb-4">
                        <label class="position-absolute mt-n2 px-2 bg-white small ml-2">Email</label>
                        <input type="email" id="customerEmail" class="form-control border-0 no-focus p-4"   required>
                    </div>
         			 
                    <div class="border rounded position-relative w-100 mb-4">
                        <label class="position-absolute mt-n2 px-2 bg-white small ml-2">Mobile Number</label>
                        <input type="number" id="mobileno" class="form-control border-0 no-focus p-4" required>
                    </div>
					<div class="border rounded position-relative w-100 mb-4">
                        <label class="position-absolute mt-n2 px-2 bg-white small ml-2">Address</label>
                        <textarea id="customeraddress" class="form-control no-focus border-0 p-3" required></textarea>
                    </div>
					<div class="border rounded position-relative w-100 mb-4">
                        <label class="position-absolute mt-n2 px-2 bg-white small ml-2">City</label>
                        <input type="text" id="city" class="form-control border-0 no-focus p-4" required>
                    </div>
					<div class="border rounded position-relative w-100 mb-4">
                        <label class="position-absolute mt-n2 px-2 bg-white small ml-2">State</label>
                        <input type="text" id="state" class="form-control border-0 no-focus p-4" required>
                    </div>
                     
                     
                </form>
            </div>
             
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary submitBtn" onclick="submitContactForm()">SUBMIT</button>
            </div>
        </div>
    </div>
</div>
 	<!-- Toastr -->
	<script>
function submitContactForm(){
    var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    var name = $('#customername').val();
    var email = $('#customerEmail').val();
    var mobileno = $('#mobileno').val();
	var customeraddress = $('#customeraddress').val();
    var city = $('#city').val();
    var state = $('#state').val();
	var producturl = $('#producturl').val();
    if(name.trim() == '' ){
        alert('Please enter your name.');
        $('#customername').focus();
        return false;
    }else if(email.trim() == '' ){
        alert('Please enter your email.');
        $('#customerEmail').focus();
        return false;
    }else if(email.trim() != '' && !reg.test(email)){
        alert('Please enter valid email.');
        $('#customerEmail').focus();
        return false;
    }else if(mobileno.trim() == '' ){
        alert('Please enter your Mobile No.');
        $('#mobileno').focus();
        return false;
    }
	else if(customeraddress.trim() == '' ){
        alert('Please enter your Address.');
        $('#customeraddress').focus();
        return false;
    }
	else if(city.trim() == '' ){
        alert('Please enter your City.');
        $('#city').focus();
        return false;
    }
	else if(state.trim() == '' ){
        alert('Please enter your state.');
        $('#state').focus();
        return false;
    }else{
        $.ajax({
            type:'POST',
            url:'submit_cart.php',
            data:'contactFrmSubmit=1&name='+name+'&email='+email+'&mobileno='+mobileno+'&customeraddress='+customeraddress+'&city='+city+'&state='+state+'&producturl='+producturl,
            beforeSend: function () {
                $('.submitBtn').attr("disabled","disabled");
                $('.modal-body').css('opacity', '.5');
            },
			
            success:function(msg){
				 
				 var result = $.trim(msg);
                if(result == 'ok'){
                    $('#customername').val('');
                    $('#customerEmail').val('');
                    $('#mobileno').val('');
					$('#customeraddress').val('');
					$('#city').val('');
					$('#state').val('');
					toastr.success('Product Added to Cart,<br>we will reach you soon. Thankyou!!.');
                    //$('.statusMsg').html('<span style="color:green;">Product Added to Cart,<br>we will reach you soon. Thankyou!!.</p>');
                }else{
					toastr.error('Product Already Added to Cart.');
                 //   $('.statusMsg').html('<span style="color:red;">Product Already Added to Cart.</span>');
                }
                $('.submitBtn').removeAttr("disabled");
                $('.modal-body').css('opacity', '');
            }
        });
    }
}
</script>
	  
	 <div class="container-fluid px-md-4 px-0 row mx-auto">
          
        					 </div> 
    
 
		  
		
<?php include('footer.php'); ?>

</body>
</html>