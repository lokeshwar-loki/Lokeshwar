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
                        $categoryURL = sanitise($_GET['url']);
                        $categoryPageResult = mysqli_query($connection, "SELECT * FROM `info_subcategory` WHERE `url` = '$categoryURL' AND `status` = 1");
                        if(mysqli_num_rows($categoryPageResult) == 1){
                            $categoryPageRow = mysqli_fetch_assoc($categoryPageResult);
                            $categoryToShowId = $categoryPageRow['id'];
                            print('<div class="p-4"><div class="row">');
                            $listingSQL = "SELECT listing.name, listing.about, listing.address, listing.email, listing.website, listing.membership, listing.url, listing.logo, listing.phone FROM `info_subcategory` JOIN `listing` JOIN `listing_subcategory` ON info_subcategory.id = listing_subcategory.subcategory_id AND listing.listing_id = listing_subcategory.listing_id WHERE listing_subcategory.subcategory_id = '$categoryToShowId'";
                            
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
                                print('<div class="col-12 pb-4 text-center"><h2><span class="bottom-short-border">Listed under <span class="text-warning">'.ucwords($categoryPageRow['title']).'</span></span></h2></div>');
                                while($listingRow = mysqli_fetch_assoc($listingResult)){
                                    ?>
                                   
                                    
                                <div class="col-lg-6 col-12 p-md-4 p-3">
                                    <div class="border rounded p-3 shadow-sm">
                                        <div class="d-flex flex-row">
                                            <div>
                                                <a class="border shadow-sm p-2 d-inline-block" href="<?php print(WEBSITE_URL.'/listing/'.$listingRow['url']); ?>">
                                                    <?php
                                                        if(strlen($listingRow['logo']) > 0){
                                                            print('<img src="'.WEBSITE_URL.'/admin/files/'.$listingRow['logo'].'" height="60" width="60">');
                                                        }else{
                                                            print('<img src="'.WEBSITE_URL.'/images/no-thumb.jpg" height="60" width="60">');
                                                        }
                                                    ?>
                                                </a>
                                            </div>
                                            <div class="flex-fill">
                                                <div class="w-100 pl-3">
                                                    <a href="<?php print(WEBSITE_URL.'/listing/'.$listingRow['url']); ?>">
                                                        <h5 class="m-0 font-poppins text-dark"><?php print(ucwords($listingRow['name'])); ?></h5>
                                                    </a>
                                                </div>
                                                <div class="w-100 pt-2 text-right">
                                                    <?php
                                                        if($listingRow['membership'] == 1){
                                                            print('<img src="'.WEBSITE_URL.'/images/platinum.png" height="55">');
                                                        }else if($listingRow['membership'] == 2){
                                                            print('<img src="'.WEBSITE_URL.'/images/gold.png" height="55">');
                                                        }else if($listingRow['membership'] == 3){
                                                            print('<img src="'.WEBSITE_URL.'/images/silver.png" height="55">');
                                                        }else if($listingRow['membership'] == 4){
                                                            print('<img src="'.WEBSITE_URL.'/images/bronze.png" height="55">');
                                                        }else{
                                                            
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="py-3 px-2 small text-muted border-bottom text-justify">
                                            <?php
                                                if($listingRow['membership'] < 4){
                                                    if(strlen(json_decode($listingRow['about'])->profile) < 200){
                                                        print(json_decode($listingRow['about'])->profile);
                                                    }else{
                                                        print(substr(json_decode($listingRow['about'])->profile, 0, 200).'...');
                                                    }
                                                }
                                            ?>
                                        </div>
                                        <div class="pt-1 px-2 mt-2 small text-muted">
                                            <i class="fa fa-map-marker mr-1"></i> <?php print(json_decode($listingRow['address'])->main); ?>
                                        </div>
                                        <div class="pt-1 px-2 small text-muted">
                                            <i class="fa fa-phone mr-1"></i>  <?php print(json_decode($listingRow['phone'])->telephone); ?>
                                        </div>
                                        <div class="py-3 mt-3 small border-top px-2">
                                            <ul class="list-inline m-0">
                                                <li class="list-inline-item">Share on : </li>
                                                <li class="list-inline-item">
                                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php print(WEBSITE_URL.'/listing/'.$listingRow['url']); ?>" target="_blank" class="btn btn-sm btn-outline-warning shadow-sm rounded-circle">&nbsp;<i class="fa fa-facebook"></i>&nbsp;</a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="https://www.twitter.com/share?url=<?php print(WEBSITE_URL.'/listing/'.$listingRow['url']); ?>" class="btn btn-sm btn-outline-warning shadow-sm rounded-circle"><i class="fa fa-twitter"></i></a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php print(WEBSITE_URL.'/listing/'.$listingRow['url']); ?>" class="btn btn-sm btn-outline-warning shadow-sm rounded-circle"><i class="fa fa-linkedin"></i></a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a class="btn btn-sm btn-warning text-white w-100" href="<?php print(WEBSITE_URL.'/enquire/'.$listingRow['url']); ?>">ENQUIRE</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div>
                                            <a class="btn btn-warning w-100" href="<?php print(WEBSITE_URL.'/listing/'.$listingRow['url']); ?>">View Details</a>
                                        </div>
                                    </div>
                                </div>

                                    <?php
                                }

                                if($totalPage > 1){
                                    print('<div class="w-100 pt-3">');
                                    print('<ul class="pagination justify-content-center">');
                                    print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/category/'.$categoryURL.'"><i class="fa fa-angle-double-left"></i> First</a></li>');
                                    if($totalPage <= 9){
                                        for($i=1; $i<=$totalPage; $i++){
                                            $nextPageLink = WEBSITE_URL.'/category/'.$_GET['url'].'?page='.$i;
                                            print('<li class="page-item"><a class="page-link text-warning" href="'.$nextPageLink.'">'.$i.'</a></li>');
                                        }
                                    }else{
                                        if($page > 3 && $page < ($totalPage - 2)){
                                            print('<li class="page-item disabled"><a class="page-link text-warning" href="#">...</a></li>');
                                            print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/category/'.$_GET['url'].'?page='.($page-2).'">'.($page-2).'</a></li>');
                                            print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/category/'.$_GET['url'].'?page='.($page-1).'">'.($page-1).'</a></li>');
                                            print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/category/'.$_GET['url'].'?page='.$page.'">'.$page.'</a></li>');
                                            print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/category/'.$_GET['url'].'?page='.($page+1).'">'.($page+1).'</a></li>');
                                            print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/category/'.$_GET['url'].'?page='.($page+2).'">'.($page+2).'</a></li>');
                                            print('<li class="page-item disabled"><a class="page-link text-warning" href="#">...</a></li>');
                                        }else{
                                            print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/category/'.$_GET['url'].'?page=1">2</a></li>');
                                            print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/category/'.$_GET['url'].'?page=2">1</a></li>');
                                            print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/category/'.$_GET['url'].'?page=3">3</a></li>');
                                            print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/category/'.$_GET['url'].'?page=4">4</a></li>');
                                            print('<li class="page-item disabled"><a class="page-link text-warning" href="#">...</a></li>');
                                            print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/category/'.$_GET['url'].'?page='.($totalPage-3).'">'.($totalPage-3).'</a></li>');
                                            print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/category/'.$_GET['url'].'?page='.($totalPage-2).'">'.($totalPage-2).'</a></li>');
                                            print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/category/'.$_GET['url'].'?page='.($totalPage-1).'">'.($totalPage-1).'</a></li>');
                                            print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/category/'.$_GET['url'].'?page='.$totalPage.'">'.$totalPage.'</a></li>');
                                        }
                                    }
                                    print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/category/'.$categoryURL.'?page='.$totalPage.'"> Last <i class="fa fa-angle-double-right"></i></a></li>');
                                    print('</ul>');
                                    print('</div>');
                                }


                            }else{
                                print('<div class="col-12 py-5">No Listing was found in this category</div>');
                            }
                            print('</div></div>');
                        }else{
                            print('<h1 class="text-center display-2 text-warning mt-5">404</h1>');
                            print('<p class="text-center">The Page you were looking for was not found here</p>');
                            print('<div class="text-center pb-5"><a class="btn btn-warning px-4 py-3" href="'.WEBSITE_URL.'">Go to Home</a></div>');
                        }
                    }else{
                        print('<div class="p-4"><div class="row">');

                        $allCategorySQL = "SELECT * FROM `info_subcategory` WHERE `status` = '1'";
                        if(isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0){
                            $page = $_GET['page'];
                        }else{
                            $page = 1;
                        }
                        $perPage = 20;
                        $totalResult = mysqli_num_rows(mysqli_query($connection, $allCategorySQL));
                        $totalPage = floor($totalResult/$perPage);
                        if($totalPage%$perPage != 0){
                            $totalPage++;
                        }
                        $limit = $perPage*($page-1);
                        $allCategorySQL .= " LIMIT $limit , $perPage";
                        $allCategoryResult = mysqli_query($connection, $allCategorySQL);

                        while($allCategoryRow = mysqli_fetch_assoc($allCategoryResult)){
                            ?>
                            <div class="col-xl-4 col-6 mb-4">
                                <a href="<?php print(WEBSITE_URL.'/category/'.$allCategoryRow['url']); ?>">
                                    <div class="card bg-light border-0 rounded overflow-hidden shadow-sm">
                                        <img src="<?php print(WEBSITE_URL.'/images/thumb.jpg'); ?>" class="card-img">
                                        <div class="card-img-overlay text-white d-flex justify-content-center align-items-center text-center p-0">
                                            <div class="card-content">
                                                <div class="rounded-circle bg-white text-warning d-inline-block card-icon-rounded">
                                                    <i class="fa fa-link"></i>
                                                </div>
                                                <h6 class="card-title pt-md-3 pt-2 my-0"><?php print(ucwords($allCategoryRow['title'])); ?></h6>
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
                            print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/category"><i class="fa fa-angle-double-left"></i> First</a></li>');
                            if($totalPage <= 9){
                                for($i=1; $i<=$totalPage; $i++){
                                    $nextPageLink = WEBSITE_URL.'/category?page='.$i;
                                    print('<li class="page-item"><a class="page-link text-warning" href="'.$nextPageLink.'">'.$i.'</a></li>');
                                }
                            }else{
                                if($page > 3 && $page < ($totalPage - 2)){
                                    print('<li class="page-item disabled"><a class="page-link text-warning" href="#">...</a></li>');
                                    print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/category?page='.($page-2).'">'.($page-2).'</a></li>');
                                    print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/category?page='.($page-1).'">'.($page-1).'</a></li>');
                                    print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/category?page='.$page.'">'.$page.'</a></li>');
                                    print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/category?page='.($page+1).'">'.($page+1).'</a></li>');
                                    print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/category?page='.($page+2).'">'.($page+2).'</a></li>');
                                    print('<li class="page-item disabled"><a class="page-link text-warning" href="#">...</a></li>');
                                }else{
                                    print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/category?page=1">2</a></li>');
                                    print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/category?page=2">1</a></li>');
                                    print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/category?page=3">3</a></li>');
                                    print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/category?page=4">4</a></li>');
                                    print('<li class="page-item disabled"><a class="page-link text-warning" href="#">...</a></li>');
                                    print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/category?page='.($totalPage-3).'">'.($totalPage-3).'</a></li>');
                                    print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/category?page='.($totalPage-2).'">'.($totalPage-2).'</a></li>');
                                    print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/category?page='.($totalPage-1).'">'.($totalPage-1).'</a></li>');
                                    print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/category?page='.$totalPage.'">'.$totalPage.'</a></li>');
                                }
                            }
                            print('<li class="page-item"><a class="page-link text-warning" href="'.WEBSITE_URL.'/category?page='.$totalPage.'"> Last <i class="fa fa-angle-double-right"></i></a></li>');
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