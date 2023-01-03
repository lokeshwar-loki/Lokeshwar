<?php
    require('config.php');?>
	 
<?php
//submit_form.php
if(isset($_POST['contactFrmSubmit']) && !empty($_POST['productname']) && !empty($_POST['email']) && (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) && !empty($_POST['customername']) && !empty($_POST['customeraddress'])){
     
    // Submitted form data
    $productname   = $_POST['productname'];
    $productcount  = $_POST['productcount'];
    $customername= $_POST['customername'];
	$customeraddress   = $_POST['customeraddress'];
    $email  = $_POST['email'];
    $phone= $_POST['phone'];
	$message= $_POST['message'];
	$dt2=date("Y-m-d H:i:s");
	
	$sql = "select * from global_repairservice where `phone` = '$phone' and `email` = '$email' and `productname` = '$productname'";
		$query = mysqli_query($connection,$sql);
		$trows = mysqli_num_rows($query);
                 if($trows==0) {
	  $enquirySQL = "INSERT INTO `global_repairservice`(`productname`,`productcount`,`customername`,`customeraddress`,`email`,`phone`,`message`,`created_date`)";
      $enquirySQL .= "VALUES('$productname','$productcount','$customername','$customeraddress','$email','$phone','$message','$dt2')";
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
    $subject= 'Request for Product Repair/service';
     
    $htmlContent = '
    <h4>Repair/service request has been submitted at Global Enterprises, details are given below.</h4>
	<h3><b>Product Name : </b>'.$productname.'<br>
	<b>Total Product : </b>'.$productcount.'</h3>
    <table cellspacing="0" style="width: 300px; height: 200px;">
        <tr>
            <th>Name:</th><td>'.$customername.'</td>
        </tr>
        <tr style="background-color: #e0e0e0;">
            <th>Email:</th><td>'.$email.'</td>
        </tr>
        <tr>
            <th>Mobile no:</th><td>'.$phone.'</td>
        </tr>
		<tr>
            <th>Address:</th><td>'.$customeraddress.'</td>
        </tr>
		<tr>
            <th>Description:</th><td>'.$message.'</td>
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
	 