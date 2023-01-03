<section class="py-0">
    <div class="jumbotron rounded-0 m-0 p-0 position-relative overflow-hidden">
        <div class="jumbotron-background">
            <img src="<?php print(WEBSITE_URL.'/images/banner.jpg'); ?>" class="w-100" height="100%">
        </div>
        <div class="position-relative jumbotron-custom py-5 px-md-4 px-3" style="z-index:2;">
            <h1 class="text-center text-white mb-4 mt-md-5 mt-4">
                <?php
                    if(isset($searchTerm)){
                        print('Showing results for "'.ucwords($searchTerm).'"');
                    }else{
                        print('What to search?');
                    }
                ?>
            </h1>
            
            <div class="container rounded py-3 mb-md-5 mb-4">
                <form method="get" action="<?php print(WEBSITE_URL.'/search'); ?>">
                    <div class="row">
                        <div class="col-lg-8 col-sm-8 col-md-8">
                            <div class="input-group py-md-2 border rounded bg-white position-relative w-100 mb-4 p-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-transparent border-0 pl-md-3 pl-1"><i class="text-muted fa fa-search"></i></span>
                                </div>
                                <input type="text" name="q" required class="form-control input-warning no-focus border-0 py-md-3 py-4" placeholder="Enter Product Name or service"
                                    <?php
                                        if(isset($searchTerm)){
                                            print('value="'.$searchTerm.'"');
                                        }
                                    ?>
                                >
                            </div>
                        </div>
                        
                        
                        <div class="col-lg-4 pt-md-0 pt-4">
                            <input type="submit" value="Search" class="btn btn-warning px-0 py-3 w-100">
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</section>