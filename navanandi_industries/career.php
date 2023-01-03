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
                 <div class="top-catgories text-center">
                    <h3><span class="">Career</span></h3>
                </div>
            </div>
			
			</div>
			</section>


<div class="container">

       <div class="row">
                <div class="col-12">
                    <div class="blog_details_content">
					
					<?php  
                        if(mysqli_num_rows($careerResult) > 0){ $i=1;
                             while($allcareer = mysqli_fetch_assoc($careerResult)){
                         
						  
                            ?>
                        <div class="blog_details_top d-flex">
						
						
                            <div class="blog__author wow fadeInUp" data-wow-delay="0.1s" data-wow-duration="1.1s">
                                
                                <div class="blog_author_name">
                                    <div class="text-center">
                            <div class="rounded-circle border border-warning bg-white text-warning d-inline-block card-icon-rounded">
                                <i class="fa"><?php echo $i++;?></i>
                            </div></div>
                                </div>
								<div class="portfolio_meta">
                                <div class="portfolio_meta_list">
                                    <h4>Total Vacancies</h4>
                                    <span><?php echo $allcareer['total_position'];?></span>
                                </div>
                                <div class="portfolio_meta_list">
                                    <h4>Job Location</h4>
                                    <span><?php echo $allcareer['job_location'];?></span>
                                </div>
                                <div class="portfolio_meta_list">
                                    <h4>Salary</h4>
                                    <span><?php echo $allcareer['package'];?></span>
                                </div>
                            </div>
                                 
                            </div>    
                            <div class="blog_details_sidebar">
  
 <div class="blog_details_title wow fadeInUp" data-wow-delay="0.2s" data-wow-duration="1.2s">
                                     
                                <div class="blog_details_desc">
								<h4 class="wow fadeInUp" data-wow-delay="0.1s" data-wow-duration="1.1s"><?php echo $allcareer['job_title'];?></h4>
                                   
                                    <p class="wow fadeInUp" data-wow-delay="0.2s" data-wow-duration="1.2s"><?php echo nl2br($allcareer['description']);?>.</p>
                                 </div>
                                  
                                 
                            </div>
                            
                        </div>
						</div><hr><?php }}?>
                            
                        </div>
						
						</div>
						</div>
						</div>
                            
                         
						
						  
						 <div class="container-fluid px-md-4 px-0 row mx-auto">
		 
                 
            </div>
		
<?php include('footer.php'); ?>

</body>
</html>