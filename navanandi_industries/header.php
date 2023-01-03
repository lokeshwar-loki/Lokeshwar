  <header>
    <nav class="navbar navbar-expand-xl navbar-light bg-white px-lg-4 px-3 py-md-2 py-3 shadow-sm">
        <div class="navbar-barand">
            <a href="<?php print(WEBSITE_URL); ?>"> 
                <img src="<?php print(WEBSITE_URL.'/images/logosample.png'); ?>" class="navbar-brand-logo">
            </a>
             
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigationMenu" aria-controls="navigationMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navigationMenu">
            <ul class="navbar-nav ml-auto pb-lg-0 pb-2">
			<li class="nav-item position-relative ml-lg-3 ml-0"><a class="nav-link nav-link-cus px-2 mx-2" style="color:#242222" href="<?php print(WEBSITE_URL.'/index'); ?>">HOME</a></li>
                <li class="nav-item position-relative ml-lg-3 ml-0"><a class="nav-link nav-link-cus px-2 mx-2 link_color" style="color:#242222" href="<?php print(WEBSITE_URL.'/about-us'); ?>">ABOUT US</a></li>
                <li class="nav-item position-relative ml-lg-3 ml-0"><a class="nav-link nav-link-cus px-2 mx-2" style="color:#242222" href="<?php print(WEBSITE_URL.'/product'); ?>">PRODUCT</a></li>
				<li class="nav-item position-relative ml-lg-3 ml-0"><a class="nav-link nav-link-cus px-2 mx-2" style="color:#242222" href="<?php print(WEBSITE_URL.'/repair_and _services'); ?>">REPAIR AND SERVICE</a></li>
                <li class="nav-item position-relative ml-lg-3 ml-0"><a class="nav-link nav-link-cus px-2 mx-2" style="color:#242222" href="<?php print(WEBSITE_URL.'/blog'); ?>">BLOG</a></li>
                <li class="nav-item position-relative ml-lg-3 ml-0"><a class="nav-link nav-link-cus px-2 mx-2" style="color:#242222" href="<?php print(WEBSITE_URL.'/career'); ?>">CAREER</a></li>
                <li class="nav-item position-relative ml-lg-3 ml-0"><a class="nav-link nav-link-cus px-2 mx-2" style="color:#242222" href="<?php print(WEBSITE_URL.'/contact_us'); ?>">CONTACT US</a></li>
               
				 
				<?php
                    if(isset($_SESSION['user'])){
                        print('<li class="nav-item position-relative ml-lg-3 ml-0">');
                        print('<a  class="nav-link nav-link-cus px-0 mx-0" href="'.WEBSITE_URL.'/logout" class="">Logout</a>');
                        print('</li>');
                    }
                ?>
				 <span class="fa-stack fa-2x has-badge"  data-count="5">
  <i class="fa fa-circle fa-stack-2x count"></i>
  <i class="fa fa-shopping-cart fa-stack-1x fa-inverse"><?php if($productTotalRow['products'] > 0){ echo $productTotalRow['products']; }?> </i>
</span> 

            </ul>
        </div>
    </nav>
</header>
 