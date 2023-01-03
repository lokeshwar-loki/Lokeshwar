<?php
    require('config.php');?>
	 
<?php
//submit_form.php
if(isset($_POST['contactFrmSubmit']) && !empty($_POST['name']) && !empty($_POST['email']) && (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) && !empty($_POST['mobileno']) && !empty($_POST['customeraddress']) && !empty($_POST['city']) && !empty($_POST['state']) && !empty($_POST['producturl'])){
     
    // Submitted form data
    $name   = $_POST['name'];
    $email  = $_POST['email'];
    $mobileno= $_POST['mobileno'];
	$customeraddress   = $_POST['customeraddress'];
    $city  = $_POST['city'];
    $state= $_POST['state'];
	$producturl= $_POST['producturl'];
	$dt2=date("Y-m-d H:i:s");
	
	$sql = "select * from global_addtocartproduct where `mobile_no` = '$mobileno' and `product_url` = '$producturl'";
		$query = mysqli_query($connection,$sql);
		$trows = mysqli_num_rows($query);
                 if($trows==0) {
	  $enquirySQL = "INSERT INTO `global_addtocartproduct`(`product_url`,`customername`,`email`,`mobile_no`,`customer_address`,`city`,`state`,`created_date`)";
      $enquirySQL .= "VALUES('$producturl','$name','$email','$mobileno','$customeraddress','$city','$state','$dt2')";
    $query=mysqli_query($connection, $enquirySQL);
	  	 
		 
		 $sqlproduct = "select * from global_product where `product_sku` = '$producturl' and status = 1";
		$queryproduct = mysqli_query($connection,$sqlproduct);
		$trows = mysqli_num_rows($queryproduct);
		$rowsproduct = mysqli_fetch_assoc($queryproduct);
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
    $subject= 'Request for Product';
     
    $htmlContent = '
    <h4>Product request has submitted at Global Enterprises, details are given below.</h4>
	<h3><b>Product Name : </b>'.$rowsproduct['product_name'].'<br>
	<b>Product SKU : </b>'.$rowsproduct['product_sku'].'</h3>
    <table cellspacing="0" style="width: 300px; height: 200px;">
        <tr>
            <th>Name:</th><td>'.$name.'</td>
        </tr>
        <tr style="background-color: #e0e0e0;">
            <th>Email:</th><td>'.$email.'</td>
        </tr>
        <tr>
            <th>Mobile no:</th><td>'.$mobileno.'</td>
        </tr>
		<tr>
            <th>Address:</th><td>'.$customeraddress.'</td>
        </tr>
		<tr>
            <th>City:</th><td>'.$city.'</td>
        </tr>
		<tr>
            <th>State:</th><td>'.$state.'</td>
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
	 