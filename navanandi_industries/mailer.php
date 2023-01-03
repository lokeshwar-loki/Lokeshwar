<?php

function sendSignupMail($email, $key, $name, $user){

    $subject = 'Welcome to '.WEBSITE_NAME;

    $body  = '<div style="border:none; font-family:verdana; font-size:14px; font-color:#303030; text-align:center; line-height:22px; padding:20px 0px;">';
    $body .= '<h2 style="margin:0px;">Welcome to '.WEBSITE_NAME.'</h2>';
    $body .= '<div style="padding:40px 20px; text-align:left">';
    $body .= 'Dear '.$name.',<br>Thank you for signing up on '.WEBSITE_NAME.'<br>Kindly Verify your account.';
    $body .= '</div>';
    $body .= '<a href="'.WEBSITE_URL.'/confirm?verify='.$user.'&key='.$key.'" style="background-color:#FFD800; color:#303030; text-decoration:none; padding:15px 25px; border-radius:25px;">Verify Account</a>';
    $body .= '<div>';

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    //$headers .= "From: admin@infopages-oman.com \r\n";

    if(mail($email, $subject, $body, $headers)){
        return true;
    }else{
        return false;
    }
}

?>