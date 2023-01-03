<?php
    require('config.php');?>
	 
<?php
//submit_form.php
if(isset($_POST['contactFrmSubmit']) && !empty($_POST['name']) && !empty($_POST['email']) && (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) && !empty($_POST['phone']) && !empty($_POST['message'])){
     
    // Submitted form data
    $name   = $_POST['name'];
    $email  = $_POST['email'];
    $phone= $_POST['phone'];
	$message   = $_POST['message'];
     
	$dt2=date("Y-m-d H:i:s");
	
	 
	  $enquirySQL = "INSERT INTO `global_contactmessage`(`name`,`email`,`phone`,`message`,`created_date`)";
      $enquirySQL .= "VALUES('$name','$email','$phone','$message','$dt2')";
    if(mysqli_query($connection, $enquirySQL))
	{
		 $status = 'ok';
        } else {
            // Set a 500 (internal server error) response code.
            //http_response_code(500);
            $status = 'err';
        }
     
    // Output status
    echo $status;

    /*
     * Send email to admin
     */
    /*$recipient     = 'shilpashreedh95@gmail.com';
    $subject= 'Contact Message From <b>'.$name.'</b>';
     
    $htmlContent = '
    <h4>Contact Message has submitted from<b>'. $name.'</b>, details are given below.</h4>
	<h3><b>Name : </b>'.$name.'<br>
	<b>Email : </b>'.$email.'<br>
	<b>Mobile No : </b>'.$phone.'<br>
	<b>Message : </b><p>'.$message.'</p><br>
	</h3>
     ';
     
    // Set content-type header for sending HTML email
   $headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// Additional headers
$headers .= 'From: tutorial101<sender@example.com>' . "\r\n";
     
    // Send email
    if (mail($recipient, $subject, $htmlContent, $headers)) {
       
            http_response_code(200);
             $status = 'ok';
        } else {
            // Set a 500 (internal server error) response code.
            http_response_code(500);
            $status = 'err';
        }
     
    // Output status
    echo $status;die;
}*/
}
?>
	 