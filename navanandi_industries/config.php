<?php
    
    session_start();

    date_default_timezone_set('Asia/Kolkata');

    define("WEBSITE_NAME", "Global Enterprises");
    define("WEBSITE_TAGLINE", "The only Local Search Engine");
    // define("WEBSITE_URL", "http://".$_SERVER['HTTP_HOST'].'/navanandi_industries');
    define("WEBSITE_URL", "http://localhost/navanandi_industries");

    define("CONTACT_PERSON", " ");
    define("CONTACT_PERSON_POST"," ");
    define("CONTACT_EMAIL", "teste@gmail.com");
    define("CONTACT_PHONE", "+ 68 999999");

    define("DATABASE_HOST","localhost");
    define("DATABASE_USER","navana89_NniDatabase_User");
    define("DATABASE_PASS","NavandiUser@123");
    define("DATABASE_NAME","navana89_navanandiIDB");

    $connection = mysqli_connect(DATABASE_HOST, DATABASE_USER , DATABASE_PASS, DATABASE_NAME);
    if(!$connection){
        die('Failed to connect to Database');
    }

    if(!isset($_COOKIE['googtrans'])){
        setcookie('googtrans','/en/en', time()+31536000, '/');
    }

    function sanitise($string){
        $string = mysqli_real_escape_string($GLOBALS['connection'],$string);
        $string = htmlentities($string);
        return $string;
    }

    function makeSlug($text){
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '-', $text);
        $text = strtolower($text);
        return $text;
    }
	
	$productList = array();
    $productListSQL = " SELECT p.*,(select i.image FROM global_product_image i where i.product_id=p.id order by i.id desc limit 1)image FROM `global_product` p WHERE p.`status` = 1 ORDER BY p.created_date DESC";
    $productListResult = mysqli_query($connection, $productListSQL);
    while($productRow = mysqli_fetch_assoc($productListResult)){
        array_push($productList, $productRow);
    }
	
	$productTotal = " SELECT  count(id)products from global_addtocartproduct c WHERE c.product_url in(SELECT product_sku FROM `global_product` WHERE `status` = 1) and c.status=1";
    $productTotalResult = mysqli_query($connection, $productTotal);
    $productTotalRow = mysqli_fetch_assoc($productTotalResult);
	
	
	$locationTotal = " SELECT  location_name,location_map from global_location WHERE status=1 order by id desc limit 2";
    $locationResult = mysqli_query($connection, $locationTotal);
     
    
	$careerTotal = " SELECT * from global_career WHERE status=1 order by id desc";
    $careerResult = mysqli_query($connection, $careerTotal);
     
 $BlogsTotal = " SELECT * from global_blog WHERE status=1 order by id desc";
    $blogResult = mysqli_query($connection, $BlogsTotal);
	
	$catalogTotal = " SELECT * from global_catalogs WHERE status=1 order by id desc";
    $catalogResult = mysqli_query($connection, $catalogTotal);
     
     
?>