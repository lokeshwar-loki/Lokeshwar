<?php

    session_start();

    if(basename($_SERVER['PHP_SELF']) != 'login.php'){
        if(!isset($_SESSION['admin'])){
            header("Location:login.php");
        }
    }

    date_default_timezone_set('Asia/Kolkata');

    define("WEBSITE_NAME", "Navanadi Industries");
    define("WEBSITE_TAGLINE", "The only Local Search Engine");
    // define("WEBSITE_URL", "http://".$_SERVER['HTTP_HOST'].'/navanandi_industries/admin');
    define("WEBSITE_URL", "http://localhost/navanandi_industries/admin");

    define("DATABASE_HOST","localhost");
    define("DATABASE_USER","navana89_NniDatabase_User");
    define("DATABASE_PASS","NavandiUser@123");
    define("DATABASE_NAME","navana89_navanandiIDB");

    $connection = mysqli_connect(DATABASE_HOST, DATABASE_USER , DATABASE_PASS, DATABASE_NAME);
    if(!$connection){
        die('Failed to connect to Database');
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
$acceptDocument = array('pdf', 'doc', 'docx', 'xls', 'xlsx', 'txt', 'ppt', 'pptx', 'csv');


?>