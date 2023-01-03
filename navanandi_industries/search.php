<?php
    require('config.php');

    if(isset($_GET['q'])){
        $searchTerm = sanitise($_GET['q']);
    }
    if(isset($_GET['sort'])){
        $searchSort = sanitise($_GET['sort']);
    }else{
        $searchSort = 0;
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php if(isset($_GET['q'])){print(sanitise($_GET['q']).' - ');} print('Search | '.WEBSITE_NAME); ?></title>
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
                <?php
                    if(isset($searchTerm)){
                        
                ?>

                <div class="row mb-4">

                    <?php
                        $searchSQL = "SELECT p.*,(select i.image FROM global_product_image i where i.product_id=p.id order by i.id desc limit 1)image from `global_product` p 
						WHERE p.`search_keywords_url` LIKE '%$searchTerm%' and p.status='1'";
						 
                        if(isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0){
                            $page = $_GET['page'];
                        }else{
                            $page = 1;
                        }
                        $perPage = 20;
                        $totalResult = mysqli_num_rows(mysqli_query($connection, $searchSQL));
                        $totalPage = floor($totalResult/$perPage);
                        if($totalPage%$perPage != 0){
                            $totalPage++;
                        }
                        $limit = $perPage*($page-1);
                        $searchSQL .= " LIMIT $limit , $perPage";

                        $searchResult = mysqli_query($connection, $searchSQL);
                        print(mysqli_error($connection));
                        if(mysqli_num_rows($searchResult) > 0){
                            
                                while($searchRow = mysqli_fetch_assoc($searchResult)){
                                    $searchRowId = $searchRow['id'];
                                ?>
								
								
								
<div class="col-lg-6 col-12 p-md-4 p-3">
<div class="border rounded p-3 shadow-sm">

			<div class="titleflex-fill">
			<div class="title text-center">
			<a href="<?php print(WEBSITE_URL.'/product-details?url='.$searchRow['product_sku']); ?>">
			<h5 class="m-0 font-poppins text-dark font-poppins_line"><?php print(ucwords($searchRow['product_name'])); ?></h5>
            </a>
     
  </div>
                                                
</div>

<div class="d-flex">
                        <div class="d-inline-block">
                            <div class="border">
                                                                <a href="<?php print(WEBSITE_URL.'/product-details?url='.$searchRow['product_sku']); ?>">
                                                    <?php
                                                        if(strlen($searchRow['image']) > 0){
                                                            print('<img src="'.WEBSITE_URL.'/admin/files/'.$searchRow['image'].'" height="100" width="100">');
                                                        }else{
                                                            print('<img src="'.WEBSITE_URL.'/images/no-thumb.jpg" height="100" width="100">');
                                                        }
                                                    ?>
													</a>
                            </div>
                        </div>
                        <h5 class="flex-fill text-center pt-3 px-3">
                            <div class="d-md-block d-none">
                                <a href="<?php print(WEBSITE_URL.'/product-details?url='.$searchRow['product_sku']); ?>">
    <h3 class="text-red blink-soft "> <i class="fa fa-product-hunt"><?php echo str_repeat("&nbsp;",2); ?><?php print(ucwords($searchRow['product_sku'])) ?> </i></h3>   
   </a>
  
   </div>
                        </h5>
                         
                    </div>
 
 										<div class="flex-fill">
												
											
		   
		    		               
                                             <!--   <div class="w-100 pt-2">
												<a href="<?php print(WEBSITE_URL.'/product-details/'.$searchRow['product_sku']); ?>">
                                                    <?php
                                                        if(strlen($searchRow['image']) > 0){
                                                            print('<img src="'.WEBSITE_URL.'/admin/files/'.$searchRow['image'].'" height="100" width="100">');
                                                        }else{
                                                            print('<img src="'.WEBSITE_URL.'/images/no-thumb.jpg" height="60" width="60">');
                                                        }
                                                    ?>
													</a>
                                                </div>
												
												 <div class="flex-fill text-right">
												<a href="<?php print(WEBSITE_URL.'/product-details/'.$searchRow['product_sku']); ?>">
    <h3 class="text-red blink-soft "> <i class="fa fa-product-hunt"><?php echo str_repeat("&nbsp;",2); ?><?php print(ucwords($searchRow['product_sku'])) ?> </i></h3>   
   </a>
           </div>-->
												
												
										<div class="py-3 px-2 text-muted border-top border-bottom text-justify">
                                            <?php
                                                if(!empty($searchRow['specification'])){
                                                    if(strlen($searchRow['specification']) < 200){?>
														 
                                            <i class="text-muted"><b>Specification: </b></i>
                                                                                     
																					<?php 
                                                        print($searchRow['specification']);
                                                    }else{
                                                        print(substr(($searchRow['specification']), 0, 200).'...');
                                                    }
                                                }
                                            ?>
                                        </div>
										<div>
                                            <a class="btn btn-warning w-100" href="<?php print(WEBSITE_URL.'/product-details?url='.$searchRow['product_sku']); ?>">View Details</a>
                                        </div>
		
                                            </div>
											
											
											
											
								 
							<!--<div class="d-flex flex-row">
  
                                                <a class="border shadow-sm d-inline-block" href="<?php print(WEBSITE_URL.'/listing/'.$searchRow['url']); ?>">
                                                    <?php
                                                        if(strlen($searchRow['status']) > 1){
                                                            print('<img src="'.WEBSITE_URL.'/admin/files/'.$searchRow['id'].'" height="100" width="100">');
                                                        }else{
                                                            print('<img src="'.WEBSITE_URL.'/images/no-thumb.jpg" height="60" width="60">');
                                                        }
                                                    ?>
                                                </a>
												</div>-->
												
		 
</div>
</div>
 

                            <?php }
                            
                                if($totalPage > 1){
                                    print('<div class="w-100 pt-3">');
                                    print('<ul class="pagination justify-content-center">');
                                    print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/search?q='.$_GET['q'].'"><i class="fa fa-angle-double-left"></i> First</a></li>');
                                    if($totalPage <= 9){
                                        for($i=1; $i<=$totalPage; $i++){
                                            $nextPageLink = WEBSITE_URL.'/search?q='.$_GET['q'].'&page='.$i;
                                            print('<li class="page-item"><a class="page-link text-warning" href="'.$nextPageLink.'">'.$i.'</a></li>');
                                        }
                                    }else{
                                        if($page > 3 && $page < ($totalPage - 2)){
                                            print('<li class="page-item disabled"><a class="page-link text-warning" href="#">...</a></li>');
                                            print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/search?q='.$_GET['q'].'&page='.($page-2).'">'.($page-2).'</a></li>');
                                            print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/search?q='.$_GET['q'].'&page='.($page-1).'">'.($page-1).'</a></li>');
                                            print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/search?q='.$_GET['q'].'&page='.$page.'">'.$page.'</a></li>');
                                            print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/search?q='.$_GET['q'].'&page='.($page+1).'">'.($page+1).'</a></li>');
                                            print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/search?q='.$_GET['q'].'&page='.($page+2).'">'.($page+2).'</a></li>');
                                            print('<li class="page-item disabled"><a class="page-link text-warning" href="#">...</a></li>');
                                        }else{
                                            print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/search?q='.$_GET['q'].'&page=1">1</a></li>');
                                            print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/search?q='.$_GET['q'].'&page=2">2</a></li>');
                                            print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/search?q='.$_GET['q'].'&page=3">3</a></li>');
                                            print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/search?q='.$_GET['q'].'&page=4">4</a></li>');
                                            print('<li class="page-item disabled"><a class="page-link text-warning" href="#">...</a></li>');
                                            print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/search?q='.$_GET['q'].'&page='.($totalPage-3).'">'.($totalPage-3).'</a></li>');
                                            print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/search?q='.$_GET['q'].'&page='.($totalPage-2).'">'.($totalPage-2).'</a></li>');
                                            print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/search?q='.$_GET['q'].'&page='.($totalPage-1).'">'.($totalPage-1).'</a></li>');
                                            print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/search?q='.$_GET['q'].'&page='.$totalPage.'">'.$totalPage.'</a></li>');
                                        }
                                    }
                                    print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/search?q='.$_GET['q'].'&page='.$totalPage.'"> Last <i class="fa fa-angle-double-right"></i></a></li>');
                                    print('</ul>');
                                    print('</div>');
                                }
        
                        }else{
                            print('<h3 class="text-center w-100 cus-shadow p-4 mx-3 my-0 font-weight-light">No Result was found for '.$searchTerm.'</h3>');
                        }
                    ?>
                </div>


                <?php } ?>
                 
            </div>

            <div class="col-md-2 d-md-block d-none">
                
            </div>
        </div>
    </section>

    <?php include('footer.php'); ?>

</body>
</html>