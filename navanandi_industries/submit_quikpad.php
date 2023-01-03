<?php
    require('config.php');?>
	 
<?php
//submit_form.php
if(isset($_POST['contactFrmSubmit']) && !empty($_POST['product_name']) && !empty($_POST['email_address']) && (!filter_var($_POST['email_address'], FILTER_VALIDATE_EMAIL) === false) && !empty($_POST['phone']) && !empty($_POST['company_name'])){
     
    // Submitted form data
    $product_name   = $_POST['product_name'];
    $usage_Application  = $_POST['usage_Application'];
    $required_quantity= $_POST['required_quantity'];
	$company_name   = $_POST['company_name'];
    $contact_name  = $_POST['contact_name'];
    $phone= $_POST['phone'];
	$email_address= $_POST['email_address'];
	$contact_address= $_POST['contact_address'];
	$dt2=date("Y-m-d H:i:s");
	
	$sql = "select * from global_quickpad_enquiry where `product_name` = '$product_name' and `email_address` = '$email_address' and `phone` = '$phone'";
		$query = mysqli_query($connection,$sql);
		$trows = mysqli_num_rows($query);
                 if($trows==0) {
	  $enquirySQL = "INSERT INTO `global_quickpad_enquiry`(`product_name`,`usage_Application`,`required_quantity`,`company_name`,`contact_name`,`phone`,`email_address`,`contact_address`,`created_date`)";
      $enquirySQL .= "VALUES('$product_name','$usage_Application','$required_quantity','$company_name','$contact_name','$phone','$email_address','$contact_address','$dt2')";
    $query=mysqli_query($connection, $enquirySQL);
	  	 
		 
		  
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
    $subject= 'Request for Product Enquiry';
     
    $htmlContent = '
    <h4>Enquiry about Product has been submitted at Global Enterprises, details are given below.</h4>
	<h3><b>Product Name : </b>'.$product_name.'<br>
	<b>Total Product : </b>'.$required_quantity.'<br>
	<b>Usage Application : </b>'.$usage_Application.'<br>
	</h3>
    <table cellspacing="0" style="width: 300px; height: 200px;">
        <tr>
            <th>Company Name:</th><td>'.$company_name.'</td>
        </tr>
		
		<tr>
            <th>Contact Name:</th><td>'.$contact_name.'</td>
        </tr>
		
        <tr style="background-color: #e0e0e0;">
            <th>Email:</th><td>'.$email_address.'</td>
        </tr>
        <tr>
            <th>Mobile no:</th><td>'.$Phone.'</td>
        </tr>
		<tr>
            <th>Address:</th><td>'.$contact_address.'</td>
        </tr>
		 
		 
    </table>';
     
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
	 