<?php
    require('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php print('Products | '.WEBSITE_NAME.' | '.WEBSITE_TAGLINE); ?></title>
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
                    <h3><span class="">Products</span></h3>
                </div>
            </div>
			
			</div>
			</section>
			
			<div class="container">

<div class="related_post_area">
			
			<div class="related_post_container">
                                 
     
                <?php 
                     
                        print('<div class="p-4"><div class="row">');

                        $allproductSQL = "SELECT p.*, (select i.image FROM global_product_image i where i.product_id=p.id order by i.id desc limit 1)image FROM `global_product` p WHERE p.`status` = 1 ORDER BY p.created_date DESC";
                        if(isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0){
                            $page = $_GET['page'];
                        }else{
                            $page = 1;
                        }
                        $perPage = 20;
                        $totalResult = mysqli_num_rows(mysqli_query($connection, $allproductSQL));
                        $totalPage = floor($totalResult/$perPage);
                        if($totalPage%$perPage != 0){
                            $totalPage++;
                        }
                        $limit = $perPage*($page-1);
                        $allproductSQL .= " LIMIT $limit , $perPage";
                        $allproductResult = mysqli_query($connection, $allproductSQL);

                        while($allproductRow = mysqli_fetch_assoc($allproductResult)){
                            ?>
							
							<div class="col-lg-4 col-md-6 col-sm-6">
                                    <a href="<?php print(WEBSITE_URL.'/product-details?url='.$allproductRow['product_sku']); ?>">
                                        <div class="single_related_post wow fadeInUp" data-wow-delay="0.1s" data-wow-duration="1.1s">
                                            <div class="related_thumb">
											<?php 
		 if($allproductRow['image'] > 0){?>
                                            <img src="<?php print(WEBSITE_URL.'/admin/files/'.$allproductRow['image']); ?>" class="card-img" style="width:100%; height: 230px; object-fit: fill;">
		 <?php } else { ?>	
<img src="<?php print(WEBSITE_URL.'/images/products.jpg'); ?>" class="card-img" style="width:100%; height: 230px; object-fit: fill;"> <?php } ?>
		 
                                             
											  <div class="related_post_text">
                                     
                                                <h5 class="card-title pt-md-3 pt-2 my-0"><?php print(ucwords($allproductRow['product_name'])); ?></h5>
                                            </div>
											  </div>
	           
												
											</div>
                                        
										</a>
                                    </div>
                             
                                 
                            <?php
                        }



                        if($totalPage > 1){
                            print('<div class="w-100 pt-3">');
                            print('<ul class="pagination justify-content-center">');
                            print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/product"><i class="fa fa-angle-double-left"></i> First</a></li>');
                            if($totalPage <= 9){
                                for($i=1; $i<=$totalPage; $i++){
                                    $nextPageLink = WEBSITE_URL.'/product?page='.$i;
                                    print('<li class="page-item"><a class="page-link text-warning" href="'.$nextPageLink.'">'.$i.'</a></li>');
                                }
                            }else{
                                if($page > 3 && $page < ($totalPage - 2)){
                                    print('<li class="page-item disabled"><a class="page-link text-warning" href="#">...</a></li>');
                                    print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/product?page='.($page-2).'">'.($page-2).'</a></li>');
                                    print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/product?page='.($page-1).'">'.($page-1).'</a></li>');
                                    print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/product?page='.$page.'">'.$page.'</a></li>');
                                    print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/product?page='.($page+1).'">'.($page+1).'</a></li>');
                                    print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/product?page='.($page+2).'">'.($page+2).'</a></li>');
                                    print('<li class="page-item disabled"><a class="page-link text-warning" href="#">...</a></li>');
                                }else{
                                    print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/product?page=1">2</a></li>');
                                    print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/product?page=2">1</a></li>');
                                    print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/product?page=3">3</a></li>');
                                    print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/product?page=4">4</a></li>');
                                    print('<li class="page-item disabled"><a class="page-link text-warning" href="#">...</a></li>');
                                    print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/product?page='.($totalPage-3).'">'.($totalPage-3).'</a></li>');
                                    print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/product?page='.($totalPage-2).'">'.($totalPage-2).'</a></li>');
                                    print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/product?page='.($totalPage-1).'">'.($totalPage-1).'</a></li>');
                                    print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/product?page='.$totalPage.'">'.$totalPage.'</a></li>');
                                }
                            }
                            print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/product?page='.$totalPage.'"> Last <i class="fa fa-angle-double-right"></i></a></li>');
                            print('</ul>');
                            print('</div>');
                        }




                        print('</div></div>');
                    //}
                ?>

                 
            </div>

             
        </div>
		</div>
    </section>

    <?php include('footer.php'); ?>

</body>
</html>