<?php
    require('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php print('Blog | '.WEBSITE_NAME.' | '.WEBSITE_TAGLINE); ?></title>
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
                    <h3><span class="">Blog</span></h3>
                </div>
            </div>
			
			</div>
			</section>


<div class="container">

<div class="related_post_area">
                             
                            <div class="related_post_container">
							 
                                <div class="row">
								
								<?php  
                        if(mysqli_num_rows($blogResult) > 0){  
                             while($allblog = mysqli_fetch_assoc($blogResult)){
                         
						  
                            ?>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="single_related_post wow fadeInUp" data-wow-delay="0.1s" data-wow-duration="1.1s">
                                            <div class="related_thumb">
											<?php 
		 if($allblog['blog'] > 0){?>
                                            <img src="<?php print(WEBSITE_URL.'/admin/files/'.$allblog['blog']); ?>" class="card-img" style="width:100%; height: 330px; object-fit: fill;">
		 <?php } else { ?>	
<img src="<?php print(WEBSITE_URL.'/images/blog3.jpg'); ?>" class="card-img" style="width:100%; height: 330px; object-fit: fill;"> <?php } ?>
		  							
      
                                            </div>
                                            <div class="related_post_text">
                                                <p><?php echo date("d M Y", strtotime($allblog['created_date']));?></p>
                                                <h3> <a href="#"><?php echo $allblog['blog_name'];?></a> </h3>
                                            </div>
						</div>
                                    </div><?php }} ?>
                                     
                                     
                                </div>
                            </div>
                        </div>
                    </div> 
                 
             
  
<?php include('footer.php'); ?>

</body>
</html>