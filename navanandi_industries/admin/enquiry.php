<?php
  require('config.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Enquiry</title>
    <?php include('links.php'); ?>
  </head>
  <body>
    <div class="container-scroller">

      <?php include('header.php'); ?>

      <div class="container-fluid page-body-wrapper">

        <?php include('navigation.php'); ?>

        <div class="main-panel">

        <div class="p-md-4 p-3">
          <div class="p-4 cus-shadow">
          <div class="table-responsive ">
            <?php
              $bussinessEnquiryRequestSQL = "SELECT enquiry.enquiry_id, enquiry.name, enquiry.email, enquiry.phone, enquiry.message, enquiry.time, enquiry.status, category.title FROM `enquiry` JOIN `category` ON enquiry.category = category.category_id WHERE enquiry.type = 2 ORDER BY `enquiry_id` DESC";
              $bussinessEnquiryRequestResult = mysqli_query($connection, $bussinessEnquiryRequestSQL);

              print(mysqli_error($connection));

              if(mysqli_num_rows($bussinessEnquiryRequestResult) > 0){
                print('<table class="table table-hover table-bordered">');
                print('<thead>');
                print('<td>Name</td>');
                print('<td>Email</td>');
                print('<td>Phone</td>');
                print('<td>Category</td>');
                print('<td>Message</td>');
                print('<td>Time</td>');
                print('<td>Action</td>');
                print('</thead>');
                print('<tbody>');
                while($bussinessEnquiryRequestRow = mysqli_fetch_assoc($bussinessEnquiryRequestResult)){
                  print('<tr>');
                  print('<td>'.$bussinessEnquiryRequestRow['name'].'</td>');
                  print('<td>'.$bussinessEnquiryRequestRow['email'].'</td>');
                  print('<td>'.$bussinessEnquiryRequestRow['phone'].'</td>');
                  print('<td>'.$bussinessEnquiryRequestRow['title'].'</td>');
                  print('<td style="max-width:150px; word-wrap: break-word; white-space: pre-wrap;">'.$bussinessEnquiryRequestRow['message'].'</td>');
                  print('<td>'.date('h:iA,\<\b\r\>d M Y',$bussinessEnquiryRequestRow['time']).'</td>');
                  if($bussinessEnquiryRequestRow['status'] == 0){
                    print('<td><a href="'.WEBSITE_URL.'/enquiry-status-toggle.php?id='.$bussinessEnquiryRequestRow['enquiry_id'].'" class="btn btn-primary w-100"><i class="fa fa-check"></i> Mark Reviewed</a></td>');
                  }else if($bussinessEnquiryRequestRow['status'] == 1){
                    print('<td><span class="btn btn-success w-100">Reviewed</span></td>');
                  }else{
                    print('<td>NA</td>');
                  }
                  print('</tr>');
                }
                print('</tbody>');
                print('</table>');
              }else{
                print('<div class="alert alert-primary text-center small m-0">You have no Bussiness Enquiry Request</div>');
              }
            ?>
          </div>
          </div>
        </div>

        </div>
      </div>
    </div>

    <?php include('links-footer.php'); ?>
  </body>
</html>