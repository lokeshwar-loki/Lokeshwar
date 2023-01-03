<?php
    require('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php print('Categories | '.WEBSITE_NAME.' | '.WEBSITE_TAGLINE); ?></title>
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
                <?php include('ad-left.php'); ?>
            </div>

            <div class="col-md-8">
                <?php
                    if(isset($_GET['url'])){
                         $subcategoryURL = sanitise($_GET['url']);
                        $subcategoryPageResult = mysqli_query($connection, "SELECT * FROM `category` WHERE `url` = '$subcategoryURL' AND `status` = 1");
                        if(mysqli_num_rows($subcategoryPageResult) == 1){
                            $subcategoryPageRow = mysqli_fetch_assoc($subcategoryPageResult);
                            $subcategoryToShowId = $subcategoryPageRow['category_id'];
                            print('<div class="p-4"><div class="row">');
                            $listingSQL = "SELECT *   FROM `info_subcategory` WHERE categoryid = '$subcategoryToShowId'";
                            
                            if(isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0){
                                $page = $_GET['page'];
                            }else{
                                $page = 1;
                            }
                            $perPage = 20;
                            $totalResult = mysqli_num_rows(mysqli_query($connection, $listingSQL));
                            $totalPage = floor($totalResult/$perPage);
                            if($totalPage%$perPage != 0){
                                $totalPage++;
                            }
                            $limit = $perPage*($page-1);
                            $listingSQL .= " LIMIT $limit , $perPage";
                            
                            $listingResult = mysqli_query($connection, $listingSQL);
                            print(mysqli_error($connection));
                            if(mysqli_num_rows($listingResult) > 0){
                                print('<div class="col-12 pb-4 text-center"><h2><span class="bottom-short-border">Subcategory under <span class="text-warning">'.ucwords($subcategoryPageRow['title']).'</span></span></h2></div>');
                                while($listingRow = mysqli_fetch_assoc($listingResult)){
                                    ?>
                                   
                                    
                                <div class="col-lg-4 col-12 p-md-4 p-3">
                                    <div class="border rounded p-3 shadow-sm">
                                        <div class="d-flex flex-row">
                                             
                                            <div class="flex-fill">
                                                 
                                                    <a href="<?php print(WEBSITE_URL.'/category/'.$listingRow['url']); ?>">
                                                        <h5 class="m-0 font-poppins text-dark"><?php print(ucwords($listingRow['title'])); ?></h5>
                                                    </a>
                                                
                                                 
                                            </div>
                                        </div>
                                         
                                         
                                        
                                    </div>
                                </div>

                                    <?php
                                }

                                if($totalPage > 1){
                                    print('<div class="w-100 pt-3">');
                                    print('<ul class="pagination justify-content-center">');
                                    print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/maincategory/'.$subcategoryURL.'"><i class="fa fa-angle-double-left"></i> First</a></li>');
                                    if($totalPage <= 9){
                                        for($i=1; $i<=$totalPage; $i++){
                                            $nextPageLink = WEBSITE_URL.'/maincategory/'.$_GET['url'].'?page='.$i;
                                            print('<li class="page-item"><a class="page-link text-warning" href="'.$nextPageLink.'">'.$i.'</a></li>');
                                        }
                                    }else{
                                        if($page > 3 && $page < ($totalPage - 2)){
                                            print('<li class="page-item disabled"><a class="page-link text-warning" href="#">...</a></li>');
                                            print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/maincategory/'.$_GET['url'].'?page='.($page-2).'">'.($page-2).'</a></li>');
                                            print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/maincategory/'.$_GET['url'].'?page='.($page-1).'">'.($page-1).'</a></li>');
                                            print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/maincategory/'.$_GET['url'].'?page='.$page.'">'.$page.'</a></li>');
                                            print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/maincategory/'.$_GET['url'].'?page='.($page+1).'">'.($page+1).'</a></li>');
                                            print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/maincategory/'.$_GET['url'].'?page='.($page+2).'">'.($page+2).'</a></li>');
                                            print('<li class="page-item disabled"><a class="page-link text-warning" href="#">...</a></li>');
                                        }else{
                                            print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/maincategory/'.$_GET['url'].'?page=1">2</a></li>');
                                            print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/maincategory/'.$_GET['url'].'?page=2">1</a></li>');
                                            print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/maincategory/'.$_GET['url'].'?page=3">3</a></li>');
                                            print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/maincategory/'.$_GET['url'].'?page=4">4</a></li>');
                                            print('<li class="page-item disabled"><a class="page-link text-warning" href="#">...</a></li>');
                                            print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/maincategory/'.$_GET['url'].'?page='.($totalPage-3).'">'.($totalPage-3).'</a></li>');
                                            print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/maincategory/'.$_GET['url'].'?page='.($totalPage-2).'">'.($totalPage-2).'</a></li>');
                                            print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/maincategory/'.$_GET['url'].'?page='.($totalPage-1).'">'.($totalPage-1).'</a></li>');
                                            print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/maincategory/'.$_GET['url'].'?page='.$totalPage.'">'.$totalPage.'</a></li>');
                                        }
                                    }
                                    print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/maincategory/'.$subcategoryURL.'?page='.$totalPage.'"> Last <i class="fa fa-angle-double-right"></i></a></li>');
                                    print('</ul>');
                                    print('</div>');
                                }


                            }else{
                                print('<div class="col-12 py-5">No Sub Category was found in this category</div>');
                            }
                            print('</div></div>');
                        }else{
                            print('<h1 class="text-center display-2 text-warning mt-5">404</h1>');
                            print('<p class="text-center">The Page you were looking for was not found here</p>');
                            print('<div class="text-center pb-5"><a class="btn btn-warning px-4 py-3" href="'.WEBSITE_URL.'">Go to Home</a></div>');
                        }
                    }else{
                        print('<div class="p-4"><div class="row">');

                        $allsubCategorySQL = "SELECT * FROM `category` WHERE `status` = '1' ORDER BY title ASC";
                        if(isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0){
                            $page = $_GET['page'];
                        }else{
                            $page = 1;
                        }
                        $perPage = 20;
                        $totalResult = mysqli_num_rows(mysqli_query($connection, $allsubCategorySQL));
                        $totalPage = floor($totalResult/$perPage);
                        if($totalPage%$perPage != 0){
                            $totalPage++;
                        }
                        $limit = $perPage*($page-1);
                        $allsubCategorySQL .= " LIMIT $limit , $perPage";
                        $allsubCategoryResult = mysqli_query($connection, $allsubCategorySQL);

                        while($allsubCategoryRow = mysqli_fetch_assoc($allsubCategoryResult)){
                            ?>
                            <div class="col-xl-4 col-6 mb-4">
                                <a href="<?php print(WEBSITE_URL.'/maincategory.php/?url='.$allsubCategoryRow['url']); ?>">
                                    <div class="card bg-light border-0 rounded overflow-hidden shadow-sm">
                                        <img src="<?php print(WEBSITE_URL.'/images/thumb.jpg'); ?>" class="card-img">
                                        <div class="card-img-overlay text-white d-flex justify-content-center align-items-center text-center p-0">
                                            <div class="card-content">
                                                <div class="rounded-circle bg-white text-warning d-inline-block card-icon-rounded">
                                                    <i class="fa fa-link"></i>
                                                </div>
                                                <h6 class="card-title pt-md-3 pt-2 my-0"><?php print(ucwords($allsubCategoryRow['title'])); ?></h6>
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
                            print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/maincategory"><i class="fa fa-angle-double-left"></i> First</a></li>');
                            if($totalPage <= 9){
                                for($i=1; $i<=$totalPage; $i++){
                                    $nextPageLink = WEBSITE_URL.'/maincategory?page='.$i;
                                    print('<li class="page-item"><a class="page-link text-warning" href="'.$nextPageLink.'">'.$i.'</a></li>');
                                }
                            }else{
                                if($page > 3 && $page < ($totalPage - 2)){
                                    print('<li class="page-item disabled"><a class="page-link text-warning" href="#">...</a></li>');
                                    print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/maincategory?page='.($page-2).'">'.($page-2).'</a></li>');
                                    print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/maincategory?page='.($page-1).'">'.($page-1).'</a></li>');
                                    print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/maincategory?page='.$page.'">'.$page.'</a></li>');
                                    print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/maincategory?page='.($page+1).'">'.($page+1).'</a></li>');
                                    print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/maincategory?page='.($page+2).'">'.($page+2).'</a></li>');
                                    print('<li class="page-item disabled"><a class="page-link text-warning" href="#">...</a></li>');
                                }else{
                                    print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/maincategory?page=1">2</a></li>');
                                    print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/maincategory?page=2">1</a></li>');
                                    print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/maincategory?page=3">3</a></li>');
                                    print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/maincategory?page=4">4</a></li>');
                                    print('<li class="page-item disabled"><a class="page-link text-warning" href="#">...</a></li>');
                                    print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/maincategory?page='.($totalPage-3).'">'.($totalPage-3).'</a></li>');
                                    print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/maincategory?page='.($totalPage-2).'">'.($totalPage-2).'</a></li>');
                                    print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/maincategory?page='.($totalPage-1).'">'.($totalPage-1).'</a></li>');
                                    print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/maincategory?page='.$totalPage.'">'.$totalPage.'</a></li>');
                                }
                            }
                            print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/maincategory?page='.$totalPage.'"> Last <i class="fa fa-angle-double-right"></i></a></li>');
                            print('</ul>');
                            print('</div>');
                        }




                        print('</div></div>');
                    }
                ?>

                <div class="col-12 mb-3">
                    <?php include('ad-slider.php'); ?>
                </div>
            </div>

            <div class="col-md-2 d-md-block d-none">
                <?php include('ad-right.php'); ?>
            </div>
        </div>
    </section>

    <?php include('footer.php'); ?>

</body>
</html>